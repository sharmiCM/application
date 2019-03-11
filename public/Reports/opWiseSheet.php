<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	$startDate = $_POST['sdate1'];
	$endDate = $_POST['edate1'];
	$opname1 = $_POST['oname1'];
	//$selOps= "SELECT * FROM `storejms` WHERE Received_Time >= '".$startDate."' & Received_Time<='".$endDate."'"; 
	$ip = "SELECT * FROM storejms WHERE Operator_Name = '".$opname1."' AND Received_Date = '".$startDate."' AND File_Status='Yet to assign'";// AND Received_Date <='".$endDate."'";
	$com = "SELECT * FROM storejms WHERE QC_Name = '".$opname1."'  AND Received_Date = '".$startDate."'";// AND Received_Date <='".$endDate."'";  //AND File_Status = 'In QC' 
	$del = "SELECT * FROM storejms WHERE Operator_Name = '".$opname1."' AND File_Status = 'Delivered'  AND Received_Date = '".$startDate."'";// AND Received_Date <='".$endDate."'";
	$hand = "SELECT * FROM storejms WHERE Operator_Name = '".$opname1."' AND File_Status != 'Yet to assign' AND File_Status != 'Delivered' AND File_Status != 'In QC' AND File_Status != 'Assigned' AND Received_Date = '".$startDate."'";// AND Received_Date <='".$endDate."'"; //query to check for handovers
	//$qcFile = "SELECT * FROM storejms WHERE QC_Name = '".$opname1."' AND Received_Date = '".$startDate."'";// AND Received_Date <='".$endDate."'";
	$resa=mysqli_query($con,$ip)or die(mysqli_error());
	$resb=mysqli_query($con,$com)or die(mysqli_error());
	$resc=mysqli_query($con,$del)or die(mysqli_error());
	$resd=mysqli_query($con,$hand)or die(mysqli_error());
	//$rese=mysqli_query($con,$qcFile)or die(mysqli_error());
	
	$noria = mysqli_num_rows($resa);
	$norib = mysqli_num_rows($resb);
	$noric = mysqli_num_rows($resc);
	$norid = mysqli_num_rows($resd);
	//$norie = mysqli_num_rows($rese);
	
	$assignedTotal = (int)$noria+(int)$norib+(int)$noric+(int)$norid;
	//getoperator details with file worked: to display it in the table
	$opTagDMG1 ="<table style='border:1px solid black;'><tr style='background-color: #dddddd;'><th style='border:1px solid black;'>Operator Name</th><th style='border:1px solid black;'>Files Assigned</th><th style='border:1px solid black;'>Files In QC</th><th style='border:1px solid black;'>Files Delivered</th></tr>";
	$opTagDMG1 = $opTagDMG1."<tr><td style='border:1px solid black;text-align: center;'>".$opname1."</td><td style='border:1px solid black;text-align: center;'>".$noria."</td><td  style='border:1px solid black;text-align: center;'>".$norib."</td><td  style='border:1px solid black;text-align: center;'>".$noric."</td></tr></table>";
	
	
	$opTagDMG2Table = "SELECT * FROM storejms WHERE (Operator_Name = '".$opname1."' OR QC_Name='".$opname1."') AND Received_Date = '".$startDate."' AND File_Status!='ForceQuit'";// AND Received_Date <='".$endDate."'
	$resopTagDMG2Table=mysqli_query($con,$opTagDMG2Table)or die(mysqli_error());
	
	$opTagDMG2="";
	//getoperator details with file worked: to display it in the downloaded excel sheet
	$opTagDMG2 ="<table style='border:1px solid black;'><tr style='background-color: #dddddd;'><th style='border:1px solid black;'>Team</th><th style='border:1px solid black;'>Publisher</th><th style='border:1px solid black;'>Magazine</th><th style='border:1px solid black;'>Operator Name</th><th style='border:1px solid black;'>File Name</th><th style='border:1px solid black;'>Start Time</th><th style='border:1px solid black;'>End Time</th><th style='border:1px solid black;'>Assigned Time</th><th style='border:1px solid black;'>Received Time</th><th style='border:1px solid black;'>Complexity</th><th style='border:1px solid black;'>Files Status</th><th style='border:1px solid black;'>QC File</th><th style='border:1px solid black;'>Production/QC hours</th><th style='border:1px solid black;'>OTD</th><th style='border:1px solid black;'>Comments</th><th style='border:1px solid black;'>Core/Aux</th></tr>";
	$opTagDMG2Comp = $opTagDMG2;
	$qc="";
	
	
	while ($ruopTagDMG2Table=mysqli_fetch_assoc($resopTagDMG2Table)){
		if($ruopTagDMG2Table['Delivered_Date']){
		//$prodHrs = 'NA';
		//echo $ruopTagDMG2Table['File_Name']."   ".$ruopTagDMG2Table['QC_Name']."   ".$opname1;
		if($ruopTagDMG2Table['QC_Name']==$opname1){ $qc = 'yes';}
		else{ $qc = 'no';}
		$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
		
		/*for start time -starts*/
		if($ruopTagDMG2Table['Start_Time']){
			$start=splitAndFormat($ruopTagDMG2Table['Start_Time']);
			}
		else if($ruopTagDMG2Table['Assigned_Time']){
			$start=splitAndFormat($ruopTagDMG2Table['Assigned_Time']);
			}
		else{
			$start=splitAndFormat($ruopTagDMG2Table['ReceivedTimeTimer']);
			}
		/*for start time -ends*/
		
		/*for end time -starts*/
		if($ruopTagDMG2Table['End_Time']){
			$end=splitAndFormat($ruopTagDMG2Table['End_Time']);			
			}
		else{
			$startEnd_Time = preg_split("#/#", $ruopTagDMG2Table['Delivered_Date'])[1];
			$End_Time1 = preg_split("#/#", $ruopTagDMG2Table['Delivered_Date']);
			$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$ruopTagDMG2Table['Delivered_Time'];			
			$end=splitAndFormat($End_Time);
		}
			
			$startEnd = formatTime($start,$end);
			$then = new DateTime($startEnd[0]);
			$now = new DateTime($startEnd[1]); 
			if($start){
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

$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";}
else{$OTD="No";}
			
}
else{
	$prodHrs = 'NA';$OTD="NA";
}
			$opTagDMG2 = $opTagDMG2."<tr><td style='border:1px solid black;text-align: center;'>DMG</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Publisher']."</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Magazine'] ."</td><td style='border:1px solid black;text-align: center;'>".$opname1."</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['File_Name']."</td><td  style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Start_Time']."</td><td  style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['End_Time']."</td><td  style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Assigned_Time']."</td><td  style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['ReceivedTimeTimer']."</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Complexity']."</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['File_Status']."</td><td style='border:1px solid black;text-align: center;'>".$qc."</td><td style='border:1px solid black;text-align: center;'>".$prodHrs."</td><td style='border:1px solid black;text-align: center;'>".$OTD."</td><td style='border:1px solid black;text-align: center;'>".$ruopTagDMG2Table['Comments']."</td><td style='border:1px solid black;text-align: center;'>Core</td></tr>";
	}
	}
	
	/*Query to get aux jobs -starts*/
	$query = "SELECT * FROM aux_jobs_dmg WHERE Operator_Name = '".$opname1."' AND Received_Date = '".$startDate."'";
	$reQuer=mysqli_query($con,$query)or die(mysqli_error());
	while ($reQuerTab=mysqli_fetch_assoc($reQuer)){
		$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				$Start_Time = preg_split("#/#", $reQuerTab['Start_Time']); //$now = new DateTime('2005/09/01 10:02:25 PM'); 
				$End_Time = preg_split("#/#", $reQuerTab['End_Time']);
				
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$Start_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$restartTime = str_replace($Start_Time[1],$mon,$reQuerTab['Start_Time']);
					break;
					}
				} //echo $restartTime;
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$End_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$reendTime = str_replace($End_Time[1],$mon,$reQuerTab['End_Time']);	
					break;
					}
				}
				
			//echo $restartTime."____".$reendTime;
				//start
			$finalstartingEndingTimeRet = formatTime($restartTime,$reendTime);		
			//start ends
			
			$then = new DateTime($finalstartingEndingTimeRet[0]);
			$now = new DateTime($finalstartingEndingTimeRet[1]); 
			if($finalstartingEndingTimeRet[1]){
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

$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";}
else{$OTD="No";}
			
}
else{
	$prodHrs = 'NA';$OTD="NA";
}

		$Complexity = (int)$reQuerTab['Simple_Count']."-S; ".(int)$reQuerTab['Medium_Count']."-M; ".(int)$reQuerTab['Complex_Count']."-C; ";
		if($reQuerTab['End_Time']=''){$File_Status='In Progress';}else{$File_Status='Completed';}
		
		
		$opTagDMG2 = $opTagDMG2."<tr><td style='border:1px solid black;text-align: center;'>".$reQuerTab['Team']."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$opname1."</td><td style='border:1px solid black;text-align: center;'>".$reQuerTab['FileName']."</td><td  style='border:1px solid black;text-align: center;'>".$reQuerTab['Start_Time']."</td><td  style='border:1px solid black;text-align: center;'>".$reQuerTab['End_Time']."</td><td  style='border:1px solid black;text-align: center;'>-</td><td  style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$Complexity."</td><td style='border:1px solid black;text-align: center;'>".$File_Status."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$prodHrs."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>Aux</td></tr>";
	}
	/*Query to get aux jobs -ends*/
	
	if($opTagDMG2Comp==$opTagDMG2){
		$opTagDMG2 = $opTagDMG2."<tr><td>No Data available</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
	}
	
	
	
	$opTagDMG2 = $opTagDMG2."</table>";	
	
	
	
			
	echo $opTagDMG1."//RECORD//".$opTagDMG2."//RECORD//".$opTagDMG2Table."//RECORD//".$com;
	
	function formatTime($startTimecall,$endTimecall){
	$repAstart = explode(" ",$startTimecall);	$repAstarttime = explode(":",$repAstart [1] );
		$repAend = explode(" ",$endTimecall);		$repAendtime = explode(":",$repAend [1] );
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
		$finalstartingEndingTime=[$finalstartingTime,$finalendingTime];
		return $finalstartingEndingTime;
}

function splitAndFormat($time){
	$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	$resultTime = preg_split("#/#", $time)[1];
	
	for($i=0;$i<sizeof($mlist);$i++){
		if($mlist[$i]==$resultTime){
			if($i<10){$mon = '0'.$i;}else{$mon = $i;}
			$endResult =str_replace($resultTime,$mon,$time);
		}
	}
	return $endResult;
}
?>