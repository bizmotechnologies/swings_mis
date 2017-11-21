<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model{

// --------------add feature model---------------------//
	public function add_feature($data){		

		extract($data);

		$insert_feature="INSERT INTO features (feature_title, feature_description,roles) VALUES ('$feature_title', '$feature_description','$role_features')";
		$result =$this->db->query($insert_feature);

		//sql query to insert new feature
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'New Feature Added.<br> Add More...'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..New feature Addition Failed!!!'
			);
		}
		
		return $response;

	}
// ------------------add feature model ends--------------------------//

	//---------------get all features model-------------//
	function getAll_feature()
	{
		$query="SELECT * FROM features";
		$result = $this->db->query($query);
		//return $result['num'];
		
		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'No any Feature added !!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all features ends--------------------------//


	//---------------edit features model-------------//
	function edit_feature($data)
	{
		extract($data);
		
		// $query="UPDATE rules SET rule_title='$rule_title', rule_content= '$rule_content' WHERE rule_id=".$rule_id." ";
		$data = array(
			'feature_title' => $editfeature_title,
			'feature_description' => $editfeature_desc,
			'roles'	=>	$editfeature_roles
		);
		
		$this->db->where('feature_id', $editfeature_id);
		$result =$this->db->update('features', $data); 
		
		if($result){
			return "Updated successfully";
		}
		else{
			return "Updation failed";
		}
	}
	//----------------edit features ends--------------------------//


	//---------------delete features model-------------//
	function del_feature($data)
	{
		extract($data);
		$query="DELETE FROM features WHERE feature_id=".$feature_id." ";	
		
		if($this->db->query($query)){
			$response=array(
				'status' => 1,
				'status_message' =>'Rule deleted Successfully.'			
			);
		}
		else
		{
			//insertion failure
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..Rule Deletion Failed!!!'			
			);
		}

		return $response;
	}
	//----------------delete features ends--------------------------//

	//---------------get roles for features model-------------//
	function get_roles($feature_id)
	{
		$query="SELECT roles FROM features WHERE feature_id=".$feature_id." ";	
		$result = $this->db->query($query);
		//return $result['num'];
		
		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'No any Feature added !!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get roles for features ends--------------------------//


	//---------------get all settings model-------------//
	function getAll_settings()
	{
		$query="SELECT * FROM customize_settings";
		$result = $this->db->query($query);
		//return $result['num'];
		
		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'No any Setting found !!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all settings ends--------------------------//

	//---------------edit calculating parameters model-------------//
	function update_calcParams($data)
	{
		extract($data);
		
		$query_cut="UPDATE customize_settings SET setting_value='$cut_value' WHERE setting_name='cut_value' ";
		$result_cut =$this->db->query($query_cut);

		$query_landing="UPDATE customize_settings SET setting_value='$landing_value' WHERE setting_name='landing_value' ";
		$result_landing =$this->db->query($query_landing);

		$query_profit="UPDATE customize_settings SET setting_value='$profit_margin' WHERE setting_name='profit_margin' ";
		$result_profit =$this->db->query($query_profit);
		
		
		if($result_cut && $result_profit && $result_landing){
			$response=array(
				'status'	=>	1,
				'status_message'	=>	'Updated successfully'
			);
			return $response;
		}
		else{
			$response=array(
				'status'	=>	0,
				'status_message'	=>	'Updation failed'
			);
			
			return $response;
		}
	}
	//----------------edit calculating parameters ends--------------------------//
}
?>