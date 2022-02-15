<?php
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<link rel="stylesheet" href="CSS/bootstrap.min.css">
	<link rel="stylesheet" href="CSS/bootstrap.rtl.css">
	<link rel="stylesheet" href="CSS/bootstrap.rtl.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-grid.css">
	<link rel="stylesheet" href="CSS/bootstrap-grid.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-grid.rtl.css">
	<link rel="stylesheet" href="CSS/bootstrap-grid.rtl.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-reboot.css">
	<link rel="stylesheet" href="CSS/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-reboot.rtl.css">
	<link rel="stylesheet" href="CSS/bootstrap-reboot.rtl.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-utilities.css">
	<link rel="stylesheet" href="CSS/bootstrap-utilities.min.css">
	<link rel="stylesheet" href="CSS/bootstrap-utilities.rtl.css">
	<link rel="stylesheet" href="CSS/bootstrap-utilities.rtl.min.css">

	<title>Input Expected Output</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<script src="JS/addRowButton.js"></script>
	<link rel="stylesheet" href="CSS/PlacePurchaseOrderLink1.css">
	<script src="JS/PlacePurchaseOrderLink2.js"></script>
	<script src="JS/PlacePurchaseOrderLink3.js"></script>
	<script src="JS/bootstrap.bundle.js"></script>
	<script src="JS/bootstrap.bundle.min.js"></script>
	<script src="JS/bootstrap.esm.js"></script>
	<script src="JS/bootstrap.esm.min.js"></script>
	<script src="JS/bootstrap.js"></script>
	<script src="JS/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
	<SCRIPT>
		$(document).ready(function(){
		$("#prod_name").select2();
		$('#but_read').click(function(){
		var username = $('#prod_name option:selected').text();
		var userid = $('#prod_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	</SCRIPT>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    // include "../includes/header.php";
	// global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Input Expected Output</h1>
</header>

	<a class="btn btn-outline-secondary btn-lg" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
	  Menu >>
	</a>

	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	  <div class="offcanvas-header"><br>
		<h5 class="offcanvas-title" id="offcanvasExampleLabel" align="center">Menu</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	  </div>
		  <div class="offcanvas-body">			
			<div class="dropdown mt-3" align="center">
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial.php'">
				Accept Raw Material
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Add Production Estimation.php'">
				Add Production Estimation
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Returnfaultymaterial.php'">
				Return Faulty Material
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submit finished goods.php'">
				Submit Finished Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AdhocProduction.php'">
				Raise Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPendingProductions.php'">
				Historical Production
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				Pending requisitions
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical requisitions
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br>
		<form method="post" action="">
		<table style="width:70%" id="formContent" align="center">	
			<tr align="center">	
				<td align="center" class="form-label"><br><br>Product Name: </td>
				<td align="center"><br><br><select style="width: 400px; height: 40px;" name="prod_name" id="prod_name" class="form-control">
					<?php
						$prod_require_date=date('Y-m-d');
						$result=mysqli_query($connection, "SELECT prod_name FROM production WHERE prod_require_date='$prod_require_date' AND prod_status='RawMaterial Accepted' OR prod_status='Partially to Prod'");
						while($data=mysqli_fetch_array($result)){
							echo "<option value='".$data['prod_name']."'>".$data['prod_name']."</option>";
						}
					?>
				</select></td>
			</tr>
			<tr align="center">	
			<td align="center" class="form-label"><br><br>Number of People Present: </td>
				<td align="center"><br><br><input type="number" id="prod_num_people_present" class="form-control" name="prod_num_people_present" style="width: 400px; height: 40px;"></td>
			</tr>
			<tr align="center">	
			<td align="center" class="form-label"><br><br>Idle Time Expected: </td>
				<td align="center"><br><br><input type="number" id="prod_idle_time_expected" class="form-control" name="prod_idle_time_expected" style="width: 400px; height: 40px;"></td>
			</tr>
			<tr align="center">	
			<td align="center" class="form-label"><br><br>Estimated output quantity: </td>
				<td align="center"><br><br><input type="number" id="estimated_prod_quantity" class="form-control" name="estimated_prod_quantity" style="width: 400px; height: 40px;"></td>
			</tr>
		</table><br><br>
		<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Submit " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>	

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Confirm</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Do you accept all these Raw Materials. </td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm</button>
				  </div>
				</div>
			  </div>
			</div>
		</form>			
	</div>
</div>
</body>
</html>
<?php

if(isset($_POST["submit"]))
{
	$prod_name=$_POST['prod_name'];
    $prod_num_people_present=$_POST["prod_num_people_present"];
    $prod_idle_time_expected=$_POST["prod_idle_time_expected"];
    $estimated_prod_quantity=$_POST["estimated_prod_quantity"];
	
	$sql = mysqli_query($connection, "UPDATE production SET estimated_prod_quantity='$estimated_prod_quantity', prod_num_people_present='$prod_num_people_present', prod_idle_time_expected='$prod_idle_time_expected' WHERE prod_name='$prod_name'");
			
	if ($sql) {
		echo '<script>alert("Raw Materials Accepted.")</script>';
		echo '<script>window.location.replace("Acceptrawmaterial.php")</script>';
	} else {
		echo "Error: " . $sql . "<br>" . $connection->error;
	}
}
?>
