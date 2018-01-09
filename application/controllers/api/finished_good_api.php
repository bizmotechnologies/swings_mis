<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . '/libraries/REST_Controller.php');
class Finished_good_api extends REST_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inventory_model/Finished_good_model');
	}
	public function GetFinishedGoodsDetails_get()
	{
		$result = $this->Finished_good_model->GetFinishedGoodsDetails();
          return $this->response($result);
	}
	public function ShowFinishedGoods_post(){
		$data = $_POST;
		$result = $this->Finished_good_model->ShowFinishedGoods($data);
		return $this->response($result);			
	}
	public function GetQuotationIdFromquoation_master_get(){
		$result = $this->Finished_good_model->GetQuotationIdFromquoation_master();
		return $this->response($result);			
	}
}