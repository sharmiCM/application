
<?php include __DIR__ . "/../header.php";?>
<style>
body {
    background: #424b5d;
}
.centered2 {
  position: fixed;
  top: 50%;
  left: 50%;
  /* bring your own prefixes */
  transform: translate(-50%, -50%);
}
.ui-widget.ui-widget-content{
	width: 100%;
	cursor:pointer;
}
.ui-datepicker-calendar{
	line-height: 50px;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
	font-weight: 200;
	border-radius: 20px;
}

#tableForMail  {
    font-family: arial;
    border-collapse: collapse;
}

#tableForMail td {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
#wrapperr{
	background:url("img/template.png")
}
.ui-datepicker .ui-datepicker-header {
    background-color: white;
    border: 0px;
}
</style>
	  <section id="main-content">
          <section class="wrapper">
	<script src="https://smtpjs.com/v2/smtp.js"></script>	  
<h1 style="text-align:center; font-family:Futura,Trebuchet MS,Arial,sans-serif;color:white;"><b>Welcome</b></h1>
<div class="centered2" id="myrandomtext" style="text-align:center; font-family:courier; color:white;font-size:46px; display:none;"> Plant your garden and decorate your own soul, instead of waiting for someone to bring you flowers </div>

<table style="width:50%; line-height: 40;margin-left: 20%;margin-top: 5%;font-family: Futura,Trebuchet MS,Arial,sans-serif; box-shadow: 3px 4px grey; ">
<tr>
<td style="color: white; text-align:center; font-family: unset;background-color: grey;width: 60%;">
<h2 align='center' style=" height: 80px; line-height:0px; background: transparent;" id='daySelected'></h2>
<h1 style="font-size: 75px; line-height:0px;" id='dateSelected'>00</h1>
<h5 style="height: 25px; line-height:0px;    margin-top: 50px;" id='puncRea'>Reason: - </h5>
<h5 style="height: 25px; line-height:0px;" id='puncPer'></h5>
	<table align='center' style="background:transparent; line-height:30px;width: 98%; border-radius: 10px;" id="inoutCal">
	<tr><th style="border: 0px;"></th><th style="border: 0px;text-align: -webkit-center;">Intime</th><th style=";border: 0px;text-align: -webkit-center;">Outtime</th><th style="border: 0px;text-align: -webkit-center;">Hours</th></tr>
	<tr><th style="border: 0px;border-right: 1px solid white;">Scheduled</th><th id='shedI' style="border: 0px;border-right: 1px solid white;text-align: -webkit-center;">Intime</th><th id='shedO' style="border: 0px;border-right: 1px solid white;text-align: -webkit-center;">Outtime</th><th style="border: 0px;text-align: -webkit-center;">9.00</th></tr>
	<tr><th style="border: 0px;border-right: 1px solid white;">Actual</th><th id='actI' style="border: 0px;border-right: 1px solid white;text-align: -webkit-center;">Intime</th><th id='actO' style="border: 0px;border-right: 1px solid white;text-align: -webkit-center;">Outtime</th><th id='hrsPres' style="border: 0px;text-align: -webkit-center;">Hours</th></tr>
	<tr><td></td><td></td><td></td></tr>
	</table>
</td>
<td><div id="attendance" style=""></div></td>
</tr>
</table>


