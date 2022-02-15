<?php 
    include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept' && $_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	// if($_SESSION['user_dept'] != 'production_dept'){
	// 	echo '<script type="text/javascript">alert("Access Denied.")';
	// 	header("Location: ../login.html");
	// }
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- select2 css -->
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>

    <!-- select2 script -->
    <script src='select2/dist/js/select2.min.js'></script>
	<script type="text/javascript src="jquery-3.6.0.min.js"></script>

    <!-- CDN -->
    <!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> 
     -->
	
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

	<title>Historical Requisition</title>
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
		
	$(document).ready(function() {
            $("#material_name").select2();
        });
		
	$(document).ready(function() {
            $("#worker_name").select2();
        });
	</SCRIPT>
</head>
<body>
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
	<h1 class="display-3" align="center">Historical Job Work</h1>
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
				<?php
				if($_SESSION['user_dept'] == 'production_dept')
				{
					echo '<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Acceptrawmaterial.php\'">
					Accept Raw Material
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Add Production Estimation.php\'">
					Add Production Estimation
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Returnfaultymaterial.php\'">
					Return Faulty Material
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Submit finished goods.php\'">
					Submit Finished Goods
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Acceptrawmaterial1.php\'">
					Input Expected Output
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'AdhocProduction.php\'">
					Raise Requisition
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'ViewPendingProductions.php\'">
					Historical Production
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'ViewRequisition.php\'">
					Pending requisitions
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'job_workers.php\'">
					Manage Job Workers
					</button><br><br>				  
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'closePO.php\'">
					  Close PO
					</button>';
				}

				else
				{?>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>

				<hr><?php
					echo '<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'SubmitJobWork.php\'">
					Jobwork Out(Issue Material)
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'AcceptJobwork1.php\'">
					Jobwork In(Accept Material)
					</button><br><br>
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'job_work_receivable.php\'">
					Jobwork Receivable
				</button><br><br>
					
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'Manage intermediate goods.php\'">
					Manage Intermediate Goods
					</button><br><br>
					
					<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location=\'job_workers.php\'">
					Manage Job Workers
					</button>					
					';
				}
				?>
			</div>
		  </div>
