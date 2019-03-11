<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
 <title>PPIS</title>
 <link rel="stylesheet" href="<?php echo base_url();?>public/css/style.css" type="text/css" media="screen" />
 <style>
 body{
	background:url("http://localhost:8080/PPIS/img/template.png")
}
 </style>
</head>
<body>
<div id="infoMessage"><?php echo $this->session->userdata('messages');?></div>

<div id="login_form">
 <h1 style="color:white;font-family:Open Sans';"> CONTENT PRODUCTION </h1></br></br>

	<form method="post" accept-charset="utf-8" action="<?php echo base_url();?>LoginRegister/validateCredentials" class="forms" id="mform">
	
 <img src="<?php echo base_url();?>img/user_white.png" style='width:35px;height:35px;position: absolute;left: 10px;'/>
 <input type="text" name="EmployeeID" style="text-transform:capitalize;background:transparent;" placeholder='Employee ID' />
 
	</br> 
	<img src="<?php echo base_url();?>img/lock_white.png" style='width:35px;height:35px;position: absolute;left: 10px;'/>
	<input type="password" name="password" style="text-transform:capitalize;background:transparent;" placeholder='password'>
</br> </br> 
<input type="submit" value="Login" name="Login">

 <p style="width: 173px;border: 1px solid grey;height: 26px;position: absolute;margin-top: -35px;margin-left: 44%;text-align: -webkit-center;padding-top: 7px;background: dimgrey;">
 <?php
 echo anchor('LoginRegister/signup', 'Create Account','style=padding-left:10px;'); ?>
 </p>
 
</div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript" charset="utf-8"></script> 
 <script type="text/javascript" charset="utf-8">
  $('input').click(function(){
   $(this).select(); 
  });
 </script>
</body>
</html>