
<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
$date = $_POST['date'];
 $sql="Select * from login WHERE Date='".$date."' AND out_time = '0000-00-00 00:00:00' ";
 $result = mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result))
{
$EmployeeID =$row['EmployeeID'];
$Time =$row['Time'];
$out_time =$row['out_time'];
$Date =$row['Date'];
$ID =$row['ID'];
?>
<form method="POST" action="">
<table class="table table-border" style="width:30%">
<tr>
<td><?PHP echo $Date; ?></td>
<td><?PHP echo $EmployeeID; ?></td>
<td><?PHP echo $Time; ?></td>
<td><input type="text" name="out_t" value="0000-00-00 00:00:00">
<input type="hidden" value="<?PHP echo $out_time; ?>"></td>
<input type="hidden" name="ID" value="<?PHP echo $ID; ?>"></td>
<td><button id="update" name="update" value="update"> Update </button></td>
</tr>

</form>
<?PHP
}
if(isset($_POST['update']) == 'update'){
$id_t =$_POST['ID'];
$out_t = $_POST['out_t'];
echo $sql_u1="UPDATE login SET out_time = '".$out_t."' WHERE ID = '".$id_t."'";
$result_u1 = mysqli_query($con,$sql_u1);
}
?>
</div>
</div>
-->
	  <section id="main-content">
          <section class="wrapper">
		  <div>
<div class="row">
<h3> Update Log out time</h3>

<div>
<div>
<form method="POST" action="">
<input type="date" id="date1" name="date1" class="date">
<button> Submit </button>
</form>
<?PHP
$date1 = $_POST['date1'];
 $sql="Select * from login WHERE Date='".$date1."'";
 $result = mysqli_query($con,$sql);
while($row=mysqli_fetch_array($result))
{
$EmployeeID =$row['EmployeeID'];
$Time =$row['Time'];
$out_time =$row['out_time'];
$Date =$row['Date'];
$ID =$row['ID'];
?>
<form method="POST" action="">
<table class="table table-border" style="width:50%">
<tr>
<td><?PHP echo $Date; ?></td>
<td><?PHP echo $EmployeeID; ?></td>
<td><?PHP echo $Time; ?></td>
<td>
<input type="text" name="out_tt"  value="<?PHP echo $out_time; ?>"></td>
<input type="hidden" name="ID" value="<?PHP echo $ID; ?>"></td>
<td><button> Update </button></td>
</tr>

</form>
<?PHP
}
$id_tt =$_POST['ID'];
$out_tt = $_POST['out_tt'];
$sql_u="UPDATE login SET out_time = '".$out_tt."' WHERE ID = '".$id_tt."'";
$result_u = mysqli_query($con,$sql_u);
?>

</div>
</div>
</div>
</div>
 </section>
  </section>
<?PHP
include('footer.php');
?>