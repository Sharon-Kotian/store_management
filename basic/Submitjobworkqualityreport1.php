<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'qc_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}

	if(isset($_POST["submit"]))
	{
		$jw_id=$_POST["jw_id"];
		$_SESSION['jw_id']=$_POST['jw_id'];

		$rs=mysqli_query($connection, "SELECT jw_id from ext_job_work where jw_id='$jw_id'");
		if(mysqli_num_rows($rs)){
			echo '<script>window.location.replace("Submitjobworkqualityreport.php")</script>';
		}
		else{
			echo '<script>alert("Job Worker id does not exists.");
			window.location.replace("Submitjobworkqualityreport1.php")</script>';
		}
		
	}
	mysqli_close($connection);
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

	<title>Submit job work quality report</title>
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
		$("#jw_status").select2();
		$('#but_read').click(function(){
		var username = $('#jw_status option:selected').text();
		var userid = $('#jw_status').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	</SCRIPT>
		<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 		

</head>
<body class="bg-light text-dark">
<header>
	<?php 
    // include "includes/header.php";
	// global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Submit job work quality report</h1>
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
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='QC_Details.php'">
				Quality Check Details
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewQCPOs.php'">
				Historical QC
				</button>
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown">
	<div id="formContent">
	<form name="frm" action="" method="post">
	<table style="width:60%" id="formContent" align="center">
			<tr>		
				<td align="center" style="width: 200px; height: 20px;" class="form-label"><br><br> Job Work ID :  </td>
				<td align="center"><br><br><input type="text" id="jw_id" class="form-control" name="jw_id" style="width: 350px; height: 40px;"></td>
			</tr>	
		</table>
		<br><br>
		<p align="center"><input type="submit"  name="submit" class="btn btn-primary btn-lg" value=" Submit "></p>	
		</form>			
	</div>
</div>

</body>
</html>
