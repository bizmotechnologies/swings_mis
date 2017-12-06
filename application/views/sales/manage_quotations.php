<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);
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
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/sales/manage_quotation.js"></script>

</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-files-o"></i> Manage Quotations</b></h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l5">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Raise Quotation</b></h6>
          <span class="w3-small"></span>
        </header>

        <div class="w3-col l12 w3-padding w3-small">
          <div class="w3-col l12 w3-padding-left w3-padding-right">
            <?php //print_r($all_enquiries); ?>
            <label class="">Select Enquiry:</label>
            <div class="input-group">
              <span class="input-group-btn w3-light-grey w3-border-bottom">
                <strong><label class="w3-small">&nbsp;#ENQ NO :&nbsp;</label></strong>
              </span>
              <input list="enquiry_list" type="text" class="w3-input" name="enquiry_name" id="enquiry_name" placeholder="search by enquiry no. or customer name" onchange="Show_Enquiry()" required>
              <datalist id="enquiry_list">
                <?php foreach($all_enquiries['status_message'] as $result) { ?>
                <option data-value="<?php echo $result['enquiry_id']; ?>" value="<?php echo '#ENQ-0'.$result['enquiry_id']; ?>"><?php echo $result['customer_name']; ?> (dated: <?php echo $result['date_on']; ?>)</option>                  
                <?php } ?>
              </datalist>
            </div>
          </div>

          <form id="send_quotationForm" name="send_quotationForm" >
            <div class="w3-col l12 w3-margin-top w3-padding-right" id="fetched_enquiryDetails"></div>
          </form>
        </div>
      </div>
      <div class="w3-col l7">
        <header class="w3-container" >
          <h6><b><i class="fa fa-file-text"></i> Quotation Details</b></h6>
          <span class="w3-small"></span>
        </header>
        <div class="w3-col l12 w3-small">
          <div class="w3-col l12">
            <div class="w3-col l12">
              <!-- div for filtering table data||| still in construction -->
            </div>
            <div class="w3-col l12">

              <div id="quotation_table" class="w3-col l12">
                <table class="table table-bordered w3-table-all w3-card-4" ><!-- table starts here -->
                  <tr style="background-color:black; color:white;" >
                    <th class="text-center">Sr. No</th>
                    <th class="text-center">Enquiry No.</th>              
                    <th class="text-center">Quotation No.</th>              
                    <th class="text-center">Raised on</th>              
                    <th class="text-center">Delivery&nbsp;within</th>              
                    <th class="text-center">Current Status</th> 
                    <th class="text-center">#</th>                                           
                  </tr>

                  <?php 
                  $count=1;
                  foreach ($all_liveQuotes['status_message'] as $key) {

                    $date=date('d M Y', strtotime($key['dated']));
                    $time=date('h:m A', strtotime($key['time_at']));

                    $current_stat='live';
                    $color='w3-green';

                    if($key['current_status']=='2'){
                      $current_stat='In PO';
                      $color='w3-blue';
                    }

                    echo                    
                    '<tr>
                    <td class="text-center">'.$count.'</td>
                    <td class="text-center">#ENQ-0'.$key['enquiry_id'].'</td>
                    <td class="text-center">#QUO-0'.$key['quotation_id'].'</td>
                    <td class="text-center">'.$date.'<br>'.$time.'</td>
                    <td class="text-center">'.$key['delivery_within'].'</td>
                    <td class="text-center"><span class="'.$color.' w3-padding-tiny w3-round">'.$current_stat.'</span></td>
                    <td>
                    <a class="btn w3-small" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn w3-small" data-toggle="modal" data-target="#"><i class="fa fa-times"></i></a></td>
                    </tr>
                    ';
                    $count++;
                  }
                  ?>
                </table>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="Input_MaterialStock"></div>
    <!-- End page content -->
  </div>

  <!--     script to raise quotation   -->
  <script>
   $(function(){
     $("#send_quotationForm").submit(function(){

       dataString = $("#send_quotationForm").serialize();
       $("#fetched_enquiryDetails").html('<center><img width="70%" height="auto" src="'+BASE_URL+'css/logos/mail_loader.gif"/></center>');

       $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>sales_enquiry/manage_quotations/raise_quotation",
         data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {

             $('#fetched_enquiryDetails').html(data);
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
