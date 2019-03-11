$(document).ready(function(){
	//on click of radio button - core & aux
    $("input[name=optradio]").change(function (re) {
        if (re.target.parentElement.innerText == "Core") {
            $("#coreDiv")[0].style.display = "block";
            $("#auxDiv")[0].style.display = "none";
        }
        else {
            $("#coreDiv")[0].style.display = "none";
            $("#auxDiv")[0].style.display = "block";
        }
    });
	$("input[name=optradioqc]").change(function (re) {
        if (re.target.parentElement.innerText == "Core") {
            $("#coreDivQC")[0].style.display = "block";
            $("#auxDivQC")[0].style.display = "none";
        }
        else {
            $("#coreDivQC")[0].style.display = "none";
            $("#auxDivQC")[0].style.display = "block";
        }
    });
	//$("input[name=compradio]").change(function (re) {
                $("input[class=one]").each(function(){
                    this.checked = true;
                });
            //});
			//window.addEventListener('blur', function() {
  //document.title = 'not focused';
//});

	$( ".top-menu" ).click(function(res) {
		incremVar=0;
		if(res.target.innerHTML=="Request Approval"){
			$.ajax({
				type:'POST',
				url:'approveRequest.php',	
				data:{empID:$(".centered")[1].innerText,empName:$(".centered")[2].innerText,count:1},
				success:function(html){
					if(incremVarReq==0){
						alert("Request sent successfully.");
						incremVarReq++;
					}
				}
			});
			
		}
		else{
			logitOut();
		}
		/*
		if((login==0 || signouts==0) && (res.target.innerHTML=='Logout' || res.target.innerHTML=='Day Signout')){
			login++;signouts++;
			logitOut(res.target.innerHTML);
		}
		*/
	});
	loggedInOperator();
});

function compradioClick(re){
//assignSelfHandle(re.form.parentElement,re.defaultValue);
fileName = re.form.parentElement.parentElement.cells[3].textContent;
	var c= re.outerHTML.replace("checked=\"\"",'');
	if(re.defaultValue=='Simple'){
		re.outerHTML = (c).replace("Simple\"","Simple\" checked");
	}	
	if(re.defaultValue=='Medium'){
		re.outerHTML = (c).replace("Medium\"","Medium\" checked");
	}	
	if(re.defaultValue=='Complex'){
		re.outerHTML = (c).replace("Complex\"","Complex\" checked");
	}
	assignSelfHandle(re.defaultValue);
	mulArgs=="single";
}
function checkboxEnable(rere){
	if(rere.checked==true){
		rere.outerHTML =(rere.outerHTML).replace("style=\"\"", "checked");
	}
	else{
		rere.outerHTML =(rere.outerHTML).replace("checked=\"\"", "");
	}
}




var login=0,signouts=0;
var last;
var passVar1,employeeID
var employeeName;
var trToInsert='';
function displayIdleOperators(){
	modal = document.getElementById('modalidleOp');
	modal.style.display = "block";
	$.ajax({
		type:'POST',
		url:$('.base').val()+"public/Reports/vars1.php",	
		data:{pars:"parsing"},
		success:function(html){
			var c = html.split("/FREAK/");
			$("#idleList").html(c[4]);	
			var i = setInterval(function() { 
				$.ajax({
					type:'POST',
					url:$('.base').val()+"public/Reports/vars1.php",	
					data:{pars:"parsing"},
					success:function(html){
						var c = html.split("/FREAK/");
							$("#idleList").html(c[4]);	
					}
				});
			}, 10000);
		}
	});
}
//var divTextGlobal;
var incremVar=0; incremVarReq=0;
function logitOut(){
	$.ajax({
		type:'POST',
		url:'calcProdIdleBreak.php',
		data:{empID:employeeID,empName:employeeName},
		success:function(html){
			if(incremVar==0){
			var c =html.split("_");
			//var table="<table style='width: 100%;font-size: larger;text-align: center;line-height: 22px;'><tr><td>Core Production Count</td><td>"+c[4]+"</td></tr><tr><td>Aux Production Count</td><td>"+c[5]+"</td></tr><tr><td>Core Production Hours</td><td>"+c[7]+"</td></tr><tr><td>Aux Production Hours</td><td>"+c[6]+"</td></tr><tr><td>Break Hours</td><td>"+c[0]+"</td></tr><tr><td>Admin Hours</td><td>"+c[1]+"</td></tr><tr><td>Idle Hours</td><td>00:00:00</td></tr></table>";
			var table="<table style='width: 100%;font-size: larger;text-align: start;line-height: 22px;border: 1px solid #F1E41A;'><tr><th>Core/Aux</th><th>Job Type</th><th>Count</th><th>Hours</th></tr><tr><td style='border: 1px solid #F1E41A;'>Core</td><td style='border: 1px solid #F1E41A;'>Production</td><td style='border: 1px solid #F1E41A;'>"+c[4]+"</td><td style='border: 1px solid #F1E41A;'>"+c[7]+"</td></tr>  <tr><td style='border: 1px solid #F1E41A;'>Aux</td><td style='border: 1px solid #F1E41A;'>Production</td><td style='border: 1px solid #F1E41A;'>"+c[5]+"</td><td style='border: 1px solid #F1E41A;'>"+c[6]+"</td></tr><tr><td style='border: 1px solid #F1E41A;'></td><td style='border: 1px solid #F1E41A;'>Break</td><td style='border: 1px solid #F1E41A;'>-</td><td style='border: 1px solid #F1E41A;'>"+c[0]+"</td></tr><tr><td style='border: 1px solid #F1E41A;'></td><td>Admin</td><td style='border: 1px solid #F1E41A;'>-</td><td style='border: 1px solid #F1E41A;'>"+c[1]+"</td></tr><tr><td style='border: 1px solid #F1E41A;'></td><td style='border: 1px solid #F1E41A;'>Idle</td><td style='border: 1px solid #F1E41A;'>-</td><td style='border: 1px solid #F1E41A;'>"+c[8]+"</td></tr> </table></br>";
			
			//divTextGlobal = divText;
			var findDivs = $( document ).find( "div" )[0];
			findDivs.outerHTML= findDivs.outerHTML+"<div id='logoutModal' class='modal'><div class='modal-content' style='width: 32%; max-height: 700px; overflow: hidden;'><span onclick='closeModalLOg()' style='color: coral;opacity: 1;font-weight: 900;' class='close' > &times; </span> <div id='insopWiseModal' style='border: 1px solid chocolate;padding: 5px;'><h4 style='margin-top:2px;color:#FB3406;text-align: center;'>FIND YOUR ACTIVITIES HERE</h4><div id='operatorAct' style='text-align: center;width: 100%;'> </div> <div  style='text-align: -webkit-center;'> <input onclick='closeopWiseMod(this);' type='button' id='logouts' value='Logout' style='border-radius: 5px;background-color: cadetblue;font-size: large;'> &nbsp&nbsp&nbsp<input onclick='closeopWiseMod(this);' type='button' id='signouts' value='Day Signout' style='border-radius: 5px;background-color: darkorange;font-size: large;'></div> </div> </div> </div>";
			$("#operatorAct").html(table);
			modal = document.getElementById('logoutModal');
			modal.style.display = "block";
			incremVar++;
			}
		}
	});
}

function closeModalLOg(){
			modal = document.getElementById('logoutModal');
			modal.style.display = "none";	
}

function closeopWiseMod(ref){
	modal = document.getElementById('logoutModal');
    modal.style.display = "none";
	
	if(ref.defaultValue=='Logout'){
		login=0;
		$.post("logout.php?action=logout",{},function(data){
			location.href="index.php";
		});
	}
	if(ref.defaultValue=='Day Signout'){
		signouts=0;
		$.ajax({
		type:'POST',
		url:'punctuality.php',
		data:{empID:$(".centered")[1].innerText,empName:$(".centered")[2].innerText},
		success:function(html){
			var c =html.split('.')[1];
			if(c=="reached"){
				$.post("signout.php?action=logout",{},function(data){
					location.href="index.php";
				});
			}
			else{
				alert("You have not reached minimum working hours. Remaining working hours is: "+html+" Request an approval to signout for the day.");
			}
		}
		});		
	}
}
function openDialog(passVar){
	var date5= (passVar.title).split("/").join("-");
	$.ajax({
		type:'POST',
		url:'prevDays.php',
		data:{date:date5},
		success:function(html){
			var c= html.split("=");var dialogOptions = {
			  "title" : "Compare Statistics",
			  "width" : 'auto',
			  "height" : 'auto',
			  "modal" : false,
			  "resizable" : false,
			  "draggable" : true,
			  "close" : function(){
				if(last[0] != this){
				  $(this).remove(); 
				}
			  },
			  "show": {
				effect: "blind",
				duration: 1000
			  },
			  "hide": {
				effect: "blind",
				duration: 1000
			  }
			};    
			// dialog-extend options
			var dialogExtendOptions = {
			  "closable" : true,
			  "maximizable" : true,
			  "minimizable" : true,
			  "minimizeLocation" : 'left',
			  "collapsable" : true,
			  "titlebar" : false
			};
		   
			// open dialog
			//last = $("#dialog").dialog(dialogOptions);//.dialogExtend(dialogExtendOptions);
			//$(".ui-dialog-titlebar")[0].children[1].style.float = 'right';
			
			modal = document.getElementById('dialog');
			modal.style.display='block';
			
			getComparitiveInformation(c[1],c[2],c[3],c[4],c[5],1);
		}
	});
			
	/*
	var dialogOptions = {
      "title" : "Compare Statistics",
      "width" : 'auto',
      "height" : 'auto',
      "modal" : false,
      "resizable" : false,
      "draggable" : true,
      "close" : function(){
        if(last[0] != this){
          $(this).remove(); 
        }
      },
	  "show": {
        effect: "blind",
        duration: 1000
      },
      "hide": {
        effect: "blind",
        duration: 1000
      }
    };    
    // dialog-extend options
    var dialogExtendOptions = {
      "closable" : true,
      "maximizable" : true,
      "minimizable" : true,
      "minimizeLocation" : 'left',
      "collapsable" : true,
      "titlebar" : false
    };
   
    // open dialog
    last = $("#dialog").dialog(dialogOptions);//.dialogExtend(dialogExtendOptions);
	$(".ui-dialog-titlebar")[0].children[1].style.float = 'right';
	*/
}

