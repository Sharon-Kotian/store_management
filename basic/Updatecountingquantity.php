<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
	
	if(isset($_POST['submit'])){
		$po_din=$_POST['po_din'];
		$_SESSION['po_din']=$_POST['po_din'];

		$rs= mysqli_query($connection, "SELECT * from po_summary WHERE po_din='$po_din'");
		$count=mysqli_num_rows($rs);
		if($count==1){
			echo '<script>window.location.replace("Updatecountingquantity1.php")</script>';
			
		}else{
			echo '<script>alert("PO DIN does not exists");
			window.location.replace("Updatecountingquantity.php")</script>';
			
		}
	};
	

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

	<title>Update counting quantity</title>
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
			$("#po_din").select2();
		});
	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 	
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
	<h1 class="display-3" align="center">Update counting quantity</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToQualityCheck.php'">
				Handover To Quality Check
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofCountedGoods.php'">
				List of Counted Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='edit_counted_quantity.php'">
				Edit Counted Quantity
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='CountingDetails.php'">
				Counting details
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='closeDIN.php'">
				Close DIN
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" method="post" action="">
			<table style="width:100%" id="tableContent"><br>
				<tr align="center">		
					<td align="right" class="form-label"><br><br>DIN Number: </td>
					<td align="center"><br><br><select name="po_din" id="po_din" style="width: 250px; height: 40px;" data-select2-id="select2-data-qc_invoice_no" required>
						<?php 
							$records=mysqli_query($connection,"SELECT po_din from po_summary WHERE po_status='Goods Received'");
							while($data=mysqli_fetch_array($records)){
								echo "<option value='".$data['po_din']."'>".$data['po_din']."</option>";
							}
						?>
					</select></td>
				</tr>
				<br><br>
			</table>
			<br><br>
			<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="  Update  " id="myBtn">
		</form>
	<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Submitted!!
			  </div>
			  <button type="button"  id="mybtn"class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
		</div>

					
	</div>
</div>
</body>
</html>

<?php mysqli_close($connection); ?>
