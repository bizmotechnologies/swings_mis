<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageMaterial_model extends CI_Model {

    public function getMaterialrecord() { /* this  function is used for material records  */
        $query = "SELECT * FROM materials";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

    /* fun ends here */

//--------------------/*this fun is used to get material name for save materials*/---------------------------
    public function getMaterialdata($material_id) {
        $sql = "SELECT material_name FROM materials WHERE material_id='$material_id'";
        $resultnew = $this->db->query($sql);

        $material_name = "";

        foreach ($resultnew->result_array() as $row) {
            $material_name = $row['material_name'];
        }
        return $material_name;
    }

//-------------------------/*this fun is used to get material name for save materials ends here-------------------------*/

//--------------------get profile information----------------------//
    public function GetProfileInformation($Profiles) {
        $query = "SELECT * FROM product_profile WHERE profile_id = '$Profiles'";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

//------this fun is used to get all customers details-----------//
    public function GetCustomersDetails() {
        $query = "SELECT * FROM customer_details";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

//------this fun is used to get all customers details-----------//
    //------this fun is used to get all informaion of product profile
    public function GetProductProfileDetails() {
        $query = "SELECT * FROM product_profile";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

//-----------this fun is used to get material Final price for calaculation-------//
    //-----this fun is udsed to get tube history for customer-----------//
    public function GetTubeHistoryForInquiry($Customer_id, $Profile_id) {
        $query = "SELECT * FROM quotation_master WHERE cust_id = '$Customer_id' AND profile_id = '$Profile_id'";
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => 'records found..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

    //-----this fun is udsed to get tube history for customer-----------//
//    public function GetFinalriceForMaterialCalculation($data) {
//        extract($data);
//    }

    public function getRawMaterialInfo() {
        $query = "SELECT * FROM raw_materialstock";
        $result = $this->db->query($query);
        if ($result->num_rows() >= 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;
    }

    /* fun ends here */

    //----this fun is used to get all raw material information-----//
    public function GetMaterialInformation($data) {
        extract($data);
        $query = "SELECT * FROM raw_materialstock WHERE material_id = " . $material_id;
        $result = $this->db->query($query);
        if ($result->num_rows() > 0) {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No records found');
        }
        return $response;    }

    //----this fun is used to get all raw material information ends here-----//

//------this fun is used to get all material inforation-----------------//
    public function GetMaterialInformation_ForEnquiry($data) { /* this fun is used to get material data */

        $sqlselect = "SELECT * FROM raw_materialstock WHERE material_id = '$data'";
        $result = $this->db->query($sqlselect);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $info = array();
            foreach ($result->result_array() as $key) {
                $newarr = array(
                    'raw_ID' => $key['raw_ID'],
                    'raw_OD' => $key['raw_OD'],
                    'avail_length' => $key['avail_length']
                );
                $info[] = $newarr;
            }
            $response = json_encode($info);
        }
        return $response;
    }


    //-----------------------function to check whether material name already exists------------------//
    function checkMaterial_exist($material_name)
    {
        $query = null;
        $query = $this->db->get_where('materials', array(//making selection
            'material_name' => $material_name
        ));     
        
        if ($query->num_rows() > 0) {
            return 0;           
        } else {
            return 1;           
        }
    }
    //---------------------------END-----------------------------------------//

// this function is used to save materials///////////
    public function saveMaterial($data) {
        extract($data);
        
        $checkMaterial=ManageMaterial_model::checkMaterial_exist($material_nameForStock);//---------check if material already exist or not

        if($checkMaterial){
        $sql = "INSERT INTO materials
		(material_name,material_color) 
        VALUES ('" . strtoupper($material_nameForStock) . "','" . strtoupper($materialColor_ForStock) . "')";
        //echo $sql; die();
        $result = $this->db->query($sql);

        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Material Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Material Not Inserted Successfully...!');
        }
    }
    else{
         $response = array(
                'status' => 0,
                'status_message' => 'Material Name already exists. Try Different...!');
    }
        return $response;
    }

// Ending function savematerial /////////////


// this fun is used for update material details---------------------

    public function updateRecord($data) {
        extract($data);

        $mat_code = 0;
        $mat_codenew = 0;
        $code = 0;
        $material_code = 0;
        $material_codenew = 0;
        $mat_code = $updated_materialname[0];
        $mat_codenew = $updated_materialname[1];
        $var = $mat_code . $mat_codenew;
        $code = strtoupper($var);
        $material_codenew = uniqid();
        $material_code = $code . '_' . $material_codenew;

        $doller = 0;
        $conversion_rate = 0;
        $currency = $Select_UpdatedCurrency;
        switch ($currency) {
            case "dollar":
                $conversion_rate = $updated_costpermm * $UpdatedCurrency_amount;
                break;
            case "euro":
                $conversion_rate = $updated_costpermm * $UpdatedCurrency_amount;
                break;
            case "pound":
                $conversion_rate = $updated_costpermm * $UpdatedCurrency_amount;
                break;
        }

        $sqlupdate = "UPDATE materials SET material_name = '$updated_materialname',
	material_innerdimention = '$updated_materialID',
	material_outerdimention = '$updated_materialOD',
	pricepermm ='$updated_costpermm', material_code = '$material_code',
	conversion_rate ='$conversion_rate', Currency_amount = '$UpdatedCurrency_amount', currency = '$currency' WHERE material_id='$new_material_id'";
//echo $sqlupdate ; die();
        $resultupdate = $this->db->query($sqlupdate);

        if ($resultupdate) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
    }

// this update material details function ends here-----------------

    public function deleteRecord($data) { /* delete function starts here */
        extract($data);
        $sqldelete = "DELETE FROM materials WHERE material_id='$material_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($this->db->affected_rows() >= 1) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted...!');
        }

        return $response;
    }

    /* delete  function ends here */
}

?>