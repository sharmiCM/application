<?PHP
	$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
	$m = date('m');$tableHistory1="";
	for($i=1;$i<$m;$i++){
		$start = date('d/M/Y', strtotime(date('Y-M')."-".$i." month"));
		$end = date('d/M/Y', strtotime(date('Y-M')."-".$i." month"))."  23:59:59";
		$q1= "SELECT * FROM `storejms` where File_Status='Delivered' AND Received_Time>='".$start."' AND Received_Time<='".$end."'";
		$rq1=mysqli_query($con,$q1)or die(mysqli_error());
		$nor1 = mysqli_num_rows($rq1);
		$tableHistory1="<tr style='line-height: 30px;'><td>".date('F', strtotime(date('Y-M')."-".$i." month"))."</td><td>:</td><td style='padding-left: 3px;'>".$nor1."</td></tr>".$tableHistory1;
	}
	$tableHistory="<table>".$tableHistory1."</table>";
	echo $tableHistory;
	mysqli_close($con);
?>