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
        $sqlselect = "SELECT * FROM sub_quotation_specialist WHERE wo_id = '$wo_id' AND current_status IS NULL";

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
        //date_default_timezone_set('Asia/Kuwait');
        $query = "UPDATE wo_production SET end_time ='$time' WHERE wo_id = '$wo_id'";
        $this->db->query($query);
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
    //-------------------------------function for update wo_production end time-------------------//
   //----this fun is used to update the raised query is approved by quotation specialist----------------//     
    public function approvedQuery($data){
        extract($data);
        $query = "UPDATE sub_quotation_specialist SET approved ='approved',reason_for_rejected ='$ReasonForApprove', current_status='1' "
                . "WHERE wo_id = '$wo_id' AND sub_quot_specialist_id='$sp_id'";
        $result = $this->db->query($query);
        
        $sqlSelect = "SELECT * FROM sub_quotation_specialist WHERE wo_id = '$wo_id' AND current_status IS NULL";
        $select = $this->db->query($sqlSelect);
        if($select->num_rows() == 0){
        $updateWo = "UPDATE wo_production SET query_status = '0' WHERE wo_id = '$wo_id'";
        $result = $this->db->query($updateWo);
        }
        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records update successfull');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Updated'
            );
        }
        return $response;
    }
   //----this fun is used to update the raised query is approved by quotation specialist----------------// 
   //----this fun is used to update the raised query is rejected by quotation specialist----------------// 
    public function rejectQuery($data){
        extract($data);
        $query = "UPDATE sub_quotation_specialist SET approved ='approved', reason_for_rejected ='$ReasonForReject', current_status='0' "
                . "WHERE wo_id = '$wo_id' AND sub_quot_specialist_id='$sp_id'";
        $result = $this->db->query($query);
        //-----this update is for to update status of query which is selected----------------------//
        $sqlSelect = "SELECT * FROM sub_quotation_specialist WHERE wo_id = '$wo_id' AND current_status IS NULL";
        $select = $this->db->query($sqlSelect);
        //-----this update is for to update status of query which is selected----------------------//
        if($select->num_rows() == 0){
        $updateWo = "UPDATE wo_production SET query_status = '0' WHERE wo_id = '$wo_id'";
        $result = $this->db->query($updateWo);
        }
        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records update successfull');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Updated'
            );
        }
        return $response;
    }
       //----this fun is used to update the raised query is rejected by quotation specialist----------------// 

}
