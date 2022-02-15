<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}

	if(isset($_POST['submitg'])){
			$po_din = $_POST['po_din'];
			$po_boxes_actual_received = $_POST['po_boxes_actual_received'];

			$po_din = mysqli_real_escape_string($connection, $po_din);
			$po_boxes_actual_received = mysqli_real_escape_string($connection, $po_boxes_actual_received);

			$rs=mysqli_query($connection, "SELECT * from po_summary WHERE po_din='$po_din'");
			if(mysqli_num_rows($rs)>0){
				$update_query=mysqli_query($connection, "UPDATE po_summary SET po_boxes_actual_received='$po_boxes_actual_received' WHERE po_din='$po_din'");
				if($update_query){
					echo '<script type="text/javascript">alert("Quantity of Boxes Updated Successfully.");
					window.location.replace("HandoverToCountingDepartment(Good Review).php")</script>';
				}else{
					echo 'Error.';
				}
			}
			else{
				echo 'Error.';
				echo '<script>window.location.replace("HandoverToCountingDepartment(Good Review).php")</script>';
			}
		};


		if(isset($_POST['printpo'])){
			$po_din = $_POST['po_din'];
			$po_boxes_actual_received = $_POST['po_boxes_actual_received'];

			$po_din = mysqli_real_escape_string($connection, $po_din);
			$po_boxes_actual_received = mysqli_real_escape_string($connection, $po_boxes_actual_received);

			$_SESSION['po_din']=$_POST['po_din'];
			$_SESSION['po_boxes_actual_received']=$_POST['po_boxes_actual_received'];
			$rs=mysqli_query($connection, "SELECT * from po_summary WHERE po_din='$po_din'");
			if(mysqli_num_rows($rs)>0){
				$update_query=mysqli_query($connection, "UPDATE po_summary SET po_boxes_actual_received='$po_boxes_actual_received' WHERE po_din='$po_din'");
				if($update_query){
					echo '<script>window.open("PrintHandoverToCountingDepartment(Good Review).php")</script>';
				}else{
					echo 'Error.';
				}
			}
			else{
				echo '<script>window.open("PrintHandoverToCountingDepartment(Good Review).php")</script>';
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

	<title>Handover To Counting Department</title>
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
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 				
</head>
<body class="bg-light text-dark">
<header>	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Handover To Counting Department</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='VerifyNoBoxesForm1.php'">
					Verify No of Boxes
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ViewNoBoxes.php'">
					DIN Reprint
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofGoodsReceived.php'">
					List of Goods Received
				  </button>
			</div>
		  </div>
</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" action="" method="post">
			<table style="width:60%" id="formContent" align="center">
				<tr align="center">
				<?php 
					//include_once("../includes/db.php");
					//global $connections;	
					//session_start();
					$po_number=$_SESSION['po_number'];
					$rs=mysqli_query($connection, "SELECT po_din, po_boxes_actual_received from po_summary WHERE po_number='$po_number'");
					$row=mysqli_fetch_array($rs);
					if($row){
					?>		
					<br><br><br>
					<td align="center" class="form-label"><br><br>DIN Number: </td>
					<td align="center"><br><br><input type="text" id="po_din" class="form-control" name="po_din"  style="width: 250px; height: 40px;" value="<?php echo $row['po_din']; ?>" readonly></td>
				</tr>
				
				<tr>
					<td align="center" class="form-label"><br><br>Quantity Of Boxes: </td>
					<td align="center"><br><br><input type="text" id="po_boxes_actual_received" class="form-control" name="po_boxes_actual_received"  style="width: 250px; height: 40px;" value="<?php echo $row['po_boxes_actual_received']; ?>"></td>
				<?php 
				} 
				mysqli_close($connection);
				?>
				</tr>
			</table>
		<br><br><br>
		<p align="center"><input type="submit" class="btn btn-primary" value="  Save  " name="submitg"></p>
		<p align="center"><input type="submit" class="btn btn-primary" value="  Save and Print  " name="printpo">	</p>	
		</form>	
	</div>
</div>

</body>
</html>
