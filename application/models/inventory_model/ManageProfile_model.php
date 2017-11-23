<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class ManageProfile_model extends CI_Model{

	//-------function to insert profile info to db model--------------//
	public function save_Profile($data) { 

        extract($data);
       
        $sql = "INSERT INTO product_profile(profile_name,product_description,"
                . "profile_image,material_associated"
                . ") "
                . "values ('$profile_name','$prod_description','$profile_image',"
                . "'$material_associated')";

        $result = $this->db->query($sql);

        if ($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Profile Added Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Profile Addition Failed...!');
        }
       
        return $response;
    }
	//---------function ends------------------//


	//-------------function to get all profile data-----------//
	 public function getAll_profile() { 

        $sqlselect = "SELECT * FROM product_profile";

        $result = $this->db->query($sqlselect);

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

    /* ends here */
	//------------------function ends-------------------------//

	

}
?>