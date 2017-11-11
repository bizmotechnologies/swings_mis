<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
$user_name=$this->session->userdata('user_name');
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css"> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script> -->
</head>
<body class="w3-white">
<?php echo base64_decode('MTIzNDU2'); ?>
  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-black w3-animate-left w3-white" style="z-index:2px;width:120px;" id="navigation"><br>

    <div class="w3-bar-block">
      <!--__________________SEALWINGS LOGO _____________________ -->
    <!-- <div class="w3-col l12 w3-margin-bottom" style="padding: 0">
      <center><img class="img img-responsive" title="Seal Wings logo" src="<?php echo base_url(); ?>css/logos/login.jpg" width="180px" height="auto"></center>
      <hr>
    </div> -->
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu "><i class="fa fa-remove fa-fw"></i>&nbsp; Close
    </a>

    <a href="<?php echo base_url(); ?>admin/admin_dashboard" class="w3-bar-item w3-hover-text-orange w3-padding w3-center">
      <div class="w3-col l12"><i class="w3-xlarge fa fa-user-secret fa-fw"></i></div>
      <div class="w3-col l12 w3-wide w3-small" style="letter-spacing: 2px">Admin<br><br></div>      
      <div class="clear"></div>
    </a>

    <a href="<?php echo base_url(); ?>sales_enquiry/enquiry_dashboard" class="w3-bar-item w3-hover-text-orange w3-padding w3-center">
      <div class="w3-col l12"><i class="w3-xlarge fa fa-assistive-listening-systems fa-fw"></i></div>
      <div class="w3-col l12 w3-wide w3-small" style="letter-spacing: 2px">Sales Enquiry<br><br></div>      
      <div class="clear"></div>
    </a>

     <a href="<?php echo base_url(); ?>admin/manage_users" class="w3-bar-item w3-hover-text-orange w3-padding w3-center">
      <div class="w3-col l12"><i class="w3-xlarge fa fa-money fa-fw"></i></div>
      <div class="w3-col l12 w3-wide w3-small" style="letter-spacing: 2px">Accountant<br><br></div>      
      <div class="clear"></div>
    </a>

    <a href="<?php echo base_url(); ?>orders/manage_quotations" class="w3-bar-item w3-hover-text-orange w3-padding w3-center">
      <div class="w3-col l12"><i class="w3-xlarge fa fa-product-hunt fa-fw"></i></div>
      <div class="w3-col l12 w3-wide w3-small" style="letter-spacing: 2px">Production<br><br></div>     
      <div class="clear"></div>
    </a>

    <a href="<?php echo base_url(); ?>orders/manage_quotations" class="w3-bar-item w3-hover-text-orange w3-padding w3-center">
      <div class="w3-col l12"><i class="w3-xlarge fa fa-dropbox fa-fw"></i></div>
      <div class="w3-col l12 w3-wide w3-small" style="letter-spacing: 2px">Inventory<br><br></div>     
      <div class="clear"></div>
    </a>       

  </div>
</nav>

<!-- Top container -->
<div class="w3-bar w3-white w3-card-2 w3-large w3-padding" style="z-index:0px">
  <div class="w3-col l12">
    <div class="w3-col l6 s6">
     <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey w3-blue" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
   </div>
   <div class="w3-col l6 s6 w3-right">
    <div class="w3-col l10">
      <span class="w3-button w3-right w3-medium w3-hover-none">Welcome, <strong><?php echo $user_name; ?></strong></span>
    </div>
    <div class="w3-col l2">
      <div class="w3-right">        
        <a href="#" class="w3-button w3-padding-small"><i class="fa fa-user"></i></a>           
        <a href="<?php echo base_url(); ?>role_login/logout" title="Logout user" class="w3-button w3-padding-small"><i class="fa  fa-sign-out"></i></a> 
      </div>
    </div>

  </div>

</div>



</div>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<script>
// Get the Sidebar
var navigation = document.getElementById("navigation");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (navigation.style.display === 'block') {
    navigation.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    navigation.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  navigation.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
