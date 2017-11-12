<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageVendor_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/VendorManagement_model');
	}

	
	// -----------------------ADD CUSTOMER API----------------------//
	//-------------------------------------------------------------//
	public function save_CustomerDetails_post(){
		$data = $_POST;
		$result = $this->AddCustomer_model->save_CustomerDetails($data);
		return $this->response($result);			
	}
	//---------------------ADD CUSTOMER END------------------------------//

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