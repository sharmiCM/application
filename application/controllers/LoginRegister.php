<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginRegister extends CI_Controller{
 function __construct()
  {
   parent::__construct();
    $this->load->helper(array('url'));
	$this->load->model('login'); /* load model default which you create */
    $this->load->library('session');
  }
 function index()
 {
  $this->load->view('login_form'); 
 } 
 function validateCredentials() {  
//if (isset($this->session->userdata['user'])){
  $this->load->model('login'); 
  $query = $this->login->validate();
  if($query=="Go to home page!") // if the user's credentials validated...
  {
   redirect('HomeScreen'); 
   //redirect('HomeScreen/forceSignout');
  }
  else // incorrect username or password
  {
    $msg = '<p class=error>'.$query.'</p>';
	$data = array('messages' => $msg);
	$this->session->set_userdata($data);
    $this->load->view('login_form');
	$this->session->unset_userdata('messages');
   //$this->index();
  }
//}
//else{
//	 $this->index();
//}
 }
  function logout() {
  $this->session->sess_destroy();
  $this->load->view('login_form');
 }
  function signup()
 {
  $data['main_content'] = 'signup_form';
  $this->load->view('includes/template', $data);
 }
  function logged_in_area()
 {
  $data['main_content'] = 'logged_in_area';
  $this->load->view('includes/template', $data);
 }
 function create_member()
 {
  $this->load->library('session');

  
  // field name, error message, validation rules
  $this->form_validation->set_rules('Firstname', 'Name', 'trim|required');
  $this->form_validation->set_rules('Lastname', 'Last Name', 'trim|required');
  $this->form_validation->set_rules('EmailID', 'Email Address', 'trim|required|valid_email');
  $this->form_validation->set_rules('EmployeeID', 'Username', 'trim|required|min_length[4]');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
  $this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
   
  if($this->form_validation->run() == FALSE)
  {
   $this->load->view('signup_form');
  }
  else
  {   
   $this->load->model('login');
    
   if($query = $this->login->create_member())
   {
    $data['main_content'] = 'signup_successful';
    $this->load->view('includes/template', $data);
   }
   else
   {
    $this->load->view('signup_form');   
   }
  }
 
   
 }
}
