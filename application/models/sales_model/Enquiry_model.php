<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Enquiry_model extends CI_Model{

	//---------------get all live quotations model-------------//
	function getlive_Quotations()
	{
		$query="SELECT * FROM sub_quotation WHERE current_status='0'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'No Quotation is live or pending!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();		
			$quotations=array(
				'status'	=>	1,
				'status_message' =>$response
			);
			return $quotations;
		}
	}
	//----------------get all live quotations ends--------------------------//

	//---------------get sub_quotation details model-------------//
	function getQuotation_details($sub_quotationID)
	{
		$query="SELECT * FROM sub_quotation WHERE sub_quotation_id='$sub_quotationID'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Quotation details not found!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();

			//----------------------Generate Quotation fields------------------//
			$quotation_details="";
			$quotation_details=Enquiry_model::getQuotation($response[0]['quotation_id']);
			//-----------------------Quotation fields end-----------------------//	

			$response[0]['quotation_customer']= $quotation_details[0]['customer_id'];
			$response[0]['quotation_created']= $quotation_details[0]['dated'];
			return $response;
		}
	}
	//----------------get sub_quotation details ends--------------------------//

	//---------------get quotation details model-------------//
	function getQuotation($quotationID)
	{
		$query="SELECT * FROM quotation_master WHERE quotation_id='$quotationID'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Quotation details not found!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get quotation details ends--------------------------//



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
			$quotations=array(
				'status'	=>	1,
				'status_message' =>$response
			);
			return $quotations;
		}
	}
	//----------------get all live quotations of customer ends--------------------------//

	//---------------get revised subquotation list to quotation master table model-------------//
	function getLive_subquotation($quotation_id,$sub_quotation)
	{
		$query="SELECT * FROM quotation_master WHERE quotation_id='$quotation_id'";
		$result = $this->db->query($query);
		
		$response=$result->result_array();
		$sub_quotationsJSON="";
		$dated="";
		foreach ($response as $key) {
			$sub_quotationsJSON=$key['sub_quotations'];
		}

		$sub_quotations=json_decode($sub_quotationsJSON,true);		
		$sub_quoteARR=array();

		//---------set all other subquotation values to false----------//
		foreach ($sub_quotations as $key) {
			$sub_quoteARR[]=array(
				'sub_quotation'	=> $key['sub_quotation'],
				'status'	=>	FALSE
			);

			// ------update subquotation table current_status to 1			
			$this->db->set('current_status', '1'); //value that used to update column  
			$this->db->where('sub_quotation_id', $key['sub_quotation']); //which row want to upgrade  
			$this->db->update('sub_quotation');  //table name
		}

		// -------new subquotation added with true value---------//
		$sub_quoteARR[]=array(
			'sub_quotation'	=> $sub_quotation,
			'status'	=>	TRUE	
		);
		$sub_quotationJSON=json_encode($sub_quoteARR);
		return $sub_quotationJSON;
	}
	//----------------get revised subquotation list to quotation master table ends--------------------------//

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

		//sql query to insert new role
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'Quotation Added.<br>'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..Quotation could not be added!!!'
			);
		}

		return $response;
	}
	//----------------add product to quotation ends--------------------------//


	//---------------add product to revised quotation model-------------//
	function add_revisedQuotation($data)
	{
		extract($data);

		//-----------------------get autoincrement values--------------------//
		$this->load->model('config_model/DbSetup_model');
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
		$sub_quotationJSON="";
		$sub_quotationJSON=Enquiry_model::getLive_subquotation($quotation_id,$sub_quotationTable_id);
		//-----------------------Quotation fields end-----------------------//

		//------------------------Insert data into subquotation and update subquotations in quotation master tables---------------------//
		$insert_intoSubquotation="INSERT INTO sub_quotation(quotation_id,products,current_status,dated,time_at) VALUES ('$quotation_id','$productJSON','0',NOW(),NOW())";
		$result=0;
		if($this->db->query($insert_intoSubquotation)){
			
			$this->db->set('sub_quotations', $sub_quotationJSON); //value that used to update column  
			$this->db->where('quotation_id', $quotation_id); //which row want to upgrade  
			$this->db->update('quotation_master');  //table name
			$result=1;
		}
		//-----------------------------------insert query end--------------------------------------------------//

		//sql query to insert new role
		if($result==1)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'Quotation Added.<br>'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..Quotation could not be added!!!'
			);
		}

		return $response;
	}
	//----------------add product to revised quotation ends--------------------------//


}
?>