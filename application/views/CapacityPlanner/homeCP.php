<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
?>

<section id="main-content" style='background-color:#F0F0F0'>
		<section class="wrapper site-min-height">
			<script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript" ></script>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />

<style>
#main-content{
	//background-size: 20px 20px;
	//background-image: url("img/1.jpg"),url("img/a.jpg"),linear-gradient(to right, lightgrey 1px, transparent 1px), linear-gradient(to bottom, lightgrey 1px, transparent 1px);
	//background-size: 100%;
	//background-size: 15px 15px;
    //background-image: linear-gradient(to right, lightgrey 1px, transparent 1px), linear-gradient(to bottom, lightgrey 1px, transparent 1px);
}
</style>
</br>
<input type="hidden" class="base" value="<?php echo base_url(); ?>">
<div id="loders" style="position: fixed; z-index: 1;padding-top: 400px;padding-left: 900px;left: 0;top: 0;width: 100%;height: 100%; overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);"><img id = "loading" src = "<?php echo base_url();?>img/load5.gif" alt = "Loading indicator" style="width:60px" ></div>

<div class="jumb" style="background-color: #424A5D; color:white; text-align:center;">
  <div>
    <h1>CONTENT PRODUCTION - CAPACITY PLANNER</h1>
  </div>
</div></br>

	<div id="commonMod" class="modal">
	<div class="modal-content" style="width: 500px; max-height: 700px; overflow: hidden;">
	<span class="close" onclick="closeModalLP();">&times;</span>
		<div id="inscommonMod" style="border: 1px solid chocolate;padding-left: 5px;">
			<div style='text-align:center;' class='commonModDiv'></div>
		</div>
			
		</div>
	</div>
			
	
<div class="container" style="width:100%">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-info">
        <div class="panel-heading" style="cursor: pointer;"> <a href="<?php echo base_url(); ?>HomeScreen/capacityPlannerDMGT">DMGT</a></div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td><div id='recDmg'></div></td></tr><tr><td>Fresh</td><td id='FreshDmg'>In development</td></tr><tr><td>Amends</td><td id='AmendsDmg'>"</td></tr><tr><td>To Be Initiated</td><td id='ytaDmg'></td></tr><tr><td>Work In Progress</td><td id='wipDmg'></td></tr><tr><td>Waiting For QC</td><td id='needQCDmg'></td></tr><tr><td>Delivered</td><td id='delDmg'></td></tr><tr><td>OTD</td><td id='otdDmg'></td></tr><tr><td>Internal Quality</td><td id='inQualDmg'></td></tr><tr><td>Actual Headcount</td><td id='actHeadCntDmg'></td></tr><tr><td>Available Headcount</td><td onclick='displayWOAbs(this)' id='headCountDmg' style="cursor:pointer;line-height: 0px;"></td></tr> <tr><td>Elapsed Time</td><td id='elapseTimeDmg'></td></tr> <tr><td>Available Capacity</td><td id='availCapDmg'></td></tr> <tr><td>Used Capacity</td><td id='usedCapDmg' onclick='displayusedBriefCap(this)' style="cursor:pointer;line-height: 0px;"></td></tr><tr><td>Remaining Capacity</td><td id='remCapDmg' onclick='displayremCap(this)' style="cursor:pointer;line-height: 0px;"></td></tr><tr><td>Above Handling Capacity</td><td id='abvHanCalDmg'></td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
	  <div class="panel-heading">JOHN LEWIS</div>
         <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td><div id='recJL'></div></td></tr><tr><td>Fresh</td><td id='FreshJL'>In development</td></tr><tr><td>Amends</td><td id='AmendsJL'>"</td></tr><tr><td>To Be Initiated</td><td id='ytaJL'></td></tr><tr><td>Work In Progress</td><td id='wipJL'></td></tr><tr><td>Waiting For QC</td><td id='needQCJL'></td></tr><tr><td>Delivered</td><td id='delJL'></td></tr><tr><td>OTD</td><td id='otdJL'></td></tr><tr><td>Internal Quality</td><td id='inQualJL'></td></tr><tr><td>Actual Headcount</td><td id='actHeadCntJL'></td></tr><tr><td>Available Headcount</td><td onclick='displayWOAbs(this)' id='headCountJL' style="cursor:pointer;line-height: 0px;"></td></tr> <tr><td>Elapsed Time</td><td id='elapseTimeJL'></td></tr> <tr><td>Available Capacity</td><td id='availCapJL'></td></tr> <tr><td>Used Capacity</td><td id='usedCapJL' onclick='displayusedBriefCap(this)' style="cursor:pointer;line-height: 0px;"></td></tr><tr><td>Remaining Capacity</td><td id='remCapJL' onclick='displayremCap(this)' style="cursor:pointer;line-height: 0px;"></td></tr><tr><td>Above Handling Capacity</td><td id='abvHanCalJL'></td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">AMI</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container" style="width:100%">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-danger">
        <div class="panel-heading">General Print</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">TC</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-info">
        <div class="panel-heading">OST</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td id='totalRec'>In development</td></tr><tr><td>Fresh</td><td id='recFresh'>"</td></tr><tr><td>Amends</td><td id='recAmend'>"</td></tr><tr><td>To Be Initiated</td><td id='recTbi'>"</td></tr><tr><td>Work In Progress</td><td id='recWip'>"</td></tr><tr><td>Waiting For QC</td><td id='recWfQc'>"</td></tr><tr><td>Delivered</td><td id='recDel'>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Actual Headcount</td><td id='actHC'></td></tr> <tr><td>Available Headcount</td><td id="availHC">"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr><tr><td>Estimated Delivery Date</td><td id='estDelDate'>"</td></tr></table>
		</div>
      </div>
    </div>
  </div>
