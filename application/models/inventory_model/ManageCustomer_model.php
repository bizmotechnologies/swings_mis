<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ManageCustomer_model extends CI_Model {

    public function getCustomerDetails($branch_name) { /* this fun is used to get customer deatails */

        $sqlselect = "SELECT * FROM customer_details WHERE visible = '1' AND branch_name='$branch_name'";

        $result = $this->db->query($sqlselect);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }
        return $response;
    }

    /* ends here */
//----this fun is used to save the customer details-----------------------------------------//
    public function save_CustomerDetails($data) { /* this fun is used for save customer details */
        extract($data);
        $sqlnew = "INSERT INTO customer_details(customer_name,customer_email,"
                . "customer_address,contact,bank_name,bank_address,"
                . "account_no,IFSC_no,MICR_no,PAN_no,joining_date,profit_for_odgreater,profit_for_odsmall,branch_name) "
                . "values ('$Input_CustomerName','$Input_CustomerEmail','$Input_CustomerAddress',"
                . "'$contact','$Input_Bank_name','$Input_Bank_Address',"
                . "'$Input_Bank_AccNo','$Input_Bank_IFSC_Code','$Input_Bank_MICR_Code',"
                . "'$Input_PAN_No',now(),'$Select_profitCategoryOne','$Select_profitCategoryTwo','$branch_name')";
        $resultnew = $this->db->query($sqlnew);
        if ($resultnew) {
            $response = array(
                'status' => 1,
                'status_message' => 'Customer Details Inserted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Customer Details Not Inserted Successfully...!');
        }
        return $response;
    }
//----this fun is used to save the customer details-----------------------------------------//

    public function Update_CustomerDetails($data) { /* this fun is used to  update customer details */
        extract($data);

        $sql = "UPDATE customer_details SET customer_name = '$Updated_CustomerName',
  customer_email = '$Updated_CustomerEmail',customer_address = '$Updated_CustomerAddress',contact = '$contact',
  bank_name = '$Updated_Bank_name' ,bank_address = '$Updated_Bank_Address' ,
  account_no = '$Updated_Bank_AccNo' , IFSC_no = '$Updated_Bank_IFSC_Code' ,
  MICR_no = '$Updated_Bank_MICR_Code' ,PAN_no = '$Updated_PAN_No',"
                . "profit_for_odgreater='$UpdateSelect_profitCategoryOne',"
                . "profit_for_odsmall='$UpdateSelect_profitCategoryTwo',branch_name='$branch_name' WHERE cust_id ='$new_Cust_id'";
        //echo $sql; die();
        $resultUpadateCustomerDetails = $this->db->query($sql);

        if ($resultUpadateCustomerDetails) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
    }

    /* update customer details ends here */

    public function DeleteCustomerDetails($data) { /* this fun for delete customer details */

        extract($data);
        //print_r($data);die();
        $sqldelete = "UPDATE customer_details SET visible = '0' WHERE cust_id = '$Customer_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($resultdelete) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted Successfully...!');
        }

        return $response;
    }

    /* delete fun ends here */

    public function getCustomerBy_ID($customer_id) { /* this fun is used to get customer deatails */

        $sqlselect = "SELECT * FROM customer_details WHERE cust_id = '$customer_id'";

        $result = $this->db->query($sqlselect);

        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No Records Found.');
        } else {
            $response = $result->result_array();
        }
        return $response;
    }

    /* ends here */
}

?>