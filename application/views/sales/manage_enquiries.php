<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Generate Enquiries</title>
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
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/inventory/manage_enquiries.js"></script>
</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-files-o"></i> Manage Enquiries</b></h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l12 w3-small">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Add Enquiry</b></h6>
        </header>
        <div class="col-lg-2"></div>
        <div class="w3-col l8">
           <div class="w3-col l12 ">
          <div class="w3-col l6 w3-margin-bottom w3-padding-right">
            <label class="w3-label w3-text-black">Select Customer:</label>            
            <input list="Customerinfo" type="text" class="w3-input" name="customer_id" id="customer_id" placeholder="Search customer by customer name" required>
            <datalist id="Customerinfo">
              <?php foreach($all_customer['status_message'] as $result) { ?>
              <option data-value="<?php echo $result['cust_id']; ?>" value="<?php echo $result['customer_name']; ?>"><?php echo $result['customer_name']; ?></option>
              <?php } ?>
            </datalist>
          </div>
          <div class="col-lg-3"></div>

          <div class="w3-col l12 w3-margin-top">
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label w3-text-black">Product Name:</label>            
              <input type="text" class="w3-input" name="product_name" id="product_name" placeholder="Enter Product name here..." required></div>
            <div class="w3-col l6 w3-padding-right">
              <label class="w3-label w3-text-black">Select Product Profile:</label>            
              <input list="Profileinfo" type="text" class="w3-input" name="profile_id" id="profile_id" placeholder="Search Profile by profile name" required>
              <datalist id="Profileinfo">
              <?php foreach($all_profile['status_message'] as $result) { ?>
              <option data-value="<?php echo $result['profile_id']; ?>" value="<?php echo $result['profile_name']; ?>"><?php echo $result['profile_name']; ?></option>
              <?php } ?>
            </datalist>  
            </div>
          </div>

          <div class="w3-col l12">
            <div class="w3-col l12">
              <label class="w3-label w3-text-black"><input type="checkbox" name="housing_status" id="housing_status"> Select Product Profile:</label>            
            </div>
          </div>

        </div>
        </div>
        <div class="col-lg-2"></div>

       


      </div>
    </div>

    <!-- End page content -->
  </div>

  <!-- script to toggle i.e.hide/show revise and new quotation div -->
  <script>
    $(function() {
      $('#revise_quoteBtn').change(function() {
        $("#revise_quoteDiv").toggle();
      })
    })
  </script>
  <!-- script ends -->

  <!-- script to get customer specific live quotations when customer is selected -->
  <script>
    $(document).ready(function() {
      $('#customer_name').change(function() {

        var customer_name = $('#customer_name').val(); //customer name value
        
        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/getCustomer_quotations",
          data: 'customer_name='+ customer_name,
          cache: false,
          success: function(response) {
            $('#revise_quoteDiv').html(response);
          },
          error: function(xhr, textStatus, errorThrown) {
           alert('request failed'+errorThrown);
         }
       });

      });
    });
  </script>
  <!-- script ends -->

  <!-- script to get customer specific live quotations when customer is selected -->
  <script>
    $(document).ready(function() {
      $('#quotation_ToSend').change(function() {

        var quotation_ToSend = $('#quotation_ToSend').val(); //customer name value

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/quotationDetails",
          data: 'sub_quotationID='+ quotation_ToSend,
          cache: false,
          success: function(response) {
            $("#quotation_detailsDIV").html(response); 
          },
          error: function(xhr, textStatus, errorThrown) {
           alert('request failed'+errorThrown);
         }
       });

      });
    });
  </script>
  <!-- script ends -->
</body>
</html>
