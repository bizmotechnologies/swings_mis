<?php
error_reporting(E_ERROR | E_PARSE);

class AllProfiles extends CI_controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('inventory_model/ManageProfile_model');

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
   $data['all_profiles'] = AllProfiles::getAll_Profile();     //-------show all Raw materials
   $this->load->model('inventory_model/ManageProfile_model');	
   $this->load->view('includes/navigation');
   $this->load->view('inventory/profile/all_profiles',$data);

 }

 //----------this function to get material details-----------------------------
 public function getAll_Profile() {

  $path = base_url();
  $url = $path . 'api/ManageProfile_api/all_profile';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  return $response;
}

//----------------this fun get material details end---------------//



}