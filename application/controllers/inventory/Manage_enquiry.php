<?php
error_reporting(E_ERROR | E_PARSE);

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
    //---this fun is used to get Available tube for product from raw material 

    public function showAvailable_Tube(){
       extract($_POST);
       //print_r($_POST);die();
       if(isset($MaterialID) && isset($MaterialOD) && isset($MaterialLength)  && $MaterialID[0] != ''){
            $Material_ID = min($MaterialID);
            $Material_OD = max($MaterialOD);
            $Material_LENGTH = max($MaterialLength);
            
            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/showAvailable_Tube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);
            //print_r($response_json);
            $length = min($response['length']);//----finding the minimum length for available tube
            $key = array_search($length, $response['length']);  //--finding tube id/od by using key index of length
            if($response['status']==0){
                echo 'N/A';
            }
            else{
            echo $response['tube'][$key]; //--returns the available tube for material
            }
        }
        else{
            echo 'N/A';
        }
    }
    //---this fun is used to get Available tube for product from raw material 
    //---this fun is used to get best tube for product from raw material 

    public function getBest_tube() {
        extract($_POST);
        //print_r($_POST);die();

        if(isset($MaterialID) && isset($MaterialOD) && isset($MaterialLength)){
            $Material_ID = min($MaterialID);
            $Material_OD = max($MaterialOD);
            $Material_LENGTH = max($MaterialLength);

            $Material_ID=$Material_ID - $ID_tolerance;//-----taking tolerance value into consideration
            $Material_OD=$Material_OD - $OD_tolerance;//-----taking tolerance value into consideration

            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/getBestTube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
            //echo $url;die();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);
            //print_r($response_json);die();
            if(empty($response['value'])){
                echo '<label>Best Tube: N/A</label>';
            }
            else{
            echo '<label>Available Tube: '.$response['value'].'</label>';
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
        //print_r($_POST);die();

        $Material_ID=0;
        $Material_OD=0;
        if(isset($Available_tube) && $Available_tube!='N/A' && isset($MaterialLength) && isset($Materialinfo)){

            $materialID_OD = explode("/", $Available_tube);            
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
    public function GetMaterialBasePrice_byBranchPrice(){
        extract($_POST);
        
//print_r($_POST);die();
        if(isset($branchprice) && $branchprice!=0 && isset($MaterialLength)){
           
            $Material_LENGTH = max($MaterialLength);
            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/GetMaterialBasePrice_byBranchPrice?branchprice='.$branchprice.'&Material_LENGTH='.$Material_LENGTH;
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
    //----this funis used to get value from table to perform bestprice calculations
}
