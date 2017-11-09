<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

//S-wings Manage_quotations
class Manage_quotations extends CI_Controller
{
	public function __construct(){
		parent::__construct();
		// $this->load->model('DbSetup_model')	;
		// $this->DbSetup_model->createDbSchema();	
	}

	public function index(){
		
		$data['all_products']=Manage_quotations::show_products();
		$data['all_roles']=Manage_quotations::show_roles();

		$this->load->view('includes/navigation.php');
		$this->load->view('pages/manage_quotations.php',$data);		
	}
	
	// ---------------function to add new feature------------------------//
	public function add_feature(){
		extract($_POST);
		$roles_arr=array();
		foreach ($feature_roles as $key) {
			$roles_arr[]=$key;
		}
		$data=array(
			'feature_title' => $feature_title, 
			'feature_description' => $feature_description, 
			'role_features' => json_encode($roles_arr), 
		);

		//Connection establishment, processing of data and response from REST API
		$path=base_url();
		$url = $path.'api/settings_api/add_feature';	
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
			
		}	
		
	}
// ---------------------function ends----------------------------------//
	

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


	// ---------------function to edit feature------------------------//
	public function edit_feature(){
		
		extract($_POST);		
		$data=$_POST;
		$data['editfeature_roles']=json_encode($editfeature_roles);

		//Connection establishment, processing of data and response from REST API
		
		$path=base_url();
		$url = $path.'api/settings_api/edit_feature';	
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);		
		
		//API processing end
		if($response['status']==0){
			$data['updateFeature_set']='<div class="alert alert-danger">
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
			
		}
		else{
			$data['updateFeature_set']='<div class="alert alert-success">
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
			
		}			
		redirect('General_settings');	
	}
// ---------------------function ends----------------------------------//


	// ---------------function to delete feature------------------------//
	public function del_feature(){
		extract($_POST);

		//Connection establishment to get data from REST API
		$path=base_url();
		$url = $path.'api/settings_api/del_feature?feature_id='.$feature_id;		
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response_json = curl_exec($ch);
		curl_close($ch);
		$response=json_decode($response_json, true);
		//api processing ends

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
			
		}	
		
	}
// ---------------------function ends----------------------------------//
	
}
?>