<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'accounts_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$supp_name=$_POST['supp_name'];
		$supp_address=$_POST['supp_address'];
		$supp_pan=$_POST['supp_pan'];
		$supp_gstin=$_POST['supp_gstin'];
		$supp_state_name=$_POST['supp_state_name'];
		$supp_state_code=$_POST['supp_state_code'];
		$supp_bank_details=$_POST['supp_bank_details'];
		$supp_default_credit_period=$_POST['supp_default_credit_period'];

		$supp_name=mysqli_real_escape_string($connection,$supp_name);
		$supp_address=mysqli_real_escape_string($connection,$supp_address);
		$supp_pan=mysqli_real_escape_string($connection,$supp_pan);
		$supp_gstin=mysqli_real_escape_string($connection,$supp_gstin);
		$supp_state_name=mysqli_real_escape_string($connection,$supp_state_name);
		$supp_state_code=mysqli_real_escape_string($connection,$supp_state_code);
		$supp_bank_details=mysqli_real_escape_string($connection,$supp_bank_details);
		$supp_default_credit_period=mysqli_real_escape_string($connection,$supp_default_credit_period);
		
		$rs=mysqli_query($connection, "SELECT * from supplier WHERE supp_name='$supp_name'");

		if(mysqli_num_rows($rs)>0){
				echo '<script type="text/javascript"> alert("Supplier already exits.");
				window.location.replace("New Supplier Details.php")</script>';
		}
		else{
		$insert_query=mysqli_query($connection, "INSERT into supplier (supp_id,supp_name, supp_address, supp_pan, supp_gstin, supp_state_name, supp_state_code, supp_bank_details, supp_default_credit_period) VALUES('','$supp_name','$supp_address','$supp_pan','$supp_gstin','$supp_state_name','$supp_state_code','$supp_bank_details','$supp_default_credit_period')");
			if($insert_query){
				echo '<script type="text/javascript">alert("Supplier Added Successfully.");
				window.location.replace("New Supplier Details.php")</script>';
			}
			else{
				echo "Error" .mysqli_error($connection);
			}
		}
		mysqli_close($connection);
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

	<title>New Supplier Details</title>
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
	<script src="JS/PlacePurchaseOrderLink3.js"></script>
	<SCRIPT>
	$(document).ready(function(){
		$("#supp_state_name").select2();
		$('#but_read').click(function(){
		var username = $('#supp_state_name option:selected').text();
		var userid = $('#supp_state_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	</SCRIPT>
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
	<h1 class="display-3" align="center">New Supplier Details</h1>
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
	<div id="formContent"><br><br>
	<form name="form1" method="POST" action="">
		<table style="width:100%" id="formContent">
			<tr align="center">									
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier Name : </td>
				<td align="left" style="width:45%"><br><br><input type="text" id="supp_name" class="form-control" name="supp_name" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier Address : </td>
				<td align="left"><br><br><input type="text" id="supp_address" class="form-control" name="supp_address" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier Pan Number : </td>
				<td align="left"><br><br><input type="text" id="supp_pan" class="form-control" name="supp_pan" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier GST Number : </td>
				<td align="left"><br><br><input type="text" id="supp_gstin" class="form-control" name="supp_gstin" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier State Name : </td>
				<td align="left"><br><br><select name="supp_state_name" id="supp_state_name" style="width: 300px; height: 40px;" class="form-select">
				<option value="Andhra Pradesh">Andhra Pradesh</option>
				<option value="Arunachal Pradesh">Arunachal Pradesh</option>
				<option value="Assam">Assam</option>
				<option value="Bihar">Bihar</option>
				<option value="Chhattisgarh">Chhattisgarh</option>
				<option value="Delhi">Delhi</option>
				<option value="Goa">Goa</option>
				<option value="Gujarat">Gujarat</option>
				<option value="Haryana">Haryana</option>
				<option value="Himachal Pradesh">Himachal Pradesh</option>
				<option value="Jharkhand">Jharkhand</option>
				<option value="Karnataka">Karnataka</option>
				<option value="Kerala">Kerala</option>
				<option value="Madhya Pradesh">Madhya Pradesh</option>
				<option value="Maharashtra">Maharashtra</option>
				<option value="Manipur">Manipur</option>
				<option value="Meghalaya">Meghalaya</option>
				<option value="Mizoram">Mizoram</option>
				<option value="Nagaland">Nagaland</option>
				<option value="Odisha">Odisha</option>
				<option value="Punjab">Punjab</option>
				<option value="Rajasthan">Rajasthan</option>
				<option value="Sikkim">Sikkim</option>
				<option value="Tamil Nadu">Tamil Nadu</option>
				<option value="Telangana">Telangana</option>
				<option value="Tripura">Tripura</option>
				<option value="Uttar Pradesh">Uttar Pradesh</option>
				<option value="Uttarakhand">Uttarakhand</option>
				<option value="West Bengal">West Bengal</option>
				<option value="China">China</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier State Code : </td>
				<td align="left"><br><br><input type="text" id="supp_state_code" class="form-control" name="supp_state_code"  style="width:300px; height:40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier Bank Details : </td>
				<td align="left"><br><br><input type="text" id="supp_bank_details" class="form-control" name="supp_bank_details" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="right" class="form-label" style="width:50%;padding-right:200px;"><br><br>Supplier's Default Credit Period : </td>
				<td align="left"><br><br><input type="text" id="supp_default_credit_period" class="form-control" name="supp_default_credit_period" style="width: 300px; height: 40px;" required></td>
			</tr>
		</table><br><br><br>
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value="  Add  " data-bs-toggle="modal" data-bs-target="#exampleModal" name="submit"></p>	
		</form>
	<!--	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Confirm Add</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Do you want to Add the Supplier: </td>
							<td align="left"><input type="text" id="supp_name" class="form-control" name="supp_name" readonly></td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm Add</button>
				  </div>
				</div>
			  </div>
		</div>-->
	</div>
</div>

</body>
</html>
