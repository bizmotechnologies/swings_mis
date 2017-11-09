<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
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
      <h5><b><i class="fa fa-users"></i> Manage Users</b></h5>
    </header>
    <!-- Header end -->

    <div class="w3-row-padding w3-margin-bottom ">
      <div class="w3-col l12 w3-light-grey">        
        <div class="w3-padding">
          <div class="w3-col l12 w3-white w3-round w3-margin-bottom w3-padding w3-small">
            <div class="w3-col l12">
              <span class="w3-medium"><b><i class="fa fa-user-plus"></i> Create User</b></span>           
            </div>  
            <form id="createUser_form">         
              <div class="w3-col l11 w3-margin-top">
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Username:</label>
                  <input type="text" placeholder="eg. ABC, XYZ,etc." class="form-control" id="user_name" name="user_name">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Password:</label>
                  <input type="password"  minlength="8" placeholder="eg. ********" class="form-control" id="user_password" name="user_password">
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Confirm Password:</label>
                  <input type="password"  minlength="8" placeholder="re-enter password here" class="form-control" id="user_password_c" name="user_password_c">
                  <b><span id="message"></span></b>
                </div>
                <div class="w3-col l3 w3-padding-left w3-padding-bottom">
                  <label class="w3-label">Assign Role:</label>
                  <select class="form-control" id="user_role" name="user_role">
                    <option class="w3-red" value="0">select role from options</option>
                    <?php 
                    if(isset($all_roles['status'])){
                      echo ' <option><b>'.$all_roles['status_message'].'</option> ';                    
                    }
                    else{
                      foreach ($all_roles as $key) { 
                        echo '
                        <option value="'.$key['role_id'].'">'.strtoupper($key['role_name']).'</option>'; 
                      }
                    }               
                    ?>
                  </select>
                  <b><span id="role_message"></span></b>
                </div>
              </div>
              <div class="w3-col l1 w3-padding-top w3-padding-left w3-margin-top">
                <button class="btn w3-blue w3-margin-top" type="submit" id="user_createBtn" name="user_createBtn">Add New</button>
              </div>
            </form>

            <div class="w3-col l12" id="createUser_msg"></div>
          </div>
          
          <div class="w3-col l12">

          <?php                                 
            if(isset($all_users['status'])){
              echo ' <tr class="w3-text-red"><td colspan="5" class="text-center"><b>'.$all_users['status_message'].'</b></td></tr> ';                    
            }
            else{
              foreach ($all_users as $key) { 

                echo '
                <div class="w3-col l3 w3-white w3-card-2 w3-small w3-padding w3-margin-bottom w3-margin-right w3-border w3-round-xlarge">
                <div class="w3-col l12">
                <div class="w3-col l12" style="margin:0;padding:0">
                <a class="btn w3-left w3-padding-tiny" id="editUser_btn" name="editUser_btn" data-toggle="modal" data-target="#editUser_'.$key['user_id'].'" title="edit user"><i class="fa fa-edit ">&nbsp;</i></a>
                <a class="btn w3-right w3-padding-tiny" id="delUser_btn" name="delUser_btn" onClick="delUser('.$key['user_id'].')" title="delete user"><i class="fa fa-remove "></i></a>
                </div>
                <div class="w3-col l4 s4 w3-center">
                <span class="w3-jumbo"><i class="fa fa-vcard"></i></span>
                </div>
                <div class="w3-col l8 s8 w3-padding-left w3-padding-top">

                <table class="w3-margin-top">
                <tr>
                <td><span class="w3-tiny w3-label">Username:</span></td>
                <td>&nbsp;<span><b>'.$key['user_name'].'</b></span></td>
                </tr>
                </table>

                <div class="w3-col l12">
                <span><i>'.$key['user_roleName'].'</i></span>
                </div>
                <div class="w3-col l12 w3-margin-top">
                <span class="w3-tiny w3-label">Access Level:</span>
                <span><b>'.$key['access_privilege'].'</b></span>
                </div>
                </div>
                </div>
                </div>

                <!---------------- Modal to edit user------------>
                <div id="editUser_'.$key['user_id'].'" class="modal fade " role="dialog">
                <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content col-lg-8 col-lg-offset-2">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title w3-xlarge w3-text-red">Edit User Details</h4>
                </div>
                <div class="modal-body">
                <form method="POST" action="'.base_url().'admin/manage_users/edit_user">
                <input type="hidden" name="edituser_id" value="'.$key['user_id'].'">
                <label>Username: <br></label>
                <input class="form-control w3-margin-bottom" type="text" name="edit_userName" id="edit_userName" placeholder="eg. ABC, XYZ,etc." value="'.$key['user_name'].'" required>
                <label>Password: <br></label>
                <input class="form-control " type="text" name="edit_userPassword" id="edit_userPassword_'.$key['user_id'].'" placeholder="eg. ********" autocomplete="off" minlength="8" value="'.$key['user_password'].'" required>
                <label class="w3-margin-top">Confirm Password: <br></label>
                <input class="form-control " type="text" minlength="8" autocomplete="off" name="confirm_userPassword" onkeyup="confirm_editPasswd('.$key['user_id'].')" id="confirm_userPassword_'.$key['user_id'].'" placeholder="re-enter password here" required>
                <b><span id="update_message_'.$key['user_id'].'"></span></b><br>

                <label class="">Role : </label>
                <select class="form-control" name="edit_userRole" id="edit_userRole">
                ';
                if(isset($all_roles['status'])){
                  echo '<option class="w3-red"><b>'.$all_roles['status_message'].'</b></option> ';
                }
                else{
                  foreach ($all_roles as $roles) { 
                    $selected="";
                    if($key['user_role']==$roles['role_id']){$selected="selected";}

                    echo '<option class="" value="'.$roles['role_id'].'" '.$selected.'>'.strtoupper($roles['role_name']).'</option> ';
                  }  
                  echo '</select>';
                } 
                echo ' 
                <button class="btn w3-blue w3-margin-top" type="submit" name="updateUser" id="updateUser_'.$key['user_id'].'">Update</button>
                </form>
                </div>
                </div>
                </div>
                </div>
                <!--------------------modal end------------------------->  
                ';

              }

            }               
            ?> 
          </div>
        </div>     
      </div>
    </div>

    <!-- End page content -->
  </div>


