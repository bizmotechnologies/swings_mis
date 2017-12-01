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
    public function GetRawMaterialBasePriceForEnquiry() {
        $Material_id = 30;
        $MaterialID = array("20", "20", "20", "20", "20", "20");
        $MaterialOD = array("20", "20", "20", "5", "20", "20");
        $MaterialLENGTH = array("1", "1", "1", "5", "4", "7");
        $Material_ID = min($MaterialID);
        $Material_OD = max($MaterialOD);
        $Material_LENGTH = max($MaterialLENGTH);
        
        $path = base_url();
        $url = $path.'api/ManageEnquiry_api/GetRawMaterialBasePriceForEnquiry?material_id='.$Material_id.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);
    }

//---this fun is used to get base price from raw material
}
