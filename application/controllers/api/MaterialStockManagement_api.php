<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class MaterialStockManagement_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inventory_model/MaterialStockManagement_model');
    }

    // -----------------------GET ALL MATERIAL DETAILS API----------------------//
    //-------------------------------------------------------------//
    public function excelTodb_post() {
        $data=($_POST['excel_json']);
        $result = $this->MaterialStockManagement_model->Excelto_DB($data);
        return $this->response($result);
    }

    //---------------------GET ALL MATERIALS END------------------------------//

    // -----------------------GET ALL MATERIAL DETAILS API----------------------//
    //-------------------------------------------------------------//
    public function GetMaterialDetails_get() {
        
        $result = $this->MaterialStockManagement_model->GetMaterialDetails();
        return $this->response($result);
    }

    //---------------------GET ALL MATERIALS END------------------------------//
//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/

    public function GetVendorsDetails_get() {
        $result = $this->MaterialStockManagement_model->GetVendorsDetails();
        return $this->response($result);
    }

//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/
//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/

    public function Get_Purchase_Stock_get() {
        $result = $this->MaterialStockManagement_model->Get_Purchase_Stock();
        return $this->response($result);
    }

//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/
    // -----------------------UPDATE DETAILS FOR CUSTOMER API----------------------//
    //-----------------------------	--------------------------------//
    public function Update_CustomerDetails_post() {
        $data = $_POST;
        $result = $this->MaterialStockManagement_model->Update_CustomerDetails($data);
        return $this->response($result);
    }

    //---------------------UPDATE CUSTOMER DETAILS END------------------------------//
//---------------------API FOR SAVE FUNCTIONALITY API----------------------------//

    public function Save_RawStockMaterial_Info_post() {
        $data = $_POST;
        $response = $this->MaterialStockManagement_model->Save_RawStockMaterial_Info($data);
        return $this->response($response);
    }

//---------------------API FOR SAVE FUNCTIONALITY API----------------------------//
// -----------------------GET ALL RAW MATERIAL DETAILS API----------------------//
    public function GetRawMaterialInfoDetails_get() {
        $branch_name=$_GET['branch_name'];
        $result = $this->MaterialStockManagement_model->GetRawMaterialInfoDetails($branch_name);
        return $this->response($result);
    }

    //---------------------GET ALL RAW MATERIALS END------------------------------//
    //---------------------DELETE RAW MATERIALS ------------------------------//

    public function DeleteRawMaterialStockDetails_get() {
        $data = $_GET;
        $response = $this->MaterialStockManagement_model->DeleteRawMaterialStockDetails($data);
        return $this->response($response);
    }

    //---------------------DELETE RAW MATERIALS ----------------------------------------------//
    //---------------------Update RAW MATERIALS ----------------------------------------------//

    public function Update_UpdatedRawStockMaterial_Info_post() {

        $data = $_POST;
        $result = $this->MaterialStockManagement_model->Update_UpdatedRawStockMaterial_Info($data);
        return $this->response($result);
    }

    //---------------------Update RAW MATERIALS ----------------------------------------------//
//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/

    public function GetProductsName_get() {
        $result = $this->MaterialStockManagement_model->GetProductsName();
        return $this->response($result);
    }

//-----------------------------------THIS FUN FOR GET VENDOR DETAILS---------------------------------------------------/
//--------------------------------------PURCHASE PRODUCT API STARTS HERE-----------------------------------------------/
//--------------------------------------FUN SAVE PURCHSE PRODUCTS-----------------------------------------------/

    public function Save_PurchasedProduct_Info_post() {
        $data = $_POST;
        $response = $this->MaterialStockManagement_model->Save_PurchasedProduct_Info($data);
        return $this->response($response);
    }

//--------------------------------------FUN SAVE PURCHASED PRODUCTS-----------------------------------------------/
//--------------------------------------FUN GET PURCHASED PRODUCTS INFORMATION-----------------------------------------------/
    public function GetPurchaseProductsName_get() {
        $result = $this->MaterialStockManagement_model->GetPurchaseProductsName();
        return $this->response($result);
    }

//--------------------------------------FUN GET PURCHASED PRODUCTS INFO ENDS HERE-----------------------------------------------/


    public function Update_purchasedproducts_Info_post() {

        $data = $_POST;
        $result = $this->MaterialStockManagement_model->Update_purchasedproducts_Info($data);
        return $this->response($result);
    }

//---------------------- this fun is used to update purchased products-----------------------//
//---------------------- this fun is used to Delete purchased products-----------------------//
    public function DeletePurchasedStockDetails_get() {

        $data = $_GET;
        $response = $this->MaterialStockManagement_model->DeletePurchasedStockDetails($data);
        return $this->response($response);
    }
//---------------------- this fun is used to Delete purchased products-----------------------//
//---------------------- this fun is used to save purchased products-----------------------//

    public function Save_FinishedProduct_Info_post() {
        $data = $_POST;
        $response = $this->MaterialStockManagement_model->Save_FinishedProduct_Info($data);
        return $this->response($response);
    }
//---------------------- this fun is used to save finished products-----------------------//
//---------------------- this fun is used to get finished products details-----------------------//

    public function GetFinishedInformationDetails_get() {
        $result = $this->MaterialStockManagement_model->GetFinishedInformationDetails();
        return $this->response($result);
    }
//---------------------- this fun is used to get finished products details-----------------------//
//---------------------- this fun is used to update finished products details-----------------------//

    public function Update_Finishedproducts_Info_post() {
        $data = $_POST;
        $result = $this->MaterialStockManagement_model->Update_Finishedproducts_Info($data);
        return $this->response($result);
    }
//---------------------- this fun is used to update finished products details-----------------------//
//---------------------- this fun is used to Delete finished products details-----------------------//

    public function DeleteFinishedProductDetails_get() {
        $data = $_GET;
        $response = $this->MaterialStockManagement_model->DeleteFinishedProductDetails($data);
        return $this->response($response);
    }
//---------------------- this fun is used to Delete finished products details-----------------------//
//---------------------- this fun is used to get price from price list-----------------------//

    public function GetPriceFromPriceList_post() {
        $data = $_POST;
        $response = $this->MaterialStockManagement_model->GetPriceFromPriceList($data);
        return $this->response($response);
    }
    //---------------------- this fun is used to get price from price list-----------------------//
//---------------------- this fun is used to save material category in material category table-----------------------//

    public function saveMaterialCategory_post(){
        $data = $_POST;
        $response = $this->MaterialStockManagement_model->saveMaterialCategory($data);
        return $this->response($response);
    }
    //---------------------- this fun is used to save material category in material category table-----------------------//
//----this fun is used to showing material category-------------------------------------------//
    public function showmaterialCategory_get(){
        $material_id = $_GET['material_id'];
        $response = $this->MaterialStockManagement_model->showmaterialCategory($material_id);
        return $this->response($response);        
    }
}
