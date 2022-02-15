<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'purchase_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!--link rel="stylesheet" href="CSS/PlacePurchaseOrder.css"-->
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

	<title>Monitor reorder materials</title>
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
		
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	

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
	<h1 class="display-3" align="center">Monitor reorder materials</h1>
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
		  		  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PlacePurchaseOrder.php'">
					Place Purchase Order
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddRawMaterialfortheProduct.php'">
					Add New Raw Material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageReorderLevel1.php'">
					Manage Reorder Level
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPendingPOs.php'">
					View pending POs
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='rawmaterialsoverview.php'">
					Raw Materials Overview
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewBOM.php'">
					View BOM
				  </button><br><br>				  
                  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='closePO.php'">
					Close PO
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 75px;" onClick="parent.location='UpdateStockQuantityForMaterial.php'">
					Update stock quantity for material
				  </button>			  
			</div>
		  </div>
</div>
	
	<div class="wrapper fadeInDown">
  <div id="formContent">
  <br><br><br>
		<table border="1px" align="center" class="table table-bordered" style='width:80%' id="tablename">
		<thead>
			<tr style="font-size:28px" align="center">
			  <th class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name" align="center"><b>Raw material name</b></th>
			  <th class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_reorder_level" name="rm_reorder_level" align="center"><b>Reorder level</b></th>
			  <th class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_total_quantity" name="rm_total_quantity" align="center"><b>Total available quantity</b></th>
			</tr>
		</thead>
			<tbody id="people">
			<?php
				$query=mysqli_query($connection, "SELECT rm_name, rm_counting_quantity, rm_qc_quantity, rm_stores_quantity, rm_rework_quantity, rm_jobwork_quantity, rm_reorder_level from raw_materials ORDER BY rm_stores_quantity ASC");
				while($row=mysqli_fetch_array($query)){
					$available_quantity = $row['rm_counting_quantity'] + $row['rm_qc_quantity'] + $row['rm_stores_quantity'] + $row['rm_rework_quantity'] + $row['rm_jobwork_quantity'];
					if($available_quantity <= $row['rm_reorder_level']){
						?>
						<tr style="font-size:22px">
							<td align="center"><?php echo $row['rm_name']; ?></td>
							<td align="center"><?php echo $row['rm_reorder_level']; ?></td>
							<td align="center"><?php echo $available_quantity; ?></td>
						</tr>
					<?php
					}
				}
				mysqli_close($connection);
			?>
		</tbody>
		</table>   
  </div>
</div>
<br><br>
</body>
</html>
