<?php 
	include_once ("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	if(isset($_POST['add'])){
		$fps_name=$_POST['fps_name'];
		$count_fps=count($_POST['fps_name']);

		//Generate finished_product_summary query in a loop
		$fps_query = "SELECT * from finished_product_summary where ";
		for($j=0; $j<$count_fps; $j++){
			if($j==0){
				$fps_query .= "fps_name='". $_POST['fps_name'][$j]. "' ";
			}

			else{
				$fps_query .= "OR fps_name='". $_POST['fps_name'][$j]. "' ";
			}
		}

		$records=mysqli_query($connection, $fps_query);

		
		//Generate finished_product_details query in a loop
		$fpd_query = "SELECT * from finished_product_details where ";
		$k = 0;
		while($data=mysqli_fetch_array($records)){
			$fps_id = $data['fps_id'];
			if($k == 0){
				$fpd_query .= "fps_id='". $data['fps_id']. "' ";
			}

			else{
				$fpd_query .= "OR fps_id='". $data['fps_id']. "' ";
			}
			$k++;
		}

		$select=mysqli_query($connection, $fpd_query);
		if(mysqli_num_rows($select) > 0){
			$rm_query = "SELECT * from raw_materials where ";
			$i = 0;
			
			while($row=mysqli_fetch_array($select)){
				$fpd_material_name=$row['fpd_material_name'];

				if($i == 0){
					$rm_query .= "rm_name='". $fpd_material_name."'";
				}
				else{
					$rm_query .= " OR rm_name='". $fpd_material_name."'";
				}
				$i=$i+1;
			}

			$_SESSION['str_query']=$rm_query;
			if ($rm_query) {
				echo '<script>window.open("PrintRawMaterials.php")</script>';
			}
		}

		else{
			echo '<script>alert("Raw Materials are missing.")</script>';
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

	<title>Print Quantity Verification</title>
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
		$("#fps_name").select2();
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
	<h1 class="display-3" align="center">Print Quantity Verification</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='VerificationReport.php'">
				Verification report
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Allocate Caret ID
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Search Caret ID
				</button>
			</div>
		</div>
	</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="Finished Product Wise" ONCLICK="parent.location='PrintQuantityVerification.php'" style="width: 300px; height: 45px;">
			<input type="button" class="btn btn-primary btn-lg" value=" Raw Material Wise " ONCLICK="parent.location='PrintRawMatQuantity.php'" style="width: 300px; height: 45px;"></p>
	
	</div>
	<DIV ID="SectionName">
	<form name="frm" method="post">
		<table style="width:50%" id="formContent" align="center">	
			<tbody><tr align="center">									
				<td align="center" class="form-label"><br><br><br><br>Finished Product Name: </td>
				<td align="center"><br><br><br><select multiple name="fps_name[]" id="fps_name" class="form-select select2-hidden-accessible" style="width: 300px; height:45px;" data-select2-id="select2-data-fpd_material_name" tabindex="-1" aria-hidden="true" required>
				<?php 
					$records=mysqli_query($connection,"SELECT fps_name from finished_product_summary ");
					while($data=mysqli_fetch_array($records)){
						echo "<option value='".$data['fps_name']."'>".$data['fps_name']."</option>";			
					}
				?>
			</select>
			
				</td>
			</tr>			
		</tbody></table>
		<p align="center"><br><br><br>
			<?php echo "<input type='submit' name='add' class='btn btn-primary btn-lg' value=' Print ' id='myBtn' style='width: 150px; height: 45px;' align='center' onClick=\"javascript: return confirm('Do you want to Print?');\">";?>
		</p>
	</form>
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
