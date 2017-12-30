<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Enquiry_report_model extends CI_Model
{
	public function get_all_data($From_date, $To_date, $cust_id)
	{
		if( $cust_id!="")
		{	
				$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
				JOIN quotation_master as quot 
				JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id 
				WHERE quot.customer_id='$cust_id' AND wo.dated BETWEEN '$From_date' AND '$To_date'";
		}
		else
		{
			$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
				JOIN quotation_master as quot 
				JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id 
				WHERE  wo.dated BETWEEN '$From_date' AND '$To_date'";
		}
		//echo $query;die();
		$result = $this->db->query($query);
		//print_r($result->result_array());die();
        if ($result->num_rows() <= 0) {
            $response = array(
                'status' => 0,
                'status_message' => 'No data found !!!');
        } else {
            $response = array(
                'status' => 1,
                'status_message' => $result->result_array());
        }

        return $response;
        //print_r($response);die();

	}

	public function sort_byBranch($From_date, $To_date, $branch_name, $cust_id)
	{
			 if ($From_date == '' && $To_date == '' && $cust_id == '') 
			 {
				$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id 
					WHERE wo.branch_name ='$branch_name'";
			 }
			 else if($From_date == '' && $To_date == '')
			 {
			 	$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND wo.branch_name ='$branch_name'";
			 }
			 else if($cust_id == '' && $To_date == '')
			 {
			 	$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated <= '$To_date' AND wo.branch_name ='$branch_name'";
			 }
			 else if($From_date == '' && $cust_id == '')
			 {
			 	$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated >='$From_date'  AND wo.branch_name ='$branch_name'";
			 }
			 else {
	                if ($From_date == '') {
	                     	$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated <= '$To_date' AND wo.branch_name ='$branch_name'";
	                     		}
	                     		else if ($To_date == '') {
	                     			$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated >='$From_date' AND wo.branch_name ='$branch_name'";
	                     	} else if ($cust_id == '') {
	                     		$query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE wo.dated BETWEEN '$From_date' AND '$To_date' AND wo.branch_name ='$branch_name'";
	                     	 } else {	
	                     	 $query="SELECT e.enquiry_id,quot.quotation_id,wo.branch_name,quot.customer_name,e.date_on,wo.dated FROM enquiry_master as e
					JOIN quotation_master as quot 
					JOIN wo_master as wo ON e.enquiry_id=quot.enquiry_id AND quot.quotation_id= wo.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated BETWEEN '$From_date' AND '$To_date' AND wo.branch_name ='$branch_name'"; 
	                     	 }
	                  }
	                   $result = $this->db->query($query);

                if ($result->num_rows() <= 0) {
                    $response = array(
                        'status' => 0,
                        'status_message' => 'No data Found for specified Filter !!!');
                } else {
                    $response = array(
                        'status' => 1,
                        'status_message' => $result->result_array());
                }
                return $response;
               }

}