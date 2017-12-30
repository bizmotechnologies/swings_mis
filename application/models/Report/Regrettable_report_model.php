<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Regrettable_report_model extends CI_Model
{
	public function get_regrettable_data($From_date, $To_date,$cust_id)
	{
		if( $cust_id!="")
		{
			$query="SELECT * FROM enquiry_master WHERE customer_id=$cust_id AND date_on BETWEEN '$From_date' AND '$To_date'";
		}
		else
		{
			$query="SELECT * FROM enquiry_master WHERE date_on BETWEEN '$From_date' AND '$To_date'";
		}
		
		$result = $this->db->query($query);
		//echo $query;die();
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
     
  }


  public function sort_byBranch($From_date, $To_date, $branch_name, $cust_id)
	{
			 if ($From_date == '' && $To_date == '' && $cust_id == '') 
			 {
				$query="SELECT * FROM enquiry_master WHERE branch_name ='$branch_name'";
			 }
			 else if($From_date == '' && $To_date == '')
			 {
			 	$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND branch_name ='$branch_name'";
			 }
			 else if($cust_id == '' && $To_date == '')
			 {
			 	$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND  date_on <= '$To_date' AND branch_name ='$branch_name'";
			 }
			 else if($From_date == '' && $cust_id == '')
			 {
			 	$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND date_on >='$From_date'  AND branch_name ='$branch_name'";
			 }
			 else {
	                if ($From_date == '') {
	                     	$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND date_on <= '$To_date' AND branch_name ='$branch_name'";
	                     		}
	                else if ($To_date == '') {
	                     			$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND  date_on >='$From_date' AND branch_name ='$branch_name'";
	               } else if ($cust_id == '') {
	                     		$query="SELECT * FROM enquiry_master WHERE date_on BETWEEN '$From_date' AND '$To_date' AND branch_name ='$branch_name'";
	               } else {	
	                     	$query="SELECT * FROM enquiry_master WHERE customer_id='$cust_id' AND date_on BETWEEN '$From_date' AND '$To_date' AND branch_name ='$branch_name'"; 
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