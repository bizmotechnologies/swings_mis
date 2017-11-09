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
	
	public function login_auth(){
		extract($_POST);

		if($login_role=='0'){
			echo '<div class="alert alert-danger">
			<strong>Select Appropriate Role first !!!</strong> 
			</div>			
			';	
			die();
		}
		//Connection establishment, processing of data and response from REST API		
		$data=array(
 			'user_name' =>$login_user,
 			'user_password' => $login_password,
 			'user_role'	=> $login_role
 		);
 		
		$path=base_url();
		$url = $path.'api/auth_api/login';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		
		//API processing end
		if($response['status']==0){
			echo '<div class="alert alert-danger ">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				//window.location.reload();
			}, 1000);
			</script>
			';	
			
		}
		else{
			echo '<div class="alert alert-success">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				//window.location.href="'.base_url().'admin/admin_dash";
			}, 1000);
			</script>
			';				
			
		}	
		
	}

	// ---------------function to show all role------------------------//
	public function show_roles(){
		
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/manageRoles_api/all_role';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;		
		
	}
// ---------------------function ends----------------------------------//
	
}
?>