<?php

error_reporting(E_ERROR | E_PARSE);

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//S-wings Manage_quotations
class Manage_quotation_specialist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //start session		
        $user_id = $this->session->userdata('user_id');
        $user_name = $this->session->userdata('user_name');
        $privilege = $this->session->userdata('privilege');

        //check session variable set or not, otherwise logout
        if (($user_id == '') || ($user_name == '') || ($privilege == '')) {
            redirect('role_login');
        }
    }

    public function index() {
        
        $this->load->model('quotation_specialist_model/ManageQuotationSpecialist_model');
        $data['wo_details'] = Manage_quotation_specialist::Get_WorkorderProduction_Details();     //-------show all materials
        $this->load->view('includes/navigation');
        $this->load->view('quotation_specialist/quotation_specialist',$data);   
    }
  //---this fun is udsed to get work order production details-----
    public function Get_WorkorderProduction_Details(){
        $path = base_url();
        $url = $path . 'api/ManageQuotation_Specialist_api/Get_WorkorderProduction_Details';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response_json);die();
        return $response;
    }
 //---this fun is udsed to get work order production details-----
   //--this fun is used to get all details of quotation specialist by wo id----//
   public function getqueryForChange(){
        extract($_POST);
        //print_r($_POST);
        $path = base_url();
        $url = $path . 'api/ManageQuotation_Specialist_api/getqueryForChange?wo_id='.$wo_id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response_json, true);
        //print_r($response);
        $customer_name = $response['status_message'][0]['customer_name'];
        $wo_id = $response['status_message'][0]['wo_id'];
        $branch_name = $response['status_message'][0]['branch_name'];
        if ($response['status']==0) {
  } 
  else {
      //----div for Customer And work order information--------------------//                                 
      echo'<div class="w3-col l12">
      <table class="table table-bordered">
      <tbody>
      <tr>
      <th class="text-right">Customer Name:</th>
      <td>'.$customer_name.'</th>
      <th class="text-right">Branch Name:</th>
      <td>'.$branch_name. '</td>
      <th class="text-right">Work Order No:</th>
      <td>#WO-0'.$wo_id.'</td>
      </tr>
      </tbody>
      </table>
      </div>';
      //----div for Customer And work order information--------------------//                                 
                $count=0;
                foreach ($response['status_message'] as $key) {
                echo'<div class="w3-col l12 w3-padding">';
                                //----div for profile--------------------//
                echo'<div class="w3-col l12 w3-margin-top">';  
                echo'<div class="w3-col l3 w3-padding-right">
                <label>Profile Name:</label>
                <label>'.$key['profile_name'].'</label>                
                </div>
                </div>';
                                //----div for profile--------------------//
                //----div for material name , changed name, and material ID--------------------//
                
                echo'<div class="w3-col l12 w3-margin-top"> 
                <input type="hidden" name="" id="sp_id_'.$key['sub_quot_specialist_id'].'">    
                <div class="w3-col l4 w3-padding-right">
                <label>Material Name:</label>
                <label>'.$key['original_material_name'].'</label>
                </div>
                
                <div class="w3-col l4 w3-padding-right">
                <label>Changed Material:</label>
                <label>'.$key['changed_material_name'].'</label>
                </div>
                
                <div class="w3-col l4 w3-padding-right">
                <label>Material ID</label>
                <label>'.$key['material_id'].'</label>
                </div>
                              
                </div>';  
                //----div for material name , changed name, and material ID--------------------//
                //----div for material OD , length, and changed length--------------------//                 
                echo'<div class="w3-col l12 w3-margin-top">
                
                <div class="w3-col l4 w3-padding-right">
                <label>Material OD:</label>
                <label>'.$key['material_od'].'</label>
                </div>
                
                <div class="w3-col l4 w3-padding-right">
                <label>Alloted Length:</label>
                <label>'.$key['original_material_length'].'</label>
                </div>
                
                <div class="w3-col l4 w3-padding-right">
                <label>Changed length:</label>
                <label>'.$key['changed_material_length'].'</label>
                </div>
                                               
                </div>';
                //----div for material OD , length, and changed length--------------------//                 
                //----div for reason of change in material length and material name--------------------//                 
                echo'<div class="w3-col l12 w3-padding-right w3-margin-top">
                
                <label>Reason For Change in Length/Material :</label>
                <label>'.$key['reason_changed_length_material'].'</label>
                          
                </div>';
                //----div for reason of change in material length and material name--------------------//                 
                //----div for reason of approved and rejected profile changes--------------------//                                 
                echo'<div class="w3-col l12 w3-padding-right w3-margin-top">
                
                <label>Reason For Approved/Rejected:</label>
                <input type="text" class="form-control" name="reasonForApproved_Rejected" id="reasonForApproved_Rejected_'.$key['sub_quot_specialist_id'].'">
                          
                </div>';
                //----div for reason of approved and rejected profile changes--------------------//                                 
                //----div for button of approved and rejected profile changes--------------------//                                 
                echo'<div class="w3-col l12 w3-margin-top w3-right">
                <a class="w3-button w3-red" id="approveBtn_'.$key['sub_quot_specialist_id'].'" >Approve<i class="w3-margin-left fa fa-thumbs-up"></i></a>
                <a class="w3-button w3-black" id="rejectBtn_'.$key['sub_quot_specialist_id'].'" >Reject<i class="w3-margin-left fa fa-thumbs-down"></i></a>
                </div>';
                //----div for button of approved and rejected profile changes--------------------//                                 
                
                echo'</div>';
                $count++;
                 //----script for approve query--------------------//                                 
            echo'<script>
            $("#approveBtn_'.$key['sub_quot_specialist_id'].'").click(function()
                    {
                        ReasonForApprove= $("#reasonForApproved_Rejected_'.$key['sub_quot_specialist_id'].'").val();
                        sp_id = $("#sp_id_'.$key['sub_quot_specialist_id'].'").val();
                        alert(sp_id);    
                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "quotation_specialist/Manage_quotation_specialist/approvedQuery",
                            data: {
                                ReasonForApprove: ReasonForApprove,
                                sub_quot_specialist_id: row_id,
                                Wo_id: Wo_id
                            },
                            return: false, 
                            success: function (data)
                            {
                                $.alert(data);  
                                $("#showwoQueryForProduction").load(location.href + " #showwoQueryForProduction>*", "");
                            }
                        });
                    }
            </script>';
                  //----script for approve query--------------------//                                             
                 //----script for reject query--------------------//                                 
            echo'<script>
            function rejectQuery(row_id,Wo_id)
                    {
                        ReasonForReject= $("#reasonForApproved_Rejected_"+row_id).val();

                        $.ajax({
                            type: "POST",
                            url: BASE_URL + "quotation_specialist/Manage_quotation_specialist/rejectQuery",
                            data: {
                                ReasonForReject: ReasonForReject,
                                sub_quot_specialist_id: row_id,
                                Wo_id: Wo_id
                            },
                            return: false, 
                            success: function (data)
                            {
                                $.alert(data);  
                                $("#showwoQueryForProduction").load(location.href + " #showwoQueryForProduction>*", "");
                            }
                        });
                    }
</script>';
                  //----script for reject query--------------------//                                 
                }
            }
        }
    //--this fun is used to get all details of quotation specialist by wo id----//
    
    public function approvedQuery(){
    extract($_POST);
    $data = $_POST;

    $path = base_url();
    $url = $path . 'api/ManageQuotation_Specialist_api/approvedQuery';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    
    if ($response['status'] == 0) {
            echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
        <strong>' . $response['status_message'] . '</strong> 
        </div>
        ';
        } else {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    ';
        }
    
    }
    
public function rejectQuery(){
    extract($_POST);
    $data = $_POST;

    $path = base_url();
    $url = $path . 'api/ManageQuotation_Specialist_api/rejectQuery';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response_json = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response_json, true);
    
    if ($response['status'] == 0) {
            echo'<div class="alert alert-danger w3-margin" style="text-align: center;">
        <strong>' . $response['status_message'] . '</strong> 
        </div>
        ';
        } else {
            echo'<div class="alert alert-success w3-margin" style="text-align: center;">
    <strong>' . $response['status_message'] . '</strong> 
    </div>
    ';
        }
    
    }
}
