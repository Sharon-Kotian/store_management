<?php
	include "includes/db.php";
	global $connection;
	$page ='Expected production output.php';
	$sec = "30";
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

	<title>QC status</title>
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
<body style="background-color:#f8f9fa!important" class="bg-light text-dark">
<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">QC status</h1>
</header>

<center><div class="wrapper fadeInDown back">
  <div id="formContent" style="clear:both;">
	  <br>
		<table border="1px" align="center" class="table table-bordered" style="width:1500px;">
			<tr style="font-size:28px">
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_id" name="qc_id"><b>Sr. No.</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_din" name="qc_din"><b>DIN</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_material_name" name="qc_material_name"><b>Material Name</b></td>
			
             <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_bundles_qnty" name="qc_bundles_qnty"><b>Total boxes/packets</b></td>
			
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_person" name="qc_person"><b>QC Person</b></td>
			 <td class="fadeIn fourth" style="width: 400px; height: 50px;" id="qc_ext_date" name="qc_ext_date"><b>QC Expected Date</b></td>
			</tr>

			<?php
				$query=mysqli_query($connection, "SELECT DISTINCT qc_din,qc_material_name, qc_bundles_qnty, qc_ReportBy, qc_ext_date from quality_control where qc_status = 'Handed over to QC'");	
                
                $sr_no= 1;				
				while($row=mysqli_fetch_array($query)){
					$qc_ext_date = '';
						
					$qc_ext_date = $row['qc_ext_date'];
					if($qc_ext_date=='0000-00-00' or $qc_ext_date=='')
					{
						$new_date="";
					}
					else
					{
						$timestamp=strtotime($qc_ext_date);
						$new_date=date("d-m-Y",$timestamp);
					}
				
					
					
					?>

					<tr style="font-size:22px">
                        <td align="center"><?php echo $sr_no; ?></td>
						<td align="center"><?php echo $row['qc_din']; ?></td>
						<td align="center"><?php echo $row['qc_material_name']; ?></td>
                        
                        <td align="center"><?php echo $row['qc_bundles_qnty']; ?></td>
						<td align="center"><?php echo $row['qc_ReportBy']; ?></td>
						<td align="center"><?php echo $new_date; ?></td>
                        
                        <?php
							$sr_no= $sr_no + 1;
							?>
					</tr>
					<?php
				}
				mysqli_close($connection);
			?>
						
		</table>
	  <br><br>
    </form>
  </div>
</div></center>
<br><br>
</body>
</html>
