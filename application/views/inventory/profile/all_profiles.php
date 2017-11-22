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
   
    echo '<div class="w3-col l1 w3-red w3-card-2 w3-round w3-padding-tiny w3-text-white" style="margin:5px">
      <div class=" profile_pic img-thumbnail" style="background-image:url(\''.base_url().$key['profile_image'].'\')"></div>
      <div class="w3-col l12 w3-center"><span class="w3-small">'.$key['profile_name'].'</span></div>
    </div>';
}
    }
    else{
      echo '<div class="w3-col l12"><label class="w3-center w3-text-red">'.$all_profiles['status_message'].'</label></div>';
    }
    ?>   
  </div>
</div>


<!-- script to add more material div  -->
<script></script>
<!-- script to add more material end -->


</body>
</html>


