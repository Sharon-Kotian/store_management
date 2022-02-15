<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$caret_id=$_POST['caret_id'];
		$caret_material_name=$_POST['caret_material_name'];
		$caret_quantity=$_POST['caret_quantity'];

		$caret_id=mysqli_real_escape_string($connection,$caret_id);
		$caret_material_name=mysqli_real_escape_string($connection,$caret_material_name);
		$caret_quantity=mysqli_real_escape_string($connection,$caret_quantity);

		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_material_name='$caret_material_name' WHERE caret_id='$caret_id'");
		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_quantity='$caret_quantity' WHERE caret_id='$caret_id'");
		
		if($insert_query){
			echo '<script type="text/javascript">alert("Caret Updated Successfully.");
			window.location.replace("AlignItemsInCarets.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
		}
		mysqli_close($connection);
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

	<title>Allocate Caret Id</title>
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
		$("#caret_id").select2();
		$('#but_read').click(function(){
		var username = $('#caret_id option:selected').text();
		var userid = $('#caret_id').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function(){
		$("#caret_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#caret_material_name option:selected').text();
		var userid = $('#caret_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	</SCRIPT>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 			
</head>
<body class="bg-light text-dark">
<header>
	<?php 
   // include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Allocate Caret Id</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewRequisition.php'">
				View Pending Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewHistoricalRequisition.php'">
				Historical Requisition
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Job Work
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='Add Material For Intermediate Goods.php'">
				Add Material For Intermediate Goods
				</button>
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="All Carets" ONCLICK="parent.location='AllocateCaretId_All.php'" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw Material Wise " ONCLICK="parent.location='AllocateCaretId_RawMaterialWise.php'" style="width: 300px; height: 45px;"></p>
	
	</div>
	
<div id="formContent">
	<br><br><br>
	<table border="1px" align="center" class="table table-bordered" style='width:70%'>
		<tr style="font-size:28px">
		  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Caret ID</b></td>
		  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Caret Material</b></td>
		</tr>
		<?php
				$query = "SELECT * from store_caret";
				$final_record=mysqli_query($connection, $query);
				while($row=mysqli_fetch_array($final_record)){?>
					<tr style="font-size:22px">
						<td align="center"><?php echo $row['caret_id']; ?></td>
						<td align="center"><?php echo $row['caret_material_name']; ?></td>
					</tr>
					<?php
				}
			
			mysqli_close($connection);
		?>
	</table> 
  </div>
</div>
</body>
</html>
