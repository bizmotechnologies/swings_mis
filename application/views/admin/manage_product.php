<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:120px;">

  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
  </header>
  <div class="container">

  <div class="row">

    <div class="col-lg-1">
      <a class="btn btn-primary" href="<?php echo base_url();?>Home">Materials</a>
    </div>

    <div class="col-lg-2 col-lg-offset-9">
  <a class="btn w3-text-red" data-toggle="modal" data-target="#myModal"><b>Product Material Association<b></a>
    </div>

    <br><br><br>
  </div>
  <div class="row">

    <div class="col-lg-1">
      <?php echo anchor("Product_Controller/add_products", 'Add&nbsp;Products', ['class' => 'btn btn-primary']);?>
    </div>

    <div class="col-lg-2 col-lg-offset-1" style="padding-top;"> 
     <label for="inputProductCategory" class="control-label">Product&nbsp;Category:</label> 
   </div>

   <div class="col-lg-2">
    <input type="text" class="form-control" id="input_Productcategory" name="input_Productcategory" placeholder="Enter Product Category" required> 
  </div>

  <div class="col-lg-1">
    <input id="sub_Productbtn" type="submit" class="btn btn-primary"> 
  </div>

  <div class="col-lg-1" style="padding-top;"> 
    <label for="category" class="control-label">Categories:</label>    
  </div>

  <div class="col-lg-2">
    <select class="form-control" name="Select_Product_category_id" id="Select_Product_category_id" onchange="ShowProductsTable();">
      <option>Select Product Category</option>
      <?php foreach ($all_categories as $result ) { ?>
      <option value='<?php echo $result->product_category_id; ?>' ><?php echo $result->product_category_name; ?></option>
      <?php } ?>
    </select>
  </div>

  <div class="col-lg-1">
    <button class="btn btn-primary" id="sub_ProductDelbtn" type="submit"><i class="fa fa-trash"></i></button>
  </div>

</div><br>

<div class="row">
  <div><span id="input_category_span"></span></div>
</div>

<!-- this Div is for Showing table  -->
<div class="col-lg-10">
  <div class="col-lg-12 w3-margin-right" id="Show_producttablenew" name="Show_producttablenew" >
  </div>      
</div>

<div class="col-lg-10">
  <div class="col-lg-12 w3-margin-right" id="Show_producttable" name="Show_producttable" >
  </div>      
</div>

</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Product Material Association.</h4>
      </div>


      <div class="modal-body" >
        <form method="POST" action="" id="material_product_form" name="material_product_form">

          <div class="w3-center">
            <input type="hidden" class="" id="Prod_id" name="Prod_id">
          </div>

          <div class="row">
            <div class="col-lg-4">
              <label>Select Product: </label> 
            </div> 
            <div class="col-lg-6">                   
              <select class="form-control" name="SelectProduct_id" id="SelectProduct_id" onchange="Show_Material_Product_Association();">
                <option>Select Products:</option>
                <?php foreach ($products as $result ) { ?>
                <option value='<?php echo $result->product_id; ?>' ><?php echo $result->product_name; ?></option>
                <?php } ?>
              </select>
            </div>
          </div><br>

          <div class="row">
            <div class="col-lg-4">   
              <label>Select Materials:</lable>
              </div>
              <div class="col-lg-6">                   
                <select class="form-control" name="SelectMaterial_id" id="SelectMaterial_id">
                  <option>Select Materials</option>
                  <?php foreach ($materials as $result ) { ?>
                  <option value='<?php echo $result->material_id; ?>'><?php echo $result->material_name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div><br>

            <button type="submit" class="btn btn-primary">Add</button><br><br>
          </form>

        <div>
        <div class="w3-margin-right" id="Show_productmaterialAssociationnew" name="Show_productmaterialAssociation" style="max-height: 300px; overflow-y: scroll;">
          <table class="table table-bordered" >
              <tr >
                <th class="text-center">SR. No</th>
                <th class="text-center">Material&nbsp;name</th>              
                <th class="text-center">Actions</th>              
              </tr>
            <tbody id="Show_product_Wise_Association" name="Show_product_Wise_Association">
            </tbody>
          </table>
        </div> 
      </div>

        
        </div>
      </div>

    </div>
  </div>

</div>

<script>
function Show_Material_Product_Association(){

  dataString ='SelectProduct_id='+$("#SelectProduct_id").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Product_Controller/Show_Material_Product_Association",
      data: dataString,
      cache: false,
      success: function(data){
        $('#Show_product_Wise_Association').html(data);
      } 
    });

}
</script>
<script>
  $(function(){
   $("#sub_Productbtn").click(function(){  
     dataString = $("#input_Productcategory").val();  
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>Product_Controller/addProductCategory",
       data: 
       {
        input_Productcategory:dataString
      },
           return: false,  //stop the actual form post !important!
           success: function(data)
           {
            $('#input_category_span').html(data);                 
          }
        });
         return false;  //stop the actual form post !important!
       });
 });
</script>

  <script>
  $(function(){
   $("#sub_ProductDelbtn").click(function(){  
     dataString ='Select_Product_category_id='+$("#Select_Product_category_id").val();

     $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Product_Controller/DeleteProduct",
      data: dataString,
      cache: false,
      success: function(data){
        $('#Show_producttablenew').html(data);
      } 
    });

         return false;  //stop the actual form post !important!

       });
 });
  </script>

  <script>
  function ShowProductsTable(){
    dataString ='Select_Product_category_id='+$("#Select_Product_category_id").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>Product_Controller/ShowProductsTable",
      data: dataString,
      cache: false,
      success: function(data){
        $('#Show_producttable').html(data);
      } 
    });
  }
  </script>

<script type="text/javascript">
  $(function(){
   $("#material_product_form").submit(function(){
     dataString = $("#material_product_form").serialize();
    //alert(dataString);
    $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>Product_Controller/Save_Material_product_assoc",
     data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
            //alert(data);
            $("#Show_product_Wise_Association").html(data);
          }

        });

         return false;  //stop the actual form post !important!

       });
 });
</script>


