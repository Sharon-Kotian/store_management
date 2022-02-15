<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept' && $_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	// if($_SESSION['user_dept'] != 'production_dept'){
	// 	echo '<script type="text/javascript">alert("Access Denied.")';
	// 	header("Location: ../login.html");
	// }
	
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

	<title>Historical Requisition</title>
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
	<h1 class="display-3" align="center">Historical Requisition</h1>
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
				<?php
				if($_SESSION['user_dept'] == 'production_dept')
				{
					echo '<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Acceptrawmaterial.php\'">
					Accept Raw Material
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Add Production Estimation.php\'">
					Add Production Estimation
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Returnfaultymaterial.php\'">
					Return Faulty Material
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Submit finished goods.php\'">
					Submit Finished Goods
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Acceptrawmaterial1.php\'">
					Input Expected Output
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'AdhocProduction.php\'">
					Raise Requisition
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'ViewPendingProductions.php\'">
					Historical Production
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'ViewRequisition.php\'">
					Pending requisitions
					</button>';
				}

				else
				{?>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
					Dashboard
					</button><br>
					<hr>
					<?php echo '<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'HandoverToProduction_RaiseRequisition.php\'">
					Handover To Production
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'SubmitMaterialToRework.php\'">
					Submit Material To Rework
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'ViewRequisition.php\'">
					View Pending Requisition
					</button>';
				}
				?>
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown">	
	<div class="row" align="center">
		<div id="formContent">
			<p align="center"><a class="btn btn-primary btn-lg" style="width: 300px; height: 50px;" href="ViewPendingProductions.php">Product wise</a>
			<a class="btn btn-primary btn-lg" style="width: 300px; height: 50px;" href="ViewHistoricalRequisition.php">Raw material wise</a></p>
		</div>
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
								<td align="center"><br><br><input type="date" id="rr_req_date" name="rr_req_date" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>End Date: </td>
								<td align="center"><br><br><input type="date" id="rr_req_date1" name="rr_req_date1" class="form-control" style="width: 300px; height: 45px;" required></td>
							</tr>
						</table>';
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$rr_req_date = $_POST['rr_req_date'];
							$rr_req_date1 = $_POST['rr_req_date1'];
							$query = "SELECT * from raise_requisition where date_format(rr_submit_date, '%Y-%m-%d')>='$rr_req_date' AND date_format(rr_submit_date, '%Y-%m-%d')<='$rr_req_date1' ORDER BY cast(rr_submit_date as int) ASC ";
							//$query = "SELECT * from raise_requisition where date_format(rr_submit_date, '%Y-%m-%d')>='$rr_req_date' AND date_format(rr_submit_date, '%Y-%m-%d')<='$rr_req_date1' AND rr_remaining_quantity= 0 ORDER BY rr_submit_date ASC ";
							$raw_mat_query = mysqli_query($connection,$query);
						?>
							
						
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>Requisition ID</th>
									<th>Requisition Material Name</th>
									<th>Requisition Required Date</th>
									<th>Requisition Submitted Date</th>
                                    <th>Body Colour</th>
									<th>Required Quantity</th>
                                    <th>Remaining Quantity</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								
								$rr_id = $row['rr_id'];
								$rr_material_name = $row['rr_material_name'];
								$rr_req_date = $row['rr_req_date'];
								$rr_submit_date = $row['rr_submit_date'];
								$rr_body_colour = $row['rr_body_colour'];
								$rr_remaining_quantity = $row['rr_remaining_quantity'];
								$timestamp = strtotime($rr_req_date); 
								$new_date = date("d-m-Y", $timestamp);
								$timestamp1 = strtotime($rr_submit_date); 
								$new_date1 = date("d-m-Y", $timestamp1);
								$rr_required_quantity = $row['rr_material_quantity'];
								
								echo "<tr align='center'>";
								echo "<td>$rr_id</td>";
								echo "<td>$rr_material_name</td>";
								echo "<td>$new_date</td>";
								echo "<td>$new_date1</td>";
								echo "<td>$rr_body_colour</td>";
								echo "<td>$rr_required_quantity</td>";
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
