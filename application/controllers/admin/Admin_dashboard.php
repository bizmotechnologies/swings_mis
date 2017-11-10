<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//Swings admin dashboard
class Admin_dashboard extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		
		//start session		
		$user_id=$this->session->userdata('user_id');
		$user_name=$this->session->userdata('user_name');
		$privilege=$this->session->userdata('privilege');
				
		//check session variable set or not, otherwise logout
		if(($user_id=='') || ($user_name=='') || ($privilege=='')){
			redirect('role_login');
		}
	}

	public function index(){
				
		$this->load->view('includes/navigation.php');
		$this->load->view('admin/admin_dash.php');
		
	}		
	
}
?>