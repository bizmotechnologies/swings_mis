<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageQuotationSpecialist_model extends CI_Model {

    public function Get_WorkorderProduction_Detaills() { /* this fun is used to get customer deatails */

        $sqlselect = "";

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

}
