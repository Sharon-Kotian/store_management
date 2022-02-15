<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
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

	<title>Finished Product Details</title>
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
			$("#fpd_material_name").select2();
			$("#fps_name").select2();
		 });
		 
		 function ShowProduct() {
			var x = document.getElementById('SectionName');
			var y = document.getElementById('ProductName');
			if (x.style.display == 'none') {
				y.style.display = 'block';
			} else {
				x.style.display = 'none';
				y.style.display = 'block';
			}
		}

			function ShowRowMaterial() {
				var y = document.getElementById('ProductName');
				var x = document.getElementById('SectionName');
				if (y.style.display == 'none') {
					x.style.display = 'block';
				} else {
					y.style.display = 'none';
					x.style.display = 'block';
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
	<h1 class="display-3" align="center">Finished Product Details</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Align Items in Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Accept Job Work
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='CreateJobworkerprofile.php'">
				Create Job Workers Profile
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Raw Material information
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Submit Job Work
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitMaterialToRework.php'">
				Submit Material To Rework
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Manage intermediate goods.php'">
				Manage Intermediate Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='Add Material For Intermediate Goods.php'">
				Add Material For Intermediate Goods
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
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="  Product wise  " ONCLICK="ShowRowMaterial()">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw material wise " ONCLICK="ShowProduct()"></p>
	
	</div>


	<DIV ID="ProductName" STYLE="display:none">
		<form name="frm" method="post" action=""><br><br>
						<table style="width:75%" align="center" id="dataTable">
							<tr>
								<td align="center" class="form-label"><br><br> Select Raw Material: </td>
								<td align="center"><br><br><select name="fpd_material_name" id="fpd_material_name" style="width: 350px; height: 40px;" required>
								<?php 
									$records=mysqli_query($connection,"SELECT fpd_material_name from finished_product_details");
									while($data=mysqli_fetch_array($records)){
										echo "<option value='".$data['fpd_material_name']."'>".$data['fpd_material_name']."</option>";
									}
								?>
							</select></td>
								<td align="center"><br><br><input type='submit' id= 'clickme' value=' Submit ' class='btn btn-primary btn-lg' name='datewise'></td>
							</tr>
						</table><br><br>

						<?php 
							if(isset($_POST['datewise'])){
								$fpd_material_name=$_POST['fpd_material_name'];?>
								<table border="1px" align="center" class="table table-bordered" style='width:80%'>
									<tr align="center">
										<th align="center">Finished Product ID</th>
										<th align="center">Material Name</th>
										<th align="center">Finished Product Material Quantity</th>
										<th align="center">Finished Product Submitted Quantity</th>
										<th align="center">Finished Product Accepted Quantity</th>										
									</tr>
									
								<?php
				$query=mysqli_query($connection, "SELECT * from finished_product_details where fpd_material_name ='$fpd_material_name'");
				while($row=mysqli_fetch_array($query)){?>
					<tr style="font-size:22px">
						<td><input type="number" class="form-control" name="fpd_id[]" id="fpd_id " value="<?php echo $row['fpd_id']; ?>" readonly></td>
						<td><input type="text" class="form-control" name="fpd_material_name[]" value="<?php echo $row['fpd_material_name']; ?>" id="fpd_material_name" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_material_quantity[]" value="<?php echo $row['fpd_material_quantity']; ?>" id="fpd_material_quantity" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_submitted_quantity[]" value="<?php echo $row['fpd_submitted_quantity']; ?>" id="fpd_submitted_quantity" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_accepted_quantity[]" value="<?php echo $row['fpd_accepted_quantity']; ?>" id="fpd_accepted_quantity" style="width: 100%" readonly></td>
					</tr>
					<?php
					}
				}
			?>
			</table>
		</form>
			<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Updated!!
			  </div>
			  <button type="button"  id="mybtn"class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		  </div>
	</div>
	
	<DIV ID="SectionName" STYLE="display:none">
		<form name="frm" method="post" action=""><br><br>
						<table style="width:75%" align="center" id="dateTable">
							<tr>
								<td align="center" class="form-label"><br><br> Select Finished Product: </td>
								<td align="center"><br><br><select name="fps_name" id="fps_name" style="width: 350px; height: 40px;" required>
								<?php 
									$records=mysqli_query($connection,"SELECT fps_name from finished_product_summary");
									while($data=mysqli_fetch_array($records)){
										echo "<option value='".$data['fps_name']."'>".$data['fps_name']."</option>";
									}
								?>
							</select></td>
								<td align="center"><br><br><input type='submit' id= 'clickme' value=' Submit ' class='btn btn-primary btn-lg' name='datawise'></td>
							</tr>
						</table><br><br>

						<?php 
							if(isset($_POST['datawise'])){
								$fps_name=$_POST['fps_name'];?>
								<table border="1px" align="center" class="table table-bordered" style='width:80%'>
									<tr align="center">
										<th align="center">Finished Product ID</th>
										<th align="center">Material Name</th>
										<th align="center">Finished Product Material Quantity</th>
										<th align="center">Finished Product Submitted Quantity</th>
										<th align="center">Finished Product Accepted Quantity</th>										
									</tr>
									
								<?php
				$query=mysqli_query($connection, "SELECT * from finished_product_details where fps_id IN (SELECT fps_id from finished_product_summary where fps_name ='$fps_name')");
				while($row=mysqli_fetch_array($query)){?>
					<tr style="font-size:22px">
						<td><input type="number" class="form-control" name="fpd_id[]" id="fpd_id " value="<?php echo $row['fpd_id']; ?>" readonly></td>
						<td><input type="text" class="form-control" name="fpd_material_name[]" value="<?php echo $row['fpd_material_name']; ?>" id="fpd_material_name" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_material_quantity[]" value="<?php echo $row['fpd_material_quantity']; ?>" id="fpd_material_quantity" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_submitted_quantity[]" value="<?php echo $row['fpd_submitted_quantity']; ?>" id="fpd_submitted_quantity" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="fpd_accepted_quantity[]" value="<?php echo $row['fpd_accepted_quantity']; ?>" id="fpd_accepted_quantity" style="width: 100%" readonly></td>
					</tr>
					<?php
					}
				}
			?>
			</table>
		</form>
			<!--  Toast code -->
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
<!--toast script-->
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
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
