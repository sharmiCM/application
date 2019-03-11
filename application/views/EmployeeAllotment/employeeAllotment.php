<?PHP
include __DIR__ . "/../header.php";
	error_reporting(0); 
	//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
	?>
	<script>
	$(document).ready(function () {
$(document).on('click','.e_teaa',function(){
	var pas33 = (this.id);
		var p55=pas33.split("-");
		var idno5=p55[1];		
	 $('#Firstname-'+idno5).show();
	 $('#Lastname-'+idno5).show();
	 $('#AutoID-'+idno5).show();
	 $('#JoiningDate-'+idno5).show();
	 $('#EmployeeID-'+idno5).show();
	 $('#TeamName-'+idno5).show();
	 $('#Designation-'+idno5).show();
	 $('#user_level-'+idno5).show();
	 $('#SkypeID-'+idno5).show();
	 $('#ProadId-'+idno5).show();
	 $('#u_teaa-'+idno5).show();
	 
	});
});

$(document).ready(function () {
$(document).on('click','.c_teaa',function(){
	var pas33 = (this.id);
		var p55=pas33.split("-");
		var idno5=p55[1];		
	
	 $('#Firstname-'+idno5).hide();
	 $('#Lastname-'+idno5).hide();
	 $('#AutoID-'+idno5).hide();
	 $('#JoiningDate-'+idno5).hide();
	 $('#EmployeeID-'+idno5).hide();
	 $('#TeamName-'+idno5).hide();
	 $('#Designation-'+idno5).hide();
	 $('#user_level-'+idno5).hide();
	 $('#SkypeID-'+idno5).hide();
	 $('#ProadId-'+idno5).hide();
	 $('#u_teaa-'+idno5).hide();
	 
	 
	});
});
$(document).ready(function () {
$(document).on('click','.u_teaa',function(){
	var pas33 = (this.id);
var p55=pas33.split("-");
		var idno5=p55[1];	
		
	var Firstname =	$('#Firstname-'+idno5).val();
	var Lastname = $('#Lastname-'+idno5).val();
	var AutoID = $('#AutoID-'+idno5).val();
	var JoiningDate = $('#JoiningDate-'+idno5).val();
	var EmployeeID = $('#EmployeeID-'+idno5).val();
	var TeamName = $('#TeamName-'+idno5).val();
	var Designation = $('#Designation-'+idno5).val();
	var user_level = $('#user_level-'+idno5).val();
	var SkypeID = $('#SkypeID-'+idno5).val();
	var ProadId = $('#ProadId-'+idno5).val();
	
		//alert(TeamName);
        if(AutoID){
		
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>public/EmpAllotment/Update_log.php",
                data:{'AutoID': AutoID,
				'Firstname':Firstname,
				'Lastname':Lastname,
				'JoiningDate':JoiningDate,
				'EmployeeID':EmployeeID,
				'TeamName':TeamName,
				'Designation':Designation,
				'user_level':user_level,
				'SkypeID':SkypeID,
				'ProadId':ProadId,
				},
                success:function(html){
                   
					//alert(html);	
                }
            }); 
        }else{
            $('#Shift').html('<option value="">Select Name first</option>'); 
        }
    });
	});
	

	$(document).ready(function () {
$(document).on('click','.I_teaa',function(){
	var pas33 = (this.id);
var p55=pas33.split("-");
		var idno5=p55[1];	
		
	var Firstname_I =	$('#Firstname_I-'+idno5).val();
	var Lastname_I = $('#Lastname_I-'+idno5).val();
	//var AutoID_I = $('#AutoID_I-'+idno5).val();
	var JoiningDate_I = $('#JoiningDate_I-'+idno5).val();
	var EmployeeID_I = $('#EmployeeID_I-'+idno5).val();
	var TeamName_I = $('#TeamName_I-'+idno5).val();
	var Designation_I = $('#Designation_I-'+idno5).val();
	var user_level_I = $('#user_level_I-'+idno5).val();
	var SkypeID_I = $('#SkypeID_I-'+idno5).val();
	var ProadId_I = $('#ProadId_I-'+idno5).val();
	var Gender_I = $('#Gender_I-'+idno5).val();
	var Mobileno_I = $('#Mobileno_I-'+idno5).val();
	var Address_I = $('#Address_I-'+idno5).val();
	var password_I = $('#password_I-'+idno5).val();
	var UserLogin_I = $('#UserLogin_I-'+idno5).val();
	var Department_I = $('#Department_I-'+idno5).val();
	var EmailID_I = $('#EmailID_I-'+idno5).val();
	
		//alert(TeamName);
        if(Firstname_I){
		
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>public/EmpAllotment/Update_log.php",
                data:{
				'Firstname_I':Firstname_I,
				'Lastname_I':Lastname_I,
				'JoiningDate_I':JoiningDate_I,
				'EmployeeID_I':EmployeeID_I,
				'TeamName_I':TeamName_I,
				'Designation_I':Designation_I,
				'user_level_I':user_level_I,
				'SkypeID_I':SkypeID_I,
				'ProadId_I':ProadId_I,
				'Gender_I':Gender_I,
				'Mobileno_I':Mobileno_I,
				'Address_I':Address_I,
				'password_I':password_I,
				'UserLogin_I':UserLogin_I,
				'Department_I':Department_I,
				'EmailID_I':EmailID_I,
				},
                success:function(html){
                   
					alert(html);	
                }
            }); 
        }else{
            $('#Shift').html('<option value="">Select Name first</option>'); 
        }
    });
	});

	</script>
	<section id="main-content">
        <section class="wrapper">
		<input type="hidden" class="base" value="<?php echo base_url(); ?>">
		<table class="table table-fixed table-hover table-striped table-bordered table-responsive sortable">
	<thead>
