<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive sidebar template with sliding effect and dropdown menu based on bootstrap 3">
	
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
	
    <title>PPIS</title>
	
    <!--1<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    <!--2--><link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	
	<!--3--><link href="<?php echo base_url();?>public/css/sidebar.css" rel="stylesheet">    
	<!--4--><script src="<?php echo base_url();?>/public/js/sideHandler.js"></script>
	<!--5--><script src="<?php echo base_url();?>/public/js/sideHandler1.js"></script>
	<!--6--><link href="<?php echo base_url();?>/public/css/sidePaneCss.css" rel="stylesheet" />
	<!--16<link href="<?php echo base_url();?>/public/css/bootstrap.css" rel="stylesheet" />-->
	<!--7--><link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!--8--><script src="https://code.jquery.com/jquery-1.12.4.js"></script>  
	<!--9--><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  
	<!--10<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>-->
	<!--11<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">-->
	<!--12--><script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<!--13--><script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>	
	<!--14<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">	-->
	<!--15--><script src="<?php echo base_url();?>/public/js/sidebar.js"></script>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  
	

<style>
ul.sidebar-menu li ul.sub li {
    background: dimgrey;
}
ul.sidebar-menu li a.active, ul.sidebar-menu li a:hover, ul.sidebar-menu li a:focus {
    background: dimgrey;
}

</style>
</head>

<body>
<input type="hidden" class="base" value="<?php echo base_url(); ?>">
<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">born</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" style="width:50px;height:50px;" src="<?php echo base_url();?>img/user_white.png" alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name"><?php echo $_SESSION['fName'] ?>
            <!--<strong>Smith</strong>-->
          </span>
		   <span class="user-role" style=""><?php echo $_SESSION['user_level']." - ".$_SESSION['TeamName'] ?> </span>
          <span class="user-id" style="display:none;"><?php echo $_SESSION['EmployeeID'] ?> </span>
          <!--<span class="user-role"><?php echo $_SESSION['user_level'] ?></span>-->
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-header  -->
      <div class="sidebar-search">
        <div>
          <div class="input-group">
            <input type="text" class="form-control search-menu" placeholder="Search...">
            <div class="input-group-append">
              <span class="input-group-text">
                <i class="fa fa-search" aria-hidden="true"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- sidebar-search  -->
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-tachometer-alt"></i>
              <span>Capacity Planner</span>
              <!--<span class="badge badge-pill badge-warning">New</span>-->
            </a>
            <!--<div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">Dashboard 1
                    <span class="badge badge-pill badge-success">Pro</span>
                  </a>
                </li>
                <li>
                  <a href="#">Dashboard 2</a>
                </li>
                <li>
                  <a href="#">Dashboard 3</a>
                </li>
              </ul>
            </div>-->
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-cogs"></i>
              <span>Staffing</span>
              <span class="badge badge-pill badge-danger" style="background-color: red;">3</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/rosterCreate">Create Roster</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/rosterDisplay">Update Roster</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/rosterUpdate">Display Roster</a>
                </li>
                <li>
                  <a href="#">Import Roster</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="far fa-gem"></i>
              <span>My Job Queue</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">JL Jobs</a>
                </li>
                <li>
                  <a href="#">DMGT Jobs</a>
                </li>
                <li>
                  <a href="#">Assign JL Jobs</a>
                </li>
                <li>
                  <a href="#">Assign DMGT Jobs</a>
                </li>
                <li>
                  <a href="#">QA Jobs</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-chart-line"></i>
              <span>Job Management</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="#">DMGT</a>
                </li>
                <li>
                  <a href="#">John Lewis</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-chart-bar"></i>
              <span>Reports</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/viewLogs">Export Logs</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/viewPunctuality">View Punctuality Reports</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="sidebar-dropdown">
            <a href="#">
              <i class="fa fa-globe"></i>
              <span>Admin Acts</span>
            </a>
            <div class="sidebar-submenu">
              <ul>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/employeeAllotment">Employee Allotment</a>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>HomeScreen/forceSignout">Force Signout</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="header-menu">
            <span>Extra</span>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Documentation</span>
              <span class="badge badge-pill badge-primary" style="background-color: cadetblue;">Beta</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-calendar"></i>
              <span>Calendar</span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-folder"></i>
              <span>Examples</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="#">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-warning notification" style="background-color: orangered;">3</span>
      </a>
      <a href="#">
        <i class="fa fa-envelope"></i>
        <span class="badge badge-pill badge-success notification" style="background-color: green;">7</span>
      </a>
      <a href="#">
        <i class="fa fa-cog"></i>
        <span class="badge-sonar"></span>
      </a>
      <a href="<?php echo base_url(); ?>LoginRegister/logout">
        <i class="fa fa-power-off"></i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content"> <!-- this ends in another page where the page is linked like home page-->
    <div class="container-fluid"> <!-- this ends in another page where the page is linked like home page-->
      
	  
    
<!-- page-wrapper
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> -->
    
