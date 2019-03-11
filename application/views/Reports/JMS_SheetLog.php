<?PHP
include __DIR__ . "/../header.php";
?>
<style>

</style>

<section id="main-content" style="background:<?php echo base_url();?>img/template.JPG" >
		<section class="wrapper site-min-height">
			
		<input type="hidden" class="base" value="<?php echo base_url(); ?>">
		
<div id="centreTextA" style="margin-top: 50px;">
		<h1 style="text-align: -webkit-center;">JOB MANAGEMENT SYSTEM - View Logs</h1>
		<div> <br/>
		<div id="loadersjmsSheet_Log" style="position: fixed; z-index: 1;padding-top: 400px;padding-left: 900px;left: 0;top: 0;width: 100%;height: 100%; overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4);display:none;"><img id = "loadingjmsSheet_Log" src = "<?php echo base_url();?>img/load5.gif" alt = "Loading indicator" style="width:60px;"></div>
		<div id="centreTextA" style="">
		<table style="width: 100%;">
                <tr>
                    <td style="border: 1px solid lightgray;text-align: center; background-color: #6699cc; color: white;height:30px; width:20%;">Click to view Job Status:&nbsp&nbsp</td>
                    <td style="border: 1px solid lightgray;    text-align: center; width:20%;">
						<div><b>&nbsp On: &nbsp&nbsp&nbsp&nbsp</b><input type="text" id="datepickerStartDateL" placeholder="Select Start Date">&nbsp&nbsp</div>
					</td>
					<!--
                    <td style="border: 1px solid lightgray;">
						<div style=""><b>&nbspTo: </b><input type="text" id="datepickerEndDateL" placeholder="Select End Date">&nbsp&nbsp</div>
					</td>-->
					<td style="border: 1px solid lightgray;text-align:center; width:20%;">
						<input class="radSelect" id="te" type="radio" value="Team" />&nbsp&nbsp Team &nbsp <input class="radSelect" id="op" type="radio" value="Operator" checked/>&nbsp&nbspOperator
					</td>
					<td style="border: 1px solid lightgray; width:40%; text-align:center;">
					<div id="team" style="display:none;"><label>&nbspChoose Team:&nbsp&nbsp<label><select id="OperatorSelectCoreLT" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"></select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
					<img onclick="exportToExcelOperatorSheet1();" title="Export To Excel" src="<?php echo base_url();?>img/excel.png" style="width: 20px; height: 20px;"/>
					</div>
					<div id="operator"><label>&nbspChoose Operator:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label><select id="OperatorSelectCoreL" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"></select> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input id="opDisp" type="button" value="Display Logs" onclick="displayOpLogs();"/>
					<img onclick="exportToExcelOperatorSheet2();" title="Export To Excel" src="<?php echo base_url();?>img/excel.png" style="width: 20px; height: 20px;"/>
					</div>
					</td>
                </tr>
		</table>
			<div id="tableValuesForExcelLOP"></div>
			<div id="tableValuesForExcelLTeam" style="display:none;"></div></br></br>
			</div>
			
			</br></br>
			
			<div id="centreTextC" style="">
			<table style="width: 100%;">
					<tr>
						<td style="border: 1px solid lightgray;text-align: center; background-color: #6699cc; color: white;height:30px; width:20%;">Generate Shift Report:&nbsp&nbsp</td>
						<td style="border: 1px solid lightgray; width:40%;text-align: center;">
							<div><b>&nbsp On: &nbsp&nbsp&nbsp&nbsp</b><input type="text" id="datepickerStartDateSR" placeholder="Select Start Date">&nbsp&nbsp</div>
						</td><!--
						<td style="border: 1px solid lightgray;">
							<div style=""><b>&nbspTo: </b><input type="text" id="datepickerEndDateSR" placeholder="Select End Date">&nbsp&nbsp</div>
						</td>-->
						<td style="border: 1px solid lightgray; width:40%;">
						<div id="teamSR" ><label>&nbspChoose Team:&nbsp&nbsp<label>
						<select id="selectTeamSR" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"></select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						
						<img onclick="exportToExcelOperatorSheetSR();" title="Export To Excel" src="<?php echo base_url();?>img/excel.png" style="width: 20px; height: 20px;"/>
						</div>
						</td>
					</tr>
			</table>
			<div id="tableValuesForShiftReport" style="text-align:-webkit-center;"></div>
		</div>
			
			</br></br></br></br>
		
		<div id="centreTextB" style="">
			<table style="width: 100%;" id='pubTable'>
					<tr>
						<td style="border: 1px solid lightgray;text-align: center; background-color: #6699cc; color: white;height:30px; width:20%;">Generate Publisher Report:&nbsp&nbsp</td>
						<td style="border: 1px solid lightgray; width:20%;">
							<div><b>&nbsp From: </b><input type="text" id="datepickerStartDatePR" placeholder="Select Start Date">&nbsp&nbsp</div>
						</td>
						<td style="border: 1px solid lightgray; width:20%;">
							<div style=""><b>&nbspTo: </b><input type="text" id="datepickerEndDatePR" placeholder="Select End Date">&nbsp&nbsp</div>
						</td>
						<td style="border: 1px solid lightgray; width:40%;">
						<div id="teamPR" ><label>&nbspChoose Team:&nbsp&nbsp<label>
						<select id="selectTeamPR" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"></select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
						
						<img onclick="exportToExcelOperatorSheetPR();" title="Export To Excel" src="<?php echo base_url();?>img/excel.png" style="width: 20px; height: 20px;"/>
						</div>
						</td>
					</tr>
			</table>
			<div id="tableValuesForPubReport" style="text-align:-webkit-center;"></div>
		</div>
			
			
		</div>
		</div>
