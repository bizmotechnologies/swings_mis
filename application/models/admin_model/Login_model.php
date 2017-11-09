<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model{

	// -----------------------USER LOGIN API----------------------//
	//-------------------------------------------------------------//
	public function login($data)
	{
		extract($data);
				
	//sql query to check login credentials
		$query="SELECT * FROM user_tab WHERE user_name='$user_name' AND user_password='$user_password' AND user_role='$user_role'";
		$result = $this->db->query($query);

	//if credentials are true, their is obviously only one record
		if($result->num_rows() == 1){
			foreach ($result->result_array() as $row) {
				$privilege=$row['access_privilege'];
				$user_name=$row['user_name'];
				$user_id=$row['user_id'];
			}

			if ($result) {
				//response with values to be stored in sessions if update session_bool true
				$response=array(
					'status' => 1,
					'user_id' =>$user_id,
					'user_name' => $user_name,				
					'privilege' => $privilege,
					'status_message' =>'Login Successfull',
					'role' => $privilege
				);
			}
			else{
				$response=array(
					'status' => 0,
					'user_id' =>$user_id,
					'user_name' => $user_name,
					'role' => $privilege,				
					'status_message' =>'Error to start session for '.$user_name.' !!!',
				);
			}
		}
		else
		{
		//login failed response
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..Login credentials are incorrect!!!',
				'user_name' => $user_name,				
				'role' => $privilege
			);
		}
		return $response;
	}
	//----------------------------LOGIN END------------------------------//


	//---------------get all roles model-------------//
	function getAll_role()
	{
		$query="SELECT * FROM roles";
		$result = $this->db->query($query);
		//return $result['num'];
				
		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Roles are not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all roles ends--------------------------//

	//-----------------------function to check whether privilege level already exists------------------//
	function checkPrivilege_exist($privilege_level)
	{
		$query = null;
		$query = $this->db->get_where('roles', array(//making selection
			'privilege_level' => $privilege_level
		));		
		
		if ($query->num_rows() > 0) {
			return 0;			
		} else {
			return 1;			
		}
	}
//-----------------------------------function end---------------------------------------//

	//---------------edit roles model-------------//
	function edit_role($data)
	{
		extract($data);
		
		// $query="UPDATE rules SET rule_title='$rule_title', rule_content= '$rule_content' WHERE rule_id=".$rule_id." ";
		$data = array(
			'role_title' => $editrole_title,
			'role_description' => $editrole_desc
		);
		
		$this->db->where('role_id', $editrole_id);
		$result =$this->db->update('roles', $data); 
		
		if($result){
			return "Updated successfully";
		}
		else{
			return "Updation failed";
		}
	}
	//----------------edit roles ends--------------------------//


	//---------------delete roles model-------------//
	function del_role($data)
	{
		extract($data);

		$query="DELETE FROM roles WHERE role_id=".$role_id." ";	
		
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
	//----------------delete roles ends--------------------------//

	//---------------get role name by role_id model-------------//
	function getRole_name($role_id)
	{
		$query="SELECT role_name FROM roles WHERE role_id='$role_id' ";	
		
		$result =$this->db->query($query);

		$role_name="";

		foreach ($result->result_array() as $row) {
			$role_name = $row['role_name'];
		}

		return $role_name; 
	}
	//----------------get role name by role_id ends--------------------------//
}
?>