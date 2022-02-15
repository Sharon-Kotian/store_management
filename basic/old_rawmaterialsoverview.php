<?php 
    include "../includes/header.php";
	global $connection;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="CSS/RowMaterialOverview.css">
	<title>Raw Material Overview</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<link rel="stylesheet" href="CSS/PlacePurchaseOrderLink1.css">
	<script src="JS/PlacePurchaseOrderLink2.js"></script>
	<script src="JS/PlacePurchaseOrderLink3.js"></script>
	<SCRIPT>
	$(document).ready(function(){
		$("#prod_name").select2();
		$('#but_read').click(function(){
		var username = $('#prod_name option:selected').text();
		var userid = $('#prod_name').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	$(document).ready(function(){
		$("#po_material_name").select2();
		$('#but_read').click(function(){
		var username = $('#po_material_name option:selected').text();
		var userid = $('#po_material_name').val();
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
    }
}

function ShowRowMaterial() {
    var y = document.getElementById('ProductName');
	var x = document.getElementById('SectionName');
    if (y.style.display == 'none') {
        x.style.display = 'block';
    } else {
        y.style.display = 'none';
    }
}

function myfunctionRow() {
  var tablewrap=document.getElementById('displaytable'); 
	if(tablewrap.style.display==="none"){
		tablewrap.style.display="block"
	}
	else{
		tablewrap.style.display="none"
	}
};
	
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
<body>
<header>
	<p align="right">Welcome  
		<a href="login.html" class="button">Logout</a>
	</p>
	<hr style="height:2px" color="black">
	<h1 style="font-family:verdana;text-align: center;color: black; font-size: 40px;"><u>Raw Material Overview</u></h1>
</header>
<br>
<div class="split left">
	<ul style="color: blanchedalmond;">
		
		<li><a href="PlacePurchaseOrder.html">Place Purchase Order</a></li><br><br>
		<li><a href="ManageReorderLevel.html">Set New Order Level</a></li><br><br>
		<li><a href="contactus.html">Add New Raw Material</a></li>		<br><br>			
	</ul>
</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent">
		<p><input type="button" class="fadeIn fourth" value="  Raw Material  " ONCLICK="ShowRowMaterial()">
			<input type="button" class="fadeIn fourth" value=" Product Name " ONCLICK="ShowProduct()"></p>
	
	</div>
	<DIV ID="SectionName" STYLE="display:none">
		<p for="cars">Select Material:
			<select name="cars" id="po_material_name" style="width: 185px; height: 30px;">
			<?php 
				$query = "SELECT rm_id,rm_name,rm_stores_quantity FROM raw_materials WHERE status = 'Available'";
				$available_raw_mat = mysqli_query($connection,$query);
				echo $available_raw_mat;
				 
				while ($row = mysqli_fetch_assoc($available_raw_mat)) 
				{
					$rm_id = $row['rm_id'];
					$rm_name = $row['rm_name'];
					$rm_stores_quantity = $row['rm_stores_quantity'];
					echo "Hello";

					echo "<option value=$rm_id>$rm_name</option>";
				}
			
			?>
			
				<option value="volvo">Sand Paper</option>
				<option value="saab">Saab</option>
				<option value="opel">Opel</option>
				<option value="audi">Audi</option>
			</select>
					<input type="button" id= "clickme" value=" Ok " onclick='myfunctionRow();'> 
		</p>  
		<div id="displaytable1">
		  <table id="displaytable" style="display: none; border= 3">
			<tr align="center">
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Raw Material Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Quantity</td>
			</tr>
			<tr>
			  <td align="center">1</td>
			  <td align="center">2</td>
			</tr>
			<tr>
			  <td align="center">4</td>
			  <td align="center">5</td>
			</tr>
		  </table> 
		</div>
	</DIV>
	
	<DIV ID="ProductName" STYLE="display:none">
		<p for="product">Select Product:
			<select name="product" id="prod_name" style="width: 185px; height: 30px;">
				<option value="abc">Aluminium Plate</option>
				<option value="def">Aluminium Rod</option>
				<option value="ghi">Aluminium Spring</option>
				<option value="jkl">Iron Plate</option>
			</select>
			<input type="button" id= "clickme" value=" Ok " onclick='myfunctionProduct();'>		
		</p>
		<div id="ProductTable1">
			<table id="ProductTable" style="display: none; border="3">
			  <tr align="center">
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Product Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Raw Material Name</td>
			  <td class="fadeIn fourth" style="width: 200px; height: 50px;">Quantity</td>
			</tr>
			<tr>
			  <td align="center">Rod</td>
			  <td align="center">1</td>
			  <td align="center">2</td>
			</tr>
			<tr>
			  <td align="center">Spring</td>
			  <td align="center">4</td>
			  <td align="center">5</td>
			</tr>
		  </table>
	  </div>
	</DIV>
</div>


  
  


</body>
</html>