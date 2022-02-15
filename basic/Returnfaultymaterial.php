<?php
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST["submit"]))
	{
		$faulty_production_id=$_POST["faulty_production_id"];
		$_SESSION['faulty_production_id']=$_POST['faulty_production_id'];
		echo '<script>window.location.replace("Returnfaultymaterial1.php")</script>';
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

	<title>Return faulty material</title>
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
			$("#faulty_production_id").select2();
			$('#but_read').click(function(){
				var username = $('#faulty_production_id option:selected').text();
				var userid = $('#faulty_production_id').val();
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
	<h1 class="display-3" align="center">Return faulty material</h1>
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
			<div class="dropdown mt-3">
				<div class="dropdown mt-3" align="center">
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial.php'">
					Accept Raw Material
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Add Production Estimation.php'">
					Add Production Estimation
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submit finished goods.php'">
					Submit Finished Goods
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
</div>
	
	<div class="wrapper fadeInDown">
	<div id="formContent">
		<form method="post" action="">
		<table style="width:100%" id="formContent">
			<tr>
				<td align="center" class="form-label"><br><br>Faulty Production Name: </td>
				<td align="center"><br><br><select name="faulty_production_id" id="faulty_production_id" style="width: 300px; height: 50px;" required>
                 	<?php
                 	$date=date('Y-m-d');
                        $sql1 = "SELECT prod_name FROM production WHERE prod_require_date='$date' AND prod_status='RawMaterial Accepted'";
                        $result = $connection->query($sql1);

                        if ($result->num_rows > 0) {                          
                            while($row = $result->fetch_assoc()) {
                            	echo "<option value='".$row['prod_name']."'>".$row['prod_name'];" </option>";
                            }
                        }
                    ?>
				</select> 
				</td>
			</tr>				
		</table>
			<br>
			<p align="center"> <input type="submit" name="submit" class="btn btn-primary btn-lg temp" value=" Submit "></p>
			
			  <br><br>
		</form>
	</div>
</div>
</body>
</html>
