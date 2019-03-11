<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeScreen extends CI_Controller {
	
	public function index()
	{
		$this->load->view('HomeScreen/Home.php');//
	}
	public function rosterCreate()
	{
		$this->load->view('Roster/roster.php');//
	}
	public function rosterDisplay()
	{
		$this->load->view('Roster/Display_roster.php');//
	}
	public function rosterUpdate()
	{
		$this->load->view('Roster/roster_update.php');//
	}
	public function viewLogs()
	{
		$this->load->view('Reports/JMS_SheetLog.php');//
	}
	public function viewPunctuality()
	{
		$this->load->view('Punctuality/punctualityChart.php');//
	}
	public function employeeAllotment()
	{
		$this->load->view('EmployeeAllotment/employeeAllotment.php');//
	}
	public function capacityPlannerDash()
	{
		$this->load->view('CapacityPlanner/homeCP.php');//
	}
	public function capacityPlannerDMGT()
	{
		$this->load->view('CapacityPlanner/Capacity_planner.php');//
	}
}
