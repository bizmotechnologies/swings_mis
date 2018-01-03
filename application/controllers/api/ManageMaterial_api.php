<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageMaterial_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inventory_model/ManageMaterial_model');
    }

    // ----------------------- SAVE MATERIAL API----------------------//
    //-------------------------------------------------------------//
    public function saveMaterial_post() {
        $data = $_POST;
        $response = $this->ManageMaterial_model->saveMaterial($data);
        return $this->response($response);
    }
    //---------------------SAVE MATERIAL API END------------------------------//

    // -----------------------GET ALL MATERIAL INFO API-----------------------------//
    //------------------------------------------------------------------------//
    public function getMaterialrecord_get() {
        $result = $this->ManageMaterial_model->getMaterialrecord();
        return $this->response($result);
    }
    //---------------------GET ALL MATERIAL INFO END------------------------------//

    // -----------------------GET FILTERED MATERIAL INFO API-----------------------------//
    //------------------------------------------------------------------------//
    public function getMaterialrecord_filter_get() {
        extract($_GET);
        $result = $this->ManageMaterial_model->getMaterialrecord_filter($material_id);
        return $this->response($result);
    }
    //---------------------GET FILTERED MATERIAL INFO END------------------------------//

    // -----------------------EDIT MATERIAL RECORD API----------------------//
    //-------------------------------------------------------------//
    public function updateRecord_post() {
        $data = $_POST;
        $new = $this->ManageMaterial_model->updateRecord($data);
        return $this->response($new);
    }

    //---------------------EDIT MATERIAL END------------------------------//
    // -----------------------DELETE MATERIAL API----------------------//
    public function deleteRecord_get() {
        $data = $_GET;
        $response = $this->ManageMaterial_model->deleteRecord($data);
        return $this->response($response);
    }

    //---------------------DELETE MATERIAL END------------------------------//
    // -----------------------GET ALL MATERIAL INFO API-----------------------------//
    //------------------------------------------------------------------------//
    public function getRawMaterialInfo_get() {
        $result = $this->ManageMaterial_model->getRawMaterialInfo();
        return $this->response($result);
    }

    //---------------------GET ALL MATERIAL INFO END------------------------------//
    //-----this fun is used to get material info----------------------------//
    public function GetMaterilaInformation_get() {
        $data = $_GET;
        $result = $this->ManageMaterial_model->GetMaterialInformation($data);
        return $this->response($result);
    }

    //-----this fun is used to get material info----------------------------//
//--------this fun is used to get material info-----------------------------------------//
    public function GetMaterialInformation_ForEnquiry_get() {
        $Select_material_1 = $_GET['Select_material_1'];
        $response = $this->ManageMaterial_model->GetMaterialInformation_ForEnquiry($Select_material_1);
        return $this->response($response);
    }

//--------this fun is used to get material info-----------------------------------------//
    //---------this fun is used to get customers details-------------------------//
    public function GetCustomersDetails_get() {
        $result = $this->ManageMaterial_model->GetCustomersDetails();
        return $this->response($result);
    }

//---------this fun is used to get customers details-------------------------//
    //-------------this fun is for get profile details---------------------//
    public function GetProductProfileDetails_get() {
        $result = $this->ManageMaterial_model->GetProductProfileDetails();
        return $this->response($result);
    }

    //-------------this fun is for get profile details---------------------//
    //------------this fun is used to get tube history for customers previous product----//
    public function GetTubeHistoryForInquiry_get() {
        $Customer_id = $_GET['Customer_id'];
        $Profile_id = $_GET['Profile_id'];
        $response = $this->ManageMaterial_model->GetTubeHistoryForInquiry($Customer_id, $Profile_id);
        return $this->response($response);
    }

    //------------this fun is used to get tube history for customers previous product----//
    public function GetProfileInformation_get() {
        $Profiles = $_GET['Profiles'];
        $response = $this->ManageMaterial_model->GetProfileInformation($Profiles);
        return $this->response($response);
    }

    //--------------this fun is used to get profile image-------------------//

    public function getprofileimage_get() {
        $Profiles = $_GET['Profiles'];
        $response = $this->ManageMaterial_model->getprofileimage($Profiles);
        return $this->response($response);
    }

    //--------------this fun is used to get profile image-------------------//
    //--------------this fun is used to get housing data-------------------//
    public function Get_housingData_get(){
        $Profiles = $_GET['profile_id'];
        $response = $this->ManageMaterial_model->Get_housingData($Profiles);
        return $this->response($response);
    }
    //--------------this fun is used to get housing data-------------------//
    //--------------this fun is used to get housing history data-------------------//
    public function gethousingHistory_get(){
        $Profiles = $_GET['Profiles'];
        $cusomer_id = $_GET['customer_id'];
        $response = $this->ManageMaterial_model->gethousingHistory($Profiles,$cusomer_id);
        return $this->response($response);
    }
    //--------------this fun is used to get housing history data-------------------//
    //--------------this fun is used to get material category details-------------------//
    public function getMaterialCategoryByCstomer_get() {
        $customer_id = $_GET['customer_id'];
        $response = $this->ManageMaterial_model->getMaterialCategoryByCstomer($customer_id);
        return $this->response($response);
    }
    //--------------this fun is used to get material category details-------------------//
    
}
