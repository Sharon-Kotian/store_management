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
		<h1>Quantity Verification</h1>
		<table style="width:100%;">
			<?php 
				$str_query=$_SESSION['str_query'];
				$final_record=mysqli_query($connection, $str_query);?>
				<tr>
				<th style="text-align:center;"><strong>Caret Id</strong></th>
				<th style="text-align:center;"><strong>Raw Material</strong></th>
				<th style="text-align:center;"><strong>Last Verified On</strong></th>
				<th></th>
				<th style="text-align:center;"><strong>Quantity</strong>
					<table style="table-layout: fixed; border: none; border-top: 1px solid;">
						<tr>
							<td style='width: 74px; border: none; border-right: 1px solid;'><strong>Stores</strong></td>
							<td style='width: 74px; border: none; border-right: 1px solid;'><strong>Counti ng</strong></td>
							<td style='width: 74px; border: none; border-right: 1px solid;'><strong>Quality Check</strong></td>
							<td style='width: 74px; border: none; border-right: 1px solid;'><strong>Rework</strong></td>
							<td style='width: 74px; border: none; border-right: 1px solid;'><strong>Job Work</strong></td>
							<td style='width: 70px; border: none'><strong>Total</strong></td>
						</tr>
					</table>
				</th>
				<th style="width: 300px; text-align:center;"><strong>Remarks</strong></th>
			</tr>
			<?php
				while($row=mysqli_fetch_array($final_record)){					
					$rm_name=$row['rm_name'];
					$rs=mysqli_query($connection, "SELECT * from raw_materials where rm_name='$rm_name'");
					while($data=mysqli_fetch_array($rs)){
			?>	
	</div>
			<?php 
				$rm_id=$row['rm_id'];
				$rm_verification_date=$row['rm_verification_date'];
				$rm_stores_quantity=(int)$row['rm_stores_quantity'];
				$rm_counting_quantity=(int)$row['rm_counting_quantity'];
				$rm_qc_quantity=(int)$row['rm_qc_quantity'];
				$rm_rework_quantity=(int)$row['rm_rework_quantity'];
				$rm_jobwork_quantity=(int)$row['rm_jobwork_quantity'];
				$total_quantity = (int)$row['rm_stores_quantity']+(int)$row['rm_counting_quantity']+(int)$row['rm_qc_quantity']+(int)$row['rm_rework_quantity']+(int)$row['rm_jobwork_quantity'];
				$caret_id = $row['rm_caret_id'];

					echo "<tr>";
					if($caret_id==""){
						echo "<td> </td>";
					}else{
						echo "<td style='text-align:center;'>$caret_id</td>";
					}
					
					echo "<td style='text-align:center;'>$rm_name</td>";
					if($row['rm_verification_date']=="0000-00-00" OR $row['rm_verification_date']==""){
						echo "<td style='text-align:center;'>NA</td>";
					}else{
						echo "<td style='text-align:center;'>$rm_verification_date</td>";
					}
					echo "<td>
							<table style='width:100%; border: none;' height='80'>
								<tr>
									<td style='height: 47px; border: none; border-bottom: 1px solid;'>As Per Books:</td>
								</tr>
								<tr>
									<td style='height: 47px; border: none;'>As Per Verification:</td>
								</tr>
							</table>
						</td>

						<td>
							<table style='width:100%; table-layout: fixed; border: none;'>
								<tr style='border: none;'>
									<td style='height: 47px; width: 70px; border: none; border-bottom: 1px solid; border-right: 1px solid;' align='center'>$rm_stores_quantity</td>
									<td style='width: 70px; border: none; border-bottom: 1px solid; border-right: 1px solid;' align='center'>$rm_counting_quantity</td>
									<td style='width: 70px; border: none; border-bottom: 1px solid; border-right: 1px solid;' align='center'>$rm_qc_quantity</td>
									<td style='width: 70px; border: none; border-bottom: 1px solid; border-right: 1px solid;' align='center'>$rm_rework_quantity</td>
									<td style='width: 70px; border: none; border-bottom: 1px solid; border-right: 1px solid;' align='center'>$rm_jobwork_quantity</td>
									<td style='width: 70px; border: none; border-bottom: 1px solid;' align='center'>$total_quantity</td>
								</tr>
								<tr>
									<td style='height: 47px; border: none; border-right: 1px solid;'> </td>
									<td style='height: 47px; border: none; border-right: 1px solid;'> </td>
									<td style='height: 47px; border: none; border-right: 1px solid;'> </td>
									<td style='height: 47px; border: none; border-right: 1px solid;'> </td>
									<td style='height: 47px; border: none; border-right: 1px solid;'> </td>
									<td style='height: 47px; border: none;'> </td>
								</tr>
							</table>
						</td>";
					echo "<td> </td>";
					echo "</tr>";
				}
				
			}mysqli_close($connection);
			?>
	</table>
	<br><br><br><br>
	<p><b>Date:</b></p><p>_________________________</p><br>
	<p><b>Name Of Person Who Verified:</b></p><p>_____________________________________</p>
</body>
</html>
