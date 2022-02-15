<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
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

	<title>Search Caret ID</title>
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
		$(document).ready(function(){
			$("#caret_id").select2();
		});
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
	<h1 class="display-3" align="center">Search Caret ID</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateOpeningStock.php'">
				Update opening stock
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PrintQuantityVerification.php'">
				Print For Verification
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='VerificationReport.php'">
				Verification report
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Allocate Caret ID
				</button>
			</div>
		</div>
	</div>
	
	<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><a class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" href="RawMaterialInformation_caret.php">Caret ID wise</a>
			<a class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" href="SearchCaretId_RawMaterial.php">Raw material wise</a></p>
	</div>
	<br><br>
	<div id="frmContent">
		<p align="center"><a class="btn btn-outline-primary btn-sm" style="width: 200px; height: 35px;" href="RawMaterialInformation_All.php">Display All</a>
			<a class="btn btn-outline-primary btn-sm" style="width: 200px; height: 35px;" href="RawMaterialInformation_Selected.php">Display Selected</a></p>
	</div>
	
  <div id="formContent">
  <form name="frm" method="post">
  <br><br><br>
	<table align="center" style='width:30%'>
		<tbody id="table">
		<tr style="font-size:20px">
			<td class="fadeIn fourth" style="width: 400px; height: 50px;" align="center"><b>Caret ID :</b></td>
			<td align="center"><select multiple name="caret_id[]" id="caret_id" style="width: 300px; height: 45px;" class="form-select select2-hidden-accessible" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true" required>
				<?php 
					$records=mysqli_query($connection,"SELECT distinct rm_caret_id from raw_materials");
					while($data=mysqli_fetch_array($records)){
						echo "<option value='".$data['rm_caret_id']."'>".$data['rm_caret_id']."</option>";
					}
				?>
			</select>
			</td>
		</tr>
		</tbody>
	</table><br><br>
	<p align="center">
			<?php echo "<input type='submit' id='display_selected' value='Display Carets' class='btn btn-primary btn-lg' style='width: 200px; height: 45px;' name='display_selected'>";
			?></p>
	<br><br>
	<table border="1px" align="center" class="table table-bordered" style='width:70%'>
		
		<?php
		if(isset($_POST['display_selected'])){
			$caret_id=$_POST['caret_id'];
			$count=count($_POST['caret_id']);
			$query = "SELECT * from raw_materials where ";
			for($i=0;$i<$count;$i++){
				if($i == 0){
					$query .= "rm_caret_id='". $caret_id[$i]."'";
				}
				else{
					$query .= " OR rm_caret_id='". $caret_id[$i]."'";
				}
			}
			$final_record=mysqli_query($connection, $query);
			echo '<tr style="font-size:28px">';
			echo '<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="caret_id" name="caret_id" align="center"><b>Caret ID</b></td>';
			echo '<td class="fadeIn fourth" style="width: 400px; height: 50px;" id="caret_material_name" name="caret_material_name" align="center"><b>Caret Material</b></td>';
			echo '</tr>';
			while($row=mysqli_fetch_array($final_record)){?>
				<tr style="font-size:22px">
					<td align="center"><?php echo $row['rm_caret_id']; ?></td>
					<td align="center"><?php echo $row['rm_name']; ?></td>
				</tr>
				<?php
			}
		}
			mysqli_close($connection);
		?>
	</table> 
	</form>
  </div>
</div>
<br><br>
</body>
</html>
