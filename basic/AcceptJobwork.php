<?php 
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['print']) && isset($_FILES['invoice_image'])){
		$po_invoice_received=$_POST['po_invoice_received'];
		$jw_id=$_POST['jw_id'];
		$jw_act_qnty = $_POST['jw_act_qnty'];
		$jw_actual_date = date('Y-m-d', strtotime($_POST['jw_actual_date']));
		$jw_comment = $_POST['jw_comment'];
		$_SESSION['jw_id']=$_POST['jw_id'];
		$jw_tot_amt=$_POST['jw_tot_amt'];
		$_SESSION['jw_tot_amt']=$_POST['jw_tot_amt'];
		$_SESSION['jw_challan']=$_POST['jw_challan'];

		$quantity_query = mysqli_query($connection, "SELECT jw_act_qnty FROM ext_job_work WHERE jw_id='$jw_id'");
		if($quantity_row=mysqli_fetch_array($quantity_query)){
			$jw_act_qnty = $jw_act_qnty + $quantity_row['jw_act_qnty'];
		}

		$name=$_FILES['invoice_image']['name'];
		$target_dir="uploads/";
		$target_file=$target_dir.basename($_FILES["invoice_image"]["name"]);
		$imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$extension_arr=array("jpg", "jpeg", "png", "gif", "pdf");
		if(in_array($imageFileType, $extension_arr)){
			$image_base64=base64_encode(file_get_contents($_FILES["invoice_image"]["tmp_name"]));
			$image='data:image/'.$imageFileType.';base64,'.$image_base64;
		}

		$invoice_image=@getimagesize($_FILES["invoice_image"]["tmp_name"]);
		$query=mysqli_query($connection, "UPDATE ext_job_work SET jw_invoice_received='$po_invoice_received', jw_act_qnty='$jw_act_qnty', jw_comment='$jw_comment', jw_actual_date='$jw_actual_date', jw_status='JW Received', jw_invoice_image='".$name."' WHERE jw_id='$jw_id'");
		if($query){
			move_uploaded_file($_FILES['invoice_image']['tmp_name'],$target_dir.$name);
			echo '<script>window.open("PrintChallan.php")</script>';
		}
		else{
			echo "Error.".mysqli_error($connection);
		}		
	}elseif(isset($_POST['print']) && !isset($_FILES['invoice_image'])){
		echo '<script>window.open("PrintChallan.php")</script>';
	}
	elseif(isset($_POST['select'])){
		$jw_challan = $_POST['select'];
		$_SESSION['searchoption'] = "JWChallanNumber_select";
		$_SESSION['JWChallanNumber'] = $jw_challan;

		echo '<script>window.location.replace("AcceptJobWork.php")</script>';
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

	<title>Job work in</title>
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
		$(function() {
		    $('input[name="po_invoice_received"]').on('click', function() {
		        if ($(this).val() == '1') {
		            $('#textboxes').show();
		        }
		        else {
		            $('#textboxes').hide();
		        }
		    });
		});
	</script>
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
	<h1 class="display-3" align="center">Job work in</h1>
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
		<?php
			$searchoption = $_SESSION['searchoption'];
			$ew_id = $_SESSION['ew_id'];

			if($searchoption == "JWChallanNumber_select"){
				//display iia
				?>
				<form name="frm" method="post" action="" enctype="multipart/form-data">
					<table style="width:70%;" id="formContent" align="center">
						<tr align="center">
							<?php 
								$jw_actual_date=$_SESSION['jw_actual_date'];
								$JWChallanNumber=$_SESSION['JWChallanNumber'];
						
							?>
							<td align="center" class="form-label" style="width:50%;"><br><br>Date</td>
							<td align="center"><br><br><input type="text" id="jw_actual_date" class="form-control" name="jw_actual_date" style="width: 250px; height: 40px;" readonly value="<?php echo $jw_actual_date; ?>"></td>
						</tr>
						<tr align="center">
							<?php
								$select=mysqli_query($connection, "SELECT jw_id, jw_tot_amt, jw_worker_id FROM ext_job_work WHERE jw_challan_number='$JWChallanNumber'");
								if($data=mysqli_fetch_array($select)){
									$jw_worker_id = $data['jw_worker_id'];
									$jw_worker_query = mysqli_query($connection, "SELECT ew_name FROM ext_worker WHERE ew_id = '$jw_worker_id'");
									if($worker_data = mysqli_fetch_array($jw_worker_query)){
							?>
							<td align="center" class="form-label"><br><br>Job Worker Name</td>
							<td align="center"><br><br><input type="text" id="ew_name" class="form-control" name="ew_name" style="width: 250px; height: 40px;" value="<?php echo $worker_data['ew_name']; ?>" readonly></td>
							<?php
									}
							?>
						</tr>
						<tr style="display: none;">
							<td align="center"><br><br><input type="text" id="jw_id" class="form-control" name="jw_id" style="width: 250px; height: 40px;" value="<?php echo $data['jw_id']; ?>" readonly></td>
						</tr>
						<tr align="center">
							<td align="center" class="form-label"><br><br>Challan Number</td>
							<td align="center"><br><br><input type="text" id="jw_challan" class="form-control" name="jw_challan" style="width: 250px; height: 40px;" value="<?php echo $JWChallanNumber; ?>" readonly></td>
						</tr>

						<tr align="center">
							<td align="center" class="form-label"><br><br>Quantity of intermediate goods received</td>
							<td align="center"><br><br><input type="text" id="jw_act_qnty" class="form-control" name="jw_act_qnty" style="width: 250px; height: 40px;"></td>
						</tr>

						<tr align="center">
							<td align="center" class="form-label"><br><br>Comment / Remarks</td>
							<td align="center"><br><br><textarea id="jw_comment" class="form-control" name="jw_comment" style="width: 80%;"></textarea></td>
						</tr>

						<tr align="center">
							<td align="center" class="form-label"><br><br>Amount</td>
							<td align="center"><br><br><input type="text" id="jw_tot_amt" class="form-control" name="jw_tot_amt" style="width: 250px; height: 40px;" value="<?php echo $data['jw_tot_amt']; ?>" readonly></td>
							<?php 
								}
							?>
						</tr>
					</table><br><br>

					<p id="wrapper" align="center">
						<label for="yes_no_radio" class="form-label">Invoice received with delivery?</label> &nbsp; &nbsp; &nbsp; &nbsp;
						<input type="radio" name="po_invoice_received" value="1" required>Yes</input> &nbsp; &nbsp; &nbsp; &nbsp;
						<input type="radio" name="po_invoice_received" value="0" required>No</input>
					</p>
					<br>
					<div id="textboxes" style="display: none">
						<table style="width:70%;" id="formContent" align="center">
							<tr align="center">
								<td align="center" class="form-label" style="width:50%;">Upload Invoice image</td>
								<td align="center"><input type="file" id="invoice_image" class="form-control" name="invoice_image" style="width: 250px; height: 40px;"></td>
							</tr>
						</table>
						<br><br>
					</div>

					<p align="center"><input type="submit" name="print" class="btn btn-primary btn-lg" value="Print Challan" id="print"></p>
					<br>
				</form>
				<?php
			}
			else{
				//display iib
				?>
				<form name="frm1" method="post" action="" enctype="multipart/form-data">
					<table align="center" style="width: 60%;" class="table">
						<thead class="thead" align="center">
							<th>Job worker name</th>
							<th>Challan number</th>
							<th>Semi-finished product</th>
							<th>Action</th>
						</thead>

						<tbody align="center">
							<?php
								$jw_query = mysqli_query($connection, "SELECT * FROM ext_job_work WHERE jw_worker_id = '$ew_id' AND (jw_status='JW Submitted' OR jw_status='JW Received')");
								while($jw_row = mysqli_fetch_array($jw_query)){
									?>
									<tr>
										<td>
											<?php
												$worker_id = $jw_row['jw_worker_id'];
												$worker_query = mysqli_query($connection, "SELECT ew_name FROM ext_worker WHERE ew_id = '$worker_id'");
												while($worker_row = mysqli_fetch_array($worker_query)){
													echo $worker_row['ew_name'];
													break;
												}
											?>
										</td>

										<td>
											<?php echo $jw_row['jw_challan_number'];?>
										</td>

										<td>
											<?php echo $jw_row['jw_good_name'];?>
										</td>

										<td>
											<button type="submit" name="select" id="select" value="<?php echo $jw_row['jw_challan_number'];?>" class="btn btn-outline-primary btn-sm">Select</button>
										</td>
									</tr>
									<?php
								}
							?>
						</tbody>
					</table>
				</form>
				<?php
			}
		?>
		
				<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
				<div class="toast-body" text="center">
				    Searching for Data!!
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
</script>
</body>
</html>
<?php mysqli_close($connection); ?>
