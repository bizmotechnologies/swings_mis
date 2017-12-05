<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Quotations</title>
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
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/function.js"></script>
</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l6 w3-border">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Raise Quotation</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <div class="w3-col l12 w3-padding-left">
            <?php //print_r($all_enquiries); ?>
            <label class="">Select Enquiry:</label>
            <div class="input-group">
              <span class="input-group-btn w3-light-grey w3-border-bottom">
                <strong><label class="w3-small">&nbsp;#ENQ NO :&nbsp;</label></strong>
              </span>
              <input list="enquiry_list" type="text" class="w3-input" name="enquiry_name" id="enquiry_name" placeholder="search by enquiry no. or customer name" required>
              <datalist id="enquiry_list">
                <?php foreach($all_enquiries['status_message'] as $result) { ?>
                <option data-value="<?php echo $result['enquiry_id']; ?>" value="<?php echo '#ENQ-0'.$result['enquiry_id']; ?>"><?php echo $result['customer_name']; ?> (dated: <?php echo $result['date_on']; ?>)</option>                  
                <?php } ?>
              </datalist>
            </div>

          </div>
        </div>
      </div>
      <div class="w3-col l6">
        <header class="w3-container" >
          <h6><b><i class="fa fa-file-text"></i> Quotation Details</b></h6>
          <span class="w3-small"></span>
        </header>
        <div class="w3-col l12 w3-small"></div>
      </div>
    </div>

    <div id="Input_MaterialStock"></div>
    <!-- End page content -->
  </div>
  <!-- script to delete product -->
  <script>
    function delProduct(id)
    {

     $.ajax({
      type:'post',
      url:'<?php echo base_url(); ?>sales_enquiry/manage_quotations/delProducts_fromSession',
      data:{
        delete_product_id:id  },
        success:function(response) {
          alert(response);
      //location.reload();
    }
  });
   }
 </script>
 <!-- script end -->

 <!-- script to add products in array  -->
 <script>
   function addProducts() {
        var product_id = $('#product_id').val(); //product name value
        var cut_value = $('#quote_cut').val(); //product cut value
        var quote_ID = $('#quote_ID').val(); //product ID value
        var quote_OD = $('#quote_OD').val(); //product OD value
        var quote_thickness = $('#quote_thickness').val(); //product thickness value
        var quote_price = $('#quote_price').val(); //product price value
        var quote_tolerance = $('#quote_tolerance').val(); //product tolerance value

        if(quote_ID==''||quote_OD==''||quote_thickness==''||quote_price==''||quote_tolerance==''){
          msg='<h4 class="w3-text-red"><i class="fa  fa-info-circle"></i> WARNING</h4><label class="w3-text-grey w3-label w3-small">       <strong>Please fill all the specifications of product. </strong></label>';
          $.alert(msg);
          return false;
        }
        var data = {
          product_id:product_id,
          cut_value:cut_value,
          quote_ID:quote_ID,
          quote_OD:quote_OD,
          quote_thickness:quote_thickness,
          quote_price:quote_price,
          quote_tolerance:quote_tolerance
        };

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/addProducts_toSession",
          data: data,
          cache: false,
          success: function(response) {
            $('#all_productSession').html(response);

            $('#quote_ID').val('');
            $('#quote_OD').val(''); 
            $('#quote_thickness').val(''); 
            $('#quote_price').val('');
            $('#quote_tolerance').val(''); 
          },
          error: function(xhr, textStatus, errorThrown) {
           alert('request failed'+errorThrown);
         }
       });
      }
    </script>
    <!-- script ends -->

    <!-- script to get product specifications and calculated price -->
    <script>
      $(document).ready(function() {
        $('#get_productSpecs_btn').click(function() {

        var product_id = $('#product_id').val(); //where #table could be an input with the name of the table you want to truncate
        var cut_value = $('#quote_cut').val(); //where #table could be an input with the name of the table you want to truncate

        $("#product_specs").html('<center><img width="70%" height="auto" src="<?php echo base_url(); ?>css/logos/page_spinner3.gif" /></center>');

        $.ajax({
          type: "POST",
          url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/productDetails",
          data: 'product_id='+ product_id +'&cut_value='+ cut_value,
          cache: false,
          success: function(response) {
            $('#product_specs').html(response);
          },
          error: function(xhr, textStatus, errorThrown) {
           alert('request failed'+errorThrown);
         }
       });

      });
      });
    </script>
    <!-- script ends -->

    <!--     script to raise quotation   -->
    <script>
     $(function(){
       $("#raiseQuote_form").submit(function(){
         dataString = $("#raiseQuote_form").serialize();

         $.ajax({
           type: "POST",
           url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/generate_quotation",
           data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {

             location.reload();
           }

         });
         return false;  //stop the actual form post !important!

       });
     });
   </script>
   <!-- script ends here -->

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