function openLPdialog(){
	modal = document.getElementById('modalLP');
    modal.style.display = "block";
	$( "#datepickerStartLP" ).datepicker({dateFormat: "dd/mm/yy"});
	$('#datepickerStartLP').datepicker().datepicker('setDate', new Date());	
}
function closeModalLP(){
	//modal = document.getElementById('modalLP');
    modal.style.display = "none";	
	if(trToInsert){
		$('#jmsDisp')[0].children[1].innerHTML =  trToInsert + "" +$('#jmsDisp')[0].children[1].innerHTML;
		trToInsert='';
	}
}
var tablerow;
function lowPriorityFiles(){
	var filesList=[]; var pubList=[];
	var jmsTable=$('#jmsDisp')[0].children[1].children;
	for(is=0;is<jmsTable.length;is++){
		var cellValue = jmsTable[is].children[11].innerHTML;
		if(cellValue==$( "#datepickerStartLP" )[0].value){
			filesList.push((jmsTable[is].children[4].innerText).replace('\n',''));		pubList.push( (jmsTable[is].children[11].innerHTML).split("/").join("-"));
			$("#jmsDispLowPrior")[0].children[1].innerHTML= $("#jmsDispLowPrior")[0].children[1].innerHTML+""+jmsTable[is].innerHTML;
			jmsTable[is].remove();
			jmsTable=$('#jmsDisp')[0].children[1].children;
			is--;
		}
		if(is==jmsTable.length-1){
			//alert("Low Priority Jobs are moved.");
		}
	}
	var incs=0;
	for(i=0;i<filesList.length;i++){
		$.ajax({
		type:'POST',
		url:'moveLowPriorFiles.php',
		data:{fileName:filesList[i],folderName:pubList[i]},
		success:function(html){
			var c= html;
			incs++;
			if(incs==filesList.length-1){
				alert("File Moved as Low Priority");
			}
		}
	});
		
	}
	
	//var tablerow= ref.parentElement.parentElement;
	//var d = (tablerow.children[4].outerText).replace('\n','');
	/*
	$.ajax({
		type:'POST',
		url:'moveLowPriorFiles.php',
		data:{fileName:d},
		success:function(html){
			var c= html;
			tablerow.remove();
			//$("#jmsDispLowPrior")[0].children[1].innerHTML= (tablerow.outerHTML).replace("<span class=\"glyphicon glyphicon-new-window\" style=\"font-size:13px;color: coral;\" title=\"Move to Low Priority\" onclick=\"lowPriorityFiles(this);\"></span>","");
			alert("File Moved as Low Priority");
		}
	});
	*/
	
	modal = document.getElementById('modalLP');
    modal.style.display = "none";
}
function insideDialog(cs1,cs2,cs3,cs4,cs5){
	var a = new Date();
	
	var ces1 =(cs1.split(":")[1]).split("*");	var ces2 =(cs2.split(":")[1]).split("*");	var ces3 =(cs3.split(":")[1]).split("*");	var ces4 =(cs4.split(":")[1]).split("*");	var ces5 =(cs5.split(":")[1]).split("*");
	
	var perS1 = Number((ces1[1]*100/ces1[0]).toFixed(1));
	var perM1 = Number((ces1[2]*100/ces1[0]).toFixed(1));
	var perC1 = Number((ces1[3]*100/ces1[0]).toFixed(1));
	
	var perS2 = Number((ces2[1]*100/ces2[0]).toFixed(1));
	var perM2 = Number((ces2[2]*100/ces2[0]).toFixed(1));
	var perC2 = Number((ces2[3]*100/ces2[0]).toFixed(1));
	
	var perS3 = Number((ces3[1]*100/ces3[0]).toFixed(1));
	var perM3 = Number((ces3[2]*100/ces3[0]).toFixed(1));
	var perC3 = Number((ces3[3]*100/ces3[0]).toFixed(1));
	
	var perS4 = Number((ces4[1]*100/ces4[0]).toFixed(1));
	var perM4 = Number((ces4[2]*100/ces4[0]).toFixed(1));
	var perC4 = Number((ces4[3]*100/ces4[0]).toFixed(1));
	
	var perS5 = Number((ces5[1]*100/ces5[0]).toFixed(1));
	var perM5 = Number((ces5[2]*100/ces5[0]).toFixed(1));
	var perC5 = Number((ces5[3]*100/ces5[0]).toFixed(1));
	var myConfig = {
      "graphset": [
	  {
        "type": "mixed",
        "title": {"text": "DMGT - Complexity Trend","align": "center","font-size": 20,"height": "5%","font-color":"orange","background-color": "#E0E0E0"},
		"legend": {"layout": "x2","width": "285px","height":"40px","x": "11%","y": "8%","alpha": 1,"shadow": 0,"max-items": 4,"overflow": "page","type":"line","draggable": false,"minimize": false,"header": {"text": "Legend Info" },
        },
        "plotarea": {"margin": "34% 30% 10% 10%"},
		"plot":{
		  "valueBox":{
			"text":"%v"
		  }
		},
        "scale-x": {
          "values": [cs1.split(":")[0], cs2.split(":")[0], cs3.split(":")[0], cs4.split(":")[0], cs5.split(":")[0]],"zooming": false,
          "guide": {
            "line-style": "solid",
            "line-color": "#BDBDBD"
          },
          "markers": [{"type": "area","range": [3.5, 4.5],"background-color": "#66BB6A","alpha": 0.5,"label": {"text": "Active<br>Month","offset-y": -245,"angle": 0,"font-size": 10,"bold": true}}, 
		  {"type": "area","range": [3.5, 4.5],"background-color": "#cccccc","alpha": 0.5}
		  ]
        },
        "scale-y": {
          "zooming": false,
          "guide": {
            "line-style": "solid"
          },
          "label": {
          }
        },
        "scale-y-2": {
          "values": "0:100:10",
          "format": "%v%",
          "zooming": false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Percentage"
          }
        },
        "scale-y-3": {
          "decimals": 2,
          "zooming": false,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-3 label"
          }
        },
        "scale-y-4": {
          "format": "$%v",
          "multiplier": true,
          "zooming": false,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-4 label"
          }
        },
        "scroll-x": {
          "bar": {
            "height": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "height": "4px",
            "offset-y": -1,
            "background-color": "#E0E0E0"
          }
        },
        "scroll-y": {
          "bar": {
            "width": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "width": "4px",
            "offset-x": -1,
            "background-color": "#E0E0E0"
          }
        },
        "crosshair-x": {
          "plot-label": {
            "visible": false
          }
        },
        "crosshair-y": {

        },
        "zoom": {
          "background-color": "#B71C1C",
          "alpha": 0.2,
          "label": {
            "visible": true,
            "border-color": "#B71C1C"
          }
        },
        "series": [ {
          "type": "bar",
		  "values": [perS1, perS2, perS3, perS4, perS5],
          "scales": "scale-x,scale-y-2",
          "background-color": "#1B5E20",
          "text": "Simple",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        }, {
          "type": "bar",
		  "values": [perM1, perM2, perM3, perM4, perM5],
          "scales": "scale-x,scale-y-2",
          "background-color": "#E65100",
          "text": "Medium",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "short": true,
            "placement": "top-in",
            //"offset-y": 5,
            "font-angle": 90,
            "font-color": "#fff",
            "bold": true
          }
        },
		{
          "type": "bar",
		  "values": [perC1, perC2, perC3, perC4, perC5],
          "scales": "scale-x,scale-y-2",
          "background-color": "#FFAC33",
          "text": "Complex",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        },
		{
          "type": "line",
          "values": [Number(ces1[1])+Number(ces1[2])+Number(ces1[3]), Number(ces2[1])+Number(ces2[2])+Number(ces2[3]), Number(ces3[1])+Number(ces3[2])+Number(ces3[3]), Number(ces4[1])+Number(ces4[2])+Number(ces4[3]), Number(ces5[1])+Number(ces5[2])+Number(ces5[3])],
          "text": "Volume Trend",
          "line-color": "#B71C1C","labels":"%v",
          "legend-marker": {
            "type": "circle"
          },
          "marker": {
            "background-color": "#B71C1C",
			//"text":"%v"
          }
        }
		/*,
		{
            "type":"grid",
            "options":{
                "header-row":false
            },
            "series":[
                {
                    "values":["Jon","Anderson","January 9, 1957","U K"]
                },
                {
                    "values":["Steve","Hogarth","January 25, 1950","U K"]
                },
                {
                    "values":["Jim","Carrey","June 12, 1972","U S"]
                }
            ]
        }*/
		]
      }],
      "background-color": "white"
    };

    zingchart.render({
      id: 'compTrend',
      data: myConfig,
      height: 400,
      width: 400,
	  hideprogresslogo: true
    });
	//$("#compTrend-wrapper").css({"white-space": "nowrap","position": "relative","height": "500px", "width": "725px"});
	//$("#compTrend-top").css({"white-space": "nowrap","width": "725px","height": "498px","position": "absolute","overflow": "hidden","margin-left": "-48px","margin-top": "-36px"});
	
	var newsPer1 =Number(ces1[5])*100/(Number(ces1[5])+Number(ces1[6])+Number(ces1[7])).toFixed(1);
	var magPer1 =Number(ces1[6])*100/(Number(ces1[5])+Number(ces1[6])+Number(ces1[7])).toFixed(1);
	var othPer1 =Number(ces1[7])*100/(Number(ces1[5])+Number(ces1[6])+Number(ces1[7])).toFixed(1);
	
	var newsPer2 =Number(ces2[5])*100/(Number(ces2[5])+Number(ces2[6])+Number(ces2[7])).toFixed(1);
	var magPer2 =Number(ces2[6])*100/(Number(ces2[5])+Number(ces2[6])+Number(ces2[7])).toFixed(1);
	var othPer2 =Number(ces2[7])*100/(Number(ces2[5])+Number(ces2[6])+Number(ces2[7])).toFixed(1);
	
	var newsPer3 =Number(ces3[5])*100/(Number(ces3[5])+Number(ces3[6])+Number(ces3[7])).toFixed(1);
	var magPer3 =Number(ces3[6])*100/(Number(ces3[5])+Number(ces3[6])+Number(ces3[7])).toFixed(1);
	var othPer3 =Number(ces3[7])*100/(Number(ces3[5])+Number(ces3[6])+Number(ces3[7])).toFixed(1);
	
	var newsPer4 =Number(ces4[5])*100/(Number(ces4[5])+Number(ces4[6])+Number(ces4[7])).toFixed(1);
	var magPer4 =Number(ces4[6])*100/(Number(ces4[5])+Number(ces4[6])+Number(ces4[7])).toFixed(1);
	var othPer4 =Number(ces4[7])*100/(Number(ces4[5])+Number(ces4[6])+Number(ces4[7])).toFixed(1);
	
	var newsPer5 =Number(ces5[5])*100/(Number(ces5[5])+Number(ces5[6])+Number(ces5[7])).toFixed(1);
	var magPer5 =Number(ces5[6])*100/(Number(ces5[5])+Number(ces5[6])+Number(ces5[7])).toFixed(1);
	var othPer5 =Number(ces5[7])*100/(Number(ces5[5])+Number(ces5[6])+Number(ces5[7])).toFixed(1);
	var myConfig1 = {
      "graphset": [{
        "type": "mixed",
        "title": {"text": "DMGT - Volume Trend Analysis","align": "center","font-size": 20,"height": "5%","font-color":"orange","background-color": "#E0E0E0"},
		"legend": {"layout": "x2","width": "285px","height":"40px","x": "11%","y": "8%","alpha": 1,"shadow": 0,"max-items": 4,"overflow": "page","type":"line","draggable": false,"minimize": false,"header": {"text": "Legend Info" },
		
        },		
        "plotarea": {"margin": "34% 30% 10% 10%"},
		"plot":{
		  "valueBox":{
			"text":"%v"
		  }
		},
        "scale-x": {
          "values": [cs1.split(":")[0], cs2.split(":")[0], cs3.split(":")[0], cs4.split(":")[0], cs5.split(":")[0]],"zooming": false,
          "guide": {
            "line-style": "solid",
            "line-color": "#BDBDBD"
          },
          "markers": [{"type": "area","range": [3.5, 4.5],"background-color": "#66BB6A","alpha": 0.5,"label": {"text": "Active<br>Month","offset-y": -245,"angle": 0,"font-size": 10,"bold": true}}, 
		  {"type": "area","range": [3.5, 4.5],"background-color": "#cccccc","alpha": 0.5}
		  ]
        },
        "scale-y": {
          "zooming": false,
          "guide": {
            "line-style": "solid"
          },
          "label": {
          }
        },
        "scale-y-2": {
          "values": "0:100:10",
          "format": "%v%",
          "zooming": false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Percentage"
          }
        },
        "scale-y-3": {
          "decimals": 2,
          "zooming": false,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-3 label"
          }
        },
        "scale-y-4": {
          "format": "$%v",
          "multiplier": true,
          "zooming": false,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-4 label"
          }
        },
        "scroll-x": {
          "bar": {
            "height": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "height": "4px",
            "offset-y": -1,
            "background-color": "#E0E0E0"
          }
        },
        "scroll-y": {
          "bar": {
            "width": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "width": "4px",
            "offset-x": -1,
            "background-color": "#E0E0E0"
          }
        },
        "crosshair-x": {
          "plot-label": {
            "visible": false
          }
        },
        "crosshair-y": {

        },
        "zoom": {
          "background-color": "#B71C1C",
          "alpha": 0.2,
          "label": {
            "visible": true,
            "border-color": "#B71C1C"
          }
        },
        "series": [ {
          "type": "bar",
		  "values": [Number(newsPer1.toFixed(1)), Number(newsPer2.toFixed(1)), Number(newsPer3.toFixed(1)), Number(newsPer4.toFixed(1)), Number(newsPer5.toFixed(1))],
          "scales": "scale-x,scale-y-2",
          "background-color": "#1B5E20",
          "text": "Newspaper",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        }, {
          "type": "bar",
		  "values": [Number(magPer1.toFixed(1)), Number(magPer2.toFixed(1)), Number(magPer3.toFixed(1)), Number(magPer4.toFixed(1)), Number(magPer5.toFixed(1))],
          "scales": "scale-x,scale-y-2",
          "background-color": "#E65100",
          "text": "Magazine",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "short": true,
            "placement": "top-in",
            "font-angle": 90,
            "font-color": "#fff",
            "bold": true
          }
        },
		{
          "type": "bar",
		  "values": [Number(othPer1.toFixed(1)), Number(othPer2.toFixed(1)), Number(othPer3.toFixed(1)), Number(othPer4.toFixed(1)), Number(othPer5.toFixed(1))],
          "scales": "scale-x,scale-y-2",
          "background-color": "#FFAC33",
          "text": "Cartoons",
          "tooltip": {
            "text": "%v% %t",
            "width": "120px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        },
		{
          "type": "line",
          "values": [Number(ces1[5])+Number(ces1[6])+Number(ces1[7]), Number(ces2[5])+Number(ces2[6])+Number(ces2[7]), Number(ces3[5])+Number(ces3[6])+Number(ces3[7]), Number(ces4[5])+Number(ces4[6])+Number(ces4[7]), Number(ces5[5])+Number(ces5[6])+Number(ces5[7])],
          "text": "Volume Trend",
          "line-color": "#B71C1C","labels":"%v",
          "legend-marker": {
            "type": "circle"
          },
          "marker": {
            "background-color": "#B71C1C",
          }
        }
		]
      }],
      "background-color": "white"
    };

    zingchart.render({
      id: 'volumeTrend',
      data: myConfig1,
      height: 400,
      width: 400,
	  hideprogresslogo: true
    });
	
	var d1Qual= Number((Number(ces1[8])*100/Number(ces1[0])).toFixed(1));d1Qual = d1Qual?d1Qual:100;
	var d2Qual=Number((Number(ces2[8])*100/Number(ces2[0])).toFixed(1));d2Qual = d2Qual?d2Qual:100;
	var d3Qual=Number((Number(ces3[8])*100/Number(ces3[0])).toFixed(1));d3Qual = d3Qual?d3Qual:100;
	var d4Qual=Number((Number(ces4[8])*100/Number(ces4[0])).toFixed(1));d4Qual = d4Qual?d4Qual:100;
	var d5Qual=Number((Number(ces5[8])*100/Number(ces5[0])).toFixed(1));d5Qual = d5Qual?d5Qual:100;
	
	var myConfig2 = {
      "graphset": [{
        "type": "mixed",
        "title": {"text": "DMGT Quality & OTD Analysis","align": "center","font-size": 20,"height": "5%","font-color":"orange","background-color": "#E0E0E0"},
		"legend": {"layout": "x2","width": "285px","height":"40px","x": "11%","y": "8%","alpha": 1,"shadow": 0,"max-items": 4,"overflow": "page","type":"line","draggable": false,"minimize": false,"header": {"text": "Legend Info" },
		
        },		
        "plotarea": {"margin": "34% 30% 10% 10%"},
		"plot":{
		  "valueBox":{
			"text":"%v%"
		  }
		},
        "scale-x": {
          "values": [cs1.split(":")[0], cs2.split(":")[0], cs3.split(":")[0], cs4.split(":")[0], cs5.split(":")[0]],
		  "zooming": false          
        },
        "scale-y": {
          "zooming": false,
          "values": "0:100:20",
          "format": "%v%",
          "guide": {
            "line-style": "solid"
          },
          "label": {
            "text": "Percentage"
          }
        },
        "crosshair-x": {
          "plot-label": {
            "visible": false
          }
        },
        "series": [ {
          "type": "line",
		  "values": [Number((Number(ces1[4])*100/Number(ces1[0])).toFixed(1)), Number((Number(ces2[4])*100/Number(ces2[0])).toFixed(1)), Number((Number(ces3[4])*100/Number(ces3[0])).toFixed(1)), Number((Number(ces4[4])*100/Number(ces4[0])).toFixed(1)), Number((Number(ces5[4])*100/Number(ces5[0])).toFixed(1))],
		  "lineColor":'#336600',
		  "marker":{
			  "backgroundColor":'#336600',
			  "size": 7,
			},
          "text": "OTD",
          "tooltip": {
            "text": "%v% %t",
            "wrap-text": 1
          }
        },
		{
          "type": "line",
		  "values": [d1Qual,d2Qual,d3Qual,d4Qual,d5Qual],
		  "lineColor":'#D23C0A',
		  "marker":{
			  "backgroundColor":'#D23C0A',
			  "size": 4,
			},
          "text": "Internal Quality",
          "tooltip": {
            "text": "%v% %t",
            "wrap-text": 1
          }
        }
		
		]
      }],
      "background-color": "white"
    };

    zingchart.render({
      id: 'qualTrend',
      data: myConfig2,
      height: 400,
      width: 400,
	  hideprogresslogo: true
    });
	
	
	
}