<tr>

<th>First name</th>
<th>Last name</th>
<th>Joining Date</th>
<th>Gender</th>
<th>Mobileno</th>
<th>Address</th>
<th>Proad ID</th>
<th>EmployeeID</th>
<th>password</th>
<th>UserLogin</th>
<th>Department</th>
<th>Team Name</th>
<th>Designation</th>
<th>EmailID</th>
<th>SkypeID</th>
<th>User level</th>
</tr>
</thead>
<tbody>
<tr>

<td><input type="text" name="Firstname" id="Firstname_I-<?PHP echo $j; ?>" class="form-control" ></td>
<td><input type="text" name="Lastname" id="Lastname_I-<?PHP echo $j; ?>" class="form-control"></td>
<td><input type="date" name="JoiningDate" id="JoiningDate_I-<?PHP echo $j; ?>" class="form-control"></td>
<td><select name="Gender" id="Gender_I-<?PHP echo $j; ?>" class="form-control">
<option>Male</option>
<option>Female</option>
</select></td>
<td><input type="text" name="Mobileno" id="Mobileno_I-<?PHP echo $j; ?>" class="form-control"></td>
<td><textarea  name="Address" id="Address_I-<?PHP echo $j; ?>" class="form-control"></textarea></td>
<td><input type="text" name="ProadId" id="ProadId_I-<?PHP echo $j; ?>" class="form-control" ></td>
<td><input type="text" name="EmployeeID" id="EmployeeID_I-<?PHP echo $j; ?>" class="form-control" ></td>
<td><input type="text" name="password" id="password_I-<?PHP echo $j; ?>" class="form-control" value="Born1234!" readonly></td>
<td><input type="text" name="UserLogin" id="UserLogin_I-<?PHP echo $j; ?>" class="form-control" ></td>
<td><input type="text" name="Department" id="Department_I-<?PHP echo $j; ?>" class="form-control" value="Premedia" readonly></td>
<td><select name="TeamName" id="TeamName_I-<?PHP echo $j; ?>" class="TeamName form-control" >
					<?PHP
			$Teams = mysqli_query($con,"SELECT * FROM teams");
				
			while ($row=mysqli_fetch_array($Teams))
			{			
			?>
			<option name="teams" value=<?PHP  echo $row['value'] ?>  > <?PHP echo $row['teams']; ?> </b></option>";		
			<?PHP	
			}
		?>
	</select></td>
