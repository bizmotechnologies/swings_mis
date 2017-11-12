<?php
class Manage_customers extends CI_controller{

public function index(){

	    $this->load->model('inventory_model/ManageCustomer_model');	

        $response['details'] = $this->ManageCustomer_model->getCustomerDetails(); /*fun for get customer detais*/
        //print_r($response);
        $this->load->view('includes/navigation');
        $this->load->view('inventory/customer/manage_customer', $response);

	}

	public function Update_CustomerDetails(){/*fun for update customer deatils*/

	  extract($_POST);
      //print_r($_POST);die();
      $data = $_POST;
      $this->load->model('inventory_model/ManageCustomer_model');
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


	}/*update customer ends here*/

	public function DeleteCustomerDetails(){/*fun for delete customer*/

		extract($_GET);
        $data = $_GET;
        $this->load->model('inventory_model/ManageCustomer_model');  
        $response = $this->ManageCustomer_model->DeleteCustomerDetails($data);
        redirect('inventory/Manage_customers');      
	}/*fun ends here*/

}
?>