function closemodalFordialog(){
	$("#compTrend").html("");	$("#volumeTrend").html("");		$("#qualTrend").html("");
	modal = document.getElementById('dialog');
	modal.style.display = "none";
}

function nextPrevDiv(divs){
	var c = divs;
	if(divs.className=="next round"){
		var c = divs.parentNode.previousElementSibling.childNodes[1].childNodes;
		for(var i =0;i<c.length;i++){
				if(c[i].nodeName=="DIV"){
					if(c[i].style.display=="" ||c[i].style.display=="block"){
						var nextdiv = Number(c[i].className)+1;
						if($("."+nextdiv).length>0){
							c[i].style.display="none";
							$("."+nextdiv)[0].style.display="block";break;
						}						
					}
				}
		}
		
	}
	else{		
		var c = divs.parentNode.nextElementSibling.childNodes[1].childNodes;
		for(var i =0;i<c.length;i++){
				if(c[i].nodeName=="DIV"){
					if(c[i].style.display=="" ||c[i].style.display=="block"){
						var nextdiv = Number(c[i].className)-1;
						if(nextdiv!=0){
						c[i].style.display="none";
							$("."+nextdiv)[0].style.display="block";break;
						}
					}
				}
		}
	}
}
var mlist; var lasting=0;
function getComparitiveInformation(st,en,st1,en1,st2,last){
	var startdate = $( "#datepickerStartdash" )[0].value.split("/");
	mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	for(var ie=0;ie<mlist.length;ie++){
		if(startdate[1]==mlist[ie]){
			var date = new Date($( "#datepickerStartdash" )[0].value);
			date.setDate(date.getDate()-7);
			if(date.getDate()<10){var aa = "0"+date.getDate();}else{var aa = date.getDate();}
			var a= aa + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var bb = "0"+date.getDate();}else{var bb = date.getDate();}
			var b= bb + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var cc = "0"+date.getDate();}else{var cc = date.getDate();}
			var c= cc + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var dd = "0"+date.getDate();}else{var dd = date.getDate();}
			var d= dd + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var ee = "0"+date.getDate();}else{var ee = date.getDate();}
			var e= ee + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var ff = "0"+date.getDate();}else{var ff = date.getDate();}
			var f= ff + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			date.setDate(date.getDate()+1);
			
			if(date.getDate()<10){var gg = "0"+date.getDate();}else{var gg = date.getDate();}
			var g= gg + '/' + mlist[(date.getMonth())] + '/' + date.getFullYear();
			
			
			if(st){
				a=st;b=en;c=st1;d=en1;e=st2;f='';g=''; //a=st;b=en;c="";d="";e="";
			}
			lasting=last;
			$.ajax({
				type:'POST',
				url:$('.base').val()+"public/CapacityPlanner/getComparison.php",	
				data:{date1:a,date2:b,date3:c,date4:d,date5:e,date6:f,date7:g,lasts:last},
				success:function(html){
					var cs =html.split("$");
					if(!lasting){//Number(cs[5])){
						var cs1 =(cs[0].split(":")[1]).split("*");
						var cs2 =(cs[1].split(":")[1]).split("*");
						var cs3 =(cs[2].split(":")[1]).split("*");
						var cs4 =(cs[3].split(":")[1]).split("*");
						var cs5 =(cs[4].split(":")[1]).split("*");
						var cs7 =(cs[7].split(":")[1]).split("*");
						var cs8 =(cs[8].split(":")[1]).split("*");
						
						var divWeekCharts ="<div id='date1a' style='margin-left: 8px;float:left;width: 123px;'></div><div id='date1b' style='float:left;width: 126px;'></div><div id='date2a' style='margin-left: -19px;float:left;width: 123px;'></div><div id='date2b' style='float:left;width: 126px;'></div><div id='date3a' style='margin-left: -19px;float:left;width: 123px;'></div><div id='date3b' style='float:left;width: 126px;'></div><div id='date4a' style='margin-left: -19px; float:left;width: 123px;'></div><div id='date4b' style='float:left;width: 126px;'></div><div id='date5a' style='margin-left: -19px;float:left;width: 123px;'></div><div id='date5b' style='float:left;width: 126px;'></div>  <div id='date6a' style='margin-left: -19px;float:left;width: 123px;'></div><div id='date6b' style='float:left;width: 126px;'></div>  <div id='date7a' style='margin-left: -19px;float:left;width: 123px;'></div><div id='date7b' style='float:left;width: 126px;'></div></br>";
						$("#multiSlider").html(divWeekCharts);
						var myConfig = {
							type: "pie", 
							backgroundColor: "#2A2C3E",						
							plot: {
							  refAngle: 270,
							  valueBox: [{
								placement: "out",
								text: "%t: %v",
								fontSize: 16
							  },
							  {
								placement: "in",
								text: "%npv%",
								fontColor: "#1A1B26",
								fontSize: 16
							  }]
							},
							tooltip: {
							  fontSize: 12,
							  fontColor: "#1A1B26",
							  shadow: 0,
							  borderRadius: 3,
							  borderWidth: 1,
							  borderColor: "#fff"
							},
							series : [{values : [400],backgroundColor: "#FB7373"},{values : [350],backgroundColor: "#FFA089"},{values : [250],backgroundColor: "#F2C994",text:"aa"}]
						};

						zingchart.render({ 
							id : 'dated', 
							data : myConfig,
							width:350,
							height:200,
							hideprogresslogo: true
						});
						createChartforComparison("date1a","date1b",cs[0]); createChartforComparison("date2a","date2b",cs[1]); createChartforComparison("date3a","date3b",cs[2]); createChartforComparison("date4a","date4b",cs[3]);
						createChartforComparison("date5a","date5b",cs[4]); createChartforComparison("date6a","date6b",cs[7]); createChartforComparison("date7a","date7b",cs[8]);
						var divWeekCharts ="<div id='' style='float:left;width: 237px;'><h5 title="+cs[0].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div><div id='' style='margin-left: -8px;float:left;width: 238px;'><h5 title="+cs[1].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div><div id='' style='margin-left: -8px;float:left;width: 238px;'><h5 title="+cs[2].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div><div id='' style='margin-left: -8px;float:left;width: 238px;'><h5 title="+cs[3].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div><div id='' style='margin-left: -8px;float:left;width: 238px;'><h5 title="+cs[4].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div><div id='' style='margin-left: -8px;float:left;width: 238px;'><h5 title="+cs[7].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div> <div id='' style='margin-left: -8px;float:left;width: 237px;'><h5 title="+cs[8].split(":")[0]+" onclick='openDialog(this)' style='margin-left: 8px;text-align: center;cursor: pointer;border: 1px solid darkgrey;background-color: #BAB9C6;color: #3F5666;margin-top: 1px;font-weight: 200;'>View Comparitive Statistics</h5></div>";
						$("#multiSlider").append(divWeekCharts);
						var zingBrand = setInterval(function() {
						//$('#compTrend-license-text')[0].style.display='none';
						//$('#volumeTrend-license-text')[0].style.display='none';
						//$('#qualTrend-license-text')[0].style.display='none';
						//$('#dated-license-text')[0].style.display='none';
						$('#date1b-license-text')[0].style.display='none';
						$('#date2b-license-text')[0].style.display='none';
						$('#date3b-license-text')[0].style.display='none';
						$('#date4b-license-text')[0].style.display='none';
						$('#date5b-license-text')[0].style.display='none';
						$('#date6b-license-text')[0].style.display='none';
						$('#date7b-license-text')[0].style.display='none';
						$('#complChart-license-text')[0].style.display='none';
						$('#QualityChart-license-text')[0].style.display='none';
						$('#otdChart-license-text')[0].style.display='none';
						//$('#forDashChart1-license-text')[0].style.display='none';

							clearInterval(zingBrand);
						}, 15000);
					}
					else{
						insideDialog(cs[0],cs[1],cs[2],cs[3],cs[4]);
					}
					
				}
			});
			break;
		}
	}	
}

