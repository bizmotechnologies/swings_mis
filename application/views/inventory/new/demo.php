<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raise Enquiry</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/fetchmaterial_Details.js"></script>
    <script>
        var currparent = 1;
        var currchild = 1;
            function getChildDivHtml(id) {// this code is used for add div to parent div on click fun
                return '<div class="w3-col l12 w3-padding-left" id="Product_' + currparent + '">\n\
                <div class="w3-col l12 w3-padding-left w3-light-grey">Product_' + currparent + '</div>\n\
                <div class="w3-col l12 w3-padding w3-small">\n\
                \n\
                <div class="w3-col l3 w3-left">\n\
                <div class="input-group">\n\
                <label>Product Name:</label>\n\
                <input type="text" placeholder="Product Name" value="" class="form-control" style="text-transform:uppercase;" id="product_nameForEnquiry_' + currparent + '" name="product_nameForEnquiry[]" required>\n\
                </div>\n\
                </div>\n\
                \n\
                </div>\n\
                \n\<div class="w3-col l12 w3-padding w3-small">\n\
                <hr>\n\
                <div class="w3-col l3 w3-left">\n\
                <div class="input-group">\n\
                <label>Profile Name:</label>\n\
                <input list="Profiles_' + currparent + '" id="Select_Profiles_' + currparent + '" name="Select_Profiles[]" value="<?php echo $div['profile_id']; ?>" class="form-control" required type="text" placeholder="Select Profile Name" onchange="GetProfileInformation(' + currparent + ');">\n\
                <datalist id="Profiles_' + currparent + '">\n\
                <?php foreach ($profileinfo['status_message'] as $result) { ?><option data-value="<?php echo $result['profile_id']; ?>" value="<?php echo $result['profile_name']; ?>"></option><?php } ?></datalist>\n\
                </div>\n\
                </div>\n\
                </div>\n\
                \n\
                <div class="w3-col l12 w3-light-grey w3-padding w3-small">\n\
                \n\
                <div class="w3-col l10 w3-left">\n\
                <div class="input-group ">\n\
                <input type="checkbox" id="checkHousing_' + currparent + '" onclick="GetHousingValue(' + currparent + ');"><b>  Housing(EX. Seal&nbsp;kit&nbsp;for&nbsp;Hydraulic&nbsp;70&nbsp;MM,&nbsp;Rod&nbsp;50&nbsp;MM&nbsp;–&nbsp;15&nbsp;Sets.)</b>\n\
                </div>\n\
                </div>\n\
                </div>\n\
                \n\
                <div class="w3-light-grey" id="housing_statusforChecked_' + currparent + '">\n\
                \n\
                <div class="w3-col l12 w3-padding w3-small">\n\
                <div class="w3-col l6">\n\
                <label>Profile Description:</label>\n\
                <input type="text" value="" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked_' + currparent + '" name="profile_DescriptionForHousingUnchecked[]" required>\n\
                </div>\n\
                </div>\n\
                <div class="w3-col l12 w3-padding w3-small">\n\
                \n\
                <div class="w3-col l4 s4">\n\
                <div class="input-group">\n\
                <label>ID:</label>\n\
                <input type="number" placeholder="ID" min="0" class="form-control" value="" style="text-transform:uppercase;" id="ID_forHousingUnckecked_' + currparent + '" name="ID_forHousingUnckecked[]" required>\n\
                </div>\n\
                </div>\n\
                \n\
                <div class="w3-col l4 s4 w3-padding-left">\n\
                <div class="input-group">\n\
                <label>OD:</label>\n\
                <input type="number" placeholder="OD" min="0" class="form-control" value="" style="text-transform:uppercase;" id="OD_forHousingUnckecked_' + currparent + '" name="OD_forHousingUnckecked[]" required>\n\
                </div>\n\
                </div>\n\
                \n\
                <div class="w3-col l4 s4 w3-padding-left">\n\
                <div class="input-group">\n\
                <label>LENGTH:</label>\n\
                <input type="number" placeholder="LENGTH" min="0" class="form-control" value="" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_' + currparent + '" name="LENGTH_forHousingUnckecked[]" required>\n\
                </div>\n\
                </div>\n\
                \n\
                </div>\n\
                </div>\n\
                \n\<div class="w3-col l12 w3-padding-left w3-margin-top w3-margin-bottom" id="MaterialDiv_' + currparent + '">\n\
                </div>\n\
                </div>\n\
                <div class="w3-col l12 w3-padding-left w3-margin-top w3-margin-bottom w3-small">\n\
                <div class="w3-col l4 w3-padding-left">\n\
                <label>QUANTITY</label>\n\
                <input id="Product_Quantity_1" name="Product_Quantity[]" value="<?php echo $div['product_quantity']; ?>" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity">\n\
                </div>\n\
                <div class="w3-col l4 w3-padding-left">\n\
                <label>Total Product Price</label>\n\
                <input id="TotalProduct_Price_1" name="TotalProduct_Price[]" value="<?php echo $div['product_price']; ?>" class="form-control" required type="number" min="0" step="0.01" placeholder="Product Quantity">\n\
                </div>\n\
</div>';// this code is used for add div to parent div on click fun
}
            $(document).ready(function () {// this fun is used for add above code to parent div on click fun
                $('#btn-add-product').on('click', function () {
                    $('div#parent').append(getChildDivHtml(currparent));
                    currparent++;
                });// this fun is used for add above code to parent div on click fun

                $('div#parent').on('click', '.btn-add-siblings', function () {// this fun is used for add materials to parent div on click fun
                    $(this).parent().append('<div class="w3-col l12 w3-tiny w3-margin-top">\n\
                        <div class="w3-col l2 ">\n\
                        <label >MATERIAL</label>\n\
                        <input list="Materialinfo_' + currchild + '" value="<?php echo $material_id; ?>" id="Select_material_' + currchild + '" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(' + currchild + ');">\n\
                        <datalist id="Materialinfo_' + currchild + '">\n\
                        <?php foreach ($materials['status_message'] as $result) { ?><option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option><?php } ?></datalist>\n\
                        \n\</div>\n\
                        <div class="w3-col l3">\n\
                        \n\<div class="w3-col l4 s4 w3-padding-left">\n\
                        <label>ID</label>\n\
                        <input list="MaterialID_' + currchild + '" value="<?php echo $Select_ID; ?>" id="Select_ID_' + currchild + '" name="Select_ID[]" class="form-control" required type="text" min="0" placeholder="ID" >\n\
                        <datalist id="MaterialID_' + currchild + '"></datalist>\n\
                        </div>\n\
                        <div class="w3-col l4 s4 w3-padding-left">\n\
                        <label>OD</label>\n\
                        <input list="MaterialOD_' + currchild + '" value="<?php echo $Select_OD; ?>" id="Select_OD_' + currchild + '" name="Select_OD[]" class="form-control" required type="text" min="0" placeholder="OD" >\n\
                        <datalist id="MaterialOD_' + currchild + '"></datalist>\n\
                        </div>\n\
                        <div class="w3-col l4 s4 w3-padding-left">\n\
                        <label>LENGTH</label>\n\
                        <input list="MaterialLength_' + currchild + '" value="<?php echo $Select_Length; ?>" id="Select_Length_' + currchild + '" name="Select_Length[]" class="form-control" required type="text" min="0" placeholder="Length" >\n\
                        <datalist id="MaterialLength_' + currchild + '"></datalist>\n\
                        </div>\n\
                        </div>\n\
                        <div class="w3-col l1 w3-padding-left">\n\
                        <label>BASE PRICE</label><input id="base_Price_' + currchild + '" name="base_Price[]" value="<?php echo $base_Price; ?>" class="form-control" min="0" step="0.01" required type="number" placeholder="Base Price"  onfocus="GetMaterialBasePrice(' + currchild + ');">\n\
                        </div>\n\
                        <div class="w3-col l1 w3-padding-left">\n\
                        <label>QUANTITY</label>\n\
                        <input id="select_Quantity_' + currchild + '" name="select_Quantity[]" value="<?php echo $select_Quantity; ?>" class="form-control" min="0" required type="number" placeholder="Quantity" onkeypress="GetFinalPriceForMaterialCalculation(' + currchild + ');">\n\
                        </div>\n\
                        <div class="w3-col l1 w3-padding-left">\n\
                        <label>DISCOUNT(%)</label>\n\
                        <input id="discount_' + currchild + '" name="discount[]" <?php echo $discount; ?> class="form-control" required type="number" min="0" step="0.01" placeholder="Discount %." onkeypress="GetFinalPriceForMaterialCalculation(' + currchild + ');">\n\
                        </div>\n\
                        <div class="w3-col l1 w3-padding-left">\n\
                        <label>FINAL&nbsp;PRICE</label>\n\
                        <input id="final_Price_' + currchild + '" name="final_Price[]" <?php echo $final_Price; ?> class="form-control" required type="number" min="0" step="0.01" placeholder="Final Price" onfocus="GetFinalPriceForMaterialCalculation(' + currchild + ');">\n\
                        </div>\n\<a href="#" class="delete w3-text-grey w3-margin-left w3-left fa fa-remove" title="Delete field"></a>\n\
</div>');// this fun is used for add materials to parent div on click fun
currchild++;
});
                $('div#parent').on("click", ".delete", function (e) {// this fun is used for remove materials from parent div on click fun
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });// this fun is used for remove materials from parent div on click fun
            });


        </script>
        <script>
            function GetHousingValue(currentparent) {// this fun is used for show housing div on checkbox of housing
                //alert('hiii');
                var wrapper = $("#housing_statusforChecked_" + currentparent);
                var x = 1;
                var check_status = document.getElementById("checkHousing_" + currentparent).checked;
                if (check_status) {
                    x++;
// this fun is used for show housing div on checkbox of housing
$(wrapper).html('<div class="w3-col l12 w3-padding w3-small">\n\
    <div class="w3-col l6">\n\
    <label>Profile Description:</label>\n\
    <input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingChecked_' + currentparent + '" name="profile_DescriptionForHousingChecked[]" required>\n\
    </div>\n\
    </div>\n\
    <div class="w3-col l12 w3-padding w3-small">\n\
    <div class="w3-col l3 s3">\n\
    <div class="input-group">\n\
    <label>ID:</label>\n\
    <input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingChecked_' + currentparent + '" name="ID_forHousingChecked[]" required>\n\
    </div>\n\
    </div>\n\
    <div class="w3-col l3 s3 w3-padding-left">\n\
    <div class="input-group">\n\
    <label>OD:</label>\n\
    <input type="number" placeholder="OD" min="0" class="form-control" style="text-transform:uppercase;" id="OD_forHousingChecked_' + currentparent + '" name="OD_forHousingChecked[]" required>\n\
    </div>\n\
    </div>\n\
    <div class="w3-col l3 s3 w3-padding-left">\n\
    <div class="input-group">\n\
    <label>LENGTH:</label>\n\
    <input type="number" placeholder="LENGTH" min="0" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingChecked_' + currentparent + '" name="LENGTH_forHousingChecked[]" required>\n\
    </div>\n\
    </div>\n\
    <div class="w3-col l3 s3 w3-padding-left">\n\
    <div class="input-group">\n\
    <label>QUANTITY:</label>\n\
    <input type="number" placeholder="QUANTITY" min="0" class="form-control" style="text-transform:uppercase;" id="Set_QuantityforHousingChecked_' + currentparent + '" name="Set_QuantityforHousingChecked[]" required>\n\
    </div>\n\
    </div>\n\
    </div>');

                } else {// this fun is used for show housing div on checkbox of housing
                    $(wrapper).html('<div class="w3-col l12 w3-padding w3-small">\n\
                        <div class="w3-col l6">\n\
                        <label>Profile Description:</label>\n\
                        <input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked_' + currentparent + '" name="profile_DescriptionForHousingUnchecked[]" required>\n\
                        </div>\n\
                        </div>\n\
                        <div class="w3-col l12 w3-padding w3-small">\n\
                        <div class="w3-col l4 s4">\n\
                        <div class="input-group">\n\
                        <label>ID:</label>\n\
                        <input type="number" placeholder="ID" min="0" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked_' + currentparent + '" name="ID_forHousingUnckecked[]" required>\n\
                        </div>\n\
                        </div>\n\
                        <div class="w3-col l4 s4 w3-padding-left">\n\
                        <div class="input-group">\n\
                        <label>OD:</label>\n\
                        <input type="number" placeholder="OD" min="0" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked_' + currentparent + '" name="OD_forHousingUnckecked[]" required>\n\
                        </div>\n\
                        </div>\n\
                        <div class="w3-col l4 s4 w3-padding-left">\n\
                        <div class="input-group">\n\
                        <label>LENGTH:</label>\n\
                        <input type="number" placeholder="LENGTH" min="0" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_' + currentparent + '" name="LENGTH_forHousingUnckecked[]" required>\n\
                        </div>\n\
                        </div>\n\
</div>'); // this fun is used for show housing div on checkbox of housing

                }
            }
        </script>
        <script>
            function GetProfileInformation(rownum) {
                Profiles = $('#Profiles_' + rownum + ' [value="' + $('#Select_Profiles_' + rownum).val() + '"]').data('value');
                //alert(Profiles);

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>inventory/Manage_materials/GetProfileInformation",
                    data: {
                        Profiles: Profiles
                    },
                    cache: false,
                    success: function (data) {
                        //alert(data);
                        $('#MaterialDiv_'+rownum).html(data);
                    }
                });
            }
        </script>
    </head>
    <body class="w3-light-grey">
        <div class="w3-main" style="margin-left:120px;">
            <!-- Header -->

            <header class="w3-container" >
                <h5><b><i class="fa fa-cubes"></i> Manage Enquiry</b></h5>
            </header>
            <div class="w3-col l12 w3-padding-left">
                <div class="w3-col l12 w3-padding-left w3-small">
                    <label>Add New Enquiry</label>
                </div>
                <div class="w3-col l12 w3-padding">
                    <button id="btn-add-product">Add New Product </button>
                </div>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>inventory/Manage_materials/SaveProductsForEnquiry" id="Manage_EnquiryForm" name="Manage_EnquiryForm">
                <div class="w3-col l12 w3-border-top" id="parent"><!--this div for customer for to quotation-->
                    <div class="w3-col l12 w3-padding w3-small">
                        <div class="w3-col l3 w3-padding-left">
                            <div class="input-group w3-padding-top">
                                <label>Customer Name:</label> 
                                <input list="Customers" id="Select_Customers" name="Select_Customers" value="<?php echo $cust_name; ?>" class="form-control" required type="text" placeholder="Customer Name">                                         
                                <datalist id="Customers">
                                    <?php foreach ($customers['status_message'] as $result) { ?>
                                    <option data-value="<?php echo $result['cust_id']; ?>" value='<?php echo $result['customer_name']; ?>'></option>
                                    <?php } ?>
                                </datalist>
                            </div>
                        </div>
                    </div>

                </div><!--this div for customer for to quotation-->

                <div class="w3-col l12"><!--this div for button for add product to quotation-->
                    <button type="submit" class="btn btn-info w3-right w3-margin" disabled>Raise Enquiry</button>
                </div> 
                <!--this div for button for add product to quotation-->
            </form>
        </div>

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
<!--\n\<div class="w3-col l12 w3-padding-left w3-margin-top w3-margin-bottom">\n\
<button class="btn-add-siblings">Add Material</button>\n\
</div>\n\-->
<script>
    //------------get best tube-------------
    function getBest_tube(fieldnum) {

        Materialinfo = 0;
        MaterialID = 0;
        MaterialOD = 0;
        MaterialLength = 0;
        Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');

        var MaterialID = [];
        var MaterialOD = [];
        var MaterialLength = [];

        $('#Div_no_'+fieldnum+' input[name="Select_ID[]"]').each(function ()
        {
            MaterialID.push($(this).val());
        });

        $("#Div_no_"+fieldnum+" input[name='Select_OD[]']").each(function ()
        {
            MaterialOD.push($(this).val());
        });

        $("#Div_no_"+fieldnum+" input[name='Select_Length[]']").each(function ()
        {
            MaterialLength.push($(this).val());
        });

        $.ajax({
            type: "POST",
            url: BASE_URL + "inventory/Manage_enquiry/getBest_tube",
            data: {
                Materialinfo: Materialinfo,
                MaterialID: MaterialID,
                MaterialOD: MaterialOD,
                MaterialLength: MaterialLength
            },
        return: false, //stop the actual form post !important!
        success: function (data)
        {
         $('#bestTube_' + fieldnum).val(data);
     }
 })
    }
//--------------get best tube end-----------------------
</script>
<script>
function GetMaterialBasePrice(fieldnum) {
    Materialinfo = 0;
    MaterialLength = 0;
    Materialinfo = $('#Materialinfo_'+fieldnum+' [value="' + $('#Select_material_'+fieldnum).val() + '"]').data('value');
    //alert(Materialinfo);
        var MaterialLength = [];
        $("#Div_no_"+ fieldnum+" input[name='Select_Length[]']").each(function ()
    {
        MaterialLength.push($(this).val());
    });
    bestTube = $('#bestTube_'+fieldnum).val();
    //alert(bestTube);
    $.ajax({
        type: "POST",
        url: BASE_URL + "inventory/Manage_enquiry/GetMaterialBasePrice",
        data: {
            Materialinfo: Materialinfo,
            MaterialLength: MaterialLength,
            bestTube: bestTube 

        },
        return: false, //stop the actual form post !important!
        success: function (data)
        {
            alert(data);
            //                            $("#base_Price_" + fieldnum).empty();
            $('#base_Price_' + fieldnum).val(data);
        }
    });
}

</script>
    
</body>
</html>