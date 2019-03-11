		<?PHP
$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
			$fArr = array();
			$fArr1 = array();
			$i=0;$j=0;
			$opTagDMG = "";$opTagothers = "";$opTagDMG1="";$opTagDMG2="";$opTagDMG3="";$opTagDMG4="";$opTagDMG5="";
			$idleOperators="<ol style='list-style-type:circle'>";
			//$selectOp= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation,Band FROM `signup` where EmployeeID IN (SELECT EmployeeID FROM `login` WHERE out_time='0000-00-00 00:00:00') ORDER BY Firstname ASC";
			$selectOp= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation,Band FROM `signup` where EmployeeID IN (SELECT EmployeeID FROM `login` WHERE out_time IS NULL) ORDER BY Firstname ASC";
			$ress=mysqli_query($con,$selectOp)or die(mysqli_error());	
			$norri = mysqli_num_rows($ress);
			while ($ru=mysqli_fetch_assoc($ress)){
				if($ru['TeamName']=="DMGT"){
					$opTagDMG = $opTagDMG."<option name='".$ru['Firstname']."' value='".$ru['TeamName']."' style='background-color:white;color:Black;' title='".$ru['EmployeeID']."'>".$ru['Firstname']."</option>";$i++;
					if($ru['Designation']!="Production Manager" & $ru['Designation']!="Associate Production Manager")
					$opTagDMG1 = $opTagDMG1.",".$ru['Firstname']." ".$ru['Lastname']." - ".$ru['Designation'];
					
					$selUnAssOp= mysqli_query($con,"SELECT File_Status, Operator_Name FROM `storejms` where Operator_Name ='".$ru['Firstname']."' AND  File_Status='Assigned'")or die(mysqli_error());
					$norresul = mysqli_num_rows($selUnAssOp);
					if($norresul==0){
						$idleOperators=$idleOperators."<li>".$ru['Firstname']."</li>";
					}					
				
				}
				else{
				//$opTagothers = $opTagothers."<option name='".$ru['TeamName']."-Band".$ru['Band']."' value='".$ru['TeamName']."' style='background-color:white;color:Black;' title='".$ru['EmployeeID']."'>".$ru['Firstname']."</option>";$j++;
				$opTagDMG2 = $opTagDMG2.",".$ru['Firstname']." ".$ru['Lastname']." -".$ru['Designation'];
				}
			}
			
			$selectOp= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation,Band FROM `signup` where TeamName!='DMGT' AND TeamName!='Admin' AND user_level!='RESIGNED' ORDER BY Firstname ASC";// AND EmployeeID IN (SELECT EmployeeID FROM `login`) WHERE 1 out_time='0000-00-00 00:00:00'
			$resAux=mysqli_query($con,$selectOp)or die(mysqli_error());
			while ($ruA=mysqli_fetch_assoc($resAux)){
				$opTagothers = $opTagothers."<option name='".$ruA['TeamName']."' value='".$ruA['TeamName']."' style='background-color:white;color:Black;' title='".$ruA['EmployeeID']."'>".$ruA['Firstname']."</option>";
				//$opTagothers = $opTagothers."<option name='".$ruA['TeamName']."' value='".$ruA['TeamName']."' style='background-color:white;color:Black;' title='".$ruA['EmployeeID']."-Band".$ruA['Band']."'>".$ruA['Firstname']."</option>";
			}
			
			$selectOp1= "SELECT Firstname,Lastname,TeamName,EmployeeID,Designation FROM `signup` where TeamName = 'DMGT' ORDER BY Firstname ASC";
			$ress1=mysqli_query($con,$selectOp1)or die(mysqli_error());
			while ($ru1=mysqli_fetch_assoc($ress1)){
				if($ru1['Designation']!="Production Manager" & $ru1['Designation']!="Associate Production Manager"){
				$opTagDMG3 = $opTagDMG3."<option name='".$ru1['EmployeeID']."' value='".$ru1['TeamName']."' style='background-color:white;color:Black;' title='".$ru['TeamName']."-Band".$ru['Band']."'>".$ru1['Firstname']."</option>";
				}
			}
			if($idleOperators=="<ol style='list-style-type:circle'>"){
				$idleOperators="<li>No Idle Operators available.</li></ol>";
			}
			else{
				$idleOperators=$idleOperators."</ol>";
			}
			
			$sel=mysqli_query($con,"SELECT Firstname,Lastname,TeamName,EmployeeID,Designation,Band FROM `signup` where user_level!='RESIGNED' ORDER BY TeamName ASC")or die(mysqli_error());
			while ($re=mysqli_fetch_assoc($sel)){
				if($re['Designation']!="Production Manager" & $re['Designation']!="Associate Production Manager"){
					if($re['TeamName'] == 'Johnlewis'){
						$opTagDMG4 = $opTagDMG4."<option name='".$re['EmployeeID']."' value='".$re['TeamName']."' style='background-color:white;color:Black;' title='Band ".$re['Band']."'>".$re['Firstname']."</option>";
					}
					else{
						$opTagDMG5 = $opTagDMG5."<option name='".$re['EmployeeID']."' value='".$re['TeamName']."' style='background-color:white;color:Black;' title='Band ".$re['Band']."'>".$re['Firstname']."</option>";
					}
				}
			}
			$opTagDMG6='';
			$sel1=mysqli_query($con,"SELECT Firstname,Lastname,TeamName,EmployeeID,Designation,Band FROM `signup` where user_level!='RESIGNED' and user_level!='Admin' and user_level!='MANAGER' ORDER BY Firstname ASC")or die(mysqli_error());
			while ($re=mysqli_fetch_assoc($sel1)){
				$opTagDMG6 = $opTagDMG6."<option name='".$re['EmployeeID']."' value='".$re['TeamName']."' style='background-color:white;color:Black;' title='".$re['EmployeeID'].",".$re['Firstname']."".$re['Lastname'].",".$re['Firstname']."'>".$re['Firstname']."</option>";
			}
			echo $opTagDMG."/FREAK/".$opTagothers."/FREAK/".$opTagDMG1."/FREAK/".$opTagDMG3."/FREAK/".$idleOperators."/FREAK/".$opTagDMG4."/FREAK/".$opTagDMG5."/FREAK/".$opTagDMG6;
				
	mysqli_close($con);  
		?>
