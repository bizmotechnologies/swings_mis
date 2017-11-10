<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);

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
            <div class="w3-col l6 w3-padding-right">
              <label>Product List:</label>
              <select class="form-control" id="product_id" name="product_id" onchange="getProduct_details()">
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
            </div>
            <div class="w3-col l6 w3-padding-left">
              <label>Customer List:</label>
              <select class="form-control">
                <option value="0">Select customer</option>
              </select>
            </div>
          </div>

          <div id="product_specs"></div>
        </form>
      </div>
    </div>
    <div class="w3-col l6">
      <header class="w3-container" >
          <h6><b><i class="fa fa-file-text"></i> Quotation Details</b></h6>
          <span class="w3-small"></span>
      </header>
    </div>
  </div><div id="Input_MaterialStock"></div>
  <!-- End page content -->
</div>

<!-- script to Populate product specification when product is selected -->
<script>
function getProduct_details(){

  dataString ='product_id='+$("#product_id").val();

    $.ajax({
      type: "POST",
      url: "<?php echo base_url(); ?>orders/manage_quotations/productDetails",
      data: dataString,
      cache: false,
      success: function(data){
       $('#product_specs').html(data);
      } 
    });

}
</script>
<!-- script ends -->

</body>
</html>
