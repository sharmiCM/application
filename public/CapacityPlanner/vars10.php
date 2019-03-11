<?PHP

$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
	date_default_timezone_set('Asia/Calcutta');
	$currentTime=date("H:i:s");
	$divAuxYTC="";$divAvailable="";
	
	$selectOp= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation FROM `signup` where EmployeeID IN (SELECT EmployeeID FROM `login` WHERE out_time='0000-00-00 00:00:0')";
	$ress=mysqli_query($con,$selectOp)or die(mysqli_error());	
	$norri = mysqli_num_rows($ress);
	while ($ru=mysqli_fetch_assoc($ress)){
		$divAvailable="<div style=' color: darkblue; padding-left: 5px; font-weight: 500; cursor: pointer; text-decoration: underline;' onclick='opInfo(this);'><img src='img/user.png' style='width10px;height:10px;'>".$ru['Firstname']." ".$ru['Lastname']." -".$ru['Designation']."</div>".$divAvailable;
	}
	
	$divAuxYTC="";$a=0;
	$q2 = "SELECT Firstname,Lastname,EmployeeID,Designation  FROM `signup`";
	$rq2=mysqli_query($con,$q2)or die(mysqli_error());
	while ($rus=mysqli_fetch_assoc($rq2)){
		$q21 = "SELECT Shiftcode FROM `roster_table` WHERE DATE='".date('Y-m-d')."' AND empid='".$rus['EmployeeID']."'";
		
		$rq21=mysqli_query($con,$q21)or die(mysqli_error());
		while ($rus1=mysqli_fetch_assoc($rq21)){
			$shift = "Shift ".$rus1['Shiftcode'];
			$q22 = "SELECT intime,outtime,Shifts FROM `roster` where Shifts='".$shift."'";
			$rq22=mysqli_query($con,$q22)or die(mysqli_error());
			while ($rus2=mysqli_fetch_assoc($rq22)){
				if($rus2['intime']>date('H:i:s')){
						$divAuxYTC="<div style=' color: darkblue; padding-left: 5px; font-weight: 500; cursor: pointer; text-decoration: underline;' onclick='opInfo(this);'><img src='img/user.png' style='width10px;height:10px;'>".$rus['Firstname']." ".$rus['Lastname']." -".$rus['Designation']."</div>".$divAuxYTC;
				}
			}
		}
	
	}
	
	$divAuxDFD="";
		
	$selectOpDone= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation FROM `signup` where EmployeeID IN (SELECT EmployeeID FROM `login` WHERE out_time>'".date('Y-m-d')." 00:00:0' AND Date='".date('Y-m-d')."')";
	$ress=mysqli_query($con,$selectOpDone)or die(mysqli_error());	
	$norri = mysqli_num_rows($ress);
	while ($ru=mysqli_fetch_assoc($ress)){
		$divAuxDFD="<div style=' color: darkblue; padding-left: 5px; font-weight: 500; cursor: pointer; text-decoration: underline;' onclick='opInfo(this);'><img src='img/user.png' style='width10px;height:10px;'>".$ru['Firstname']." ".$ru['Lastname']." -".$ru['Designation']."</div>".$divAuxDFD;
	}
	echo "<td style='width:35%;border: 1px solid white;'><div class='Available' style='height: 248px;overflow-y: scroll;font-size: 12px;'>".$divAvailable."</div></td>TEAM<td style='width:35%;border: 1px solid white;'><div class='Avail_YTC' style='height: 248px;overflow-y: scroll;font-size: 12px;'>".$divAuxYTC."</div></td>TEAM<td style='width:30%;border: 1px solid white;'><div class='doneForTheDay' style='height: 248px;overflow-y: scroll;'>".$divAuxDFD."</div></td>";
	mysqli_close($con);
?>
	