<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'purchase_dept'){
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

	<title>View Pending Purchase Orders</title>
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
	<h1 class="display-3" align="center">View Pending Purchase Orders</h1>
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
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" href="ViewPendingPOs.php?source=Supplier" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Supplier Wise</a>
			<a class="btn btn-primary btn-lg" href="ViewPendingPOs.php?source=Date" ONCLICK="ShowProduct()" style="width: 250px; height: 50px;">Date Wise</a>
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
					case 'Supplier':
						//global $connection;
						echo '<br><br>';
						echo '<select name="supp_name" id="supp_name" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select Supplier</option>';
						$query = "SELECT supp_id, supp_name FROM supplier";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$supp_id = $row['supp_id'];
							$supp_name = $row['supp_name'];

							echo "<option value=$supp_id>$supp_name</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$supp_name = $_POST['supp_name'];
							$query = "SELECT * FROM po_summary WHERE po_supp_id = {$supp_name}";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>PO number</th>
									<th>Supplier</th>
									<th>PO Issue date</th>
                                    <th>PO expected date</th>
                                    <th>Action</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$selectquery = mysqli_query($connection,"select supp_name from supplier where supp_id = '$supp_name'");
								while($rows = mysqli_fetch_assoc($selectquery)){
								$po_number = $row['po_number'];
								$po_supp_id = $rows['supp_name'];
								$po_ordered_date = $row['po_ordered_date'];
								$po_due_date = $row['po_due_date'];
								
								echo "<tr>";
								echo "<td align='center'>$po_number</td>";
								echo "<td align='center'>$po_supp_id</td>";
								echo "<td align='center'>$po_ordered_date</td>";
								echo "<td align='center'>$po_due_date</td>";
							?>
								<td align='center'><a target="_blank" href="POView.php?id=<?php echo $row['po_number']; ?>" role="button" class="btn btn-outline-info btn-lg" aria-pressed="true">View</a>
								<a target="_blank" href="POPrint1.php?id=<?php echo $row['po_number']; ?>" role="button" class="btn btn-outline-info btn-lg" aria-pressed="true">Print</a></td>
							<?php
								echo "</tr>";
							}
							}
							echo '</tbody>';
                        	echo '</table>';
						}
						
						break;
					
					case 'Date':
						echo '<br><br>';
						echo '<table style="width:75%" align="center">
							<tr>
								<td align="center" class="form-label"><br><br>Start Date: </td>
								<td align="center"><br><br><input type="date" id="po_ordered_date" name="po_ordered_date" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>End Date: </td>
								<td align="center"><br><br><input type="date" id="po_ordered_date1" name="po_ordered_date1" class="form-control" style="width: 300px; height: 45px;" required></td>
							</tr>
						</table>';
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$po_ordered_date = $_POST['po_ordered_date'];
							$po_ordered_date1 = $_POST['po_ordered_date1'];
							$query = "SELECT * from po_summary where po_status = 'PO issued' AND date_format(po_ordered_date, '%Y-%m-%d')>='$po_ordered_date' AND date_format(po_ordered_date, '%Y-%m-%d')<='$po_ordered_date1' ORDER BY cast(po_number as int) DESC ";
							$raw_mat_query = mysqli_query($connection,$query);
						
						?>
							
						
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th align='center'>PO number</th>
									<th align='center'>PO Issue date</th>
                                    <th align='center'>PO expected date</th>
                                    <th align='center'>Action</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
							
									
								$po_number = $row['po_number'];
								$po_ordered_date = $row['po_ordered_date'];
								$po_due_date = $row['po_due_date'];
								
								echo "<tr>";
								echo "<td align='center'>$po_number</td>";
								echo "<td align='center'>$po_ordered_date</td>";
								echo "<td align='center'>$po_due_date</td>";
							?>
								<td align='center'><a target="_blank" href="POView.php?id=<?php echo $row['po_number']; ?>" role="button" class="btn btn-outline-info btn-lg" aria-pressed="true">View</a>
								<a target="_blank" href="POPrint1.php?id=<?php echo $row['po_number']; ?>" role="button" class="btn btn-outline-info btn-lg" aria-pressed="true">Print</a></td>
							<?php
								echo "</tr>";
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
	</DIV>
</div>
</body>
</html>
