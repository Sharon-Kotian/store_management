<?php
include_once("includes/header.php");
global $connection;
if ($_SESSION['user_dept'] != 'admin_dept') {
	echo '<script type="text/javascript">alert("Access Denied.")';
	header("Location: ../login.html");
}

if (isset($_POST['add'])) {
	$user_name = $_POST['user_name'];
	$user_pass = $_POST['user_pass'];
	$user_pass_confirm = $_POST['user_pass_confirm'];
	$user_dept = $_POST['user_dept'];

	if ($user_pass == $user_pass_confirm) {
		$select = mysqli_query($connection, "SELECT * FROM users WHERE user_name='$user_name'");
		if (mysqli_num_rows($select) > 0) {
			echo '<script type="text/javascript"> alert("Username already exits.")</script>';
		} else {
			if ($user_dept == 'admin_dept') {
				$insert_query = mysqli_query($connection, "INSERT into users (user_name, user_dept, user_pass, user_role) VALUES('$user_name', '$user_dept','$user_pass', 'admin')");
			} else {
				$insert_query = mysqli_query($connection, "INSERT into users (user_name, user_dept, user_pass, user_role) VALUES('$user_name', '$user_dept','$user_pass', 'basic')");
			}

			if ($insert_query) {
				echo '<script type="text/javascript">alert("User Added Successfully.");
					window.location.replace("ManageUsers.php")</script>';
			} else {
				echo '<script type="text/javascript"> alert("Error while Adding User. Please try again.")</script>';
			}
		}
	} else {
		echo '<script type="text/javascript">alert("Passward and Confirm Password are different.");
				window.location.replace("ManageUsers.php")</script>';
	}
};

if (isset($_POST['delete'])) {
	$user_name_delete = $_POST['user_name_delete'];
	$query = mysqli_query($connection, "DELETE FROM users WHERE user_name='$user_name_delete' ");
	if ($query) {
		echo '<script type="text/javascript">alert("User Deleted Successfully.");
			window.location.replace("ManageUsers.php")</script>';
	} else {
		echo "Error" . mysqli_error($connection);
		mysqli_close($connection);
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

	<title>Manage Users</title>
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
		$(document).ready(function() {
			$("#user_name_delete").select2();
			$('#but_read').click(function() {
				var username = $('#user_name_delete option:selected').text();
				var userid = $('#user_name_delete').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});
		$(document).ready(function() {
			$("#user_dept").select2();
			$('#but_read').click(function() {
				var username = $('#user_dept option:selected').text();
				var userid = $('#user_dept').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});

		function ShowProduct() {
			var x = document.getElementById('SectionName');
			var y = document.getElementById('ProductName');
			if (x.style.display == 'none') {
				y.style.display = 'block';
			} else {
				x.style.display = 'none';
				y.style.display = 'block';
			}
		}

		function ShowRowMaterial() {
			var y = document.getElementById('ProductName');
			var x = document.getElementById('SectionName');
			if (y.style.display == 'none') {
				x.style.display = 'block';
			} else {
				y.style.display = 'none';
				x.style.display = 'block';
			}
		}
	</SCRIPT>
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
		<h1 class="display-3" align="center">Manage Users</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='view_factory.php'">
				View Factories
				</button>
			</div>
		</div>
	</div>

	<div class="wrapper fadeInDown">
		<div id="formContent">
			<p align="center"><input type="button" class="btn btn-primary btn-lg" value="  Add User  " ONCLICK="ShowRowMaterial()">
				<input type="button" class="btn btn-primary btn-lg" value=" Delete User " ONCLICK="ShowProduct()">
			</p>

		</div>
		<DIV ID="SectionName" STYLE="display:none">
			<form name="frm" action="ManageUsers.php" method="post">
				<table style="width:70%" align="center">
					<tr align="center">
						<td align="center" class="form-label"><br><br>Select User Department : </td>
						<td align="center"><br><br><select name="user_dept" id="user_dept" style="width: 350px; height: 45px;" class="form-select">
								<option value="purchase_dept">Purchase Department</option>
								<option value="counting_dept">Counting Department</option>
								<option value="goods_receiving">Good Receiving Department</option>
								<option value="qc_dept">Quality Control Department</option>
								<option value="stores_dept">Stores Department</option>
								<option value="production_dept">Production Department</option>
								<option value="rework_dept">Rework Department</option>
								<option value="outward_dept">Outward Department</option>
								<option value="accounts_dept">Accounts Department</option>
								<option value="admin_dept">Admin</option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<td align="center" class="form-label"><br><br>Enter User Name : </td>
						<td align="center"><br><br>
							<input type="text" name="user_name" id="user_name" style="width: 350px; height: 40px;" class="form-control">
						</td>
					</tr>
					<tr>
						<td align="center" class="form-label"><br><br>Enter New Password : </td>
						<td align="center"><br><br><input type="password" id="user_pass" class="form-control" name="user_pass" style="width: 350px; height: 40px;" required></td>
					</tr>
					<tr>
						<td align="center" class="form-label"><br><br>Confirm New Password : </td>
						<td align="center"><br><br><input type="password" id="user_pass_confirm" class="form-control" name="user_pass_confirm" style="width: 350px; height: 40px;" oninput="checkMatch();" required><small style="color: red; display: none;" id="nomatch">Passwords don't match</small></td>
					</tr>
				</table>
				<p align="center"><br><br>
					<?php echo "<input type='submit' name='add' class='btn btn-primary btn-lg' value=' Add ' id='myBtn' style='width: 150px; height: 45px;' align='center' onClick=\"javascript: return confirm('Do you want to add the User?');\">"; ?>
				</p>
			</form>
		</DIV>

		<DIV ID="ProductName" STYLE="display:none">
			<form name="frm" action="" method="post">
				<table style="width:70%" align="center">
					<tr>
						<td align="center" class="form-label"><br><br>Select User Name: </td>
						<td align="center"><br><br><select name="user_name_delete" id="user_name_delete" style="width: 400px; height: 45px;" class="form-select">
								<?php
								$records = mysqli_query($connection, "SELECT user_name from users WHERE user_role!='admin'");
								while ($data = mysqli_fetch_array($records)) {
									if ($data['user_name'] != 'master') {
										echo "<option value='" . $data['user_name'] . "'>" . $data['user_name'] . "</option>";
									}
								}
								?>
							</select>
						</td>
					</tr>
				</table>

				<p align="center"><br><br><br>
					<?php echo "<input type='submit' id= 'clickme' value='Delete' class='btn btn-primary btn-lg' name='delete' onClick=\"javascript: return confirm('Are you sure to delete the User?');\">"; ?> </p>
			</form>
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
									<td align="left" class="form-label"> Do you want to delete this user: </td>
									<td align="left"><input type="text" id="user_id_delete" class="form-control" name="user_id_delete" value="emp4@abc" readonly></td>
								</tr>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Confirm Delete</button>
						</div>
					</div>
				</div>
			</div>
		</DIV>
	</div>
	<!--toast script-->
	<script>
		$(document).ready(function() {
			$("#myBtn").click(function() {
				$('.toast').toast('show');
			});
		});
	</script>

	<script>
		function checkMatch(){
			var pass1 = $("#user_pass").val();
			var pass2 = $("#user_pass_confirm").val();

			if (pass1 != pass2){
				document.getElementById('nomatch').style.display = "block";
				document.getElementById('myBtn').setAttribute('disabled', 'True');
			}
			else{
				document.getElementById('nomatch').style.display = "none";
				document.getElementById('myBtn').removeAttribute('disabled');
			}
		}
	</script>
</body>

</html>
<?php mysqli_close($connection); ?>
