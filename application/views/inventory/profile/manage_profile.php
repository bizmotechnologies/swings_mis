<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
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
  <style type="text/css">
  input[type=number]::-webkit-inner-spin-button, 
  input[type=number]::-webkit-outer-spin-button {  

   opacity: 1;

 }
</style>
</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-pinterest"></i> Manage Profiles</b></h5>
    </header>

    <div class="w3-col l12"><!-- container starts here -->

      <div class="w3-col l12">
       <span class="w3-label w3-right w3-margin-right"><a href="<?php echo base_url(); ?>inventory/allProfiles" class="btn w3-blue w3-small"><b><i class="fa fa-eye"></i> View Profile</b></a></span>
     </div>
     <!-- Manage Profiles div -->
     <div class="w3-col l12 w3-padding-left w3-padding-right ">
      <header class="w3-container" >
        <h6><b><i class="fa fa-black-tie"></i> Add Profile</b></h6>
        <span class="w3-small"></span>
      </header>

      <div class="w3-col l12 w3-padding w3-small">
        <form id="addProfile_form" enctype="multipart/form-data">
          <div class="w3-col l6 w3-margin-bottom">
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label w3-text-black">Profile Name:</label>
              <input type="text" class="w3-input" name="profile_name" id="profile_name" placeholder="Eg. SS01, SK01, SA01 etc." required>
            </div>
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label w3-text-black">Product Description:</label>
              <input type="text" class="w3-input" name="prod_description" id="prod_description" placeholder="Eg. Piston seal, Rod seal, etc." required>
            </div>
          </div>
          <div class="w3-col l12 w3-margin-bottom">
            <div class="w3-col l3 w3-padding-top w3-padding-right">
              <label class="w3-label w3-text-black w3-margin-top">Profile Image:</label>
              <input type="file" name="profile_image" id="profile_image" class="w3-input w3-padding-tiny"> 
            </div>
            <div class="w3-col l4 w3-left">
              <img src="" width="180px" id="profile_imagePreview" height="180px" alt="Product Profile Image will be displayed here once chosen. Image size is:(100px * 80px)" class=" w3-centerimg img-thumbnail">
            </div>
          </div>

          <!-- material div start -->
          <div class="w3-col l12 w3-margin-bottom w3-margin-top">

            <header class="w3-col l12" >
              <span class="w3-small"><b><i class="fa fa-cubes"></i> Associated Materials :</b></span>
            </header>
            <div class="w3-col l12 w3-margin-top">
              <div class="w3-col l2 w3-padding-right w3-padding-left">
                <label class="w3-label">Material:</label>
                <input list="Materialinfo_1" type="text" class="w3-input" name="material_name[]" id="material_name_1" placeholder="Type material name" required onchange="getMaterialId(1)">
                <datalist id="Materialinfo_1">
                  <?php foreach($all_materials['status_message'] as $result) { ?>
                  <option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option>                  
                  <?php } ?>
                </datalist>
                <input type="hidden" name="material_id[]" id="material_id_1">
              </div>
              <div class="w3-col l4 ">
                <div class="w3-col l4 s4 w3-padding-right">
                  <label class="w3-label w3-margin-left">ID Quantity:</label>
                  <input type="number" min="0" class="w3-input w3-margin-left w3-center" name="ID_quantity[]" id="ID_quantity" placeholder="count"  required style="width:80px">
                </div>
                <div class="w3-col l4 s4 w3-padding-right">
                  <label class="w3-label w3-margin-left">OD Quantity:</label>
                  <input type="number" min="0" class="w3-input w3-margin-left w3-center" name="OD_quantity[]" id="OD_quantity" placeholder="count" required style="width:80px">
                </div>
                <div class="w3-col l4 s4 ">
                  <label class="w3-label">Length Quantity:</label>
                  <input type="number" min="0" class="w3-input w3-margin-left w3-center" name="length_quantity[]" id="length_quantity" placeholder="count" required style="width:80px">
                </div>
              </div>
              <div class="w3-col l2 s6">
                <label class="w3-label">Material Quantity:</label>
                <input type="number" min="1" class="w3-input w3-center w3-margin-left" name="material_quantity[]" id="material_quantity" placeholder="count" required style="width:100px">
              </div>
              <div class="w3-col l4 w3-padding-right w3-padding-left">
                <div class="w3-col l7">
                  <label class="w3-label">Material Image:</label>
                  <input type="file" name="material_image[]" id="material_image" class="w3-input w3-padding-small">                
                </div>

                <div class="w3-col l5">
                  <span><a  id="add_moreMaterial" class="btn add_moreMaterial w3-small w3-text-red w3-right w3-margin-top">Add more <i class="fa fa-plus"></i></a></span>
                </div>

              </div>
            </div>
          </div>
          <div id="added_newMaterial" class="w3-col l12"></div>
          <!-- material div end -->
          <div class="w3-col l12 ">
            <button type="submit" title="click add profile to add product profile" class="w3-margin w3-button w3-right w3-red">Add Profile</button>
          </div>
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
          <div class="w3-col l2 w3-padding-right w3-padding-left ">\n\
          <label class="w3-label">Material:</label>\n\
          <input list="Materialinfo_'+x+'" type="text" class="w3-input" name="material_name[]" id="material_name_'+x+'" placeholder="Type material name" required onchange="getMaterialId('+x+')">\n\
          <datalist id="Materialinfo_'+x+'">\n\
          <?php foreach($all_materials['status_message'] as $result) { ?><option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option><?php } ?>\n\
          </datalist><input type="hidden" name="material_id[]" id="material_id_'+x+'">\n\
          </div>\n\
          <div class="w3-col l4 ">\n\
          <div class="w3-col l4 s4 w3-padding-right">\n\
          <label class="w3-label w3-margin-left">ID Quantity:</label><input type="number" min="0" class="w3-input w3-margin-left w3-center" name="ID_quantity[]" id="ID_quantity" placeholder="count"  required style="width:80px"></div>\n\
          <div class="w3-col l4 s4 w3-padding-right">\n\
          <label class="w3-label w3-margin-left">OD Quantity:</label><input type="number" min="0" class="w3-input w3-margin-left w3-center" name="OD_quantity[]" id="OD_quantity" placeholder="count" required style="width:80px"></div>\n\
          <div class="w3-col l4 s4 ">\n\
          <label class="w3-label">Length Quantity:</label><input type="number" min="0" class="w3-input w3-margin-left w3-center" name="length_quantity[]" id="length_quantity" placeholder="count" required style="width:80px">\n\
          </div>\n\
          </div>\n\
          <div class="w3-col l2 s6 w3-padding-right">\n\
          <label class="w3-label">Material Quantity:</label><input type="number" min="1" class="w3-input w3-margin-left w3-center" name="material_quantity[]" id="material_quantity" placeholder="count" required style="width:100px">\n\
          </div>\n\
          <div class="w3-col l4 w3-padding-right">\n\
          <div class="w3-col l7 w3-padding-left">\n\
          <label class="w3-label ">Material Image:</label>\n\
          <input type="file" name="material_image[]" id="material_image_1" class="w3-input w3-padding-tiny"></div>\n\
          </div>\n\
          </div>\n\
          <a href="#" class="delete w3-text-grey w3-right w3-small" title="remove material field">remove field <i class="fa fa-remove"></i></a>\n\
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

<script>
  function getMaterialId(field_num){

  var material_id = $('#Materialinfo_'+field_num+' option[value="' + $('#material_name_'+field_num).val() + '"]').data('value');
  $('#material_id_'+field_num).val(material_id);
}
</script>
</body>
</html>


