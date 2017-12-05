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
		
		$data['all_products']=Manage_quotations::show_products();
		$data['all_customer']=Manage_quotations::show_customer();
		$data['all_liveQuotations']=Manage_quotations::show_liveQuotation();

		$this->load->view('includes/navigation.php');
		$this->load->view('sales/manage_quotations.php',$data);		
		//$this->load->view('sales/demo.php',$data);		
	}
	
	// ---------------function to show all products------------------------//
	public function show_products(){
		
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/ManageProducts_api/all_product';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;	

		
	}
// ---------------------function ends----------------------------------//

	// ---------------function to add products to session------------------------//
	public function addProducts_toSession(){		
		extract($_POST);
		
		$product_session=$this->session->userdata('product_session');

		$product_array=json_decode($product_session,true);

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/manageProducts_api/productDetails?product_id='.$product_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		
		$product_name="";
		foreach ($response as $key) {
			$product_name=$key['product_name'];
		}

		//----create session array--------//
		$session_data= array(
			'product_id'  => $product_id,
			'product_name'  => $product_name,
			'cut_value' => $cut_value,
			'quote_ID'=>$quote_ID,
			'quote_OD'=>$quote_OD,
			'quote_thickness'=>$quote_thickness,
			'quote_price'=>$quote_price,
			'quote_tolerance'=>$quote_tolerance
		);
		$product_array[]=$session_data;
		$product_session=json_encode($product_array);
		$this->session->set_userdata('product_session',$product_session);
		$newproduct_session=$this->session->userdata('product_session');
		//print_r(json_decode($newproduct_session,true));

		$count=1;
		echo ' <table class="table table-striped" >';
		foreach ((json_decode($newproduct_session,true)) as $key) {
			
			echo '
			<tr>
			<td>
			<span class="w3-padding-left"><b>'.$count.'. '.$key['product_name'].'</b></span>                 
			</td>
			</tr>
			';
			$count++;
		}
		echo '<table>
		<a href="'.base_url().'sales_enquiry/manage_quotations/clearSession" class="w3-button w3-right w3-margin-right w3-margin-bottom"><i class="fa fa-refresh"></i> Clear</a>
		';
		
	}
// ---------------------function ends----------------------------------//

	// ---------------function to delete products from session------------------------//
	public function clearSession(){		
		$this->session->set_userdata('product_session','cleared');
		$this->session->unset_userdata(array("product_session"=>""));
    	//$this->session->sess_destroy();
		redirect('sales_enquiry/manage_quotations');
	}
// ---------------------function ends----------------------------------//

	// ---------------function to show all live quotations------------------------//
	public function show_liveQuotation(){

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/manageQuotations_api/all_liveQuotations';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;	


	}
// ---------------------function ends----------------------------------//

	// ---------------function to show quotation details------------------------//
	public function quotationDetails(){
		$sub_quotationID=$_POST['sub_quotationID'];
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/manageQuotations_api/quotationDetails?sub_quotationID='.$sub_quotationID;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);

		if(isset($response['status'])){
			echo '
			<div class="w3-col l12 alert alert-danger w3-center w3-margin-bottom">
			<span class="w3-medium w3-text-red">'.$response['status_message'].'</span>
			</div>';
		}
		else{
			echo '
			<div class="w3-col l12 w3-padding">
			<div class="w3-col l12 w3-card-2 w3-padding">
			<div class="w3-col l12 w3-margin-bottom">
			<label class="w3-label w3-text-blue">QUOTATION NO:</label>
			<span class="w3-text-grey">Quotation No.#Q'.$response[0]['quotation_id'].'/'.$response[0]['sub_quotation_id'].'</span>
			</div>
			<div class="w3-col l12 w3-margin-bottom">
			<label class="w3-label w3-text-blue">QUOTATION FOR:</label>
			<span class="w3-text-grey">'.$response[0]['customer_name'].'</span>
			<span class="w3-text-grey"> <i>['.$response[0]['customer_email'].']</i></span>
			</div>
			<div class="w3-col l12 w3-margin-bottom">
			<span class="w3-left w3-text-grey"> created on: '.$response[0]['quotation_created'].'</span>
			<span class="w3-right w3-text-grey"> revised on: '.$response[0]['dated'].'</span>
			</div>
			<div class="w3-col l12">
			<label class="w3-label w3-text-blue">PRODUCTS ARE:</label>
			<table class="table table-striped table-responsive w3-text-grey">
			<thead>
			<tr>
			<th class="text-center">Product Name</th>
			<th class="text-center">ID/OD</th>
			<th class="text-center">Thickness</th>
			<th class="text-center">Price</th>

			</tr>
			</thead>
			<tbody>';
			foreach (json_decode($response[0]['products'],true) as $key) {
				
				echo '
				<tr>
				<td class="text-center">'.$key['product_name'].'</td>                 
				<td class="text-center">'.$key['quote_ID'].'/'.$key['quote_OD'].'</td>                 
				<td class="text-center">'.$key['quote_thickness'].'</td>                 
				<td class="text-center">'.$key['quote_price'].' <i class="fa fa-rupee"></i></td>                 
				</tr>
				';
			}

			echo '</tbody>
			</table>
			<div class="w3-col l12">
			<a href="#" class="w3-button w3-red w3-left">Send to Client</a>
			<a href="#" class="w3-button w3-red w3-right">Proceed to PO</a>
			</div>
			
			</div>
			</div>
			</div>';	
		}

	}
