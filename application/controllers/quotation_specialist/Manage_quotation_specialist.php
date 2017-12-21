<?php

error_reporting(E_ERROR | E_PARSE);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//S-wings Manage_quotations
class Manage_quotation_specialist extends CI_Controller {

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
        
        $this->load->model('quotation_specialist_model/ManageQuotationSpecialist_model');
        $data['details'] = Manage_quotation_specialist::Get_WorkorderProduction_Detaills();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('quotation_specialist/quotation_specialist');   
    }
    public function Get_WorkorderProduction_Detaills(){
        $path = base_url();
        $url = $path . 'api/ManageQuotation_Specialist_api/Get_WorkorderProduction_Detaills';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        return $response;
    }
    

}
