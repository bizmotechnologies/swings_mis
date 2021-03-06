<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
$branch_name=$this->session->userdata('branch_name');

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
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/materialstock_management.js"></script>

</head>
<body class="w3-light-grey">
    <!-- !PAGE CONTENT! -->
    <div class="w3-main" style="margin-left:120px;">

        <!-- Header -->
        <header class="w3-container" >
            <h5><b><i class="fa fa-cubes"></i> Manage Stocks</b></h5>
        </header>

        <div id="exTab1" class="container w3-small" > <!-- container for tab -->
            <br>
            <ul  class="nav nav-tabs">
                <li class="active "><a class="w3-medium w3-button w3-red"  href="#RawMaterialStock" data-toggle="tab">Raw Material Stock</a></li>
                <li><a class="w3-medium w3-orange w3-button w3-text-white"  href="#PurchasedProducts" data-toggle="tab">Purchased Products Stock</a></li>
                <li><a class="w3-medium w3-brown w3-button"  href="#" data-toggle="tab">Finished Product Stock</a></li>
            </ul>

            <div class="tab-content clearfix "><br><!-- tab containt starts -->

                <div class="tab-pane active" id="RawMaterialStock">  <!-- tab for Raw material starts here -->

                    <div class="col-lg-12">
                        <label>Add new Material</label>
                    </div>
                    <div class="w3-col l12 w3-margin-top w3-small">
                        <hr>

                        <!-- add material form starts here----->
                        <form id="Add_material_form">
                            
                            <div class="w3-col l12">
                                
                            <div class="w3-col l4 w3-padding-bottom">
                                <label class="w3-label">Material Name:</label>
                                <input type="text" placeholder="Material Name" class="form-control" style="text-transform:uppercase;" id="material_nameForStock" name="material_nameForStock" required>
                            </div>
                            <div class="w3-col l3 w3-padding-bottom w3-padding-left">
                                <label class="w3-label">Material Color:</label>
                                <input type="text" autocomplete="off"  placeholder="Material Color" class="form-control" style="text-transform:uppercase;" id="materialColor_ForStock" name="materialColor_ForStock" required>
                            </div>
                                                              
                            </div>
                            <!--material category div-->
                            <div class="w3-col l12">
                                <div  class="w3-col l12 w3-margin-top w3-margin-bottom"><label> Material Category </label></div>
                                <div class="w3-col l1 w3-center">
                                    <label class="w3-label ">A</label>
                                    <input type="text" value="2.65" step="0.01" placeholder="material category" id="Category_a" name="Category_a" class="form-control" required>                                                            
                                </div>
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label">B</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_b" name="Category_b" class="form-control" required>                                                            
                                </div>
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label ">C</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_c" name="Category_c" class="form-control" required>                                                            
                                </div>
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label">D</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_d" name="Category_d" class="form-control" required>                                                            
                                </div>
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label">E</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_e" name="Category_e" class="form-control" required>                                                            
                                </div>                         
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label">F</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_f" name="Category_f" class="form-control" required>                                                            
                                </div>
                                <div class="w3-col l1 w3-center w3-padding-left">
                                    <label class="w3-label">G</label>
                                    <input type="text" autocomplete="off" value="2.65" step="0.01" placeholder="material category" id="Category_g" name="Category_g" class="form-control" required>                                                            
                                </div>

                                <div class="w3-col l1 w3-padding-top w3-padding-right w3-padding-left">
                                    <button class="btn w3-blue w3-margin-top" type="submit" id="Save_materialBtn" name="Save_materialBtn">Add Material</button>
                                </div> 
                                
                            </div>
                            <!--material category div-->

                        </form>                        <!-- add material form ends here----->

                                                
                        <div class="w3-col l12" id="addMaterial_err"></div>
                    </div><br><br>
                    <!--this div is for showing the delete material div -->
                    
                    <div class="w3-col l12">
                        <hr>
                        <div class="w3-col l12">
                            <label class="w3-left">Delete Material</label>
                        </div>
                        <div class="w3-col l3 w3-padding-bottom w3-left">
                            <div class="input-group w3-padding-top w3-margin-top">
                                <select class="form-control" name="Select_NewMaterials_Id" id="Select_NewMaterials_Id" required> <!-- this is for showing material stocks quantity -->
                                    <option>Select Material</option>
                                    <?php foreach ($materials['status_message'] as $result) { ?>
                                    <option value='<?php echo $result['material_id']; ?>' ><?php echo $result['material_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary w3-blue" type="button" title="Delete Material" onclick="Delete_material();"><i class="fa fa-trash"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!--this div is for showing the delete material div -->

                    <div class="w3-col l12" id="categoryDiv">
                        <form id="UpdateMaterialCategoryForm" name="UpdateMaterialCategoryForm">
                         <hr>
                         <div class="w3-col l12">
                             <label class="">Update Material Category</label>
                         </div>
                    <div class="w3-col l12 w3-margin-top">
                        <div class="w3-col l2">
                            <label class="w3-label">Material Name:</label> 
                            <input list="Materials" id="material_info" autocomplete="off" onclick="this.select();" name="material_info" value="<?php echo $cust_name; ?>" class="form-control" required type="text" placeholder="Select material" onchange="getMaterialId();showmaterialCategory();">  
                            <input type="hidden" name="material_id" id="material_id">                                      
                            <datalist id="Materials">
                                <?php foreach ($materials['status_message'] as $result) { ?>
                                    <option data-value="<?php echo $result['material_id']; ?>" value='<?php echo $result['material_name']; ?>'></option>
                                <?php } ?>
                            </datalist>
                        </div>                        
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label ">A</label>
                            <input type="text" value="" step="0.01" placeholder="material category" id="UpdateCategory_a" name="UpdateCategory_a" class="form-control" required>                                                            
                            </div>
                            <div class="w3-col l1  w3-center w3-padding-left">
                            <label class="w3-label">B</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_b" name="UpdateCategory_b" class="form-control" required>                                                            
                            </div>
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label ">C</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_c" name="UpdateCategory_c" class="form-control" required>                                                            
                            </div>
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label">D</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_d" name="UpdateCategory_d" class="form-control" required>                                                            
                            </div>
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label">E</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_e" name="UpdateCategory_e" class="form-control" required>                                                            
                            </div>                         
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label">F</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_f" name="UpdateCategory_f" class="form-control" required>                                                            
                            </div>
                            <div class="w3-col l1 w3-center w3-padding-left">
                            <label class="w3-label">G</label>
                            <input type="text" autocomplete="off" value="" step="0.01" placeholder="material category" id="UpdateCategory_g" name="UpdateCategory_g" class="form-control" required>                                                            
                            </div> 

                            <div class="w3-col l1 w3-padding-left w3-padding-top w3-margin-left">
                                <button class="btn w3-blue w3-margin-top" type="submit" id="Save_materialCategoryBtn" name="Save_materialCategoryBtn">Update Category</button>
                            </div> 
                        </div>
                    </form>
                </div>
                <div class="w3-col l12"id="categoryError"></div>
                <div class="w3-col l12"><!-- table container -->
                    <hr>

                    <div class="">

                        <div class=" w3-col l12"><!-- container starts here -->
                            <div class="w3-col l12"><label>Manage Raw Material</label></div><br>

                            <div class="w3-col l12 w3-margin-top">
                                <div class="w3-col l6 w3-left">
                                    <a class="btn btn-info" data-toggle="modal" data-target="#addRawMaterial_modal">Add Raw Material</a><br>
                                </div>
                                <div class="w3-col l6 ">
                                    <a class="btn btn-info w3-right" href="<?php echo base_url(); ?>inventory/materialConsumption">Add Consumed Material</a><br>
                                </div>

                            </div>
                        </div><br><!-- container ends here -->
                        <div class="w3-col l12 w3-margin-top">
                            <form id="MaterialFilter_Form" name="MaterialFilter_Form">
                                <div class="w3-col l4 ">
                                    <label class="w3-label">Filter by Material:</label>
                                    <div class="input-group">
                                        <input type="hidden" name="Material_idForMaterialFilter" id="Material_idForMaterialFilter">
                                        <input list="Material_Filter" id="Material_ForFilter" name="Material_ForFilter" class="form-control" placeholder="Materials..." onchange="getMaterialId_filter();">
                                        <datalist id="Material_Filter">
                                          <?php foreach ($materials['status_message'] as $result) { ?>
                                          <option data-value='<?php echo $result['material_id']; ?>' value='<?php echo $result['material_name']; ?>'></option>
                                          <?php } ?>
                                      </datalist>
                                      <span class="input-group-btn">
                                        <button class="btn btn-secondary w3-blue" name="MaterialFilter" id="MaterialFilter" type="submit" title="Filter Raw material stock"><i class="fa fa-filter"></i></button>
                                    </span>
                                </div>                      
                            </div> 
                            <!-- script to set material id when slected -->
                            <script>
                                function getMaterialId_filter(){
                                    material_id = $('#Material_Filter [value="' + $('#Material_ForFilter').val() + '"]').data('value');
                                    $('#Material_idForMaterialFilter').val(material_id);
                                }
                            </script>
                        </form>    
                    </div>
                    <div class="w3-col l12 w3-margin-top">
                        <div class="" id="ShowRaw_products" name="ShowRaw_products" style="max-height: 400px; overflow: scroll;">
                            <table class="table table-striped table-responsive w3-small"> 
                             <!-- table starts here -->
                             <thead>
                                <tr class="w3-black">
                                    <th class="text-center">SR. No</th>
                                    <th class="text-center">Material&nbsp;Name</th>  
                                    <th class="text-center">ID</th>              
                                    <th class="text-center">OD</th>              
                                    <th class="text-center">Available&nbsp;Length</th>              
                                    <th class="text-center">Tolerance</th>
                                    <th class="text-center">Price/Unit</th>
                                    <th class="text-center">Branch</th>
                                    <th class="text-center">Actions</th>  

                                </tr>
                            </thead>
                            <tbody ><!-- table body starts here -->
                                <?php
                                $count = 1;
                                if ($details['status'] == 1) {
                                    for ($i = 0; $i < count($details['status_message']); $i++) {
                                        echo '<tr class="text-center">
                                        <td class="text-center">' . $count . '.</td>
                                        <td class="text-center"><input type="text" name="Updated_MaterialStock_Materialname" id="Updated_MaterialStock_Materialname_'.$details['status_message'][$i]['rawmaterial_id'].'" class="form-control" value="' . $details['status_message'][$i]['material_name'] . '"></td>
                                        <td class="text-center">' . $details['status_message'][$i]['raw_ID'] . '</td>
                                        <td class="text-center">' . $details['status_message'][$i]['raw_OD'] . '</td>
                                        <td class="text-center"><input type="number" name="Updated_MaterialStock_Length" id="Updated_MaterialStock_Length_'.$details['status_message'][$i]['rawmaterial_id'].'" class="form-control" value="' . $details['status_message'][$i]['avail_length'] . '"></td>
                                        <td class="text-center">' . $details['status_message'][$i]['tolerance'] . '</td>
                                        <td class="text-center">' . $details['status_message'][$i]['material_price'] . ' <i class="fa fa-rupee"></i></td>
                                        <td class="text-center">' . $details['status_message'][$i]['branch_name'] . '</td>
                                        <td class="text-center"><a class="btn w3-text-blue w3-medium w3-padding-small" id="update_rawMaterial_'.$details['status_message'][$i]['rawmaterial_id'].'" onclick="update_rawMaterial('.$details['status_message'][$i]['rawmaterial_id'].')" title="Update Raw Material" style="padding:0"><i class="fa fa-edit"></i></a>
                                        <a class="btn w3-text-red w3-medium w3-padding-small" title="Delete Raw Material" id="delete_rawMaterial_'.$details['status_message'][$i]['rawmaterial_id'].'" onclick="delete_rawMaterial('.$details['status_message'][$i]['rawmaterial_id'].')" style="padding:0"><i class="fa fa-close"></i>
                                        </a> 
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
        <script>
            $(function(){
                $("#MaterialFilter_Form").submit(function(){
                  dataString = $("#MaterialFilter_Form").serialize();
                  
                  $.ajax({
                     type: "POST",
                     url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/FilterMaterialBy_Name",
                     data: dataString,
                    return: false,  //stop the actual form post !important!

                    success: function(data)
                    {    
                    $('#ShowRaw_products').html(data);        
                    }

                });
         return false;  //stop the actual form post !important!

       });
   });
 </script>                    
<script>
  function getMaterialId(){
    customer_id = $('#Materials [value="' + $('#material_info').val() + '"]').data('value');
    $('#material_id').val(customer_id);
  }
</script>
<script>
    //---this script is used to get the material category by material id--------------------//
function showmaterialCategory(){
    material_id = $('#Materials [value="' + $('#material_info').val() + '"]').data('value');
    //alert(material_id);
    $.ajax({
                type: "POST",
                url: BASE_URL+"inventory/MaterialStock_Management/showmaterialCategory",
                dataType:"json",
                data: {
                    material_id: material_id                 
                },
                cache: false,
                success: function (data) {
               
                $('#UpdateCategory_a').val(data['category_a']);    
                $('#UpdateCategory_b').val(data['category_b']);    
                $('#UpdateCategory_c').val(data['category_c']);    
                $('#UpdateCategory_d').val(data['category_d']);    
                $('#UpdateCategory_e').val(data['category_e']);    
                $('#UpdateCategory_f').val(data['category_f']);    
                $('#UpdateCategory_g').val(data['category_g']);    
              
            }
        }); //stop the actual form post !important! 
}
    //---this script is used to get the material category by material id--------------------//
</script>                 
       
    <script>
    /* this function is used for show total material stocks quantity*/
    $(function (){
        $("#UpdateMaterialCategoryForm").submit(function (){
         dataString = $("#UpdateMaterialCategoryForm").serialize();
        //alert(dataString);
        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/MaterialStock_Management/UpdateMaterialCategory",
            data: dataString,
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                $("#categoryError").html(data);
                $("#categoryDiv").load(location.href + " #categoryDiv>*", "");
            }
        });
        return false; //stop the actual form post !important! 
    });
    });
</script>
<!-- script to delete raw material stock -->
<script>
    function delete_rawMaterial(row_id)
    {
     $.confirm({
        title: '<label class="w3-large w3-text-red"><i class="fa fa-envelope"></i> Delete Stock Entry.</label>',
        content: '<span class="w3-medium">Do You really want to delete this stock entry ?</span>',
        buttons: {
            confirm: function () {
              $.ajax({
                type:'get',
                url:BASE_URL+'inventory/MaterialStock_Management/DeleteRawMaterialStockDetails?rawmaterial_id='+row_id,                                    
                success:function(response) {
                                      //$.alert(response);
                                      //location.reload();
                                      $("#ShowRaw_products").load(location.href + " #ShowRaw_products>*", "");
                                  }
                              });
          },
          cancel: function () {}
      }
  });
 }
</script>
<!-- script to delete raw material stock -->
<script>

</script>
<!-- script to update raw material stock -->
<script>
    function update_rawMaterial(row_id)
    {
        Material_name= $("#Updated_MaterialStock_Materialname_"+row_id).val();
        Material_length= $("#Updated_MaterialStock_Length_"+row_id).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>inventory/MaterialStock_Management/Update_UpdatedStockMaterial_Info",
            data: {
                Material_name: Material_name,
                Material_length: Material_length,
                Raw_materialId: row_id
            },
            return: false, 
            success: function (data)
            {
                $.alert(data);  
                $("#ShowRaw_products").load(location.href + " #ShowRaw_products>*", "");
            }
        });
    }
