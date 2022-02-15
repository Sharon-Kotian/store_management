<?php
	include("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$ew_name=$_POST['ew_name'];
		$ew_ph_no=$_POST['ew_ph_no'];
		$ew_aadhar_no=$_POST['ew_aadhar_no'];
		$ew_address=$_POST['ew_address'];
		$ew_emer_cont_name=$_POST['ew_emer_cont_name'];
		$ew_emer_cont_no=$_POST['ew_emer_cont_no'];

		$name=$_FILES['ew_aadhar_front_img']['name'];
		$name1=$_FILES['ew_aadhar_back_img']['name'];
		$target_dir="uploads/";
		$target_file=$target_dir.basename($_FILES["ew_aadhar_front_img"]["name"]);
		$target_file1=$target_dir.basename($_FILES["ew_aadhar_back_img"]["name"]);
		$imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$imageFileType1=strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
		$extension_arr=array("jpg","jpeg","png","gif", "pdf");
		if(in_array($imageFileType, $extension_arr)){
			$image_base64=base64_encode(file_get_contents($_FILES["ew_aadhar_front_img"]["tmp_name"]));
			$image='data:image/'.$imageFileType.';base64,'.$image_base64;
		}

		if(in_array($imageFileType1, $extension_arr)){
			$image1_base64=base64_encode(file_get_contents($_FILES["ew_aadhar_back_img"]["tmp_name"]));
			$image1='data:image/'.$imageFileType1.';base64,'.$image1_base64;
		}

		$ew_aadhar_front_img=getimagesize($_FILES["ew_aadhar_front_img"]["tmp_name"]);
		$ew_aadhar_back_img=getimagesize($_FILES["ew_aadhar_back_img"]["tmp_name"]);

	
		
		$rs=mysqli_query($connection, "SELECT * from ext_worker WHERE ew_aadhar_no='$ew_aadhar_no'");		
		if(mysqli_num_rows($rs)>0){
			echo '<script type="text/javascript"> alert("Worker already exists.");
			window.location.replace("CreateJobworkerprofile.php")</script>';
		}
		else{
			$insert_query=mysqli_query($connection, "INSERT into ext_worker (ew_name, ew_ph_no, ew_aadhar_no, ew_aadhar_front_img, ew_aadhar_back_img, ew_address, ew_emer_cont_name, ew_emer_cont_no, ew_status) VALUES('$ew_name','$ew_ph_no','$ew_aadhar_no','".$image."','".$image1."','$ew_address','$ew_emer_cont_name','$ew_emer_cont_no','')");
			if($insert_query){
				move_uploaded_file($_FILES['ew_aadhar_front_img']['tmp_name'],$target_dir.$name);
				move_uploaded_file($_FILES['ew_aadhar_back_img']['tmp_name'],$target_dir.$name1);
				echo '<script type="text/javascript">alert("Worker Added Successfully.");
				window.location.replace("CreateJobworkerprofile.php")</script>';
			}
			else{
			echo "Error" .mysqli_error($connection);
			}
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

	<title>Create Job worker profile</title>
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
		
	</script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	<h1 class="display-3" align="center">Create Job worker profile</h1>
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
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form name="form1" method="POST" action="" enctype="multipart/form-data">
		<table style="width:60%" id="formContent" align="center">
			  
			<tr>
				<td align="left" class="form-label">Name: </td> 
				<td align="left"><input type="text" id="ew_name" class="form-control" name="ew_name">
				</td>
			</tr>
			</tr>
			
			<tr>
			<td align="left" class="form-label"><br><br>Phone Number: </td> 
				<td align="left"><br><br><input type="number" id="ew_ph_no" class="form-control" name="ew_ph_no">
				</td>
			</tr>

			<tr>
				<td align="left" class="form-label"><br><br>Aadhar Number : </td>
				<td align="left"><br><br><input type="number" id="ew_aadhar_no" class="form-control" name="ew_aadhar_no"></td>
				<br><br>
			</tr>
		
			<tr>
				<td align="left" class="form-label"><br><br>Address: </td>
				<td align="left"><br><br><textarea id="ew_address" class="form-control" name="ew_address" rows="7" cols="50"> </textarea>
				</td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Emergency Contact Person Name: </td>
				<td align="left"><br><br><input type="text" id="ew_emer_cont_name" class="form-control" name="ew_emer_cont_name"></td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Emergency Contact Number: </td>
				<td align="left"><br><br><input type="number" id="ew_emer_cont_no" class="form-control" name="ew_emer_cont_no"></td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Aadhar Photo Front: </td>
				<td align="center"><br><br><input type="file" name="ew_aadhar_front_img" id="ew_aadhar_front_img" class="form-control">
			</td>
			</tr>			
			<tr>
				<td align="left" class="form-label"><br><br>Aadhar Photo Back: </td>
				<td align="center">
				<form action="/action_page.php"><br><br>
					<input type="file" name="ew_aadhar_back_img" id="ew_aadhar_back_img" class="form-control">
				</form>
			</td>
			</tr>
		</table>
			<br><br>
			<p align="center"> <input type="submit" name="submit" class="btn btn-primary btn-lg" value=" Create " data-bs-toggle="modal" data-bs-target="#exampleModal"></p>
		</form>
	</div>
</div>
</body>
</html>

<?php mysqli_close($connection); ?>
