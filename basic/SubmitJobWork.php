<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	if(isset($_POST['submit'])){
		$igs_name=$_POST['igs_name'];
		$rm_counting_quantity=$_POST['rm_counting_quantity'];

		$_SESSION['igs_name']=$_POST['igs_name'];
		$_SESSION['rm_counting_quantity']=$_POST['rm_counting_quantity'];

		echo '<script>window.location.replace("SubmitJobWork1.php")</script>';
		
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

	<title>Submit Job work</title>
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
		/*$(document).ready(function(){
		$("#rm_name").select2();
		$('#but_read').click(function(){
		var username = $('#rm_name option:selected').text();
		var userid = $('#rm_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});*/
	

	$(document).ready(function(){
		$("#igs_name").select2();
		$('#but_read').click(function(){
		var username = $('#igs_name option:selected').text();
		var userid = $('#igs_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	
	
	
	</script>
<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
</head>
<body class="bg-light text-dark">
<header>
	<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Submit Job work</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>

				<hr>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Jobwork In(Accept Material) 
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_work_receivable.php'">
				Jobwork Receivable
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Data
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Manage intermediate goods.php'">
				Manage Intermediate Goods
				</button><br><br>
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button>
			</div>
		</div>
	</div>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post" action="">
			
		<table style="width:60%" id="formContent" align="center">	
			<tr>
				<td align="center" class="form-label"><br><br> Intermediate Goods Name: </td>
				<td align="center"><br><br>
					<select name="igs_name" id="igs_name" style="width: 300px; height: 50px;" required>
						<?php 
							$records=mysqli_query($connection,"SELECT igs_name from inter_goods_summary");
							while($data=mysqli_fetch_array($records)){
								echo "<option value='".$data['igs_name']."'>".$data['igs_name']."</option>";
							}
						?>
					</select> 
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Quantity of expected intermediate goods: </td>
				<td align="center"><br><br><input type="number" id="rm_counting_quantity" class="form-control" name="rm_counting_quantity" style="width: 300px; height: 40px;" required></td>
				<br><br>
			</tr>
		
		</table>
			<br><br><br>
			<p align="center"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Create " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
		</form>
		<br><br>
		
	</div>
</body>
</html>

<?php mysqli_close($connection); ?>
