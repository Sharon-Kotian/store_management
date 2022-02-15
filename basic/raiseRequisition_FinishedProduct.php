<?php 
	include_once ("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'production_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	
	if(isset($_POST['delete'])){
		
		$rr_material_name_material=$_POST['rr_material_name_material'];
		//$rr_body_colour_material=$_POST['rr_body_colour_material'];
		$rr_material_quantity_material=$_POST['rr_material_quantity_material'];
		//$rr_req_date_material=$_POST['rr_req_date_material'];
		
		$n=$_SESSION['mat_name'];
		$q=$_SESSION['mat_qnty'];
		$c=$_SESSION['body_colour'];
		$d=$_SESSION['req_date'];
		if($d=='')
		{
			$d=date("Y-m-d");
		}
		
		
		
				$maxid=mysqli_query($connection, "select max(pr_product_id) from product_requisition");
					while($maxid_row=mysqli_fetch_array($maxid)){
						$pr_product_id = $maxid_row[0] + 1;
					}
				foreach ($rr_material_name_material as $index => $names) {	
					
					$fpd_material_name = $names;					
					$sqlquery = mysqli_query($connection, "INSERT into product_requisition (pr_product_id, pr_product_name, pr_required_date, pr_required_quantity, pr_status, pr_body_colour, pr_material_name) VALUES('$pr_product_id', '$n','$d','$rr_material_quantity_material[$index]', 'Production Requisition Raised', '$c', '$fpd_material_name')");
				}	
			
				$sql1 = mysqli_query($connection, "INSERT into production (prod_name, prod_color, prod_quantity, prod_require_date, prod_status) VALUES('$n', '$c', '$q', '$d', 'Production Estimated')");
				
			
				if ($sqlquery) {
					echo '<script>alert("Requisition has been raised.")</script>';
					echo '<script>window.location.replace("AdhocProduction.php")</script>';
				} else {
					echo '<script>alert("BOM for material is not available.")</script>';
					echo '<script>window.location.replace("AdhocProduction.php")</script>';
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
	
	<DIV>
	<form name="frm" action="" method="post">
		<center><table style="width:50%; margin-left:425px;" id="tableContent" align="center">
			<tbody id="table">
				
								<?php 
									$n=$_SESSION['mat_name'];
									$c=$_SESSION['body_colour'];
									$d=$_SESSION['req_date'];
									$q=$_SESSION['mat_qnty'];
									$query1 = "SELECT fps_id FROM finished_product_summary WHERE fps_name = '$n'";
									$id_query = mysqli_query($connection, $query1);
									$r=mysqli_fetch_assoc($id_query);
									$id=$r['fps_id'];
									$query = "SELECT * FROM finished_product_details WHERE fps_id = '$id'";
									
									$records=mysqli_query($connection,"SELECT fpd_material_name,fpd_material_quantity FROM finished_product_details WHERE fps_id = '$id'");
									while($data=mysqli_fetch_array($records)){?>
									<tr align="center" id="row">
									<td class="form-label" id="label_raw">Raw Material Required : </td>
									<td>	
							<?php
										
										echo "<input type='text' class='form-control' style='width:275px;' value='".$data['fpd_material_name']."' name='rr_material_name_material[]' id='rr_material_name_material' readonly>";
									
								?>
								
							
							</td>
													
				
					<?php
						$qnty=$data['fpd_material_quantity']*$q;
						
					?>
					<td class="form-label" id="label_quantity"> Quantity :  </td>
					<td><input type="number" id="rr_material_quantity_material" class="form-control" name="rr_material_quantity_material[]"  style="width: 100px; height: 40px;" value="<?php echo $qnty;?>" required></td>
					
					
					
					<td><input type="button" class="btn btn-outline-warning" value="Delete Row" id="button_delete" onclick="deleteField(this);"/></td>
				
				</tr>
				<?php }?>
			</tbody>
		</table><center>
		
		<p align="center"><br><br><br>
			<?php echo "<input type='submit' id= 'clickme' value='Raise' class='btn btn-primary btn-lg' name='delete' onClick=\"javascript: return confirm('Do you want to raise requisition?');\">"; 
			?>		</p>
	</form>
	</div>
	
	
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
