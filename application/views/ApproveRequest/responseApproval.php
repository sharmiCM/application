<?PHP
include __DIR__ . "/../header.php";
error_reporting(0);
?>

<section id="main-content">
		<section class="wrapper">
<!--<script src="https://code.jquery.com/jquery-1.12.4.js" type="text/javascript" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" />-->

		

<style>
 #approveForSignout  {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 25%;
    border: 2px solid #F1E41A;
	margin-top: 10px;
}

#approveForSignout td {
    border: 1px solid #F1E41A;
    text-align: left;
    padding: 8px;
}

#approveForSignout tr:nth-child(odd) {
    background-color: #F4F1D3;
}
</style>
		<div id="approveForSignout"></div>
		<input type="hidden" class="base" value="<?php echo base_url(); ?>">
		<?PHP
		$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
		$approveTr="<table>";
		date_default_timezone_set('Asia/Calcutta');	
		$re=mysqli_query($con,"SELECT * FROM `attendance` WHERE markoutDate='' AND requestTo='".$_SESSION['EmployeeID']."'")or die(mysqli_error());
		while ($roq=mysqli_fetch_assoc($re)){
			 $approveTr=$approveTr."<tr><td style='width:5%;'>".$roq['empId']."</td><td style='width:15%;'>".$roq['Name']."</td><td style='width:5%;'><input type='button' id='approveSO' value='Approve' style='border-radius: 7px;background-color: darkgray;' onclick='approveForSignOut(this);'></td></tr>";
		}
		$approveTr=$approveTr."</table>";
		
		
	?>

		<script type="text/javascript">
		$(document).ready(function(){
			if("<?php echo $approveTr?>"=="<table></table>"){
				var htmlCont = "<b>No Request Available</b>";
			}
			else{
				var htmlCont="<?php echo $approveTr?>";
			}
			$("#approveForSignout").html(htmlCont);
		});
		function approveForSignOut(ref){			
			$.ajax({
				type:'POST',
				url:"approveRequest.php",//"<?php echo base_url();?>public/Reports/approveRequest.php"
				data:{empID:$(".centered")[1].innerText,empName:$(".centered")[2].innerText,count:2, forEmp:ref.parentNode.previousSibling.previousSibling.outerText},
				success:function(html){
					location.reload();
				}
			});
		}
		</script>


      </section>
          </section>
<?PHP


include('footer.php');
?>
