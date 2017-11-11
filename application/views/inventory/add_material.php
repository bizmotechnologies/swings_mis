<?php include("header.php") ?>

<div class="col-lg-1 col-lg-offset-1">
      <?php echo anchor("Manage_materials", 'Back&nbsp;To&nbsp;Materials', ['class' => 'btn btn-primary']);?> <!-- this anchor tag is for redirect to material management page -->
    </div><br><br>
    <br>
<div>
<form class="w3-small" method="POST" action="" id="AddMaterial_Form" name="AddMaterial_Form"><!-- Material Form starts here -->
<br>
<div class="row">
<div class="col-lg-2 col-lg-offset-2"> 
      <label for="material_name" class="col-lg-2 control-label w3-medium">Material&nbsp;Name:</label></div>
      <div class="col-lg-3">
        <input type="text" name="inputmaterial_name" id="inputmaterial_name" class="form-control" placeholder="Material Name" required>
      </div>
</div> 
</div><br>

<div class="row">
<div class="col-lg-2 col-lg-offset-2"> 
      <label for="material_name" class="col-lg-2 control-label w3-medium">Material&nbsp;ID:</label></div>
      <div class="col-lg-3">
        <input type="number" name="inputmaterial_InnerDimention" id="inputmaterial_InnerDimention" class="form-control" placeholder=" Inner Dimention" required>
      </div>
</div> 
</div><br>
<div class="row">
<div class="col-lg-2 col-lg-offset-2"> 
      <label for="material_name" class="col-lg-2 control-label w3-medium">Material&nbsp;OD:</label>
</div>
      <div class="col-lg-3">
        <input type="number" name="inputmaterial_OuterDimention" id="inputmaterial_OuterDimention" class="form-control" placeholder=" Outer Dimention" required>
      </div>
</div> 
</div><br>

<div class="row">
    <div class="col-lg-2 col-lg-offset-2">
      <label for="price" class="col-lg-2 control-label w3-medium">Price<span class="w3-tiny">(cost/mm)</span>:</label></div>
      <div class="col-lg-2">
        <input type="number" name="input_priceFor_material" id="input_priceFor_material" class="form-control" placeholder="Material Price" step="0.01" required>
      </div>&nbsp;
      <div class="col-lg-1">
         <select class="form-control getmaterialdetails" name="Select_Currency" id="Select_Currency"  required>
                <option value="0">Currency </option>
                <option value="dollar">Dollar</option>
                <option value="euro">Euro</option>
                <option value="pound">Pound</option>
                <option value="rupees">Rupees</option>
        </select>
      </div>
</div><br>

<div class="row col-lg-10" >
      <center>
        <button class="btn btn-md btn-primary w3-margin-bottom" type="submit">Submit</button>
        <button class="btn btn-md btn-default w3-margin-bottom" type="reset">Reset</button>
      </center>
</div>

<div class="row">
  <div class="w3-margin-bottom w3-margin-bottom w3-small" id="addMaterial_err"></div>
</div>

</form><!-- form ends here -->
</div>
<?php include("footer.php"); ?>
<script>                          // this fun for submitting form for save materials
$(function(){
   $("#AddMaterial_Form").submit(function(){
     dataString = $("#AddMaterial_Form").serialize();
    
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>Manage_materials/saveMaterial",
       data: dataString,
           return: false,  //stop the actual form post !important!
           success: function(data)
           {
             $("#addMaterial_err").html(data);                         
           }
         });
         return false;  //stop the actual form post !important!

       });
 });
</script>

<!-- this script function is used to perform mathematical function to perform to get total prize of material -->
<SCRIPT>
/*function showPrizecalculations(){
  var inputmaterial_Cut = document.getElementById('inputmaterial_Cut').value;
  var input_length_thickness = document.getElementById('input_length_thickness').value;
  var input_Costpermm = document.getElementById('input_Costpermm').value;

       if (inputmaterial_Cut == "")
           inputmaterial_Cut = 0;
       if (input_length_thickness == "")
           input_length_thickness = 0;
        if (input_Costpermm == "")
           input_Costpermm = 0;

       var result = parseInt(input_Costpermm) * 2.65 * (parseInt(input_length_thickness) + parseInt(inputmaterial_Cut));
       if (!isNaN(result)) {
           document.getElementById('input_priceFor_material').value = result;
       }
}*/
</SCRIPT>
<!-- this script function is used to perform mathematical function to perform to get total prize of material -->
