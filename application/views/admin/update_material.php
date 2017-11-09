<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:120px;">

  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
  </header>
  <?php echo form_open('home/save', ['class' => 'form-horizontal']);?> 
<div class="row"> 
	<div class="col-lg-6 col-lg-offset-2">  
	<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Material&nbsp;Name</label>
      <div class="col-lg-4">
      	<?php echo form_input(['name' =>'inputmaterial_name', 'class' =>'form-control', 'placeholder' =>'Material Name', 'value' =>set_value('inputmaterial_name')]);?>
      </div>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('inputmaterial_name');?>
</div>
</div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <label for="inputingedients" class="col-lg-2 control-label">Ingredients</label>
      <div class="col-lg-4">
        <?php echo form_input(['name' =>'input_ingredients', 'class' =>'form-control', 'placeholder' =>'Ingredients', 'value' =>set_value('input_ingredients')]);?>
      </div>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('input_ingredients');?>
</div>
</div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <label for="Material Category" class="col-lg-2 control-label">Material&nbsp;Category</label>
      <div class="col-lg-4">
      	<select class="form-control" name="input_material_category_id" id="input_material_category_id">
        <option>Select Category</option>
        <?php foreach ($all_categories as $result ) { ?>
        <option value='<?php echo $result->material_category_id; ?>' ><?php echo $result->material_category_name; ?></option>
       <?php } ?>
      </select>
      </div>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('input_material_category_id')?>
</div>
</div>
<div class="row" >
	<div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <label for="Color" class="col-lg-2 control-label">Length</label>
      <div class="col-lg-4">
      	<?php echo form_input(['name' =>'input_length_thickness', 'class' =>'form-control', 'placeholder' =>'Material Length And Thickness', 'value' =>set_value('input_length_thickness')]);?>      
      </div>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('input_length_thickness');?>
</div>
</div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <label for="Color" class="col-lg-2 control-label">Instock&nbsp;Quantity</label>
      <div class="col-lg-4">
      	<?php echo form_input(['name' =>'input_instock_quantity', 'class' =>'form-control', 'placeholder' =>'Material Instock Quantity', 'value' =>set_value('input_instock_quantity')]);?>           
      </div>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('input_instock_quantity');?>
</div>
</div>
<div class="row">
	<div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <div class="col-lg-4 col-lg-offset-2">
      	<?php echo form_submit(['value' => 'Update', 'class' => 'btn btn-primary']);?>
      	<?php echo form_submit(['value' => 'Reset', 'class' => 'btn btn-default']);?>
      </div>
    </div>
</div>
</div>
<?php echo form_close(); ?>
</div>