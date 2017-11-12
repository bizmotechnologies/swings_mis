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

	// -----------------------GET ALL ROLE API----------------------//
	//-------------------------------------------------------------//
	public function getCustomerDetails_get(){
		$result = $this->ManageCustomer_model->getCustomerDetails();
		return $this->response($result);			
	}
	//---------------------GET ALL ROLE END------------------------------//

	
	// -----------------------DELETE ROLE API----------------------//
	//-------------------------------------------------------------//
	public function Update_CustomerDetails_post(){
		$data = $_POST;
		$result = $this->ManageCustomer_model->Update_CustomerDetails($data);
		return $this->response($result);			
	}
	//---------------------DELETE ROLE END------------------------------//

// -----------------------DELETE CUSTOMER API----------------------//
	//-------------------------------------------------------------//
	public function DeleteCustomerDetails_get(){
		$data = $_GET;
		$response= $this->ManageCustomer_model->DeleteCustomerDetails( $data );
		return $this->response($response);			
	}
	//---------------------DELETE CUSTOMER END------------------------------//

}