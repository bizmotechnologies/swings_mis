<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class DbSetup_model extends CI_Model{

	public function __construct(){}

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
}
?>