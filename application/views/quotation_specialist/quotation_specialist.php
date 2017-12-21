<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Quotation Specialist</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
        <link href="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">

        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
        <script src="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/fetchmaterial_Details.js"></script>
    </head>
    <body class="w3-light-grey">
        <div class="w3-main" style="margin-left:120px;">
            <!-- Header -->
            <header class="w3-container w3-padding-left" >
                <h5><b><i class="fa fa-cubes"></i> Manage Quotations Specialist</b></h5>
            </header>
            <div class="w3-col l12 w3-padding-left">
                <div class="w3-col l12 w3-padding-left w3-small">
                    <label>Query For Quotations</label>
                </div>
            </div>

            <div class="w3-col l12 w3-padding-left" id="Show_workorderQueries" name="Show_workorderQueries">
                <div class="w3-col l4">
                    <table class="table table-bordered table-responsive w3-small" ><!-- table starts here -->
                        <tr style="background-color:black; color:white;" >
                            <th class="text-center">SR. No</th>
                            <th class="text-center">WO No</th>              
                            <th class="text-center">Query</th>              
                            <th class="text-center">Action</th>                                                                            
                        </tr>
                        <tbody><!-- table body for showing table details -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
