
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:120px;">

  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
  </header>
<?php echo form_open('home/save_category', ['class' => 'form-horizontal']);?> 
<div class="row"> 
	<div class="col-lg-6 col-lg-offset-2">  
	<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Add&nbsp;Category</label>
      <div class="col-lg-4">
      	<?php echo form_input(['name' =>'inputcategory_name', 'class' =>'form-control', 'placeholder' =>'Material Name', 'value' =>set_value('inputcategory_name')]);?>
      </div>
         <?php echo form_submit(['value' => 'Submit', 'class' => 'btn btn-primary']);?>
    </div>
</div>
<div class="col-lg-6">
	<?php echo form_error('inputcategory_name');?>
</div>
</div>
<!-- <div class="row"> -->
	<!-- <div class="col-lg-6 col-lg-offset-2">
    <div class="form-group">
      <div class="col-lg-4 col-lg-offset-2">
      	<?php// echo form_submit(['value' => 'Reset', 'class' => 'btn btn-default']);?>
      </div>
    </div>
</div>
</div> -->
<?php echo form_close();?>
</div>
