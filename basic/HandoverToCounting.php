<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}


		if(isset($_POST['submitg'])){
			$po_din = $_POST['po_din'];
			$q1=0;
			$insert_query=0;
			//$po_boxes_actual_received = $_POST['po_boxes_actual_received'];

			$po_din = mysqli_real_escape_string($connection, $po_din);
			
			
			//echo $po_din;
			
			$rs=mysqli_query($connection, "SELECT * from po_summary WHERE po_din='$po_din'");
			
			while($row=mysqli_fetch_array($rs)){
				
				$po_number=$row['po_number'];
				
				
				$q=mysqli_query($connection, "SELECT * from po_details WHERE po_number='$po_number'");
				
				while($rows=mysqli_fetch_array($q))
				{
					$po_material_name=$rows['po_material_name'];
					$po_counting_qnty=$rows['po_counting_quantity'];
					
					$q1=mysqli_query($connection, "SELECT * from counting_summary WHERE din_no='$po_din' and rm_name='$po_material_name'");
					if(mysqli_num_rows($q1)>0)
					{
						$q1=mysqli_query($connection, "UPDATE counting_summary SET counting_quantity='$po_counting_qnty', counting_status='Handed to Counting' WHERE din_no='$po_din' and rm_name='$po_material_name'");
						
						
					}
					else
					{
						$query="INSERT INTO counting_summary(din_no,rm_name,counting_quantity,counting_status) VALUES ('$po_din','$po_material_name','$po_counting_qnty','Handed to Counting')";
						$insert_query=mysqli_query($connection, $query);
						
						if($insert_query)
						{
							echo '<script type="text/javascript">alert("Records Inserted");
									window.location.replace("HandoverToCounting.php")</script>';
						}
					}
					
				}
				
			}
			
			if($q1)
			{
				echo '<script type="text/javascript">alert("Records Updated");
						window.location.replace("HandoverToCounting.php")</script>';

			}
			if($insert_query)
			{
				echo '<script type="text/javascript">alert("Records Inserted");
						window.location.replace("HandoverToCounting.php")</script>';
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

	<title>Handover To Counting Department</title>
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
		
		 
        
		$(document).ready(function() {
            $("#po_din").select2();
        });
   
		
	</script>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 				
</head>
<body class="bg-light text-dark">
<header>	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Handover To Counting Department</h1>
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
					List of goods received
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='din_status.php'">
					DIN Status
				  </button>
			</div>
		  </div>
</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" action="" method="post">
			<table style="width:60%" id="formContent" align="center">
				<tr align="center">
				<?php 
					/*//include_once("../includes/db.php");
					//global $connections;	
					//session_start();
					$po_number=$_SESSION['po_number'];
					$rs=mysqli_query($connection, "SELECT po_din, po_boxes_actual_received from po_summary WHERE po_number='$po_number'");
					$row=mysqli_fetch_array($rs);
					if($row){*/
					?>		
					<br><br><br>
					<td align="center" class="form-label"><br><br>DIN Number: </td>
					<td align="center"><br><br><select name="po_din" id="po_din" style="width: 350px; height: 40px;">
					<?php
						$query=mysqli_query($connection, "SELECT po_din FROM po_summary where po_status='Goods Received' or po_status='PO issued'");
						while($row=mysqli_fetch_array($query)){
							if($row['po_din']!='')
							{
							echo "<option value='".$row['po_din']."'>".$row['po_din']."</option>";
							}
						}
					?>
				</select> 
				</td>
				<?php 
				//} 
				//mysqli_close($connection);
				?>
				</tr>
			</table>
		<br><br><br>
		<p align="center"><input type="submit" class="btn btn-primary" value="  Handover to Counting  " name="submitg"></p>
			</p>	
		</form>	
	</div>
</div>

</body>
</html>
