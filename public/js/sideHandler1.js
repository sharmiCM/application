var siblin;
function displayPopuptoSelfAssign(events,ret){
	var lens = ret.nextElementSibling.nextElementSibling.nextElementSibling.children[0];
	fileName = ret.innerText;
	var sourceName;
	if(events.srcElement){sourceName=events.srcElement.localName;}
	else{sourceName=events.target.localName;}
	if(sourceName!='span'){
	for(var w =0;w<lens.length;w++){
		if(lens[w].checked==true){
			chkValues = true;
			break;
		}
		else{
			chkValues=false;
		}
	}
	if(chkValues==true){
		mulArgs ="single";
		modal = document.getElementById('myModaltoSelfAssign');
		siblin = ret.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling;
		modal.style.display = "block";
		retFileName = ret;
		//get the operator who are all logged in
		loggedInOperator();
	}
	else{
		alert("Please select the complexity of the file to assign.");
	}
	}
	else{
		//var copyText = $(events)[0].currentTarget.children[0];
  var para = $(events)[0].currentTarget.children[0];
//selectElementText(para)
var range = document.createRange(); // create new range object
    range.selectNodeContents(para); // set range to encompass desired element text
    var selection = window.getSelection(); // get Selection object from currently user selected text
    selection.removeAllRanges(); // unselect any user selected text (if any)
    selection.addRange(range);
	}
}
var incF=0;var incF1=0; var ns=0;
function multiJobAssign(){
	var totalJob = $("input[class='multiChkBodys']:checked");
		mulArgs ="multiple"; var complex=0;
		if(totalJob.length>0){
			var fileNmaeArr=[]; 
			var siblingArr=[];
			for(n=0;n<totalJob.length;n++){
				siblin = totalJob[n].parentElement.parentElement.children[7];
			 if(siblin.previousElementSibling.lastChild[0].checked==true){
				 complex++;
					 fileName = totalJob[n].parentElement.parentElement.children[3].innerText;
					 fileNmaeArr.push(fileName);	siblingArr.push("Simple");
			 }
			 if(siblin.previousElementSibling.lastChild[1].checked==true){
				 complex++;
					 fileName = totalJob[n].parentElement.parentElement.children[3].innerText;
					 fileNmaeArr.push(fileName);	siblingArr.push("Medium");
			 }
			 if(siblin.previousElementSibling.lastChild[2].checked==true){
				 complex++;
					 fileName = totalJob[n].parentElement.parentElement.children[3].innerText;
					 fileNmaeArr.push(fileName);	siblingArr.push("Complex");
			 }
			}
			if(complex==totalJob.length){
				for(n=0;n<totalJob.length;n++){
					var cmplxty;
					 if(siblin.previousElementSibling.lastChild[0].checked==true){
						 cmplxty="Simple";
					 }
					 if(siblin.previousElementSibling.lastChild[1].checked==true){
						 cmplxty="Medium";
					 }
					 if(siblin.previousElementSibling.lastChild[2].checked==true){
						 cmplxty="Complex";
					 }
					var dates = new Date();						var hours = dates.getHours();			var minutes = dates.getMinutes();					var ampm = hours >= 12 ? 'PM' : 'AM';
					hours = hours % 12;							hours = hours ? hours : 12;				var datess = dates.getDate() < 10 ? '0'+dates.getDate() : dates.getDate(); 					
					hours = hours < 10 ? '0'+hours : hours;		minutes = minutes < 10 ? '0'+minutes : minutes;		
					var strTime = dates.getFullYear() + '/' + mlist[dates.getMonth()] + '/' + datess + ' ' + hours + ':' + minutes + ':' + dates.getSeconds()+ ' ' + ampm;
					var mons1 = Number(dates.getMonth()+1);					var mons = mons1 < 10 ? mons1 : mons1;					var fName = datess+""+mons+""+dates.getFullYear();					var assignedYess=[];
					
					$.ajax({
						type:'POST',
						url:'vars3.php',	
						data:{File_Names:(fileNmaeArr[incF]).replace('\n','')},
						success:function(html){
							reachedFirst="no";
							html = html.split("/FREAK/");
							if(html[0]=="Assigned"){
								assignedYess.push("yes");
							}
							else{
								assignedYess.push("no");
							}
						},
						complete: function(html){
							if(assignedYess[incF1]=="no"){
								
									//var lpOrNot = sibli.parentElement.offsetParent.id;
									//var pubDate = sibli.parentElement.children[11].innerText;
									//if(lpOrNot=="jmsDispLowPrior"){
									//	lpOrNot="yes";
									//}
									//else{
										var lpOrNot="no";
									//}
									var pubDate = "";//sibli.parentElement.children[11].innerText;
								$.ajax({
									type:'POST',
									url:'vars.php',	
									data:{File_Name:(fileNmaeArr[incF1]).replace('\n',''),filHan:$(".centered")[2].innerText,curtime:strTime,singORMult:"single",complexity:siblingArr[incF1],folder:fName,lpOrNot:lpOrNot,pubDate:pubDate},
									success:function(html){
										var c = html;
										if(ns==totalJob.length-1){
										   alert("Your jobs are Assigned");
										   mulArgs=="single";
										   window.location.reload();
										}
										ns++;
									}
								});
								incF1++;
							}
							else{
								incF1++;
								alert("The job you are assigning is being assinged by an operator. Choose another job.");
							}
						}
					});					
					incF++;
				}
			}
			else{
				alert("Please select a complexity");
			}
		}
		else{
			alert("Please select a Job to Assign");
		}
}
var fileName;

