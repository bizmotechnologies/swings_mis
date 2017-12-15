<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_workorder extends CI_Controller
  {
    public function index()
 	 {
    	   $this->load->database();
    	   $this->load->model('sales_model/manage_workorder_model');
    	   $data['wo_info']=$this->manage_workorder_model->get_all_woinfo();
    	   $this->load->view('includes/navigation.php');
		     $this->load->view('sales/manage_workorder.php',$data);
   	} 
	
    public function get_all_woinfo() 
    {
         $path=base_url();
         $url = $path.'api/Wo_get_all_infoapi/get_all_woinfo';   
         // $url = $path.'api/Wo_get_all_infoapi/get_all_wo_id?wo_id='.$wo_id;	   
         $ch = curl_init($url);
         curl_setopt($ch, CURLOPT_HTTPGET, true);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         $response_json = curl_exec($ch);
         curl_close($ch);
         $response=json_decode($response_json, true);
         return $response;
    }


    public function show_WO_id_info()
    {
          extract($_POST);
          //print_r($_POST);
          $path=base_url();
          $url = $path.'api/Wo_get_all_infoapi/show_WO_id_info?wo_id='.$wo_id; 
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_HTTPGET, true);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response_json = curl_exec($ch);
          curl_close($ch);
          $response=json_decode($response_json, true);
          print_r($response['status_message']);

  }
    
}
?>