<?php $this->load->view('includes/header'); ?>
<div id="login_form">
 <h1 style='color:white;font-family: 'Open Sans';'> CONTENT PRODUCTION </h1></br></br>
 
 <?php if(! is_null($msg)) echo $msg;?>  
    <?php  
	echo form_open('LoginRegister/validateCredentials');
	?>
	<!--<form method="post" accept-charset="utf-8" action="<?php echo base_url();?>LoginRegister/validateCredentials" class="forms" id="mform">-->
 <img src="<?php echo base_url();?>img/user_white.png" style='width:35px;height:35px;position: absolute;left: 10px;'/>
 <?php  
	echo form_input('EmployeeID', 'Employee ID','style=text-transform:capitalize;background:transparent;');?>
	</br> 
	<img src="<?php echo base_url();?>img/lock_white.png" style='width:35px;height:35px;position: absolute;left: 10px;'/>
 <?php 
echo form_password('password', '111111','style=text-transform:capitalize;background:transparent;');?>
</br> </br> 
 <?php 
 echo form_submit('submit', 'Login');?>
 
 <p style="width: 173px;border: 1px solid grey;height: 26px;position: absolute;margin-top: -35px;margin-left: 44%;text-align: -webkit-center;padding-top: 7px;background: dimgrey;">
 <?php
 echo anchor('LoginRegister/signup', 'Create Account','style=padding-left:10px;'); ?>
 </p>
 <?php
 echo form_close();
 ?>
<?php $this->load->view('includes/footer'); ?>