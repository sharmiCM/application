
<?PHP
session_start();
error_reporting(0);
$datee = $_POST['datee'];
$datee1 = $_POST['datee1'];
 echo $_SESSION['date1_roster'] = $datee1;
 echo $_SESSION['date_ros'] = $datee;
 $dateee = $_SESSION['date_roster'];
 $dateee1 = $_SESSION['dateee11'];
   $Shiftcode = $_SESSION['shi'];
 $eid = $_SESSION['eide'];

//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
 if(isset($_POST["teamname"]) && !empty($_POST["teamname"])){
    
		$query1 = mysqli_query($con,"SELECT s.TeamName,s.EmployeeID,s.Firstname,s.Lastname FROM signup s WHERE '".$_POST["teamname"]."' = s.TeamName");
		
    $num_rows = mysqli_num_rows($query1);
    
    if($query1 > 0){
	echo '<option value="">Select Team</option>';
		while ($row = mysqli_fetch_array($query1)) {
			echo '<option value="'.$row['EmployeeID'].'" >'.$row['Firstname'].$row['Lastname'].'</option>';
			}
        }
    else{
        echo '<option value="">Team not available</option>';
    }
}
 if(isset($_POST["NameeID"]) && !empty($_POST["NameeID"])){
echo $_POST['NameeID'];
  $query = mysqli_query($con,"SELECT r.Shiftcode,r.empid,r.DATE  FROM roster_table r WHERE  r.DATE BETWEEN '".$dateee."' AND '".$dateee1."' AND r.empid = '".$_POST['NameeID']."'");
    $num_rows1 = mysqli_num_rows($query);
        while ($row = mysqli_fetch_assoc($query)) 
		{
             $chosenCategory = $row['Shiftcode'];
        }
		$q=mysqli_query($con,"select * from roster");
			while ($maincategory=mysqli_fetch_array($q))
	{
	if($maincategory['ID'] == $chosenCategory)
		{
			echo "<option name= Shift style=background-color:#BCE77C; selected value='".$maincategory['ID']."'  > '".$maincategory['Shifts']."'</b></option>";	
	
		}
	else
		{
			echo "<option style=background-color:#BCE77C; name=Shift value=$maincategory[ID] >$maincategory[Shifts]</b></option>";
		}
	}		   
}
 if(isset($_POST["Shiftcode"]) && !empty($_POST["Shiftcode"])){
  echo $_POST["Shiftcode"];
  echo $_POST['NameeID'];
  //$query = mysqli_query($con,"SELECT r.Shiftcode,r.empid,r.DATE FROM roster_table r WHERE r.DATE = '".$dateee."' AND r.empid = '".$_POST['NameeID']."'");


}


  
if(isset($_POST['submit']) == 'Update'){
/* mysqli_query($con,"UPDATE roster_table SET Shiftcode = '".$a."' WHERE DATE = '".$dateee."' AND empid = '".$_POST['NameeID']."'");
echo $dateee;
echo $_SESSION['shi']; 
*/



  $roster = ("UPDATE roster_table SET Shiftcode = ".$Shiftcode." WHERE DATE >= '".$dateee."' AND DATE  <= '".$dateee1."' AND empid = '".$eid."'");
  $result=mysqli_query($con,$roster);
   echo "<script>alert('Success')</script>";
   echo "<script>alert('$roster')</script>";
header("Refresh: 1; url=http://localhost:8080/PPIS/HomeScreen/rosterUpdate");
//echo "<script>window.open('roster_update.php','_self')</script>";
 
}


$shift_h =$_POST['shift_h'];
if(isset($_POST['shift_h']) == '1'){
echo"$shift_h";

}

 

?>