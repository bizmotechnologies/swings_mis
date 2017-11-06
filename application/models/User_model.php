<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model{

// --------------add user model---------------------//
	public function add_user($data){		
		extract($data);
		$insert_feature="INSERT INTO user_tab(user_name, user_password,user_role, access_privilege) VALUES ('$user_name', '$user_password','$user_role','$user_role')";
		$result =$this->db->query($insert_feature);

		//sql query to insert new user
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'New User Added...'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..New user Addition Failed!!!'
			);
		}		
		return $response;
	}
// ------------------add user model ends--------------------------//

	//-------------------set access privilege---------------------//
	// public function getAccess_privilege($role_id)
	// {
	// 	$access_privilege="";
	// 	switch ($role_id) {

	// 		case '1':
	// 			$access_privilege
	// 		break;
			
	// 		default:
				
	// 		break;
	// 	}
	// }
	//--------------------function ends----------------------------//

	//---------------get all users model-------------//
	function getAll_users()
	{
		$query="SELECT * FROM user_tab";
		$result = $this->db->query($query);
		//return $result['num'];	

		$user_data=array();
		
		foreach ($result->result_array() as $row) 
		{

			$this->load->model('manageRole_model');
			$role_name=$this->manageRole_model->getRole_name($row['user_id']);
			
			$extra=array(
				'user_id'	=>	$row['user_id'],
				'user_name'	=>	$row['user_name'],
				'user_password'	=>	$row['user_password'],
				'user_role'	=>	$row['user_role'],
				'user_roleName'	=>	$role_name,
				'access_privilege'	=>	$row['access_privilege']
			);
			$user_data[]=$extra;
		}
		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'No any User available !!!'
			);
			return $response;
		}
		else
		{
			$response=$user_data;
			return $response;
		}
	}
	//----------------get all user ends--------------------------//


	//---------------edit user model-------------//
	function edit_user($data)
	{
		extract($data);
		
		// $query="UPDATE rules SET rule_title='$rule_title', rule_content= '$rule_content' WHERE rule_id=".$rule_id." ";
		$data = array(
			'user_name' => $edit_userName,
			'user_password' => $edit_userPassword,
			'user_role'	=>	$edit_userRole,
			'access_privilege'	=>	$edit_userRole
		);
		
		$this->db->where('user_id', $edituser_id);
		$result =$this->db->update('user_tab', $data); 
		
		if($result){
			return "Updated successfully";
		}
		else{
			return "Updation failed";
		}
	}
	//----------------edit user ends--------------------------//

	

	//---------------delete user model-------------//
	function del_user($data)
	{
		extract($data);
		$query="DELETE FROM user_tab WHERE user_id=".$user_id." ";	
		
		if($this->db->query($query)){
			$response=array(
				'status' => 1,
				'status_message' =>'User deleted Successfully.'			
			);
		}
		else
		{
			//insertion failure
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..User Deletion Failed!!!'			
			);
		}

		return $response;
	}
	//----------------delete user ends--------------------------//

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

	
}
?>