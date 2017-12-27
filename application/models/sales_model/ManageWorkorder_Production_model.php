<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageWorkorder_Production_model extends CI_Model {

//----this fun is used to get all wo id of workorder which is ready for production

    public function get_Workorderfor_Production() {
        $query = "SELECT * FROM wo_production WHERE current_status = '1'";
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
    public function get_Workorderfor_Product_details($wo_id){
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
//-----this fun is used to save all the query is to be saved in subquotation specialist table-------//    
    public function Submit_raiseQueryDetails($data) {
        extract($data);
        $QueryForQuotationSpecialistnew = json_decode($QueryForQuotationSpecialist, TRUE);         
        foreach($QueryForQuotationSpecialistnew as $key){            
        $sql = "INSERT INTO sub_quotation_specialist (wo_id,customer_name,profile_name,"
                    . "original_material_name,"
                    . "changed_material_name,"
                    . "material_id,"
                    . "material_od,"
                    . "original_material_length,"
                    . "changed_material_length,"
                    . "reason_changed_length_material,"
                    . "approved,"
                    . "rejected,"
                    . "reason_for_rejected,"
                    . "role,"
                    . "branch_name,"
                    . "submitted_date,"
                    . "modified_date,"
                    . "current_status) "
                    . "VALUES "
                    . "('$wo_id',"
                    . "'$CustomerName',"
                    . "'" . $key['ChangedprofileName'] ."',"
                    . "'" . $key['ChangedmaterialName'] . "',"
                    . "'" . $key['UpdatedMaterialName'] . "',"
                    . "'" . $key['material_ID'] . "',"
                    . "'" . $key['material_OD'] . "',"
                    . "'" . $key['Allotedmaterial_length'] . "',"
                    . "'" . $key['Consumedmaterial_length'] . "',"
                    . "'" . $key['reasonForchange'] . "',"
                    . "'','','','',"
                    . "'$branch_name',"
                    . "now(),'','')";
            //echo $sql;die();
        $resultnew = $this->db->query($sql);       
        }
        //----if the above query inserted then the below query of update table wo production-----------//
        if ($resultnew) {
            $sqlupdate = "UPDATE wo_production SET query_status = '1' WHERE wo_id = '$wo_id'";//--update with status to wo for production
            $resultnew = $this->db->query($sqlupdate);
            if ($resultnew) {
                $response = array(
                    'status' => 1,
                    'status_message' => 'Query Raised Successfully..!');
            } else {
                $response = array(
                    'status' => 0,
                    'status_message' => 'Query Not Raised...!');
            }
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Query Not Raised...!');
        }
        return $response;
    }
//-----this fun is used to save all the query is to be saved in subquotation specialist table-------//    
     //--------------------------function for update wo_production start time------------------//
    public function update_start_time($wo_id) {
        $tz = date_default_timezone_set('Asia/Kolkata');       
        $time=date('h:i:s',time($tz));
        $date = date('Y-m-d');
        $query = "UPDATE wo_production SET start_time ='$time',open ='open',start_date ='$date' WHERE wo_id = '$wo_id'";
        //echo $query; die();
        $this->db->query($query);
        if ($this->db->affected_rows() == 1) {
            $response = array(
                'status' => 1,
                'status_message' => 'Work Order Is Started..!');           
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Work Order Is Not Started..!'
            ); 
        }
        return $response;
    }

    //---this fun is for update wo production table by start time and date and state--------------//
    //-------------------------------function for update wo_production end time-------------------//
    public function update_end_time($wo_id) {
        $tz = date_default_timezone_set('Asia/Kolkata');       
        $time=date('h:i:s',time($tz));
        $date = date('Y-m-d');
        $query = "UPDATE wo_production SET end_time ='$time',close ='close',end_date ='$date',current_status='0' WHERE wo_id = '$wo_id'";
        //echo $query; die();
        $this->db->query($query);
        if ($this->db->affected_rows() == 1) {
            $response = array(
                'status' => 1,
                'status_message' => 'Work order completed...!');            
        } else {
            $response = array(
                'status' => 0,
                'status_message' => ' No Records Updated');
        }
        return $response;
    }
    //-------------------------------function for update wo_production end time-------------------//
         
        public function cron_job($wo_id, $scheduler_status) {
        $sqlupdate = "UPDATE wo_production SET scheduler_status ='$scheduler_status' WHERE wo_id ='$wo_id'";
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

//----this fun is used to get all wo id of workorder which is ready for production

   
}
