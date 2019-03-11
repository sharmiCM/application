<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	$startDate = $_POST['sdate1'];
	$endDate = $_POST['edate1'];
	$tname1 = $_POST['tname1'];
	$datecond = $_POST['dateCond'];
	$datecondaux = $_POST['dCondAux'];
	$OTSYes=0;$OTDNo=0;
	
	$previousTeamVale='';
	
	$teams=''; $totalDMGHours='00:00:00'; $totalOtherHours='00:00:00';	$totalQCHrsDMG='00:00:00';	$totalDMGCount=0;	$totalOtherCount=0; $totQcDMGCnt=0;
	
	$pubReport="<table style='text-align:center;'>";
	
	$sqlPubInfor = "SELECT * FROM `benchmark`";
	$resb=mysqli_query($con,$sqlPubInfor)or die(mysqli_error());
	
	
	while ($resba=mysqli_fetch_assoc($resb)){
		if($resba['team_Ben']!='DMGT'){// this is for DMG for Others
			if($resba['team_Ben']==$previousTeamVale){
				$magazine=$resba['magazine_Ben'];
				$prodHrsMag = getMagazinesProdHrs($magazine,$startDate,$datecondaux,$con);
				$prodHrsMag = explode(",",$prodHrsMag);				
				$pubReport=$pubReport."<tr><td style='border:1px solid black;'>".$resba['team_Ben']."</td><td style='border:1px solid black;'>".$resba['magazine_Ben']."</td> <td style='border:1px solid black;'>".$prodHrsMag[1]."</td><td style='border:1px solid black;'>".$prodHrsMag[0]."</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>0</td></tr>";	
				$totalOtherCount+=$prodHrsMag[0];
			}
			else{
				$pubReport=$pubReport."<tr style='background-color: darkslategray;color:white;font-weight: bold;'><td style='width:50px;border-right:1px solid white;'>Publisher</td><td style='width:50px;border-right:1px solid white;'>Magazine/Titles</td><td style='width:100px;border-right:1px solid white;'>Total Hours</td><td style='width:100px;border-right:1px solid white;'>Total Images</td><td style='width:100px;border-right:1px solid white;'>Client Admin</td><td style='width:100px;border-right:1px solid white;'>QC</td><td style='width:100px;border-right:1px solid white;'>QA</td><td style='width:100px;border-right:1px solid white;'>QC Count</td><td style='width:50px;'>QA Count</td></tr>";
				$magazine=$resba['magazine_Ben'];
				$prodHrsMag = getMagazinesProdHrs($magazine,$startDate,$datecondaux,$con);
				$prodHrsMag = explode(",",$prodHrsMag);
				$pubReport=$pubReport."<tr><td style='border:1px solid black;'>".$resba['team_Ben']."</td><td style='border:1px solid black;'>".$resba['magazine_Ben']."</td><td style='border:1px solid black;'>".$prodHrsMag[1]."</td><td style='border:1px solid black;'>".$prodHrsMag[0]."</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>0</td></tr>";
				$previousTeamVale =$resba['team_Ben'];	
$totalOtherCount+=$prodHrsMag[0];
			}
			
			$totalOtherHours = sum_the_time($totalOtherHours,$prodHrsMag[1]);	
			
		}
		else{// this is for DMG for 
			if($resba['team_Ben']!=$previousTeamVale){
					$pubReport=$pubReport."<tr style='background-color: darkslategray;color:white;font-weight: bold;'><td style='width:50px;border-right:1px solid white;'>Publisher</td><td style='width:50px;border-right:1px solid white;'>Magazine/Titles</td><td style='width:100px;border-right:1px solid white;'>Total Hours</td><td style='width:100px;border-right:1px solid white;'>Total Images</td><td style='width:100px;border-right:1px solid white;'>Client Admin</td><td style='width:100px;border-right:1px solid white;'>QC</td><td style='width:100px;border-right:1px solid white;'>QA</td><td style='width:100px;border-right:1px solid white;'>QC Count</td><td style='width:50px;'>QA Count</td></tr>";
					$previousTeamVale =$resba['team_Ben'];
			}
		
		$totalPubProdHrsDMG="00:00:00";	$totalPubQCHrsDMG="00:00:00";	$totPubCnt=0; 	$totQcPubCnt=0;
		$startDate = explode("/",$startDate);
		$startDate = $startDate[2]."/".$startDate[1]."/".$startDate[0];
		$publisher = ucfirst(strtolower(ucfirst($resba['magazine_Ben'])));
			$sqlcore = mysqli_query($con,"SELECT * FROM storejms WHERE (".$datecond.") AND Publisher='".$publisher."' AND File_Status='Delivered'")or die(mysqli_error());
			$cql ="SELECT * FROM storejms WHERE ".$datecond." AND Publisher='".$publisher."'";
			while ($resCore=mysqli_fetch_assoc($sqlcore)){
				
			if($resCore['Start_Time']){$startdmgTime=$resCore['Start_Time'];}			
			else if($resCore['Assigned_Time']){$startdmgTime=$resCore['Assigned_Time'];}	
			else if($resCore['ReceivedTimeTimer']){$startdmgTime=$resCore['ReceivedTimeTimer'];}	
			else{$startdmgTime='';}
			
			if($resCore['End_Time']){$enddmgTimes=$resCore['End_Time'];}			
			else if($resCore['Delivered_Date']){
				$delvi=explode("/",$resCore['Delivered_Date']); $delvi = $delvi[2]."/".$delvi[1]."/".$delvi[0]." ".$resCore['Delivered_Time'];
				$enddmgTimes=$delvi;
			}	
			else{$enddmgTimes='';}
				if($startdmgTime && $enddmgTimes){
					
					$formattedTime = formatTime($startdmgTime,$enddmgTimes);//"2018/August/03 11:39:13 AM","2018/August/03 11:51:34 AM");
					//echo "___".$formattedTime[0].",".$formattedTime[1]."___";
					$prodHrsMags = calcHMS($formattedTime[0],$formattedTime[1]);//calcHMS($startdmgTime,$enddmgTimes);//"2018/August/03 11:39:13 AM","2018/August/03 11:51:34 AM"
					$totalPubProdHrsDMG = sum_the_time($totalPubProdHrsDMG,$prodHrsMags);	
					$totPubCnt++;	
					$totalDMGHours = sum_the_time($totalDMGHours,$prodHrsMags);		$totalDMGCount++;
					
				}
			if($resCore['QC_StartTime']){
				$formattedQCTime = formatTime($resCore['QC_StartTime'],$resCore['QC_EndTime']);
				$qcHrsMags = calcHMS($formattedQCTime[0],$formattedQCTime[1]);
				$totalPubQCHrsDMG = sum_the_time($totalPubQCHrsDMG,$qcHrsMags);
				$totalQCHrsDMG = sum_the_time($totalQCHrsDMG,$totalPubQCHrsDMG);
				$totQcPubCnt++;		$totQcDMGCnt++;		
			}
			}
			$pubReport=$pubReport."<tr><td style='border:1px solid black;'>".$resba['team_Ben']."</td><td style='border:1px solid black;'>".$resba['magazine_Ben']."</td> <td style='border:1px solid black;'>".$totalPubProdHrsDMG."</td><td style='border:1px solid black;'>".$totPubCnt."</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>".$totalPubQCHrsDMG."</td><td style='border:1px solid black;'>00:00:00</td><td style='border:1px solid black;'>".$totQcPubCnt."</td><td style='border:1px solid black;'>0</td></tr>";
		}
	}
	
			
			
	$pubReport=$pubReport."<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	
	$pubReport=$pubReport."<tr style='background-color: darkslategray;color:white;font-weight: bold;'><td></td><td>Core:</td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>Production</td> <td style='font-weight: bold;'>Hours:</td><td>".$totalDMGHours."</td><td style='font-weight: bold;'>Count:</td><td>".$totalDMGCount."</td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>QC</td> <td style='font-weight: bold;'>Hours:</td><td>".$totalQCHrsDMG."</td><td style='font-weight: bold;'>Count:</td><td>".$totQcDMGCnt."</td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>QA</td> <td style='font-weight: bold;'>Hours:</td><td>00:00:00</td><td style='font-weight: bold;'>Count:</td><td>0</td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>Client Admin</td> <td></td><td>00:00:00</td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>Quality_NB</td> <td></td><td>00:00:00</td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>Admin_NB</td> <td></td><td>00:00:00</td><td></td><td></td><td></td><td></td><td></td></tr>";
	
	$pubReport=$pubReport."<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	
	$pubReport=$pubReport."<tr style='background-color: darkslategray;color:white;font-weight: bold;'><td></td><td>Aux:</td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>Production</td> <td style='font-weight: bold;'>Hours:</td><td>".$totalOtherHours."</td><td style='font-weight: bold;'>Count:</td><td>".$totalOtherCount."</td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>QC</td> <td style='font-weight: bold;'>Hours:</td><td>00:00:00</td><td style='font-weight: bold;'>Count:</td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr><td></td><td style='font-weight: bold;'>QA</td> <td style='font-weight: bold;'>Hours:</td><td>00:00:00</td><td style='font-weight: bold;'>Count:</td><td></td><td></td><td></td><td></td></tr>";
	
	$pubReport=$pubReport."<tr><td></td><td></td> <td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	$pubReport=$pubReport."<tr style='border-top:1px solid black;border-bottom:1px solid black;'><td></td><td style='font-weight: bold;border-left:1px solid white;border-right:1px solid white;'>Total Production Hours:</td> <td></td><td style='border-right:1px solid white;'>".sum_the_time($totalDMGHours,$totalOtherHours)."</td><td style='border-right:1px solid white;'></td><td style='border-right:1px solid white;'></td><td style='border-right:1px solid white;'></td><td style='border-right:1px solid white;'></td><td style='border-right:1px solid black;'></td></tr>";
			
	$pubReport=$pubReport."</table>";
	//echo $teams;
	echo $pubReport;
	//echo $cql;
	
	function getMagazinesProdHrs($magazine,$startDate,$datecondaux,$con){
		$i=0;$j=0;$totalProHrs="00:00:00";
		$startDate = explode("/",$startDate);
		$startDate = $startDate[2]."/".$startDate[1]."/".$startDate[0];
		$auxQuery=mysqli_query($con,"SELECT * FROM `aux_jobs_dmg` where (".$datecondaux.") AND Magazine='".$magazine."'")or die(mysqli_error());//Received_Date='".$startDate."'
		while ($resba=mysqli_fetch_assoc($auxQuery)){
			//$formattedTime = formatTime($resba['Start_Time'],$resba['End_Time']);
			//echo $restartTime."__".$reendTime;
			if($resba['Start_Time'] && $resba['End_Time']){
			$retProdHrs = calcHMS($resba['Start_Time'],$resba['End_Time']);//$formattedTime[0],$formattedTime[1]);
			$totalProHrs = sum_the_time($totalProHrs,$retProdHrs);
			$i++;
			}
		}
		//echo $i.",".$totalProHrs;
		return $i.",".$totalProHrs;
	}
	
	
	function calcHMS($restartTime,$reendTime){
	$mlist = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	
				$Start_Time = preg_split("#/#", $restartTime); //$now = new DateTime('2005/09/01 10:02:25 PM'); 
				$End_Time = preg_split("#/#", $reendTime);
				//echo $restartTime."__".$reendTime;
				
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$Start_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$restartTime = str_replace($Start_Time[1],$mon,$restartTime);
					break;
					}
				} //echo $restartTime;
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$End_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$reendTime = str_replace($End_Time[1],$mon,$reendTime);	
					break;
					}
				}
		$startTime1=$restartTime;
		$End_Time1=$reendTime;	
	    $formattedTime = formatTime($startTime1,$End_Time1);
		//echo $restartTime."__".$reendTime;
			$then = new DateTime($formattedTime[0]);//$formattedTime[0]);//echo $startTime1;
			$now = new DateTime($formattedTime[1]);//$formattedTime[1]);//echo $End_Time1;
			//$now = new DateTime('2005/09/01 10:02:25 PM'); 
				$sinceThen = $then->diff($now);
				//$prodHrs = $sinceThen->y.':'.$sinceThen->m.':'.$sinceThen->d.':'.$sinceThen->h.':'.$sinceThen->i.':'.$sinceThen->s;

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
				return $prodHrs;
}

