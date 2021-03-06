<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageQuotation_Specialist_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('quotation_specialist_model/ManageQuotationSpecialist_model');
    }

    //---this fun is used to get all work order for productions which raise enquiry
    public function Get_WorkorderProduction_Details_get() {
        $result = $this->ManageQuotationSpecialist_model->Get_WorkorderProduction_Details();
        return $this->response($result);
    }

    //---this fun is used to get all work order for productions which raise enquiry
    //---this fun is used to get all work order for productions which has raised enquiry
    public function getqueryForChange_get() {
        $wo_id = $_GET['wo_id'];
        $result = $this->ManageQuotationSpecialist_model->getqueryForChange($wo_id);
        return $this->response($result);
    }

    //---this fun is used to get all work order for productions which has raised enquiry
    //------this fun is used to approve quotation specialist query------------------------//
    public function approvedQuery_post(){
        extract($_POST);
        $data=$_POST;		
        $result = $this->ManageQuotationSpecialist_model->approvedQuery($data);
        return $this->response($result);
    }
    //------this fun is used to approve quotation specialist query------------------------//
    //------this fun is used to reject quotation specialist query------------------------//   
    public function rejectQuery_post(){
        extract($_POST);
        $data=$_POST;		
        $result = $this->ManageQuotationSpecialist_model->rejectQuery($data);
        return $this->response($result); 
    }
    //------this fun is used to reject quotation specialist query------------------------//   

}
