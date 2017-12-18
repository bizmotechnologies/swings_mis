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
}
