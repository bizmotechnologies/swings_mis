<?php
class Manage_customers extends CI_controller{

public function index(){

	    $this->load->model('ManageCustomer_model');	

        $response['details'] = $this->ManageCustomer_model->getCustomerDetails(); 
        //print_r($response);
        $this->load->view('manage_customer', $response);

	}

	public function Update_CustomerDetails(){

	  extract($_POST);
      //print_r($_POST);die();
      $data = $_POST;
      $this->load->model('ManageCustomer_model');
      $response = $this->ManageCustomer_model->Update_CustomerDetails( $data );
      //print_r($response['status_message']);die();
       if($response['status'] == 0)
       {

      	        echo $response['status_message'];
                //print_r($response['status_message']);
       }
       else
       {
      	      	echo $response['status_message'];
       }


	}

	public function DeleteCustomerDetails(){

		extract($_GET);
        $data = $_GET;
        $this->load->model('ManageCustomer_model');  
        $response = $this->ManageCustomer_model->DeleteCustomerDetails($data);
        redirect('Manage_customers');      
	}

}
?>