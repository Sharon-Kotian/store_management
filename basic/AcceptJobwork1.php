<?php 
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$jw_actual_date=$_POST['jw_actual_date'];
		$ew_id=$_POST['ew_name'];
		$searchoption = $_POST['searchoption'];
		$JWChallanNumber = $_POST['JWChallanNumber'];

		$_SESSION['ew_id']=$_POST['ew_name'];
		$_SESSION['jw_actual_date']=$_POST['jw_actual_date'];
		$_SESSION['searchoption']=$_POST['searchoption'];
		$_SESSION['JWChallanNumber']=$_POST['JWChallanNumber'];

		echo '<script>window.location.replace("AcceptJobWork.php")</script>';
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

	<title>Job work in</title>
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
		$(document).ready(function(){
		$("#ew_name").select2();
		$('#but_read').click(function(){
		var username = $('#ew_name option:selected').text();
		var userid = $('#ew_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	</script>
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
	<h1 class="display-3" align="center">Job work in</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Jobwork Out(Issue Material)
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
		<form name="frm" method="post" action="">
			<table style="width:60%;" id="formContent" align="center" class="p-2">
				<tr align="center">		
					<br>
					<td align="center" class="form-label" style="width:20%;"><strong>Date</strong></td>
					<td align="center"><input type="text" id="jw_actual_date" class="form-control" name="jw_actual_date" style="width: 250px; height: 40px;" readonly>
					<script>
						var today = new Date();
						var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
						document.getElementById("jw_actual_date").value = date;
					</script></td>
				</tr>
				<tr align="center">
					<td align="center" class="form-label" style="width:20%;"><br><br><strong>Please enter</strong></td>
					<td>
						<br><br>
						<table style="width: 80%;">
							<tr>
								<td style="width: 10%;">
									<input type="radio" id="searchoption_challan" name="searchoption" value="JWChallanNumber_select" onclick="enableChallan();" required>
								</td>
								<td style="width: 30%;">JW Challan No.</td>
								<td style="width: 60%;" align="center">
									<input type="text" id="JWChallanNumber" name="JWChallanNumber" class="form-control" style="width: 80%;">
								</td>
							</tr>

							<tr>
								<td colspan="3" align="center">
									<br>
									<strong>OR</strong>
								</td>
							</tr>

							<tr>
								<td>
									<br><input type="radio" id="searchoption_worker" name="searchoption" value="ew_name_select" onclick="enableWorker();" required>
								</td>
								<td><br>Name of Jobworker</td>
								<td align="center">
									<br>
									<select name="ew_name" id="ew_name" style="width: 80%;">
										<option value="">Select job-worker</option>
										<?php 
											$records=mysqli_query($connection,"SELECT ew_id, ew_name from ext_worker where not ew_status = 'Deleted'");
											while($data=mysqli_fetch_array($records)){
												echo "<option value='".$data['ew_id']."'>".$data['ew_name']."</option>";
											}
										?>
									</select>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		<br><br><br>
		
		<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="Search" id="print"></p>
		</form>	
				<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body" text="center">
				    Searching for Data!!
				</div>
				<button type="button"  id="mybtn"class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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


function enableWorker(){
	document.getElementById('JWChallanNumber').setAttribute('readonly', 'True');
	document.getElementById('ew_name').removeAttribute('readonly');
	document.getElementById('ew_name').removeAttribute('disabled');
	document.getElementById('ew_name').setAttribute('required', 'True');
	document.getElementById('JWChallanNumber').value = "";
	document.getElementById('JWChallanNumber').removeAttribute('required');
}


function enableChallan(){
	document.getElementById('ew_name').setAttribute('readonly', 'True');
	document.getElementById('ew_name').setAttribute('disabled', 'True');
	document.getElementById('ew_name').removeAttribute('required');
	document.getElementById('JWChallanNumber').removeAttribute('readonly');
	document.getElementById('JWChallanNumber').setAttribute('required', 'True');
}
</script>
</script>
</body>
</html>
