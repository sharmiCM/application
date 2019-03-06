		<?PHP
			//include("dbConfig.php");
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
			$dates = $_POST['date'];
			$name = $_POST['name'];
			$empId = $_POST['empId'];
			$check = $_POST['check'];
			//$month = $_POST['month'];
			
			if($check==0){
				$i=0;			
				$chkQuery = mysqli_query($con,"select * from attendance where Date='".$dates."' AND Name='".$name."' AND empId='".$empId."'")or die(mysqli_error());
				$norR = mysqli_num_rows($chkQuery);
				
				if($norR>0){
					echo "You have already marked your attendance.";
				}
				else{
					
						date_default_timezone_set('Asia/Calcutta');
						$curDate=date('Y-m-d G:i:s');
						
						$getshiftCode=mysqli_query($con,"SELECT Shiftcode,empid,Team FROM `roster_table` WHERE Date='".date('Y-m-d')."' AND empid='".$empId."'")or die(mysqli_error($getshiftCode));
						while ($rb=mysqli_fetch_assoc($getshiftCode)){
							
							$getShiftTime=mysqli_query($con,"SELECT * FROM `roster` where ID='".$rb['Shiftcode']."'")or die(mysqli_error());
							while ($rc=mysqli_fetch_assoc($getShiftTime)){
								
								$intime = date('Y-m-d')." ".$rc['intime'];

								/*calc login time for late login check - starts*/
								$timestamp1 = strtotime($intime);
								$timestamp2 = strtotime($curDate);
								$usedHour = ($timestamp1 - $timestamp2);
								
								if(((int)$usedHour)<0){
									$message="Late Login. You have successfully marked your presence.";$late=1;
								}
								else{
									$message="You have successfully marked your presence.";$late=0;
								}
								
								$maneMail="";
								$getMngr = mysqli_query($con,"select Manager from `signup` WHERE EmpolyeeID='".$empId."'")or die(mysqli_error());
								while ($rd=mysqli_fetch_assoc($getMngr)){
									$maneMail=$rd['Manager'];
								}
								
								$opeMail="";
								$getOptr = mysqli_query($con,"select TeamName, EmailID from `signup` WHERE EmpolyeeID='".$empId."'")or die(mysqli_error());
								while ($re=mysqli_fetch_assoc($getOptr)){
									$opeMail=$re['EmailID'];
								}
								if($i==0){
								$sqlAtt = mysqli_query($con,"INSERT INTO `attendance`(Name,empId,Date,markinDate,Late) VALUES ('".$name."','".$empId."','".$dates."','".$curDate."','".$late."')")or die(mysqli_error());
								//(Number(msg[4]))/60+" mins late
								$comments = round(abs(((int) $usedHour)/60),0);
								$i++;
								echo $message;
								}
							}
					}
				}
			}
			else if($check==1){
				$lateVal="";$weekOffs='';
				date_default_timezone_set('Asia/Calcutta');$markinDate="";$markoutDate="";
				$dateds = explode("/",$_POST['calDate']);
				$d=cal_days_in_month(CAL_GREGORIAN,(int)$dateds[1],(int)$dateds[2]);
				
				$chkQuery = mysqli_query($con,"select * from attendance where Date='".$_POST['calDate']."' AND empId='".$empId."'")or die(mysqli_error());
				$norR = mysqli_num_rows($chkQuery);
				while ($rec=mysqli_fetch_assoc($chkQuery)){
					$markinDate=$rec['markinDate'];$markoutDate=$rec['markoutDate'];
					$lateVal = $rec['Late'];
				}
				
				if($lateVal==""){
					$weekOffsQuery = mysqli_query($con,"select * from roster_table where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND empid='".$empId."'")or die(mysqli_error());
					while ($resc=mysqli_fetch_assoc($weekOffsQuery)){
						if($resc['Shiftcode']=='26'){
							$weekOffs=1;
						}
					}
				}
				$reason='';
				$lateReason = mysqli_query($con,"select * from login where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND EmployeeID='".$empId."'")or die(mysqli_error());
				while ($rescs=mysqli_fetch_assoc($lateReason)){
						$reason = $rescs['Reason'];
				}
				$shedI='';$shedO='';$hrePres="-";
				$getRosterTimes = mysqli_query($con,"select * from roster_table where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND empid='".$empId."'")or die(mysqli_error());
				while ($re=mysqli_fetch_assoc($getRosterTimes)){
					$actTime =  mysqli_query($con,"SELECT * FROM `roster` where ID='".$re['Shiftcode']."'")or die(mysqli_error());
					while ($re1=mysqli_fetch_assoc($actTime)){
						$shedI=$re1['intime'];$shedO=$re1['outtime'];
						if(!$markoutDate){
							$hrePres="-";
						}
						else{
							$timestamp1 = strtotime($markinDate);
							$timestamp2 = strtotime($markoutDate);
							$hrePres = round(($timestamp2-$timestamp1)/3600,2);
						}
					}
				}
				$unixTimestamp = strtotime($dateds[2]."-".$dateds[1]."-".$dateds[0]); 
				$dayOfWeek = date("l", $unixTimestamp);
				
					//$gets='';$gets1='';
				//get future shifts
				$timestamp1 = strtotime($_POST['calDate']);
				$timestamp2 = strtotime(date('d/m/Y'));
				$futureShifts="";
				$differ = $timestamp2-$timestamp1;
				if($differ<0){
					$getRoster = mysqli_query($con,"select * from roster_table where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND empid='".$empId."'")or die(mysqli_error());
					//$gets ="select a from rostertable where DATE='".$dateds[2]."-".$dateds[1]."-".$dateds[0]."' AND empid='".$empId."'";
					while ($r1=mysqli_fetch_assoc($getRoster)){
						//$gets1 = "SELECT a FROM `roster` where ID='".$r1['Shiftcode']."'";
						$getRosterCode = mysqli_query($con,"SELECT * FROM `roster` where ID='".$r1['Shiftcode']."'")or die(mysqli_error());
						while ($r2=mysqli_fetch_assoc($getRosterCode)){
						$futureShifts = $r2['Shifts'];
						}
					}
				}
								
			echo $lateVal."*".$d."_".$dateds[0]."_".$_POST['calDate']."_".$_POST['trow']."_".$_POST['tdata']."_".$markinDate."_".$weekOffs."_".$futureShifts."_".$shedI."_".$shedO."_".$markoutDate."_".$hrePres."_".$dayOfWeek."_".$reason;//$gets."_".$gets1;//$timestamp1.":".$_POST['calDate']." _".$timestamp2.":".date('d/m/Y')."_".$futureShifts;	
			}
		else{
			
		}
		
			
		?>
