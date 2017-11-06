<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class Auth_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
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

	// -----------------------GET ALL USER API----------------------//
	//-------------------------------------------------------------//
	public function all_user_get(){
		$result = $this->login_model->getAll_users();
		return $this->response($result);			
	}
	//---------------------GET ALL USER END------------------------------//

	// -----------------------EDIT USER API----------------------//
	//-------------------------------------------------------------//
	public function edit_user_post(){
		$data = $_POST;
		$result = $this->login_model->edit_user($data);
		return $this->response($result);			
	}
	//---------------------EDIT USER END------------------------------//

	// -----------------------DELETE USER API----------------------//
	//-------------------------------------------------------------//
	public function del_user_get(){
		$data = $_GET;
		$result = $this->login_model->del_user($data);
		return $this->response($result);			
	}
	//---------------------DELETE USER END------------------------------//


}