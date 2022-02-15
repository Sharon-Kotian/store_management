<?php
	include_once ("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'admin_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$full_name=$_POST['full_name'];
		$short_name=$_POST['short_name'];
		$full_addr=$_POST['full_addr'];
		$pan=$_POST['pan'];
		$gstin=$_POST['gstin'];
		$email=$_POST['email'];
		
		
		$records=mysqli_query($connection,"SELECT * from company_info");
		$cnt=mysqli_num_rows($records);
		if($cnt==0)
		{
			$query="INSERT INTO company_info VALUES ('1','$full_name','$short_name','$full_addr','$pan','$gstin','$email')";
			$insert_query=mysqli_query($connection, $query);
			if($insert_query)
			{
			echo '<script type="text/javascript">alert("Records Inserted");
					window.location.replace("company_info.php")</script>';
			}
		}
		else
		{
		
		$update_query=mysqli_query($connection, "UPDATE company_info SET company_full_name='$full_name', company_short_name='$short_name', company_full_address='$full_addr', pan='$pan', gstin='$gstin', email='$email'");
		
			if($update_query)
			{
				echo '<script type="text/javascript">alert("Records Updated");
						window.location.replace("company_info.php")</script>';
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

	<title>Manage Company Information</title>
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
	<h1 class="display-3" align="center">Manage Company Information</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateCredentialsOfUser.php'">
				Update Credentials Of User
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='view_factory.php'">
				View Factories
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="frm" method="post" action="" required>
		<table style="width:70%" id="formContent" align="center">
			
				<?php
					$data1=mysqli_query($connection,"SELECT * from company_info");
					$data=mysqli_fetch_array($data1);
					
					$c=mysqli_num_rows($data1);
					if($c>0)
					{
					$full_name=$data['company_full_name'];
					$short_name=$data['company_short_name'];
					$full_addr=$data['company_full_address'];
					$pan=$data['pan'];
					$gstin=$data['gstin'];
					$email=$data['email'];
					
					
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>Company Full Name  </td>";
					echo "<td align='center'><br><br>";
					echo "<input type='text' value='".$full_name."' name='full_name' id='full_name' class='form-control' style='width:300px; height:45px;'></td></tr>";
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>Company Short Name  </td>";
					echo "<td align='center'><br><br>";
					echo "<input type='text' value='".$short_name."' name='short_name' id='short_name' class='form-control' style='width:300px; height:45px;'></td></tr>";
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>Full Address  </td>";
					echo "<td align='center'><br><br>";
					echo "<textarea rows=6 columns=12 name='full_addr' id='full_addr' class='form-control' style='width:300px; height:150px;'>".$full_addr."</textarea></td></tr>";
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>PAN  </td>";
					echo "<td align='center'><br><br>";
					echo "<input type='text' value='".$pan."' name='pan' id='pan' class='form-control' style='width:300px; height:45px;'></td></tr>";
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>GSTIN  </td>";
					echo "<td align='center'><br><br>";
					echo "<input type='text' value='".$gstin."' name='gstin' id='gstin' class='form-control' style='width:300px; height:45px;'></td></tr>";
					
					echo "<tr align='center'>";									
					echo "<td align='center' class='form-label'><br><br>Email ID  </td>";
					echo "<td align='center'><br><br>";
					echo "<input type='text' value='".$email."' name='email' id='email' class='form-control' style='width:300px; height:45px;'></td></tr>";
					}
					else
					{
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>Company Full Name  </td>";
						echo "<td align='center'><br><br>";
						echo "<input type='text' name='full_name' id='full_name' class='form-control' style='width:300px; height:45px;'></td></tr>";
						
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>Company Short Name  </td>";
						echo "<td align='center'><br><br>";
						echo "<input type='text' name='short_name' id='short_name' class='form-control' style='width:300px; height:45px;'></td></tr>";
						
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>Full Address  </td>";
						echo "<td align='center'><br><br>";
						echo "<textarea rows=6 columns=12 name='full_addr' id='full_addr' class='form-control' style='width:300px; height:150px;'></textarea></td></tr>";
						
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>PAN  </td>";
						echo "<td align='center'><br><br>";
						echo "<input type='text' name='pan' id='pan' class='form-control' style='width:300px; height:45px;'></td></tr>";
						
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>GSTIN  </td>";
						echo "<td align='center'><br><br>";
						echo "<input type='text' name='gstin' id='gstin' class='form-control' style='width:300px; height:45px;'></td></tr>";
						
						echo "<tr align='center'>";									
						echo "<td align='center' class='form-label'><br><br>Email ID  </td>";
						echo "<td align='center'><br><br>";
						echo "<input type='text' name='email' id='email' class='form-control' style='width:300px; height:45px;'></td></tr>";
					}
					
				?>
		</table><br><br><br>
		<center><input type="submit" name="submit" id="submit" value="Update" class="btn btn-primary btn-lg"></center>
	</form>
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