function assignSelfHandle(cmplxty){
	/*var cmplxty;
	 if(siblin.previousElementSibling.lastChild[0].checked==true){
		 cmplxty="Simple";
	 }
	 if(siblin.previousElementSibling.lastChild[1].checked==true){
		 cmplxty="Medium";
	 }
	 if(siblin.previousElementSibling.lastChild[2].checked==true){
		 cmplxty="Complex";
	 }*/
	var dates = new Date();
	var hours = dates.getHours();
	var minutes = dates.getMinutes();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	var datess = dates.getDate() < 10 ? '0'+dates.getDate() : dates.getDate();
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = dates.getFullYear() + '/' + mlist[dates.getMonth()] + '/' + datess + ' ' + hours + ':' + minutes + ':' + dates.getSeconds()+ ' ' + ampm;
	var mons1 = Number(dates.getMonth()+1);
	var mons = mons1 < 10 ? mons1 : mons1;
	var fName = datess+""+mons+""+dates.getFullYear();
	var assignedYes;
	$.ajax({
		type:'POST',
		url:'vars3.php',	
		data:{File_Names:(fileName).replace('\n','')},
		success:function(html){
			reachedFirst="no";
			html = html.split("/FREAK/");
			if(html[0]=="Assigned"){
				assignedYes = "yes";
			}
			else{
				assignedYes="no";
			}
			
		},
		complete: function(html){
			if(assignedYes=="no"){
				
				//var lpOrNot = sibli.parentElement.offsetParent.id;
				//var pubDate = sibli.parentElement.children[11].innerText;
				//if(lpOrNot=="jmsDispLowPrior"){
					var lpOrNot="yes";
				//}
				//else{
				//	lpOrNot="no";
				//}
				var pubDate = "";//sibli.parentElement.children[11].innerText;
				$.ajax({
					type:'POST',
					url:'vars.php',	
					data:{File_Name:(fileName).replace('\n',''),filHan:$(".centered")[2].innerText,curtime:strTime,singORMult:"single",complexity:cmplxty,folder:fName,lpOrNot:lpOrNot,pubDate:pubDate},
					success:function(html){
						closeModals();
						//sample(html);
						if(mulArgs=='single'){
						   alert("Your job is Assigned");
						   mulArgs=="single";
						   window.location.reload();
						}
					}
				});
			}
			else{
				alert("The job you are assigning is being assinged by an operator. Choose another job.");
			}
		}
	});
}
function getfileForQA(){
	$.ajax({
		type:'POST',
		url:'getfilesForQA.php',	
		data:{date:$('#datepckrStrt').val()},
		success:function(html){
			var c= html;
			$("#divForQaTable").html(html);
		}
	});
}
function assignQAFiles(ret){
	var curTimes = getHMS();
	ret.parentElement.remove();
	$.ajax({
		type:'POST',
		url:'assignfilesForQA.php',	
		data:{assignedTime:curTimes,filename:ret.innerHTML,qcname:$(".centered")[2].innerText,forQC:'false'},
		success:function(html){
			var c= html;
			alert("Job Assigned for QA");
			//$("#divForQaTable").html(html);
		}
	});
}
function cleartableValuesForExcel(){
	$("#tableValuesForExcel").html("");
}
var mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
function getHMS(){
	var dates = new Date();
	var hours = dates.getHours();
	var minutes = dates.getMinutes();
	var ampm = hours >= 12 ? 'PM' : 'AM';
	hours = hours % 12;
	hours = hours ? hours : 12; // the hour '0' should be '12'
	var datess = dates.getDate() < 10 ? '0'+dates.getDate() : dates.getDate();
	hours = hours < 10 ? '0'+hours : hours;
	minutes = minutes < 10 ? '0'+minutes : minutes;
	var strTime = dates.getFullYear() + '/' + mlist[dates.getMonth()] + '/' + datess + ' ' + hours + ':' + minutes + ':' + dates.getSeconds()+ ' ' + ampm;
	return strTime;
}

function startAux(re){
	var t = $("#selectTeamName")[0];//.selectedIndex;
	var p = $("#selectPublisherName")[0];
	var m = $("#selectMagazineName")[0];
	if(m.selectedIndex>=1 && $("#folderName")[0].value!=""){
	var startime =getHMS();
	$.ajax({
		type:'POST',
		url:'auxTrack.php',
		data:{team:t[Number($("#selectTeamName")[0].selectedIndex)].label,publisher:p[Number($("#selectPublisherName")[0].selectedIndex)].label,magazine:m[Number($("#selectMagazineName")[0].selectedIndex)].label,OpName:$(".centered")[2].innerText,type:'',timeLabel:'start',fileName:$("#folderName")[0].value,startimes:startime,empID:$(".centered")[1].innerText},
		success:function(html){
		   var c = html;
		   $("#endAux")[0].disabled=false;		$("#pauseAux")[0].disabled=false; $("#pauseAux")[0].style.backgroundColor='deepskyblue';  
		   $("#startAux")[0].disabled=true;$("#startAux")[0].style.backgroundColor='grey';
		   alert("Job Started");
		}
	});
	}
	else{
		alert("Please enter all the values");
	}
}

