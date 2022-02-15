<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$pr_required_date=$_POST['pr_required_date'];
		$pr_product_name=$_SESSION['prod_name'];
		$_SESSION['prod_name']= $_POST['pr_product_name'];
		$_SESSION['prod_require_date']= $pr_required_date;
		
		echo '<script type="text/javascript">window.location.replace("HandoverToProduction1.php")</script>';
		
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

	<title>Handover To Production</title>
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
	function ShowRowMaterial() {
		var y = document.getElementById('ProductName');
		var x = document.getElementById('SectionName');
		if (y.style.display == 'none') {
			x.style.display = 'block';
		} else {
			y.style.display = 'none';
		}
	}
	
	$(document).ready(function(){
		$("#prod_name").select2();
	});
	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 				
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    //include "../includes/header.php";
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Handover To Production</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>

				<hr>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitMaterialToRework.php'">
				Submit Material To Rework
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				View Pending Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical Requisition
				</button>	
			</div>
		</div>
	</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><a class="btn btn-primary btn-lg" href="HandoverToProduction.php">Product wise</a>
			<a class="btn btn-primary btn-lg" href="RequisitionResolve.php">Raw material wise</a></p>
	</div>
</div>	

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" method="post" action=""><br><br>
			<table style="width:70%" id="formContent" align="center">
				<tr>
					<td align="right" class="fadeIn fourth" style="width: 300px; height: 50px;"><b>Date:</b></td> 
					<td align="center"><input type="date" id="pr_required_date" class="form-control" name="pr_required_date" style="width:200px; height: 40px;"></td>		
					<td><input type="submit" name="display" class="btn btn-primary btn-lg" value="Display"></td>
				</tr>
			</table><br><br>
			
			<?php 
				if(isset($_POST['display'])){
					$pr_required_date=$_POST['pr_required_date'];
					$_SESSION['prod_require_date']= $pr_required_date;
					$result=mysqli_query($connection, "SELECT DISTINCT `pr_product_id`, `pr_product_name`, pr_body_colour FROM `product_requisition`where pr_product_id IN (select DISTINCT pr_product_id from product_requisition where (pr_status='Production Requisition Raised' OR pr_status='Partially to Prod') AND date_format(pr_required_date, '%Y-%m-%d')='$pr_required_date')");
					//$result=mysqli_query($connection, "SELECT DISTINCT `pr_product_id`, `pr_product_name`, pr_body_colour FROM `product_requisition`");
					?>
					<table style="width:70%" id="formContent" align="center">
						<tr>
							<td align="right" class="fadeIn fourth" style="width: 300px; height: 50px;"><b>Product Name:</b></td> 
							<td align="center"><select style="width:400px; height: 40px;" name="pr_product_name" id="pr_product_name" class="form-select">
							<?php
								while($data=mysqli_fetch_array($result)){
									echo "<option value='".$data['pr_product_id']."'>".$data['pr_product_name']."(".$data['pr_body_colour'].")</option>";
								}
								
							?>
							</select></td>	
							<td>
							<?php
								echo "<input value='".$pr_required_date."' name='pr_required_date' style='display:none;'";
							?>
							</td>
						</tr>
					</table><br>

					<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="Display"></p>
			<?php } ?>
				
		</form>
			<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Updated!!
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
