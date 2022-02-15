<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
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

	<title>List of Goods Received</title>
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
            $("#supp_name").select2();
            $("#rm_name1").select2();
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
	<h1 class="display-3" align="center">List of Goods Received</h1>
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
	<div id="formContent">
		<p align="center">
			<a class="btn btn-primary btn-lg" href="ListofGoodsReceived.php?source=date" ONCLICK="ShowRowMaterial()">Date Wise</a>
			<a class="btn btn-primary btn-lg" href="ListofGoodsReceived.php?source=supplier" ONCLICK="ShowProduct()">Supplier Wise</a>
			<a class="btn btn-primary btn-lg" href="ListofGoodsReceived.php?source=goods" ONCLICK="ShowProduct()">Goods Wise</a>
		</p>
	
	</div>
	<div class="row" align="center">
		<form method="post">
			<?php
				if(isset($_GET['source']))
				{
					$source = $_GET['source'];
				}
				else
				{
					$source = '';
				}

				switch ($source)
				{
					case 'date':?>
						<table style="width:75%" align="center">
							<tr>
								<td align="center" class="form-label"><br><br>Start Date: </td>
								<td align="center"><br><br><input type="date" id="sdate" name="sdate" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>End Date: </td>
								<td align="center"><br><br><input type="date" id="edate" name="edate" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center"><br><br><input type='submit' id= 'clickme' value=' Submit ' class='btn btn-primary btn-lg' name='datewise' ></td>
							</tr>
						</table><br><br>

						<?php 
							if(isset($_POST['datewise'])){
								$sdate=$_POST['sdate'];
								$edate=$_POST['edate'];?>
								<table border="1px" align="center" class="table table-bordered" style='width:70%'>
									<tr align="center">
										<th align="center">DIN</th>
										<th align="center">Material Name</th>
										<th align="center">Quantity as per PO</th>
										<th align="center">Quantity as per Invoice</th>
										<th align="center">Date</th>
										<th align="center">Supplier</th>
									</tr>
								<?php
								$select=mysqli_query($connection, "SELECT * FROM po_details WHERE po_arrived_date>='$sdate' AND po_arrived_date<='$edate'");
								if(mysqli_num_rows($select)>0){
									while($rows=mysqli_fetch_array($select)){
										$po_number=$rows['po_number'];
										$po_arrived_date=$rows['po_arrived_date'];
										$select_query=mysqli_query($connection, "SELECT po_din,po_supp_id FROM po_summary WHERE po_number='$po_number'");
										if(mysqli_num_rows($select_query)>0){
											while($row=mysqli_fetch_array($select_query)){
												$po_supp_id=$row['po_supp_id'];
												$rs=mysqli_query($connection, "SELECT supp_name FROM supplier WHERE supp_id='$po_supp_id'");
												while($data=mysqli_fetch_array($rs)){
												?>
													<tr>
														<td align="center"><?php echo $row['po_din']; ?></td>
														<td align="center"><?php echo $rows['po_material_name']; ?></td>
														<td align="center"><?php echo $rows['po_material_quantity']; ?></td>
														<td align="center"><?php echo $rows['po_invoice_qnty']; ?></td>
														<td align="center"><?php 
														if ($po_arrived_date!='' && $po_arrived_date != '0000-00-00'){
														    $po_arrived_date = date_format(date_create($po_arrived_date), "d-m-Y");
														    echo $po_arrived_date;
														} else {
														    $po_arrived_date = '';
														    echo $po_arrived_date;
														}
														?></td>
														<td align="center"><?php echo $data['supp_name']; ?></td>
													</tr>
												<?php }
											}
										}else{
											echo '<script>alert("List of Goods Not Available for this date.");
											window.location.replace("ListofGoodsReceived.php")</script>';
										}
									}
								}else{
									echo '<script>alert("List of Goods Not Available for this date.");
									window.location.replace("ListofGoodsReceived.php")</script>';
								}
							?>
						</table>
					<?php 
				}
				break;
			case 'supplier':
		?> 
			<table style="width:75%" align="center">
				<tr>
					<td align="center" class="form-label"><br><br>Supplier Name: </td>
					<td align="center"><br><br><select name="supp_name" id="supp_name" style="width: 300px; height: 45px;" class="form-select">
						<option disabled selected>--Select Supplier Name--</option>
					<?php 
						$records=mysqli_query($connection,"SELECT supp_id ,supp_name from supplier");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['supp_id']."'>".$data['supp_name']."</option>";
						}
					?>
					</select></td>
					<td align="center"><br><br>
						<input type='submit' id= 'clickme' value=' Submit ' class='btn btn-primary btn-lg' name='supplierwise' >
					</td>
				</tr>
			</table><br><br>

		<?php
			if(isset($_POST['supplierwise'])){
				$supp_name=$_POST['supp_name'];
				$select=mysqli_query($connection, "SELECT supp_name FROM supplier WHERE supp_id='$supp_name'");
				while($data=mysqli_fetch_array($select)){
					$supp_name1=$data['supp_name'];
					echo "<input type='text' value='$supp_name1' class='form_control' style='width: 300px; text-align: center;' readonly disabled>";
				}
				?>
				<br><br><table border="1px" align="center" class="table table-bordered" style='width:70%'>
					<tr align="center">
						<th align="center">DIN</th>
						<th align="center">Material Name</th>
						<th align="center">Quantity as per PO</th>
						<th align="center">Quantity as per Invoice</th>
						<th align="center">Date</th>
					</tr>
				<?php
				$select=mysqli_query($connection, "SELECT po_din,po_number, po_arrived_date FROM po_summary WHERE po_supp_id='$supp_name'");
				if(mysqli_num_rows($select)>0){
					while($row=mysqli_fetch_array($select)){
						$po_number=$row['po_number'];
						
						$select_query=mysqli_query($connection, "SELECT * FROM po_details WHERE po_number='$po_number'");
						if(mysqli_num_rows($select_query)>0){
							while($rows=mysqli_fetch_array($select_query)){
								$po_arrived_date=$rows['po_arrived_date'];
								if($po_arrived_date!= '0000-00-00'){?>
									<tr>
										<td align="center"><?php echo $row['po_din']; ?></td>
										<td align="center"><?php echo $rows['po_material_name']; ?></td>
										<td align="center"><?php echo $rows['po_material_quantity']; ?></td>
										<td align="center"><?php echo $rows['po_invoice_qnty']; ?></td>
										<td align="center"><?php 
										if ($po_arrived_date!='' && $po_arrived_date != '0000-00-00'){
										        $po_arrived_date = date_format(date_create($po_arrived_date), "d-m-Y");
										        echo $po_arrived_date;
										} else {
										        $po_arrived_date = '';
										        echo $po_arrived_date;
										}
										?></td>
									</tr>
							<?php }
							}
						}else{
							echo '<script>alert("List of Goods Not Available for this Supplier.");
							window.location.replace("ListofGoodsReceived.php")</script>';
						}
					}
				}else{
					echo '<script>alert("List of Goods Not Available for this Supplier.");
					window.location.replace("ListofGoodsReceived.php")</script>';
				}
			?>
			</table>
		<?php 
		} 
		break;
	case 'goods':?>	
		<table style="width:75%" align="center">
			<tr>
				<td align="center" class="form-label"><br><br>Goods Name: </td>
				<td align="center"><br><br><select name="rm_name" id="rm_name1" style="width: 300px; height: 45px;" class="form-select">
					<option disabled selected>--Select Goods Name--</option>
					<?php 
						$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
						while($data=mysqli_fetch_array($records)){ 

							echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
						}
					?>
					</select>
				</td>
				<td align="left"><br><br>
					<input type='submit' id='clickme' value= 'Submit' class='btn btn-primary btn-lg' name='goodswise'></td>
			</tr>
		</table><br><br>	
		<?php
			if(isset($_POST['goodswise'])){
				$rm_name=$_POST['rm_name'];
				echo "<input type='text' value='$rm_name' class='form_control' style='width: 300px; text-align: center;' readonly disabled>";
				?>
				<br><br><table border="1px" align="center" class="table table-bordered" style='width:70%'>
					<tr align="center">
						<th align="center">DIN</th>
						<th align="center">Material Name</th>
						<th align="center">Quantity as per PO</th>
						<th align="center">Quantity as per Invoice</th>
						<th align="center">Date</th>
						<th align="center">Supplier</th>
					</tr>
				<?php
					$select_query=mysqli_query($connection, "SELECT * FROM po_details WHERE po_material_name='$rm_name'");
					if(mysqli_num_rows($select_query)>0){
						while($rows=mysqli_fetch_array($select_query)){
							$po_arrived_date=$rows['po_arrived_date'];
							$po_number=$rows['po_number'];
							$select=mysqli_query($connection, "SELECT po_din,po_arrived_date, po_supp_id FROM po_summary WHERE po_number='$po_number'");
							while($row=mysqli_fetch_array($select)){
								$po_supp_id=$row['po_supp_id'];
								$rs=mysqli_query($connection, "SELECT supp_name FROM supplier WHERE supp_id='$po_supp_id'");
								while($data=mysqli_fetch_array($rs)){
									if($po_arrived_date!= '0000-00-00'){
							?>
							<tr>
								<td align="center"><?php echo $row['po_din']; ?></td>
								<td align="center"><?php echo $rows['po_material_name']; ?></td>
								<td align="center"><?php echo $rows['po_material_quantity']; ?></td>
								<td align="center"><?php echo $rows['po_invoice_qnty']; ?></td>
								<td align="center"><?php 
									if ($po_arrived_date!='' && $po_arrived_date != '0000-00-00'){
										$po_arrived_date = date_format(date_create($po_arrived_date), "d-m-Y");
										echo $po_arrived_date;
									} else {
										$po_arrived_date = '';
										echo $po_arrived_date;
									}
								?></td>
								<td align="center"><?php echo $data['supp_name']; ?></td>
							</tr>
						<?php }
							}
						}
						}	
					}else{
						echo '<script>alert("List of Goods Not Available for this Good.");
						window.location.replace("ListofGoodsReceived.php")</script>';
					}
			?>
			</table>
		<?php }
		break;
	default:
		break; 
	}
	?>
	</DIV>
</form>
</div>
</body>
</html>
<?php mysqli_close($connection); ?>
