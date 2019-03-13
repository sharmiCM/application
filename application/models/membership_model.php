<?php
class Membership_model extends CI_Model {
 function validate()
 {
	$this->load->database('new');
	$query = $this->db->query("SELECT * FROM `signup` WHERE EmployeeID='".$this->input->post('EmployeeID')."' AND password='".$this->input->post('password')."'");
	$totalfound = $query->num_rows();
	foreach ($query->result() as $row){
        $level =  $row->user_level;
	}
	if($totalfound != 1)
	{
	  $mes = "EmpolyeeID or Password is not Correct!";
	}
	else{
		if($level == 'Admin'){$mes = "Go to home page!";}
		else{
			$queri = $this->db->query("SELECT * FROM `login` WHERE EmployeeID='".$this->input->post('EmployeeID')."' AND Date='".date('Y-m-d')."'");
			$rows = $queri->num_rows();
			if($rows>=1){
				$mes = "Go to home page!";
			}
			else{
				$queri = $this->db->query("SELECT * FROM `roster_table` WHERE empid='".$this->input->post('EmployeeID')."' AND DATE='".date('Y-m-d')."'");
				$rows = $queri->num_rows();
				
				if($this->input->post('EmployeeID')=='Admin'){$mes = "Go to home page!";}
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
								$queri = $this->db->query("INSERT INTO login(Date,Time,EmployeeID) VALUES ('".date('Y-m-d')."','".date('Y-m-d G:i:s')."','".$this->input->post('EmployeeID')."')");
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