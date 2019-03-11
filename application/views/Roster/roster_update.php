<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
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

$(document).ready(function(){
 $(document).on('change','.leave',function(){
  var TEAMID = (this.id);
  var TEAM=$("#leave").val();
		//var one = $(this).val();
 		
        if(TEAM){
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>public/Roster/roster_ajax.php",
				data:{'teamname': TEAM },
                success:function(html){
                    $('#Namee').html(html);
					$('#Shift').html('<option value="">Select Name first</option>'); 
                }
            }); 
        }else{
            $('#Namee').html('<option value="">Select  first</option>');
			 $('#Shift').html('<option value="">Select Name first</option>'); 
        }
    });
	
	    $(document).on('change','.Namee',function(){
        var NameeID = (this.id);		
		var Namee=$("#Namee").val();
        if(Namee){
            $.ajax({
                type:'POST',
                url:"<?php echo base_url();?>public/Roster/roster_ajax.php",
                data:{'NameeID': Namee},
                success:function(html){
                    $('#Shift').html(html);
					 $('#eid').val(Namee);
					//alert(html);
                }
            }); 
        }else{
            $('#Shift').html('<option value="">Select Name first</option>'); 
        }
    });
	
	});
	
  $(document).ready(function(){
   $(document).on('change','.Shift',function(){        //Date in full format alert(new Date(this.value));
        var inputShift = this.value;
		//alert(inputDate);
		$.ajax({
                type:'POST',
				url:"<?php echo base_url();?>public/Roster/roster_ajax.php",
				data:{'Shiftcode': inputShift },
                success:function(responce){
                    $('#Shif').val(responce); 
					//alert(data);
                }
            }); 	
    });
});
	
  
  $(document).ready(function(){
   $(document).on('change','#date',function(){        //Date in full format alert(new Date(this.value));
        var inputDate = this.value;
		//alert(inputDate);
		$.ajax({
                type:'POST',
				url:"<?php echo base_url();?>public/Roster/roster_ajax.php",
				data:{'datee': inputDate },
                success:function(data){
                    $('#alert').val(data); 
					//alert(data);
                }
            }); 	
    });
});

  $(document).ready(function(){
   $(document).on('change','.date1',function(){        //Date in full format alert(new Date(this.value));
        var inputDate1 = this.value;
		//alert(inputDate);
		$.ajax({
                type:'POST',
				url:"<?php echo base_url();?>public/Roster/roster_ajax.php",
				data:{'datee1': inputDate1 },
                success:function(dataa){
                    $('#date11').val(dataa); 
					//alert(dataa);
                }
            }); 	
    });
});
	</script>

		  
	<?php
	$one=$_POST['teamname'];
	
	$data = mysqli_query($con,"SELECT * FROM signup WHERE TeamName LIKE '".$one."'") or die(mysqli_error()); 

	$resultt=mysqli_query($con,"SELECT count(*) as total from signup WHERE TeamName LIKE '".$one."'");
		$datao=mysqli_fetch_assoc($resultt);
		$total = $datao['total'];
	//echo $total;
	?>
	
	 <section id="main-content">
          <section class="wrapper">
	<div>
	<div class="row" style="padding:30px 0px 15px 0">
		<form id="myform" action="" method="POST">
			<div class= "col-md-4">
				<b>Date 1</b>
				<input type="date"  name="date" id="date" placeholder="Select Date">
				<b>Date 2</b>
				<input type="date"  name="date1" class="date1" placeholder="Select Date">
			</div>
				<input type="hidden" name="dateee" id="alert">
				<input type="hidden" name="dateee11" id="date11">
				
				<input type="hidden" name="Shif" id="Shif">
				
				<input type="hidden" name="eid" id="eid">
	<div class= "col-md-2">
			<select name="teamname" id="leave" class="leave form-control">
				<?PHP
						$Teams = mysqli_query($con,"SELECT * FROM teams");
						
					while ($row=mysqli_fetch_array($Teams))
					{
					echo "<option value='".$row['value']."'>".$row['teams']."</b></option>";
					}
				?>
			</select>

	</div>
		<div class= "col-md-2">
			<select name="Name" class="Namee form-control" id="Namee">	<option value="" >Select TEAM first</option>  </select>
		</div>	
			<div class= "col-md-2">
				<select name="Shift" id="Shift" class="Shift form-control"> <option value="" >Select Name first</option> 	</select>  
			</div> 
 		<input type="submit" name="submit1" class="btn btn-primary" value="Confirm" >
		
	</form>
	</div>
		<div>
	<form action="<?php echo base_url();?>public/Roster/roster_ajax.php" method="POST">
	<?PHP
		$dateee = $_POST['dateee'];
		$_SESSION['date_roster'] = $dateee;
		
		$dateee11 = $_POST['dateee11'];
		$_SESSION['dateee11'] = $dateee11;

		$sh = $_POST['Shif'];
		$_SESSION['shi'] = $sh;

		$eid = $_POST['eid'];
		$_SESSION['eide'] = $eid;

		$date = $_SESSION['date_ros'];

		echo '<font size="2px" face="Arial"><span>Selected Date	1 :  </span>'; echo $dateee; echo  '<br>';
		echo '<font size="2px" face="Arial"><span>Selected Date 2	 :  </span>'; echo $dateee11; echo  '<br>';
		echo '<font size="2px" face="Arial"><span>Employee ID	 :  </span>'; echo $eid;  echo  '<br>';
		echo '<font size="2px" face="Arial"><span>Shift ID	 :  </span>';  echo $sh; echo  '<br> <br>';
 
	?>
	<div class="">
	
	<input type="submit" name="submit" class="btn btn-success btn-lg" value="Update">
	
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info " data-toggle="modal" data-target="#myModal">Roster Timings</button>
  	
 </div>
	
		
	</form>
	</div>


  <!-- Modal -->
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
    </section>
          </section>
</body>
</html>