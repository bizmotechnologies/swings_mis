<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Profiles</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/country/country.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-pinterest"></i> Manage Profiles</b></h5>
    </header><br>

    <div class="w3-col l12"><!-- container starts here -->

      <!-- Manage Roles div -->
      <div class="w3-col l12 w3-padding-left w3-padding-right ">
        <header class="w3-container" >
          <h6><b><i class="fa fa-black-tie"></i> Add Profile</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <div class="w3-col l6 w3-margin-bottom">
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label">Profile Name:</label>
              <input type="text" class="form-control" name="profile_name" id="profile_name" placeholder="Eg. S101, C20, etc." required>
            </div>
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label">Product Description:</label>
              <input type="text" class="form-control" name="prod_description" id="prod_description" placeholder="Eg. Piston seal, Rod seal, etc." required>
            </div>
          </div>

          <!-- material div start -->
          <div class="w3-col l12 w3-margin-bottom">
            <div class="w3-col l12">
              <div class="w3-col l2 w3-padding-right">
                <label class="w3-label">Material:</label>
                <input type="text" class="form-control" name="material_name[]" id="material_name[]" placeholder="Type " required>
              </div>
              <div class="w3-col l3 ">
                <div class="w3-col l4 s4 w3-padding-right">
                  <label class="w3-label">ID:</label>
                  <input type="text" class="form-control" name="material_ID[]" id="material_ID[]" placeholder="Eg. Piston seal, Rod seal, etc." required>
                </div>
                <div class="w3-col l4 s4 w3-padding-right">
                  <label class="w3-label">OD:</label>
                  <input type="text" class="form-control" name="material_OD[]" id="material_OD[]" placeholder="Eg. Piston seal, Rod seal, etc." required>
                </div>
                <div class="w3-col l4 s4 w3-padding-right">
                  <label class="w3-label">Length:</label>
                  <input type="text" class="form-control" name="material_length" id="material_length" placeholder="Eg. Piston seal, Rod seal, etc." required>
                </div>
              </div>
              <div class="w3-col l1 s6 w3-padding-right">
                <label class="w3-label">Quantity:</label>
                <input type="text" class="form-control" name="material_quantity" id="material_quantity" placeholder="Eg. Piston seal, Rod seal, etc." required>
              </div>
              <div class="w3-col l6 w3-padding-right"></div>
            </div>
          </div>
          <!-- material div end -->

        </div>

      </div>
      <!-- manage roles div end -->

    </div>
  </div>
</body>
</html>


