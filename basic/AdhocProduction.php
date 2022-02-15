<?php 
	include_once ("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	if(isset($_POST['add'])){
		
		$_SESSION['mat_name']=$_POST['rr_material_name'];
		$_SESSION['mat_qnty']=$_POST['rr_material_quantity'];
		$_SESSION['body_colour']=$_POST['rr_body_colour'];
		$rr_req_immediate=$_POST['rr_req_immediate'];
		if($rr_req_immediate=="Yes")
		{
			$rr_req_date=date("Y-m-d"); 
		}
		else
		{
			$rr_req_date=$_POST['rr_req_date']; 
		}
		$_SESSION['req_date']=$_POST['rr_req_date'];
		echo $_SESSION['req_date'];
		if(TRUE)
		{	
			echo '<script>window.location.replace("raiseRequisition_FinishedProduct.php")</script>';
		}
		
		
		
	};

	if(isset($_POST['delete'])){
		$rr_material_name_material=$_POST['rr_material_name_material'];
		$rr_body_colour_material=$_POST['rr_body_colour_material'];
		$rr_material_quantity_material=$_POST['rr_material_quantity_material'];
		$rr_req_date_material=$_POST['rr_req_date_material'];
		
		foreach ($rr_material_name_material as $index => $names) {	
				echo $names;
				$query="INSERT into raise_requisition (rr_material_name, rr_body_colour, rr_material_quantity, rr_req_date, rr_remaining_quantity, rr_status) VALUES ('$names','$rr_body_colour_material[$index]','$rr_material_quantity_material[$index]','$rr_req_date_material[$index]', '$rr_material_quantity_material[$index]', 'Raw Material Estimated')";
				$insert_query=mysqli_query($connection, $query);
				if($insert_query){
					echo '<script>alert("Requisition has been raised.");
					window.location.replace("AdhocProduction.php")</script>';
				}
				else{
					echo "Error" .mysqli_error($connection);
					echo '<script>window.location.replace("AdhocProduction.php")</script>';
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

	<title>Raise Requisition</title>
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
		$("#rr_body_colour").select2();
		$("#rr_material_name").select2();
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
	<h1 class="display-3" align="center">Raise requisition</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial.php'">
					Accept Raw Material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Add Production Estimation.php'">
					Add Production Estimation
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Returnfaultymaterial.php'">
					Return Faulty Material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Submit finished goods.php'">
					Submit Finished Goods
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='Acceptrawmaterial1.php'">
					Input Expected Output
				  </button>
			</div>
		  </div>
	</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="Finished Product Wise" ONCLICK="ShowRowMaterial()" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw Material Wise " ONCLICK="ShowProduct()" style="width: 300px; height: 45px;"></p>
	
	</div>
	<DIV ID="SectionName" STYLE="display:none">
	<form name="frm" method="post">
		<table style="width:80%" id="formContent" align="center">	
			<tbody><tr align="center">									
				<td align="center" class="form-label"><br><br>Finished Product Name: </td>
				<td align="center"><br><br><select name="rr_material_name" id="rr_material_name" style="width: 300px; height: 45px;" class="form-select select2-hidden-accessible" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true">
				<?php 
					$records=mysqli_query($connection,"SELECT fps_name from finished_product_summary ");
					while($data=mysqli_fetch_array($records)){
						echo "<option value='".$data['fps_name']."'>".$data['fps_name']."</option>";
					}
				?>
			</select>
				</td>
			</tr>
			<tr align="center">					
				<td align="center" class="form-label"><br><br>Select Color of Product Body: </td>
				<td align="center"><br><br><select name="rr_body_colour" id="rr_body_colour" style="width: 300px; height: 45px;" data-select2-id="select2-data-color" tabindex="-1" class="select2-hidden-accessible" aria-hidden="true">
					<option value="NA">NA</option>
					<option value="Black">Black</option>
					<option value="Blue">Blue</option>
					<option value="Orange">Orange</option>
					<option value="Red">Red</option>
					<option value="White">White</option>
					<option value="Yellow">Yellow</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Enter Quantity: </td>
				<td align="center"><br><br><input type="text" id="rr_material_quantity" class="form-control" value="" name="rr_material_quantity" style="width: 300px; height: 40px;" required></td>
			</tr>
			<tr>
				<td align="center" class="form-label"><br><br>Immediate: </td>
				<td align="center"><br><br>
				<input type="radio" id="rr_req_immediate"  value="Yes" name="rr_req_immediate" style="width: 150px; height: 20px;" onclick="text(0)" checked >Yes
				<input type="radio" id="rr_req_immediate"  value="No" name="rr_req_immediate" style="width: 150px; height: 20px;" required onclick="text(1)" >No
				</td>
			</tr>

			<tr>
				<td align="center" class="form-label" id="require_date" name="require_date" style="display:none"><br><br>Require Date: </td>
				<td align="center"><br><br><input type="date" id="rr_req_date" class="form-control" name="rr_req_date" style="width: 300px; height: 40px; display:none" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d", strtotime("+7days")); ?>"></td>
			</tr>

			
		</tbody></table>
		<p align="center"><br>
			<?php echo "<input type='submit' name='add' class='btn btn-primary btn-lg' value=' Raise ' id='myBtn' style='width: 150px; height: 45px;' align='center' onClick=\"javascript: return confirm('Do you want to raise requisition?');\">";?>
		</p>
	</form>
	</DIV>
	
	<DIV ID="ProductName" STYLE="display:none">
	<form name="frm" action="" method="post">
		<table style="width:90%" id="tableContent" align="center">
			<tbody id="table">
				<tr align="center" id="row">
					<td align="center" class="form-label" id="label_raw">Raw Material Required : </td>
							<td align="left">
								<datalist name="rr_material_name_material[]" id="rr_material_name_material" style="width: 220px; height: 40px;" required>
								<?php 
									$records=mysqli_query($connection,"SELECT rm_name from raw_materials");
									while($data=mysqli_fetch_array($records)){
										echo "<option value='".$data['rm_name']."'>".$data['rm_name']."</option>";
									}
								?>
								</datalist><input  autoComplete="on" list="rr_material_name_material" name="rr_material_name_material[]" /> 
								
							</td>
													
				<td align="center" class="form-label">Body Colour : </td>
				<td align="center"><select name="rr_body_colour_material[]" id="rr_body_colour_material" class="form-select" required>
					<option value="NA">NA</option>
					<option value="Black">Black</option>
					<option value="Blue">Blue</option>
					<option value="Orange">Orange</option>
					<option value="Red">Red</option>
					<option value="White">White</option>
					<option value="Yellow">Yellow</option>
				</select>
				</td>
					<td align="center" class="form-label" id="label_quantity"> Quantity :  </td>
					<td align="left"><input type="number" id="rr_material_quantity_material" class="form-control" name="rr_material_quantity_material[]"  style="width: 100px; height: 40px;" required></td>
					<td align="center" class="form-label" id="label_quantity"> Requirement Date:  </td>
					<td align="center"><input type="date" id="rr_req_date_material" class="form-control" name="rr_req_date_material[]" style="width: 150px; height: 40px;" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date("Y-m-d", strtotime("+7days")); ?>" required></td>
					
					<td><input type="button" class="btn btn-outline-primary" value="Add Row" id="button_add"  onclick="addField(this);" style="width: 110px; height: 40px;"/></td>
					<td><input type="button" class="btn btn-outline-warning" value="Delete Row" id="button_delete" onclick="deleteField(this);"/></td>

				</tr>
			</tbody>
		</table>
		
		<p align="center"><br><br><br>
			<?php echo "<input type='submit' id= 'clickme' value='Raise' class='btn btn-primary btn-lg' name='delete' onClick=\"javascript: return confirm('Do you want to raise requisition?');\">"; ?>		</p>
	</form>
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel" align="center">Confirm</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				  </div>
				  <div class="modal-body">
					<table>
						<tr>
							<td align="left" class="form-label"> Do you want to delete this user: </td>
							<td align="left"><input type="text" id="user_id_delete" class="form-control" name="user_id_delete" value="emp4@abc" readonly></td>
						</tr>
					</table>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Confirm Delete</button>
				  </div>
				</div>
			  </div>
		</div>
	</DIV>
</div>
<!--toast script-->
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $('.toast').toast('show');
  });
});
</script>
</body>
</html>
<?php mysqli_close($connection); ?>
