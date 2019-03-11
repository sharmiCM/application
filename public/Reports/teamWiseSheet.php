<?PHP
	$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
	$startDate = $_POST['sdate1'];
	$endDate = $_POST['edate1']; $test1=0; $test2=0;$test1V=''; $test2V='';
	$tname1 = $_POST['tname1'];$OTSYes=0;$OTDNo=0;
	//$sql = "SELECT * FROM storejms WHERE Received_Date >= '".$startDate."' AND Received_Date <='".$endDate."' AND Team_Name='".$tname1."'"; 
	$totalProdHrsSR="00:00:00";$totalProdHoursAuxSR='00:00:00';$totalProdHoursAdminSR="00:00:00";
	$sql = "SELECT * FROM storejms WHERE Received_Date = '".$startDate."' OR Received_Date = '".$endDate."' AND Team_Name='".$tname1."' AND File_Status='Delivered'"; 
	$totalProdHrsSR="00:00:00";$totalProdHoursAuxSR='00:00:00';$totalProdHoursAdminSR="00:00:00";
	$resa=mysqli_query($con,$sql)or die(mysqli_error());
	
	$opTagDMG2 ="<table style='border:1px solid black;'><tr style='background-color: #dddddd;'><th style='border:1px solid black;'>Team</th><th style='border:1px solid black;'>Publisher_name</th><th style='border:1px solid black;'>Magazine_name</th><th style='border:1px solid black;'>Issue Folder Name</th><th style='border:1px solid black;'>Job description</th><th style='border:1px solid black;'>Type</th><th style='border:1px solid black;'>Simple</th><th style='border:1px solid black;'>Medium</th><th style='border:1px solid black;'>Complex</th><th style='border:1px solid black;'>Start_Time</th><th style='border:1px solid black;'>End_Time</th><th style='border:1px solid black;'>Production Hours</th><th style='border:1px solid black;'>Total Count</th><th style='border:1px solid black;'>Operator</th><th style='border:1px solid black;'>Status</th><th style='border:1px solid black;'>Error_Count</th><th style='border:1px solid black;'>Error_Type</th><th style='border:1px solid black;'>Employee ID</th><th style='border:1px solid black;'>Received Date</th><th style='border:1px solid black;'>Assigned Operator Name</th><th style='border:1px solid black;'>Overtime</th><th style='border:1px solid black;'>Complexity</th><th style='border:1px solid black;'>TeamName</th><th style='border:1px solid black;'>Core/Aux</th></tr>";// this is only for production
	
	$shiftReport="<table style='width:70%;line-height: 35px;text-align: center;'><tr><td style='border-left:1px solid black;border-top:1px solid black;font-weight: 600;'>&nbsp&nbsp".$startDate."</td><td style='border-top:1px solid black;' ></td><td style='border-top:1px solid black;'></td><td style='border-top:1px solid black;border-left:1px solid black;font-weight: 600;'>Daily Shift Report</td><td style='border-top:1px solid black;' ></td><td style='border-top:1px solid black;'></td><td style='border-top:1px solid black;'></td><td style='border-top:1px solid black;'></td><td style='border-top:1px solid black;border-right:1px solid black;'></td></tr>";
	
	$newsCountSR=0; $magCountSR=0; $delCountSR=0; $handCountSR=0; $lateCountSR=0; $otdPerSR=0; $intQualSR=0; $extQualSR='100%'; $cartoonCountSR=0; $colorupCountSR=0; $mailCountSR=0; $complexCountSR=0; $mediumCountSR=0;$simpleCountSR=0;
	
	while ($res=mysqli_fetch_assoc($resa)){
		if($res['Received_Date']==$startDate){
			$test1++;
			$time_in_24_hour_format  = date("H:i", strtotime($res['Received_Time']));
			$split_time = explode(":",$time_in_24_hour_format)[0];
			$test1V = $test1V.";  ".$res['Received_Time'].",".$time_in_24_hour_format."===".$split_time;
			if((int)$split_time >=5 && (int)$split_time<=23){
				$goInside=1;
			}
			else{
				$goInside=0;
			}
		}
		if($res['Received_Date']==$endDate){
			$test2++;
			$time_in_24_hour_format  = date("H:i", strtotime($res['Received_Time']));
			$split_time = explode(":",$time_in_24_hour_format)[0];
			if((int)$split_time <5){
				$goInside=1;
			}
			else{
				$goInside=0;
			}
		}
		if($goInside==1){
			if($res['Publisher']=='Newspaper'){$newsCountSR++;}
			if($res['Publisher']=='Magazine'){$magCountSR++;}
			if($res['Publisher']=='Cartoon'){$cartoonCountSR++;}
			if($res['Publisher']=='Colourup'){$colorupCountSR++;}
			if($res['Publisher']=='MailJobs'){$mailCountSR++;}
			
			if($res['Complexity']=='Complex'){$complexCountSR++;}
			else if($res['Complexity']=='Medium'){$mediumCountSR++;}
			else{$simpleCountSR++;}
			
			$getStartEndTime = getStartEndFn($res);
			$getStartEndTime = explode(",",$getStartEndTime);
			$mlist = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			if($getStartEndTime[0] && $getStartEndTime[1]){
			$checkstartMonth = explode("/",$getStartEndTime[0])[1];
			$checkendMonth = explode("/",$getStartEndTime[1])[1];
			
			$Start_Time = preg_split("#/#", $getStartEndTime[0])[1];
			$End_Time = preg_split("#/#", $getStartEndTime[1])[1];
			for($i=0;$i<sizeof($mlist);$i++){
				if($mlist[$i]==$Start_Time){if($i<10){$mon='0'.$i;}else{$mon=$i;}
			$getStartEndTime[0] = str_replace($Start_Time,$mon,$getStartEndTime[0]);
			$getStartEndTime[1] = str_replace($End_Time,$mon,$getStartEndTime[1]);
			break;
			}
			}
			
			//start
			$finalstartingEndingTimeRet = formatTime($getStartEndTime[0],$getStartEndTime[1]);		
			//start ends
			
			if($checkendMonth==$checkstartMonth){
					$then = new DateTime($finalstartingEndingTimeRet[0]);
					$now = new DateTime($finalstartingEndingTimeRet[1]);
					if($getStartEndTime[0] && $getStartEndTime[0]){

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
						if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes++;}
						else{$OTD="No";$OTDNo++;}
					}
					else{
						$prodHrs = 'NA';
						$OTD="NA";
					}
			}
			else{
				$returnedValues0='';
				for($a=0;$a<2;$a++){
					if($a==0){
						$startOneTime = $getStartEndTime[0];
						$endOneTime = explode(" ",$getStartEndTime[0])[0]."11:59:59 PM";
						$getStartEndTime=[$startOneTime,$endOneTime];
						
						$returnedValues0 = endStartdateConflict($getStartEndTime,1,"",$OTSYes,$OTDNo);
						$returnedValues0 = explode(",",$returnedValues0);
					}
					else{
						$startOneTime = explode(" ",$getStartEndTime[0])[0]."12:00:00 PM";			
						$endOneTime = $getStartEndTime[1];
						$returnedValues = endStartdateConflict($getStartEndTime,2,$returnedValues0[0],$OTSYes,$OTDNo);
					}
				}
				$returnedValues = explode(",",$returnedValues);
				$prodHrs = $returnedValues[0];				$OTD = $returnedValues[1];				$OTSYes = $returnedValues[2];				$OTDNo =$returnedValues[3];
				
			}
			$totalProdHrsSR = sum_the_time($totalProdHrsSR,$prodHrs);
			$simpleC=0;$mediumC=0;$complexC=0;
			if($res['Complexity']=='Complex'){$complexC++;}
			else if($res['Complexity']=='Medium'){$mediumC++;}
			else{$simpleC++;}
			$totalCount=$simpleC+$mediumC+$complexC;
			$coreAuxValue='';
			$sqlteam = mysqli_query($con,"SELECT EmployeeID, TeamName, Firstname, Lastname FROM `signup` WHERE Firstname='".$res['Operator_Name']."'")or die(mysqli_error());
			while ($resSqlteam=mysqli_fetch_assoc($sqlteam)){
				if($resSqlteam['TeamName']==$res['Team_Name']){
					$coreAuxValue='Core';
				}
				else{
					$coreAuxValue='Aux';
				}
			}
			$opTagDMG2 = $opTagDMG2."<tr><td style='border:1px solid black;text-align: center;'>".$res['Team_Name']."</td><td style='border:1px solid black;text-align: center;'>".$res['Publisher']."</td><td style='border:1px solid black;text-align: center;'>".$res['Magazine'] ."</td><td style='border:1px solid black;text-align: center;'>".$res['File_Name']."</td><td style='border:1px solid black;text-align: center;'>".$res['Comments']."</td><td  style='border:1px solid black;text-align: center;'>PRODUCTION</td><td  style='border:1px solid black;text-align: center;'>".$simpleC."</td><td  style='border:1px solid black;text-align: center;'>".$mediumC."</td><td  style='border:1px solid black;text-align: center;'>".$complexC."</td><td style='border:1px solid black;text-align: center;'>".$res['Start_Time']."</td><td style='border:1px solid black;text-align: center;'>".$res['End_Time']."</td><td style='border:1px solid black;text-align: center;'>".$prodHrs."</td><td style='border:1px solid black;text-align: center;'>".$totalCount."</td><td style='border:1px solid black;text-align: center;'>".$res['Operator_Name']."</td><td style='border:1px solid black;text-align: center;'>".$res['File_Status']."</td><td style='border:1px solid black;text-align: center;'>0</td><td style='border:1px solid black;text-align: center;'>".$res['Error_Type']."</td><td style='border:1px solid black;text-align: center;'>".$res['empId']."</td><td style='border:1px solid black;text-align: center;'>".$res['ReceivedTimeTimer']."</td><td style='border:1px solid black;text-align: center;'>".$res['Operator_Name']."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$res['Complexity']."</td><td style='border:1px solid black;text-align: center;'>".$res['Team_Name']."</td><td style='border:1px solid black;text-align: center;'>".$coreAuxValue."</td></tr>";// this is only for production
			
			
			/*for shift report - starts*/
			if($res['File_Status']=='Delivered'){$delCountSR++;}if($res['File_Status']=='ForceQuit'){$delCountSR++;}
			if($res['Error_Type']){$intQualSR++;}
			/*for shift report - ends*/					
			}
		}
	}
	$totalAdhocImgDelv=$cartoonCountSR+$colorupCountSR+$mailCountSR;
	$sqlc = "SELECT * FROM storejms WHERE QC_StartTime >= '".$startDate."' AND QC_EndTime <='".$endDate."' AND Team_Name='".$tname1."'";
	$resac=mysqli_query($con,$sqlc)or die(mysqli_error());
	while ($resc=mysqli_fetch_assoc($resac)){
		$sqlteam1 = mysqli_query($con,"SELECT EmployeeID, TeamName, Firstname, Lastname FROM `signup` WHERE Firstname='".$resc['Operator_Name']."'")or die(mysqli_error());
		while ($resSqlteam=mysqli_fetch_assoc($sqlteam1)){
			if($resSqlteam['TeamName']==$resc['Team_Name']){
				$coreAuxValue='Core';
			}
		else{
			$coreAuxValue='Aux';
		}
		}
			$opTagDMG2 = $opTagDMG2."<tr><td style='border:1px solid black;text-align: center;'>".$resc['Team_Name']."</td><td style='border:1px solid black;text-align: center;'>".$resc['Publisher']."</td><td style='border:1px solid black;text-align: center;'>".$resc['Magazine'] ."</td><td style='border:1px solid black;text-align: center;'>".$resc['File_Name']."</td><td style='border:1px solid black;text-align: center;'>".$resc['Comments']."</td><td  style='border:1px solid black;text-align: center;'>PRODUCTION</td><td  style='border:1px solid black;text-align: center;'>".$simpleC."</td><td  style='border:1px solid black;text-align: center;'>".$mediumC."</td><td  style='border:1px solid black;text-align: center;'>".$complexC."</td><td style='border:1px solid black;text-align: center;'>".$resc['QC_StartTime']."</td><td style='border:1px solid black;text-align: center;'>".$resc['QC_EndTime']."</td><td style='border:1px solid black;text-align: center;'>TBI</td><td style='border:1px solid black;text-align: center;'>TBI</td><td style='border:1px solid black;text-align: center;'>".$resc['QC_Name']."</td><td style='border:1px solid black;text-align: center;'>".$resc['QC_Status']."</td><td style='border:1px solid black;text-align: center;'>0</td><td style='border:1px solid black;text-align: center;'>".$resc['Error_Type']."</td><td style='border:1px solid black;text-align: center;'>".$res['empId']."</td><td style='border:1px solid black;text-align: center;'>".$resc['ReceivedTimeTimer']."</td><td style='border:1px solid black;text-align: center;'>".$resc['Operator_Name']."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$resc['Complexity']."</td><td style='border:1px solid black;text-align: center;'>".$resc['Team_Name']."</td><td style='border:1px solid black;text-align: center;'>".$coreAuxValue."</td></tr>";// this is only for QC
		
	}
	
	$startin= explode("/",$startDate); $starting= $startin[2]."-".$startin[1]."-".$startin[0]; $date= $startin[0]." ".$startin[1]." ".$startin[2];
	
	
	$endin = explode("/",$endDate);
	$mlist = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	for($i=0;$i<sizeof($mlist);$i++){
		if($startin[1]==$mlist[$i]){
			if($i<10){$mon='0'.($i);}else{$mon=$i;}
			$starting = str_replace($startin[1],$mon,$starting);
			$date = str_replace($startin[1],$mon,$date);
			if($startin[0]<10){$dateVal='0'.($startin[0]);}else{$dateVal=$startin[0];}
			$date = str_replace($startin[0],$dateVal,$date);
		}
	}
	//get actual count from shift roster date('Y-m-d')
	$getActCntQuery= mysqli_query($con,"SELECT * FROM `roster_table` WHERE `Date`='".$starting."' && Team='DMGT' AND Shiftcode!='26' AND (empid!='IN085' AND empid!='IN168' AND empid!='IN601' AND empid!='IN745' AND empid!='IN467' AND empid!='IN647' AND empid!='IN048')")or die(mysqli_error());// to get actual count
	$ActualCountSR = mysqli_num_rows($getActCntQuery);
	
	$getTotalLoggedInCount = mysqli_query($con,"SELECT * FROM `login` WHERE `Date`='".$starting."'")or die(mysqli_error());
	$getTotalLoggedInSR = mysqli_num_rows($getTotalLoggedInCount);// this will give the shrinkage
	$shrinkageSR = ($ActualCountSR - $getTotalLoggedInSR)*8;
	$ActualCounthoursSR = $ActualCountSR*8;
	$shrinkagePerSR = ($shrinkageSR*100)/$ActualCounthoursSR;
	
	//get DMG doing Aux jobs
	$queryDmgForAux = mysqli_query($con,"SELECT * FROM  `aux_jobs_dmg` WHERE Received_Date = '".$startin[2]."/".$startin[1]."/".$startin[0]."' AND CoreTeam='".$tname1."'")or die(mysqli_error());

	while ($reaux=mysqli_fetch_assoc($queryDmgForAux)){
		$getStartEndTime = getStartEndFn($reaux);
			$getStartEndTime = explode(",",$getStartEndTime);
		if($getStartEndTime[1]){
			 
			 //start
			$finalstartingEndingTimeRet = formatTime($getStartEndTime[0],$getStartEndTime[1]);		
			//start ends			
		
		$calcHMSprodHrs = calcHMS($finalstartingEndingTimeRet[0],$finalstartingEndingTimeRet[1]);
		$totalProdHoursAuxSR = sum_the_time($totalProdHoursAuxSR,$calcHMSprodHrs);
		 }
	}
	//get internal admin hours %
	$queryDmgForAdmin = mysqli_query($con,"SELECT * FROM  `otheractivity` WHERE Date = '".$date."' AND Activity !='Break'")or die(mysqli_error());
	while ($readmin=mysqli_fetch_assoc($queryDmgForAdmin)){
		$getStartEndTime = [$readmin['startTime'],$readmin['endTime']];//getStartEndFn1($readmin);
			$getStartEndTime = explode(",",$getStartEndTime);
		if($getStartEndTime[1]){
			 //start
			$finalstartingEndingTimeRet = formatTime($getStartEndTime[0],$getStartEndTime[1]);		
			//start ends
			
		$calcHMSprodHrs = calcHMS($finalstartingEndingTimeRet[0],$finalstartingEndingTimeRet[1]);
		$totalProdHoursAdminSR = sum_the_time($totalProdHoursAdminSR,$calcHMSprodHrs);
		 }
	}
	//get core util %
	$totalProdHrssSR = explode(":",$totalProdHrsSR);
	$totalProdHrssSR0 = (int)($totalProdHrssSR[0]);
	$totalProdHrssSR1 = (int)($totalProdHrssSR[1])/60;
	$totalProdHrssSR2 = (int)($totalProdHrssSR[2])/60/60;
	$totalProdHrssSR = $totalProdHrssSR0+$totalProdHrssSR1+$totalProdHrssSR2;
	$totalProdPerSR = ($totalProdHrssSR/($ActualCountSR*8))*100;
	//get aux util %
	$totalProdHoursAuxSR1 = explode(":",$totalProdHoursAuxSR);
	$totalProdHrssAuxSR = $totalProdHoursAuxSR1[0] + (((int)$totalProdHoursAuxSR1[1])/60) + (((int)$totalProdHoursAuxSR1[2])/60/60);
	$totalProdAuxPerSR = ($totalProdHrssAuxSR/($ActualCountSR*8))*100;
	//calculate overall %
	$overPerSR = $totalProdAuxPerSR +$totalProdPerSR;
	$overallHoursSR = sum_the_time($totalProdHrsSR,$totalProdHoursAuxSR);
	
	$otdPerSR = ($OTSYes*100/$delCountSR);//.toFixed(1)
	if($intQualSR==0){$intQualSR=$delCountSR;}
	$intQualSR = ($intQualSR*100/$delCountSR);
	//row 1
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>DMGT</td><td style='border:1px solid black;background-color: #D3D3D3;'>Newspaper</td><td style='border:1px solid black;background-color: #D3D3D3;'>Magazines</td><td style='border:1px solid black;background-color: #D3D3D3;'>Images Delivered</td><td style='border:1px solid black;background-color: #D3D3D3;'>Images Handover</td><td style='border:1px solid black;background-color: #D3D3D3;'>Late</td><td style='border:1px solid black;background-color: #D3D3D3;'>Ontime Delivery</td><td style='border:1px solid black;background-color: #D3D3D3;'>Internal Quality</td><td style='border:1px solid black;background-color: #D3D3D3;'>External Quality</td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;'></td><td>".$newsCountSR."</td><td style='border:1px solid black;'>".$magCountSR."</td><td>".$delCountSR."</td><td style='border:1px solid black;'>".$handCountSR."</td><td style='border:1px solid black;'>".$OTDNo."</td><td>".round($otdPerSR)."%</td><td style='border:1px solid black;'>".round($intQualSR)."%</td><td style='border-right:1px solid black;'>100% </td></tr>";
	//row 2
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>Adhoc Images</td><td style='border:1px solid black;background-color: #D3D3D3;'>Cartoons</td><td style='border:1px solid black;background-color: #D3D3D3;'>Colorups</td><td style='border:1px solid black;background-color: #D3D3D3;'>Mail Jobs</td><td style='border:1px solid black;background-color: #D3D3D3;'>Images Delivered</td><td style='border-left:1px solid black;border-top:1px solid black;border-bottom:1px solid black;background-color: #D3D3D3;' >Images Handover</td><td style='border-bottom:1px solid black;border-top:1px solid black;background-color: #D3D3D3;'></td><td style='border-bottom:1px solid black;border-top:1px solid black;background-color: #D3D3D3;'></td><td style='border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;background-color: #D3D3D3;'></td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border-left:1px solid black;'></td><td style='border:1px solid black;'>".$cartoonCountSR."</td><td style='border:1px solid black;'>".$colorupCountSR."</td><td style='border:1px solid black;'>".$mailCountSR."</td><td style='border:1px solid black;'>".$totalAdhocImgDelv."</td><td>0</td><td></td><td></td><td style='border-right:1px solid black;'></td></tr>";
	//row 3
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>Project</td><td style='border:1px solid black;background-color: #D3D3D3;'>Planned Leaves</td><td style='border:1px solid black;background-color: #D3D3D3;'>Unplanned Leaves</td><td style='border:1px solid black;background-color: #D3D3D3;'>Shrinkage</td><td style='border:1px solid black;background-color: #D3D3D3;'>Actual Head Count</td><td style='border:1px solid black;background-color: #D3D3D3;'>Internal Admin %</td><td style='border:1px solid black;background-color: #D3D3D3;'>Core %</td><td style='border:1px solid black;background-color: #D3D3D3;'>Aux %</td><td style='border:1px solid black;background-color: #D3D3D3;'>Overall %</td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border-left:1px solid black;'></td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>".round($shrinkagePerSR)."%</td><td style='border:1px solid black;'>".$ActualCountSR."</td><td style='border:1px solid black;'>".$totalProdHoursAdminSR."</td><td style='border:1px solid black;'>".$totalProdHrsSR."- ".round($totalProdPerSR,2)."%</td><td style='border:1px solid black;'>".$totalProdHoursAuxSR."- ".round($totalProdAuxPerSR,2)."%</td><td style='border:1px solid black;'>".$overallHoursSR."- ".round($overPerSR,2)."% </td></tr>";
	//row 4
	$totalComplexityCount=$complexCountSR+$mediumCountSR+$simpleCountSR;
	$CompSCountPer=($simpleCountSR*100/$totalComplexityCount);	
	$CompMCountPer=($mediumCountSR*100/$totalComplexityCount);	
	$CompCCountPer=($complexCountSR*100/$totalComplexityCount);
	$benchTotal = explode(":",$totalProdHrsSR);
	$benchTotal = $totalComplexityCount/($benchTotal[0]+((int)$benchTotal[1]/60)+((int)$benchTotal[2]/60/60));
	
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>Project</td><td></td><td style='border:1px solid black;background-color: #D3D3D3;'>Benchmark (Images/hr)</td><td style='border:1px solid black;background-color: #D3D3D3;'>Acheived Images/hr</td><td style='border:1px solid black;background-color: #D3D3D3;'>% Against benchmark</td><td></td><td style='border:1px solid black;background-color: #D3D3D3;'>Simple%</td><td style='border:1px solid black;background-color: #D3D3D3;'>Medium%</td><td style='border:1px solid black;background-color: #D3D3D3;'>Complex%</td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>DMGT</td><td></td><td style='border:1px solid black;'>8.5</td><td style='border:1px solid black;'>".round($benchTotal,1)."</td><td style='border:1px solid black;'>0</td><td></td><td  style='border:1px solid black;'>".round($CompSCountPer, 0, PHP_ROUND_HALF_UP)."%</td><td style='border:1px solid black;'>".round($CompMCountPer, 0, PHP_ROUND_HALF_UP)."%</td><td style='border:1px solid black;'>".round($CompCCountPer, 0, PHP_ROUND_HALF_UP)."%</td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>Cartoon & Colorup</td><td></td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td><td></td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td></tr>";
	$shiftReport=$shiftReport."<tr><td style='border:1px solid black;background-color: #D3D3D3;'>Overall Procuctivity</td><td style='border-bottom:1px solid black;'></td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>0</td><td style='border:1px solid black;'>0</td><td style='border-bottom:1px solid black;'></td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td><td style='border:1px solid black;'>0%</td></tr>";
	
	$shiftReport=$shiftReport."</table>";
	
