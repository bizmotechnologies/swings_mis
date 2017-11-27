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
        <script>
            var currparent = 1;
            var currchild = 1;
            function getChildDivHtml(id) {
                return '<div class="w3-col l12 w3-padding"" id="Product' + currparent + '">Product ' + currparent + '\n\
<div class="w3-col l12 w3-padding">\n\
\n\
<div class="w3-col l3 w3-left">\n\
<div class="input-group">\n\
<label>Product Name:</label>\n\
<input type="text" placeholder="Product Name" value="" class="form-control" style="text-transform:uppercase;" id="product_nameForEnquiry_1" name="product_nameForEnquiry[]" required>\n\
</div>\n\
</div>\n\
\n\
</div>\n\
\n\
<div class="w3-col l12 w3-light-grey w3-padding">\n\
\n\
<div class="w3-col l10 w3-left">\n\
<div class="input-group ">\n\
<input type="checkbox" id="checkHousing_1" onchange="GetHousingValue();"><b>  Housing(EX. Seal&nbsp;kit&nbsp;for&nbsp;Hydraulic&nbsp;70&nbsp;MM,&nbsp;Rod&nbsp;50&nbsp;MM&nbsp;–&nbsp;15&nbsp;Sets.)</b>\n\
</div>\n\
</div>\n\
</div>\n\
\n\
<div class="w3-light-grey" id="housing_statusforChecked_1">\n\
\n\
<div class="w3-col l12 w3-padding">\n\
<div class="w3-col l6">\n\
<label>Profile Description:</label>\n\
<input type="text" value="" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked_1" name="profile_DescriptionForHousingUnchecked[]" required>\n\
</div>\n\
</div>\n\
<div class="w3-col l12 w3-padding">\n\
\n\
<div class="w3-col l4 s4">\n\
<div class="input-group">\n\
<label>ID:</label>\n\
<input type="number" placeholder="ID" class="form-control" value="" style="text-transform:uppercase;" id="ID_forHousingUnckecked_1" name="ID_forHousingUnckecked[]" required>\n\
</div>\n\
</div>\n\
\n\
<div class="w3-col l4 s4 w3-padding-left">\n\
<div class="input-group">\n\
<label>OD:</label>\n\
<input type="number" placeholder="OD" class="form-control" value="" style="text-transform:uppercase;" id="OD_forHousingUnckecked_1" name="OD_forHousingUnckecked[]" required>\n\
</div>\n\
</div>\n\
\n\
<div class="w3-col l4 s4 w3-padding-left">\n\
<div class="input-group">\n\
<label>LENGTH:</label>\n\
<input type="number" placeholder="LENGTH" class="form-control" value="" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_1" name="LENGTH_forHousingUnckecked[]" required>\n\
</div>\n\
</div>\n\
\n\
</div>\n\
</div>\n\
\n\
</div>';
            }
            $(document).ready(function () {
                $('#btn-add-product').on('click', function () {
                    $('div#parent').append(getChildDivHtml(currparent));
                    currparent++;
                });

                $('div#parent').on('click', '.btn-add-siblings', function () {
                    $(this).parent().append('<div class="w3-col l12 w3-tiny">\n\
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
</div>');
                    currchild++;
                });
                $('div#parent').on("click", ".delete", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                });
            });


        </script>
        <script>
            function GetHousingValue() {
                var wrapper = $("#housing_statusforChecked_1");
                var x = 1;
                var housing = $('#checkHousing_1');
                //e.preventDefault();
                if (housing.checked) {
                    x++;
                    $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingChecked_1" name="profile_DescriptionForHousingChecked[]" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l3 s3"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingChecked_1" name="ID_forHousingChecked[]" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingChecked_1" name="OD_forHousingChecked[]" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingChecked_1" name="LENGTH_forHousingChecked[]" required></div></div><div class="w3-col l3 s3 w3-padding-left"><div class="input-group"><label>QUANTITY:</label><input type="number" placeholder="QUANTITY" class="form-control" style="text-transform:uppercase;" id="Set_QuantityforHousingChecked_1" name="Set_QuantityforHousingChecked[]" required></div></div></div>');

                } else {
                    $(wrapper).html('<div class="w3-col l12 w3-padding"><div class="w3-col l6"><label>Profile Description:</label><input type="text" placeholder="Profile Description(Ex.Piston Seal, Rod Seal .etc.)" class="form-control" style="text-transform:uppercase;" id="profile_DescriptionForHousingUnchecked_1" name="profile_DescriptionForHousingUnchecked[]" required></div></div><div class="w3-col l12 w3-padding"><div class="w3-col l4 s4"><div class="input-group"><label>ID:</label><input type="number" placeholder="ID" class="form-control" style="text-transform:uppercase;" id="ID_forHousingUnckecked_1" name="ID_forHousingUnckecked[]" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>OD:</label><input type="number" placeholder="OD" class="form-control" style="text-transform:uppercase;" id="OD_forHousingUnckecked_1" name="OD_forHousingUnckecked[]" required></div></div><div class="w3-col l4 s4 w3-padding-left"><div class="input-group"><label>LENGTH:</label><input type="number" placeholder="LENGTH" class="form-control" style="text-transform:uppercase;" id="LENGTH_forHousingUnckecked_1" name="LENGTH_forHousingUnckecked[]" required></div></div></div>'); //add input box

                }
            }
        </script>
    </head>
    <body class="w3-light-grey">
        <div class="w3-main" style="margin-left:120px;">
            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-cubes"></i> Manage Enquiry</b></h5>
            </header>
            <div class="col-lg-12"><label>Add New Enquiry</label>
            </div>
            <div class="col-lg-12 w3-border">
                <button id="btn-add-product">Add New Product </button>
            </div>
            <div class="col-lg-12 w3-border" id="parent">

            </div>
        </div>
    </body>
</html>