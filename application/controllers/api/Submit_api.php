<?php

///api
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');
class Submit_api extends REST_Controller 
{

    public function __construct() {
        parent::__construct();
        $this->load->model('Material_model');

        }
        public function getDetails_get() {
        
        $result = $this->Material_model->getDetails();
        return $this->response($result);
    }
    
}
 ?>


