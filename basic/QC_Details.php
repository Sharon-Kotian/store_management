<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'qc_dept'){
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

		$rs= mysqli_query($connection, "SELECT * from quality_control WHERE qc_din='$din_no' AND qc_status!='Closed'");
		$count=mysqli_num_rows($rs);
		if($count==1){
			echo '<script>window.location.replace("Updatequalitycheckdata.php")</script>';
		}else{
			echo '<script>alert("DIN does not exists");
			window.location.replace("QC_Details.php")</script>';
		}
	};
	
	if(isset($_POST['add'])){
		$din_no=$_POST['din_no'];
		$qc_ext_date=$_POST['qc_ext_date'];
		foreach ($din_no as $index => $names) {	
			$countingQuery = "SELECT qc_din FROM quality_control";
			$counting_summary = mysqli_query($connection, $countingQuery);

			$insert_bool = FALSE;
			$update_bool = FALSE;

			$material_query=mysqli_query($connection, "SELECT qc_material_name FROM quality_control where qc_din = '$din_no[$index]'");
			while($materialrow = mysqli_fetch_array($material_query))
			{
				$material_name = $materialrow['qc_material_name'];
				
				while($countingrow=mysqli_fetch_array($counting_summary))
				{
					if($countingrow['qc_din'] == $din_no[$index])
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
					$query="Update quality_control SET qc_ext_date= '$qc_ext_date[$index]' where qc_din= '$din_no[$index]'";
					$insert_query=mysqli_query($connection, $query);
					break;
				}

				elseif ($insert_bool)
				{
					if($qc_ext_date != '00-00-0000')
					{
						$query="Insert into quality_control (qc_id, qc_din, qc_material_name, qc_ext_date) values ('', '$din_no[$index]', '$material_name', '$qc_ext_date[$index]')";
						$insert_query=mysqli_query($connection, $query);
					}
				}
			}

			if($insert_query){
				echo '<script>alert("Required dates added");
				window.location.replace("QC_Details.php")</script>';
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

	<title>Quality Check Details</title>
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
	<h1 class="display-3" align="center">Quality Check Details</h1>
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
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewQCPOs.php'">
				Historical QC
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
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_name" name="rm_name"><b>Expected QC Date</b></td>
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="rm_counting_quantity" name="rm_counting_quantity"><b>Edit Action</b></td>
			</tr>
			<?php
				$query=mysqli_query($connection, "SELECT DISTINCT qc_din,qc_ext_date from quality_control where qc_status!='Closed' AND qc_status!='QC Done' ORDER BY qc_ext_date = '00-00-0000', qc_ext_date");
				while($row=mysqli_fetch_array($query)){
					$qc_din = $row['qc_din'];
					//$insert_query=mysqli_query($connection, "SELECT DISTINCT qc_din, qc_ext_date from quality_control Where qc_din= '$qc_din' ORDER BY qc_ext_date = '00-00-0000', qc_ext_date");
					$qc_ext_date = "";
					//while($rowdata=mysqli_fetch_array($insert_query)){
						$qc_ext_date = $row['qc_ext_date'];
					
					?>
						<tr style="font-size:22px">
							<td align="center"><input type="text" id="din_no" class="form-control"  name="din_no[]" style="width: 200px; height: 50px; text-align:center;" value="<?php echo $qc_din; ?>" readonly></td>
							<?php
								$material_query=mysqli_query($connection, "SELECT qc_material_name FROM quality_control where qc_din = '$qc_din'");
								$materials = "";
								while($materialrow = mysqli_fetch_array($material_query))
								{
									$materials = $materials. $materialrow['qc_material_name']. ", ";
								}
							?>
							<td align="center"><?php echo "<a onClick=\"javascript: alert('Materials: $materials');\" role='button' name='view' id='view' class='btn btn-outline-primary btn-lg' aria-pressed='true'>View</a>"; ?></td>
							<?php
							if($qc_ext_date == ''){?>
																<!-- insert -->
								<td align="center"><input type="date" id="qc_ext_date" class="form-control" name="qc_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $qc_ext_date; ?>"></td>
								<?php
							}
							else if($qc_ext_date == '0000-00-00'){?>
								<!-- update -->
								<td align="center"><input type="date" id="qc_ext_date" class="form-control" name="qc_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $qc_ext_date; ?>"></td>
							<?php
							}
							else{?>
								<td align="center"><input type="date" id="qc_ext_date" class="form-control" name="qc_ext_date[]" style="width: 200px; height: 50px;" value="<?php echo $qc_ext_date; ?>" readonly></td>
							<?php
							}
							?>
							<td align="center"><?php echo "<a onClick=\"javascript: return confirm('Confirm your update for the DIN = $qc_din?');\" href='Updatequalitycheckdata.php?id=". $qc_din."' role='button' name='submit' id='submit' class='btn btn-outline-warning btn-lg' aria-pressed='true'>Update</a>"; ?></td>
						
						</tr>
					
					<?php
				}	
				//}
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
