<?PHP
session_start();
error_reporting(0);
//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
 $num_rows = $_SESSION['num_rows'];
if(isset($_POST['TEAM_h']) == 'TEAM_h'){	

	$a_id = $_POST['a_id'];
$TEAM_h = $_POST['TEAM_h'];
	 $Publisher_h = $_POST['Publisher_h'];
	 $Magazine_h = $_POST['Magazine_h'];
	 
	
	 $sql="UPDATE logsheet SET team='".$TEAM_h."', publisher='".$Publisher_h."', magazine='".$Magazine_h."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "Updated";
}
if(isset($_POST['folder']) == 'folder'){	

	echo $a_id = $_POST['a_id'];
	$folder = $_POST['folder'];
	$description = $_POST['description'];
	//$typee = $_POST['typee'];
	$simple = $_POST['simple'];
	$medium = $_POST['medium'];
	$complex = $_POST['complex'];
	$generic = $_POST['generic'];
	$total_c = $_POST['total_c'];
	$end = $_POST['end'];
	$start = $_POST['start'];
	$diff = $_POST['diff'];
	$Name_h = $_POST['Name_h'];
	$status_h = $_POST['status_h'];
	$e_type = $_POST['e_type'];
	$e_count = $_POST['e_count'];
	$Complexity = $_POST['Complexity'];
	$Core_aux = $_POST['Core_aux'];


	 $sql="UPDATE logsheet SET issue_folder_name='".$folder."', job_description='".$description."',simple='".$simple."',medium='".$medium."', complex='".$complex."',Generic='".$generic."', total_images='".$total_c."', start_time='".$start."', end_time='".$end."', production_hour='".$diff."',operator_name='".$Name_h."',status='".$status_h."', erro_count='".$e_count."', error_type='".$e_type."',Complexity_e='".$Complexity."',Core_aux='".$Core_aux."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "Updated";
}

/* if(isset($_POST['description']) == 'description'){	

	echo $a_id = $_POST['a_id'];
	$description = $_POST['description'];

	 
	
	 $sql="UPDATE logsheet SET job_description='".$description."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
}
*/
if(isset($_POST['typee']) == 'typee'){	

	echo $a_id = $_POST['a_id'];
	$typee = $_POST['typee'];

	 
	
	 $sql="UPDATE logsheet SET type='".$typee."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "Updated";
}
 
/*

if(isset($_POST['simple']) == 'simple'){	

	 $a_id = $_POST['a_id'];
	$simple = $_POST['simple'];
	$medium = $_POST['medium'];
	$complex = $_POST['complex'];
	$generic = $_POST['generic'];
	$total_c = $_POST['total_c'];
	
	 
	
	 $sql="UPDATE logsheet SET simple='".$simple."', medium='".$medium."', complex='".$complex."',Generic='".$generic."', total_images='".$total_c."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
}


if(isset($_POST['start']) == 'start'){	

	 $a_id = $_POST['a_id'];
	$end = $_POST['end'];
	$start = $_POST['start'];
	$diff = $_POST['diff'];
	
	
	 
	
	 $sql="UPDATE logsheet SET start_time='".$start."', end_time='".$end."', production_hour='".$diff."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
}


if(isset($_POST['Name_h']) == 'Name_h'){	

	 $a_id = $_POST['a_id'];
	$Name_h = $_POST['Name_h'];
		 
	
	 $sql="UPDATE logsheet SET operator_name='".$Name_h."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
}

if(isset($_POST['status_h']) == 'status_h'){	

	 $a_id = $_POST['a_id'];
	$status_h = $_POST['status_h'];
	$e_type = $_POST['e_type'];
	$e_count = $_POST['e_count'];
		
	 $sql="UPDATE logsheet SET status='".$status_h."', erro_count='".$e_count."', error_type='".$e_type."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
}
 */
if(isset($_POST['date']) == 'date'){	

	 $a_id = $_POST['a_id'];
	$date = $_POST['date'];

		
	 $sql="UPDATE logsheet SET date='".$date."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "Updated";
}
/* 
if(isset($_POST['Complexity']) == 'Complexity'){	

	 $a_id = $_POST['a_id'];
	$Complexity = $_POST['Complexity'];

		
	 $sql="UPDATE logsheet SET Complexity_e='".$Complexity."' WHERE ID = '".$a_id."' ";
	
	$result1 = mysqli_query($con,$sql);
	echo "<script>alert('Updated')</script>";
} */
if(isset($_POST['AutoID']) == 'AutoID'){	

$Firstname_1 = $_POST['Firstname'];
$Lastname_1 = $_POST['Lastname'];
$ProadId_1 = $_POST['ProadId'];
$JoiningDate_1 = $_POST['JoiningDate'];
$EmployeeID_1 = $_POST['EmployeeID'];
$TeamName_1 = $_POST['TeamName'];
$Designation_1 = $_POST['Designation'];
$user_level_1 = $_POST['user_level'];
$SkypeID_1 = $_POST['SkypeID'];
$AutoID = $_POST['AutoID'];
	 
		
	 $sql="UPDATE signup SET Firstname ='".$Firstname_1."',Lastname ='".$Lastname_1."',ProadId ='".$ProadId_1."',JoiningDate ='".$JoiningDate_1."',EmployeeID ='".$EmployeeID_1."',TeamName ='".$TeamName_1."',Designation ='".$Designation_1."',user_level ='".$user_level_1."',SkypeID ='".$SkypeID_1."' WHERE Auto_ID = '".$AutoID."' ";
	 
	 echo "Updated";

	$result1 = mysqli_query($con,$sql);	
}
if(isset($_POST['Firstname_I']) == 'Firstname_I'){	

$Firstname_I = $_POST['Firstname_I'];
$Lastname_I = $_POST['Lastname_I'];
$ProadId_I = $_POST['ProadId_I'];
$JoiningDate_I = $_POST['JoiningDate_I'];
$EmployeeID_I = $_POST['EmployeeID_I'];
$TeamName_I = $_POST['TeamName_I'];
$Designation_I = $_POST['Designation_I'];
$user_level_I = $_POST['user_level_I'];
$SkypeID_I = $_POST['SkypeID_I'];
$Gender_I = $_POST['Gender_I'];
$Mobileno_I = $_POST['Mobileno_I'];
$Address_I = $_POST['Address_I'];
$password_I = $_POST['password_I'];
$UserLogin_I = $_POST['UserLogin_I'];
$Department_I = $_POST['Department_I'];
$EmailID_I = $_POST['EmailID_I'];

	
 $sql="INSERT INTO signup(Firstname,Lastname,JoiningDate,Gender,Mobileno,Address,ProadId,EmployeeID,password,UserLogin,Department,TeamName,Designation,EmailID,SkypeID,user_level) VALUES ('".$Firstname_I."','".$Lastname_I."','".$JoiningDate_I."','".$Gender_I."','".$Mobileno_I."','".$Address_I."','".$ProadId_I."','".$EmployeeID_I."','".$password_I."','".$UserLogin_I."','".$Department_I."','".$TeamName_I."','".$Designation_I."','".$EmailID_I."','".$SkypeID_I."','".$user_level_I."')";
		
echo "Added Succesfully";
	
	$result1 = mysqli_query($con,$sql);	
}


?>