<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'qc_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}
	

	if(isset($_POST['submit'])){
		$po_din=$_POST['po_din'];
		$rm_name=$_POST['rm_name'];
		
		$qc_stores_quantity=$_POST['qc_stores_quantity'];
		$qc_Rejected_Quantity=$_POST['qc_Rejected_Quantity'];
		
		
		//print_r($rm_name);
		//print_r($qc_Rejected_Quantity);
		$qc_comment=$_POST['qc_comment'];
		if(isset($_POST['qc_Action']))
		{
		$qc_Action=$_POST['qc_Action'];
		}
		else
		{
			echo '<script type="text/javascript">alert("Action not selected");
				window.location.replace("QC_Details.php")</script>';
				
		}
		$qc_ReportBy=$_POST['qc_ReportBy'];

		if(empty($rm_name)){
			echo '<script type="text/javascript">alert("Entry for the raw material is missing.");
				window.location.replace("QC_Details.php")</script>';
				
		}
		else{
			foreach ((array)$rm_name as $index => $values) {
				if($qc_stores_quantity[$index]!=0 || $qc_Rejected_Quantity[$index]!=0)
				{
				
				/*if(!isset($qc_Rejected_Quantity[$index]))
				{
					$qc_Rejected_Quantity[$index]=0;
				}
				if(!isset($qc_stores_quantity[$index]))
				{
					$qc_stores_quantity[$index]=0;
				}
				if(!isset($qc_Action[$index]))
				{
					$qc_Action[$index]='Return';
				}
				if(!isset($qc_comment[$index]))
				{
					$qc_comment[$index]='';
				}*/
				//$tot=  $qc_Rejected_Quantity[$index] + $qc_stores_quantity[$index];
				$tot=  $qc_stores_quantity[$index];			//This is verified quantity
				$diff=  $qc_stores_quantity[$index]-$qc_Rejected_Quantity[$index] ;
				//echo $rm_name[$index];
				$query=mysqli_query($connection, "SELECT qc_counting_quantity FROM quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
				$data=mysqli_fetch_array($query);
				
				if(mysqli_num_rows($query)>0){
					$update_query=0;
					$update_query1=0;
					$counting_quantity=$data['qc_counting_quantity'];
					$query1=mysqli_query($connection, "SELECT qc_Rejected_Quantity, qc_stores_quantity, qc_comment,qc_ReportBy from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
					$data1=mysqli_fetch_array($query1);
					if(mysqli_num_rows($query1)){
						
						if((strcmp($qc_Action[$index],'Rework'))==0)
						{
							$existing_tot= $data1['qc_Rejected_Quantity'] + $data1['qc_stores_quantity'];
							$tot1=$existing_tot+$tot;
							if(($counting_quantity)==$tot){
								$update_query=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]',qc_stores_quantity=qc_stores_quantity+'$diff', qc_rework_quantity=qc_rework_quantity+'$qc_Rejected_Quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy', qc_status='QC Done' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_rework_quantity,qc_return_quantity,qc_Rejected_Quantity,qc_counting_quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff',rm_rework_quantity=rm_rework_quantity+'$qc_Rejected_Quantity[$index]' WHERE rm_name='$values'");
							}
							elseif (($counting_quantity)>$tot) {
								$update_query1=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$diff',qc_rework_quantity=qc_rework_quantity+'$qc_Rejected_Quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_return_quantity,qc_Rejected_Quantity,qc_rework_quantity,qc_counting_quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff',rm_rework_quantity=rm_rework_quantity+'$qc_Rejected_Quantity[$index]' WHERE rm_name='$values'");
							}
							elseif (($counting_quantity)<$tot){
								echo '<script>alert("Quantity exceeded.");
								window.location.replace("QC_Details.php")</script>';
								$_SESSION['pass_match']=0;
							}
						}
						else if((strcmp($qc_Action[$index],'Return'))==0)
						{
							$existing_tot= $data1['qc_Rejected_Quantity'] + $data1['qc_stores_quantity'];
							$tot1=$existing_tot+$tot;
							if(($counting_quantity)==$tot){
								$update_query=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]',qc_stores_quantity=qc_stores_quantity+'$diff', qc_return_quantity=qc_return_quantity+'$qc_Rejected_Quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy', qc_status='QC Done' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								
								
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_rework_quantity,qc_return_quantity,qc_Rejected_Quantity,qc_counting_quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_return_quantity=rm_return_quantity+'$qc_Rejected_Quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff' WHERE rm_name='$values'");
								
							}
							elseif (($counting_quantity)>$tot) {
								$update_query1=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$diff',qc_return_quantity=qc_return_quantity+'$qc_Rejected_Quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_rework_quantity,qc_counting_quantity,qc_return_quantity,qc_Rejected_Quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_return_quantity=rm_return_quantity+'$qc_Rejected_Quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff' WHERE rm_name='$values'");
							}
							elseif (($counting_quantity)<$tot){
								echo '<script>alert("Quantity exceeded.");
								window.location.replace("QC_Details.php")</script>';
								$_SESSION['pass_match']=0;
							}
						}
						else if((strcmp($qc_Action[$index],'Scrap'))==0)
						{
							$existing_tot= $data1['qc_Rejected_Quantity'] + $data1['qc_stores_quantity'];
							if(($counting_quantity)==$tot){
								$update_query=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]',qc_Rejected_Quantity=qc_Rejected_Quantity+'$qc_Rejected_Quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$diff',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy', qc_status='QC Done' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_rework_quantity,qc_counting_quantity,qc_return_quantity,qc_Rejected_Quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff',rm_rejected_quantity=rm_rejected_quantity+'$qc_Rejected_Quantity[$index]' WHERE rm_name='$values'");
							}
							elseif (($counting_quantity)>$tot) {
								$update_query1=mysqli_query($connection, "UPDATE quality_control SET qc_counting_quantity=qc_counting_quantity-'$qc_stores_quantity[$index]',qc_Rejected_Quantity=qc_Rejected_Quantity+'$qc_Rejected_Quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$diff',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy' WHERE qc_material_name='$values' AND qc_din='$po_din'");
								$query1=mysqli_query($connection, "SELECT qc_stores_quantity,qc_rework_quantity,qc_counting_quantity, qc_return_quantity,qc_Rejected_Quantity from quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
								$data1=mysqli_fetch_array($query1);
								$s=$data1['qc_stores_quantity'];
								$r=$data1['qc_rework_quantity'];
								$c=$data1['qc_counting_quantity'];
								$ret=$data1['qc_return_quantity'];
								$rej=$data1['qc_Rejected_Quantity'];
								
								$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity=rm_qc_quantity-'$qc_stores_quantity[$index]',rm_rejected_quantity=rm_rejected_quantity+'$qc_Rejected_Quantity[$index]',rm_stores_quantity=rm_stores_quantity+'$diff' WHERE rm_name='$values'");
							}
							elseif (($counting_quantity)<$tot){
								echo '<script>alert("Quantity exceeded.");
								window.location.replace("QC_Details.php")</script>';
								
							}
						}
						else
						{
							echo '<script type="text/javascript">alert("Action not selected");
							window.location.replace("QC_Details.php")</script>';
							
						}
						
						/*$existing_tot= $data1['qc_Rejected_Quantity'] + $data1['qc_stores_quantity'];
						if(($counting_quantity-$existing_tot)==$tot){
							$update_query=mysqli_query($connection, "UPDATE quality_control SET qc_Rejected_Quantity=qc_Rejected_Quantity+'$qc_Rejected_Quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$qc_stores_quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy', qc_status='QC Done' WHERE qc_material_name='$values' AND qc_din='$po_din'");
						}
						elseif (($counting_quantity-$existing_tot)>$tot) {
							$update_query1=mysqli_query($connection, "UPDATE quality_control SET qc_Rejected_Quantity=qc_Rejected_Quantity+'$qc_Rejected_Quantity[$index]', qc_stores_quantity=qc_stores_quantity+'$qc_stores_quantity[$index]',qc_comment= '$qc_comment[$index]',qc_Action= '$qc_Action[$index]',qc_ReportBy= '$qc_ReportBy' WHERE qc_material_name='$values' AND qc_din='$po_din'");
						}
						elseif (($counting_quantity-$existing_tot)<$tot){
							echo '<script>alert("Quantity exceeded.");
							window.location.replace("Updatequalitycheckdata.php")</script>';
						}*/
					}
				}
				if($update_query){
						echo '<script type="text/javascript">alert("QC done Successfully.");
						window.location.replace("QC_Details.php")</script>';
						
					}elseif($update_query1){
						echo '<script type="text/javascript">alert("Partial QC done Successfully.");
						window.location.replace("QC_Details.php")</script>';
						
					}
					else{
						echo '<script type="text/javascript">alert("QC data failed to update. Check all inputs correctly. Error: "' .mysqli_error($connection).');
						window.location.replace("QC_Details.php")</script>';						
					}
					
					
				}
				
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

	<title>Update quality check data</title>
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
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 
	<SCRIPT>
		$(document).ready(function(){
		//$("#qc_Action").select2();
	});
	</SCRIPT> 
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
	<h1 class="display-3" align="center">Update quality check data</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submitjobworkqualityreport1.php'">
				Submit Job Work Quality Report
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='QC_Details.php'">
				Quality Check Details
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewQCPOs.php'">
				Historical QC
				</button>
			</div>
		  </div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" action="" method="post">
		<table style="width:50%" id="formContent" align="center">
			<!-- <tr align="center">
			<?php 
				$po_din=$_GET['id'];
				$rs=mysqli_query($connection, "SELECT po_invoice_no from po_summary WHERE po_din='$po_din'");
				if($row=mysqli_fetch_array($rs)){
				?>			
				<td align="center" class="form-label">Invoice Number: </td>
				<td align="center"><input type="text" id="po_invoice_no" class="form-control" name="po_invoice_no" style="width: 180px; height: 45px;" value="<?php echo $row['po_invoice_no']; ?>" readonly>
				</td>
			<tr> -->
			
			<tr>
				<table border="1px" align="center" class="table table-bordered" style="width:90%"><br><br>
						
					<tr align="center">
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>DIN Number</b></td>
					  <td class="fadeIn fourth" style="width: 1000px; height: 50px;" name="rm_name" id="rm_name"><b>Raw Material Name</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>Quantity Received</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>Quantity Verified</b></td>
					  <td class="fadeIn fourth" style="width: 400px; height: 50px;"><b>Quantity Rejected</b></td>
					  <td class="fadeIn fourth" style="width: 1000px; height: 50px;"><b>Reason</b></td>
					  <td class="fadeIn fourth" style="width: 300px; height: 50px;"><b>Action</b></td>
					</tr>	
					<?php
						$po_invoice_no=$row['po_invoice_no'];
						$record=mysqli_query($connection, "SELECT qc_material_name, qc_counting_quantity FROM quality_control WHERE qc_din='$po_din' AND qc_status='Handed over to QC'");
						while($rows=mysqli_fetch_array($record)){
							?>				
							<tr>
								<td><input type="text" id="po_din" name="po_din" style="text-align: center" class="form-control" value="<?php echo $po_din; ?>" readonly></td>
								<td><input type="text" id="rm_name" name="rm_name[]" style="text-align: center" class="form-control" value="<?php echo $rows['qc_material_name']; ?>" readonly></td>
								<td><input type="text" id="rm_name" style="text-align: center" class="form-control" value="<?php echo $rows['qc_counting_quantity']; ?>" readonly></td>
								<td><input type="number" id="qc_stores_quantity" name="qc_stores_quantity[]" value="0" style="text-align: center" class="form-control"> </td>
								<td> <input type="number" id="qc_Rejected_Quantity" name="qc_Rejected_Quantity[]" value="0" style="text-align: center" class="form-control"> </td>		
								<td> <input type="text" id="qc_comment" name="qc_comment[]" value="" style="text-align: center" class="form-control"> </td>
								<td align="center"><select name="qc_Action[]" id="qc_Action" style="width: 145px;" class="form-select">
									<option id=0 disabled>Select Action</option>
									<option id=1 selected="true">Return</option>
									<option id=2>Rework</option>
									<option id=3>Scrap</option>
								</select> 
							</tr>
						<?php
							}
						}
					?>
							
				</table>
			</tr>
			</table>
			<table align="center" width="40%">
			<tr>									
				<td align="center" class="form-label"><br><br>Report Prepared By : </td>
				<td align="center"><br><br>
				<input type="text" name="qc_ReportBy" id="qc_ReportBy" style="width: 350px; height: 40px;" class="form-control"></td>
			</tr>
		</table><br>
		<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Submit " id="myBtn"></p>
				
		</form>		
	<!--  Toast code -->
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
<!--toast script-->
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $('.toast').toast('show');
  });
});
</script>

</body>
</html>

<?php
	mysqli_close($connection);
?>
