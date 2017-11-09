<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class Auth_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model/login_model');
		date_default_timezone_set('Asia/Kolkata');	//set Kuwait's timezone
	}

	
	// -----------------------USER LOGIN API----------------------//
	//-------------------------------------------------------------//
	public function login_post(){
		$data=($_POST);

		$result = $this->login_model->login($data);
		return $this->response($result);			
	}
	//---------------------USER LOGIN END------------------------------//

}