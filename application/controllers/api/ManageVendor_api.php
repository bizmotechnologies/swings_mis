<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageVendor_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inventory_model/VendorManagement_model');
    }

    // -----------------------ADD VENDERS INFO API----------------------//
    //-------------------------------------------------------------//
    public function save_VendorDetails_post() {
        $data = $_POST;
        $result = $this->VendorManagement_model->save_VendorDetails($data);
        return $this->response($result);
    }

    //---------------------ADD VENDERS INFO END------------------------------//
    // -----------------------GET ALL VENDOR DETAILS API----------------------//
    //-------------------------------------------------------------//
    public function GetAllVendorDetails_get() {
        $response = $this->VendorManagement_model->GetAllVendorDetails();
        return $this->response($response);
    }

    //---------------------GET ALL VENDOR DETAILS END------------------------------//
    // -----------------------UPDATE VENDERS API----------------------//
    //-------------------------------------------------------------//
    public function Update_VendorDetails_post() {
        $data = $_POST;
        $result = $this->VendorManagement_model->Update_VendorDetails($data);
        return $this->response($result);
    }

    //---------------------UPDATE ROLE END------------------------------//
// -----------------------DELETE CUSTOMER API----------------------//
    //-------------------------------------------------------------//
    public function DeleteVendorDetails_get() {
        $data = $_GET;
        $response = $this->VendorManagement_model->DeleteVendorDetails($data);
        return $this->response($response);
    }

    //---------------------DELETE CUSTOMER END------------------------------//
}
