<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');
class Wo_get_all_infoapi extends REST_Controller 
{

   		 public function __construct()
   		 {
       		  parent::__construct();
       		  $this->load->model('sales_model/manage_workorder_model');
		   }
       public function get_all_woinfo_get()
       {
           $result = $this->manage_workorder_model->get_all_woinfo();
       		 return $this->response($result);
    	 }
      public function show_WO_id_info_get()
      {
        $wo_id  = $_GET['wo_id'];
        $result = $this->manage_workorder_model->show_WO_id_info($wo_id);
        return $this->response($result);
       }
}
?>
