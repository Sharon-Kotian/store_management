<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
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

	<title>Finished Product & Raw Material Overview</title>
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
<body>
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
	<h1 class="display-3" align="center">Finished Product & Raw Material Overview</h1>
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
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" style="width: 300px; height:45px;" href="FinishedProdAndRawMatOverview.php?source=material" ONCLICK="ShowRowMaterial()">Raw Material</a>
			<a class="btn btn-primary btn-lg" style="width: 300px; height:45px;" href="FinishedProdAndRawMatOverview.php?source=product" ONCLICK="ShowProduct()">Product Wise</a>
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
						echo '<select name="po_material_name" id="po_material_name" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select Material</option>';
						$query = "SELECT rm_id,rm_name FROM raw_materials";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$rm_id = $row['rm_id'];
							$rm_name = $row['rm_name'];

							echo "<option value=$rm_id>$rm_name</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="po_material_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['po_material_name_submit']))
						{
							echo "<br>";
							$po_material_name = $_POST['po_material_name'];
							$query = "SELECT * FROM raw_materials WHERE rm_id = {$po_material_name}";
							$raw_mat = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr>
                                    <th>Name</th>
									<th>Reorder Level</th>
									<th>Ordered Quantity</th>
                                    <th>Store Quantity</th>
                                    <th>Counting Quantity</th>
                                    <th>QC Quantity</th>
                                    <th>Jobwork Quantity</th>
                                    <th>Rework Quantity</th>
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
								
								echo '<br><br>';	
								echo "<tr>";
								echo "<td>$rm_name</td>";
								echo "<td>$rm_reorder_level</td>";
								echo "<td>$rm_ordered_quantity</td>";
								echo "<td>$rm_stores_quantity</td>";
								echo "<td>$rm_counting_quantity</td>";
								echo "<td>$rm_qc_quantity</td>";
								echo "<td>$rm_jobwork_quantity</td>";
								echo "<td>$rm_rework_quantity</td>";
								echo "</tr>";
							}
							echo '</tbody>';
                        	echo '</table>';
						}
						
						break;
					
					case 'product':
						echo '<br><br>';
						//echo '<form name="product_name_submit" action="" method="post">';
						echo '<select name="product_name" id="product_name" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select Material</option>';
						$query = "SELECT fps_id, fps_name FROM finished_product_summary";
						$prod = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_array($prod)) 
						{
							$fps_id = $row['fps_id'];
							$fps_name = $row['fps_name'];

							echo '<option value="'.$fps_id.'">'.$fps_name.'</option>';
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input class="form-control" type="text" placeholder="Enter Required Quantity" name="required_prod_quantity" style="width: 400px; height: 45px;">';
						echo '<br>';	
						echo '<input type="submit" name="product_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						//echo '</form>';
						
						if(isset($_POST['product_name_submit']))
						{
							echo "<br>";
							$product_name = $_POST['product_name'];
							$required_prod_quantity = $_POST['required_prod_quantity'];
							$query = "SELECT * FROM finished_product_details WHERE fps_id = '$product_name'";
							$prod_fpd = mysqli_query($connection, $query);
						?>
						<table class="table table-bordered table-hover" style="width:80%; margin-left: 10%;">
							<thead>
                                <tr>
                                    <th>Name</th>
									<th>Required Quantity</th>
									<th>Reorder Level</th>
									<th>Ordered Quantity</th>
                                    <th>Store Quantity</th>
                                    <th>Counting Quantity</th>
                                    <th>QC Quantity</th>
                                    <th>Jobwork Quantity</th>
                                    <th>Rework Quantity</th>
									<th>Required Purchase Quantity</th>
                                </tr>
                            </thead>
                        	<tbody>
						<?php
							while ($row1 = mysqli_fetch_array($prod_fpd)) 
							{
								$fpd_material_name = $row1['fpd_material_name'];
								$fpd_material_quantity = $row1['fpd_material_quantity'];

								$query1 = "SELECT * FROM raw_materials WHERE rm_name = '$fpd_material_name'";
								$raw_mat1 = mysqli_query($connection,$query1);
									
								while ($row2 = mysqli_fetch_array($raw_mat1)) 
								{
									$rm_counting_quantity = $row2['rm_counting_quantity'];
									$rm_qc_quantity = $row2['rm_qc_quantity'];
									$rm_stores_quantity = $row2['rm_stores_quantity'];
									$rm_rework_quantity = $row2['rm_rework_quantity'];
									$rm_jobwork_quantity = $row2['rm_jobwork_quantity'];
									$rm_reorder_level = $row2['rm_reorder_level'];
									$rm_ordered_quantity = $row2['rm_ordered_quantity'];

									$req_purchase_qnty = (($fpd_material_quantity * $required_prod_quantity) + $rm_reorder_level) - ($rm_counting_quantity + $rm_qc_quantity + $rm_stores_quantity + $rm_jobwork_quantity + $rm_rework_quantity);
									if($req_purchase_qnty < 0)
									{
										$req_purchase_qnty = 0;
									}
									
									echo "<tr>";
									echo "<td>$fpd_material_name</td>";
									echo "<td>$fpd_material_quantity</td>";
									echo "<td>$rm_reorder_level</td>";
									echo "<td>$rm_ordered_quantity</td>";
									echo "<td>$rm_stores_quantity</td>";
									echo "<td>$rm_counting_quantity</td>";
									echo "<td>$rm_qc_quantity</td>";
									echo "<td>$rm_jobwork_quantity</td>";
									echo "<td>$rm_rework_quantity</td>";
									echo "<td>$req_purchase_qnty</td>";
									echo "</tr>";
								}
							}
							echo '</tbody>';
                        	echo '</table>';
						}
						break;
					
					default:
						break;
				}                          

			?>
		</form>
	</div>
		<div id="displaytable1">
		  <table id="displaytable" style="display: none; border:3;" align="center">
			<tr align="center">
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Raw Material Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Quantity</td>
			</tr>
			<tr>
			  <td align="center">1</td>
			  <td align="center">2</td>
			</tr>
			<tr>
			  <td align="center">4</td>
			  <td align="center">5</td>
			</tr>
		  </table> 
		</div>
	</DIV>
	
	<DIV ID="ProductName" STYLE="display:none">
		<p for="product">Select Product:
			<select name="product" id="prod_name" style="width: 185px; height: 30px;">
				<option value="abc">Aluminium Plate</option>
				<option value="def">Aluminium Rod</option>
				<option value="ghi">Aluminium Spring</option>
				<option value="jkl">Iron Plate</option>
			</select>
			<input type="button" id= "clickme" value=" Ok " onclick='myfunctionProduct();'>		
		</p>
		<div id="ProductTable1">
			<table id="ProductTable" style="display: none; border:3;">
			  <tr align="center">
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Product Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Raw Material Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Quantity</td>
			</tr>
			<tr>
			  <td align="center">Rod</td>
			  <td align="center">1</td>
			  <td align="center">2</td>
			</tr>
			<tr>
			  <td align="center">Spring</td>
			  <td align="center">4</td>
			  <td align="center">5</td>
			</tr>
		  </table>
	  </div>
	</DIV>
</div>
</body>
</html>
