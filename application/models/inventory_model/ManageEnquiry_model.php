<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageEnquiry_model extends CI_Model {

    public function getBest_tube($material_id, $Material_ID, $Material_OD, $Material_LENGTH) {
        $criteriaForTube = ManageEnquiry_model::CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        return ($criteriaForTube);
    }

    public function CheckCriteriaForCalculatedTube($material_id, $Material_ID, $Material_OD, $Material_LENGTH) {

        $sql = "SELECT * from raw_materialstock WHERE material_id = '$material_id'";
        $result = $this->db->query($sql);
        $rawMaterial_ID = 0;
        $rawMaterial_OD = 0;
        $rawMaterial_Tolerance = 0;
        $rawMaterial_LENGTH = 0;
        $criteria = array();
        $response = array();

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


            $length_avail = ($Material_LENGTH + $rawMaterial_Tolerance);
            //echo $length_avail;
            if ($rawMaterial_LENGTH >= $length_avail) {
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
                $length_avail = ($Material_LENGTH + $rawMaterial_Tolerance);
                $response = array(
                    'status' => 1,
                    'value' => $rawMaterial_ID . '/' . $rawMaterial_OD
                );
                //print_r($response);die();
                unset($criteria);
                break;
            }
        }
        return $response;
    }

//-----this fun is used to get material base price calculations-------------//
    public function GetMaterialBasePrice($material_id, $MaterialID, $MaterialOD, $MaterialLength) {

        $material_price = ManageEnquiry_model::getmaterialPriceforcalculation($material_id, $MaterialID, $MaterialOD, $MaterialLength);
        $customizevalue = ManageEnquiry_model::getcustomizedvalueforCalculation();
        $setting_value = json_decode($customizevalue, TRUE);
        //print_r($setting_value);
        $cut_value = 0;
        $profit_margin = 0;
        $single_cost = 0;
        $cut_value = $setting_value['cut_value'];
        $profit_margin = $setting_value['profit_margin'];

        $single_cost = $material_price * ($profit_margin * ($cut_value + $MaterialLength));

        return $single_cost;
    }

//-----this fun is used to get material base price calculations-------------//


    public function getmaterialPriceforcalculation($material_id, $MaterialID, $MaterialOD, $MaterialLength) {
        $sql = "SELECT material_price FROM raw_materialstock WHERE material_id = '$material_id' "
                . "AND raw_ID = '$MaterialID' AND raw_OD ='$MaterialOD' AND avail_length >= '$MaterialLength'";

        $result = $this->db->query($sql);
        $material_price = '0.00';
        if ($result->num_rows() <= 0) {
            $material_price = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            foreach ($result->result_array() as $row) {
                $material_price = $row['material_price'];
            }
        }
        return $material_price;
    }

//-----this fun is used to get material base price calculations-------------//
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



    // this function is used to save  products in enquiry///////////
    public function saveProductForEnquiry($data) {
        extract($data);

        $sql = "INSERT INTO enquiry_master (customer_id,customer_name,products_associated,time_on,date_on,current_status) 
        VALUES ('".$customer_id."','".$customer_name."','".$products_associated."',NOW(),NOW(),'1')";
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
}

?>