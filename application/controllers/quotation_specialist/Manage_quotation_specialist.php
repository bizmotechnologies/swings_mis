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
        $data['wo_details'] = Manage_quotation_specialist::Get_WorkorderProduction_Details();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('quotation_specialist/quotation_specialist',$data);   
    }
  //---this fun is udsed to get work order production details-----
    public function Get_WorkorderProduction_Details(){
        $path = base_url();
        $url = $path . 'api/ManageQuotation_Specialist_api/Get_WorkorderProduction_Details';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        return $response;
    }
 //---this fun is udsed to get work order production details-----
   //--this fun is used to get all details of quotation specialist by wo id----//
   public function getqueryForChange(){
        extract($_POST);
        //print_r($_POST);
        $path = base_url();
        $url = $path . 'api/ManageQuotation_Specialist_api/getqueryForChange?wo_id='.$wo_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        print_r($response_json);die();
        if ($response['status']==0) {
  } 
  else {
    foreach ($response['status_message'] as $key) {
      $date=date('d/m/Y',strtotime($key['dated'])); 
      echo '
      <div class= "w3-margin-top w3-card-2 w3-padding">
      <div class="w3-col l12">
      <table class="table table-bordered">
      <tbody>
      <tr>
      <th class="text-right">Customer ID:</th>
      <td>'.$key['customer_name'].'</th>
      <th class="text-right">Date:</td>
      <td>'.$date.'</td>
      <th class="text-right">Work Order No:</th>
      <td>#WO-0'.$key['wo_id'].'</td>
      </tr>
      </tbody>
      </table>
      </div>';
            }
        }
    }

    //--this fun is used to get all details of quotation specialist by wo id----//
    

}
