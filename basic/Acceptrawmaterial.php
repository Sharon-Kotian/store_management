<?php
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
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

	<title>Accept Raw Material</title>
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
	<meta name="viewport" content=" width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
	<SCRIPT>
		$(document).ready(function(){
		$("#po_invoice_no").select2();
	});
	
	function ShowProduct() {
    var x = document.getElementById('SectionName');
	var y = document.getElementById('ProductName');
    if (x.style.display == 'none') {
        y.style.display = 'block';
    } else {
        x.style.display = 'none';
		y.style.display = 'block';
    }
	}

	function ShowRowMaterial() {
		var y = document.getElementById('ProductName');
		var x = document.getElementById('SectionName');
		if (y.style.display == 'none') {
			x.style.display = 'block';
		} else {
			y.style.display = 'none';
			x.style.display = 'block';
		}
	}
	</SCRIPT>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    // include "../includes/header.php";
	// global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Accept Raw Material</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Add Production Estimation.php'">
				Add Production Estimation
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Returnfaultymaterial.php'">
				Return Faulty Material
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submit finished goods.php'">
				Submit Finished Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial1.php'">
				Input Expected Output
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AdhocProduction.php'">
				Raise Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPendingProductions.php'">
				Historical Production
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				Pending requisitions
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical requisitions
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="Product Wise" ONCLICK="ShowRowMaterial()" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value="Raw Material Wise" ONCLICK="ShowProduct()" style="width: 300px; height: 45px;"></p>	
	</div>
	<div id="SectionName" STYLE="display:none"><br>
		<form method="post" action="">
			<table border="1px" align="center" class="table table-bordered" ><br><br>
				<tr>
				  <td class="fadeIn fourth" style="width: 200px; height: 50px;" align="center"><b>Requisition ID</b></td>
				  <td class="fadeIn fourth" style="width: 200px; height: 50px;" align="center"><b>Raw Material Name</b></td>
				  <td class="fadeIn fourth" style="width: 200px; height: 50px;" align="center"><b>Quantity</b></td>
				</tr>
				
				<?php
					$date=date('Y-m-d');
					$query=mysqli_query($connection, "SELECT * FROM product_requisition WHERE (pr_status='Handed to Production' OR pr_status='Partially to Prod') AND pr_submitted_quantity!='0' AND pr_submitted_quantity!=pr_accepted_quantity");
					if(mysqli_num_rows($query)){
						while($row=mysqli_fetch_array($query)){
				?>
					<tr>
						<td><input type="text" id="pr_id" name="pr_id[]" value="<?php echo $row['pr_id']; ?>"style="text-align: center" class="form-control" readonly></td>
						<td hidden="true"><input type="hidden" id="pr_product_id" name="pr_product_id[]" value="<?php echo $row['pr_product_id']; ?>"style="text-align: center" class="form-control" readonly></td>
						<td hidden="true"><input type="hidden" id="pr_material_quantity" name="pr_material_quantity[]" value="<?php echo $row['pr_material_quantity']; ?>"style="text-align: center" class="form-control" readonly></td>
						<td><input type="text" id="pr_material_name" name="pr_material_name[]" value="<?php echo $row['pr_material_name']; ?>"style="text-align: center" class="form-control" readonly></td>
						<td> <input type="text" id="pr_submitted_quantity" name="pr_submitted_quantity[]" style="text-align: center" class="form-control" value="<?php echo $row['pr_submitted_quantity']-$row['pr_accepted_quantity']; ?>" readonly> </td>
					</tr>
					<?php
					}
				}
				?>

			</table>
			<br>
		
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="Accept" data-bs-toggle="modal" data-bs-target="#exampleModal"></p>	

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Confirm</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Do you accept all these Raw Materials. </td>
						</tr>
					</table>
                </form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary">Confirm</button>
				  </div>
				</div>
			  </div>
		</div>
		</form>			
	</div>
	
	<DIV ID="ProductName" STYLE="display:none">
		<form method="post" action="">
		<table style="width:70%" id="formContent">			
			<tr>
				<table border="1px" align="center" class="table table-bordered">
			<tr>
			  <td class="fadeIn fourth" align="center" style="width: 400px; height: 50px;" id="rr_material_name" name="rr_material_name"><b>Raw Material Name</b></td>
			  <td class="fadeIn fourth" align="center" style="width: 400px; height: 50px;" id="rr_new_quantity" name="rr_new_quantity"><b>Quantity</b></td>
			  
			</tr>
			<?php
				$query=mysqli_query($connection, "SELECT rr_material_name, rr_new_quantity, rr_req_date from raise_requisition where rr_status='Partially to Prod' OR rr_status='Handed to Prod' AND rr_req_date= DATE(NOW())");
				while($row=mysqli_fetch_array($query)){?>
					<tr>
						<td><input type="text" class="form-control" name="rr_material_name[]" value="<?php echo $row['rr_material_name']; ?>" id="rr_material_name" style="width: 100%" readonly></td>
						<td><input type="text" class="form-control" name="rr_new_quantity[]" value="<?php echo $row['rr_new_quantity']; ?>" id="rr_new_quantity" style="width: 100%" readonly></td>
					</tr>
					<?php
				}
			?>
		</table>
			</tr>			
		</table>
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" name="add" value="Accept" id="add"></p>	
		</form>			
	</div>