</div>
<div class="wrapper fadeInDown"> <div id="formContent">
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" href="HistoricalJobWork.php?source=Date" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Date Wise</a>
			<a class="btn btn-primary btn-lg" href="HistoricalJobWork.php?source=Material" ONCLICK="ShowProduct()" style="width: 250px; height: 50px;">Material Wise</a>
		<a class="btn btn-primary btn-lg" href="HistoricalJobWork.php?source=Worker" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Job Worker Wise</a>
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
				}	switch ($source)
				{
					case 'Material':
						//global $connection;
						echo '<br><br>';
						echo '<select name="material_name" id="material_name" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select Material</option>';
						$query = "SELECT DISTINCT jw_good_name FROM ext_job_work where jw_actual_date!='0000-00-00'";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$igs_id = $row['igs_id'];
							$igs_name = $row['jw_good_name'];

							echo "<option value=$igs_name>$igs_name</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="igs_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['igs_name_submit']))
						{
							//echo $_POST['material_name'];
							$igs_name = $_POST['material_name'];
							//echo $igs_name;
							$query = "select DISTINCT * from ext_job_work where jw_good_name='{$igs_name}' AND jw_actual_date!='0000-00-00'";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>Good Name</th>
									<th>Expected Quantity</th>
									<th>Actual quantity</th>
                                    <th>Submit date</th>
                                    <th>Actual date</th>        <th>Total amount</th>                 
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								//$selectquery = mysqli_query($connection,"select jw_good_name,jw_exp_qnty,jw_act_qnty,jw_submit_date,jw_actual_date,jw_tot_amt from ext_job_work where jw_good_name = '$igs_name' AND jw_actual_date!='0000-00-00' ORDER BY jw_id");
								//while($rows = mysqli_fetch_assoc($selectquery)){
								$jw_good_name = $row['jw_good_name'];
								$jw_exp_qnty= $row['jw_exp_qnty'];
								$jw_act_qnty = $row['jw_act_qnty'];
								$jw_submit_date = $row['jw_submit_date'];
								$t=strtotime($jw_submit_date);
								$d=date("d-m-Y",$t);
								$jw_actual_date = $row['jw_actual_date'];
								$t1=strtotime($jw_actual_date);
								$d1=date("d-m-Y",$t1);
								$jw_tot_amt = $row['jw_tot_amt'];
								
								echo "<tr>";
								echo "<td align='center'>$jw_good_name</td>";
								echo "<td align='center'>$jw_exp_qnty</td>";
								echo "<td align='center'>$jw_act_qnty</td>";
								echo "<td align='center'>$d</td>";
								echo "<td align='center'>$d1</td>";          
								echo "<td align='center'>$jw_tot_amt</td>";					
						?>
							<?php
								echo "</tr>";
							//}
							}
							echo '</tbody>';
                        	echo '</table>';
						}
						
						break;

                      case 'Date':				
							echo '<table style="width:75%" align="center">
							<tr>
								<td align="center" class="form-label"><br><br>From Date: </td>
								<td align="center"><br><br><input type="date" id="jw_actual_date" name="jw_actual_date" class="form-control" style="width: 300px; height: 45px;" required></td>
								<td align="center" class="form-label"><br><br>To Date: </td>
								<td align="center"><br><br><input type="date" id="jw_actual_date1" name="jw_actual_date1" class="form-control" style="width: 300px; height: 45px;" required></td>
							</tr>
						</table>';
						echo '<br><br>';
						echo '<input type="submit" name="historic_job_work_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['historic_job_work_submit']))
						{
							$jw_actual_date = $_POST['jw_actual_date'];
							$jw_actual_date1 = $_POST['jw_actual_date1'];
							$query = "SELECT * from ext_job_work where date_format(jw_actual_date, '%Y-%m-%d')>='$jw_actual_date' AND date_format(jw_actual_date, '%Y-%m-%d')<='$jw_actual_date1' and jw_actual_date!='0000-00-00' ORDER BY jw_actual_date ASC ";
							$raw_mat_query = mysqli_query($connection,$query);
						?>
							
						
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>Good Name</th>
									<th>Expected quantity</th>
									<th>Actual quantity</th>
                                    <th>Submit date</th>
									<th>Actual date</th>
                                    <th>Total amount </th> 
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								
								$jw_good_name = $row['jw_good_name'];
								$jw_exp_qnty = $row['jw_exp_qnty'];
								$jw_act_qnty = $row['jw_act_qnty'];
								$jw_submit_date=$row['jw_submit_date'];
								$timestamp = strtotime($jw_submit_date); 
								$new_date = date("d-m-Y", $timestamp);
								$jw_actual_date=$row['jw_actual_date'];
								$timestamp1 = strtotime($jw_actual_date); 
								$new_date1 = date("d-m-Y", $timestamp1);
								$jw_tot_amt = $row['jw_tot_amt'];

								echo "<tr align='center'>";
								echo "<td>$jw_good_name</td>";
								echo "<td>$jw_exp_qnty</td>";
								echo "<td>$jw_act_qnty</td>";
								echo "<td>$new_date</td>";
								echo "<td>$new_date1</td>";
								echo "<td>$jw_tot_amt</td>";
								echo "</tr>";
							}
							echo '</tbody>';
                        	echo '</table>';
						}  
									
						break;
						
						
						
					case 'Worker':
						//global $connection;
						echo '<br><br>';
						echo '<select name="worker_name" id="worker_name" class="form-control" style="width: 400px; height: 45px;">';
						echo '<option value="0">Select Worker</option>';
						$query = "SELECT DISTINCT ew_id, ew_name FROM ext_worker,ext_job_work where ext_worker.ew_id=ext_job_work.jw_worker_id and not ext_worker.ew_status = 'Deleted'";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$ew_id = $row['ew_id'];
							$ew_name1 = $row['ew_name'];

							echo "<option value=$ew_id>$ew_name1</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="ew_name_submit" class="btn btn-primary btn-lg" value="Submit">';
						
						if(isset($_POST['ew_name_submit']))
						{
							//echo $_POST['worker_name'];
							$ew_name = $_POST['worker_name'];
							//echo $igs_name;
							$query = "select DISTINCT * from ext_job_work,ext_worker where ext_worker.ew_id=ext_job_work.jw_worker_id AND jw_worker_id={$ew_name} AND ext_job_work.jw_actual_date!='0000-00-00' ORDER BY ext_job_work.jw_id";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th>Good Name</th>
									<th>Expected Quantity</th>
									<th>Actual quantity</th>
                                    <th>Submit date</th>
                                    <th>Actual date</th>        <th>Total amount</th>                 
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								//$selectquery = mysqli_query($connection,"select DISTINCT jw_good_name,jw_submit_date,jw_id,jw_exp_qnty,jw_act_qnty,jw_actual_date,jw_tot_amt from ext_job_work,ext_worker where ext_worker.ew_id=ext_job_work.jw_worker_id AND jw_worker_id ={$ew_name} GROUP BY jw_id ORDER BY jw_id");
								//while($rows = mysqli_fetch_assoc($selectquery)){
								$jw_good_name = $row['jw_good_name'];
								$jw_exp_qnty= $row['jw_exp_qnty'];
								$jw_act_qnty = $row['jw_act_qnty'];
								$jw_submit_date = $row['jw_submit_date'];
								$t=strtotime($jw_submit_date);
								$d=date("d-m-Y",$t);
								$jw_actual_date = $row['jw_actual_date'];
								$t1=strtotime($jw_actual_date);
								$d1=date("d-m-Y",$t1);
								$jw_tot_amt = $row['jw_tot_amt'];
								
								echo "<tr>";
								echo "<td align='center'>$jw_good_name</td>";
								echo "<td align='center'>$jw_exp_qnty</td>";
								echo "<td align='center'>$jw_act_qnty</td>";
								echo "<td align='center'>$d</td>";
								echo "<td align='center'>$d1</td>";          
								echo "<td align='center'>$jw_tot_amt</td>";					
						?>
							<?php
								echo "</tr>";
							//}
							}
							echo '</tbody>';
                        	echo '</table>';
						}
						
						break;
					default: break;
				}

			?>
		</form>
	</div>
	</DIV>
</div>
</body>
</html>
