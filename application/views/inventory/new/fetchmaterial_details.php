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
                <div class="w3-padding-left col-lg-offset-1">
                    <div class="row">
                        <div class="col-lg-3">
                            <label class="padding-left">Select&nbsp;Material:</label> 
                        </div>
                        <div class="col-lg-6">  
                            <input list="Materialinfo" id="Select_material" name="Select_material" class="form-control" required type="text" placeholder="Select Material" onchange="GetMaterilaInformation();">                                         
                            <datalist id="Materialinfo">
                                <?php foreach ($info['status_message'] as $result) { ?>
                                    <option data-value="<?php echo $result['material_id']; ?>" value='<?php echo $result['material_name']; ?>'><?php echo $result['material_name']; ?></option>
                                <?php } ?>
                            </datalist><br>
                        </div>
                    </div>
                </div>
            </form>

            <script>
                function GetMaterilaInformation() {
                  Materialinfo =  $('#Materialinfo [value="' + $('#Select_material').val() + '"]').data('value');
                  alert(Materialinfo);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>inventory/Manage_materials/GetMaterilaInformation",
                        data: Materialinfo,
                        cache: false,
                        success: function (data) {
                            alert(data);
                            //$('#Show_producttable').html(data);
                        }
                    });
                }
            </script>