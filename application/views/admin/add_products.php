<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:120px;">

  <!-- Header -->
  <header class="w3-container" >
    <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
  </header>
  <div class="container">
   <div class="col-lg-9">
    <div class="col-lg-1">
      <?php echo anchor("Manage_products", 'Back&nbsp;To&nbsp;Products', ['class' => 'btn btn-primary']);?>
    </div><br><br>
    <br>
    <form class="w3-small" method="POST" action="" id="addProducts_Form" name="addProducts_Form">
      <div class="col-lg-3">
        <label for="productName" class="control-label">Product&nbsp;Name:</label></div>
        <div class="col-lg-9">
          <input type="text" name="Input_productName" id="Input_productName" class="form-control" placeholder="Product Name" required><br>
        </div>
        <div class="col-lg-3">
          <label for="prod_cat" class="control-label">Select&nbsp;Product&nbsp;Category:</label></div>
          <div class="col-lg-9">
            <select class="form-control" name="SelectNew_Product_category_id" id="SelectNew_Product_category_id">
              <option>Select Product Category</option>
              <?php foreach ($all_categories as $result ) { ?>
              <option value='<?php echo $result->product_category_id; ?>' ><?php echo $result->product_category_name; ?></option>
              <?php } ?>
            </select><br>
          </div>

      <!-- <div class="col-lg-3">
		<label for="measurements" class="control-label">Measurements:</label></div>
		<div class="col-lg-8">
		<div class="col-lg-3">
        <input type="number" name="Inner_dimention" id="Inner_dimention" class="form-control " step="0.01" min="0" placeholder="ID" required>
        </div><div class="w3-col l1 w3-padding"><b>X</b></div>
        <div class="col-lg-3">
        <input type="number" name="Outer_dimention" id="Outer_dimention" class="form-control " step="0.01" min="0" placeholder="OD" required>
        </div><div class="w3-col l1 w3-padding"><b>X</b></div>
        <div class="col-lg-3">
        <input type="number" name="input_Thickness" id="input_Thickness" class="form-control " placeholder="Thickness" step="0.01" min="0" required><br>
      </div></div> -->
      <div class="col-lg-3">
        <label for="measurements" class="control-label">Material Specification:</label></div>
        <div class="col-lg-9">
          <table class="table table-bordered table-hover" id="tab_logic">
            <thead>
              <tr>
                
                <th class="text-center ">
                  ID
                </th>
                <th class="text-center">
                  OD
                </th>
                <th class="text-center">
                  Thickness
                </th>
                <th class="text-center">
                  Material
                </th>
                <th class="text-center">
                  Price
                </th>
                <th class="text-center">
                  Action
                </th>
              </tr>

            </thead>
            <tbody id='addedRows'>
              <tr id='rowCount'>
                
                <td>
                  <input type="text" class="form-control" id="ID_val" name="ID_val" placeholder="ID">
                </td>
                <td>
                  <input type="text" class="form-control" id="OD_val" name="OD_val" placeholder="OD">
                </td>
                <td>
                  <input type="text" class="form-control" id="Thicknes" name="Thicknes" placeholder="Thickness">
                </td>
                <td>
                  <select class="form-control" name="SelectNew_Material_id" id="SelectNew_Material_id" onchange="showMaterial();">
                    <option>Select Materials </option>
                    <?php foreach ($all_materials as $result ) { ?>
                    <option value='<?php echo $result->material_id; ?>' ><?php echo $result->material_name; ?></option>
                    <?php } ?>
                  </select>
                </td>
                <td>
                  <input type="text" class="form-control" id="Material_Price" value='<?php// echo $prices->material_price; ?>' name="Material_Price" placeholder="Price">
                </td>
                <td></td>
              </tr>
            </tbody>
          </table>

          <div class=" w3-right">
            <a  id="add_row" class="btn btn-default pull-left btn add-more w3-margin" onclick="addMoreRows();">Add Row</a>
          </div>
        </div>
        <div class="col-lg-3">
          <label for="Price" class="control-label">Total Price:</label></div>
          <div class="col-lg-9">
            <input type="text" name="Input_productPrice" id="Input_productPrice" class="form-control" placeholder="Price" step="0.01" min="0" required><br>
          </div>
          <div class="col-lg-offset-3">
            <div class="col-lg-3">
              <button class="btn btn-md btn-primary btn-block w3-margin-bottom" type="submit">Submit</button>
            </div>
            <div class="col-lg-3">
              <button class="btn btn-md btn-default btn-block w3-margin-bottom" type="reset">Reset</button>
            </div></div><br>
          </form>

        </div> <!-- /container -->

        <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div>
      </div>
    </div>
    <script>
      var rowCount = 1;
      function addMoreRows() {
        rowCount++;

        var recRow = '<tr id="rowCount' + rowCount + '"><td><input value="" id="ID_val' + rowCount + '" name="ID_val"  type="text" placeholder="ID"  class="form-control input-md"></td><td><input value="" id="OD_val' + rowCount + '" name="OD_val"  type="text" placeholder="OD"  class="form-control input-md"></td><td><input value="" id="Thicknes' + rowCount + '" name="Thicknes"  type="text" placeholder="Thicknes"  class="form-control input-md"></td><td><Select id="SelectNew_Material_id' + rowCount + '" name="SelectNew_Material_id" class="form-control" onchange="showMaterial();"><option>Select Materials </option><?php foreach ($all_materials as $result ) { ?><option value="<?php echo $result->material_id; ?>" ><?php echo $result->material_name; ?></option><?php } ?></select></td><td><input value="" id="Material_Price' + rowCount + '" name="Material_Price"  type="text" placeholder="Price"  class="form-control input-md"></td><td><a href="javascript:void(0);" onclick="removeRow(' + rowCount + ');">Delete</a></td></tr>';

        jQuery('#addedRows').append(recRow);
      }

      function removeRow(removeNum) {
        jQuery('#rowCount' + removeNum).remove();

      }
      
    </script>
    <script>
      function showMaterial(){
        dataString ='SelectNew_Material_id='+$("#SelectNew_Material_id").val();

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>Manage_products/showMaterial",
          data: dataString,
          cache: false,
          success: function(data){
            $('#addProducts_err').html(data);
          } 
        });
      }
    </script>
    <script>
      $(function(){
       $("#addProducts_Form").submit(function(){
         dataString = $("#addProducts_Form").serialize();

         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>Manage_products/save_Products",
           data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#addProducts_err").html(data);                         
           }

         });

         return false;  //stop the actual form post !important!

       });
     });
   </script>