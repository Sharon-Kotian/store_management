<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'rework_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
	
	if(isset($_POST["Submit"]))
	{
			$faulty_material_name=$_POST["faulty_material_name"];
			$faulty_rework_quantity=$_POST["faulty_rework_quantity"];
			$faulty_scrape_quantity=$_POST["faulty_scrape_quantity"];
			$faulty_return_quantity=$_POST["faulty_return_quantity"];
			foreach($faulty_material_name as $index => $values){
				$sql= mysqli_query($connection, "Update faulty_goods set faulty_rework_quantity='$faulty_rework_quantity[$index]', faulty_scrape_quantity='$faulty_scrape_quantity[$index]', faulty_return_quantity='$faulty_return_quantity[$index]', faulty_status='Rework Updated' where faulty_material_name='$values' and faulty_status='Submitted to rework'");
			}
			if ($sql) {
				echo '<script>alert("Record Updated Successfully!!");
				window.loaction.replace("UpdateReworkStatus.php")</script>';
			} else {
			  echo "Error: " . $sql . "<br>" . $connection->error;
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

	<title>Update Rework Status</title>
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
		function findTotalrework(){
		var arr = document.getElementsByClassName('form-control faulty_rework_quantity');
		var tot=0;
		for(var i=0;i<arr.length;i++){
		  if(parseFloat(arr[i].value))
			tot += parseFloat(arr[i].value);
		}
		document.getElementById('faulty_rework_quantity1').value = tot;
		}
		
		function findTotalscrap(){
		var arr = document.getElementsByClassName('form-control faulty_scrape_quantity');
		var tot=0;
		for(var i=0;i<arr.length;i++){
		  if(parseFloat(arr[i].value))
			tot += parseFloat(arr[i].value);
		}
		document.getElementById('faulty_scrape_quantity1').value = tot;
		}
		
		function findTotalreturn(){
		var arr = document.getElementsByClassName('form-control faulty_return_quantity');
		var tot=0;
		for(var i=0;i<arr.length;i++){
		  if(parseFloat(arr[i].value))
			tot += parseFloat(arr[i].value);
		}
		document.getElementById('faulty_return_quantity1').value = tot;
		}
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
	<h1 class="display-3" align="center">Update Rework Status</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ReworkEstimation.php'">
					Rework Estimation
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateReworkStatus.php'">
					Update Rework Status
				  </button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="form" action="" method="post">
			<table border="1px" align="center" class="table table-bordered" style="width:90%"><br><br>
					<tr>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;" name="rm_name" id="rm_name" align="center"><b>Raw Material Name</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Repaired Quantity</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Scraped Quantity</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Returned Quantity</b></td>
					</tr>
					<?php
                            $sql1 = "SELECT faulty_material_name, faulty_rework_quantity,faulty_scrape_quantity,faulty_return_quantity FROM faulty_goods where faulty_status='Submitted to rework'";
                            $result = $connection->query($sql1);
		

                            if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {?>
								<tr>
                         
								<td><input type="text" id="rm_name" name="faulty_material_name[]" value="<?php echo $row["faulty_material_name"]; ?>" style="text-align: center" class="form-control faulty_material_name" readonly></td>
								<td><input type="text" id="faulty_rework_quantity" value="<?php echo $row["faulty_rework_quantity"];?>" name="faulty_rework_quantity[]" style="text-align: center" onblur="findTotalrework()" class="form-control faulty_rework_quantity"></td>
								<td><input type="text" id="faulty_scrape_quantity" value="<?php echo $row["faulty_scrape_quantity"];?>" name="faulty_scrape_quantity[]" style="text-align: center" onblur="findTotalscrap()" class="form-control faulty_scrape_quantity"> </td>
								<td> <input type="text" id="faulty_return_quantity" value="<?php echo $row["faulty_return_quantity"];?>" name="faulty_return_quantity[]" style="text-align: center" onblur="findTotalreturn()" class="form-control faulty_return_quantity"> </td>				
								</tr>
								<?php
							}

                            } else {
								echo '<script>alert("No Materials Available")</script>';
                            }
                        ?>

		</table>
		<br><br>
		<table style="width:50%" align="center">
			<tr>
				<td align="center" style="width: 250px; height: 20px;"> Total Quantity For Repair:  </td>
				<td align="center"><input type="text" id="faulty_rework_quantity1" class="form-control" name="faulty_rework_quantity1" style="width: 190px; height: 45px;" readonly></td>
			</tr>
			<tr>
				<td align="center" style="width: 250px; height: 20px;"><br><br> Total Quantity To Scrap:  </td>
				<td align="center"><br><br><input type="text" id="faulty_scrape_quantity1" class="form-control" name="faulty_scrape_quantity1" style="width: 190px; height: 45px;" readonly></td>
			</tr>
			<tr>
				<td align="center" style="width: 250px; height: 20px;"><br><br> Total Quantity To Return:  </td>
				<td align="center"><br><br><input type="text" id="faulty_return_quantity1" class="form-control" name="faulty_return_quantity1" style="width: 190px; height: 45px;" readonly></td>
			</tr>
		</table><br><br>
		<p align="center"><input type="Submit" name="Submit" class="btn btn-primary btn-lg" value="Submit" id="myBtn">
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
<?php
	mysqli_close($connection);
?>
