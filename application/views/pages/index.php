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
<link rel="stylesheet" href="<?php echo base_url(); ?>css/signin.css">
<!-- <link rel="stylesheet" href="assets/css/alert/jquery-confirm.css"> -->
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/jquery-3.1.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>css/bootstrap/bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="assets/css/alert/jquery-confirm.js"></script> -->
</head>
<body style="background-color: white">

    <div class="container">

      <form class="form-signin w3-border-bottom" id="admin_loginForm">
        <center><img class="img img-responsive w3-margin-bottom" title="Seal Wings- Login" src="<?php echo base_url(); ?>css/logos/login.jpg" width="200px" height="auto"></center>
        <h2 class="form-signin-heading "></h2>
        <label for="adminUser" class="sr-only">Email address/ Username</label>
        <input type="text" name="adminUser" class="form-control w3-margin-bottom" placeholder="Admin Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="adminPass" class="form-control" placeholder="Password" required>
        
        <button class="btn btn-lg btn-primary btn-block w3-margin-bottom" type="submit">Sign in</button>
        <div class="w3-margin-bottom w3-margin-bottom w3-small" id="adminLogin_err"></div>        

      </form>
            
      <div class="w3-center">       
      <span class="w3-medium">© Copyright and All Rights reserved</span><br>
      <span class="w3-small">Powered by <a class="w3-text-blue" href="https://bizmo-tech.com" target="_blank">Bizmo Technologies</a> </span>
    </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--     <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
 -->
    <script>
 $(function(){
   $("#admin_loginForm").submit(function(){
     dataString = $("#admin_loginForm").serialize();
    
     $.ajax({
       type: "POST",
       url: "<?php echo base_url(); ?>admin_login/auth_admin",
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