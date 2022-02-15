<?php
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$po_din=$_POST['po_din'];
		$rm_name=$_POST['rm_name'];
		$po_counting_quantity=$_POST['po_counting_quantity']; // This is counted quantity entered by the user
		$hand_over_to=$_POST['hand_over_to'];
		$hand_over_by=$_POST['hand_over_by'];
		//$qc_bundles_qnty=$_POST["qc_bundles_qnty"];
		//$rs= mysqli_query($connection, "SELECT  from counting_summary WHERE din_no='$po_din'");
		//$row=mysqli_fetch_array($rs);
		//$po_number= $row['po_number'];
		
		foreach ($rm_name as $index => $values) {
			$result=mysqli_query($connection, "SELECT counting_quantity FROM counting_summary WHERE rm_name='$values' AND din_no='$po_din'");
			$data=mysqli_fetch_array($result);
			
			if($data['counting_quantity']<$po_counting_quantity[$index])
			{
				echo '<script type="text/javascript">alert("Invalid Count");
					window.location.replace("CountingDetails.php")</script>';
					
			}
			else
			{
				//mysql_real_escape_string($values);
				$query="UPDATE counting_summary SET counting_status='Handed over to QC' where din_no=$po_din and rm_name=$values";
				$update_query=mysqli_query($connection, $query);
				
				$query1="SELECT * FROM counting_summary where din_no='$po_din' and rm_name='$values'";
				$select_query=mysqli_query($connection, $query1);
				$data=mysqli_fetch_array($select_query);
				
				$count=$data['counting_quantity'];
				
				
				$query1="SELECT * FROM quality_control where qc_din='$po_din' and qc_material_name='$values'";
				$select_query1=mysqli_query($connection, $query1);
				$data1=mysqli_fetch_array($select_query1);
				$cnt=mysqli_num_rows($select_query1);
				
				
				if($cnt>0)
				{
				
				$count1=$data1['qc_quantity_check'];
				
				if($po_counting_quantity[$index]+$count1==$count)
				{
					$query1="UPDATE counting_summary SET counting_status='Closed' where din_no='$po_din' and rm_name='$values'";
					$query2="UPDATE quality_control SET qc_status='Handed over to QC', qc_quantity_check=qc_quantity_check+'$po_counting_quantity[$index]',qc_counting_quantity=qc_counting_quantity+'$po_counting_quantity[$index]',qc_handed_to='$hand_over_to',qc_handed_by='$hand_over_by' where qc_din='$po_din' and qc_material_name='$values'";
					//$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='$values'";
					$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]' , rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' WHERE rm_name='$values'";
					//$query4="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='Body - Goldy Head Green'";
					$update_query1=mysqli_query($connection, $query1);
					$update_query2=mysqli_query($connection, $query2);
					$update_query3=mysqli_query($connection, $query3);
					//$update_query4=mysqli_query($connection, $query4);
					
					
					if($update_query1 || $update_query2 || $update_query3)
						{
							echo '<script type="text/javascript">alert("Records Updated and DIN closed");
								window.location.replace("CountingDetails.php")</script>';
								
						}
				}
				else
				{
					/*if($count1+$po_counting_quantity[$index]==$count)
					{
						$query1="UPDATE counting_summary SET counting_status='Closed' where din_no='$po_din' and rm_name='$values'";
						$query2="UPDATE quality_control SET qc_status='Closed', qc_counting_quantity=qc_counting_quantity+'$po_counting_quantity[$index]' where qc_din='$po_din' and qc_material_name='$values'";
						$update_query1=mysqli_query($connection, $query1);
						$update_query2=mysqli_query($connection, $query2);
						
						if($update_query1 || $update_query2)
						{
							echo '<script type="text/javascript">alert("Records Updated");
								window.location.replace("HandoverToQualityCheck1.php")</script>';
						}
					}
					else */
					if($count1+$po_counting_quantity[$index]>$count)
					{
						echo '<script type="text/javascript">alert("Invalid Count");
							window.location.replace("CountingDetails.php")</script>';
							
					}
					else
					{
						//echo $values;
						$query1="UPDATE counting_summary SET counting_status='Closed' where din_no=$po_din and rm_name=$values";
						$query2="UPDATE quality_control SET qc_status='Handed over to QC', qc_quantity_check=qc_quantity_check+'$po_counting_quantity[$index]',qc_counting_quantity=qc_counting_quantity+'$po_counting_quantity[$index]',qc_handed_to='$hand_over_to',qc_handed_by='$hand_over_by' where qc_din='$po_din' and qc_material_name='$values'";
						//$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='$values'";
						$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]' , rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' WHERE rm_name='$values'";
						//$query4="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='Body - Goldy Head Green'";
						$update_query1=mysqli_query($connection, $query1);
						$update_query3=mysqli_query($connection, $query3);
						$select_query1=mysqli_query($connection, $query2);
						//$update_query4=mysqli_query($connection, $query4);
						if($update_query1 || $update_query3)
						{
							echo '<script type="text/javascript">alert("Records Updated");
								window.location.replace("CountingDetails.php")</script>';
								
						}
					}
				}
				}
				else
				{
					if($po_counting_quantity[$index]==$count)
					{
						$query1="UPDATE counting_summary SET counting_status='Closed' where din_no='$po_din' and rm_name='$values'";
						$query="INSERT INTO quality_control(qc_din,qc_material_name,qc_counting_quantity,qc_quantity_check,qc_handed_to,qc_handed_by,qc_status) VALUES ('$po_din','$values','$po_counting_quantity[$index]','$po_counting_quantity[$index]','$hand_over_to','$hand_over_by','Handed over to QC')";
						//$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='$values'";
						$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]' , rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' WHERE rm_name='$values'";
						//$query4="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='Body - Goldy Head Green'";
						$insert_query=mysqli_query($connection, $query);
						$update_query1=mysqli_query($connection, $query1);
						$update_query3=mysqli_query($connection, $query3);
						//$update_query4=mysqli_query($connection, $query4);
						if($insert_query || $update_query1 || $update_query3)
						{
						echo '<script type="text/javascript">alert("Records Inserted and DIN closed");
								window.location.replace("CountingDetails.php")</script>';
								
						}
					}
					else
					{
						$query="INSERT INTO quality_control(qc_din,qc_material_name,qc_counting_quantity,qc_quantity_check,qc_handed_to,qc_handed_by,qc_status) VALUES ('$po_din','$values','$po_counting_quantity[$index]','$po_counting_quantity[$index]','$hand_over_to','$hand_over_by','Handed over to QC')";
						$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='$values'";
						//$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]' , rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' WHERE rm_name='$values'";
						$query3="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]' , rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' WHERE rm_name='$values'";
						//$query4="UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity-'$po_counting_quantity[$index]',rm_qc_quantity=rm_qc_quantity+'$po_counting_quantity[$index]' where rm_name LIKE '$values' or rm_name='Body - Goldy Head Green'";
						$insert_query=mysqli_query($connection, $query);
						$update_query3=mysqli_query($connection, $query3);
						//$update_query4=mysqli_query($connection, $query4);
						if($insert_query || $update_query3)
						{
						echo '<script type="text/javascript">alert("Records Inserted");
								window.location.replace("CountingDetails.php")</script>';
								
						}
					}
				}
				
				
				


			
			
			/*$query="INSERT INTO quality_control(qc_din,qc_material_name,qc_counting_quantity,qc_handed_to,qc_handed_by,qc_status) VALUES ('$po_din','$values','$po_counting_quantity[$index]','$hand_over_to','$hand_over_by','Handed over to QC')";
			$insert_query=mysqli_query($connection, $query);
			if($insert_query)
			{
			echo '<script type="text/javascript">alert("Records Inserted");
					window.location.replace("HandoverToQualityCheck1.php")</script>';
			}*/
			}
		}
	};
		
		
		
		
		
		
		
		

		/*foreach ($rm_name as $index => $values) {
			
			if(mysqli_num_rows($rs)>0){
				$result=mysqli_query($connection, "SELECT po_number, po_material_name FROM po_details WHERE po_number='$po_number' AND po_material_name='$values'");
				if(mysqli_num_rows($result)>0){
					$insert_query=mysqli_query($connection, "UPDATE po_details SET po_counting_quantity=po_counting_quantity+'$po_counting_quantity[$index]' WHERE po_material_name='$values'");
				}else{
					$insert_query=mysqli_query($connection, "INSERT INTO po_details( po_number, po_material_name, po_counting_quantity) VALUES ('$po_number','$values', '$po_counting_quantity[$index]')");
				}
				$counting_date=date("Y-m-d");
				$rs1=mysqli_query($connection, "SELECT din_no, rm_name FROM counting_summary WHERE din_no='$po_din' AND rm_name='$values' AND counting_date='$counting_date' ");
				if(mysqli_num_rows($rs1)>0){
					$insert_query1=mysqli_query($connection, "UPDATE counting_summary SET counting_quantity=counting_quantity+'$po_counting_quantity[$index]', counting_date = '$counting_date' WHERE rm_name='$values' AND din_no='$po_din'");
				}
				else{
					$rs5=mysqli_query($connection, "SELECT din_no, rm_name FROM counting_summary WHERE din_no='$po_din' AND rm_name='$values'");
					if(mysqli_num_rows($rs5)>0){
						$insert_query1=mysqli_query($connection, "UPDATE counting_summary SET counting_quantity=counting_quantity+'$po_counting_quantity[$index]', counting_date = '$counting_date' WHERE rm_name='$values' AND din_no='$po_din'");
					}
					else{
						$insert_query1=mysqli_query($connection, "INSERT INTO counting_summary(din_no, rm_name, counting_date, counting_quantity) VALUES ('$po_din','$values', '$counting_date','$po_counting_quantity[$index]')");
					}
				}
				$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity=rm_counting_quantity +'$po_counting_quantity[$index]' WHERE rm_name='$values'");
				
				$rs2=mysqli_query($connection, "SELECT * FROM quality_control WHERE qc_din='$po_din' AND qc_material_name='$values'");
				if(mysqli_num_rows($rs2)>0){
					$insert_query2=mysqli_query($connection, "UPDATE quality_control SET qc_bundles_qnty=qc_bundles_qnty+'$qc_bundles_qnty[$index]', qc_counting_quantity=qc_counting_quantity+'$po_counting_quantity[$index]' WHERE qc_din='$po_din' AND qc_material_name='$values'");
				}else{
					$insert_query2=mysqli_query($connection, "INSERT INTO quality_control(qc_din, qc_material_name, qc_bundles_qnty, qc_counting_quantity) VALUES('$po_din', '$values', '$qc_bundles_qnty[$index]', '$po_counting_quantity[$index]')");
				}
			}
			else{
				echo '<script type="text/javascript">alert("DIN Number does not exists.");
				window.location.replace("CountingDetails.php")</script>';
			}
		}
		if($insert_query && $insert_query1 && $insert_query2 && $update_query){
			echo '<script type="text/javascript">alert("Updated Counting Quantity Successfully.");
			window.location.replace("CountingDetails.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
			echo '<script>window.location.replace("CountingDetails.php")</script>';
		}*/

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

	<title>Handover To Quality Check</title>
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
		// $(document).ready(function(){
		// 	$("#rm_name").select2();
		// });
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
				
				<button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToQualityCheck.php'">
				Handover To Quality Check
				</button><br><br>
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

