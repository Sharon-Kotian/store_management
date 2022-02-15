<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}

	if(isset($_POST['submit'])){
		$password = $_POST['masterpassword'];
		$pass_match = false;

		$pass_result = mysqli_query($connection, "SELECT user_pass FROM users WHERE user_name='master'");
		while($data=mysqli_fetch_array($pass_result)){
			$master_password = $data['user_pass'];

			if($master_password == $password){
				$pass_match = true;
				break;
			}

			else{
				$pass_match = false;
			}
		}

		$_SESSION['pass_match']= $pass_match;

		if($pass_match){
			echo '<script type="text/javascript">window.location.replace("edit_counted_quantity.php")</script>';
		}

		else{
			echo '<script type="text/javascript">alert("Please enter correct password");
			window.location.replace("EditCountedQuantity_Gatekeeper.php")</script>';
		}
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

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

	<title>Edit Counted Quantity</title>
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
</head>
<body class="bg-light text-dark">
	<?php
	?>
	<header>
	<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Edit Counted Quantity</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='Updatecountingquantity.php'">
				Update Counting Quantity
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToQualityCheck.php'">
				Handover To Quality Check
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofCountedGoods.php'">
				List of Counted Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='CountingDetails.php'">
				Counting details
				</button>
			</div>
		</div>
</div>
<div class="wrapper fadeInDown">	
	<div class="row" align="center">
		<form method="post">
			<br><br>
			<table style="width: 50%;">
				<tr>
					<td align="right"><label class="form-label m-5">Enter master password</label></td>
					<td align="left"><input type="password" id="masterpassword" name="masterpassword" class="form-control m-5" style="width: 70%;"></td>
				</tr>
			</table>

			<br>
			<input type="submit" id="password_submit" class="btn btn-primary btn-lg" value="Submit" name="submit">
		</form>
	</div>
</div>
</body>
</html>