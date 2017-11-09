<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:120px;">

  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
  </header>
<div class="container">
  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-dashboard"></i> Manage Material</b></h5>
  </header>
  <br>
  <div class="row col-lg-2">
    <a class="btn btn-primary" href="<?php echo base_url();?>Product_Controller">Products</a>
  </div><br><br><br>
  <div class="row">
    <div class="col-lg-2">
      <?php echo anchor("home/create", 'Add&nbsp;Material', ['class' => 'btn btn-primary']);?>
    </div>
    <div class="col-lg-1" style="padding-top;"> 
       <label for="inputCategory" class="control-label">Add Category:</label> 
    </div>
    <div class="col-lg-3">
      <input type="text" class="form-control" id="input_category" name="input_category" placeholder="Enter Category" required> 
    </div>
     <div class="col-lg-1">
      <input id="sub_btn" type="submit" class="btn btn-primary"> 
    </div>
    <div class="col-lg-1" style="padding-top;"> 
      <label for="sel1" class="control-label">Categories:</label>    
    </div>
    <div class="col-lg-3">
      <select class="form-control" name="Select_category_id" id="Select_category_id" onchange="showmaterialtable();">
        <option>Select Category</option>
        <?php foreach ($all_categories as $result ) { ?>
        <option value='<?php echo $result->material_category_id; ?>' ><?php echo $result->material_category_name; ?></option>
       <?php } ?>
      </select>
    </div>
  </div><br>
<div class="row">
    <div><span id="input_category_span"></span></div>
  </div>
<!-- this Div is for Showing table  -->

<div class="col-lg-10">
  <div class="col-lg-12 w3-margin-right" id="Show_materialtable" name="Show_materialtable" >

  </div>      
</div>

</div>

</div>


<script>
$(function(){
   $("#sub_btn").click(function(){  
   dataString = $("#input_category").val();  
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>Home/addCategory",
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

</script>

<script>
     function showmaterialtable(){
            dataString ='Select_category_id='+$("#Select_category_id").val();
            
            $.ajax({
              type: "POST",
              url: "<?php echo base_url(); ?>Home/Showmaterialtable",
              data: dataString,
              cache: false,
              success: function(data){
                $('#Show_materialtable').html(data);
              } 
            });
          }
</script>


