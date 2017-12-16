<?php
class Manage_workorder_model extends CI_model
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
  if ($result->num_rows() <= 0) 
  {
    $response = array(                                             
      'status' => 0,
      'status_message' => 'No Records Found.');                           
  } else {
    $data=$result->result_array();
    $quotation_id=$data[0]['quotation_id'];

    $this->load->model('sales_model/Enquiry_model');
    $quotation_details=$this->Enquiry_model->getQuotation($quotation_id);

    $data[0]['customer_name']=$quotation_details[0]['customer_name'];
    //echo $data['customer_name'];die();
    $response = array(
      'status' => 1,
      'status_message' => $data);
  }
  return $response;

}

}
?>