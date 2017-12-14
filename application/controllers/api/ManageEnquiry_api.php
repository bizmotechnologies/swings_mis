<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageEnquiry_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('inventory_model/ManageEnquiry_model');
    }

    public function getBestTube_get() {
        $material_id = $_GET['material_id'];
        $Material_ID = $_GET['Material_ID'];
        $Material_OD = $_GET['Material_OD'];
        $Material_LENGTH = $_GET['Material_LENGTH'];
        $response = $this->ManageEnquiry_model->getBest_tube($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        //print_r($_GET);
        return $this->response($response);
    }

    //-------------this fun is used to get material base price calculation--------------//
    public function GetMaterialBasePrice_get() {
        $material_id = $_GET['material_id'];
        $Material_ID = $_GET['Material_ID'];
        $Material_OD = $_GET['Material_OD'];
        $Material_LENGTH = $_GET['Material_LENGTH'];
        $response = $this->ManageEnquiry_model->GetMaterialBasePrice($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        return $this->response($response);
    }

    //-------------this fun is used to get material base price calculation--------------//

     // ----------------------- SAVE PRODUCTS API----------------------//
    //-------------------------------------------------------------//
    public function SaveProductsForEnquiry_post() {
        $data = $_POST;
        $response = $this->ManageEnquiry_model->saveProductForEnquiry($data);
        return $this->response($response);
    }

    //---------------------SAVE PRODUCTS API END------------------------------//
    //---------------------GET AVAILABLE TUBE FROM RAW MATERIAL------------------------------//
    public function get_AvailableTube_get(){
        $material_id = $_GET['material_id'];
        $Material_ID = $_GET['Material_ID'];
        $Material_OD = $_GET['Material_OD'];
        $response = $this->ManageEnquiry_model->get_AvailableTube($material_id, $Material_ID, $Material_OD);
        return $this->response($response);
    }
    //---------------------GET AVAILABLE TUBE FROM RAW MATERIAL------------------------------//
    //---------------------THIS FUN IS USED TO SAVE PROFILE DATA-----------------------------//
    public function SaveProfile_data_post(){
        $housingInfo = $_POST;
        $response = $this->ManageEnquiry_model->SaveProfile_data($housingInfo);
        return $this->response($response);
    }
    //---------------------THIS FUN IS USED TO SAVE PROFILE DATA-----------------------------//
    //---------------------THIS FUN IS USED TO GET AVAILABLE TUBE-----------------------------//
    public function showAvailable_Tube_get(){
        $material_id = $_GET['material_id'];
        $Material_ID = $_GET['Material_ID'];
        $Material_OD = $_GET['Material_OD'];
        $Material_LENGTH = $_GET['Material_LENGTH'];
        $response = $this->ManageEnquiry_model->showAvailable_Tube($material_id, $Material_ID, $Material_OD, $Material_LENGTH);
        return $this->response($response);
    }
    //---------------------THIS FUN IS USED TO GET AVAILABLE TUBE FROM RAW MATERIAL-----------------------------//
    public function getAvailableTubeFromAllBranches_get(){
        $material_id = $_GET['material_id'];
        $Material_ID = $_GET['material_ID'];
        $Material_OD = $_GET['material_OD'];
        $response = $this->ManageEnquiry_model->getAvailableTubeFromAllBranches($material_id, $Material_ID, $Material_OD);
        return $this->response($response);
    }
}

?>