/*
	if($tname1=='Johnlewis'){$tname1='JLBAU';}
	echo "SELECT * FROM `jl` WHERE Team='".$tname1."' and File_Status='Delivered'";
	$sqlteam = mysqli_query($con,"SELECT * FROM `jl` WHERE Team='".$tname1."' and File_Status='Delivered'")or die(mysqli_error());
		while ($re2=mysqli_fetch_assoc($sqlteam)){
			$opTagDMG2."<tr><td style='border:1px solid black;text-align: center;'>".$tname1."</td><td style='border:1px solid black;text-align: center;'>".$re2['batch']."</td><td style='border:1px solid black;text-align: center;'>".$re2['batch_type'] ."</td><td style='border:1px solid black;text-align: center;'>".$re2['File_Name']."</td><td style='border:1px solid black;text-align: center;'>".$re2['Comments']."</td><td  style='border:1px solid black;text-align: center;'>PRODUCTION</td><td  style='border:1px solid black;text-align: center;'>S</td><td  style='border:1px solid black;text-align: center;'>M</td><td  style='border:1px solid black;text-align: center;'>C</td><td style='border:1px solid black;text-align: center;'>".$re2['Start_Time']."</td><td style='border:1px solid black;text-align: center;'>".$re2['End_Time']."</td><td style='border:1px solid black;text-align: center;'>".$prodHrs."</td><td style='border:1px solid black;text-align: center;'>1</td><td style='border:1px solid black;text-align: center;'>".$re2['Operator_Name']."</td><td style='border:1px solid black;text-align: center;'>".$re2['File_Status']."</td><td style='border:1px solid black;text-align: center;'>0</td><td style='border:1px solid black;text-align: center;'>".$re2['Error_Type']."</td><td style='border:1px solid black;text-align: center;'>".$re2['empId']."</td><td style='border:1px solid black;text-align: center;'>".$re2['ReceivedTimeTimer']."</td><td style='border:1px solid black;text-align: center;'>".$re2['Operator_Name']."</td><td style='border:1px solid black;text-align: center;'>-</td><td style='border:1px solid black;text-align: center;'>".$re2['Complexity']."</td><td style='border:1px solid black;text-align: center;'>".$re2['Team_Name']."</td><td style='border:1px solid black;text-align: center;'>".$coreAuxValue."</td></tr>";
		}
*/
	$opTagDMG2=$opTagDMG2."</table>";
				
	echo $opTagDMG2."BREAK".$shiftReport."BREAK".$totalProdPerSR."BREAK".$test1V;
	
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
  return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}


