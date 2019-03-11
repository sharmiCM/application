<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
$team=$_POST['team'];
if($team=='Dmg'){$team1='DMGT';}if($team=='JL'){$team1='Johnlewis';}

	
	date_default_timezone_set('Asia/Calcutta');$elapseTime=0;
	$currentTime=date('Y-m-d G:i:s');
	
	//echo $currentTime."--------";
	
	$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
	if((int)$dates>7){
		$dateForQuery = date('Y-m-d');
		$dateForQueryJMS = "Received_Date='".date('d/F/Y')."'";
	}
	else{
		$dateForQuery = date('Y-m-d', strtotime('-1 day'));
		$dateForQueryJMS = "Received_Date='".date("d/F/Y")."' AND Received_Date='".date('d/F/Y', strtotime('-1 day'))."'";
	}


$a=0;$empIdVal="(";
	$getActCnt =mysqli_query($con,"SELECT EmployeeID FROM `signup` where user_level!='RESIGNED' AND TeamName='".$team1."' AND user_level!='LEAD'")or die(mysqli_error());
	while ($rActCnt=mysqli_fetch_assoc($getActCnt)){
		if($a==0){
			$empIdVal="(EmployeeID='".$rActCnt['EmployeeID']."'";
		}
		else{
			$empIdVal=$empIdVal. " OR EmployeeID='".$rActCnt['EmployeeID']."'";
		}
		$a++;
	}
	$empIdVal=$empIdVal.")";
	$actualCount = mysqli_num_rows($getActCnt);
	$shiftCodeEmpid='';
	$getloginTime=mysqli_query($con,"SELECT * FROM `login` WHERE Date='".$dateForQuery."' AND out_time IS NULL")or die(mysqli_error());// AND ".$empIdVal//='0000-00-00 00:00:00'
	$teams='';$availableCount=0;$i=0;$totalRemSeconds="00:00:00";
	$totalLostSeconds="00:00:00";$remOperatorCount=0;
	
	while ($ra=mysqli_fetch_assoc($getloginTime)){
		$reached=0;//echo "SELECT Shiftcode,empid FROM `roster_table` WHERE Date='".date('Y-m-d')."' AND Team='".$team1."' AND empid='".$ra['EmployeeID']."';";
		$getshiftCode=mysqli_query($con,"SELECT Shiftcode,empid FROM `roster_table` WHERE Date='".date('Y-m-d')."' AND Team='".$team1."' AND empid='".$ra['EmployeeID']."'")or die(mysqli_error($getshiftCode));	
		while ($rb=mysqli_fetch_assoc($getshiftCode)){
		$availableCount++;
			if($reached==0){
$reached++;				
				$rbs=$ra['EmployeeID'];		$remOperatorCount++;
			
			$getShiftTime=mysqli_query($con,"SELECT * FROM `roster` where ID='".$rb['Shiftcode']."'")or die(mysqli_error());
			while ($rc=mysqli_fetch_assoc($getShiftTime)){			
				
				$shiftStartHour=explode(":",$rc['intime']); 
				$shiftEndHour=explode(":",$rc['outtime']); 
				
				if($shiftStartHour[0] < $shiftEndHour[0]){
					$startDate= date('Y-m-d')." ".$rc['intime'];
					$endDate=date('Y-m-d')." ".$rc['outtime'];
					$hrs = calcUsedHrs($rbs,$startDate,$currentTime,$endDate);		$hrs = explode("_",$hrs);										
					$totalLostSeconds=sum_the_time($totalLostSeconds,$hrs[0]);										
					$totalRemSeconds=sum_the_time($totalRemSeconds,$hrs[1]);	
					$elapseTime = calcElapsedTime($dateForQuery,$rbs,$currentTime,$elapseTime,$startDate,$endDate); //echo $rbs.":- Used".$hrs[0].", Rem:".$hrs[1]."____";
				}
				else{
					$startDate= date('Y-m-d')." ".$rc['intime'];
					$endDate=date('Y-m-d', strtotime('+1 day'))." ".$rc['outtime'];
					$hrs = calcUsedHrs($rbs,$startDate,$currentTime,$endDate);		$hrs = explode("_",$hrs);			
					$totalLostSeconds=sum_the_time($totalLostSeconds,$hrs[0]);					
					$totalRemSeconds=sum_the_time($totalRemSeconds,$hrs[1]);
					$elapseTime = calcElapsedTime($dateForQuery,$rbs,$currentTime,$elapseTime,$startDate,$endDate); //echo $rbs.":- Used".$hrs[0].", Rem:".$hrs[1]."____";
				}
			}
		}
		}
		
	}
	if($team1=='DMGT'){$tat = 900;
	$forAHC=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status='Assigned' OR File_Status='Yet to assign' OR File_Status='Need QC'")or die(mysqli_error());
	$totalImageCounts = mysqli_num_rows($forAHC);
	$totalAHCRemSeconds = $totalImageCounts - $availableCount;
	}
	else if($team1=='Johnlewis'){$tat = 1440;}
	
	if($totalAHCRemSeconds<0){
		$totalAHCRemSeconds=0;
	}
	else{
		$totalAHCRemSeconds= $totalAHCRemSeconds." (".secondsToHMS($totalAHCRemSeconds*$tat).")";
	}
	$getActCnt =mysqli_query($con,"SELECT EmployeeID FROM `signup` where user_level!='RESIGNED' AND TeamName='".$team1."' AND user_level!='LEAD'")or die(mysqli_error());
	$actualCount = mysqli_num_rows($getActCnt);
	
	$weekoffCnt =mysqli_query($con,"SELECT * FROM `roster_table` WHERE Shiftcode='26' and DATE='".date('Y-m-d')."'")or die(mysqli_error());
	$weekoffCount = mysqli_num_rows($weekoffCnt);

	$actualCount=$actualCount-$weekoffCount;
	$totalProdHours="00:00:00";
	$elapseTime = secondsToHMS($elapseTime);
		
	echo $availableCount."BREAK".$totalRemSeconds."BREAK".$totalAHCRemSeconds."BREAK".$totalLostSeconds."BREAK".$actualCount."BREAK".$weekoffCount."BREAK".$remOperatorCount."BREAK".($availableCount*8).":00:00BREAK".$totalProdHours."BREAK".$elapseTime."__".$team;
	
	function calcElapsedTime($dateForQuery,$rbs,$currentTime,$elapseTime,$startDate,$endDate){
		$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
		$elapseQue = mysqli_query($con,"SELECT * FROM `login` WHERE Date='".$dateForQuery."' AND EmployeeID='".$rbs."'")or die(mysqli_error());// AND out_time='0000-00-00 00:00:00'
		$elapsingTime=0;
		while ($ree=mysqli_fetch_assoc($elapseQue)){
			$Shift_start = strtotime($startDate);
			$Shift_end = strtotime($endDate);
			$login_Time = strtotime($ree['Time']);
			//$logout_Time = strtotime($ree['out_time']);
			
			if($login_Time<$Shift_start){
				// check if the elapsed time is greater than 2 hours				
				$elapsingTime += $Shift_start - $login_Time;
			}
			if($currentTime>$Shift_end){
				$elapsingTime += $currentTime - $Shift_end;				
			}
if($elapsingTime<7200){
	$elapseTime+=0;
}
else{
	$elapseTime=$elapseTime+$elapsingTime;
}	
		}
		return $elapseTime;
	}

	
	function calcUsedHrs($rbs,$inTime,$currentTime,$outtime){		
		$today_start = strtotime($inTime);
		$today_end = strtotime($outtime);
		$date_timestamp = strtotime($currentTime);
		
		if ($date_timestamp > $today_start  && $date_timestamp <= $today_end ) {//to check if the current time is between the shift roaster time
		$usedTime = $date_timestamp - $today_start;
		$remTime = $today_end - $date_timestamp;
			//echo $rbs.":- Used:".secondsToHMS($usedTime).";  Rem:".secondsToHMS($remTime)."____";
		}
		else{
			$usedTime=0;$remTime=32400;
		}
		return 	secondsToHMS($usedTime)."_".secondsToHMS($remTime-3600);
	}

	
	function secondsToHMS($seconds){
		$hours = floor($seconds / 3600);	if($hours<10){$hours="0".$hours;}
		$minutes = floor(($seconds / 60) % 60);	if($minutes<10){$minutes="0".$minutes;}
		$seconds = $seconds % 60;if($seconds<10){$seconds="0".$seconds;}
		return "$hours:$minutes:$seconds";
	}
  
	function sum_the_time($time1, $time2) {
	  $times = array($time1, $time2);
	  $seconds = 0;
	  foreach ($times as $time)
	  {
		list($hour,$minute,$second) = explode(':', $time);
		$seconds += $hour*3600;
		$seconds += $minute*60;
		$seconds += $second;
	  }
	  $hours = floor($seconds/3600);
	  $seconds -= $hours*3600;
	  $minutes  = floor($seconds/60);
	  $seconds -= $minutes*60;
	  // return "{$hours}:{$minutes}:{$seconds}";
	  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
	}

	function diff_the_time($totalHours){
		$time1 = strtotime($totalHours);
		$time2 = strtotime('24:00:00');
		$difference = ($time2 - $time1);//round(abs($time2 - $time1) / 3600,2);
		$hours = floor($difference / 3600); if($hours<10){$hours ='0'.$hours;}
		$minutes = floor(($difference / 60) % 60); 	if((int)$minutes<10){$minutes ='0'.$minutes;}
		$seconds = $difference % 60; if($seconds<10){$seconds ='0'.$seconds;}
		if($hours || $minutes || $seconds){
			$finHours = $hours.":".$minutes.":".$seconds;
		}
		return $finHours;
	}
?>