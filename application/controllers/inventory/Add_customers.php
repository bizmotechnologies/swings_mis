<?php
class Add_customers extends CI_controller{

public function index(){/*this fun for indexing to add the view*/

        $this->load->model('AddCustomer_model');
        $this->load->view('add_customer');
	}

public function save_CustomerDetails(){  /*this fun is used to save customer deatails*/

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

}/*fun ends here*/
	
}
?>
