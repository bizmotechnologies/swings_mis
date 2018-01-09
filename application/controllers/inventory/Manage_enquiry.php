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
        
        $Material_ID=$Material_ID - $ID_tolerance;//-----taking tolerance value into consideration
        $Material_OD=$Material_OD + $OD_tolerance;//-----taking tolerance value into consideration

        
        $path = base_url();
        $url = $path . 'api/ManageEnquiry_api/showAvailable_Tube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH;
        //echo $url;        die();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
            //print_r($response_json);die();

        if($response['status']==0){
            //echo 'N/A';
            $tubeArr= array(
                'avail_tube' => 'N/A',
                'new_length' => 'N/A'
            );
            $response = json_encode($tubeArr);
            echo $response;
        }
        else{
            $new_length = '';
            $avail_tube = '';
            $length = min($response['length']);//----finding the minimum length for available tube
            $key = array_search($length, $response['length']);  //--finding tube id/od by using key index of length
            $tube = $response['tube'][$key]; //--returns the available tube for material
            $tubeArr= array(
                'avail_tube' => $tube,
                'new_length' => $length
            );
            $response = json_encode($tubeArr);
            echo $response;
        }
    }
    else{
        $tubeArr= array(
                'avail_tube' => 'N/A',
                'new_length' => 'N/A'
            );
            $response = json_encode($tubeArr);
            echo $response;
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
            $Material_OD=$Material_OD + $OD_tolerance;//-----taking tolerance value into consideration

            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/getBestTube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH.'&MaterialCategory='.$MaterialCategory;
            //echo $url;die();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);
            //print_r($response_json);die();
            if(empty($response['value'])){
                echo '<b><span class="w3-small"><span class="w3-text-red">Best Tube:</span> N/A</span><span class="w3-small w3-margin-left"><span class="w3-text-red">Best Price:</span> N/A</span></b>';
            }
            else{
                echo '<b><span class="w3-small"><span class="w3-text-red">Best Tube:</span> '.$response['value'].'</span><span class="w3-small w3-margin-left"><span class="w3-text-red">Best Price:</span> '.$response['best_price'].' <i class="fa fa-inr"></i></span></b>';
            }
        }
        else{
            echo '<b><span class="w3-small"><span class="w3-text-red">Best Tube:</span> N/A</span><span class="w3-small w3-margin-left"><span class="w3-text-red">Best Price:</span> N/A</span></b>';
        }
    }

//---this fun is used to get base price from raw material-----------------------//
//---this fun is used to get available tube from raw material-----------------//

    // public function get_AvailableTube(){
    //     extract($_POST);
    //     //print_r($_POST);
    //     if(isset($MaterialID) && isset($MaterialOD)){
    //         $Material_ID = min($MaterialID);
    //         $Material_OD = max($MaterialOD);

    //         $path = base_url();
    //         $url = $path . 'api/ManageEnquiry_api/get_AvailableTube?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD;
    //         $ch = curl_init($url);
    //         curl_setopt($ch, CURLOPT_HTTPGET, true);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         $response_json = curl_exec($ch);
    //         curl_close($ch);
    //         $response = json_decode($response_json, true);
    //         //print_r($response_json);
    //         if(empty($response) || $response['status_message'] == NULL){
    //             echo '<label>Available Tube: N/A</label>';
    //         }
    //         else{
    //             echo '<label>Available Tube: '.$response['status_message'].'</label>';
    //         }
    //     }
    //     else{
    //         echo '<label>Available Tube: N/A</label>';
    //     }
    // }
//---this fun is used to get available tube from raw material-----------------------//

//------------this fun is used to get calculation of material base price-------------//
    public function GetMaterialBasePrice() {
        extract($_POST);

        $Material_ID=0;
        $Material_OD=0;
        if(isset($Available_tube) && $Available_tube!='N/A' && isset($MaterialLength) && isset($Materialinfo)){

            $materialID_OD = explode("/", $Available_tube);            
            $Material_ID = $materialID_OD[0];
            $Material_OD = $materialID_OD[1];            
            $Material_LENGTH = max($MaterialLength);
            $path = base_url();
            $url = $path . 'api/ManageEnquiry_api/GetMaterialBasePrice?material_id='.$Materialinfo.'&Material_ID='.$Material_ID.'&Material_OD='.$Material_OD.'&Material_LENGTH='.$Material_LENGTH.'&MaterialCategory='.$MaterialCategory;
            //echo $url;die();
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response_json, true);
            echo ($response);
        } else{
            echo '0.00';
        }
    }

//    -----------this fun is show fetched material info page
    public function GetMaterialBasePrice_byBranchPrice(){
        extract($_POST);
        
        if(isset($Available_tube) && $Available_tube!='N/A' && isset($branchprice) && $branchprice!=0){           
            echo ($branchprice);
        } else{
            echo '0.00';
        }
    }
    //----this funis used to get value from table to perform bestprice calculations
}
