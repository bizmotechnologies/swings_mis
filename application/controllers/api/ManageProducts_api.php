<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageProducts_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/ManageProducts_model');
		$this->load->model('sales_model/Enquiry_model');
		date_default_timezone_set('Asia/Kolkata');	//set Kuwait's timezone
	}


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

	// -----------------------GET PRODUCT QUOTATION API----------------------//
	//-------------------------------------------------------------//
	public function productQuotation_get(){
		$product_id=$_GET['product_id'];
		$cut_value=$_GET['cut_value'];
		$result = $this->Enquiry_model->getProduct_Quotation($product_id,$cut_value);
		return $this->response($result);			
	}
	//---------------------GET PRODUCT QUOTATION END------------------------------//


}