function formatTime($start,$end){
	//echo $start.",".$end;
	$repAstart = explode(" ",$start);	$repAstarttime = explode(":",$repAstart [1] );
		$repAend = explode(" ",$end);		$repAendtime = explode(":",$repAend [1] );
		$startingTime='';$endingTime='';
		for($ii=0;$ii<sizeof($repAstarttime);$ii++){
			if($ii==0){
				if((int)$repAstarttime[$ii]<10){
					$startingTime='0'.(int)$repAstarttime[$ii];
				}
				else{
					$startingTime=(int)$repAstarttime[$ii];
				}
			}
			else{
				if((int)$repAstarttime[$ii]<10){
					$startingTime=$startingTime.":0".(int)$repAstarttime[$ii];
				}
				else{
					$startingTime=$startingTime.":".(int)$repAstarttime[$ii];
				}
			}
		}
		for($ii=0;$ii<sizeof($repAendtime);$ii++){
			if($ii==0){
				if((int)$repAendtime[$ii]<10){
					$endingTime='0'.(int)$repAendtime[$ii];
				}
				else{
					$endingTime=(int)$repAendtime[$ii];
				}
			}
			else{
				if((int)$repAendtime[$ii]<10){
					$endingTime=$endingTime.":0".(int)$repAendtime[$ii];
				}
				else{
					$endingTime=$endingTime.":".(int)$repAendtime[$ii];
				}
			}
		}
		$finalstartingTime=$repAstart[0]." ".$startingTime." ".$repAstart[2];$finalendingTime=$repAend[0]." ".$endingTime." ".$repAend[2];
		$finalTime=[$finalstartingTime,$finalendingTime];
		return $finalTime;
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
?>