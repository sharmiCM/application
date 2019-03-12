<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');error_reporting(0);	
//mysqli_select_db('new');
	$startDate = $_POST['sdate'];
	$endDate = $_POST['edate'];
	$interval = $_POST['interval'];
	$currMonthStart = "01/".date("F")."/".date("Y");	//$t1 = date("j M Y");
	$currMonthEnd = "31/".date("F")."/".date("Y")." 12:59:59 PM";	//$t1 = date("j M Y");
	
	$coreUtil="00:00:00";

	if($interval=='no'){		
	$totalImg= "SELECT * FROM `storejms` WHERE 1";
	$totalImgRes=mysqli_query($con,$totalImg)or die(mysqli_error());
	$norTotalImgRes = mysqli_num_rows($totalImgRes);//total image received till date
	
	$totalImg1= "SELECT * FROM `storejms` WHERE Received_Date = '".$startDate."'";// AND Received_Date<='".$endDate."'";
	$totalImgRes1=mysqli_query($con,$totalImg1)or die(mysqli_error());
	$norTotalImgRes1 = mysqli_num_rows($totalImgRes1);//total image received today
	
	$totalImg2= "SELECT * FROM `storejms` WHERE (File_Status='Assigned' OR File_Status='Yet to assign')";
	$totalImgRes2=mysqli_query($con,$totalImg2)or die(mysqli_error());
	$norTotalImgRes2 = mysqli_num_rows($totalImgRes2);//total Assigned (In progress) image today
	
	$totalImg3= "SELECT * FROM `storejms` WHERE File_Status='Delivered' AND Received_Date = '".$startDate."'";// AND Received_Date<='".$endDate."'";
	$totalImgRes3=mysqli_query($con,$totalImg3)or die(mysqli_error());
	$norTotalImgRes3 = mysqli_num_rows($totalImgRes3);//total Delivered image today
	
	$totalEmp= "SELECT * FROM `signup` where TeamName='DMGT' AND user_level!='RESIGNED' ORDER BY `EmployeeID`";
	$totalEmpRes=mysqli_query($con,$totalEmp)or die(mysqli_error());
	$nortotalEmpRes = mysqli_num_rows($totalEmpRes);//total employees working
	
	$totalEmpOn= "SELECT Firstname,Lastname,TeamName,EmployeeID FROM `signup` where TeamName='DMGT' AND EmployeeID IN (SELECT EmployeeID FROM `login` WHERE out_time='0000-00-00 00:00:0')";
	$totalEmpResOn=mysqli_query($con,$totalEmpOn)or die(mysqli_error());
	$nortotalEmpResOn = mysqli_num_rows($totalEmpResOn);//total employees online
		
	//$totalImgMonth= "SELECT * FROM `storejms` WHERE Received_Date >= '".$currMonthStart."' AND Received_Date<='".$currMonthEnd."".date('t')."'";
	$prevCount=0;
	$lasDate = (int)date('t');
	for($i=1;$i<=$lasDate;$i++){
		if($i<10){$da ="0".$i;}else{$da =$i;}
		$totalImgMonth= "SELECT * FROM `storejms` WHERE Received_Date = '".$da."".date("/F/Y")."' AND  File_Status='Delivered'";
		$totalImgMonthRes=mysqli_query($con,$totalImgMonth)or die(mysqli_error());
		$prevCount = $prevCount + (int)mysqli_num_rows($totalImgMonthRes);
	}//total image for the month	
	$nortotalImgMonthRes = $prevCount;
	
	
	$jmsQuery = mysqli_query($con,"SELECT * FROM `storejms` where Received_Date ='".date("d/F/Y")."' AND File_Status='Delivered'");// AND File_Status!='ForceQuit'
	$OTDvarDay = 0;
	$OTDvarHrs = 0;
	$OTDvarMin = 0;
	$OTDvarSec = 0;			
	while ($re=mysqli_fetch_assoc($jmsQuery)){
		//if($re['Delivered_Date']){
		$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		
		if($re['Start_Time']){$startingTime=$re['Start_Time'];}
		else if($re['Assigned_Time']){$startingTime=$re['Assigned_Time'];}
		else{$startingTime=$re['ReceivedTimeTimer'];}	
		if($re['End_Time']){$endingTime=$re['End_Time'];}
		else{
			$delv = explode("/",$re['Delivered_Date']);
			$delv = $delv[2]."/".$delv[1]."/".$delv[0];
			$endingTime=$delv." ".$re['Delivered_Time'];
			}	
		
		
		$Start_Time = explode("/", $startingTime)[1];		
		$End_Time = explode("/", $endingTime)[1];		
		

		for($i=0;$i<sizeof($mlist);$i++){
			if($mlist[$i]==$End_Time){if($i<10){$mon='0'.$i;}else{$mon=$i;}
			$endingTime = str_replace($End_Time,$mon,$endingTime);				
			break;
			}
		}
		for($i=0;$i<sizeof($mlist);$i++){
			if($mlist[$i]==$Start_Time){if($i<10){$mon='0'.$i;}else{$mon=$i;}
			$startingTime = str_replace($Start_Time,$mon,$startingTime);			
			break;
			}
		}
		
		$repAstart = explode(" ",$startingTime);	$repAstarttime = explode(":",$repAstart [1] );
		$repAend = explode(" ",$endingTime);		$repAendtime = explode(":",$repAend [1] );
		$startingTimes='';$endingTimes='';
		for($ii=0;$ii<sizeof($repAstarttime);$ii++){
			if($ii==0){
				if((int)$repAstarttime[$ii]<10){
					$startingTimes='0'.(int)$repAstarttime[$ii];
				}
				else{
					$startingTimes=(int)$repAstarttime[$ii];
				}
			}
			else{
				if((int)$repAstarttime[$ii]<10){
					$startingTimes=$startingTimes.":0".(int)$repAstarttime[$ii];
				}
				else{
					$startingTimes=$startingTimes.":".(int)$repAstarttime[$ii];
				}
			}
		}
		for($ii=0;$ii<sizeof($repAendtime);$ii++){
			if($ii==0){
				if((int)$repAendtime[$ii]<10){
					$endingTimes='0'.(int)$repAendtime[$ii];
				}
				else{
					$endingTimes=(int)$repAendtime[$ii];
				}
			}
			else{
				if((int)$repAendtime[$ii]<10){
					$endingTimes=$endingTimes.":0".(int)$repAendtime[$ii];
				}
				else{
					$endingTimes=$endingTimes.":".(int)$repAendtime[$ii];
				}
			}
		}
		$finalstartingTime=$repAstart[0]." ".$startingTimes." ".$repAstart[2];$finalendingTime=$repAend[0]." ".$endingTimes." ".$repAend[2];
		
	
	
	$then = new DateTime($finalstartingTime);
	$now = new DateTime($finalendingTime);
	if($startingTime){
		$sinceThen = $then->diff($now);
		if($sinceThen->y==0){
			if($sinceThen->m==0){
				if($sinceThen->d==0){
					$prodHrs = $sinceThen->h.':'.$sinceThen->i.':'.$sinceThen->s;
				}
				else{$prodHrs = $sinceThen->d.':'.$sinceThen->h.':'.$sinceThen->i.':'.$sinceThen->s;}
			}
			else{$prodHrs=$sinceThen->m.':'.$sinceThen->d.':'.$sinceThen->h.':'.$sinceThen->i.':'.$sinceThen->s;}
		}
		else{$prodHrs = $sinceThen->y.':'.$sinceThen->m.':'.$sinceThen->d.':'.$sinceThen->h.':'.$sinceThen->i.':'.$sinceThen->s;}
		
		$coreUtil = sum_the_time($coreUtil, $prodHrs);
		/*
		//$OTDvarMon = $sinceThen->m;
		//$OTDvarDay =$OTDvarDay + $sinceThen->d;
		$OTDvarHrs =$OTDvarHrs + $sinceThen->h;
		$OTDvarMin =$OTDvarMin + $sinceThen->i;
		$OTDvarSec =$OTDvarSec + $sinceThen->s;				
		if($OTDvarSec>60){
			$OTDvarMin = round((int)$OTDvarMin+((int)$OTDvarSec/60),0);
			$OTDvarSec=0;
		}
		if($OTDvarMin>60){
			$OTDvarHrs = round((int)$OTDvarHrs+((int)$OTDvarMin/60),0);
			$OTDvarMin=0;
		}*/
		}
		//}
	}
	//$coreUtil = $OTDvarHrs.":".$OTDvarMin.":".$OTDvarSec;
	/*to calculate core utilization  starts*/
	//get actual count from shift roster date('Y-m-d')
	$getActCntQuery= mysqli_query($con,"SELECT * FROM `roster_table` WHERE `Date`='".date('Y-m-d')."' && Team='DMGT' AND Shiftcode!='26' AND (empid!='IN085' AND empid!='IN168' AND empid!='IN601' AND empid!='IN745' AND empid!='IN467' AND empid!='IN647' AND empid!='IN048')")or die(mysqli_error());// to get actual count
	$ActualCountSR = mysqli_num_rows($getActCntQuery);
	
	$totalProdHrssSR = explode(":",$coreUtil);
	$totalProdHrssSR0 = (int)($totalProdHrssSR[0]);
	$totalProdHrssSR1 = (int)($totalProdHrssSR[1])/60;
	$totalProdHrssSR2 = (int)($totalProdHrssSR[2])/60/60;
	$totalProdHrssSR = $totalProdHrssSR0+$totalProdHrssSR1+$totalProdHrssSR2;
	
	$totalProdPerSR = round(($totalProdHrssSR/($ActualCountSR*8))*100,2);
	
//$coreUtil = $OTDvarHrs."h:".$OTDvarMin."m:".$OTDvarSec."s";
/*to calculate core utilization  ends*/
	
	//$norTotalImgRes=(int)$norTotalImgRes1+(int)$norTotalImgRes;	
	echo $norTotalImgRes."COUNT".$norTotalImgRes1."COUNT".$norTotalImgRes2."COUNT".$norTotalImgRes3."COUNT".$nortotalEmpRes."COUNT".$nortotalEmpResOn."COUNT".$nortotalImgMonthRes."COUNT".$totalImgMonth."COUNT".$totalProdPerSR."COUNT";
	}
	else{
		$arS =["01/".date("F")."/".date("Y"),"06/".date("F")."/".date("Y"),"13/".date("F")."/".date("Y"),"20/".date("F")." ".date("Y"),"27/".date("F")."/".date("Y")];
		$arE =["05/".date("F")."/".date("Y")." 12:59:59 PM","12/".date("F")."/".date("Y")." 12:59:59 PM","19/".date("F")."/".date("Y")." 12:59:59 PM","26/".date("F")." ".date("Y")." 12:59:59 PM","31/".date("F")."/".date("Y")." 12:59:59 PM"];
		for($i=1;$i<6;$i++){
			$queryR= "SELECT * FROM `storejms` WHERE Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryRRes=mysqli_query($con,$queryR)or die(mysqli_error());
			$norqueryRRes = mysqli_num_rows($queryRRes);
			$queryIP= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='Assigned' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryIPRes=mysqli_query($con,$queryIP)or die(mysqli_error());
			$norqueryIPRes = mysqli_num_rows($queryIPRes);
			$queryIqc= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='In QC' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryIqcRes=mysqli_query($con,$queryIqc)or die(mysqli_error());
			$norqueryIqcRes = mysqli_num_rows($queryIqcRes);
			$queryD= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='Delivered' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryDRes=mysqli_query($con,$queryD)or die(mysqli_error());
			$norqueryDRes = mysqli_num_rows($queryDRes);
			$queryY= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='Yet to assign' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryYRes=mysqli_query($con,$queryY)or die(mysqli_error());
			$norqueryYRes = mysqli_num_rows($queryYRes);
			$queryFQ= "SELECT * FROM `storejms` WHERE File_Status='ForceQuit' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryFQRes=mysqli_query($con,$queryFQ)or die(mysqli_error());
			$norqueryFQRes = mysqli_num_rows($queryFQRes);
			$queryEc= "SELECT * FROM `storejms` WHERE Error_Type!='' AND Received_Date >= '".$arS[$i-1]."' AND Received_Date<='".$arE[$i-1]."'";
			$queryEcRes=mysqli_query($con,$queryEc)or die(mysqli_error());
			$norqueryEcRes = mysqli_num_rows($queryEcRes);
			if($i==1){
				$weekArr=$norqueryRRes."/".$norqueryIPRes."/".$norqueryIqcRes."/".$norqueryDRes."/".$norqueryYRes."/".$norqueryFQRes."/".$norqueryEcRes;
			}
			else{
				$weekArr=$weekArr."$".$norqueryRRes."/".$norqueryIPRes."/".$norqueryIqcRes."/".$norqueryDRes."/".$norqueryYRes."/".$norqueryFQRes."/".$norqueryEcRes;
			}
		}
		$querysmc1= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND Complexity='Simple' AND Received_Date >= '".$currMonthStart."' AND Received_Date<='".$currMonthEnd."'";
		$querysmcRes1=mysqli_query($con,$querysmc1)or die(mysqli_error());
		$nor1 = mysqli_num_rows($querysmcRes1);
		$querysmc2= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND Complexity='Medium' AND Received_Date >= '".$currMonthStart."' AND Received_Date<='".$currMonthEnd."'";
		$querysmcRes2=mysqli_query($con,$querysmc2)or die(mysqli_error());
		$nor2 = mysqli_num_rows($querysmcRes2);
		$querysmc3= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND Complexity='Complex' AND Received_Date >= '".$currMonthStart."' AND Received_Date<='".$currMonthEnd."'";
		$querysmcRes3=mysqli_query($con,$querysmc3)or die(mysqli_error());
		$nor3 = mysqli_num_rows($querysmcRes3);
		$querysmc4= "SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND Complexity='' AND Received_Date >= '".$currMonthStart."' AND Received_Date<='".$currMonthEnd."'";
		$querysmcRes4=mysqli_query($con,$querysmc4)or die(mysqli_error());
		$nor4 = mysqli_num_rows($querysmcRes4);		
		
		echo $weekArr."*".$nor1.",".$nor2.",".$nor3.",".$nor4;
	}

	
	function sum_the_time($time1, $time2) {
  $times = array($time1, $time2);
  $seconds = 0;
  foreach ($times as $time)
  { //echo $time;
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
?>