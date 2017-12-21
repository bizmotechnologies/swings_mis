<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);

//Sealwings Work Order
class Work_order extends CI_Controller
{
	public function __construct(){
		parent::__construct();	

	}

	public function index($item_link=''){
		
		$wo_id=$item_link;
		$path=base_url();
		$url = $path.'api/Wo_get_all_infoapi/print_WO?wo_id='.$wo_id; 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
          //print_r($response_json);die();
          //print_r($response['status_message']);

		if ($response['status']==0) {

		} else {
			$data['print_data']=$response['status_message'];
			$this->load->view('sales/print_wo',$data);
		}
		
	}
	

}
?>