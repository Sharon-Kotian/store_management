<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}

	function random_strings($length_of_string) {
		return substr(sha1(time()), 0, $length_of_string);
	}

	if(isset($_POST['submit'])){
		$po_number=$_POST['po_number'];
		//$po_boxes_as_per_invoice=$_POST['po_boxes_as_per_invoice'];
		$po_boxes_actual_received=$_POST['po_boxes_actual_received'];
		$po_ordered_date=$_POST['po_ordered_date'];
		$po_invoice_received=$_POST['po_invoice_received'];
		$po_id=$_POST['po_id'];
		$po_invoice_qnty=$_POST['po_invoice_qnty'];
		$po_mat_name=$_POST['po_mat_name'];
		$po_member_receiving=$_POST['po_member_receiving'];
		$_SESSION['po_number']=$_POST['po_number'];

		$name=$_FILES['image_of_document']['name'];
		$target_dir="uploads/";
		$target_file=$target_dir.basename($_FILES["image_of_document"]["name"]);
		$imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$extension_arr=array("jpg", "jpeg", "png", "gif", "pdf");
		if(in_array($imageFileType, $extension_arr)){
			$image_base64=base64_encode(file_get_contents($_FILES["image_of_document"]["tmp_name"]));
			$image='data:image/'.$imageFileType.';base64,'.$image_base64;
		}
		$image_of_document=getimagesize($_FILES["image_of_document"]["tmp_name"]);

		$po_din=random_strings(6);
		$select=mysqli_query($connection, "SELECT po_din FROM po_summary WHERE po_number='$po_number'");
		while($row=mysqli_fetch_array($select)){
			$po_din1=$row['po_din'];
			if($po_din1!=''){
				$update_query=mysqli_query($connection, "UPDATE po_summary SET po_boxes_actual_received='$po_boxes_actual_received', po_ordered_date=NOW(),  po_invoice_received='$po_invoice_received', po_status='Goods Received', po_member_receiving=CONCAT(po_member_receiving,' $po_member_receiving'), po_arrived_date=NOW(), image_of_document='".$image."' WHERE po_number='$po_number'");
			}
			
			
			else{
				$update_query=mysqli_query($connection, "UPDATE po_summary SET po_boxes_actual_received='$po_boxes_actual_received', po_ordered_date=NOW(), po_din='$po_din', po_invoice_received='$po_invoice_received', po_status='Goods Received', po_member_receiving=CONCAT(po_member_receiving,' $po_member_receiving'), po_arrived_date=NOW(), image_of_document='".$image."' WHERE po_number='$po_number'");
			}
		}
		foreach((array)$po_id as $index => $values) {
			if($po_invoice_qnty[$index]!=''){
				$po_query="select * from po_details where po_id='$values'";
				$invoice_query=mysqli_query($connection,$po_query);
				while($invoice_data=mysqli_fetch_array($invoice_query)){
					$po_material_quantity=$invoice_data['po_material_quantity'];
					if($po_material_quantity==$po_invoice_qnty[$index]){
						//echo $po_mat_name[$index];
						$update_query1=mysqli_query($connection, "UPDATE po_details SET po_invoice_qnty=po_invoice_qnty+'$po_invoice_qnty[$index]', po_arrived_date=NOW(), po_status='Closed' WHERE po_id='$values' ");
						$insert_query1=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity-'$po_invoice_qnty[$index]' WHERE rm_name='$po_mat_name[$index]'");
						//echo $insert_query1;
					}
					else if($po_invoice_qnty[$index]+$invoice_data['po_invoice_qnty']==$po_material_quantity)
					{
						//echo $po_mat_name[$index];
						$update_query1=mysqli_query($connection, "UPDATE po_details SET po_invoice_qnty=po_invoice_qnty+'$po_invoice_qnty[$index]', po_arrived_date=NOW(), po_status='Closed' WHERE po_id='$values' ");
						$insert_query1=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity-'$po_invoice_qnty[$index]' WHERE rm_name='$po_mat_name[$index]'");
						//echo $insert_query1;
					}
					else if($po_invoice_qnty[$index]+$invoice_data['po_invoice_qnty']>$po_material_quantity)
					{
						echo '<script type="text/javascript">confirm("Invalid input quantity");
						window.location.replace("VerifyNoBoxesForm2.php")</script>';
					}
					else{
						//echo $po_mat_name[$index];
						$update_query1=mysqli_query($connection, "UPDATE po_details SET po_invoice_qnty=po_invoice_qnty+'$po_invoice_qnty[$index]', po_arrived_date=NOW() WHERE po_id='$values'");
						$insert_query1=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity-'$po_invoice_qnty[$index]' WHERE rm_name='$po_mat_name[$index]'");
						//echo $insert_query1;
					}					
				}
				$invoice_query_chars=mysqli_query($connection, "select * from po_details where po_number='$po_number' AND po_status!='Closed'");
				$count_chars=mysqli_num_rows($invoice_query_chars);

				if($count_chars == 0){
					$po_summary_query = mysqli_query($connection, "UPDATE po_summary SET po_status='Closed' Where po_number='$po_number'");
				}
			}
			
			else
				$update_query1=mysqli_query($connection, "UPDATE po_details SET po_invoice_qnty=po_invoice_qnty+'$po_invoice_qnty[$index]' WHERE po_id='$values' ");
		}
		if($update_query || $update_query1){
			move_uploaded_file($_FILES['image_of_document']['tmp_name'],$target_dir.$name);
			echo '<script type="text/javascript">alert("Verified Number of Boxes Successfully.");
				window.location.replace("HandoverToCountingDepartment(Good Review).php")</script>';
		}
		else{
			die("Query Failed " .mysqli_error($connection));
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

	<title>Receive goods</title>
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
		        if ($(this).val() == 'Invoice') {
		            $('#textboxes').show();
		        }
		        else {
		            $('#textboxes').show();
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
	<h1 class="display-3" align="center">Receive goods</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='VerifyNoBoxesForm1.php'">
				  Receive goods
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ViewNoBoxes.php'">
					DIN Reprint
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofGoodsReceived.php'">
					List of Goods Received in past
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToCounting.php'">
					Handover To Counting Department
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='din_status.php'">
					DIN Status
				  </button>
			</div>
		  </div>
</div>

    <div class="wrapper fadeInDown">
        <div id="formContent"><br><br>
        	<form name="frm" action="" method="post" enctype="multipart/form-data">
            <table style="width:50%" id="tableContent" align="center">
            	<tr align="center">
				<td align="center" class="form-label">Date: </td>
				<td align="center"><input type="text" id="po_ordered_date" class="form-control" name="po_ordered_date" style="width: 350px; height: 40px;" readonly>
				<script>
				  var today = new Date();
				  var date = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
				  document.getElementById("po_ordered_date").value = date;
				</script></td>
			</tr>
            <tr align="center">
            	<?php
            		$supp_name=$_SESSION['supp_name'];
            		$po_number=$_SESSION['po_number'];
            	?>
				<td align="center" class="form-label"><br><br>Supplier Name : </td>
				<td><br><br><input type="text" id="supp_name" class="form-control" name="supp_name" style="width: 350px; height: 40px;" value="<?php echo $supp_name; ?>" readonly>
				</td>
			</tr>
            <tr align="center">									
				<td align="center" class="form-label"><br><br>PO Number: </td>
				<td align="center"><br><br><input type="text" id="po_number" class="form-control" name="po_number" style="width: 350px; height: 40px;" value="<?php echo $po_number; ?>" readonly>
				</td>
			</tr>
			<tr>
				<td colspan="2">
				<table border="1px" align="center" class="table table-bordered">
					<tr align="center"><br><br>
						<td hidden="true">PO ID</td>
						<th align="center" style="width:40%;">Material Name</th>
						<th align="center" style="width:30%;">PO Quantity</th>
						<th align="center" style="width:30%;">Already Received Quantity</th>
						<th align="center" style="width:30%;">Quantity as per Invoice/Challan Received</th>
						<!-- <th align="center" style="width:30%;">Rate</th> -->
					</tr>
					<tr align="center">
						<?php
							$query=mysqli_query($connection, "SELECT * FROM po_details WHERE po_number='$po_number' AND po_status!='Closed'");
							if(mysqli_num_rows($query)){
								while($row=mysqli_fetch_array($query)){
									$po_id=$row['po_id'];
									$po_material_name=$row['po_material_name'];
									$po_material_quantity=$row['po_material_quantity'];
									$po_invoice_quantity=$row['po_invoice_qnty'];
									$po_rate=$row['po_rate'];?>
									<td hidden="true"><input type="hidden" name="po_id[]" id="po_id" value="<?php echo $po_id; ?>"></td>
									<td align="center" style="width:40%;"><input type="text" name="po_mat_name[]" id="po_mat_name" class="form-control" value="<?php echo $po_material_name;?>" hidden><?php echo $po_material_name; ?></td>
									<td align="center" style="width:30%;"><?php echo $po_material_quantity; ?></td>
									<td align="center" style="width:30%;"><?php echo $po_invoice_quantity; ?></td>
									<td align="center" style="width:30%;"><input type="number" name="po_invoice_qnty[]" id="po_invoice_qnty" class="form-control"></td>
									<!-- <td align="center" style="width:30%;"><?php echo $po_rate; ?></td> -->
								</tr>
								<?php
								}
							}else{
								echo '<script>alert("NO materials found for this PO Number")</script>';
							}
						?>
				</table></td>
			</tr>
			<!-- <tr align="center">
				<td align="center" class="form-label"><br><br>Boxes as per Invoice: </td>
				<td align="center"><br><br><input type="number" id="po_boxes_as_per_invoice" class="form-control" hint="20000" name="po_boxes_as_per_invoice" style="width: 350px; height: 40px;" step=".01"></td>
			</tr> -->
			<tr align="center">
				<td align="center" class="form-label"><br><br>Total Boxes/Packets Received: </td>
				<td align="center"><br><br><input type="number" id="po_boxes_actual_received" class="form-control" hint="20000" name="po_boxes_actual_received" style="width: 350px; height: 40px;" step=".01"></td>
			</tr>    
            <tr align="center">
            	<td colspan="2" align="center" class="form-label"><br><br>
            		<p id="wrapper" align="center">
		                <label for="yes_no_radio" class="form-label">Invoice received with delivery?</label> &nbsp;&nbsp;&nbsp;
		                <input type="radio" name="po_invoice_received" value="Invoice" required>&nbsp;Invoice</input> &nbsp;
		                <input type="radio" name="po_invoice_received" value="Challan">&nbsp;Challan</input>
		            </p>
            	</td>
        	</tr>
			<tr id="textboxes" style="display: none" align="center">
				<td align="right" class="form-label"><br><br>Document Received: </td>
				<td align="center"><br><br>
					<input type="file" name="image_of_document" id="image_of_document" class="form-control" style="width: 350px; height: 40px;" required>
				</td>
			</tr>
			<tr align="center">
				<td align="center" class="form-label"><br><br>Name of Team Member Receiving: </td>
				<td align="center"><br><br><input type="text" id="po_member_receiving" class="form-control" name="po_member_receiving" style="width: 350px; height: 40px;"></td>
			</tr>
		</table><br><br>
            <p align="center"><input type="submit" class="btn btn-primary btn-lg" value="  Submit  " name="submit"></p>
            </form>
        </div>
    </div>
</body>

</html>
