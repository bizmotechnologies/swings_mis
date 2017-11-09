<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings admin general settings 
class General_settings extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		
	}

	public function index(){
		
		$data['all_features']=General_settings::show_feature();		//-------show all features
		$data['all_roles']=General_settings::show_roles();		//-------show all roles

		$this->load->view('includes/navigation.php');	//--------header and side menu
		$this->load->view('admin/general_settings.php',$data);		
	}
	
	// ---------------function to add new feature------------------------//
	public function add_feature(){
		extract($_POST);
		$roles_arr=array();
		foreach ($feature_roles as $key) {
			$roles_arr[]=$key;	//---------create array of roles to store in feature table
		}
		$data=array(
			'feature_title' => $feature_title, 
			'feature_description' => $feature_description, 
			'role_features' => json_encode($roles_arr), 	//-------json format as ['role-1','role-2',...]
		);

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/settings_api/add_feature';	
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


	// ---------------function to edit feature------------------------//
	public function edit_feature(){		
		extract($_POST);		
		$data=$_POST;
		$data['editfeature_roles']=json_encode($editfeature_roles);

		//Connection establishment, processing of data and response from REST API		
		$path=base_url();
		$url = $path.'api/settings_api/edit_feature';	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);		
		
		//API processing end
		if($response['status']==0){
			$data['updateFeature_set']='<div class="alert alert-danger">
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
			$data['updateFeature_set']='<div class="alert alert-success">
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
		redirect('admin/general_settings');	
	}
// ---------------------function ends----------------------------------//


	// ---------------function to delete feature------------------------//
	public function del_feature(){
		extract($_POST);

		//Connection establishment to get data from REST API
		$path=base_url();
		$url = $path.'api/settings_api/del_feature?feature_id='.$feature_id;		
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