<?PHP 
include __DIR__ . "/../header.php";
error_reporting(0);	
 ?>


      <!--main content start-->
	  
	  <section id="main-content">
          <section class="wrapper" style="">
		  <!--<script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript" ></script>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">-->
<script src="https://cdn.zingchart.com/zingchart.min.js"></script>

<input type="hidden" class="base" value="<?php echo base_url(); ?>">
			<div id="dashboard">
		<div id="loadersCapacity" style="position: fixed; z-index: 1;padding-top: 400px;padding-left: 900px;left: 0;top: 0;width: 100%;height: 100%; overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);display:none;"><img id = "loadingjmsSheet_Log" src = "<?php echo base_url();?>img/load5.gif" alt = "Loading indicator" style="width:60px;"></div>		
			<table id="countTable" style="margin-top: -1px;width: 100%;">
			<tr>
				<th>Total Images</th>
				<th>Total Images for the month</th>
				<th>Total Jobs for the day</th>
				<th>Work In Progress</th>
				<th>Jobs Delivered Today</th>
				<th>Total Head Count</th>
				<th>Head Count Online</th>
				<th>Core Utilization</th>
			</tr>
				<tr style="font-size: x-large;">
					<td><div class="tdDiv" id="totalI"></div></td>
					<td><div class="tdDiv" id="totalImgMonth"><div style="text-decoration: underline;cursor:pointer;" onclick="getPreMonVal(this);"></div></div></td>
					<td><div class="tdDiv" id="totalTod"></div></td>
					<td><div class="tdDiv" id="totalProcessing"></div></td>
					<td><div class="tdDiv" id="totalDelivered"></div></td>
					<td><div class="tdDiv" id="totalEmployees"></div></td>
					<td><div class="tdDiv" id="totalEmployeesOn"></div></td>
					<td><div class="tdDiv" id="utilHours"></div></td>
				</tr>
			</table>
			<table style="border: 2px solid whitesmoke; display:none;"><tr>
				<td style="width:70%;"><h3 style="color: gray;">DMG Statistics:</h3> </td>
				<td style="width: 10%;text-align: right;display:none;">
					<b>From: </b><input type="text" id="datepickerStartdash" placeholder="Select Start Date" >&nbsp&nbsp
					<b>To: </b><input type="text" id="datepickerEnddash" placeholder="Select End Date">
				</td>
			</tr>
			</table>
			<table id="chartscore" style="width:100%; height:510px;border: 2px solid whitesmoke;">
				<tr>
					<td style="width:35%;">
						<div id='complChart'></div>						
					</td>
					<td style="width:20%;padding-left: 4px;border: 2px solid white;">
					<div id='mainDdiv' style="height:96%; border: 1px solid #dadada; margin-top: -13px;">
					<div id='QualityChart' style="text-align: -webkit-center;height: 48%;border-bottom-width: 6px;"></div><br/>					
					<div id='otdChart' style="text-align: -webkit-center;"></div><br/>					
					</div>
					</td>
					<td style="width:45%;padding-left: 14px;">
						<h7 style="color: gray;"><b>Publisher Split-ups:</b></h7>
						<div id="publSplit" style="height:95%;background-color: #E2E2E2;overflow: auto;"></div>
					</td>
				</tr>
			</table>
				<h5 style="color: gray;">View Comparitive Statistics:</h5>
				<div><div id="multiSlider"></div></div>
				
		<div id="myModaltoOperatorInfo" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal3();">&times;</span>
                <div id="insideModalOp" style="border: 1px solid chocolate;padding-left: 5px;">
                   <div id="OpHist"></div>
				</div>                   
                    
                </div>
            </div>
			<div id="myModalMonthlyInfo" class="modal">
				<div class="modal-content" style="max-width: 13%;">
					<span class="close" onclick="closeModal4();">&times;</span>
					<div id="insideModalMon" style="border: 1px solid chocolate;padding-left: 5px;">
					   <div id="MonHist"></div>
					</div>
				</div>
			</div>
		</div>
		<div id="modalForOTD" class="modal">
            <div class="modal-content" style="width:45%; max-height: 700px; overflow-y: scroll;">
                <span class="close" onclick="closemodalForOTD();">&times;</span>
                <div id="insmodalForOTD" style="border: 1px solid chocolate;padding-left: 5px;">
                    <h4 style="margin-top:2px;color:#FB3406;text-align: center;">OTD Analysis</h4>
					<div id="OTDAn" style="max-height: 350px;overflow-y: auto;text-align: center;"></div>
				</div>
                    
                </div>
            </div>
			<div id="modalForQual" class="modal">
            <div class="modal-content" style="max-width:45%; max-height: 700px; overflow-y: scroll;">
                <span class="close" onclick="closemodalForQuality();">&times;</span>
                <div id="insmodalForQual" style="border: 1px solid chocolate;padding-left: 5px;">
                    <h4 style="margin-top:2px;color:#FB3406;text-align: center;">Quality Analysis</h4>
					<div id="QualAn" style="max-height: 350px;overflow-y: auto;text-align: center;"></div>
				</div>
                    
                </div>
            </div>
			
		<div id="dialog" class="modal">
            <div class="modal-content" style="width:30%; max-height: 700px;">
                <span class="close" onclick="closemodalFordialog();">&times;</span>
                <div id="insdialogue" style="border: 1px solid chocolate;padding-left: 5px;">
                    <h4 style="margin-top:2px;color:#FB3406;text-align: center;">OTD Comparitive Statistics</h4>
					<table style="width:100%;">
						<tr>
						<td><div class="previous round" style="text-decoration: none;display: inline-block;padding: 8px 16px;border:1px solid #4CAF50;cursor:pointer;" onclick="nextPrevDiv(this);">&#8249;</div></td>
						
							<td>
								<div id="compareDateChart">
								<div id="compTrend" class="1"></div>
								<div id="volumeTrend" class="2" style="width:400px;height:400px;display:none;"></div>
								<div id="qualTrend" class="3" style="width:400px;height:400px;display:none;"></div>
								</div>						
							</td>
							
						<td><div class="next round" style="text-decoration: none;display: inline-block;padding: 8px 16px;cursor:pointer;" onclick="nextPrevDiv(this);">&#8250;</div></td>
						</tr>
					</table>
				</div>
                    
                </div>
            </div>
			
		
		
		<div id="dialogOTDComp" class="modal">
            <div class="modal-content" style="width:63%; max-height: 700px; overflow: hidden;">
                <span class="close" onclick="closemodalForOTDComp();">&times;</span>
                <div id="insdialogOTDComp" style="border: 1px solid chocolate;padding-left: 5px;background-color: aliceblue;">
                    <h4 style="margin-top:2px;color:#FB3406;text-align: center;">OTD Comparitive Statistics</h4>
					
					<table style="width:100%;">
						<tr>
							<td><b>Choose a month:</b> <input type="text" id="firstDate" ><div id="OTDdiffChart"></div></td>
							<td><b>Choose a month to compare:</b> <input type="text" id="secondDate" ><div id="OTDdiffChart1"></div>
						</tr>
					</table>
				</div>
                    
                </div>
            </div>
		
		<div style="display:none;">
		<h7 style="color: gray;"><b>Complexity Statistics, Volume Received & Volume Delivered:</b></h7>
		<div id="forDashChart1" style="width: 95%;height: 485px	;margin-left: 20px;overflow: hidden;margin-top: 5px;"></div>
		</div>
			
 </section>
  </section>
  <script>
$(document).ready(function(){
    capacityPlanner();
	
});
function closemodalForOTD(){
	$("#insmodalForOTD > h4 >img").remove();
	modal = document.getElementById('modalForOTD');
modal.style.display = "none";
}
function closemodalForOTDComp(){
	$("#insdialogOTDComp > h4 >img").remove();
	modal = document.getElementById('dialogOTDComp');
modal.style.display = "none";
}

function closemodalForQuality(){
	modal = document.getElementById('modalForQual');
modal.style.display = "none";
}
</script>
      <!--main content end-->	  

 </body>
</html>