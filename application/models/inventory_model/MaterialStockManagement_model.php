	<?php
	class MaterialStockManagement_model extends CI_Model{

		public function GetMaterialDetails(){  /*this fun is used to get material details*/

			$query = "SELECT * FROM materials";
			$result =$this->db->query($query);
			if($result->num_rows()<=0){  
				$response=array(
					'status' => 0,
					'status_message' =>''	);
			}
			else{
				$response=$result->result_array();
			}

			return $response;

		} 
		/*this getmaterialdeaails fun ends here*/

		public function GetRawMaterialInfoDetails(){  /*this fun is used to get material details*/

			$query = "SELECT * FROM raw_materialstock";
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

		} 
		/*this getmaterialdeaails fun ends here*/

		public function GetVendorsDetails(){

			$query = "SELECT * FROM vendor_details";
			$result =$this->db->query($query);
			if($result->num_rows()<=0){  
				$response=array(
					'status' => 0,
					'status_message' =>''	);
			}
			else{
				$response= $result->result_array();
			}

			return $response;
		}


		public function GetProductsName(){

			$query = "SELECT * FROM products";
			$result =$this->db->query($query);
			if($result->num_rows()<=0){  
				$response=array(
					'status' => 0,
					'status_message' =>''	);
			}
			else{
				$response= $result->result_array();
			}

			return $response;
		}

public function GetPurchaseProductsName(){
	$query = "SELECT * FROM purchase_productstock";
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
}

//---------------------------this fun Starts here for delete raw material----------------------------------------------\\

		public function DeleteRawMaterialStockDetails($data){
			extract($data);
			//print_r($data);die();
			$sqldelete = "DELETE FROM raw_materialstock WHERE rawmaterial_id = '$rawmaterial_id'";

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
//---------------------------this fun ends here for delete raw material----------------------------------------------\\

		public function Save_RawStockMaterial_Info($data){
			extract($data);

			$this->load->model('inventory_model/ManageProduct_model');
			$material_name = $this->ManageProduct_model->getMaterialdata($Select_RawMaterials_Id);

			$sqlnew="INSERT INTO raw_materialstock(material_id,vendor_id,
				material_name,raw_ID,raw_OD,
				avail_length,raw_quantity,
				accepted_date) 
	values ('$Select_RawMaterials_Id','$Select_RawVendors_Id',
		'$material_name','$Input_RawMaterialStock_ID',
		'$Input_RawMaterialStock_OD','$Input_RawMaterialLength','$Input_RawMaterialNewQuantity',now())";
	//echo $sqlnew;die();
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
/*----------------------update stock material info fun is Starts here--------------------------------*/


public function Save_PurchasedProduct_Info($data){

	extract($_POST);
	$data = $_POST;
	print_r($data);
	$product_name=MaterialStockManagement_model::getproductdata($Select_PurchasedProduct_Id);
	print_r($product_name);
	$sqlnew="INSERT INTO purchase_productstock(product_id,product_name,
		stock_id,stock_od,
		length,quantity,purchase_price,
		purchase_discount,vendor_id,accepted_date,
		purchase_currency,price_in_rs) 
	values ('$Select_PurchasedProduct_Id','$product_name',
		'$Input_PurchasedProductStock_ID','$Input_ProductStock_OD',
		'$Input_PurchasedLength','$Input_Purchased_quantity',
		'$input_priceForPurchase','$Input_PurchasedDiscount',
		'$Select_PurchasedVendors_Id',now(),
		'$Select_purchasedCurrency','$Input_Purchased_Price')";
	//echo $sqlnew;die();
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

//-------------------------------------------------------------------------
public function getproductdata($id){   /*this fun is uded to get mateial name for save materil product assocition*/
	$sql = "SELECT product_name FROM products WHERE product_id='$id'";
	$resultnew =$this->db->query($sql);

	$product_name="";

	foreach ($resultnew->result_array() as $row) {
		$product_name = $row['product_name'];
	}
	return $product_name; 
}  
//-----------------------------------------------------------------
public function Update_UpdatedRawStockMaterial_Info($data){ /*this fun is used to update material info*/

	extract($data);

	$this->load->model('inventory_model/ManageProduct_model');
	$material_name = $this->ManageProduct_model->getMaterialdata($Select_RawMaterials_Id);

	$sql = "UPDATE raw_materialstock SET rawmaterial_id = '$rawmaterial_id',
	material_id = '$Select_RawMaterials_Id', vendor_id = '$Select_RawVendor_Id',
	material_name = '$material_name', raw_ID = '$Updated_MaterialStock_OD',
	raw_OD = '$Updated_MaterialStock_OD',avail_length = '$Updated_MaterialLength',
	raw_quantity = '$Updated_MaterialNewQuantity' WHERE rawmaterial_id = '$rawmaterial_id'";
			    //echo $sql; die();
	$resultUpadate =$this->db->query($sql);

	if($resultUpadate){  
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
/*----------------------update stock material info fun is ends here--------------------------------*/

public function DeleteStockDetails($data){   /*-------------------this fun for delete stock details---------------------*/

	extract($data);
	$sqldelete = "DELETE FROM received_stock WHERE received_stock_id = '$Receivedstock_id'";

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
/*---------------delete stock details fun ends here--------------------------------------*/

public function Get_Purchase_Stock(){   /* this getreceived stock fun is used to get alll stock details*/
	$query = "SELECT * FROM purchase_productstock";
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
/*--------------------------this getreceivedstock ends here-------------------------------------*/

public function Save_StockMaterial_Info($data){  /*this fun for save stock details*/

	extract($data);

	$this->load->model('ManageProduct_model');
	$material_name = $this->ManageProduct_model->getMaterialdata($Select_Materials_Id); 

			//print_r($material_name);die();
	$Input_MaterialStocknew = 0;
	$new_instock_Quantity = 0;
	$Input_MaterialStocknew = trim($Input_MaterialStock);
	$new_instock_Quantity = $Input_MaterialStocknew + $Input_MaterialNewQuantity;

	$sqlupdate = "UPDATE materials SET instock_quantity= '$new_instock_Quantity' WHERE material_id = '$Select_Materials_Id'";
	$this->db->query($sqlupdate);

	$sqlnew="INSERT INTO received_stock(material_id,material_name,stock_quantity,
		stock_id,stock_od,length,quantity,purchase_price,purchase_discount,
		vendor,accepted_date) values ('$Select_Materials_Id','$material_name',
		'$Input_MaterialStocknew','$Input_MaterialStock_ID','$Input_MaterialStock_OD',
		'$Input_MaterialLength','$Input_MaterialNewQuantity','$Input_StockMaterialPrice',
		'$Input_StockMaterialDiscount','$Select_StockVenders',now())";

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
/* save stocks information ends here*/

public function showMaterial($data){   /*this fun is used to get instock quantity for materials*/

	extract($data);
			//print_r($data);die();
	$sqlselect = "SELECT instock_quantity FROM materials WHERE material_id = '$Select_Materials_Id'";
	$result =$this->db->query($sqlselect);

	if($result->num_rows()<=0){  
		$response=array(
			'status' => 0,
			'status_message' =>'No Records Found.'	);
	}
	else{
		$stock="";
		foreach ($result->result_array() as $key) {
			$stock=$key['instock_quantity'];
		}
		$response=array(
			'status' => 1,
			'status_message' => $stock);
	}
	return $response;
}
/*this fun ends here*/
}
?>	