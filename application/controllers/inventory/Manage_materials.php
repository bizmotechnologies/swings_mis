<?php

class Manage_materials extends CI_controller {

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
        //$this->load->helper('url');
        $this->load->model('inventory_model/ManageMaterial_model');
        $data['details'] = Manage_materials::getMaterialrecord();     //-------show all materials

        $this->load->view('includes/navigation');
        $this->load->view('inventory/materials/manage_material', $data);
    }

    //--------this fun is uded to get all values of material----------// 
    public function GetMaterialInformation_ForEnquiry() {
        extract($_POST);
        //print_r($_POST);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetMaterialInformation_ForEnquiry?Select_material_1=' . $Materialinfo;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response);
        //echo ($response_json);
    }

    //--------this fun is uded to get all values of material----------// 
//------------this fun is used to get calculation of material base price-------------//
    public function GetMaterialBasePrice() {
        extract($_POST);
        $data = $_POST;
        //print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetMaterialBasePrice';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        echo $response_json;
        //print_r($response_json);
    }

//    -----------this fun is show fetched material info page
//--------this fun is used to get final price for material-------//
    public function GetFinalriceForMaterialCalculation() {
        extract($_POST);
        $data = $_POST;
        print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetFinalriceForMaterialCalculation';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);
        echo $response;
    }

//--------this fun is used to get final price for material-------//

    public function fetchmaterial_details() {
        $data['info'] = Manage_materials::getRawMaterialInfo();     //-------show all Raw materials
        $data['customers'] = Manage_materials::GetCustomersDetails();     //-------show all Customers
        $data['profiles'] = Manage_materials::GetProductProfileDetails();     //-------show all Product Profile
        $this->load->view('includes/navigation');
        $this->load->view('inventory/new/fetchmaterial_details', $data);
    }

//    -----------this fun is show fetched material info page
    //---------this fun is used to get tube history for customer------------
    public function GetTubeHistoryForInquiry() {
        extract($_POST);
        $data = $_POST;
        //print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetTubeHistoryForInquiry?Customer_id=' . $Customer_id . '&Profile_id=' . $Profile_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response);
    }

    //---------this fun is used to get tube history for customer------------
//----------this fun for to get customer details-----------------------------
    public function GetCustomersDetails() {

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetCustomersDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//----------------this fun is for get customers details---------------//
//----------this fun for to get profile details-----------------------------
    public function GetProductProfileDetails() {

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetProductProfileDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//----------------this fun is for get profile details---------------//
//----this function is used to update material details-----//
    public function Update() {
        extract($_POST);
        $data = $_POST;

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/updateRecord';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json); die();	
        redirect('inventory/manage_materials');
    }

    //---------------this function is used to update material details---------------//

    public function add_material() {
        $this->load->view('includes/navigation');
        $this->load->view('inventory/materials/add_material');
    }

//--- this function is used to save material details------
//----------this fun for toget material details-----------------------------
    public function getMaterialrecord() {

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getMaterialrecord';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//----------------this fun is for get total info of materials---------------//
//----------this fun for toget material details-----------------------------
    public function getRawMaterialInfo() {

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getRawMaterialInfo';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

//----------------this fun is for get total info of materials---------------//
//---------this fun is used to show raw material information------//
    function GetMaterilaInformation() { //this api is used for to get all info of raw materials 
        extract($_POST);
        $data = $_POST;
        print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetMaterilaInformation?material_id=';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
    }

//---------this fun is used to show raw material information------//


    public function saveMaterial() {
        extract($_POST);
        $data = $_POST;

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/saveMaterial';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        if ($response['status'] == 0) {
            echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    <script>
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
      window.location.reload();
  }, 1000);
  </script>';
        } else {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    <script>
    window.setTimeout(function() {
       $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
      window.location.reload();
  }, 1000);
  </script>';
        }
    }

    //--- this function is used to save material details------
// ---- this function is used to delete material details-------

    public function Delete() {

        extract($_GET);
        $data = $_GET;

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/deleteRecord?material_id=' . $material_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        redirect('inventory/manage_materials');
    }

// ---- this function is used to delete material details-------
}

?>