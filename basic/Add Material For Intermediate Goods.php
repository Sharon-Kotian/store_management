<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){

		$igs_name=$_POST['igs_name'];
		$rm_name=$_POST['rm_name'];
		$igd_mat_qnty=$_POST['igd_mat_qnty'];

		foreach ($rm_name as $index => $names) {
			$select=mysqli_query($connection, "SELECT rm_name from raw_materials WHERE rm_name='$names'");
			if(mysqli_num_rows($select)){
				$query="INSERT INTO inter_goods_details(igd_mat_name, igd_mat_qnty, igs_id) VALUES ('$names','$igd_mat_qnty[$index]','$igs_name')";
				$insert_query=mysqli_query($connection, $query);
				if($insert_query){
					echo '<script type="text/javascript">alert("Material for Intermediate Good Added");
					window.location.replace("Add Material For Intermediate Goods.php")</script>';
				}
				else{
					echo "Error" .mysqli_error($connection);
					echo '<script>window.location.replace("Add Material For Intermediate Goods.php")</script>';
				}
			}else{
				echo '<script>alert("Raw Material does not exists");
				window.location.replace("Add Material For Intermediate Goods.php")</script>';
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

	<title>Add Material For Intermediate Goods</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<script src="JS/addRowFunction.js"></script>
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

	 <SCRIPT type="text/javascript">
	$(document).ready(function(){
		$("#igs_name").select2();
		$('#but_read').click(function(){
		var username = $('#igs_name option:selected').text();
		var userid = $('#igs_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	</SCRIPT>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 		
	
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
	<h1 class="display-3" align="center">Add Material For Intermediate Goods</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>

				<hr>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Jobwork Out(Issue Material)
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Jobwork In(Accept Material) 
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_work_receivable.php'">
					Jobwork Receivable
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Data
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Manage intermediate goods.php'">
				Manage Intermediate Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent"><br><br>
	<form name="formname" method="post" action="">
		<table style="width:40%" id="productContent" align="center">	
			<tr align="center">		
				<td align="center" style="width: 200px; height: 20px;" class="form-label"> Product Name :  </td>
				<td align="center"><select name="igs_name" id="igs_name" style="width: 200px; height: 50px;">
							<?php 
								$records=mysqli_query($connection,"SELECT igs_id, igs_name from inter_goods_summary");
								while($data=mysqli_fetch_array($records)){
									echo "<option value='".$data['igs_id']."'>".$data['igs_name']."</option>";
								}
							?>
							</select> 
				</td>
			</tr>
		</table><br>
		<hr size="5" width="100%"> 
		<br>
		<table style="width:90%" id="tableContent" align="center">
			<tbody id="table">
				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Raw Material Required : </td>
							<td align="left">
								<datalist name="rm_name[]" id="rm_name" style="width: 220px; height: 40px;">
								<?php 
									$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
									while($data=mysqli_fetch_array($records)){
										echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
									}
								?>
								</datalist> 
								<input  autoComplete="on" list="rm_name" name="rm_name[]" />
							</td>
					
					<td align="center" style="width: 200px; height: 20px;" class="form-label" id="label_quantity"> Quantity :  </td>
					<td align="left"><input type="number" id="igd_mat_qnty" class="form-control" name="igd_mat_qnty[]" style="width: 200px; height: 40px;"></td>
					
					<td><input type="button" class="btn btn-outline-primary" value="Add Row" id="button_add"  onclick="addField(this);" style="width: 110px; height: 40px;"/></td>
					<td><input type="button" class="btn btn-outline-warning" value="Delete Row" id="button_delete" onclick="deleteField(this);"/></td>

				</tr>
			</tbody>
		</table><br><br><br>
		
		<p align="center"><input type="submit" class="btn btn-primary btn-lg" value=" Submit " name="submit" ></p>		
		</form>

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
