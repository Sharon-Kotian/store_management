<?php 
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
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

	<title>Manage Job Workers</title>
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
	<h1 class="display-3" align="center">Manage Job Workers</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>

				<hr>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Jobwork Out(Issue Material)
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Jobwork In(Accept Material) 
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_work_receivable.php'">
					Jobwork Receivable
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Data
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Manage intermediate goods.php'">
				Manage Intermediate Goods
				</button>
				
			</div>
		  </div>
</div>
	
	<div class="row" align="center">
		<center><button type="button" class="btn btn-primary" onClick="parent.location='CreateJobworkerprofile.php'" style="width: 200px;">Add new job worker</button></center>
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

				
					?>
						<table class="table table-bordered table-hover" style="width:80%">
							<thead>
                                <tr>
                                    <th>Job Worker ID</th>
                                    <th>Name</th>
									<th>Phone Number</th>
									<th>Address</th>
                                    <th>Emergency Contact Name</th>
                                    <th>Emergency Contact Number</th>  
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>Blacklist</th>
                                    
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
                            $query = "SELECT * FROM ext_worker where ew_status != 'Deleted'";
							$raw_mat_query = mysqli_query($connection,$query);
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								

									
                                $ew_id=$row['ew_id'];    
								$ew_name = $row['ew_name'];
								$ew_ph_no = $row['ew_ph_no'];
								$ew_address = $row['ew_address'];
								$ew_emer_cont_name = $row['ew_emer_cont_name'];
                                $ew_emer_cont_no = $row['ew_emer_cont_no'];
                                $ew_status=$row['ew_status'];
								
								if($ew_status=='Blacklist')
								{
									echo "<tr class='text-danger'>";
								}

								else
								{
									echo "<tr>";
								}
                                echo "<td>$ew_id</td>";
								echo "<td>$ew_name</td>";
								echo "<td>$ew_ph_no</td>";
								echo "<td>$ew_address</td>";
								echo "<td>$ew_emer_cont_name</td>";
                                echo "<td>$ew_emer_cont_no</td>";
 
							echo "<td><a onClick=\"javascript: return confirm('Confirm your edit for the Job Worker = $ew_id?');\"  href='jw_Update.php?id=".$row['ew_id']."'  role='button' class='btn btn-outline-warning btn-lg' aria-pressed='true'>Edit</a></td>";
							echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete the Job Worker = $ew_id?');\"  href='jw_Recycle.php?id=".$row['ew_id']."' class='btn btn-outline-danger btn-lg'  role='button' aria-pressed='true'>Delete</a></td>";
							if($ew_status=='Blacklist')
							{
								echo "<td><a onClick=\"javascript: return confirm('Are you sure to whitelist the Job Worker = $ew_id?');\" href='jw_Status1.php?id=".$row['ew_id']."' onclick='change()' id='myButton2' value='Whitelist'  class='btn btn-outline-success btn-lg'  role='button'  aria-pressed='true'>Whitelist</a></td>";
								
							}
							else
							{
								echo "<td><a onClick=\"javascript: return confirm('Are you sure to blacklist the Job Worker = $ew_id?');\" href='jw_Status.php?id=".$row['ew_id']."' onclick='change()' id='myButton1' value='Blacklist'  class='btn btn-outline-warning btn-lg'  role='button'  aria-pressed='true'>Blacklist</a></td>";
							}
							
							
								echo "</tr>";
							}
							
							echo '</tbody>';
                        	echo '</table>';
						?>
						
						
		</form>
	</div>
	</DIV>
</div>
</body>
</html>
