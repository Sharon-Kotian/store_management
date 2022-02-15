<?php
	include_once("includes/db.php");
	global $connection;
	$page ='countingstatus.php';
	$sec = "30";
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

	<title>Expected production output</title>
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
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
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
	<h1 class="display-3" align="center">Expected production output</h1>
</header>

<div class="wrapper fadeInDown">
  <div id="formContent">
	  <br><br>
	<form name="frm" action="Expected production output.php" method="post">
		<table border="1px" align="center" class="table table-bordered" style="width:80%">
			<tr style="font-size:28px">
			  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_name" name="prod_name"><b>Product Name</b></td>
			  <td align="center" class="fadeIn fourth" style="width: 400px; height: 50px;" id="prod_quantity" name="prod_quantity"><b>Expected Counting</b></td>
			</tr>
			<?php
					$query=mysqli_query($connection, "SELECT prod_name, prod_quantity from production where prod_require_date=DATE(NOW())");
					while($row=mysqli_fetch_array($query)){?>
					<tr style="font-size:20px">
						<td align="center"><?php echo $row['prod_name']; ?></td>
						<td align="center"><?php echo $row['prod_quantity']; ?></td>
					</tr>
					<?php
					}
					?>
		</table>
	  <br><br>
	  <table style="width:80%" id="formContent" align="center">	
			<tr align="center">	
			<?php 
					$rs=mysqli_query($connection, "SELECT prod_num_people_present, prod_idle_time_expected from production WHERE prod_require_date=DATE(NOW())");
					$row=mysqli_fetch_array($rs);
					if($row){
					?>		
			<td align="right" class="form-label"><br><br>Employee's Present: </td>
				<td align="center"><br><br><input type="number" id="prod_num_people_present" class="form-control" name="prod_num_people_present" style="width: 400px; height: 40px;" value="<?php echo $row['prod_num_people_present'];?>" readonly></td>
			</tr>
			
			<tr align="center">	
			<td align="right" class="form-label"><br><br>Idle Time Expected: </td>
				<td align="center"><br><br><input type="number" id="prod_idle_time_expected" class="form-control" name="prod_idle_time_expected" style="width: 400px; height: 40px;" value="<?php echo $row['prod_idle_time_expected'];?>" readonly></td>
				<?php 
				} 
				mysqli_close($connection);
				?>
			</tr>
		</table>
    </form>
  </div>
</div>
<br><br>
</body>
</html>
