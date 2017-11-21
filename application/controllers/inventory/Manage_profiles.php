<?php
class Manage_profiles extends CI_controller{

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

   $this->load->model('inventory_model/ManageProfile_model');	
   $this->load->view('includes/navigation');
   $this->load->view('inventory/profile/manage_profile');

 }

}