<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consume Form</title>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/alert/jquery-confirm.css">
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>css/alert/jquery-confirm.js"></script>
</head>
<body class="w3-light-grey">

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:120px;">

    <!-- Header -->
    <header class="w3-container" >
      <h5><b><i class="fa fa-users"></i>Consumed Material</b></h5>
    </header>
    <!-- Header end -->

    <div class="w3-row-padding w3-margin-bottom ">
      <div class="w3-col l12 ">        
        <div class="w3-padding">
          <div class="w3-col l12 w3-light-grey w3-white w3-round w3-margin-bottom w3-padding w3-small">

            <form id="materialConsumption_form">         
              <div class="w3-col l11 w3-margin-top">
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Select Material</label>
                  <select class="form-control" id="material_name" name="material_name">
                    <option class="w3-red" value="0" active>Select Material</option>
                    <?php 
                    foreach ($all_material['status_message'] as $key) {
                      echo '<option class="" value="'.$key['material_name'].'">'.$key['material_name'].'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Inner Dimensions(ID)</label>
                  <input type="number" placeholder="Enter ID" class="form-control" id="inner_dia" name="inner_dia">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Outer Dimension(OD)</label>
                  <input type="number" placeholder="Enter OD" class="form-control" id="outer_dia" name="outer_dia">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Consumed Lenght</label>
                  <input type="number" placeholder="Enter Consumed Length" class="form-control" id="consumed_length" name="consumed_length">
                  <b><span id="message"></span></b>
                </div>
              </div>
              <div class="w3-col l1 w3-padding-top w3-padding-left w3-margin-top">
                <button class="btn w3-blue w3-margin-top" type="submit" id="comsumption_submit" name="comsumption_submit">Add New</button>
              </div>
            </form>
          </div>
          <div class="w3-col l12" id="Err_msg"></div>
        </div> 
        <div class="w3-col l6 w3-padding-left">

         <table class="table table-striped table-responsive w3-small"> 
           <!-- table starts here -->
           <thead>
            <tr class="w3-black ">
              <th class="text-center w3-border">SR. No</th>
              <th class="text-center w3-border">Material&nbsp;Name</th>  
              <th class="text-center w3-border">ID</th>              
              <th class="text-center w3-border">OD</th>              
              <th class="text-center w3-border">Consumed&nbsp;Length</th>
            </tr>
          </thead>
          <tbody><!-- table body starts here -->
           <?php 

           if($all_consume['status']==0){
            echo '<tr>
            <td class="text-center" colspan="5"><strong>'.$all_consume['status_message'].'</strong> </td>
            </tr>';
          }
          else
          {
            foreach ($all_consume['status_message'] as $key) {
              $count=1; 
              echo '
              <tr>
              <td class="text-center">'.$count.'</td>
              <td class="text-center">'.$key['material_name'].'</td>
              <td class="text-center">'.$key['material_ID'].'</td>
              <td class="text-center">'.$key['material_OD'].'</td>
              <td class="text-center">'.$key['material_Length'].'</td>
              </tr>
              ';
              $count++;
            }

          }
          ?>
        </tbody>
      </table>
    </div>    
  </div>
</div>
</div>

<!--     script to add role     -->
<script>
 $(function(){
   $("#materialConsumption_form").submit(function(){
     dataString = $("#materialConsumption_form").serialize();

     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>inventory/MaterialConsumption/addConsumption",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#Err_msg").html(data);                                     
           }

         });
         return false;  //stop the actual form post !important!

       });
 });
</script>
<!-- script ends here -->
</body>
</html>
