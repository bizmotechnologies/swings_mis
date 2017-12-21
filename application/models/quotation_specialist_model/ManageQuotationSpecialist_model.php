<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageQuotationSpecialist_model extends CI_Model {

    //----this fun is used to get all details of wo productions
    public function Get_WorkorderProduction_Details() { /* this fun is used to get customer deatails */

        $sqlselect = "SELECT * FROM wo_production WHERE query_status = '1'";

        $result = $this->db->query($sqlselect);

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

    //----this fun is used to get all details of wo productions
    //----this fun is used to get all details of quotations specialist
    public function getqueryForChange($wo_id) {
        $sqlselect = "SELECT * FROM quotation_specialist WHERE wo_id = '$wo_id'";

        $result = $this->db->query($sqlselect);

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

    //----this fun is used to get all details of quotations specialist
    //--------------------------function for update wo_production start time------------------//
    public function update_start_time($wo_id) {
        $tz = 'Asia/Kolkata';
        $time = date('H:i:s', time($tz));
        $query = "UPDATE wo_production SET start_time ='$time' WHERE wo_id = '$wo_id'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() >= 1) {
            $response = array(
                'status' => 0,
                'status_message' => ' No Records Updated'
            );
        } else {
            $response = array(
                'status' => 1,
                'status_message' => 'Records update successfull');
        }
        return $response;
    }

    //---this fun is 
    //-------------------------------function for update wo_production end time-------------------//
    public function update_end_time($wo_id) {
        $tz = 'Asia/Kolkata';
        $time = date('H:i:s', time($tz));
        $query = "UPDATE wo_production SET end_time ='$time' WHERE wo_id = '$wo_id'";
        $result = $this->db->query($query);
        if ($this->db->affected_rows() >= 1) {
            $response = array(
                'status' => 0,
                'status_message' => ' No Records Updated'
            );
        } else {
            $response = array(
                'status' => 1,
                'status_message' => 'Records update successfull');
        }
        return $response;
    }

}