<div class="wrapper fadeInDown">
	<div id="formContent">
		<form name="frm" method="post" action="">
			<table style="width:100%" id="tableContent"><br>
				<tr align="center">	
				<?php $po_din=$_SESSION['po_din']; ?>
					<td align="right" class="form-label" colspan="2"><br><br>DIN Number: </td>
					<td align="center" colspan="2"><br><br><input type="text" id="po_din" class="form-control" name="po_din" style="width: 200px; height: 50px;" value="<?php echo $po_din; ?>" readonly></td>
				</tr>
				<br><br>
				<tr>	
					<td align="center" class="form-label"><br><br>Select Raw Material: </td>
					<td align="center"><br><br><select name="rm_name[]" id="rm_name" style="width: 250px;" class="form-select" required>
						<?php 
							//$rs=mysqli_query($connection,"SELECT po_number from po_summary WHERE po_din='$po_din'");
							//while($row=mysqli_fetch_array($rs)){
								//$po_number=$row['po_number'];
								$records=mysqli_query($connection,"SELECT DISTINCT rm_name from counting_summary WHERE din_no='$po_din' and counting_ext_date!='0000-00-00' and counting_status!='Closed'");
								while($data=mysqli_fetch_array($records)){
									//$counting_quantity=$data['counting_quantity'];
									echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
								}
							//}
						?>
					</select> 
					</td>
					<!--<td align="center" class="form-label"><br><br>Number of bundles prepared: </td>
					<td align="center"><br><br><input type="number" id="qc_bundles_qnty" class="form-control" name="qc_bundles_qnty[]" style="width: 100px;" step=".01" required></td>-->
					
					<td align="right" class="form-label"><br><br>Quantity counted: </td>
					<td align="right"><br><br><input type="number" id="po_counting_quantity" class="form-control" name="po_counting_quantity[]" style="width: 100px;"  step=".01" required></td>
					
					<td align="center"><br><br><input type="button" class="btn btn-outline-primary" value="Add Row"  onclick="addFieldWithoutAddition(this);" style="width: 110px; height: 40px;"/></td>
					<td><br><br><input type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField(this);"/></td>

				</tr>
			</table>
			<br><br>
			<table style="width:100%;">
				<tr align="center">
					<td align="right" class="form-label" style="padding:25px 100px 25px 100px;"><br><br>Hand Over To: </td>
					<td align="left" style="padding:25px 100px 25px 100px;"><br><br><input type="text" id="hand_over_to" class="form-control" name="hand_over_to" style="width: 200px;" required></td>
				</tr>
				<tr>
					<td align="right" class="form-label" style="padding:25px 100px 25px 100px;"><br><br>Hand Over By: </td>
					<td align="left" style="padding:25px 100px 25px 100px;"><br><br><input type="text" id="hand_over_by" class="form-control" name="hand_over_by" style="width: 200px;" required></td>
				</tr>
			</table>
			<p align="center"><input type="submit" name="submit" class="btn btn-primary btn-lg" value="  Update  " id="myBtn">
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

<?php mysqli_close($connection); ?>
