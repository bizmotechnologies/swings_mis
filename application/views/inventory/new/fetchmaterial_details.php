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
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/fetchmaterial_Details.js"></script>

    </head>
    <body class="w3-light-grey">
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">
<?php print_r(json_decode($multiple_divs,true)); ?>
            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-cubes"></i> Manage Enquiry</b></h5>
            </header>
            <div class="col-lg-12"><label>Add New Enquiry</label>
            </div>
            <form method="POST" action="<?php echo base_url();?>inventory/Manage_materials/fetchmaterial_details" id="Manage_EnquiryForm" name="Manage_EnquiryForm">

                <div class="w3-col l12 w3-margin-top w3-small">
                    <div class="w3-col l12 w3-padding">

                        <div class="w3-col l3 w3-left">
                            <div class="input-group w3-padding-top">
                                <label>Customer Name:</label> 
                                <input list="Customers" id="Select_Customers" name="Select_Customers" class="form-control" required type="text" placeholder="Customer Name">                                         
                                <datalist id="Customers">
                                    <?php foreach ($customers['status_message'] as $result) { ?>
                                        <option data-value="<?php echo $result['cust_id']; ?>" value='<?php echo $result['customer_name']; ?>'></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>

                    </div>

                    <div>
                        <div class="w3-col l12 w3-padding">

                            <hr>
                            <div class="w3-col l3 w3-left">
                                <div class="input-group">
                                    <label>Product Name:</label>
                                    <input type="text" placeholder="Product Name" class="form-control" style="text-transform:uppercase;" id="product_nameForEnquiry_1" name="product_nameForEnquiry[]" required>
                                </div>
                            </div>

                        </div>

                        <div class="w3-col l12 w3-padding">
                            <hr>
                            <div class="w3-col l3 w3-left">
                                <div class="input-group">
                                    <label>Profile Name:</label> 
                                    <input list="Profiles_1" id="Select_Profiles_1" name="Select_Profiles[]" class="form-control" required type="text" placeholder="Select Profile Name">                                         
                                    <datalist id="Profiles_1">
                                        <?php foreach ($profiles['status_message'] as $result) { ?>
                                            <option data-value="<?php echo $result['profile_id']; ?>" value='<?php echo $result['profile_name']; ?>'></option>
                                        <?php } ?>
                                    </datalist>
                                </div>
                            </div>

                        </div>

                        <div class="w3-col l12 w3-light-grey w3-padding"><!-- this div is used to show housing div-->

                            <div class="w3-col l10 w3-left">
                                <div class="input-group ">
                                    <input type="checkbox" name="checkHousing[]" id="checkHousing_1" value=""><b>  Housing(Seal&nbsp;kit&nbsp;for&nbsp;Hydraulic&nbsp;70&nbsp;MM,&nbsp;Rod&nbsp;50&nbsp;MM&nbsp;–&nbsp;15&nbsp;Sets.)</b>
                                </div>
                            </div>

                        </div><!-- this div is used to show housing div-->

                        <div class="w3-light-grey" id="housing_statusforChecked_1"> <!--this div is used to show the div of housing value for housing is not checked-->
                            <div class="w3-col l12 w3-padding">

                                <div class="w3-col l6">
                                    <label>Profile Description:</label>
                                    <input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked_1" name="profile_DescriptionForHousingUnchecked[]" required></div>
                            </div>

                            <div class="w3-col l12 w3-padding">

                                <div class="w3-col l4 s4">
                                    <div class="input-group">
                                        <label>ID:</label>
                                        <input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked_1" name="ID_forHousingUnckecked[]" required>
                                    </div>
                                </div>
                                <div class="w3-col l4 s4 w3-padding-left">
                                    <div class="input-group">
                                        <label>OD:</label>
                                        <input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked_1" name="OD_forHousingUnckecked[]" required>
                                    </div>
                                </div>
                                <div class="w3-col l4 s4 w3-padding-left">
                                    <div class="input-group">
                                        <label>LENGTH:</label>
                                        <input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_1" name="LENGTH_forHousingUnckecked[]" required>
                                    </div>
                                </div>

                            </div>

                        </div>  <!--this div is used to show the div of housing value for housing is not checked ends here-->
                        <div class="w3-col l12" id="addMaterial_err"></div>
                        <br>

                        <hr>

                        <div class="w3-col l12 w3-tiny w3-padding w3-border-top w3-margin-top w3-margin-bottom"><!-- this div for material information and calculations-->

                            <div class="w3-col l2">
                                <label >MATERIAL</label> 
                                <input list="Materialinfo_1" id="Select_material_1" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(1);">                                         
                                <datalist id="Materialinfo_1">
                                    <?php foreach ($info['status_message'] as $result) { ?>
                                        <option data-value="<?php echo $result['material_id']; ?>" value='<?php echo $result['material_name']; ?>'><?php echo $result['material_name']; ?></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                            <div class="w3-col l3">
                                <div class="w3-col l4 s4 w3-padding-left">
                                    <label>ID</label> 
                                    <input list="MaterialID_1" id="Select_ID_1" name="Select_ID[]" class="form-control" required type="text" min="0" placeholder="ID" >                                         
                                    <datalist id="MaterialID_1">
                                    </datalist>
                                </div>
                                <div class="w3-col l4 s4 w3-padding-left">
                                    <label>OD</label> 
                                    <input list="MaterialOD_1" id="Select_OD_1" name="Select_OD[]" class="form-control" required type="text" min="0" placeholder="OD" >                                         
                                    <datalist id="MaterialOD_1">
                                    </datalist>
                                </div>
                                <div class="w3-col l4 s4 w3-padding-left">
                                    <label>LENGTH</label> 
                                    <input list="MaterialLength_1" id="Select_Length_1" name="Select_Length[]" class="form-control" required type="text" min="0" placeholder="Length" >                                         
                                    <datalist id="MaterialLength_1">
                                    </datalist>
                                </div>
                            </div>

                            <div class="w3-col l1 w3-padding-left">
                                <label>BASE PRICE</label> 
                                <input id="base_Price_1" name="base_Price[]" class="form-control" min="0" step="0.01" required type="number" placeholder="Base Price"  onfocus="GetMaterialBasePrice(1);">                                         
                            </div>

                            <div class="w3-col l1 w3-padding-left">
                                <label>QUANTITY</label> 
                                <input id="select_Quantity_1" name="select_Quantity[]" class="form-control" min="0" required type="number" placeholder="Quantity" onkeypress="GetFinalPriceForMaterialCalculation(1);">                                         
                            </div>

                            <div class="w3-col l1 w3-padding-left">
                                <label>DISCOUNT(%)</label> 
                                <input id="discount_1" name="discount[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Discount %." onkeypress="GetFinalPriceForMaterialCalculation(1);">                                         
                            </div>

                            <div class="w3-col l1 w3-padding-left">
                                <label>FINAL&nbsp;PRICE</label> 
                                <input id="final_Price_1" name="final_Price[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Final Price" onfocus="GetFinalPriceForMaterialCalculation(1);">                                         
                            </div>
                            <div class="w3-col l3 w3-margin-top">
                                <span><a  id="add_row_1" class="btn add-more w3-text-blue w3-right">+Add More Material</a></span>
                            </div>
                        </div><br><br>

                        <div class="w3-col l12">
                            <div id="added_row_1" class="w3-small w3-col l12"></div>
                        </div>

                        <div class="w3-col l12 w3-small w3-margin-top w3-margin-bottom">

                            <div class="w3-col l4 w3-padding-left">
                                <label>QUANTITY</label> 
                                <input id="Product_Quantity_1" name="Product_Quantity[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity">                                         
                            </div>
                            <div class="w3-col l4 w3-padding-left">
                                <label>Total Product Price</label> 
                                <input id="TotalProduct_Price_1" name="TotalProduct_Price[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity">                                         
                            </div>
                            <div class="w3-col l4 w3-padding-left">
                                <a id="add_product_1" title="Click Add Product To Enquiry" class="btn add-more w3-text-blue w3-margin-right w3-right ">+Add More Product</a>
                            </div> 

                        </div>

                    </div><!--this div is for product div-->

                </div><!-- main div closed here-->
                <div class="w3-col l12 ">
                    <div id="ADD_Product_1" class="w3-small w3-col l12"></div>
                </div>
                <div class="w3-right w3-margin-right">
                    <button type="submit" class="btn btn-info">Add Product</button>
                </div><br>
            </form><br><br><br>
            <!-- Modal -->
            <div id="myModalnew" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="modal-title" id="msg_header"></div>
                        </div>
                        <div class="modal-body">
                            <div id="addMaterials_err" name="addMaterials_err"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>




            <script>
                $(document).ready(function () {
                    var max_fields = 15;
                    var x = 1;
                    var wrapper = $("#added_row_" + x);
                    var add_button = $("#add_row_" + x);
                    $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                            x++;
                            $(wrapper).append('<div class="w3-margin-bottom w3-col l12 w3-tiny w3-padding-left">\n\
        <div class="w3-col l2">\n\
        <label>MATERIAL</label>\n\
        <input list="Materialinfo_' + x + '" id="Select_material_' + x + '" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(' + x + ');">\n\
        <datalist id="Materialinfo_' + x + '">\n\
<?php foreach ($info['status_message'] as $result) { ?><option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option><?php } ?></datalist>\n\
        </div>\n\
        <div class="w3-col l3">\n\
        <div class="w3-col l4 s4 w3-padding-left">\n\
        <label>ID</label>\n\
        <input list="MaterialID_' + x + '" id="Select_ID_' + x + '" name="Select_ID[]" class="form-control" required type="text" placeholder="ID">\n\
        <datalist id="MaterialID_' + x + '">\n\
        </datalist>\n\
        </div>\n\
        <div class="w3-col l4 s4 w3-padding-left">\n\
        <label >OD</label>\n\
        <input list="MaterialOD_' + x + '" id="Select_OD_' + x + '" name="Select_OD[]" class="form-control" required type="text" placeholder="OD">\n\
        <datalist id="MaterialOD_' + x + '">\n\
        </datalist>\n\
        </div>\n\
        <div class="w3-col l4 s4 w3-padding-left">\n\
        <label>LENGTH</label>\n\
        <input list="MaterialLength_' + x + '" id="Select_Length_' + x + '" name="Select_Length[]" class="form-control" required type="text" placeholder="Length">\n\
        <datalist id="MaterialLength_' + x + '">\n\
        </datalist>\n\
        </div>\n\
        </div>\n\
        <div class="w3-col l1 w3-padding-left">\n\
        <label>BASE PRICE</label>\n\
        <input id="base_Price_' + x + '" name="base_Price[]" class="form-control" min="0" required type="number" placeholder="Base Price" onfocus="GetMaterialBasePrice('+x+');"></div>\n\
        <div class="w3-col l1 w3-padding-left">\n\
        <label>QUANTITY</label>\n\
        <input id="select_Quantity_' + x + '" name="select_Quantity[]" class="form-control" min="0" required type="number" placeholder="Quantity" onkeypress="GetFinalPriceForMaterialCalculation('+x+');">\n\
        </div>\n\
        <div class="w3-col l1 w3-padding-left">\n\
        <label>DISCOUNT</label>\n\
        <input id="discount_' + x + '" name="discount[]" class="form-control" required min="0" type="number" placeholder="Discount" onkeypress="GetFinalPriceForMaterialCalculation('+x+');">\n\
        </div>\n\
        <div class="w3-col l1 w3-padding-left">\n\
        <label>FINAL&nbsp;PRICE</label>\n\
        <input id="final_Price_' + x + '" name="final_Price[]" class="form-control" min="0" required type="number" placeholder="Final Price" onfocus="GetFinalPriceForMaterialCalculation('+x+');">\n\
        </div>\n\
        <a href="#" class="delete w3-text-grey w3-margin-left w3-left fa fa-remove" title="Delete field"></a>\n\
        </div>'); //add input box

                        } else
                        {
                            alert(' You Reached the maximum limit of adding 15 fields.'); //alert when added more than 4 input fields
                        }
                    });
                    $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    });
                }
                );
            </script>

            <!-- this script is used for showing add more rows functionality ends here -->
