<?PHP
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	//$filNames = $_POST['File_Names'];
	$selOps= "SELECT Complexity,Publisher, Magazine FROM `storejms` where Received_Date='".date("d/F/Y")."'";
	$resus=mysqli_query($con,$selOps)or die(mysqli_error());
	$nori2 = mysqli_num_rows($resus);
	$count1=0;$count2=0;$count3=0;$count4=0;$count5=0;$count6=0;$count7=0;$count8=0;$count9=0;$count10=0;$count11=0;$count12=0;$count13=0;$count14=0;$count15=0;$count16=0;$count17=0;
	
	$counta1=0;$counta2=0;$counta3=0;$counta4=0; $countb1=0;$countb2=0;$countb3=0;$countb4=0; $countc1=0;$countc2=0;$countc3=0;$countc4=0; $countd1=0;$countd2=0;$countd3=0;$countd4=0;
	$counte1=0;$counte2=0;$counte3=0;$counte4=0; $countf1=0;$countf2=0;$countf3=0;$countf4=0; $countg1=0;$countg2=0;$countg3=0;$countg4=0; $counth1=0;$counth2=0;$counth3=0;$counth4=0; 
	$counti1=0;$counti2=0;$counti3=0;$counti4=0; $countj1=0;$countj2=0;$countj3=0;$countj4=0; $countk1=0;$countk2=0;$countk3=0;$countk4=0; $countl1=0;$countl2=0;$countl3=0;$countl4=0; 
	$countm1=0;$countm2=0;$countm3=0;$countm4=0; $countn1=0;$countn2=0;$countn3=0;$countn4=0; $counto1=0;$counto2=0;$counto3=0;$counto4=0; $countp1=0;$countp2=0;$countp3=0;$countp4=0;
	
	$s1=0;$m1=0;$c1=0;$s2=0; $m2=0;$c2=0;$s3=0;$m3=0; $c3=0;$s4=0;$m4=0;$c4=0; $s5=0;$m5=0;$c5=0; $s6=0;$m6=0;$c6=0;	$s7=0;$m7=0;$c7=0;$s8=0; $m8=0;$c8=0;$s9=0;$m9=0; $c9=0;$s10=0;$m10=0;$c10=0; $s11=0;$m11=0;$c11=0;	$s12=0;$m12=0;$c12=0;$s13=0; $m13=0;$c13=0;$s14=0;$m14=0; $c14=0;$s15=0;$m15=0;$c15=0; $s16=0;$m16=0;$c16=0;
	$NewsPaperCount=0;
	$MagazineCount=0;
	$opTagDMG1 ="<table style='border:1px solid black; width:100%;height:100%;'><tr style='background-color: #A5A4AF;'><th style='border:1px solid black;'>Publisher</th><th style='border:1px solid black;'>Count</th><th style='border:1px solid black;'>Simple</th><th style='border:1px solid black;'>Medium</th><th style='border:1px solid black;'>Complex</th><th style='border:1px solid black;'>-C-</th><th style='border:1px solid black;'>-RC-</th><th style='border:1px solid black;'>-E-</th><th style='border:1px solid black;'>-RE-</th><th style='border:1px solid black;'>%</th></tr>";
	while ($rus=mysqli_fetch_assoc($resus)){
		if($rus['Publisher'] =='Newspaper'){
			$NewsPaperCount = $NewsPaperCount+1;
		}
		else{
			$MagazineCount = $MagazineCount+1;
		}
		$Mag1 = preg_split("/-/",$rus['Magazine'])[1];
		$rus['Magazine'] = preg_split("/-/",$rus['Magazine'])[0];
$co = $rus['Complexity'];		

		if($rus['Magazine'] =='ESNEWS'){$count1++; if($Mag1=='C'){$counta1++;}if($Mag1=='RC'){$counta2++;}if($Mag1=='E'){$counta3++;}if($Mag1=='RE'){$counta4++;} if($co =='Complex'){$c1++;} else if($co =='Medium'){$m1++;}else{$s1++;}}
		else if($rus['Magazine'] =='METNEWS'){$count2++; if($Mag1=='C'){$countb1++;}if($Mag1=='RC'){$countb2++;}if($Mag1=='E'){$countb3++;}if($Mag1=='RE'){$countb4++;} if($co =='Complex'){$c2++;} else if($co =='Medium'){$m2++;}else{$s2++;}}
		else if($rus['Magazine'] =='DMNEWS'){$count3++; if($Mag1=='C'){$countc1++;}if($Mag1=='RC'){$countc2++;}if($Mag1=='E'){$countc3++;}if($Mag1=='RE'){$countc4++;} if($co =='Complex'){$c3++;} else if($co =='Medium'){$m3++;}else{$s3++;}}
		else if($rus['Magazine'] =='IPLNEWS'){$count4++; if($Mag1=='C'){$countd1++;}if($Mag1=='RC'){$countd2++;}if($Mag1=='E'){$countd3++;}if($Mag1=='RE'){$countd4++;}if($co =='Complex'){$c4++;} else if($co =='Medium'){$m4++;}else{$s4++;}}
		else if($rus['Magazine'] =='MOSNEWS'){$count5++; if($Mag1=='C'){$counte1++;}if($Mag1=='RC'){$counte2++;}if($Mag1=='E'){$counte3++;}if($Mag1=='RE'){$counte4++;}if($co =='Complex'){$c5++;} else if($co =='Medium'){$m5++;}else{$s5++;}}
		else if($rus['Magazine'] =='METDUB'){$count6++; if($Mag1=='C'){$countf1++;}if($Mag1=='RC'){$countf2++;}if($Mag1=='E'){$countf3++;}if($Mag1=='RE'){$countf4++;}if($co =='Complex'){$c6++;} else if($co =='Medium'){$m6++;}else{$s6++;}}
		else if($rus['Magazine'] =='ESHP'){$count7++; if($Mag1=='C'){$countg1++;}if($Mag1=='RC'){$countg2++;}if($Mag1=='E'){$countg3++;}if($Mag1=='RE'){$countg4++;}if($co =='Complex'){$c7++;} else if($co =='Medium'){$m7++;}else{$s7++;}}
		else if($rus['Magazine'] =='JPI'){$count8++; if($Mag1=='C'){$counth1++;}if($Mag1=='RC'){$counth2++;}if($Mag1=='E'){$counth3++;}if($Mag1=='RE'){$counth4++;}if($co =='Complex'){$c8++;} else if($co =='Medium'){$m8++;}else{$s8++;}}
		else if($rus['Magazine'] =='IOS'){$count9++; if($Mag1=='C'){$counti1++;}if($Mag1=='RC'){$counti2++;}if($Mag1=='E'){$counti3++;}if($Mag1=='RE'){$counti4++;}if($co =='Complex'){$c9++;} else if($co =='Medium'){$m9++;}else{$s9++;}}
		else if($rus['Magazine'] =='IDMNEWS'){$count10++; if($Mag1=='C'){$countj1++;}if($Mag1=='RC'){$countj2++;}if($Mag1=='E'){$countj3++;}if($Mag1=='RE'){$countj4++;}if($co =='Complex'){$c10++;} else if($co =='Medium'){$m10++;}else{$s10++;}}
		else if($rus['Magazine'] =='IOSNEWS'){$count11++; if($Mag1=='C'){$countk1++;}if($Mag1=='RC'){$countk2++;}if($Mag1=='E'){$countk3++;}if($Mag1=='RE'){$countk4++;}if($co =='Complex'){$c11++;} else if($co =='Medium'){$m11++;}else{$s11++;}}
		else if($rus['Magazine'] =='TVWEEK'){$count12++; if($Mag1=='C'){$countl1++;}if($Mag1=='RC'){$countl2++;}if($Mag1=='E'){$countl3++;}if($Mag1=='RE'){$countl4++;}if($co =='Complex'){$c12++;} else if($co =='Medium'){$m12++;}else{$s12++;}}
		else if($rus['Magazine'] =='WKNDMAG'){$count13++; if($Mag1=='C'){$countm1++;}if($Mag1=='RC'){$countm2++;}if($Mag1=='E'){$countm3++;}if($Mag1=='RE'){$countm4++;}if($co =='Complex'){$c13++;} else if($co =='Medium'){$m13++;}else{$s13++;}}
		else if($rus['Magazine'] =='EVENT'){$count14++; if($Mag1=='C'){$countn1++;}if($Mag1=='RC'){$countn2++;}if($Mag1=='E'){$countn3++;}if($Mag1=='RE'){$countn4++;}if($co =='Complex'){$c14++;} else if($co =='Medium'){$m14++;}else{$s14++;}}
		else if($rus['Magazine'] =='YOUMAG'){$count15++; if($Mag1=='C'){$counto1++;}if($Mag1=='RC'){$counto2++;}if($Mag1=='E'){$counto3++;}if($Mag1=='RE'){$counto4++;}if($co =='Complex'){$c15++;} else if($co =='Medium'){$m15++;}else{$s15++;}}
		else if($rus['Magazine'] =='ESMAG'){$count16++; if($Mag1=='C'){$countp1++;}if($Mag1=='RC'){$countp2++;}if($Mag1=='E'){$countp3++;}if($Mag1=='RE'){$countp4++;}if($co =='Complex'){$c16++;} else if($co =='Medium'){$m16++;}else{$s16++;}}
		else{$count17++;}
	}
	if($nori2){$percent = round(($count1*100/$nori2),1);}else{$percent=0;} if($s1==0){$s1="";}if($m1==0){$m1="";}if($c1==0){$c1="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>ESNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count1."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s1."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m1."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counta1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counta2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counta3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counta4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count2*100/$nori2),1);}else{$percent=0;} if($s2==0){$s2="";}if($m2==0){$m2="";}if($c2==0){$c2="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>METNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count2."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s2."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m2."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countb1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countb2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countb3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countb4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count3*100/$nori2),1);}else{$percent=0;} if($s3==0){$s3="";}if($m3==0){$m3="";}if($c3==0){$c3="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>DMNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count3."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s3."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m3."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countc1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countc2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countc3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countc4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count4*100/$nori2),1);}else{$percent=0;}	 if($s4==0){$s4="";}if($m4==0){$m4="";}if($c4==0){$c4="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>IPLNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c4."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countd1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countd2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countd3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countd4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
if($nori2){$percent = round(($count5*100/$nori2),1);}else{$percent=0;}	 if($s5==0){$s5="";}if($m5==0){$m5="";}if($c5==0){$c5="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>MOSNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count5."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s5."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m5."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c5."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counte1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counte2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counte3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counte4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
if($nori2){$percent = round(($count6*100/$nori2),1);}else{$percent=0;} if($s6==0){$s6="";}if($m6==0){$m6="";}if($c6==0){$c6="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>METDUB</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count6."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s6."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m6."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c6."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countf1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countf2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countf3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countf4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count7*100/$nori2),1);}else{$percent=0;}	 if($s7==0){$s7="";}if($m7==0){$m7="";}if($c7==0){$c7="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>ESHP</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count7."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s7."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m7."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c7."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countg1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countg2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countg3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countg4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
if($nori2){$percent = round(($count8*100/$nori2),1);}else{$percent=0;} if($s8==0){$s8="";}if($m8==0){$m8="";}if($c8==0){$c8="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>JPI</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count8."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s8."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m8."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c8."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counth1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counth2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counth3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counth4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count9*100/$nori2),1);}else{$percent=0;} if($s9==0){$s9="";}if($m9==0){$m9="";}if($c9==0){$c9="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>IOS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count9."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s9."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m9."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c9."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counti1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counti2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counti3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counti4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
if($nori2){$percent = round(($count10*100/$nori2),1);}else{$percent=0;}	 if($s10==0){$s10="";}if($m10==0){$m10="";}if($c10==0){$c10="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>IDMNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count10."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s10."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m10."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c10."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countj1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countj2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countj3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countj4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count11*100/$nori2),1);}else{$percent=0;} if($s11==0){$s11="";}if($m11==0){$m11="";}if($c11==0){$c11="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>IOSNEWS</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count11."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s11."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m11."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c11."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countk1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countk2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countk3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countk4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count12*100/$nori2),1);}else{$percent=0;} if($s12==0){$s12="";}if($m12==0){$m12="";}if($c12==0){$c12="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>TVWEEK</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count12."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s12."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m12."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c12."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countl1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countl2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countl3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countl4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count13*100/$nori2),1);}else{$percent=0;} if($s13==0){$s13="";}if($m13==0){$m13="";}if($c13==0){$c13="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>WKNDMAG</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count13."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s13."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m13."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c13."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countm1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countm2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countm3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countm4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count14*100/$nori2),1);}else{$percent=0;} if($s14==0){$s14="";}if($m14==0){$m14="";}if($c14==0){$c14="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>EVENT</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count14."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s14."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m14."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c14."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countn1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countn2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countn3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countn4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	
if($nori2){$percent = round(($count15*100/$nori2),1);}else{$percent=0;} if($s15==0){$s15="";}if($m15==0){$m15="";}if($c15==0){$c15="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>YOUMAG</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count15."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s15."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m15."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c15."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counto1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counto2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counto3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$counto4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
if($nori2){$percent = round(($count16*100/$nori2),1);}else{$percent=0;}	 if($s16==0){$s16="";}if($m16==0){$m16="";}if($c16==0){$c16="";}
$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>ESMAG</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$count16."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$s16."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$m16."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$c16."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countp1."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countp2."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countp3."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$countp4."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";	

$count_c = $counta1+$countb1+ $countc1+$countd1+$counte1+ $countf1+ $countg1+$counth1+$counti1+ $countj1+$countk1+ $countl1+$countm1+$countn1+$counto1+ $countp1;
$count_rc = $counta2+$countb2+ $countc2+$countd2+$counte2+ $countf2+ $countg2+$counth2+$counti2+ $countj2+$countk2+ $countl2+$countm2+$countn2+$counto2+ $countp2;
$count_e = $counta3+$countb3+ $countc3+$countd3+$counte3+ $countf3+ $countg3+$counth3+$counti3+ $countj3+$countk3+ $countl3+$countm3+$countn3+$counto3+ $countp3;
$count_re = $counta4+$countb4+ $countc4+$countd4+$counte4+ $countf4+ $countg4+$counth4+$counti4+ $countj4+$countk4+ $countl4+$countm4+$countn4+$counto4+ $countp4;

if($nori2){$percent = round(($NewsPaperCount*100/$nori2),1);}else{$percent=0;}

	$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>Newspaper</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$NewsPaperCount."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td></td><td></td><td></td><td></td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
	
if($nori2){$percent = round(($MagazineCount*100/$nori2),1);}else{$percent=0;}	
	$opTagDMG1 =$opTagDMG1. "<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>Magazine</td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$MagazineCount."</td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td style='border:1px solid black;line-height: 20px;text-align: center;'></td><td></td><td></td><td></td><td></td><td style='border:1px solid black;line-height: 20px;text-align: center;'>".$percent."</td></tr>";
	
	$opTagDMG1=$opTagDMG1."<tr style='color:#2D2D44;'><td style='border:1px solid black;text-align: left;'>Total</td><td style='text-align: center;'>".$nori2."</td><td></td><td></td><td></td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$count_c."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$count_rc."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$count_e."</td><td  style='border:1px solid black;line-height: 20px;text-align: center;'>".$count_re."</td><td></td><td></td></tr></table>";
	echo $opTagDMG1;
?>






