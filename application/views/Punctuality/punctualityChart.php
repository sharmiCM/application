<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
?>

<style>

.ui-widget.ui-widget-content{
	width: 60%;
	cursor:pointer;
}
.ui-datepicker-calendar{
	line-height: 60px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
	font-weight: 200;
}
</style>

<section id="main-content">
		<section class="wrapper">
		<input type="hidden" class="base" value="<?php echo base_url(); ?>">
		<div id="loaders" style="position: fixed; z-index: 1;padding-top: 400px;padding-left: 900px;left: 0;top: 0;width: 100%;height: 100%; overflow: auto;background-color: rgb(0,0,0);background-color: rgba(0,0,0,0.4); display:none;"><img id = "loading" src = "<?php echo base_url();?>img/load5.gif" alt = "Loading indicator" style="width:60px;" ></div>
		
		<div id="centreTextCal" style="">
		<table style="width: 100%;margin-top: 100px;">
                <tr>
                    <td style="border: 1px solid lightgray;text-align: center; background-color: #6699cc; color: white;height:30px; width:20%;">View Calendar:&nbsp&nbsp</td>
                    <td style="border: 1px solid lightgray;    text-align: center; width:20%;">
						Select Team: <select id="selTeam" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"  onchange="dispOpeName(this)"></select>
					</td>
					<td style="border: 1px solid lightgray;text-align:center; width:20%;">
						Select Team: <select id="selOperator" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;"></select>
					</td>
					<td style="border: 1px solid lightgray; width:40%; text-align:center;">
						<input id="applyCal" type="button" value="View" onclick="displayOpCal();"/>
					</td>
                </tr>
		</table><br/>
		
		<div id="attDiv"></div></br>
