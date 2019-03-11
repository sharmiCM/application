<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
$team=$_POST['team'];	
	
	
	date_default_timezone_set('Asia/Calcutta');	
	$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
	if((int)$dates>7){
		$dateForQuery = "Received_Date='".date('d/F/Y')."'";
	}
	else{
		$dateForQuery = "Received_Date='".date("d/F/Y")."' AND Received_Date='".date('d/F/Y', strtotime('-1 day'))."'";
	}
	if($team=='Dmg'){
		$reR=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND ".$dateForQuery)or die(mysqli_error());//for received//."Received_Date='".date("d/F/Y")."'"
		$norR = mysqli_num_rows($reR); 
		$reY=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='Yet to assign'")or die(mysqli_error());//yet to assign// AND Received_Date='".date("d/F/Y")."'
		$norY = mysqli_num_rows($reY);
		$reWip=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='Assigned'")or die(mysqli_error());//Assigned// AND Received_Date='".date("d/F/Y")."'
		$norWip = mysqli_num_rows($reWip);
		$reW=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status!='ForceQuit' AND File_Status='NeedQC'")or die(mysqli_error());//Waiting For QC// AND Received_Date='".date("d/F/Y")."'
		$norW = mysqli_num_rows($reW);
		$reD=mysqli_query($con,"SELECT * FROM `storejms` WHERE File_Status='Delivered' AND File_Status!='ForceQuit' AND ".$dateForQuery)or die(mysqli_error());//Delivered//Received_Date='".date("d/F/Y")."'
		$norD = mysqli_num_rows($reD);
	}
	else if($team=='JL'){
		$reR=mysqli_query($con,"SELECT * FROM `jl` WHERE File_Status!='ForceQuit' AND ".$dateForQuery)or die(mysqli_error());//for received//."Received_Date='".date("d/F/Y")."'"
		$norR = mysqli_num_rows($reR); 
		$reY=mysqli_query($con,"SELECT * FROM `jl` WHERE File_Status!='ForceQuit' AND File_Status='Yet to assign'")or die(mysqli_error());//yet to assign// AND Received_Date='".date("d/F/Y")."'
		$norY = mysqli_num_rows($reY);
		$reWip=mysqli_query($con,"SELECT * FROM `jl` WHERE File_Status!='ForceQuit' AND File_Status='Assigned'")or die(mysqli_error());//Assigned// AND Received_Date='".date("d/F/Y")."'
		$norWip = mysqli_num_rows($reWip);
		$reW=mysqli_query($con,"SELECT * FROM `jl` WHERE File_Status!='ForceQuit' AND File_Status='NeedQC'")or die(mysqli_error());//Waiting For QC// AND Received_Date='".date("d/F/Y")."'
		$norW = mysqli_num_rows($reW);
		$reD=mysqli_query($con,"SELECT * FROM `jl` WHERE File_Status='Delivered' AND File_Status!='ForceQuit' AND ".$dateForQuery)or die(mysqli_error());//Delivered//Received_Date='".date("d/F/Y")."'
		$norD = mysqli_num_rows($reD);
	}
	
	echo $norR."*".$norY."*".$norWip."*".$norW."*".$norD."_".$team;
?>
