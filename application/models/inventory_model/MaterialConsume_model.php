<?php
 if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MaterialConsume_model extends CI_Model 
{	

	public function addConsumption($data)
	{
		extract($data);
		//print_r($data);die();
		$query="INSERT into consumption_table(material_name,material_ID,material_OD,material_Length)VALUES('$material_name','$inner_dia','$outer_dia','$consumed_length')";
		$result = $this->db->query($query);
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'New Consumption Added.<br>'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Consumption Entry Failed'
			);
		}
		
		return $response;
	}

		public function getConsumptionDetails()
	{
		$query="SELECT *FROM consumption_table";
		$result=$this->db->query($query);

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
    
 }

?>