<script type="text/javascript">

$(document).ready(function(){//SELECT * FROM `teams`
$("input[class=radSelect]").change(function (re) {
	if(re.currentTarget.id=="te"){
		$("#team").show();
		$("#operator").hide();
		$("#op")[0].checked=false;
		$("#tableValuesForExcelLOP").hide();
	}
	else{
		$("#team").hide();
		$("#operator").show();
		$("#te")[0].checked=false;
		$("#tableValuesForExcelLOP").show();
		}
});
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/vars1.php",	
		data:{pars:"parsing"},
		success:function(html){
			$("#OperatorSelectCoreL").empty().append('<option value="" style="background-color:white;color:Black">Select Operator</option>');
			var c = html.split("/FREAK/");
			  $("#OperatorSelectCoreL >option").after(c[3]);
		}	  
	});
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/teamInfo.php",	
		data:{pars:"parsing"},
		success:function(html){
			$("#OperatorSelectCoreLT").empty().append('<option value="" style="background-color:white;color:Black">Select Team</option>');
			  $("#OperatorSelectCoreLT >option").after(html);
			$("#selectTeamPR").empty().append('<option value="" style="background-color:white;color:Black">Select Team</option>');
			  $("#selectTeamPR >option").after(html);
			$("#selectTeamSR").empty().append('<option value="" style="background-color:white;color:Black">Select Team</option>');
			  $("#selectTeamSR >option").after(html);
		}	  
	});
$( "#datepickerStartDateL" ).datepicker({dateFormat: "dd/MM/yy"}); $( "#datepickerStartDatePR" ).datepicker({dateFormat: "dd/MM/yy"});  $( "#datepickerStartDateSR" ).datepicker({dateFormat: "dd/MM/yy"});
$('#datepickerStartDateL').datepicker().datepicker('setDate', new Date());  $('#datepickerStartDatePR').datepicker().datepicker('setDate', new Date());$('#datepickerStartDateSR').datepicker().datepicker('setDate', new Date());
	//$( "#datepickerEndDateL" ).datepicker({dateFormat: "dd/MM/yy"});
	$( "#datepickerEndDatePR" ).datepicker({dateFormat: "dd/MM/yy"});
	//$('#datepickerEndDateL').datepicker().datepicker('setDate', new Date());
	$('#datepickerEndDatePR').datepicker().datepicker('setDate', new Date());
});	

