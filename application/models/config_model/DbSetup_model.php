<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class DbSetup_model extends CI_Model{

	public function __construct(){}

	//----------function to auto load databse and tables if not exist------------------//
	public function createDbSchema(){		

		if($this->load->dbforge())
		{
			include('db_tables.php');
		}
		else {
			$this->dbforge->create_database('swing_db', TRUE);
			$this->db->query('use swing_db');
			include('db_tables.php');
		}

	}
	//---------------------function ends---------------//


	//----------function to get next auto increment value of primary key in particular table------------------//
	public function get_AutoIncrement($table_schema,$table_name){		

		$sql="SELECT AUTO_INCREMENT FROM information_schema.tables WHERE Table_SCHEMA = '$table_schema' AND table_name = '$table_name' ";
  		$result =$this->db->query($sql);

  		$response=$result->result_array();
  		return $response[0]['AUTO_INCREMENT'];
	}
	//---------------------function ends---------------//
}
?>