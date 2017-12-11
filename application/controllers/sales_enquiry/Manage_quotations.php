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

	// --------------------- this fun is used to send quotation to PO ----------------------------------//	

	public function sendTo_PO(){
		extract($_POST);
		print_r($_POST);

		$path=base_url();
		$url = $path.'api/manageQuotations_api/sendTo_PO?quotation_id='.$quotation_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		print_r($response_json);

		redirect('sales_enquiry/manage_quotations');
	}
        // --------------------- this fun is used to to send quotation to PO ----------------------------------//


	// --------------------- this fun is used to get sort quotation by customer and date ----------------------------------//	

	public function sendMail(){
		extract($_POST);
		$data=$_POST;
		print_r($_POST);die();

		$config['protocol'] = 'smtp';
$config['smtp_host'] = 'seal-wings.com';
$config['smtp_port'] = '465'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$config['smtp_crypto'] = 'ssl';
$config['smtp_user'] = 'test@seal-wings.com';
$config['smtp_pass'] = 'sealwings@123';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "rn";
$this->load->library('email',$config); 
$this->email->from('test@seal-wings.com', 'Sender Name');
$this->email->to('samratbizmotech@gmail.com','Recipient Name');
$this->email->subject('Your Subject');
$this->email->message('Your Message'); 
if ($this->email->send()) {
    $response=array(
        'status' => 0,
        'status_message' => 'Message could not be sent. <br>Mailer Error: '
    );
} else {
    $response = array(
        'status' => 1,
        'status_message' => 'Message has been sent'
    );
}
        //sql query to insert user row and create an account
return $response;
die();
		
		$path=base_url();
		$url = $path.'api/manageQuotations_api/sendMail';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		print_r($response_json);die();

		redirect('sales_enquiry/manage_quotations');
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
