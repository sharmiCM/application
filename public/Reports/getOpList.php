		<?PHP
			//include('dbConfig.php');
$con = mysqli_connect('localhost', 'root', 'ppisAdmin@123','new');
//mysqli_select_db('new');
			
			$team = $_POST['team'];
			$optionOperators="";
			$selectOp=mysqli_query($con,"SELECT * FROM `signup` WHERE TeamName='".$team."' ORDER BY Firstname ASC")or die(mysqli_error($selectOp));
			while ($ru=mysqli_fetch_assoc($selectOp)){
					$optionOperators = $optionOperators."<option value=".$ru['EmployeeID'].">".$ru['Firstname']." ".$ru['Lastname']."</option>";
			}
			echo $optionOperators;
				  
		?>
