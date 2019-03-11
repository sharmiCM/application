<?PHP
			$con = mysqli_connect('127.0.0.1', 'root', 'ppisAdmin@123','new');
			$fArr = array();
			$fArr1 = array();
			$i=0;$j=0;
			$opTagDMG = "";$opTagothers = "";$opTagDMG1="";$opTagDMG2="";
			$selectOp= "SELECT * FROM `teams`";
			$ress=mysqli_query($con,$selectOp)or die(mysqli_error());	
			//$norri = mysqli_num_rows($ress);
			while ($ru=mysqli_fetch_assoc($ress)){
				if($ru['value'] && $ru['value']!='Select Team'){
				$opTagDMG = $opTagDMG."<option name='".$ru['value']."' value='".$ru['Team_id']."' style='background-color:white;color:Black;'>".$ru['value']."</option>";
				}
				
			}
			echo $opTagDMG;

	mysqli_close($con);				  
		?>