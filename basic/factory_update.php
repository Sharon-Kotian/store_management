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

	if(isset($_POST['print_data']))
	{
		echo "<br>";
		$n1= $_POST['name1'];    
		$a1 = $_POST['addr'];
		$name=$_GET['name'];
        
		
		$update_query=mysqli_query($connection, "UPDATE factory_details SET factory_name='$n1', factory_address='$a1' WHERE factory_name='$name'");
        if($update_query){
            echo '<script>alert("Factory Details Updated Successfully");
            window.location.replace("view_factory.php")</script>';
        }
        else{
            echo "Error.".mysqli_error($connection);
            echo '<script>window.location.replace("view_factory.php")</script>';
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

	<title>Update Factory Details</title>
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
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	
	<script type="text/javascript">
		

	</script>

</head>
<body class="bg-light text-dark">
<header>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Update Factory Details</h1>
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
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 80px;" onClick="parent.location='view_factory.php'">
				View Factories
				</button>
			</div>
		  </div>
</div>

	
	<div class="wrapper fadeInDown">
		<div id="formContent" align="center">
		<br><br><br>
		<form method="post">
		<table style="width:60%" id="formContent" align="center">
			<?php 
			 	$name=$_GET['name'];
				$query=mysqli_query($connection, "SELECT * FROM factory_details WHERE factory_name='$name'");
				$row=mysqli_fetch_array($query);
				if($count=mysqli_num_rows($query))
                {
					$n=$row['factory_name'];    
					$addr = $row['factory_address'];                   
			?> 
			
			<tr>
			<td align="left" class="form-label" width="50%"><br><br>Factory Name: </td> 
				<td align="left" width="50%"><br><br><input type="text" id="name1" class="form-control" style='width:500px;' name="name1" value="<?php echo $n; ?>" required>
				</td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Factory Address: </td>
				<td align="left"><br><br><textarea rows=6 cols=12 name='addr' id='addr' class='form-control' style='width:500px; height:150px;'><?php echo $addr; ?></textarea>
				
			</tr>
			<?php } ?>			
			</table></center><br><br>
			  <p align="center"><a href=""><input type="submit" class="btn btn-primary btn-lg" value="Save" name="print_data"></a>
			  <br><br>
		</form>
	</div>
</body>
</html>

