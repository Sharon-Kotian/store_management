<?php
	include_once("includes/db.php");
	global $connections;

	if(isset($_POST["Handedover_To_Stores"]))
	{
		$rm_name=$_POST["rm_name"];
		$caret_quantity=$_POST["caret_quantity"];
		//$rm_stores_quantity=$_POST["rm_stores_quantity"];
		$po_din=$_POST["po_din"];
		$sql = mysqli_query($connection, "SELECT rm_counting_quantity,rm_stores_quantity  FROM raw_materials WHERE rm_name='$rm_name'");
		$row= mysqli_fetch_array($sql);
		
		if(mysqli_num_rows($sql) > 0){
			$rm_counting_quantity = $row['rm_counting_quantity'] - $caret_quantity;
			$rm_stores_quantity = $row['rm_stores_quantity'] + $caret_quantity;
			
			$sql = mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity='$rm_counting_quantity', rm_stores_quantity='$rm_stores_quantity' WHERE rm_name='$rm_name'");
		
			$update_query=mysqli_query($connection, "UPDATE po_summary SET po_status='Handed over to Stores' WHERE po_din='$po_din'");
		
			if ($sql && $update_query) {
			echo '<script>alert("Material handed over to Stores Successfully!!");
			window.location.replace("HandoverToStores.php")</script>';

			} else {
		  	echo "Error: " . $sql . "<br>" . $connection->error;
		  	echo '<script>window.location.replace("HandoverToStores.php")</script>';
			}
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

	<title>Handover To Stores</title>
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
	
	$(document).ready(function(){
		$("#po_din").select2();
		$('#but_read').click(function(){
		var username = $('#po_din option:selected').text();
		var userid = $('#po_din').val();
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
	<h1 class="display-3" align="center">Handover To Stores</h1>
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
				  <button class="btn btn-primary btn-lg">
					Place Purchase Order
				  </button><br><br>
				  <button class="btn btn-primary btn-lg">
					Set New Order Level
				  </button><br><br>
				  <button class="btn btn-primary btn-lg">
					Add New Raw Material
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="frm" action="" method="post">
		<table style="width:70%" id="formContent"align="center">
			<tbody><tr align="center">					
				<td align="center" class="form-label"><br><br>Select Material: </td>
				<td align="center"><br><br><select name="rm_name" id="rm_name" style="width: 250px; height: 40px;" data-select2-id="select2-data-rm_name" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<?php 
						$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
						}
					?>
				</select>
				</td>
			</tr>
			<tr align="center">
				<td align="center" class="form-label"><br><br>Number of bundles prepared: </td>
					<td align="center"><br><br><input type="text" id="caret_quantity" class="form-control" name="caret_quantity" style="width: 250px; height: 40px;"></td>
			</tr>
			<tr align="center">						
				<td align="center" class="form-label"><br><br>DIN Number: </td>
				<td align="center"><br><br><select name="po_din" id="po_din" style="width: 250px; height: 40px;" data-select2-id="select2-data-qc_invoice_no"  >
					<?php 
						$records=mysqli_query($connection,"SELECT po_din from po_summary");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['po_din']."'>".$data['po_din']."</option>";
						}
					?>
				</select>
				</td>
			</tr>
		</tbody></table><br><br>
		<p align="center"><input type="submit" name="Handedover_To_Stores" class="btn btn-primary btn-lg" value="Handover to Stores" id="myBtn"></p>	
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
