<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeScreen extends CI_Controller {
	
	
	public function index()
	{	
		$this->template
				->title('Dashboard','My App')
				->build('Dashboard/dashboard');
		//$this->load->view('Dashboard/Home.php');//
	}
}
