<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings admin manage users
class Manage_users extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		// $this->load->model('DbSetup_model')	;
		// $this->DbSetup_model->createDbSchema();	
	}

	public function index(){
		
		$data['all_features']=Manage_users::show_feature();
		$data['all_roles']=Manage_users::show_roles();
		$data['all_users']=Manage_users::show_users();	//---------get all users

		$this->load->view('includes/navigation.php');
		$this->load->view('admin/manage_users.php',$data);		
	}
	
	// ---------------function to add new user------------------------//
	public function add_user(){
		extract($_POST);

		//---------------if any of the role is not selected, then return this--------//
		if($user_role=='0'){
			echo '<div class="alert alert-danger">
			<strong>Select Appropriate Role first !!!</strong> 
			</div>			
			';	
			die();
		}
		
		//Connection establishment, processing of data and response from REST API
		$data=$_POST;
		$path=base_url();
		$url = $path.'api/user_api/add_user';	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		
		//API processing end
		if($response['status']==0){
			echo '<div class="alert alert-danger">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
				location.reload();
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
				location.reload();
			}, 1000);
			</script>			
			';				
		}	
		
	}
// ---------------------function ends----------------------------------//
	

	// ---------------function to show all feature------------------------//
	public function show_feature(){
		
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/settings_api/all_feature';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;		
		
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

	// ---------------function to show all users------------------------//
	public function show_users(){
		
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/user_api/all_user';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;	

	}
// ---------------------function ends----------------------------------//


	// ---------------function to edit user------------------------//
	public function edit_user(){
		
		extract($_POST);		
		$data=$_POST;

		//Connection establishment, processing of data and response from REST API
		
		$path=base_url();
		$url = $path.'api/user_api/edit_user';	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);		
				
		redirect('admin/manage_users');	
	}
// ---------------------function ends----------------------------------//


	// ---------------function to delete users------------------------//
	public function del_user(){
		extract($_POST);

		//Connection establishment to get data from REST API
		$path=base_url();
		$url = $path.'api/user_api/del_user?user_id='.$user_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//api processing ends

		//API processing end
		if($response['status']==0){
			echo '<div class="alert alert-danger">
			<strong>'.$response['status_message'].'</strong> 
			</div>
			<script>
			window.setTimeout(function() {
				$(".alert").fadeTo(500, 0).slideUp(500, function(){
					$(this).remove(); 
				});
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
			}, 1000);
			</script>			
			';				
			
		}	
		
	}
// ---------------------function ends----------------------------------//
	
}
?>