<!--     <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
-->
<script>
  $(function(){
   $("#createUser_form").submit(function(){
    dataString = $("#createUser_form").serialize();

    $.ajax({
     type: "POST",
     url: "<?php echo base_url(); ?>admin/manage_users/add_user",
     data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#createUser_msg").html(data);                                    
           }

         });

         return false;  //stop the actual form post !important!

       });
 });
</script>
<!-- script ends here -->

<!-- script to delete features -->
<script>
  function delUser(id){
    $.confirm({
      title: '<label class="w3-large w3-text-red fa fa-warning"> Delete User Permanantly!!!</label>',

      buttons: {
        confirm: function () {
          var dataS = 'user_id='+ id;
          $.ajax({
            url:"<?php echo base_url(); ?>admin/manage_users/del_user", 
            type: "POST", 
            data: dataS,
            cache: false,
            success:function(html){                    
              setTimeout(function() {
                window.location.reload();
              }, 500);
            }
          });
        },
        cancel: function () {

        }
      }
    });

  }
</script>
<!-- script ends -->

<!-- script to check password and confirm passord field matches or not -->
<script>
  $('#user_password_c').on('keyup', function () {
    if ($('#user_password').val() == $('#user_password_c').val()) {
      $('#user_createBtn').prop("disabled", false);
      $('#message').html('');

    } else {
      $('#message').html('Password Not Matching').css('color', 'red');
      $('#user_createBtn').prop("disabled", true);
    }
  });
</script>
<!-- script end -->

<!-- script to check password and confirm passord field in update form of user matches or not -->
<script>
  function confirm_editPasswd(password_id){
   // $('#confirm_userPassword_'+password_id).on('keyup', function () {
    if ($('#edit_userPassword_'+password_id).val() == $('#confirm_userPassword_'+password_id).val()) {
      $('#updateUser_'+password_id).prop("disabled", false);
      $('#update_message_'+password_id).html('');

    } else {
      $('#update_message_'+password_id).html('Password Not Matching').css('color', 'red');
      $('#updateUser_'+password_id).prop("disabled", true);
    } 
  }  
</script>
<!-- script end -->

</body>
</html>
