<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
class ManageRoles_api extends REST_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin_model/manageRole_model');
		date_default_timezone_set('Asia/Kolkata');	//set Kuwait's timezone
	}

	
	// -----------------------ADD ROLE API----------------------//
	//-------------------------------------------------------------//
	public function add_role_post(){
		$data = $_POST;
		$result = $this->manageRole_model->add_role($data);
		return $this->response($result);			
	}
	//---------------------ADD ROLE END------------------------------//

	// -----------------------GET ALL ROLE API----------------------//
	//-------------------------------------------------------------//
	public function all_role_get(){
		$result = $this->manageRole_model->getAll_role();
		return $this->response($result);			
	}
	//---------------------GET ALL ROLE END------------------------------//

	// -----------------------GET ALL BRANCHES API----------------------//
	//-------------------------------------------------------------//
	public function all_branches_get(){
		$result = $this->manageRole_model->getAll_branches();
		return $this->response($result);			
	}
	//---------------------GET ALL BRANCHES END------------------------------//

	
	// -----------------------DELETE ROLE API----------------------//
	//-------------------------------------------------------------//
	public function del_role_get(){
		$data = $_GET;
		$result = $this->manageRole_model->del_role($data);
		return $this->response($result);			
	}
	//---------------------DELETE ROLE END------------------------------//


}