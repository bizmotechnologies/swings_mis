<?php
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
   $data['info'] = Manage_profiles::getMaterialrecord();     //-------show all Raw materials
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


 //----------this function to save product profile-----------------------------

public function addProfile() { 
  extract($_POST);
  $data = $_POST;

  $material_Arr=array();  //material_image array
  $allowed_types=['gif','jpg','png','jpeg','JPG','GIF','JPEG','PNG'];
  for($i = 0; $i < count($_FILES['material_image']['name']); $i++){

    $extension = pathinfo($_FILES['material_image']['name'][$i], PATHINFO_EXTENSION); //get file extension 

    //image validating---------------------------//
    //check whether image size is less than 1 mb or not
    if($_FILES['material_image']['size'][$i] > 1048576){
      echo '<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> Image size for material '.$material_name[$i].' exceeds size limit of 1MB. Upload image having size less than 1MB</label>';
      die();
    }

    //check file is an image or not by checking extensions
    if(!in_array($extension, $allowed_types)){
      echo '<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> File uploading for material '.$material_name[$i].' is not an image file. Upload image having type gif, jpg, jpeg OR png</label>';
      die();
    }
  }
  //validating image ends---------------------------//

  $imagePath ='';
  for($i = 0; $i < count($material_name); $i++){
    if(!empty($_FILES['material_image']['name'])){
      $extension = pathinfo($_FILES['material_image']['name'][$i], PATHINFO_EXTENSION);

      $_FILES['userFile']['name'] = $profile_name.'_'.$material_name[$i].'_'.$material_ID[$i].'/'.$material_OD[$i].'.'.$extension;
      $_FILES['userFile']['type'] = $_FILES['material_image']['type'][$i];
      $_FILES['userFile']['tmp_name'] = $_FILES['material_image']['tmp_name'][$i];
      $_FILES['userFile']['error'] = $_FILES['material_image']['error'][$i];
      $_FILES['userFile']['size'] = $_FILES['material_image']['size'][$i];

      $uploadPath ='images/desktop/';  //upload images in upload/ folder
      $config['upload_path'] = $uploadPath;
          $config['allowed_types'] = 'gif|jpg|png|jpeg'; //allowed types of images           

      $this->load->library('upload', $config);  //load upload file config.
      $this->upload->initialize($config);

      if($this->upload->do_upload('userFile')){
        $fileData = $this->upload->data();
        $uploadData[$i]['file_name'] = $fileData['file_name'];
        $uploadData[$i]['created'] = date("Y-m-d H:i:s");
        $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
        $imagePath='images/desktop/'.$fileData['file_name'];
      }
    }

    $material_Arr[]=array(
      'material_name' =>  $material_name[$i],
      'material_ID' =>  $material_ID[$i],
      'material_OD' =>  $material_OD[$i],
      'material_length' =>  $material_length[$i],
      'material_quantity' =>  $material_quantity[$i],
      'material_image' =>  $imagePath

    );
  }

  $data['material_associated']=json_encode($material_Arr);

  $path = base_url();                                                   // this code is for web service AND api for save profile 
  $url = $path . 'api/ManageCustomer_api/save_CustomerDetails';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response_json = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response_json, true);
  print_r($response_json);die();

  if ($response['status'] == 0) {

    echo $response['status_message'];
  } else {
    echo $response['status_message'];
  }
}

    //----------------this fun is to save profile details end---------------//



}