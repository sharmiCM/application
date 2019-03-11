<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
		date_default_timezone_set('Asia/Calcutta');	
		$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
		if((int)$dates>7){
			$dateForQuery = "Received_Date='".date('d/F/Y')."'";
		}
		else{
			$dateForQuery = "Received_Date='".date("d/F/Y")."' AND Received_Date='".date('d/F/Y', strtotime('-1 day'))."'";
		}
		
	$jmsQuery = mysqli_query($con,"SELECT * FROM `storejms` where ".$dateForQuery." AND File_Status='Delivered' AND File_Status!='ForceQuit'");	//Received_Date ='".date("d/F/Y")."'
	$qual="";$QualYes=0;$QualNo=0;
	$nori2 = mysqli_num_rows($jmsQuery);
	$file="<table id='getQualtable' style='font-size: xx-small;border: 1px solid #F1E41A;'><tr><th>File_Name</th><th>Error_Type</th><th>Operator</th><th>QC Operator</th><th>Complexity</th></tr>";
	while ($re=mysqli_fetch_assoc($jmsQuery)){
		if($re['Error_Type']){
			$qual=$qual."<tr><td>".$re['File_Name']."</td><td>".$re['Error_Type']."</td><td>".$re['Operator_Name']."</td><td>".$re['QC_Name']."</td><td>".$re['Complexity']."</td></tr>";
			$QualYes++;
		}
		else{
			$QualNo++;	
		}
	}
	$file =$file."</table>";
	echo $QualYes."*".$QualNo++."*".$nori2."*".$file;
		  
?>
