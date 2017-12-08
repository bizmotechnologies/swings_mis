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

        if(isset($MaterialID) && isset($MaterialOD) && isset($MaterialLength)){
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
            $response=json_decode($response_json, true);
            //print_r($response['value']);die();
            if(empty($response['value'])){
                echo 'N/A';
            }
            else{
            echo $response['value'];
            }
        }
        else{
            echo 'N/A';
        }
    }

//---this fun is used to get base price from raw material-----------------------//
//---this fun is used to get available tube from raw material-----------------//

    public function get_AvailableTube(){
        extract($_POST);
        //print_r($_POST);
        if(isset($MaterialID) && isset($MaterialOD)){
            $Material_ID = min($MaterialID);
            $Material_OD = max($MaterialOD);

            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/get_AvailableTube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            //print_r($response_json);
            if(empty($response) || $response['status_message'] == NULL){
                echo '<label>Available Tube: N/A</label>';
            }
            else{
            echo '<label>Available Tube: '.$response['status_message'].'</label>';
            }
        }
        else{
            echo '<label>Available Tube: N/A</label>';
        }
    }
//---this fun is used to get available tube from raw material-----------------------//

//------------this fun is used to get calculation of material base price-------------//
    public function GetMaterialBasePrice() {
        extract($_POST);
        $Material_ID=0;
        $Material_OD=0;

        if(isset($bestTube) && $bestTube!='N/A' && isset($MaterialLength) && isset($Materialinfo)){

            $materialID_OD = explode("/", $bestTube);            
            $Material_ID = $materialID_OD[0];
            $Material_OD = $materialID_OD[1];            
            $Material_LENGTH = max($MaterialLength);
            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/GetMaterialBasePrice?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
            //echo $url;die();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            echo $response_json;
        } else{
            echo '0.00';
        }
    }

//    -----------this fun is show fetched material info page
}
