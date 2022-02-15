<?php
	include_once ("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'purchase_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	if(isset($_POST['submit'])){
		$po_number=$_POST['po_number'];
		$rs= mysqli_query($connection, "SELECT * from po_summary WHERE po_number ='$po_number'");
        $status=mysqli_query($connection, "UPDATE po_summary SET po_status='Closed' WHERE po_number='$po_number'");
		$status1=mysqli_query($connection, "UPDATE po_details SET po_status='Closed' WHERE po_number='$po_number'");		
        if($status && $status1){
            echo '<script>alert("PO closed");
            window.location.replace("closePO.php")</script>';    
        }
        else{
            echo "Error.".mysqli_error($connection);
            echo '<script>window.location.replace("closePO.php")</script>';
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

	<title>Close PO</title>
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
    function clicked() {
       if (confirm('Do you want to Close PO?')) {
           yourformelement.submit();
       } else {
           return false;
       }
    }

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
	<h1 class="display-3" align="center">Close PO</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewBOM.php'">
					View BOM
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 75px;" onClick="parent.location='UpdateStockQuantityForMaterial.php'">
					Update stock quantity for material
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" method="post" action="">
			<table style="width:60%" id="tableContent" align="center">
				<tr align="center">		
					<td align="center" class="form-label"><br><br>PO Number: </td>
					<td align="center"><br><br><select name="po_number" id="po_number" style="width: 250px; height: 40px;" data-select2-id="select2-data-qc_invoice_no" class="form-select" required>
						<option value="">Select PO number</option>
						<?php 
							$records=mysqli_query($connection,"SELECT po_number from po_summary WHERE po_status='Goods Received' OR po_status='PO issued'");
							while($data=mysqli_fetch_array($records)){
								echo "<option value='".$data['po_number']."'>".$data['po_number']."</option>";
							}
						?>
					</select></td>
				</tr>
				<br><br>
			</table>
			<br><br>
			<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="Close" id="myBtn" onclick="clicked();" >
		</form>				
	</div>
</div>
</body>
</html>

<?php mysqli_close($connection); ?>
