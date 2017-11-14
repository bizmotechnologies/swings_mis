<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ManageProduct_model extends CI_Model{

	public function getProductcategory(){  /*this function is used to get product category*/

		$query = $this->db->get('product_category');
		return $query->result();
	}
	/*this function is used to get product category ends here*/

	public function showmaterialInfo($data){ /* this fun is used to get material data*/

		$sqlselect = "SELECT * FROM materials WHERE material_id = '$data'";
		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
			$response=array(
				'status' => 0,
				'status_message' =>'No Records Found.'	);
		}
		else{
			$info=array();
			foreach ($result->result_array() as $key) {
				$newarr = array(

					'material_innerdimention' => $key['material_innerdimention'],
					'material_outerdimention' => $key['material_outerdimention'],
					);
				$info[] = $newarr;
			}
			$response=json_encode($info);
		}
		return $response;
	}
	/*---------------- this fun is ends here --------------------------------*/

	public function Show_Material_Product_Association($data){   /* this function is used to show material product association*/

		extract($data);

		$sqlselect="SELECT * FROM product_material_assoc WHERE product_id = '$SelectProduct_id'";

		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
			$response=array(
				'status' => 0,
				'status_message' =>'No Records Found.'	);
		}
		else{
			$response=array(
				'status' => 1,
				'status_message' => $result->result_array());
		}
		return $response;
	}
	/* show material product association ends here */

	public function Save_Material_product_assoc($data){  /* this fun is used to save material product association */
		extract($data);
		$material_name=ManageProduct_model::getMaterialdata($SelectMaterial_id);
		$sqlnew="INSERT INTO product_material_assoc (product_id, material_id,material_name) 
		values ('$SelectProduct_id','$SelectMaterial_id','$material_name')";
		$resultnew =$this->db->query($sqlnew);

		$sqlselect="SELECT * FROM product_material_assoc WHERE product_id = '$SelectProduct_id'";

		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
			$response=array(
				'status' => 0,
				'status_message' =>'No Records Found.'	);
		}
		else{
			$response=array(
				'status' => 1,
				'status_message' => $result->result_array());
		}
		return $response;
	}/*material product association ends here */

	public function DeleteMaterialProductAssoc($data){ /*this fun is used to delete mae=terila product assocition */

		extract($data);
		$sqldelete = "DELETE FROM product_material_assoc WHERE product_material_assoc_id='$product_material_assoc_id'";
		$resultdelete =$this->db->query($sqldelete);
		if($resultdelete){  
			$response=array(
				'status' => 1,
				'status_message' =>'Records Deleted Successfully..!');
		}
		else{
			$response=array(
				'status' => 0,
				'status_message' => 'Records Not Deleted Successfully...!');
		}
		return $response;
		/*  function ends here*/
	}

	public function getMaterialdata($id){   /*this fun is uded to get mateial name for save materil product assocition*/
		$sql = "SELECT material_name FROM materials WHERE material_id='$id'";
		$resultnew =$this->db->query($sql);

		$material_name="";
		
		foreach ($resultnew->result_array() as $row) {
			$material_name = $row['material_name'];
		}
		return $material_name; 
	}  
	/*-----------------fun ends here----------------------*/

	public function getMaterialId(){  /* this fun is used to get material information */

		$query = $this->db->get('materials');
		return $query->result();
		/*fun ends here*/
	}

	public function getProductsId(){  /*this fun is used to get product info*/

		$query = $this->db->get('products');
		return $query->result();

	}/*fun ends here*/

	public function getProduct_Records(){ /*this fun is used to get product records */

		$query = "SELECT * FROM products ";
		$result =$this->db->query($query);
		if($result->num_rows()<=0){  
			$response=array(
				'status' => 0,
				'status_message' =>''	);
		}
		else{
			$response=array(
				'status' => 1,
				'status_message' => $result->result_array());
		}
		
		return $response;

	}/*fun ends here*/

		
	public function save_Products($data){  /*this fun is for save product information*/
		extract($data);

		$ID_val = json_decode($ID_val);
		$SelectNew_Material_id = json_decode($SelectNew_Material_id);
		$OD_val = json_decode($OD_val);
		
		
		$sql="SELECT  AUTO_INCREMENT FROM information_schema.tables WHERE Table_SCHEMA = 'swing_db' AND table_name = 'products' ";
		$resultnew =$this->db->query($sql);

		$Product_id="";
		
		foreach ($resultnew->result_array() as $row)  
		{
			$Product_id = $row['AUTO_INCREMENT'];
		}

		$i=0;                        /*this logic for getting multiple values form table and storing in table */
		foreach ($ID_val as $key => $value) {

			$full['ID'][$i]=$value;
			$i++;
		}

		$j=0;
		foreach ($OD_val as $key => $value) {

			$full['OD'][$j]=$value;
			$j++;
		}

		$k=0;
		foreach ($SelectNew_Material_id as $key => $value) {

			$full['material_id'][$k]=$value;
			$k++;
		}
		for ($i=0; $i < count($full['ID']); $i++) { 
			$ID = $full['ID'][$i];
			$OD = $full['OD'][$i];
			$material_id = $full['material_id'][$i].' ';

			$sqlforproductAssociation = " INSERT INTO product_material_assoc(product_id, material_id, material_innerdimention, material_outerdimention) 
			VALUES ('$Product_id','$material_id','$ID', '$OD')";
			$resultnew =$this->db->query($sqlforproductAssociation);  /*this code is for insert multiple rows to db ends here*/

		}		
		$mat_code=0;
		$mat_codenew=0;
		$code=0;
		$product_code=0;
		$Product_codenew = 0;
		$mat_code= $Input_productName[0];
		$mat_codenew= $Input_productName[1];
		$var= $mat_code.$mat_codenew;
		$code = strtoupper($var) ;
		$Product_codenew = uniqid(); 
		$product_code = $code.'_'.$Product_codenew;

		$sql = "INSERT INTO products(product_name,product_code,ID,OD,thickness)
		VALUES ('$Input_productName','$product_code','$Inner_dimention','$Outer_dimention','$input_Thickness')";
		$resultSaveproducts =$this->db->query($sql);

		if($resultSaveproducts){  
			$response=array(
				'status' => 1,
				'status_message' =>'Records Inserted Successfully..!');
		}
		else{
			$response=array(
				'status' => 0,
				'status_message' => 'Records Not Inserted Successfully...!');
		}
		
		return $response;

	} /*this save product fun ends here*/


	public function DeleteRecord($data){  /*this fun is used to delete record of product*/

		extract($data);
				//print_r($data);
		$sqldelete = "DELETE FROM products WHERE product_id='$Product_id'";

		$resultdelete =$this->db->query($sqldelete);

	if($this->db->affected_rows()>=1){  
		$response=array(
			'status' => 1,
			'status_message' =>'Records Deleted Successfully..!');
	}
	else{
		$response=array(
			'status' => 0,
			'status_message' => 'Records Not Deleted...!');
	}
	
	return $response;

	}
	/*delete product fun ends here*/

	public function UpdateProductRecord($data){  /*this fun is used for to update records for product*/

		extract($data);
		$mat_code=0;
		$mat_codenew=0;
		$code=0;
		$product_code=0;
		$Product_codenew = 0;
		$mat_code= $updated_ProductName[0];
		$mat_codenew= $updated_ProductName[1];
		$var= $mat_code.$mat_codenew;
		$code = strtoupper($var) ;
		$Product_codenew = uniqid(); 
		$product_code = $code.'_'.$Product_codenew;

		$sql = "UPDATE products SET product_name = '$updated_ProductName', product_code = '$product_code',
		ID = '$UpdatedInner_dimention',OD = '$UpdatedOuter_dimention',
		thickness = '$Updatedinput_Thickness' WHERE product_id='$new_Product_id'";

		$resultUpadateproducts =$this->db->query($sql);

		if($resultUpadateproducts){  
			$response=array(
				'status' => 1,
				'status_message' =>'Records Updated Successfully..!');
		}
		else{
			$response=array(
				'status' => 0,
				'status_message' => 'Records Not Updated Successfully...!');
		}
		return $response;
	}/*update records ends here*/





}
?>