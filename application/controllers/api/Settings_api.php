<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class Settings_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('settings_model');
		date_default_timezone_set('Asia/Kolkata');	//set Kuwait's timezone
	}

	
	// -----------------------ADD FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function add_feature_post(){
		$data = $_POST;
		$result = $this->settings_model->add_feature($data);
		return $this->response($result);			
	}
	//---------------------ADD FEATURE END------------------------------//

	// -----------------------GET ALL FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function all_feature_get(){
		$result = $this->settings_model->getAll_feature();
		return $this->response($result);			
	}
	//---------------------GET ALL FEATURE END------------------------------//

	// -----------------------EDIT FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function edit_feature_post(){
		$data = $_POST;
		$result = $this->settings_model->edit_feature($data);
		return $this->response($result);			
	}
	//---------------------EDIT FEATURE END------------------------------//

	// -----------------------DELETE FEATURE API----------------------//
	//-------------------------------------------------------------//
	public function del_feature_get(){
		$data = $_GET;
		$result = $this->settings_model->del_feature($data);
		return $this->response($result);			
	}
	//---------------------DELETE FEATURE END------------------------------//


}