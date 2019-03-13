<?php
	error_reporting(0); 
session_start();
$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
$var = explode(",",$_COOKIE['valss']);

$_SESSION['user_level'] = $var[2];
$_SESSION['EmployeeID'] = $var[0];
$_SESSION['name'] = $var[1];
$_SESSION['TeamName'] = $var[3];
$_SESSION['date'];

$_SESSION['user_level'];
$EmployeeID =$_SESSION['EmployeeID'];
$name = $_SESSION['name'];
$TeamName = $_SESSION['TeamName'];
$_SESSION['date'];

 if(isset($_SESSION['user_level']) == 1){
	 
	 if($_SESSION['user_level'] == 'RESIGNED'){
		 
		 echo "<script>alert('Sorry, This Employee has resigned You cannot login')</script>";
echo "<script>window.open('index.php','_self')</script>";
	 }
				 
if($_SESSION['user_level'] == 'MANAGER'){
//echo "<script>alert('Welcome Manager')</script>";
$smartJms = "show";
$Capacity = "show";
$staffing = "show";
$Logsheet = "show";
$Roster = "show";
$construction = "show";
$Display_roster = "show";
$Activity = "show";
$Job = "show";
$Queue = "show";
$Options = "show";
$Reports = "show";
$Edit_logsheet = "show";
$roster_update = "show";
$edit_log_date = "show";
$Import = "show";
$Update_signup = "show";
$New_Logsheet = "show";
$PSC_report = "show";
$Import_Excel = "show";
$Logsheet_check = "show";
$edit_quotes = "show";
$edit_dropdown = "show";
$pup_test1 = "show";
$QC_report = "show";
$JMS_Sheet = "show";
$JMS_SheetLog = "show";
$JohnLewis = "show";
$View_logsheet = "show";
$jobs_list = "hide";
$jobs = "hide";
$jobs_listjms = "hide";
$Assign_Self_QA="hide";
$responseApproval="show";
$setdcInput="hide";
$tcForecast="show";

}
if($_SESSION['user_level'] == 'ADMIN'){
$smartJms = "show";
$Capacity = "show";
$staffing = "show";
$Logsheet = "show";
$Roster = "show";
$construction = "show";
$Display_roster = "show";
$Activity = "show";
$Job = "show";
$Queue = "show";
$Options = "show";
$Reports = "show";
$Edit_logsheet = "show";
$roster_update = "show";
$edit_log_date = "show";
$Import = "show";
$Update_signup = "show";
$New_Logsheet = "show";
$PSC_report = "show";
$Import_Excel = "show";
$Logsheet_check = "show";
$edit_quotes = "show";
$edit_dropdown = "show";
$pup_test1 = "show";
$QC_report = "show";
$JMS_Sheet = "show";
$JMS_SheetLog = "show";
$JohnLewis = "show";
$View_logsheet = "show";
$jobs_list = "hide";
$jobs = "hide";
$jobs_listjms = "hide";
$Assign_Self_QA="hide";
$responseApproval="show";
$setdcInput="show";
$tcForecast="show";

}
if($_SESSION['user_level'] == 'LEAD' || $_SESSION['Designation'] ==  'Production Specialist_Lead'){
$smartJms = "show";
$Capacity = "show";
$staffing = "show";
$Logsheet = "show";
$Roster = "show";
$construction = "show";
$Display_roster = "show";
$Activity = "show";
$Job = "show";
$Queue = "show";
$Options = "show";
$Reports = "show";
$Edit_logsheet = "show";
$roster_update = "show";
$edit_log_date = "show";
$Import = "show";
$Update_signup = "hide";
$edit_dropdown = "hide";
$pup_test1 = "hide";
$New_Logsheet = "hide";
$JMS_Sheet = "hide";
$JohnLewis = "show";
$JMS_SheetLog = "show";
$PSC_report = "show";
$Import_Excel = "show";
$Logsheet_check = "show";
$edit_quotes = "show";
$QC_report = "show";
$View_logsheet = "show";
$jobs_list = "show";
$jobs = "show";
$jobs_listjms = "show";
$Assign_Self_QA="show";
$responseApproval="hide";
$setdcInput="show";
$tcForecast="show";

}
if($_SESSION['user_level'] == 'OPERATOR' && $_SESSION['Designation'] !=  'Production Specialist_Lead'){
$smartJms = "show";
$Capacity = "hide";
$staffing = "show";
$Logsheet = "show";
$PSC_report = "show";
$View_logsheet = "show";
$Roster = "hide";
$construction = "hide";
$Display_roster = "show";
$Activity = "hide";
$Job = "show";
$Queue = "hide";
$Options = "hide";
$Reports = "hide";
$Edit_logsheet = "hide";
$roster_update = "hide";
$edit_log_date = "hide";
$Import = "hide";
$Update_signup = "hide";
$New_Logsheet = "hide";
$Import_Excel = "hide";
$Logsheet_check = "hide";
$edit_quotes = "hide";
$edit_dropdown = "hide";
$pup_test1 = "hide";
$QC_report = "hide";
$JMS_Sheet = "hide";
$JohnLewis = "hide";
$JMS_SheetLog = "hide";
$jobs_list = "show";
$jobs = "show";
$jobs_listjms = "show";
$Assign_Self_QA="show";
$responseApproval="hide";
$setdcInput="hide";
$tcForecast="hide";

}
}
else {
echo "<script>alert('user_level Not assigned Contact manager')</script>";
echo "<script>window.open('index.php','_self')</script>";
}

