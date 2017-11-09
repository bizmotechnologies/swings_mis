<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ManageProducts_model extends CI_Model{

	//---------------get all products model-------------//
	function getAll_product()
	{
		$query="SELECT * FROM products";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Products are not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all products ends--------------------------//

	//---------------get particular products model-------------//
	function getProduct_details($product_id)
	{
		$query="SELECT * FROM products WHERE product_id='$product_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Product is not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get particular products ends--------------------------//

	
}
?>