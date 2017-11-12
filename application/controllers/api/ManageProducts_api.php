<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageProducts_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/ManageProducts_model');
		$this->load->model('sales_model/Enquiry_model');
		$this->load->model('inventory_model/ManageProduct_model');

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

	// -----------------------GET PRODUCT COST API----------------------//
	//-------------------------------------------------------------//
	public function productCosting_get(){
		$product_id=$_GET['product_id'];
		$cut_value=$_GET['cut_value'];
		$result = $this->Enquiry_model->getProduct_Costing($product_id,$cut_value);
		return $this->response($result);			
	}
	//---------------------GET PRODUCT COST END------------------------------//

	// -----------------------ADD PRODUCT IN QUOTATION API----------------------//
	//-------------------------------------------------------------//
	public function add_ToQuotation_post(){
		$data=$_POST;		
//print_r($data);die();
		$result = $this->Enquiry_model->add_ToQuotation($data);
		return $this->response($result);			
	}
	//---------------------ADD PRODUCT IN QUOTATION END------------------------------//

// -----------------------ADD PRODUCT IN QUOTATION API----------------------//
	//-------------------------------------------------------------//
	public function save_Products_post(){
		$data=$_POST;		
		$response = $this->ManageProduct_model->save_Products($data);
		return $this->response($response);			
	}
	//---------------------ADD PRODUCT IN QUOTATION END------------------------------//

	// -----------------------GET ALL MATERIAL INFORMATION API----------------------//
	//-------------------------------------------------------------//
	public function showmaterialInfo_get(){
		$SelectNew_Material_id_1 = $_GET['SelectNew_Material_id_1'];
		$response = $this->ManageProduct_model->showmaterialInfo($SelectNew_Material_id_1);
		return $this->response($response);			
	}
	//---------------------GET ALL MATERIAL INFO  END------------------------------//


// -----------------------GET PRODUCT RECORDS API----------------------//
	//-------------------------------------------------------------//
	public function getProduct_Records_get(){
		$response = $this->ManageProduct_model->getProduct_Records();
		return $this->response($response);			
	}
	//---------------------GET PRODUCT RECORDS END------------------------------//

// -----------------------GET DELETE PRODUCT RECORD API----------------------//
	//-------------------------------------------------------------//
	public function DeleteRecord_get(){
		$data = $_GET;
		$response = $this->ManageProduct_model->DeleteRecord($data);     
		return $this->response($response);			
	}
	//---------------------GET PRODUCT RECORDS END------------------------------//
// -----------------------GET UPDATE PRODUCT RECORD API----------------------//
	//-------------------------------------------------------------//
	public function UpdateProductRecord_post(){
		$data = $_POST;
		$response = $this->ManageProduct_model->UpdateProductRecord($data);     
		return $this->response($response);			
	}
	//---------------------GET PRODUCT UPDATE RECORDS END------------------------------//

}