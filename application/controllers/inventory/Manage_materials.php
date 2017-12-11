<?php
error_reporting(E_ERROR | E_PARSE);

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

//--------this fun is used to get all values of material----------// 
//--------this fun is used to get all information of Profile----------// 
    public function GetProfileInformation() {
        $profileinfo = Manage_materials::GetProductProfileDetails();     //-------show all Product Profile
        $materials = Manage_materials::getMaterialrecord();     //-------show all Raw materials

        extract($_POST);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetProfileInformation?Profiles='.$Profiles;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response['status_message']);die(); 
        if ($response['status'] == 1) {
            //for ($i = 0; $i < count($response['status_message']); $i++) {

                $material_associated = json_decode($response['status_message'][0]['material_associated'], TRUE);
               
                echo '<div class="w3-col l12 w3-tiny"><span class="w3-text-red"><b>NOTE:</b> Input Fields which are disabled (marked in grey and default set to 0) are N/A for the respective material. Only fill enabled input fields</span></div>';

                       $count=0;

                foreach ($material_associated as $key) {

                    echo'<div class="w3-col l12 w3-tiny w3-margin-top" id="Div_no_'.$Profile_num.'_'.$count.'">
                    <div class="w3-col l2">';
                    echo'<label>MATERIAL</label>';
                    echo'<input autocomplete="off" list="Materialinfo_'.$Profile_num.'_'.$count.'" value="'.$key['material_name'].'" id="Select_material_'.$Profile_num.'_'.$count.'" name="Select_material[]" class="w3-input" required type="text" placeholder="Material" onchange="get_AvailableTube('.$Profile_num.','.$count.');">';

                    echo'<datalist id="Materialinfo_'.$Profile_num.'_'.$count.'">';
                    foreach ($materials['status_message'] as $result) {
                        echo'<option data-value = "'.$result['material_id'].'" value = "'.$result['material_name'].'"></option>';
                    }
                    echo'</datalist>
                    </div>
                    <div class="w3-col l3">
                    <div class="w3-col l4 s4 w3-padding-left">';

                    if($key['ID_quantity']==0){                        
                        $disabled='readonly';
                        $value='0';
                        echo'<label>ID</label>
                        <input value="'.$value.'" name="Select_ID['.$Profile_num.'][]" class="w3-input w3-light-grey" required type="text" min="0" placeholder="ID" '.$disabled.'>';
                    }
                    for ($j = 0; $j < $key['ID_quantity']; $j++) {

                        echo'<label>ID</label>
                        <input list="MaterialID_'.$Profile_num.'_'.$count.'_'.$j.'" value="" id="Select_ID_'.$Profile_num.'_'.$count.'_'.$j.'" name="Select_ID['.$Profile_num.'][]" class="w3-input" required type="text" min="0" placeholder="ID">
                        <datalist id="MaterialID_'.$Profile_num.'_'.$count.'_'.$j.'">
                        </datalist>';

                    }
                    echo'</div>
                    <div class="w3-col l4 s4 w3-padding-left">';

                    if($key['OD_quantity']==0){                        
                        $disabled='readonly';
                        $value='0';
                        echo'<label>OD</label>
                        <input value="'.$value.'" name="Select_OD['.$Profile_num.'][]" class="w3-input w3-light-grey" required type="text" min="0" placeholder="OD" '.$disabled.'>';
                    }
                    for ($k = 0; $k < $key['OD_quantity']; $k++) {

                        echo'<label>OD</label>
                        <input list="MaterialOD_'.$Profile_num.'_'.$count.'_'.$k.'" value="" id="Select_OD_'.$Profile_num.'_'.$count.'_'.$k.'" name="Select_OD['.$Profile_num.'][]" class="w3-input" required type="text" min="0" placeholder="OD">
                        <datalist id="MaterialOD_'.$Profile_num.'_'.$count.'_'.$k.'">
                        </datalist>';
                    }
                    echo'</div>
                    <div class="w3-col l4 s4 w3-padding-left" >';

                    if($key['length_quantity']==0){                        
                        $disabled='readonly';
                        $value='0';
                        echo'<label>Length</label>
                        <input value="'.$value.'" name="Select_Length['.$Profile_num.'][]" class="w3-input w3-light-grey" required type="text" min="0" placeholder="Length" '.$disabled.'>';
                    }
                    for ($l = 0; $l < $key['length_quantity']; $l++) {

                        echo'<label>LENGTH</label>
                        <input list="MaterialLength_'.$Profile_num.'_'.$count.'_'.$l.'" value="" id="Select_Length_'.$Profile_num.'_'.$count.'_'.$l.'" name="Select_Length['.$Profile_num.'][]" class="w3-input" required type="text" min="0" placeholder="Length" onkeyup="get_AvailableTube('.$Profile_num.','.$count.');">
                        <datalist id="MaterialLength_'.$Profile_num.'_'.$count.'_'.$l.'">
                        </datalist>';
                    }
                    echo'</div>
                    </div>
                    <div class="w3-col l1 w3-padding-left">
                    <label>BEST TUBE</label>&nbsp;<a class="btn w3-red" style="padding:0 2px 0 2px;" onclick="getBest_tube('.$Profile_num.','.$count.');"><i class="fa fa-refresh w3-small"></i></a>
                    <input id="bestTube_'.$Profile_num.'_'.$count.'" name="best_tube[]" value="" class="w3-input" required type="text" placeholder="ID/OD" readonly>
                    </div>
                    <div class="w3-col l2 w3-padding-left">
                    <label>BASE PRICE</label><input id="base_Price_'.$Profile_num.'_'.$count.'" name="base_Price[]" value="" class="w3-input" min="0" step="0.01" required type="number" placeholder="Base Price"  onfocus="GetMaterialBasePrice('.$Profile_num.','.$count.');">
                    </div>
                    <div class="w3-col l1 w3-padding-left">
                    <label>QUANTITY</label>
                    <input id="select_Quantity_'.$Profile_num.'_'.$count.'" name="select_Quantity[]" value="" class="w3-input" min="0" required type="number" placeholder="Quantity" onkeypress="GetFinalPriceForMaterialCalculation('.$Profile_num.','.$count.');">
                    </div>
                    <div class="w3-col l1 w3-padding-left">
                    <label>DISCOUNT(%)</label>
                    <input id="discount_'.$Profile_num.'_'.$count.'" name="discount[]" class="w3-input" required type="number" min="0" step="0.01" placeholder="Discount %." onkeypress="GetFinalPriceForMaterialCalculation('.$Profile_num.','.$count.');">
                    </div>
                    <div class="w3-col l2 w3-padding-left">
                    <label>FINAL&nbsp;PRICE</label>
                    <input id="final_Price_'.$Profile_num.'_'.$count.'" name="final_Price[]" class="w3-input" required type="number" min="0" step="0.01" placeholder="Final Price" onfocus="GetFinalPriceForMaterialCalculation('.$Profile_num.','.$count.');">
                    </div>

                    <div class="w3-col l12" id="best_tubeError_'.$Profile_num.'_'.$count.'">
                    
                    </div>
                    <div class="w3-col l2 w3-margin-top" id="available_tube_'.$Profile_num.'_'.$count.'">                     
                    </div>
                    </div>

                    ';
                    $count=$count+1;
                    
                }
            //}
        }
    }
    
    //--------------this fun is used to get profile image-------------------//

    public function getprofileimage(){
        extract($_POST);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/getprofileimage?Profiles='.$Profiles;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        echo $response;
    }
    //--------------this fun is used to get profile image-------------------//

        public function SaveProductsForEnquiry() {
        //$data = $_POST;
        //print_r($data);die();
        extract($_POST);

        if(!isset($Select_Profiles)){
            echo 'Add at least 1 Product in Enquiry';
            die();
        }
        $Set_QuantityforHousing = 0;
        $housing_status = 0;
        $Prod_ID = 0;
        $Prod_OD = 0;
        $Prod_length = 0;
        $Prod_description = '';
        $product_arr = array();
        $material_Arr = array();
        $profile_arr = array();
        $HousingArr = array();
        $housingInfo = '';
        
        //print_r($LENGTH_forHousingChecked);die();
        for ($prod = 0; $prod < count($Select_Profiles); $prod++) {
            
            if (isset($checkHousing[$prod])) {
                $housing_status = 1;
                $Prod_ID = $ID_forHousingUnckecked;
                $Prod_OD = $OD_forHousingUnckecked;
                $Prod_length = $LENGTH_forHousingUnckecked;
                $Prod_description = $profile_DescriptionForHousingUnchecked;
            } else {
                $housing_status = 0;
                $Prod_ID = $ID_forHousingUnckecked;
                $Prod_OD = $OD_forHousingUnckecked;
                $Prod_length = $LENGTH_forHousingUnckecked;
                $Prod_description = $profile_DescriptionForHousingUnchecked;
            }
            for ($i = 0; $i < count($Select_material); $i++) {
                $ID_arr = array();
                $OD_arr = array();
                $Length_arr = array();
                
                foreach ($Select_ID as $ID) {
                 $multiple_ID = array();
                 foreach ($ID as $key) {
                    $multiple_ID[]=$key;
                }
                $ID_arr[] = $multiple_ID;
            }

            foreach ($Select_OD as $OD) {
             $multiple_OD = array();
             foreach ($OD as $key) {
                $multiple_OD[]=$key;
            }
            $OD_arr[] = $multiple_OD;
        }
        foreach ($Select_Length as $Length) {
         $multiple_Length = array();
         foreach ($Length as $key) {
            $multiple_Length[]=$key;
        }
        $Length_arr[] = $multiple_Length;
    }

    $material_Arr[] = array(
        'material_id' => $Select_material[$i],
        'material_ID' => $ID_arr,
        'material_OD' => $OD_arr,
        'material_Length' => $Length_arr,
        'best_tube' => $best_tube,
        'base_Price' => $base_Price[$i],
        'select_Quantity' => $select_Quantity[$i],
        'discount' => $discount[$i],
        'final_Price' => $final_Price[$i]
    );
   
}

//print_r(json_encode($material_Arr));
$profile_arr[] = array(
    'product_name' => $product_nameForEnquiry[$prod],
    'profile_id' => $profile_id[$prod],
    'housing_status' => $housing_status,
    'profile_description' => $Prod_description,
    'Prod_ID' => $Prod_ID,
    'Prod_OD' => $Prod_OD,
    'Prod_length' => $Prod_length,
    'material_associated' => $material_Arr,
    'product_quantity' => $Product_Quantity[$prod],
    'product_price' => $TotalProduct_Price[$prod]
);
    
$HousingArr[] = array(
    'product_name' => $product_nameForEnquiry[$prod],
    'housing_status' => $housing_status,
    'profile_description' => $Prod_description[$prod],
    'Prod_ID' => $Prod_ID[$prod],
    'Prod_OD' => $Prod_OD[$prod],
    'Prod_length' => $Prod_length[$prod],
    'product_quantity' => $Product_Quantity[$prod]
    );
        $housingInfo['profile_id'] = $profile_id[$prod];
}

        $housingInfo['profile_data'] = json_encode($HousingArr);
        $path = base_url();
        $url = $path . 'api/ManageEnquiry_api/SaveProfile_data';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $housingInfo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

$data['customer_id']=$customer_id;
$data['customer_name']=$Select_Customers;
$data['products_associated']=json_encode($profile_arr);

$path = base_url();
$url = $path . 'api/ManageEnquiry_api/SaveProductsForEnquiry';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);
echo $response['status_message'];
}


