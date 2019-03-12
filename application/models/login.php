<?php
class login extends CI_Model {
 function validate()
 {
	$this->load->database('new');
	$emp = $this->input->post('EmployeeID');
	$query = $this->db->query("SELECT * FROM `signup` WHERE EmployeeID='".$emp."' AND password='".$this->input->post('password')."'");
	$totalfound = $query->num_rows();
	$data = array();
	foreach ($query->result() as $row){
        $level =  $row->user_level;
		$firstN =  $row->Firstname;
		$lastN =  $row->Lastname;
		$team =  $row->TeamName;
		
		$data = array(
		'info' => $emp.",".$row->Firstname."".$row->Lastname.",".$row->user_level.",".$row->TeamName,
		'is_logged_in' => true,
		'user_level' => $level,
		'EmployeeID' => $emp,
		'lname' => $lastN,
		'TeamName' => $team,
		'fName' => $firstN,
		'date' => date('Y-m-d')
		);
	}
	
	$this->session->set_userdata($data);
	if($totalfound != 1)
	{
	  $mes = "EmployeeID or Password is not Correct!";
	}
	else{
		if($level == 'Admin'){$mes = "Go to home page!";}
		else{
			$queri = $this->db->query("SELECT * FROM `login` WHERE EmployeeID='".$emp."' AND Date='".date('Y-m-d')."'");
			$rows = $queri->num_rows();
			if($rows>=1){
				$mes = "Go to home page!";
			}
			else{
				$queri = $this->db->query("SELECT * FROM `roster_table` WHERE empid='".$emp."' AND DATE='".date('Y-m-d')."'");
				$rows = $queri->num_rows();
				
				if($emp=='Admin'){$mes = "Go to home page!";}
				else{
					if($rows!=1){
						$mes = "Roster not assigned. Contact Manager!";
					}
					else{
						foreach ($queri->result() as $row){
							$shiftCode = $row->Shiftcode;
						}
						$querie = $this->db->query("SELECT * FROM `roster` WHERE ID='".$shiftCode."'");
						foreach ($querie->result() as $row){
							$checkLate = strtotime(date('Y-m-d')." ".($row->intime)). - strtotime(date('Y-m-d H:i:s'));
							if($checkLate>=0){
								$queri = $this->db->query("INSERT INTO login(Date,Time,EmployeeID) VALUES ('".date('Y-m-d')."','".date('Y-m-d G:i:s')."','".$emp."')");
								$mes = "Go to home page!";
							}
							else{$mes = "Late!";}
						}
					}
				}
			}
		}			
	}
  return $mes;
 }
 function create_member()
 {
  $new_member_insert_data = array(
   'Firstname' => $this->input->post('Firstname'),
   'Lastname' => $this->input->post('Lastname'),
   'EmailID' => $this->input->post('EmailID'),   
   'EmployeeID' => $this->input->post('EmployeeID'),
   'password' => md5($this->input->post('password'))      
  );

   
  $insert = $this->db->insert('signup', $new_member_insert_data);
  return $insert;
 } 

}