<?php include("header.php"); ?><!-- header file -->

<div class="container">
	<div class="col-lg-9">
    <div class="col-lg-1">
      <?php echo anchor("Manage_products", 'Back&nbsp;To&nbsp;Products', ['class' => 'btn btn-primary']);?><!-- anchor for redirect to manage product -->
    </div><br><br>
    <br>
    <form class="w3-small" method="POST" action="" id="addProducts_Form" name="addProducts_Form">
      <div class="col-lg-3">
        <label for="productName" class="control-label">Product&nbsp;Name:</label></div>
        <div class="col-lg-9">
          <input type="text" name="Input_productName" id="Input_productName" class="form-control" placeholder="Product Name" required><br>
        </div>

        <div class="col-lg-3">
          <label for="measurements" class="control-label">Product&nbsp;Measurements:</label></div>
          <div class="col-lg-8">
            <div class="w3-col l3">
              <input type="number" name="Inner_dimention" id="Inner_dimention" class="form-control " step="0.01" min="0" placeholder="ID" required>
            </div>
            <div class="w3-col l1 w3-padding"><b>X</b></div>
            <div class="w3-col l3">
              <input type="number" name="Outer_dimention" id="Outer_dimention" class="form-control " step="0.01" min="0" placeholder="OD" required>
            </div>
            <div class="w3-col l1 w3-padding"><b>X</b></div>
            <div class="w3-col l3">
              <input type="number" name="input_Thickness" id="input_Thickness" class="form-control " placeholder="Thickness" step="0.01" min="0" required><br>
            </div>
          </div>

          <div class="col-lg-3">
            <!-- this is measurements for material -->
            <label for="measurements" class="control-label">Material Specification:</label></div>   <!-- this logic for store muliple material value to table -->
            <div class="col-lg-9">
              <table class="table table-bordered table-hover" id="tab_logic"><!-- table starts here -->
                <thead>
                  <tr>
                    <th class="text-center ">
                      ID
                    </th>
                    <th class="text-center">
                      OD
                    </th>
                    <th class="text-center">
                      Material
                    </th>
                    <th class="text-center">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody id='addedRows'>
                  <tr id='rowCount'>                                                   
                    <td>
                      <input type="text" class="form-control" id="ID_val_1" name="ID_val[]" placeholder="ID" required>
                    </td>
                    <td>
                      <input type="text" class="form-control" id="OD_val_1" name="OD_val[]" placeholder="OD_1" required>
                    </td>
                    <td>
                      <select class="form-control getmaterialdetails" name="SelectNew_Material_id[]" id="SelectNew_Material_id_1" onchange="showmaterialInfo(1);" required>
                        <option>Select Materials </option>
                        <?php foreach ($all_materials as $result ) { ?>
                        <option value='<?php echo $result->material_id; ?>' ><?php echo $result->material_name; ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <!-- table ends here -->
              <div class=" w3-right"> <!-- this div for add multiple rows in table -->
                <a  id="add_row" class="btn btn-default pull-left btn add-more w3-margin" onclick="addMoreRows();">Add Row</a>
              </div>
              <!-- div ends here -->
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
          <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div><!-- div for showing error and success message -->
        </div>

        <?php include("footer.php"); ?>
        <!-- this script is used for showing add more rows functionality -->
        <script>
        var rowCount = 1;
        function addMoreRows() {
          rowCount++;

          var recRow = '<tr id="rowCount' + rowCount + '"><td><input value="" id="ID_val_' + rowCount + '" name="ID_val[]"  type="text" placeholder="ID"  class="form-control input-md"></td><td><input value="" id="OD_val_' + rowCount + '" name="OD_val[]"  type="text" placeholder="OD"  class="form-control input-md"></td><td><Select id="SelectNew_Material_id_' + rowCount + '" name="SelectNew_Material_id[]" class="form-control input-md" onchange="showmaterialInfo('+ rowCount +');"><option>Select Materials </option><?php foreach ($all_materials as $result ) { ?><option value="<?php echo $result->material_id; ?>" ><?php echo $result->material_name; ?></option><?php } ?></select></td><td><a href="javascript:void(0);" onclick="removeRow(' + rowCount + ');">Delete</a></td></tr>';

          jQuery('#addedRows').append(recRow);
        }
        function removeRow(removeNum) {
          jQuery('#rowCount' + removeNum).remove();

        }  

        </script>
        <!-- this script is used for showing add more rows functionality ends here -->

        <!-- this script is used for add products functionality -->
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
        <SCRIPT TYPE="text/javascript">
        function showmaterialInfo(fieldnum){  /*this function is used for show total material information*/

          dataString ='SelectNew_Material_id_1='+$("#SelectNew_Material_id_"+fieldnum).val();

          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Manage_products/showmaterialInfo",
            data: dataString,
            cache: false,
            success: function(data){
             nota = JSON.parse(data);
             $('#ID_val_'+ fieldnum).val(nota[0].material_innerdimention);
             $('#OD_val_'+ fieldnum).val(nota[0].material_outerdimention);
           }
         });
        }
        /*this function is used for show total material information*/
        </SCRIPT>