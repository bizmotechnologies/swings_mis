<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

	class ManageCustomer_model extends CI_Model{

public function getCustomerDetails(){  /*this fun is used to get customer deatails*/

	$sqlselect="SELECT * FROM customer_details WHERE visible = '1'";

		$result =$this->db->query($sqlselect);

		if($result->num_rows()<=0){  
   				$response=array(
    			'status' => 0,
    			'status_message' =>'No Records Found.'	);
  					}
  					else{
   					$response=array(
    				'status' => 1,
    				'status_message' => $result->result_array());
  						}
		return $response;


}/*ends here*/

public function Update_CustomerDetails($data){  /*this fun is used to  update customer details*/
  extract($data);

  $sql = "UPDATE customer_details SET customer_name = '$Updated_CustomerName',
        customer_email = '$Updated_CustomerEmail',country = '$SelectUpdated_Country',
        state = '$SelectUpdated_State',city = '$Update_City',
        contact_no1 = '$Updated_ContactNo_one',contact_no2 = '$Updated_ContactNo_two',
        bank_name = '$Updated_Bank_name' ,bank_address = '$Updated_Bank_Address' ,
        account_no = '$Updated_Bank_AccNo' , IFSC_no = '$Updated_Bank_IFSC_Code' ,
        MICR_no = '$Updated_Bank_MICR_Code' ,PAN_no = '$Updated_PAN_No' WHERE cust_id ='$new_Cust_id'";
        //echo $sql; die();
      $resultUpadateCustomerDetails =$this->db->query($sql);

      if($resultUpadateCustomerDetails){  
          $response=array(
          'status' => 1,
          'status_message' =>'Records Updated Successfully..!');
            }
            else{
            $response=array(
            'status' => 0,
            'status_message' => 'Records Not Updated Successfully...!');
              }
    return $response;


}/*update customer details ends here*/

public function DeleteCustomerDetails($data){ /*this fun for delete customer details */

    extract($data);
    //print_r($data);die();
    $sqldelete = "UPDATE customer_details SET visible = '0' WHERE cust_id = '$Customer_id'";

    $resultdelete =$this->db->query($sqldelete);

    if($resultdelete){  
          $response=array(
          'status' => 1,
          'status_message' =>'Records Deleted Successfully..!');
            }
            else{
            $response=array(
            'status' => 0,
            'status_message' => 'Records Not Deleted Successfully...!');
              }
 
    return $response;

}/*delete fun ends here*/


	}
?>