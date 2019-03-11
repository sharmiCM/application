<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	$selOps= "SELECT * FROM `complexitytime`";

	$resus=mysqli_query($con,$selOps)or die(mysqli_error());
	//$nori2 = mysqli_num_rows($resus);
	while ($rus=mysqli_fetch_assoc($resus)){
	}
		date_default_timezone_set('Asia/Calcutta');	
		$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
		if((int)$dates>7){
			$dateForQuery = "Received_Date='".date('d/F/Y')."'";
		}
		else{
			$dateForQuery = "Received_Date='".date("d/F/Y")."' AND Received_Date='".date('d/F/Y', strtotime('-1 day'))."'";
		}
	
	$jmsQuery = mysqli_query($con,"SELECT * FROM `storejms` where ".$dateForQuery." AND File_Status='Delivered' AND File_Status!='ForceQuit'");//Received_Date ='".date("d/F/Y")."'
	
	$OTSYes=0;$OTSNo=0;$OTSNA=0;
	$nori2 = mysqli_num_rows($jmsQuery);
	$file="<table id='getOTDtable' style='font-size: xx-small;border: 1px solid #F1E41A;'><tr><th>File_Name</th><th>Process Time</th><th>Operator</th><th>Received_Time</th><th>Assigned_Time</th><th>Delivered_Time</th><th>Complexity</th></tr>";
	while ($re=mysqli_fetch_assoc($jmsQuery)){
		$receivedTimeTimer =$re['Start_Time'];
		
		$getStartEndTime = getStartEndFn($re);
			$getStartEndTime = explode(",",$getStartEndTime);
			
			//if($re['End_Time']){
				$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				if($getStartEndTime[0] && $getStartEndTime[1]){//if($re['Start_Time'] && $re['End_Time']){
				$Start_Time = preg_split("#/#", $getStartEndTime[0])[1];
				$End_Time = preg_split("#/#", $getStartEndTime[1])[1];
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$Start_Time){if($i<10){$mon='0'.$i;}else{$mon=$i;}
				$getStartEndTime[0] = str_replace($Start_Time,$mon,$getStartEndTime[0]);
				$getStartEndTime[1] = str_replace($End_Time,$mon,$getStartEndTime[1]);
				break;
				}
				}
				$repAstart = explode(" ",$getStartEndTime[0]);	$repAstarttime = explode(":",$repAstart [1] );
		$repAend = explode(" ",$getStartEndTime[1]);		$repAendtime = explode(":",$repAend [1] );
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
			$now = new DateTime($finalendingTime);//$re['Delivered_Date']." ".$re['Delivered_Time']);
			//$now = new DateTime('2005/09/01 10:02:25 PM'); 
			if($getStartEndTime[0]){
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
				//echo $prodHrs."".$re['Publisher']."- -";
				
			$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
			if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes++;}
			else{
				$OTD="No";$OTSNo++;
				$file =$file."<tr><td>".$re['File_Name']."</td><td style='text-align:center;'>".$prodHrs."</td><td style='text-align:center;'>".$re['Operator_Name']."</td><td>".$receivedTimeTimer."</td><td>".$re['Assigned_Time']."</td><td>".$re['Delivered_Date']." ".$re['Delivered_Time']."</td><td style='text-align:center;'>".$re['Complexity']."</td></tr>";
				}
			}
			else{
				$prodHrs = 'NA';$OTD="NA";$OTSNA++;
			}
			}
			//}
	}
	$file =$file."</table>";
	$band1=0;$band2=0;$band3=0;
	$bandVar="<h5 style='color: gray;'>BAND INFORMATION:</h5><table><tr><th style='border:1px solid #264031;color:white;background-color:#5F9EA0;'>Band Type</th><th style='border:1px solid #264031;color:white;background-color:#5F9EA0;'>Head Count</th></tr>";
	$bandQuery =mysqli_query($con,"SELECT * FROM `signup` WHERE TeamName='DMGT' AND user_level!='RESIGNED'")or die(mysqli_error());
	while ($resB=mysqli_fetch_assoc($bandQuery)){
		if($resB['Band']==1){$band1++;}
		if($resB['Band']==2){$band2++;}
		if($resB['Band']==3){$band3++;}
	}
	$bandVar=$bandVar."<tr style='text-align:center;'><td style='border:1px solid #3F5666;'>BAND 1</td><td style='border:1px solid #3F5666;'>".$band1."</td></tr><tr style='text-align:center;'><td style='border:1px solid #3F5666;'>BAND 2</td><td style='border:1px solid #3F5666;'>".$band3."</td></tr><tr style='text-align:center;'><td style='border:1px solid #3F5666;'>BAND 3</td><td style='border:1px solid #3F5666;'>".$band2."</td></tr>";
	$bandVar=$bandVar."</table>";
	echo $OTSYes."*".$OTSNo."*".$OTSNA."*".$nori2."*".$file."*".$bandVar;
	


function getStartEndFn($res){
	if($res['End_Time']){
		$endTime = $res['End_Time'];
	}
	else{// if($res['Delivered_Date']){
		$delDate = explode("/",$res['Delivered_Date']);
		$delDatefin = $delDate[2]."/".$delDate[1]."/".$delDate[0];
		$endTime = $delDatefin." ".$res['Delivered_Time']; //echo $endTime;
	}
	//else{
	//	$endTime ='';
	//}
	
	if($res['Start_Time']){
		$startTime = $res['Start_Time'];
	}
	else if($res['Assigned_Time']){
			$startTime=$res['Assigned_Time'];
	}
	else{
		$startTime = $res['ReceivedTimeTimer'];
	}
	//if($res['File_Name']=='15335827712974342_IDMNEWS-C-275049045.jpg'){
	//	echo $startTime.",".$endTime;
	//}
	
	return $startTime.",".$endTime;
}	
?>
