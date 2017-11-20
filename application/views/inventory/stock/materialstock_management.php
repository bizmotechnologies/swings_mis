<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
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
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/country/country.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/materialstock_management.js"></script>

    </head>
    <body class="w3-light-grey">
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">

            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-cubes"></i> Manage Stocks</b></h5>
            </header>

            <div id="exTab1" class="container"> <!-- container for tab -->
                <br>
                <ul  class="nav nav-tabs">
                    <li class="active"><a  href="#RawMaterialStock" data-toggle="tab">Raw Material Stock</a>
                    </li>
<!--                    <li><a href="#PurchasedProducts" data-toggle="tab">Purchased Products Stock</a>
                    </li>
                    <li><a href="#FinishedProducts" data-toggle="tab">Finished Product Stock</a>
                    </li>-->
                </ul>

                <div class="tab-content clearfix"><br><!-- tab containt starts -->

                    <div class="tab-pane active" id="RawMaterialStock">  <!-- tab for Raw material starts here -->

                        <div class="col-lg-12"><label>Add new Material</label>
                        </div>
                        <div class="w3-col l12 w3-margin-top w3-small">
                            <form id="Add_material_form">

                                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                                    <label class="w3-label">Material Name:</label>
                                    <input type="text" placeholder="Material Name" class="form-control" style="text-transform:uppercase;" id="material_nameForStock" name="material_nameForStock">
                                </div>
                                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                                    <label class="w3-label">Material Color:</label>
                                    <input type="text" autocomplete="off"  placeholder="Material Color" class="form-control" style="text-transform:uppercase;" id="materialColor_ForStock" name="materialColor_ForStock">
                                </div>

                                <div class="w3-col l1 w3-padding-top w3-padding-left w3-padding-right ">
                                    <button class="btn w3-blue w3-margin-top" type="submit" id="Save_materialBtn" name="Save_materialBtn">Add Material</button>
                                </div>

                            </form>
                            <div class="w3-col l3 w3-padding-left w3-padding-bottom w3-margin-left w3-right">
                                <div class="input-group w3-padding-left w3-padding-top w3-margin-top">
                                    <select class="form-control" name="Select_NewMaterials_Id" id="Select_NewMaterials_Id" required> <!-- this is for showing material stocks quantity -->
                                        <option>Select Material</option>
                                        <?php foreach ($materials['status_message'] as $result) { ?>
                                            <option value='<?php echo $result['material_id']; ?>' ><?php echo $result['material_name'] . '-' . $result['material_color']; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-btn">
                                        <button class="btn btn-secondary w3-blue" type="button" onclick="Delete_material();"><i class="fa fa-trash"></i></button>
                                    </span>
                                </div>
                            </div>

                            <div class="w3-col l12" id="addMaterial_err"></div>
                        </div><br>
                        <div class="w3-col l12 w3-padding"><!-- table container -->
                            <hr>
                            
                            <div class="">

                                <div class=" w3-col l12"><!-- container starts here -->
                                                                                                                <div class="w3-col l12"><label>Manage Raw Material</label></div><br>

                                    <div class="w3-left w3-margin-top">

                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Add Raw Material</button><br>
                                    </div>
                                </div><br><!-- container ends here -->
                                <div class="w3-col l12 w3-margin-top">
                                    <div class="" id="ShowRaw_products" name="ShowRaw_products" style="max-height: 400px; overflow: scroll;">
                                        <table class="table table-bordered table-responsive w3-small" >            <!-- table starts here -->
                                            <tr >
                                                <th class="text-center">SR. No</th>
                                                <th class="text-center">Material&nbsp;Name</th>  
                                                <th class="text-center">ID</th>              
                                                <th class="text-center">OD</th>              
                                                <th class="text-center">Available&nbsp;Length</th>              
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Actions</th>                                           
                                            </tr>
                                            <tbody><!-- table body starts here -->
                                                <?php
                                                $count = 1;
                                                if ($details['status'] == 1) {
                                                    for ($i = 0; $i < count($details['status_message']); $i++) {
                                                        echo '<tr class="text-center">
                          <td class="text-center">' . $count . '.</td>
                          <td class="text-center">' . $details['status_message'][$i]['material_name'] . '</td>
                          <td class="text-center">' . $details['status_message'][$i]['raw_ID'] . '</td>
                          <td class="text-center">' . $details['status_message'][$i]['raw_OD'] . '</td>
                          <td class="text-center">' . $details['status_message'][$i]['avail_length'] . '</td>
                          <td class="text-center">' . $details['status_message'][$i]['raw_quantity'] . '</td>
                          <td class="text-center"><a class="btn w3-red w3-medium w3-padding-small" title="DeleteCustomer" href="' . base_url() . 'inventory/MaterialStock_Management/DeleteRawMaterialStockDetails?rawmaterial_id=' . $details['status_message'][$i]['rawmaterial_id'] . '" style="padding:0"><i class="fa fa-close"></i></a>

                          <!-- Modal  starts here-->

                          <div id="myModalnew_' . $details['status_message'][$i]['rawmaterial_id'] . '" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div>Manage Stock Material</div>
                          </div>
                          <div class="modal-body w3-light-grey">   
                          <form method="POST" action="" id="Update_Manage_MaterialForm_' . $details['status_message'][$i]['rawmaterial_id'] . '" name="Update_Manage_MaterialForm_' . $details['status_message'][$i]['rawmaterial_id'] . '">
                          <input type="hidden" name="rawmaterial_id" id="rawmaterial_id' . $details['status_message'][$i]['rawmaterial_id'] . '" value="' . $details['status_message'][$i]['rawmaterial_id'] . '">
                          <div class="row">
                          <div class="col-lg-3">
                          <label>Select Material</label> 
                          </div>
                          <div class="col-lg-6">                   
                          <select class="form-control" name="Select_RawMaterials_Id" id="Select_RawMaterials_Id" required> <!-- this is for showing material stocks quantity -->
                          <option>Select Material</option>';
                                                        foreach ($All_Material as $result) {
                                                            echo '<option value="' . $result['material_id'] . '"';
                                                            if ($details['status_message'][$i]['material_id'] == $result['material_id']) {
                                                                echo 'selected';
                                                            } echo '>' . $result['material_name'] . '</option>';
                                                        }
                                                        echo '</select><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>ID:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_MaterialStock_ID" id="Updated_MaterialStock_ID" class="form-control" placeholder="Material ID" step="0.01" value="' . $details['status_message'][$i]['raw_ID'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>OD:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_MaterialStock_OD" id="Updated_MaterialStock_OD" class="form-control" placeholder="Material OD" step="0.01" value="' . $details['status_message'][$i]['raw_OD'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Length:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_MaterialLength" id="Updated_MaterialLength" class="form-control" placeholder="Material Length" step="0.01" value="' . $details['status_message'][$i]['avail_length'] . '" required><br>
                         </div>          
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Quantity:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_MaterialNewQuantity" id="Updated_MaterialNewQuantity" class="form-control" placeholder="Material Quantity" value="' . $details['status_message'][$i]['raw_quantity'] . '" step="0.01" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Select Material</label> 
                         </div>
                         <div class="col-lg-6">                   
                         <select class="form-control" name="Select_RawVendor_Id" id="Select_RawVendor_Id" required> <!-- this is for showing material stocks quantity -->
                         <option>Select Material</option>';
                                                        foreach ($vendors as $result) {
                                                            echo '<option value="' . $result['vendor_id'] . '"';
                                                            if ($details['status_message'][$i]['vendor_id'] == $result['vendor_id']) {
                                                                echo 'selected';
                                                            } echo '>' . $result['vendor_name'] . '</option>';
                                                        }
                                                        echo '</select><br>
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

                         <script>
                         /* this script is used to update material info */
                         $(function(){
                           $("#Update_Manage_MaterialForm_' . $details['status_message'][$i]['rawmaterial_id'] . '").submit(function(){
                             dataString = $("#Update_Manage_MaterialForm_' . $details['status_message'][$i]['rawmaterial_id'] . '").serialize();
                             $.ajax({
                               type: "POST",
                               url: "' . base_url() . 'inventory/MaterialStock_Management/Update_UpdatedRawStockMaterial_Info",
                               data: dataString,
                               return: false,  
                               success: function(data)
                               {
                                $("#Updatestock_errnew").html(data);
                                location.reload();
                              }
                            });
return false;  
});
});
/* update script ends here  */
</script>   

<script>   
/* this script is used to reload page when close modal*/
$("#myModal_' . $details['status_message'][$i]['rawmaterial_id'] . '").on("hidden.bs.modal", function () {
 location.reload();
});
/* this script is used to reload page when close modal*/
</script>


</td>
</tr>';
                                                        $count++;
                                                    }
                                                } else {
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
                        <div id="myModal" class="modal fade" role="dialog"><!-- modal starts here for add Raw  materials stocks -->
                            <div class="modal-dialog ">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <div class="w3-xlarge w3-center">Add Raw Materials</div>
                                    </div>
                                    <div class="modal-body w3-small">
                                        <form method="POST" action="" id="Manage_RawMaterialForm" name="Manage_RawMaterialForm">
                                            <div class="w3-padding-left col-lg-offset-1">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Select&nbsp;Material:</label> 
                                                </div>
                                                <div class="col-lg-6">  
                                                    <select class="form-control" name="Select_RawMaterials" id="Select_RawMaterials" required> <!-- this is for showing material stocks quantity -->
                                                        <option>Select Material:</option>
                                                        <?php foreach ($All_Material as $result) { ?>
                                                            <option value='<?php echo $result['material_id']; ?>' ><?php echo $result['material_name'] . '-' . $result['material_color'] ?></option>
                                                        <?php } ?>
                                                    </select><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Select&nbsp;Vendor: </label> 
                                                </div> 
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="Select_RawVendors_Id" id="Select_RawVendors_Id" required>                   
                                                        <option>Select Vendor:</option>
                                                        <?php foreach ($vendors as $result) { ?>
                                                            <option value='<?php echo $result['vendor_id']; ?>' ><?php echo $result['vendor_name']; ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </div>
                                            </div><br>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">ID:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialStock_ID" id="Input_RawMaterialStock_ID" class="form-control" placeholder="Material ID" step="0.01" required><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">OD:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialStock_OD" id="Input_RawMaterialStock_OD" class="form-control" placeholder="Material OD" step="0.01" required><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Length:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialLength" id="Input_RawMaterialLength" class="form-control" placeholder="Material Length" step="0.01" required><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Quantity:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialNewQuantity" id="Input_RawMaterialNewQuantity" class="form-control" placeholder="Material Quantity" step="0.01" required><br>
                                                </div>      
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="checkbox" name="checkPrice" id="checkPrice" value=""> Fetch Price From Price list<br>
                                                </div>
                                            </div><br>

                                            <div class="row" id="simple_price">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Price:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialPrice" id="Input_RawMaterialPrice" class="form-control" placeholder="Material Quantity" step="0.01" ><br>
                                                </div>      
                                            </div>
                                            <br>

                                            <div class="row" id="fetched_price" style="display:none">
                                                <div class="col-lg-3">
                                                    <label class="padding-left">Fetched&nbsp;Price:</label>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="number" name="Input_RawMaterialPriceFrom_Pricelist" id="Input_RawMaterialPriceFrom_Pricelist" class="form-control" placeholder="Material Quantity" step="0.01" ><br>
                                                </div>      
                                            </div>

                                            <center>
                                                <button type="submit" class="btn btn-primary">Save Stock</button>
                                                <button type="reset" class="btn btn-default">Reset</button>
                                            </center><br><br>
                                            <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div><br><br><br>
                                            </div>
                                        </form><!-- form ends here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- modal ends here -->
                    <!--____________________________________ tab div 1 ends here_________________________________________ -->

                    <div class="tab-pane" id="PurchasedProducts">  <!-- tab 2 starts here -->

                        <div class=" container w3-padding"><!-- container starts here -->
                            <div class="w3-left">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalFor_purchasedProduct">Add Purchased Stock</button><br>
                            </div><br><br>
                        </div><br><!-- container ends here -->

                        <div class="container w3-padding"><!-- table container -->
                            <div class="">
                                <div>
                                    <div class="w3-margin-right" id="ShowPurchasedProduct" name="ShowPurchasedProduct" style="max-height: 400px; overflow: scroll;">
                                        <table class="table table-bordered table-responsive" >            <!-- table starts here -->
                                            <tr >
                                                <th class="text-center">SR. No</th>
                                                <th class="text-center">Material&nbsp;Name</th>  
                                                <th class="text-center">ID</th>              
                                                <th class="text-center">OD</th>              
                                                <th class="text-center">Length</th>              
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">price</th>                         
                                                <th class="text-center">Actions</th>                                           
                                            </tr>
                                            <tbody><!-- table body starts here -->

                                                <?php
                                                $count = 1;
                                                if ($Purchased['status'] == 1) {//print_r($Purchased['status_message']);
                                                    for ($i = 0; $i < count($Purchased['status_message']); $i++) {
                                                        echo '<tr class="text-center">
                          <td class="text-center">' . $count . '.</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['product_name'] . '</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['stock_id'] . '</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['stock_od'] . '</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['length'] . '</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['quantity'] . '</td>
                          <td class="text-center">' . $Purchased['status_message'][$i]['purchase_price'] . '</td>
                          <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateCustomer" data-toggle="modal" data-target="#myModalnew_' . $Purchased['status_message'][$i]['purchased_product_id'] . '" style="padding:0"><i class="fa fa-edit"></i></a>
                          <a class="btn w3-red w3-medium w3-padding-small" title="DeleteCustomer" href="' . base_url() . 'inventory/MaterialStock_Management/DeletePurchasedStockDetails?purchased_product_id=' . $Purchased['status_message'][$i]['purchased_product_id'] . '" style="padding:0"><i class="fa fa-close"></i></a>

                          <!-- Modal  starts here-->

                          <div id="myModalnew_' . $Purchased['status_message'][$i]['purchased_product_id'] . '" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div>Manage Stock Material</div>
                          </div>
                          <div class="modal-body w3-light-grey">   
                          <form method="POST" action="" id="Update_purchasedManage_MaterialForm_' . $Purchased['status_message'][$i]['purchased_product_id'] . '" name="Update_purchasedManage_MaterialForm_' . $Purchased['status_message'][$i]['purchased_product_id'] . '">
                          <input type="hidden" name="purchased_product_id" id="purchased_product_id' . $Purchased['status_message'][$i]['purchased_product_id'] . '" value="' . $Purchased['status_message'][$i]['purchased_product_id'] . '">
                          <div class="row">
                          <div class="col-lg-3">
                          <label>Select Product:</label> 
                          </div>
                          <div class="col-lg-6">                   
                          <select class="form-control" name="Select_UpdatedPurchased_Id" id="Select_UpdatedPurchased_Id_' . $Purchased['status_message'][$i]['purchased_product_id'] . '" required> <!-- this is for showing material stocks quantity -->
                          <option value="0">Select Product</option>';
                                                        foreach ($product as $result) {
                                                            echo '<option value="' . $result['product_id'] . '"';
                                                            if ($Purchased['status_message'][$i]['product_id'] == $result['product_id']) {
                                                                echo 'selected';
                                                            } echo '>' . $result['product_name'] . '</option>';
                                                        }
                                                        echo '</select><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Select Vendor</label> 
                         </div>
                         <div class="col-lg-6">                   
                         <select class="form-control" name="Select_UpdatedVendor_Id" id="Select_UpdatedVendor_Id" required> <!-- this is for showing material stocks quantity -->
                         <option value="0">Select Material</option>';
                                                        foreach ($vendors as $result) {
                                                            echo '<option value="' . $result['vendor_id'] . '"';
                                                            if ($Purchased['status_message'][$i]['vendor_id'] == $result['vendor_id']) {
                                                                echo 'selected';
                                                            } echo '>' . $result['vendor_name'] . '</option>';
                                                        }
                                                        echo '</select><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>ID:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_PurchasedStock_ID" id="Updated_PurchasedStock_ID" class="form-control" placeholder="Material ID" step="0.01" value="' . $Purchased['status_message'][$i]['stock_id'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>OD:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_purchasedStock_OD" id="Updated_purchasedStock_OD" class="form-control" placeholder="Material OD" step="0.01" value="' . $Purchased['status_message'][$i]['stock_od'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Length:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_purchasedLength" id="Updated_purchasedLength" class="form-control" placeholder="Material Length" step="0.01" value="' . $Purchased['status_message'][$i]['length'] . '" required><br>
                         </div>          
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Quantity:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_PurchasedNewQuantity" id="Updated_PurchasedNewQuantity" class="form-control" placeholder="Material Quantity" value="' . $Purchased['status_message'][$i]['quantity'] . '" step="0.01" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label for="price" class="control-label w3-medium">Price<span class="w3-tiny">(cost/mm)</span>:</label></div>
                         <div class="col-lg-3">
                         <input type="number" name="input_updatedpriceForPurchase" id="input_updatedpriceForPurchase" class="form-control" value="' . $Purchased['status_message'][$i]['purchase_price'] . '" placeholder="Product Price" step="0.01" required>
                         </div>
                         <div class="col-lg-3">
                         <select class="form-control" name="Select_UpdatedpurchasedCurrency" id="Select_UpdatedpurchasedCurrency"  required>
                         <option class="w3-red" value="0">Currency </option>
                         <option value="dollar"';
                                                        if ($Purchased['status_message'][$i]['purchase_currency'] == 'dollar') {
                                                            echo 'selected';
                                                        } echo '>Dollar</option>
                            <option value="euro" ';
                                                        if ($Purchased['status_message'][$i]['purchase_currency'] == 'euro') {
                                                            echo 'selected';
                                                        } echo '>Euro</option>
                            <option value="pound" ';
                                                        if ($Purchased['status_message'][$i]['purchase_currency'] == 'pound') {
                                                            echo 'selected';
                                                        } echo '>Pound</option>
                            <option value="rupees" ';
                                                        if ($Purchased['status_message'][$i]['purchase_currency'] == 'rupees') {
                                                            echo 'selected';
                                                        } echo '>Rupees</option>

                         </select>
                         </div>
                         </div><br>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Currency price in <i class="fa fa-rupee"></i>:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Input_UpdatedPurchased_Price" id="Input_Purchased_Price" class="form-control" value="' . $Purchased['status_message'][$i]['price_in_rs'] . '" placeholder="product prize in rs" step="0.01" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Discount:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Input_PurchasedDiscount" id="Input_PurchasedDiscount" class="form-control" value="' . $Purchased['status_message'][$i]['purchase_discount'] . '" placeholder="product discount" step="0.01" required><br>
                         </div>
                         </div>


                         <div class="w3-right">
                         <button type="submit" class="btn btn-primary">Save Stock</button></div><br><br>
                         <div class="w3-margin-bottom w3-col l12 w3-small w3-center" id="Updatestock_errnew_' . $Purchased['status_message'][$i]['purchased_product_id'] . '"></div><br><br><br>
                         </form>
                         </div> 
                         </div>
                         </div>
                         </div>

                         <script>
                         /* this script is used to update material info */
                         $(function(){
                           $("#Update_purchasedManage_MaterialForm_' . $Purchased['status_message'][$i]['purchased_product_id'] . '").submit(function(){
                             dataString = $("#Update_purchasedManage_MaterialForm_' . $Purchased['status_message'][$i]['purchased_product_id'] . '").serialize();
                             $.ajax({
                               type: "POST",
                               url: "' . base_url() . 'inventory/MaterialStock_Management/Update_purchasedproducts_Info",
                               data: dataString,
                               return: false,  
                               success: function(data)
                               {
                                $("#Updatestock_errnew_' . $Purchased['status_message'][$i]['purchased_product_id'] . '").html(data);
                                location.reload();
                              }
                            });
return false;  
});
});
/* update script ends here  */
</script>   

<script>   
/* this script is used to reload page when close modal*/
$("#myModal_' . $Purchased['status_message'][$i]['purchased_product_id'] . '").on("hidden.bs.modal", function () {
  location.reload();
});
/* this script is used to reload page when close modal*/
</script>


</td>
</tr>';
                                                        $count++;
                                                    }
                                                } else {
                                                    echo'<tr><td style="text-align: center;" colspan = "9">No Records Found...!</td></tr>';
                                                }
                                                ?>

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
                                        <h4 class="modal-title">Add Purchased Products</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="" id="Manage_PurchasedProductForm" name="Manage_PurchasedProductForm">

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Select Product:</label> 
                                                </div>
                                                <div class="col-lg-6">                   
                                                    <select class="form-control" name="Select_PurchasedProduct_Id" id="Select_PurchasedProduct_Id" required> <!-- this is for showing material stocks quantity -->
                                                        <option>Select Product</option>
                                                        <?php foreach ($product as $result) { ?>
                                                            <option value='<?php echo $result['product_id']; ?>' ><?php echo $result['product_name']; ?></option>
                                                        <?php } ?>
                                                    </select><br>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <label>Select Vendor: </label> 
                                                </div> 
                                                <div class="col-lg-6">
                                                    <select class="form-control" name="Select_PurchasedVendors_Id" id="Select_PurchasedVendors_Id" required>                   
                                                        <option>Select Vendor:</option>
                                                        <?php foreach ($vendors as $result) { ?>
                                                            <option value='<?php echo $result['vendor_id']; ?>' ><?php echo $result['vendor_name']; ?></option>
                                                    <?php } ?> </div>
                                                </select>
                                            </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>ID:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_PurchasedProductStock_ID" id="Input_PurchasedProductStock_ID" class="form-control" placeholder="product ID" step="0.01" required><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>OD:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_ProductStock_OD" id="Input_ProductStock_OD" class="form-control" placeholder="product OD" step="0.01" required><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Length:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_PurchasedLength" id="Input_PurchasedLength" class="form-control" placeholder="product Length" step="0.01" required><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Quantity:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_Purchased_quantity" id="Input_Purchased_quantity" class="form-control" placeholder="product Length" step="0.01" required><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="price" class="control-label w3-medium">Price<span class="w3-tiny">(cost/mm)</span>:</label></div>
                                        <div class="col-lg-3">
                                            <input type="number" name="input_priceForPurchase" id="input_priceForPurchase" class="form-control" placeholder="Product Price" step="0.01" required>
                                        </div>
                                        <div class="col-lg-3">
                                            <select class="form-control" name="Select_purchasedCurrency" id="Select_purchasedCurrency"  required>
                                                <option class="w3-red" value="0">Currency </option>
                                                <option value="dollar">Dollar</option>
                                                <option value="euro">Euro</option>
                                                <option value="pound">Pound</option>
                                                <option value="rupees">Rupees</option>
                                            </select>
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>price in <i class="fa fa-rupee"></i>:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_Purchased_Price" id="Input_Purchased_Price" class="form-control" placeholder="product Length" step="0.01" required><br>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label>Discount:</label>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="number" name="Input_PurchasedDiscount" id="Input_PurchasedDiscount" class="form-control" placeholder="product Length" step="0.01" required><br>
                                        </div>
                                    </div>
                                    <br>

                                    <center>
                                        <button type="submit" class="btn btn-primary">Save Stock</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </center><br><br>
                                    <div class="w3-margin-bottom w3-col l12 w3-small" id="addpurchaseproducts_err"></div><br><br><br>
                                </div>
                                </form><!-- form ends here -->

                            </div>

                        </div>
                    </div>

                </div><!--tab 2 ends here -->
                <!-- ____________________________the tab 2 ends here____________________ -->

                <!--_______________________________ tab 3 starts here_____________________________________________ -->

                <div class="tab-pane" id="FinishedProducts"><!-- tab 3 starts here -->

                    <div class=" container w3-padding"><!-- container starts here -->
                        <div class="w3-left">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalFor_FinishedProduct">Add Finished Stock</button><br>
                        </div><br><br>
                    </div><br><!-- container ends here -->

                    <div class="container w3-padding"><!-- table container -->
                        <div class="">
                            <div>
                                <div class="w3-margin-right" id="ShowFinishedProduct" name="ShowFinishedProduct" style="max-height: 350px; overflow: scroll;">
                                    <table class="table table-bordered table-responsive" >            <!-- table starts here -->
                                        <tr >
                                            <th class="text-center">SR. No</th>
                                            <th class="text-center">Product&nbsp;Name</th>  
                                            <th class="text-center">ID</th>              
                                            <th class="text-center">OD</th>              
                                            <th class="text-center">Length</th>              
                                            <th class="text-center">Quantity</th>         
                                            <th class="text-center">Actions</th>                                           
                                        </tr>
                                        <tbody><!-- table body starts here -->

                                            <?php
                                            $count = 1;
                                            if ($Finished['status'] == 1) {//print_r($Purchased['status_message']);
                                                for ($i = 0; $i < count($Finished['status_message']); $i++) {
                                                    echo '<tr class="text-center">
                          <td class="text-center">' . $count . '.</td>
                          <td class="text-center">' . $Finished['status_message'][$i]['product_name'] . '</td>
                          <td class="text-center">' . $Finished['status_message'][$i]['fproduct_ID'] . '</td>
                          <td class="text-center">' . $Finished['status_message'][$i]['fproduct_OD'] . '</td>
                          <td class="text-center">' . $Finished['status_message'][$i]['fproduct_length'] . '</td>
                          <td class="text-center">' . $Finished['status_message'][$i]['fproduct_quantity'] . '</td>
                          <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateCustomer" data-toggle="modal" data-target="#myModalnew_' . $Finished['status_message'][$i]['finished_product_id'] . '" style="padding:0"><i class="fa fa-edit"></i></a>
                          <a class="btn w3-red w3-medium w3-padding-small" title="DeleteCustomer" href="' . base_url() . 'inventory/MaterialStock_Management/DeleteFinishedProductDetails?finished_product_id=' . $Finished['status_message'][$i]['finished_product_id'] . '" style="padding:0"><i class="fa fa-close"></i></a>

                          <!-- Modal  starts here-->

                          <div id="myModalnew_' . $Finished['status_message'][$i]['finished_product_id'] . '" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                          <!-- Modal content-->
                          <div class="modal-content">
                          <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div>Manage Stock Material</div>
                          </div>
                          <div class="modal-body w3-light-grey">   
                          <form method="POST" action="" id="Update_Finished_ProductForm_' . $Finished['status_message'][$i]['finished_product_id'] . '" name="Update_Finished_ProductForm_' . $Finished['status_message'][$i]['finished_product_id'] . '">
                          <input type="hidden" name="finished_product_id" id="finished_product_id_' . $Finished['status_message'][$i]['finished_product_id'] . '" value="' . $Finished['status_message'][$i]['finished_product_id'] . '">
                          <div class="row">
                          <div class="col-lg-3">
                          <label>Select Product:</label> 
                          </div>
                          <div class="col-lg-6">                   
                          <select class="form-control" name="Select_UpdatedFinished_product_Id" id="Select_UpdatedFinished_product_Id_' . $Finished['status_message'][$i]['finished_product_id'] . '" required> <!-- this is for showing material stocks quantity -->
                          <option value="0">Select Product</option>';
                                                    foreach ($product as $result) {
                                                        echo '<option value="' . $result['product_id'] . '"';
                                                        if ($Finished['status_message'][$i]['product_id'] == $result['product_id']) {
                                                            echo 'selected';
                                                        } echo '>' . $result['product_name'] . '</option>';
                                                    }
                                                    echo '</select><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>ID:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_FinishedProduct_ID" id="Updated_FinishedProduct_ID" class="form-control" placeholder="Product ID" step="0.01" value="' . $Finished['status_message'][$i]['fproduct_ID'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>OD:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_FinishedProduct_OD" id="Updated_FinishedProduct_OD" class="form-control" placeholder="Material OD" step="0.01" value="' . $Finished['status_message'][$i]['fproduct_OD'] . '" required><br>
                         </div>
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Length:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_FinishedProductLength" id="Updated_FinishedProductLength" class="form-control" placeholder="Material Length" step="0.01" value="' . $Finished['status_message'][$i]['fproduct_length'] . '" required><br>
                         </div>          
                         </div>

                         <div class="row">
                         <div class="col-lg-3">
                         <label>Quantity:</label>
                         </div>
                         <div class="col-lg-6">
                         <input type="number" name="Updated_FinishedProductQuantity" id="Updated_FinishedProductQuantity" class="form-control" placeholder="Material Quantity" value="' . $Finished['status_message'][$i]['fproduct_quantity'] . '" step="0.01" required><br>
                         </div>
                         </div>


                         <div class="w3-right">
                         <button type="submit" class="btn btn-primary">Save Stock</button></div><br><br>
                         <div class="w3-margin-bottom w3-col l12 w3-small w3-center" id="Updatestock_errnew_' . $Finished['status_message'][$i]['finished_product_id'] . '"></div><br><br><br>
                         </form>
                         </div> 
                         </div>
                         </div>
                         </div>

                         <script>
                         /* this script is used to update material info */
                         $(function(){
                           $("#Update_Finished_ProductForm_' . $Finished['status_message'][$i]['finished_product_id'] . '").submit(function(){
                             dataString = $("#Update_Finished_ProductForm_' . $Finished['status_message'][$i]['finished_product_id'] . '").serialize();
                             $.ajax({
                               type: "POST",
                               url: "' . base_url() . 'inventory/MaterialStock_Management/Update_Finishedproducts_Info",
                               data: dataString,
                               return: false,  
                               success: function(data)
                               {
                                $("#Updatestock_errnew_' . $Finished['status_message'][$i]['finished_product_id'] . '").html(data);
                                location.reload();
                              }
                            });
return false;  
});
});
/* update script ends here  */
</script>   

<script>   
/* this script is used to reload page when close modal*/
$("#myModal_' . $Finished['status_message'][$i]['finished_product_id'] . '").on("hidden.bs.modal", function () {
  location.reload();
});
/* this script is used to reload page when close modal*/
</script>


</td>
</tr>';
                                                    $count++;
                                                }
                                            } else {
                                                echo'<tr><td style="text-align: center;" colspan = "7">No Records Found...!</td></tr>';
                                            }
                                            ?>

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
                                    <h4 class="modal-title">Finished Product</h4>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="" id="Manage_FinishedProductForm" name="Manage_FinishedProductForm">

                                        <div class="row">
                                            <div class="col-lg-3 col-lg-offset-1">
                                                <label>Select Product:</label> 
                                            </div>
                                            <div class="col-lg-5 ">                   
                                                <select class="form-control" name="Select_PurchasedProduct_Id" id="Select_PurchasedProduct_Id" required> <!-- this is for showing material stocks quantity -->
                                                    <option>Select Product</option>
                                                    <?php foreach ($product as $result) { ?>
                                                        <option value='<?php echo $result['product_id']; ?>' ><?php echo $result['product_name']; ?></option>
                                                    <?php } ?>
                                                </select><br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-lg-offset-1">
                                                <label >ID:</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number" name="Input_Finished_Product_ID" id="Input_Finished_Product_ID" class="form-control" placeholder="product ID" step="0.01" required><br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-lg-offset-1">
                                                <label >OD:</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number" name="Input_Finished_Product_OD" id="Input_Finished_Product_OD" class="form-control" placeholder="product ID" step="0.01" required><br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-lg-offset-1">
                                                <label>Thickness:</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number" name="Input_Finished_Product_Thickness" id="Input_Finished_Product_Thickness" class="form-control" placeholder="product ID" step="0.01" required><br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-lg-offset-1">
                                                <label>Quantity:</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number" name="Input_Finished_Product_Quantity" id="Input_Finished_Product_Quantity" class="form-control" placeholder="product ID" step="0.01" required><br>
                                            </div>
                                        </div>


                                        <center>
                                            <button type="submit" class="btn btn-primary">Save Stock</button>
                                            <button type="reset" class="btn btn-default">Reset</button>
                                        </center>

                                        <br><br>
                                        <div class="w3-margin-bottom w3-col l12 w3-small" id="addFinishedproducts_err"></div><br><br><br>

                                    </form>
                                </div><!-- modal Body -->

                            </div>

                        </div>
                    </div>

                </div>
                <!-- ___________________________tab 3 div ends here__________________________________ -->

            </div><!-- tab containt ends here -->

        </div><!-- tab containt div ends here -->

    </div><!-- container for tab -->

</div>
<!--_______________________ div for main container____________________________ -->

<script>

    $('#checkPrice').on('change', function () {
        if (this.checked) {
            $('#fetched_price').show();
            $('#simple_price').hide();
            Select_Materials_Id = $("#Select_RawMaterials").val();
            Select_RawVendors_Id = $('#Select_RawVendors_Id').val();
            Input_RawMaterialStock_ID = $('#Input_RawMaterialStock_ID').val();
            Input_RawMaterialStock_OD = $('#Input_RawMaterialStock_OD').val();
            Input_RawMaterialLength = $('#Input_RawMaterialLength').val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/GetPriceFromPriceList",
                data: {
                    Select_Materials_Id: Select_Materials_Id,
                    Select_RawVendors_Id: Select_RawVendors_Id,
                    Input_RawMaterialStock_ID: Input_RawMaterialStock_ID,
                    Input_RawMaterialStock_OD: Input_RawMaterialStock_OD,
                    Input_RawMaterialLength: Input_RawMaterialLength
                },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $("#Input_RawMaterialPriceFrom_Pricelist").val(data);
                }
            });
        } else {
            $('#simple_price').show();
            $('#fetched_price').hide();
        }
    });
</script> 