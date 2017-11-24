<?php
error_reporting(E_ERROR | E_PARSE);

class Manage_profiles extends CI_controller{

  public function __construct(){
    parent::__construct();
    $this->load->model('inventory_model/ManageMaterial_model');

    //start session   
    $user_id=$this->session->userdata('user_id');
    $user_name=$this->session->userdata('user_name');
    $privilege=$this->session->userdata('privilege');
    
    //check session variable set or not, otherwise logout
    if(($user_id=='') || ($user_name=='') || ($privilege=='')){
      redirect('role_login');
    }   
  }

  public function index(){
   $data['all_materials'] = Manage_profiles::getMaterialrecord();     //-------show all Raw materials
   $this->load->model('inventory_model/ManageProfile_model');	
   $this->load->view('includes/navigation');
   $this->load->view('inventory/profile/manage_profile',$data);

 }

 //----------this function to get material details-----------------------------
 public function getMaterialrecord() {

  $path = base_url();
  $url = $path . 'api/ManageMaterial_api/getMaterialrecord';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HTTPGET, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  return $response;
}

//----------------this fun get material details end---------------//


 //----------this function to save product profile-----------------------------//
public function addProfile() { 
  extract($_POST);
  $data = $_POST;

  $material_Arr=array();  //material_image array
  $allowed_types=['gif','jpg','png','jpeg','JPG','GIF','JPEG','PNG'];
  $extension_profile='';
  for($i = 0; $i < count($_FILES['material_image']['name']); $i++){

    $extension_material = pathinfo($_FILES['material_image']['name'][$i], PATHINFO_EXTENSION); //get material image file extension 
    $extension_profile = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION); //get profile image file extension 

    //image validating---------------------------//
    //check whether image size is less than 1 mb or not
    if($_FILES['material_image']['size'][$i] > 1048576){  //for material images
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> Image size for material '.$material_name[$i].' exceeds size limit of 1MB. Upload image having size less than 1MB</label>';
      die();
    }
    if($_FILES['profile_image']['size'] > 1048576){ //for profile image
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> Profile Image size exceeds size limit of 1MB. Upload image having size less than 1MB</label>';
      die();
    }

    //check file is an image or not by checking extensions
    if(!in_array($extension_material, $allowed_types)){  //for material images
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> File uploading for material '.$material_name[$i].' is not an image file. Upload image having type gif, jpg, jpeg OR png</label>';
      die();
    }
    if(!in_array($extension_profile, $allowed_types)){  //for profile image
      echo '<label class="w3-small w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> File uploading for profile '.$profile_name.' is not an image file. Upload image having type gif, jpg, jpeg OR png</label>';
      die();
    }
  }
  //validating image ends---------------------------//

  //uploading profile image-------------------------------//
  $profileImg_path='';

  if(!empty($_FILES['profile_image']['name'])){
      $_FILES['profile_image']['name']=$profile_name.'.'.$extension_profile;

      $config['upload_path']  = 'images/desktop/';
      $config['allowed_types']= 'gif|jpg|png|jpeg';
      $config['overwrite']   = TRUE;

    $this->load->library('upload', $config);
    $this->upload->initialize($config);
    if($this->upload->do_upload('profile_image'))
    {
      $profileImg_path='images/desktop/'.$profile_name.'.'.$extension_profile;
    }

  }
  //uploading profile image ends-------------------------//

  $imagePath ='';
  for($i = 0; $i < count($material_name); $i++){
    if(!empty($_FILES['material_image']['name'])){
      $extension = pathinfo($_FILES['material_image']['name'][$i], PATHINFO_EXTENSION);

      $_FILES['userFile']['name'] = $profile_name.'_'.$material_name[$i].'_'.$ID_quantity[$i].'-'.$OD_quantity[$i].'.'.$extension;
      $_FILES['userFile']['type'] = $_FILES['material_image']['type'][$i];
      $_FILES['userFile']['tmp_name'] = $_FILES['material_image']['tmp_name'][$i];
      $_FILES['userFile']['error'] = $_FILES['material_image']['error'][$i];
      $_FILES['userFile']['size'] = $_FILES['material_image']['size'][$i];

      $uploadPath ='images/desktop/';  //upload images in images/desktop/ folder
      $config['upload_path'] = $uploadPath;
      $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           
      $config['overwrite'] = TRUE;            

      $this->load->library('upload', $config);  //load upload file config.
      $this->upload->initialize($config);

      if($this->upload->do_upload('userFile')){
        $fileData = $this->upload->data();
        $imagePath='images/desktop/'.$fileData['file_name'];
      }
    }

    $material_Arr[]=array(
      'material_id' =>  $material_id[$i],
      'material_name' =>  $material_name[$i],
      'ID_quantity' =>  $ID_quantity[$i],
      'OD_quantity' =>  $OD_quantity[$i],
      'length_quantity' =>  $length_quantity[$i],
      'material_quantity' =>  $material_quantity[$i],
      'material_image' =>  $imagePath
    );
  }

  $data['material_associated']=json_encode($material_Arr);
  $data['profile_image']=($profileImg_path);
  
  $path = base_url();                                                   // this code is for web service AND api for save profile 
  $url = $path . 'api/ManageProfile_api/save_Profile';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  
  if ($response['status'] == 0) {
    echo '<div class="alert alert-danger">
      <strong>'.$response['status_message'].'</strong> 
      </div>
      <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
        location.reload();
      }, 1000);
      </script>';
  } else {
    echo '<div class="alert alert-success">
      <strong>'.$response['status_message'].'</strong> 
      </div>
      <script>
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
        location.reload();
      }, 1000);
      </script>';
  }
}
//----------------this fun is to save profile details end---------------//



}