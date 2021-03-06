<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageQuotations_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model/Enquiry_model');
        $this->load->model('sales_model/QuotationForEnquiry_model');
    }

    // -----------------------GET CUSTOMER'S QUOTATIONS API----------------------//
    //-------------------------------------------------------------//
    public function getCustomer_quotations_get() {
        $customer_id = $_GET['cust_id'];
        $result = $this->Enquiry_model->getQuotations($customer_id);
        return $this->response($result);
    }

    //---------------------GET CUSTOMER'S QUOTATIONS END------------------------------//
    // -----------------------GET ALL LIVE QUOTATIONS API----------------------//
    //-------------------------------------------------------------//
    public function all_liveQuotations_get() {
        $result = $this->Enquiry_model->getlive_Quotations();
        return $this->response($result);
    }

    //---------------------GET ALL LIVE QUOTATIONS END------------------------------//
    // -----------------------GET QUOTATIONS DETAILS API----------------------//
    //-------------------------------------------------------------//
    public function quotationDetails_get() {
        $sub_quotationID = $_GET['sub_quotationID'];
        $result = $this->Enquiry_model->getQuotation_details($sub_quotationID);
        return $this->response($result);
    }

    //---------------------GET QUOTATIONS DETAILS END------------------------------//
// -----------------------DELETE CUSTOMER API----------------------//
    //-------------------------------------------------------------//
    public function DeleteCustomerDetails_get() {
        $data = $_GET;
        $response = $this->ManageCustomer_model->DeleteCustomerDetails($data);
        return $this->response($response);
    }

    //---------------------DELETE CUSTOMER END------------------------------//
//------------this fun is used to get enquiry -------------------//

    public function fetchEnquiry_For_Quotation_get() {
        $response = $this->QuotationForEnquiry_model->fetchEnquiry_For_Quotation();
        return $this->response($response);
    }

//------------this fun is used to get enquiry -------------------//

    //------------this fun is for get enquiry by id-------------------------------------//
    public function Show_Enquiry_get() {
        $enquiry_id = $_GET['enquiry_id'];
        $response = $this->QuotationForEnquiry_model->Show_Enquiry($enquiry_id);
        return $this->response($response);
    }

    //------------this fun is for get enquiry by id-------------------------------------//
    //------------this fun is save quotation-------------------------------------//
    public function save_quotation_post() {
        $data = $_POST;
        $response = $this->QuotationForEnquiry_model->save_quotation($data);
        return $this->response($response);
    }

    //------------this fun is save quotation-------------------------------------//
    //------------this fun is send quotation to PO-------------------------------------//
    public function sendTo_WO_get() {
        $quotation_id = $_GET['quotation_id'];
        $branch_name = $_GET['branch_name'];
        $response = $this->QuotationForEnquiry_model->sendTo_WO($quotation_id,$branch_name);
        return $this->response($response);
    }

    //------------this fun is send quotation to PO-------------------------------------//
    //------------this fun is used to insert new quotation for revised quotation-------------------------------------//
    public function getEnquiry_DetailsFor_MultipleQuotation_post() {
        $data = $_POST;
        $response = $this->QuotationForEnquiry_model->getEnquiry_DetailsFor_MultipleQuotation($data);
        return $this->response($response);
    }
    //------------this fun is used to insert new quotation for revised quotation-------------------------------------//

     //------------this fun is send quotation to customer by mail-------------------------------------//
    public function sendMail_get() {
        extract($_GET);
        $data=$_GET;        
        $response = $this->QuotationForEnquiry_model->contact_admin($data);
        return $this->response($response);
    }
    //------------this fun is send quotation to customer by mail-------------------------------------//

    public function getcustomerDetails_get() {
        $result = $this->QuotationForEnquiry_model->getcustomerDetails();
        return $this->response($result);
    }
    //--------this fun is used to show all customer details--------------------------------//

    //--------this fun is used to get all enquiry details for sorting--------------------------------//
    public function GetEnquiriesForSorting_get(){
        $result = $this->QuotationForEnquiry_model->GetEnquiriesForSorting();
        return $this->response($result);
    }
    //--------this fun is used to get all enquiry details for sorting--------------------------------//

     //------------this fun deletes quoatation-------------------------------------//
    public function delete_quote_get() {
        extract($_GET);
        $response = $this->QuotationForEnquiry_model->delete_quote($quotation_id);
        return $this->response($response);
    }
    //--------this fun is used to delete quotation--------------------------------//
    public function Get_quotationDetails_get(){
        extract($_GET);
        $club_id = $_GET['club_id'];
        $response = $this->QuotationForEnquiry_model->Get_quotationDetails($club_id);
        return $this->response($response);
    }
    //-----------this fun is used to get quotations details---------------------------------------//
    //------------this fun is used to get the quotations details----------------------------------//
    
    public function getQuotationInfo_get(){
        extract($_GET);
        $quotation_id = $_GET['quotation_id'];
        $response = $this->QuotationForEnquiry_model->getQuotationInfo($quotation_id);
        return $this->response($response);
    }
}