</br>
</br>
<div id="divForMail" style="display:none;"></div>
<?PHP	
	date_default_timezone_set('Asia/Calcutta');$elapseTime=0;
	$curDate=date('Y-m-d G:i:s');
	
	$dates = explode(":",explode(" ",date('Y-m-d G:i:s'))[1])[0];
	if((int)$dates>=5){
		$dateForQuery = date('d/m/Y');
	}
	else{
		$dateForQuery = date('d/m/Y', strtotime('-1 day'));
	}
	$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
	$this->load->library('session');
	$session_data = $this->session->userdata('EmployeeID').",".$this->session->userdata('fName')."".$this->session->userdata('lname').",".$this->session->userdata('user_level').",".$this->session->userdata('TeamName').",".$this->session->userdata('fName');
	
	
	$checkQue=mysqli_query($con,"select * from attendance where Date='".$dateForQuery."' and empId='".$_SESSION['EmployeeID']."'");
	$numberOfRows=mysqli_num_rows($checkQue);
	if($numberOfRows<1){
	
	/*check for late - starts*/
	//$emps =  $_SESSION['EmployeeID'];
	$lateVar='';
	$getshiftCode=mysqli_query($con,"SELECT Shiftcode,empid,Team FROM `roster_table` WHERE Date='".date('Y-m-d')."' AND empid='".$_SESSION['EmployeeID']."'")or die(mysqli_error($getshiftCode));
	while ($rb=mysqli_fetch_assoc($getshiftCode)){
		$getShiftTime=mysqli_query($con,"SELECT * FROM `roster` where ID='".$rb['Shiftcode']."'")or die(mysqli_error());
		while ($rc=mysqli_fetch_assoc($getShiftTime)){
			$intime = date('Y-m-d')." ".$rc['intime'];
			/*calc login time for late login check - starts*/
			$timestamp1 = strtotime($intime);
			$timestamp2 = strtotime($curDate);
			$usedHour = ($timestamp1 - $timestamp2);
			if(((int)$usedHour)<0){
				$lateVar=1;
			}
			else{
				$lateVar=0;
			}
		}
		
	}
	
	/*check for late - ends*/
	$sqlAttCP="INSERT INTO attendance(Name,Date,markinDate,empId,Late) VALUES ('".$_SESSION['name']."','".date('d/m/Y')."','".date('Y-m-d G:i:s')."','".$_SESSION['EmployeeID']."','".$lateVar."')";
	$ressqlAttCP = mysqli_query($con,$sqlAttCP);
	}
	
	?>
<script>

