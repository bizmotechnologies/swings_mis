<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>General Settings</title>
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
      <h5><b><i class="fa fa-gears"></i> General Settings</b></h5>
    </header>
    <!-- Header end -->

    <!-- Manage Roles div -->
    <div class="w3-row-padding w3-margin-bottom ">
      <div class="w3-col l12 w3-padding">
        <header class="w3-container" >
          <h6><b><i class="fa fa-address-book"></i> Manage Roles</b></h6>
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
            //------if no roles are added then print this----//
            echo ' <span class="w3-text-red"><b>'.$all_roles['status_message'].'</b></span> ';                    
          }
          else{
            foreach ($all_roles as $key) { 
              $active="";
              //-------------set all roles in tiles--------//
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
    <!-- manage roles div end -->

    <div class="w3-row-padding w3-margin-bottom ">
      <hr>
      <div class="w3-col l6 w3-border-right">
        <header class="w3-container" >
          <h6><b><i class="fa fa-bookmark-o"></i> Manage Features</b></h6>
          <span class="w3-small">To assign certain permissions to certain roles, we need to add the features first.</span>
        </header>

        <div class="w3-padding">
          <button class="btn w3-blue w3-margin-bottom" data-toggle="modal" data-target="#addFeature"><i class="fa fa-plus"></i> Add New</button>
          <div class="w3-col l4 w3-right" id="updateFeature_msg">
            <?php 
            if(isset($updateFeature_set)){
              echo $updateFeature_set;
            }
            ?>
          </div>
          <div style="overflow-x: scroll;"> 
            <table class="table table-striped table-responsive w3-small" >
              <thead>
                <tr>
                  <th>SrNo.</th>
                  <th>Feature Name</th>
                  <th>Assigned To (Roles);</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                $srno=1;
                if(isset($all_features['status'])){
                  echo ' <tr class="w3-text-red"><td colspan="5" class="text-center"><b>'.$all_features['status_message'].'</b></td></tr> ';                    
                }
                else{

                  //----------print all features if present in db
                  foreach ($all_features as $key) { 
                    $feature_roles=json_decode($key['roles']);

                    echo '
                    <tr>
                    <td>'.$srno.'.</td>
                    <td>'.$key['feature_title'].'</td>
                    <td>';
                    if(isset($all_roles['status'])){
                      echo ' <span class="w3-text-red"><b>'.$all_roles['status_message'].'</b></span> ';
                    }
                    else{
                      //-----------show all roles along with selected ones in checkbox ----------//
                      foreach ($all_roles as $roles) { 
                        $checked="";
                        if(in_array($roles['role_id'], $feature_roles)){$checked="checked";}

                        echo '
                        <input type="checkbox" value="'.$roles['role_id'].'" '.$checked.' disabled>
                        <label class="w3-label">'.$roles['role_name'].'</label><br>';                               
                      }  
                    } 
                    echo '
                    </td>
                    <td>
                    <a class="btn w3-padding-tiny" id="editFeature_btn" name="editFeature_btn" data-toggle="modal" data-target="#editFeature_'.$key['feature_id'].'" title="Edit '.$key['feature_title'].'"><i class="fa fa-edit"></i></a>
                    <a class="btn w3-padding-tiny" id="delFeature_btn" name="delFeature_btn" onClick="delFeature('.$key['feature_id'].')" title="Remove '.$key['feature_title'].'"><i class="fa fa-remove"></i></a>
                    </td>
                    </tr> 


                    <!------------- Modal to update feature -------------->

                    <div id="editFeature_'.$key['feature_id'].'" class="modal fade " role="dialog">
                    <div class="modal-dialog modal-md">
                    <!-- Modal content-->
                    <div class="modal-content col-lg-8 col-lg-offset-2">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title w3-xlarge w3-text-red">Edit <span class="w3-medium">'.$key['feature_title'].'</span></h4>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="'.base_url().'admin/general_settings/edit_feature">
                    <input type="hidden" name="editfeature_id" value="'.$key['feature_id'].'">
                    <label>Feature Title: <br></label>
                    <input class="form-control" type="text" name="editfeature_title" placeholder="Enter Feature Title here." value="'.$key['feature_title'].'" required>

                    <label class="w3-margin-top">Feature description: </label>
                    <textarea class="form-control" rows="5" name="editfeature_desc" placeholder="Type the Feature description here." >'.$key['feature_description'].'</textarea>
                    <label class="w3-margin-top">Visible To: </label>
                    ';
                    if(isset($all_roles['status'])){
                      echo ' <span class="w3-text-red"><b>'.$all_roles['status_message'].'</b></span> ';
                    }
                    else{
                      echo '<div class="well w3-padding w3-small">';
                      foreach ($all_roles as $roles) { 
                        $checked="";
                        if(in_array($roles['role_id'], $feature_roles)){$checked="checked";}

                        echo '
                        <input type="checkbox" name="editfeature_roles[]" value="'.$roles['role_id'].'" '.$checked.'>
                        <label class="w3-label">'.$roles['role_name'].'</label><br>';                               
                      }  
                      echo '</div>';
                    } 
                    echo ' 
                    <button class="btn w3-blue w3-margin-top" type="submit" name="updateFeature" id="updateFeature">Update</button>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>
                    <!-------------modal end------------------->                  
                    ';                               
                    $srno++;
                  }

                }               
                ?>

              </tbody>
            </table>
          </div>
        </div>


        <!-- shift table modal Start -->
        <div id="addFeature" class="modal fade " role="dialog">
          <div class="modal-dialog modal-sm">
            <!-- Modal content-->
            <div class="modal-content ">    
              <div class="modal-header">
                <button type="button" id="mod_close" class="close fa fa-remove" data-dismiss="modal"></button>
                <h4 class="w3-text-red"><b>Add Feature</b></h4>
              </div>
              <div class="modal-body">
                <form id="add_featureForm">
                  <label>Name: </label>
                  <input class="form-control w3-margin-bottom" id="feature_title" name="feature_title" type="text" placeholder="" value = "" required/>  

                  <label>Description: </label>
                  <textarea class="form-control w3-margin-bottom" id="feature_description" name="feature_description" cols="5"></textarea>

                  <label>Visible To: </label>
                  <?php 
                  if(isset($all_roles['status'])){
                    echo ' <span class="w3-text-red"><b>'.$all_roles['status_message'].'</b></span> ';
                  }
                  else{
                    echo '<div class="well w3-padding">';
                    foreach ($all_roles as $roles) { 
                      echo '
                      <input type="checkbox" name="feature_roles[]" value="'.$roles['role_id'].'">
                      <label class="w3-label">'.$roles['role_name'].'</label><br>';                               
                    }  
                    echo '</div>';
                  } 
                  ?>

                  <button class="w3-red w3-margin-bottom w3-button w3-round" type="submit" name="table_submit" id="feature_submit">Add</button>                
                  <div class="" id="add_feature_msg"></div>                  
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--   shift table modal end -->
      </div>

      <div class="w3-col l6 ">

        <header class="w3-container" >
          <h6><b><i class="fa fa-calculator"></i> Customize Calculating Parameters</b></h6>
          <span class="w3-small">Customize the parameters needed in various calculations and generating quotations.</span>
        </header>

        <div class="w3-padding"></div>
        
      </div>
    </div>

    <!-- End page content -->
  </div>

<!--  Script to reload page when add feature modal closes............................
--> 
<script>
  $('#addFeature').on('hidden.bs.modal', function () {
    location.reload();
  });
</script>
<!-- script end -->

<!--  script to add features   -->
<script>
  $(function(){
   $("#add_featureForm").submit(function(){
     dataString = $("#add_featureForm").serialize();

     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>admin/general_settings/add_feature",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#add_feature_msg").html(data); 
             $('#feature_description').val('');                        
             $('#feature_title').val('');                        
           }

         });

         return false;  //stop the actual form post !important!

       });
 });
</script>
<!-- script ends here -->

<!-- script to delete features -->
<script>
  function delFeature(id){
    $.confirm({
      title: '<label class="w3-large w3-text-red fa fa-warning"> Delete Feature!!!</label>',

      buttons: {
        confirm: function () {
          var dataS = 'feature_id='+ id;
          $.ajax({
            url:"<?php echo base_url(); ?>admin/general_settings/del_feature", 
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

<!--     script to add role     -->
<script>
 $(function(){
   $("#add_roleForm").submit(function(){
     dataString = $("#add_roleForm").serialize();
     
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>admin/manage_roles/add_role",
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
            url:"<?php echo base_url(); ?>admin/manage_roles/del_role", 
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
