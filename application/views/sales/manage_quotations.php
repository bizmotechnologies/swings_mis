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
<!--  <script type="text/javascript" src="<?php echo base_url(); ?>css/calender/dhtmlxcalendar.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/calender/dhtmlxcalendar.css"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/calender/dhtmlxcalendar_deprecated.js"></script>-->
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/sales/manage_quotation.js"></script>
  <style type="text/css">
  input[type=date]::-webkit-inner-spin-button, 
  input[type=date]::-webkit-outer-spin-button { 
    -webkit-appearance: none; 
  }

  input[type=date] {
    -moz-appearance: textfield;
    margin: 0;
  }
</style>
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
            <label class="w3-label">Select Enquiry:</label>
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
            <div class="w3-col l12 w3-tiny"><span class="w3-text-red w3-right">*The Enquiries listed above are all Live Enquiries. Empty list indicates no Live Enquiries left.</span></div>
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
          <div class="w3-col l12 ">
            <div class="w3-col l12 w3-padding-left w3-padding-top">
              <div class="w3-col l12">
                <div class="w3-col l10">
                  <form id="quotation_filter">
                    <div class="w3-col l4 w3-padding-right">
                      <label class="w3-label">From Date:</label>
                      <input type="date" class="form-control" name="filter_fromDate" id="filter_fromDate" required>
                    </div>
                    <div class="w3-col l4 w3-padding-right">
                      <label class="w3-label">Till Date:</label>
                      <input type="date" class="form-control" name="filter_toDate" id="filter_toDate" required>
                    </div>
                    <div class="w3-col l4 w3-padding-right">
                      <label class="w3-label">Search Customer:</label>
                      <div class="input-group">
                        <input type="hidden" name="customer_idFilter" id="customer_idFilter">
                        <input list="customerName_list" id="filter_customerName" name="filter_customerName" class="form-control" placeholder="Customers..." onchange="getCustomerId();">
                        <datalist id="customerName_list">
                          <?php foreach ($all_customer['status_message'] as $result) { ?>
                          <option data-value="<?php echo $result['cust_id']; ?>" value='<?php echo $result['customer_name']; ?>'></option>
                          <?php } ?>
                        </datalist>
                        <span class="input-group-btn">
                          <button class="btn btn-secondary w3-blue" name="filter_quoteBtn" id="filter_quoteBtn" type="submit" title="Filter"><i class="fa fa-filter"></i></button>
                        </span>
                      </div>                      
                    </div>
                  </form>
                </div>
                <div class="w3-col l2">
                  <div class="w3-col l12 w3-padding-right">
                    <label class="w3-label">Sort By:</label>
                    <select class="form-control" id="Sort_by" name="Sort_by" onchange="sort_byStatus();">
                      <option value="1">LIVE</option>
                      <option value="2">PO</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
              <!-- <form>
            <div class="w3-col l12 w3-padding">
              <div class="w3-col l3">
                  <label class="w3-center">From Date</label>
                  <input type="date" class="w3-input" id="From_date" name="From_date" required>
              </div>
              <div class="w3-col l3 padding-left">
                  <label class="w3-center">To Date</label>
                  <input type="date" class="w3-input" id="To_date" name="To_date" required>
              </div>
              <div class="w3-col l3 padding-left">
                  <label class="w3-center">Customer name</label>
                  <input list="CustomerFilter" id="Customer_nameForFilter" name="Customer_nameForFilter" class="w3-input" placeholder="Customer Name" >
                  <datalist id="CustomerFilter">
                      <?php foreach ($all_customer['status_message'] as $result) { ?>
                          <option data-value="<?php echo $result['cust_id']; ?>" value='<?php echo $result['customer_name']; ?>'></option>
                      <?php } ?>
                  </datalist>
              </div>
              <div class="w3-col l1 padding-left">
                  <button type="submit" class="btn w3-blue w3-margin-top w3-center" id="quotation_filter" name="quotation_filter">Sort</button>
              </div>
              <div class="w3-col l2">
                  <label class="w3-center">Status</label>
                  <select class="w3-input" id="Sort_by" name="Sort_by" onchange="sort_byStatus();">
                      <option value="1">LIVE</option>
                      <option value="2">PO</option>
                  </select>
              </div>
            </div>
          </form> -->
          <div class="w3-col l12" id="Show_quotationsTable">
            <hr class="w3-margin-right w3-margin-left">
            <div id="quotation_table" class="w3-col l12 w3-padding">
              <table class="table table-bordered table-responsive w3-small" ><!-- table starts here -->
                <tr style="background-color:black; color:white;" >
                  <th class="w3-center">Sr. No</th>
                  <th class="w3-center">Quotation No.</th>              
                  <th class="w3-center">Enquiry No.</th>              
                  <th class="w3-center">Customer</th>              
                  <th class="w3-center">Raised on</th>              
                  <th class="w3-center">Delivery within</th>              
                  <th class="w3-center">Current Status</th> 
                  <th class="w3-center">#&nbsp;Actions</th>                                           
                </tr>
                <?php 
                $count=1; 
                if($all_liveQuotes['status']==0){
                  echo '<div class="alert alert-danger">
                  <strong>'.$all_liveQuotes['status_message'].'</strong> 
                  </div>';
                }
                else
                {
                  foreach ($all_liveQuotes['status_message'] as $key) {
                    $date=date('d/m/y', strtotime($key['dated']));
                    $delivery_values=explode(' ', $key['delivery_within']);
                    $customer_id=$key['customer_id'];
                    $customer_name=$key['customer_name'];
                    $quotation_id=$key['quotation_id'];

                    $current_stat='live';
                    $color='w3-green';
                    $hide='';

                    if($key['current_status']=='2'){
                      $current_stat='In PO';
                      $color='w3-red';
                      $hide='w3-hide';
                    }

                    echo                    
                    '<tr class="">
                    <td class="w3-center">'.$count.'.</td>
                    <td class="w3-center">#QUO-0'.$quotation_id.'</td>
                    <td class="w3-center">#ENQ-0'.$key['enquiry_id'].'</td>
                    <td class="w3-center">'.ucwords($customer_name).'</td>
                    <td class="w3-center">'.$date.'</td>
                    <td class="w3-center">'.$key['delivery_within'].'</td>
                    <td class="w3-center"><span class="'.$color.'  w3-padding-small w3-round">'.$current_stat.'</span></td>
                    <td>
                    <div class="w3-col l12 w3-text-grey">
                    <a class="btn w3-medium" style="padding:0px;" data-toggle="modal" data-target="#viewQuote_modal_'.$key['quotation_id'].'" title="View Quotation"><i class="fa fa-eye"></i></a>

                    <a class="btn w3-medium '.$hide.'" style="padding:0px;" onclick="send_ToPO('.$quotation_id.');" title="Send to PO"><i class="fa fa-sign-out"></i></a>

                    <a class="btn w3-medium" style="padding:0px;" onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.')" title="Send To Client"><i class="fa fa-envelope"></i></a>
                    </div>                      
                    </td>
                    </tr>
                    ';
                      //onclick="send_mail('.$customer_id.',\''.$customer_name.'\','.$quotation_id.');"---- code for mail sending
                    $count++;

                    echo '
                    <!-- Modal start  --> 
                    <div id="viewQuote_modal_'.$key['quotation_id'].'" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content w3-col l12">
                    <div class="modal-header w3-blue">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="w3-text-white">Quotation No: #QUO-0'.$key['quotation_id'].'</span></h4>
                    </div>
                    <div class="modal-body">';
                    $products_associatedArr= json_decode($key['product_associated'],true);

                    $enquiry_no=$key['enquiry_id'];
                    $customer_id=$key['customer_id'];
                    $customer_name=$key['customer_name'];
                    $date=date('d M Y', strtotime($key['dated']));
                    $time=date('h:m A', strtotime($key['time_at']));

                    $product_arr=array();
      //print_r($products_associatedArr);die();

                    echo '
                    <div class="w3-col l12 w3-margin-bottom">
                    <div class="checkbox">
                    <label title="Toggle the switch to raise this quotation" class="">
                    <input name="revise_quoteBtn" data-onstyle="danger" data-size="mini" id="revise_quoteBtn_'.$key['quotation_id'].'" type="checkbox" data-toggle="toggle" data-on="ON" data-off="OFF" value="1">
                    <b>Toggle to Revise Quotation</b>
                    </label>                           
                    </div>
                    </div>                      
                    <div class="w3-col l12 w3-small" id="view_quoteDiv_'.$key['quotation_id'].'">
                    <div class="w3-col l12 w3-margin-bottom">
                    <div class="w3-left">
                    <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                    <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                    </div>
                    <div class="w3-right">
                    <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                    </div>
                    </div>

                    <div class="w3-col l12 w3-margin-bottom">
                    <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                    <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                    </div>

                    <div class="w3-col l12 w3-margin-bottom">
                    <label class="w3-label w3-text-red">Products:</label>

                    <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                    foreach ($products_associatedArr as $value) { 
                      echo '
                      <li>'.strtoupper($value['product_name']).' -';

                      if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                      echo '
                      </li>
                      <ol>
                      <i>
                      <li>'.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                      if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                      echo '@ '.$value['product_price'].' <i class="fa fa-inr"></i> per NO</li>
                      </i>
                      </ol>
                      <br>
                      ';
                    } 
                    echo '</ol>              
                    </div>
                    <div class="w3-col l12 w3-margin-bottom">
                    <label class="w3-label w3-text-red">Delivery within: '.$key['delivery_within'].'</label><br>

                    </div></div><br>';

                    echo '
                    <form id="revise_quoteForm_'.$key['quotation_id'].'">
                    <div class="w3-col l12 w3-small" id="revise_quoteDiv_'.$key['quotation_id'].'" style="display:none">
                    <div class="w3-col l12 w3-margin-bottom">
                    <div class="w3-left">
                    <label class="w3-label w3-text-red">Enquiry No:</label> <span class="">#ENQ-0'.$enquiry_no.'</span>
                    <input type="hidden" value="'.$enquiry_no.'" name="enquiry_id" name="enquiry_id">
                    </div>
                    <div class="w3-right">
                    <label class="w3-label w3-text-red">Issued On:</label> <span class="">'.$date.', '.$time.'</span>
                    </div>
                    </div>

                    <div class="w3-col l12 w3-margin-bottom">
                    <label class="w3-label w3-text-red">Customer Name:</label> <span class="">'.$customer_name.' (#CID-0'.$customer_id.')</span>
                    <input type="hidden" value="'.$customer_id.'" name="customer_id" name="customer_id">

                    </div>

                    <div class="w3-col l12 w3-margin-bottom">
                    <label class="w3-label w3-text-red">Products:</label>

                    <ol type="I" style="margin: 0">';

        //--------------------------all the products fetched from enquiry----------------------//
                    foreach ($products_associatedArr as $value) { 
                      echo '
                      <li>'.strtoupper($value['product_name']).' -';

                      if($value['housing_status']==1){ echo $value['housing_setQuantity'].' SETS'; } else { echo '1 SET'; }

                      echo '
                      </li>
                      <ol>
                      <i>
                      <li>
                      '.ucwords($value['profile_description'][0]).'- '.strtoupper($value['profile_id']).'- '.$value['Prod_ID'][0].'mm ID X '.$value['Prod_OD'][0].'mm OD X '.$value['Prod_length'][0].'mm THICK -';

                      if($value['housing_status']==1){ echo '1 NO.'; } else { echo $value['product_quantity'].' NO.'; }

                      echo '@ 
                      <div class="input-group w3-small" style="width:200px">
                      <input name="revise_productPrice[]" type="number" class="form-control" step="0.01" min="0" value="'.$value['product_price'].'">
                      <span class="input-group-addon"><i class="fa fa-inr"></i> per NO</span>
                      </div>                        
                      </li>
                      </i>
                      </ol>
                      <br>
                      ';
                    } 
                    echo '</ol>              
                    </div>
                    <div class="w3-col l12 w3-margin-bottom">
                    <div class="w3-col l12">
                    <label class="w3-label w3-text-red">Delivery within:</label>
                    <input type="number" name="revise_deliverySpan" class="form-control w3-padding-right" style="width:80px" min="0" value="'.$delivery_values[0].'">
                    <select class="w3-input" style="width:120px" name="revise_deliveryPeriod">
                    <option '; if($delivery_values[1]=='day/days'){ echo 'selected'; } echo ' value="1">day/days</option>
                    <option '; if($delivery_values[1]=='week/weeks'){ echo 'selected'; } echo ' value="2">week/weeks</option>
                    <option '; if($delivery_values[1]=='month/months'){ echo 'selected'; } echo ' value="3">month/months</option>
                    <option '; if($delivery_values[1]=='year/years'){ echo 'selected'; } echo ' value="4">year/years</option>
                    </select>
                    </div> 
                    <button class="btn w3-button btn-block w3-red w3-margin-top w3-margin-bottom" type="submit" id="send_quote" name="send_quote">Revise Quotation For Enquiry #ENQ-0'.$enquiry_no.'</button>                     
                    <br>
                    </form>
                    </div><br>
                    </div>';
      //------------------------------products fetched end ----------------------------------//
                    echo '</div>
                    <br><br>

                    </div>
                    <!-- //Modal End  -->
                    <!-- script to toggle i.e.hide/show revise and new quotation div -->
                    <script>
                    $(function() {
                      $("#revise_quoteBtn_'.$key['quotation_id'].'").change(function() {
                        if ($("#revise_quoteBtn_'.$key['quotation_id'].'").is(":checked")) {
                          $("#revise_quoteDiv_'.$key['quotation_id'].'").show();
                          $("#view_quoteDiv_'.$key['quotation_id'].'").hide();
                        }
                        else{
                          $("#revise_quoteDiv_'.$key['quotation_id'].'").hide();
                          $("#view_quoteDiv_'.$key['quotation_id'].'").show();        
                        }
                      })
                    })
                    </script>
                    <!-- script ends -->

                    <!--     script to add revised quotation     -->
                    <script>
                    $(function(){
                      $("#revise_quoteForm_'.$key['quotation_id'].'").submit(function(){
                       dataString = $("#revise_quoteForm_'.$key['quotation_id'].'").serialize();

                       $.ajax({
                         type: "POST",
                         url: "'.base_url().'sales_enquiry/manage_quotations/getEnquiry_DetailsFor_MultipleQuotation",
                         data: dataString,
                         return: false,  //stop the actual form post !important!

                         success: function(data)
                         {
                           $.alert(data);                                     
                         }

                       });
                       return false;  //stop the actual form post !important!

                     });
                   });
                   </script>
                   <!-- script ends here -->
                   ';
                 }
               }
               ?>
             </table>
           </div> 


           <!-- revise quotation div start -->
           <div class="w3-col l12">

           </div>
           <!-- revise quotation div end -->

         </div>
       </div>
     </div>
   </div>
 </div>

 <div id="Input_MaterialStock"></div>
 <!-- End page content -->
</div>

<script>
  function getCustomerId(){

    customer_id = $('#customerName_list [value="' + $('#filter_customerName').val() + '"]').data('value');
    $('#customer_idFilter').val(customer_id);
  }
</script>

<!--  Script to delete item from order list............................
--> 
<script type="text/javascript">
  function send_mail(customer_id,customer_name,quotation_id)
  {

    $.confirm({
      title: '<label class="w3-large w3-text-red"><i class="fa fa-envelope"></i> Send Quotation to Customer.</label>',
      content: '<span class="w3-medium">Do You really want to send this quotation to customer?</span>',
      buttons: {
        confirm: function () {
          $.ajax({
            type:'post',
            url:BASE_URL+'sales_enquiry/manage_quotations/sendMail',
            data:{
              customer_id:customer_id,
              customer_name:customer_name,
              quotation_id:quotation_id
            },
            success:function(response) {
              $.alert(response);
            }
          });
        },
        cancel: function () {}
      }
    });
  }
</script>
<!-- script to send mail ends -->

<!--  Script to delete item from order list............................
--> 
<script type="text/javascript">
  function send_ToPO(quotation_id)
  {

    $.confirm({
      title: '<label class="w3-large w3-text-red"><i class="fa fa-envelope"></i> Send Quotation to Purchase Order.</label>',
      content: '<span class="w3-medium">Do You really want to send #QUO-0'+quotation_id+' to Purchase Order ?</span>',
      buttons: {
        confirm: function () {
          $.ajax({
            type:'post',
            url:BASE_URL+'sales_enquiry/manage_quotations/sendTo_PO',
            data:{
              quotation_id:quotation_id
            },
            success:function(response) {
              $.alert(response);
            }
          });
        },
        cancel: function () {}
      }
    });
  }
</script>
<!-- script to send mail ends -->


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
<script>
    //---------this fun is used to sort by status--------------------------------//
    function sort_byStatus(){
      customer_id = $('#customer_idFilter').val();
      From_date = $('#filter_fromDate').val();
      To_date = $('#filter_toDate').val();
      Sort_by = $('#Sort_by').val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>sales_enquiry/Sort_Enquiries_Quotations/sort_byStatus",
        data: {
          customer_id: customer_id,
          From_date: From_date,
          To_date: To_date,
          Sort_by: Sort_by
        },
        cache: false,
        success: function (data) {
          //alert(data);
          $('#Show_quotationsTable').html(data);
        }
      });
    }
    //---------this fun is used to sort by status--------------------------------//

  </script>
  

  <!--     script to filter quotation   -->
  <script>
    $(function(){
     $("#quotation_filter").submit(function(){

      dataString = $("#quotation_filter").serialize();
      $("#Show_quotationsTable").html('<center><img width="50%" height="auto" src="'+BASE_URL+'css/logos/page_spinner3.gif"/></center>');

      $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>sales_enquiry/Sort_Enquiries_Quotations/filter_quotation",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {

             $('#Show_quotationsTable').html(data);
           }

         });
         return false;  //stop the actual form post !important!

       });
   });
 </script>
 <!-- script ends here -->
</body>
</html>
