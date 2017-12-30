<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
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
      <h5><b><i class="fa fa-files-o"></i> Report For</b>
          <b >Enquiry to Work Order </b>
      </h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l7">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> </b></h6>
          <span class="w3-small"></span>
        </header>
        <div class="w3-col l12 w3-padding-left w3-padding-top">
            <div class="w3-col l12">
              <div class="w3-col l10">
                <form id="report_filter">
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
                      <input list="customerName_list" id="filter_customerName" name="filter_customerName" class="form-control" placeholder="Customers..." onchange="show_data();">
                      <datalist id="customerName_list">
                        <?php foreach ($all_customer['status_message'] as $result) { ?>
                        <option data-value="<?php echo $result['cust_id'] ?>" value='<?php echo $result['customer_name']; ?>'></option>
                        <?php } ?>
                      </datalist>
                      <span class="input-group-btn">
                        <button class="btn btn-secondary w3-blue" name="filter_quoteBtn" id="filter_quoteBtn" type="submit" title="Filter Quotations"><i class="fa fa-filter"></i></button>
                      </span>
                    </div>                      
                  </div>
                </form>
              </div>
              <div class="w3-col l2">
                <div class="w3-col l12 w3-padding-right">
                  <label class="w3-label">Sort By:</label>
                  <select class="form-control" id="Sort_by_branch" name="Sort_by_branch" onchange="sort_byBranch();">
                    <option value="PUNE">PUNE</option>
                    <option value="BANGALORE">BANGALORE</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
       
        <div class="w3-col l12 w3-padding-left">
          <div class="w3-col l12 w3-margin-top">
            <div class="" id="ShowRaw_products" name="ShowRaw_products">

              <table class="table table-bordered table-responsive w3-small">            <!-- table starts here -->
                <tr class="w3-black">
                  <th class="text-center">Sr No.</th>
                  <th class="text-center">Quotation No.</th>
                  <th class="text-center">Enquiry No.</th>
                  <th class="text-center">Branch name</th>
                   <th class="w3-center">Customer Name</th>              
                  <th class="w3-center">Enquiry Raised Date</th>              
                  <th class="w3-center">Work Order Raised Date</th>              
                  <th class="w3-center">Days Taken</th>             
                                                 
                </tr>
              <tbody id="sortdatafrom_enquiry_quotation">
                
                </tbody> 
              </table>   <!-- table closed here -->
            </div>
          </div>
        </div>
      </div>
      <div class="w3-col l7 w3-margin-top w3-padding-left">
        <div class="w3-col l12 w3-small w3-margin-top">
          <div class="w3-col l12 w3-margin-top">
            <div class= "w3-margin-top" id="wo_details">
            </div> 
          </div>
        </div>
      </div>
    </div>
  </div>
 
  <script>
    $(function(){
     $("#report_filter").submit(function(){

      dataString = $("#report_filter").serialize();
      //alert(dataString);
      // $("#sortdatafrom_womaster_quotation").html('<center><img width="50%" height="auto" src="'+BASE_URL+'css/logos/page_spinner3.gif"/></center>');

      $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>/Report/Enquiry_report_controller/get_all_data",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
           // alert(data);
             $('#sortdatafrom_enquiry_quotation').html(data);
           }

         });
         return false;  //stop the actual form post !important!

       });
   });
 </script>


<script>
  function show_data(){

    customer_id = $('#customerName_list [value="' + $('#filter_customerName').val() + '"]').data('value');
    $('#customer_idFilter').val(customer_id);
  }
</script>

<script>
    //---------this fun is used to sort by status--------------------------------//
    function sort_byBranch(){
      
       customer_id = $('#customerName_list [value="' + $('#filter_customerName').val() + '"]').data('value');
      From_date = $('#filter_fromDate').val();
      To_date = $('#filter_toDate').val();
      Sort_by_branch = $('#Sort_by_branch').val();
    // alert(customer_id);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>Report/Enquiry_report_controller/sort_byBranch",
        data: {
          cust_id: customer_id,
          From_date: From_date,
          To_date: To_date,
          Sort_by_branch: Sort_by_branch
        },
        cache: false,
        success: function (data) {
         //alert(data);
          $('#sortdatafrom_enquiry_quotation').html(data);
        }
      });
    }
    //---------this fun is used to sort by status--------------------------------//

  </script>
</body>
</html>
