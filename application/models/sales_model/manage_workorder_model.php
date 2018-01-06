<?php
class Manage_workorder_model extends CI_model
{
  function __construct()
  {
    parent::__construct();
  }

//------------------get all wo information model---------------------
  public function get_all_woinfo()
  {
   $query = "SELECT * FROM wo_master";
   $result=$this->db->query($query);  

   if ($result->num_rows() <= 0) 
   {
    $response = array(                                             
      'status' => 0,
      'status_message' => 'No Work Order Found.');                           
  } else {
    $response = array(
      'status' => 1,
      'status_message' => $result->result_array());
  }
  return $response;
}
//------------------get all wo information model---------------------

//------------------print all wo information model---------------------
  public function print_WO($wo_id)
  {
   $query = "SELECT * FROM wo_production WHERE wo_id='$wo_id' AND current_status='1'";
   $result=$this->db->query($query);  

   if ($result->num_rows() <= 0) 
   {
    $response = array(                                             
      'status' => 0,
      'status_message' => 'No Work Order Found.');                           
  } else {
    $response = array(
      'status' => 1,
      'status_message' => $result->result_array());
  }
  return $response;
}
//------------------print all wo information model---------------------


public function show_WO_id_info($wo_id)
{
  $query = "SELECT * FROM wo_master WHERE wo_id = '$wo_id'";
  $result=$this->db->query($query);  
  if ($result->num_rows() <= 0) 
  {
    $response = array(                                             
      'status' => 0,
      'status_message' => 'Record for Work Order Not Found.');                           
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


public function sendTo_Prod($data) {
        extract($data);
        $wo_details=Manage_workorder_model::show_WO_id_info($wo_number);
        
        $products=$wo_details['status_message'][0]['product_associated'];
        //print_r($products);die();
         //---------------if record not found-------------
        if ($wo_details['status']==0) {
            $response = array(
                'status' =>0,
                'status_message' => 'Work Order record not found');
            return $response;
            die();
        }

        $insert_prod = "INSERT INTO wo_production(wo_id,customer_name,product_associated,wo_drawings,modified_ID,modified_OD,modified_length,dated,start_date,start_time,end_date,end_time,current_status,branch_name) VALUES ('$wo_number','$wo_customerName','$products','$wo_drawing','$ID','$OD','$length',now(),'','','','','1','$branch_name')";
    //echo $insert_prod;die();
        if ($this->db->query($insert_prod)) {
            $update_wo = "UPDATE wo_master SET current_status = '0' WHERE wo_id = '$wo_number'";
            $this->db->query($update_wo);
            $response = array(
                'status' => 1,
                'status_message' => 'Work Order sent to Production Successfully');
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Work Order sent to Production Failed!!!');
        }
        return $response;
    }

}
?>