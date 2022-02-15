<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'outward_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['accept'])){
		$prod_id=$_POST['prod_id'];
		if($prod_id==''){
			echo '<script>alert("No Goods Available to Accept.");
			window.location.replace("accept_receipt_of_goods.php")</script>';
		}else{
			$insert_query=mysqli_query($connection, "UPDATE production SET prod_status='Outward' WHERE prod_require_date=DATE(NOW()) AND prod_status='Prod Complete'");
		}
		if($insert_query){
			echo '<script type="text/javascript">alert("Accepted Receipt of Goods Successfully.");
			window.location.replace("accept_receipt_of_goods.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
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

	<title>Accept Receipt Of Goods</title>
	
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
	<script>
		
	</script>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Accept Receipt Of Goods</h1>
</header>

	

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
		<br><br>
		<form method="post" action="">
			<table style="width:80%" align="center" class="table table-bordered" readonly>
					<tbody>
					<tr>
						<td hidden="true"></td>
					    <td class="fadeIn fourth" align="center" style=" width: 50%; height: 50px;"><b>Products Produced</b></td>
						<td class="fadeIn fourth" align="center" style="width: 50%; height: 50px;"><b> Quantity submitted by production department</b></td>
					</tr>
					<?php
					$query=mysqli_query($connection, "SELECT prod_id, prod_name, prod_quantity from production where prod_require_date=DATE(NOW()) AND prod_status='Prod Complete'");
					while($row=mysqli_fetch_array($query)){?>
					<tr style="font-size:20px">
						<td hidden="true"><input type="hidden" name="prod_id" value="<?php echo $row['prod_id']; ?>"></td>
						<td align="center"><?php echo $row['prod_name']; ?></td>
						<td align="center"><?php echo $row['prod_quantity']; ?></td>
					</tr>
					<?php
					}
					mysqli_close($connection);
					?>
							
					</tbody>
			</table>	
		<br><br>
		<p align="center"><input type="submit" name="accept" class="btn btn-primary btn-lg" value=" Accept " id="myBtn"></p>	
		</form>	
		<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;"class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Accepted !!
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

</body></html>