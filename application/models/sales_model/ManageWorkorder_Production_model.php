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
        //print_r($data); die();
        //print_r($QueryForQuotationSpecialist);die();
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
