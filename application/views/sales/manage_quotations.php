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
  <link href="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">

  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
</head>
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
          <h6><b><i class="fa fa-hand-o-up"></i> Raise Quotation</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <form id="raiseQuote_form">
            <div class="w3-right checkbox w3-padding-right">
              <label title="Toggle the switch to revise old quotation">
                <input name="revise_quoteBtn" data-onstyle="danger" data-size="mini" id="revise_quoteBtn" type="checkbox" data-toggle="toggle" data-on="Revise Old" data-off="New" value="1">
              </label>
            </div>
            <div class="w3-col l12 w3-margin-bottom">
              <div class="w3-col l12 w3-padding" id="new_quoteDiv">
                <label>Customer List:</label>
                <select name="customer_name" id="customer_name" class="form-control">
                  <option class="w3-red" value="0">Select customer</option>
                  <?php 
                  if(isset($all_customer['status'])==0){
                    echo '<option>'.$all_customer['status_message'].'</option>';                    
                  }
                  else{
                    foreach ($all_customer['status_message'] as $key) {                  
                     echo '<option value="'.$key['cust_id'].'">'.$key['customer_name'].' <i class="w3-tiny">('.$key['customer_email'].')</i></option>';
                   }
                 }
                 ?>
               </select>
               <div class="w3-col l12">
                <a href="<?php echo base_url(); ?>inventory/add_customers"><span class="w3-tiny w3-right w3-text-red w3-label"><i class="fa fa-plus"></i> Add Customer</span></a>
              </div>
            </div>
            <div class="w3-col l12 w3-padding" id="revise_quoteDiv" style="display: none"></div>
            <div class="w3-col l6 w3-padding">
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
              <a href="<?php echo base_url(); ?>inventory/manage_products/add_products"><span class="w3-tiny w3-right w3-text-red w3-label"><i class="fa fa-plus"></i> Add Product</span></a>
            </div>
          </div>
          <div class="w3-col l2 w3-padding">
            <label>Cut :</label>
            <input class="form-control" type="number" id="quote_cut" name="quote_cut" placeholder="Cut" required>
          </div>
          <div class="w3-col l4 w3-padding ">
            <br>
            <a class="btn w3-small w3-text-blue" id="get_productSpecs_btn"><b><i class="fa fa-chevron-circle-down"></i> Get Specifications</b></a>
          </div>
        </div>

        <div id="product_specs">

        </div>
        <div id="more"></div>
        <button type="btn" id="moreBTN">ADD</button>
      </form>
    </div>
  </div>
  <div class="w3-col l6">
    <header class="w3-container" >
      <h6><b><i class="fa fa-file-text"></i> Quotation Details</b></h6>
      <span class="w3-small"></span>
    </header>
    <div class="w3-col l12 w3-small">
      <div class="w3-col l12 w3-padding">
        <label>Live Quotations List:</label>
        <select name="quotation_ToSend" id="quotation_ToSend" class="form-control">
          <option class="w3-red" value="0">Select quotation</option>
          <?php 
          if(isset($all_liveQuotations['status'])==0){
            echo '<option>'.$all_liveQuotations['status_message'].'</option>';                    
          }
          else{
            foreach ($all_liveQuotations['status_message'] as $key) {                  
             echo '<option value="'.$key['sub_quotation_id'].'">Quotation No.#Q'.$key['quotation_id'].'/'.$key['sub_quotation_id'].'- dated:'.$key['dated'].'</option>';
           }
         }
         ?>
       </select>

     </div>
     <div class="w3-col l12 " id="quotation_detailsDIV">

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
            $.alert(data);
             //$("#quotation_detailsDIV").html(data);                                     
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

<script>
  $(document).ready(function() {
    var max_fields=4;
    var wrapper         = $("#more"); 
    var add_button      = $("#moreBTN"); 

    var x = 1; 
    $(add_button).click(function(e){ 
      e.preventDefault();
      if(x < max_fields){ 
        x++; 
            $(wrapper).append('<label>Product List:</label><select class="form-control" id="product_id" name="product_id" ><option value="0">Select product</option><?php if(isset($all_products['status'])){echo '<option>'.$all_products['status_message'].'</option>';}else{foreach ($all_products as $key) {echo '<option value="'.$key['product_id'].'">'.$key['product_name'].'</option>';}}?></select><div class="w3-col l12"><a href="<?php echo base_url(); ?>inventory/manage_products/add_products"><span class="w3-tiny w3-right w3-text-red w3-label"><i class="fa fa-plus"></i> Add Product</span></a></div></div><div class="w3-col l2 w3-padding"><label>Cut :</label><input class="form-control" type="number" id="quote_cut" name="quote_cut" placeholder="Cut" required></div><div class="w3-col l4 w3-padding "><br><a class="btn w3-small w3-text-blue" id="get_productSpecs_btn"><b><i class="fa fa-chevron-circle-down"></i> Get Specifications</b></a></div></div><div id="product_specs"></div>'); //add input box
            
        }
        else
        {
          alert('You Reached the limits')   //alert when added more than 4 input fields
        }
    });

    $(wrapper).on("click",".delete", function(e){ 
      e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });
  
</script>
<!-- script ends -->
</body>
</html>
