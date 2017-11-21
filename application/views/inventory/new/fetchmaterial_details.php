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

    </head>
    <body class="w3-light-grey">
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">

            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-cubes"></i> Manage Stocks</b></h5>
            </header>
            <form method="POST" action="" id="Manage_RawMaterialForm" name="Manage_RawMaterialForm">

                <div class="w3-col l12 w3-small w3-padding">
                    <div class="w3-col l2">
                        <label >MATERIAL</label> 
                        <input list="Materialinfo" id="Select_material_1" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(1);">                                         
                        <datalist id="Materialinfo">
                            <?php foreach ($info['status_message'] as $result) { ?>
                                <option data-value="<?php echo $result['material_id']; ?>" value='<?php echo $result['material_name']; ?>'><?php echo $result['material_name']; ?></option>
                            <?php } ?>
                        </datalist>
                    </div>
                    <div class="w3-col l3">
                        <div class="w3-col l4 s4 w3-padding-left">
                            <label>ID</label> 
                            <input list="MaterialID" id="Select_ID_1" name="Select_ID[]" class="form-control" required type="text" placeholder="ID">                                         
                            <datalist id="MaterialID">

                            </datalist>
                        </div>
                        <div class="w3-col l4 s4 w3-padding-left">
                            <label >OD</label> 
                            <input list="MaterialOD" id="Select_OD_1" name="Select_OD[]" class="form-control" required type="text" placeholder="OD">                                         
                            <datalist id="MaterialOD">

                            </datalist>
                        </div>
                        <div class="w3-col l4 s4 w3-padding-left">
                            <label >LENGTH</label> 
                            <input list="MaterialLength" id="Select_Length_1" name="Select_Length[]" class="form-control" required type="text" placeholder="Length">                                         
                            <datalist id="MaterialLength">

                            </datalist>
                        </div>
                    </div>

                    <div class="w3-col l1 w3-padding-left">
                        <label>BASE PRICE</label> 
                        <input id="base_Price_1" name="base_Price[]" class="form-control" min="0" required type="number" placeholder="Base Price">                                         
                    </div>

                    <div class="w3-col l1 w3-padding-left">
                        <label>QUANTITY</label> 
                        <input id="select_Quantity_1" name="select_Quantity[]" class="form-control" min="0" required type="number" placeholder="Quantity">                                         
                    </div>

                    <div class="w3-col l1 w3-padding-left">
                        <label>DISCOUNT</label> 
                        <input id="discount_1" name="discount[]" class="form-control" required type="number" min="0" placeholder="Discount %.">                                         
                    </div>

                    <div class="w3-col l1 w3-padding-left">
                        <label>FINAL&nbsp;PRICE</label> 
                        <input id="final_Price_1" name="final_Price[]" class="form-control" required type="number" min="0" placeholder="Final Price">                                         
                    </div>
                    <div class="w3-col l1">
                        <span><a  id="add_row" class="btn add-more w3-text-blue w3-right">+Add</a></span>
                    </div>
                </div>

                <div class="w3-col l12">
                    <div id="added_row" class="w3-small w3-col l12"></div>
                </div>

                <!--                </div>-->
            </form>


            <script>
                $(document).ready(function () {
                    var max_fields = 15;
                    var wrapper = $("#added_row");
                    var add_button = $("#add_row");
                    var x = 1;
                    $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                            x++;
                            $(wrapper).append('<div class="w3-margin-bottom w3-col l12 w3-padding-left">\n\
<div class="w3-col l2">\n\
<label>MATERIAL</label>\n\
<input list="Materialinfo" id="Select_material_' + x + '" name="Select_material[]" class="form-control" required type="text" placeholder="Material" onchange="GetMaterialInformation_ForEnquiry(' + x + ');">\n\
<datalist id="Materialinfo">\n\
<?php foreach ($info['status_message'] as $result) { ?><option data-value="<?php echo $result['material_id']; ?>" value="<?php echo $result['material_name']; ?>"><?php echo $result['material_name']; ?></option><?php } ?></datalist>\n\
</div>\n\
<div class="w3-col l3">\n\
<div class="w3-col l4 s4 w3-padding-left">\n\
<label>ID</label>\n\
<input list="MaterialID" id="Select_ID_' + x + '" name="Select_ID[]" class="form-control" required type="text" placeholder="ID">\n\
<datalist id="MaterialID">\n\
</datalist>\n\
</div>\n\
<div class="w3-col l4 s4 w3-padding-left">\n\
<label >OD</label>\n\
<input list="MaterialOD" id="Select_OD_' + x + '" name="Select_OD[]" class="form-control" required type="text" placeholder="OD">\n\
<datalist id="MaterialOD">\n\
</datalist>\n\
</div>\n\
<div class="w3-col l4 s4 w3-padding-left">\n\
<label>LENGTH</label>\n\
<input list="MaterialLength" id="Select_Length_' + x + '" name="Select_Length[]" class="form-control" required type="text" placeholder="Length">\n\
<datalist id="MaterialLength">\n\
</datalist>\n\
</div>\n\
</div>\n\
<div class="w3-col l1 w3-padding-left">\n\
<label>BASE PRICE</label>\n\
<input id="base_Price_' + x + '" name="base_Price[]" class="form-control" min="0" required type="number" placeholder="Base Price"></div>\n\
<div class="w3-col l1 w3-padding-left">\n\
<label>QUANTITY</label>\n\
<input id="select_Quantity_' + x + '" name="select_Quantity[]" class="form-control" min="0" required type="number" placeholder="Quantity">\n\
</div>\n\
<div class="w3-col l1 w3-padding-left">\n\
<label>DISCOUNT</label>\n\
<input id="discount_' + x + '" name="discount[]" class="form-control" required min="0" type="number" placeholder="Discount">\n\
</div>\n\
<div class="w3-col l1 w3-padding-left">\n\
<label>FINAL&nbsp;PRICE</label>\n\
<input id="final_Price_' + x + '" name="final_Price[]" class="form-control" min="0" required type="number" placeholder="Final Price">\n\
</div>\n\
<a href="#" class="delete w3-text-grey w3-margin-left w3-left fa fa-remove" title="Delete field"></a>\n\
</div>'); //add input box

                        } else
                        {
                            alert(' You Reached the maximum limit of adding 15 fields.');		//alert when added more than 4 input fields
                        }
                    });

                    $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault();
                        $(this).parent('div').remove();
                        x--;
                    });
                });

            </script>

            <!-- this script is used for showing add more rows functionality ends here -->
            <script>
                function GetMaterilaInformation() {
                    Materialinfo = $('#Materialinfo [value="' + $('#Select_material_1').val() + '"]').data('value');
                    //alert(Materialinfo);
                    datas = {
                        materialinfo: Materialinfo
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>inventory/Manage_materials/GetMaterilaInformation",
                        data: datas,
                        cache: false,
                        success: function (data) {
                            alert(data);
                            //$('#Show_producttable').html(data);
                        }
                    });
                }
            </script>
            <script>
                function GetMaterialInformation_ForEnquiry(fieldnum) {
                    Materialinfo = $('#Materialinfo [value="' + $('#Select_material_1').val() + '"]').data('value');
                    alert(Materialinfo);
                    Materialinfo = {
                        Materialinfo: Materialinfo
                    };
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>inventory/Manage_materials/GetMaterialInformation_ForEnquiry",
                        data: Materialinfo,
                        cache: false,
                        success: function (data) {
                            nota = JSON.parse(data);
                            //alert(data);
                            var str = '';
                            for (var i = 0; i < nota.length; i++) {

                                str += "<option data-value='" + nota[i].raw_ID + "' value='" + nota[i].raw_ID + "'>" + nota[i].raw_ID + "</option>";
                                $('#MaterialOD [value="' + $('#Select_OD_' + fieldnum).val(nota[i].raw_OD) + '"]').data('value');
                                $('#MaterialLength [value="' + $('#Select_Length_' + fieldnum).val(nota[i].avail_length) + '"]').data('value');
                            }
                            $("#MaterialID").empty();
                            $("#MaterialID").append(str);
                        }
                    });
                }
            </script>