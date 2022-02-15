<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'purchase_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
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

	<title>View BOM</title>
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
		
		$(document).ready(function(){
			$("#product_name").select2();
			$('#but_read').click(function(){
			var username = $('#product_name option:selected').text();
			var userid = $('#product_name').val();
			$('#result').html("id : " + userid + ", name : " + username);
			});
		});
		
		$(document).ready(function() {
				$("#supp_name").select2();
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
	<h1 class="display-3" align="center">View BOM</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='MonitorReorderMaterials.php'">
				Monitor Reorder material
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPendingPOs.php'">
				View pending POs
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='rawmaterialsoverview.php'">
				Raw Materials Overview
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
		<div class="row" align="center">
			<form method="post">
				<?php
					echo '<select name="fps_name" id="fps_name" class="form-control" style="width: 400px; height: 45px;">';
					//echo '<option value="0">Select Supplier</option>';
					$query = "SELECT fps_id, fps_name FROM finished_product_summary";
					$raw_mat = mysqli_query($connection,$query);
					
					while ($row = mysqli_fetch_assoc($raw_mat)) 
					{
						$fps_id = $row['fps_id'];
						$fps_name = $row['fps_name'];

						echo "<option value=\"$fps_id\">$fps_name</option>";
					}
					echo "</select>";
					echo '<input type="submit" name="fps_name_submit" class="btn btn-primary btn-lg m-3" value="View">';
					echo '<input type="submit" name="fps_name_edit" class="btn btn-primary btn-lg" value="Edit"><br><br><br>';
					
					if(isset($_POST['fps_name_submit']))
					{
						//$fps_name = $_POST['fps_name'];
						$fps_id = $_POST['fps_name'];
						$query1 = "SELECT fps_name FROM finished_product_summary WHERE fps_id = '$fps_id'";
						$query = "SELECT * FROM finished_product_details WHERE fps_id = '$fps_id'";
						$name_query = mysqli_query($connection, $query1);
						$r=mysqli_fetch_assoc($name_query);
						$name=$r['fps_name'];
						//echo $name;
						$raw_mat_query = mysqli_query($connection, $query);?>
						<input type="text" value="<?php echo $name;?>" class="form-control" style="width: 400px; height: 45px; text-align:center;" readonly>
						<?php echo '<br>';
						echo '<table class="table table-bordered" style="width:50%">';
						echo '<thead>';
						echo "<tr align='center'>";
						echo '<th>Material</th>';
						echo '<th>Quantity</th>';
						echo '</tr>';
						echo '</thead>';

						echo '<tbody>';
						echo '<br><br>';
						while ($row = mysqli_fetch_assoc($raw_mat_query)) 
						{
							$fpd_material_name = $row['fpd_material_name'];
							$fpd_material_quantity = $row['fpd_material_quantity'];
								
							echo "<tr>";
							echo "<td align='center'>$fpd_material_name</td>";
							echo "<td align='center'>$fpd_material_quantity</td>";
							echo "</tr>";
						}
						
						echo '</tbody>';
						echo '</table>';
					}

					if(isset($_POST['fps_name_edit']))
					{
						$fps_id = $_POST['fps_name'];
						
						$query1 = "SELECT fps_name FROM finished_product_summary WHERE fps_id = '$fps_id'";
						
						$name_query = mysqli_query($connection, $query1);
						$r=mysqli_fetch_assoc($name_query);
						$name=$r['fps_name'];
						//echo $name;?>
						<input type="text" value="<?php echo $name;?>" class="form-control" style="width: 400px; height: 45px; text-align:center;" readonly>
						<?php 
						
						$query = "SELECT * FROM finished_product_details WHERE fps_id = '$fps_id'";
						$raw_mat_query = mysqli_query($connection, $query);

						echo '<br>';
						echo '<table class="table table-bordered" style="width:60%" id="tableContent">';
						echo '<thead>';
						echo "<tr align='center'>";
						echo '<th style="display:none;"></th>';
						echo '<th style="display:none;"></th>';
						echo '<th>Material</th>';
						echo '<th>Quantity</th>';
						echo '<th></th>';
						echo '<th></th>';
						echo '</tr>';
						echo '</thead>';

						echo '<tbody id="table">';
						echo '<br><br>';
						while ($row = mysqli_fetch_assoc($raw_mat_query)) 
						{
							$fpd_material_name = $row['fpd_material_name'];
							$fpd_material_quantity = $row['fpd_material_quantity'];
							$fpd_id = $row['fpd_id'];
							//$fps_id = $row['fps_id'];
							
							echo "<tr id='row'>";
							echo "<td style='display:none;'><input type='text' value='", $fpd_id, "' name='fpd_id_edit[]' id='fpd_id_edit' class='form-control'></td>";
							echo "<td style='display:none;'><input type='text' value='", $fps_id, "' name='fps_id_edit' id='fps_id_edit' class='form-control'></td>";
							
							
							echo '<td style="width: 20%";><select name="fpd_material_name_edit[]" id="fpd_material_name_edit" class="form-control" style="width: 400px; height: 45px;">';
							//echo '<option value="0">Select Supplier</option>';
							$query = "SELECT fpd_id, fpd_material_name FROM finished_product_details";
							$raw_mat = mysqli_query($connection,$query);
							$selected_id = 0;
							$selected_material = '';
							while ($row = mysqli_fetch_assoc($raw_mat)) 
							{
								$material_names = "<?php echo $fpd_material_name; ?>";
								$fpd_id = $row['fpd_id'];
								$fpd_material_name_update = $row['fpd_material_name'];
								if($fpd_material_name_update == $fpd_material_name && $selected_id == 0){
									echo "<option value=\"$fpd_material_name_update\" selected>$fpd_material_name_update</option>";
									$selected_id = $fpd_id;
									$selected_material = $fpd_material_name_update;
								}
								else{
									echo "<option value=\"$fpd_material_name_update\">$fpd_material_name_update</option>";
								}
								
							}
							echo "</select>";
							echo '</td>';
							
							/*echo "<td style='width: 45%';><input type='text' value='", $fpd_material_name, "' name='fpd_material_name_edit[]' id='fpd_material_name_edit' class='form-control'></td>";*/
							echo "<td style='width: 20%';><input type='number' value='", $fpd_material_quantity, "' name='fpd_material_quantity_edit[]' id='fpd_material_quantity_edit' class='form-control'></td>";
							echo "<td align='center'><input type='button' class='btn btn-outline-primary' value='Add Material' id='button_add'  onclick='addField_BOM(this)' style='width: 120px; height: 40px;'/></td>";
							
							/*echo "<td align='center'><button class='btn btn-outline-danger' name='button_delete' id='button_delete'>Delete Material</button></td>";*/
							echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete the Material $selected_material?');\" class='btn btn-outline-danger'  href='MaterialBOMRecycle.php?id=".$selected_id."' role='button' aria-pressed='true'>Delete Material</a></td>";							

							echo "</tr>";
						}
						
						echo '</tbody>';
						echo '</table>';
						echo '<br>';
						echo '<input type="submit" name="BOM_edit" class="btn btn-primary btn-lg" value="Save">';
					}

					if(isset($_POST['BOM_edit']))
					{
						$fpd_id_edit= $_POST['fpd_id_edit'];
						
						$fpd_material_name_edit=$_POST['fpd_material_name_edit'];
						$fpd_material_quantity_edit=$_POST['fpd_material_quantity_edit'];
						$fps_id_edit=$_POST['fps_id_edit'];
						
						echo $fps_id_edit;
						$check_query= mysqli_query($connection,"select * from finished_product_details");						
						foreach ($fpd_id_edit as $index => $names)
						{
							$insert_flag = false;
							$update_flag = false;
							echo $fpd_id_edit[$index];
							while ($row_check = mysqli_fetch_assoc($check_query)) {
								if($fps_id_edit == $row_check['fps_id'] AND $fpd_id_edit[$index] == $row_check['fpd_id']){									
									$update_flag = true;
									$insert_flag = false;
									break;
								}
								else{
									
									$update_flag = false;
									$insert_flag = true;									
								}
							}
							if($update_flag){
								$query_update=mysqli_query($connection,"UPDATE finished_product_details SET fpd_material_name='$fpd_material_name_edit[$index]' , fpd_material_quantity= '$fpd_material_quantity_edit[$index]' WHERE fpd_id ='$fpd_id_edit[$index]'");
							}
							else if($insert_flag){
								$query_update=mysqli_query($connection,"INSERT into finished_product_details (fpd_id, fpd_material_name, fpd_material_quantity,fpd_submitted_quantity, fpd_accepted_quantity,fps_id) VALUES('','$fpd_material_name_edit[$index]','$fpd_material_quantity_edit[$index]','','','$fps_id_edit')");
							}
							$insert_query=mysqli_query($connection, $query_update);
							if($insert_query){
								echo '<script>alert("BOM Updated.");
								window.location.replace("ViewBOM.php")</script>';
							}
							else{
								echo '<script>window.location.replace("ViewBOM.php")</script>';
							}
						}
					}
				?>
			</form>
		</div>
	</DIV>
</div>
</body>
</html>
