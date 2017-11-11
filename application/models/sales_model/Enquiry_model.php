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

	//---------------get particular products model-------------//
	function getProduct_Quotation($product_id,$cut_value)
	{
		$query="SELECT * FROM product_material_assoc WHERE product_id='$product_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Product details not found!!!'
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
return $product;die();
			for ($i=0; $i < count($response) ; $i++) {
			//return $response[$i]['material_id'];die(); 
				$material = $this->ManageMaterials_model->getMaterial_details($response[$i]['material_id']);
				for ($j=0; $j < count($material) ; $j++) {

					$material_price=((($cut_value + $product_thickness) * 2.65) * $material[$j]['material_price'] );
					$product_price=$product_price + $material_price;
				}
				
			}
			$quote_data=array(
				'product_ID'	=>	
			);

			return $product_price;
		}
	}
	//----------------get particular products ends--------------------------//

	
}
?>