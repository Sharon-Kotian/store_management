<?php
	include_once("includes/header.php");
	global $connections;
	
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: login.html");
	}
	

	/*if(isset($_POST["Handover_to_QC"]))
	{
		$rm_name=$_POST["rm_name"];
		$po_din=$_POST["po_din"];
		
		$select=mysqli_query($connection, "SELECT qc_id FROM quality_control WHERE qc_din='$po_din' AND qc_material_name='$rm_name'");
		if(mysqli_num_rows($select)>0){
			while($row=mysqli_fetch_array($select)){
				$qc_id=$row['qc_id'];
				$update_query=mysqli_query($connection, "UPDATE quality_control SET qc_status='Handed over to QC' WHERE qc_id='$qc_id'");
				
				$update_query=mysqli_query($connection, "UPDATE counting_summary SET counting_status='Handed over to QC' WHERE din_no='$po_din' AND rm_name='$rm_name'");
				
				$select_query=mysqli_query($connection, "SELECT counting_quantity FROM counting_summary where din_no='$po_din' AND rm_name='$rm_name'");
				while($column=mysqli_fetch_array($select_query)){
					$counting_quantity = $column['counting_quantity'];		
					$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity= rm_qc_quantity+ '$counting_quantity', rm_counting_quantity= rm_counting_quantity-'$counting_quantity' WHERE rm_name='$rm_name'");
				}
			}
		}else{
			echo '<script>alert("No Material Found with the provided data.");
			window.location.replace("HandoverToQualityCheck.php")</script>';
		}
		
		if ($update_query) {
			echo '<script>alert("Handed to Quality Control Successfully!!");
			window.location.replace("HandoverToQualityCheck.php")</script>';
			
		} else {
		  echo "Error: " . $update_query . "<br>" . $connection->error;
		  echo '<script>window.location.replace("HandoverToQualityCheck.php")</script>';
		}
	};*/
	
	
	if(isset($_POST["Handover_to_QC"]))
	{
		$po_din=$_POST["po_din"];
		$_SESSION['po_din']=$_POST['po_din'];
		if($po_din==''){
			echo '<script>alert("DIN is empty");
			window.location.replace("HandoverToQualityCheck.php")</script>';
		}else{
			echo '<script>window.location.replace("HandoverToQualityCheck1.php")</script>';
		}
		
	};
	//mysqli_close($connection);
	
?>

<!DOCTYPE html>
<html lang="en">
	<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
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

	<title>Handover To Quality Check</title>
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

	<script>
	$(document).ready(function(){
		$("#rm_name").select2();
		$('#but_read').click(function(){
		var username = $('#rm_name option:selected').text();
		var userid = $('#rm_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	$(document).ready(function(){
		$("#po_din").select2();
		$('#but_read').click(function(){
		var username = $('#po_din option:selected').text();
		var userid = $('#po_din').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no "> 			
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
	<h1 class="display-3" align="center">Handover To Quality Check</h1>
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
				
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofCountedGoods.php'">
				List of Counted Goods
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='CountingDetails.php'">
				Counting details
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='edit_counted_quantity.php'">
				Edit Counted Quantity
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='closeDIN.php'">
				Close DIN
				</button>
			</div>
		  </div>
</div>


<div class="wrapper fadeInDown" data-select2-id="select2-data-3-6ij1">
	<div id="formContent" data-select2-id="select2-data-formContent"><br><br>
		<form name="frm" action="" method="post">
		<table style="width:70%" id="formContent"align="center">
			<tbody>
			<tr align="center">						
				<td align="center" class="form-label"><br><br>DIN Number: </td>
				<td align="center"><br><br><select name="po_din" id="po_din" style="width: 250px; height: 40px;" data-select2-id="select2-data-qc_invoice_no"  >
					<?php 
						$records=mysqli_query($connection,"SELECT DISTINCT din_no from counting_summary WHERE din_no!='' AND counting_status='Handed to Counting'");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['din_no']."'>".$data['din_no']."</option>";
						}
					?>
				</select>
				</td>
			</tr>
		</tbody></table><br><br><br>
		<p align="center"><input type="submit"  name="Handover_to_QC" class="btn btn-primary btn-lg" value="Handover to QC" id="myBtn"></p>
		</form>

<!--  Toast code -->
		<div style="position: absolute; bottom: 0; right: 0;" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="d-flex">
			  <div class="toast-body" text="center">
			    Successfully Submitted!!
			  </div>
			  <button type="button" id="mybtn" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
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

</body></html>

<?php mysqli_close($connection); ?>
