<?php

use function PHPSTORM_META\type;

include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}

	if($_SESSION['pass_match'] != 1){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: UpdateOpeningStock_Gatekeeper.php");
	}

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

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

	<title>Update Opening Stock</title>
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
		$(document).ready(function(){
		$("#po_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#po_material_name option:selected').text();
		var userid = $('#po_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function(){
		$("#product_name").select2();
		$('#but_read').click(function(){
		var username = $('#product_name option:selected').text();
		var userid = $('#product_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	</SCRIPT>
</head>
<body class="bg-light text-dark">
	<?php
		//include "includes/sidebar.php";
	?>
	<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Update Opening Stock</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
				</button><br><br>
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PrintQuantityVerification.php'">
				Print For Verification
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='VerificationReport.php'">
				Verification report
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Allocate Caret ID
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Search Caret ID
				</button>
			</div>
		</div>
</div>
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" style="width: 300px; height:45px;" href="UpdateOpeningStock
.php?source=material" ONCLICK="ShowRowMaterial()">Raw Material</a>
			<a class="btn btn-primary btn-lg" style="width: 300px; height:45px;" href="UpdateOpeningStock.php?source=product" ONCLICK="ShowProduct()">Product Wise</a>
		</p>
	
	</div>
	
	<div class="row" align="center">
		<form method="post">
			<?php
				if(isset($_GET['source']))
				{
					$source = $_GET['source'];
				}
				else
				{
					$source = '';
				}

				switch ($source)
				{
					case 'material':
						//global $connection;
						echo '<br><br>';
						echo '<label class="m-4">Select Raw Materials</label>';
						echo '<select multiple name="po_material_name[]" id="po_material_name"  style="width: 400px; height: 45px;" class="form-select select2-hidden-accessible" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true">';
						$query = "SELECT rm_id,rm_name FROM raw_materials";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$rm_id = $row['rm_id'];
							$rm_name = $row['rm_name'];

							echo "<option value=$rm_id>$rm_name</option>";
						}
						echo "</select>";
						echo '<input type="submit" name="po_material_name_submit" class="btn btn-primary m-4" value="Submit">';
						
						if(isset($_POST['po_material_name_submit']))
						{
							echo "<br>";
							$po_material_name = $_POST['po_material_name'];
							$count = count($_POST['po_material_name']);
							$str_query = "SELECT * from raw_materials where ";
							for($i=0;$i<$count;$i++){
								if($i == 0){
									$str_query .= "rm_id='". $po_material_name[$i]."'";
								}
								else{
									$str_query .= " OR rm_id='". $po_material_name[$i]."'";
								}
							}
							$raw_mat = mysqli_query($connection,$str_query);
						?>

						<br><table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr>
									<th rowspan="2" style="text-align: center">Caret Id</th>
                                    <th rowspan="2" style="text-align: center">Name of Raw Material</th>
									<th colspan="6" style="text-align: center">Opening Quantity</th>
                                    <th rowspan="2" style="text-align: center">Entered By</th>
                                </tr>
								<tr>
									<td style="text-align: center; width: 100px"><b>Stroes</td>
									<td style="text-align: center; width: 100px"><b>Couting</td>
									<td style="text-align: center; width: 100px"><b>Quality Check</td>
									<td style="text-align: center; width: 100px"><b>Rework</td>
									<td style="text-align: center; width: 100px"><b>Job Work</td>
									<td style="text-align: center; width: 100px"><b>Total</td>
								</tr>
                            </thead>
                        	<tbody>
						<?php	
							while ($row = mysqli_fetch_assoc($raw_mat)) 
							{
								$rm_id = $row['rm_id'];
								$rm_name = $row['rm_name'];
								$rm_counting_quantity = $row['rm_counting_quantity'];
								$rm_qc_quantity = $row['rm_qc_quantity'];
								$rm_stores_quantity = $row['rm_stores_quantity'];
								$rm_rework_quantity = $row['rm_rework_quantity'];
								$rm_jobwork_quantity = $row['rm_jobwork_quantity'];
								$rm_reorder_level = $row['rm_reorder_level'];
								$rm_ordered_quantity = $row['rm_ordered_quantity'];
								$caret_id = $row['rm_caret_id'];
								$total = $rm_stores_quantity + $rm_counting_quantity + $rm_qc_quantity + $rm_rework_quantity + $rm_jobwork_quantity;
								
								echo "<td style='text-align: center;'>$caret_id</td>"
								?>
								<td style='text-align: center;'><input type="text" id="rm_name" class="form-control"  name="rm_name[]" style="width: 250px; height: 40px; text-align:center;" value="<?php echo $rm_name; ?>" readonly></td>
								<td style='text-align: center;'><input type="text" id="rm_stores_quantity" class="form-control" name="rm_stores_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_stores_quantity; ?>" ></td>
								<td style='text-align: center;'><input type="text" id="rm_counting_quantity" class="form-control" name="rm_counting_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_counting_quantity; ?>"></td>
								<td style='text-align: center;'><input type="text" id="rm_qc_quantity" class="form-control" name="rm_qc_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_qc_quantity; ?>"></td>
								<td style='text-align: center;'><input type="text" id="rm_rework_quantity" class="form-control" name="rm_rework_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_rework_quantity; ?>"></td>
								<td style='text-align: center;'><input type="text" id="rm_jobwork_quantity" class="form-control" name="rm_jobwork_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_jobwork_quantity; ?>"></td>
								<td style='text-align: center;'><input type="text" id="rm_total_quantity" class="form-control" name="rm_total_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $total; ?>.00" readonly></td>
								<td style='text-align: center;'><input type="text" id="rm_last_edited_by" class="form-control" name="rm_last_edited_by[]" style="width: 200px; height: 40px; text-align:center;"></td>
								<?php
								echo "</tr>";
							}
							echo '</tbody>';
                        	echo '</table><br>';
							echo '<input type="submit" name="po_material_raw_mat_update" class="btn btn-primary btn-lg" value="Update">';							
						}
						
						if(isset($_POST['po_material_raw_mat_update'])){
							$rm_name_update = $_POST['rm_name'];
							$rm_stores_quantity_update = $_POST['rm_stores_quantity'];
							$rm_counting_quantity_update = $_POST['rm_counting_quantity'];
							$rm_qc_quantity_update = $_POST['rm_qc_quantity'];
							$rm_rework_quantity_update = $_POST['rm_rework_quantity'];
							$rm_jobwork_quantity_update = $_POST['rm_jobwork_quantity'];
							$rm_last_edited_by_update= $_POST['rm_last_edited_by'];
							
							foreach ($rm_name_update as $index => $names) {
								if($rm_last_edited_by_update[$index]==""){
									$query_update=mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$rm_stores_quantity_update[$index]', rm_counting_quantity='$rm_counting_quantity_update[$index]', rm_qc_quantity='$rm_qc_quantity_update[$index]', rm_rework_quantity='$rm_rework_quantity_update[$index]', rm_jobwork_quantity='$rm_jobwork_quantity_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
								}else{
									$query_update=mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$rm_stores_quantity_update[$index]', rm_counting_quantity='$rm_counting_quantity_update[$index]', rm_qc_quantity='$rm_qc_quantity_update[$index]', rm_rework_quantity='$rm_rework_quantity_update[$index]', rm_jobwork_quantity='$rm_jobwork_quantity_update[$index]', rm_last_edited_by='$rm_last_edited_by_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
								}
							}
							if($query_update){
								echo '<script type="text/javascript">alert("Raw Material Quantity Updated.");
								window.location.replace("UpdateOpeningStock.php")</script>';
							}else{
								echo '<script type="text/javascript">alert("Raw Material Quantity Not Updated.");
								window.location.replace("UpdateOpeningStock.php")</script>';
							}
						}
						
						break;
					
					case 'product':
						echo '<br><br>';
						echo '<label class="m-4">Select Products</label>';
						echo '<select multiple name="product_name[]" id="product_name" class="form-control" style="width: 400px; height: 45px;">';
						$query = "SELECT fps_id, fps_name FROM finished_product_summary";
						$prod = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_array($prod)) 
						{
							$fps_id = $row['fps_id'];
							$fps_name = $row['fps_name'];

							echo '<option value="'.$fps_id.'">'.$fps_name.'</option>';
						}
						echo "</select>";
							
						echo '<input type="submit" name="product_name_submit" class="btn btn-primary m-4" value="Submit">';
						echo '<br>';
						
						if(isset($_POST['product_name_submit']))
						{
							$product_name = $_POST['product_name'];
							$product_count = count($_POST['product_name']);

							
							//Generate finished_product_summary query in a loop
							$fps_query = "SELECT * from finished_product_summary where ";
							for($j=0; $j<$product_count; $j++){
								if($j==0){
									$fps_query .= "fps_id='". $_POST['product_name'][$j]. "' ";
								}

								else{
									$fps_query .= "OR fps_id='". $_POST['product_name'][$j]. "' ";
								}
							}
							$records=mysqli_query($connection, $fps_query);


							//Generate finished_product_details query in a loop
							$fpd_query = "SELECT * from finished_product_details where ";
							$k = 0;
							while($data=mysqli_fetch_array($records)){
								$fps_id = $data['fps_id'];
								if($k == 0){
									$fpd_query .= "fps_id='". $data['fps_id']. "' ";
								}

								else{
									$fpd_query .= "OR fps_id='". $data['fps_id']. "' ";
								}
								$k++;
							}
							$prod_fpd=mysqli_query($connection, $fpd_query);
						?>
						<table class="table table-bordered table-hover" style="width:80%;">
							<thead>
                                <tr>
									<th rowspan="2" style="text-align: center">Caret Id</th>
									<!-- <th rowspan="2" style="text-align: center">Product Name</th> -->
                                    <th rowspan="2" style="text-align: center">Name of Raw Material</th>
									<th colspan="6" style="text-align: center">Opening Quantity</th>
                                    <th rowspan="2" style="text-align: center">Entered By</th>
                                </tr>
								<tr>
									<td style="text-align: center; width: 100px"><b>Stores</td>
									<td style="text-align: center; width: 100px"><b>Couting</td>
									<td style="text-align: center; width: 100px"><b>Quality Check</td>
									<td style="text-align: center; width: 100px"><b>Rework</td>
									<td style="text-align: center; width: 100px"><b>Job Work</td>
									<td style="text-align: center; width: 100px"><b>Total</td>
								</tr>
                            </thead>
                        	<tbody>
						<?php
							$rm_query = "SELECT * from raw_materials where ";
							$i = 0;
							while ($row1 = mysqli_fetch_array($prod_fpd))
							{
								$fpd_material_name = $row1['fpd_material_name'];
								$fpd_material_quantity = $row1['fpd_material_quantity'];

								if($i == 0){
									$rm_query .= "rm_name='". $fpd_material_name. "' ";
								}

								else{
									$rm_query .= "OR rm_name='". $fpd_material_name. "' ";
								}
								$i++;
							}

							$raw_mat1 = mysqli_query($connection,$rm_query);
							if(gettype($raw_mat1) == "boolean"){
								echo '<script type="text/javascript">alert("No material for this product");
								window.location.replace("UpdateOpeningStock.php")</script>';
							}
							else{
								while ($row2 = mysqli_fetch_array($raw_mat1))
								{
									$rm_name = $row2['rm_name'];
									$rm_counting_quantity = $row2['rm_counting_quantity'];
									$rm_qc_quantity = $row2['rm_qc_quantity'];
									$rm_stores_quantity = $row2['rm_stores_quantity'];
									$rm_rework_quantity = $row2['rm_rework_quantity'];
									$rm_jobwork_quantity = $row2['rm_jobwork_quantity'];
									$rm_ordered_quantity = $row2['rm_ordered_quantity'];
									$caret_id = $row2['rm_caret_id'];
									$total = $rm_stores_quantity + $rm_counting_quantity + $rm_qc_quantity + $rm_rework_quantity + $rm_jobwork_quantity;

									echo "<td style='text-align: center;'>$caret_id</td>";
									?>								
									<td style='text-align: center;'><input type="text" id="fpd_material_name" class="form-control" name="fpd_material_name[]" style="width: 250px; height: 40px; text-align:center;" value="<?php echo $rm_name; ?>" readonly></td>	
									<td style='text-align: center;'><input type="text" id="rm_stores_quantity" class="form-control" name="rm_stores_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_stores_quantity; ?>" ></td>
									<td style='text-align: center;'><input type="text" id="rm_counting_quantity" class="form-control" name="rm_counting_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_counting_quantity; ?>"></td>
									<td style='text-align: center;'><input type="text" id="rm_qc_quantity" class="form-control" name="rm_qc_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_qc_quantity; ?>"></td>
									<td style='text-align: center;'><input type="text" id="rm_rework_quantity" class="form-control" name="rm_rework_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_rework_quantity; ?>"></td>
									<td style='text-align: center;'><input type="text" id="rm_jobwork_quantity" class="form-control" name="rm_jobwork_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $rm_jobwork_quantity; ?>"></td>
									<td style='text-align: center;'><input type="text" id="rm_total_quantity" class="form-control" name="rm_total_quantity[]" style="width: 100px; height: 40px; text-align:center;" value="<?php echo $total; ?>" readonly></td>
									<td style='text-align: center;'><input type="text" id="rm_last_edited_by" class="form-control" name="rm_last_edited_by[]" style="width: 200px; height: 40px; text-align:center;"></td>
									<?php
									echo "</tr>";
								}
							}

							echo '</tbody>';
                        	echo '</table><br>';
							echo '<input type="submit" name="po_material_prod_update" class="btn btn-primary btn-lg" value="Update">';
						}
						if(isset($_POST['po_material_prod_update'])){
							$rm_name_update = $_POST['fpd_material_name'];
							$rm_stores_quantity_update = $_POST['rm_stores_quantity'];
							$rm_counting_quantity_update = $_POST['rm_counting_quantity'];
							$rm_qc_quantity_update = $_POST['rm_qc_quantity'];
							$rm_rework_quantity_update = $_POST['rm_rework_quantity'];
							$rm_jobwork_quantity_update = $_POST['rm_jobwork_quantity'];
							$rm_last_edited_by_update = $_POST['rm_last_edited_by'];
							
							foreach ($rm_name_update as $index => $names) {
								if($rm_last_edited_by_update[$index]==""){
									$query_update=mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$rm_stores_quantity_update[$index]', rm_counting_quantity='$rm_counting_quantity_update[$index]', rm_qc_quantity='$rm_qc_quantity_update[$index]', rm_rework_quantity='$rm_rework_quantity_update[$index]', rm_jobwork_quantity='$rm_jobwork_quantity_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
								}else{
									$query_update=mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$rm_stores_quantity_update[$index]', rm_counting_quantity='$rm_counting_quantity_update[$index]', rm_qc_quantity='$rm_qc_quantity_update[$index]', rm_rework_quantity='$rm_rework_quantity_update[$index]', rm_jobwork_quantity='$rm_jobwork_quantity_update[$index]', rm_last_edited_by='$rm_last_edited_by_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
								}
							}
							/*$query_update=mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$rm_stores_quantity_update', rm_counting_quantity='$rm_counting_quantity_update', rm_qc_quantity='$rm_qc_quantity_update', rm_rework_quantity='$rm_rework_quantity_update', rm_jobwork_quantity='$rm_jobwork_quantity_update' WHERE rm_name='$rm_name_update'");*/
							if($query_update){
								echo '<script type="text/javascript">alert("Raw Material Quantity Updated.");
								window.location.replace("UpdateOpeningStock.php")</script>';
							}else{
								echo '<script type="text/javascript">alert("Raw Material Quantity Not Updated.");
								window.location.replace("UpdateOpeningStock.php")</script>';
							}
						}
						break;
					
					default:
						break;
				}                          

			?>
		</form>
	</div>
</div>
</body>
</html>
