<?php
class manage_workorder_model extends CI_model
{
	     function __construct()
	     {
		      parent::__construct();
	     }

	   public function get_all_woinfo()
	   {
			
         $query = "SELECT * FROM wo_master";
         $result=$this->db->query($query);  

         if ($result->num_rows() <= 0) 
         {
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

    public function show_WO_id_info($wo_id)
     {
          $query = "SELECT * FROM wo_master WHERE wo_id = '$wo_id'";
          $result=$this->db->query($query);  
          $quotation_id ="";

        foreach ($result->result_array() as $row) {
            $quotation_id = $row['quotation_id'];
        }
        return $quotation_id;
        //print_r($quotation_id);

     /*   if ($this->db->query($query)) {
            $response = array(
            'status' => 1,
            'status_message' => $result->result_array()
          );
         }else
        {
            $response = array(
            'status' => 0,
            'status_message' => 'Failed!!!');
        }
           return $response;
*/
      }

      public function get_quotationid_info($wo_id)
      {
        $quotation_id = manage_workorder_model::show_WO_id_info($wo_id);
        $query = "SELECT * FROM quotation_master WHERE quotation_id = '$quotation_id'";
        $result=$this->db->query($query);  
        if ($this->db->query($query)) {
            $response = array(
            'status' => 1,
            'status_message' => $result->result_array()
          );
         }else
        {
            $response = array(
            'status' => 0,
            'status_message' => 'Failed!!!');
        }
           return $response;
      }
  }
 ?>