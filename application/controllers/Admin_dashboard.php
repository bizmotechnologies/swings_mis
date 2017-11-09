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
		// $this->load->model('admin_settings');
		// $data['all_category']=$this->admin_settings->getAllCategory();//get all category to seacrh items

		// $this->load->model('search_result');
		// $data['all_recentItems']=$this->search_result->getAllitems_reverse();//get all recent items

		// $this->load->model('item_model');
		// $data['topCategories']=$this->item_model->getTopCategory();//get TOP Popular Categories
		// $data['popularItems']=$this->item_model->popularItems();//get 10 popular items
		
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
		// //if status returned is 0 then signin failed, if 1 then redirect to account page
 	// 	if($response['status']==0){
 	// 		$data['account_registered']=$response['status_message'];
 	// 		$this->load->model('item_model');
		// 	$data['topCategories']=$this->item_model->getTopCategory();//get TOP Popular Categories

 	// 		$this->load->view('includes/header.php');
 	// 		//$this->load->view('pages/guest_subheader.php');
 	// 		$this->load->view('pages/member_signup.php',$data);
 	// 		$this->load->view('includes/footer.php',$data);			

 	// 	}
 	// 	else{
 	// 		$session_data= array(
 	// 			'email_id'  => $response['email_id'],
 	// 			'is_logged' => $response['is_logged'],
 	// 			'unique_id'=>$response['unique_id'],
 	// 			'user_name'=>$response['user_name']
 	// 		);

		// 	//start session of user if login success
 	// 		$this->session->set_userdata($session_data);
		// 	$unique_id=$session_data['unique_id'];	//get unique_id of user
		// 	$username=$session_data['user_name'];	//get unique_id of user

		// 	//if unique_id is created then user has inserted his all details
		// 	//and if not created, then redirect user to edit-details page
		// 	if($unique_id=='' || $username==''){									
		// 		redirect('edit_account');
		// 	}
		// 	else{				
		// 		redirect('user_home');
		// 	}

		// }
		// //if-else stmt end
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