<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ManageMaterials_model extends CI_Model{

	//---------------get all materials model-------------//
	function getAll_materials()
	{
		$query="SELECT * FROM materials";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Materials are not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all materials ends--------------------------//

	//---------------get particular material model-------------//
	function getMaterial_details($material_id)
	{
		$query="SELECT * FROM materials WHERE material_id='$material_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Material not found!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get particular material ends--------------------------//

	
}
?>