function exportToExcelOperatorSheet1(){	
if($("#tableValuesForExcelLOP")[0].style.display=="block" || $("#tableValuesForExcelLOP")[0].style.display==""){
			export_table_to_csv($("#tableValuesForExcelLOP > table >tbody > tr"),$("#OperatorSelectCoreL")[0][$("#OperatorSelectCoreL")[0].selectedIndex].innerText+"_JMS_Report");
}
else{
	mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var dateSv = $('#datepickerStartDateL')[0].value.split("/");
	var dateVal = new Date($('#datepickerStartDateL')[0].value);
	dateVal.setDate(dateVal.getDate()+1);
	for(var ie=0;ie<mlist.length;ie++){
		if(dateSv[1]==mlist[ie]){
			if(dateVal.getDate()<10){var aa = "0"+dateVal.getDate();}else{var aa = dateVal.getDate();}
			var edate1= aa + '/' + mlist[(dateVal.getMonth())] + '/' + dateVal.getFullYear();
			break;
		}
	}
	$("#loadersjmsSheet_Log").show();
	//alert("<?PHP echo date("H:i:s", strtotime("12:00:33 AM"))?>");
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/teamWiseSheet.php",	
		data:{sdate1:$('#datepickerStartDateL')[0].value, edate1:edate1,tname1:$("#OperatorSelectCoreLT")[0][$("#OperatorSelectCoreLT")[0].selectedIndex].innerText},
		//data:{sdate1:$('#datepickerStartDateL')[0].value, edate1:$('#datepickerEndDateL')[0].value,tname1:$("#OperatorSelectCoreLT")[0][$("#OperatorSelectCoreLT")[0].selectedIndex].innerText},
		success:function(html){
			var c= html.split("BREAK");
			$("#tableValuesForExcelLTeam").empty();//
			$("#tableValuesForExcelLTeam").html("<br/>"+c[0]);
			download_csv("tableValuesForExcelLTeam",$('#datepickerStartDateL')[0].value+"_JMS_Report"); //export_table_to_csv($("#tableValuesForExcelLTeam > table >tbody > tr"), "JMS_Report.csv");
			$("#loadersjmsSheet_Log").hide();
		}
	});
}
}

function exportToExcelOperatorSheetPR(){
	$("#loadersjmsSheet_Log").show();
	var dateCondition;var dateConditionAux;
	var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	if($('#datepickerStartDatePR')[0].value == $('#datepickerEndDatePR')[0].value){
		dateCondition="Received_Date='"+$('#datepickerStartDatePR')[0].value+"'";
		
		var aux = ($('#datepickerStartDatePR')[0].value).split("/");
		if(aux[0]<10){var aa1 = "0"+aux[0];}else{var aa1 = aux[0];}
		dateConditionAux="Received_Date='"+aux[2]+"/"+aux[1]+"/"+aux[0]+"'";
	}
	else{
		dateCondition="Received_Date='"+$('#datepickerStartDatePR')[0].value+"'";
		
		var aux = ($('#datepickerStartDatePR')[0].value).split("/");
		if(aux[0]<10){var aa1 = "0"+aux[0];}else{var aa1 = aux[0];}
		dateConditionAux="Received_Date='"+aux[2]+"/"+aux[1]+"/"+aux[0]+"'";
		
		var date = new Date($( "#datepickerStartDatePR" )[0].value);
		for(i=0;i<2;i++){
			date.setDate(date.getDate()+1);
			if(date.getDate()<10){var aa = "0"+date.getDate();}else{var aa = date.getDate();}
			var a= aa + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();	 var aAux= date.getFullYear() + '/' + mlist[(date.getMonth())] + '/' + aa;
			dateCondition=dateCondition+" OR Received_Date='"+a+"'";
			dateConditionAux=dateConditionAux+" OR Received_Date='"+aAux+"'";
			if(a==$('#datepickerEndDatePR')[0].value){
				break;
			}
			else{
				i--;
			}
		}
	}
			
			
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/pubReport.php",	
		data:{sdate1:$('#datepickerStartDatePR')[0].value, edate1:$('#datepickerEndDatePR')[0].value,tname1:$("#selectTeamPR")[0][$("#selectTeamPR")[0].selectedIndex].innerText,dateCond:dateCondition,dCondAux:dateConditionAux},
		success:function(html){
			$("#tableValuesForPubReport").empty().hide();
			$("#tableValuesForPubReport").html("<br/>"+html);
			download_csv("tableValuesForPubReport","Pub_Report"); //export_table_to_csv($("#tableValuesForPubReport > table >tbody > tr"), "Pub_Report.csv");
			$("#loadersjmsSheet_Log").hide();
		}
	});
}

