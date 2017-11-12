<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate Quotations</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
<!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css">
--><script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url(); ?>css/country/country.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-users"></i> Manage Materials</b></h5>
    </header>

<div class="container"><!-- container starts here -->
  <div class="row col-lg-2">
    <a class="btn btn-primary" href="<?php echo base_url();?>inventory/manage_products">Products</a>
  </div><br><br><br>

  <div class="row">
    <div class="col-lg-2">
      <?php echo anchor("inventory/Manage_materials/add_material", 'Add&nbsp;Material', ['class' => 'btn btn-primary']);?><!-- anchor for add material -->
    </div>
    <div class="col-lg-1" style="padding-top;"> 
      <label for="sel1" class="control-label">Materials:</label>    
    </div>
    <div class="col-lg-3">
      <select class="form-control" name="Select_material_id" id="Select_material_id" onchange="showmaterialtable();"><!-- fun for showing material page material wise -->
        <option>Select materials</option>
        <?php foreach ($all_categories as $result ) { ?>
        <option value='<?php echo $result->material_id; ?>' ><?php echo $result->material_name; ?></option>
        <?php } ?>
      </select>
    </div>
  </div><br>

  <div class="row"><span id="input_category_span"></span></div>
  <!-- this Div is for Showing table  -->

  <div class="row">
    <div class="col-lg-12 w3-margin-right" id="Show_materialtable" name="Show_materialtable" >

    </div>      
  </div>

</div>

</div>
<!-- this script function is used to save categories of materials -->

<script>
$(function(){
 $("#sub_btn").click(function(){  
   dataString = $("#input_category").val();  
   $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>inventory/Manage_materials/addCategory",
     data: 
     {
      input_category:dataString
    },
           return: false,  //stop the actual form post !important!
           success: function(data)
           {
            $('#input_category_span').html(data); 
            alert(data);                
          }

        });

         return false;  //stop the actual form post !important!

       });
});

</script><!-- this script function is ends here -->

<!-- this script function is used to show material wise table -->

<script>
function showmaterialtable(){
  dataString ='Select_material_id='+$("#Select_material_id").val();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>inventory/Manage_materials/Showmaterialtable",
    data: dataString,
    cache: false,
    success: function(data){
      $('#Show_materialtable').html(data);
    } 
  });
}
</script>
<!-- this script function is used to show material wise table -->


<!-- this script function is used to perform mathematical function to perform to get total prize of material -->

<SCRIPT>
/*function showPrizecalculations(){

  var inputmaterial_Cut = document.getElementById('updated_materialcut').value;
  var input_length_thickness = document.getElementById('updated_materiallength').value;
  var input_Costpermm = document.getElementById('updated_costpermm').value;

  if (inputmaterial_Cut == "")
   inputmaterial_Cut = 0;
 if (input_length_thickness == "")
   input_length_thickness = 0;
 if (input_Costpermm == "")
   input_Costpermm = 0;

 var result = parseInt(input_Costpermm) * 2.65 * (parseInt(input_length_thickness) + parseInt(inputmaterial_Cut));
 if (!isNaN(result)) {
   document.getElementById('updated_materialtotalPrice').value = result;
 }


}*/
</SCRIPT>
<!-- this script function is used to perform mathematical function to perform to get total prize of material -->