function createChartforComparison(id1,id2,cs){
	var css = (cs.split(":")[1]).split("*");
	var perS = Number((css[1]*100/css[0]).toFixed(1));
	var perM = Number((css[2]*100/css[0]).toFixed(1));
	var perC = Number((css[3]*100/css[0]).toFixed(1));
	var s=Number(css[1]);var m=Number(css[2]);var c=Number(css[3]);
	if(!s){s=0;}if(!m){m=0;}if(!c){c=0;}
	var myConfig = {
  "layout":"1x2",
  "graphset":[
    {
      "type":"bar",
	  "title":{
		"text":cs.split(":")[0],
		"background-color":"none",
		"float":"left",
		"fontSize": 11.5,
		"font-weight":"none",
		"font-color":"black"
	  },
	  "scale-x": {
		"labels": ["S", "M", "C"]
	  },
	 "scale-y": {
		"values": '0:'+css[1]+':20',
		"item": {
		  "fontSize": 12
		},
		"guide": {
		  "visible": false
		}
	  },
	    "backgroundColor": "#dadada",
		"alpha":"0.5",
      "plot":{
        "background-color":"none",
        "border-width":1,
        "border-color":"black",
        "background-image":"PATTERN_DIAGONAL_BRICK"
      },
      "series":[
        {"values":[s,m,c]}
      ]
    }
  ]
};

zingchart.loadModules('patterns');
zingchart.render({ 
	id : id1, 
	data : myConfig, 
	height: 180,
	width:330,
	hideprogresslogo: true
});
if(s){var simText = ""+perS.toFixed(0)+"%";}else{simText="";}
if(m){var medText = ""+perM.toFixed(0)+"%";}else{medText="";}
if(c){var comText = ""+perC.toFixed(0)+"%";}else{comText="";}
var myConfig1 = {
  "layout":"1x2",
  "graphset":[
    {
      "type":"ring",
	  "backgroundColor": "#dadada",
	  "alpha":"0.5",
	  "shadow": "false",
      "scale":{
        "size-factor":1.0
      },
      "plot":{
        "value-box":{
		"placement":"in",
          "font-size":12,
          "font-weight":"normal"
        }
      },
      "series":[
        {"values":[s],"text":simText,"background-color":"#004C99"},
        {"values":[m],"text":medText,"background-color":"#66B2FF"},
        {"values":[c],"text":comText,"background-color":"#CCE5FF"}//BAB9C6, 8888A8, 5A5A88
      ]
    }
  ]
};
//"background-image":"PATTERN_SOLID_DIAMOND"//"background-image":"PATTERN_SHINGLE"//"background-image":"PATTERN_VERTICAL"
zingchart.loadModules('patterns');
zingchart.render({ 
	id : id2, 
	data : myConfig1, 
	height: 180,
	width:210,
	  hideprogresslogo: true
});
	//$("#"+id2+"-license-text")[0].style.display="none";

}
function showHideLp(re){
	if(re.value=="Show Low Priority Files"){
		$(".lpDivs")[0].style.display='block';
		$("#showLP")[0].style.display='none';
		$("#hideLP")[0].style.display='block';
	}
	else{
		$(".lpDivs")[0].style.display='none';
		$("#showLP")[0].style.display='block';
		$("#hideLP")[0].style.display='none';
	}
}

function showHideAs(re){
	if(re.value=="Show Assigned Files"){
		$(".asDivs")[0].style.display='block';
		$("#showAS")[0].style.display='none';
		$("#hideAS")[0].style.display='block';
	}
	else{
		$(".asDivs")[0].style.display='none';
		$("#showAS")[0].style.display='block';
		$("#hideAS")[0].style.display='none';
	}
	
}

var modal;
function getPreMonVal(ret){
	$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/TATExceedFiles.php",	
		data:{nothing:'nodata'},
		success:function(html){
			modal = document.getElementById('myModalMonthlyInfo');
			modal.style.display = "block";
			$("#MonHist").html("<h5 style='color: gray;'>Monthly Records:</h5>"+html); 
		}
	});
}
function forPublisherSplitup(){
	$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/pubSplits.php",	
		data:{nothing:'nodata'},
		success:function(html){			
			$("#publSplit").html(html); 
		}
	});
	
}
var QualityDetails;
function capacityPlanner(){
	forPublisherSplitup();
	mlist = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			var a = new Date();
			if(a.getDate()<10){var dd = "0"+a.getDate();}else{var dd = a.getDate();}
			a = dd+"/"+mlist[a.getMonth()]+"/"+a.getFullYear();
			var b="";var c="";var d="";var e="";
			$.ajax({
				type:'POST',
				url:$('.base').val()+"public/CapacityPlanner/getComparison.php",	
				data:{date1:a,date2:b,date3:c,date4:d,date5:e,date6:"",date7:"",lasts:""},
				success:function(html){
					var cs =html.split("$")[0].split(":")[1].split("*");
					if(Number(cs[0])){cs[0]=Number(cs[0]);}else{cs[0]=0;}
					if(Number(cs[1])){cs[1]=Number(cs[1]);}else{cs[1]=0;}
					if(Number(cs[2])){cs[2]=Number(cs[2]);}else{cs[2]=0;}
					if(Number(cs[3])){cs[3]=Number(cs[3]);}else{cs[3]=0;}
					
				var F12T2=0,F2T4=0,F4T6=0,F6T8=0,F8T10=0,F10T12=0,F12T2p=0,F2T4p=0,F4T6p=0,F6T8p=0,F8T10p=0,F10T12a=0;	
				var timeArray=["12:00:00 AM","2:00:00 AM","4:00:00 AM","6:00:00 AM","8:00:00 AM","10:00:00 AM","12:00:00 PM","2:00:00 PM","4:00:00 PM","6:00:00 PM","8:00:00 PM","10:00:00 PM"];
				
				var times = html.split("$")[6].split("-");
				for(var j=0;j<times.length;j++){
					if(times[j]){
						var actualTime = new Date(times[j]).getTime();
						var a = new Date();
						a = a.getFullYear()+"/"+mlist[a.getMonth()]+"/"+a.getDate();
						for(var i=0;i<timeArray.length;i++){					
						if(i==timeArray.length-1){var end="12:00:00 AM";}else{var end=timeArray[i+1];}
							var startTime = new Date(a+" "+timeArray[i]).getTime();
							var EndTime = new Date(a+" "+end).getTime();
							if(i==0){if(actualTime >= startTime && actualTime<EndTime){F12T2++;}}
							if(i==1){if(actualTime >= startTime && actualTime<EndTime){F2T4++;}}
							if(i==2){if(actualTime >= startTime && actualTime<EndTime){F4T6++;}}
							if(i==3){if(actualTime >= startTime && actualTime<EndTime){F6T8++;}}
							if(i==4){if(actualTime >= startTime && actualTime<EndTime){F8T10++;}}
							if(i==5){if(actualTime >= startTime && actualTime<EndTime){
								F10T12++;
								}}
							if(i==6){if(actualTime >= startTime && actualTime<EndTime){F12T2p++;}}
							if(i==7){if(actualTime >= startTime && actualTime<EndTime){F2T4p++;}}
							if(i==8){if(actualTime >= startTime && actualTime<EndTime){F6T8p++;}}
							if(i==9){if(actualTime >= startTime && actualTime<EndTime){F8T10p++;}}
							if(i==10){if(actualTime >= startTime && actualTime<EndTime){F10T12a++;}}
						}
					}
				}
				
				
					/*chart1 starts*/
					zingchart.THEME="classic";
					var myConfig1 = {
					"background-color":"#BAB9C6",
					"globals": {
					  "font-family":"Arial",
					  "font-weight":"normal"
					},
					"graphset":[
						{
							"type":"null",
							"x":"2.25%",
							"y":"1%",
							"background-color":"none",
							"title":{
								"text":"Today's Activity",
								"text-align":"left",
								"font-size":"14px",
								"font-color":"#ffffff",
								"background-color":"none"
							}
						},
						{
							"type":"null",
							"x":"73.75%",
							"y":"1%",
							"background-color":"none",
							"title":{
								"text":"Last Sync: Yesterday",
								"text-align":"right",
								"font-size":"11px",
								"font-color":"#f4f4f4",
								"background-color":"none"
							}
						},
						{
							"type":"pie",
							"height":"40%",
							"width":"30%",
							"x":"3%",
							"y":"10%",
							"background-color":"#ffffff",
							"border-radius":4,
							"title":{
								"text":"<strong>Simple - "+(Number(cs[1]*100/cs[0]).toFixed(2))+"%</strong>",
								"text-align":"left",
								"background-color":"none",
								"font-color":"#000000",
								"font-size":"13px",
								"offset-y":"10%",
								"offset-x":"10%"
							},
							"value-box":{
								"visible":true
							},
							"plotarea":{
								"margin":"20% 0% 0% 0%"
							},
							"plot":{
								"slice":50,
								"ref-angle":270,
								"detach":false,
								"hover-state":{
									"visible":false
								},
								"value-box":{
									"visible":true,
									"type":"first",
									"connected":false,
									"placement":"center",
									"text":"%v",
									"rules":[
										{
											"rule":"%v > "+cs[1],
											"visible":false
										}
									],
									"font-color":"#000000",
									"font-size":"20px"
								},
								"tooltip":{
									"rules":[
										{
											"rule":"%i == 0",
											"text":"%v %t Received",
											"shadow":false,
											"border-radius":4
										},
										{
											"rule":"%i == 1",
											"text":"%v Received",
											"shadow":false,
											"border-radius":4
										}
									]
								},
								"animation":{
									"delay":0,
									"effect":2,
									"speed":"600",
									"method":"0",
									"sequence":"1"
								}
							},
							"series":[
								{
									"values":[cs[1]],
									"text":"Simple",
									"background-color":"#00baf0",
									"border-width":"0px",
									"shadow":0
								},
								{
									"values":[cs[0]],
									"text":"Total",
									"background-color":"#dadada",
									"alpha":"0.5",
									"border-color":"#dadada",
									"border-width":"1px",
									"shadow":0
								}
							]
						},
						{
							"type":"pie",
							"height":"40%",
							"width":"30%",
							"x":"35%",
							"y":"10%",
							"background-color":"#ffffff",
							"border-radius":4,
							"title":{
								"text":"<strong>Medium - "+(Number(cs[2]*100/cs[0]).toFixed(2))+"%</strong>",
								"text-align":"left",
								"background-color":"none",
								"font-color":"#000000",
								"font-size":"13px",
								"offset-y":"10%",
								"offset-x":"10%"
							},
							"value-box":{
								"visible":true
							},
							"plotarea":{
								"margin":"20% 0% 0% 0%"
							},
							"plot":{
								"slice":50,
								"ref-angle":270,
								"detach":false,
								"hover-state":{
									"visible":false
								},
								"value-box":{
									"visible":true,
									"type":"first",
									"connected":false,
									"placement":"center",
									"text":"%v",
									"rules":[
										{
											"rule":"%v > "+cs[2],
											"visible":false
										}
									],
									"font-color":"#000000",
									"font-size":"20px"
								},
								"tooltip":{
									"rules":[
										{
											"rule":"%i == 0",
											"text":"%v %t Received",
											"shadow":false,
											"border-radius":4
										},
										{
											"rule":"%i == 1",
											"text":"%v Received",
											"shadow":false,
											"border-radius":4
										}
									]
								},
								"animation":{
									"delay":0,
									"effect":2,
									"speed":"600",
									"method":"0",
									"sequence":"1"
								}
							},
							"series":[
								{
									"values":[cs[2]],
									"text":"Medium",
									"background-color":"#8AB839",
									"border-width":"0px",
									"shadow":0
								},
								{
									"values":[cs[0]],
									"text":"Total",
									"background-color":"#dadada",
									"alpha":"0.5",
									"border-color":"#dadada",
									"border-width":"1px",
									"shadow":0
								}
							]
						},
						{
							"type":"pie",
							"height":"40%",
							"width":"30%",
							"x":"67%",
							"y":"10%",
							"background-color":"#ffffff",
							"border-radius":4,
							"title":{
								"text":"<strong>Complex - "+(Number(cs[3]*100/cs[0]).toFixed(2))+"%</strong>",
								"text-align":"left",
								"background-color":"none",
								"font-color":"#000000",
								"font-size":"13px",
								"offset-y":"10%",
								"offset-x":"10%"
							},
							"value-box":{
								"visible":true
							},
							"plotarea":{
								"margin":"20% 0% 0% 0%"
							},
							"plot":{
								"slice":50,
								"ref-angle":270,
								"detach":false,
								"hover-state":{
									"visible":false
								},
								"value-box":{
									"visible":true,
									"type":"first",
									"connected":false,
									"placement":"center",
									"text":"%v",
									"rules":[
										{
											"rule":"%v > "+cs[3],
											"visible":false
										}
									],
									"font-color":"#000000",
									"font-size":"20px"
								},
								"tooltip":{
									"rules":[
										{
											"rule":"%i == 0",
											"text":"%v %t Received",
											"shadow":false,
											"border-radius":4
										},
										{
											"rule":"%i == 1",
											"text":"%v Received",
											"shadow":false,
											"border-radius":4
										}
									]
								},
								"animation":{
									"delay":0,
									"effect":2,
									"speed":"600",
									"method":"0",
									"sequence":"1"
								}
							},
							"series":[
								{
									"values":[cs[3]],
									"text":"Complex",
									"background-color":"#FABE28",
									"border-width":"0px",
									"shadow":0
								},
								{
									"values":[cs[0]],
									"text":"Total",
									"background-color":"#dadada",
									"alpha":"0.5",
									"border-color":"#dadada",
									"border-width":"1px",
									"shadow":0
								}
							]
						},
						{
							"type":"mixed",
							"height":"42%",
							"width":"94%",
							"x":"3%",
							"y":"53%",
							"background-color":"#ffffff",
							"border-radius":4,
							"title":{
								"text":"Step Tracker",
								"text-align":"left",
								"font-size":"13px",
								"font-color":"#000000",
								"background-color":"none",
								"offset-x":"10%",
								"offset-y":"10%"
							},
							"legend":{
								"toggle-action":"remove",
								"layout":"x3",
								"x":"52.5%",
								"shadow":false,
								"border-color":"none",
								"background-color":"none",
								"item":{
									"font-color":"#000000"
								},
								"marker":{
									"type":"circle",
									"border-width":0
								},
								"tooltip":{
									"text":"%plot-description"
									}
							},
							"tooltip":{
								"text":"%t<br><strong>%v</strong>",
								"font-size":"12px",
								"border-radius":4,
								"shadow":false,
								"callout":true,
								"padding":"5 10"
							},
							"plot":{
								"background-color":"#5A5A87",
								"animation":{
									"effect":"4"
								},
							    "valueBox":{
								 "text":"%v"
							    }
							},
							"plotarea":{
								"margin":"35% 3.5% 20% 7.5%"
							},
							"scale-x":{
								"values":["12AM","2AM","4AM","6AM","8AM","10AM","<strong>NOON</strong>","2PM","4PM","6PM","8PM","10PM"],
								"line-color":"#5A5A87",
								"line-width":"1px",
								"item":{
									"font-size":"10px",
									"offset-y":"-2%"
								},
								"guide":{
									"visible":false
								},
								"tick":{
									"visible":false
								}
							},
							"scale-y":{
								//"values":"0:300:100",
								"line-color":"none",
								"item":{
									"font-size":"10px",
									"offset-x":"2%"
								},
								"guide":{
									"line-style":"solid",
									"line-color":"#5A5A87"
								},
								"tick":{
									"visible":false
								}
							},
							crosshairX:{
							  plotLabel:{
								multiple: true,
								borderRadius: 3
							  },
							  scaleLabel:{
								backgroundColor:'#5A5A87',
								borderRadius: 3
							  },
							  marker:{
								size: 7,
								alpha: 0.5
							  }
							},
							crosshairY:{
							  lineColor:'#5A5A87',
							  type:'multiple',
							  scaleLabel:{
								decimals: 2,
								borderRadius: 3,
								offsetX: -5,
								fontColor:"#5A5A87",
								bold: true
							  }
							},
							"series":[
								{
									"type": "line",
									"marker": {
										"background-color": "#5A5A87",
										"border-width": 2,
										"shadow": 0,
										"border-color": "#88f5fa"
									},
									"line-color": "#5A5A87",
									"text":"Volumes Received",
									"values":[F12T2,F2T4,F4T6,F6T8,F8T10,F10T12,F12T2p,F2T4p,F4T6p,F6T8p,F8T10p,F10T12a],
									"background-color":"#5A5A87",
									"description":"Count",
									"hover-state":{
										"background-color":"#5A5A87"
									}									
								}
							]
						}
					]
					};
					zingchart.render({ 
						id : 'complChart', 
						data : myConfig1, 
						height: 500, 
						width: 725
					});
					/*chart1 ends*/
				}
			});


//code to get OTD - starts

$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/getOTD.php",	
		data:{nothing:'nodata'},
		success:function(html){
			var otdPer =html.split("*");
			otdDetails = otdPer[4];
			var yesPer = Number((otdPer[0]*100/otdPer[3]).toFixed(0));
			var noPer = Number((otdPer[1]*100/otdPer[3]).toFixed(0));
			if(!yesPer){
				yesPer=100;noPer=0;
			}
/*chart2 starts*/			
	zingchart.THEME="classic";
	var myConfig2 = {
		"globals": {
		  "font-family":"Lato",
		  "font-weight":"100"
		},
		"graphset":[
			{
				"type":"ring",
				"background-color":"",//#282E3D
				"tooltip":{
					"visible":0
				},
				"plotarea":{
					"margin":"0% 0% 0% 0%"
				},
				"plot":{
					"slice":60,
					"ref-angle":80,
					"detach":false,
					"hover-state":{
						"visible":false
					},
					"value-box":{
						"visible":true,
						"type":"first",
						"connected":false,
						"placement":"center",
						"text":yesPer +"% <br>OTD",
						"rules":[
							{
								"rule":"%v > 50",
								"visible":false
							}
						],
						"font-color":"black",
						"font-size":"27px"
					},
					"animation":{
						"delay":0,
						"effect":2,
						"speed":"600",
						"method":"0",
						"sequence":"1"
					}
				},
				"series":[
					{
						"values":[noPer],
						"background-color":"lightgray",
						"border-color":"white",
                    "border-width":"1px",
						"shadow":0
					},
					{
						"values":[yesPer],
						"background-color":"#FA8072",
						"border-color":"white",
						"border-width":"1px",
						"shadow":0
					}
				]
			}
		]
		};
     
    zingchart.render({ 
    	id : 'QualityChart', 
    	data : myConfig2, 
    	hideprogresslogo: true,
      height:170,
      width:170
    });
	$("#QualityChart").prepend("<h5 style='border: 1px solid darkgrey;background-color: #BAB9C6;margin-top: 1px;font-weight: bold;' onclick='otdHistory()'>OTD Analysis</h5>");
	$("#QualityChart").append("<input type='button' id='f' value='View Details' style='border-radius: 3px;background-color: #BAB9C6;height: 22px;font-size: 12px;width: 67%;' onclick='getOTDDetails()' >");
	
	//display band information
	}
		
/*chart2 ends*/
	});
