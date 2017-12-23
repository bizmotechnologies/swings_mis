<?php
error_reporting(E_ERROR | E_PARSE);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageEnquiry_model extends CI_Model {

    public function getBest_tube($material_id, $Material_ID, $Material_OD, $MaterialLength) {
        $criteriaForTube = ManageEnquiry_model::CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $MaterialLength);
        return ($criteriaForTube);
    }

    public function CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $MaterialLength) {
        $sql = "SELECT * from raw_materialstock WHERE material_id = '$material_id'";
        $result = $this->db->query($sql);
        $rawMaterial_ID = 0;
        $rawMaterial_OD = 0;
        $rawMaterial_Tolerance = 0;
        $rawMaterial_LENGTH = 0;
        $criteria = array();
        $response = array();
        $bestTUBE_Arr=array();
        $count=0;

        foreach ($result->result_array() as $row) {
            $rawMaterial_ID = $row['raw_ID'];
            $rawMaterial_OD = $row['raw_OD'];
            $rawMaterial_LENGTH = $row['avail_length'];
            $rawMaterial_Tolerance = $row['tolerance'];
            $Conditionone = $Material_ID - $rawMaterial_ID;
            $Conditiontwo = $Material_OD + $rawMaterial_Tolerance;
            
            //echo $Conditionone;
            if ($Conditionone >= 0) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($rawMaterial_OD >= $Conditiontwo) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($Conditionone == $Material_ID) {
                $criteria[] = 1;
            } elseif ($Conditionone >= $rawMaterial_Tolerance) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if (in_array(0, $criteria)) {
                $response = array(
                    'status' => 0,
                    'value' => 'N/A'
                );
                unset($criteria);
            } else {
                $bestprice=ManageEnquiry_model::GetMaterialBasePrice($material_id, $rawMaterial_ID, $rawMaterial_OD, $MaterialLength);
                
                $bestTUBE=array(
                    'best_tube' =>  $rawMaterial_ID . '/' . $rawMaterial_OD,
                    'best_price'    =>  $bestprice
                );
                $bestTUBE_Arr[]=$bestTUBE;
                unset($criteria);
                $count=1;
            }
        }

        if($count==1){
            ManageEnquiry_model::sksort($bestTUBE_Arr,'best_price');
            $response = array(
                'status' => 1,
                'value' => $bestTUBE_Arr[0]['best_tube'],
                'best_price' => $bestTUBE_Arr[0]['best_price']
            ); 
        }        
        return $response;
    }

    // ----------------sksort function to get min best_price------------------//
    public function sksort(&$array, $subkey="id", $sort_ascending=true) {

        if (count($array))
            $temp_array[key($array)] = array_shift($array);

        foreach($array as $key => $val){
            $offset = 0;
            $found = false;
            foreach($temp_array as $tmp_key => $tmp_val)
            {
                if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
                {
                    $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                        array($key => $val),
                        array_slice($temp_array,$offset)
                    );
                    $found = true;
                }
                $offset++;
            }
            if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
        }

        if ($sort_ascending) $array = array_reverse($temp_array);

        else $array = $temp_array;
    }

    //------------------------end the functions-------------------------//

    //----this funis used to get value from table to perform bestprice calculations
    public function GetMaterialBasePrice_byBranchPrice($material_id, $Material_ID, $Material_OD,$branchprice, $Material_LENGTH){
        $customizevalue = ManageEnquiry_model::getcustomizedvalueforCalculation();
        $setting_value = json_decode($customizevalue, TRUE);

        $material_details = ManageEnquiry_model::getmaterial_AvailLength($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        $vendor_id=$material_details[0]['vendor_id'];
        $avail_length=$material_details[0]['avail_length'];

        $this->load->model('inventory_model/VendorManagement_model');
        $vendor_details=$this->VendorManagement_model->GetVendorDetails($vendor_id);

        $cut_value = 0;
        $profit_margin = 0;
        $single_cost = 0;
        $cut_value = $setting_value['cut_value'];
        $profit_margin = 2.65;
        $vendor_discount = ($vendor_details['status_message'][0]['vendor_discount']);
        $landed_cost = ($branchprice * ((100 - $vendor_discount)/100)) * ($vendor_details['status_message'][0]['vendor_landing_cost']);
        $costPer_mm= $landed_cost / 134;
//print_r($vendor_discount);die();
        $single_cost = $costPer_mm * ($profit_margin * ($cut_value + $Material_LENGTH));
        $decimal_price=number_format($single_cost,2,'.','');
        return $decimal_price;
    }
//----this funis used to get value from table to perform bestprice calculations
//-----this fun is used to get material base price calculations-------------//
    public function GetMaterialBasePrice($material_id, $MaterialID, $MaterialOD, $MaterialLength) {
        $material_details = ManageEnquiry_model::getmaterialDetailsforcalculation($material_id, $MaterialID, $MaterialOD, $MaterialLength);
        $avail_length = ManageEnquiry_model::getmaterial_AvailLength($material_id, $MaterialID, $MaterialOD, $MaterialLength);
        $material_price=$material_details[0]['material_price'];
        $vendor_id=$material_details[0]['vendor_id'];

        $this->load->model('inventory_model/VendorManagement_model');
        $vendor_details=$this->VendorManagement_model->GetVendorDetails($vendor_id);

        //print_r($vendor_details['status_message'][0]['profit_margin']);
        $customizevalue = ManageEnquiry_model::getcustomizedvalueforCalculation();
        $setting_value = json_decode($customizevalue, TRUE);
        $cut_value = 0;
        $profit_margin = 0;
        $single_cost = 0;
        $cut_value = $setting_value['cut_value'];
        $profit_margin = 2.65;

        $vendor_discount = ($vendor_details['status_message'][0]['vendor_discount']);

        $landed_cost = ($material_price * ((100 - $vendor_discount)/100)) * ($vendor_details['status_message'][0]['vendor_landing_cost']);
        $costPer_mm= $landed_cost / 134;

        $single_cost = $costPer_mm * ($profit_margin * ($cut_value + $MaterialLength));

        $decimal_price=number_format($single_cost,2,'.','');
        return $decimal_price;
    }


//-----this fun is used to get material base price calculations-------------//
    public function getmaterialDetailsforcalculation($material_id, $MaterialID, $MaterialOD, $MaterialLength) {
        $sql = "SELECT vendor_id,material_price FROM raw_materialstock WHERE material_id = '$material_id' "
        . "AND raw_ID = '$MaterialID' AND raw_OD ='$MaterialOD'";

        $result = $this->db->query($sql);
        $material_price = '0.00';
        $vendor_id='0';
        $details='';
        if ($result->num_rows() <= 0) {
            $material_price = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            foreach ($result->result_array() as $row) {
                $material_price = $row['material_price'];
                $vendor_id = $row['vendor_id'];
            }
            $details[]=array(
                'material_price'    =>   $material_price,
                'vendor_id' =>  $vendor_id
            );
        }
        return $details;
    }
//-----this fun is used to get material base price calculations-------------//

//-----this fun is used to get material length -------------//
    public function getmaterial_AvailLength($material_id, $MaterialID, $MaterialOD, $MaterialLength) {
        $sql = "SELECT vendor_id,avail_length FROM raw_materialstock WHERE material_id = '$material_id' "
        . "AND raw_ID = '$MaterialID' AND raw_OD ='$MaterialOD'";

        $result = $this->db->query($sql);
        $avail_length = '0';
        $details='';
        if ($result->num_rows() <= 0) {
            $avail_length = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            foreach ($result->result_array() as $row) {
                $avail_length = $row['avail_length'];
                $vendor_id = $row['vendor_id'];
            }
            $details[]=array(
                'avail_length'    =>   $avail_length,
                'vendor_id' =>  $vendor_id
            );
        }
        return $details;
    }
//-----this fun is used to get material length-------------//


//-----this fun is used to get customized values for  calculations-------------//

    public function getcustomizedvalueforCalculation() {
        $query = "SELECT * FROM customize_settings";
        $result = $this->db->query($query);
        $cut_value = 0;
        $profit_margin = 0;
        $landing_value = 0;
        $euro_cost = 0;
        $arrnew = array();
        foreach ($result->result_array() as $key) {
            switch ($key['setting_name']) {
                case 'cut_value':
                $cut_value = $key['setting_value'];
                break;

                case 'landing_value':
                $landing_value = $key['setting_value'];
                break;

                case 'profit_margin':
                $profit_margin = $key['setting_value'];
                break;

                case 'euro_cost':
                $euro_cost = $key['setting_value'];
                break;

                default:
                    # code...
                break;
            }
        }
        $arrnew = array(
            'cut_value' => $cut_value,
            'profit_margin' => $profit_margin,
            'landing_value' => $landing_value,
            'euro_cost' => $euro_cost,
        );
        $customizevalue = json_encode($arrnew);
        return $customizevalue;
    }

    /* this  function is used for material records  */
    /* this  function is used to show available tube from raw materials  */
    public function showAvailable_Tube($material_id, $Material_ID, $Material_OD, $Material_LENGTH){
        $criteriaForAvailableTube = ManageEnquiry_model::CheckCriteriaForAvailableTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        return ($criteriaForAvailableTube);

    }
    /* this  function is used to show available tube from raw materials  */
    /* this  function is used to set Crieria for available tube from raw materials  */
    public function CheckCriteriaForAvailableTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH){

        $sql = "SELECT * from raw_materialstock WHERE material_id = '$material_id'";
        $result = $this->db->query($sql);
        $rawMaterial_ID = 0;
        $rawMaterial_OD = 0;
        $rawMaterial_Tolerance = 0;
        $rawMaterial_LENGTH = 0;
        $criteria = array();
        $response = array();
        $tube = array();
        $length = array();
        foreach ($result->result_array() as $row) {
            $rawMaterial_ID = $row['raw_ID'];
            $rawMaterial_OD = $row['raw_OD'];
            $rawMaterial_LENGTH = $row['avail_length'];
            $rawMaterial_Tolerance = $row['tolerance'];
            $Conditionone = $Material_ID - $rawMaterial_ID;
            $Conditiontwo = $Material_OD + $rawMaterial_Tolerance;
            //echo $Conditionone;
            if ($Conditionone >= 0) {   //----criteria no1 for available tube
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($rawMaterial_OD >= $Conditiontwo) {   //----criteria no2 for available tube
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if ($Conditionone == $Material_ID) {  //----criteria no3 for available tube
                $criteria[] = 1;
            } elseif ($Conditionone >= $rawMaterial_Tolerance) {
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            $length_avail = ($Material_LENGTH + $rawMaterial_Tolerance);   //----criteria no4 for length for available tube
            //echo $length_avail;
            if ($rawMaterial_LENGTH >= $length_avail) {    //---checking the material length is greater than provided length
                $criteria[] = 1;
            } else {
                $criteria[] = 0;
            }

            if (in_array(0, $criteria)) {   //----checking criteria for available tube as all criteria TRUE
                $response = array(
                    'status' => 0,
                    'value' => 'N/A'       //------if single criteria is not true it returns false
                );
                unset($criteria);
            } else {
                $tube[] = $rawMaterial_ID . '/' . $rawMaterial_OD;  //---this tube is collection of all tube which satisfies with above criteria
                $length[] = $rawMaterial_LENGTH; //---the length for satisfied tube
                unset($criteria);
            }
        }
        if(!empty($tube)){
            $response = array(
                'status' => 1,
                'tube' => $tube,
                'length' => $length
            );
        }
        else{
            $response = array(
                'status' => 0,
                'tube' => 'N/A',
                'length' => 'N/A'
            );
        }
        //print_r($response); //die();
        return $response;
    }
    /* this  function is used to set Crieria for available tube from raw materials  */
    // this function is used to save  products in enquiry///////////
    public function saveProductForEnquiry($data) {
        extract($data);

        $sql = "INSERT INTO enquiry_master (customer_id,customer_name,products_associated,time_on,date_on,current_status,branch_name) 
        VALUES ('".$customer_id."','".$customer_name."','".$products_associated."',NOW(),NOW(),'1','$branch_name')";
        //echo $sql; die();
        $result = $this->db->query($sql);

        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Enquiry Details Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Enquiry Not Inserted Successfully...!');
        }

        return $response;
    }

// Ending function save products in enquiry/////////////
   //---------------------GET AVAILABLE TUBE FROM RAW MATERIAL------------------------------//
    public function get_AvailableTube($material_id, $MaterialID, $MaterialOD){
      $sql = "SELECT max(avail_length) as avail_length FROM raw_materialstock WHERE material_id = '$material_id' "
      . "AND raw_ID <= '$MaterialID' AND raw_OD >='$MaterialOD'";

      $result = $this->db->query($sql);
      $avail_length = '0.00';
      if ($result->num_rows() <= 0) {
        $avail_length = array(
            'status' => 0,
            'status_message' => '<label>Available Tube: N/A</label>');
    } else {
        foreach ($result->result_array() as $row) {
            $avail_length = $row['avail_length'];
        }
        $avail_length = array(
            'status' => 0,
            'status_message' => $avail_length);
    }
    return $avail_length;
}
    //---------------------GET AVAILABLE TUBE FROM RAW MATERIAL------------------------------// 

public function SaveProfile_data($housingInfo){
    extract($housingInfo);
        //print_r($housingInfo); die();
    $sqlselect = "SELECT * FROM profile_combination WHERE profile_id = '$profile_id'";
    $result = $this->db->query($sqlselect);
    if ($result->num_rows() <= 0) {
        $sql = "INSERT INTO profile_combination(profile_id,profile_data) 
        VALUES ('$profile_id','$profile_data')";
        $result = $this->db->query($sql);
    } else {
        $sql = "UPDATE profile_combination SET profile_data = '$profile_data' WHERE profile_id = '$profile_id'";
        $result = $this->db->query($sql);
    }
}

public function getAvailableTubeFromAllBranches($material_id, $Material_ID, $Material_OD){
        //echo $material_id;
    $branch_name = '';
    $branch = '';
    $tube = '';
    $price = '';
    $available_tubes = '';
    $sql = "SELECT * FROM branch_table";
    $result = $this->db->query($sql);
    $all_branchData=array();
    if ($result->num_rows() >= 0) {         
        foreach ($result->result_array() as $row) {
            $branch_name = $row['branch_name'];

            $selectSql = "SELECT * FROM raw_materialstock WHERE "
            . "raw_ID = '$Material_ID' AND raw_OD = '$Material_OD' "
            . "AND material_id ='$material_id' AND branch_name = '$branch_name' LIMIT 1";
                //echo $selectSql;                die();
            $resultSelect = $this->db->query($selectSql);
            if($resultSelect->num_rows() >= 0){
                foreach ($resultSelect->result_array() as $key) {
                    $branch = $key['branch_name'];
                    $tube = $key['raw_ID'] . '/' . $key['raw_OD'];
                    $price = $key['material_price'];
                    
                    $available_tubes = array(
                        'branch_name' => $branch,
                        'tube' => $tube,
                        'price' => $price
                    );       
                    $all_branchData[] = $available_tubes;
                }
                   // print_r($all_banchData);
                $response = array(
                    'status' => 1,
                    'status_message' => $all_branchData);
            } 
            else{
             $response = array(
                'status' => 0,
                'status_message' => 'Tube is not available in this branch.'
            ); 
         }
     }
     return $response;
 }
                //return $response;
}

}

?>