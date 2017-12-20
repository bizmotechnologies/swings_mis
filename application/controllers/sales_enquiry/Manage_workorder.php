<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);

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

//---------------------------SHOW WO information when clicked------------------------
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
      <form id="addWO_form" enctype="multipart/form-data">
      <input type="hidden" name="wo_customerName" value="'.$key['customer_name'].'">
      <input type="hidden" name="wo_number" value="'.$key['wo_id'].'">
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
        <span>'.$count.'.</span>
        </td>
        <td class="text-center">
        <span>'.$profile_name.'<input class="form-control" name="profile_name[]" value="'.$profile_name.'" type="text"></span>
        </td>
        <td class="text-center">
        <span>';
        foreach ($row['material_associated'] as $material) {
          echo($material['material_id']).'+';
        }  
        echo '</span>
        </td>
        <td class="text-center">
        <span>'.$row['Prod_ID'][0].'</span>
        </td>
        <td class="text-center">
        <span>'.$row['Prod_OD'][0].'</span>
        </td>
        <td class="text-center">
        <span>'.$row['Prod_length'][0].'</span>
        </td>
        <td class="text-center">
        <span><input class="form-control" name="wo_quantity[]" value="'.$row['product_quantity'].'" style="width:60px" type="number"></span>
        </td>
        <td class="text-center">
        <span>'.number_format($row['product_price']/$row['product_quantity'], 2, '.', '').'</span>
        </td>
        </tr>
        <tr>
        <td colspan="8" class="text-center">
        <div class="w3-col l12">
        <div class="w3-col l4"></div>        
        <div class="w3-col l10">
        <a class="w3-right w3-margin-bottom btn w3-text-red w3-small fa fa-plus" id="more_imageBtn_'.$count.'" name="more_imageBtn" style="padding:0"> Add More (max. 6 images)</a>
        <div class="w3-col l4 w3-padding-top">        
        <input accept="image/*" name="drawing_image_'.$count.'[]" type="file" class="w3-input w3-margin-top" onchange="readURL(this,'.$count.',1);">
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
              $(wrapper).append(\'<div class=""><a class="delete w3-text-grey w3-right fa fa-remove" title="Delete Drawing"></a><div class="w3-col l4 w3-padding-top"><input accept="image/*" name="drawing_image_'.$count.'[]" type="file" onchange="readURL(this,'.$count.',\'+x+\');" class="w3-input w3-margin-top"></div><div class="w3-col l8"><img src="" width="180px" id="profile_imagePreview_'.$count.'_\'+x+\'" height="180px" alt="Image will be displayed here once chosen. Image size is:(100px * 80px)" class="img-thumbnail"></div></div>\'); //add input box
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
      <div class="w3-center">
      <button class="w3-button w3-red w3-margin-top w3-margin-bottom" type="submit"><i class="fa fa-print"></i> Print #WO-0'.$key['wo_id'].'</button>
      </div>
      </form>
      <br>
      </div> 
      </div>
      <script>
      $(document).ready(function (e){
        $("#addWO_form").on(\'submit\',(function(e){  
          e.preventDefault();        
          $.ajax({
            url: BASE_URL + "sales_enquiry/Manage_workorder/addWO",
            type: "POST",
            data:  new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            success: function(data){
              $.alert(data);
            },
            error: function(){}             
          });
        }));
      });
      </script>
      ';
    }
  }
}
//-------------------------end of show WO function----------------------//

//----------this function to save WO profile-----------------------------//
public function addWO() { 
  extract($_POST);
  //print_r($_POST);print_r($_FILES);die();
  $data = $_POST;

  $drawing_Arr=array();  //material_image array
  $allowed_types=['gif','jpg','png','jpeg','JPG','GIF','JPEG','PNG'];

  for($j = 1; $j <= count($profile_name); $j++){
    for($i = 0; $i < count($_FILES['drawing_image_'.$j]['name']); $i++){

    $extension_drawing = pathinfo($_FILES['drawing_image_'.$j]['name'][$i], PATHINFO_EXTENSION); //get material image file extension 

    //image validating---------------------------//
    //check whether image size is less than 1 mb or not
    if($_FILES['drawing_image_'.$j]['size'][$i] > 1048576){  //for material images
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> Image size for material '.$profile_name[$i].' exceeds size limit of 1MB. Upload image having size less than 1MB</label>';
      die();
    }
    
    //check file is an image or not by checking extensions
    if(!in_array($extension_drawing, $allowed_types)){  //for material images
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> File uploading for material '.$profile_name[$i].' is not an image file. Upload image having type gif, jpg, jpeg OR png</label>';
      die();
    }
    
  }
}
  //validating image ends---------------------------//

$imagePath ='';
$count=1;
$main_drawingArr=array();
for ($j=0; $j < count($profile_name); $j++) {
  for($i = 0; $i < count($_FILES['drawing_image_'.$count]['name']); $i++){
    if(!empty($_FILES['drawing_image_'.$count]['name'])){
      $extension = pathinfo($_FILES['drawing_image_'.$count]['name'][$i], PATHINFO_EXTENSION);

      $_FILES['userFile']['name'] = '#WO'.$wo_number.'_'.$profile_name[$j].'_drawing'.$i.'.'.$extension;
      $_FILES['userFile']['type'] = $_FILES['drawing_image_'.$count]['type'][$i];
      $_FILES['userFile']['tmp_name'] = $_FILES['drawing_image_'.$count]['tmp_name'][$i];
      $_FILES['userFile']['error'] = $_FILES['drawing_image_'.$count]['error'][$i];
      $_FILES['userFile']['size'] = $_FILES['drawing_image_'.$count]['size'][$i];

      $uploadPath ='images/wo_drawings/';  //upload images in images/desktop/ folder
      $config['upload_path'] = $uploadPath;
      $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           
      $config['overwrite'] = TRUE;            

      $this->load->library('upload', $config);  //load upload file config.
      $this->upload->initialize($config);

      if($this->upload->do_upload('userFile')){
        $fileData = $this->upload->data();
        $imagePath='images/wo_drawings/'.$fileData['file_name'];
      }
      $drawing_Arr[]= $imagePath;
      //$drawing_Arr[]= $_FILES['userFile']['name'];
    }
  }
  $main_drawingArr[]=$drawing_Arr;
  unset($drawing_Arr);
  $count++;   
}
$data['wo_drawing']=json_encode($main_drawingArr);
$data['quantities']=json_encode($wo_quantity);

// this code is for web service AND api for save production
$path = base_url();                                                    
$url = $path . 'api/Wo_get_all_infoapi/sendToProd';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);
curl_close($ch);
$response = json_decode($response_json, true);
//print_r($response_json);die();

if ($response['status'] == 0) {
  echo '<div class="alert alert-danger">
  <strong>'.$response['status_message'].'</strong> 
  </div>';
} else {
  echo '<div class="alert alert-success">
  <strong>'.$response['status_message'].'</strong> 
  </div>';
}
}
//----------------this fun is to save WO details end---------------//



}
?>