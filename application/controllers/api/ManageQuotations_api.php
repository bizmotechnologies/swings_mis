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
//------------this fun is used to get sort enquiry by the date,customer and status-------------------//
    public function sort_Enquiry_get() {
        $From_date = $_GET['From_date'];
        $To_date = $_GET['To_date'];
        $Sort_by = $_GET['Sort_by'];
        $customer_Id = $_GET['customer_Id'];
        $response = $this->QuotationForEnquiry_model->sort_Enquiry($From_date, $To_date, $Sort_by, $customer_Id);
        return $this->response($response);
    }

//------------this fun is used to get sort enquiry by the date,customer and status-------------------//
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
    public function sendTo_PO_get() {
        $quotation_id = $_GET['quotation_id'];
        $response = $this->QuotationForEnquiry_model->sendTo_PO($quotation_id);
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
    public function sendMail_post() {
        extract($_POST);        
        $response = $this->QuotationForEnquiry_model->contact_admin();
        return $this->response($response);
    }
    //------------this fun is send quotation to customer by mail-------------------------------------//
    //--------------this fun is used to get sort quotation details by status-------------------------//
    public function sort_byStatus_get(){
        $From_date = $_GET['From_date'];
        $To_date = $_GET['To_date'];
        $Sort_by = $_GET['Sort_by'];
        $customer_Id = $_GET['customer_Id'];
        $response = $this->QuotationForEnquiry_model->sort_byStatus($From_date, $To_date, $Sort_by, $customer_Id);
        return $this->response($response);
    }
    //--------------this fun is used to get sort quotation details by status-------------------------//

   }
