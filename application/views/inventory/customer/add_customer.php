<?php include("header.php") ?>
<!-- This function is used for print country -->
<script type="text/javascript">
 $(document).ready(function () {
        print_country("Select_Country");
    });
</script>
<!-- This function is used for print country -->

<div class=" container w3-light-grey w3-padding">
  <div class="w3-right">
      <?php echo anchor("Manage_customers", 'Show&nbsp;Customer&nbsp;Details', ['class' => 'btn btn-primary']);?>
  </div>
</div>

<div class="container w3-light-grey" style="border:thin"> <!-- container starts here -->

<div class="w3-light-grey">
<form method="POST" action="" id="customerDetailsForm" name="customerDetailsForm"><!-- form Starts here -->
	<div class="w3-dark-grey">Personal Details</div><br>
 <div class="row">
    <div class="col-lg-2">
		<label for="CustomerName" class="control-label">Customer&nbsp;Name:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_CustomerName" id="Input_CustomerName" class="form-control" placeholder="Customer Name" required><br>
    </div>

    <div class="col-lg-2">
		<label for="CustomerEmail" class="control-label">Customer&nbsp;Email:</label></div>
		<div class="col-lg-4">
        <input type="email" name="Input_CustomerEmail" id="Input_CustomerEmail" class="form-control" placeholder="Customer Email" required><br>
    </div>
 </div>

 <div class="row">
    <div class="col-lg-2">
		<label for="Country" class="control-label">Country:</label></div>
		<div class="col-lg-4">
        <select class="form-control" name="Select_Country" id="Select_Country" onchange ="print_state('Select_State', this.selectedIndex);">
        <option>Select Country</option>
      </select><br>
    </div>

    <div class="col-lg-2">
		<label for="State" class="control-label">State:</label></div>
		<div class="col-lg-4">
        <select class="form-control" name="Select_State" id="Select_State">
        <option>Select State</option>
      </select><br>
    </div>
 </div>

 <div class="row">
  <div class="col-lg-2">
		<label for="City" class="control-label">City:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_City" id="Input_City" class="form-control" placeholder="Customer City" required><br>
    </div>
 </div>

<div class="row">
<div class="col-lg-2">
		<label for="ContactNo1" class="control-label">Contact&nbsp;No1:</label></div>
		<div class="col-lg-4">
        <input type="number" name="Input_ContactNo_one" id="Input_ContactNo_one" class="form-control" placeholder="Customer Contact No1" minlength="10" required><br>
    </div>
    <div class="col-lg-2">
		<label for="ontactNo2" class="control-label">Contact&nbsp;No2:</label></div>
		<div class="col-lg-4">
        <input type="number" name="Input_ContactNo_two" id="Input_ContactNo_two" class="form-control" placeholder="Customer Contact No2" minlength="10" required><br>
    </div>
</div>

<div class="w3-dark-grey">Bank Details</div><br>
<div class="row">
<div class="col-lg-2">
		<label for="BankName" class="control-label">Bank&nbsp;Name:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_Bank_name" id="Input_Bank_name" class="form-control" placeholder="Customer Bank Name" required><br>
    </div>
    <div class="col-lg-2">
		<label for="BankAddress" class="control-label">Bank&nbsp;Address:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_Bank_Address" id="Input_Bank_Address" class="form-control" placeholder="Customer Bank Address" required><br>
    </div>
</div>

<div class="row">
<div class="col-lg-2">
		<label for="BankAccNo" class="control-label">Bank&nbsp;Account.No:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_Bank_AccNo" id="Input_Bank_AccNo" class="form-control" placeholder="Customer Account No" required><br>
    </div>
    <div class="col-lg-2">
		<label for="IFSCCode" class="control-label">IFSC&nbsp;Code:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_Bank_IFSC_Code" id="Input_Bank_IFSC_Code" class="form-control" placeholder="Customer IFSC Code" required><br>
    </div>
</div>
 

<div class="row">
<div class="col-lg-2">
		<label for="MICRCode" class="control-label">MICR&nbsp;Code:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_Bank_MICR_Code" id="Input_Bank_MICR_Code" class="form-control" placeholder="Customer MICR Code" required><br>
    </div>
    <div class="col-lg-2">
		<label for="PANNo" class="control-label">PAN&nbsp;NO:</label></div>
		<div class="col-lg-4">
        <input type="text" name="Input_PAN_No" id="Input_PAN_No" class="form-control" placeholder="Customer PAN No" required><br>
    </div>
</div>

 <div class="row col-lg-3 col-lg-offset-5">
  <button type="submit" class="btn btn-primary w3-padding w3-center" style="margin: 10px;">Submit</button>
  <button type="reset" class="btn btn-default w3-padding w3-center" style="margin: 10px;">Reset</button>
 </div>

</form><!-- form Ends here -->

</div>
</div><!-- container ends here -->

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="msg_header"></h4>
      </div>
      <div class="modal-body">
        <div id="addProducts_err" name="addProducts_err"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php include("footer.php") ?>
<!-- This script is used to reload the page when popup close -->
<script>
  $('#myModal').on('hidden.bs.modal', function () {
    location.reload();
  });
</script>
<!-- This script is used to reload the page when popup close -->

<!-- This script is used to save customers information -->
<script>
$(function(){
   $("#customerDetailsForm").submit(function(){
     dataString = $("#customerDetailsForm").serialize();
     $.ajax({
       type: "POST",
       url: "<?php echo base_url();?>Add_customers/save_CustomerDetails",
       data: dataString,
           return: false,  //stop the actual form post !important!
           success: function(data)
           {
                $("#msg_header").text('Message');
                $("#msg_span").css({'color': "black"});
                $("#addProducts_err").html(data);                         
                $('#myModal').modal('show');
           }
         });
         return false;  //stop the actual form post !important!
       });
 });
</script>
<!-- This script is used to save customers information -->
