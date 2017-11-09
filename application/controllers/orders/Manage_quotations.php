<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings Manage_quotations
class Manage_quotations extends CI_Controller
{
	public function __construct(){
		parent::__construct();			
	}

	public function index(){
		
		$data['all_products']=Manage_quotations::show_products();
		$data['all_roles']=Manage_quotations::show_roles();

		$this->load->view('includes/navigation.php');
		$this->load->view('pages/manage_quotations.php',$data);		
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

	// ---------------function to show particular product details------------------------//
	public function productDetails(){

		$product_id=$_POST['product_id'];
		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/ManageProducts_api/productDetails?product_id='.$product_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//API processing END

		//-------------------populate the following data of respective product when product is selected
		echo '
		<div class="w3-col l12 w3-margin-bottom">
            <div class="w3-col l4 w3-left w3-padding-right">
              <label>Inner Dimension:</label>
              <input class="form-control" type="number" id="quote_ID" name="quote_ID" min="0" step="0.01" value="'.$response[0]['ID'].'" placeholder="ID in mm">
            </div>
            <div class="w3-col l4 w3-center">
              <label class="w3-left">Outer Dimension:</label>
              <input class="form-control" type="number" id="quote_OD" name="quote_OD" min="0" step="0.01" value="'.$response[0]['OD'].'" placeholder="OD in mm">
            </div>
            <div class="w3-col l4 w3-right w3-padding-left">
              <label>Thickness/Length:</label>
              <input class="form-control" type="number" id="quote_thickness" name="quote_thickness" min="0" value="'.$response[0]['thickness'].'" step="0.01" placeholder="Thickness in mm">
            </div>
          </div>

          <div class="w3-col l12 w3-margin-bottom">
            <div class="w3-col l4 w3-left w3-padding-right">
              <label>Price (per 1NO.):</label>
              <input class="form-control" type="number" id="quote_price" name="quote_price" min="0" step="0.01" value="'.$response[0]['price'].'" placeholder="in Rupees">
            </div>
            <div class="col-lg-4 w3-center">
              
            </div>
            <div class="w3-col l4 w3-padding-left w3-padding-top">
              <button type="submit" class="w3-right btn w3-blue w3-margin-top">Add to Quotation</button>
            </div>
          </div>
		'	;

		
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
	
}
?>