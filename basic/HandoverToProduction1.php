<?php
include_once("includes/header.php");
global $connection;

if ($_SESSION['user_dept'] != 'stores_dept') {
	echo '<script type="text/javascript">alert("Access Denied.")';
	header("Location: ../login.html");
}

if (isset($_POST['update'])) {
	$pr_id = $_POST['pr_id'];
	$pr_product_name = $_POST['pr_product_name'];
	$pr_required_quantity = $_POST['pr_required_quantity'];
	$pr_remaining_quantity = $_POST['pr_remaining_quantity'];
	$quantity = $_POST['quantity'];

	$prod_require_date = $_SESSION['prod_require_date'];

	foreach ($pr_product_name as $index => $values) {
		$tot = $pr_required_quantity[$index];
		$query = mysqli_query($connection, "SELECT pr_submitted_quantity from product_requisition WHERE pr_id='$pr_id[$index]'");
		$data = mysqli_fetch_array($query);
		if (mysqli_num_rows($query) > 0) {
			$existing_quantity = $data['pr_submitted_quantity'];

			if (($tot - $existing_quantity) == $quantity[$index]) {			//Exact required (i.e. remaining) quantity is provided
				$insert_query = mysqli_query($connection, "UPDATE product_requisition SET pr_submitted_quantity=pr_submitted_quantity+'$quantity[$index]', pr_submitted_date=NOW(), pr_status='Handed to Production' WHERE pr_id='$pr_id[$index]' and pr_material_name='$pr_product_name[$index]'");
				$insert_query1 = mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity=rm_stores_quantity - '$quantity[$index]' WHERE rm_name='$pr_product_name[$index]'");
			} elseif ($quantity[$index] == 0 || $quantity[$index] == '') {
				continue;
			} elseif (($tot - $existing_quantity) > $quantity[$index]) {		//Partial required (i.e. remaining) quantity is provided
				$insert_query = mysqli_query($connection, "UPDATE product_requisition SET pr_submitted_quantity=pr_submitted_quantity+'$quantity[$index]', pr_submitted_date=NOW(), pr_status='Partially to Prod' WHERE pr_id='$pr_id[$index]' and pr_material_name='$pr_product_name[$index]'");
				$insert_query1 = mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity=rm_stores_quantity - '$quantity[$index]' WHERE rm_name='$pr_product_name[$index]'");
			} elseif (($tot - $existing_quantity) < $quantity[$index]) {
				echo '<script>alert("One or more Raw Materials Quantity have been exceeded.");
					window.location.replace("HandoverToProduction1.php")</script>';
			}
		}
	}
	$rs = mysqli_query($connection, "SELECT count(pr_product_id) from product_requisition WHERE pr_product_id='$pr_id[$index]' ");
	$rs1 = mysqli_query($connection, "SELECT count(pr_product_id) from product_requisition WHERE pr_product_id='$pr_id[$index]' AND pr_required_quantity=pr_submitted_quantity ");
	$data = mysqli_fetch_array($rs);
	$data1 = mysqli_fetch_array($rs1);
	if ($data[0] == $data1[0]) {
		$update_query = mysqli_query($connection, "UPDATE production SET prod_status='Handed to Production' WHERE prod_name='$pr_product_name[$index]' AND prod_require_date='$prod_require_date' ");
		if ($insert_query && $update_query) {
			echo '<script type="text/javascript">alert("Handover To Production Successfully.");
				window.location.replace("HandoverToProduction.php")</script>';
		}
	} else {
		$update_query1 = mysqli_query($connection, "UPDATE production SET prod_status='Partially to Prod' WHERE prod_name='$pr_product_name' AND prod_require_date='$prod_require_date' ");
		if ($insert_query && $update_query1) {
			echo '<script type="text/javascript">alert("Partially Handed Over To Production Successfully.")</script>';
		}
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
			<form name="frm" method="post" action=""><br>
				<?php
				$prod_id = $_SESSION['prod_name'];
				$prod_require_date = $_SESSION['prod_require_date'];
				//$result=mysqli_query($connection, "SELECT * FROM product_requisition WHERE `pr_product_id`='$prod_id' AND `pr_required_date`='$prod_require_date'");
				$result = mysqli_query($connection, "SELECT * FROM product_requisition WHERE `pr_product_id`='$prod_id' AND date_format(pr_required_date, '%Y-%m-%d')='$prod_require_date'");

				$data = mysqli_fetch_array($result);
				//$prod_quantity=$data['prod_quantity'];
				$prod_name = $data['pr_product_name'];
				$prod_colour = $data['pr_body_colour'];
				?>
				<table style="width:70%" id="formContent" align="center">
					<tr>
						<td align="right" class="fadeIn fourth" style="width: 300px; height: 50px;"><b>Product Name:</b></td>
						<td align="center"><input type="text" id="prod_name" class="form-control" name="prod_name" value="<?php echo $prod_name; ?>" style="width:400px; height: 40px;" readonly></td>
					</tr>
					<tr>
						<td align="right" class="fadeIn fourth" style="width: 300px; height: 50px;"><b>Color of Product Body:</b></td>
						<td align="center"><input type="text" id="color" class="form-control" name="color" value="<?php echo $prod_colour; ?>" style="width:400px; height: 40px;" readonly></td>
					</tr>
				</table><br><br>
				<table style="width:80%" id="formContent" class="table table-bordered" align="center">
					<tr align="center">
						<td class="fadeIn fourth" style="width: 100px; height: 50px;"><b>Sr. No.</b></td>
						<td class="fadeIn fourth" style="width: 600px; height: 50px;"><b>Raw Material Name</b></td>
						<td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>Total Raw Material Quantity</b></td>
						<td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>Remaining Quantity</b></td>
						<td class="fadeIn fourth" style="width: 200px; height: 50px;"><b>Quantity</b></td>
					</tr>
					<?php
					if (mysqli_num_rows($result)) {
						//$rs=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$prod_name'");
						$sr_no = 0;
						//$result_query=mysqli_query($connection, "SELECT * FROM product_requisition WHERE `pr_product_id`='$prod_id' AND `pr_required_date`='$prod_require_date' AND pr_submitted_quantity!=pr_required_quantity");
						$result_query = mysqli_query($connection, "SELECT * FROM product_requisition WHERE `pr_product_id`='$prod_id' AND date_format(pr_required_date, '%Y-%m-%d')='$prod_require_date' AND pr_submitted_quantity!=pr_required_quantity");
						while ($row = mysqli_fetch_array($result_query)) {
							$pr_id = $row['pr_id'];
							$pr_product_id = $row['pr_product_id'];
							$pr_product_name = $row['pr_product_name'];
							$pr_material_name = $row['pr_material_name'];
							$pr_remaining_quantity = $row['pr_required_quantity'] - $row['pr_submitted_quantity'];


							//$_SESSION['fps_id']=$fps_id;
							//$search=mysqli_query($connection, "SELECT * from finished_product_details WHERE fps_id='$fps_id' AND fpd_material_quantity*'".$_SESSION['prod_quantity']."'!=fpd_submitted_quantity");

							$sr_no++;
					?>
							<tr align="center">
								<td><input type="hidden" name="pr_id[]" id="pr_id" value="<?php echo $pr_id; ?>">
									<?php echo $sr_no; ?></td>
								<td><input type="text" class="form-control" name="pr_product_name[]" value="<?php echo $pr_material_name; ?>" id="pr_product_name" style="width: 100%" readonly></td>
								<td><input type="text" class="form-control" name="pr_required_quantity[]" value="<?php echo $row['pr_required_quantity']; ?>" id="pr_required_quantity" style="width: 100%" readonly></td>
								<td><input type="number" class="form-control" name="pr_remaining_quantity[]" id="pr_remaining_quantity" style="width: 100%" value="<?php echo $pr_remaining_quantity; ?>" readonly></td>
								<td><input type="number" class="form-control" name="quantity[]" id="quantity" style="width: 100%"></td>
							</tr>
					<?php

						}
					} else {
						echo '<script type="text/javascript">alert("No data available for this date");
					window.location.replace("HandoverToProduction.php")</script>';
					}
					?>

				</table><br><br>
				<p align="center">
					<input type="submit" class="btn btn-primary btn-lg" value="Handover To Production" id="myBtn" name="update">
				</p>
				<br>

			</form>
</body>

</html>
<?php mysqli_close($connection); ?>