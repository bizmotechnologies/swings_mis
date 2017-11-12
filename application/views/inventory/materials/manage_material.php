<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Materials Quotations</title>
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
    </header><br>

<div class="container"><!-- container starts here -->

  <div class="row">
    <div class="w3-left">
      <?php echo anchor("inventory/Manage_materials/add_material", 'Add&nbsp;Material', ['class' => 'btn btn-primary']);?><!-- anchor for add material -->
    </div>
    <div class="w3-right">
    <a class="btn btn-primary" href="<?php echo base_url();?>inventory/manage_products">Products</a>
  </div>
  </div><br>

  <div class="row"><span id="input_category_span"></span></div>
  <!-- this Div is for Showing table  -->

  <div class="row">
    <div class="col-lg-12 w3-margin-right" id="Show_materialtable" name="Show_materialtable" >
        <table class="table table-striped">
      <tr >
        <th class="text-center">Sr.No</th>
        <th class="text-center">Material&nbsp;name</th>
        <th class="text-center">Material&nbsp;ID</th>
        <th class="text-center">Material&nbsp;OD</th>
        <th class="text-center">Price&nbsp;(cost/mm)</th>
        <th class="text-center">Total Amount</th>              
        <th class="text-center">Price in <i class="fa fa-rupee"></i>:</th>
        <th class="text-center">Actions</th>              
      </tr>
      <tbody id="Show_product_Wise_Association" name="Show_product_Wise_Association">
    <?php 
      $count = 1;
        if($details['status']==1){
     for($i = 0; $i < count($details['status_message']); $i++) { 
     
             echo '<tr>
                 <td class="text-center">'.$count.'.</td>
                 <td class="text-center">'.$details['status_message'][$i]['material_name'].'</td>
                 <td class="text-center">'.$details['status_message'][$i]['material_innerdimention'].'</td>
                 <td class="text-center">'.$details['status_message'][$i]['material_outerdimention'].'</td>
                 <td class="text-center">'.$details['status_message'][$i]['pricepermm'].'</td>           
                 <td class="text-center">'.$details['status_message'][$i]['conversion_rate'].'</td>
                 <td class="text-center">'.$details['status_message'][$i]['currency_amount'].'</td>
                 <td class="text-center"><a class="btn w3-medium" title="Updatematerial" data-toggle="modal" data-target="#updateMenu_'.$details['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
          <a class="btn w3-medium" title="Deletematerial" href="'.base_url().'inventory/Manage_materials/Delete?material_id='.$details['status_message'][$i]['material_id'].'" style="padding:0"><i class="fa fa-trash"></i></a>
          <!-- Modal -->
          <div id="updateMenu_'.$details['status_message'][$i]['material_id'].'" class="modal fade " role="dialog">
            <div class="modal-dialog ">
              <!-- Modal content-->
              <div class="modal-content col-lg-8 col-lg-offset-2">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title w3-xxlarge w3-text-red">Update</h4>
                </div>
                <div class="modal-body">
                  <form method="POST" action="'.base_url().'inventory/Manage_materials/Update">
                    <div class="w3-center">
                    <input type="hidden" class="" id="new_material_id" name="new_material_id" value="'.$details['status_message'][$i]['material_id'].'">
                    <input type="hidden" class="" id="new_material_category_id" name="new_material_category_id" value="'.$details['status_message'][$i]['material_id'].'">
                    </div><br>
                    <label>Material Name: </label>
                    <input class="form-control" type="text" value="'.$details['status_message'][$i]['material_name'].'" id="updated_materialname" name="updated_materialname" required><br>

                    <label>Material&nbsp;ID: </label>
                    <input class="form-control" type="text" value="'.$details['status_message'][$i]['material_innerdimention'].'" id="updated_materialID" name="updated_materialID" required><br>

                    <label>Material&nbsp;OD: </label>
                    <input class="form-control" type="text" value="'.$details['status_message'][$i]['material_outerdimention'].'" id="updated_materialOD" name="updated_materialOD" required><br>
                    <div class="w3-col l12">
                      <div class="w3-col l4 w3-padding-right">
                      <label>Price&nbsp;<span class="w3-tiny">(cost/mm)</span>:</label>
                      <input type="number" name="updated_costpermm" id="updated_costpermm" value="'.$details['status_message'][$i]['pricepermm'].'"  class="form-control w3-margin-bottom" placeholder="Material Instock Quantity"  step="0.01" min="0" required/>
                      </div>
                      <div class="w3-col l4">
                      <label class="w3-text-white">currency:</label>
                        <select class="form-control getmaterialdetails" name="Select_UpdatedCurrency" id="Select_UpdatedCurrency"  required>
                            <option class="w3-red" value="0">Currency </option>
                            <option value="dollar"'; if($details['status_message'][$i]['currency']=='dollar'){echo 'selected';} echo '>Dollar</option>
                            <option value="euro" '; if($details['status_message'][$i]['currency']=='euro'){echo 'selected';} echo '>Euro</option>
                            <option value="pound" '; if($details['status_message'][$i]['currency']=='pound'){echo 'selected';} echo '>Pound</option>
                            <option value="rupees" '; if($details['status_message'][$i]['currency']=='rupees'){echo 'selected';} echo '>Rupees</option>
                          </select>
                         </div>
                      <div class="w3-col l4 w3-padding-left">
                       <label>Price in <i class="fa fa-rupee"></i>:</label>
                        <input type="number" name="UpdatedCurrency_amount" id="UpdatedCurrency_amount" class="form-control" value="'.$details['status_message'][$i]['currency_amount'].'" placeholder="Currency Amount" step="0.01" required>
                      </div>                                       
                      </div><br>                   
                      <button class="btn w3-red" type="submit" name="updateRecord" id="updateRecord">Update Menu</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--modal end--> 
          </td>
         </tr>';
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
    </div>      
  </div>

</div>

</div>

</div><!-- main container -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-title" id="msg_header" name="msg_header"></div>
      </div>
      <div class="modal-body">
        <div id="updateVendordetails_err" name="updateVendordetails_err"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div><!-- modal ends here -->
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