</div><br>

<div class="container" style="width:100%">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-success">
        <div class="panel-heading">JD_SPORTS</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-info">
        <div class="panel-heading">SYNDICATION</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">BOOK COVERS</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
  </div>
</div>
<br>

<div class="container" style="width:100%">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-info">
        <div class="panel-heading">SP_ATRWORK</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">PT ARTWORK</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">PT WEB</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		</div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="container" style="width:100%">    
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-danger">
        <div class="panel-heading">eBooks</div>
        <div class="panel-body">
			<table class='commonCss' style='font-size: 14px;'><tr><td>Jobs Received</td><td>In development</td></tr><tr><td>Fresh</td><td>"</td></tr><tr><td>Amends</td><td>"</td></tr><tr><td>To Be Initiated</td><td>"</td></tr><tr><td>Work In Progress</td><td>"</td></tr><tr><td>Waiting For QC</td><td>"</td></tr><tr><td>Delivered</td><td>"</td></tr><tr><td>OTD</td><td>"</td></tr><tr><td>Internal Quality</td><td>"</td></tr><tr><td>Available Headcount</td><td>"</td></tr><tr><td>Used Capacity</td><td>"</td></tr><tr><td>Remaining Capacity</td><td>"</td></tr><tr><td>Above Handling Capacity</td><td>"</td></tr></table>
		<!--<img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">-->
		</div>
        <!--<div class="panel-footer">Buy 50 mobiles and get a gift card</div>-->
      </div>
    </div>
  </div>
