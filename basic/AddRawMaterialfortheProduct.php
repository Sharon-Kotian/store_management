<?php
	include_once ("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'purchase_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){

		$fps_name=$_POST['fps_name'];
		$rm_name=$_POST['rm_name'];
		$fpd_material_quantity=$_POST['fpd_material_quantity'];

		foreach ($rm_name as $index => $names) {
			$select=mysqli_query($connection, "SELECT rm_name from raw_materials WHERE rm_name='$names'");
			if(mysqli_num_rows($select)){
				$query="INSERT INTO finished_product_details(fpd_id, fpd_material_name, fpd_material_quantity, fps_id) VALUES ('','$names','$fpd_material_quantity[$index]','$fps_name')";
				$insert_query=mysqli_query($connection, $query);
				if($insert_query){
					echo '<script>alert("Raw Material Added for the Product Successfully.");
					window.location.replace("AddRawMaterialfortheProduct.php")</script>';
				}
				else{
					echo "Error" .mysqli_error($connection);
					echo '<script>window.location.replace("AddRawMaterialfortheProduct.php")</script>';
				}
			}else{
				echo '<script>alert("Raw Material does not exists");
				window.location.replace("AddRawMaterialfortheProduct.php")</script>';
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

	<title>Add Raw Material for the Product</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<script src="JS/addRowFunction.js"></script>
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
		$("#fps_name").select2();
	});
	
	</SCRIPT>
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
	<h1 class="display-3" align="center">Add Raw Material for the Product</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageReorderLevel1.php'">
					Manage Reorder Level
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='MonitorReorderMaterials.php'">
					Monitor Reorder material
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 75px;" onClick="parent.location='UpdateStockQuantityForMaterial.php'">
					Update stock quantity for material
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="formname" method="post" action="">
		<table style="width:40%" id="productContent" align="center">	
			<tr align="center">		
				<td align="center" style="width: 200px; height: 20px;" class="form-label"> Product Name :  </td>
				<td align="center"><select name="fps_name" id="fps_name" style="width: 200px; height: 50px;">
							<?php 
								$records=mysqli_query($connection,"SELECT fps_id, fps_name from finished_product_summary");
								while($data=mysqli_fetch_array($records)){
									echo "<option value='".$data['fps_id']."'>".$data['fps_name']."</option>";
								}
							?>
							</select> 
				</td>
			</tr>
		</table><br>
		<hr size="5" width="100%"> 
		<br>
		<table style="width:90%" id="tableContent" align="center">
			<tbody id="table">
				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Raw Material Required : </td>
							<td align="left">
								<datalist name="rm_name[]" id="rm_name" style="width: 220px; height: 40px;">
								<?php 
									$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
									while($data=mysqli_fetch_array($records)){
										echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
									}
								?>
								</datalist><input  autoComplete="on" list="rm_name" name="rm_name[]" /> 
								
							</td>
					
					<td align="center" style="width: 200px; height: 20px;" class="form-label" id="label_quantity"> Quantity :  </td>
					<td align="left"><input type="number" id="fpd_material_quantity" class="form-control" name="fpd_material_quantity[]" style="width: 200px; height: 40px;"></td>
					
					<td><input type="button" class="btn btn-outline-primary" value="Add Row" id="button_add"  onclick="addField(this);" style="width: 110px; height: 40px;"/></td>
					<td><input type="button" class="btn btn-outline-warning" value="Delete Row" id="button_delete" onclick="deleteField(this);"/></td>

				</tr>
			</tbody>
		</table><br><br><br>
		
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value=" Submit " name="submit" ></p>		
		</form>

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
