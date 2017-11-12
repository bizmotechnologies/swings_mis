<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageMaterial_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/ManageMaterial_model');
	}

	
	// ----------------------- SAVE MATERIAL API----------------------//
	//-------------------------------------------------------------//
	public function saveMaterial_post(){
		$data = $_POST;
		$response = $this->ManageMaterial_model->saveMaterial( $data );
		return $this->response($response);			
	}
	//---------------------SAVE MATERIAL API END------------------------------//

	// -----------------------GET ALL MATERIAL INFO API-----------------------------//
	//------------------------------------------------------------------------//
	public function getrecord_get(){
		$result = $this->ManageMaterial_model->getrecord();
		return $this->response($result);			
	}
	//---------------------GET ALL MATERIAL INFO END------------------------------//

	// -----------------------EDIT MATERIAL RECORD API----------------------//
	//-------------------------------------------------------------//
	public function updateRecord_post(){
		$data = $_POST;
        $new= $this->ManageMaterial_model->updateRecord( $data );
		return $this->response($new);			
	}
	//---------------------EDIT MATERIAL END------------------------------//

	// -----------------------DELETE MATERIAL API----------------------//
	//-------------------------------------------------------------//
	public function deleteRecord_get(){
		$data = $_GET;
		$response= $this->ManageMaterial_model->deleteRecord( $data );
		return $this->response($response);			
	}
	//---------------------DELETE MATERIAL END------------------------------//


}