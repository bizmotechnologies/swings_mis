<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Work Order</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link href="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">

  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>css/bootstrap/bootstrap-toggle.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/config.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/js/sales/manage_workorder.js"></script>
  <style type="text/css" media="print">
  body { blue;margin: 10mm 8mm 10mm 8mm;
  }
  html {background-color: #FFFFFF;margin: 0px; 
  }

  @page {size:auto letter; 
    margin: 0mm; }

  </style>

  <script>

    function printdiv(printpage)
    {


      var headstr = "<html><head></head><body></body>";

      var footstr = "</body>";

      var newstr = document.all.item(printpage).innerHTML;

      var oldstr = document.body.innerHTML;
      document.body.innerHTML = headstr+newstr+footstr;
      window.print();
      document.body.innerHTML = oldstr;
      return false;


    }
  </script>
</head>
<body class="">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main">
    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-files-o"></i> Print Work Order</b></h5>
    </header>

    <div class="col-lg-3"></div>
    <div class="col-lg-6 w3-small" id="container">
      <?php

      foreach ($print_data as $key) {
        $date=date('d/m/Y',strtotime($key['dated'])); 
        echo '
        <div class= "">
        <div class="w3-col l12">
        <table class="table table-bordered table-responsive">
        <tbody>
        <tr>
        <th class="text-right">Customer ID:</th>
        <td>'.$key['customer_name'].'</th>
        <th class="text-right">Date:</td>
        <td>'.$date.'</td>
        <th class="text-right">Work Order No:</th>
        <td>#WO-0'.$key['wo_id'].'</td>
        </tr>
        </tbody>
        </table>
        </div>
        <div class="w3-col l12">
        <table class="table table-bordered table-responsive">
        <thead>
        <tr>
        <th class="text-center">Sr.</th>
        <th class="text-center">Profile</th>
        <th class="text-center">Material</th>
        <th class="text-center">ID</th>
        <th class="text-center">OD</th>
        <th class="text-center">Length</th>
        <th class="text-center">Qty</th>
        <th class="text-center">per Piece (<i class="fa fa-inr"></i>)</th>
        </tr>
        </thead>
        <tbody>';
        $count=1;
        foreach (json_decode($key['product_associated'],TRUE) as $row) {

      //-----------------get profile name----------------------
          $path=base_url();
          $url = $path.'api/ManageProfile_api/profileDetails?profile_id='.$row['profile_id']; 
          $ch = curl_init($url);
          curl_setopt($ch, CURLOPT_HTTPGET, true);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          $response_json = curl_exec($ch);
          curl_close($ch);
          $response=json_decode($response_json, true);
          $profile_name=($response['status_message'][0]['profile_name']);
      //echo $profile_name;
      //------------------get profile name ends---------------------------
          echo '
          <tr>
          <td class="text-center">
          <span>'.$count.'.</span>
          </td>
          <td class="text-center">
          <span>'.$profile_name.'<input class="form-control" name="profile_name[]" value="'.$profile_name.'" type="hidden"></span>
          </td>
          <td class="text-center">
          <span>';
          $br=1;
          foreach ($row['material_associated'] as $material) {
            echo($material['material_id']).'+';

            if($br==3){
              $br=0;
              echo '<br>';
            }
            $br++;
          }  
          echo '</span>
          </td>
          <td class="text-center">
          <span>'.$row['Prod_ID'][0].'</span>
          </td>
          <td class="text-center">
          <span>'.$row['Prod_OD'][0].'</span>
          </td>
          <td class="text-center">
          <span>'.$row['Prod_length'][0].'</span>
          </td>
          <td class="text-center">
          <span>'.$row['product_quantity'].'</span>
          </td>
          <td class="text-center">
          <span>'.number_format($row['product_price']/$row['product_quantity'], 2, '.', '').'</span>
          </td>
          </tr>               
          ';       
          $count++;
        }
        echo '
        </tbody>
        </table> 
        </div>     
        <br>
        </div> 
        <div class="w3-col l12 ">';
        foreach ($print_data as $key) {
          $image=json_decode($key['wo_drawings']);
          $count=1;
          foreach ($image as $img) {
            for ($i=0; $i < count($img); $i++) { 
             echo ' 
             <img class="w3-col l6 w3-border img-thumbnail" style="width: 370px;height: 370px;margin:5px 5px 0 0" src="'.base_url().$img[$i].'">          
             
             ';
             $count++;
           }          
         }
       }
       echo '
       </div>
       </div>

       ';
     }

     ?>
   </div>
   <div class="col-lg-3">
    <input name="b_print" id="b_print" type="button" class="w3-button w3-red w3-wide w3-margin-top" onClick="javascript:printdiv('container')" value=" Print"  >
  </div>
</div>
</body>
</html>
