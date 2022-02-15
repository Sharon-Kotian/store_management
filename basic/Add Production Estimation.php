<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
?>

<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

	<title>Add Production Estimation</title>
	
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
	
	<script>
	$(document).ready(function(){
		$("#fpd_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#fpd_material_name option:selected').text();
		var userid = $('#fpd_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
		
	});
	$(document).ready(function(){
		$("#color").select2();
		$('#but_read').click(function(){
		var username = $('#color option:selected').text();
		var userid = $('#color').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
		
	});

	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no "> 
</head>
<body class="bg-light text-dark">

<header>
	<?php 
    //include "includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Add Production Estimation</h1>
</header>

	<a class="btn btn-outline-secondary btn-lg" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
	  Menu &gt;&gt;
	</a>

	<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
	  <div class="offcanvas-header"><br>
		<h5 class="offcanvas-title" id="offcanvasExampleLabel" align="center">Menu</h5>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	  </div>
		  <div class="offcanvas-body">			
			<div class="dropdown mt-3" align="center">
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial.php'">
				Accept Raw Material
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
	<div id="formContent"><br><br>
		<form name="form" action="" method="post">
		<table style="width:80%" id="formContent" align="center">	
			<tbody><tr align="center">									
				<td align="center" class="form-label"><br><br>Finished Product Name: </td>
				<td align="center"><br><br><select name="fpd_material_name" id="fpd_material_name" style="width: 300px; height: 45px;" class="form-select select2-hidden-accessible" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true">
				<?php 
					$records=mysqli_query($connection,"SELECT fps_name from finished_product_summary ");
					while($data=mysqli_fetch_array($records)){
						echo "<option value='".$data['fps_name']."'>".$data['fps_name']."</option>";
					}
				?>
			</select>
				</td>
			</tr>
			<tr align="center">					
				<td align="center" class="form-label"><br><br>Select Color of Product Body: </td>
				<td align="center"><br><br><select name="color" id="color" style="width: 300px; height: 45px;" data-select2-id="select2-data-color" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="NA">NA</option>
					<option value="Black">Black</option>
					<option value="Blue">Blue</option>
					<option value="Orange">Orange</option>
					<option value="Red">Red</option>
					<option value="White">White</option>
					<option value="Yellow">Yellow</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Enter Quantity: </td>
				<td align="center"><br><br><input type="text" id="fpd_material_quantity" class="form-control" value="" name="fpd_material_quantity" style="width: 300px; height: 40px;"></td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Require Date: </td>
				<td align="center"><br><br><input type="date" id="mydate" class="form-control" name="prod_require_date" style="width: 300px; height: 40px;" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d", strtotime("+7days")); ?>"></td>
			</tr>
		</tbody></table><br><br>

		<p align="center"><input type="submit" name ="submit" id="myBtn" class="btn btn-primary btn-lg" value="  Submit  "></p>
		<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Submitted!!
			  </div>
			  <button id="mybtn" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
		</form>
            
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

<?php
	if(isset($_POST["submit"]))
	{
		$fpd_material_name=$_POST["fpd_material_name"];
		$fpd_material_quantity=$_POST["fpd_material_quantity"];
		$prod_require_date=$_POST["prod_require_date"];
		$color=$_POST['color'];

		$insert_query=mysqli_query($connection, "INSERT INTO production(prod_name, prod_quantity, prod_require_date, prod_intim_submit_date, prod_status, prod_color) VALUES('$fpd_material_name', '$fpd_material_quantity', '$prod_require_date', NOW(), 'Production Estimated', '$color')");
		if($insert_query){
			echo '<script>alert("Production Estimation Added Successfully!!")</script>';
	  	} else {
			echo "Error: " . $connection->error;
		}		
	};
	mysqli_close($connection);
?>					

</body>
</html>
