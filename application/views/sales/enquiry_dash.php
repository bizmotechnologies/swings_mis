<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enquiry Dashboard</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css"> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script> -->
</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-dashboard"></i> Enquiry Dashboard</b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">
      <div class="w3-col l12">
        <a class="btn w3-col l2  w3-round-xxlarge w3-card-4 w3-center w3-hover-light-blue w3-red w3-padding-16 w3-margin-right w3-margin-bottom" href="<?php echo base_url(); ?>inventory/manage_materials/raise_enquiry">
          <div class="w3-col l12"><i class="fa fa-question w3-xxxlarge"></i></div> 
          <div class="w3-col l12"><br>
            <span class="w3-small">Manage Enquiries</span>
          </div>
        </a>

        <a class="btn w3-col l2  w3-round-xxlarge w3-card-4 w3-center w3-hover-light-blue w3-red w3-padding-16 w3-margin-right w3-margin-bottom" href="#">
          <div class="w3-col l12"><i class="fa fa-copy w3-xxxlarge"></i></div> 
          <div class="w3-col l12"><br>
            <span class="w3-small">Manage Quotations</span>
          </div>
        </a>

        <a class="btn w3-col l2  w3-round-xxlarge w3-card-4 w3-center w3-hover-light-blue w3-red w3-padding-16 w3-margin-right w3-margin-bottom" href="#">
          <div class="w3-col l12"><i class="fa fa-file-text w3-xxxlarge"></i></div>
          <div class="w3-col l12"><br>
            <span class="w3-small">Manage Purchase Orders</span>
          </div>
        </a>
       
      </div>      
    </div>




    <!-- End page content -->
  </div>

</body>
</html>
