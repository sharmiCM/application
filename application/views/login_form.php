<?php $this->load->view('includes/header'); ?>
<div id="login_form">
 <h1 style='color:white;font-family: 'Open Sans';'>CONTENT PRODUCTION</h1>
 <?php if(! is_null($msg)) echo $msg;?>  
    <?php 
 echo form_open('LoginRegister/validate_credentials');
 echo form_input('EmployeeID', 'Employee ID');
 echo form_password('password', '111111');
 echo form_submit('submit', 'Login');
 echo anchor('LoginRegister/signup', 'Create Account','style=padding-left:10px;text-align:center;');
 echo form_close();
 ?>
</div>
<?php $this->load->view('includes/footer'); ?>