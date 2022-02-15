<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'accounts_dept'){
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

	<title>Production report</title>
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
	<h1 class="display-3" align="center">Production report</h1>
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
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Production report.php'">
					Production Report
			</button><br><br>
		  	<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Countingreport.php'">
					Counting Report
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='QualityCheckReport1.php'">
					Quality Check Report
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PayToJobWork.php'">
					Pay To Job Work
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageRawMaterials.php'">
					Manage Raw Materials
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageFinishedProducts.php'">
					Manage Finished Products
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='New Supplier Details.php'">
					New Supplier Details
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPOs.php'">
					View POs
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='DeletedPOs.php'">
					Deleted POs
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewInvoices.php'">
					View Invoices
			</button><br><br>
            <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='supp_workers.php'">
					Manage Supplier
			</button>
			</div>
		  </div>
</div>
	
<div class="wrapper fadeInDown">
	<table style="width:30%" id="formContent" align="center">	
		<tr align="center">	
			<td align="right" class="form-label"><br><br>Date : </td>
			<td align="center"><br><br><input type="text" id="frmDate" class="form-control" name="frmDate" style="width: 200px; height: 40px;" readonly>
				<script>
				  var today = new Date();
				  var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
				  document.getElementById("frmDate").value = date;
				</script>
			</td>
		</tr>
	</table><br><br>
	<div id="formContent">
		<p align="center">
			<a class="btn btn-primary btn-lg" href="Production Report.php?source=morning" ONCLICK="ShowRowMaterial()">Morning</a>
			<a class="btn btn-primary btn-lg" href="Production Report.php?source=evening" ONCLICK="ShowProduct()">Evening</a>
			<a class="btn btn-primary btn-lg" href="Production Report.php?source=comparison" ONCLICK="ShowComparison()">Comparison</a>	
		</p>
	</div><br><br>

	<?php
		$frmDate=date('Y-m-d');

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
			case 'morning':
				?>
				<DIV ID="SectionName">
				<p align="center">Morning</p>
					<table border="1px" align="center" class="table table-bordered">
						<tr style="font-size:28px">
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Raw Material</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Quantity Accepted</b></td>
						</tr>
						<?php
							$query=mysqli_query($connection, "SELECT * FROM production where prod_require_date='$frmDate'");
							while($rows=mysqli_fetch_array($query)){
								$prod_name=$rows['prod_name'];
								$select=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$prod_name'");
								while($data=mysqli_fetch_array($select)){
									$fps_id=$data['fps_id'];
									$rs=mysqli_query($connection, "SELECT * FROM finished_product_details where fps_id='$fps_id'");
									while($row=mysqli_fetch_array($rs)){
						?>
						<tr style="font-size:22px">
						  <td align="center"><?php echo $row['fpd_material_name'];?></td>
						  <td align="center"><?php echo $row['fpd_submitted_quantity'];?></td>
						</tr>
						<?php	
									}
								} 
					?>
					</table>
					<br><br>
					<table align="center" width="50%">
						<tr align="center">
							<th>Acceptance Time :</th>
							<th><?php echo $rows['prod_accept_time']; ?></th>
						</tr>
						<tr align="center">
							<th>Idle Time Expected :</th>
							<th><?php echo $rows['prod_idle_time_expected']; ?></th>
						</tr>
						<tr align="center">
							<th>People at Work :</th>
							<th><?php echo $rows['prod_num_people_present']; ?></th>
						</tr>
						<tr align="center" >
							<th>Goods Expected :</th>
							<th><?php echo $rows['estimated_prod_quantity']; ?></th>
						</tr>
					</table><br><br>
				</DIV>
				<?php
			}
					break;
					
					case 'evening':
				?>
				<DIV ID="ProductName">
					<p align="center">Evening</p>
					<table border="1px" align="center" class="table table-bordered">
						<tr style="font-size:28px">
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Raw Material</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Quantity Accepted</b></td>
						</tr>
						<?php
							$query=mysqli_query($connection, "SELECT * FROM production where prod_require_date='$frmDate'");
							while($rows=mysqli_fetch_array($query)){
								$prod_id=$rows['prod_id'];
								$prod_name=$rows['prod_name'];
								$select=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$prod_name'");
								while($data=mysqli_fetch_array($select)){
									$fps_id=$data['fps_id'];
									$rs=mysqli_query($connection, "SELECT * FROM finished_product_details where fps_id='$fps_id'");
									while($row=mysqli_fetch_array($rs)){
						?>
						<tr style="font-size:22px">
						  <td align="center"><?php echo $row['fpd_material_name'];?></td>
						  <td align="center"><?php echo $row['fpd_submitted_quantity'];?></td>
						</tr>
						<?php	
									}
								} 
					?>
					</table>
					<br><br>
					<table align="center" width="50%">
						<tr align="center">
							<th>Acceptance Time :</th>
							<th><?php echo $rows['prod_accept_time']; ?></th>
						</tr>
						<tr align="center">
							<th>Idle Time Actual :</th>
							<th><?php echo $rows['prod_idle_time_actual']; ?></th>
						</tr>
						<tr align="center">
							<th>People at Work :</th>
							<th><?php echo $rows['prod_num_people_present']; ?></th>
						</tr>
						<tr align="center" >
							<th>Goods Expected :</th>
							<th><?php echo $rows['estimated_prod_quantity']; ?></th>
						</tr>
					</table>
				<table border="1px" align="center" class="table table-bordered">
					<tr style="font-size:28px"><br><br>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Faulty Raw Material</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Rework Quantity Accepted</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_accept_time" name="prod_accept_time"><b>Return Quantity Accepted</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_idle_time_expected" name="prod_idle_time_expected"><b>Scrap Quantity Accepted</b></td>
					</tr>
					<?php
						$query=mysqli_query($connection, "SELECT * FROM faulty_goods where faulty_production_id='$prod_id'");
						while($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td align="center"><?php echo $row['faulty_material_name'];?></td>
						<td align="center"><?php echo $row['faulty_rework_quantity'];?></td>
						<td align="center"><?php echo $row['faulty_return_quantity'];?></td>
						<td align="center"><?php echo $row['faulty_scrape_quantity'];?></td>
					</tr>
					<?php }
					}?>
				</table><br><br>		
				</DIV>

				<?php
				break;
					
				case 'comparison':
				?>
	
				<DIV ID="ComparisonName">
					<p align="center">Comparison</p>
					<table border="1px" align="center" class="table table-bordered">
						<tr style="font-size:28px">
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Raw Material</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Quantity Accepted</b></td>
						</tr>
						<?php
							$query=mysqli_query($connection, "SELECT * FROM production where prod_require_date='$frmDate'");
							while($rows=mysqli_fetch_array($query)){
								$prod_id=$rows['prod_id'];
								$prod_name=$rows['prod_name'];
								$select=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$prod_name'");
								while($data=mysqli_fetch_array($select)){
									$fps_id=$data['fps_id'];
									$rs=mysqli_query($connection, "SELECT * FROM finished_product_details where fps_id='$fps_id'");
									while($row=mysqli_fetch_array($rs)){
						?>
						<tr style="font-size:22px">
						  <td align="center"><?php echo $row['fpd_material_name'];?></td>
						  <td align="center"><?php echo $row['fpd_submitted_quantity'];?></td>
						</tr>
						<?php	
						}
					} 
					?>
					</table>
					<table border="1px" align="center" class="table table-bordered">
						<tr style="font-size:28px"><br><br>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Idle Time Expected</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Idle Time Actual</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Expected Product Quantity</b></td>
						  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Actual Product Quantity</b></td>
						</tr>
						<tr style="font-size:22px">
							<td align="center"><?php echo $rows['prod_idle_time_expected'];?></td>
						  <td align="center"><?php echo $rows['prod_idle_time_actual']; ?></td>
						  <td align="center"><?php echo $rows['estimated_prod_quantity'];?></td>
						  <td align="center"><?php echo $rows['prod_quantity'];?></td>
						</tr>
					</table>
					<table border="1px" align="center" class="table table-bordered">
					<tr style="font-size:28px"><br><br>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Faulty Raw Material</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_unit" name="rm_unit"><b>Rework Quantity Accepted</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_accept_time" name="prod_accept_time"><b>Return Quantity Accepted</b></td>
						<td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_idle_time_expected" name="prod_idle_time_expected"><b>Scrap Quantity Accepted</b></td>
					</tr>
					<?php
						$query=mysqli_query($connection, "SELECT * FROM faulty_goods where faulty_production_id='$prod_id'");
						while($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td align="center"><?php echo $row['faulty_material_name'];?></td>
						<td align="center"><?php echo $row['faulty_rework_quantity'];?></td>
						<td align="center"><?php echo $row['faulty_return_quantity'];?></td>
						<td align="center"><?php echo $row['faulty_scrape_quantity'];?></td>
					</tr>
					<?php }
					}?>
				</table><br><br>	
				</DIV>
				<?php
				break;

				default:
						break;
			}
			mysqli_close($connection);
		?>
		</div>
	</body>
</html>
