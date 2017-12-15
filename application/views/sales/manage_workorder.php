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
      <div class="w3-col l6">
        <header class="w3-container" >
          <h6><b><i class="fa fa-hand-o-up"></i> Raise Work Order</b></h6>
          <span class="w3-small"></span>
        </header>
        <div class="w3-col l12">
          <div class="w3-col l12 w3-margin-top">
            <div class="" id="ShowRaw_products" name="ShowRaw_products">
              <table class="table table-bordered table-responsive w3-small">            <!-- table starts here -->
                <tr class="w3-black">
                  <th class="text-center">Work Order ID</th>
                  <th class="text-center">Quotation No</th>              
                  <th class="text-center"> Date</th>              
                  <th class="text-center"> Time</th>              
                  <th class="text-center">Actions</th>                                           
                </tr>
                   <?php  
                    if($wo_info['status']==1){
                    foreach ($wo_info['status_message'] as $row)  
                   {  
                    $time=date('H:i:a', strtotime($row['time']));
                     $date=date('m/d/y',strtotime($row['date']));
                       
                   ?><tr>  
                    <td><?php echo $row['wo_id'];?></td>  
                    <td>#QUO-0<?php echo $row['quotation_id'];?></td>
                    <td><?php echo $date;?></td>
                    <td><?php echo $time;?></td>
                    <td class="text-center w3-medium"><i class="fa fa-eye" ></i><a class="btn w3-medium '.$hide.'" style="padding:0px;" onclick="show_WO_id_info('<?php echo $row['wo_id']; ?>');" title="show  WO_id"> &nbsp;
                  <i class="fa fa-sign-out"></i></td>
                     </tr>  
                     <?php }}
                     else{
                      echo '<tr><td colspan="5" class="w3-center">'.$wo_info['status_message'].'</td></tr>';
                     }  
                    ?>  
              </table>   <!-- table closed here -->
            </div>
          </div>
        </div>
      </div>
      <div class="w3-col l6  w3-margin-top w3-padding-left">
        <div class="w3-col l12 w3-small w3-margin-top">
          <div class="w3-col l12 w3-margin-top">
            <div class= "w3-margin-top" id="wo_details">
            </div> 
          </div>
        </div>
    </div>
 </div>
</div>
 <script type="text/javascript">
  function show_WO_id_info(wo_id)
  {

    $.confirm({
      title: '<label class="w3-large w3-text-red"><i class="fa fa-envelope"></i> Send  to Work Order.</label>',
      content: '<span class="w3-medium">Do You really want to send '+wo_id+' to Work Order ?</span>',
      buttons: {
        confirm: function () {
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
        },
        cancel: function () {}
      }
    });
  }
</script>
</body>
</html>
