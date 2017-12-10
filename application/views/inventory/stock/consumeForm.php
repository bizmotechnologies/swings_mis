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
      <div class="w3-col l12 w3-light-grey">        
        <div class="w3-padding">
          <div class="w3-col l12 w3-white w3-round w3-margin-bottom w3-padding w3-small">
            <!-- <div class="w3-col l12">
              <span class="w3-medium"><b><i class="fa fa-user-plus"></i> Create User</b></span>           
            </div>  --> 
            <form id="createUser_form" action="post">         
              <div class="w3-col l11 w3-margin-top">
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Select Material</label>
                  <select class="form-control" id="material1" name="material1">
                    <option class="w3-red" value="0">Material</option>
                  </select>
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Inner Dimensions(ID)</label>
                  <input type="text" placeholder="Enter ID" class="form-control" id="inner_dia" name="inner_dia">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Outer Dimension(OD)</label>
                  <input type="password"  minlength="8" placeholder="Enter OD" class="form-control" id="outer_dia" name="outer_dia">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Consumed Lenght</label>
                  <input type="password"  minlength="8" placeholder="Enter Consumed Length" class="form-control" id="consumed_lenght" name="consumed_lenght">
                  <b><span id="message"></span></b>
                </div>
              </div>
              <div class="w3-col l1 w3-padding-top w3-padding-left w3-margin-top">
                <button class="btn w3-blue w3-margin-top" type="submit" id="add_material" name="add_material">Add New</button>
              </div>
            </form>
          </div>
        </div>     
      </div>
    </div>
  </div>
</body>
</html>
