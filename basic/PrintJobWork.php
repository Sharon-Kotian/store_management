<?php
	include_once ("includes/db.php");
	global $connection;
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<link rel="stylesheet" href="htmlToPDFfile/htmlTOpdf.css">
	<script src="htmlToPDFfile/htmlTOpdfJavascript.js"></script>
	<script src="htmlToPDFfile/htmlTOpdfscript.js"></script>
	<script src="htmlToPDFfile/JS/addRowButton.js"></script>
</head>
<body onload="window.print()">
	<div id="PurchaseOrder">
	<?php
				$query = "SELECT * FROM company_info";
				$info = mysqli_query($connection,$query);
				while ($row = mysqli_fetch_assoc($info)) 
				{
					$full_name = $row['company_full_name'];
					$short_name = $row['company_short_name'];
					$full_addr = $row['company_full_address'];
					$pan = $row['pan'];
					$gstin = $row['gstin'];
					$email = $row['email'];
				}
			?>
		<h2 align="center"><?php echo $full_name.' ('.$short_name.')';?></h2>
		<h1>Job Work Material Out Challan</h1>
		<table style="width:100%;">
			<?php 
				$jw_id=$_SESSION['jw_id'];
				$jw_charges = $_SESSION['jw_charges'];
				$final_record=mysqli_query($connection, "SELECT * FROM ext_job_work WHERE jw_id = '$jw_id'");
				if($jw_row = mysqli_fetch_array($final_record)){
					$issued_by = $jw_row['jw_issuing_person'];
			?>		
					<tr>
						<td><b>Challan No.:</b></td>
						<td><?php echo $jw_row['jw_challan_number']; ?></td>
					</tr>
					<tr>
						<td><b>Date:</b></td>
						<td><?php echo date('d-m-Y', strtotime($jw_row['jw_submit_date'])); ?></td>
						<td><b>Expected Date:</b></td>
						<?php
							if($jw_row['jw_exp_date'] == "0000-00-00 00:00:00"){
								echo "<td>N/A</td>";
							}
							else{
								echo "<td>".date('d-m-Y', strtotime($jw_row['jw_exp_date']))."</td>";
							}
						?>
					</tr>
					<tr>
						<td><b>Jobworker: </b></td>
						<td>
							<?php
								$worker_id = $jw_row['jw_worker_id'];
								$worker_query = mysqli_query($connection, "SELECT * FROM ext_worker WHERE ew_id = '$worker_id'");
								if($worker_row = mysqli_fetch_array($worker_query)){
									echo $worker_row['ew_name'];
								}
							?>
						</td>
						<td><b>Expected quantity: </b></td>
						<td><?php echo (int)$jw_row['jw_exp_qnty']; ?></td>
					</tr>
					<tr>
						<td><b>Semi finished goods: </b></td>
						<td><?php echo $jw_row['jw_good_name']; ?></td>
						<td><b>JW charges/unit: </b></td>
						<td><?php echo $jw_charges; ?></td>
					</tr>
		</table>
			<?php
				}
			?>
				<br><br><h3>List of raw materials issued:</h3><br>
				<table style="width: 100%;">
					<thead>
						<tr>
							<th style="width: 10%;">Sr. no.</th>
							<th style="width: 65%;">Name</th>
							<th style="width: 25%;">Quantity</th>
						</tr>
					</thead>

					<tbody>
						<?php
							$jw_id=$_SESSION['jw_id'];
							$jw_summary_query = mysqli_query($connection, "SELECT * FROM job_work_summary WHERE jw_id = '$jw_id'");
							$srno = 1;
							$quantity_total = 0;
							while($summary_row = mysqli_fetch_array($jw_summary_query)){
								echo "<tr><td>$srno</td>";
								echo "<td>".$summary_row['rm_name']."</td>";
								echo "<td>".(int)$summary_row['submitted_quantity']."</td></tr>";
								$srno++;
								$quantity_total = $quantity_total + $summary_row['submitted_quantity'];
							}
						?>
						<tr>
							<td colspan="2" align="center"><b>TOTAL</b></td>
							<td><b><?php echo $quantity_total; ?></b></td>
						</tr>
					</tbody>
				</table>
			
				
			<?php
			mysqli_close($connection);
			?>
	</table>
	<br><br><br><br>
	<p><b>Issued by:    </b><?php echo $issued_by; ?></p><br>
	<p><b>Sign & stamp</b></p><br><p>_____________________________________</p>
</body>
</html>
