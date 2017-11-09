<?php include("header.php") ?>
<div class="col-lg-1 col-lg-offset-1">
      <?php echo anchor("Manage_materials", 'Back&nbsp;To&nbsp;Materials', ['class' => 'btn btn-primary']);?>
    </div><br><br>
    <br>
<form class="w3-small" method="POST" action="" id="AddMaterial_Form" name="AddMaterial_Form">
  <br>
<div class="row">
<div class="col-lg-2 col-lg-offset-2"> 
      <label for="material_name" class="col-lg-2 control-label">Material&nbsp;Name:</label></div>
      <div class="col-lg-4">
        <input type="text" name="inputmaterial_name" id="inputmaterial_name" class="form-control" placeholder="Material Name" required>
      </div>
</div> 
</div><br>

<div class="row">
<div class="col-lg-2 col-lg-offset-2">
      <label for="inputingedients" class="col-lg-2 control-label">Ingredients:</label></div>
      <div class="col-lg-4">
        <input type="text" name="input_ingredients" id="input_ingredients" class="form-control" placeholder="Material Ingredients" required>
      </div>
</div>
</div><br>

<div class="row">
  <div class="col-lg-2 col-lg-offset-2">
      <label for="Material Category" class="col-lg-2 control-label">Material&nbsp;Category:</label></div>
      <div class="col-lg-4">
      	<select class="form-control" name="input_material_category_id" id="input_material_category_id">
        <option>Select Category</option>
        <?php foreach ($all_categories as $result ) { ?>
        <option value='<?php echo $result->material_category_id; ?>' ><?php echo $result->material_category_name; ?></option>
       <?php } ?>
      </select>
</div>
</div><br>

<div class="row" >
    <div class="col-lg-2 col-lg-offset-2">
      <label for="length" class="col-lg-2 control-label">Length:</label></div>
      <div class="col-lg-4">
        <input type="number" name="input_length_thickness" id="input_length_thickness" class="form-control" placeholder="Material Length And Thickness" required>
      </div>
</div><br>

<div class="row">
    <div class="col-lg-2 col-lg-offset-2">
      <label for="inst_quantity" class="col-lg-2 control-label">Instock&nbsp;Quantity:</label></div>
      <div class="col-lg-4">
        <input type="number" name="input_instock_quantity" id="input_instock_quantity" class="form-control" placeholder="Material Stock Quantity" required>
      </div>
</div><br>

<div class="row">
    <div class="col-lg-2 col-lg-offset-2">
      <label for="price" class="col-lg-2 control-label">Price:</label></div>
      <div class="col-lg-4">
        <input type="number" name="input_priceFor_material" id="input_priceFor_material" class="form-control" placeholder="Material Price" required>
      </div>
</div><br>

<div class="row">
      <div class="col-lg-1 col-lg-offset-3">
        <button class="btn btn-md btn-primary btn-block w3-margin-bottom" type="submit">Submit</button>
      </div>
      <div class="col-lg-1">
        <button class="btn btn-md btn-default btn-block w3-margin-bottom" type="reset">Reset</button>
</div>
</div>

<div class="row">
  <div class="w3-margin-bottom w3-margin-bottom w3-small" id="addMaterial_err"></div>
</div>

</form>
<?php include("footer.php") ?>
<script>
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