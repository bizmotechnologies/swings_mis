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
<!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script>
--></head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l6">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Raise New Quotation</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <form id="raiseQuote_form">
            <div class="w3-col l12 w3-margin-bottom">
              <div class="w3-col l12 w3-padding">
                <label>Customer List:</label>
                <select class="form-control">
                  <option value="0">Select customer</option>
                </select>
                <div class="w3-col l12">
                  <span class="w3-small w3-right w3-text-red w3-label"><i class="fa fa-plus"></i> Add Customer</span>
                </div>
              </div>
              <div class="w3-col l8 w3-padding">
                <label>Product List:</label>
                <select class="form-control" id="product_id" name="product_id" >
                  <option value="0">Select product</option>
                  <?php 
                  if(isset($all_products['status'])){
                    echo '<option>'.$all_products['status_message'].'</option>';                    
                  }
                  else{
                    foreach ($all_products as $key) {                  
                     echo '<option value="'.$key['product_id'].'">'.$key['product_name'].'</option>';
                   }
                 }
                 ?>
               </select>
               <div class="w3-col l12">
                <span class="w3-small w3-right w3-text-red w3-label"><i class="fa fa-plus"></i> Add Product</span>
              </div>
            </div>
            <div class="w3-col l4 w3-padding">
              <label>Cut :</label>
              <input class="form-control" type="number" id="quote_cut" name="quote_cut" placeholder="Cut" required>
            </div>
            <div class="w3-col l12 w3-padding">
              <button type="button" class="w3-right btn w3-blue" id="get_productSpecs_btn">Get Specifications</button>
            </div>
          </div>

          <div id="product_specs">
            
          </div>
        </form>
      </div>
    </div>
    <div class="w3-col l6">
      <header class="w3-container" >
        <h6><b><i class="fa fa-file-text"></i> Quotation Details</b></h6>
        <span class="w3-small"></span>
      </header>
      <div class="w3-col l12">
        <div class="w3-col l12" id="quotation_detailsDIV">
          
        </div>
      </div>
    </div>
  </div><div id="Input_MaterialStock"></div>
  <!-- End page content -->
</div>

<!-- script to get product specifications and calculated price -->
<script>
  $(document).ready(function() {
    $('#get_productSpecs_btn').click(function() {

        var product_id = $('#product_id').val(); //where #table could be an input with the name of the table you want to truncate
        var cut_value = $('#quote_cut').val(); //where #table could be an input with the name of the table you want to truncate

        //$("#product_specs").html('<center><img width="70%" height="auto" src="<?php echo base_url(); ?>css/logos/page_spinner3.gif" /></center>');

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

<!--     script to add role     -->
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
             $("#quotation_detailsDIV").html(data);                                     
           }

         });
         return false;  //stop the actual form post !important!

       });
 });
</script>
<!-- script ends here -->
</body>
</html>
