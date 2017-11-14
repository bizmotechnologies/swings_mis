<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Products</title>
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
      <h5><b><i class="fa fa-users"></i> Manage Products</b></h5>
    </header><br>

<div class="container"><!-- container starts here -->

  <div class="row">
    <div class="col-lg-1">
      <?php echo anchor("inventory/Manage_products/add_products", 'Add&nbsp;Products', ['class' => 'btn btn-primary']);?><!-- anchor for redirecting to add material page  -->
    </div>
    <div class="w3-right">
      <a class="btn btn-primary" href="<?php echo base_url();?>inventory/Manage_materials">Materials</a> <!-- anchor for material managements -->
    </div>
  </div><br>

  <div class="row">
    <div><span id="input_category_span"></span></div><!-- this div is used for showing messages for operations -->
  </div>

  <div class="row">
  <div class="container" id="Show_productmaterialAssociationnew" name="Show_productmaterialAssociation" style="max-height: 400px; overflow-y: scroll;"><!-- this div showing the table of material and product association -->
    <table class="table table-striped">
      <tr >
        <th class="text-center">SR. No</th>
        <th class="text-center">Product&nbsp;name</th> 
        <th class="text-center">ID</th>              
        <th class="text-center">OD</th>              
        <th class="text-center">Thickness</th>                                 
        <th class="text-center">Actions</th>              
      </tr>
      <tbody id="Show_product_Wise_Association" name="Show_product_Wise_Association" >
        <?php                                            /*this code is used to show products list in the table*/
        $count=1;
        if($productdata['status']==1){
         for($i = 0; $i < count($productdata['status_message']); $i++) { 
          echo'<tr>
          <td class="text-center">'.$count.'.</td>
          <td class="text-center">'.$productdata['status_message'][$i]['product_name'].'</td>
          <td class="text-center">'.$productdata['status_message'][$i]['ID'].'</td>
          <td class="text-center">'.$productdata['status_message'][$i]['OD'].'</td>
          <td class="text-center">'.$productdata['status_message'][$i]['thickness'].'</td>
          <td class="text-center"><a class="btn w3-medium" title="UpdateProduct" data-toggle="modal" data-target="#updateMenu_'.$productdata['status_message'][$i]['product_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
          <a class="btn w3-medium" title="DeleteProduct" href="'.base_url().'inventory/Manage_products/DeleteRecord?Product_id='.$productdata['status_message'][$i]['product_id'].'" style="padding:0"><i class="fa fa-trash"></i></a>
          <!-- Modal -->
          <div id="updateMenu_'.$productdata['status_message'][$i]['product_id'].'" class="modal fade " role="dialog">
          <div class="modal-dialog ">
          <!-- Modal content-->
          <div class="modal-content modal-md">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title w3-xxlarge w3-text-red">Update</h4>
          </div>
          <div class="modal-body">
          <form method="POST" action="'.base_url().'inventory/Manage_products/UpdateRecord">
          <div class="">
          <input type="hidden" class="" id="new_Product_id" name="new_Product_id" value="'.$productdata['status_message'][$i]['product_id'].'">
          </div><br>


          <div class="col-lg-3">
          <label for="productName" class="control-label">Product&nbsp;Name:</label></div>
          <div class="col-lg-9">
          <input type="text" name="updated_ProductName" id="updated_ProductName" value="'.$productdata['status_message'][$i]['product_name'].'" class="form-control" placeholder="Product Name" required><br>
          </div>

          <div class="col-lg-3">
          <label for="productName" class="control-label">ID:</label></div>
          <div class="col-lg-9">
          <input type="text" name="UpdatedInner_dimention" id="UpdatedInner_dimention" value="'.$productdata['status_message'][$i]['ID'].'" class="form-control" step="0.01" placeholder="Product Name" required><br>
          </div>

          <div class="col-lg-3">
          <label for="productName" class="control-label">OD:</label></div>
          <div class="col-lg-9">
          <input type="text" name="UpdatedOuter_dimention" id="UpdatedOuter_dimention" class="form-control " value="'.$productdata['status_message'][$i]['OD'].'" step="0.01" placeholder="Product Name" required><br>
          </div>

          <div class="col-lg-3">
          <label for="productName" class="control-label">Thickness:</label></div>
          <div class="col-lg-9">
          <input type="number" name="Updatedinput_Thickness" id="Updatedinput_Thickness" class="form-control " value="'.$productdata['status_message'][$i]['thickness'].'" step="0.01" placeholder="Product Name" required><br>
          </div>                        

          <button class="btn w3-red" type="submit" name="updateRecord" id="updateRecord">Update Menu</button>
          </form>
          </div>
          </div>
          </div>
          </div>
          <!--modal end--> 
          </td>
          </tr>';/*this code is used to show products list in the table ends here*/
          $count++; 
        }   
      } 
      else
      {
        echo'<tr><td colspan="7" style="text-align: center;">No Records Found...!</td></tr>';
      } 
      echo '</table>';
      ?>               
    </tbody>
  </table>
</div> 
</div>

<div>
<!-- this script is used for showing material product association functionality -->
<script>
function Show_Material_Product_Association(){
  dataString ='SelectProduct_id='+$("#SelectProduct_id").val();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>inventory/Manage_products/Show_Material_Product_Association",
    data: dataString,
    cache: false,
    success: function(data){
      $('#Show_product_Wise_Association').html(data);
    } 
  });

}
</script>
<!-- this script is used for showing material product association functionality ends here-->

<!-- this script is used for showing add product category functionality -->
<script>
$(function(){
 $("#sub_Productbtn").click(function(){  
   dataString = $("#input_Productcategory").val();  
   $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>inventory/Manage_products/addProductCategory",
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
<!-- this script is used for showing add product category functionality ends here-->

<!-- this script is used for showing delete product category association functionality -->
<script>
$(function(){
 $("#sub_ProductDelbtn").click(function(){  
   dataString ='Select_Product_category_id='+$("#Select_Product_category_id").val();

   $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>inventory/Manage_products/DeleteProduct",
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
<!-- script ends here -->

<!-- this script is used to show products table -->
<script>
function ShowProductsTable(){
  dataString ='Select_Product_category_id='+$("#Select_Product_category_id").val();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>inventory/Manage_products/ShowProductsTable",
    data: dataString,
    cache: false,
    success: function(data){
      $('#Show_producttable').html(data);
    } 
  });
}
</script>
<!-- the script ends here -->

<!-- this script is for add or save material product association -->
<script type="text/javascript">
$(function(){
 $("#material_product_form").submit(function(){
   dataString = $("#material_product_form").serialize();
    //alert(dataString);
    $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>inventory/Manage_products/Save_Material_product_assoc",
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
<!-- ends here -->