if($_SESSION['EmployeeID'] == 'ADMIN'){
?>
<script>

 setInterval(function () {document.getElementById("Premedia").click();}, 25000);
	
</script>

<a id="TC" href="https://docs.google.com/spreadsheets/d/1vol16HqvY9hgmZB2ooFerJh0fvhHVZ-2I1l9qTDaulw/export?format=csv" style="display:none">TC</a>
<a id="GP" href="https://docs.google.com/spreadsheets/d/1LWu0Tj6W1R6qPsKz-Z7v5IfX-382X8R0yGstNqUwAYA/export?format=csv" style="display:none">GP</a>
<a id="AMI" href="https://docs.google.com/spreadsheets/d/1pbnTYgHFlgj-pmlikWwcaFXrxly1WCB9-Xamdedoz_Y/export?format=csv" style="display:none">AMI</a>
<a id="JL" href="https://docs.google.com/spreadsheets/d/1PCCm6W39bJvGo5CXmo2bUhRtus_VZKr_79mXRWwdoss/export?format=csv" style="display:none">JL</a>
<a id="Premedia" href="https://docs.google.com/spreadsheets/d/1336bLVvsJM42vVvsmi1-ISyL5t9mi8mFwPoqrIYhp0w/export?format=csv " style="display:none">All_data</a>
<?PHP	
	
}

 
?>
	

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	<meta http-equiv="X-UA-Compatible" content="IE=10; IE=9; IE=8; IE=7; IE=EDGE" />
    <title>Born Pre-Media</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">    
	


    <!-- Custom styles for this template -->

    <link href="assets/css/stylee.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

	
 <script src="assets/js/jquery.js"></script>
    

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="js/jquery_ui/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
	<!-- Sorting -->
	
<link href="css/bootstrap-sortable.css" rel="stylesheet" type="text/css">
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap-sortable.js"></script> 

	<!-- End Sorting -->
<style>
ul.sidebar-menu li ul.sub li {
    background: dimgrey;
}
ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
    background: dimgrey;
}
span{
	font-size: larger;
	color:white;
}

