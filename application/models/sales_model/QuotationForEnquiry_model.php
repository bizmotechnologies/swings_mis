<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QuotationForEnquiry_model extends CI_Model {

//------------this fun is for get all enquiries for quotation status-------------
    public function fetchEnquiry_For_Quotation() {
        $query = "SELECT * FROM enquiry_master WHERE current_status = '1'";

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
    public function Show_Enquiry($enquiry_id) {
        $query = "SELECT * FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";

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

    //------------this fun is used to get enquiry product by enquiry id--------------------------------//
    public function getEnquiry_products($enquiry_id) {
        $query = "SELECT products_associated FROM enquiry_master WHERE enquiry_id = '$enquiry_id'";

        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = 0;
        } else {
            $response = $result->result_array();
        }
        return $response;
    }

    //------------this fun is used to get enquiry product by enquiry id--------------------------------//


    //------------this fun is used to save quotation--------------------------------//
    public function save_quotation($data) {
        extract($data);

        $delivery_P='';
        $enquiry_products=QuotationForEnquiry_model::getEnquiry_products($enquiry_id);

        $this->load->model('inventory_model/ManageCustomer_model');
        $customer_details=$this->ManageCustomer_model->getCustomerBy_ID($customer_id);

        if($enquiry_products==0){
            $response = array(
                'status' => 0,
                'status_message' => 'Quotation Raised Successfully');

            return $response;
            die();
        }
        
        //print_r($enquiry_products);die();
        switch ($delivery_period) {
            case '1':
            $delivery_P='day/days';
            break;

            case '2':
            $delivery_P='week/weeks';
            break;

            case '3':
            $delivery_P='month/months';
            break;

            case '4':
            $delivery_P='year/years';
            break;
            
            default:
                # code...
            break;
        }

        $delivery_within= $delivery_span.' '.$delivery_P;
        $insert_quotation="INSERT INTO quotation_master(enquiry_id,customer_id,customer_name,product_associated,delivery_within,dated,time_at,current_status) VALUES ('$enquiry_id','$customer_id','".$customer_details[0]['customer_name']."','".$enquiry_products[0]['products_associated']."','$delivery_within',NOW(),NOW(),'1')";

        if($this->db->query($insert_quotation)){
            //--------------update enquiry from live enquiry to Quotation---------------------
            $update_enquiry="UPDATE enquiry_master SET current_status = '0' WHERE enquiry_id = '$enquiry_id'";
            if($this->db->query($update_enquiry)){
                $response = array(
                    'status' => 1,
                    'status_message' => 'Quotation Raised Successfully');             
            }
            else{
                $response = array(
                    'status' => 0,
                    'status_message' => 'Quotation Raised but Enquiry remained Live!!!');
            }           
        }
        else {
            $response = array(
                'status' => 0,
                'status_message' => 'Quotation Raising Failed');
        }

        return $response;
    }

    //------------this fun is used to save quotation--------------------------------//
}
