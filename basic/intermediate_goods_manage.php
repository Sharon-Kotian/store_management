<?php 
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	/*if(isset($_POST['print_data']))
	{
		echo "<br>";
		$ew_id= $_POST['ew_id'];    
		$ew_name = $_POST['ew_name'];
		$ew_ph_no = $_POST['ew_ph_no'];
		$ew_address = $_POST['ew_address'];
		$ew_emer_cont_name = $_POST['ew_emer_cont_name'];
		$ew_emer_cont_no = $_POST['ew_emer_cont_no'];
        
		
		$update_query=mysqli_query($connection, "UPDATE ext_worker SET ew_id='$ew_id', ew_name='$ew_name', ew_ph_no='$ew_ph_no', ew_address='$ew_address' ,
		ew_emer_cont_name='$ew_emer_cont_name' , ew_emer_cont_no='$ew_emer_cont_no', ew_status='' WHERE ew_id='$ew_id'");
        if($update_query){
            echo '<script>alert("Manage Job Worker Updated Successfully");
            window.location.replace("job_workers.php")</script>';
        }
        else{
            echo "Error.".mysqli_error($connection);
            echo '<script>window.location.replace("job_workers.php")</script>';
        }
		
    }*/
	
	if(isset($_POST['submit'])){

		//$igs_name=$_POST['igs_name'];
		$rm_name=$_POST['rm_name'];
		$igd_mat_qnty=$_POST['igd_mat_qnty'];
		$name1=$_POST['name1'];
		$charges=$_POST['charges'];
		
		$q=mysqli_query($connection,"SELECT igs_id from inter_goods_summary where igs_name='$name1'");
		$row = mysqli_fetch_assoc($q);
		$id=$row['igs_id'];
		
		
		$update_query= mysqli_query($connection, "UPDATE inter_goods_summary SET igs_amt='$charges' WHERE igs_name='$name1'");

		foreach ($rm_name as $index => $names) {
			if($names!='')
			{
			$select=mysqli_query($connection, "SELECT rm_name from raw_materials WHERE rm_name='$names'");
			if(mysqli_num_rows($select)){
				
				$query="INSERT INTO inter_goods_details(igd_mat_name, igd_mat_qnty, igs_id) VALUES ('$names','$igd_mat_qnty[$index]','$id')";
				$insert_query=mysqli_query($connection, $query);
				if($insert_query){
					echo '<script type="text/javascript">alert("Material for Intermediate Good Added");
					window.location.replace("Manage intermediate goods.php?source=Manage")</script>';
				}
				else{
					echo "Error" .mysqli_error($connection);
					echo '<script>window.location.replace("Manage intermediate goods.php?source=Manage")</script>';
				}
			}else{
				echo '<script>alert("Raw Material does not exists");
				window.location.replace("Manage intermediate goods.php?source=Manage")</script>';
			}
			}
		}
		echo '<script>alert("Data is Updated");
				window.location.replace("Manage intermediate goods.php?source=Manage")</script>';
		
		
	};
				
?>

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

	<title>Manage Intermediate Goods</title>
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
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	
	<script type="text/javascript">
		

	</script>

</head>
<body class="bg-light text-dark">
<header>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Manage Intermediate Goods</h1>
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
				
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button>
			</div>
		  </div>
</div>

	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post">
		<table style="width:80%" id="formContent" align="center">
			<?php 
			 	$id=$_GET['name'];?>
				
				
				<form>
														
					<table style="width:60%" align="center">
					<tr>
					<td align="left" class="form-label" style="width:550px"><br><br>Semi Finished Product Name:</td>
					<?php
					$name1=$_GET['name'];
					
					echo "<td><br><br><input class='form-control' type=text id='name1' name='name1' style='width:250px' value='$name1'readonly></td></tr>";
					$q=mysqli_query($connection,"SELECT igs_amt from inter_goods_summary where igs_name='$name1'");
					$row = mysqli_fetch_assoc($q);
					$amt=$row['igs_amt'];
		
		
		
					echo '<tr>';
					echo '<td align="left" class="form-label"><br><br>Job Work Charges per unit:</td>'; 
					echo "<td><br><br><input class='form-control' type='number' min=0 step=0.01 class='form-control' id='charges' name='charges' value='$amt' style='width:250px'></td></tr></table><br><br><br><br>";?>
							
								
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
	<script>
	$(document).ready(function(){
	  $("#myBtn").click(function(){
	    $('.toast').toast('show');
	  });
	});
</script>
</body>
</html>

