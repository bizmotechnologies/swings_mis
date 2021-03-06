<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Sort_Enquiry_Quotations_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model/Enquiry_model');
        $this->load->model('sales_model/QuotationForEnquiry_model');
    }

//------------this fun is used to get sort enquiry by the date,customer and status-------------------//
    public function filter_quotation_get() {
        //print_r($_GET);die();
        $From_date = $_GET['From_date'];
        $To_date = $_GET['To_date'];
        $customer_Id = $_GET['customer_id'];
        $response = $this->QuotationForEnquiry_model->filter_quotation($From_date, $To_date, $customer_Id);
        return $this->response($response);
    }

//------------this fun is used to get sort enquiry by the date,customer and status-------------------//
    //--------------this fun is used to get sort quotation details by status-------------------------//
    public function sort_byStatus_get() {
        $From_date = $_GET['From_date'];
        $To_date = $_GET['To_date'];
        $Sort_by = $_GET['Sort_by'];
        $customer_Id = $_GET['customer_id'];
        $response = $this->QuotationForEnquiry_model->sort_byStatus($From_date, $To_date, $Sort_by, $customer_Id);
        return $this->response($response);
    }

    //--------------this fun is used to get sort quotation details by status-------------------------//
//---this fun is used to sort the enquiries -----------------------------------------//    
    
    public function sort_Enquiries_get(){
        $From_date = $_GET['Enquiry_From_date'];
        $To_date = $_GET['Enquiry_To_date'];
        $customer_Id = $_GET['customer_id'];
        $response = $this->QuotationForEnquiry_model->sort_Enquiries($From_date, $To_date, $customer_Id);
        return $this->response($response);
    }
//---this fun is used to sort the enquiries -----------------------------------------//    
//---------------this fun is used to join the quotations -----------------------------------------//    
    public function joinQuotations_get(){
        extract($_GET);
        $quotations_id = $_GET['quotations_id'];
        $join_QuotationsArray = $_GET['join_QuotationsArr'];
        $response = $this->QuotationForEnquiry_model->joinQuotations($quotations_id,$join_QuotationsArray);
        return $this->response($response);
    }
//---------------this fun is used to join the quotations -----------------------------------------//    
    
}