$(document).ready(function(){
	
	document.cookie = "valss=; expires = Thu, 01 Jan 1970 00:00:00 UTC";
	document.cookie="valss= <?php echo $session_data; ?>";
	$( "#attendance" ).datepicker({
		inline: true,
		dayNamesMin: [ "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat" ],
		showWeek: true,
		onChangeMonthYear: function( year, month, inst ){
			var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			for(var ie=0;ie<mlist.length;ie++){
				if(ie==month){
					if(ie<10){
						monthCurr=(ie<10)?'0'+(ie):(ie);
					}
					else{
						monthCurr=(ie<10)?(ie):(ie);
					}
				}
			}
			var s = setInterval(function() {
				displayAttendance(monthCurr,yearCurr);
				$(".ui-datepicker-calendar >thead > tr >th >span").css("color", "black");
				$(".ui-datepicker-month").css("color", "black");$(".ui-datepicker-year").css("color", "black");
				clearInterval(s);
			},500);			
		}
	});
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
	$(".ui-datepicker-calendar >thead > tr >th >span").css("color", "black");
	$(".ui-datepicker-month").css("color", "black");$(".ui-datepicker-year").css("color", "black");
});
var orderDate=[];var ordDat=0;var tableCal;
dateSelectedVal="<?php echo date("d/m/Y")?>";
var daySelectedVal="<?php echo date("l",strtotime(date("Y-m-d")))?>";
function displayAttendance(monthCurr,yearCurr){
	var inf = ((document.cookie).split("=")[1]).split(",");
	
	tableCal = $(".ui-datepicker-calendar")[0].children[1].children;	$(".ui-datepicker-calendar")[0].style.Minwidth="770px";	$(".ui-datepicker-calendar")[0].style.Maxwidth="900px";
	for(var i=0;i<tableCal.length;i++){//for table row
		var tdCal = tableCal[i].children;
		for(var j=0;j<tdCal.length;j++){
			if(tdCal[j].className != " ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled" && tdCal[j].className!="ui-datepicker-week-col"){
				tdCal[j].style.columnWidth="40px";
				var dateCur = (Number(tdCal[j].innerText)<10)? "0"+Number(tdCal[j].innerText) : Number(tdCal[j].innerText);
			var data = dateCur+"/"+monthCurr+"/"+yearCurr;
			$.ajax({
				type:'POST',
				url:"<?php echo base_url();?>public/HomeScreen/attendancePM.php",	
				data:{date:"",empId:inf[0],name:inf[1],check:1,calDate:data,trow:i,tdata:j},
				success:function(html){
					var date = html.split("_")[1];
					var hip = html.split("*"); var und = (hip[1]).split("_");
					var late = (html.split("*")[0]).replace("		","");
								
					var cc = tableCal[und[3]].children[und[4]];
					cc.childNodes[0].style.backgroundColor='#f6f6f6';cc.style.backgroundColor='#f6f6f6'; 
					cc.childNodes[0].style.textAlign= "-webkit-center";						
					if(ordDat==0){
						orderDate[Number(und[0])] = "";
						orderDate[Number(und[1])] = late;
						if(late=='0'){
							var cc = tableCal[und[3]].children[und[4]]; //punctual
						}
						else{
							var cc = tableCal[und[3]].children[und[4]];
							if(late==''){
								cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center;border: 0px;'>"+und[1]+"</a>";//late								//background:gainsboro;
							}
							else{
								cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center; color:red;'>"+und[1]+"</a>";//+"  Late:"+und[5].split(" ")[1]+"</a>";//late
							}
						}
					}
					else{
						orderDate[Number(und[1])] = late;
						if(late=='0'){
							var cc = tableCal[und[3]].children[und[4]]; //punctual
						}
						else{
							var cc = tableCal[und[3]].children[und[4]];
							if(late==''){
									cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center;border: 0px;'>"+und[1]+"</a>";//late//background:gainsboro;
								}
							else{
								cc.innerHTML="<a class='ui-state-default' style='text-align: -webkit-center;color:red;'>"+und[1]+"</a>"//+"  Late:"+und[5].split(" ")[1]+"</a>";//late
							}
						}
					}
					if(und[6]=='1'){
						cc.childNodes[0].style.backgroundColor="lightgray"; 
						cc.childNodes[0].style.width="30px";
						cc.childNodes[0].style.height="30px";
						cc.childNodes[0].style.borderRadius="250px";
						cc.childNodes[0].style.padding="1px";
						cc.childNodes[0].style.marginTop="2px";
						cc.childNodes[0].style.lineHeight="26px";
						cc.childNodes[0].style.marginLeft ="10px";
					}
					else{
						if(late==''){
						}
						else{
							cc.childNodes[0].style.backgroundColor="#f6f6f6";	
							cc.childNodes[0].style.border='0px';
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
					if(dateSelectedVal==und[2]){
						$("#shedI")[0].innerHTML= und[8];
						$("#shedO")[0].innerHTML= und[9];
						$("#actI")[0].innerHTML= (und[5]=="")?"-":(und[5]);//.split(" ")[1];
						$("#actO")[0].innerHTML= (und[10]=="")?"-":(und[10]);//.split(" ")[1];
						$("#hrsPres")[0].innerHTML= (und[11]=="")?"-":und[11];
						$("#inoutCal").show();daySelectedVal=und[12];
						$("#daySelected")[0].innerHTML = daySelectedVal.toUpperCase();
						$("#dateSelected")[0].innerHTML = und[1];
						$("#puncRea")[0].innerHTML = "Reason:- "+und[13];
						
						dateSelectedVal="";
					}
					if(ordDat==Number(und[0])){
						$("#puncPer").html("Punctuality Percentage:&nbsp;&nbsp;"+(((totalDays-totalLateDays)*100)/totalDays).toFixed(0)+"%");totalDays=0;totalLateDays=0;ordDat=0;
						$("#attendance > div >table >tbody >tr >td").click(function(res,val) {
							monthCurr= $(".ui-datepicker-month")[0].innerText; yearCurr= $(".ui-datepicker-year")[0].innerText;
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
							if(res.target.className!="ui-datepicker-week-col"){
								if(isNaN(res.target.innerHTML)){
									var val = (res.target.innerHTML).split(" ")[0];
									dateSelectedVal= val+"/"+monthCurr+"/"+yearCurr;
								}
								else{
									dateSelectedVal= res.target.innerHTML+"/"+monthCurr+"/"+yearCurr;
								}
								displayAttendance(monthCurr,yearCurr);
	$(".ui-datepicker-calendar >thead > tr >th >span").css("color", "black");
	$(".ui-datepicker-month").css("color", "black");$(".ui-datepicker-year").css("color", "black");
							}
						});
					}
				}
			});
			}
		}
	}	
}


var totalDays =0;var totalLateDays =0; var dateSelectedVal;
</script>

          </section>
          </section>
</body>
</html>
