
<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
?>

<style>
input[type="date"]::before {
	color: #999999;
	content: attr(placeholder);
}
input[type="date"] {
	color: #ffffff;
}
input[type="date"]:focus,
input[type="date"]:valid {
	color: #666666;
}
input[type="date"]:focus::before,
input[type="date"]:valid::before {
	content: "" !important;
}



</style>
<script>
$(document).ready(function () {
$(document).on('change','#shift-11',function(){
	
     $("#shift_h").val($("#shift-11").val());
     var shift_h =$("#shift-11").val();
	  $.ajax({
                type:'POST',
				URL:"<?php echo base_url();?>public/Reports/roster_ajax.php",
                data:{'shift_h':shift_h},
                success:function(data){
				var nums=$("#shift_h1").val(data);
				//alert(data);
                }
            }); 
    });
});
</script>
<script type="text/javascript">
	function recp(id) {
	$('#myStyle').load('test.php?id=' + id);
	}
	function changenextdropdown(ret){
		var tdLen  = ret.parentElement.parentElement.cells.length;
		var selIndex = ret.selectedIndex;
		 for (var i = ret.parentElement.cellIndex; i < tdLen; i++) {
		//ret.parentElement.nextElementSibling.nextElementSibling.firstElementChild[ret.selectedIndex].selected = true;
		ret.parentElement.parentElement.cells[i].nextElementSibling.nextElementSibling.firstElementChild[ret.selectedIndex].selected = true;
		 }
	}
</script>



    <section id="main-content">
		<section class="wrapper site-min-height">
		

	<div class="row" style="padding:30px 0px 10px 0">
		<div class="col-sm-12">
		<?php
		
			$one=$_POST['teamname'];
			$date = $_POST['date'];
			$date2 = $_POST['date2'];
			
			$data = mysqli_query($con,"SELECT * FROM signup WHERE TeamName LIKE '".$one."'") or die(mysqli_error()); 

			$resultt=mysqli_query($con,"SELECT count(*) as total from signup WHERE TeamName LIKE '".$one."'");
			$datao=mysqli_fetch_assoc($resultt);
			$total = $datao['total'];
			//echo $total;
			$si=1;
			$da=1;
			 $na=1;
		?>
		<div class="row" style="padding:0px 0px 15px 0">
			<form id="myform" action="<?php echo base_url(); ?>HomeScreen/rosterCreate" method="POST">
			<div class="col-sm-2">
				<input type="date"  name="date" id="date" placeholder="Start Date" value="<?php echo $date;?>" required>
			</div>
			<div class="col-sm-2">
				<input type="date" placeholder="End Date" name="date2" id="date2" value="<?php echo $date2;?>" required>
			</div>
			<div class="col-sm-2">
				<select name="teamname" class="form-control" id="leave" onchange="showUser(this.value)">
					<?PHP
							$Teams = mysqli_query($con,"SELECT * FROM teams");
							
						while ($row=mysqli_fetch_array($Teams))
						{
						echo "<option value='".$row['value']."'>".$row['teams']."</b></option>";
						}
					?>
				</select>
			</div>
			<div class="col-sm-5">
				<input type="submit" class="btn btn-primary" name="submit" value="GO" onClick="recp('1')">
			</div>
			</form>
		</div>	
	<div style="padding:0px 0px 15px 0">
		<?PHP
		echo '<font size="2px" face="Arial"><span>Start :  </span>'; echo $date; echo  '<br>';
		echo '<span>End :  </span>'; echo $date2; echo  '<br>';
		echo '<span>Team :  </span>'; echo $one;
		?>
	</div>

	<div class="row">
			<form action="" method="POST">
		<div>
			<table class="table table-striped table-bordered one table-responsive">

			<tr>
				<th>Count</th>
				<th>Employee ID</th> 
				<th>Employee Name</th>
				
					<?php   

			for($d=$date;$d<=$date2;)
			{?>
			<td><input type="hidden" name="arraycoun[]"><input type="hidden" name="date<?php echo $da;?>" value="<?php echo $d;?>"><?php  echo $d; ?>
				<?php 
				$d++;
				$da++;
			}?>
			</tr>
			<tr>

			
			<?php 
		while($row = mysqli_fetch_assoc($data)){
		?>

		<tr>
			<td><?php echo $si; ?></td>
			<td> <input type="hidden" name="arraycount[]"> <input type="hidden" name="empid<?php echo $si; ?>" value="<?php echo $row['EmployeeID']?>" > <?php echo $row['EmployeeID'] ?></td>
			<td><input type="hidden" name="arrayc[]"><input type="hidden" name="name<?php echo $na; ?>" value='<?php echo $row['Firstname'].' '.$row['Lastname']?>'><?php echo $row['Firstname'].' '.$row['Lastname'];?></td>
			<td><input type="hidden" name="arraycTeam[]"><input type="hidden" name="teamNames<?php echo $na; ?>" value='<?php echo $row['TeamName']?>'><?php echo $row['TeamName'];?></td>

		<?php
		 
		$ro=1;
		  for ($j=1;$j<$da;$j++)  
		  {
		  $query = mysqli_query($con,"SELECT r.Shiftcode,r.empid,r.DATE  FROM roster_table r WHERE  r.DATE BETWEEN '".$date."' AND '".$date2."' AND r.empid = '".$row['EmployeeID']."'");
    $num_rows1 = mysqli_num_rows($query);
        while ($row = mysqli_fetch_assoc($query)) 
		{
             $chosenCategory = $row['Shiftcode'];
        }

		$sql = "SELECT intime,outtime,ID,Shifts FROM roster";
		$result = mysqli_query($con,$sql);

		?>	
		<td>
		<select class="shift"  onchange="changenextdropdown(this);" id="shift-<?PHP echo $si.$j; ?>" name="shift<?PHP echo $si.$j; ?>"> 
		<?PHP
		while ($row = mysqli_fetch_array($result)) {
		if($row['ID'] == $chosenCategory)
		{
			?>  <option name="shiftcode<?PHP echo $ro; ?>"  selected value=<?PHP  echo $row['ID'] ?>  > <?PHP echo $row['Shifts']; ?> </b></option>";			
	<?PHP 
		}
		else
		{?>
			<option name="shiftcode<?PHP echo $ro; ?>" value=<?PHP  echo $row['ID'] ?>  > <?PHP echo $row['Shifts']; ?> </b></option>";
		
			<?PHP
		}

		?>
		
		<?PHP echo $ro++; 

		}
		?>
		</select>

		</td> <input type="hidden" name="kcount[]"value="<?PHP echo $k; ?>"> 
		  <?php  echo $k;
		  }   ?>  
		  
		</tr>

		<?php 
			$na++;
		   $si++; 
		   $j++; 
			}
		 ?>		 
		 </table>
		</div>
	<div style="padding:0px 0px 0px 18px">
		<input type="submit"  class="btn btn-success" name="Register" value="Submit">
	</div>	 
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



