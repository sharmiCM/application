<?PHP
  include __DIR__ . "/../header.php";
	error_reporting(0);
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');

	$one=$_POST['teamname'];
	
	$data = mysqli_query($con,"SELECT TeamName FROM signup WHERE TeamName LIKE '".$one."'") or die(mysqli_error()); 	

	?>
	
  <section id="main-content">
          <section class="wrapper">

	<div class="container-fluid">
		<div class="row" style="padding:30px 0px 10px 0">
		<div class="col-md-6">
			<form method="POST" action="">
				<b>Date 1</b><input type="date" id="date" name="date">
				<b>Date 2</b><input type="date" id="date1" name="date1">
				</div>
				<div class="col-md-2">
				<select name="teamname" id="leave" class="form-control" onchange="showUser(this.value)">
					<?PHP
				$Teams = mysqli_query($con,"SELECT * FROM teams");
				
			while ($row=mysqli_fetch_array($Teams))
			{
			echo "<option value='".$row['value']."'>".$row['teams']."</b></option>";
			}
		?>
			</select>
			</div>
			<div class="col-md-2">
				<button id="get" value="get" class="btn btn-primary" name="get">Get Roster</button>
				</div>
			</form>
			
		</div>
		
		<div>
		<form action="#" method="POST">
			<table class="table table table-hover table-bordered table-striped table-responsive">
			<tbody>
			<tr>
			<th>Date</th>
			<th>Employee ID</th>
			<th>Employee Name</th>
			<th>Shifts</th>
			</tr>
			<?PHP
				$h=0;
				if(isset($_POST['get']) == 'get')
		{		
				
				$date = $_POST['date'];
				$dateee1 = $_POST['date1'];
				
				$sql= "SELECT t.ID,t.DATE,t.empid,t.name,t.Shiftcode,r.ID,r.Shifts,s.TeamName,s.EmployeeID FROM roster_table t,signup s,roster r WHERE t.DATE BETWEEN '".$date."' AND '".$dateee1."' AND t.Shiftcode = r.ID AND s.EmployeeID = t.empid AND '".$one."' LIKE s.TeamName  ORDER BY t.DATE DESC";
				
				$result=mysqli_query($con,$sql);
					while ($row = mysqli_fetch_array($result))
				{
					$DATE=$row['DATE']; $empid=$row['empid']; $name=$row['name'];$Shifts=$row['Shifts']; $TeamName=$row['TeamName'] ;
					$ID=$row['ID'] ;
			?>
				<tr>
					<td><?php echo $DATE; ?></td>
					<td><?php echo $empid; ?> </td>
					<td><?php echo $name; ?> </td>
					<td><?php echo $Shifts; ?></td>			
		  


				
					<td><a id="del-<?PHP echo $h; ?>" name="del" class="del">Delete</a></td>
					
						  					<?PHP
											if(isset($_POST["del"]) == '1'){
						/* $sql_del="DELETE FROM `roster_table` WHERE `ID`='".$ID."'";
$result1=mysqli_query($con,$sql_del);	 */		
 echo "<script>alert('Deleted')</script>";
											}

		?>
					
			<?php 
			$h++;
				} 
		}
			?>
				</tr>
			</tbody>
			</table>
			</form>
		</div>
		  <!-- Modal -->
	   <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Roster Timings</button>
  	
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Shift Codes</h4>
        </div>
        <div class="modal-body">
		
		<!--  Baala content -->
          	<div class="row">
		<div class="col-md-offset-1">
			<table  style="width:500px; height:50%" class=" table table-hover table-inverse  table-responsive ">

			<tr class=" bg-primary">
			<th>Shift ID</th>
			<th>Shift Code</th>
			<th>In time</th>
			<th>Out time</th>
			<th>Duration</th>
			</tr>

			<?PHP  $sql = "Select * from roster";
			$result = mysqli_query($con,$sql);
			while($row = mysqli_fetch_array($result)){
			 $id = $row['ID'];
			 $Shifts = $row['Shifts'];
			 $intime = $row['intime'];
			 $outtime = $row['outtime'];
			 $totalhours = $row['totalhours'];
			
			?>
			<tr class="bg-info">
			<td scope="row"><?PHP echo $id ?></td>
			<td><?PHP echo $Shifts ?></td>
			<td><?PHP echo $intime ?></td>
			<td><?PHP echo $outtime ?></td>
			<td><?PHP echo $totalhours ?></td>
			</tr>
			<?PHP } ?>
			</table>
		</div>
	</div>
		<!--  Baala content Ends-->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
	 
      
    </div>
  </div>
	</div>
	</section>
	</section>
</body>
</html>