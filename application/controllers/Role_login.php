<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//Swings Login
class Role_login extends CI_Controller
{
	public function __construct(){
		parent::__construct();	

		//---------uncomment this to load db automatically---------------//
		// $this->load->model('DbSetup_model')	;
		// $this->DbSetup_model->createDbSchema();		
	}

	public function index(){
		
		$data['all_roles']=Role_login::show_roles();	//---get all roles
		$this->load->view('pages/index.php',$data);
		
	}
	
	public function login_auth(){
		extract($_POST);

		//---------------if any of the role is not selected, then return this--------//
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
			//----create session array--------//
			$session_data= array(
 				'user_id'  => $response['user_id'],
 				'user_name' => $response['user_name'],
 				'privilege'=>$response['privilege'],
 				'role'=>$response['role']
 			);

			//start session of user if login success
 			$this->session->set_userdata($session_data);

			echo '<div class="alert alert-success">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				window.location.href="'.base_url().'admin/admin_dashboard";
			}, 1000);
			</script>
			';						
		}	
		
	}

	// ---------------function to logout all role------------------------//
	public function logout(){
		
		//if logout success then destroy session and unset session variables
		$this->session->unset_userdata(array("user_id"=>"","user_name"=>"","privilege"=>"","role"=>""));
		$this->session->sess_destroy();
		redirect('role_login')	;
		
	}
// ---------------------function ends----------------------------------//

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