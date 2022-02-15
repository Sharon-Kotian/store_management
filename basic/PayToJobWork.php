<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'accounts_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
	
			if(isset($_POST['paid']))
					{
						
						$ch=$_POST['ch_no'];
						$update_query= mysqli_query($connection, "UPDATE ext_job_work SET jw_status='Paid' WHERE jw_challan_number='$ch'");
						if($update_query)
						{
							echo '<script>alert("Record Updated");
				window.location.replace("PayToJobWork.php")</script>';
						}
						else
						{
							echo '<script>alert("Not Updated");
				window.location.replace("PayToJobWork.php")</script>';
							
						}
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

	<title>Pay To Job Work</title>
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
		$("#rm_name").select2();
		$('#but_read').click(function(){
		var username = $('#rm_name option:selected').text();
		var userid = $('#rm_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	</SCRIPT>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
  //  include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Pay To Job Work</h1>
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
	<form name="frm" method="post" action="">
		<table style="width:70%" id="formContent" align="center">
			<tr align="center">									
				<td align="center" class="form-label"><br><br>Challan Number: </td>
				<td align="center"><br><br><input type="text" id="jw_id" class="form-control" name="jw_id" style="width: 200px; height: 40px;"></td>
				<td align="center"><br><br><input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Show Amount " id="myBtn">	
				</td>
			</tr>
			<?php
				if(isset($_POST['submit'])){
					$jw_id=$_POST['jw_id'];
					//$jw_tot_amt=$_POST['jw_tot_amt'];
				
					$jw_id=mysqli_real_escape_string($connection,$jw_id);
					//$jw_tot_amt=mysqli_real_escape_string($connection,$jw_tot_amt);

					$row=mysqli_query($connection, "SELECT * FROM ext_job_work WHERE jw_challan_number='$jw_id'");
					if($data=mysqli_fetch_array($row)){	
					
			?>
			<tr>
				<form name="frm1" method="post" action="">
				<td align="center" class="form-label"><br><br>Amount Payable: </td>
				<td align="center"><br><br><input type="text" id="jw_tot_amt" class="form-control" name="jw_tot_amt" style="width: 200px; height: 40px;" value="<?php echo $data['jw_tot_amt']; ?>" readonly></td>
				<td align="center"><br><br><input type="text" id="ch_no" class="form-control" name="ch_no" style="width: 200px; height: 40px;" value="<?php echo $data['jw_challan_number']; ?>" hidden><input type="submit" class="btn btn-primary btn-lg" value="Mark as Paid " id="paid" name="paid"></form>	
				
			
				</td>
					</tr>
<?php				
					}
					}
				
			mysqli_close($connection);
			?>
			
			
		</table><br><br><br>
	</form>
	<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Processing to Pay!!
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
