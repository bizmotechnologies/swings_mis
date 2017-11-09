<?php
	class ManageMaterial_model extends CI_Model{

	public function getrecord($data){
		extract($data);
		$query = "SELECT * FROM materials WHERE material_category_id = '$Select_category_id'";
		$result =$this->db->query($query);
		 if($result->num_rows()>=0){  
   				$response=array(
    				'status' => 1,
    				'status_message' => $result->result_array());
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => 'No records found');
  						}
 
		return $response;

	}

	public function saverecord( $data ){
		extract($data);
		//$query= $this->db->insert('materials', $data);
		$mat_code=0;
		$mat_codenew=0;
		$code=0;
		$material_code=0;
		$material_codenew = 0;
		$mat_code= $inputmaterial_name[0];
		$mat_codenew= $inputmaterial_name[1];
		$var= $mat_code.$mat_codenew;
		$code = strtoupper($var) ;
		$material_codenew = uniqid(); 
		$material_code = $code.'_'.$material_codenew;
		$sql = "INSERT INTO materials
		(material_name,material_category_id,ingredients,length_thickness,instock_quantity,material_code,material_price) 
		VALUES ('$inputmaterial_name','$input_material_category_id','$input_ingredients','$input_length_thickness','$input_instock_quantity', '$material_code','$input_priceFor_material')";
  		$result =$this->db->query($sql);

		if($result){  
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

	public function getcategory(){
		$query = $this->db->get('material_category');
		return $query->result();

	}

	public function addcategory($data){
		extract($data);
		$sqlnew="INSERT INTO material_category(material_category_name) values ('$input_category')";
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

	public function updateRecord($data){
		extract($data);
		//print_r($data);
		$mat_code=0;
		$mat_codenew=0;
		$code=0;
		$material_code=0;
		$material_codenew = 0;
		$mat_code= $updated_materialname[0];
		$mat_codenew= $updated_materialname[1];
		$var= $mat_code.$mat_codenew;
		$code = strtoupper($var) ;
		$material_codenew = uniqid(); 
		$material_code = $code.'_'.$material_codenew;
		$sqlupdate = "UPDATE materials SET material_name='$updated_materialname',material_category_id='$update_category_id',ingredients='$updated_ingredients',length_thickness='$updated_materiallength',
		instock_quantity='$updated_instockquantity',material_code='$material_code', material_price='$updated_materialPrice' WHERE material_id='$new_material_id'";		

		$resultupdate =$this->db->query($sqlupdate);

			$value= 'Records Updated Successfully';
			//return $value;
			return redirect('manage_material');

	}


	public function deleteRecord($data){

		extract($data);
				//print_r($data);
		$sqldelete = "DELETE FROM materials WHERE material_id='$material_id'";

		$resultdelete =$this->db->query($sqldelete);

		if($resultdelete){  
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




	}
?>