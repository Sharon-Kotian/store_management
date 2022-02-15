<?php
	include_once ("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'admin_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$user_name=$_POST['user_name'];
		$user_pass=$_POST['user_pass'];

		$user_name=mysqli_real_escape_string($connection,$user_name);
		$user_pass=mysqli_real_escape_string($connection,$user_pass);

		$insert_query=mysqli_query($connection, "UPDATE users SET user_pass='$user_pass' WHERE user_name='$user_name'");
		if($insert_query){
			echo '<script type="text/javascript">alert("Passward Updated Successfully.");
			window.location.replace("UpdateCredentialsOfUser.php")</script>';
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

	<title>Update Credentials Of User</title>
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
	<SCRIPT>
	$(document).ready(function(){
		$("#user_name").select2();
		$('#but_read').click(function(){
		var username = $('#user_name option:selected').text();
		var userid = $('#user_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	</SCRIPT>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
 //   include "../includes/header.php";
 //	global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Update Credentials Of User</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageUsers.php'">
				Manage Users
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateMasterPassword.php'">
				Update Master password
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='company_info.php'">
				Manage Company Information
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='view_factory.php'">
				View Factories
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="frm" method="post" action="">
		<table style="width:70%" id="formContent" align="center">
			<tr align="center">									
				<td align="center" class="form-label"><br><br>Select User Name : </td>
				<td align="center"><br><br>
				<select name="user_name" id="user_name" style="width: 250px; height: 40px;" class="form-control" name="user_name">
					<?php 
						$records=mysqli_query($connection,"SELECT user_name from users");
						while($data=mysqli_fetch_array($records)){
							if($data['user_name'] != 'master'){
								echo "<option value='".$data['user_name']."'>".$data['user_name']."</option>";
							}
						}
					?>
				</select> 
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Enter New Password : </td>
				<td align="center"><br><br><input type="password" id="user_pass" class="form-control" name="user_pass" style="width: 250px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Confirm New Password : </td>
				<td align="center"><br><br><input type="password" id="user_pass_confirm" class="form-control" name="user_pass" style="width: 250px; height: 40px;" oninput="checkMatch();" required><small style="color: red; display: none;" id="nomatch">Passwords don't match</small></td>
			</tr>
		</table><br><br><br>
		<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Update " data-bs-toggle="modal" data-bs-target="#exampleModal" id="submit"></p>	
	</form>
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Confirm Update</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Do you want to Update the password?</td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm Update</button>
				  </div>
				</div>
			  </div>
		</div>
	</div>
</div>

</body>

<script>
	function checkMatch(){
		var pass1 = $("#user_pass").val();
		var pass2 = $("#user_pass_confirm").val();

		if (pass1 != pass2){
			document.getElementById('nomatch').style.display = "block";
			document.getElementById('submit').setAttribute('disabled', 'True');
		}
		else{
			document.getElementById('nomatch').style.display = "none";
			document.getElementById('submit').removeAttribute('disabled');
		}
	}
</script>

</html>
