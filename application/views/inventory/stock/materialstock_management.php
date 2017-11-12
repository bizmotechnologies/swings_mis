<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Stock</title>
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
      <h5><b><i class="fa fa-users"></i> Manage Stocks</b></h5>
    </header>

 <div id="exTab1" class="container"> <!-- container for tab -->
  <div><b>Material Stock Management</b></div><br>
  <ul  class="nav nav-pills">
    <li class="active"><a  href="#RawMaterialStock" data-toggle="tab">Raw Material Stock</a>
    </li>
    <li><a href="#PurchasedProducts" data-toggle="tab">Purchased Products Stock</a>
    </li>
    <li><a href="#FinishedProducts" data-toggle="tab">Finished Product Stock</a>
    </li>
  </ul>

  <div class="tab-content clearfix"><br><!-- tab containt starts -->

    <div class="tab-pane active" id="RawMaterialStock">  <!-- tab for Raw material starts here -->

      <div class=" container w3-padding"><!-- container starts here -->
        <div class="w3-left">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Manage Raw Material</button><br>
        </div><br><br>
      </div><br><!-- container ends here -->

      <div class="container w3-padding"><!-- table container -->
        <div class="">
          <div>
            <div class="w3-margin-right" id="ShowAcceptedStockDetails" name="ShowAcceptedStockDetails">
              <table class="table table-bordered table-responsive" >            <!-- table starts here -->
                <tr >
                  <th class="text-center">SR. No</th>
                  <th class="text-center">Material&nbsp;Name</th>  
                  <th class="text-center">ID</th>              
                  <th class="text-center">OD</th>              
                  <th class="text-center">Length</th>              
                  <th class="text-center">Purchase&nbsp;Discount</th>
                  <th class="text-center">Purchase&nbsp;Price</th>              
                  <th class="text-center">Material&nbsp;Quantity</th> 
                  <th class="text-center">Vender</th>                         
                  <th class="text-center">Accepted&nbsp;Date</th>              
                  <th class="text-center">Actions</th>                                           
                </tr>
                <tbody><!-- table body starts here -->
                  <?php
                  $count=1;
                  if($details['status']==0)
                  {
                    for($i = 0; $i < count($details['status_message']); $i++)
                    { 
                      echo '<tr class="text-center">
                      <td class="text-center">'.$count.'</td>
                      <td class="text-center">'.$details['status_message'][$i]['material_name'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['stock_id'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['stock_od'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['length'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['quantity'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['purchase_price'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['purchase_discount'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['vendor'].'</td>
                      <td class="text-center">'.$details['status_message'][$i]['accepted_date'].'</td>
                      <td class="text-center"><a class="btn  w3-medium" title="UpdateCustomer" data-toggle="modal" data-target="#myModalnew_'.$details['status_message'][$i]['received_stock_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
                      <a class="btn  w3-medium " title="DeleteCustomer" href="'.base_url().'inventory/MaterialStock_Management/DeleteStockDetails?Receivedstock_id='.$details['status_message'][$i]['received_stock_id'].'" style="padding:0"><i class="fa fa-close"></i></a>

                      <!-- Modal  starts here-->

                      <div id="myModalnew_'.$details['status_message'][$i]['received_stock_id'].'" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div>Manage Stock Material</div>
                      </div>
                      <div class="modal-body w3-light-grey">   
                      <form method="POST" action="" id="Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'" name="Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'">
                      <input type="hidden" name="Receivedstock_id" id="Receivedstock_id_'.$details['status_message'][$i]['received_stock_id'].'" value="'.$details['status_message'][$i]['received_stock_id'].'">
                      <div class="row">
                      <div class="col-lg-3">
                      <label>ID:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Updated_MaterialStock_ID" id="Updated_MaterialStock_ID" class="form-control" placeholder="Material ID" step="0.01" value="'.$details['status_message'][$i]['stock_id'].'" required><br>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-3">
                      <label>OD:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Updated_MaterialStock_OD" id="Updated_MaterialStock_OD" class="form-control" placeholder="Material OD" step="0.01" value="'.$details['status_message'][$i]['stock_od'].'" required><br>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-3">
                      <label>Length:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Updated_MaterialLength" id="Updated_MaterialLength" class="form-control" placeholder="Material Length" step="0.01" value="'.$details['status_message'][$i]['length'].'" required><br>
                      </div>          
                      </div>

                      <div class="row">
                      <div class="col-lg-3">
                      <label>Quantity:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Updated_MaterialNewQuantity" id="Updated_MaterialNewQuantity" class="form-control" placeholder="Material Quantity" value="'.$details['status_message'][$i]['quantity'].'" step="0.01" required><br>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-3">
                      <label>Purchase Price<span class="w3-tiny">(per&nbsp;unit)</span>:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Update_StockMaterialPrice" id="Update_StockMaterialPrice" class="form-control" placeholder="Material Price" value="'.$details['status_message'][$i]['purchase_price'].'" step="0.01" required><br>
                      </div>
                      </div>

                      <div class="row">
                      <div class="col-lg-3">
                      <label>Purchase Discount:</label>
                      </div>
                      <div class="col-lg-6">
                      <input type="number" name="Update_StockMaterialDiscount" id="Update_StockMaterialDiscount" class="form-control" placeholder="Material Discount" value="'.$details['status_message'][$i]['purchase_discount'].'" step="0.01" required><br>
                      </div>            
                      </div>

                      <div class="w3-right">
                      <button type="submit" class="btn btn-primary">Save Stock</button></div><br><br>
                      <div class="w3-margin-bottom w3-col l12 w3-small" id="Updatestock_errnew"></div><br><br><br>
                      </form>
                      </div> 
                      </div>
                      </div>
                      </div>
                      
                      <script >
                      /* this script is used to update material info */
                      $(function(){
                       $("#Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'").submit(function(){
                         dataString = $("#Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'").serialize();
                  //alert(dataString);
                         $.ajax({
                           type: "POST",
                           url: "'.base_url().'inventory/MaterialStock_Management/Update_UpdatedStockMaterial_Info",
                           data: dataString,
                           return: false,  

                           success: function(data)
                           {
                            location.reload();
                            $("#Updatestock_errnew").html(data);
                          }

                        });

 return false;  

});
});
 /* update script ends here  */
 </script>   
 <script>   
 /* this script is used to reload page when close modal*/
 $(\'#myModal_'.$details['status_message'][$i]['received_stock_id'].'\').on(\'hidden.bs.modal\', function () {
   location.reload();
 });
 /* this script is used to reload page when close modal*/
 </script>

 </td>
 </tr>';
 $count++;
}
}
else
{
  echo'<tr><td style="text-align: center;" colspan = "9">No Records Found...!</td></tr>';
}
?>
</tbody><!-- table body close here -->
</table>   <!-- table closed here -->
</div>
</div>
</div>
</div><!-- table container ends here -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog"><!-- modal starts here for add materials stocks -->
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div>Manage Stock Material</div>
      </div>
      <div class="modal-body ">
        <form method="POST" action="" id="Manage_MaterialForm" name="Manage_MaterialForm">

          <div class="row">
            <div class="col-lg-2">
              <label>Stock:</label>
            </div>
            <div class="col-lg-4">
             <input type="text" name="Input_MaterialStock" id="Input_MaterialStock" class="form-control" placeholder="Material Stock" step="0.01" required><br>
           </div>
           <div class="col-lg-2">
            <label>Select Material: </label> 
          </div>
          <div class="col-lg-4">                   
            <select class="form-control" name="Select_Materials_Id" id="Select_Materials_Id" onchange="ShowMaterialStock();" required> <!-- this is for showing material stocks quantity -->
              <option>Select Material:</option>
              <?php  foreach ($All_Material as $result ) { ?>
              <option value='<?php echo $result->material_id; ?>' ><?php echo $result->material_name;?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2">
            <label>ID:</label>
          </div>
          <div class="col-lg-4">
           <input type="number" name="Input_MaterialStock_ID" id="Input_MaterialStock_ID" class="form-control" placeholder="Material ID" step="0.01" required><br>
         </div>
         <div class="col-lg-2">
          <label>OD:</label>
        </div>
        <div class="col-lg-4">
         <input type="number" name="Input_MaterialStock_OD" id="Input_MaterialStock_OD" class="form-control" placeholder="Material OD" step="0.01" required><br>
       </div>
     </div>
     
     <div class="row">
      <div class="col-lg-2">
        <label>Length:</label>
      </div>
      <div class="col-lg-4">
       <input type="number" name="Input_MaterialLength" id="Input_MaterialLength" class="form-control" placeholder="Material Length" step="0.01" required><br>
     </div>
     <div class="col-lg-2">
      <label>Quantity:</label>
    </div>
    <div class="col-lg-4">
     <input type="number" name="Input_MaterialNewQuantity" id="Input_MaterialNewQuantity" class="form-control" placeholder="Material Quantity" step="0.01" required><br>
   </div>      
 </div>

 <div class="row">
  <div class="col-lg-2">
    <label>Select Vendor: </label> 
  </div> 
  <div class="col-lg-4">                   
   <input type="text" name="Select_StockVenders" id="Select_StockVenders" class="form-control" placeholder="Material Vendors" required><br>
 </div>
</div><br>

<div class="w3-right">
 <button type="submit" class="btn btn-primary">Save Stock</button></div><br><br>
 <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div><br><br><br>
</form><!-- form ends here -->

</div>  
</div>
</div>
</div>
</div><!-- tab div ends here -->



<div class="tab-pane" id="PurchasedProducts">  <!-- tab 2 starts here -->

  <div class=" container w3-padding"><!-- container starts here -->
    <div class="w3-left">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalFor_purchasedProduct">Add Purchased Stock</button><br>
    </div><br><br>
  </div><br><!-- container ends here -->

  <div class="container w3-padding"><!-- table container -->
    <div class="">
      <div>
        <div class="w3-margin-right" id="ShowAcceptedStockDetails" name="ShowAcceptedStockDetails">
          <table class="table table-bordered table-responsive" >            <!-- table starts here -->
            <tr >
              <th class="text-center">SR. No</th>
              <th class="text-center">Material&nbsp;Name</th>  
              <th class="text-center">ID</th>              
              <th class="text-center">OD</th>              
              <th class="text-center">Length</th>              
              <th class="text-center">Purchase&nbsp;Discount</th>
              <th class="text-center">Vender</th>                         
              <th class="text-center">Accepted&nbsp;Date</th>              
              <th class="text-center">Actions</th>                                           
            </tr>
            <tbody><!-- table body starts here -->

            </tbody><!-- table body close here -->
          </table><!-- table closed here -->
        </div>
      </div>
    </div>
  </div><!-- table container ends here -->
  <!-- Modal -->
  <div id="ModalFor_purchasedProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div><!-- tab 2 ends here -->

<div class="tab-pane" id="FinishedProducts"><!-- tab 3 starts here -->

  <div class=" container w3-padding"><!-- container starts here -->
    <div class="w3-left">
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalFor_FinishedProduct">Add Finished Stock</button><br>
    </div><br><br>
  </div><br><!-- container ends here -->

  <div class="container w3-padding"><!-- table container -->
    <div class="">
      <div>
        <div class="w3-margin-right" id="ShowAcceptedStockDetails" name="ShowAcceptedStockDetails">
          <table class="table table-bordered table-responsive" >            <!-- table starts here -->
            <tr >
              <th class="text-center">SR. No</th>
              <th class="text-center">Material&nbsp;Name</th>  
              <th class="text-center">ID</th>              
              <th class="text-center">OD</th>              
              <th class="text-center">Length</th>              
              <th class="text-center">Purchase&nbsp;Discount</th>
              <th class="text-center">Vender</th>                         
              <th class="text-center">Accepted&nbsp;Date</th>              
              <th class="text-center">Actions</th>                                           
            </tr>
            <tbody><!-- table body starts here -->

            </tbody><!-- table body close here -->
          </table><!-- table closed here -->
        </div>
      </div>
    </div>
  </div><!-- table container ends here -->
  <!-- Modal -->
  <div id="ModalFor_FinishedProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div><!-- tab 3 div ends here -->

</div><!-- tab containt ends here -->

</div><!-- tab containt div ends here -->


</div><!-- container for tab -->


</div><!-- div for main container -->
<script >
/*this script is used for save stock material information*/
$(function(){
 $("#Manage_MaterialForm").submit(function(){
   dataString = $("#Manage_MaterialForm").serialize();
    //alert(dataString);
    $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/Save_StockMaterial_Info",
     data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
            //alert(data);
            $("#addProducts_err").html(data);
          }

        });

         return false;  //stop the actual form post !important!

       });
});
/*this script is used for save stock material information*/
</script>
<script>  /* this function is used for show total material stocks quantity*/
function ShowMaterialStock(){

  dataString ='Select_Materials_Id='+$("#Select_Materials_Id").val();

  $.ajax({
    type: "POST",
    url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/ShowMaterialStock",
    data: dataString,
    cache: false,
    success: function(data){
      
     $('#Input_MaterialStock').val(data);
   } 
 });

}
/*this function is used for show total material stocks quantity*/
</script>  
