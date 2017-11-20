<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Vendor Management</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
       <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
         <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/vendor_management.js"></script>

    </head>
    <body class="w3-light-grey">
        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">
            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-users"></i> Vendor Management</b></h5>
            </header>

            <div class=" container"> <!-- container starts here -->
                <div class="w3-left">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Add_Vendors">Add Vendors</button><br> <!-- showing the add vendor popup -->
                </div><br><br>
            </div><br>

            <div class="container w3-padding"><!-- containers starts here -->
                <div class="">
                    <div>
                        <div class="w3-margin-right" id="ShowVendors" name="ShowVendors">
                            <table class="table table-bordered table-responsive" >  <!--  table starts here -->
                                <tr >
                                    <th class="text-center">SR. No</th>
                                    <th class="text-center">Vendor&nbsp;Name</th>  
                                    <th class="text-center">Vendor&nbsp;Email</th>              
                                    <th class="text-center">Shop Name</th>              
                                    <th class="text-center">Shop Address</th>              
                                    <th class="text-center">Contact&nbsp;No</th>          
                                    <th class="text-center">Actions</th>                                           
                                </tr>
                                <tbody><!-- table showing parts starts here -->
                                    <?php
                                    $count = 1;
                                    if ($details['status'] == 1) {
                                        for ($i = 0; $i < count($details['status_message']); $i++) {
                                            $email_arr = json_decode($details['status_message'][$i]['vendor_email'], TRUE);
                                            echo '<tr class="text-center">
                <td class="text-center">' . $count . '</td>
                <td class="text-center">' . $details['status_message'][$i]['vendor_name'] . '</td>
                <td class="text-center">';
                                            for ($key = 0; $key < count($email_arr); $key++) {
                                                echo $email_arr[$key] . '<br>';
                                            }
                                            echo '</td>
                <td class="text-center">' . $details['status_message'][$i]['vendor_shopname'] . '</td>
                <td class="text-center">' . $details['status_message'][$i]['vendor_shopaddress'] . '</td>
                <td class="text-center">' . $details['status_message'][$i]['contact_no_one'] . '</td>
                <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateVendor" data-toggle="modal" data-target="#UpdatemyModal_' . $details['status_message'][$i]['vendor_id'] . '" style="padding:0"><i class="fa fa-edit"></i></a>
                <a class="btn w3-red w3-medium w3-padding-small" title="DeleteVendor" href="' . base_url() . 'inventory/Vendor_Management/DeleteVendorDetails?Vendor_id=' . $details['status_message'][$i]['vendor_id'] . '" style="padding:0"><i class="fa fa-close"></i></a>

                     <script>
     /*this script is used to update Vendor details*/

     $(function(){
       $("#VendorDetailsUpdatedForm_' . $details['status_message'][$i]['vendor_id'] . '").submit(function(){
         dataString = $("#VendorDetailsUpdatedForm_' . $details['status_message'][$i]['vendor_id'] . '").serialize();

         $.ajax({
           type: "POST",
           url: "' . base_url() . 'inventory/Vendor_Management/Update_VendorDetails",
           data: dataString,
           return: false,

           success: function(data)
           {
            $("#msg_header").text(\'Message\');
            $("#msg_span").css({\'color\': "black"});
            $("#updateVendordetails_err").html(data);                         
            $(\'#myModal\').modal(\'show\');          }

          });

     return false;  

    });
    });
     /*this script is used to update customer details ends here*/
     </script>
    



 <div id="UpdatemyModal_' . $details['status_message'][$i]['vendor_id'] . '" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">

 <!-- Modal content-->
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title w3-xlarge" id="msg_headernew">Update Vendor Details</h4>
 </div>
 <div class="modal-body w3-small">

 <form method="POST" action="" id="VendorDetailsUpdatedForm_' . $details['status_message'][$i]['vendor_id'] . '" name="VendorDetailsUpdatedForm_' . $details['status_message'][$i]['vendor_id'] . '">
 <div class="w3-center">
 <input type="hidden" class="" id="new_Vendor_id" name="new_Vendor_id" value="' . $details['status_message'][$i]['vendor_id'] . '">
 </div>
                               <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label for="CustomerName" class="control-label w3-right w3-padding-right">Vendor&nbsp;Name:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Updated_VendorName" id="Updated_VendorName" class="form-control" placeholder="Vendor Name" value="' . $details['status_message'][$i]['vendor_name'] . '" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="Shop name" class="control-label w3-right w3-padding-right">ShopName:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Updated_VendorShopName" id="Updated_VendorShopName" class="form-control" value="' . $details['status_message'][$i]['vendor_shopname'] . '" placeholder="Vendor Shop Name" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="shopAddress" class="control-label w3-right w3-padding-right">Shop&nbsp;Address:</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="Updated_VendorShopAddress" rows="5" id="Updated_VendorShopAddress" class="form-control" value="" placeholder="Vendor Shop Address" required>' . $details['status_message'][$i]['vendor_shopaddress'] . '</textarea><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="ContactNo1" class="control-label w3-right w3-padding-right">Contact&nbsp;No1:</label>
                                                    </td>
                                                    <td>
                                                        <input type="tel" name="Updated_VendorContactNo_one" id="Updated_VendorContactNo_one" class="form-control" value="' . $details['status_message'][$i]['contact_no_one'] . '" placeholder="Vendor Contact No1" minlength="10" required><br>
                                                    </td>
                                                <tr>
                                                    <td>
                                                    <label for="ContactNo2" class="control-label w3-right w3-padding-right">Contact&nbsp;No2:</label>
                                                    </td>
                                                    <td>
                                                    <input type="tel" name="Updated_VendorContactNo_two" id="Updated_VendorContactNo_two" class="form-control" value="' . $details['status_message'][$i]['contact_no_two'] . '" placeholder="Vendor Contact No2" minlength="10" required><br>
                                                    </td>
                                                </tr>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="w3-col l12">
                                                <div class="w3-col l3 w3-margin-right">
                                                    <label for="VendorEmail" class="control-label w3-right">Vendor&nbsp;Email:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <div id="added_rowUpdated">';
                                            for ($key = 0; $key < count($email_arr); $key++) {
                                                echo '<input type="email" name="Updated_VendorEmail[]" id="Updated_VendorEmail" class="form-control w3-margin-bottom" value="' . $email_arr[$key] . '" placeholder="Vendor Email">';
                                            }
                                            echo'</div>
                                                </div>
                                            </div>
                                            <table>
                                                <tr>
                                                    <td><label for="landingCost" class="control-label w3-right w3-padding-right">Landing Cost:</label></td>
                                                    <td><input type="number" name="Updated_VendorLandingCost" id="Updated_VendorLandingCost" class="form-control" value="' . $details['status_message'][$i]['vendor_landing_cost'] . '" placeholder="Vendor Landing Cost" step="0.01" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="Discount" class="control-label w3-right w3-padding-right">Discount:</label></td>
                                                    <td><input type="number" name="Updated_Discount" id="Updated_Discount" class="form-control" value="' . $details['status_message'][$i]['vendor_discount'] . '" placeholder="Vendor Discount" step="0.01" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="col-lg-6">
                                            <table class="w3-margin-left">
                                                <tr>
                                                    <td><label for="BankName" class="control-label w3-right w3-padding-right">Bank&nbsp;Name:</label></td>
                                                    <td><input type="text" name="Updated_VendorBank_name" id="Updated_VendorBank_name" class="form-control" value="' . $details['status_message'][$i]['vendorbank_name'] . '" placeholder="Vendors Bank Name" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="BankAccNo" class="control-label w3-right w3-padding-right">Account.No:</label></td>
                                                    <td><input type="text" name="Updated_VendorBank_AccNo" id="Updated_VendorBank_AccNo" class="form-control" value="' . $details['status_message'][$i]['vendor_accno'] . '" placeholder="Vendor Account No" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="MICRCode" class="control-label w3-right w3-padding-right">MICR&nbsp;Code:</label></td>
                                                    <td><input type="text" name="UpdatedVendor_Bank_MICR_Code" id="UpdatedVendor_Bank_MICR_Code" class="form-control" value="' . $details['status_message'][$i]['vendor_micr_no'] . '" placeholder="Vendor MICR Code" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td><label for="BankAddress" class="control-label w3-right w3-padding-right">Bank&nbsp;Address:</label></td>
                                                    <td><input type="text" name="Updated_VendorBank_Address" id="Updated_VendorBank_Address" class="form-control" value="' . $details['status_message'][$i]['vendorbank_address'] . '" placeholder="Vendors Bank Address" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="IFSCCode" class="control-label w3-right w3-padding-right">IFSC&nbsp;Code:</label></td>
                                                    <td><input type="text" name="UpdatedVendor_Bank_IFSC_Code" id="UpdatedVendor_Bank_IFSC_Code" class="form-control" value="' . $details['status_message'][$i]['vendor_ifsc_no'] . '" placeholder="Vendor IFSC Code" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="PANNo" class="control-label w3-right w3-padding-right">PAN&nbsp;NO:</label></td>
                                                    <td><input type="text" name="VendorUpdated_PAN_No" id="VendorUpdated_PAN_No" class="form-control" value="' . $details['status_message'][$i]['vendor_pan_no'] . '" placeholder="Vendor PAN No" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="w3-margin-top w3-right">
                                            <button type="submit" class="btn btn-primary" >Update Vendor</button>
                                    </div>
                                    <div class="row" id="addVendorInformation_err" name="addVendorInformation_err"></div>
                               

</form>

 </div>

 </div>

 </div>
 </div>           
 </td>
 </tr>';
                                            $count++;
                                        }
                                    } else {
                                        echo'<tr><td style="text-align: center;" colspan = "7">No Records Found...!</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div id="Add_Vendors" class="modal fade" role="dialog"><!--  modal for add vendor information -->
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="w3-xlarge w3-center">Add Vendor Information</div>
                        </div>
                        <div class="modal-body w3-small">
                            <div class="w3-padding">
                                <form method="POST" action="" id="VendorDetailsForm" name="VendorDetailsForm"><!-- form starts here -->


                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <label for="CustomerName" class="control-label w3-right w3-padding-right">Vendor&nbsp;Name:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Input_VendorName" id="Input_VendorName" class="form-control" placeholder="Vendor Name" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="Shop name" class="control-label w3-right w3-padding-right">ShopName:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Input_VendorShopName" id="Input_VendorShopName" class="form-control" placeholder="Vendor Shop Name" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="shopAddress" class="control-label w3-right w3-padding-right">Shop&nbsp;Address:</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="Input_VendorShopAddress" rows="5" id="Input_VendorShopAddress" class="form-control" placeholder="Vendor Shop Address" required></textarea><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="ContactNo1" class="control-label w3-right w3-padding-right">Contact&nbsp;No1:</label>
                                                    </td>
                                                    <td>
                                                        <input type="tel" name="Input_VendorContactNo_one" id="Input_VendorContactNo_one" class="form-control" placeholder="Vendor Contact No1" minlength="10" required><br>
                                                    </td>
                                                <tr>
                                                    <td><label for="ContactNo2" class="control-label w3-right w3-padding-right">Contact&nbsp;No2:</label></td>
                                                    <td><input type="tel" name="Input_VendorContactNo_two" id="Input_VendorContactNo_two" class="form-control" placeholder="Vendor Contact No2" minlength="10" required><br></td>
                                                </tr>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="w3-col l12">
                                                <div class="w3-col l3 w3-margin-right">
                                                    <label for="CustomerEmail" class="control-label w3-right">Vendor&nbsp;Email:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <input type="email" name="Input_VendorEmail[]" id="Input_VendorEmail" class="form-control" placeholder="Vendor Email" required>
                                                    <div id="added_row"></div>
                                                    <span><a  id="add_row" class="btn add-more w3-text-red w3-right">+Add</a></span>
                                                </div>
                                            </div>
                                            <table>
                                                <tr>
                                                    <td><label for="landingCost" class="control-label w3-right w3-padding-right">Landing Cost:</label></td>
                                                    <td><input type="number" name="Input_VendorLandingCost" id="Input_VendorLandingCost" class="form-control" placeholder="Vendor Landing Cost" step="0.01" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="Discount" class="control-label w3-right w3-padding-right">Discount:</label></td>
                                                    <td><input type="number" name="Input_Discount" id="Input_Discount" class="form-control" placeholder="Vendor Discount" step="0.01" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="col-lg-6">
                                            <table class="w3-margin-left">
                                                <tr>
                                                    <td><label for="BankName" class="control-label w3-right w3-padding-right">Bank&nbsp;Name:</label></td>
                                                    <td><input type="text" name="Input_VendorsBank_name" id="Input_VendorsBank_name" class="form-control" placeholder="Vendors Bank Name" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="BankAccNo" class="control-label w3-right w3-padding-right">Account.No:</label></td>
                                                    <td><input type="text" name="Input_VendorBank_AccNo" id="Input_VendorBank_AccNo" class="form-control" placeholder="Vendor Account No" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="MICRCode" class="control-label w3-right w3-padding-right">MICR&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_VendorBank_MICR_Code" id="Input_VendorBank_MICR_Code" class="form-control" placeholder="Vendor MICR Code" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td><label for="BankAddress" class="control-label w3-right w3-padding-right">Bank&nbsp;Address:</label></td>
                                                    <td><input type="text" name="Input_VendorBank_Address" id="Input_VendorBank_Address" class="form-control" placeholder="Vendors Bank Address" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="IFSCCode" class="control-label w3-right w3-padding-right">IFSC&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_VendorBank_IFSC_Code" id="Input_VendorBank_IFSC_Code" class="form-control" placeholder="Vendor IFSC Code" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="PANNo" class="control-label w3-right w3-padding-right">PAN&nbsp;NO:</label></td>
                                                    <td><input type="text" name="Input_VendorPAN_No" id="Input_VendorPAN_No" class="form-control" placeholder="Vendor PAN No" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="w3-margin-top">
                                        <center>
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                            <button type="reset" class="btn btn-default" >Reset</button>
                                        </center>
                                    </div>
                                    <div class="row" id="addVendorInformation_err" name="addVendorInformation_err"></div>
                                </form>
                                <!-- form ends here -->
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

    </div><!-- main container -->
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="modal-title" id="msg_header" name="msg_header"></div>
                </div>
                <div class="modal-body">
                    <div id="updateVendordetails_err" name="updateVendordetails_err"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div><!-- modal ends here -->
    <script type="text/javascript">
        /*script for showing country and state*/
//        $(document).ready(function () {
//            print_country("Select_VendorCountry");
//        });
        /*script for showing country and state*/
    </script>
    <!-- This script is used to reload the page when popup close -->
    <script>
//        $('#myModal').on('hidden.bs.modal', function () {
//            location.reload();
//        });
    </script>
    <!-- This script is used to reload the page when popup close -->
    <script>
        $(document).ready(function () {
            var max_fields = 4;
            var wrapper = $("#added_row");
            var add_button = $("#add_row");

            var x = 1;
            $(add_button).click(function (e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append('<div class=""><a href="#" class="delete w3-text-grey w3-right fa fa-remove" title="Delete email field"></a><input type="email" name="Input_VendorEmail[]" id="Input_VendorEmail" class="form-control" placeholder="Vendor Email" required></div>'); //add input box

                } else
                {
                    $.alert('You Reached the maximum limit of 4')		//alert when added more than 4 input fields
                }
            });

            $(wrapper).on("click", ".delete", function (e) {
                e.preventDefault();
                $(this).parent('div').remove();
                x--;
            })
        });

    </script>
