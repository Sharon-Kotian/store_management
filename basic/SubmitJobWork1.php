<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	function random_strings($length_of_string) {
		return substr(sha1(time()), 0, $length_of_string);
	}
	
	if(isset($_POST['submit'])){
		$igd_mat_name=$_POST['igd_mat_name'];
		$igd_mat_qnty=$_POST['igd_mat_qnty'];
		$rm_counting_quantity=$_POST['rm_counting_quantity'];
		$jw_submit_date=date('Y-m-d');
		$jw_exp_date=$_POST['jw_exp_date'];
		$ew_name=$_POST['ew_name'];
		$igs_name=$_POST['igs_name'];
		$jw_id=$_POST['jw_id'];
		$jw_issuing_person = $_POST['jw_issuing_person'];
		$jw_challan_number = random_strings(8);
		$_SESSION['jw_id'] = $jw_id;

		$jwcharges_query = mysqli_query($connection, "SELECT igs_amt FROM inter_goods_summary WHERE igs_name = '$igs_name'");
		if($jwcharges = mysqli_fetch_array($jwcharges_query)){
			$jw_charges = $jwcharges['igs_amt'];
		}

		$jw_amount = $jw_charges*$rm_counting_quantity;
		$_SESSION['jw_charges'] = $jw_charges;

		$insert_query=mysqli_query($connection, "INSERT into ext_job_work(jw_id, jw_good_name, jw_exp_qnty,jw_submit_date, jw_exp_date, jw_status, jw_worker_id, jw_issuing_person, jw_challan_number, jw_tot_amt)VALUES('$jw_id', '$igs_name', '$rm_counting_quantity', NOW(), '$jw_exp_date', 'JW Submitted', '$ew_name', '$jw_issuing_person', '$jw_challan_number', '$jw_amount')");

		foreach ($igd_mat_name as $index => $values) {
			$insert_query1=mysqli_query($connection, "INSERT INTO job_work_summary(jw_id, rm_name, submitted_quantity) VALUES('$jw_id','$values', '$igd_mat_qnty[$index]')");
		}

		if($insert_query && $insert_query1){
			echo '<script type="text/javascript">alert("Job Work Submitted Successfully.");
			window.location.replace("SubmitJobWork.php");
			window.open("PrintJobWork.php");</script>';
		}else{
			echo "Error" .mysqli_error($connection);
			echo '<script>alert("Job Work submition failed."); window.location.replace("SubmitJobWork.php");</script>';
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

	<title>Submit Job work</title>
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

	<script type="text/javascript">
		/*$(document).ready(function(){
		$("#rm_name").select2();
		$('#but_read').click(function(){
		var username = $('#rm_name option:selected').text();
		var userid = $('#rm_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});*/
	
	$(document).ready(function(){
		$("#supp_state_code").select2();
		$('#but_read').click(function(){
		var username = $('#supp_state_code option:selected').text();
		var userid = $('#supp_state_code').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	$(document).ready(function(){
		$("#ew_name").select2();
		$('#but_read').click(function(){
		var username = $('#ew_name option:selected').text();
		var userid = $('#ew_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	
	
	
	</script>
<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
</head>
<body class="bg-light text-dark">
<header>
	<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Submit Job work</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='Add Material For Intermediate Goods.php'">
				Add Material For Intermediate Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button>
			</div>
		</div>
	</div>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post" action="">
			
			
		<table style="width:60%" id="formContent" align="center">	
			<tr>
				<?php
					$igs_name=$_SESSION['igs_name'];
					$rm_counting_quantity=$_SESSION['rm_counting_quantity'];
					$query = "SELECT count(jw_id) as max_jw FROM ext_job_work";
					$max_jw = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($max_jw)) 
					{
						$jw_id = $row['max_jw'] + 1 ;
					}
				?>
				<td align="center"><input type="hidden" id="jw_id" class="form-control" name="jw_id" value="<?php echo $jw_id; ?>" readonly></td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br> Intermediate Goods Name: </td>
				<td align="center"><br><br><input type="text" id="igs_name" class="form-control" name="igs_name" style="width: 300px; height: 40px;" value="<?php echo $igs_name; ?>" readonly></td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Quantity of expected intermediate goods: </td>
				<td align="center"><br><br><input type="text" id="rm_counting_quantity" class="form-control" name="rm_counting_quantity" style="width: 300px; height: 40px;" value="<?php echo $rm_counting_quantity; ?>" readonly></td>
					<br><br>
			</tr>
		</table><br><br><br>

		<table class="table table-bordered" style="width:60%" align="center" id="tableContent">
			<thead>
				<tr align="center">
					<th width="50%">Raw Materials Name</th>
					<th width="50%">Quantity</th>
					<th width="50%">Add material</th>
					<th width="50%">Delete material</th>
				</tr>
			</thead>

			<tbody id="table">
					
			<?php
				$query=mysqli_query($connection, "SELECT igs_id FROM inter_goods_summary WHERE igs_name='$igs_name'");
				if($row=mysqli_fetch_array($query)){
					$igs_id=$row['igs_id'];
					$select=mysqli_query($connection, "SELECT igd_mat_name, igd_mat_qnty FROM inter_goods_details WHERE igs_id='$igs_id'");
					while($data=mysqli_fetch_array($select)){	//This while is for every row of the table
						$igd_mat_qnty= $data['igd_mat_qnty'] * $rm_counting_quantity;
						$rm_query = mysqli_query($connection, "SELECT * FROM raw_materials");
						echo '<tr align="center" id="row"><td align="center" width="70%"><select name="igd_mat_name[]" id="material" style="width: 100%; text-align: center" class="form-select">';
						while($data_rm = mysqli_fetch_array($rm_query)){	//This while is for the dropdown
							$material = $data_rm['rm_name'];
							if($material == $data['igd_mat_name']){
								echo "<option value='$material' selected>".$material."</option>";
							}
							else{
								echo "<option value='$material'>".$material."</option>";
							}
						}
						?>
						</select></td>
						<td align="center" width="30%"><input type="text" name="igd_mat_qnty[]" id="igd_mat_qnty" value="<?php echo $igd_mat_qnty; ?>" class="form-control" style="width: 100%; text-align: center"></td>
						<td><input type='button' class="btn btn-outline-primary" onclick="addField(this);" id='button_add' value="Add"></td>
						<td><input type='button' class="btn btn-outline-danger" onclick="deleteField(this);" value="Delete" id="button_delete"></td>
						</tr>
			</tbody>
						<?php
					}
				}
				else{
					echo '<script>alert("No Raw Materials Available for this Intermediate Good");
					window.loaction.replace("SubmitJobWork.php")</script>';
				}
			?>
		</table>
		
		<table style="width:60%" id="formContent" align="center">	
			<tr>
				<td align="center" class="form-label" width="50%"><br><br>Submitted Date: </td>
				<td align="center" width="50%"><br><br><input type="text" id="jw_submit_date" class="form-control" name="jw_submit_date" style="width: 300px; height: 40px;" readonly>
				<script>
					var today = new Date();
					var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
					document.getElementById("jw_submit_date").value = date;
				</script>
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label" width="50%"><br><br>Expected Date: </td>
				<td align="center" width="50%"><br><br><input type="date" id="jw_exp_date" class="form-control" name="jw_exp_date" style="width: 300px; height: 40px;" min="<?php echo date('Y-m-d', strtotime("+0days")); ?>"></td></td>
			</tr>
			<tr>
				<td align="center" class="form-label" width="50%"><br><br> Job Worker's Name: </td>
				<td align="center" width="50%"><br><br>
					<select name="ew_name" id="ew_name" style="width: 300px; height: 50px;">
						<option value="">Select job worker</option>
						<?php 
							$records=mysqli_query($connection,"SELECT ew_id, ew_name from ext_worker where not ew_status = 'Deleted'");
							while($data=mysqli_fetch_array($records)){
								echo "<option value='".$data['ew_id']."'>".$data['ew_name']."</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label" width="50%"><br><br>Name of Person issuing: </td>
				<td align="center" width="50%"><br><br><input type="text" id="jw_issuing_person" class="form-control" name="jw_issuing_person" style="width: 300px; height: 40px;"></td>
			</tr>
			
		</table>
			<br><br><br>
			<p align="center"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value="Submit and Print" data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
		</form>
			
			
			<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Succesfully Created JOB ID</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Job ID: </td>
							<td align="left"><input type="text" id="jw_id" class="form-control" name="jw_id" value="2021" readonly></td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Print Job Work</button>
				  </div>
				</div>
			  </div>
			</div>
			  <br><br>
		
	</div>
</body>
</html>

<?php mysqli_close($connection); ?>