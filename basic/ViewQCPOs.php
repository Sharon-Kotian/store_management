<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'qc_dept'){
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

	<title>View historical QCs</title>
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
		$("#qc_din").select2();
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
            $("#qc_material_name").select2();
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
	<h1 class="display-3" align="center">View historical QCs</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submitjobworkqualityreport1.php'">
				Submit Job Work Quality Report
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='QC_Details.php'">
				Quality Check Details
				</button>
				
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" href="ViewQCPOs.php?source=Material" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Material Wise</a>
			<a class="btn btn-primary btn-lg" href="ViewQCPOs.php?source=Date" ONCLICK="ShowProduct()" style="width: 250px; height: 50px;">Date Wise</a>
			<a class="btn btn-primary btn-lg" href="ViewQCPOs.php?source=DIN" ONCLICK="ShowProduct()" style="width: 250px; height: 50px;">DIN Wise</a>
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
					case 'Material':
						//global $connection;
						echo '<br><br>';
						echo '<select name="qc_material_name" id="qc_material_name" class="form-control" style="width: 400px; height: 45px;">';
						$query = "SELECT DISTINCT qc_material_name FROM quality_control where qc_status='QC Done'";
						
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							//$qc_id  = $row['qc_id'];
							$qc_material_name = $row['qc_material_name'];

							echo "<option value='$qc_material_name'>$qc_material_name</option>";
						}echo $qc_id;
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$qc_material_name = $_POST['qc_material_name'];
							$query = "SELECT * FROM quality_control WHERE qc_material_name  = '$qc_material_name' and qc_status='QC Done'";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>QC ID</th>
									<th>QC DIN</th>
									<th>QC Material Name</th>
                                    <th>Quantity Received</th>
									<th>Quantity to Stores</th>
                                    <th>QC Action</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$selectquery = mysqli_query($connection,"select DISTINCT qc_material_name from quality_control where qc_material_name  = '$qc_material_name' and qc_status='QC Done'");
								while($rows = mysqli_fetch_assoc($selectquery)){
								$qc_id = $row['qc_id'];
								$qc_din = $row['qc_din'];
								$po_qc_id  = $rows['qc_material_name'];
								$qc_counting_quantity = $row['qc_counting_quantity'];
								$qc_stores_quantity = $row['qc_stores_quantity'];
								$qc_Action = $row['qc_Action'];
								
								echo "<tr align='center'>";
								echo "<td>$qc_id</td>";
								echo "<td>$qc_din</td>";
								echo "<td>$qc_material_name </td>";
								echo "<td>$qc_counting_quantity</td>";
								echo "<td>$qc_stores_quantity</td>";
								echo "<td>$qc_Action</td>";
								
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
								<td align="center"><br><br><input type="date" id="counting_date" name="counting_date" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>End Date: </td>
								<td align="center"><br><br><input type="date" id="counting_date1" name="counting_date1" class="form-control" style="width: 300px; height: 45px;" required></td>
							</tr>
						</table>';
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$counting_date = $_POST['counting_date'];
							$counting_date1 = $_POST['counting_date1'];
							$query = "SELECT * from quality_control where qc_din IN (select din_no from counting_summary where date_format(counting_date, '%Y-%m-%d')>='$counting_date' AND date_format(counting_date, '%Y-%m-%d')<='$counting_date1') and qc_status='QC Done' ORDER BY qc_id DESC ";
							$raw_mat_query = mysqli_query($connection,$query);
						
						?>
							
						
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>QC ID</th>
									<th>QC DIN</th>
									<th>QC Material Name</th>
                                    <th>Quantity Received</th>
									<th>Quantity to Stores</th>
                                    <th>QC Action</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$qc_id = $row['qc_id'];
								$qc_din = $row['qc_din'];
								$qc_material_name  = $row['qc_material_name'];
								$qc_counting_quantity = $row['qc_counting_quantity'];
								$qc_stores_quantity = $row['qc_stores_quantity'];
								$qc_Action = $row['qc_Action'];
								
								echo "<tr align='center'>";
								echo "<td>$qc_id</td>";
								echo "<td>$qc_din</td>";
								echo "<td>$qc_material_name </td>";
								echo "<td>$qc_counting_quantity</td>";
								echo "<td>$qc_stores_quantity</td>";
								echo "<td>$qc_Action</td>";
							}
							echo '</tbody>';
                        	echo '</table>';
						}
							
						break;
						
					
					case 'DIN':
						//global $connection;
						echo '<br><br>';
						echo '<select name="qc_din" id="qc_din" class="form-control" style="width: 400px; height: 45px;">';
						$query = "SELECT DISTINCT qc_din FROM quality_control where qc_status='QC Done'";
						
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							//$qc_id  = $row['qc_id'];
							$qc_din = $row['qc_din'];

							echo "<option value='$qc_din'>$qc_din</option>";
						}//echo $qc_id;
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="supp_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['supp_name_submit']))
						{
							$qc_din = $_POST['qc_din'];
							$query = "SELECT * FROM quality_control WHERE qc_din  = '$qc_din' and qc_status='QC Done'";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>QC ID</th>
									<th>QC DIN</th>
									<th>QC Material Name</th>
                                    <th>Quantity Received</th>
									<th>Quantity to Stores</th>
                                    <th>QC Action</th>                      
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$selectquery = mysqli_query($connection,"select DISTINCT qc_din from quality_control where qc_din = '$qc_din' and qc_status='QC Done'");
								while($rows = mysqli_fetch_assoc($selectquery)){
								$qc_id = $row['qc_id'];
								$qc_din = $rows['qc_din'];
								$qc_material_name  = $row['qc_material_name'];
								$qc_counting_quantity = $row['qc_counting_quantity'];
								$qc_stores_quantity=$row['qc_stores_quantity'];
								$qc_Action = $row['qc_Action'];
								
								echo "<tr align='center'>";
								echo "<td>$qc_id</td>";
								echo "<td>$qc_din</td>";
								echo "<td>$qc_material_name </td>";
								echo "<td>$qc_counting_quantity</td>";
								echo "<td>$qc_stores_quantity</td>";
								echo "<td>$qc_Action</td>";
								
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
	</DIV>
</div>
</body>
</html>
