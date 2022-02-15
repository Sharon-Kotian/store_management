<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'rework_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$faulty_material_name=$_POST['faulty_material_name'];
		$faulty_rework_quantity=$_POST['faulty_rework_quantity'];
		$faulty_rework_eta=$_POST['faulty_rework_eta'];

		$faulty_rework_eta=date('Y-m-d', strtotime( '+'.$faulty_rework_eta.' days'));
		//echo $faulty_rework_eta;

		$rs=mysqli_query($connection, "SELECT faulty_material_name AND faulty_rework_quantity FROM faulty_goods WHERE faulty_material_name='$faulty_material_name' AND faulty_rework_quantity='$faulty_rework_quantity'");
		if(mysqli_num_rows($rs)){
			$insert_query=mysqli_query($connection, "UPDATE faulty_goods SET faulty_rework_eta='$faulty_rework_eta', faulty_status='Accepted to Rework' WHERE faulty_material_name='$faulty_material_name' and faulty_rework_quantity='$faulty_rework_quantity'");
		}
		if($insert_query){
			echo '<script type="text/javascript">alert("Rework Estimated Successfully.");
			window.location.replace("ReworkEstimation.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
			echo '<script>window.location.replace("ReworkEstimation.php")</script>';
		}

	}
	//mysqli_close($connection);
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

	<title>Rework Estimated</title>
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
		
	</SCRIPT>
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
	<h1 class="display-3" align="center">Rework Estimation</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ReworkEstimation.php'">
					Rework Estimation
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateReworkStatus.php'">
					Update Rework Status
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" method="post" action="">
		<table style="width:40%" id="formContent" align="center">
			
			<tr align="left">
			<?php
				$rs=mysqli_query($connection, "SELECT faulty_material_name, faulty_rework_quantity FROM faulty_goods WHERE faulty_action='Rework' AND faulty_status='Submitted to Rework' ORDER BY faulty_id ASC LIMIT 1");
				while($data=mysqli_fetch_array($rs)){
				?>		
				
					<td align="left" style="width: 200px; height: 20px;" class="form-label"><br><br> Material Name :  </td>
					<td align="center"><br><br><input type="text" id="faulty_material_name" class="form-control" name="faulty_material_name" value="<?php echo $data['faulty_material_name']; ?>" style="width: 300px; height: 40px;" readonly></td>
				</tr>
				<tr>
					<td align="left" style="width: 200px; height: 20px;" class="form-label"><br><br> Quantity:  </td>
					<td align="center"><br><br><input type="number" id="faulty_rework_quantity" class="form-control" name="faulty_rework_quantity" value="<?php echo $data['faulty_rework_quantity']; ?>" style="width: 300px; height: 40px;" readonly></td>
			</tr>
			
			<tr>
				<br><br>
						
				<td align="left" style="width: 300px; height: 20px;" class="form-label"> <br><br>Estimated time in days:  </td>
				<td align="center"><br><br><input type="number" id="faulty_rework_eta" class="form-control" name="faulty_rework_eta" style="width: 300px; height: 40px;"></td>						
				
				
			</tr>
		</table><br><br>
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value=" Submit " id="myBtn" name="submit"></p>
		<?php
				}
			?>
		</form>	

			<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Submitted!!
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
</script>
</body>
</html>
<?php mysqli_close($connection); ?>