<td><input type="text" name="Designation" id="Designation_I-<?PHP echo $j; ?>" class="form-control"></td>

<td><input type="email" name="EmailID" id="EmailID_I-<?PHP echo $j; ?>" class="form-control" ></td>
<td><input type="text" name="SkypeID" id="SkypeID_I-<?PHP echo $j; ?>" class="form-control">
<td><select name="user_level" id="user_level_I-<?PHP echo $j; ?>" class="user_level form-control">
<?PHP
$Teams = mysqli_query($con,"SELECT * FROM user_level");
				
			while ($row=mysqli_fetch_array($Teams))
			{		
			?>
			<option name="Level" value=<?PHP  echo $row['Level'] ?>  > <?PHP echo $row['Level']; ?> </b></option>";	
			<?PHP		
			}
		?></select></td>
<td>
<a href="#" class="I_teaa btn btn-success btn-xs fa fa-check col-md-offset-1" id="I_teaa-<?PHP echo $j; ?>"> Insert </a>
</td>	
</tr>
</tbody>
</table>
	<table class="table table-fixed table-hover table-striped table-bordered table-responsive sortable">
	<thead>
<tr>
<th>Employee ID</th>
<th>First name</th>
<th>Last name</th>
<th>Joining Date</th>
<th>Proad ID</th>
<th>Team Name</th>
<th>Designation</th>
<th>User level</th>
<th>SkypeID</th>
</tr>
</thead>
	<?PHP
	$j=1;
	$sql ="Select Firstname,Lastname,ProadId,JoiningDate,EmployeeID,TeamName,Designation,user_level,SkypeID,Auto_ID from signup WHERE user_level != 'ADMIN'";
	$result2017 = mysqli_query($con,$sql); 
						$number_of_rows = mysqli_num_rows($result2017);
						while ($row = mysqli_fetch_array($result2017)){
						
						 $Firstname = $row['Firstname'];
						 $Lastname = $row['Lastname'];
						 $ProadId = $row['ProadId'];
						 $JoiningDate = $row['JoiningDate'];
						 $EmployeeID = $row['EmployeeID'];
						 $TeamName = $row['TeamName'];
						 $Designation = $row['Designation'];
						 $user_level = $row['user_level'];
						 $SkypeID = $row['SkypeID'];
						 $AutoID = $row['Auto_ID'];
?>
<tbody>
<tr>
<td><?PHP echo $EmployeeID; ?><input type="text" name="EmployeeID<?PHP echo $j; ?>" id="EmployeeID-<?PHP echo $j; ?>" class="form-control" value="<?PHP echo $EmployeeID; ?>" style="display:none"></td>
<td><?PHP echo $Firstname; ?><input type="text" name="Firstname<?PHP echo $j; ?>" id="Firstname-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $Firstname; ?>" style="display:none"></td>
<td><?PHP echo $Lastname; ?><input type="text" name="Lastname<?PHP echo $j; ?>" id="Lastname-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $Lastname; ?>" style="display:none"></td>
<td><?PHP echo $JoiningDate; ?><input type="text" name="JoiningDate<?PHP echo $j; ?>" id="JoiningDate-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $JoiningDate; ?>" style="display:none"></td>
<td><?PHP echo $ProadId; ?><input type="text" name="ProadId<?PHP echo $j; ?>" id="ProadId-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $ProadId; ?>" style="display:none"></td>
<td><?PHP echo $TeamName; ?><select name="TeamName<?PHP echo $j; ?>" id="TeamName-<?PHP echo $j; ?>" class="TeamName form-control" style="display:none">
					<?PHP
			$Teams = mysqli_query($con,"SELECT * FROM teams");
				
			while ($row=mysqli_fetch_array($Teams))
			{			
			
			if($row['value'] == $TeamName)
		{
			?>  <option name="teams"  selected value=<?PHP  echo $row['value'] ?>  > <?PHP echo $row['teams']; ?> </b></option>";			
	<?PHP 
		}
		else
		{
			?>
			<option name="teams" value=<?PHP  echo $row['value'] ?>  > <?PHP echo $row['teams']; ?> </b></option>";
		
			<?PHP
		}
			}
		?>
	</select></td>
<td><?PHP echo $Designation; ?><input type="text" name="Designation<?PHP echo $j; ?>" id="Designation-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $Designation; ?>" style="display:none"></td>
<td><?PHP echo $user_level; ?><select name="user_level<?PHP echo $j; ?>" id="user_level-<?PHP echo $j; ?>" class="user_level form-control" style="display:none">
<?PHP
$Teams = mysqli_query($con,"SELECT * FROM user_level");
				
			while ($row=mysqli_fetch_array($Teams))
			{		
			
			if($row['Level'] == $user_level)
		{
			?>  <option name="Level"  selected value=<?PHP  echo $row['Level'] ?>  > <?PHP echo $row['Level']; ?> </b></option>";			
	<?PHP 
		}
		else
		{
			?>
			<option name="Level" value=<?PHP  echo $row['Level'] ?>  > <?PHP echo $row['Level']; ?> </b></option>";
		
			<?PHP
		}
			}
		?></select></td>
<td><?PHP echo $SkypeID; ?><input type="text" name="SkypeID<?PHP echo $j; ?>" id="SkypeID-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $SkypeID; ?>" style="display:none">
<input type="hidden" name="AutoID<?PHP echo $j; ?>" id="AutoID-<?PHP echo $j; ?>" class="form-control"value="<?PHP echo $AutoID; ?>"></td>	
<td>
<a href="#" class="e_teaa btn btn-primary btn-xs fa fa-pencil col-md-offset-1" id="e_teaa-<?PHP echo $j; ?>"> edit </a>
<a href="#" class="c_teaa btn btn-danger btn-xs fa fa-trash-o col-md-offset-1" id="c_teaa-<?PHP echo $j; ?>"> Cancel </a>
<a href="#" class="u_teaa btn btn-success btn-xs fa fa-check col-md-offset-1" id="u_teaa-<?PHP echo $j; ?>" style="display:none"> Update </a>
</td>	
</tr>
</tbody>
<?PHP
$j++;
}
?>

</table>

<?PHP

/* $Firstname_1 = $_POST['Firstname'];
$Lastname_1 = $_POST['Lastname'];
$ProadId_1 = $_POST['ProadId'];
$JoiningDate_1 = $_POST['JoiningDate'];
$EmployeeID_1 = $_POST['EmployeeID'];
$TeamName_1 = $_POST['TeamName'];
$Designation_1 = $_POST['Designation'];
$user_level_1 = $_POST['user_level'];
$SkypeID_1 = $_POST['SkypeID'];
$AutoID_1 = $_POST['AutoID'];
	 
	//$date = $_POST['date'];

		
	echo $sql="UPDATE signup SET Firstname ='".$Firstname_1."',Lastname ='".$Lastname_1."',ProadId ='".$ProadId_1."',JoiningDate ='".$JoiningDate_1."',EmployeeID ='".$EmployeeID_1."',TeamName ='".$TeamName_1."',Designation ='".$Designation_1."',user_level ='".$user_level_1."',SkypeID ='".$SkypeID_1."' WHERE Auto_ID = '".$AutoID."' ";
	
	$result1 = mysqli_query($con,$sql); */	

?>

</section>
</section>
		  
<?PHP
include('footer.php');
?>