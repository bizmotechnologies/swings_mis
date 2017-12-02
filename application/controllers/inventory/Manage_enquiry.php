<?php

class Manage_enquiry extends CI_controller {

    public function __construct() {
        parent::__construct();
//start session     
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $privilege = $this->session->userdata('privilege');

//check session variable set or not, otherwise logout
        if (($user_id == '') || ($user_name == '') || ($privilege == '')) {
            redirect('role_login');
        }
    }

    public function index() {
        
    }

//---this fun is used to get base price from raw material 
    public function getBest_tube() {
        extract($_POST);
        //print_r($_POST);die();
                if(isset($Material_ID) && isset($MaterialOD) && isset($MaterialLength)){

        $Material_ID = min($MaterialID);
        $Material_OD = max($MaterialOD);
        $Material_LENGTH = max($MaterialLength);

        $path = base_url();
        $url = $path . 'api/ManageEnquiry_api/getBestTube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        echo $response['value'];
    }
    else{
        echo 'N/A';
    }
    }

//---this fun is used to get base price from raw material
//------------this fun is used to get calculation of material base price-------------//
    public function GetMaterialBasePrice() {
        extract($_POST);
        //print_r($_POST);die();
        $Material_ID = min($MaterialID);
        $Material_OD = max($MaterialOD);
        $Material_LENGTH = max($MaterialLength);

        $path = base_url();
        $url = $path . 'api/ManageEnquiry_api/getBestTube?material_id='.$Materialinfo . '&Material_ID=' . $Material_ID . '&Material_OD=' . $Material_OD . '&Material_LENGTH=' . $Material_LENGTH;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        echo $response;
    }

//    -----------this fun is show fetched material info page
}
