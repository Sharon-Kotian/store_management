<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$caret_id=$_POST['caret_id'];
		$caret_material_name=$_POST['caret_material_name'];
		$caret_quantity=$_POST['caret_quantity'];

		$caret_id=mysqli_real_escape_string($connection,$caret_id);
		$caret_material_name=mysqli_real_escape_string($connection,$caret_material_name);
		$caret_quantity=mysqli_real_escape_string($connection,$caret_quantity);

		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_material_name='$caret_material_name' WHERE caret_id='$caret_id'");
		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_quantity='$caret_quantity' WHERE caret_id='$caret_id'");
		
		if($insert_query){
			echo '<script type="text/javascript">alert("Caret Updated Successfully.");
			window.location.replace("AlignItemsInCarets.php")</script>';
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

	<title>Stores dashboard</title>
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
	<script src="JS/PlacePurchaseOrderLink3.js"></script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 			
</head>
<body class="bg-light text-dark">
<header>
	<?php 
   // include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Stores dashboard</h1>
</header>

<div class="wrapper fadeInDown">
	<div id="formContent" class="d-flex flex-row bd-highlight mb-3 justify-content-center">
		<div class="card m-5" style="width: 18rem;">
			<img class="card-img-top" src="../images/RM.jpg" alt="Card image cap">
			<div class="card-body">
				<h3 class="card-title" align="center">Accept / Issue RM for Production</h3>
				<!-- <p class="card-text">Some example text Some example text Some example text Some example text Some example text Some example text </p> -->
				<center><a href="./HandoverToProduction_RaiseRequisition.php" class="btn btn-primary">Navigate</a></center>
			</div>
		</div>

		<div class="card m-5" style="width: 18rem;">
			<img class="card-img-top" src="../images/worker.jpg" alt="Card image cap">
			<div class="card-body">
				<h3 class="card-title" align="center">Job work</h3>
				<!-- <p class="card-text">Some example text Some example text Some example text Some example text Some example text Some example text </p> -->
				<center><a href="./job_workers.php" class="btn btn-primary">Navigate</a></center>
			</div>
		</div>

		<div class="card m-5" style="width: 18rem;">
			<img class="card-img-top" src="../images/quantity.jpg" alt="Card image cap">
			<div class="card-body">
				<h3 class="card-title" align="center">Quantity verification</h3>
				<!-- <p class="card-text">Some example text Some example text Some example text Some example text Some example text Some example text </p> -->
				<center><a href="./PrintQuantityVerification.php" class="btn btn-primary">Navigate</a></center>
			</div>
		</div>

	</div>
</div>
<!--toast script-->
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $('.toast').toast('show');
  });
});
</script>
</body>
</html>
