<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Enquiry_model extends CI_Model{

	// //---------------get all products model-------------//
	// function getAll_product()
	// {
	// 	$query="SELECT * FROM products";
	// 	$result = $this->db->query($query);
	// 	//return $result['num'];

	// 	if($result->num_rows() <= 0)
	// 	{  
	// 		$response=array(
	// 			'status'	=>	0,
	// 			'status_message' =>'Products are not defined yet!!!'
	// 		);
	// 		return $response;
	// 	}
	// 	else
	// 	{
	// 		$response=$result->result_array();
	// 		return $response;
	// 	}
	// }
	// //----------------get all products ends--------------------------//

	//---------------get all live quotations of customer model-------------//
	function getQuotations($customer_id)
	{
		$query="SELECT * FROM quotation_master WHERE customer_id='$customer_id' AND current_status='0'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'There is no any quotation associated with this customer'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			// $live_subquotation=array();
			// foreach ($response as $key) {
			// 	$live_subquotation[]=Enquiry_model::getLive_subquotation($key['quotation_id']);
			// }
			
			$quotations=array(
				'status'	=>	1,
				'status_message' =>$response//json_encode($live_subquotation)
			);
			return $quotations;
		}
	}
	//----------------get all live quotations of customer ends--------------------------//

	//---------------get live subquotation of quotation master table model-------------//
	function getLive_subquotation($quotation_id)
	{
		$query="SELECT * FROM quotation_master WHERE quotation_id='$quotation_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		$response=$result->result_array();
		$sub_quotationsJSON="";
		$dated="";
		foreach ($response as $key) {
			$sub_quotationsJSON=$key['sub_quotations'];
			$dated=$key['dated'];
		}

		$sub_quotations=json_decode($sub_quotationsJSON,true);		
		$live_quotation="";

		foreach ($sub_quotations as $key) {
			
			if ($key['status']==TRUE) {
				$live_quotation=$key['sub_quotation'];
			}
		}
		$sub_quoteARR=array(
			'live_subQuote'	=>	$live_quotation,
			'live_Quote'	=>	$quotation_id,
			'dated'	=>	$dated
		);
		return $sub_quoteARR;
	}
	//----------------get live subquotation of quotation master table ends--------------------------//

	//---------------get particular product costing model-------------//
	function getProduct_Costing($product_id,$cut_value)
	{
		$query="SELECT * FROM product_material_assoc WHERE product_id='$product_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Product details not found OR No any material is associated with it!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			$product_price=0;

			$this->load->model('inventory_model/ManageMaterials_model');
			$this->load->model('inventory_model/ManageProducts_model');

			$product = $this->ManageProducts_model->getProduct_details($product_id);
			$product_thickness= $product[0]['thickness'];

			for ($i=0; $i < count($response) ; $i++) {
				$material = $this->ManageMaterials_model->getMaterial_details($response[$i]['material_id']);

				for ($j=0; $j < count($material) ; $j++) {
					$material_price=((($cut_value + $product_thickness) * 2.65) * $material[$j]['pricepermm'] );
					$product_price=$product_price + $material_price;
				}
				
			}
			$quote_data=array(
				'status'	=>	1,
				'product_ID'	=> $product[0]['ID'],	
				'product_OD'	=> $product[0]['OD'],	
				'product_thickness'	=> $product[0]['thickness'],
				'product_price'	=> $product_price	
			);

			return $quote_data;
		}
	}
	//----------------get particular product costing ends--------------------------//


	//---------------add product to quotation model-------------//
	function add_ToQuotation($data)
	{
		extract($data);
		//-----------------------get autoincrement values--------------------//
		$this->load->model('config_model/DbSetup_model');
		$quotation_masterTable_id = $this->DbSetup_model->get_AutoIncrement('swing_db','quotation_master');
		$sub_quotationTable_id = $this->DbSetup_model->get_AutoIncrement('swing_db','sub_quotation');
		//------------------------------end---------------------------------//


		//----------------------Generate Subquotation fields------------------//
		$product=array();
		$product[]=array(
			'product_id'	=>	$product_id,
			'ID'	=>	$quote_ID,
			'OD'	=>	$quote_OD,
			'thickness'	=>	$quote_thickness,
			'cut'	=>	$quote_cut,
			'tolerance'	=>	$quote_tolerance,
			'price'	=>	$quote_price
		);
		$productJSON=json_encode($product);
		//-----------------------Subquotation fields end-----------------------//

		
		//----------------------Generate Quotation fields------------------//
		$sub_quotations=array();
		$sub_quotations[]=array(
			'sub_quotation'	=>	$sub_quotationTable_id,
			'status'	=>	TRUE
		);
		$sub_quotationJSON=json_encode($sub_quotations);
		//-----------------------Quotation fields end-----------------------//

		//------------------------Insert data into subquotation and quotation master tables---------------------//
		$insert_intoSubquotation="INSERT INTO sub_quotation(quotation_id,products,current_status,dated,time_at) VALUES ('$quotation_masterTable_id','$productJSON','0',NOW(),NOW())";
		
		if($this->db->query($insert_intoSubquotation)){
			$insert_intoMaster="INSERT INTO quotation_master(customer_id,sub_quotations,current_status,dated,time_at) VALUES ('1','$sub_quotationJSON','0',NOW(),NOW())";
			$result =$this->db->query($insert_intoMaster);
		}
		//-----------------------------------insert query end--------------------------------------------------//

		//print_r($productJSON);die();
		
		//sql query to insert new role
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'Product Added.<br>'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..Product could not be added!!!'
			);
		}
		
		return $response;
	}
	//----------------add product to quotation ends--------------------------//

	
}
?>