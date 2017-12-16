<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Work Order</title>
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
      <h5><b><i class="fa fa-files-o"></i> Manage Work Order</b></h5>
    </header>

    <div class="w3-container">
      <div class="w3-col l4">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Raise Work Order</b></h6>
          <span class="w3-small"></span>
        </header>
        <div class="w3-col l12 w3-padding-left">
          <div class="w3-col l12 w3-margin-top">
            <div class="" id="ShowRaw_products" name="ShowRaw_products">
              <table class="table table-bordered table-responsive w3-small">            <!-- table starts here -->
                <tr class="w3-black">
                  <th class="text-center">Sr No.</th>
                  <th class="text-center">Work Order No.</th>
                  <th class="text-center">Quotation No.</th>              
                  <th class="text-center"> Issued On</th>              
                  <th class="text-center">#</th>                                           
                </tr>
                <?php  
                if($wo_info['status']==1){
                  $count=1;
                  foreach ($wo_info['status_message'] as $row)  
                  {  
                    $time=date('h:i a', strtotime($row['time_on']));
                    $date=date('d/m/Y',strtotime($row['dated']));                       
                    ?><tr>  
                      <td class="text-center"><?php echo $count;?>.</td>  
                      <td class="text-center">#WO-0<?php echo $row['wo_id'];?></td>  
                      <td class="text-center">#QUO-0<?php echo $row['quotation_id'];?></td>
                      <td class="text-center"><?php echo $date;?><br><?php echo $time;?></td>
                      <td class="text-center w3-medium">  <!-- onclick="show_WO_id_info('<?php echo $row['wo_id']; ?>');" --> 
                        <a class="btn w3-medium '.$hide.'" style="padding:0px;" title="View Work Order"><i class="fa fa-eye" onclick="show_WO_id_info('<?php echo $row['wo_id']; ?>');"></i>
                        </a>                        
                      </td>
                    </tr>  
                    <?php
                    $count++;
                  }
                }
                else{
                  echo '<tr><td colspan="5" class="w3-center">'.$wo_info['status_message'].'</td></tr>';
                }  
                ?>  
              </table>   <!-- table closed here -->
            </div>
          </div>
        </div>
      </div>
      <div class="w3-col l8 w3-margin-top w3-padding-left">
        <div class="w3-col l12 w3-small w3-margin-top">
          <div class="w3-col l12 w3-margin-top" id="wo_details">         

        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    function show_WO_id_info(wo_id)
    {
    $("#wo_details").html('<center><img width="60%" height="auto" src="'+BASE_URL+'css/logos/page_spinner3.gif"/></center>');     
      $.ajax({
        type:'post',
        url:BASE_URL+'sales_enquiry/Manage_workorder/show_WO_id_info',
        data:{
          wo_id:wo_id
        },
        success:function(response) {
          $('#wo_details').html(response);
        }
      });

    }
  </script>
</body>
</html>
