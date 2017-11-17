<?php

class Vendor_Management extends CI_controller {

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

        $this->load->model('inventory_model/VendorManagement_model');
        $response['details'] = Vendor_Management::GetAllVendorDetails();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/vendor/vendor_management', $response);
    }

    public function GetAllVendorDetails() {

        $path = base_url();
        $url = $path . 'api/ManageVendor_api/GetAllVendorDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    public function save_VendorDetails() { /* this fun for saving all vendor details */

        extract($_POST);
        $data = $_POST;
        print_r($data);
        $emailArr = array();
        foreach ($Input_VendorEmail as $key) {
            $emailArr[] = $key;  //---------create array of roles to store in feature table
        }
        $data = array(
            'Input_VendorName' => $Input_VendorName,
            'Input_VendorShopName' => $Input_VendorShopName,
            'Input_VendorShopAddress' => $Input_VendorShopAddress,
            'Input_VendorContactNo_one' => $Input_VendorContactNo_one,
            'Input_VendorContactNo_two' => $Input_VendorContactNo_two,
            'Input_VendorLandingCost' => $Input_VendorLandingCost,
            'Input_Discount' => $Input_Discount,
            'Input_VendorsBank_name' => $Input_VendorsBank_name,
            'Input_VendorBank_AccNo' => $Input_VendorBank_AccNo,
            'Input_VendorBank_MICR_Code' => $Input_VendorBank_MICR_Code,
            'Input_VendorBank_Address' => $Input_VendorBank_Address,
            'Input_VendorBank_IFSC_Code' => $Input_VendorBank_IFSC_Code,
            'Input_VendorPAN_No' => $Input_VendorPAN_No,
            'Input_VendorEmail' => json_encode($emailArr)
        );

        //print_r($data);
        $path = base_url();
        $url = $path . 'api/ManageVendor_api/save_VendorDetails';
        //echo $url;  
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        // print_r($response);
        if ($response['status'] == 0) {
            echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
   <strong>' . $response['status_message'] . '</strong> 
   </div>
   <script>
   window.setTimeout(function() {
     $(".alert").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove(); 
    });
    location.reload();
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
  location.reload();
}, 1000);
</script>';
        }
    }

    /* ---------------------------this save vndor details fun ends here---------------------------------- */

    public function Update_VendorDetails() { /* this fun is used to update vendor details */

        extract($_POST);
        $data = $_POST;

        $emailArr = array();
        foreach ($Updated_VendorEmail as $key) {
            $emailArr[] = $key;  //---------create array of roles to store in feature table
        }
        $data['Updated_VendorEmail'] = json_encode($emailArr);

        $path = base_url();
        $url = $path . 'api/ManageVendor_api/Update_VendorDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        // print_r($response_json); die();
        if ($response['status'] == 0) {
            echo $response['status_message'];
        } else {
            echo $response['status_message'];
        }
    }

    /* --------------------------fun update vendor details ends here------------------------------------- */

    /* ------------------------fun for delete vendor info----------------------------------- */

    public function DeleteVendorDetails() {

        extract($_GET);
        $data = $_GET;

        $path = base_url();
        $url = $path . 'api/ManageVendor_api/DeleteVendorDetails?Vendor_id=' . $Vendor_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        redirect('inventory/Vendor_Management');
    }

    /* ------------------fun for delete vendor details ends here----------------------------------- */
}

?>