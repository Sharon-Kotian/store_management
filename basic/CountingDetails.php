<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'counting_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	if(isset($_POST['submit'])){
		$din_no=$_SESSION['din_no'];
		echo '<script>alert('.$_POST['din_no'].')';

		foreach ($din_no as $index => $names)
		{
			$_SESSION['din_no']=$din_no[$index];
		}

		$rs= mysqli_query($connection, "SELECT * from counting_summary WHERE din_no='$din_no' AND counting_status = 'Counting Submitted'");
		$count=mysqli_num_rows($rs);
		if($count==1){
			echo '<script>window.location.replace("Updatecountingquantity1.php")</script>';
		}else{
			echo '<script>alert("DIN does not exists");
			window.location.replace("CountingDetails.php")</script>';
			
		}
	};
	
	if(isset($_POST['add'])){
		$din_no=$_POST['din_no'];
		$counting_ext_date=$_POST['counting_ext_date'];
		foreach ($din_no as $index => $names) {	
			$countingQuery = "SELECT din_no FROM counting_summary";
			$counting_summary = mysqli_query($connection, $countingQuery);

			$insert_bool = FALSE;
			$update_bool = FALSE;

			$material_query=mysqli_query($connection, "SELECT po_material_name, po_number FROM po_details where po_number IN (SELECT po_number from po_summary where po_din = '$din_no[$index]')");
			while($materialrow = mysqli_fetch_array($material_query))
			{
				$material_name = $materialrow['po_material_name'];
				
				while($countingrow=mysqli_fetch_array($counting_summary))
				{
					if($countingrow['din_no'] == $din_no[$index])
					{
						$update_bool = TRUE;
						$insert_bool = FALSE;
						break;
					}
					else
					{
						$insert_bool = TRUE;
						$update_bool = FALSE;
					}
				}

				if($update_bool)
				{
					$query="Update counting_summary SET counting_ext_date= '$counting_ext_date[$index]' where din_no= '$din_no[$index]'";
					$insert_query=mysqli_query($connection, $query);
					break;
				}

				elseif ($insert_bool)
				{
					if($counting_ext_date != '00-00-0000')
					{
						$query="Insert into counting_summary (cs_id, din_no, rm_name, counting_date, counting_quantity, counting_ext_date) values ('', '$din_no[$index]', '$material_name', '', '', '$counting_ext_date[$index]')";
						$insert_query=mysqli_query($connection, $query);
					}
				}
			}

			if($insert_query){
				echo '<script>alert("Required dates added");
				window.location.replace("CountingDetails.php")</script>';
				
			}
			else{
				echo "Error" .mysqli_error($connection);
				//echo '<script>window.location.replace("CountingDetails.php")</script>';
				
			}
		}							
	}							
?>

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

	<title>Counting Details</title>
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
	<SCRIPT>
		$(document).ready(function(){
		$("#po_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#po_material_name option:selected').text();
		var userid = $('#po_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function(){
		$("#product_name").select2();
		$('#but_read').click(function(){
		var username = $('#product_name option:selected').text();
		var userid = $('#product_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function() {
            $("#supp_name").select2();
        });
	</SCRIPT>
</head>
<body class="bg-light text-dark">
	<?php
		//include "includes/sidebar.php";
	?>
	<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Counting Details</h1>
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
	
	
	<div class="row" align="center">
		<form method="post">
						
		<table align="center" class="table table-bordered" width="80%">
			<tr style="font-size:28px" align="center">
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>DIN</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>View Details</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Expected Counting Date</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_counting_quantity" name="rm_counting_quantity"><b>Edit Action</b></td>
			</tr>
			<?php
				$query=mysqli_query($connection, "SELECT DISTINCT po_din, po_status from po_summary,counting_summary Where po_summary.po_din=counting_summary.din_no and counting_status!='Closed' and po_status<> 'PO issued' AND po_status<> 'Deleted PO' and po_din <> '' ORDER BY counting_ext_date = '00-00-0000', counting_ext_date");
				while($row=mysqli_fetch_array($query)){
					$po_din = $row['po_din'];
					$insert_query=mysqli_query($connection, "SELECT DISTINCT din_no, counting_ext_date from counting_summary Where din_no= '$po_din' AND counting_status!='Handed over to QC' ORDER BY counting_ext_date = '00-00-0000', counting_ext_date");
					$counting_ext_date = "";
					while($rowdata=mysqli_fetch_array($insert_query)){
						$counting_ext_date = $rowdata['counting_ext_date'];
					
					?>
						<tr style="font-size:22px">
							<td align="center"><input type="text" id="din_no" class="form-control"  name="din_no[]" style="width: 200px; height: 50px; text-align:center;" value="<?php echo $po_din; ?>" readonly></td>
							<?php
								$material_query=mysqli_query($connection, "SELECT po_material_name, po_number FROM po_details where po_number IN (SELECT po_number from po_summary where po_din = '$po_din')");
								$materials = "";
								while($materialrow = mysqli_fetch_array($material_query))
								{
									$materials = $materials. $materialrow['po_material_name']. ", ";
								}
							?>
							<td align="center"><?php echo "<a onClick=\"javascript: alert('Materials: $materials');\" role='button' name='view' id='view' class='btn btn-outline-primary btn-lg' aria-pressed='true'>View</a>"; ?></td>
							<?php
							if($counting_ext_date == ''){?>
																<!-- insert -->
								<td align="center"><input type="date" id="counting_ext_date" class="form-control" name="counting_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $counting_ext_date; ?>"></td>
								<?php
							}
							else if($counting_ext_date == '0000-00-00'){?>
								<!-- update -->
								<td align="center"><input type="date" id="counting_ext_date" class="form-control" name="counting_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $counting_ext_date; ?>"></td>
							<?php
							}
							else{?>
								<td align="center"><input type="date" id="counting_ext_date" class="form-control" name="counting_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $counting_ext_date; ?>" readonly></td>
							<?php
							}
							?>
							<td align="center"><?php echo "<a onClick=\"javascript: return confirm('Confirm your update for the DIN = $po_din?');\" href='Updatecountingquantity1.php?id=". $po_din."' role='button' name='submit' id='submit' class='btn btn-outline-warning btn-lg' aria-pressed='true'>Update</a>"; ?></td>
						
						</tr>
					
					<?php
				}	
				}
				mysqli_close($connection);
			?>
		</table>
		<p align="center"><br><br><br>
			<?php echo "<input type='submit' name='add' class='btn btn-primary btn-lg' value=' Submit ' id='myBtn' style='width: 150px; height: 45px;' align='center' onClick=\"javascript: return confirm('Do you want to add expected dates?');\">";?>
		</p>
		</form>
	</div>
	</DIV>
</div>
</body>
</html>
