<?php
	include_once ("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$prod_name=$_POST['prod_name'];
		$prod_quantity=$_POST['prod_quantity'];
		date_default_timezone_set('Asia/Kolkata');
		$prod_name=mysqli_real_escape_string($connection,$prod_name);
		$prod_quantity=mysqli_real_escape_string($connection,$prod_quantity);

		$insert_query=mysqli_query($connection, "UPDATE production SET prod_quantity='$prod_quantity', prod_status='Prod Complete', prod_complete_time=TIME(NOW()) WHERE prod_name='$prod_name'");
		if($insert_query){
			echo '<script type="text/javascript">alert("Finished Good Submitted Successfully.");
			window.location.replace("Submit finished goods.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
		}
		mysqli_close($connection);
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

	<title>Submit finished goods</title>
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
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 	
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Submit finished goods</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial1.php'">
				Input Expected Output
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
	<div id="formContent"><br><br>
	<form name="formname" method="post" action="">
		<table style="width:60%" id="formContent" align="center">
			<tr align="center">		
				<td align="center" class="form-label"><br><br>Finished Product : </td>
				<td align="center"><br><br><select name="prod_name" id="prod_name" style="width: 205px; height: 50px;">
					<?php 
						$records=mysqli_query($connection,"SELECT prod_name from production where prod_status='RawMaterial Accepted'");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['prod_name']."'>".$data['prod_name']."</option>";
						}
					?>
					</select> 
				</td>
			</tr>
			<tr align="center">		
				<td align="center" style="width: 300px; height: 20px;" class="form-label"><br><br> Quantity : </td>
				<td align="center"><br><br><input type="text" id="prod_quantity" class="form-control" name="prod_quantity" style="width: 205px; height: 50px;"></td>
			</tr>
		</table><br><br>
		<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="  Submit  " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
	</form>
		
		<!--<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Do you want to submit this Product?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Product Name: </td>
							<td align="left"><input type="text" id="fps_name" class="form-control" name="fps_name" value="2021" readonly></td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm</button>
				  </div>
				</div>
			  </div>
			</div>-->
			  <br><br>
	</div>
	
</div>

</body>
</html>