</div>
<br><br>
	<script type="text/javascript">
		$("#loders").show();
		var i = setInterval(function() {
			repeat('Dmg');
			//repeat('JL');
		}, 60000);
		repeat('Dmg');
		//repeat('JL');
		 function repeat(team){
			 $.ajax({
				type:'POST',
				url:"<?php echo base_url();?>public/CapacityPlanner/getInfo.php",	
				data:{nothing:'nodata',team:team},
				success:function(html){
					id = html.split("_")[1];html = html.split("_")[0];
					var c = html.split("*");
					var td = document.getElementById("rec"+id);
					td.innerHTML = c[0];
					td = document.getElementById("Fresh"+id);
					td.innerHTML = c[0];
					td = document.getElementById("Amends"+id);
					td.innerHTML = "0";
					td = document.getElementById("yta"+id);
					td.innerHTML = c[1];
					td = document.getElementById("wip"+id);
					td.innerHTML = c[2];
					td = document.getElementById("needQC"+id);
					td.innerHTML = c[3];
					td = document.getElementById("del"+id);
					td.innerHTML = c[4];
				}
			});
			$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>public/CapacityPlanner/getOTD.php",	
			data:{nothing:'nodata'},
			success:function(html){
				var otdPer =html.split("*");
				otdDetails = otdPer[4];
				var yesPer = Number((otdPer[0]*100/otdPer[3]).toFixed(0));
				var noPer = Number((otdPer[1]*100/otdPer[3]).toFixed(0));
				if(!yesPer){
					yesPer=100;noPer=0;
				}
				td = document.getElementById("otdDmg");
				td.innerHTML = yesPer+"%";
			}
			});
			$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>public/CapacityPlanner/getQuality.php",	
			data:{nothing:'nodata'},
			success:function(html){
				var qualPer =html.split("*");
				QualityDetails = qualPer[3];
				var yesPer = Number((qualPer[0]*100/qualPer[2]).toFixed(0));
				var noPer = Number((qualPer[1]*100/qualPer[2]).toFixed(0));
				if(!yesPer){
					yesPer=100;noPer=0;
				}
				td = document.getElementById("inQualDmg");
				td.innerHTML = yesPer+"%";
			}
			});
			
			
			$.ajax({
			type:'POST',
			url:"<?php echo base_url();?>public/CapacityPlanner/capacityCountsMainDash.php",	
			data:{nothing:'nodata',team:team},
			success:function(html){
				id = html.split("__")[1]; html = html.split("__")[0];
				var c =html.split("BREAK");
				$("#actHeadCnt"+id).html(c[4]);
				$("#headCount"+id).html("<div>"+c[0]+" </div>");		$("#headCount"+id).append("<p style='display:none;' id='myDiv'> <b>DMGT&nbsp:-</b> Week-Off: "+c[5]+", Absenteeism:0 </p>"); $("#headCount").append("&nbsp&nbsp&nbsp<span class='glyphicon glyphicon-info-sign' title='Info' style='position: relative;margin-right: -76px; top: -7px;'></span>");
				$("#remCap"+id).html("<div>"+c[1]+" </div>");		$("#remCap"+id).append("&nbsp&nbsp&nbsp<span class='glyphicon glyphicon-info-sign' title='Info' style='position: relative;margin-right: -76px; top: -7px;'></span>");
				$("#usedCap"+id).html(c[3]);	//$("#usedCap").append("&nbsp&nbsp&nbsp<span class='glyphicon glyphicon-info-sign' title='Info' style='position: relative; margin-right: -22px; top: 3px;'></span>");
				$("#abvHanCal"+id).html(c[2]);
				$("#availCap"+id).html(c[7]);
				$("#elapseTime"+id).html(c[9]);
				
				$("#loders").hide();
			}
			});
			//datagDocs();
		
		}
		
		function displayWOAbs(ref){
			if(ref.id=='headCount'){
				modal = document.getElementById('commonMod');
				modal.style.display = "block";
				$(".commonModDiv").html(ref.children[1].innerHTML);
				setTimeout(function(){ $('#commonMod').fadeOut() }, 2000);
			}
			    //$('#myDiv').toggle('slide', 'left', 500);

		}
		function displayremCap(ref){
				var hrsToCount = (ref.innerText).split(":");
				var calcs = Number(hrsToCount[0]) + (Number(hrsToCount[1])/60)  + (Number(hrsToCount[2])/3600) ;
				var te = ref.parentElement.parentElement.parentElement.parentElement.parentElement.children[0].innerHTML;
				if(te == 'DMGT'){
					id='Dmg'; bench = 3.9;
				}if(te == 'JOHN LEWIS'){id='JL';bench = 8.9;}
			$("#remCap"+id).append("<p style='display:none;' class='myDivRem'> <b>Estimated Jobs to handle:</b> &nbsp &nbsp "+(calcs*Number(bench)).toFixed(1)+"</p>");//3.9 is the average taken for DMG from the list of benchmarks of different publishers and magazines.
				modal = document.getElementById('commonMod');
				modal.style.display = "block";
				$(".commonModDiv").html(ref.children[2].innerHTML); 
		}
		
		function displayusedBriefCap(ref){
			//alert("came");
		}
		
		function openDMGTPage(){
			location.href="<?php echo site_url('public/CapacityPlanner/Capacity_planner.php'); ?>";
		}
		
		function datagDocs() {
			
			var url="https://docs.google.com/spreadsheets/d/e/2PACX-1vQchGj4ZVy-zHXTjl95j5guswhu-feactd63grv83Sz_AphVe6RXysSDFDHiCQrZ0WweH5NipY4jtC5/pub?output=csv";
			$.ajax({
				type:'POST',
				url:'connectgDoc.php',	
				data:{url:url,con:1},
				success:function(html){
					var c =html.split("$");		var totalJobs=0;	var delJobs=0;	var wipJobs=0;	var wfQcJobs=0;	var tbiJobs=0;	var othJobs=0;	var freshJobs=0;	var amendJobs=0;
					var headings =c[0].split("*");
					for(i=1;i<c.length;i++){
						var innerArr = c[i].split("**");
						/*OST -starts*/
						//calculate pending counts
						if(innerArr[16]=='Delivered'){
							delJobs +=Number(innerArr[7]);
						}
						else if(innerArr[16]=='Working in progress'){
							wipJobs +=Number(innerArr[7]);
						}
						else if(innerArr[16]=='Waiting for QC'){
							wfQcJobs +=Number(innerArr[7]);
						}
						else if(innerArr[16]=='To be initiated'){
							tbiJobs +=Number(innerArr[7]);
						}
						else{
							othJobs+=Number(innerArr[7]);							
						}
						if(innerArr[6]=='New'){freshJobs+=Number(innerArr[7]);}
						else{amendJobs+=Number(innerArr[7]);}
						
						/*to calculate estimated hours for delivery*/
						if(innerArr[14]!='Delivered' && innerArr[14]){
							var estTimePerJob = innerArr[17].split(":");
							estTimePerJob = (Number(estTimePerJob[0])*3600) + (Number(estTimePerJob[1])*60) + Number(estTimePerJob[2]);
							
							var recDate=innerArr[10].split("/"); var month;
							var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
							for(var ie=0;ie<mlist.length;ie++){
								if(ie== Number(recDate[0])-1){
									month = mlist[Number(recDate[0])-1];
									break;
								}
							}
							estTimePerJob = estTimePerJob * innerArr[7];
							var finDate = month+" "+recDate[1]+","+recDate[2];
							var dt = new Date(finDate);
							dt.setSeconds( dt.getSeconds() + estTimePerJob);
							dt = dt+"";
							dt = dt.split(" GMT+0530 (India Standard Time)").join("");
							$("#estDelDate").html(dt);
						}
						/*to calculate estimated hours for delivery*/
					}
					totalJobs = delJobs+wipJobs+wfQcJobs+tbiJobs+othJobs;
					
					$("#totalRec").html(totalJobs);		$("#recDel").html(delJobs);		$("#recWip").html(wipJobs);		$("#recWfQc").html(wfQcJobs);		$("#recTbi").html(tbiJobs);		$("#recFresh").html(freshJobs);		$("#recAmend").html(amendJobs);
					/*OST -ends*/
					//totalRec,recFresh,recAmend,recTbi,recWip,recWfQc,recDel

					
				}
			});
		}
		
		/*
		0:""
1:"Account Manager"
2:"Client"
3:"Project/job"
4:"Type of shot/s"
5:"Final output usage"
6:"Correction or New"
7:"Number of Images"
8:"Number of Drop -ins"
9:"Proad Code"
10:"Date Sent "
11:"Delivery Date"
12:"Urgent request time/date"
13:"Status "
14:"OTD "
15:"Additional Notes"
16:"Time estimate per image / project"
17:"Total time required in hours"
18:"Number of days required based on one operator"
19:"Complexity"
20:"Job Count Verification"
		*/
		</script>
		</section>
          </section>
</body>
</html>