//code to get OTD - ends


/*chart2 starts*/
$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/getQuality.php",	
		data:{nothing:'nodata'},
		success:function(html){
			var qualPer =html.split("*");
			QualityDetails = qualPer[3];
			var yesPer = Number((qualPer[0]*100/qualPer[2]).toFixed(0));
			var noPer = Number((qualPer[1]*100/qualPer[2]).toFixed(0));
			if(!yesPer){
				yesPer=100;noPer=0;
			}
zingchart.THEME="classic";
var myConfig3 = {
    "globals": {
      "font-family":"Lato",
      "font-weight":"100"
    },
    "graphset":[
        {
            "type":"ring",
            "background-color":"",//#282E3D
            "tooltip":{
                "visible":0
            },
            "plotarea":{
                "margin":"0% 0% 0% 0%"
            },
            "plot":{
                "slice":60,
                "ref-angle":50,
                "detach":false,
                "hover-state":{
                    "visible":false
                },
                "value-box":{
                    "visible":true,
                    "type":"first",
                    "connected":false,
                    "placement":"center",
                    "text":"100% <br>Quality",
                    "rules":[
                        {
                            "rule":"%v > 50",
                            "visible":false
                        }
                    ],
                    "font-color":"black",
                    "font-size":"27px"
                },
                "animation":{
                    "delay":0,
                    "effect":2,
                    "speed":"600",
                    "method":"0",
                    "sequence":"1"
                }
            },
            "series":[
                {
                    "values":[yesPer],
                    "background-color":"lightgray",
                    "border-color":"white",
                    "border-width":"1px",
                    "shadow":0
                },
                {
                    "values":[noPer],
                    "background-color":"#5A5A87",
                    "border-color":"white",
                    "border-width":"1px",
                    "shadow":0
                }
            ]
        }
    ]
    };
     
    zingchart.render({ 
    	id : 'otdChart', 
    	data : myConfig3, 
    	hideprogresslogo: true,
      height:170,
      width:170
    });
	$("#otdChart").prepend("<h5 style='border: 1px solid darkgrey;background-color: #BAB9C6;margin-top: 1px;font-weight: bold;'>Quality Analysis</h5>");
	$("#otdChart").append("<input type='button' id='g' value='View Details' style='border-radius: 3px;background-color: #BAB9C6;height: 22px;font-size: 12px;width: 67%;' onclick='getQualityAnalysis()' >");
		}
});
/*chart3 ends*/


	var start = ["17/May/2018 12:00:00 AM","17/May/2018 02:00:00 AM","17/May/2018 04:00:00 AM","17/May/2018 06:00:00 AM","17/May/2018 08:00:00 AM","17/May/2018 10:00:00 AM","17/May/2018 12:00:00 PM","17/May/2018 02:00:00 PM","17/May/2018 04:00:00 PM","17/May/2018 06:00:00 PM","17/May/2018 08:00:00 PM","17/May/2018 10:00:00 PM"];
	
	var end = ["17/May/2018 01:59:59 AM","17/May/2018 03:59:59 AM","17/May/2018 05:59:59 AM","17/May/2018 07:59:59 AM","17/May/2018 09:59:59 AM","17/May/2018 11:59:59 AM","17/May/2018 01:59:59 PM","17/May/2018 03:59:59 PM","17/May/2018 05:59:59 PM","17/May/2018 07:59:59 PM","17/May/2018 09:59:59 PM","17/May/2018 11:59:59 PM"];
	
	$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/TATExceedFiles.php",	
		data:{nothing:'nodata'},
		success:function(html){
			//var c = html.split("+");
			//$("#summaryDash").html($("#summaryDash").html()+" - "+c[1]); 
			//$("#marqueDiv").html(c[0]);
			//setInterval(function() {
			//var c = $('#marqueDiv');
			//c.scrollTop(c.scrollTop() + 1)
			//}, 100);
		}
	});
	$( "#datepickerStartdash" ).datepicker({dateFormat: "dd/MM/yy"});
	$('#datepickerStartdash').datepicker().datepicker('setDate', new Date());
	$( "#datepickerEnddash" ).datepicker({dateFormat: "dd/MM/yy"});
	$('#datepickerEnddash').datepicker().datepicker('setDate', new Date());
	var todDate = $('#datepickerStartdash')[0].value;
	$("#loadersCapacity").show();
	$.ajax({
			type:'POST',
			url:$('.base').val()+"public/CapacityPlanner/capacityCount.php",	
			data:{sdate:todDate, edate:todDate,interval:'no'},
			success:function(html){
				var c = html.split("COUNT");
				/*total images till date - starts*/
				var totalText = $("#totalI").html(c[0]);//+"<h2 id='h3Totl' style='margin-top: 7px;'>"+c[0]+"</h2>";
				//$("#totalI").html(totalText);
				/*total images till date -ends*/
				
				/*total images received today - starts*/
				var totalText1 = $("#totalTod").html(c[1]);//+"<h2 id='h3TodayTot' style='margin-top: 7px;'>"+c[1]+"</h2>";
				//$("#totalTod").html(totalText1);
				/*total images received today -ends*/
				
				/*total images inprogress today - starts*/
				var totalText2 = $("#totalProcessing").html(c[2]);//+"<h2 id='h3TodayProcessing' style='margin-top: 7px;'>"+c[2]+"</h2>";
				//$("#totalProcessing").html(totalText2);
				/*total images inprogress today -ends*/
				
				/*total images delivered today - starts*/
				var totalText3 = $("#totalDelivered").html(c[3]);//+"<h2 id='h3TodayDelivered' style='margin-top: 7px;'>"+c[3]+"</h2>";
				//$("#totalDelivered").html(totalText3);
				/*total images delivered today -ends*/
				
				/*total employees - starts*/
				var totalEmp = $("#totalEmployees").html(c[4]);//+"<h2 id='h3TodayEmployees' style='margin-top: 7px;'>"+c[4]+"</h2>";
				//$("#totalEmployees").html(totalEmp);
				/*total employees -ends*/
				
				/*total employees online- starts*/
				var totalEmpOn = $("#totalEmployeesOn").html(c[5]);//+"<h2 id='h3TodayEmployeesOn' style='margin-top: 7px;'>"+c[5]+"</h2>";
				//$("#totalEmployeesOn").html(totalEmpOn);
				/*total employees online-ends*/
				
				/*total images in the month- starts*/
				var totalImgMonth = $("#totalImgMonth").html(c[6]);//+"<h2 id='h3totalImgMont' style='margin-top: 7px;'>"+c[6]+"</h2>";
				//$("#totalImgMonth").html(totalImgMonth);
				/*total images in the month-ends*/
				
				/*core Utilixation- starts*/
				var htmlc8 = c[8].split(":");
				var coreUtilization = $("#utilHours").html(c[8]+"%")+"<h2 id='h3coreUtil' style='margin-top: 7px;'>"+c[8]+"%";
				//$("#utilHours").html(coreUtilization);
				/*core Utilixation-ends*/
				$("#loadersCapacity").hide();
			}
	});	
	
	
	$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/capacityCount.php",	
		data:{sdate:$('#datepickerStartdash')[0].value, edate:$('#datepickerStartdash')[0].value+" 12:59:60 PM",interval:'yes'},
		success:function(html){
var myConfig = {
      "graphset": [{
        "type": "mixed",
        "legend": {
          "layout": "x2",
          "width": "85px",
		  "height":"20px",
          "x": "72%",
          "y": "11%",
          "alpha": 1,
          "shadow": 0,
          "max-items": 1,
          "overflow": "page",
		  "type":"line",
          "draggable": true,
          "minimize": true,
          "header": {
            "text": "Legend Info"
          },
        },
		
        "plotarea": {
          "margin": "34% 30% 10% 10%"
        },
        "scale-x": {
          "values": ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          "zooming": true,
          "guide": {
            "line-style": "solid",
            "line-color": "#BDBDBD"
          },
          "markers": [{
            "type": "area",
            "range": [3.5, 4.5],
            "background-color": "#66BB6A",
            "alpha": 0.5,
            "label": {
              "text": "Active<br>Month",
              "offset-y": -245,
              "angle": 0,
              "font-size": 10,
              "bold": true
            }
          }, {
            "type": "area",
            "range": [3.5, 4.5],
            "background-color": "#cccccc",
            "alpha": 0.5
          }]
        },
        "scale-x-2": {
          "values": ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10","11","12"],
          "guide": {
            "visible": false
          },
          "label": {
            "text": "X-2 label"
          },
          "zooming": true
        },
        "scale-y": {
          "zooming": true,
          "guide": {
            "line-style": "solid"
          },
          "label": {
          },
          "minor-ticks": 3,
          "minor-tick": {
            "placement": "cross",
            "size": 6
          },
          "minor-guide": {
            "line-width": "1px",
            "line-style": "dashed",
            "line-segement-size": "1px",
            "line-gap-size": "6px",
            "alpha": 0.7
          },
          "markers": [{
            "type": "line",
            "range": [74],
            "line-color": "#212121",
            "alpha": 1,
            "line-width": 2,
            "label": {
              "text": "Threshold",
              "offset-x": -60,
              "offset-y": 8,
              "background-color": "#212121",
              "font-color": "white",
              "font-size": 10,
              "callout": true,
              "callout-position": "right"
            }
          }]
        },
        "scale-y-2": {
          "values": "0:100:10",
          "format": "%v%",
          "zooming": true,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Percentage"
          }
        },
        "scale-y-3": {
          "decimals": 2,
          "zooming": true,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-3 label"
          }
        },
        "scale-y-4": {
          "format": "$%v",
          "multiplier": true,
          "zooming": true,
		  "visible":false,
          "guide": {
            "visible": false
          },
          "label": {
            "text": "Y-4 label"
          }
        },
        "scroll-x": {
          "bar": {
            "height": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "height": "4px",
            "offset-y": -1,
            "background-color": "#E0E0E0"
          }
        },
        "scroll-y": {
          "bar": {
            "width": "8px",
            "background-color": "#757575"
          },
          "handle": {
            "width": "4px",
            "offset-x": -1,
            "background-color": "#E0E0E0"
          }
        },
        "crosshair-x": {
          "plot-label": {
            "visible": false
          }
        },
        "crosshair-y": {

        },
        "zoom": {
          "background-color": "#B71C1C",
          "alpha": 0.2,
          "label": {
            "visible": true,
            "border-color": "#B71C1C"
          }
        },
        "preview": {
          "height": 50,
          "width": "69%",
          "position": "14% 14%"
        },
        "series": [{
          "type": "line",
          "values": [69, 68],
          "text": "Volume Trend",
          "scales": "scale-x,scale-y",
          "line-color": "#0D47A1",
          "legend-marker": {
            "type": "circle"
          },
          "marker": {
            "background-color": "#0D47A1"
          }
        }, {
          "type": "line",
          "values": [51, 53],
          "scales": "scale-x,scale-y-2",
          "line-color": "#B71C1C",
          "tooltip-text": "%v%",
          "legend-marker": {
            "type": "circle"
          },
          "marker": {
            "background-color": "#B71C1C"
          }
        }, {
          "type": "bar",
          "values": [22, 25],
          "text": "Simple",
          "background-color": "#1B5E20",
          "tooltip": {
            "text": "The number being shown is the percentage of the node when compared to its plot",
            "width": "200px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        }, {
          "type": "bar",
          "values": [25, 10],
          "background-color": "#E65100",
          "text": "Medium",
          "tooltip": {
            "text": "The number being shown above the bar is the value of the node",
            "width": "200px",
            "wrap-text": 1
          },
          "value-box": {
            "short": true,
            "placement": "top-in",
            "font-angle": 90,
            "font-color": "#fff",
            "bold": true
          }
        },
		{
          "type": "bar",
          "values": [22, 25],
          "text": "Comples",
          "background-color": "#FFAC33",
          "tooltip": {
            "text": "The number being shown is the percentage of the node when compared to its plot",
            "width": "200px",
            "wrap-text": 1
          },
          "value-box": {
            "placement": "top-in",
            "offset-y": 5,
            "font-color": "#fff",
            "font-angle": 90
          }
        }]
      }],
      "background-color": "white"
    };

    zingchart.render({
      id: 'forDashChart1',
      data: myConfig,
      height: 500,
      width: 870,
	  hideprogresslogo: true
    });
	$("#forDashChart1-wrapper").css({"white-space": "nowrap","position": "relative","height": "500px", "width": "725px"});
	$("#forDashChart1-top").css({"white-space": "nowrap","width": "725px","height": "498px","position": "absolute","overflow": "hidden","margin-left": "-48px","margin-top": "-36px"});

		}
	});	

