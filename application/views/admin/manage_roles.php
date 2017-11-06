<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Roles</title>
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
      <h5><b><i class="fa fa-users"></i> User roles</b></h5>
    </header>
    <!-- Header end -->

    <div class="w3-row-padding w3-margin-bottom ">
      <div class="w3-col l12 w3-light-grey w3-padding">
        <header class="w3-container" >
          <span class="w3-small"></span>
        </header>

        <div class="w3-padding-large w3-col l5">
          <form id="add_roleForm" class="w3-small">
          <div class="w3-col l4 w3-padding-top">
            <button class="btn w3-blue w3-margin-top w3-margin-bottom" data-toggle="modal" data-target="#addRole"><i class="fa fa-plus"></i> Add New Role</button>
          </div>
          <div class="w3-col l8">
            <label>Role Name: </label>
                <input class="form-control w3-margin-bottom" id="role_name" name="role_name" type="text" placeholder="role name eg.Admin, sub-admin,etc." required/>
          </div>
          </form>
          <div class="w3-col l12" id="add_role_msg"></div>                  
        </div>
        <div class="w3-padding-large w3-col l7 w3-white w3-round-large">
          <div class="w3-col l12 w3-label"><label>Roles: </label></div>
           <?php 
           if(isset($all_roles['status'])){
            echo ' <span class="w3-text-red"><b>'.$all_roles['status_message'].'</b></span> ';                    
           }
           else{
            foreach ($all_roles as $key) { 
              $active="";

              echo '
              <div class="w3-padding w3-red w3-round w3-margin-right w3-margin-bottom w3-small w3-card-2" style="display: inline-block">
              <a class="btn w3-tiny w3-right" title="delete" onClick="delRole('.$key['role_id'].')" style="padding:0;margin:0"><i class="fa fa-remove"></i></a>
              <span class="w3-center">'.strtoupper($key['role_name']).'</span>
              <div class="w3-col l12 w3-left"><b class="w3-tiny">Type:</b></div>
              </div>'; 
            }
          }               
          ?>
      </div>      
   </div>
 </div>

 <!-- End page content -->
</div>

<!--     script to add role     -->
<script>
 $(function(){
   $("#add_roleForm").submit(function(){
     dataString = $("#add_roleForm").serialize();
     
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>Manage_roles/add_role",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#add_role_msg").html(data);                                     
           }

         });
         return false;  //stop the actual form post !important!

       });
 });
</script>
<!-- script ends here -->

<!-- script to delete role -->
<script>
  function delRole(id){
    $.confirm({
      title: '<label class="w3-large w3-text-red fa fa-warning"> Delete Role!!!</label>',

      buttons: {
        confirm: function () {
          var dataS = 'role_id='+id;
          $.ajax({
            url:"<?php echo base_url(); ?>Manage_roles/del_role", 
            type: "POST", 
            data: dataS,
            cache: false,
            success:function(html){  
           $.alert(html);                
              setTimeout(function() {
                window.location.reload();
              }, 1000);
            }
          });
        },
        cancel: function () {}
      }
    });

  }
</script>
<!-- script ends -->
</body>
</html>
