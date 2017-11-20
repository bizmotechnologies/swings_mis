<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageMaterial_model extends CI_Model {

    public function getMaterialrecord() { /* this  function is used for material records  */
        $query = "SELECT * FROM materials";
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

    public function getRawMaterialInfo() { /* this  function is used for material records  */
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
 public function GetMaterilaInformation($data){
     extract($data);
     $query = "SELECT * FROM raw_materialstock WHERE material_id = ".$material_id;
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
 //----this fun is used to get all raw material information ends here-----//
    
    
// this function is used to save materials///////////
    public function saveMaterial($data) {
        extract($data);
        //print_r($data);
        $sql = "INSERT INTO materials
		(material_name,material_color) 
        VALUES ('" . strtoupper($material_nameForStock) . "','" . strtoupper($materialColor_ForStock) . "')";
        //echo $sql; die();
        $result = $this->db->query($sql);

        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Inserted Successfully...!');
        }
        return $response;
    }

// Ending function savematerial /////////////
// this fun is used for update material details---------------------

    public function updateRecord($data) {
        extract($data);
        //print_r($data);die();
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