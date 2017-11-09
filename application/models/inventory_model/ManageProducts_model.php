<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class ManageProducts_model extends CI_Model{

// --------------add role model---------------------//
	public function add_role($data){		

		extract($data);

		$insert_role="INSERT INTO roles(role_name) VALUES ('$role_name')";
		$result =$this->db->query($insert_role);

		//sql query to insert new role
		if($result)
		{  
			$response=array(
				'status' => 1,
				'status_message' =>'New Role Added.<br>'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Sorry..New role Addition Failed!!!'
			);
		}
		
		return $response;

	}
// ------------------add role model ends--------------------------//

	//---------------get all products model-------------//
	function getAll_product()
	{
		$query="SELECT * FROM products";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Products are not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get all products ends--------------------------//

	//---------------get particular products model-------------//
	function getProduct_details($product_id)
	{
		$query="SELECT * FROM products WHERE product_id='$product_id'";
		$result = $this->db->query($query);
		//return $result['num'];

		if($result->num_rows() <= 0)
		{  
			$response=array(
				'status'	=>	0,
				'status_message' =>'Product is not defined yet!!!'
			);
			return $response;
		}
		else
		{
			$response=$result->result_array();
			return $response;
		}
	}
	//----------------get particular products ends--------------------------//

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