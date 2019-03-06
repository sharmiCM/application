<?php $this->load->view('includes/header'); ?>
<h1>Create an Account!</h1>
<fieldset>
<legend>Personal Information</legend>
<?php
echo form_open('LoginRegister/create_member');
echo form_input('Firstname', set_value('Firstname', 'First Name'));
echo form_input('Lastname', set_value('Lastname', 'Last Name'));
echo form_input('EmailID', set_value('EmailID', 'Email Address'));
?>
</fieldset>

<fieldset>
<legend>Login Info</legend>
<?php
echo form_input('EmployeeID', set_value('EmployeeID', 'Username'));
echo form_input('password', set_value('password', 'Password'));
echo form_input('password2', 'Password Confirm');
 
echo form_submit('submit', 'Create Acccount');
?>
<?php echo validation_errors('<p class="error">'); ?>
</fieldset>
<?php $this->load->view('includes/footer'); ?>
 