//code for pie chart - ends
forQC="dash";
loggedInOperator();	
$.ajax({
		type:'POST',
		url:$('.base').val()+"public/CapacityPlanner/vars10.php",	
		data:{currentTime:""},
		success:function(html){
			var c = html;var doneforDayText;
			var availableResource=html.split("TEAM")[0];
			if(html.split("TEAM")[2]=="<td style='width:30%;border: 1px solid white;'><div class='doneForTheDay' style='height: 248px;overflow-y: scroll;'></div></td>	"){
				doneforDayText="<td style='width:30%;border: 1px solid white;'><div class='doneForTheDay' style='height: 248px;overflow-y: scroll;'>No Resource has left</div></td>"
			}
			else{
				doneforDayText=html.split("TEAM")[2];
			}
		}
});
getComparitiveInformation(null,null,null,null,null,null);
}
var otdMainvar=0;var otdMonthPer=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
function otdHistory(){
	//$('#demo1s').daterangepicker();
	$( "#firstDate" ).datepicker({
		dateFormat: "MM-yy",
		maxDate: "+0D",
		onSelect: function(ee){monthsDate(ee,"OTDdiffChart");}
	});
	$('#firstDate').datepicker().datepicker('setDate', new Date());
	$( "#secondDate" ).datepicker({
		dateFormat: "MM-yy",
		maxDate: "+0D",
		onSelect: function(ee){monthsDate(ee,"OTDdiffChart1");}
	});
	monthsDate($( "#firstDate" )[0].value,"OTDdiffChart");
}

function monthsDate(date,id){
	otdMonthPer=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
	$.ajax({
		type:'POST',
		url:'getDatesInMonth.php',	
		data:{date1:date},
		success:function(html){
			var cc = html.split("_");
			for(i=0;i<cc.length;i++){
					$.ajax({
						type:'POST',
						url:'getOTDmonth.php',	
						data:{date1:cc[i]},
						success:function(html){
							var c =html.split("_");
							otdMonthPer[Number(c[2])-1]=Number(c[0]);
							otdMainvar++;
							if(otdMainvar==cc.length){
								otdMainvar=0;
								//otdMonthPer.slice(1);
								$("#"+id).html('');								
								$("#dialogOTDComp").show();
								var dates=["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31"];
								var myConfig = {
								  "layout":"1x2",
									"width":"1000px",
								  "graphset":[
									{
									  "type":"bar",
									  "scale-x": {
											"values": dates,
											"line-color": "#7E7E7E",
											"tick": {
												"visible": false
											},
											"guide": {
												"visible": false
											},
											"item": {
												"font-family": "arial",
												"font-color": "#8B8B8B"
											}
										},
									  "scale-y":{
										"values":"0:100:20",
										"format":"%v%",
										"guide":{
										  "line-style":"dashdot"
										}
									  },
									  "plot":{
										"background-color":"orange pink"
									  },
									  "series":[
										{"values":otdMonthPer}
									  ]
									},
									
								  ]
								};
							//#4CAF50 #8BC34A
								zingchart.render({ 
									id : id, 
									data : myConfig, 
									height: 400, 
									width: 1000,
									hideprogresslogo: true
								});
								
								$("#"+id+"-wrapper").css({"white-space": "nowrap","position": "relative","height": "400px", "width": "630px"});
							}
						}
					});
			}
		}
	});
}
var forQC;
var totalDmgEmp;

function handleClick(re) {
	if(re.parentElement.nextElementSibling.innerText=="Yet to assign"){
	}
	else{
		if (confirm("Are you sure you want to re-assign complexity for already assigned file?.")) {
			var sel;
			for(i=0;i<re.length;i++){
				if(re[i].checked==true){
					sel = re[i].defaultValue;
					var fName = (re.parentElement.previousElementSibling.previousElementSibling.innerText).replace('\n','');
					$.ajax({
							type:'POST',
							url:'vars4.php',	
							data:{radio:sel,fNames:fName},
							success:function(html){
								var c = html;
								alert("Assigned Complexity");						
							}
					});	
				}
			}
		}
	}
    return true;
}
function getOTDDetails(){
	$("#modalForOTD").show();
	if(otdDetails=="<table id='getOTDtable' style='font-size: xx-small;border: 1px solid #F1E41A;'><tr><th>File_Name</th><th>Process Time</th><th>Operator</th><th>Received_Time</th><th>Assigned_Time</th><th>Delivered_Time</th><th>Complexity</th></tr></table>"){
		
	$("#OTDAn").html("100% OTD Acheived");
	}
	else{
		$("#OTDAn").html(otdDetails);
		$("#insmodalForOTD >h4").append("<img onclick='exportToExc();' title='Export To Excel' src='img/excel.png' style='width: 20px; height: 20px;float: right;'/>");
		}
}

