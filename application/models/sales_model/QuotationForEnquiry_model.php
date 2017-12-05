<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuotationForEnquiry_model extends CI_Model {

//------------this fun is for get all enquiries for quotation status-------------
    public function fetchEnquiry_For_Quotation() {
        $query = "SELECT * FROM enquiry_master";

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

//------------this fun is for get all enquiries for quotation status-------------
//------------this fun is for get all enquiries sort by date, customer and sort-------------

    public function sort_Enquiry($From_date, $To_date, $Sort_by, $customer_Id) {
        if ($customer_Id == 'all') {
            switch ($Sort_by) {
                case 'live':
                    $sql = "SELECT * FROM quotation_master WHERE status = '1'";
                    break;

                case 'inpo':
                    $sql = "SELECT * FROM quotation_master WHERE status = '0'";
            }
        } else {
            switch ($Sort_by) {
                case 'live':
                    $sql = "SELECT * FROM quotation_master WHERE status = '1' AND cust_id = '$customer_Id'";
                    break;

                case 'inpo':
                    $sql = "SELECT * FROM quotation_master WHERE status = '0' AND cust_id = '$customer_Id'";
            }
        }
    }

    //------------this fun is for get all enquiries sort by date, customer and sort-------------//
    //------------this fun is used to get enquiries by enquiry id--------------------------------//
    public function Show_Enquiry($Enquiries) {
        $query = "SELECT * FROM enquiry_master WHERE enquiry_id = '$Enquiries' AND current_status = '1'";

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

    //------------this fun is used to get enquiries by enquiry id--------------------------------//
}
