<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Manage_workorder extends CI_Controller
{
  public function index()
  {
    $this->load->database();
    $this->load->model('sales_model/manage_workorder_model');
    $data['wo_info']=$this->manage_workorder_model->get_all_woinfo();
    $this->load->view('includes/navigation.php');
    $this->load->view('sales/manage_workorder.php',$data);
  } 

  public function get_all_woinfo() 
  {
   $path=base_url();
   $url = $path.'api/Wo_get_all_infoapi/get_all_woinfo';   
         // $url = $path.'api/Wo_get_all_infoapi/get_all_wo_id?wo_id='.$wo_id;	   
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_HTTPGET, true);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   $response_json = curl_exec($ch);
   curl_close($ch);
   $response=json_decode($response_json, true);
   return $response;
 }


 public function show_WO_id_info()
 {
  extract($_POST);
          //print_r($_POST);
  $path=base_url();
  $url = $path.'api/Wo_get_all_infoapi/show_WO_id_info?wo_id='.$wo_id; 
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response=json_decode($response_json, true);
          //print_r($response);die();
          //print_r($response['status_message']);

  if ($response['status']==0) {

  } else {

    foreach ($response['status_message'] as $key) {
             //$customer_name=$response['status_message']['customer_name'];
      $date=date('d/m/Y',strtotime($key['dated'])); 
      echo '
      <div class= "w3-margin-top w3-card-2 w3-padding">
      <div class="w3-col l12">
      <table class="table table-bordered">
      <tbody>
      <tr>
      <th class="text-right">Customer ID:</th>
      <td>'.$key['customer_name'].'</th>
      <th class="text-right">Date:</td>
      <td>'.$date.'</td>
      <th class="text-right">Work Order No:</th>
      <td>#WO-0'.$key['wo_id'].'</td>
      </tr>
      </tbody>
      </table>
      </div>

      <table class="table table-bordered table-responsive">
      <thead>
      <tr>
      <th class="text-center">Sr.</th>
      <th class="text-center">Profile</th>
      <th class="text-center">Material</th>
      <th class="text-center">ID</th>
      <th class="text-center">OD</th>
      <th class="text-center">Length</th>
      <th class="text-center">Qty</th>
      <th class="text-center">per Piece (<i class="fa fa-inr"></i>)</th>
      </tr>
      </thead>
      <tbody>';
      $count=1;
      foreach (json_decode($key['product_associated'],TRUE) as $row) {
                  
        //-----------------get profile name----------------------
        $path=base_url();
        $url = $path.'api/ManageProfile_api/profileDetails?profile_id='.$row['profile_id']; 
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);
        $profile_name=($response['status_message'][0]['profile_name']);
        //echo $profile_name;
        //------------------get profile name ends---------------------------
        echo '
        <tr>
        <td class="text-center">
        <label>'.$count.'.</label>
        </td>
        <td class="text-center">
        <label>'.$profile_name.'</label>
        </td>
        <td class="text-center">
        <label>';
        foreach ($row['material_associated'] as $material) {
          echo($material['material_id']).'+';
        }  
        echo '</label>
        </td>
        <td class="text-center">
        <label>'.$row['Prod_ID'][0].'</label>
        </td>
        <td class="text-center">
        <label>'.$row['Prod_OD'][0].'</label>
        </td>
        <td class="text-center">
        <label>'.$row['Prod_length'][0].'</label>
        </td>
        <td class="text-center">
        <label>'.$row['product_quantity'].'</label>
        </td>
        <td class="text-center">
        <label>'.number_format($row['product_price']/$row['product_quantity'], 2, '.', '').'</label>
        </td>
        </tr>
        <tr>
        <td colspan="8" class="text-center">
        <div class="w3-col l12">
        <div class="w3-col l4"></div>        
        <div class="w3-col l10">
          <a class="w3-right w3-margin-bottom btn w3-text-red w3-small fa fa-plus" id="more_imageBtn_'.$count.'" name="more_imageBtn" style="padding:0"> Add More (max. 6 images)</a>
        <div class="w3-col l4 w3-padding-top">        
        <input accept="image/*" name="drawing_image[]" type="file" class="w3-input w3-margin-top" onchange="readURL(this,'.$count.',1);">
        </div>
        <div class="w3-col l8">
        <img src="" width="180px" id="profile_imagePreview_'.$count.'_1" height="180px" alt="Image will be displayed here once chosen. Image size is:(100px * 80px)" class="img-thumbnail">
        </div>
        <div id="more_image_div_'.$count.'"></div>
        </div>
        </div>
        
        </td>
        </tr>        
        ';
        echo ' <!-- script to add more image upload input field on button click -->

        <script>
        $(document).ready(function() {
          var max_fields      = 6;
          var wrapper         = $("#more_image_div_'.$count.'"); 
          var add_button      = $("#more_imageBtn_'.$count.'"); 

          var x = 1; 
          $(add_button).click(function(e){ 
            e.preventDefault();
            if(x < max_fields){ 
              x++; 
              $(wrapper).append(\'<div class=""><a class="delete w3-text-grey w3-right fa fa-remove" title="Delete Drawing"></a><div class="w3-col l4 w3-padding-top"><input accept="image/*" name="drawing_image[]" type="file" onchange="readURL(this,'.$count.',\'+x+\');" class="w3-input w3-margin-top"></div><div class="w3-col l8"><img src="" width="180px" id="profile_imagePreview_'.$count.'_\'+x+\'" height="180px" alt="Image will be displayed here once chosen. Image size is:(100px * 80px)" class="img-thumbnail"></div></div>\'); //add input box
            }
            else
            {
              $.alert(\'You Reached the limits\')   //alert when added more than 4 input fields
            }
          });

          $(wrapper).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent(\'div\').remove(); x--;
          })
        });

        </script>
        <!-- script ends -->';
        $count++;
      }
      echo '</tbody>
      </table>
      <button class="btn w3-button btn-block w3-red w3-margin-top w3-margin-bottom" type="submit" id="send_wo" name="send_wo">Send #WO-0'.$key['wo_id'].' for Production <i class="fa fa-sign-out"></i></button>                     
      <br>
      </div> 
      </div>

      ';
    }
  }


}

}
?>