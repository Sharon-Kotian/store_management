<?php 
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	if(isset($_POST['submit'])){
		$faulty_id=$_POST['faulty_id'];
		$faulty_action=$_POST['faulty_action'];
		$faulty_submit_date=date("Y-m-d H:i:s");
		date_default_timezone_set('Asia/Kolkata');
		foreach ($faulty_action as $index => $values) {

			if($values=='Return'){
				$insert_query=mysqli_query($connection, "UPDATE faulty_goods SET faulty_status='Submitted to Return', faulty_submit_date='$faulty_submit_date' WHERE faulty_id='$faulty_id[$index]' AND faulty_status='Returned To Stores'");
			}
			elseif ($values=='Rework') {
				$insert_query=mysqli_query($connection, "UPDATE faulty_goods SET faulty_status='Submitted to Rework', faulty_submit_date='$faulty_submit_date' WHERE faulty_id='$faulty_id[$index]' AND faulty_status='Returned To Stores'");
			}
			else{
				$insert_query=mysqli_query($connection, "UPDATE faulty_goods SET faulty_status='Submitted to Scrap', faulty_submit_date='$faulty_submit_date' WHERE faulty_id='$faulty_id[$index]' AND faulty_status='Returned To Stores'");
			}
		}
		if($insert_query){
			echo '<script type="text/javascript">alert("Material Added to Rework Successfully.");
			window.location.replace("SubmitMaterialToRework.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
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

	<title>Submit Material To Rework</title>
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
	
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 		
	
</head>
<body class="bg-light text-dark">
<header>
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Submit Material To Rework</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HandoverToProduction_RaiseRequisition.php'">
				Handover To Production
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				View Pending Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical Requisition
				</button>			
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
		<form name="frm" action="" method="post"> 
			<table border="1px" align="center" class="table table-bordered" style="width:90%">
			<tr style="font-size:28px">
			  <td class="fadeIn fourth" style="width: 150px; height: 50px;" align="center"><b>Sr No</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Material Name</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;"align="center"><b>Return Quantity</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Rework Quantity</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Scrap Quantity</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Action To Be Taken</b></td>
			</tr>
			<?php
				$query=mysqli_query($connection, "SELECT faulty_id,faulty_material_name, faulty_return_quantity, faulty_rework_quantity, faulty_scrape_quantity, faulty_action from faulty_goods WHERE faulty_status='Returned To Stores'");
				$sr_no =0;
				while($row=mysqli_fetch_array($query)){
				$sr_no++;
			?>
					<tr style="font-size:22px">
						<td align="center"><input type="hidden" name="faulty_id[]" value="<?php echo $row['faulty_id']; ?>" readonly><?php echo $sr_no; ?></td>
						<td align="center"><?php echo $row['faulty_material_name']; ?></td>
						<td align="center"><?php echo $row['faulty_return_quantity']; ?></td>
						<td align="center"><?php echo $row['faulty_rework_quantity']; ?></td>
						<td align="center"><?php echo $row['faulty_scrape_quantity']; ?></td>
						<td align="center"><input type="text" name="faulty_action[]" id="faulty_action" value="<?php echo $row['faulty_action']; ?>" readonly></td>
					</tr>
					<?php
				}
			?>
		</table><br>
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value=" Submit " name="submit"></p>
		</form>			
	</div>
</div>

</body>
</html>
<?php mysqli_close($connection); ?>
