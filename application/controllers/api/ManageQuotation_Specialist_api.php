<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class ManageProfile_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('quotation_specialist_model/ManageQuotationSpecialist_model');
    }
    public function Get_WorkorderProduction_Detaills_get(){        
        $result = $this->ManageQuotationSpecialist_model->Get_WorkorderProduction_Detaills();
        return $this->response($result);
    }
}
