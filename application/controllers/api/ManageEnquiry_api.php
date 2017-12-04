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
}

?>