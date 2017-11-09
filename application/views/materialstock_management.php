  <div class="w3-main" style="margin-left:120px;">

<div class=" container w3-light-grey w3-padding">
<div class="w3-left">
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Manage Material</button><br>
  <!-- Trigger the modal with a button -->


</div><br><br>
</div><br>

<div class="container w3-light-grey w3-padding">
	<div class="w3-light-grey">
		<div>
			<div class="w3-margin-right" id="ShowAcceptedStockDetails" name="ShowAcceptedStockDetails">
				<table class="table table-bordered table-responsive" >
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
					<tbody>
	<?php
  	//print_r($details); 
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
              <a class="btn  w3-medium " title="DeleteCustomer" href="'.base_url().'MaterialStock_Management/DeleteStockDetails?Receivedstock_id='.$details['status_message'][$i]['received_stock_id'].'" style="padding:0"><i class="fa fa-close"></i></a>

              <!-- Modal -->
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
		           </form>
		             </div>	
		           </div>
               </div>
               </div>
		
<script >
$(function(){
   $("#Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'").submit(function(){
     dataString = $("#Update_Manage_MaterialForm_'.$details['status_message'][$i]['received_stock_id'].'").serialize();
    //alert(dataString);
    $.ajax({
     type: "POST",
     url: "'.base_url().'MaterialStock_Management/Update_UpdatedStockMaterial_Info",
     data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
            //alert(data);
            $("#Updatestock_errnew").html(data);
          }

        });

         return false;  //stop the actual form post !important!

       });
 });
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
					</tbody>
                    </table>
					</div>
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
			<div>Manage Stock Material</div>
		</div>
		<div class="modal-body w3-light-grey">
		<form method="POST" action="" id="Manage_MaterialForm" name="Manage_MaterialForm">

          <div class="w3-center">
          </div>
          <div class="row">

            <div class="col-lg-3">
              <label>Select Material: </label> 
            </div> 
            <div class="col-lg-6">                   
              <select class="form-control" name="Select_Materials_Id" id="Select_Materials_Id" onchange="ShowMaterialStock();" required>
                <option>Select Material:</option>
                <?php  foreach ($All_Material as $result ) { ?>
               <option value='<?php echo $result->material_id; ?>' ><?php echo $result->material_name;?></option>
                <?php } ?>
              </select>
            </div>
       
          </div>

          <div class="row">

          	<div class="col-lg-3">
          		<label>Stock:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="text" name="Input_MaterialStock" id="Input_MaterialStock" class="form-control" placeholder="Material Stock" step="0.01" required><br>
          	</div>

          </div>

           <div class="row">

          	<div class="col-lg-3">
          		<label>ID:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_MaterialStock_ID" id="Input_MaterialStock_ID" class="form-control" placeholder="Material ID" step="0.01" required><br>
          	</div>

          </div>
           <div class="row">

          	<div class="col-lg-3">
          		<label>OD:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_MaterialStock_OD" id="Input_MaterialStock_OD" class="form-control" placeholder="Material OD" step="0.01" required><br>
          	</div>

          </div>

           <div class="row">
          	<div class="col-lg-3">
          		<label>Length:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_MaterialLength" id="Input_MaterialLength" class="form-control" placeholder="Material Length" step="0.01" required><br>
          	</div>          
          </div>

          <div class="row">

          	<div class="col-lg-3">
          		<label>Quantity:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_MaterialNewQuantity" id="Input_MaterialNewQuantity" class="form-control" placeholder="Material Quantity" step="0.01" required><br>
          	</div>

          </div>

          <div class="row">

          	<div class="col-lg-3">
          		<label>Purchase Price<span class="w3-tiny">(per&nbsp;unit)</span>:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_StockMaterialPrice" id="Input_StockMaterialPrice" class="form-control" placeholder="Material Price" step="0.01" required><br>
          	</div>
          	
          </div>

          <div class="row">

          	<div class="col-lg-3">
          		<label>Purchase Discount:</label>
          	</div>
          	<div class="col-lg-6">
          	   <input type="number" name="Input_StockMaterialDiscount" id="Input_StockMaterialDiscount" class="form-control" placeholder="Material Discount" step="0.01" required><br>
          	</div>
          	
          </div>

          <div class="row">

          	<div class="col-lg-3">
              <label>Select Vendor: </label> 
            </div> 
            <div class="col-lg-6">                   
               <input type="text" name="Select_StockVenders" id="Select_StockVenders" class="form-control" placeholder="Material Vendors" required><br>
            </div>

          </div><br>

          <div class="w3-right">
           <button type="submit" class="btn btn-primary">Save Stock</button></div><br><br>
           <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div><br><br><br>
          </form>

		  </div>	
		</div>
		</div>
		</div>
  </div>
<script >
$(function(){
   $("#Manage_MaterialForm").submit(function(){
     dataString = $("#Manage_MaterialForm").serialize();
    //alert(dataString);
    $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>MaterialStock_Management/Save_StockMaterial_Info",
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
</script>
<script>
function ShowMaterialStock(){

  dataString ='Select_Materials_Id='+$("#Select_Materials_Id").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>MaterialStock_Management/ShowMaterialStock",
      data: dataString,
      cache: false,
      success: function(data){
      
       $('#Input_MaterialStock').val(data);
      } 
    });

}
</script>		