function calcHMS($restartTime,$reendTime){
	$mlist = ["","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				$Start_Time = preg_split("#/#", $restartTime); //$now = new DateTime('2005/09/01 10:02:25 PM'); 
				$End_Time = preg_split("#/#", $reendTime);
				
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$Start_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$restartTime = str_replace($Start_Time[1],$mon,$restartTime);
					break;
					}
				} 
				for($i=0;$i<sizeof($mlist);$i++){
					if($mlist[$i]==$End_Time[1]){
						if($i<10){$mon = '0'.$i;}else{$mon = $i;}
					$reendTime = str_replace($End_Time[1],$mon,$reendTime);	
					break;
					}
				}
		$startTime1=$restartTime;
		$End_Time1=$reendTime;	
	
			$then = new DateTime($startTime1);
			$now = new DateTime($End_Time1);
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
				return $prodHrs;
}

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

function getStartEndFn($res){
	if($res['End_Time']){
		$endTime = $res['End_Time'];
	}
	else{
		$delDate = explode("/",$res['Delivered_Date']);
		$delDatefin = $delDate[2]."/".$delDate[1]."/".$delDate[0];
		$endTime = $delDatefin." ".$res['Delivered_Time'];
	}
	
	if($res['Start_Time']){
		$startTime = $res['Start_Time'];
	}
	else if($res['Assigned_Time']){
			$startTime=$res['Assigned_Time'];
	}
	else{
		$startTime = $res['ReceivedTimeTimer'];
	}
	
	return $startTime.",".$endTime;
}

function endStartdateConflict($getStartEndTime,$i,$oldProdHrs,$OTSYes,$OTDNo){
	$then = new DateTime($getStartEndTime[0]);
	$now = new DateTime($getStartEndTime[1]);
	$OTD='';
	if($getStartEndTime[0] && $getStartEndTime[0]){

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
		
		if($i==2){
			$prodHrs = sum_the_time($oldProdHrs,$prodHrs);
			$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
			
			if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes++;}
			else{$OTD="No";$OTDNo++;}
		}
		
	}
	else{
		$prodHrs = 'NA';
		$OTD="NA";
	}
return $prodHrs.",".$OTD.",".$OTSYes.",".$OTDNo;	
}
	mysqli_close($con);
?>