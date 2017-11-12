<?php
class Manage_customers extends CI_controller{

public function index(){

	    $this->load->model('inventory_model/ManageCustomer_model');	

        $response['details']=Manage_customers::getCustomerDetails();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('inventory/customer/manage_customer', $response);

	}
              /*----------------this fun is used to show all customer info in tables-----------------------------*/
public function  getCustomerDetails(){

        $path=base_url();
        $url = $path.'api/ManageCustomer_api/getCustomerDetails';        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        return $response;
}
        /*------------------------------fun for show customer details ends here-------------------------------*/

        /*------------------------------fun for update customer details-------------------------------*/

	public function Update_CustomerDetails(){

	    extract($_POST);
      $data = $_POST;

      $path=base_url();
        $url = $path.'api/ManageCustomer_api/Update_CustomerDetails';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        //print_r($response_json);die();
       if($response['status'] == 0)
       {
      	        echo $response['status_message'];
       }
       else
       {
      	      	echo $response['status_message'];
       }

}
        /*------------------------------fun for update customer details-------------------------------*/


      /*------------------------------fun for delete customer details-------------------------------*/

	public function DeleteCustomerDetails(){/*fun for delete customer*/

		    extract($_GET);
        $data = $_GET;

        $path=base_url();
            $url = $path.'api/ManageCustomer_api/DeleteCustomerDetails?Customer_id='.$Customer_id;        
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response_json = curl_exec($ch);
            curl_close($ch);
            $response=json_decode($response_json, true);

            //print_r($response_json);die();
        redirect('inventory/Manage_customers');      
	}

          /*------------------------------fun for delete customer details-------------------------------*/

}
?>