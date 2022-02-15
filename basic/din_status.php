<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	// if($_SESSION['user_dept'] != 'production_dept'){
	// 	echo '<script type="text/javascript">alert("Access Denied.")';
	// 	header("Location: ../login.html");
	// }
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- select2 css -->
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

    <!-- select2 script -->
    <script src='select2/dist/js/select2.min.js'></script>
	<script type="text/javascript src="jquery-3.6.0.min.js"></script>

    <!-- CDN -->
    <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> 
     -->
	
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

	<title>DIN Status</title>
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
	<SCRIPT>

	$(document).ready(function(){
		$("#din").select2();
		$('#but_read').click(function(){
		var username = $('#po_material_name option:selected').text();
		var userid = $('#po_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	

	</SCRIPT>
</head>
<body>
	</SCRIPT>
</head>
<body class="bg-light text-dark">
	<?php
		//include "includes/sidebar.php";
	?>
	<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">DIN Status</h1>
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
				<div class="dropdown mt-3" align="center">
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='VerifyNoBoxesForm1.php'">
				  Receive goods
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ViewNoBoxes.php'">
					DIN Reprint
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofGoodsReceived.php'">
					List of Goods Received in past
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToCounting.php'">
					Handover To Counting Department
				  </button>
			</div>
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown"> 
	
	<div class="row" align="center">
		<form method="post">
			<?php
				
						echo '<br><br>';
						echo '<select name="din" id="din" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select DIN</option>';
						$query = "SELECT DISTINCT po_din FROM po_summary where po_din!=''";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$din = $row['po_din'];
							
							echo "<option value=$din>$din</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['submit']))
						{
							
							$din = $_POST['din'];
							
							$query = "select po_status from po_summary where po_din='{$din}'";
							$raw_mat_query = mysqli_query($connection,$query);
						?>
						
						<?php	
							echo '<br><br><br><br>';
							$row = mysqli_fetch_assoc($raw_mat_query);
							
							$status=$row['po_status'];?>
						<div class="form-label" style="font-size:20;" align="center"><?php echo "Status : ".$status;}?></div>
							
										
		</form>
	</div>
	
</div>
</body>
</html>