function getQualityAnalysis(){
	$("#modalForQual").show();
	if(QualityDetails=="<table id='getQualtable' style='font-size: xx-small;border: 1px solid #F1E41A;'><tr><th>File_Name</th><th>Error_Type</th><th>Operator</th><th>QC Operator</th><th>Complexity</th></tr></table>"){		
	$("#QualAn").html("100% Quality Acheived");
	}
	else{
		$("#QualAn").html(otdDetails);
		$("#insmodalForQual >h4").append("<img onclick='download_csv('getOTDtable','Quality Analysis');' title='Export To Excel' src='img/excel.png' style='width: 20px; height: 20px;float: right;'/>");
		//$("#insmodalForQual >h4").append("<img onclick='export_table_to_csv($('#getOTDtable > tbody > tr'), 'Quality Analysis.csv');' title='Export To Excel' src='img/excel.png' style='width: 20px; height: 20px;float: right;'/>");
	}
}
		function chartingFn(){
			//if($('#datepickerStart')[0].value!=""){
			$.ajax({
				type:'POST',
				url:'getChartForDate.php',	
				data:{sdate:$('#datepickerStart')[0].value, edate:$('#datepickerEnd')[0].value+" 11:59:59 PM"},
				success:function(html){
					$("#chartDiv").html();
					$("#chartDiv").html("<canvas id='myChartID' style='max-width: 500px;max-height:350px;display:none;'>");
					html = html.split("/$");	
					//$("#opWiseDet").html(html[4]);		
					$("#myChartID")[0].style.display="block";
					availableTags = html[5];
					var ctx = document.getElementById('myChartID').getContext('2d');
					var myChart = new Chart(ctx, {
					type: 'bar',
					data: {
						labels: ["Received: "+html[0], "In Progress: "+html[1], "To Be Initiated: "+html[2], "Delivered: "+html[6], "In QC: "+html[3]],
						datasets: [{
							label: 'DMG Status Report',
							fill: false,
							data: [html[0], html[1], html[2], html[6], html[3]],
							backgroundColor: ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)'],
							borderColor: ['rgba(255,99,132,1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)'],
							borderWidth: 1.5
						}]
					},
					title: {
						display: true,
						text: 'Chart.js Line Chart - Legend'
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero:true,
									steps: 50,
									max: 500,					
								}
							}]
						}
					}
					});
					if($("#percentage")[0].childNodes[1].childNodes[2]){
						var cc= $("#percentage")[0].childNodes[1].childNodes[2];
						cc.cells[0].innerHTML =$('#datepickerStart')[0].value+" - "+$('#datepickerEnd')[0].value;
						cc.cells[1].innerHTML =(Number(html[1])*100/Number(html[0])).toFixed(1)+" %";
						cc.cells[2].innerHTML =(Number(html[2])*100/Number(html[0])).toFixed(1)+" %";
						cc.cells[3].innerHTML =(Number(html[6])*100/Number(html[0])).toFixed(1)+" %";
						cc.cells[4].innerHTML =(Number(html[3])*100/Number(html[0])).toFixed(1)+" %";
					}
					else{
						$("#percentage")[0].childNodes[1].innerHTML+="<tr style='border:1px solid black;text-align: center;'><td style='border:1px solid black;font-size: smaller;'>"+$('#datepickerStart')[0].value+" - "+$('#datepickerEnd')[0].value+"</td><td style='border:1px solid black;'>"+(Number(html[1])*100/Number(html[0])).toFixed(1)+"%</td><td style='border:1px solid black;'>"+(Number(html[2])*100/Number(html[0])).toFixed(1)+"%</td><td style='border:1px solid black;'>"+(Number(html[6])*100/Number(html[0])).toFixed(1)+"%</td><td style='border:1px solid black;'>"+(Number(html[3])*100/Number(html[0])).toFixed(1)+"%</td></tr><br/><br/>"
					}
					$("#tableForOprtr").html("");
					$("#forSelect").html(availableTags);
					
				},
				complete: function(){
					//alert("Job Assigned to: "+selValue[selValue.selectedIndex].innerText);
				}
			});
			//}
		}
		
		function getfromchartDisplay(){
			$.ajax({
							type:'POST',
							url:'opWiseSheet.php',	
							data:{sdate1:$('#datepickerStartAss')[0].value, edate1:$('#datepickerEndAss')[0].value+" 23:59:60",oname1:$("#chartSelector option:selected").val()},
							success:function(html){
								var htmlTable = html.split("//RECORD//");
								$("#tableForOprtr").html("<br/>"+htmlTable[0]);
								$("#tableValuesForExcel").html("<br/>"+htmlTable[1]);
							}
					});	
		}
		
		function exportToExcel(){
			//var htmltable= document.getElementById('tableForOprtr');
			//var html = htmltable.outerHTML;
			//window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
			//var htmltable= document.getElementById('tableValuesForExcel');
			//var html = htmltable.outerHTML;
			//window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
			download_csv("tableForOprtr","Analysis"); //export_table_to_csv($("#tableForOprtr >tbody > tr"), "Analysis.csv");
		}
		function exportToExc(){
			//var htmltable= document.getElementById('getOTDtable');
			//var html = htmltable.outerHTML;
			//window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
			download_csv("getOTDtable","OTD Analysis"); //export_table_to_csv($("#getOTDtable > tbody > tr"), "OTD Analysis.csv");
		}
	
	
