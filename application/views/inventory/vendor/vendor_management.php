<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate Quotations</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
<!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css">
--><script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url(); ?>css/country/country.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-users"></i> Manage Customers</b></h5>
    </header>

 <div class=" container w3-padding"> <!-- container starts here -->
  <div><b>Vendor Management</b></div><br>
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
            <th class="text-center">ShopName</th>              
            <th class="text-center">Address</th>              
            <th class="text-center">Contact&nbsp;No</th>          
            <th class="text-center">Actions</th>                                           
          </tr>
          <tbody><!-- table showing parts starts here -->
            <?php
            $count=1;
            if($details['status']==0)
            {
              for($i = 0; $i < count($details['status_message']); $i++)
              { 
                echo '<tr class="text-center">
                <td class="text-center">'.$count.'</td>
                <td class="text-center">'.$details['status_message'][$i]['vendor_name'].'</td>
                <td class="text-center">'.$details['status_message'][$i]['vendor_email'].'</td>
                <td class="text-center">'.$details['status_message'][$i]['vendor_shopname'].'</td>
                <td class="text-center">'.$details['status_message'][$i]['vendor_shopaddress'].'</td>
                <td class="text-center">'.$details['status_message'][$i]['contact_no_one'].'</td>
                <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateVendor" data-toggle="modal" data-target="#UpdatemyModal_'.$details['status_message'][$i]['vendor_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
                <a class="btn w3-red w3-medium w3-padding-small" title="DeleteVendor" href="'.base_url().'inventory/Vendor_Management/DeleteVendorDetails?Vendor_id='.$details['status_message'][$i]['vendor_id'].'" style="padding:0"><i class="fa fa-close"></i></a>

                <script type="text/javascript">
                <!-- script is for showing country for select state  -->

                $(document).ready(function () {

                  print_country("SelectVendorUpdated_Country_'.$details['status_message'][$i]['vendor_id'].'");
              //console.log(print_country);
                });
 <!-- script is for showing country for select state  -->
     </script>

     <script>
     /*this script is used to update Vendor details*/

     $(function(){
       $("#VendorDetailsUpdatedForm_'.$details['status_message'][$i]['vendor_id'].'").submit(function(){
         dataString = $("#VendorDetailsUpdatedForm_'.$details['status_message'][$i]['vendor_id'].'").serialize();

         $.ajax({
           type: "POST",
           url: "'.base_url().'inventory/Vendor_Management/Update_VendorDetails",
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



 <div id="UpdatemyModal_'.$details['status_message'][$i]['vendor_id'].'" class="modal fade" role="dialog">
 <div class="modal-dialog modal-lg">

 <!-- Modal content-->
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal">&times;</button>
 <h4 class="modal-title" id="msg_headernew">Vendor Details</h4>
 </div>
 <div class="modal-body">

 <form method="POST" action="" id="VendorDetailsUpdatedForm_'.$details['status_message'][$i]['vendor_id'].'" name="VendorDetailsUpdatedForm_'.$details['status_message'][$i]['vendor_id'].'">
 <div class="w3-center">
 <input type="hidden" class="" id="new_Vendor_id" name="new_Vendor_id" value="'.$details['status_message'][$i]['vendor_id'].'">
 </div>
 <div class="w3-dark-grey">Personal Details</div><br>
 <div class="row">

 <div class="col-lg-2">
 <label for="customerName" class="control-label">Vendor&nbsp;Name:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorName" id="Updated_VendorName" class="form-control" placeholder="Vendor Name" value="'.$details['status_message'][$i]['vendor_name'].'" required><br>
 </div>

 <div class="col-lg-2">
 <label for="customerEmail" class="control-label">Vendor&nbsp;Email:</label></div>
 <div class="col-lg-4">
 <input type="email" name="Updated_VendorEmail" id="Updated_VendorEmail" class="form-control" placeholder="Vendor Email" value="'.$details['status_message'][$i]['vendor_email'].'" required><br>
 </div>

 </div>

 <div class="row">

 <div class="col-lg-2">
 <label for="customerName" class="control-label">ShopName:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorShopName" id="Updated_VendorShopName" class="form-control" placeholder="Vendor ShopName" value="'.$details['status_message'][$i]['vendor_shopname'].'" required><br>
 </div>

 <div class="col-lg-2">
 <label for="customerEmail" class="control-label">ShopAddress:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorShopAddress" id="Updated_VendorShopAddress" class="form-control" placeholder="Vendor ShopAddress" value="'.$details['status_message'][$i]['vendor_shopaddress'].'" required><br>
 </div>

 </div>


 <div class="row">

 <div class="col-lg-2">
 <label for="country" class="control-label">Country:</label></div>
 <div class="col-lg-4">
 <select class="form-control" name="SelectVendorUpdated_Country" id="SelectVendorUpdated_Country_'.$details['status_message'][$i]['vendor_id'].'" onchange ="print_state(\'SelectUpdatedVendor_State_'.$details['status_message'][$i]['vendor_id'].'\', this.selectedIndex);" required>
 <option> Select Country</option>
 </select><br>
 </div>

 <div class="col-lg-2">
 <label for="state" class="control-label">State:</label></div>
 <div class="col-lg-4">
 <select class="form-control" name="SelectUpdatedVendor_State" id="SelectUpdatedVendor_State_'.$details['status_message'][$i]['vendor_id'].'" required>
 <option>Select State</option>
 </select><br>
 </div>

 </div>

 <div class="row">
 <div class="col-lg-2">
 <label for="city" class="control-label">City:</label></div>
 <div class="col-lg-4">
 <input type="text" name="UpdateVendor_City" id="UpdateVendor_City" class="form-control" placeholder="Vendor City" value="'.$details['status_message'][$i]['vendor_city'].'" required><br>
 </div>
 </div>

 <div class="row">
 <div class="col-lg-2">
 <label for="contactNo1" class="control-label">Contact&nbsp;No1:</label></div>
 <div class="col-lg-4">
 <input type="number" name="Updated_VendorContactNo_one" id="Updated_VendorContactNo_one" class="form-control" value="'.$details['status_message'][$i]['contact_no_one'].'" placeholder="vendor Contact No1" minlength="10" required><br>
 </div>
 <div class="col-lg-2">
 <label for="contactNo2" class="control-label">Contact&nbsp;No2:</label></div>
 <div class="col-lg-4">
 <input type="number" name="Updated_VendorContactNo_two" id="Updated_VendorContactNo_two" class="form-control" value="'.$details['status_message'][$i]['contact_no_two'].'" placeholder="vendor Contact No2" minlength="10" required><br>
 </div>
 </div>

 <div class="w3-dark-grey">Bank Details</div><br>

 <div class="row">
 <div class="col-lg-2">
 <label for="bankName" class="control-label">Bank&nbsp;Name:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorBank_name" id="Updated_VendorBank_name" class="form-control" value="'.$details['status_message'][$i]['vendorbank_name'].'" placeholder="Vendor Bank Name" required><br>
 </div>
 <div class="col-lg-2">
 <label for="bankAddress" class="control-label">Bank&nbsp;Address:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorBank_Address" id="Updated_VendorBank_Address" class="form-control" value="'.$details['status_message'][$i]['vendorbank_address'].'" placeholder="Vendor Bank Address" required><br>
 </div>
 </div>

 <div class="row">
 <div class="col-lg-2">
 <label for="bankAccno" class="control-label">Bank&nbsp;Account.No:</label></div>
 <div class="col-lg-4">
 <input type="text" name="Updated_VendorBank_AccNo" id="Updated_VendorBank_AccNo" class="form-control" value="'.$details['status_message'][$i]['vendor_accno'].'" placeholder="Vendor Account No" required><br>
 </div>
 <div class="col-lg-2">
 <label for="ifscNo" class="control-label">IFSC&nbsp;Code:</label></div>
 <div class="col-lg-4">
 <input type="text" name="UpdatedVendor_Bank_IFSC_Code" id="UpdatedVendor_Bank_IFSC_Code" class="form-control" value="'.$details['status_message'][$i]['vendor_ifsc_no'].'" placeholder="Vendor IFSC Code" required><br>
 </div>
 </div>


 <div class="row">
 <div class="col-lg-2">
 <label for="micrNo" class="control-label">MICR&nbsp;Code:</label></div>
 <div class="col-lg-4">
 <input type="text" name="UpdatedVendor_Bank_MICR_Code" id="UpdatedVendor_Bank_MICR_Code" class="form-control" value="'.$details['status_message'][$i]['vendor_micr_no'].'" placeholder="Vendor MICR Code" required><br>
 </div>
 <div class="col-lg-2">
 <label for="panNo" class="control-label">PAN&nbsp;NO:</label></div>
 <div class="col-lg-4">
 <input type="text" name="VendorUpdated_PAN_No" id="VendorUpdated_PAN_No" class="form-control" placeholder="Vendor PAN No" value="'.$details['status_message'][$i]['vendor_pan_no'].'" required><br>
 </div>
 </div>

 <div class="row col-lg-3 col-lg-offset-8">
 <button type="submit" class="btn btn-primary w3-padding w3-right" style="margin: 10px;">Update</button>
 </div><br>
 <div><br>
 </div>
 </div>
 </form>

 </div>

 </div>

 </div>
 </div>           
 </td>
 </tr>';
 $count++;
}
}
else
{
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
        <div>Add Vendor Information</div>
      </div>
      <div class="modal-body">
        <form method="POST" action="" id="VendorDetailsForm" name="VendorDetailsForm"><!-- form starts here -->
          <div class="w3-dark-grey">Shop Details</div><br>

          <div class="row">
            <div class="col-lg-2">
              <label for="CustomerName" class="control-label">Vendor&nbsp;Name:</label></div>
              <div class="col-lg-4">
                <input type="text" name="Input_VendorName" id="Input_CustomerName" class="form-control" placeholder="Vendor Name" required><br>
              </div>

              <div class="col-lg-2">
                <label for="CustomerEmail" class="control-label">Vendor&nbsp;Email:</label></div>
                <div class="col-lg-4">
                  <input type="email" name="Input_VendorEmail" id="Input_VendorEmail" class="form-control" placeholder="Vendor Email" required><br>
                </div>
              </div>


              <div class="row">

                <div class="col-lg-2">
                  <label for="Country" class="control-label">Vendor&nbsp;ShopName:</label></div>
                  <div class="col-lg-4">
                   <input type="text" name="Input_VendorShopName" id="Input_VendorShopName" class="form-control" placeholder="Vendor Shop Name" required><br>
                 </div>

                 <div class="col-lg-2">
                  <label for="State" class="control-label">Shop&nbsp;Address:</label></div>
                  <div class="col-lg-4">
                   <input type="text" name="Input_VendorShopAddress" id="Input_VendorShopAddress" class="form-control" placeholder="Vendor Shop Address" required><br>
                 </div>

               </div>

               <div class="row">

                <div class="col-lg-2">
                  <label for="Country" class="control-label">Country:</label></div>
                  <div class="col-lg-4">
                    <select class="form-control" name="Select_VendorCountry" id="Select_VendorCountry" onchange ="print_state('Select_VendorState', this.selectedIndex);">
                      <option>Select Country</option>
                    </select><br>
                  </div>

                  <div class="col-lg-2">
                    <label for="State" class="control-label">State:</label></div>
                    <div class="col-lg-4">
                      <select class="form-control" name="Select_VendorState" id="Select_VendorState">
                        <option>Select State</option>
                      </select><br>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-lg-2">
                      <label for="City" class="control-label">City:</label></div>
                      <div class="col-lg-4">
                        <input type="text" name="Input_VendorCity" id="Input_VendorCity" class="form-control" placeholder="Vendor City" required><br>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-2">
                        <label for="ContactNo1" class="control-label">Contact&nbsp;No1:</label></div>
                        <div class="col-lg-4">
                          <input type="number" name="Input_VendorContactNo_one" id="Input_VendorContactNo_one" class="form-control" placeholder="Vendor Contact No1" minlength="10" required><br>
                        </div>
                        <div class="col-lg-2">
                          <label for="ContactNo2" class="control-label">Contact&nbsp;No2:</label></div>
                          <div class="col-lg-4">
                            <input type="number" name="Input_VendorContactNo_two" id="Input_VendorContactNo_two" class="form-control" placeholder="Vendor Contact No2" minlength="10" required><br>
                          </div>
                        </div>

                        <div class="w3-dark-grey">Bank Details</div><br>

                        <div class="row">
                          <div class="col-lg-2">
                            <label for="BankName" class="control-label">Bank&nbsp;Name:</label></div>
                            <div class="col-lg-4">
                              <input type="text" name="Input_VendorsBank_name" id="Input_VendorsBank_name" class="form-control" placeholder="Vendors Bank Name" required><br>
                            </div>
                            <div class="col-lg-2">
                              <label for="BankAddress" class="control-label">Bank&nbsp;Address:</label></div>
                              <div class="col-lg-4">
                                <input type="text" name="Input_VendorBank_Address" id="Input_VendorBank_Address" class="form-control" placeholder="Vendors Bank Address" required><br>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-lg-2">
                                <label for="BankAccNo" class="control-label">Bank&nbsp;Account.No:</label></div>
                                <div class="col-lg-4">
                                  <input type="text" name="Input_VendorBank_AccNo" id="Input_VendorBank_AccNo" class="form-control" placeholder="Vendor Account No" required><br>
                                </div>
                                <div class="col-lg-2">
                                  <label for="IFSCCode" class="control-label">IFSC&nbsp;Code:</label></div>
                                  <div class="col-lg-4">
                                    <input type="text" name="Input_VendorBank_IFSC_Code" id="Input_VendorBank_IFSC_Code" class="form-control" placeholder="Vendor IFSC Code" required><br>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-lg-2">
                                    <label for="MICRCode" class="control-label">MICR&nbsp;Code:</label></div>
                                    <div class="col-lg-4">
                                      <input type="text" name="Input_VendorBank_MICR_Code" id="Input_VendorBank_MICR_Code" class="form-control" placeholder="Vendor MICR Code" required><br>
                                    </div>
                                    <div class="col-lg-2">
                                      <label for="PANNo" class="control-label">PAN&nbsp;NO:</label></div>
                                      <div class="col-lg-4">
                                        <input type="text" name="Input_VendorPAN_No" id="Input_VendorPAN_No" class="form-control" placeholder="Vendor PAN No" required><br>
                                      </div>
                                    </div>

                                    <div class="row">
                                     <center> <button type="submit" class="btn btn-primary w3-padding w3-center" style="margin: 10px;">Submit</button>
                                      <button type="reset" class="btn btn-default w3-padding w3-center" style="margin: 10px;">Reset</button></center>
                                    </div>
                                    <div class="row" id="addVendorInformation_err" name="addVendorInformation_err"></div>
                                  </form>
                                  <!-- form ends here -->

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
                                <button type="button" onclick= "window.location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div><!-- modal ends here -->


<script type="text/javascript">
                        /*script for showing country and state*/
          $(document).ready(function () {
          print_country("Select_VendorCountry");
           });
              /*script for showing country and state*/
</script>
<script>
                        /*this script is used for submit fun to add vendor details*/
        $(function(){
          $("#VendorDetailsForm").submit(function(){
        dataString = $("#VendorDetailsForm").serialize();
       $.ajax({
       type: "POST",
       url: "<?php echo base_url();?>inventory/Vendor_Management/save_VendorDetails",
        data: dataString,
         return: false,  //stop the actual form post !important!
          success: function(data)
          {
          $("#addVendorInformation_err").html(data);                         
         }
      });
       return false;  //stop the actual form post !important!
     });
    });
                          /*this script is used for submit fun to add vendor details*/
    </script>
                          <!-- This script is used to reload the page when popup close -->
    <script>
    $('#myModal').on('hidden.bs.modal', function () {
      location.reload();
    });
    </script>
  <!-- This script is used to reload the page when popup close -->