<?php
	class ManageProduct_model extends CI_Model{

	public function getProductcategory(){

		$query = $this->db->get('product_category');
		return $query->result();

	}

	public function showMaterial($data){

		extract($data);
		$sqlselect = "SELECT * FROM materials WHERE material_id = '$SelectNew_Material_id'";
		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
   				$response=array(
    			'status' => 1,
    			'status_message' =>'No Records Found.'	);
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => $result->result_array());
  						}
 
		return $response;

	}

	public function Show_Material_Product_Association($data){

		extract($data);

		$sqlselect="SELECT * FROM product_material_assoc WHERE product_id = '$SelectProduct_id'";

		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
   				$response=array(
    			'status' => 1,
    			'status_message' =>'No Records Found.'	);
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => $result->result_array());
  						}
 
		return $response;

	}

	public function Save_Material_product_assoc($data){
	//print_r($data); die();
	extract($data);
	$material_name=ManageProduct_model::getMaterialdata($SelectMaterial_id);
	//print_r($material_name); die();
	$sqlnew="INSERT INTO product_material_assoc (product_id, material_id,material_name) 
	values ('$SelectProduct_id','$SelectMaterial_id','$material_name')";
		$resultnew =$this->db->query($sqlnew);

		$sqlselect="SELECT * FROM product_material_assoc WHERE product_id = '$SelectProduct_id'";

		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
   				$response=array(
    			'status' => 1,
    			'status_message' =>'No Records Found.'	);
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => $result->result_array());
  						}
 
		return $response;

	}

	public function DeleteMaterialProductAssoc($data){

		extract($data);
		//print_r($data);die();
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

	}

	public function getMaterialdata($id){
		$sql = "SELECT material_name FROM materials WHERE material_id='$id'";
		$resultnew =$this->db->query($sql);

		 $material_name="";
  
        foreach ($resultnew->result_array() as $row) {
        $material_name = $row['material_name'];
        }
    
        return $material_name; 

	}
	public function getMaterialId(){

		$query = $this->db->get('materials');
		return $query->result();

	}

	public function getProductsId(){

		$query = $this->db->get('products');
		return $query->result();

	}

	public function getProduct_Records($data){

		extract($data);
		$query = "SELECT * FROM products WHERE product_category_id = '$Select_Product_category_id'";
		$result =$this->db->query($query);
		 if($result->num_rows()<=0){  
   				$response=array(
    			'status' => 1,
    			'status_message' =>''	);
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => $result->result_array());
  						}
 
		return $response;

	}

	public function addProductCategory($data){

		extract($data);
		$sqlnew="INSERT INTO product_category(product_category_name) values ('$input_Productcategory')";
		$resultnew =$this->db->query($sqlnew);

		if($resultnew){  
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

	}

	public function DeleteProduct($data){

		extract($data);
		//print_r($data);die();
		$sqldelete = "DELETE FROM product_category WHERE product_category_id='$Select_Product_category_id'";

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
	}


public function save_Products($data){
	//print_r($data);
		extract($data);
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

		$sql = "INSERT INTO products(product_category_id,product_name,product_code,ID,OD,thickness,price)
		 VALUES ('$SelectNew_Product_category_id','$Input_productName','$product_code','$Inner_dimention','$Outer_dimention','$input_Thickness','$Input_productPrice')";
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

}
public function DeleteRecord($data){

	extract($data);
				//print_r($data);
		$sqldelete = "DELETE FROM products WHERE product_id='$Product_id'";

		$resultdelete =$this->db->query($sqldelete);

		if($resultdelete){
		echo "<script>alert('Menu Item Deleted');
		      window.location.href='".base_url()."Manage_products';</script>";
		}

}

public function UpdateProductRecord($data){
		//print_r($data);
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

		$sql = "UPDATE products SET product_category_id = '$update_Product_category_id',
		    product_name = '$updated_ProductName',product_code = '$product_code',
		    ID = '$UpdatedInner_dimention',OD = '$UpdatedOuter_dimention',
		    thickness = '$Updatedinput_Thickness',price = '$updated_Price' WHERE product_id='$new_Product_id'";
		    //echo $sql; die();
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
}





	}
?>