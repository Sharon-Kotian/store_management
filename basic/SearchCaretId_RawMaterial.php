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
	<SCRIPT>
	$(document).ready(function(){
		$("#rm_name").select2();
	});


function text(x)
{
	if(x==0) 
	{
		document.getElementById("rr_req_date").style.display="none";
		document.getElementById("require_date").style.display="none";
		
	}
	else 
	{
		document.getElementById("require_date").style.display="block";
		document.getElementById("rr_req_date").style.display="block";
    	return;
	}
}

</SCRIPT>
</head>
<body class="bg-light text-dark">
<header>
	<?php 
   // include "../includes/header.php";
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
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="Caret ID Wise" ONCLICK="parent.location='RawMaterialInformation_caret.php'" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw Material Wise " ONCLICK="parent.location='SearchCaretId_RawMaterial.php'" style="width: 300px; height: 45px;"></p>
	
	</div>
	
	<DIV ID="ProductName">
	<form name="frm" method="post">
		<table style="width:50%" id="tableContent" align="center">
			<tbody id="table">
				<tr align="center">									
				<td align="center" class="form-label"><br><br><br><br>Raw Material Name: </td>
				<td align="center"><br><br><br><br><select multiple name="rm_name[]" id="rm_name" style="width: 300px; height: 45px;" class="form-select select2-hidden-accessible" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true" required>
				<?php 
					$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
					while($data=mysqli_fetch_array($records)){
						echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
					}
				?>
			</select>
				</td>
			</tr>	
			</tbody>
		</table>
		
		<p align="center"><br>
			<?php echo "<input type='submit' id='clickme' value='Display' class='btn btn-primary btn-lg' style='width: 150px; height: 45px;' name='delete'>"; 
			
				if(isset($_POST['delete'])){
					$rm_name=$_POST['rm_name'];
					$count=count($rm_name);
					$str_query = "SELECT * from raw_materials where ";
					for($i=0;$i<$count;$i++){
						if($i == 0){
							$str_query .= "rm_name='". $_POST['rm_name'][$i]."'";
						}
						else{
							$str_query .= " OR rm_name='". $_POST['rm_name'][$i]."'";
						}
					}	
					$final_record=mysqli_query($connection, $str_query);
					?>
					<br><table class="table table-bordered table-hover m-5" style="width:80%">
						<thead>
							<tr>
								<th style="text-align: center">Sr No.</th>
								<th style="text-align: center">Name of Raw Material</th>
								<th style="text-align: center">Caret Id</th>
							</tr>
						</thead>
						<tbody>
					<?php
					$sr_no=1;
					while ($row = mysqli_fetch_assoc($final_record)){
						$rm_name = $row['rm_name'];
						/*if($row['rm_name']!=$_POST['rm_name']){
							echo '<script type="text/javascript">alert("Raw Material is absent in caret.")';
						}*/
						$caret_query=mysqli_query($connection,"select * from raw_materials where rm_name='$rm_name'");
						$count=mysqli_num_rows($caret_query);
						while($id=mysqli_fetch_array($caret_query)){
							$rm_caret_id=$id['rm_caret_id'];
						}	
						
						//echo '<br><br>';	
						echo "<tr>";
						echo "<td style='text-align: center'>$sr_no</td>";
						echo "<td style='text-align: center'>$rm_name</td>";
						
						if($count==0){
							echo "<td style='text-align: center'>NA</td>";
							
						}else{	
							echo "<td style='text-align: center'>$rm_caret_id</td>";
						}
						$sr_no=$sr_no+1;
					}
					echo '</tbody>';
                    echo '</table>';
				};				
			?></p>
	</form>
	</DIV>
</div>
</body>
</html>
<?php mysqli_close($connection); ?>
