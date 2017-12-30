<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class report_model extends CI_Model
{

//-------------------------------------get profit report by name--------------------------------------------------------//	
	public function get_all_info()
	{
		$query = "SELECT * FROM wo_master";
		$result=$this->db->query($query);  
		$wo_data=array();
		if ($result->num_rows() <= 0) 
		{
			$response = array(                                             
				'status' => 0,
				'status_message' => 'No Records Found.');                           
		} else {
			//$wo_data ="";
			
			foreach ($result->result_array() as $row)
			{
				$customer_details = report_model::get_quotationid_info($row['quotation_id']);
			//print_r($customer_details);

			$customer_name=$customer_details['status_message'][0]['customer_name'];
			//$cust_id=$customer_details['status_message'][0]['cust_id'];
			//print_r($customer_name);
				$extra=array(
					'wo_id'=>$row['wo_id'],
					'customer_name'=>$customer_name,
					//'cust_id'=>$cust_id,
					'branch_name'=>$row['branch_name'],
					'profit'=>$row['profit']
				);
				//print_r($extra);
				$wo_data[]=$extra;
			}
			
			$response = array(
				'status' => 1,
				'status_message' => $wo_data);
		}
		return $response;

	}

	public function show_ProfitReport($From_date,$To_date,$cust_id,$customer_name)
	{
		$query = "SELECT * FROM wo_master WHERE wo_id = '$wo_id'";
		$result=$this->db->query($query);  
		$quotation_id ="";

		foreach ($result->result_array() as $row)
		{
			$quotation_id = $row['quotation_id'];
		}
		$customer_details = report_model::get_quotationid_info($quotation_id);
		print_r($customer_details);

	}

	public function get_quotationid_info($quotation_id)
	{

		$query = "SELECT * FROM quotation_master WHERE quotation_id = '$quotation_id'";
		$result=$this->db->query($query);  
		if ($this->db->query($query)) {
			$response = array(
				'status' => 1,
				'status_message' => $result->result_array()
			);
		}else
		{
			
			$response = array(
				'status' => 0,
				'status_message' =>'No data found');
		}
		return $response;
	}

	 public function sort_Profitreport($From_date, $To_date, $cust_id) {
	 	if( $cust_id!="")
	 	{
	 		$query="SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated BETWEEN '$From_date' AND '$To_date'";
	 	}
	 	else
	 	{
	 		$query="SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,quot.quotation_id,f.vendor_name,f.material_name,f.profit FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE  wo.dated BETWEEN '$From_date' AND '$To_date'";
	 	}
	 	
    
     //echo $query;die();
        $result = $this->db->query($query);
       // print_r($result);die();
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

    public function sort_byBranch($From_date, $To_date, $branch_name, $cust_id) {
                if ($From_date == '' && $To_date == '' && $cust_id == '') {
                   $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE wo.branch_name ='$branch_name'";
                 }
                 else if($From_date == '' && $To_date == ''){
                     $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND wo.branch_name ='$branch_name'";
                 }
                 else if($cust_id == '' && $To_date == ''){
                     $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated <= '$To_date' AND wo.branch_name ='$branch_name'";
                 }
                 else if($From_date == '' && $cust_id == ''){
                    $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated >='$From_date'  AND wo.branch_name ='$branch_name'";
                 }
                 else {
                     if ($From_date == '') {
                         $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated <= '$To_date' AND wo.branch_name ='$branch_name'";
                     } else if ($To_date == '') {
                         $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated >='$From_date' AND wo.branch_name ='$branch_name'";
                     } else if ($cust_id == '') {
                         $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit  FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE wo.dated BETWEEN '$From_date' AND '$To_date' AND wo.branch_name ='$branch_name'";
                     } else {
                         $sqlsort = "SELECT wo.profit,wo.branch_name,wo.wo_id,quot.customer_name,f.vendor_name,quot.quotation_id,f.material_name,f.profit FROM wo_master as wo JOIN quotation_master as quot JOIN finished_goods as f on quot.quotation_id = wo.quotation_id AND f.quotation_id = quot.quotation_id  AND quot.quotation_id=f.quotation_id WHERE quot.customer_id='$cust_id' AND  wo.dated BETWEEN '$From_date' AND '$To_date' AND wo.branch_name ='$branch_name' ";
                    }
                }
       // echo $sqlsort;die();
                $result = $this->db->query($sqlsort);

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