</script>
<!-- script to edit raw material stock -->

<!-- Modal -->
<div id="addRawMaterial_modal" class="modal fade" role="dialog"><!-- modal starts here for add Raw  materials stocks -->
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content w3-col l12">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="w3-xlarge w3-center">Add Raw Materials</div>
            </div>
            <div class="modal-body w3-small ">
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
                                <input type="number" name="Input_RawMaterialNewQuantity" id="Input_RawMaterialNewQuantity" class="form-control" placeholder="Material Quantity" min="0" required><br>
                            </div>      
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="padding-left">Tolerance:</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="number" name="Input_RawMaterialTolerance" id="Input_RawMaterialTolerance" class="form-control" placeholder="Material Tolerance" step="0.01" required><br>
                            </div>      
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <input type="checkbox" name="checkPrice" id="checkPrice" value=""> Fetch Price From Price list<br>
                            </div>
                        </div><br>

                        <div class="row" >
                            <div id="simple_price">
                                <div class="col-lg-3">
                                    <label class="padding-left">Price:</label>
                                </div>
                                <div class="col-lg-3" >
                                    <input type="number" name="Input_RawMaterialPrice" id="Input_RawMaterialPrice" class="form-control" placeholder="Price" step="0.01" ><br>
                                </div>
                            </div>
                            <div id="fetched_price" style="display:none">
                                <div class="col-lg-3">
                                    <label class="padding-left">Fetched&nbsp;Price:</label>
                                </div>
                                <div class="col-lg-3" > 
                                    <input type="number" name="Input_RawMaterialPriceFrom_Pricelist" id="Input_RawMaterialPriceFrom_Pricelist" class="form-control" placeholder="Price" step="0.01" ><br>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control" name="Input_RawMaterialCurrency" id="Input_RawMaterialCurrency" required onchange="priceconversion();">                   
                                    <option value="INR">INR</option>
                                    <option value="EURO">EURO</option>
                                </select>
                            </div>
                        </div>                                     
                        <center>
                            <button type="submit" class="btn btn-primary">Save Stock</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </center>
                        <div class="w3-margin-bottom w3-col l12 w3-small" id="addProducts_err"></div><br>
                    </div>
                </form><!-- form ends here -->
            </div>
        </div>
    </div>
