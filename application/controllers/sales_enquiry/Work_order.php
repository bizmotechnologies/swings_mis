<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//Sealwings Work Order
class Work_order extends CI_Controller
{
	public function __construct(){
		parent::__construct();	

	}

	public function index($item_link=''){
		
echo ($item_link);
		// $path=base_url();
		// $url = $path.'api/item_info/getItemsDetails?item_id='.$item_id;		
		// $ch = curl_init($url);
		// $ch = curl_init($url);
		// curl_setopt($ch, CURLOPT_HTTPGET, true);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $response_json = curl_exec($ch);
		// curl_close($ch);
		// $response=json_decode($response_json, true);		
		
		// if($response['status']==0){
		// 	$data['item_fail']= '<div class="alert alert-danger w3-margin">
		// 	<strong>'.$response['status_message'].'</strong> 
		// 	</div>';	

		// 	$this->load->view('includes/header.php');
		// 	//$this->load->view('pages/guest_subheader.php');
		// 	$this->load->view('pages/item.php',$data);
		// 	$this->load->view('includes/footer.php',$data);
			
		// }
		// else{	
		// 	$visitor_IP=$_SERVER['REMOTE_ADDR'];

		// 	$data['specificItem']=$response['items'];
		// 	$user_id=$response['items'][0]['user_id'];
		// 	$cat_name=$response['items'][0]['cat_name'];
			
			
		// 	$user_details=$this->user_details->getAccount_details_id($user_id);	//get user-details by userID
		// 	$data['user_details']=$user_details;

			
		// 	$data['allItems']=json_decode($this->search_result->getAllItem_byUID($user_id),TRUE);//get user's items by uid
		// 	$data['mayInterested_items']=$this->search_result->getAllItem_byCategory($cat_name);//get item specific categories

		// 	$data['ItemViews'] = $this->item_model->Item_views(json_decode($item_id,TRUE),$visitor_IP);	//get item total unique views

		// 	$this->load->view('includes/header.php');
		// 	//$this->load->view('pages/guest_subheader.php');
		// 	$this->load->view('pages/item.php',$data);
		// 	$this->load->view('includes/footer.php',$data);
			
		// }
		
	}
	

	

	
}
?>