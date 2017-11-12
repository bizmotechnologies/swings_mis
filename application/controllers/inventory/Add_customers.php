<?php
class Add_customers extends CI_controller{

public function index(){/*this fun for indexing to add the view*/

        $this->load->model('inventory_model/AddCustomer_model');
        $this->load->view('includes/navigation');
        $this->load->view('inventory/customer/add_customer');
	}

public function save_CustomerDetails(){  /*this fun is used to save customer deatails*/

	    extract($_POST);
      $data = $_POST;
        $path=base_url();                                                   /*this code is for web service AND api for saave customer details*/
        $url = $path.'api/ManageCustomer_api/save_CustomerDetails';  
        //echo $url;  
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
//print_r($response_json);die();
      if($response['status'] == 0){

      	        echo $response['status_message'];
      }
      else{
      	        echo $response['status_message'];
      }

}/*fun ends here*/
	
}
?>
