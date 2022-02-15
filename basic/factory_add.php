<?php
	include("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'admin_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$addr=$_POST['addr'];
		
		$rs=mysqli_query($connection, "SELECT * from factory_details WHERE factory_name='$name'");		
		if(mysqli_num_rows($rs)>0){
			echo '<script type="text/javascript"> alert("Factory already exists.");
			window.location.replace("view_factory.php")</script>';
		}
		else{
			$insert_query=mysqli_query($connection, "INSERT into factory_details VALUES('$name','$addr')");
			if($insert_query){
				echo '<script type="text/javascript">alert("Factory Added Successfully.");
				window.location.replace("view_factory.php")</script>';
			}
			else{
			echo "Error" .mysqli_error($connection);
			}
		}
	};
	
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

	<title>Add Factory Details</title>
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

	<script type="text/javascript">
		
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	<h1 class="display-3" align="center">Add Factory Details</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateCredentialsOfUser.php'">
					Update Credentials Of User
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateMasterPassword.php'">
					Update Master password
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='company_info.php'">
				Manage Company Information
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='view_factory.php'">
				View Factories
				</button>
				
			</div>
		  </div>
</div>
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<br><br><br>
		<form name="form1" method="POST" action="" enctype="multipart/form-data">
		<table style="width:60%" id="formContent" align="center">
			  
			<tr>
				<td align="left" class="form-label" width="50%">Factory Name: </td> 
				<td align="left" width="50%"><input type="text" id="name" class="form-control" name="name">
				</td>
			</tr>
			</tr>
			
		
			<tr>
				<td align="left" class="form-label"><br><br>Factory Address: </td>
				<td align="left"><br><br><textarea id="addr" class="form-control" name="addr" rows="7" cols="50"> </textarea>
				</td>
			</tr>
			
		</table>
			<br><br>
			<p align="center"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Add " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
		</form>
	</div>
</div>
</body>
</html>

<?php mysqli_close($connection); ?>