</div>
</body>
</html>
<?php

if(isset($_POST["submit"]))
{
	$pr_id=$_POST['pr_id'];
	$pr_product_id=$_POST['pr_product_id'];
	date_default_timezone_set('Asia/Kolkata');
	$time=date('H:i:s', time());
	
	if($pr_id==''){
		echo '<script>alert("No Materials to Accept");
		window.location.replace("Acceptrawmaterial.php")</script>';
	}else{
		/*$query=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$prod_name'");
		while($row=mysqli_fetch_array($query)){
			$fps_id = $row['fps_id'];
			//echo $fps_id."<br>";
			//echo $prod_quantity."<br>";
			$rs=mysqli_query($connection, "SELECT count(fps_id) from finished_product_details WHERE fps_id='$fps_id' ");
			$rs1=mysqli_query($connection, "SELECT count(fps_id) from finished_product_details WHERE fps_id='$fps_id' AND fpd_material_quantity * '$prod_quantity'=fpd_submitted_quantity ");
			$data=mysqli_fetch_array($rs);
			$data1=mysqli_fetch_array($rs1);
			//echo $data1[0];
			if($data[0]==$data1[0]){
				$sql = mysqli_query($connection, "UPDATE production SET prod_status='RawMaterial Accepted', prod_accept_time='$time' WHERE prod_name='$prod_name'");
				$sql1=mysqli_query($connection, "UPDATE finished_product_details SET fpd_accepted_quantity='0', fpd_submitted_quantity='0' WHERE fps_id='$fps_id'");
				if ($sql && $sql1) {
					echo '<script>alert("Raw Material Accepted.");
					window.location.replace("Acceptrawmaterial1.php")</script>';
				} else {
					//echo "Error: " . $sql . "<br>" . $connection->error;	
				}
			}else{*/
				foreach($pr_id as $index => $values){
					$sql=mysqli_query($connection, "UPDATE product_requisition SET pr_accepted_quantity = pr_submitted_quantity WHERE pr_id='$pr_id[$index]'");
				}
				if($sql){
					echo '<script>alert("Raw Material Partially Accepted.");
					window.location.replace("Acceptrawmaterial.php")</script>';
				}else{
					echo 'Error'.mysqli_error($sql);
				}
				
			}
			
		}
	//}	
//}

if(isset($_POST["add"])){
	$rr_material_name= $_POST['rr_material_name'];
	$rr_new_quantity= $_POST['rr_new_quantity'];
	$rr_status= $_POST['rr_status'];
	
	foreach ($rr_material_name as $index => $names) {	
				echo $names;
				$query="UPDATE raise_requisition SET rr_status='Raw Material Accepted' WHERE rr_material_name='$rr_material_name[$index]'";
				$insert_query=mysqli_query($connection, $query);    
				if($insert_query){
					echo '<script>alert("Raw Material Accepted.");
					window.location.replace("Acceptrawmaterial.php")</script>';
				}
				else{
					echo "Error" .mysqli_error($connection);
					echo '<script>window.location.replace("Acceptrawmaterial.php")</script>';
				}
		}
}
mysqli_close($connection);
?>
