<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageMaterial_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('inventory_model/ManageMaterial_model');
	}

	
	// -----------------------ADD FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function saveMaterial_post(){
		$data = $_POST;
		$response = $this->ManageMaterial_model->saveMaterial( $data );
		return $this->response($response);			
	}
	//---------------------ADD FEATURE END------------------------------//

	// -----------------------GET ALL FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function getrecord_get(){
		$result = $this->ManageMaterial_model->getrecord();
		return $this->response($result);			
	}
	//---------------------GET ALL FEATURE END------------------------------//

	// -----------------------EDIT FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function updateRecord_post(){
		$data = $_POST;
        $new= $this->ManageMaterial_model->updateRecord( $data );
		return $this->response($new);			
	}
	//---------------------EDIT FEATURE END------------------------------//

	// -----------------------DELETE FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function deleteRecord_get(){
		$data = $_GET;
		$response= $this->ManageMaterial_model->deleteRecord( $data );
		return $this->response($response);			
	}
	//---------------------DELETE FEATURE END------------------------------//


}