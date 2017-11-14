<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="windows-1252">
	<title>Keep webform data persistent</title>
	<!-- jQuery CDN -->
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
<!--   <script type="text/javascript" src="<?php echo base_url(); ?>css/js/function.js"></script>
 -->	
	<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>
</head>
<body>
  <form>
    <h1>Please enter data</h1>
    <input id="title" type="text" placeholder="Title" />
    <input id="name" type="text" placeholder="Name" />
    <input id="tickets" type="text" placeholder="Tickets" />
    <input type="button" value="Save/Show" onclick="insert()" />
  </form>
  <div id="display"></div>
  <script type="text/javascript">
  	var titles  = [];
var names   = [];
var tickets = [];

var titleInput  = document.getElementById("title");
var nameInput   = document.getElementById("name");
var ticketInput = document.getElementById("tickets");

var messageBox  = document.getElementById("display");

function insert ( ) {
 titles.push( titleInput.value );
 names.push( nameInput.value );
 tickets.push( ticketInput.value );
  
 clearAndShow();
}

function clearAndShow () {
  // Clear our fields
  titleInput.value = "";
  nameInput.value = "";
  ticketInput.value = "";
  
  // Show our output
  messageBox.innerHTML = "";
  
  messageBox.innerHTML += "Titles: " + titles.join(", ") + "<br/>";
  messageBox.innerHTML += "Names: " + names.join(", ") + "<br/>";
  messageBox.innerHTML += "Tickets: " + tickets.join(", ");
}
  </script>
</body>
</html>