</div>
</div><!-- modal ends here -->

            <!--  Script to reload page when add feature modal closes............................
            --> 
            <script>
              $('#addRawMaterial_modal').on('hidden.bs.modal', function () {
                location.reload();
            });
        </script>
        <!-- script end -->
        <!--____________________________________ tab div 1 ends here_________________________________________ -->

         <!--_______________________________ tab 3 starts here_____________________________________________ -->

<div class="tab-pane" id="PurchasedProducts"><!-- tab 3 starts here -->
    <div class="w3-row-padding w3-margin-bottom ">
      <div class="w3-col l12 w3-light-grey">        
        <div class="w3-padding">
          <div class="w3-col l12 w3-white w3-round w3-margin-bottom w3-padding w3-small">
            <form id="finishedGoods_form" method="POST" action="" name="finishedGoods_form">       
             <div class="w3-col l12 w3-margin-top">
                <div class="row">
                    <div class="w3-col l4">
                        <div class="w3-padding-left w3-padding-bottom">
                          <label class="w3-label">Material</label>
                          <input type="text" placeholder="Enter Material" class="form-control" id="Fmaterial" name="Fmaterial" onclick="this.select();">
                        </div>
                    </div>
                </div>
             </div>
             <div class="w3-col l12 w3-margin-top">
                <div class="row">
                    <div class="w3-col l9 w3-padding-left">
                      <div class="row">
                        <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                          <label class="w3-label">Inner Dimensions(ID)</label>
                          <input type="number" placeholder="Enter ID" class="form-control" id="Id" name="Id" onclick="this.select();">
                        </div>
                        <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                          <label class="w3-label">Outer Dimension(OD)</label>
                          <input type="number" placeholder="Enter OD" class="form-control" id="Od" name="Od" onclick="this.select();">
                        </div>
                        <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                          <label class="w3-label">Lenght</label>
                          <input type="number" placeholder="Enter Length" class="form-control" id="Lenght" name="Lenght" onclick="this.select();">
                        </div>
                     </div>
                  </div>
                </div>
             </div>
             <div class="w3-col l12 w3-margin-top">
                <div class="row">
                  <div class="w3-col l12 w3-padding-left">
                    <div class="row">
                        <div class="w3-col l2 w3-padding-left w3-padding-bottom">
                            <label class="w3-label">Price</label>
                            <input type="number" placeholder="Enter Price" class="form-control" id="Price" name="Price" onclick="this.select();">
                        </div>
                        <div class="w3-col l2 w3-padding-left w3-padding-bottom">
                            <label class="w3-label">Discount In Percentage</label>
                            <input type="number" placeholder="Enter Discount" class="form-control" onclick="this.select();" id="Discount" name="Discount">
                        </div>
                        <div class="w3-col l2 w3-padding-left w3-padding-bottom">
                            <label class="w3-label">Margin In Percentage</label>
                            <input type="number" placeholder="Enter Margin" class="form-control" onclick="this.select();" id="Margin" name="Margin">
                        </div>
                        <div class="w3-col l2 w3-padding-left w3-padding-bottom">
                            <label class="w3-label">Cost Price</label>
                            <input type="number" placeholder="Enter Cost Price" class="form-control" onclick="this.select();" id="CostPrice" name="CostPrice">
                        </div>
                     </div>
                  </div>
                </div>
             </div>
             <div class="w3-col l12 w3-margin-top">
                <div class="row">
                  <div class="w3-col l12 w3-padding-left">
                    <div class="row">
                        <div class="w3-col l3 w3-padding-bottom w3-padding-left">
                            <label class="w3-label">Quotation</label>
                            <select id="Select_Quotation" class="form-control" onclick="this.select();" name="Select_Quotation" value="" class="w3-input" required type="text" placeholder="Enter Quotation">
                                <?php
                                 foreach ($quotation['status_message'][0] as $result) { ?>
                                      <option value='<?php echo $result['quotation_id']; ?>' >#QUO-0<?php echo $result['quotation_id']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-col l3 w3-padding-bottom w3-padding-left">
                            <label class="w3-label">Vendor</label>
                            <select id="Select_Vendor" class="form-control" onclick="this.select();" name="Select_Vendor" value="" class="w3-input" required type="text" placeholder="Enter Vendor">
                                <?php foreach ($vendors as $result) { ?>
                                      <option value='<?php echo $result['vendor_id']; ?>' ><?php echo $result['vendor_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="w3-col l2 w3-padding-left w3-padding-bottom">
                            <label class="w3-label">Quantity</label>
                            <input type="number" placeholder="Enter Quantity" class="form-control" id="Quantity" name="Quantity" onclick="this.select();">
                        </div>
                     </div>
                  </div>
                </div>
             </div>
             <div class="w3-col l12 w3-margin-top">
                <div class="row">
                    <div class="w3-left w3-padding-left">
                        <button id="SaveGoodInfo" name="SaveGoodInfo" type="submit" class="btn btn-info" onclick="">Add</button><br>
                    </div>
                </div>
                <div class="w3-margin-bottom w3-col l12 w3-small" id="addfinishedgood_err"></div>
             </div>
            </div>
           </div>
          </form>
        </div>
        <div class="w3-col l12 w3-margin-top">
          <div class="" id="ShowFinishedGoods" name="ShowFinishedGoods" style="max-height: 400px; overflow: scroll;">
            <table class="table table-striped table-responsive w3-small"> 
               <!-- table starts here -->
               <thead>
                <tr class="w3-black">
                   <th class="text-center">Material</th>  
                   <th class="text-center">ID</th>              
                   <th class="text-center">OD</th>              
                   <th class="text-center">Length</th>              
                   <th class="text-center">Price</th>
                   <th class="text-center">Discount In Percentage</th>
                   <th class="text-center">Margin In Percentage</th>
                   <th class="text-center">Cost Price</th>
                   <th class="text-center">Quotation</th>
                   <th class="text-center">Vendor</th>
                   <th class="text-center">Quantity</th>        
                </tr>
                </thead>
                <tbody><!-- table body starts here --> 
                <?php
                    if($Fg_info['status']==1)
                    {
                      foreach($Fg_info['status_message'] as $finish)
                      {
                  ?>      
                    <tr class="text-center">
                        <td class="text-center"><?php echo $finish['material_name'];?></td>
                        <td class="text-center"><?php echo $finish['id'];?></td>
                        <td class="text-center"><?php echo $finish['od'];?></td>
                        <td class="text-center"><?php echo $finish['length'];?></td>
                        <td class="text-center"><?php echo $finish['price'];?></td>
                        <td class="text-center"><?php echo $finish['discount_percentage'];?></td>
                        <td class="text-center"><?php echo $finish['margin_percentage'];?></td>
                        <td class="text-center"><?php echo $finish['cost_price'];?></td>
                        <td class="text-center">#QUO-0<?php echo $finish['quotation'];?></td>
                        <td class="text-center"><?php echo $finish['vendor_name'];?></td>
                        <td class="text-center"><?php echo $finish['quantity'];?></td>
                    </tr>
                   <?php
                    }
                  }
                    else{
                        echo $Fg_info['status_message'];
                   }
                ?>
            </tbody><!-- table body close here -->
           </table>   <!-- table closed here -->
          </div>
        </div>
      </div>     
    </div>
<!--  </div>
</div>-->
<!-- ___________________________tab 2 div ends here__________________________________ -->

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
<script>
//----this fun is used to add raw material details information---------------------//
$(function () {
    $("#Manage_RawMaterialForm").submit(function () {
        dataString = $("#Manage_RawMaterialForm").serialize();
    //alert(dataString);
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/MaterialStock_Management/Save_RawStockMaterial_Info",
        data: dataString,
        return: false, //stop the actual form post !important!
        success: function (data)
        {
            //alert(data);
            $("#addProducts_err").html(data);
        }
    });
    return false; //stop the actual form post !important!
});
});
//this fun is used to add raw material ends here----------------------------------//
</script>
<!-- <script>
function priceconversion(){
Input_RawMaterialCurrency = $("#Input_RawMaterialCurrency").val();
checkPrice = document.getElementById("checkPrice");
if(checkPrice.checked = true){
    
}
$.ajax({
        type: "POST",
        url: BASE_URL + "inventory/MaterialStock_Management/Save_RawStockMaterial_Info",
        Input_RawMaterialCurrency: Input_RawMaterialCurrency,
        
        return: false, //stop the actual form post !important!
        success: function (data)
        {
            //alert(data);
            $("#addProducts_err").html(data);
        }
    });
}
</script> -->