<?php 
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(isset($_POST['print_data']))
	{
		echo "<br>";
		$ew_id= $_POST['ew_id'];    
		$ew_name = $_POST['ew_name'];
		$ew_ph_no = $_POST['ew_ph_no'];
		$ew_address = $_POST['ew_address'];
		$ew_emer_cont_name = $_POST['ew_emer_cont_name'];
		$ew_emer_cont_no = $_POST['ew_emer_cont_no'];
        
		
		$update_query=mysqli_query($connection, "UPDATE ext_worker SET ew_id='$ew_id', ew_name='$ew_name', ew_ph_no='$ew_ph_no', ew_address='$ew_address' ,
		ew_emer_cont_name='$ew_emer_cont_name' , ew_emer_cont_no='$ew_emer_cont_no', ew_status='' WHERE ew_id='$ew_id'");
        if($update_query){
            echo '<script>alert("Manage Job Worker Updated Successfully");
            window.location.replace("job_workers.php")</script>';
        }
        else{
            echo "Error.".mysqli_error($connection);
            echo '<script>window.location.replace("job_workers.php")</script>';
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

	<title>Update Job Worker Profile</title>
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
	<h1 class="display-3" align="center">Update Job Worker Profile</h1>
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
			<div class="dropdown mt-3">
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Align Items in Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Accept Job Work
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='CreateJobworkerprofile.php'">
				Create Job Workers Profile
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Raw Material information
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HandoverToProduction_RaiseRequisition.php'">
				Handover To Production
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Submit Job Work
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitMaterialToRework.php'">
				Submit Material To Rework
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Manage intermediate goods.php'">
				Manage Intermediate Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='Add Material For Intermediate Goods.php'">
				Add Material For Intermediate Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				View Pending Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical Requisition
				</button>
				<br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Job Work
				</button>
				<br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
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
				$query=mysqli_query($connection, "SELECT * FROM ext_worker WHERE ew_id='$id'");
				$row=mysqli_fetch_array($query);
				if($count=mysqli_num_rows($query))
                {
					$ew_id=$row['ew_id'];    
					$ew_name = $row['ew_name'];
					$ew_ph_no = $row['ew_ph_no'];
					$ew_address = $row['ew_address'];
					$ew_emer_cont_name = $row['ew_emer_cont_name'];
					$ew_emer_cont_no = $row['ew_emer_cont_no'];
					$ew_status=$row['ew_status'];
                   
			?> 
			
			<tr>
			<td align="left" class="form-label"><br><br>Job Workers ID: </td> 
				<td align="left"><br><br><input type="text" id="ew_id" class="form-control" name="ew_id" value="<?php echo $id; ?>" readonly>
				</td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Name: </td>
				<td align="left"><br><br><input type="text" id="ew_name" class="form-control" name="ew_name" value="<?php echo $ew_name; ?>" required></td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Phone Number: </td>
				<td align="left"><br><br><input type="text" id="ew_ph_no" class="form-control" name="ew_ph_no" value="<?php echo $ew_ph_no; ?>" required></td>
			</tr>	

            <tr>
				<td align="left" class="form-label">Address: </td> 
				<td align="left"><textarea style="margin-top: 40px;" id="ew_address" class="form-control" name="ew_address" rows="4" cols="30" required><?php echo $row['ew_address']; ?></textarea></td>
			</tr>

            <tr>
				<td align="left" class="form-label"><br><br>Emergency Contact Name: </td>
				<td align="left"><br><br><input type="text" id="ew_emer_cont_name" class="form-control" name="ew_emer_cont_name" value="<?php echo $ew_emer_cont_name; ?>" required></td>
			</tr>

            <tr>
				<td align="left" class="form-label"><br><br>Emergency Contact Number: </td>
				<td align="left"><br><br><input type="text" id="ew_emer_cont_no" class="form-control" name="ew_emer_cont_no" value="<?php echo $ew_emer_cont_no; ?>" required></td>
			</tr>	
			<?php } ?>			
			</table><br><br>
			  <p align="center"><a href=""><input type="submit" class="btn btn-primary btn-lg" value="Save" name="print_data"></a>
			  <br><br>
		</form>
	</div>
</body>
</html>

