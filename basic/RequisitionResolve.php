<?php
include_once("includes/header.php");
global $connection;

if ($_SESSION['user_dept'] != 'stores_dept') {
	echo '<script type="text/javascript">alert("Access Denied.")';
	header("Location: ../login.html");
}

if (isset($_POST['update'])) {
	$rr_id = $_POST['rr_id'];
	$rr_material_name = $_POST['rr_material_name'];
	$rr_material_quantity = $_POST['rr_material_quantity'];
	$rr_remaining_quantity = $_POST['rr_remaining_quantity'];
	$quantity = $_POST['quantity'];


	$insert_query = 0;
	$insert_query1 = 0;
	foreach ($rr_id as $index => $values) {
		$tot = $rr_id[$index];
		$query = mysqli_query($connection, "SELECT rr_remaining_quantity,rr_new_quantity from raise_requisition WHERE rr_id='$rr_id[$index]'");
		$data = mysqli_fetch_array($query);

		if (mysqli_num_rows($query) > 0) {
			$existing_quantity = $data['rr_remaining_quantity'];

			if (($existing_quantity) == $quantity[$index]) {
				$insert_query = mysqli_query($connection, "UPDATE raise_requisition SET rr_remaining_quantity=rr_remaining_quantity - '$quantity[$index]', rr_submit_date=NOW(), rr_new_quantity= '$quantity[$index]', rr_status='Handed to Prod' WHERE rr_id='$rr_id[$index]'");
				$insert_query1 = mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity=rm_stores_quantity - '$quantity[$index]' WHERE rm_name='$rr_material_name[$index]'");
				echo '$quanity[$index]';
				//echo '<script>alert("Quantity added.")</script>';
				//echo '<script>window.location.replace("RequisitionResolve.php")</script>';

			} elseif (($existing_quantity) < $quantity[$index]) {
				echo '<script>alert("New quantity is greater than existing quantity.")</script>';
				echo '<script>window.location.replace("RequisitionResolve.php")</script>';
			} elseif (($existing_quantity) > $quantity[$index]) {
				$insert_query = mysqli_query($connection, "UPDATE raise_requisition SET rr_remaining_quantity=rr_remaining_quantity - '$quantity[$index]', rr_submit_date=NOW(), rr_new_quantity= '$quantity[$index]', rr_status='Partially to Prod' WHERE rr_id='$rr_id[$index]'");
				$insert_query1 = mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity=rm_stores_quantity - '$quantity[$index]' WHERE rm_name='$rr_material_name[$index]'");
				//echo '<script>alert("Quantity added.")</script>';
				//echo '<script>window.location.replace("RequisitionResolve.php")</script>';
			}
		}
	}
	if ($insert_query && $insert_query1) {
		echo '<script>alert("Quantity added.")</script>';
		echo '<script>window.location.replace("RequisitionResolve.php")</script>';
	}
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

	<title>Handover To Production</title>
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
		function ShowRowMaterial() {
			var y = document.getElementById('ProductName');
			var x = document.getElementById('SectionName');
			if (y.style.display == 'none') {
				x.style.display = 'block';
			} else {
				y.style.display = 'none';
			}
		}
	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " />
</head>

<body class="bg-light text-dark">
	<header>
		<?php
		//include "../includes/header.php";

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		?>

		<hr style="height:2px" color="black">
		<h1 class="display-3" align="center">Handover To Production</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitMaterialToRework.php'">
					Submit Material To Rework
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
		<div id="formContent">
			<p align="center"><a class="btn btn-primary btn-lg" href="HandoverToProduction.php">Product wise</a>
				<a class="btn btn-primary btn-lg" href="RequisitionResolve.php">Raw material wise</a>
			</p>
		</div>
	</div>

	<div class="wrapper fadeInDown">
		<div id="formContent">
			<form name="frm" method="post" action="">
				<table style="width:70%" align="center" id="dateTable">
					<tr>
						<td align="right" class="fadeIn fourth" style="width: 300px; height: 50px;"><br><br><b>Date:</b></td>
						<td align="center"><br><br><input type="date" id="rr_req_date" name="rr_req_date" class="form-control" style="width:200px; height: 40px;"></td>
						<td><br><br><input type='submit' id='clickme' value='Display' class='btn btn-primary btn-lg' name='datewise'></td>
					</tr>
				</table><br><br>

				<?php
				if (isset($_POST['datewise'])) {
					$rr_req_date = $_POST['rr_req_date']; ?>
					<table border="1px" align="center" class="table table-bordered" style='width:90%' onclick="displaySubmit()">
						<tr align="center">
							<th align="center">Requisition number</th>
							<th align="center" style="width: 35%;">Requisition Material Name</th>
							<th align="center">Requisition Date</th>
							<th align="center">Requisition Colour</th>
							<th align="center">Total Quantity</th>
							<th align="center">Remaining Quantity</th>
							<th align="center">New Quantity</th>
						</tr>

						<?php
						try {
							//$query=mysqli_query($connection, "SELECT * from raise_requisition where date_format(rr_req_date, '%Y-%m-%d')='$rr_req_date' AND (rr_status='Raw Material Estimated' OR rr_status='Partially to Prod')");
							$query = mysqli_query($connection, "SELECT * from raise_requisition where date_format(rr_req_date, '%Y-%m-%d')='$rr_req_date' AND (rr_status='Raw Material Estimated' OR rr_status='Partially to Prod')");
						} catch (Exception $e) {
							echo '<script>alert("No materials on this date")</script>';
							echo '<script>window.location.replace("RequisitionResolve.php")</script>';
						}
						//finally
						//{
						//nothing here
						//}
						while ($row = mysqli_fetch_array($query)) { ?>
							<tr style="font-size:22px">
								<td><input type="number" class="form-control" name="rr_id[]" id="rr_id" value="<?php echo $row['rr_id']; ?>" readonly></td>
								<td><input type="text" class="form-control" name="rr_material_name[]" value="<?php echo $row['rr_material_name']; ?>" id="rr_material_name" style="width: 100%" readonly></td>
								<td><input type="text" class="form-control" name="rr_req_date[]" value="<?php echo $row['rr_req_date']; ?>" id="rr_req_date" style="width: 100%" readonly></td>
								<td><input type="text" class="form-control" name="rr_body_colour[]" value="<?php echo $row['rr_body_colour']; ?>" id="rr_body_colour" style="width: 100%" readonly></td>
								<td><input type="text" class="form-control" name="rr_material_quantity[]" value="<?php echo $row['rr_material_quantity']; ?>" id="rr_material_quantity" style="width: 100%" readonly></td>
								<td><input type="text" class="form-control" name="rr_remaining_quantity[]" value="<?php echo $row['rr_remaining_quantity']; ?>" id="rr_remaining_quantity" style="width: 100%" readonly></td>
								<td><input type="number" class="form-control" name="quantity[]" id="quantity" style="width: 100%"></td>
							</tr>
					<?php
						}
					}
					?>
					</table>
					<p align="center">
						<input type="submit" class="btn btn-primary btn-lg" value="Submit" id="myBtn" name="update" style="display: none;">
					</p>
			</form>
			<!--  Toast code -->
			<div style="position: absolute; bottom: 0; right: 0;" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="d-flex">
					<div class="toast-body" text="center">
						Successfully Updated!!
					</div>
					<button type="button" id="mybtn" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
			</div>
		</div>
	</div>
	<!--toast script-->
	<script>
		$(document).ready(function() {
			$("#myBtn").click(function() {
				$('.toast').toast('show');
			});
		});

		function displaySubmit() {
			document.getElementById('myBtn').style.display = "block";
			document.getElementById('dateTable').style.display = "none";
		}
	</script>
</body>

</html>
<?php mysqli_close($connection); ?>