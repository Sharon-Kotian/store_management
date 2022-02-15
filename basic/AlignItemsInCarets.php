<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	if(isset($_POST['submit'])){
		$caret_id=$_POST['caret_id'];
		$caret_material_name=$_POST['caret_material_name'];
		$caret_quantity=$_POST['caret_quantity'];

		$caret_id=mysqli_real_escape_string($connection,$caret_id);
		$caret_material_name=mysqli_real_escape_string($connection,$caret_material_name);
		$caret_quantity=mysqli_real_escape_string($connection,$caret_quantity);

		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_material_name='$caret_material_name' WHERE caret_id='$caret_id'");
		$insert_query=mysqli_query($connection, "UPDATE store_caret SET caret_quantity='$caret_quantity' WHERE caret_id='$caret_id'");
		
		if($insert_query){
			echo '<script type="text/javascript">alert("Caret Updated Successfully.");
			window.location.replace("AlignItemsInCarets.php")</script>';
		}
		else{
			echo "Error" .mysqli_error($connection);
		}
		mysqli_close($connection);
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

	<title>Allocate Caret Id</title>
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
	<script src="JS/PlacePurchaseOrderLink3.js"></script>
	<SCRIPT>
	$(document).ready(function(){
		$("#caret_id").select2();
		$('#but_read').click(function(){
		var username = $('#caret_id option:selected').text();
		var userid = $('#caret_id').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function(){
		$("#caret_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#caret_material_name option:selected').text();
		var userid = $('#caret_material_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});

	</SCRIPT>
	<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 			
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
	<h1 class="display-3" align="center">Allocate Caret Id</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Search Caret ID
				</button>
			</div>
		</div>
</div>

<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="All Carets" ONCLICK="parent.location='AlignItemsInCarets.php'" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw Material Wise " ONCLICK="parent.location='AllocateCaretId_RawMaterialWise.php'" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Finished Product Wise " ONCLICK="parent.location='AllocateCaretId_ProductWise.php'" style="width: 300px; height: 45px;"></p>	
	</div>
	
	<DIV ID="ProductName">
	<form name="frm" method="post">	<br><br>
		<table class="table table-bordered" style="width:80%" align="center">
			<thead>
				<tr>
					<th style="text-align: center">Sr No.</th>
					<th style="text-align: center">Name of Raw Material</th>
					<th style="text-align: center">Caret Id</th>
					<th style="text-align: center">Naration</th>
				</tr>
			</thead>
			<tbody>
			<?php
					$str_query="SELECT * from raw_materials";
					$final_record=mysqli_query($connection, $str_query);
					$sr_no=1;
					while ($row=mysqli_fetch_array($final_record)){
						$rm_name = $row['rm_name'];
						$rm_caret_id= $row['rm_caret_id'];
						/*if($row['caret_material_name']!=$_POST['rm_name']){
							echo '<script type="text/javascript">alert("Raw Material is absent in caret.")';
						}*/
						
						
						echo "<tr>";
						echo "<td style='text-align: center'>$sr_no</td>";?>
						<td align='center'><input type="text" id="rm_name_table" class="form-control" name="rm_name_table[]" style="width: 250px; height: 40px; text-align: center" value="<?php echo $rm_name; ?>" readonly></td>
						
						<td align='center'><select name="caret_id_update[]" id="caret_id_update" style="width: 200px; height: 45px;" class="form-select">
						<option value=''>Select caret</option>
						<?php 
							$selected_id = 0;
							$selected_material = '';
							$records=mysqli_query($connection,"SELECT rm_caret_id,rm_name from raw_materials");
							$carets = mysqli_query($connection,"SELECT caret_id from store_caret");
							while($data=mysqli_fetch_array($records)){
								$material_names = "<?php echo $rm_name; ?>";
								$rm_caret_id = $row['rm_caret_id'];
								$rm_name_update = $row['rm_name'];
								while($caret_array = mysqli_fetch_array($carets)){
									if($rm_caret_id == $caret_array['caret_id'] && $selected_id == 0){
										echo "<option value='".$caret_array['caret_id']."' selected>".$caret_array['caret_id']."</option>";
										$selected_id = $rm_caret_id;
										$selected_material = $rm_name_update;
									}
									else{
										if ($data['rm_caret_id'] == NULL or $data['rm_caret_id'] == ""){
											//do nothing
										}
										else{
											echo "<option value='".$caret_array['caret_id']."'>".$caret_array['caret_id']."</option>";
										}
									}
								}
							}
						?>
						</select>
						</td>
						
						<td align='center'><input type="text" id="caret_narration" class="form-control" name="caret_narration[]" style="width: 350px; height: 40px; text-align: center"></td>	
						<?php
						$sr_no=$sr_no+1;
					}
					
					echo '</tbody>';
                    echo '</table>';
					echo '<br><center><input type="submit" value="Update Caret" class="btn btn-primary btn-lg" style="width: 150px; height: 45px; display: flex; justify-content: center; align-items: center;" name="update_caret"></center>';
				
					if(isset($_POST['update_caret'])){
						$rm_name_update = $_POST['rm_name_table'];
						$caret_id_update = $_POST['caret_id_update'];
						$caret_narration_update = $_POST['caret_narration'];
						
						foreach ($rm_name_update as $index => $names) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_caret_id='$caret_id_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
							
							if($caret_narration_update[$index] != ""){
								$update_caret_narration= mysqli_query($connection, "UPDATE store_caret SET caret_narration='$caret_narration_update[$index]' WHERE caret_id='$caret_id_update[$index]'");
							}
							else{
								$update_caret_narration = true;
							}
						}
						
						if($update_query && $update_caret_narration){
							echo '<script type="text/javascript">alert("Caret Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Caret Not Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}
					}								
			?>		
	</form>
	</DIV>
</div>
</body>
</html>
