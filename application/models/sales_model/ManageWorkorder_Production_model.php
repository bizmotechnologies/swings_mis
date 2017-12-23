<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageWorkorder_Production_model extends CI_Model {

//----this fun is used to get all wo id of workorder which is ready for production

    public function get_Workorderfor_Production() {
        $query = "SELECT * FROM wo_production";
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

//----this fun is used to get all wo id of workorder which is ready for production
//----this fun is used to get all details of workorder which is ready for production
    public function get_Workorderfor_Production_details($wo_id) {
        $query = "SELECT * FROM wo_production WHERE wo_id = '$wo_id'";
        $result = $this->db->query($query);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Such Work Orders Found.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

//----this fun is used to get all details of workorder which is ready for production
    public function Submit_raiseQueryDetails($data) {
        extract($data);
        print_r($data); die();
        //print_r($QueryForQuotationSpecialist);die();
        
        
        $sql = "INSERT INTO quotation_specialist (wo_id,customer_name,queryfor_specialist,submitted_date, current_status) "
                . "VALUES ('$wo_id','$CustomerName','$QueryForQuotationSpecialist',now(),'1')";
        //echo $sql;die();
        $resultnew = $this->db->query($sql);
        if ($resultnew) {
            $sqlupdate = "UPDATE wo_production SET query_status = '1' WHERE wo_id = '$wo_id'";
            $resultnew = $this->db->query($sqlupdate);
            if ($resultnew) {
                $response = array(
                    'status' => 1,
                    'status_message' => 'Records Inserted Successfully..!');
            } else {
                $response = array(
                    'status' => 0,
                    'status_message' => 'Records Not Inserted Successfully...!');
            }
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Inserted Successfully...!');
        }
        return $response;
    }

}
