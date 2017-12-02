<?php

error_reporting(E_ERROR | E_PARSE);

class MaterialStockManagement_model extends CI_Model {

    public function GetPriceFromPriceList($data) {
        extract($data);
        $sql = "SELECT material_price FROM raw_materialstock WHERE material_id ='$Select_Materials_Id' "
                . "AND vendor_id ='$Select_RawVendors_Id' "
                . "AND raw_ID ='$Input_RawMaterialStock_ID' "
                . "AND raw_OD ='$Input_RawMaterialStock_OD'";
        $resultnew = $this->db->query($sql);
        $material_price = '0.00';

        foreach ($resultnew->result_array() as $row) {
            $material_price = $row['material_price'];
        }
        return $material_price;
    }

    /* --------------this fun is used to get material details--------------------------------------------------------- */

    public function GetMaterialDetails() {

        $query = "SELECT * FROM materials";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = $result->result_array();
        }

        return $response;
    }

    /* --------------------------this getmaterialdeaails fun ends here----------------------------------------------- */

    /* --------------this fun is used to get Finished Product details--------------------------------------------------------- */

    public function GetFinishedInformationDetails() {

        $query = "SELECT * FROM finished_products";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }

        return $response;
    }

    /* ----------------------this Finished Products details fun ends here------------------------------------------------------ */

    /* ---------------------------this fun is used to get raw material details------------------------------------------------ */

    public function GetRawMaterialInfoDetails() {

        $query = "SELECT * FROM raw_materialstock";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }

        return $response;
    }

    /* -----------------------------this get raw material details fun ends here-------------------------------------- */

    /* ------------------------------this fun is for get all vendor details--------------------------------------------- */

    public function GetVendorsDetails() {

        $query = "SELECT * FROM vendor_details";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = $result->result_array();
        }

        return $response;
    }

    /* --------------------------------this vendor details fun ends here-------------------------------------------------- */
    /* ----------------------------this fun is used to get all product details-------------------------------------------- */

    public function GetProductsName() {

        $query = "SELECT * FROM products";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = $result->result_array();
        }

        return $response;
    }

    /* -------------------------------fun getproduct name is ends here--------------------------------------------------------------- */
    /* ---------------------------------this fun is for get purchase product info----------------------------------------------- */

    public function GetPurchaseProductsName() {
        $query = "SELECT * FROM purchase_productstock";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }

        return $response;
    }

    /* --------------------------this fun is for get purchase product info ends here----------------------------------------------- */

    //---------------------------this fun Starts here for delete raw material----------------------------------------------\\
    public function DeleteRawMaterialStockDetails($data) {
        extract($data);
        //print_r($data);die();
        $sqldelete = "DELETE FROM raw_materialstock WHERE rawmaterial_id = '$rawmaterial_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($resultdelete) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted Successfully...!');
        }
        return $response;
    }

    //---------------------------this fun ends here for delete raw material----------------------------------------------\\

    /* --------------------------this fun for save raw material details----------------------------------------------- */
    public function Save_RawStockMaterial_Info($data) {
        extract($data);
        
        $this->load->model('inventory_model/ManageMaterial_model');
        $material_name = $this->ManageMaterial_model->getMaterialdata($Select_RawMaterials);

        $sqlnew = "INSERT INTO raw_materialstock(material_id,vendor_id,material_name,raw_ID,"
                . "raw_OD,avail_length,raw_quantity,material_price,tolerance,accepted_date)"
                . " values ('$Select_RawMaterials','$Select_RawVendors_Id',"
                . "'$material_name','$Input_RawMaterialStock_ID',"
                . "'$Input_RawMaterialStock_OD','$Input_RawMaterialLength',"
                . "'$Input_RawMaterialNewQuantity','$price','$Input_RawMaterialTolerance',now())";
        //echo $sqlnew;die();
        $resultnew = $this->db->query($sqlnew);

        if ($resultnew) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Inserted Successfully...!');
        }
        return $response;
    }

    /* ---------------------------------------------Save Raw material info fun ends here-------------------------------- */

    /* -----------------------------------Save Finished products info fun is Starts here-------------------------------- */

    public function Save_FinishedProduct_Info($data) {

        extract($_POST);
        $data = $_POST;
        //print_r($data);
        $product_name = MaterialStockManagement_model::getproductdata($Select_PurchasedProduct_Id);
        //print_r($product_name);
        $sqlnew = "INSERT INTO finished_products(product_id,product_name,
			fproduct_ID,fproduct_OD,
			fproduct_length,fproduct_quantity,accepted_date) 
		VALUES ('$Select_PurchasedProduct_Id','$product_name',
			'$Input_Finished_Product_ID','$Input_Finished_Product_OD',
			'$Input_Finished_Product_Thickness','$Input_Finished_Product_Quantity',now())";
        //echo $sqlnew;die();
        $resultnew = $this->db->query($sqlnew);

        if ($resultnew) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Inserted Successfully...!');
        }
        return $response;
    }

    /* ----------------------Save Finished Product info fun is ends here-------------------------------- */

    /* ----------------------Save purchased Product info fun is Starts here-------------------------------- */

    public function Save_PurchasedProduct_Info($data) {

        extract($_POST);
        $data = $_POST;

        $product_name = MaterialStockManagement_model::getproductdata($Select_PurchasedProduct_Id);
        //print_r($product_name);
        $sqlnew = "INSERT INTO purchase_productstock(product_id,product_name,
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
        $resultnew = $this->db->query($sqlnew);

        if ($resultnew) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Inserted Successfully...!');
        }
        return $response;
    }

    /* ----------------------Save purcshase Product info fun is ends here-------------------------------- */

