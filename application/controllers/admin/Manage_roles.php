<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings admin manage roles
class Manage_roles extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
		$data['all_features']=Manage_roles::show_feature();
		$data['all_roles']=Manage_roles::show_roles();

		$this->load->view('includes/navigation.php');
		$this->load->view('admin/manage_roles.php',$data);
		
	}
	
	// ---------------function to add new role------------------------//
	public function add_role(){

		//Connection establishment, processing of data and response from REST API
		$data=$_POST;	
		$path=base_url();
		$url = $path.'api/manageRoles_api/add_role';	
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


	
	// ---------------function to delete role------------------------//
	public function del_role(){
		extract($_POST);

		//Connection establishment to get data from REST API
		$path=base_url();
		$url = $path.'api/manageRoles_api/del_role?role_id='.$role_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//api processing ends

		if($response['status']==0){
			echo '<div class="alert alert-danger">
			<strong>'.$response['status_message'].'</strong> 
			</div>						
			';	
			
		}
		else{
			echo '<div class="alert alert-warning">
			<strong>'.$response['status_message'].'</strong> 
			</div>						
			';				
			
		}	
		
	}
// ---------------------function ends----------------------------------//
	
}
?>