<!--            <script>
                $(document).ready(function () {
                    var max_fields = 5;
                    var x = 1;
                    var wrapper = $("#ADD_Product_" + x);
                    var add_button = $("#add_product_" + x);
                    $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                            x++;
                            $(wrapper).append('<div><div class="w3-col l12 w3-padding"><hr><div class="w3-col l3 w3-left"><div class="input-group"><label>Product Name:</label><input type="text" placeholder="Product Name" class="form-control" style="text-transform:uppercase;" id="product_nameForEnquiry_' + x + '" name="product_nameForEnquiry[]" required></div></div></div><div class="w3-col l12 w3-padding"><hr><div class="w3-col l3 w3-left"><div class="input-group"><label>Profile Name:</label><input list="Profiles_' + x + '" id="Select_Profiles_' + x + '" name="Select_Profiles[]" class="form-control" required type="text" placeholder="Select Profile Name"><datalist id="Profiles_' + x + '"><?php foreach ($profiles['status_message'] as $result) { ?><option data-value="<?php echo $result['profile_id']; ?>" value="<?php echo $result['profile_name']; ?>"></option><?php } ?></datalist></div></div></div><div class="w3-col l12 w3-light-grey w3-padding"><div class="w3-col l10 w3-left"><div class="input-group "><input type="checkbox" name="checkHousing[]" id="checkHousing_' + x + '" value=""><b>  Housing(Seal&nbsp;kit&nbsp;for&nbsp;Hydraulic&nbsp;70&nbsp;MM,&nbsp;Rod&nbsp;50&nbsp;MM&nbsp;–&nbsp;15&nbsp;Sets.)</b></div></div></div><div class="w3-light-grey" id="housing_statusforChecked_' + x + '"><div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profie_DescriptionForHousingUnchecked_' + x + '" name="profie_DescriptionForHousingUnchecked[]" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l4 s4"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked_' + x + '" name="ID_forHousingUnckecked[]" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked_' + x + '" name="OD_forHousingUnckecked[]" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_' + x + '" name="LENGTH_forHousingUnckecked[]" required></div></div></div></div><div class="w3-col l12" id="addMaterial_err"></div><br><hr><div class="w3-col l12 w3-tiny w3-padding w3-border-top w3-margin-top w3-margin-bottom"><div class="w3-col l2"><label >MATERIAL</label><input list="Materialinfo_' + x + '" id="Select_material_' + x + '" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(' + x + ');"><datalist id="Materialinfo_' + x + '"><?php foreach ($info['status_message'] as $result) { ?><option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option><?php } ?></datalist></div><div class="w3-col l3"><div class="w3-col l4 s4 w3-padding-left"><label>ID</label><input list="MaterialID_' + x + '" id="Select_ID_' + x + '" name="Select_ID[]" class="form-control" required type="text" min="0" placeholder="ID" ><datalist id="MaterialID_' + x + '"></datalist></div><div class="w3-col l4 s4 w3-padding-left"><label>OD</label><input list="MaterialOD_' + x + '" id="Select_OD_' + x + '" name="Select_OD[]" class="form-control" required type="text" min="0" placeholder="OD" ><datalist id="MaterialOD_' + x + '"></datalist></div><div class="w3-col l4 s4 w3-padding-left"><label>LENGTH</label><input list="MaterialLength_' + x + '" id="Select_Length_' + x + '" name="Select_Length[]" class="form-control" required type="text" min="0" placeholder="Length" ><datalist id="MaterialLength_' + x + '"></datalist></div></div><div class="w3-col l1 w3-padding-left"><label>BASE PRICE</label> <input id="base_Price_' + x + '" name="base_Price[]" class="form-control" min="0" step="0.01" required type="number" placeholder="Base Price"  onfocus="GetMaterialBasePrice(' + x + ');"></div><div class="w3-col l1 w3-padding-left"><label>QUANTITY</label><input id="select_Quantity_' + x + '" name="select_Quantity[]" class="form-control" min="0" required type="number" placeholder="Quantity" onkeypress="GetFinalPriceForMaterialCalculation(' + x + ');"></div><div class="w3-col l1 w3-padding-left"><label>DISCOUNT(%)</label><input id="discount_' + x + '" name="discount[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Discount %." onkeypress="GetFinalPriceForMaterialCalculation(' + x + ');"></div><div class="w3-col l1 w3-padding-left"><label>FINAL&nbsp;PRICE</label><input id="final_Price_' + x + '" name="final_Price[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Final Price" onfocus="GetFinalPriceForMaterialCalculation(' + x + ');"></div><div class="w3-col l3 w3-margin-top"><span><a  id="add_row_' + x + '" class="btn add-more w3-text-blue w3-right">+Add More Material</a></span></div></div><br><br><div class="w3-col l12"><div id="added_row_' + x + '" class="w3-small w3-col l12"></div></div><div class="w3-col l12 w3-small w3-margin-top w3-margin-bottom"><div class="w3-col l4 w3-padding-left"><label>QUANTITY</label><input id="Product_Quantity_' + x + '" name="Product_Quantity[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity" onfocus="GetFinalPriceForMaterialCalculation(' + x + ');"></div><div class="w3-col l4 w3-padding-left"><label>Total Product Price</label><input id="TotalProduct_Price_' + x + '" name="TotalProduct_Price[]" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity" onfocus="GetFinalPriceForMaterialCalculation(' + x + ');"></div><div class="w3-col l4 w3-padding-left"><a id="add_product_' + x + '" title="Click Add Product To Enquiry" class="w3-margin btn w3-text-blue w3-right">+Add More Product</a></div></div></div>'); //add input box

                        } else
                        {
                            alert(' You Reached the maximum limit of adding 15 fields.'); //alert when added more than 4 input fields
                        }
                    });
                    $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    });
                }
                );
            </script>-->
