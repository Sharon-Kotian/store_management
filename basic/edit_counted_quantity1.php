<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$po_din=$_POST['po_din'];
		$rm_name=$_POST['rm_name'];
		$po_counting_quantity=$_POST['po_counting_quantity'];
		$qc_bundles_qnty=$_POST["qc_bundles_qnty"];
		$rs= mysqli_query($connection, "SELECT po_number from po_summary WHERE po_din='$po_din'");
		$row=mysqli_fetch_array($rs);
		$po_number= $row['po_number'];

		foreach ($rm_name as $index => $values) {
			
			if(mysqli_num_rows($rs)>0){
				$result=mysqli_query($connection, "SELECT po_number, po_material_name FROM po_details WHERE po_number='$po_number' AND po_material_name='$values'");
				if(mysqli_num_rows($result)>0){
					$insert_query=mysqli_query($connection, "UPDATE po_details SET po_counting_quantity='$po_counting_quantity[$index]' WHERE po_material_name='$values'");
				}else{
					$insert_query=mysqli_query($connection, "INSERT INTO po_details( po_number, po_material_name, po_counting_quantity) VALUES ('$po_number','$values', '$po_counting_quantity[$index]')");
				}
				$counting_date=date("Y-m-d");
				$rs1=mysqli_query($connection, "SELECT din_no, rm_name FROM counting_summary WHERE din_no='$po_din' AND rm_name='$values' AND counting_date='$counting_date' ");
				if(mysqli_num_rows($rs1)>0){
					$insert_query1=mysqli_query($connection, "UPDATE counting_summary SET counting_quantity='$po_counting_quantity[$index]', counting_date = '$counting_date' WHERE rm_name='$values' AND din_no='$po_din'");
				}
				else{
					$rs5=mysqli_query($connection, "SELECT din_no, rm_name FROM counting_summary WHERE din_no='$po_din' AND rm_name='$values'");
					if(mysqli_num_rows($rs5)>0){
						$insert_query1=mysqli_query($connection, "UPDATE counting_summary SET counting_quantity='$po_counting_quantity[$index]', counting_date = '$counting_date' WHERE rm_name='$values' AND din_no='$po_din'");
					}
					else{
						$insert_query1=mysqli_query($connection, "INSERT INTO counting_summary(din_no, rm_name, counting_date, counting_quantity) VALUES ('$po_din','$values', '$counting_date','$po_counting_quantity[$index]')");
					}
				}

				$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity='$po_counting_quantity[$index]' WHERE rm_name='$values'");
				
				$rs2=mysqli_query($connection, "SELECT * FROM quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
				if(mysqli_num_rows($rs2)>0){
					$insert_query2=mysqli_query($connection, "UPDATE quality_control SET qc_bundles_qnty='$qc_bundles_qnty[$index]', qc_counting_quantity='$po_counting_quantity[$index]' WHERE qc_din='$po_din' AND qc_material_name='$values'");
				}else{
					$insert_query2=mysqli_query($connection, "INSERT INTO quality_control(qc_din, qc_material_name, qc_bundles_qnty, qc_counting_quantity) VALUES('$po_din', '$values', '$qc_bundles_qnty[$index]', '$po_counting_quantity[$index]')");
				}
			}
			else{
				echo '<script type="text/javascript">alert("DIN Number does not exists.");
				window.location.replace("edit_counted_quantity.php")</script>';
				$_SESSION['pass_match']=0;
			}
		}
		if($insert_query && $insert_query1 && $insert_query2 && $update_query){
			echo '<script type="text/javascript">alert("Updated Counting Quantity Successfully.");
			window.location.replace("edit_counted_quantity.php")</script>';
			$_SESSION['pass_match']=0;
		}
		else{
			echo "Error" .mysqli_error($connection);
			echo '<script>window.location.replace("edit_counted_quantity.php")</script>';
			$_SESSION['pass_match']=0;
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

	<title>Edit Counted Quantity</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<script src="JS/addRowFunction.js"></script>
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
		// $(document).ready(function(){
		// 	$("#rm_name").select2();
		// });
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
	<h1 class="display-3" align="center">Edit Counted Quantity</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='CountingDetails.php'">
				Counting details
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='edit_counted_quantity.php'">
				Edit Counted Quantity
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
			<table style="width:30%" id="tableContent" align="center"><br>
				<tr align="center">	
				<?php $po_din=$_SESSION['din']; ?>
					<td align="right" class="form-label" colspan="2"><br><br>DIN Number: </td>
					<td align="right" colspan="2"><br><br><input type="text" id="po_din" class="form-control" name="po_din" style="width: 200px; height: 50px;" value="<?php echo $po_din; ?>" readonly></td>
				</tr></table>
				<br><br>
					
					<table border="1px" align="center" class="table table-bordered" style='width:70%'>
					<tr align="center">
						<th align="center">Raw Material Name</th>
						<th align="center">Number of Bundles Prepared</th>
						<th align="center">Quantity Counted</th>
					</tr>
				<?php
					$select_query=mysqli_query($connection, "SELECT * FROM counting_summary WHERE din_no='$po_din'");
					if(mysqli_num_rows($select_query)>0){
						while($rows=mysqli_fetch_array($select_query)){
							$rm_name=$rows['rm_name'];
							$counting_quantity=$rows['counting_quantity'];
							$select=mysqli_query($connection, "SELECT DISTINCT qc_bundles_qnty FROM quality_control WHERE qc_din='$po_din' and qc_material_name='$rm_name'");
							while($row=mysqli_fetch_array($select)){
								$qc_bundles_qnty=$row['qc_bundles_qnty'];
							?>
							<tr>
								<td align="center"><input type="text" id="rm_name" class="form-control" name="rm_name[]" style="width: 300px;" value="<?php echo $rows['rm_name']; ?>" readonly></td>
								<td align="center"><input type="number" id="qc_bundles_qnty" class="form-control" name="qc_bundles_qnty[]" style="width: 100px;" step=".01" value="<?php echo $row['qc_bundles_qnty']; ?>" required></td>
								<td align="center"><input type="number" id="po_counting_quantity" class="form-control" name="po_counting_quantity[]" style="width: 100px;"  step=".01" value="<?php echo $rows['counting_quantity']; ?>" required></td>
							</tr>
						<?php }
							
						}
						}	
					else{
						echo '<script>alert("List of Materials Not Available for this DIN.");
						window.location.replace("edit_counted_quantity.php")</script>';
					}
			?>
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
<!--toast script-->
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $('.toast').toast('show');
  });
});
</script>
</body>
</html>

<?php mysqli_close($connection); ?>
