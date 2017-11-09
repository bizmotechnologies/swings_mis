<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageProducts_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('ManageProducts_model');
		date_default_timezone_set('Asia/Kolkata');	//set Kuwait's timezone
	}

	
	// -----------------------ADD FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function add_feature_post(){
		$data = $_POST;
		$result = $this->ManageProducts_model->add_feature($data);
		return $this->response($result);			
	}
	//---------------------ADD FEATURE END------------------------------//

	// -----------------------GET ALL PRODUCTS API----------------------//
	//-------------------------------------------------------------//
	public function all_product_get(){

		$result = $this->ManageProducts_model->getAll_product();
		return $this->response($result);			
	}
	//---------------------GET ALL PRODUCTS END------------------------------//

	// -----------------------GET PARTICULAR PRODUCTS API----------------------//
	//-------------------------------------------------------------//
	public function productDetails_get(){
		$product_id=$_GET['product_id'];
		$result = $this->ManageProducts_model->getProduct_details($product_id);
		return $this->response($result);			
	}
	//---------------------GET PARTICULAR PRODUCTS END------------------------------//

	// -----------------------EDIT FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function edit_feature_post(){
		$data = $_POST;
		$result = $this->ManageProducts_model->edit_feature($data);
		return $this->response($result);			
	}
	//---------------------EDIT FEATURE END------------------------------//

	// -----------------------DELETE FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function del_feature_get(){
		$data = $_GET;
		$result = $this->ManageProducts_model->del_feature($data);
		return $this->response($result);			
	}
	//---------------------DELETE FEATURE END------------------------------//


}