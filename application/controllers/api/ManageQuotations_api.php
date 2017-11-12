<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageQuotations_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('sales_model/Enquiry_model');
	}

	
	// -----------------------GET CUSTOMER'S QUOTATIONS API----------------------//
	//-------------------------------------------------------------//
	public function getCustomer_quotations_get(){
		$customer_id = $_GET['cust_id'];
		$result = $this->Enquiry_model->getQuotations($customer_id);
		return $this->response($result);			
	}
	//---------------------GET CUSTOMER'S QUOTATIONS END------------------------------//

	// -----------------------GET ALL LIVE QUOTATIONS API----------------------//
	//-------------------------------------------------------------//
	public function all_liveQuotations_get(){
		$result = $this->Enquiry_model->getlive_Quotations();
		return $this->response($result);			
	}
	//---------------------GET ALL LIVE QUOTATIONS END------------------------------//

	
	// -----------------------GET QUOTATIONS DETAILS API----------------------//
	//-------------------------------------------------------------//
	public function quotationDetails_get(){
		$sub_quotationID = $_GET['sub_quotationID'];
		$result = $this->Enquiry_model->getQuotation_details($sub_quotationID);
		return $this->response($result);			
	}
	//---------------------GET QUOTATIONS DETAILS END------------------------------//

// -----------------------DELETE CUSTOMER API----------------------//
	//-------------------------------------------------------------//
	public function DeleteCustomerDetails_get(){
		$data = $_GET;
		$response= $this->ManageCustomer_model->DeleteCustomerDetails( $data );
		return $this->response($response);			
	}
	//---------------------DELETE CUSTOMER END------------------------------//

}