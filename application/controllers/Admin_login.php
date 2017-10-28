<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_login extends CI_Controller
{
	public function __construct(){
		parent::__construct();	
		
		date_default_timezone_set('Asia/Kuwait');
		
	}

	public function index(){
				
		$this->load->view('pages/admin_login.php');
	}

	//function to activate package details-------------------
	public function auth_admin(){

		$data=($_POST);
		
		$this->load->model('login_model');
		$response=$this->login_model->admin_auth($data);

		if($response['status']==0){
			echo '<div class="alert w3-red ">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				window.location.reload();
			}, 1000);
			</script>
			';	
			
		}
		else{
			echo '<div class="alert w3-green">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				window.location.href="'.base_url().'admin/admin_dash";
			}, 1000);
			</script>
			';				
			
		}	
	}

		
}
?>