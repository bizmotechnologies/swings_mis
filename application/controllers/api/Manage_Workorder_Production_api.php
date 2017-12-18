<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');

class Manage_Workorder_Production_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model/ManageWorkorder_Production_model');
    }

//----this fun is used to get details of all production work order details
    public function get_Workorderfor_Production_get() {
        $result = $this->ManageWorkorder_Production_model->get_Workorderfor_Production();
        return $this->response($result);
    }

//----this fun is used to get details of all production work order details
//----this fun is used to get details of all production work order details

    public function get_Workorderfor_Production_details_get() {
        $wo_id = $_GET['wo_id'];
        $result = $this->ManageWorkorder_Production_model->get_Workorderfor_Production_details($wo_id);
        return $this->response($result);
    }

//----this fun is used to get details of all production work order details
}
