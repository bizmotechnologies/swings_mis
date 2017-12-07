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

        $sqlselect = "SELECT * FROM product_profile WHERE status = '1'";

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
//------------------function for delete profile image from profile-------------------------//

    public function DeleteProfile($profile_id){
            
        $sqldelete = "UPDATE product_profile SET status = '0' WHERE profile_id = '$profile_id'";

        $resultdelete = $this->db->query($sqldelete);

        if ($resultdelete) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Deleted Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Deleted Successfully...!');
        }
        return $response;
        }
	//------------------function for delete profile image from profile-------------------------//
	//------------------function for update profile -------------------------//

        public function UpdateProfile($data){
            extract($data);
            //print_r($data);die();
        $sqlupdate = "UPDATE product_profile SET profile_name = '$profile_name',"
                . " product_description = '$prod_description', profile_image = '$profile_image',"
                . " material_associated = '$material_associated' WHERE profile_id = '$profile_id'";
        
        $resultupdate = $this->db->query($sqlupdate);

        if ($resultupdate) {
            $response = array(
                'status' => 1,
                'status_message' => 'Records Updated Successfully..!');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Records Not Updated Successfully...!');
        }
        return $response;
        }
      //------------------function for update profile -------------------------//

}
?>