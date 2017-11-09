<?php
class Add_customers extends CI_controller{

public function index(){

        $this->load->model('AddCustomer_model');
        $this->load->view('add_customer');
	}

public function save_CustomerDetails(){

	  extract($_POST);
      //print_r($_POST);die();
      $data = $_POST;
      $this->load->model('AddCustomer_model');
      $response = $this->AddCustomer_model->save_CustomerDetails( $data );

      if($response['status'] == 0){

      	        echo $response['status_message'];
      }
      else{
      	        echo $response['status_message'];
      }

}
	
}
?>
