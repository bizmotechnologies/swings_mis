<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Customer</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
        <!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css">
        --><script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
        <!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script>-->
        <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/manage_customer.js"></script>

    </head>
    <body class="w3-light-grey">

        <!-- !PAGE CONTENT! -->
        <div class="w3-main" style="margin-left:120px;">

            <!-- Header -->
            <header class="w3-container" >
                <h5><b><i class="fa fa-users"></i> Manage Customers</b></h5>
            </header>
            <div class=" container"><!--container starts here  -->
                <div class="w3-right">
                    <a class="btn w3-blue w3-medium w3-padding-small" title="AddCustomer" data-toggle="modal" data-target="#myModalCustomer">Add Customer</a>
                </div>
            </div><br><!--container ends here  -->
            <div class="container"><!-- container starts here -->
                <div>

                    <div>
                        <div class="w3-margin-right" id="Show_CustomerDetails" name="Show_CustomerDetails">
                            <table class="table table-bordered" ><!-- table starts here -->
                                <tr >
                                    <th class="text-center">SR. No</th>
                                    <th class="text-center">Customer&nbsp;Name</th>              
                                    <th class="text-center">Customer&nbsp;Email</th>              
                                    <th class="text-center">Customer&nbsp;Address</th>              
                                    <th class="text-center">Joining&nbsp;Date</th> 
                                    <th class="text-center">Actions</th>                                           
                                </tr>
                                <tbody><!-- table body for showing table values which showing customer details -->
                                    <?php
                                    //print_r($details); 
                                    $count = 1;
                                    if ($details['status'] == 1) {
                                        for ($i = 0; $i < count($details['status_message']); $i++) {
                                            $email_arr = json_decode($details['status_message'][$i]['customer_email'], TRUE);
                                            $contact = json_decode($details['status_message'][$i]['contact'], TRUE);

                                            echo '<tr class="text-center">
              <td class="text-center">' . $count . '</td>
              <td class="text-center">' . $details['status_message'][$i]['customer_name'] . '</td>
              <td class="text-center">';
                                            for ($key = 0; $key < count($email_arr); $key++) {
                                                echo $email_arr[$key] . '<br>';
                                            }
                                            echo '</td>
              <td class="text-center">' . $details['status_message'][$i]['customer_address'] . '</td>
              <td class="text-center">' . $details['status_message'][$i]['joining_date'] . '</td>
              <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateCustomer" data-toggle="modal" data-target="#myModal_' . $details['status_message'][$i]['cust_id'] . '" style="padding:0"><i class="fa fa-edit"></i></a>
              <a class="btn w3-red w3-medium w3-padding-small" title="DeleteCustomer" href="' . base_url() . 'inventory/Manage_customers/DeleteCustomerDetails?Customer_id=' . $details['status_message'][$i]['cust_id'] . '" style="padding:0"><i class="fa fa-close"></i></a>

              <script type="text/javascript">
              <!-- script is for showing country for select state  -->

              $(document).ready(function () {

                print_country("SelectUpdated_Country_' . $details['status_message'][$i]['cust_id'] . '");
              //console.log(print_country);
              });
              <!-- script is for showing country for select state  -->
</script>

<script>
/*this script is used to update customer details*/

$(function(){
 $("#customerDetailsUpdatedForm_' . $details['status_message'][$i]['cust_id'] . '").submit(function(){
   dataString = $("#customerDetailsUpdatedForm_' . $details['status_message'][$i]['cust_id'] . '").serialize();

   $.ajax({
     type: "POST",
     url: "' . base_url() . 'inventory/Manage_customers/Update_CustomerDetails",
     data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
            $("#msg_header").text(\'Message\');
            $("#msg_span").css({\'color\': "black"});
            $("#addProducts_err").html(data);                         
            $(\'#myModal\').modal(\'show\');                         
          }

        });

         return false;  //stop the actual form post !important!

       });
});
/*this script is used to update customer details ends here*/
</script>                       


<div id="myModal_' . $details['status_message'][$i]['cust_id'] . '" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" id="msg_headernew">Customer Details</h4>
</div>
<div class="modal-body"> 

<form method="POST" action="" id="customerDetailsUpdatedForm_' . $details['status_message'][$i]['cust_id'] . '" name="customerDetailsUpdatedForm_' . $details['status_message'][$i]['cust_id'] . '">
<div class="w3-center">
<input type="hidden" class="" id="new_Cust_id" name="new_Cust_id" value="' . $details['status_message'][$i]['cust_id'] . '">
</div>
<div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <table class="">
                                                <tr>
                                                    <td>
                                                        <label for="CustomerName" class="control-label w3-right w3-padding-right">Customer Name:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Input_CustomerName" id="Input_CustomerName" value="' . $details['status_message'][$i]['customer_name'] . '" class="form-control" placeholder="Customer Name" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="CustomerAddress" class="control-label w3-right w3-padding-right">Customer Address:</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="Input_CustomerAddress" rows="5" id="Input_CustomerAddress" value="" class="form-control" placeholder="Customer Address" required>' . $details['status_message'][$i]['customer_address'] . '</textarea><br>
                                                    </td>
                                                </tr>

                                            </table>
                                            <div class="w3-col l12" style="margin-left: 36px">
                                                <div class="w3-col l3 w3-margin-right ">
                                                    <label for="CustomerEmail" class="control-label w3-right">Customer&nbsp;Email:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <div id="added_row">';
                                            for ($key = 0; $key < count($email_arr); $key++) {
                                                echo '<input type="email" name="Updated_CustomerEmail[]" id="Updated_CustomerEmail" class="form-control w3-margin-bottom" value="' . $email_arr[$key] . '" placeholder="Vendor Email">';
                                            }
                                            echo'</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="w3-col l12">
                                               
                                                <div id="added_Newrow">';
                                            foreach ($contact as $key) {
                                                echo'<div class="w3-col 12l">
                                                    <div class="w3-col l3 w3-margin-right w3-padding-left">
                                                    <label for="ContactPerson" class="control-label w3-right">Contact&nbsp;Person:</label>
                                                </div>
                                                <div class="w3-col l7 w3-margin-bottom">
                                                    <input type="tel" name="Input_ContactPerson[]" id="Input_ContactPerson" value="' . $key['contact_person'] . '" class="form-control" placeholder="Customer Persone Name" required>
                                                </div>
                                                <div class="w3-col l3 w3-margin-right w3-padding-left">
                                                    <label for="ContactNo" class="control-label w3-right">Contact&nbsp;No:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <input type="tel" name="Input_ContactNo_one[]" id="Input_ContactNo_one" value="' . $key['contact_number'] . '" class="form-control" placeholder="Customer Contact No" required>
                                                </div>
                                                </div><br>';
                                            }
                                            echo'</div>
                                                <span><a  id="add_Newrow" class="btn add-more w3-text-blue w3-right">+Add</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="col-lg-6">

                                            <table class="w3-margin-left">
                                                <tr>
                                                    <td><label for="BankName" class="control-label w3-right w3-padding-right">Bank&nbsp;Name:</label></td>
                                                    <td><input type="text" name="Input_Bank_name" id="Input_Bank_name" value="' . $details['status_message'][$i]['bank_name'] . '" class="form-control" placeholder="Customers Bank Name" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="BankAccNo" class="control-label w3-right w3-padding-right">Account.No:</label></td>
                                                    <td><input type="text" name="Input_Bank_AccNo" id="Input_Bank_AccNo" value="' . $details['status_message'][$i]['account_no'] . '" class="form-control" placeholder="Customer Account No" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="MICRCode" class="control-label w3-right w3-padding-right">MICR&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_Bank_MICR_Code" id="Input_Bank_MICR_Code" value="' . $details['status_message'][$i]['MICR_no'] . '" class="form-control" placeholder="Customer MICR Code" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td><label for="BankAddress" class="control-label w3-right w3-padding-right">Bank&nbsp;Address:</label></td>
                                                    <td><input type="text" name="Input_Bank_Address" id="Input_Bank_Address" value="' . $details['status_message'][$i]['bank_address'] . '" class="form-control" placeholder="Customers Bank Address" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="IFSCCode" class="control-label w3-right w3-padding-right">IFSC&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_Bank_IFSC_Code" id="Input_Bank_IFSC_Code" value="' . $details['status_message'][$i]['IFSC_no'] . '" class="form-control" placeholder="Customer IFSC Code" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="PANNo" class="control-label w3-right w3-padding-right">PAN&nbsp;NO:</label></td>
                                                    <td><input type="text" name="Input_PAN_No" id="Input_PAN_No" class="form-control" value="' . $details['status_message'][$i]['PAN_no'] . '" placeholder="Customer PAN No" required><br></td>
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
                                    <div class="row" id="addCustomerInformation_err" name="addCustomerInformation_err"></div>
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
                                        echo'<tr><td style="text-align: center;" colspan = "6">No Records Found...!</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div> 
                    </div>

                </div>
            </div>


            <!--------------------------this modal is used to show add customer's form---------------------------------->
            <div id="myModalCustomer" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div>Add Customer Information</div>
                        </div>
                        <div class="modal-body w3-small">
                            <div class="w3-padding">
                                <form method="POST" action="" id="customerDetailsForm" name="customerDetailsForm"><!-- form starts here -->
                                    <div class="col-lg-12">
                                        <div class="col-lg-6">
                                            <table class="">
                                                <tr>
                                                    <td>
                                                        <label for="CustomerName" class="control-label w3-right w3-padding-right">Customer Name:</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="Input_CustomerName" id="Input_CustomerName" class="form-control" placeholder="Customer Name" required><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="CustomerAddress" class="control-label w3-right w3-padding-right">Customer Address:</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="Input_CustomerAddress" rows="5" id="Input_CustomerAddress" class="form-control" placeholder="Customer Address" required></textarea><br>
                                                    </td>
                                                </tr>

                                            </table>
                                            <div class="w3-col l12" style="margin-left: 36px">
                                                <div class="w3-col l3 w3-margin-right">
                                                    <label for="CustomerEmail" class="control-label w3-right">Customer&nbsp;Email:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <input type="email" name="Input_CustomerEmail[]" id="Input_CustomerEmail" class="form-control" placeholder="Customer Email" required>
                                                    <div id="added_row"></div>
                                                    <span><a  id="add_row" class="btn add-more w3-text-blue w3-right">+Add</a></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="w3-col l12">
                                                <div class="w3-col l3 w3-margin-right ">
                                                    <label for="ContactPerson" class="control-label w3-right">Contact&nbsp;Person:</label>
                                                </div>
                                                <div class="w3-col l7 w3-margin-bottom">
                                                    <input type="tel" name="Input_ContactPerson[]" id="Input_ContactPerson" class="form-control" placeholder="Customer Persone Name" required>
                                                </div>
                                                <div class="w3-col l3 w3-margin-right">
                                                    <label for="ContactNo" class="control-label w3-right">Contact&nbsp;No:</label>
                                                </div>
                                                <div class="w3-col l7">
                                                    <input type="tel" name="Input_ContactNo_one[]" id="Input_ContactNo_one" class="form-control" placeholder="Customer Contact No" required>
                                                </div>
                                                <div id="added_Newrow"></div>
                                                <span><a  id="add_Newrow" class="btn add-more w3-text-blue w3-right">+Add</a></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <hr>
                                        <div class="col-lg-6">

                                            <table class="w3-margin-left">
                                                <tr>
                                                    <td><label for="BankName" class="control-label w3-right w3-padding-right">Bank&nbsp;Name:</label></td>
                                                    <td><input type="text" name="Input_Bank_name" id="Input_Bank_name" class="form-control" placeholder="Customers Bank Name" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="BankAccNo" class="control-label w3-right w3-padding-right">Account.No:</label></td>
                                                    <td><input type="text" name="Input_Bank_AccNo" id="Input_Bank_AccNo" class="form-control" placeholder="Customer Account No" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="MICRCode" class="control-label w3-right w3-padding-right">MICR&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_Bank_MICR_Code" id="Input_Bank_MICR_Code" class="form-control" placeholder="Customer MICR Code" required><br></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table>
                                                <tr>
                                                    <td><label for="BankAddress" class="control-label w3-right w3-padding-right">Bank&nbsp;Address:</label></td>
                                                    <td><input type="text" name="Input_Bank_Address" id="Input_Bank_Address" class="form-control" placeholder="Customers Bank Address" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="IFSCCode" class="control-label w3-right w3-padding-right">IFSC&nbsp;Code:</label></td>
                                                    <td><input type="text" name="Input_Bank_IFSC_Code" id="Input_Bank_IFSC_Code" class="form-control" placeholder="Customer IFSC Code" required><br></td>
                                                </tr>
                                                <tr>
                                                    <td><label for="PANNo" class="control-label w3-right w3-padding-right">PAN&nbsp;NO:</label></td>
                                                    <td><input type="text" name="Input_PAN_No" id="Input_PAN_No" class="form-control" placeholder="Customer PAN No" required><br></td>
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
                                    <div class="row" id="addCustomerInformation_err" name="addCustomerInformation_err"></div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <!--------------------------this modal is used to show add customer's form---------------------------------->

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
                            <div id="addProducts_err" name="addProducts_err"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
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
                        <div id="addCustomers_err" name="addCustomers_err"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="window.location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- script for reload page when modal is closed  -->
        <script>
//            $('#myModal').on('hidden.bs.modal', function () {
//                location.reload();
//            });
        </script>
        <!-- script for reload page when modal is closed  -->
        <script>
            $(document).ready(function () {
                var max_fields = 3;
                var wrapper = $("#added_row");
                var add_button = $("#add_row");

                var x = 1;
                $(add_button).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class=""><a href="#" class="delete w3-text-grey w3-right fa fa-remove" title="Delete email field"></a><input type="email" name="Input_CustomerEmail[]" id="Input_CustomerEmail" class="form-control" placeholder="Customer Email" required></div>'); //add input box

                    } else
                    {
                        alert('You Reached the limits')		//alert when added more than 4 input fields
                    }
                });

                $(wrapper).on("click", ".delete", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });

        </script>
        <script>
            $(document).ready(function () {
                var max_fields = 3;
                var wrapper = $("#added_Newrow");
                var add_button = $("#add_Newrow");
                var x = 1;
                $(add_button).click(function (e) {
                    e.preventDefault();
                    if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class="w3-col l12 w3-margin-top"><a href="#" class="delete w3-text-grey w3-right fa fa-remove" title="Delete Contact field"></a><div class="w3-col l3 w3-margin-right "><label for="ContactPerson" class="control-label w3-right">Person ' + x + ':</label></div><div class="w3-col l7 w3-margin-bottom"><input type="tel" name="Input_ContactPerson[]" id="Input_ContactPerson" class="form-control" placeholder="Customer Contact Person" required></div><div class="w3-col l3 w3-margin-right"><label for="ContactNo" class="control-label w3-right">Contact&nbsp;No ' + x + ':</label></div><div class="w3-col l7"><input type="tel" name="Input_ContactNo_one[]" id="Input_ContactNo_one" class="form-control" placeholder="Customer Contact No" required></div></div><br>'); //add input box

                    } else
                    {
                        alert('You Reached the limits')		//alert when added more than 4 input fields
                    }
                });
                $(wrapper).on("click", ".delete", function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });

        </script>