//--------------------/*this fun is used to get product name for save products*/---------------------------
    public function getproductdata($id) {
        $sql = "SELECT product_name FROM products WHERE product_id='$id'";
        $resultnew = $this->db->query($sql);

        $product_name = "";

        foreach ($resultnew->result_array() as $row) {
            $product_name = $row['product_name'];
        }
        return $product_name;
    }

//-------------------------/*this fun is used to get product name for save products ends here-------------------------*/
    /* --------------------------this fun is used to update raw material stock info-------------------------------------- */
    public function Update_UpdatedRawStockMaterial_Info($data) {

        extract($data);

        $this->load->model('inventory_model/ManageProduct_model');
        $material_name = $this->ManageProduct_model->getMaterialdata($Select_RawMaterials_Id);

        $sql = "UPDATE raw_materialstock SET rawmaterial_id = '$rawmaterial_id',
		material_id = '$Select_RawMaterials_Id', vendor_id = '$Select_RawVendor_Id',
		material_name = '$material_name', raw_ID = '$Updated_MaterialStock_OD',
		raw_OD = '$Updated_MaterialStock_OD',avail_length = '$Updated_MaterialLength',
		raw_quantity = '$Updated_MaterialNewQuantity',tolerance ='$Updated_RawMaterialTolerance' WHERE rawmaterial_id = '$rawmaterial_id'";
        //echo $sql; die();
        $resultUpadate = $this->db->query($sql);

        if ($resultUpadate) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
    }

    /* ----------------------this fun is used to update raw material info ends here------------------------------------- */
    /* ----------------------update finished stock material info fun is starts here------------------------------------------------ */

    public function Update_Finishedproducts_Info($data) {

        extract($data);

        $product_name = MaterialStockManagement_model::getproductdata($Select_UpdatedFinished_product_Id);

        $sql = "UPDATE finished_products SET product_id = '$Select_UpdatedFinished_product_Id',
		product_name = '$product_name',
		fproduct_ID = '$Updated_FinishedProduct_ID',
		fproduct_OD = '$Updated_FinishedProduct_OD',
		fproduct_length = '$Updated_FinishedProductLength',
		fproduct_quantity = '$Updated_FinishedProductQuantity' WHERE finished_product_id = '$finished_product_id'";
        //echo $sql; die();
        $resultUpadate = $this->db->query($sql);

        if ($resultUpadate) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
    }

    /* -----------------------------------update finished product fun ends here-------------------------------------------- */

    public function DeleteFinishedProductDetails($data) {
        extract($data);
        //print_r($data);die();
        $sqldelete = "DELETE FROM finished_products WHERE finished_product_id = '$finished_product_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($resultdelete) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted Successfully...!');
        }
        return $response;
    }

    /* ---------------------------- this getreceived stock fun is used to get alll stock details---------------------------- */

    public function Get_Purchase_Stock() {
        $query = "SELECT * FROM purchase_productstock";
        $result = $this->db->query($query);
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => '');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }

        return $response;
    }

    /* --------------------------this getreceivedstock ends here------------------------------------- */

    public function Update_purchasedproducts_Info($data) {

        extract($data);
        //print_r($data);
        $product_name = MaterialStockManagement_model::getproductdata($Select_UpdatedPurchased_Id);

        $sql = "UPDATE purchase_productstock SET product_id = '$Select_UpdatedPurchased_Id',
		vendor_id = '$Select_UpdatedVendor_Id', product_name = '$product_name', 
		stock_id = '$Updated_PurchasedStock_ID', stock_od = '$Updated_purchasedStock_OD', 
		length = '$Updated_purchasedLength', quantity = '$Updated_PurchasedNewQuantity',
		purchase_price = '$input_updatedpriceForPurchase',purchase_discount = '$Input_PurchasedDiscount',
		purchase_currency = '$Select_UpdatedpurchasedCurrency', price_in_rs = '$Input_UpdatedPurchased_Price' 
		WHERE purchased_product_id = '$purchased_product_id'";
        //echo $sql; die();
        $resultUpadate = $this->db->query($sql);

        if ($resultUpadate) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
    }

    public function DeletePurchasedStockDetails($data) {
        extract($data);
        //print_r($data);die();
        $sqldelete = "DELETE FROM purchase_productstock WHERE purchased_product_id = '$purchased_product_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($resultdelete) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted Successfully...!');
        }
        return $response;
    }

    /* --------- */
    /* -----------------------------this fun is used to get instock quantity for materials---------------------------------- */

    public function showMaterial($data) {

        extract($data);
        //print_r($data);die();
        $sqlselect = "SELECT instock_quantity FROM materials WHERE material_id = '$Select_Materials_Id'";
        $result = $this->db->query($sqlselect);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $stock = "";
            foreach ($result->result_array() as $key) {
                $stock = $key['instock_quantity'];
            }
            $response = array(
                'status' => 1,
                'status_message' => $stock);
        }
        return $response;
    }

    /* this fun ends here */
}

?>	