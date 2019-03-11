<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	$date1 = $_POST['date1'];
	$date2 = $_POST['date2'];
	$date3 = $_POST['date3'];
	$date4 = $_POST['date4'];
	$date5 = $_POST['date5'];
	$date6 = $_POST['date6'];
	$date7 = $_POST['date7'];
	$lasts = $_POST['lasts'];
	
	$compQuery = "SELECT * FROM storejms WHERE Received_Date='".$date1."' OR Received_Date='".$date2."' OR Received_Date='".$date3."' OR Received_Date='".$date4."' OR Received_Date='".$date5."' OR Received_Date='".$date6."' OR Received_Date='".$date7."'";
//	OR File_Status!='ForceQuit'";

$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$mlist1 = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	$res=mysqli_query($con,$compQuery)or die(mysqli_error());
	$noria = mysqli_num_rows($res);
	$dialogOn=0;
	$totaldate1=0;$totaldate2=0;$totaldate3=0;$totaldate4=0;$totaldate5=0;$totaldate6=0;$totaldate7=0;$OTSYes1=0;$OTSYes2=0;$OTSYes3=0;$OTSYes4=0;$OTSYes5=0;$OTSYes6=0;$OTSYes7=0;$volTimeSplit="";$totaldate1All=0;
	
	$totalNewspaperCount1=0;$totalMagCount1=0;$totOtherPubCount1=0;$totalNewspaperCount2=0;$totalMagCount2=0;$totOtherPubCount2=0; $totalNewspaperCount3=0;$totalMagCount3=0;$totOtherPubCount3=0; $totalNewspaperCount4=0;$totalMagCount4=0;$totOtherPubCount4=0;
	$totalNewspaperCount5=0;$totalMagCount5=0;$totOtherPubCount5=0;$totalNewspaperCount6=0;$totalMagCount6=0;$totOtherPubCount6=0;$totalNewspaperCount7=0;$totalMagCount7=0;$totOtherPubCount7=0;
	
	$qual1=0;$qual2=0;$qual3=0;$qual4=0;$qual5=0;$qual6=0;$qual7=0;
	$date1S=0;$date1M=0;$date1C=0;$date2S=0;$date2M=0;$date2C=0;$date3S=0;$date3M=0;$date3C=0;$date4S=0;$date4M=0;$date4C=0;$date5S=0;$date5M=0;$date5C=0;$date6S=0;$date6M=0;$date6C=0;$date7S=0;$date7M=0;$date7C=0;
	
	if(!$lasts){//$date2==""){
		//$totaldate1=$totaldate1All;
		while ($resDiv=mysqli_fetch_assoc($res)){
				$volTimeSplit=$volTimeSplit."-".$resDiv['ReceivedTimeTimer'];
				
				if($resDiv['Received_Date']==$date1){
					$totaldate1++;
					if($resDiv['Complexity']=='Complex'){$date1C++;}
					else if($resDiv['Complexity']=='Medium'){$date1M++;}
					else{$date1S++;}
					if($date3==""){
								if($resDiv['Delivered_Date']){
								$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
								$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
								$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
								$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
								for($i=0;$i<sizeof($mlist);$i++){
									if($mlist[$i]==$Start_Time){
									$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
									$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
									break;
									}
								}					
							$then = new DateTime($resDiv['ReceivedTimeTimer']);
							$now = new DateTime($End_Time);
							if($resDiv['ReceivedTimeTimer']){
								$sinceThen = $then->diff($now);						
							$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
							if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes1++;}
							else{
								$OTD="No";
								}
							}
							else{
								$prodHrs = 'NA';$OTD="NA";
							}
							}
					}
				}
				if($resDiv['Received_Date']==$date2){
					$totaldate2++;
					if($resDiv['Complexity']=='Complex'){$date2C++;}
					else if($resDiv['Complexity']=='Medium'){$date2M++;}
					else{$date2S++;}
					if($date3==""){
							if($resDiv['Delivered_Date']){
								$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
								$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
								$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
								$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
								for($i=0;$i<sizeof($mlist);$i++){
									if($mlist[$i]==$Start_Time){
									$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
									$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
									break;
									}
								}					
							$then = new DateTime($resDiv['ReceivedTimeTimer']);
							$now = new DateTime($End_Time);
							if($resDiv['ReceivedTimeTimer']){
								$sinceThen = $then->diff($now);						
							$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
							if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes2++;}
							else{
								$OTD="No";
								}
							}
							else{
								$prodHrs = 'NA';$OTD="NA";
							}
							}
					}
				}
				if($resDiv['Received_Date']==$date3){
					$totaldate3++;
					if($resDiv['Complexity']=='Complex'){$date3C++;}
					else if($resDiv['Complexity']=='Medium'){$date3M++;}
					else{$date3S++;}
				}
				if($resDiv['Received_Date']==$date4){
					$totaldate4++;
					if($resDiv['Complexity']=='Complex'){$date4C++;}
					else if($resDiv['Complexity']=='Medium'){$date4M++;}
					else{$date4S++;}
				}
				if($resDiv['Received_Date']==$date5){
					$totaldate5++;
					if($resDiv['Complexity']=='Complex'){$date5C++;}
					else if($resDiv['Complexity']=='Medium'){$date5M++;}
					else{$date5S++;}
				}
				if($resDiv['Received_Date']==$date6){
					$totaldate6++;
					if($resDiv['Complexity']=='Complex'){$date6C++;}
					else if($resDiv['Complexity']=='Medium'){$date6M++;}
					else{$date6S++;}
				}
				if($resDiv['Received_Date']==$date7){
					$totaldate7++;
					if($resDiv['Complexity']=='Complex'){$date7C++;}
					else if($resDiv['Complexity']=='Medium'){$date7M++;}
					else{$date7S++;}
				}
			if($date3==""){$dialogOn=0;}else{$dialogOn=1;} 				
			}
			for($mo=0;$mo<sizeof($mlist);$mo++){
				$date1 = str_replace($mlist[$mo],$mlist1[$mo],$date1);
				$date2 = str_replace($mlist[$mo],$mlist1[$mo],$date2);
				$date3 = str_replace($mlist[$mo],$mlist1[$mo],$date3);
				$date4 = str_replace($mlist[$mo],$mlist1[$mo],$date4);
				$date5 = str_replace($mlist[$mo],$mlist1[$mo],$date5);
				$date6 = str_replace($mlist[$mo],$mlist1[$mo],$date6);
				$date7 = str_replace($mlist[$mo],$mlist1[$mo],$date7);
			}
			
	echo $date1.":".$totaldate1."*".$date1S."*".$date1M."*".$date1C."*".$OTSYes1."$".$date2.":".$totaldate2."*".$date2S."*".$date2M."*".$date2C."*".$OTSYes2."$".$date3.":".$totaldate3."*".$date3S."*".$date3M."*".$date3C."$".$date4.":".$totaldate4."*".$date4S."*".$date4M."*".$date4C."$".$date5.":".$totaldate5."*".$date5S."*".$date5M."*".$date5C."$".$dialogOn."$".$volTimeSplit."$".$date6.":".$totaldate6."*".$date6S."*".$date6M."*".$date6C."*".$OTSYes6."$".$date7.":".$totaldate7."*".$date7S."*".$date7M."*".$date7C."*".$OTSYes7;
		}
	
	
	else{
		while ($resDiv=mysqli_fetch_assoc($res)){
		$volTimeSplit=$volTimeSplit."-".$resDiv['ReceivedTimeTimer'];//$totaldate1All++;
		
	  if($resDiv['File_Status']=='Delivered' && $resDiv['File_Status']!='ForceQuit'){
		
		if($resDiv['Received_Date']==$date1){			
			$totaldate1++;
			if($resDiv['Complexity']=='Complex'){$date1C++;}
			else if($resDiv['Complexity']=='Medium'){$date1M++;}
			else{$date1S++;}
			//if($date3==""){
						if($resDiv['Delivered_Date']){
							if($resDiv['Error_Count']){$qual1++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount1++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount1++;}
							else{$totOtherPubCount1++;}		
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							break;
							}
						}					
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes1++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
					}
			//}
		}
		if($resDiv['Received_Date']==$date2){
			$totaldate2++;
			if($resDiv['Complexity']=='Complex'){$date2C++;}
			else if($resDiv['Complexity']=='Medium'){$date2M++;}
			else{$date2S++;}
			//if($date3==""){
					if($resDiv['Delivered_Date']){
						if($resDiv['Error_Count']){$qual2++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount2++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount2++;}
							else{$totOtherPubCount2++;}	
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							break;
							}
						}					
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes2++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
					}
			//}
		}
		if($resDiv['Received_Date']==$date3){
			$totaldate3++;
			if($resDiv['Complexity']=='Complex'){$date3C++;}
			else if($resDiv['Complexity']=='Medium'){$date3M++;}
			else{$date3S++;}
			//if($date3==""){
					if($resDiv['Delivered_Date']){
						if($resDiv['Error_Count']){$qual3++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount3++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount3++;}
							else{$totOtherPubCount3++;}	
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							break;
							}
						}					
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes3++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
					}
			//}
		}
		if($resDiv['Received_Date']==$date4){
			$totaldate4++;
			if($resDiv['Complexity']=='Complex'){$date4C++;}
			else if($resDiv['Complexity']=='Medium'){$date4M++;}
			else{$date4S++;}
			//if($date3==""){
					if($resDiv['Delivered_Date']){
						if($resDiv['Error_Count']){$qual4++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount4++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount4++;}
							else{$totOtherPubCount4++;}	
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							break;
							}
						}					
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes4++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
					}
			//}
		}
		if($resDiv['Received_Date']==$date5){
			$totaldate5++;
			if($resDiv['Complexity']=='Complex'){$date5C++;}
			else if($resDiv['Complexity']=='Medium'){$date5M++;}
			else{$date5S++;}
			//if($date3==""){
					if($resDiv['Delivered_Date']){
						if($resDiv['Error_Count']){$qual5++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount5++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount5++;}
							else{$totOtherPubCount5++;}	
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							//$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							//break;
							}
							if($mlist[$i]==$End_Time1[1]){
								$End_Time = str_replace($End_Time1[1],$i,$End_Time);
							}
						}
						
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes5++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
					}
			//}
		}
		if($resDiv['Received_Date']==$date5){
			$totaldate5++;
			if($resDiv['Complexity']=='Complex'){$date5C++;}
			else if($resDiv['Complexity']=='Medium'){$date5M++;}
			else{$date5S++;}
			//if($date3==""){
					if($resDiv['Delivered_Date']){
						if($resDiv['Error_Count']){$qual5++;}
							if($resDiv['Publisher']=='Newspaper'){$totalNewspaperCount5++;}
							else if($resDiv['Publisher']=='Magazine'){$totalMagCount5++;}
							else{$totOtherPubCount5++;}	
						$mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						$Start_Time = preg_split("#/#", $resDiv['ReceivedTimeTimer'])[1];						
						$End_Time1 = preg_split("#/#", $resDiv['Delivered_Date']);
						$End_Time=$End_Time1[2]."/".$End_Time1[1]."/".$End_Time1[0]. " ".$resDiv['Delivered_Time'];						
						for($i=0;$i<sizeof($mlist);$i++){
							if($mlist[$i]==$Start_Time){
							$resDiv['ReceivedTimeTimer'] = str_replace($Start_Time,$i,$resDiv['ReceivedTimeTimer']);
							//$End_Time = str_replace($End_Time1[1],$i,$End_Time);				
							//break;
							}
							if($mlist[$i]==$End_Time1[1]){
								$End_Time = str_replace($End_Time1[1],$i,$End_Time);
							}
						}
//if($End_Time!='2018/July/30 12:29:55 PM'){
						//echo $resDiv['ReceivedTimeTimer']."_".$End_Time."=".$totaldate5;
					$then = new DateTime($resDiv['ReceivedTimeTimer']);
					$now = new DateTime($End_Time);
					if($resDiv['ReceivedTimeTimer']){
						$sinceThen = $then->diff($now);						
					$OTDvarMin = $sinceThen->i;$OTDvarHrs = $sinceThen->h;
					if($OTDvarMin<=16 && $OTDvarHrs==0){$OTD="Yes";$OTSYes5++;}
					else{
						$OTD="No";
						}
					}
					else{
						$prodHrs = 'NA';$OTD="NA";
					}
//}
					}
			//}
		}
	}
		if($date3==""){$dialogOn=0;}else{$dialogOn=1;}		
	}
	
			for($mo=0;$mo<sizeof($mlist);$mo++){
				$date1 = str_replace($mlist[$mo],$mlist1[$mo],$date1);
				$date2 = str_replace($mlist[$mo],$mlist1[$mo],$date2);
				$date3 = str_replace($mlist[$mo],$mlist1[$mo],$date3);
				$date4 = str_replace($mlist[$mo],$mlist1[$mo],$date4);
				$date5 = str_replace($mlist[$mo],$mlist1[$mo],$date5);
			}
	
	echo $date1.":".$totaldate1."*".$date1S."*".$date1M."*".$date1C."*".$OTSYes1."*".$totalNewspaperCount1."*".$totalMagCount1."*".$totOtherPubCount1."*".$qual1."$".$date2.":".$totaldate2."*".$date2S."*".$date2M."*".$date2C."*".$OTSYes2."*".$totalNewspaperCount2."*".$totalMagCount2."*".$totOtherPubCount2."*".$qual2."$".$date3.":".$totaldate3."*".$date3S."*".$date3M."*".$date3C."*".$OTSYes3."*".$totalNewspaperCount3."*".$totalMagCount3."*".$totOtherPubCount3."*".$qual3."$".$date4.":".$totaldate4."*".$date4S."*".$date4M."*".$date4C."*".$OTSYes4."*".$totalNewspaperCount4."*".$totalMagCount4."*".$totOtherPubCount4."*".$qual4."$".$date5.":".$totaldate5."*".$date5S."*".$date5M."*".$date5C."*".$OTSYes5."*".$totalNewspaperCount5."*".$totalMagCount5."*".$totOtherPubCount5."*".$qual5."$".$dialogOn."$".$volTimeSplit; 	
	}
		
	
?>