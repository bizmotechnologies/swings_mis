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

        $this->load->model('inventory_model/ManageMaterial_model');
        $data['details'] = Manage_materials::getMaterialrecord();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/materials/manage_material', $data);
    }

    //---------this fun is used to add multiple products---------------//
    public function Add_MultipleProduct($data) {
        extract($data);
        //print_r($data);
        $Set_QuantityforHousing = 0;
        $housing_status = 0;
        $Prod_ID = 0;
        $Prod_OD = 0;
        $Prod_length = 0;
        $Prod_description = '';
        $product_arr = array();
        $material_Arr = array();
        $profile_arr = array();

        if (isset($Select_Profiles)) {
            for ($prod = 0; $prod < count($Select_Profiles); $prod++) {

                if (isset($checkHousing[$prod])) {
                    $housing_status = 1;
                    $Set_QuantityforHousing = $Set_QuantityforHousingChecked;

                    $Prod_ID = $ID_forHousingChecked;
                    $Prod_OD = $OD_forHousingChecked;
                    $Prod_length = $LENGTH_forHousingChecked;
                    $Prod_description = $profile_DescriptionForHousingChecked;
                } else {
                    $housing_status = 0;
                    $Set_QuantityforHousing = 0;
                    $Prod_ID = $ID_forHousingUnckecked;
                    $Prod_OD = $OD_forHousingUnckecked;
                    $Prod_length = $LENGTH_forHousingUnckecked;
                    $Prod_description = $profile_DescriptionForHousingUnchecked;
                }


                //print_r($data);
                for ($i = 0; $i < count($Select_material); $i++) {
                    $ID_arr = array();
                    $OD_arr = array();
                    $Length_arr = array();
                    foreach ($Select_ID as $ID) {
                        $ID_arr[] = $ID;
                    }
                    foreach ($Select_OD as $OD) {
                        $OD_arr[] = $OD;
                    }
                    foreach ($Select_Length as $Length) {
                        $Length_arr[] = $Length;
                    }

                    $material_Arr[] = array(
                        'material_id' => $Select_material[$i],
                        'Select_ID' => $ID_arr,
                        'Select_OD' => $OD_arr,
                        'Select_Length' => $Length_arr,
                        'base_Price' => $base_Price[$i],
                        'select_Quantity' => $select_Quantity[$i],
                        'discount' => $discount[$i],
                        'final_Price' => $final_Price[$i]
                    );
                }
                //print_r(json_encode($material_Arr));

                $profile_arr[] = array(
                    'customer_name' => $Select_Customers,
                    'product_name' => $product_nameForEnquiry[$prod],
                    'profile_id' => $Select_Profiles[$prod],
                    'housing_status' => $housing_status,
                    'profile_description' => $Prod_description,
                    'housing_setQuantity' => $Set_QuantityforHousing[$prod],
                    'Prod_ID' => $Prod_ID[$prod],
                    'Prod_OD' => $Prod_OD[$prod],
                    'Prod_length' => $Prod_length[$prod],
                    'material_associated' => $material_Arr,
                    'product_quantity' => $Product_Quantity[$prod],
                    'product_price' => $TotalProduct_Price[$prod]
                );
            }
        } else {
            $Select_Profiles = '';
        }
        $profile_arr[count($Select_Profiles)] = array(
            'product_name' => '',
            'profile_id' => '',
            'housing_status' => 0,
            'profile_description' => '',
            'housing_setQuantity' => 0,
            'Prod_ID' => '',
            'Prod_OD' => '',
            'Prod_length' => '',
            'material_associated' => array(
                'material_id' => '',
                'Select_ID' => '',
                'Select_OD' => '',
                'Select_Length' => '',
                'base_Price' => '',
                'select_Quantity' => '',
                'discount' => '',
                'final_Price' => ''),
            'product_quantity' => '',
            'product_price' => ''
        );

        return json_encode($profile_arr);
        //print_r(json_encode($profile_arr));
    }

    //---------this fun is used to add multiple products---------------//
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
    public function SaveProductsForEnquiry() {
        extract($_POST);
        $data = $_POST;
         print_r($data);die();
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/SaveProductsForEnquiry';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
    }

//------------this fun is used to get calculation of material base price-------------//
    public function GetMaterialBasePrice() {
        extract($_POST);
        $data = $_POST;
        // print_r($data);die();
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetMaterialBasePrice';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        echo $response;
        //print_r($response_json);
    }

//    -----------this fun is show fetched material info page


    public function fetchmaterial_details() {
        $data['info'] = Manage_materials::getRawMaterialInfo();     //-------show all Raw materials
        $data['materials'] = Manage_materials::getMaterialrecord();     //-------show all Raw materials
        $data['customers'] = Manage_materials::GetCustomersDetails();     //-------show all Customers
        $data['profiles'] = Manage_materials::GetProductProfileDetails();     //-------show all Product Profile
        $data['multiple_divs'] = Manage_materials::Add_MultipleProduct($_POST);     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/new/fetchmaterial_details', $data);
    }

    public function demo() {
        $data['info'] = Manage_materials::getRawMaterialInfo();     //-------show all Raw materials
        $data['materials'] = Manage_materials::getMaterialrecord();     //-------show all Raw materials
        $data['customers'] = Manage_materials::GetCustomersDetails();     //-------show all Customers
        $data['profiles'] = Manage_materials::GetProductProfileDetails();     //-------show all Product Profile
        $data['multiple_divs'] = Manage_materials::Add_MultipleProduct($_POST);     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/new/demo', $data);
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