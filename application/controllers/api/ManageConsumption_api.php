<?php
///api
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');
class ManageConsumption_api extends REST_Controller 
{

	public function __construct() {
		parent::__construct();
		$this->load->model('inventory_model/materialConsume_model');
	}
	public function addConsumption_post() {
		$data = $_POST;
		$result = $this->materialConsume_model->addConsumption($data);
		return $this->response($result);
	}

	public function getConsumptionDetails_get() {
		$result = $this->materialConsume_model->getConsumptionDetails();
		return $this->response($result);
	}
}
?>