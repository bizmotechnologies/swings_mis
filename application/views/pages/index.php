<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
//error_reporting(E_ERROR | E_PARSE);

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Seal Wings</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/font awesome/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/w3.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
<!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css"> -->
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script> -->

</head>
<body style="background-color: white">
  
    <div class="col-lg-4"></div>
    <div class="w3-col l4 w3-padding-xxlarge">

      <form class="w3-border-bottom w3-small" id="login_form">
        <center><img class="img img-responsive w3-margin-bottom" title="Seal Wings- Login" src="<?php echo base_url(); ?>css/logos/login.jpg" width="200px" height="auto"></center>
        <h2 class="form-signin-heading "></h2>
        <select name="login_role" class="form-control w3-margin-bottom" required>
          <option class="active w3-red" value="0">Select your role</option>
          <?php 
             if(isset($all_roles['status'])){
                echo '<option>'.$all_roles['status_message'].'</option>';                    
              }
              else{
                foreach ($all_roles as $key) {                  
                 echo '<option value="'.$key['role_id'].'">'.$key['role_name'].'</option>';
               }
             }
          ?>
        </select>
        <label for="login_user" class="w3-label">Email address/ Username:</label>
        <input type="text" name="login_user" class="form-control w3-margin-bottom" placeholder="Enter your username" required autofocus>
        <label for="login_password" class="w3-label">Password:</label>
        <input type="password" name="login_password" minlength="8" class="form-control w3-margin-bottom" placeholder="Enter your password" required>
        
        <button class="btn btn-md w3-red btn-block w3-margin-bottom" type="submit">Sign in</button>
        <div class="w3-margin-bottom w3-margin-bottom w3-small" id="adminLogin_err"></div>        

      </form>
            
      <div class="w3-center">       
      <span class="w3-medium">© Copyright and All Rights reserved</span><br>
      <span class="w3-small">Powered by <a class="w3-text-blue" href="https://bizmo-tech.com" target="_blank">Bizmo Technologies</a> </span>
    </div>
    </div> <!-- /container -->
    <div class="col-lg-4"></div>
    <!-- <div id="spinner" class="spinner"></div> -->


   
    <script>
 $(function(){
   $("#login_form").submit(function(){
     dataString = $("#login_form").serialize();
         $("#adminLogin_err").html('<img width="85%" height="auto" src="<?php echo base_url(); ?>css/logos/page_spinner2.gif" />');
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>role_login/login_auth",
       data: dataString,
           return: false,  //stop the actual form post !important!

           success: function(data)
           {
             $("#adminLogin_err").html(data);                         
           }

         });

         return false;  //stop the actual form post !important!

       });
 });
</script>
  </body>
</html>