function pauseAux(re){
	var t = $("#selectTeamName")[0];
	var p = $("#selectPublisherName")[0];
	var m = $("#selectMagazineName")[0];
	
	var pausetime =getHMS();
	$.ajax({
		type:'POST',
		url:'auxTrack.php',
		data:{team:t[Number($("#selectTeamName")[0].selectedIndex)].label,publisher:p[Number($("#selectPublisherName")[0].selectedIndex)].label,magazine:m[Number($("#selectMagazineName")[0].selectedIndex)].label,OpName:$(".centered")[2].innerText,type:'',timeLabel:'pause',fileName:$("#folderName")[0].value,pausetimes:pausetime,empID:$(".centered")[1].innerText},
		success:function(html){
		   var c = html;
		   $("#startAux")[0].disabled=true; 	$("#resumeAux")[0].disabled=false;  $("#resumeAux")[0].style.backgroundColor='indianred';
		   $("#pauseAux")[0].disabled=true;$("#pauseAux")[0].style.backgroundColor='grey';
		   $("#endAux")[0].disabled=true;
		   alert("Job Paused");
		}
	});
	
}

function resumeAux(re){
	var t = $("#selectTeamName")[0];
	var p = $("#selectPublisherName")[0];
	var m = $("#selectMagazineName")[0];
	
	var resumetime =getHMS();
	$.ajax({
		type:'POST',
		url:'auxTrack.php',
		data:{team:t[Number($("#selectTeamName")[0].selectedIndex)].label,publisher:p[Number($("#selectPublisherName")[0].selectedIndex)].label,magazine:m[Number($("#selectMagazineName")[0].selectedIndex)].label,OpName:$(".centered")[2].innerText,type:'',timeLabel:'resume',fileName:$("#folderName")[0].value,resumetimes:resumetime,empID:$(".centered")[1].innerText},
		success:function(html){
		   var c = html;
		   $("#resumeAux")[0].disabled=true; 	 $("#resumeAux")[0].style.backgroundColor='grey';	   $("#endAux")[0].disabled=false;
		   alert("Job Re-started");
		}
	});
}

function endAux(re){
	var sAux=$("#sAux")[0].value;
	var mAux=$("#mAux")[0].value;
	var cAux=$("#cAux")[0].value;
	if(sAux || mAux || cAux){
		if((Number(sAux) +Number(mAux)+Number(cAux))>0){
			var endtime =getHMS();
			$.ajax({
				type:'POST',
				url:'auxTrack.php',
				data:{timeLabel:'end',OpName:$(".centered")[2].innerText,fileName:$("#folderName")[0].value,endtimes:endtime,s:sAux,m:mAux,c:cAux},
				success:function(html){
				   var c = html;
				   $("#selectPublisherName")[0].disabled = false;$("#selectPublisherName").html("");
				   $("#selectMagazineName")[0].disabled = false;$("#selectMagazineName").html("");
				   $("#folderName")[0].disabled=false;
				   $("#folderName")[0].value='';
				   $("#selectTeamName")[0].disabled=false;
				   $("#selectTeamName")[0].selectedIndex=0;
				   $("#startAux")[0].disabled=false; $("#startAux")[0].style.backgroundColor='darkseagreen';
				   $("#endAux")[0].disabled=true;
				   $("#jobDescription")[0].value="";
				   $("#sAux")[0].value="";$("#mAux")[0].value="";$("#cAux")[0].value="";
				   alert("Job Ended");
				}
			});
		}
		else{
			alert("Please enter a valid count.");
		}
	}
	else{
		alert("No counts found. Minimum entry should be atleast 1.");
	}
}

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
    	return true;
    }
}
/*
function viewHideQueue(rets){
	if(rets.innerHTML=="VIEW JMS QUEUE"){
		rets.innerHTML="HIDE JMS QUEUE";
		$("#jmsDispForOpeDiv").show();
		
	}
	else{
		rets.innerHTML="VIEW JMS QUEUE"
		$("#jmsDispForOpeDiv").hide();
	}
}
*/

function dispPub(ret){
	var c = ret;
	$.ajax({
		type:'POST',
		url:'ajaxData.php',
		data:{'TeamID': ret[ret.selectedIndex].value },
		success:function(html){
		   $('#selectPublisherName').html(html); 
		}
	});
}
function dispMag(ret){
	var c = ret;
	$.ajax({
		type:'POST',
		url:'ajaxData.php',
		data:{'Publisher_id': ret[ret.selectedIndex].value },
		success:function(html){
		   $('#selectMagazineName').html(html); 
		}
	});
}
function closeModals() {
    modal = document.getElementById('myModaltoSelfAssign');
    modal.style.display = "none";
}
