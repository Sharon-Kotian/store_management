<?php 
	include_once("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'accounts_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(isset($_POST['print_data']))
	{
		echo "<br>";
        $supp_id = $_POST['supp_id'];    
		$supp_name = $_POST['supp_name'];
		$supp_address = $_POST['supp_address'];
		$supp_state_name = $_POST['supp_state_name'];
		$supp_pan = $_POST['supp_pan'];
		$supp_gstin = $_POST['supp_gstin'];
		$supp_state_code = $_POST['supp_state_code'];
		$supp_bank_details = $_POST['supp_bank_details'];
		$supp_default_credit_period = $_POST['supp_default_credit_period'];
        
        
		
		$update_query=mysqli_query($connection, "UPDATE supplier SET supp_id='$supp_id', supp_name='$supp_name', supp_address='$supp_address', 
		supp_state_name='$supp_state_name' , supp_pan='$supp_pan' , supp_gstin = '$supp_gstin',
		supp_state_code ='$supp_state_code', supp_bank_details = '$supp_bank_details',
		supp_default_credit_period = '$supp_default_credit_period',
		supp_status='' WHERE supp_id='$supp_id'");
        if($update_query){
            echo '<script>alert("Manage Supplier Updated Successfully");
            window.location.replace("supp_workers.php")</script>';
        }
        else{
            echo "Error.".mysqli_error($connection);
            echo '<script>window.location.replace("supp_workers.php")</script>';
        }
		
    }
				
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

	<title>Update Supplier Profile</title>
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
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	
	<script type="text/javascript">
		

	</script>

</head>
<body class="bg-light text-dark">
<header>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Update Supplier Profile</h1>
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
			</button>
            <br><br>
            <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='supp_workers.php'">
					Manage Supplier
			</button>
			</div>
		  </div>
</div>

	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post">
		<table style="width:80%" id="formContent" align="center">
			<?php 
			 	$id=$_GET['id'];
				$query=mysqli_query($connection, "SELECT * FROM supplier WHERE supp_id='$id'");
				$row=mysqli_fetch_array($query);
				if($count=mysqli_num_rows($query))
                {
                $supp_id = $row['supp_id'];    
		        $supp_name = $row['supp_name'];
		        $supp_address = $row['supp_address'];
		        $supp_state_name = $row['supp_state_name'];
                $supp_status = $row['supp_status'];
				$supp_pan =$row['supp_pan'];
				$supp_gstin =$row['supp_gstin'];
				$supp_state_code =$row['supp_state_code'];
				$supp_bank_details =$row['supp_bank_details'];
				$supp_default_credit_period =$row['supp_default_credit_period'];
                   
			?> 
			
			<tr>
			<td align="left" class="form-label"><br><br>Supplier ID: </td> 
				<td align="left"><br><br><input type="text" id="supp_id" class="form-control" name="supp_id" value="<?php echo $id; ?>" readonly>
				</td>
			</tr>
			
			<tr align="center">									
				<td align="left" class="form-label"><br><br>Supplier Name : </td>
				<td align="left"><br><br><input type="text" id="supp_name" class="form-control" name="supp_name" required value="<?php echo $row['supp_name']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier Address : </td>
				<td align="left"><br><br><input type="text" id="supp_address" class="form-control" name="supp_address"  required value="<?php echo $row['supp_address']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier Pan Number : </td>
				<td align="left"><br><br><input type="text" id="supp_pan" class="form-control" name="supp_pan" required value="<?php echo $row['supp_pan']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier GST Number : </td>
				<td align="left"><br><br><input type="text" id="supp_gstin" class="form-control" name="supp_gstin"  required value="<?php echo $row['supp_gstin']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier State Name : </td>
				<td align="left"><br><br><select name="supp_state_name" id="supp_state_name"  class="form-select" value="<?php echo $row['supp_state_name']; ?>">
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
				<td align="left" class="form-label"><br><br>Supplier State Code : </td>
				<td align="left"><br><br><input type="text" id="supp_state_code" class="form-control" name="supp_state_code" required value="<?php echo $row['supp_state_code']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier Bank Details : </td>
				<td align="left"><br><br><input type="text" id="supp_bank_details" class="form-control" name="supp_bank_details" required value="<?php echo $row['supp_bank_details']; ?>"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Supplier's Default Credit Period : </td>
				<td align="left"><br><br><input type="text" id="supp_default_credit_period" class="form-control" name="supp_default_credit_period"  required value="<?php echo $row['supp_default_credit_period']; ?>"></td>
			</tr>
		

            
			<?php } ?>			
			</table><br><br>
			  <p align="center"><a href=""><input type="submit" class="btn btn-primary btn-lg" value="Save" name="print_data"></a>
			  <br><br>
		</form>
	</div>
</body>
</html>