<?php 

if(isset($_POST['Register']))
{
$arraycount=$_POST['arraycount'];
  $total=count($arraycount);   
  
$arraycoun=$_POST['arraycoun'];
$total1=count($arraycoun); 
  for($a=1;$a<=$total;$a++)
	{
	  
	  for($b=1;$b<=$total1;$b++)
	  {
			
			$date=$_POST['date'.$b];
			$empid=$_POST['empid'.$a];	
			$name=$_POST['name'.$a];	
			$Shift=$_POST['shift'.$a.$b];
			$teamNamevar = $_POST['teamNames'.$a];
			$selectQuery = mysqli_query($con,"SELECT * FROM roster_table WHERE DATE='".$date."' && empid='".$empid."'")or die(mysqli_error()); 
			$selectQueryNor=mysqli_num_rows($selectQuery);
			if($selectQueryNor==0){
				$sql="INSERT INTO roster_table(empid,DATE,name,Shiftcode,Team) VALUES ('".$empid."','".$date."','".$name."','".$Shift."','".$teamNamevar."')";
			}
			else{
				//echo "<script>alert('Success on Non-duplicates.')</script>";
			}
			$result = mysqli_query($con,$sql);	
		}
	}
		echo "<script>alert('Success')</script>";
		header("Refresh: 0");
		//$this->load->view('http://localhost:8080/PPIS/HomeScreen/rosterCreate'); 
	//echo "<script>window.open('http://localhost:8080/PPIS/HomeScreen/rosterCreate','_self')</script>";
	}
	?>

	
	<!--<script>
	window.addEvent('domready',function() {
	var togglers = $$('div.toggler');
	if(togglers.length) var gmail = new Fx.Accordion(togglers,$$('div.body'));
	togglers.addEvent('click',function() { this.addClass('read').removeClass('unread'); });
	togglers[0].fireEvent('click'); //first one starts out read
});
	</script>-->
	<?PHP
	
	/* connect to gmail */
	/*$hostname = '{imap.gmail.com:995/pop3/ssl}INBOX';*/

	?>
</div>
</div>
      </section>
          </section>
</main>
</div>
</body>
</html>
