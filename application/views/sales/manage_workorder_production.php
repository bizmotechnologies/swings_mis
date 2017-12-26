<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Production</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
        <link href="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/sales/manage_quotation.js"></script>
        <style>
            .active .test {
                background-color: green;
            }
            #welcomeDiv1{
                display:none;
            }
            #welcomeDiv2{
                display:none;
            }
            .active{
                background-color: red;
                color:white;
            }
        </style>
    </head>
    <body class="w3-light-grey">
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">
            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-industry"></i> Manage Production</b></h5>
            </header>
            <div class="w3-col l12">
                <div class="w3-col l12 w3-padding-top">
                    <div class="w3-content w3-margin-top" style="max-width:1400px;">
                        <!-- The Grid -->
                        <div class="w3-col l12">
                            <!-- Left Column -->
                            <div class="w3-col l2">        
                                <div class="w3-white w3-text-grey w3-card-4">
                                    <div class="w3-display-container">
                                        <img src="http://localhost/swings_mis/images/desktop/SS01_UTEC_1-0.jpg"alt="Avatar">
                                    </div>
                                    <div class="w3-container">
                                        <hr>
                                        <div id="Demo1" class="w3-col l12 w3-bar-block">
                                            <?php foreach ($wo_info['status_message'] as $result) { 
                                                $color='';
                                                echo $result['schedular_status'];
                                                ?>
                                                <div class="w3-col l12">
                                                    <div class="w3-bar-item <?php echo $color; ?> w3-button w3-border-bottom w3-hover-black test" data-target="#welcomeDiv1" id="firstTab">
                                                        <div class="w3-container">
                                                            <h6>Work Order- <?php echo $result['wo_id']; ?></h6>
                                                            <input type="hidden" name="wo_id" id="wo_id" value="<?php echo $result['wo_id']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div><br>
                                <!-- End Left Column -->
                            </div>
                            <!-- Right Column -->
                            <div class="w3-twothird target w3-col l10" id="welcomeDiv1">
                                <div class="w3-container w3-white w3-margin-bottom">
                                    <div class="w3-main" style="overflow-y: auto;">                                        
                                        <div class="w3-col l12" id="showProduction_workorder" >
                                        </div>                                        
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <!-- End Page Container -->
                        </div>
                    </div>
                </div> 
            </div> 
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
                        <div id="addMaterials_err" name="addMaterials_err" class="w3-text-red"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('#myModalnew').on('hidden.bs.modal', function () {
               // location.reload();
            });
        </script>
        <script>
            //---this fun is used to show active div of production of work order 
            $(function () {
                $('.test').on('click', function () {
                    var $this = $(this);
                    $this.addClass("active");
                    $('.test').removeClass("active");
                    // Use the id in the data-target attribute
                    $target = $($this.data('target'));
                    $(".target").not($target).hide();
                    $target.show();
                });
            });            //---this fun is used to show active div of production of work order 

        </script>
        <script>//---this fun is used to remove active state of test class
            $(function () {
                $('.test').click(function () {
                    $(this).parent().addClass('active').siblings().removeClass('active')
                });
            });
            //---this fun is used to remove active state of test class
        </script>

    </body>
</html>
<!-- this function is used to get all information of wo production-->
<script>
    $(function () {
        $('.test').click(function () {
            Workorder_id = $('#wo_id').val();
            //alert(Workorder_id);
            $.ajax({
                type: "POST",
                url: BASE_URL + "sales_enquiry/Manage_workorder_production/get_Workorderfor_Production_details",
                data: {
                    Workorder_id: Workorder_id
                },
                return: false, //stop the actual form post !important!
                success: function (data)
                {
                    //alert(data);
                    $('#showProduction_workorder').html(data);
                }
            });
        });
    });
</script>
<!-- this function is used to get all information of wo production-->