//---this fun is used to get base price from raw material 
public function GetRawMaterialBasePriceForEnquiry() {
    $Material_id = 0;
    $Material_ID = array("10","20","20","11","20","20");
    $Material_OD = array("20","20","20","5","20","20");
    $Material_LENGTH = array("","","","","","");
    $path = base_url();
    $url = $path . 'api/ManageMaterial_api/GetRawMaterialBasePriceForEnquiry?material_id = ' . $Material_id . '&Material_ID = ' . $Material_ID . '&Material_OD =' . $Material_OD . '&Material_LENGTH =' . $Material_LENGTH;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPGET, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    print_r($response);
}

//---this fun is used to get base price from raw material 
public function fetchmaterial_details() {
        $data['info'] = Manage_materials::getRawMaterialInfo();     //-------show all Raw materials
        $data['materials'] = Manage_materials::getMaterialrecord();     //-------show all Raw materials
        $data['customers'] = Manage_materials::GetCustomersDetails();     //-------show all Customers
        $data['profileinfo'] = Manage_materials::GetProductProfileDetails();     //-------show all Product Profile
        $data['multiple_divs'] = Manage_materials::Add_MultipleProduct($_POST);     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/new/fetchmaterial_details', $data);
    }

    public function raise_enquiry() {
        $data['info'] = Manage_materials::getRawMaterialInfo();     //-------show all Raw materials
        $data['materials'] = Manage_materials::getMaterialrecord();     //-------show all Raw materials
        $data['customers'] = Manage_materials::GetCustomersDetails();     //-------show all Customers
        $data['profileinfo'] = Manage_materials::GetProductProfileDetails(); //-------show all Product Profile
        $data['multiple_divs'] = Manage_materials::Add_MultipleProduct($_POST);     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('sales/raise_enquiry', $data);
    }

//    -----------this fun is show fetched material info page
//---------this fun is used to get tube history for customer------------
    public function GetTubeHistoryForInquiry() {
        extract($_POST);
        $data = $_POST;
//print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/GetTubeHistoryForInquiry?Customer_id = ' . $Customer_id . '&Profile_id = ' . $Profile_id;
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
        return($response);
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
        $url = $path . 'api/ManageMaterial_api/GetMaterilaInformation?material_id = ';
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
            echo'<div class = "alert alert-danger w3-margin" style = "text-align: center;">
            <strong>' . $response['status_message'] . '</strong>
            </div>
            <script>
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
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
            window.setTimeout(function () {
                $(".alert").fadeTo(500, 0).slideUp(500, function () {
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

// ---- this function is used to delete material details-------//
    public function Get_housingData(){
        extract($_POST);
        $data = $_POST;

        $path = base_url();
        $url = $path . 'api/ManageMaterial_api/Get_housingData?profile_id='.$Profiles;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response[0]['profile_data']);
    }
}

?>