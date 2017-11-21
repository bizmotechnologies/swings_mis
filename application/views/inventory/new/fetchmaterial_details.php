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
                            <input list="MaterialID_1" id="Select_ID_1" name="Select_ID[]" class="form-control" required type="text" min="0" placeholder="ID" onkeyup="GetMaterialBasePrice(1);">                                         
                            <datalist id="MaterialID_1">

                            </datalist>
                        </div>
                        <div class="w3-col l4 s4 w3-padding-left">
                            <label>OD</label> 
                            <input list="MaterialOD_1" id="Select_OD_1" name="Select_OD[]" class="form-control" required type="text" min="0" placeholder="OD" onkeyup="GetMaterialBasePrice(1);">                                         
                            <datalist id="MaterialOD_1">

                            </datalist>
                        </div>
                        <div class="w3-col l4 s4 w3-padding-left">
                            <label>LENGTH</label> 
                            <input list="MaterialLength_1" id="Select_Length_1" name="Select_Length[]" class="form-control" required type="text" min="0" placeholder="Length" onkeyup="GetMaterialBasePrice(1);">                                         
                            <datalist id="MaterialLength_1">

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

            </form>
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
            <SCRIPT >
                function GetMaterialBasePrice(fieldnum) {
                    Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');
                    MaterialID = $('#MaterialID_' + fieldnum + ' [value="' + $('#Select_ID_' + fieldnum).val() + '"]').data('value');
                    MaterialOD = $('#MaterialOD_' + fieldnum + ' [value="' + $('#Select_OD_' + fieldnum).val() + '"]').data('value');
                    MaterialLength = $('#MaterialLength_' + fieldnum + ' [value="' + $('#Select_Length_' + fieldnum).val() + '"]').data('value');

                    //alert(Materialinfo);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>inventory/Manage_materials/GetMaterialBasePrice",
                        data: {
                            Materialinfo: Materialinfo,
                            MaterialID: MaterialID,
                            MaterialOD: MaterialOD,
                            MaterialLength: MaterialLength
                        },
                        return: false, //stop the actual form post !important!
                        success: function (data)
                        {
                            //alert(data);
//                            $("#msg_header").text();
//                            $("#msg_span").css({'color': "black"});
//                            $("#addMaterials_err").html(data);
//                            $('#myModalnew').modal('show');
                            $('#base_Price_' + fieldnum).val(data);
                        }
                    });
                }
            </SCRIPT>

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
                            alert(' You Reached the maximum limit of adding 15 fields.'); //alert when added more than 4 input fields
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
                    Materialinfo = $('#Materialinfo_' + fieldnum + ' [value="' + $('#Select_material_' + fieldnum).val() + '"]').data('value');
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
                            var ID = '';
                            var OD = '';
                            var Length = '';
                            for (var i = 0; i < nota.length; i++) {

                                ID += "<option data-value='" + nota[i].raw_ID + "' value='" + nota[i].raw_ID + "'>" + nota[i].raw_ID + "</option>";
                                OD += "<option data-value='" + nota[i].raw_OD + "' value='" + nota[i].raw_OD + "'>" + nota[i].raw_OD + "</option>";
                                Length += "<option data-value='" + nota[i].avail_length + "' value='" + nota[i].avail_length + "'>" + nota[i].avail_length + "</option>";
                            }
                            $("#MaterialID_" + fieldnum).empty();
                            $("#MaterialID_" + fieldnum).append(ID);
                            $("#MaterialOD_" + fieldnum).empty();
                            $("#MaterialOD_" + fieldnum).append(OD);
                            $("#MaterialLength_" + fieldnum).empty();
                            $("#MaterialLength_" + fieldnum).append(Length);
                        }
                    });
                }
            </script>