<?php 
	include_once("includes/header.php");
	global $connections;
	if($_SESSION['user_dept'] != 'accounts_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}
		if(isset($_POST['add'])){
			$rm_name1=$_POST['rm_name'];

			$rm_name1=mysqli_real_escape_string($connection,$rm_name1);

			$rs=mysqli_query($connection, "SELECT * from raw_materials WHERE rm_name='$rm_name1'");

			if(mysqli_num_rows($rs)>0){
				echo '<script type="text/javascript"> alert("Raw Material already exits.");
				window.location.replace("ManageRawMaterials.php")</script>';
			}
			else{
				$insert_query=mysqli_query($connection, "INSERT into raw_materials (rm_id,rm_name, rm_counting_quantity, rm_qc_quantity, rm_stores_quantity, rm_rework_quantity, rm_jobwork_quantity, rm_rate, rm_unit, rm_status, rm_reorder_level) VALUES('','$rm_name1','','','','','','','','','')");
				if($insert_query){
					echo '<script type="text/javascript">alert("Raw Material Inserted Successfully.");
					window.location.replace("ManageRawMaterials.php")</script>';
				}
				else
					echo "Error" .mysqli_error($connection);
			}

			mysqli_close($connection);
		};

		if(isset($_POST['delete'])){
			$rm_name=$_POST['rm_name'];
			if($rm_name==''){
				echo "<script>alert('Raw Material Name is empty.');
				window.location.replace('ManageRawMaterials.php')</script>";
			}else{
				$query=mysqli_query($connection, "DELETE FROM raw_materials WHERE rm_name='$rm_name' ");
			}
			if($query){
				echo '<script type="text/javascript">alert("Raw Material Deleted Successfully.");
				window.location.replace("ManageRawMaterials.php")</script>';
			
			}
			else
				echo "Error" .mysqli_error($connection);
			mysqli_close($connection);
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

	<title>Manage Raw Material</title>
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
		$("#rm_name1").select2();
		$('#but_read').click(function(){
		var username = $('#rm_name1 option:selected').text();
		var userid = $('#rm_name1').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
function ShowProduct() {
    var x = document.getElementById('SectionName');
	var y = document.getElementById('ProductName');
    if (x.style.display == 'none') {
        y.style.display = 'block';
    } else {
        x.style.display = 'none';
		y.style.display = 'block';
    }
}

function ShowRowMaterial() {
    var y = document.getElementById('ProductName');
	var x = document.getElementById('SectionName');
    if (y.style.display == 'none') {
        x.style.display = 'block';
    } else {
        y.style.display = 'none';
		x.style.display = 'block';
    }
}

	
function myfunctionProduct() {
  var tablewrap=document.getElementById('ProductTable'); 
	if(tablewrap.style.display==="none"){
		tablewrap.style.display="block"
	}
	else{
		tablewrap.style.display="none"
	}
};

</SCRIPT>
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
	<h1 class="display-3" align="center">Manage Raw Material</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Production report.php'">
					Production Report
			</button><br><br>
		  	<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Countingreport.php'">
					Counting Report
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='QualityCheckReport1.php'">
					Quality Check Report
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PayToJobWork.php'">
					Pay To Job Work
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageRawMaterials.php'">
					Manage Raw Materials
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageFinishedProducts.php'">
					Manage Finished Products
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='New Supplier Details.php'">
					New Supplier Details
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPOs.php'">
					View POs
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='DeletedPOs.php'">
					Deleted POs
			</button><br><br>
			<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewInvoices.php'">
					View Invoices
			</button><br><br>
            <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='supp_workers.php'">
					Manage Supplier
			</button>
			</div>
		  </div>
</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="  Add Raw Material  " ONCLICK="ShowRowMaterial()">
			<input type="button" class="btn btn-primary btn-lg" value=" Delete Raw Material " ONCLICK="ShowProduct()"></p>
	
	</div>
	<DIV ID="SectionName" STYLE="display:none">
		<form name="frm" action="ManageRawMaterials.php" method="post">
			<table style="width:100%" align="center">
				<tr>
					<td align="center" class="form-label"><br><br>Enter Raw Material Name: </td>
					<td align="left" style="width:40%"><br><br><input type="text" id="rm_name" name="rm_name" style="text-align: center;width: 400px; height: 45px;" class="form-control" required></td>
					<td align="left" style="width:20%"><br><br>
						<?php echo "<input type='submit' id= 'clickme' value=' Add ' class='btn btn-primary btn-lg' name='add' onClick=\"javascript: return confirm('Do you want to add the Raw Material?');\">";?>
				</tr>
			</table>
		</form>
	</DIV>

	<DIV ID="ProductName" STYLE="display:none">
		<form name="frm1" action="" method="post">
		<table style="width:100%" align="center">
			<tr>
				<td align="center" class="form-label"><br><br>Select Raw Material Name: </td>
				<td align="left" style="width:40%"><br><br><select name="rm_name" id="rm_name1" style="width: 400px; height: 45px;" class="form-select">
					<?php 
						$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
						}
					?>
					</select>
				</td>
				<td align="left" style="width:20%"><br><br>
					<?php echo "<input type='submit' id='clickme' value= 'Delete' class='btn btn-primary btn-lg' name='delete' onClick=\"javascript: return confirm('Are you sure to delete the Raw Material?');\">";?>
			</tr>
		</table>
		</form>		
	</DIV>
</div>
</body>
</html>
