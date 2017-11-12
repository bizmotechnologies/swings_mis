<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class AddCustomer_model extends CI_Model{

public function save_CustomerDetails($data){  /* this fun is used for save customer details*/

	extract($data);
	//print_r($data); die();
	$sqlnew="INSERT INTO customer_details(customer_name,customer_email,country,state,
		city,contact_no1,contact_no2,bank_name,bank_address,account_no,
		IFSC_no,MICR_no,PAN_no,joining_date) values ('$Input_CustomerName',
		'$Input_CustomerEmail','$Select_Country','$Select_State','$Input_City',
		'$Input_ContactNo_one','$Input_ContactNo_two','$Input_Bank_name',
		'$Input_Bank_Address','$Input_Bank_AccNo','$Input_Bank_IFSC_Code',
		'$Input_Bank_MICR_Code','$Input_PAN_No',now())";

		$resultnew =$this->db->query($sqlnew);

		if($resultnew){  
   				$response=array(
    			'status' => 1,
    			'status_message' =>'Records Inserted Successfully..!');
  					}
  					else{
   					$response=array(
    				'status' => 0,
    				'status_message' => 'Records Not Inserted Successfully...!');
  						}
 
		return $response;

}
/*save customer fun ends here*/


}
?>