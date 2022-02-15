<?php 
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'admin_dept'){
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

	<title>View Factories</title>
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
	<h1 class="display-3" align="center">View Factories</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateCredentialsOfUser.php'">
					Update Credentials Of User
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateMasterPassword.php'">
					Update Master password
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='company_info.php'">
				Manage Company Information
				</button>
				
			</div>
		  </div>
</div>
	
	<div class="row" align="center">
		<center><button type="button" class="btn btn-primary" onClick="parent.location='factory_add.php'" style="width: 200px;">Add new Factory</button></center>
		<form method="post">
						<center><table class="table table-bordered table-hover" style="width:60%">
							<thead>
                                <tr>
                                    <th style="width:200px">Factory Name</th>
                                    <th style="width:300px">Factory Address</th> 
									<th style="width:30px">Edit</th>
                                    <th style="width:30px">Delete</th>
                                </tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
                            $query = "SELECT * FROM factory_details";
							$raw_mat_query = mysqli_query($connection,$query);
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								

									
                                $name=$row['factory_name'];    
								$addr = $row['factory_address'];
								
							
								echo "<tr>";
                                echo "<td>$name</td>";
								echo "<td>$addr</td>";
								
 
							echo "<td><a onClick=\"javascript: return confirm('Confirm your edit for the Factory = $name?');\"  href='factory_update.php?name=".$row['factory_name']."'  role='button' class='btn btn-outline-warning btn-lg' aria-pressed='true'>Edit</a></td>";
							echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete the Factory = $name?');\"  href='factory_delete.php?name=".$row['factory_name']."' class='btn btn-outline-danger btn-lg'  role='button' aria-pressed='true'>Delete</a></td>";		
							
								echo "</tr>";
							}
							
							echo '</tbody>';
                        	echo '</table></center>';
						?>
						
						
		</form>
	</div>
	</DIV>
</div>
</body>
</html>
