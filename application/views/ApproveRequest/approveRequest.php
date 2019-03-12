
<?PHP 
//include("dbConfig.php");
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
$empID = $_POST['empID'];
$empName = $_POST['empName'];
$count = $_POST['count'];
date_default_timezone_set('Asia/Calcutta');


if($count==1){
	//get employee's manager's code from signup
	$getManCode=mysqli_query($con,"SELECT * FROM `signup` WHERE EmailID IN( SELECT Manager FROM `signup` WHERE EmployeeID = '".$empID."')")or die(mysqli_error());
	while ($res=mysqli_fetch_assoc($getManCode)){
		$manCode=$res['EmployeeID'];
		$attQuery = mysqli_query($con,"UPDATE `attendance` SET requestTo='".$manCode."' WHERE empId='".$empID."' AND Name='".$empName."' AND markoutDate=''")or die(mysqli_error());//need code to request for approval
	}
}
else{
	$forEmp = $_POST['forEmp'];
	
	$attQuery = mysqli_query($con,"UPDATE `attendance` SET Approved='yes', markoutDate='".date('Y-m-d G:i:s')."' WHERE requestTo='".$empID."' AND empId='".$forEmp."' AND markoutDate=''")or die(mysqli_error());//need code to request for approval
}
 ?>
