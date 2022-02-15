<?php
	include_once ("includes/header.php");
	global $connection;
	 if($_SESSION['user_dept'] != 'purchase_dept'){
	 	echo '<script type="text/javascript">alert("Access Denied.")';
	 	header("Location: ../login.html");
	 }

	if(isset($_POST['submit'])){
		$rm_id=$_POST['rm_id'];
		$rm_name=$_POST['rm_name'];
		$rm_counting_quantity=$_POST['rm_counting_quantity'];
		$rm_qc_quantity=$_POST['rm_qc_quantity'];
		$rm_stores_quantity=$_POST['rm_stores_quantity'];
		$rm_rework_quantity=$_POST['rm_rework_quantity'];
		$rm_jobwork_quantity=$_POST['rm_jobwork_quantity'];
		$rm_rate=$_POST['rm_rate'];

		$rm_name=mysqli_real_escape_string($connection,$rm_name);
		$rm_counting_quantity=mysqli_real_escape_string($connection,$rm_counting_quantity);
		$rm_qc_quantity=mysqli_real_escape_string($connection,$rm_qc_quantity);
		$rm_stores_quantity=mysqli_real_escape_string($connection,$rm_stores_quantity);
		$rm_rework_quantity=mysqli_real_escape_string($connection,$rm_rework_quantity);
		$rm_jobwork_quantity=mysqli_real_escape_string($connection,$rm_jobwork_quantity);
		$rm_rate=mysqli_real_escape_string($connection,$rm_rate);

		$query=mysqli_query($connection, "SELECT rm_last_purchase_price FROM raw_materials WHERE rm_name='$rm_name' AND rm_last_purchase_price='0.00'");
		if(mysqli_num_rows($query)){
			$insert_query=mysqli_query($connection, "UPDATE raw_materials SET rm_name='$rm_name', rm_counting_quantity='$rm_counting_quantity', rm_qc_quantity='$rm_qc_quantity', rm_stores_quantity='$rm_stores_quantity', rm_rework_quantity='$rm_rework_quantity', rm_jobwork_quantity='$rm_jobwork_quantity', rm_rate='$rm_rate', rm_last_purchase_price='$rm_rate' WHERE rm_id='$rm_id'");
		}
		else{
			$insert_query=mysqli_query($connection, "UPDATE raw_materials SET rm_name='$rm_name', rm_counting_quantity='$rm_counting_quantity', rm_qc_quantity='$rm_qc_quantity', rm_stores_quantity='$rm_stores_quantity', rm_rework_quantity='$rm_rework_quantity', rm_jobwork_quantity='$rm_jobwork_quantity', rm_rate='$rm_rate' WHERE rm_id='$rm_id'");
		}
		if($insert_query){
			echo '<script type="text/javascript">alert("Quantity updated Successfully.");
			window.location.replace("UpdateStockQuantityForMaterial.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
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

	<title>Update stock quantity for material</title>
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
	<h1 class="display-3" align="center">Update stock quantity for material</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PlacePurchaseOrder.php'">
					Place Purchase Order
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddRawMaterialfortheProduct.php'">
					Add New Raw Material
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
                  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='closePO.php'">
					Close PO
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="formname" method="post" action="">
		<table style="width:40%" id="productContent" align="center">
			<tr align="center">	<?php $rm_name = $_SESSION['rm_name']; ?>	
				<td align="center"><input type="hidden" name="rm_id" id="rm_id" class="form-control" style="width: 50%; height: 40px;" value="<?php echo $rm_name;?>" readonly></td>
			</tr>	
			<?php 
				$select = mysqli_query($connection, "select * from raw_materials where rm_id = '$rm_name'");
				while($row = mysqli_fetch_array($select)){
					$rm_name1=$row['rm_name'];
					$rm_counting_quantity = $row['rm_counting_quantity'];
					$rm_qc_quantity = $row['rm_qc_quantity'];
					$rm_stores_quantity = $row['rm_stores_quantity'];
					$rm_rework_quantity = $row['rm_rework_quantity'];
					$rm_jobwork_quantity = $row['rm_jobwork_quantity'];
					$rm_rate = $row['rm_rate'];
				}
				?>
			<tr align="center">	<?php $rm_name = $_SESSION['rm_name']; ?>	
				<td align="center" style="width: 200px; height: 20px;" class="form-label"> Raw material Name :  </td>
				<td align="center"><br><input type="text" name="rm_name" id="rm_name" class="form-control" style="width: 50%; height: 40px;" value="<?php echo $rm_name1;?>" >	<br>								
			
				</td>
			</tr>
		</table><br>
		<hr size="5" width="100%"> 
		<br>
		<table style="width:60%" id="tableContent" align="center">
			<tbody id="table">
				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Quantity in counting: <br><br></td>

					<td align="center">
						<input type="number" name="rm_counting_quantity" id="rm_counting_quantity" class="form-control" value="<?php echo $rm_counting_quantity;?>" style="width: 50%; height: 40px;">	<br>								
					</td>
				</tr>

				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Quantity in QC: <br><br></td>

					<td align="center">
						<input type="number" name="rm_qc_quantity" id="rm_qc_quantity" class="form-control" value="<?php echo $rm_qc_quantity;?>" style="width: 50%; height: 40px;">	<br>								
					</td>
				</tr>

				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Quantity in stores: <br><br></td>

					<td align="center">
						<input type="number" name="rm_stores_quantity" id="rm_stores_quantity" class="form-control" value="<?php echo $rm_stores_quantity;?>" style="width: 50%; height: 40px;"><br>									
					</td>
				</tr>

				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Quantity in rework: <br><br></td>

					<td align="center">
						<input type="number" name="rm_rework_quantity" id="rm_rework_quantity" class="form-control" value="<?php echo $rm_rework_quantity;?>" style="width: 50%; height: 40px;"><br>									
					</td>
				</tr>

				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Quantity in jobwork: <br><br></td>

					<td align="center">
						<input type="number" name="rm_jobwork_quantity" id="rm_jobwork_quantity" class="form-control" value="<?php echo $rm_jobwork_quantity;?>" style="width: 50%; height: 40px;"><br>									
					</td>
				</tr>

				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Standard Price: <br><br></td>

					<td align="center">
						<input type="text" name="rm_rate" id="rm_rate" class="form-control" value="<?php echo $rm_rate;?>" style="width: 50%; height: 40px;"><br>									
					</td>
				</tr>
			</tbody>
		</table><br>
		
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value=" Submit " name="submit" ></p>		
		</form>

		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  	<div class="toast-body" text="center">
			    	Successfully Updated!!
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