<?php
	include "includes/db.php";
	global $connection;
	$page ='QC_status.php';
	$sec = "30";
	//header('Refresh:30;URL=Expected production output.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="CSS/PlacePurchaseOrder.css">
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

	<title>Counting status</title>
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
	
	
	<style>
	body{
		background-color:#f8f9fa!important;
		margin:0;	
		max-width:5000px;
		max-height:5000vh;
		padding:0;
	}
	.back{
		max-width:2000px;
		max-height:2200vh;
		background-color:#f8f9fa;
		margin:0;
		padding:0;
	}
	
	</style>
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
	<h1 class="display-3" align="center">Counting status</h1>
</header>

<div class="wrapper fadeInDown back">
  <div id="formContent">
	  <br><br>
		<table border="1px" align="center" class="table table-bordered" width="80%">
			<tr style="font-size:28px">
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Sr. No.</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>DIN</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Date Of Receipt</b></td>
			 <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Material Name</b></td>
			 <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_counting_quantity" name="rm_counting_quantity"><b>Total Boxes/Packets</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_qc_quantity" name="rm_qc_quantity"><b>Expected Date Of Final Reports</b></td>
			</tr>
			
						<?php
					$sr_no=1;
				
				$query=mysqli_query($connection, "SELECT DISTINCT po_number, po_din, po_arrived_date, po_boxes_actual_received from po_summary,counting_summary where po_summary.po_din=counting_summary.din_no and counting_status!='Closed' and po_status = 'Goods Received' ORDER BY cast(po_arrived_date as date) ASC");
				//$sr_no= 1;				
				while($row=mysqli_fetch_array($query)){
					$po_number = $row['po_number'];
					$po_din = $row['po_din'];
					$receipt=$row['po_arrived_date'];
					if($receipt=='0000-00-00' or $receipt=='' or $receipt<'2001-01-01')
					{
						$new_date1="";
					}
					else
					{
					$timestamp1=strtotime($receipt);
					$new_date1=date("d-m-Y",$timestamp1);
					}
					$insert_name= mysqli_query($connection, "SELECT po_material_name from po_details where po_number='$po_number' and po_status!='Closed'");
					
					while($row_insert=mysqli_fetch_array($insert_name)){
						$material_name=$row_insert['po_material_name'];
						$query2 = mysqli_query($connection, "Select counting_ext_date from counting_summary where din_no = '$po_din' and counting_status!='Closed'");
						$counting_ext_date = '';
						while($row_counting = mysqli_fetch_array($query2))
						{
							$counting_ext_date = $row_counting['counting_ext_date'];
							if($counting_ext_date=='0000-00-00' or $counting_ext_date=='')
							{
								$new_date="";
							}
							else
							{
								$timestamp=strtotime($counting_ext_date);
								$new_date=date("d-m-Y",$timestamp);
							}
						}
						
						
					?>
						<tr style="font-size:22px">
							<td align="center"><?php echo $sr_no; ?></td>
							<td align="center"><?php echo $row['po_din']; ?></td>
							<td align="center"><?php echo $new_date1; ?></td>
							<td align="center"><?php echo $material_name; ?></td>
							<td align="center"><?php echo $row['po_boxes_actual_received']; ?></td>
							<td align="center"><?php echo $new_date; ?></td>
							
							<?php
							$sr_no= $sr_no + 1;
							?>
						</tr>
						<?php
					}
				}
				mysqli_close($connection);
			?>
		</table>
	  <br><br>
    </form>
  </div>
</div>
<br><br>
</body>
</html>
