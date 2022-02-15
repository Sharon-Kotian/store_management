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

	<title>Deleted POs</title>
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
		
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	<h1 class="display-3" align="center">Deleted POs (Recycle Bin)</h1>
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
  <div id="formContent">
  <br><br><br>
		<table border="1px" align="center" class="table table-bordered" style='width:70%'>
			<tr style="font-size:28px">
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="po_number" name="po_number" align="center"><b>PO number</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="supplier_name" name="supplier_name" align="center"><b>Supplier</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="po_ordered_date" name="po_ordered_date" align="center"><b>PO Issue date</b></td>
			  <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="po_expected_date" name="po_expected_date" align="center"><b>PO expected date</b></td>
			  <td class="fadeIn fourth" colspan="2" style="width: 400px; height: 50px;" id="action" name="action" align="center"><b>Action</b></td>
			</tr>
			<?php
				$query=mysqli_query($connection, "SELECT po_number, po_ordered_date, po_due_date, po_supp_id from po_summary where po_status = 'Deleted PO'");
				while($row=mysqli_fetch_array($query)){?>
					<tr style="font-size:22px">
					<?php
						$supplier_id = $row['po_supp_id'];
						$query2=mysqli_query($connection, "SELECT supp_name from supplier where supp_id = '$supplier_id'");
						while($row2=mysqli_fetch_array($query2)){
							$supp_name = $row2['supp_name'];
							$po_number=$row['po_number'];
					?>
						<td align="center"><?php echo $row['po_number']; ?></td>
						<td align="center"><?php echo $supp_name; ?></td>
						<td align="center"><?php echo $row['po_ordered_date']; ?></td>
						<td align="center"><?php echo $row['po_due_date']; ?></td>
						<?php echo "<td><a onClick=\"javascript: return confirm('Do you want to Restore the PO = $po_number?');\" href='PORestore.php?id=". $row['po_number']."' role='button' class='btn btn-outline-info btn-lg' aria-pressed='true'>Restore</a></td>";
						echo "<td><a onClick=\"javascript: return confirm('Are you sure to permanently delete the PO = $po_number?');\" class='btn btn-outline-danger btn-lg'  href='PODelete.php?id=".$row['po_number']."' role='button' aria-pressed='true'>Delete</a></td>";?>
					</tr>
					<?php
					}
				}
				mysqli_close($connection);
			?>
		</table>   
  </div>
</div>
<br><br>
</body>
</html>
