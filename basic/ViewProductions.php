<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
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

	<title>View Pending Requisition</title>
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
	<h1 class="display-3" align="center">View Pending Requisition</h1>
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
				if(isset($_GET['source']))
				{
					$source = $_GET['source'];
				}
				else
				{
					$source = '';
				}					
						echo '<table style="width:75%" align="center">
							<tr>
								<td align="center" class="form-label"><br><br>Start Date: </td>
								<td align="center"><br><br><input type="date" id="prod_require_date" name="prod_require_date" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>End Date: </td>
								<td align="center"><br><br><input type="date" id="prod_require_date1" name="prod_require_date1" class="form-control" style="width: 300px; height: 45px;" required></td>
							</tr>
						</table>';
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$prod_require_date = $_POST['prod_require_date'];
							$prod_require_date1 = $_POST['prod_require_date1'];
							$query = "SELECT * from production where date_format(prod_require_date, '%Y-%m-%d')>='$prod_require_date' AND date_format(prod_require_date, '%Y-%m-%d')<='$prod_require_date1' ORDER BY cast(prod_id as int) DESC ";
							$raw_mat_query = mysqli_query($connection,$query);
						
						?>
							
						
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>Production ID</th>
									<th>Production Name</th>
									<th>Production Required Date</th>
                                    <th>Body Colour</th>
                                    <th>Remaining Quantity</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$prod_id = $row['prod_id'];
								$prod_name = $row['prod_name'];
								$prod_require_date = $row['prod_require_date'];
								$prod_color = $row['prod_color'];
								$rr_remaining_quantity = $row['rr_remaining_quantity'];
								
								echo "<tr align='center'>";
								echo "<td>$prod_id</td>";
								echo "<td>$prod_name</td>";
								echo "<td>$prod_require_date</td>";
								echo "<td>$prod_color</td>";
								echo "<td>$rr_remaining_quantity</td>";
								echo "</tr>";
							}
							echo '</tbody>';
                        	echo '</table>';
						}   

			?>
		</form>
	</div>
	</DIV>
</div>
</body>
</html>