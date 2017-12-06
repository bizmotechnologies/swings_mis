<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageProfile_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/ManageProfile_model');
		$this->load->model('sales_model/Enquiry_model');

	}


	// -----------------------GET ALL PROFILES API----------------------//
	//-------------------------------------------------------------//
	public function all_profile_get(){

		$result = $this->ManageProfile_model->getAll_profile();
		return $this->response($result);			
	}
	//---------------------GET ALL PROFILES END------------------------------//

	// -----------------------GET PARTICULAR PRODUCTS API----------------------//
	//-------------------------------------------------------------//
	public function profileDetails_get(){
		$profile_id=$_GET['profile_id'];
		$result = $this->ManageProfile_model->getProfile_details($profile_id);
		return $this->response($result);			
	}
	//---------------------GET PARTICULAR PRODUCTS END------------------------------//	


// -----------------------ADD PRODUCT IN QUOTATION API----------------------//
	//-------------------------------------------------------------//
	public function save_Profile_post(){
		$data=$_POST;		
		$response = $this->ManageProfile_model->save_Profile($data);
		return $this->response($response);			
	}
	//---------------------ADD PRODUCT IN QUOTATION END------------------------------//


// -----------------------GET DELETE PRODUCT RECORD API----------------------//
	//-------------------------------------------------------------//
	public function DeleteRecord_get(){
		$data = $_GET;
		$response = $this->ManageProfile_model->DeleteRecord($data);     
		return $this->response($response);			
	}
	//---------------------GET PRODUCT RECORDS END------------------------------//
// -----------------------GET UPDATE PRODUCT RECORD API----------------------//
	//-------------------------------------------------------------//
	public function UpdateProfileRecord_post(){
		$data = $_POST;
		$response = $this->ManageProfile_model->UpdateProfileRecord($data);     
		return $this->response($response);			
	}
	//---------------------GET PRODUCT UPDATE RECORDS END------------------------------//
        public function DeleteProfile_get(){
           $profile_id=$_GET['profile_id'];
           $response = $this->ManageProfile_model->DeleteProfile($profile_id);     
	   return $this->response($response);
        }
}