//filter team name by entering search values
function searchByTeam() {
    var input, filter, table, tr, td, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("jmsDisp");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function displayChart() {
    modal = document.getElementById('myModaltoAssign1');
    modal.style.display = "block";
	$( "#datepickerStart" ).datepicker({dateFormat: "d/MM/yy"});
	$('#datepickerStart').datepicker().datepicker('setDate', new Date());

	$( "#datepickerEnd" ).datepicker({dateFormat: "d/MM/yy"});
	$('#datepickerEnd').datepicker().datepicker('setDate', new Date());chartingFn();
	
	$( "#datepickerStartAss" ).datepicker({dateFormat: "d/MM/yy"});
	$('#datepickerStartAss').datepicker().datepicker('setDate', new Date());

	$( "#datepickerEndAss" ).datepicker({dateFormat: "d/MM/yy"});
	$('#datepickerEndAss').datepicker().datepicker('setDate', new Date());//chartingFn();
}

//on click of the file name listed
function displayPopuptoAssign(events,ret) {
	//loggedInOperator();
	if(ret.previousSibling.previousSibling.innerText!='CARTOONS'){
	if(events.srcElement.localName!='span'){
	forQC="No";
	var lens = ret.nextElementSibling.nextElementSibling.nextElementSibling.children[0];
	if(!lens.length){
	lens = 	ret.nextElementSibling.nextElementSibling.nextElementSibling.children;
	}
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
		modal = document.getElementById('myModaltoAssign');
		sibli = ret.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling;
		modal.style.display = "block";
		retFileName = ret;
		//get the operator who are all logged in
		//loggedInOperator();
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
	else{
		var lens = ret.nextElementSibling.nextElementSibling.children[0];
		if(!lens.length){
			lens = 	ret.nextElementSibling.nextElementSibling.children;
		}
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
		mulArgs ="single"; carttonAss ='yes';
			modal = document.getElementById('myModaltoAssign');
			sibli = ret.nextElementSibling.nextElementSibling.nextElementSibling;
			modal.style.display = "block";
			retFileName = ret;
			//get the operator who are all logged in
			//loggedInOperator();
		}
		else{
			alert("Please select the complexity of the file to assign.");
		}
	}
}


var carttonAss;
function getSelectionText(){
    var selectedText = "";
    if (window.getSelection){ // all modern browsers and IE9+
        selectedText = window.getSelection().toString();
    }
    return selectedText;
}


		function checkAllfiles(){
			var c1 = $("#jmsDisp >tbody>tr>td>input");
			var c2 = trlen2[0].children[0].children[0].checked;
			//c2?$("#centreTextB")[0].style.display="block":$("#centreTextB")[0].style.display="none";
			var c3 = $("#jmsDisp")[0].children[0].children[0].children[0].children[0].checked;
			for (var i = 0; i < c1.length; i++) {
				if ( c2== true || c3 ==true){
					c1[i].checked = true;
				}
				else{
					c1[i].checked = false;
				}
			}
			if($("#jmsDisp >tbody>tr>td>input:checked").length>0){ 
			$("#multAsgnBut")[0].disabled = false;
			}
			else{
				$("#multAsgnBut")[0].disabled = true;
			}
		}
		function multipleFileAssign1(){			
			modal = document.getElementById('myModaltoAssign');
			modal.style.display = "block";
			loggedInOperator();
			mulArgs="multiple";
		}
		function deselectchkbox(){
			multiChkDisplayed="no";
			$("#dispchkbox")[0].style.display = "block";
			$("#hidechkbox")[0].style.display = "none";
			var bv = $("#jmsDisp >tbody>tr>td>input.multiChkBody");
			$(".multiChkBody").prop("style", "display:none;");
			$(".multiChkHead").prop("style", "display:none;");
			$("fieldset").prop("disabled", false);
		}
		function multipleFileAssign(){
			multiChkDisplayed="yes";
			$("#dispchkbox")[0].style.display = "none";
			$("#hidechkbox")[0].style.display = "block";
			var bv = $("#jmsDisp >tbody>tr>td>input.multiChkBody");
			$(".multiChkBody").prop("style", "display:block;");
			$("input[type=checkbox]").prop("style","margin: 1px 1px -17px -3px;");
			$( "input[class='multiChkBody']" ).change(function(exece) {
				if($( ".multiChkBody:checked" ).length>0){
					$("#multAsgnBut")[0].disabled = false;mulArgs="multiple";
					$("fieldset").prop("disabled", true);
				}
				else{
					$("#multAsgnBut")[0].disabled = true;
					$("fieldset").prop("disabled", false);
					}
			});
		}
			
		//function to get logged in operators
		function loggedInOperator(){
						//get the operator who are all logged in
				$.ajax({
					type:'POST',
					url:$('.base').val()+"public/Reports/vars1.php",	
					data:{pars:"parsing"},
					success:function(html){
						if(forQC!="yes"){
							$("#OperatorSelectCore").empty().append('<option value="" style="background-color:white;color:Black">Select Operator</option>');
							$("#OperatorSelectAux").empty().append('<option value="" style="background-color:white;color:Black">Select Operator</option>');
						  var c = html.split("/FREAK/");
						  $("#OperatorSelectCore >option").after(c[0]);
						  $("#OperatorSelectAux >option").after(c[1]);
						  operatorlist = c[2];
						}
						else{
							$("#OperatorSelectCoreQC").empty().append('<option value="" style="background-color:white;color:Black">Select Operator</option>');
							$("#OperatorSelectAuxQC").empty().append('<option value="" style="background-color:white;color:Black">Select Operator</option>');
						  var c = html.split("/FREAK/");
						  $("#OperatorSelectCoreQC >option").after(c[0]);
						  $("#OperatorSelectAuxQC >option").after(c[1]);
						  operatorlist = c[2];
						  forQC="";
						}
						if(forQC=="dash"){
							totalDmgEmp = html.split("/FREAK/")[2];
							totalDmgEmp = totalDmgEmp.split(",");
							var totalDmgEmp1="";
							for(var a=0;a<totalDmgEmp.length;a++){
								if(totalDmgEmp[a]!==""){
									totalDmgEmp1=totalDmgEmp1+"<div onclick='opInfo(this);' style='color: darkblue;font-weight: 500; cursor:pointer;text-decoration: underline;'><img src='img/user.png' style='width10px;height:10px;' />"+totalDmgEmp[a]+"</div>"
								}
							}
							$("#dmgEmpList").html(totalDmgEmp1);
						}
					}
				});	
		}
		
function opInfo(retthis){
	var modal = document.getElementById('myModaltoOperatorInfo');
    modal.style.display = "block";
	var dataOp = (retthis.innerText).split(" -")[0];
	$.ajax({
		type:'POST',
		url:'opInfo.php',	
		data:{Op_Name:dataOp.split(" ")[0],Op_FullName:dataOp},
		success:function(html){
			$("#OpHist").html("<h4 style='color: gray;'>"+dataOp+"'s Acheivements:</h4>"+html);
		}
	});
	//alert(retthis.innerText);
}
		var operatorlist;

function closeModal4(){
	modal = document.getElementById('myModalMonthlyInfo');
    modal.style.display = "none";
}
function closeModal3() {
    modal = document.getElementById('myModaltoOperatorInfo');
    modal.style.display = "none";
}
function closeModal() {
    modal = document.getElementById('myModaltoAssign');
    modal.style.display = "none";
	dateChanged="no";
	if(trToInsert){
		$('#jmsDisp')[0].children[1].innerHTML =  trToInsert + "" +$('#jmsDisp')[0].children[1].innerHTML;
		trToInsert='';
	}
}
function closeModal1() {
	$("#datepickerStart")[0].value="";
	$("#datepickerEnd")[0].value="";
    modal = document.getElementById('myModaltoAssign1');
    modal.style.display = "none";
	$("#myChartID")[0].style.display="none";
	dateChanged="no"
}
function closeModal2() {
    modal = document.getElementById('myModaltoAssignQC');
    modal.style.display = "none";
}
function closeModalcart1(){
    modal = document.getElementById('Modaltocart');
    modal.style.display = "none";
	
}
function reloadimage(img){
	var filename = (img.parentElement.nextElementSibling.innerText).replace(/(\n)/gm,"");
	img.src = "img/dmg/"+filename;//	$("#"+img.id)[0].src = "http://10.98.2.46:81/FinalCopy/img/dmg/"+filename; //http://10.98.2.46:81/FinalCopy/
	//img.currentSrc = "img/dmg/cc";//+filename;
}
function returnHtml(c){
	var tdlen = $('#jmsDisp tbody tr td.disableTd') ;
	var totalName=c[8].split(",");
	if(totalName.length>1){
		for(si=0;si<totalName.length;si++){
			for(sj=0;sj<tdlen.length;sj++){
				if(totalName[si]==(tdlen[sj].innerText).replace(/(\n)/gm,"")){
					//tdlen[sj].previousElementSibling.childNodes[0].src='img/dmg/'+(tdlen[sj].innerText).replace(/(\n)/gm,"");//to set the image
					var src = tdlen[sj].previousElementSibling.childNodes[0];
					src.outerHTML="<img class='zoomImage' style='width:"+src.style.width+";height:"+src.style.height+";' src='img/dmg/"+(tdlen[sj].innerText).replace(/(\n)/gm,"") +"' onclick='reloadimage(this);' title='Click to reload'>";
				}
			}
			
		}
	}		
		var tdlenAss1 = $('#jmsDispAssigned tbody tr') ; var tdlenAs = $('#jmsDisp tbody tr') ;
		var totalNameAssigned=c[10].split(",");
		var totalNameAssignedNames=c[11].split(",");
		var totalNameAssignedCompx=c[12].split(",");
		
		for(as=0;as<totalNameAssigned.length;as++){
			for(tr=0;tr<tdlen.length;tr++){
				if(totalNameAssigned[as]==(tdlen[tr].innerText).replace(/(\n)/gm,"")){
				if(tdlenAss1[0].innerText=="No data available in table"){
					$('#jmsDispAssigned tbody')[0].innerHTML=tdlenAs[tr].innerHTML;
				}
				else{
					for(jj=0;jj<tdlenAss1.length;jj++){
						if((tdlenAss1[jj].children[4].innerText).replace(/(\n)/gm,"")==(tdlen[tr].innerText).replace(/(\n)/gm,"")){
							break;
						}
						else{
							var comp= totalNameAssignedCompx[as];
							var toMerge =tdlenAs[tr].outerHTML.replace("Yet to assign</td><td></td>","Assigned</td><td>"+totalNameAssignedNames[as]+"</td>");
							if((toMerge.split("Yet to assign")).length>1){
								toMerge =tdlenAs[tr].outerHTML.replace("Yet to assign</td><td style=\"width: 7%;\"></td>","Assigned</td><td>"+totalNameAssignedNames[as]+"</td>");
							}
								toMerge = toMerge.replace(comp+"\"",comp+"\" checked");	
								//toMerge = toMerge.replace("<span class=\"glyphicon glyphicon-new-window\" style=\"font-size:13px;color: coral;\" title=\"Move to Low Priority\" onclick=\"lowPriorityFiles(this);\"></span>","");
							$('#jmsDispAssigned tbody')[0].innerHTML += toMerge;break;
						}
					}
					
				}
					tdlenAs[tr].remove();
				}
			}
		}
		
		
		var tdlenAss = $('#jmsDispAssigned tbody tr td.disableTd') ;
		
		var avail='no';
		globalVauArrayForComp1=c[6].split("FIRING");
		if(globalVauArrayForComp1[0]){
			for(var i=0;i<globalVauArrayForComp.length;i++){
				for(var j=0;j<globalVauArrayForComp1.length;j++){
					if(globalVauArrayForComp[i]!=''){
						if(globalVauArrayForComp[i]==globalVauArrayForComp1[j]){
							avail='yes';
						}
						if(j==(globalVauArrayForComp1.length-1)){
							if(avail!='yes'){
								for(tr=0;tr<tdlenAss.length;tr++){
									if(globalVauArrayForComp[i]==(tdlenAss[tr].innerText).replace(/(\n)/gm,"")){
										tdlenAss[tr].parentElement.remove();
									}
								}
							}
							avail='no';
						}
					}
				}
			}
		globalVauArrayForComp=c[6].split("FIRING");
		}
		else{
			for(var i=0;i<globalVauArrayForComp.length;i++){
				for(tr=0;tr<tdlenAss.length;tr++){
					if((globalVauArrayForComp[i]).toLowerCase()==((tdlenAss[tr].innerText).replace(/(\n)/gm,"")).toLowerCase()){
						tdlenAss[tr].parentElement.remove();
					}
				}				
			}
			globalVauArrayForComp=[];
		}
		
		// insert code here to remove from jms unassigned queue
		
		var tdlenqueue = $('#jmsDisp tbody tr td.disableTd') ;
		
		var avail='no';
		gbValForComp1=c[6].split("FIRING");
		if(gbValForComp1[0]){
			for(var i=0;i<gbValForComp.length;i++){
				for(var j=0;j<gbValForComp1.length;j++){
					if(gbValForComp[i]!=''){
						if(gbValForComp[i]==gbValForComp1[j]){
							avail='yes';
						}
						if(j==(gbValForComp1.length-1)){
							if(avail!='yes'){
								for(tr=0;tr<tdlenqueue.length;tr++){
									if(gbValForComp[i]==(tdlenqueue[tr].innerText).replace(/(\n)/gm,"")){
										tdlenqueue[tr].parentElement.remove();
									}
								}
							}
							avail='no';
						}
					}
				}
			}
		gbValForComp=c[6].split("FIRING");
		}
		else{
			for(var i=0;i<gbValForComp.length;i++){
				for(tr=0;tr<tdlenqueue.length;tr++){
					if((gbValForComp[i]).toLowerCase()==((tdlenqueue[tr].innerText).replace(/(\n)/gm,"")).toLowerCase()){
						tdlenqueue[tr].parentElement.remove();
					}
				}				
			}
			gbValForComp=[];
		}
		
		
		
		//code for updating rows where the file status is In QC
		var carray1 = c[4].split("FIRING");
		for(i=1;i<carray1.length;i++){
			for(j=0;j<tdlen.length;j++){
				if(carray1[i]==(tdlen[j].innerText).replace(/(\n)/gm,"")){//&& tdlen[j].nextElementSibling.nextElementSibling.nextElementSibling.innerHTML=="Assigned"
					tdlen[j].nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML="Need QC"
					//var c = carray1;
				}
			}
		}
		//code for updating rows where the file status has Handovers
		var carray2 = c[5].split("FIRING");
		for(i=1;i<carray2.length;i++){
			for(j=0;j<tdlen.length;j++){
				if(carray2[i]){
					var carray3 = carray2[i].split("//");
					if(carray3[0]==(tdlen[j].innerText).replace(/(\n)/gm,"")){
						tdlen[j].nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML=carray3[1];
						//var c = carray1;
					}
				}
			}
		}
}
var globalVauArrayForComp=[];
function multForceQuit(){	
	var lenmulti=$( ".multiChkBody:checked" ).length;
	if(lenmulti>=1){
		if(confirm("Are you sure you want to close the job?")){	
			for(m=0;m<lenmulti;m++){
				if($( ".multiChkBody:checked" )[m]){
					var setHtm = ($( ".multiChkBody:checked" )[m].parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerText).replace('\n','');
					$( ".multiChkBody:checked" )[m].parentElement.parentElement.remove();
				}
				else{
					var setHtm = ($( ".multiChkBody:checked" )[0].parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.innerText).replace('\n','');
					$( ".multiChkBody:checked" )[0].parentElement.parentElement.remove();
				}
				$.ajax({
					type:'POST',
					url:'vars9.php',	
					data:{File_Name:setHtm},
					success:function(html){
						var c =html;m--;
						if(m==0){
							alert("Job Removed");
						}
					}
				});
			}
			//
		}
		else{}			
	}
	else{
		alert("Please choose some jobs to multi-ForceQuit.");
	}	
}

function download_csv(tableID, filename) {
	
            var uri = 'data:application/vnd.ms-excel;base64,'
                , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
                , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
                , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
                var table = document.getElementById(tableID);
                var ctx = { worksheet: filename || 'Worksheet', table: table.innerHTML }
                var blob = new Blob([format(template, ctx)]);
                var blobURL = window.URL.createObjectURL(blob);
				//window.location.download = "filename.xls";
                //window.location.href = uri + base64(format(template, ctx));
				 var link = document.createElement("a");
                    link.download = filename;
                    link.href = uri + base64(format(template, ctx));
                    link.click();
				
	/*
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv",cellStyles: true});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
	*/
}

function export_table_to_csv(rows, filename) {
	var csv = [];
	//var rows = ;
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV
    download_csv(csv.join("\n"), filename);
}
		
function loadClose(){
	$("#loaders")[0].style.display="none";
}

function loadOpen(){
	$("#loaders")[0].style.display="block";
}

//14/03/2018 Sharmila starts - for custom alert
function customalerting(alTitle,alText){
	
var ALERT_TITLE = "Oops!";
var ALERT_BUTTON_TEXT = "Ok";
if(document.getElementById) {
	window.alert = function(ALERT_TITLE) {
		createCustomAlert(ALERT_TITLE);
	}
}	
}


function createCustomAlert(txt) {	
	d = document;

	if(d.getElementById("modalingContainer")) return;

	mObj = d.getElementsByTagName("body")[0].appendChild(d.createElement("div"));
	mObj.id = "modalingContainer";
	mObj.style.height = d.documentElement.scrollHeight + "px";
	
	alertObj = mObj.appendChild(d.createElement("div"));
	alertObj.id = "alertBox";
	if(d.all && !window.opera) alertObj.style.top = document.documentElement.scrollTop + "px";
	alertObj.style.left = (d.documentElement.scrollWidth - alertObj.offsetWidth)/2 + "px";
	alertObj.style.visiblity="visible";

	h1 = alertObj.appendChild(d.createElement("h1"));
	h1.appendChild(d.createTextNode(ALERT_TITLE));

	msg = alertObj.appendChild(d.createElement("p"));
	//msg.appendChild(d.createTextNode(txt));
	msg.innerHTML = txt;

	btn = alertObj.appendChild(d.createElement("a"));
	btn.id = "closeBtn";
	btn.appendChild(d.createTextNode(ALERT_BUTTON_TEXT));
	btn.href = "#";
	btn.focus();
	btn.onclick = function() { removeCustomAlert();return false; }

	alertObj.style.display = "block";
	
}

function removeCustomAlert() {
	document.getElementsByTagName("body")[0].removeChild(document.getElementById("modalingContainer"));
}
function ful(){
alert('Alert this pages');
}




//14/03/2018 Sharmila ends - for custom alert