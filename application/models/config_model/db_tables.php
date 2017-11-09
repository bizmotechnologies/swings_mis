<?php 

// -----------User Roles Table--------------------//
//-------------------------------------------------//
// define table fields
		$fields = array(
			'role_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'role_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 30
			),
			'privilege_level' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'features_visible' => array(
				'type' => 'TEXT'				
			),
			'total_users' => array(
				'type' => 'INT',
				'constraint' => 11
			)
		);

		$this->dbforge->add_field($fields);

		// define primary key
		$this->dbforge->add_key('role_id', TRUE);

		// create table
		$this->dbforge->create_table('roles',TRUE);

		//$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id) REFERENCES table(id)');
//----------------Table END----------------------------//
//------------------------------------------------------//

// -----------Operator Table--------------------//
//-------------------------------------------------//
// define table fields
		$fields = array(
			'operator_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'role_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'index'	=> TRUE
			),
			'operator_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => 255				
			),
			'IsLive' => array(
				'type' => 'INT',
				'constraint' => 11
			),
			'features_visible' => array(
				'type' => 'TEXT'
			)
		);

		$this->dbforge->add_field($fields);

		// define primary key
		$this->dbforge->add_key('operator_id', TRUE);

		// create table
		$this->dbforge->create_table('operator',TRUE);
//
		$this->db->query('ALTER TABLE operator ADD INDEX(role_id)');

		$this->db->query('ALTER TABLE operator ADD FOREIGN KEY(role_id) REFERENCES roles(role_id) ON DELETE CASCADE ON UPDATE CASCADE');


//----------------Table END----------------------------//
//------------------------------------------------------//


// -----------System Features Table--------------------//
//-------------------------------------------------//
// define table fields
		$fields = array(
			'feature_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => TRUE
			),
			'feature_title' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			),
			'feature_description' => array(
				'type' => 'VARCHAR',
				'constraint' => 255
			)
		);

		$this->dbforge->add_field($fields);

		// define primary key
		$this->dbforge->add_key('feature_id', TRUE);

		// create table
		$this->dbforge->create_table('features',TRUE);

		//$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id) REFERENCES table(id)');
//----------------Table END----------------------------//
//------------------------------------------------------//



?>