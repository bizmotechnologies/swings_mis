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
		
		$privilege='';
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
					'branch_name' => $user_branch,
					'status_message' =>'Login Successfull',
					'role' => $privilege
				);
			}
			else{
				$response=array(
					'status' => 0,
					'user_id' =>$user_id,
					'user_name' => $user_name,
					'branch_name' => $user_branch,
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
				'branch_name' => $user_branch		
			);
		}
		return $response;
	}
	//----------------------------LOGIN END------------------------------//


	//-----------------------function to check whether privilege level already exists------------------//
	function checkPrivilege_exist($privilege_level)
	{
		$query = null;
		$query = $this->db->get_where('roles', array(
			'privilege_level' => $privilege_level
		));		
		
		if ($query->num_rows() > 0) {
			return 0;			
		} else {
			return 1;			
		}
	}
//-----------------------------------function end---------------------------------------//

}
?>