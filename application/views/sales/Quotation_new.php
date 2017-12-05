<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Quotation</title>
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
            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-users"></i> Manage Quotation</b></h5>
            </header><br>

            <div class="w3-col l2 w3-padding-right w3-padding-left">
                <label class="w3-label">Enquiries:</label>
                <input list="Enquiries" type="text" class="form-control" name="select_Enquiry[]" id="select_Enquiry" placeholder="Type material name" required onchange="Show_Enquiry();">
                <datalist id="Enquiries">
                    <?php foreach ($Enquiries['status_message'] as $result) { ?>
                        <option data-value="<?php echo $result['enquiry_id']; ?>" value="<?php echo $result['customer_name']; ?>"><?php echo $result['date_on']; ?></option>                  
                    <?php } ?>
                </datalist>
                <input type="hidden" name="material_id[]" id="material_id_1">
            </div>

            <div class="w3-col l12"><!-- container starts here -->
                <div class="w3-col l12">
                    <span id="input_category_span">
                    </span>
                </div>
                <!-- this Div is for Showing table  -->
                <div class="w3-col l12">
                    <div class="w3-col l12 w3-margin-right" id="" name="" >
                        <table class="table table-striped">
                            <tr >
                                <th class="text-center">Sr.No</th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>
                                <th class="text-center"></th>              
                                <th class="text-center"></th>
                                <th class="text-center">Actions</th>              
                            </tr>
                            <tbody id="" name="">
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="w3-col l12" id="showerror">
                    
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function Show_Enquiry() {

        Enquiries = $('#Enquiries [value="' + $('#select_Enquiry').val() + '"]').data('value');

        $.ajax({
            type: "POST",
            url: BASE_URL + "sales_enquiry/Manage_quotations/Show_Enquiry",
            data: {
                Enquiries: Enquiries
            },
            return: false, //stop the actual form post !important!
            success: function (data)
            {
                alert(data);
            }
        });
    }
</script>