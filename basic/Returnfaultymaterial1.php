<?php
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST["submit"]))
	{
		$faulty_production_id=$_POST['faulty_production_id'];
		$faulty_reference_id=$_POST["faulty_reference_id"];
		$faulty_material_name=$_POST["faulty_material_name"];
	    $quantity=$_POST["quantity"];
	    $faulty_action=$_POST["faulty_action"];
	    $select=mysqli_query($connection, "SELECT prod_id FROM production WHERE prod_name='$faulty_production_id'");
	    while($row=mysqli_fetch_array($select)){
	    	$prod_id=$row['prod_id'];
			if($faulty_action=="Rework")
		    {
		        $sql = "INSERT INTO faulty_goods (faulty_material_name, faulty_production_id, faulty_reference_id, faulty_action, faulty_rework_quantity, faulty_status) VALUES ('$faulty_material_name', '$prod_id', '$faulty_reference_id', '$faulty_action', '$quantity', 'Returned To Stores')";
		    }
		    else if($faulty_action=="Replace")
		    { 	
		        $sql = "INSERT INTO faulty_goods (faulty_material_name, faulty_production_id, faulty_reference_id, faulty_action, faulty_return_quantity, faulty_status) VALUES ('$faulty_material_name', '$prod_id', '$faulty_reference_id', '$faulty_action', '$quantity', 'Returned To Stores')";
		    }
		    else
		    { 
		        $sql = "INSERT INTO faulty_goods (faulty_material_name, faulty_production_id, faulty_reference_id, faulty_action, faulty_scrape_quantity, faulty_status) VALUES ('$faulty_material_name', '$prod_id', '$faulty_reference_id', '$faulty_action', '$quantity', 'Returned To Stores')";
		    }
		}
		if ($connection->query($sql) === TRUE) {
		    echo '<script>alert("New Record Inserted Successfully!!");
		    window.location.replace("Returnfaultymaterial.php")</script>';
		} else {
			echo "Error: " . $sql . "<br>" . $connection->error;
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

	<title>Return faulty material</title>
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
		$(document).ready(function(){
			$("#faulty_material_name").select2();
			$('#but_read').click(function(){
				var username = $('#faulty_material_name option:selected').text();
				var userid = $('#faulty_material_name').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});
	
		$(document).ready(function(){
			$("#faulty_action").select2();
			$('#but_read').click(function(){
				var username = $('#faulty_action option:selected').text();
				var userid = $('#faulty_action').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});
	</script>
<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
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
	<h1 class="display-3" align="center">Return faulty material</h1>
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
				<div class="dropdown mt-3">
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial.php'">
					Accept Raw Material
					</button><br><br>
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
</div>
	
	<div class="wrapper fadeInDown">
	<div id="formContent">
		<form method="post" action="">
		<table style="width:100%" id="formContent">
			<?php $faulty_production_id=$_SESSION['faulty_production_id']; ?>
			<tr>
				<td align="center" class="form-label">Production Name: </td>
				<td align="center"><input type="text" id="faulty_production_id" class="form-control" name="faulty_production_id" value="<?php echo $faulty_production_id; ?>" style="width: 300px; height: 40px;" readonly></td>
				<br><br>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Reference ID: </td>
				<td align="center"><br><br><input type="text" id="faulty_reference_id" class="form-control" name="faulty_reference_id" style="width: 300px; height: 40px;"></td>
				<br><br>
			</tr>		
			<tr>
				<td align="center" class="form-label"><br><br> Faulty Material: </td>
				<td align="center"><br><br><select name="faulty_material_name" id="faulty_material_name" style="width: 300px; height: 50px;">
                 	<?php
                 		$query=mysqli_query($connection, "SELECT fps_id FROM finished_product_summary WHERE fps_name='$faulty_production_id'");
                 		while($row=mysqli_fetch_array($query)){
                 			$fps_id=$row['fps_id'];
                 			$select=mysqli_query($connection, "SELECT fpd_material_name FROM finished_product_details WHERE fps_id='$fps_id'");
                 			while($data=mysqli_fetch_array($select)){
                 				 echo "<option value='".$data["fpd_material_name"]."'>".$data["fpd_material_name"]."</option>";
                 			}
                 		}  
                    ?>
				</select> 
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Quantity : </td>
				<td align="center"><br><br><input type="number" id="quantity" class="form-control" name="quantity" style="width: 300px; height: 40px;"></td>
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br> Action to be taken: </td>
				<td align="center"><br><br><select name="faulty_action" id="faulty_action" style="width: 300px; height: 50px;">
					<option value="Rework">Rework</option>
					<option value="Replace">Replace</option>
					<option value="Scrap">Scrap</option>
				</select> 
				</td>
			</tr>
			
		</table>
			<br>
			<p align="center"> <input type="button" class="btn btn-primary btn-lg temp" value=" Submit " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
			
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Do you return this product?</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Product Name: </td>
							<td align="left"><input type="text" id="Production" class="form-control" name="Production" value="" readonly></td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" name="submit"class="btn btn-primary">Confirm</button>
				  </div>
				</div>
			  </div>
			</div>
			  <br><br>
		</form>
	</div>
</div>

<script>
    $(document).ready(function(){
        $(".temp").click(function(){
            var temp=$("#faulty_material_name").val();
            $("#Production").val(temp);
        });
    });
</script>	
</body>
</html>

