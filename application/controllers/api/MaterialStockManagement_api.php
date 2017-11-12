<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class MaterialStockManagement_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/MaterialStockManagement_model');
	}

	
	// -----------------------ADD CUSTOMER API----------------------//
	//-------------------------------------------------------------//
	public function save_CustomerDetails_post(){
		$data = $_POST;
		$result = $this->MaterialStockManagement_model->save_CustomerDetails($data);
		return $this->response($result);			
	}
	//---------------------ADD CUSTOMER END------------------------------//

	// -----------------------GET ALL MATERIAL DETAILS API----------------------//
	//-------------------------------------------------------------//
	public function GetMaterialDetails_get(){
		$result = $this->MaterialStockManagement_model->getCustomerDetails();
		return $this->response($result);			
	}
	//---------------------GET ALL MATERIALS END------------------------------//

//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/

    public function GetVendorsDetails_get(){
		$result = $this->MaterialStockManagement_model->GetVendorsDetails();
		return $this->response($result);
	}
//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/


//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/

    public function Get_Purchase_Stock_get(){
		$result = $this->MaterialStockManagement_model->Get_Purchase_Stock();
		return $this->response($result);
	}
//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/
	

	// -----------------------UPDATE DETAILS FOR CUSTOMER API----------------------//
	//-----------------------------	--------------------------------//
	public function Update_CustomerDetails_post(){
		$data = $_POST;
		$result = $this->MaterialStockManagement_model->Update_CustomerDetails($data);
		return $this->response($result);			
	}
	//---------------------UPDATE CUSTOMER DETAILS END------------------------------//

// -----------------------DELETE CUSTOMER API----------------------//
	//-------------------------------------------------------------//
	public function DeleteCustomerDetails_get(){
		$data = $_GET;
		$response= $this->ManageCustomer_model->DeleteCustomerDetails( $data );
		return $this->response($response);			
	}
	//---------------------DELETE CUSTOMER END------------------------------//

}