<div id="legendsCalendar" style="display:none; background: floralwhite;height: 25px;margin: 0 auto;width: 25%; line-height: 25px;padding-left: 15px;text-align: -webkit-center;"><table><tr><td> <div style='border:1px solid lightgrey;background:darkgrey;width: 30px;height: 17px;'></div></td><td style='color:black;font-weight: bold;'> &nbsp Not logged in </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><div style='border:1px solid lightgrey;background:khaki;width: 30px;height: 17px;'></div></td><td style='color:black;font-weight: bold;'> &nbsp Week-Off</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td><div style='border:1px solid lightgrey;background:lightgrey;width: 30px;height: 17px;'></div></td><td style='color:black;font-weight: bold;'> &nbsp On Time</td></tr></table></div>
		<div style="display:none; background: floralwhite;height: 25px;margin: 0 auto;width: 25%; line-height: 25px;padding-left: 15px;text-align: -webkit-center;color:black;" id='puncPerc'></div>
		
		<table style="margin-top: 100px;">
		<tr>
		<td style="border:1px solid lightgray;width: 20%;text-align:center;">
			Select Month: <select id="months" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;" disabled>			
			<option value="January">January</option>
			<option value="February">February</option>
			<option value="March">March</option>
			<option value="April">April</option>
			<option value="May">May</option>
			<option value="June">June</option>
			<option value="July">July</option>
			<option value="August">August</option>
			<option value="September"  selected="selected">September</option>
			<option value="October">October</option>
			<option value="November">November</option>
			<option value="December">December</option>			
			</select>
		</td>
		<td style="border:1px solid lightgray;text-align:center;"><input id='invFol' type="radio" name="tcInv" value="folder" checked>Folder &nbsp; &nbsp; <input id='invDoc' type="radio" name="tcInv" value="docket">Docket Number</td>
		<td style="border:1px solid lightgray;text-align:center;"><input id='invWeek' type="radio" name="tcWeekMon" value="Weekly" checked>Weekly &nbsp; &nbsp; <input id='invMon' type="radio" name="tcWeekMon" value="Monthly">Monthly</td>
		
		<td style="border:1px solid lightgray;text-align:center;">
			<select id="weeks" style="margin-top: 7px;height: 30px;width: 170px;border-radius: 5px;background-color: #357ebd;color: white;">
			<option value="Week1">01 to 07</option>
			<option value="Week2">08 to 15</option>
			<option value="Week3">16 to 22</option>
			<option value="Week4">23 to 31</option>
			</select>
			<label id="mons" style="display:none;width: 170px;"> Entire month Selected</label>
		</td>
		
		<td style="border:1px solid lightgray;width: 15%;text-align:center;">
			<input id="getGdonInfo" type="button" value="Get Info" onclick="datagDocs();"/>
		</td>
		</table>
		
		<div id="excelCont" style="display:none;"></div>
		
		</div>
		<?PHP
		$ree=mysqli_query($con,"SELECT * FROM `team` WHERE TeamID!=0 ORDER BY TEAM ASC")or die(mysqli_error());// AND Received_Time>'".$t1."'
			$norie = mysqli_num_rows($ree);  $optionTeams="";
				$optionTeams = $optionTeams."<option value='Select Team'>Select Team</option>";
			while ($rowe=mysqli_fetch_assoc($ree)){
				if($rowe['TEAM']!= 'Break' && $rowe['TEAM']!= 'Waiting for job' && $rowe['TEAM']!= 'Permission' && $rowe['TEAM']!= 'Break' ){
					$optionTeams = $optionTeams."<option value=".$rowe['TeamID'].">".$rowe['TEAM']."</option>";
				}
			}
		?>
		
		<script type="text/javascript">
		var folder=1;
		$(document).ready(function(){
			var attend=$("#selTeam").append("<?PHP echo $optionTeams?>");
			
			$("input[name=tcInv]").change(function (re) {
				if (re.target.parentElement.children[0].checked == true) {
					folder=1;
				}
				else{
					folder=0;
				}
			});
			
			$("input[name=tcWeekMon]").change(function (re) {
				if (re.target.parentElement.children[0].checked == true) {
					$("#weeks").show();
					$("#mons").hide();
				}
				else {
					$("#weeks").hide();
					$("#mons").show();
				}
			});
		});
		
		
		function datagDocs() {
			$("#loaders").show();
			var weekVar = $("#weeks")[0];
			
			if(weekVar.style.display=='none'){
				weekVar=0;
			}
			else{
				weekVar = weekVar[weekVar.selectedIndex].innerText;
				weekVar = weekVar.split(" to ").join(" ");
			}
			
			var monthVar = $("#mons")[0];
			if(monthVar.style.display=='none'){
				monthVar=0;
			}
			else{
				monthVar=1;
			}
var selIndex= $("#months")[0];		var month;	
			var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			for(var ie=0;ie<mlist.length;ie++){
				if(selIndex[selIndex.selectedIndex].innerHTML==mlist[ie]){
					if((ie+1)<10){
						month = "0"+(ie+1);
					}
					else{
						month = (ie+1);
					}
					break;
				}
			}
			
			var url="https://docs.google.com/spreadsheets/d/e/2PACX-1vRfqqf7sSu97Ran-w4K8ueQEAZ5itTNZBwoY6ky1LUbt7ULjc2cXl3Ao4JKCoNluuTZMZVyjgMQIxQo/pub?gid=956720805&single=true&output=csv";
			$.ajax({
				type:'POST',
				url:'connectgDoc.php',	
				data:{url:url,con:2,weekVar:weekVar,monthVar:monthVar,folder:folder,month:month},
				success:function(html){
					firstTma=0;
					$("#excelCont").html("");
					//var d =html.split("____");
					var c =html.split("$");
					//alert(new Date() +"");
					deleteDuplicatesfromAray(c,folder);
					$("#loaders").hide();
					//alert(new Date() +"");
				}
			});
		}
		var firstTma=0;
	function deleteDuplicatesfromAray(arr,folder){	
	
		var v= (arr[arr.length-2]).split(",");
		var w= (arr[arr.length-1]).split(",");
		
		//var arr = [9, 2, 111, 111, 2, 9, 9, 9, 4, 4, 6, 6, 4];
		var sums=0;
		var sumArray=[];
		var found=0; var level4Hrs=0;
		var splitups="";  var table="<table id='tableOnFly' style=' border: 1px solid black;'><tr style='text-align:center;font-weight: 900;font-size: 18px;'><td>Code</td><td>Batch</td><td>Level 1</td><td>Level 2</td><td>Level 3</td><td>Level 4</td><td>TOTAL</td><td>Time Taken For Level 4 Jobs</td> </tr>";

		for (var i = 0; i < arr.length-3; i++) {
			var sumElement=0; var level1=0; var level2=0; var level3=0; var level4=0;
			for (var j = i+1; j < arr.length-3; j++) {
				var interArrI = arr[i].split("**");		var interArrJ = arr[j].split("**");
				if(folder==1){
					iVar =interArrI[4]; jVar = interArrJ[4];
				}
				else{
					iVar =interArrI[5]; jVar = interArrJ[5];
				}
				
				if(interArrI[3]=='PHS'){
					if(interArrI[4]=='+PHS_F46_174411_LSN+'){
						var c = interArrI[3];
					}
				}
				
				
			  if (iVar == jVar) {				
				  if((splitups.split(iVar)).length<2){
					sumElement = sumElement + Number(interArrI[7])+Number(interArrJ[7]);
					
					level4Hrs = level4Hrs + Number(interArrI[12])+Number(interArrJ[12]);
					
					splitups = splitups+"__"+iVar;
					found=1;
					
					
				if (interArrJ[10] == "Complex Level 1") {
					level1+= Number(interArrJ[7])+Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 2") {
					level2+= Number(interArrJ[7])+Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 3") {
					level3+= Number(interArrJ[7])+Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 4") {
					level4+= Number(interArrJ[7])+Number(interArrJ[7]);
				}
				
				  }
				  else{
				  sumElement = sumElement + Number(interArrJ[7]);
				  
				  level4Hrs = level4Hrs + Number(interArrJ[12]);
				  
				if (interArrJ[10] == "Complex Level 1") {
					level1+= Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 2") {
					level2+= Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 3") {
					level3+= Number(interArrJ[7]);
				}
				if (interArrJ[10] == "Complex Level 4") {
					level4+= Number(interArrJ[7]);
				}
				  
				  }
			  }
			}
			
			if(interArrI[7]){
			if(found==0){
				if (interArrI[10] == "Complex Level 1") {
					level1++;
				}
				if (interArrI[10] == "Complex Level 2") {level2++;}if (interArrI[10] == "Complex Level 3") {level3++;}
				if (interArrI[10] == "Complex Level 4") {
					level4++;
				}
			if((splitups.split(iVar)).length<2){
				iVar= (iVar).replace("+","");	iVar= (iVar).replace("+","");
				
				sumArray.push(iVar);
				if(interArrI[3]=='TMA'){
					if(firstTma==0){
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr style='text-align:center;font-weight: 900;font-size: 18px;'><td>Code</td><td>Batch</td><td>Level 1</td><td>Level 2</td><td>Level 3</td><td>Level 4</td><td>TOTAL</td><td>Time Taken for Level 4 Jobs</td></tr>";
						firstTma++;
					}
				}
				table=table+"<tr style='font-size: 16px;'><td style=' border:1px solid grey;text-align:center;'>"+interArrI[3]+"</td><td style='width:500px; border:1px solid grey;'>"+iVar+"</td><td style='text-align:center; border:1px solid grey;'>"+level1+"</td><td style='text-align:center; border:1px solid grey; '>"+level2+"</td><td style='text-align:center; border:1px solid grey;'>"+level3+"</td><td style='text-align:center; border:1px solid grey; '>"+level4+"</td><td style=' border:1px solid grey;text-align:center;'>"+interArrI[7]+"</td><td>"+interArrI[12]+"</td></tr>";
			}
			}
			else{
				
				iVar= (iVar).replace("+","");	iVar= (iVar).replace("+","");
				sumArray.push(sumElement);
				
				if(interArrI[3]=='TMA'){
					if(firstTma==0){
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
						table=table+"<tr style='text-align:center;font-weight: 900;font-size: 18px;'><td>Code</td><td>Batch</td><td>Level 1</td><td>Level 2</td><td>Level 3</td><td>Level 4</td><td>TOTAL</td><td>Time Taken for Level 4 Jobs</td></tr>";
						firstTma++;
					}
				}
				table=table+"<tr style='font-size: 16px;'><td style=' border:1px solid grey;text-align:center;'>"+interArrI[3]+"</td><td style='width:500px; border:1px solid grey;'>"+iVar+"</td><td style='text-align:center; border:1px solid grey;'>"+level1+"</td><td style='text-align:center; border:1px solid grey;'>"+level2+"</td><td style='text-align:center; border:1px solid grey;'>"+level3+"</td><td style='text-align:center; border:1px solid grey;'>"+level4+"</td><td style=' border:1px solid grey;text-align:center;'>"+sumElement+"</td><td>"+level4Hrs+"</td> </tr>";
				arr.splice(i, 1);
				i=i-1;
				found=0;
			}
			level4Hrs=0;
		}
		}
		table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		
		/*display code wise counts*/
		table=table+"<tr style=' border:1px solid grey;text-align:center;font-weight: 900;'><td style=' border:1px solid grey;text-align:center;'>Code</td><td style=' border:1px solid grey;text-align:center;'>Level 1</td><td style=' border:1px solid grey;text-align:center;'>Level 2</td><td  style=' border:1px solid grey;text-align:center;'>Level 3</td><td style=' border:1px solid grey;text-align:center;'>Level 4</td><td style=' border:1px solid grey;text-align:center;'>TOTAL</td><td></td><td> Time Taken for Level 4 Jobs</td></tr>";
		if(v[0]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>CTC</td><td>"+w[0]+"</td><td>"+w[1]+"</td><td>"+w[2]+"</td><td>"+w[3]+"</td><td>"+v[0]+"</td><td></td><td></td></tr>";}
		if(v[1]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>CTC_Retouch</td><td>"+w[4]+"</td><td>"+w[5]+"</td><td>"+w[6]+"</td><td>"+w[7]+"</td><td>"+v[1]+"</td><td></td><td></td></tr>";}
		if(v[2]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>FGL</td><td>"+w[8]+"</td><td>"+w[9]+"</td><td>"+w[10]+"</td><td>"+w[11]+"</td><td>"+v[2]+"</td><td></td><td></td></tr>";}
		if(v[3]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>LCL</td><td>"+w[12]+"</td><td>"+w[13]+"</td><td>"+w[14]+"</td><td>"+w[15]+"</td><td>"+v[3]+"</td><td></td><td></td></tr>";}
		if(v[4]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>Loblaws_Retouch</td><td>"+w[16]+"</td><td>"+w[17]+"</td><td>"+w[18]+"</td><td>"+w[19]+"</td><td>"+v[4]+"</td><td></td><td></td></tr>";}
		if(v[5]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>PSH</td><td>"+w[20]+"</td><td>"+w[21]+"</td><td>"+w[22]+"</td><td>"+w[23]+"</td><td>"+v[5]+"</td><td></td><td></td></tr>";}
		if(v[6]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>LOW</td><td>"+w[24]+"</td><td>"+w[25]+"</td><td>"+w[26]+"</td><td>"+w[27]+"</td><td>"+v[6]+"</td><td></td><td></td></tr>";}
		if(v[7]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>MMM</td><td>"+w[28]+"</td><td>"+w[29]+"</td><td>"+w[30]+"</td><td>"+w[31]+"</td><td>"+v[7]+"</td><td></td><td></td></tr>";}
		if(v[8]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>PAR</td><td>"+w[32]+"</td><td>"+w[33]+"</td><td>"+w[34]+"</td><td>"+w[35]+"</td><td>"+v[8]+"</td><td></td><td></td></tr>";}
		if(v[9]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>PHS</td><td>"+w[36]+"</td><td>"+w[37]+"</td><td>"+w[38]+"</td><td>"+w[39]+"</td><td>"+v[9]+"</td><td></td><td></td></tr>";}
		if(v[10]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>REX</td><td>"+w[40]+"</td><td>"+w[41]+"</td><td>"+w[42]+"</td><td>"+w[43]+"</td><td>"+v[10]+"</td><td></td><td></td></tr>";}
		if(v[11]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SDM</td><td>"+w[44]+"</td><td>"+w[45]+"</td><td>"+w[46]+"</td><td>"+w[47]+"</td><td>"+v[11]+"</td><td></td><td></td></tr>";}
		if(v[12]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SOB</td><td>"+w[48]+"</td><td>"+w[49]+"</td><td>"+w[50]+"</td><td>"+w[51]+"</td><td>"+v[12]+"</td><td></td><td></td></tr>";}
		if(v[13]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>THD</td><td>"+w[52]+"</td><td>"+w[53]+"</td><td>"+w[54]+"</td><td>"+w[55]+"</td><td>"+v[13]+"</td><td></td><td></td></tr>";}
		if(v[14]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>TOY</td><td>"+w[56]+"</td><td>"+w[57]+"</td><td>"+w[58]+"</td><td>"+w[59]+"</td><td>"+v[14]+"</td><td></td><td></td></tr>";}
		
		if(v[15]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>DTR</td><td>"+w[60]+"</td><td>"+w[61]+"</td><td>"+w[62]+"</td><td>"+w[63]+"</td><td>"+v[15]+"</td><td></td><td></td></tr>";}
		if(v[16]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>GAN</td><td>"+w[64]+"</td><td>"+w[65]+"</td><td>"+w[66]+"</td><td>"+w[67]+"</td><td>"+v[16]+"</td><td></td><td></td></tr>";}
		if(v[17]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>GTI</td><td>"+w[68]+"</td><td>"+w[69]+"</td><td>"+w[70]+"</td><td>"+w[71]+"</td><td>"+v[17]+"</td><td></td><td></td></tr>";}
		if(v[18]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>GTY</td><td>"+w[72]+"</td><td>"+w[73]+"</td><td>"+w[74]+"</td><td>"+w[75]+"</td><td>"+v[18]+"</td><td></td><td></td></tr>";}
		if(v[19]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>HEN</td><td>"+w[76]+"</td><td>"+w[77]+"</td><td>"+w[78]+"</td><td>"+w[79]+"</td><td>"+v[19]+"</td><td></td><td></td></tr>";}
		if(v[20]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>HOO</td><td>"+w[80]+"</td><td>"+w[81]+"</td><td>"+w[82]+"</td><td>"+w[83]+"</td><td>"+v[20]+"</td><td></td><td></td></tr>";}
		if(v[21]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>KAR</td><td>"+w[84]+"</td><td>"+w[85]+"</td><td>"+w[86]+"</td><td>"+w[87]+"</td><td>"+v[21]+"</td><td></td><td></td></tr>";}
		if(v[22]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>KAT</td><td>"+w[88]+"</td><td>"+w[89]+"</td><td>"+w[90]+"</td><td>"+w[91]+"</td><td>"+v[22]+"</td><td></td><td></td></tr>";}
		if(v[23]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>MAS</td><td>"+w[92]+"</td><td>"+w[93]+"</td><td>"+w[94]+"</td><td>"+w[95]+"</td><td>"+v[23]+"</td><td></td><td></td></tr>";}
		if(v[24]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SCO</td><td>"+w[96]+"</td><td>"+w[97]+"</td><td>"+w[98]+"</td><td>"+w[99]+"</td><td>"+v[24]+"</td><td></td><td></td></tr>";}
		if(v[25]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SEA</td><td>"+w[100]+"</td><td>"+w[101]+"</td><td>"+w[102]+"</td><td>"+w[103]+"</td><td>"+v[25]+"</td><td></td><td></td></tr>";}
		if(v[26]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SHO</td><td>"+w[104]+"</td><td>"+w[105]+"</td><td>"+w[106]+"</td><td>"+w[107]+"</td><td>"+v[26]+"</td><td></td><td></td></tr>";}
		if(v[27]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SOU</td><td>"+w[108]+"</td><td>"+w[109]+"</td><td>"+w[110]+"</td><td>"+w[111]+"</td><td>"+v[27]+"</td><td></td><td></td></tr>";}
		if(v[28]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>STA</td><td>"+w[112]+"</td><td>"+w[113]+"</td><td>"+w[114]+"</td><td>"+w[115]+"</td><td>"+v[28]+"</td><td></td><td></td></tr>";}
		if(v[29]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>SWA</td><td>"+w[116]+"</td><td>"+w[117]+"</td><td>"+w[118]+"</td><td>"+w[119]+"</td><td>"+v[29]+"</td><td></td><td></td></tr>";}
		if(v[30]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>TBS</td><td>"+w[120]+"</td><td>"+w[121]+"</td><td>"+w[122]+"</td><td>"+w[123]+"</td><td>"+v[30]+"</td><td></td><td></td></tr>";}
		if(v[31]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>TOT</td><td>"+w[124]+"</td><td>"+w[125]+"</td><td>"+w[126]+"</td><td>"+w[127]+"</td><td>"+v[31]+"</td><td></td><td></td></tr>";}
		if(v[32]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>TSC</td><td>"+w[128]+"</td><td>"+w[129]+"</td><td>"+w[130]+"</td><td>"+w[131]+"</td><td>"+v[32]+"</td><td></td><td></td></tr>";}
		if(v[33]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>WEE</td><td>"+w[132]+"</td><td>"+w[133]+"</td><td>"+w[134]+"</td><td>"+w[135]+"</td><td>"+v[33]+"</td><td></td><td></td></tr>";}
		if(v[34]!="0"){table=table+"<tr style=' border:1px solid grey;text-align:center;'><td>WGT</td><td>"+w[136]+"</td><td>"+w[137]+"</td><td>"+w[138]+"</td><td>"+w[139]+"</td><td>"+v[34]+"</td><td></td><td></td></tr>";}
		
		table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		table=table+"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		table=table+"<tr style=' border:1px solid grey;text-align:center;font-weight: 900;'><td>Montreal</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
		table=table+"<tr style='font-weight: 900;'><td>Code</td><td>Level 1</td><td>Level 2</td><td>Level 3</td><td>Level 4</td><td>TOTAL</td><td></td><td></td></tr>";
		if(v[35]!="0"){table=table+"<tr><td>TMA</td><td>"+w[140]+"</td><td>"+w[141]+"</td><td>"+w[142]+"</td><td>"+w[143]+"</td><td>"+v[35]+"</td><td></td><td></td></tr>";}
		/*table=table+"<tr style='font-weight: 900;'><td>TOTAL</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";*/
		
		/*display code wise counts*/
		table=table+"</table>";
		document.getElementById("excelCont").innerHTML = table;
		download_csv("tableOnFly","TC_Invoice");
	}
		
		
		
		function dispOpeName(ref){
			$.ajax({
				type:'POST',
				url:$('.base').val()+"public/Reports/getOpList.php",
				data:{team:ref[ref.selectedIndex].label},
				success:function(html){
					$("#selOperator").html("");
					$("#selOperator").append(html);
				}
			});
		}
		function displayOpCal(){
			if($("#selOperator")[0].value!="" && $("#selOperator")[0].value!="Select Team"){
				$("#attDiv").html("<div class='attendanceOp' style='text-align: -webkit-center;'></div>");
				$( ".attendanceOp" ).datepicker({
					inline: true,
					maxDate: "+0M",
					dayNamesMin: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
					showWeek: true,
					onSelect: function(ret) {
						var c= html;
					},
					onChangeMonthYear: function( year, month, inst ){
						var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
						for(var ie=0;ie<mlist.length;ie++){
							if(ie==month){
								monthCurr=(ie<10)?'0'+(ie):(ie);
								/*
								if((ie+1)<10){
									monthCurr=(ie<10)?'0'+(ie+1):(ie+1);
								}
								else{
									monthCurr=(ie<10)?(ie+1):(ie+1);
								}
								*/
							}
						}
						var s = setInterval(function() {
							displayAttendance(monthCurr,yearCurr);
							clearInterval(s);
						},500);
						
					}
				});
				$("#legendsCalendar").show();
				$("#puncPerc").show();
				var monthCurr= $(".ui-datepicker-month")[0].innerText; var yearCurr= $(".ui-datepicker-year")[0].innerText;
				var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
				for(var ie=0;ie<mlist.length;ie++){
					if(mlist[ie]==monthCurr){
						if((ie+1)<10){
							monthCurr=(ie<10)?'0'+(ie+1):(ie+1);
						}
						else{
							monthCurr=(ie<10)?(ie+1):(ie+1);
						}
					}
				}
				
				displayAttendance(monthCurr,yearCurr);
			}
			else{
				alert("Please select the required options.");
			}
		}

function displayAttendance(monthCurr,yearCurr){
		
	tableCal = $(".ui-datepicker-calendar")[0].children[1].children;
	for(var i=0;i<tableCal.length;i++){//for table row
		var tdCal = tableCal[i].children;
		for(var j=0;j<tdCal.length;j++){
			if(tdCal[j].className != " ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!="ui-datepicker-week-col"){
				tdCal[j].style.columnWidth="140px";
				var dateCur = (Number(tdCal[j].innerText)<10)? "0"+Number(tdCal[j].innerText) : Number(tdCal[j].innerText);
			var data = dateCur+"/"+monthCurr+"/"+yearCurr;
			$.ajax({
				type:'POST',
				url:$('.base').val()+"public/HomeScreen/attendancePM.php",	
				data:{date:"",empId:$("#selOperator")[0].value,name:"",check:1,calDate:data,trow:i,tdata:j},
				success:function(html){
					var date = html.split("_")[1];
					var hip = html.split("*"); var und = (hip[1]).split("_");
					var late = (html.split("*")[0]).replace("		","");
					
					var cc = tableCal[und[3]].children[und[4]];
					cc.childNodes[0].style.backgroundColor='#f6f6f6';cc.style.backgroundColor='#f6f6f6'; 
					cc.childNodes[0].style.border='1px solid lightgrey';
					if(ordDat==0){
						orderDate[Number(und[0])] = "";
						orderDate[Number(und[1])] = late;
						if(late=='0'){
							cc = tableCal[und[3]].children[und[4]]; //punctual
						}
						else{
							 cc = tableCal[und[3]].children[und[4]];
							if(late==''){
								cc.innerHTML="<a class='ui-state-default' style='background:gainsboro;'>"+und[1]+"</a>";
							}
							else{
								cc.innerHTML="<a class='ui-state-default' style='color:red;'>"+und[1]+"  Late:"+und[5].split(" ")[1]+"</a>";//late
							}
						}
					}
					else{
						orderDate[Number(und[1])] = late;
						if(late=='0'){
							cc = tableCal[und[3]].children[und[4]]; //punctual
						}
						else{
							cc = tableCal[und[3]].children[und[4]];
							if(late==''){
								cc.innerHTML="<a class='ui-state-default' style='background:gainsboro;'>"+und[1]+"</a>";//late											
							}
							else{
								cc.innerHTML="<a class='ui-state-default' style='color:red;'>"+und[1]+"  Late:"+und[5].split(" ")[1]+"</a>";//late
							}
						}
					}
					if(und[6]=='1'){
						cc.childNodes[0].style.backgroundColor="khaki";
					}
					else{
						if(late==''){
							cc.childNodes[0].style.backgroundColor="gainsboro";
						}
						else{
							cc.childNodes[0].style.backgroundColor="#f6f6f6";	//cc.innerHTML="<a class='ui-state-default' style='background:khaki;'>"+und[1]+"</a>";
						}
					}
					ordDat++;
					
					var d = new Date();
					var currentMonth = d.getMonth()+1;
					d= (""+d).split(" ")[2];
					var reD = (und[2]).split("/");
					
					if(und[7]!='' && und[7]!="Week off" && currentMonth==Number(reD[1]) && late!=""){
						if(late!="1"){
							cc.childNodes[0].innerHTML = und[1]+"  ("+und[7]+")";
						}
						if(late=="0"){
						   cc.childNodes[0].innerHTML = und[1];
						}
					 }
	
					if(Number(currentMonth) == Number(reD[1])){
						if(Number(reD[0]) <= Number(d)){
							totalDays++;
							if(late=="1"){
								totalLateDays++;
							}
						}
					}
					else{
						totalDays++;//if(und[6]!="1"){totalDays++;}
						if(late=="1"){
							totalLateDays++;
						}
					}
					
					if(ordDat==Number(und[0])){
						$("#puncPerc").html("Punctuality Percentage:&nbsp;&nbsp;"+(((totalDays-totalLateDays)*100)/totalDays).toFixed(0)+"%");totalDays=0;totalLateDays=0;ordDat=0;
					}
				}
			});
			}
		}
	}
}
		var orderDate=[];var ordDat=0;var tableCal;var totalDays =0;var totalLateDays =0;
		</script>
		
		</section>
          </section>
<?PHP
include('footer.php');
?>
