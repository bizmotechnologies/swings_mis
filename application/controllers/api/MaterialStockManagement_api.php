<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class MaterialStockManagement_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/MaterialStockManagement_model');
	}

	
	// -----------------------GET ALL MATERIAL DETAILS API----------------------//
	//-------------------------------------------------------------//
	public function GetMaterialDetails_get(){
		$result = $this->MaterialStockManagement_model->GetMaterialDetails();
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

//---------------------API FOR SAVE FUNCTIONALITY API----------------------------//

    public function Save_RawStockMaterial_Info_post(){
		$data = $_POST;
		$response = $this->MaterialStockManagement_model->Save_RawStockMaterial_Info($data);
		return $this->response($response);			
	}

//---------------------API FOR SAVE FUNCTIONALITY API----------------------------//

// -----------------------GET ALL RAW MATERIAL DETAILS API----------------------//
	public function GetRawMaterialInfoDetails_get(){
		$result = $this->MaterialStockManagement_model->GetRawMaterialInfoDetails();
		return $this->response($result);			
	}
	//---------------------GET ALL RAW MATERIALS END------------------------------//

	//---------------------DELETE RAW MATERIALS ------------------------------//

	public function DeleteRawMaterialStockDetails_get(){
		$data = $_GET;
		$response= $this->MaterialStockManagement_model->DeleteRawMaterialStockDetails( $data );
		return $this->response($response);
	}
	//---------------------DELETE RAW MATERIALS ----------------------------------------------//

	//---------------------Update RAW MATERIALS ----------------------------------------------//

	public function Update_UpdatedRawStockMaterial_Info_post(){

		$data = $_POST;
		$result = $this->MaterialStockManagement_model->Update_UpdatedRawStockMaterial_Info($data);
		return $this->response($result);
	}
	//---------------------Update RAW MATERIALS ----------------------------------------------//


}