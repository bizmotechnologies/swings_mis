<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageQuotation_Specialist_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('quotation_specialist_model/ManageQuotationSpecialist_model');
    }
    //---this fun is used to get all work order for productions which raise enquiry
    public function Get_WorkorderProduction_Detaills_get(){        
        $result = $this->ManageQuotationSpecialist_model->Get_WorkorderProduction_Detaills();
        return $this->response($result);
    }
        //---this fun is used to get all work order for productions which raise enquiry

}