function exportToExcelOperatorSheetSR(){
	var dateSv = $('#datepickerStartDateL')[0].value.split("/");
	//var dateEv = $('#datepickerEndDateL')[0].value.split("/");
	$("#loadersjmsSheet_Log").show();
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/teamWiseSheet.php",	
		data:{sdate1:$('#datepickerStartDateSR')[0].value, edate1:'',tname1:$("#selectTeamSR")[0][$("#selectTeamSR")[0].selectedIndex].innerText},
		//data:{sdate1:$('#datepickerStartDateL')[0].value, edate1:$('#datepickerEndDateL')[0].value,tname1:$("#OperatorSelectCoreLT")[0][$("#OperatorSelectCoreLT")[0].selectedIndex].innerText},
		success:function(html){
			var c= html.split("BREAK");
			$("#tableValuesForShiftReport").empty();
			$("#tableValuesForShiftReport").html("<br/>"+c[1]);
			download_csv("tableValuesForShiftReport","JMS_ShiftReport"+$('#datepickerStartDateSR')[0].value); //export_table_to_csv($("#tableValuesForShiftReport > table >tbody > tr"), "JMS_ShiftReport.csv");
			$("#loadersjmsSheet_Log").hide();
		}
	});
	
}

function displayOpLogs(){
	var dateSv = $('#datepickerStartDateL')[0].value.split("/"); var dateSvWithoutSplit = $('#datepickerStartDateL')[0].value;
	//var dateEv = $('#datepickerEndDateL')[0].value.split("/");//dateSv[2]+"/"+dateSv[1]+"/"+dateSv[0]
	
	$.ajax({
		type:'POST',
		url:"<?php echo base_url();?>public/Reports/opWiseSheet.php",	
		//data:{sdate1:dateSv[2]+"/"+dateSv[1]+"/"+dateSv[0], edate1:dateEv[2]+"/"+dateEv[1]+"/"+dateEv[0],oname1:$("#OperatorSelectCoreL")[0][$("#OperatorSelectCoreL")[0].selectedIndex].innerText},
		data:{sdate1:dateSvWithoutSplit, edate1:'',oname1:$("#OperatorSelectCoreL")[0][$("#OperatorSelectCoreL")[0].selectedIndex].innerText},
		success:function(html){
			var htmlTable = html.split("//RECORD//");
			$("#tableValuesForExcelLOP").empty();
			$("#tableValuesForExcelLOP").html("<br/>"+htmlTable[1]);
			$("#tableValuesForExcelLOP").show();
		}
	});
}
function exportToExcelOperatorSheet2(){
//var htmltable= document.getElementById('tableValuesForExcelLOP');
//var html = htmltable.outerHTML;
//window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
download_csv('tableValuesForExcelLOP',$("#OperatorSelectCoreL")[0][$("#OperatorSelectCoreL")[0].selectedIndex].innerText+"_JMS_Report");
//export_table_to_csv($("#tableValuesForExcelLOP > table >tbody > tr"),$("#OperatorSelectCoreL")[0][$("#OperatorSelectCoreL")[0].selectedIndex].innerText+"_JMS_Report.csv");
}


</script>
		</section>
          </section>
</body>
</html>