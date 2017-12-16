<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings Manage_quotations
class Manage_quotations extends CI_Controller
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
		
		$data['all_enquiries'] = Manage_quotations::fetchEnquiry_For_Quotation();
		$data['enquiries'] = Manage_quotations::GetEnquiriesForSorting();
		$data['all_customer'] = Manage_quotations::getcustomerDetails();
		$data['all_liveQuotes'] = Manage_quotations::show_quotations();

		$this->load->view('includes/navigation.php');
		$this->load->view('sales/manage_quotations.php',$data);		
		//$this->load->view('sales/demo.php',$data);		
	}


//------------this fun is used to get all customer details------------//

	public function getcustomerDetails() {
		$path = base_url();
		$url = $path . 'api/ManageQuotations_api/getcustomerDetails';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response_json, true);
		return $response;
	}

    // ---------------function to show all products------------------------//
    //------------this fun is used to get all enquiries for sorting------------//
	public function GetEnquiriesForSorting(){
		$path = base_url();
		$url = $path . 'api/ManageQuotations_api/GetEnquiriesForSorting';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response = json_decode($response_json, true);
		return $response;
	}
        //------------this fun is used to get all enquiries for sorting------------//
    //------------this fun is used to get all quotations------------//

	public function show_quotations(){

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/ManageQuotations_api/all_liveQuotations';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;	


	}
// ---------------------function ends----------------------------------//

	// ---------------function to show all live quotations of customer------------------------//
	public function getCustomer_quotations(){
		extract($_POST);

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/manageQuotations_api/getCustomer_quotations?cust_id='.$_POST['customer_name'];		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//API ends here

		if($response['status']==0){
			echo '<div class="alert alert-danger">
			<strong>'.$response['status_message'].'</strong> 
			</div>						
			';	

		}
		else{
			echo '
			<label>Live Quotations:</label>
			<select name="quotation_id" id="quotation_id" class="form-control w3-margin-bottom">
			<option class="w3-red" value="0">Select quotation to revise</option>';

			foreach ($response['status_message'] as $key) {
				echo '<option class="" value="'.$key['quotation_id'].'">Quotation No.#Q'.$key['quotation_id'].'- dated:'.$key['dated'].'</option>';
			}
			echo '</select>';	


		}			

	}
// ---------------------function ends----------------------------------//	

	// ---------------function to add product in quotation------------------------//
	public function generate_quotation(){

		extract($_POST);
		$data=$_POST;
		$product_session=$this->session->userdata('product_session');

		//Connection establishment, processing of data and response from REST API	
		$path=base_url();
		$url="";
		if (isset($revise_quoteBtn)) {
			if (!isset($quotation_id)) {
				//----------------------if no quotation is associated to customer------------//
				echo '
				<h4 class="w3-text-red"><i class="fa  fa-info-circle"></i> ALERT</h4>
				<label class="w3-text-grey w3-label w3-small">
				<strong>There is no any quotation associated to this customer. </strong> 
				</label>';
				die();
			}
			if($quotation_id=='0'){
				//-----------------check quotation selected or not-------------//
				echo '
				<h4 class="w3-text-red"><i class="fa fa-warning"></i> WARNING</h4>
				<label class="w3-text-grey w3-label w3-small">
				<strong>Select appropriate Quotation for the respective customer. </strong> 
				</label>';
				die();
			}
			if($customer_name == 0){
				//-----------------check customer selected or not-------------//
				echo '
				<h4 class="w3-text-red"><i class="fa fa-warning"></i> WARNING</h4>
				<label class="w3-text-grey w3-label w3-small">
				<strong>Select Customer first. </strong> 
				</label>';
				die();
			}
			
			$url = $path.'api/ManageProducts_api/add_revisedQuotation';			
		}
		else{
			$url = $path.'api/ManageProducts_api/add_ToQuotation';
		}

		if($customer_name == 0){
				//-----------------check customer selected or not-------------//
			echo '
			<h4 class="w3-text-red"><i class="fa fa-warning"></i> WARNING</h4>
			<label class="w3-text-grey w3-label w3-small">
			<strong>Select Customer first. </strong> 
			</label>';
			die();
		}
		if ($product_session == '') {
				//----------------------if no quotation is associated to customer------------//
			echo '
			<h4 class="w3-text-red"><i class="fa  fa-info-circle"></i> ALERT</h4>
			<label class="w3-text-grey w3-label w3-small">
			<strong>Click "Add Product" button before raising quotation. </strong> 
			</label>';
			die();
		}

		$data['products']=$product_session;
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
			$sessionClear=Manage_quotations::clearSession();


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
			$sessionClear=Manage_quotations::clearSession();
			

		}	


	}
