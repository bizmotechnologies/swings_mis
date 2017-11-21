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
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/manage_profile.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-pinterest"></i> Manage Profiles</b></h5>
    </header><br>

    <div class="w3-col l12"><!-- container starts here -->

      <!-- Manage Profiles div -->
      <div class="w3-col l12 w3-padding-left w3-padding-right ">
        <header class="w3-container" >
          <h6><b><i class="fa fa-black-tie"></i> Add Profile</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <form id="addProfile_form" enctype="multipart">
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
            <div class="w3-col l6 w3-margin-bottom">
              <div class="w3-col l6">
                <label class="w3-label">Profile Image:</label>
                <input type="file" name="profile_image[]" id="profile_image_1" class="w3-input w3-padding-tiny"> 
              </div>
              <div class="w3-col l6 w3-padding-left">
                <img src="" width="150px" height="150px" class="w3-grey">
              </div>
            </div>

            <!-- material div start -->
            <div class="w3-col l12 w3-margin-bottom">
              <div class="w3-col l12">
                <div class="w3-col l2 w3-padding-right">
                  <label class="w3-label">Material:</label>
                  <input list="Materialinfo" type="text" class="form-control" name="material_name[]" id="material_name" placeholder="Type material name" onchange="GetMaterilaInformation();" required>
                  <datalist id="Materialinfo">
                    <?php foreach($info['status_message'] as $result) { ?>
                    <option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option>
                    <?php } ?>
                  </datalist>
                </div>
                <div class="w3-col l3 ">
                  <div class="w3-col l4 s4 w3-padding-right">
                    <label class="w3-label">ID:</label>
                    <input type="number" min="0" step="0.01" class="form-control" name="material_ID[]" id="material_ID" placeholder="ID"  required>
                  </div>
                  <div class="w3-col l4 s4 w3-padding-right">
                    <label class="w3-label">OD:</label>
                    <input type="number" min="0" step="0.01" class="form-control" name="material_OD[]" id="material_OD" placeholder="OD" required>
                  </div>
                  <div class="w3-col l4 s4 w3-padding-right">
                    <label class="w3-label">Length:</label>
                    <input type="number" min="0" step="0.01" class="form-control" name="material_length[]" id="material_length" placeholder="Length" required>
                  </div>
                </div>
                <div class="w3-col l1 s6 w3-padding-right">
                  <label class="w3-label">Quantity:</label>
                  <input type="number" min="1" class="form-control" name="material_quantity[]" id="material_quantity" placeholder="quantity" required>
                </div>
                <div class="w3-col l6 w3-padding-right">
                  <div class="w3-col l6 w3-padding-left">
                    <label class="w3-label">Material Image:</label>
                    <input type="file" name="material_image[]" id="material_image_1" class="w3-input w3-padding-tiny">                
                  </div>

                  <div class="w3-col l6">
                    <span><a  id="add_moreMaterial" class="btn add_moreMaterial w3-small w3-text-red w3-right w3-margin-top">Add more <i class="fa fa-plus"></i></a></span>
                  </div>

                </div>
              </div>
            </div>
            <div id="added_newMaterial" class="w3-col l12"></div>
            <!-- material div end -->
          </form>
        </div>

      </div>
      <!-- manage profile div end -->

    </div>
  </div>


  <!-- script to add more material div  -->
  <script>
    $(document).ready(function () {
      var max_fields = 10;
      var wrapper = $("#added_newMaterial");
      var add_button = $("#add_moreMaterial");

      var x = 1;
      $(add_button).click(function (e) {
        e.preventDefault();
        if (x < max_fields) {
          x++;

          $(wrapper).append('<div class="">\n\
            <div class="w3-col l12 w3-margin-bottom"><hr>\n\
            <div class="w3-col l12">\n\
            <div class="w3-col l2 w3-padding-right">\n\
            <label class="w3-label">Material:</label>\n\
            <input list="Materialinfo" type="text" class="form-control" name="material_name[]" id="material_name" placeholder="Type material name" onchange="GetMaterilaInformation();" required>\n\
            <datalist id="Materialinfo">\n\
            <option data-value="" value=""></option>\n\
            </datalist>\n\
            </div>\n\
            <div class="w3-col l3 ">\n\
            <div class="w3-col l4 s4 w3-padding-right">\n\
            <label class="w3-label">ID:</label>\n\
            <input type="number" min="0" step="0.01" class="form-control" name="material_ID[]" id="material_ID" placeholder="ID" required></div>\n\
            <div class="w3-col l4 s4 w3-padding-right">\n\
            <label class="w3-label">OD:</label>\n\
            <input type="number" min="0" step="0.01" class="form-control" name="material_OD[]" id="material_OD" placeholder="OD" required></div>\n\
            <div class="w3-col l4 s4 w3-padding-right">\n\
            <label class="w3-label">Length:</label>\n\
            <input type="number" min="0" step="0.01" class="form-control" name="material_length[]" id="material_length"\n\ placeholder="Length" required>\n\
            </div>\n\
            </div>\n\
            <div class="w3-col l1 s6 w3-padding-right">\n\
            <label class="w3-label">Quantity:</label>\n\
            <input type="number" min="1" class="form-control" name="material_quantity[]" id="material_quantity" placeholder="quantity"\n\ required>\n\
            </div>\n\
            <div class="w3-col l6 w3-padding-right">\n\
            <div class="w3-col l6 w3-padding-left">\n\
            <label class="w3-label">Material Image:</label>\n\
            <input type="file" name="material_image[]" id="material_image_1" class="w3-input w3-padding-tiny"></div>\n\
            </div>\n\
            </div>\n\
            <a href="#" class="delete w3-text-grey w3-right w3-small" title="Delete material field">remove field <i class="fa fa-remove"></i></a>\n\
            </div>\n\
                    </div>'); //add input box

        } else
        {
          $.alert('<label class="w3-label w3-text-red"><i class="fa fa-warning w3-xxlarge"></i> You Reached the maximum limit of adding '+max_fields+' fields</label>');   //alert when added more than 4 input fields
        }
      });

      $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      })
    });

  </script>
  <!-- script to add more material end -->
</body>
</html>


