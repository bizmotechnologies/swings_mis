<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Profiles</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/manage_profile.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-dropbox"></i> All Profiles</b></h5>
    </header>

    <div class="w3-col l12">
     <span class="w3-label w3-right w3-margin-right"><a href="<?php echo base_url(); ?>inventory/manage_profiles" class="btn w3-blue w3-small"><b><i class="fa fa-plus"></i> Add Profile</b></a></span>
   </div>

   <div class="w3-col l12 w3-padding-small">
    <?php  
    if($all_profiles['status']!=0){
      foreach ($all_profiles['status_message'] as $key) {

        echo '
        <div class="w3-col l1 s3 m3 w3-red w3-card-2 w3-round w3-padding-tiny w3-text-white w3-hover-opacity" style="margin:5px">
        <div class="w3-col l12">
          <a href="'.base_url().'inventory/manage_profiles/DeleteProfile?profile_id='.$key['profile_id'].'" class="btn delete w3-right" title="Remove Profile" style="padding:0;margin:0"><i class="fa fa-remove"></i></a>
          <a href="#" class="btn delete w3-left" title="Edit Profile" style="padding:0;margin:0"><i class="fa fa-edit"></i></a>
        </div>
        <a class="btn w3-col l12" data-toggle="modal" data-target="#view_profile_'.$key['profile_id'].'" style="margin:0;padding:0">
        <div class=" profile_pic img-thumbnail" style="background-image:url(\''.base_url().$key['profile_image'].'\')"></div>
        <div class="w3-col l12 w3-center"><hr style="margin:0;padding:0"><span class="w3-small">'.$key['profile_name'].'</span></div>
        </a>

        </div>';

        echo '
        <!-- Modal to show profile details-->
        <div id="view_profile_'.$key['profile_id'].'" class="modal fade" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">                
        <div class="modal-body">
        <div class="row w3-padding-small w3-small">
        <div class="w3-col l12">
        <div class="w3-col l12"><label class="w3-medium"><i class="fa fa-pinterest"></i> Profile details</label></div>
        <div class="w3-col l7">
        <div class="w3-col l12">
        <div class="w3-col l7">
        <span class="w3-right w3-tiny">Profile Name:</span>
        </div>
        <div class="w3-col l5 w3-padding-left">
        <span><b>'.$key['profile_name'].'</b></span>
        </div>
        </div>
        <div class="w3-col l12">
        <div class="w3-col l7">
        <span class="w3-right w3-tiny">Product Description:</span>
        </div>
        <div class="w3-col l5 w3-padding-left">
        <span><b>'.$key['product_description'].'</b></span>
        </div>
        </div>                          
        </div>
        <div class="w3-col l5">
        <div class="w3-padding-tiny profile_picLg img-thumbnail" style="background-image:url(\''.base_url().$key['profile_image'].'\')"></div>       
        </div>
        </div>
        <div class="w3-col l12">
        <div class="w3-col l12"><label class="w3-medium"><i class="fa fa-cubes"></i> Materials Associated</label></div>     
        <div class="w3-col l12 w3-margin-left w3-padding-left">';

        foreach (json_decode($key['material_associated'],TRUE) as $mat) { 
          echo '
          <table class="table">
          <tbody>
          <tr>
          <td>
          <div class="w3-padding-tiny profile_pic img-thumbnail" style="background-image:url(\''.base_url().$mat['material_image'].'\')"></div>
          </td>
          <td>
          <div class="w3-col l12">
          <div class="w3-col l12"><span class="w3-tiny">Material Name:</span> <b>'.$mat['material_name'].'</b></div>
          <div class="w3-col l12"><span class="w3-tiny">Total ID Units Needed:</span> <b>'.$mat['ID_quantity'].'</b></div>
          <div class="w3-col l12"><span class="w3-tiny">Total OD Units Needed Name:</span> <b>'.$mat['OD_quantity'].'</b></div>
          <div class="w3-col l12"><span class="w3-tiny">Total Length Units Needed:</span> <b>'.$mat['length_quantity'].'</b></div>
          <div class="w3-col l12"><span class="w3-tiny">Total Units of Material:</span> <b>'.$mat['material_quantity'].'</b></div>
          </div>
          </td>
          </tr>
          </tbody>
          </table>';
        }
        echo '
        </div>      
        </div>
        </div>        
        </div>
        </div>
        </div>
        </div>
        <!-- modal ends here -->
        ';
      }
    }
    else{
      echo '<div class="w3-col l12 alert alert-warning"><label class="w3-center w3-text-red w3-margin-left">'.$all_profiles['status_message'].'</label></div>';
    }
    ?>   
  </div>
</div>


<!-- script to add more material div  -->
<script></script>
<!-- script to add more material end -->


</body>
</html>