</style>	
          </head>
  <body id="wrapperr">

	<header class="header black-bg" style='border: 0px;background:transparent;'>
	
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Show / Hide"></div>
              </div>
            <!--logo start-->
            <a href="Home.php" class="logo"><b>Born</b></a>
            <!--logo end-->
			<div class="row">
						
            <div class="top-menu" class="col-md-4">
            	<ul class="nav pull-right top-menu">
				    <li><a class="btn btn-default logout pull-right" style="color:black;" href="Update_password.php">Change password</a></li>
				    <li><a class="logout" style="color:black; cursor:pointer;" >Request Approval</a></li>
					<li> <img src='img/signout.png' class="out" style="width:30px;height:30px;margin-right: 10px; margin-top: 13px; cursor:pointer;" title='logout'/> </li>
            	</ul>
           </div>
			
			</div>
        </header>
		
		      <aside>
          <div id="sidebar"  class="nav-collapse " style='background-color:#424b5d;'>
              <!-- sidebar menu start-->
			  
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="Home.php"><img class="img-circle" width="60"></a></p>
              	  <h5 class="centered"> <?PHP echo $EmployeeID; ?> </h5>
              	  <h5 class="centered"> <?PHP echo $name ; ?> </h5>
              	  <div class='<?php echo $Capacity ?>' style="display:none">	
                  <li class="mt">
                      <a class="active" href="homeCP.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Capacity planner</span>
                      </a>
                  </li>
				  </div>
              	  <div class='<?php echo $smartJms ?>' style="display:none">
                  <li>
                      <a href="PPIS.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Smart JMS</span>
                      </a>
                  </li>
				  </div>
				<div class='<?php echo $staffing ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span> Staffing </span>
                      </a>
                      <ul class="sub">
                          <li><a  href="roster.php" class='<?php echo $Roster ?>'>Create Roster</a></li>
                          <li><a  href="roster_update.php" class='<?php echo $roster_update ?>'>Update Roster</a></li>
                          <li><a  href="Display_roster.php" class='<?php echo $Display_roster ?>'>Display Roster </a></li>
                          <li><a  href="Import.php" class='<?php echo $Import ?>'>Import Roster </a></li>
                      </ul>
                  </li>
				 </div>
				<div class='<?php echo $Activity ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Employee Activity</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="Force_Signout.php">Force_Signout</a></li>
                          <li><a  href="Backup.php">Backup</a></li>
						  <li><a  href="DCInputs.php" class='<?php echo $setdcInput ?>'>Input DC</a></li>
						  <li><a  href="responseApproval.php" class='<?php echo $responseApproval ?>'>Approve Request</a></li>
                      </ul>
                  </li>
				 </div>
				  <div class='<?php echo $Job ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span> My Job Queue</span>
                      </a>
                      <ul class="sub">
					  <li><a  href="jobs.php" class='<?php echo $jobs ?>'>Jobs</a></li>
                          <li><a  href="JMS_JOBS.php" class='<?php echo $jobs_list ?>'>Jobs List DMG</a></li>
						  <li><a  href="AssignSelfQA.php" class='<?php echo $Assign_Self_QA ?>'>Quality Assurance</a></li>
						<li><a  href="logsheet_v1.php" class='<?php echo $Logsheet ?>'>Logsheet</a></li>
						<li><a  href="View_logsheet.php" class='<?php echo $View_logsheet ?>'>View Logsheet</a></li>
						<li><a  href="Edit_logsheet.php" class='<?php echo $Edit_logsheet ?>'>Edit Logsheet</a></li>
						<li><a  href="New_Logsheet.php" class='<?php echo $New_Logsheet ?>'>New_Logsheet</a></li>
						<li><a  href="Import_Excel.php" class='<?php echo $Import_Excel ?>'>Import_Excel</a></li>
                      </ul>
                  </li>
				  </div>
				   <div class='<?php echo $Queue ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Job Management</span>
                      </a>			  
                      <ul class="sub">
                          <li><a  href="JMS.php">DMG</a></li>
						  <li><a  href="JohnLewis.php" class='<?php echo $JohnLewis ?>'>John Lewis</a></li>
						  <li><a  href="tcForecast.php" class='<?php echo $tcForecast ?>'>TC Forecasts</a></li>
						   <li><a  href="JMS_SheetLog.php" class='<?php echo $JMS_SheetLog ?>'>View Logs</a></li>
                      </ul>
                  </li>	 
				  </div>
				  <div class='<?php echo $Options ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Options</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="edit_dropdown.php">edit_dropdown</a></li>                      
                          <li><a  href="edit_quotes.php">edit_quotes</a></li>                      
                      </ul>
                  </li>
				  </div>
				  <div class='<?php echo $Reports ?>' style="display:none">
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Reports</span>
                      </a>
                      <ul class="sub">  
						  <li><a  href="JMS_Sheet.php" class='<?php echo $JMS_Sheet ?>'>JMS_Sheet</a></li>
                          <li><a  href="punctualityChart.php">Puntuality</a></li>
                          <li><a  href="Break_tracker.php">Break_tracker</a></li>
                          <li><a  href="Update_signup.php" class='<?php echo $Update_signup ?>'>Employee_Allotment</a></li>
						   <li><a  href="PSC_report.php" class='<?php echo $PSC_report ?>'>Perfomance_Score_card</a></li>
						   <li><a  href="Logsheet_check.php" class='<?php echo $Logsheet_check ?>'>Logsheet_check</a></li>                    					 
						   <li><a  href="PUB_report.php" class='<?php echo $pup_test1 ?>'>Pub_report</a></li>
						   <li><a  href="QC_report.php" class='<?php echo $QC_report ?>'>QC_report</a></li> 
							<li><a  href="Feedback_Forum.php" class='<?php echo $Feedback_Forum ?>'>Feedback_Forum</a></li>    						   
						   <li><a  href="Feedback_Dashboard.php" class='<?php echo $Feedback_Dashboard ?>'>Feedback_Dashboard</a></li>                    					 
                      </ul>
                  </li>
				  </div>
				  
				  
			
			
   <?PHP  
 if($_SESSION['EmployeeID'] !=""){
/* echo "EmployeeID : "; 
 echo "yes";?> <span class="glyphicon glyphicon-ok"></span><?php*/
 } 
 else{
 echo "EmployeeID : ";
 echo "no";?><span class="glyphicon glyphicon-remove"><marquee>Please End the activity and Re-login 'EmployeeID' is not set</marquee></span><?PHP
 echo "<script>alert('Please End the activity and re-login 'EmployeeID' is not set')</script>";
 }
  echo "<br>";
  if($_SESSION['name'] !=""){/* 
  echo "Name : "; 
  echo "yes";?> <span class="glyphicon glyphicon-ok"></span><?php */
 }
 else{
 echo "Name : "; 
 echo "no";?><span class="glyphicon glyphicon-remove"></span><marquee>Please End the activity and Re-login 'Name' is not set</marquee><?PHP
 echo "<script>alert('Please End the activity and re-login 'Name' is not set')</script>";
 }
  echo "<br>";
  if($_SESSION['date'] !=""){/* 
 ?> <span><b>Date : </b></span><?php 
  echo "yes";?> <span class="glyphicon glyphicon-ok"></span><?php */ 
 }
 else{
 /*echo "Date : "; 
 echo "no";?><span class="glyphicon glyphicon-remove"></span><marquee>Please End the activity and Re-login 'DATE' is not set</marquee><?PHP
 echo "<script>alert('Please End the activity and re-login 'DATE' is not set')</script>";*/
 }
   echo "<br>";
  if($_SESSION['TeamName'] !=""){/* 
  echo "TeamName : "; 
  echo "yes";?> <span class="glyphicon glyphicon-ok"></span><?php */
 }
 else{
 echo "TeamName : "; 
 echo "no";?><span class="glyphicon glyphicon-remove"><<marquee>Please End the activity and Re-login 'TeamName' is not set</marquee>/span><?PHP
 echo "<script>alert('Please End the activity and re-login 'TeamName' is not set')</script>";
 }
 $displayPic='img/Emp_DP/'.$_SESSION['EmployeeID'].'.jpg';
 if (file_exists($displayPic)){
	$displayPic='img/Emp_DP/'.$_SESSION['EmployeeID'].'.jpg';
 }
 else{
	 $displayPic='assets/img/Born.jpg';
 }
 ?>
              </ul>
              <!-- sidebar menu end-->
          </div>
		
      </aside>
	  </body>
  <script type="text/javascript">
  $(document).ready(function(){
  $(".img-circle")[0].src="<?php echo $displayPic ?>";
	  
employeeID ="<?php echo $_SESSION['EmployeeID'] ?>";;
employeeName = "<?php echo $_SESSION['name'] ?>";;
  });
  </script>