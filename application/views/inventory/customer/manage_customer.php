<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
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
  <script type="text/javascript" src="<?php echo base_url(); ?>css/country/country.js"></script>

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
    <?php echo anchor("inventory/add_customers", 'Back&nbsp;To&nbsp;Customer', ['class' => 'btn btn-primary']);?>
  </div>
</div><br><!--container ends here  -->
<div class="container" style="border:thin"><!-- container starts here -->
 <div class="">

  <div>
    <div class="w3-margin-right" id="Show_CustomerDetails" name="Show_CustomerDetails">
      <table class="table table-bordered" ><!-- table starts here -->
        <tr >
          <th class="text-center">SR. No</th>
          <th class="text-center">Customer&nbsp;Name</th>              
          <th class="text-center">Customer&nbsp;Email</th>              
          <th class="text-center">Contact&nbsp;No</th>              
          <th class="text-center">Joining&nbsp;Date</th> 
          <th class="text-center">Actions</th>                                           
        </tr>
        <tbody><!-- table body for showing table values which showing customer details -->
          <?php
    //print_r($details); 
          $count=1;
          if($details['status']==1)
          {
            for($i = 0; $i < count($details['status_message']); $i++)
            { 
              echo '<tr class="text-center">
              <td class="text-center">'.$count.'</td>
              <td class="text-center">'.$details['status_message'][$i]['customer_name'].'</td>
              <td class="text-center">'.$details['status_message'][$i]['customer_email'].'</td>
              <td class="text-center">'.$details['status_message'][$i]['contact_no1'].'</td>
              <td class="text-center">'.$details['status_message'][$i]['joining_date'].'</td>
              <td class="text-center"><a class="btn w3-blue w3-medium w3-padding-small" title="UpdateCustomer" data-toggle="modal" data-target="#myModal_'.$details['status_message'][$i]['cust_id'].'" style="padding:0"><i class="fa fa-edit"></i></a>
              <a class="btn w3-red w3-medium w3-padding-small" title="DeleteCustomer" href="'.base_url().'inventory/Manage_customers/DeleteCustomerDetails?Customer_id='.$details['status_message'][$i]['cust_id'].'" style="padding:0"><i class="fa fa-close"></i></a>

              <script type="text/javascript">
              <!-- script is for showing country for select state  -->

              $(document).ready(function () {

                print_country("SelectUpdated_Country_'.$details['status_message'][$i]['cust_id'].'");
              //console.log(print_country);
              });
              <!-- script is for showing country for select state  -->
</script>

<script>
/*this script is used to update customer details*/

$(function(){
 $("#customerDetailsUpdatedForm_'.$details['status_message'][$i]['cust_id'].'").submit(function(){
   dataString = $("#customerDetailsUpdatedForm_'.$details['status_message'][$i]['cust_id'].'").serialize();

   $.ajax({
     type: "POST",
     url: "'.base_url().'inventory/Manage_customers/Update_CustomerDetails",
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


<div id="myModal_'.$details['status_message'][$i]['cust_id'].'" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title" id="msg_headernew">Customer Details</h4>
</div>
<div class="modal-body"> 

<form method="POST" action="" id="customerDetailsUpdatedForm_'.$details['status_message'][$i]['cust_id'].'" name="customerDetailsUpdatedForm_'.$details['status_message'][$i]['cust_id'].'">
<div class="w3-center">
<input type="hidden" class="" id="new_Cust_id" name="new_Cust_id" value="'.$details['status_message'][$i]['cust_id'].'">
</div>
<div class="">Personal Details</div><br>
<div class="row">

<div class="col-lg-2">
<label for="customerName" class="control-label">Customer&nbsp;Name:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_CustomerName" id="Updated_CustomerName" class="form-control" placeholder="Customer Name" value="'.$details['status_message'][$i]['customer_name'].'" required><br>
</div>

<div class="col-lg-2">
<label for="customerEmail" class="control-label">Customer&nbsp;Email:</label></div>
<div class="col-lg-4">
<input type="email" name="Updated_CustomerEmail" id="Updated_CustomerEmail" class="form-control" placeholder="Customer Email" value="'.$details['status_message'][$i]['customer_email'].'" required><br>
</div>

</div>


<div class="row">

<div class="col-lg-2">
<label for="country" class="control-label">Country:</label></div>
<div class="col-lg-4">
<select class="form-control" name="SelectUpdated_Country" id="SelectUpdated_Country_'.$details['status_message'][$i]['cust_id'].'" onchange ="print_state(\'SelectUpdated_State_'.$details['status_message'][$i]['cust_id'].'\', this.selectedIndex);" required>
<option> Select Country</option>
</select><br>
</div>

<div class="col-lg-2">
<label for="state" class="control-label">State:</label></div>
<div class="col-lg-4">
<select class="form-control" name="SelectUpdated_State" id="SelectUpdated_State_'.$details['status_message'][$i]['cust_id'].'" required>
<option>Select State</option>
</select><br>
</div>

</div>

<div class="row">
<div class="col-lg-2">
<label for="city" class="control-label">City:</label></div>
<div class="col-lg-4">
<input type="text" name="Update_City" id="Input_City" class="form-control" placeholder="Customer City" value="'.$details['status_message'][$i]['city'].'" required><br>
</div>
</div>

<div class="row">
<div class="col-lg-2">
<label for="contactNo1" class="control-label">Contact&nbsp;No1:</label></div>
<div class="col-lg-4">
<input type="number" name="Updated_ContactNo_one" id="Updated_ContactNo_one" class="form-control" value="'.$details['status_message'][$i]['contact_no1'].'" placeholder="Customer Contact No1" minlength="10" required><br>
</div>
<div class="col-lg-2">
<label for="contactNo2" class="control-label">Contact&nbsp;No2:</label></div>
<div class="col-lg-4">
<input type="number" name="Updated_ContactNo_two" id="Updated_ContactNo_two" class="form-control" value="'.$details['status_message'][$i]['contact_no2'].'" placeholder="Customer Contact No2" minlength="10" required><br>
</div>
</div>

<div class="">Bank Details</div><br>

<div class="row">
<div class="col-lg-2">
<label for="bankName" class="control-label">Bank&nbsp;Name:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_Bank_name" id="Updated_Bank_name" class="form-control" value="'.$details['status_message'][$i]['bank_name'].'" placeholder="Customer Bank Name" required><br>
</div>
<div class="col-lg-2">
<label for="bankAddress" class="control-label">Bank&nbsp;Address:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_Bank_Address" id="Updated_Bank_Address" class="form-control" value="'.$details['status_message'][$i]['bank_address'].'" placeholder="Customer Bank Address" required><br>
</div>
</div>

<div class="row">
<div class="col-lg-2">
<label for="bankAccno" class="control-label">Bank&nbsp;Account.No:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_Bank_AccNo" id="Updated_Bank_AccNo" class="form-control" value="'.$details['status_message'][$i]['account_no'].'" placeholder="Customer Account No" required><br>
</div>
<div class="col-lg-2">
<label for="ifscNo" class="control-label">IFSC&nbsp;Code:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_Bank_IFSC_Code" id="Updated_Bank_IFSC_Code" class="form-control" value="'.$details['status_message'][$i]['IFSC_no'].'" placeholder="Customer IFSC Code" required><br>
</div>
</div>


<div class="row">
<div class="col-lg-2">
<label for="micrNo" class="control-label">MICR&nbsp;Code:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_Bank_MICR_Code" id="Updated_Bank_MICR_Code" class="form-control" value="'.$details['status_message'][$i]['MICR_no'].'" placeholder="Customer MICR Code" required><br>
</div>
<div class="col-lg-2">
<label for="panNo" class="control-label">PAN&nbsp;NO:</label></div>
<div class="col-lg-4">
<input type="text" name="Updated_PAN_No" id="Updated_PAN_No" class="form-control" placeholder="Customer PAN No" value="'.$details['status_message'][$i]['PAN_no'].'" required><br>
</div>
</div>

<div class="row col-lg-3 col-lg-offset-8">
<button type="submit" class="btn btn-primary w3-padding w3-right" style="margin: 10px;">Update</button>
</div><br>
<div><br>
<div id="addProducts_errnew" name="addProducts_errnew">
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
 echo'<tr><td style="text-align: center;" colspan = "6">No Records Found...!</td></tr>';
}
?>
</tbody>
</table>
</div> 
</div>

</div>
</div>


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
        <button type="button" onclick= "window.location.reload();" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- script for reload page when modal is closed  -->
<script>
 $('#myModal').on('hidden.bs.modal', function () {
   location.reload();
 });
 </script>
 <!-- script for reload page when modal is closed  -->
</div>

