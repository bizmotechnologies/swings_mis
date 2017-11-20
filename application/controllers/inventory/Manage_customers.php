<?php

class Manage_customers extends CI_controller {

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

        $this->load->model('inventory_model/ManageCustomer_model');

        $response['details'] = Manage_customers::getCustomerDetails();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/customer/manage_customer', $response);
    }

    /* ----------------this fun is used to show all customer info in tables----------------------------- */

    public function getCustomerDetails() {

        $path = base_url();
        $url = $path . 'api/ManageCustomer_api/getCustomerDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }

    /* ------------------------------fun for show customer details ends here------------------------------- */

    public function save_CustomerDetails() { /* this fun is used to save customer deatails */

        extract($_POST);
        $data = $_POST;

        $emailArr = array();
        foreach ($Input_CustomerEmail as $key) {
            $emailArr[] = $key;  //---------create array of roles to store in feature table
        }
        $contactno = array();
        foreach ($Input_ContactNo_one as $value) {
            $contactno[] = $value;
        }
        $contactperson = array();
        foreach ($Input_ContactPerson as $name) {
            $contactperson[] = $name;
        }
        $contact_arr=array();
        for($i=0;$i<count($contactno);$i++){
        $contact=array(
            'contact_person'    => $contactperson[$i],
            'contact_number'    => $contactno[$i]
        );
        $contact_arr[]=$contact;
        }
//        print_r(json_encode($contact_arr));die();
        $data['Input_CustomerEmail'] = json_encode($emailArr);
        $data['contact'] = json_encode($contact_arr);

        //print_r($data); die();
        $path = base_url();                                                   /* this code is for web service AND api for saave customer details */
        $url = $path . 'api/ManageCustomer_api/save_CustomerDetails';
        //echo $url;  
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);die();
        if ($response['status'] == 0) {

            echo $response['status_message'];
        } else {
            echo $response['status_message'];
        }
    }

    /* fun ends here */


    /* ------------------------------fun for update customer details------------------------------- */

    public function Update_CustomerDetails() {

        extract($_POST);
        $data = $_POST;
        
        $emailArr = array();
        foreach ($Updated_CustomerEmail as $key) {
            $emailArr[] = $key;  //---------create array of roles to store in feature table
        }
        $contactno = array();
        foreach ($Updated_ContactNo_one as $value) {
            $contactno[] = $value;
        }
        $contactperson = array();
        foreach ($Updated_ContactPerson as $name) {
            $contactperson[] = $name;
        }
        $contact_arr=array();
        for($i=0;$i<count($contactno);$i++){
        $contact=array(
            'contact_person'    => $contactperson[$i],
            'contact_number'    => $contactno[$i]
        );
        $contact_arr[]=$contact;
        }
//        print_r(json_encode($contact_arr));die();
        $data['Updated_CustomerEmail'] = json_encode($emailArr);
        $data['contact'] = json_encode($contact_arr);
        //print_r($data); die();
        $path = base_url();
        $url = $path . 'api/ManageCustomer_api/Update_CustomerDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        if ($response['status'] == 0) {
            echo $response['status_message'];
        } else {
            echo $response['status_message'];
        }
    }

    /* ------------------------------fun for update customer details------------------------------- */


    /* ------------------------------fun for delete customer details------------------------------- */

    public function DeleteCustomerDetails() {/* fun for delete customer */

        extract($_GET);
        $data = $_GET;

        $path = base_url();
        $url = $path . 'api/ManageCustomer_api/DeleteCustomerDetails?Customer_id=' . $Customer_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);

        //print_r($response_json);die();
        redirect('inventory/Manage_customers');
    }

    /* ------------------------------fun for delete customer details------------------------------- */
}

?>