// ---------------------function ends----------------------------------//

	// ---------------function to show all products------------------------//
	public function show_customer(){

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/ManageCustomer_api/getCustomerDetails';		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		return $response;	


	}
// ---------------------function ends----------------------------------//

	// ---------------function to show particular product details------------------------//
	public function productDetails(){

		$product_id=$_POST['product_id'];
		$cut_value=$_POST['cut_value'];
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/ManageProducts_api/productCosting?product_id='.$product_id.'&cut_value='.$cut_value;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);

		//API processing END

		if($response['status']==0){
			echo '
			<div class="w3-col l12 alert alert-danger w3-center w3-margin-bottom">
			<span class="w3-medium w3-text-red">'.$response['status_message'].'</span>
			</div>';
		}
		else{
			//-------------------populate the following data of respective product when product is selected
			echo '
			<div class="w3-col l12 w3-margin-bottom">
			<div class="w3-col l4 w3-left w3-padding">
			<label>Inner Dimension:</label>
			<input class="form-control" type="number" id="quote_ID" name="quote_ID" min="0" step="0.01" value="'.$response['product_ID'].'" placeholder="ID in mm">
			</div>
			<div class="w3-col l4 w3-left w3-padding">
			<label class="w3-left">Outer Dimension:</label>
			<input class="form-control" type="number" id="quote_OD" name="quote_OD" min="0" step="0.01" value="'.$response['product_OD'].'" placeholder="OD in mm">
			</div>
			<div class="w3-col l4 w3-left w3-padding">
			<label>Thickness/Length:</label>
			<input class="form-control" type="number" id="quote_thickness" name="quote_thickness" min="0" value="'.$response['product_thickness'].'" step="0.01" placeholder="Thickness in mm">
			</div>
			</div>

			<div class="w3-col l12 w3-margin-bottom">
			<div class="w3-col l4 w3-left w3-padding">
			<label>Price (per 1NO.):</label>
			<input class="form-control" type="number" id="quote_price" name="quote_price" min="0" step="0.01" value="'.$response['product_price'].'" placeholder="in Rupees">
			</div>

			<div class="w3-col l4 w3-left w3-padding">
			<label>Tolerance :</label>
			<input class="form-control" type="number" id="quote_tolerance" name="quote_tolerance" placeholder="Tolerance rate" required>
			</div>
			<div class="w3-col l4 w3-padding-large">
			<button type="button" id="addProduct_toQuote" name="addProduct_toQuote" onclick="addProducts();" class="w3-right btn w3-blue w3-margin-top">Add Product</button>
			</div>

			</div>
			'	;

		}	

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
    
    
    public function sort_Enquiry(){
        
        $From_date = 2017/01/01;
        $To_date = 2017/12/31;
        $Sort_by = "live";
        $customer_Id = 1;
                $path=base_url();
		$url = $path.'api/manageQuotations_api/sort_Enquiry?From_date='.$From_date.'&To_date='.$To_date.'&Sort_by='.$Sort_by.'&customer_Id='.$customer_Id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
                print_r($response);
    }
    
    public function show_quotations(){
        $data['Enquiries'] = Manage_quotations::fetchEnquiry_For_Quotation();
        $this->load->view('includes/navigation');
        $this->load->view('sales/Quotation_new',$data);	
    }
    
    public function Show_Enquiry(){
                extract($_POST);
                //print_r($_POST);
                $path=base_url();
		$url = $path.'api/manageQuotations_api/Show_Enquiry?Enquiries='.$Enquiries;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
                print_r($response);
    }
    
   
}