// ---------------------function ends----------------------------------//	


// --------------------- this fun is used to get all enquiry for quotation----------------------------------//	

	public function fetchEnquiry_For_Quotation(){

		$path=base_url();
		$url = $path.'api/manageQuotations_api/fetchEnquiry_For_Quotation';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return ($response);
	}
    // --------------------- this fun is used to get all enquiry for quotation ends here----------------------------------//	

	// --------------------- this fun is used to send quotation to WO ----------------------------------//	

	public function sendTo_WO(){
		extract($_POST);
		//print_r($_POST);

		$path=base_url();
		$url = $path.'api/manageQuotations_api/sendTo_WO?quotation_id='.$quotation_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//echo($response_json);
		echo($response['status_message']);
	}
        // --------------------- this fun is used to to send quotation to WO ----------------------------------//


	// --------------------- this fun is used to get sort quotation by customer and date ----------------------------------//	

	public function sendMail(){
		extract($_POST);
		$data=$_POST;
		//print_r($_POST);
		
		$path=base_url();
		$url = $path.'api/manageQuotations_api/sendMail?quotation_id='.$quotation_id.'&customer_id='.$customer_id;	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);

		$mail_details=$response['status_message'];
		$customer_mailArr=json_decode($mail_details['customer_mail'],TRUE);

				//print_r($mail_details);die();
		$products_associatedArr= json_decode($mail_details['product_associated'],true);

		$enquiry_no=$mail_details['enquiry_id'];
		$date=date('d M Y', strtotime($mail_details['dated']));
		$time=date('h:m A', strtotime($mail_details['time_at']));

		$product_arr=array();

		$message_body ='
		<!DOCTYPE html>
		<html lang="en-US">
		<head>
		<meta charset="windows-1252">
		<title></title>
		<!-- jQuery CDN -->
		<link rel="stylesheet" href="'.base_url().'css/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="'.base_url().'css/font awesome/font-awesome.min.css">
		<link rel="stylesheet" href="'.base_url().'css/font awesome/font-awesome.css">
		<link rel="stylesheet" href="'.base_url().'css/w3.css">
		<link href="'.base_url().'css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
		<link rel="stylesheet" href="'.base_url().'css/alert/jquery-confirm.css">

		<script type="text/javascript" src="'.base_url().'css/bootstrap/jquery-3.1.1.js"></script>
		<script type="text/javascript" src="'.base_url().'css/bootstrap/bootstrap.min.js"></script>
		<script src="'.base_url().'css/bootstrap/bootstrap-toggle.min.js"></script>
		<script type="text/javascript" src="'.base_url().'css/alert/jquery-confirm.js"></script>
		</head>
		<body>
		<div class="w3-col l6 col-lg-offset-3 w3-small w3-padding w3-card-2" id="view_quoteDiv_'.$mail_details['quotation_id'].'">
		<div class="w3-col l2 w3-margin-bottom">
		<img class="img img-thumbnail" width="100px" height="80px" src="'.base_url().'css/logos/quote_img.png">
		</div>
		<div class="w3-col l8">
		<center><h1><b>SEALWINGS PVT. LTD.</b></h1>
		<span class="w3-tiny"><i>(Quotation for your requested enquiry)</i></span>
		</center>
		</div>
		<div class="w3-col l12 w3-margin-bottom w3-margin-top">
		<div class="w3-left">
		<label class="w3-label w3-text-red"><b>Enquiry No:</b></label> <span class="">#ENQ-0'.$enquiry_no.'</span>
		<input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
		</div>
		<div class="w3-right">
		<label class="w3-label w3-text-red"><b>Issued On:</b></label> <span class="">'.$date.', '.$time.'</span>
		</div>
		</div>
		<div class="w3-col l12">
		<label class="w3-label w3-text-red"><b>Quotation No:</b></label> <span class="">#QUO-0'.$quotation_id.'</span>
		</div>
		<div class="w3-col l12 w3-margin-bottom">
		<label class="w3-label w3-text-red"><b>Customer Name:</b></label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
		<input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

		</div>

		<div class="w3-col l12 w3-margin-bottom">
		<label class="w3-label w3-text-red"><b>Products:</b></label>

		<ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
		foreach ($products_associatedArr as $value) { 
			$message_body .='
			<li>'.strtoupper($value['product_name']).' -';

			if($value['housing_status']==1){ $message_body .= $value['housing_setQuantity'].' SETS'; } else { $message_body .= '1 SET'; }

			$message_body .='
			</li>
			<ol>
			<i>
			<li>'.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

			if($value['housing_status']==1){ $message_body .= '1 NO.'; } else { $message_body .= $value['product_quantity'].' NO.'; }

			$message_body .='@ '.$value['product_price'].' <i class="fa fa-inr"></i> per NO</li>
			</i>
			</ol>
			<br>
			';
		} 
		$message_body .='</ol>              
		</div>
		<div class="w3-col l12 w3-margin-bottom">
		<label class="w3-label w3-text-red"><b>Delivery within:</b> '.$mail_details['delivery_within'].'</label><br>
		<div class="w3-col l12">
		<img class="img img-thumbnail w3-right" width="auto" height="80px" src="'.base_url().'css/logos/quote_mailRegards.jpg">
		</div></div>

		<div class="col-lg-3"></div>
		</body>
		</html>';

		//die();

		foreach ($customer_mailArr as $key) {
			//echo $key;
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'seal-wings.com';
			$config['smtp_port'] = '465'; 
			$config['smtp_crypto'] = 'ssl';
			$config['smtp_user'] = 'test@seal-wings.com';
			$config['smtp_pass'] = 'sealwings@123';
			$config['charset'] = 'utf-8';
			$config['mailtype'] = 'html';
			$config['newline'] = "rn";
			$this->load->library('email',$config); 
			$this->email->from('test@seal-wings.com', 'SealWings Administrator');
			$this->email->to($key,$customer_name);
			$this->email->subject('Quotation No: #QUO-0'.$quotation_id);
			$this->email->message($message_body); 
			if (!$this->email->send()) {
				$response_mail='Quotation could not be sent. <br>Mailing Error!!! ';
			} else {
				$response_mail = 'Quotation Mail has been sent';
			}
		}
		
        //sql query to insert user row and create an account
		echo ($response_mail);
		die();
		
	}
        // --------------------- this fun is used to get sort quotation by customer and date ----------------------------------//



	 // --------------------- this fun is used to show quotation page ----------------------------------//	

	public function raise_quotation(){
		extract($_POST);
		$data=$_POST;		

		$path=base_url();
		$url = $path.'api/manageQuotations_api/save_quotation';			
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//print_r($response_json);die();

		if($response['status']==0){
			echo '<div class="alert alert-danger">
			<strong>#ENQ-0'.$_POST['enquiry_id'].' '.$response['status_message'].'</strong> 
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
			<strong>#ENQ-0'.$_POST['enquiry_id'].' '.$response['status_message'].'</strong> 
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
        // --------------------- this fun is used to show quotation page ----------------------------------//	


    // --------------------- this fun is used to show enquiries by enquiry id ----------------------------------//
	public function Show_Enquiry(){
		extract($_POST);

		if(!isset($enquiry_id)){
			echo '<div class="alert alert-danger w3-col l12">
			<strong>No records found for this Enquiry number. Select Valid Enquiry from the list!!!</strong> 
			</div>			
			';
			die();
		}
		$path=base_url();
		$url = $path.'api/manageQuotations_api/Show_Enquiry?enquiry_id='.$enquiry_id;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//print_r($response_json);

		$enquiry_no=0;
		if($response['status']==1){
			$products_associatedArr= json_decode($response['status_message'][0]['products_associated'],true);
			$enquiry_no=$response['status_message'][0]['enquiry_id'];
			$customer_id=$response['status_message'][0]['customer_id'];
			$customer_name=$response['status_message'][0]['customer_name'];
			$date=date('d M Y', strtotime($response['status_message'][0]['date_on']));
			$time=date('h:m A', strtotime($response['status_message'][0]['time_on']));
			$product_arr=array();
			//print_r($products_associatedArr);die();

			echo '
			<div class="w3-col l12 w3-small w3-padding w3-round w3-card-2">
			<div class="w3-col l12 w3-margin-bottom">
			<div class="w3-left">
			<label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
			<input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
			</div>
			<div class="w3-right">
			<label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
			</div>
			</div>

			<div class="w3-col l12 w3-margin-bottom">
			<label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
			<input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

			</div>

			<div class="w3-col l12 w3-margin-bottom">
			<label class="w3-label w3-text-red">Products:</label>

			<ol type="I" style="margin: 0">';

				//--------------------------all the products fetched from enquiry----------------------//
			foreach ($products_associatedArr as $key) { 
				echo '
				<li>'.strtoupper($key['product_name']).' -';

				if($key['housing_status']==1){ echo $key['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

				echo '
				</li>
				<ol>
				<i>
				<li>'.ucwords($key['profile_description'][0]).'- '.strtoupper($key['profile_id']).'- '.$key['Prod_ID'][0].'mm ID X '.$key['Prod_OD'][0].'mm OD X '.$key['Prod_length'][0].'mm THICK -';

				if($key['housing_status']==1){ echo '1 NO.'; } else { echo $key['product_quantity'].' NO.'; }

				echo '@ '.$key['product_price'].' <i class="fa fa-inr"></i> per NO</li>
				</i>
				</ol>
				<br>
				';
				//------------------------------products fetched end ----------------------------------//
			} 


			echo '</ol>              
			</div>
			<div class="w3-col l12 w3-margin-bottom">
			<label class="w3-label w3-text-red">Delivery within:</label><br>
			<input type="number" class="" style="width:60px;" name="delivery_span" id="delivery_span" required>
			<select class="w3-select" style="width:100px;" name="delivery_period" id="delivery_period">
			<option value="1">day/days</option>
			<option value="2">week/weeks</option>
			<option value="3">month/months</option>
			<option value="4">year/years</option>
			</select>             
			</div><br>
			<button class="btn w3-button btn-block w3-red" type="submit" id="send_quote" name="send_quote">Raise New Quotation for this Enquiry</button>
			</div>
			';			
			
		}
		else{

			echo '<div class="alert alert-danger w3-col l12">
			<strong>'.$response['status_message'].'</strong> 
			</div>			
			';	
		}
	}

//------------this fun is used to get enquiry details for multiple quotations----------------------------------------//
	public function getEnquiry_DetailsFor_MultipleQuotation(){

		extract($_POST);
		//$data=$_POST;
		$revise_Price=json_encode($_POST['revise_productPrice']);
		$data['product_JSON']=$revise_Price;
		$data['enquiry_id']=$enquiry_id;
		$data['revise_deliverySpan']=$revise_deliverySpan;
		$data['revise_deliveryPeriod']=$revise_deliveryPeriod;
//print_r($data);die();
		$path=base_url();
		$url = $path.'api/manageQuotations_api/getEnquiry_DetailsFor_MultipleQuotation';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);

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
//------------this fun is used to get enquiry details for multiple quotations----------------------------------------//

}
