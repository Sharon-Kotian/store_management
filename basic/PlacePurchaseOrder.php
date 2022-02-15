<?php 
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'purchase_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(isset($_POST['print_data']))
	{
		$po_invoiceTo = $_POST['po_invoiceTo'];
		$po_number = $_POST['po_number'];
		$_SESSION['po_number']=$_POST['po_number'];
		$po_despatchTo = $_POST['po_despatchTo'];
		$supp_id = $_POST['supp_id'];
		
		$po_mode_payment = $_POST['po_mode_payment'];
		$po_supp_number = $_POST['po_supp_number'];
		$po_other_ref = $_POST['po_other_ref'];
		//$po_despatch_through = $_POST['po_despatch_through'];
		$po_terms = $_POST['po_terms'];
		$po_material_name = $_POST['po_material_name'];
		$po_material_quantity = $_POST['po_material_quantity'];
		$po_qnty_unit = $_POST['po_qnty_unit'];
		$po_rate = $_POST['po_rate'];
		$po_total_quantity = $_POST['po_total_quantity'];
		$po_total_amt = $_POST['po_total_amt'];
		$include_gst = $_POST['include_gst'];
		$freight_charges = $_POST['freight_charges'];
		$po_due_date = $_POST['po_due_date'];
		$po_narration = $_POST['po_narration'];
		date_default_timezone_set('Asia/Kolkata');
		$charges=$_POST['charges'];
		$other_charges=$_POST['other_charges'];
		$po_ordered_date = date("Y-m-d H:i:s");
		$gst_percent=$_POST['gst_percent'];		

		$query = "INSERT INTO po_summary(po_number,po_supp_id,po_supp_number,po_mode_payment,po_status,po_total_quantity,po_total_amt,po_include_gst,freight_charges_bourn_by,po_due_date,po_ordered_date, po_other_charges_details, po_other_charges_amt, po_invoiceTo, po_other_ref, po_terms, po_despatchTo, po_narration)";
		$query .= " VALUES ('$po_number','{$supp_id}','{$po_supp_number}','{$po_mode_payment}', 'PO issued', '{$po_total_quantity}','{$po_total_amt}','{$include_gst}','{$freight_charges}','{$po_due_date}','{$po_ordered_date}', '{$charges}', '{$other_charges}', '{$po_invoiceTo}', '{$po_other_ref}', '{$po_terms}', '{$po_despatchTo}', '{$po_narration}')";
		$insert_query_res = mysqli_query($connection,$query);

		foreach ($po_material_name as $index => $values) {
			$select=mysqli_query($connection, "SELECT rm_name FROM raw_materials WHERE rm_name='$values'");
			while($row=mysqli_fetch_array($select)){
				$rm_name=$row['rm_name'];
				if($values==$rm_name){
					$po_amount = $po_material_quantity[$index] * $po_rate[$index];
					$query1 = mysqli_query($connection, "INSERT INTO po_details(po_number,po_material_name,po_material_quantity,po_qnty_unit,po_rate,po_amount,po_percent_gst)VALUES ('$po_number','$values','$po_material_quantity[$index]','$po_qnty_unit[$index]','$po_rate[$index]','$po_amount', '$gst_percent[$index]')");
					$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity + '$po_material_quantity[$index]', rm_last_purchase_price='$po_rate[$index]' WHERE rm_name='$values'");
				}
			}			
		}
		if($insert_query_res && $query1 && $update_query){
			echo '<script>alert("Placed Purchase Order Successfully.")</script>';
			echo '<script>window.open("POPrint.php")</script>';
		}
		else{
			echo '<script>alert("Error Placing Purchase Order. '.mysqli_error($connection).'")</script>';
			echo '<script>window.location.replace("PlacePurchaseOrder.php")</script>';
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

	<title>Place Purchase Order</title>
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
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  
	<script type="text/javascript">
		$(document).ready(function(){
			$("#supp_state_name").select2();
				$('#but_read').click(function(){
				var username = $('#supp_state_name option:selected').text();
				var userid = $('#supp_state_name').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});

	$(document).ready(function(){
		$("#po_material_name").select2();
		$("#po_material_name2").select2();
		$("#po_material_name3").select2();
		$("#po_material_name4").select2();
		$("#po_material_name5").select2();
		$("#po_material_name6").select2();
		$("#po_material_name7").select2();
		$("#po_material_name8").select2();
		$("#po_material_name9").select2();
		$("#po_material_name10").select2();
		$("#po_material_name11").select2();
		$("#po_material_name12").select2();
		$("#po_material_name13").select2();
		$("#po_material_name14").select2();
		$("#po_material_name15").select2();
		$("#po_material_name16").select2();
		$("#po_material_name17").select2();
		$("#po_material_name18").select2();
		$("#po_material_name19").select2();
		$("#po_material_name20").select2();
		$("#po_material_name21").select2();
		$("#po_material_name22").select2();
		$("#po_material_name23").select2();
		$("#po_material_name24").select2();
		$("#po_material_name25").select2();
		$("#po_material_name26").select2();
		$("#po_material_name27").select2();
		$("#po_material_name28").select2();
		$("#po_material_name29").select2();
		$("#po_material_name30").select2();
	});
	
	$(document).ready(function(){
		$("#supp_id").select2();
		$('#but_read').click(function(){
		var username = $('#supp_id option:selected').text();
		var userid = $('#supp_id').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	function findTotal(){
    var arr = document.getElementsByClassName('form-control form-control-sm');
    var tot=0;
    for(var i=0;i<arr.length;i++){
      if(parseFloat(arr[i].value))
        tot += parseFloat(arr[i].value);
    }
    document.getElementById('po_total_quantity').value = tot;
	}
	
	function findTotalAmt(po_rate_id){
		var po_material_quantity_id = "po_material_quantity";
		po_material_quantity_id = po_material_quantity_id.concat(po_rate_id.replace("po_rate",""));
		console.log(po_material_quantity_id);
		var amount_id = "textbox";
		amount_id = amount_id.concat(po_rate_id.replace("po_rate",""));
		console.log(amount_id);
		var arr = document.getElementsByClassName('form-control form-control-lg');
		console.log("Entered in function");
		var tot=0;	
		for(var i=0;i<arr.length;i++){	
			console.log(i);
			po_material_quantity = document.getElementById(po_material_quantity_id).value;
			console.log(po_material_quantity_id);
			var other_charges=document.getElementById('other_charges').value;
			po_rate = document.getElementById(po_rate_id).value;
			console.log(po_rate_id);
			sum= po_material_quantity * po_rate;
			console.log(sum);
			document.getElementById(amount_id).value = sum;
			if(parseFloat(arr[i].value))
				tot += parseFloat(arr[i].value);
		}
		if(other_charges!="")
		{
			document.getElementById('po_total_amt').value = Number(tot)+Number(other_charges);	
		}
	    	else
		{
			document.getElementById('po_total_amt').value = tot;
		}
	    // document.getElementById('other_charges').value = tot;
	}

	function fTotal(po_material_quantity_id){
		var po_rate_id = "po_rate";
		po_rate_id = po_rate_id.concat(po_material_quantity_id.replace("po_material_quantity",""));
		console.log(po_rate_id);
		var amount_id = "textbox";
		amount_id = amount_id.concat(po_material_quantity_id.replace("po_material_quantity",""));
		console.log(amount_id);
		var arr = document.getElementsByClassName('form-control form-control-lg');
		console.log("Entered in function");
		var tot=0;	
		for(var i=0;i<arr.length;i++){	
			console.log(i);
			po_rate = document.getElementById(po_rate_id).value;
			console.log(po_rate_id);
			var other_charges=document.getElementById('other_charges').value;
			po_material_quantity = document.getElementById(po_material_quantity_id).value;
			console.log(po_material_quantity_id);
			sum= po_material_quantity * po_rate;
			console.log(sum);
			document.getElementById(amount_id).value = sum;
			if(parseFloat(arr[i].value))
				tot += parseFloat(arr[i].value);
		}
		if(other_charges!="")
		{
			document.getElementById('po_total_amt').value = Number(tot)+Number(other_charges);	
		}
	    	else
		{
			document.getElementById('po_total_amt').value = tot;
		}
	    // document.getElementById('other_charges').value = tot;
	}
	function other(other)
	{
		//alert(other.value);
		var total=document.getElementById('po_total_amt').value;
		document.getElementById('po_total_amt').value = Number(total)+Number(other.value);
	}
	
	</script>
	
</head>
<body class="bg-light text-dark">
<header>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Place Purchase Order</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddRawMaterialfortheProduct.php'">
					Add New Raw Material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ManageReorderLevel1.php'">
					Manage Reorder Level
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='MonitorReorderMaterials.php'">
					Monitor Reorder material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewPendingPOs.php'">
					View pending POs
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='rawmaterialsoverview.php'">
					Raw Materials Overview
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='ViewBOM.php'">
					View BOM
				  </button><br><br>				  
                  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='closePO.php'">
					Close PO
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 75px;" onClick="parent.location='UpdateStockQuantityForMaterial.php'">
					Update stock quantity for material
				  </button>
			</div>
		  </div>
</div>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post">
		<table style="width:100%" id="formContent" align="center">
			  
			<tr>
				<td align="right" class="form-label" style="width:60%;padding-right:400px;">Invoice To: </td> 
				<?php
				$query = "SELECT * FROM company_info";
				$info = mysqli_query($connection,$query);
				while ($row = mysqli_fetch_assoc($info)) 
				{
					$full_name = $row['company_full_name'];
					$short_name = $row['company_short_name'];
					$full_addr = $row['company_full_address'];
					$pan = $row['pan'];
					$gstin = $row['gstin'];
					$email = $row['email'];
				}
			?>
				<td align="center" style="padding-right:350px;"><textarea id="po_invoiceTo" class="form-control" style="width: 500px; height: 275px;" name="po_invoiceTo" rows="7" cols="25" required><?php 
echo $full_name.' ('.$short_name.')';?>&#13;&#10;
<?php echo $full_addr;?>&#13;&#10;
<?php echo 'GSTIN/UIN: '.$gstin;?>&#13;&#10;
<?php echo 'E-Mail:'.' '.$email;?></textarea>
				</td>
			</tr>
			
			<tr>
			<td align="right" class="form-label" style="padding-right:400px;"><br><br>Voucher No: </td> 
			<?php
				$query = "SELECT max(cast(po_number as int)) as max_po FROM po_summary";
				$max_po = mysqli_query($connection,$query);
				while ($row = mysqli_fetch_assoc($max_po)) 
				{
					$po_num = $row['max_po'] + 1 ;
				}
			?>
				<td align="left" style="width: 500px; height: 40px;padding-right:200px"><br><br><input type="text" id="po_number" style="width: 500px; height: 40px;" class="form-control" name="po_number" value="<?php echo $po_num; ?>" readonly>
				</td>
			</tr>
		
			<tr>
				<?php
					echo '<td align="right" class="form-label" style="padding-right:400px;"><br><br>Despatch To: </td>';
					echo '<td align="left" style="width: 500px; height: 40px;padding-right:200px">';
					echo '<br><br><select name="po_despatchTo" id="po_despatchTo" style="width: 500px; height: 40px;" class="form-control">';
					#echo '<option value="0">Select Supplier</option>';
					$query = "SELECT factory_name FROM factory_details";
					$fact = mysqli_query($connection,$query);
						
					while ($row = mysqli_fetch_assoc($fact)) 
					{
						$fact_name = "{$row['factory_name']}";
						echo "<option value={$fact_name}>$fact_name</option>";
					}
					echo "</select>";
					echo '</td>';
				?>
			</tr>
		
			<tr>
			<?php
					echo '<td align="right" class="form-label" style="padding-right:400px;"><br><br>Supplier Name: </td>';
					echo '<td align="left" style="width: 500px; height: 40px;padding-right:200px">';
					echo '<br><br><select name="supp_id" id="supp_id" style="width: 500px; height: 40px;" class="form-control" required>';
					#echo '<option value="0">Select Supplier</option>';
					$query = "SELECT supp_id,supp_name FROM supplier";
					$supp = mysqli_query($connection,$query);
						
					while ($row = mysqli_fetch_assoc($supp)) 
					{
						$supp_id = $row['supp_id'];
						$supp_name = "{$row['supp_name']}";
						echo "<option value=$supp_id>$supp_name</option>";                                              
					}
					echo "</select>";
					echo '</td>';
				?>
			</tr>

			<tr>
				<td align="right" class="form-label" style="padding-right:400px;"><br><br>Mode/Terms of Payment: </td>
				<td align="left" style="width: 500px; height: 40px;padding-right:200px"><br><br><select name="po_mode_payment" id="po_mode_payment" style="width: 500px; height: 40px;" class="form-control" style="width: 215px; height:40px;" required>
					<option value="Cash">Cash</option>
					<option value="Credit">Credit</option>
					<option value="Advance">Advance</option>
				</select>
				</td>
			</tr>

			<tr>
				<td align="right" class="form-label" style="padding-right:400px;"><br><br>Supplier’s Ref./Order No: </td>
				<td align="left" style="width: 500px; height: 40px;padding-right:200px"><br><br><input type="text" id="po_supp_number" style="width: 500px; height: 40px;" class="form-control" name="po_supp_number" required></td>
			</tr>
			
			<tr>
				<td align="right" class="form-label" style="padding-right:400px;"><br><br>Other Reference(s): </td>
				<td align="left" style="width: 500px; height: 40px;padding-right:200px"><br><br><input type="text" id="po_other_ref" style="width: 500px; height: 40px;" class="form-control" name="po_other_ref" required></td>
			</tr>	
	
			<tr>
			  	<td align="right" class="form-label" style="padding-right:400px;"><br><br>Terms of Delivery: </td>
			  	<td align="left" style="width: 500px; height: 40px;padding-right:200px"><br><br><input type="text" id="po_terms" style="width: 500px; height: 40px;"sss class="form-control" name="po_terms" required></td>
			</tr>
			</table>
			<br>
			<hr style="height:2px" color="black">
			<br>
			<table style="width:100%" id="formContent">
				<tr style="width:100%;">
					<td align="left" class="form-label" style="padding-left: 15%; width:50% ;"><br><br>Amounts mentioned above are inclusive of GST:</td>
					<td align="right" style="padding-right: 10%; width:23% ;"><br><br><input type="radio" id="Include" name="include_gst" value="GST will be added extra" required><br> Yes</td>
					<td align="center"><br><br><input type="radio" id="Exclude" name="include_gst" value="No extra taxes"><br> No</td>
				</tr>
			</table><br><br>
			<table style="width:95%" id="tableContent" align="center" id="tableContent" >
				<tr align="center">
					<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addNew(this);" style="width: 110px; height: 40px;">Add Items</button></td>
				</tr>
			<tbody id="table">
			<tr id="row" style="display:none" style="width:105%" align="center">
				<td align="left">
					<select name="po_material_name[]" id="po_material_name" style="width: 220px; height: 40px;" onchange='myFunction(this.id)' required>
					<option id='0'>Select Material</option><?php 
						$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
						$raw_mat = mysqli_query($connection,$query);			
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							//$rm_id = $row['rm_id'];
							$rm_name = $row['rm_name'];
							$rm_rate=$row['rm_rate'];
							$rm_last_purchase_price=$row['rm_last_purchase_price'];

							echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
						}
						?>
					</select> 
				</td>
				<td align="left"><input type="number" id="po_material_quantity" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" step=".01" style="text-align: center" placeholder="Enter Quantity" required></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit" class="form-control" style="width: 105px; height: 40px;" required>
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" required>
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01" required></td>
				<td align="left"><input type="text" id="textbox" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField(this);" style="width: 220px; height: 40px;">Add Row</button></td>
			</tr>
			<tr ID="row2" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name2" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity2" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit2" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control">
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate2" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox2" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField2(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField2(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row3" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name3" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity3" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit3" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate3" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox3" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField3(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField3(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row4" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name4" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity4" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit4" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate4" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox4" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField4(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField4(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row5" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name5" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity5" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit5" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate5" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox5" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField5(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField5(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
				
			<tr ID="row6" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name6" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity6" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit6" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate6" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox6" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField6(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField6(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row7" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name7" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity7" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit7" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate7" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox7" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField7(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField7(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row8" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name8" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity8" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit8" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate8" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox8" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField8(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField8(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row9" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name9" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity9" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit9" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate9" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox9" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField9(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField9(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row10" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name10" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity10" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit10" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate10" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox10" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField10(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField10(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			<tr ID="row11" style="display:none" style="width:105%" align="center">			
				<td align="left">
							<select name="po_material_name[]" id="po_material_name11" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity11" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit11" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate11" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox11" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField11(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField11(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			<tr ID="row12" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name12" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity12" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit12" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate12" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox12" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField12(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField12(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row13" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name13" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity13" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit13" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate13" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox13" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField13(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField13(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row14" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name14" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity14" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit14" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate14" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox14" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField14(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField14(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row15" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name15" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity15" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit15" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate15" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox15" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField15(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField15(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row16" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name16" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity2" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit2" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate16" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox16" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField16(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField16(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row17" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name17" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity17" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit17" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate17" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox17" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField17(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField17(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row18" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name18" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity18" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit18" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate18" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox18" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField18(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField18(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row19" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name19" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity19" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit19" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate19" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox19" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField19(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField19(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row20" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name20" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity20" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit20" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate20" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox20" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField20(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField20(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			<tr ID="row21" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name21" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity21" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit21" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate21" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox21" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField21(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField21(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row22" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name22" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity23" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit23" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate23" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox23" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField22(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField22(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row23" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name23" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity23" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit23" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate23" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox23" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField23(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField23(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row24" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name24" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity24" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit24" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate24" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox24" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField24(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField24(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row25" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name25" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity25" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit25" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate25" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox25" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField25(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField25(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row26" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name26" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity26" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit26" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate26" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox26" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField26(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField26(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row27" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name27" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity27" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit27" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate27" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox27" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField27(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField27(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row28" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name28" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity28" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit28" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate28" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox28" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField28(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField28(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row29" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name29" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity29" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit29" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate29" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox29" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField29(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField29(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			
			<tr ID="row30" style="display:none" style="width:105%" align="center">			
				<td align="left">
								<select name="po_material_name[]" id="po_material_name30" style="width: 220px; height: 40px;" onchange='myFunction(this.id)'>
								<option id='0'>Select Material</option>
								<?php 
									$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials ORDER BY rm_name ASC";
									$raw_mat = mysqli_query($connection,$query);
										
									while ($row = mysqli_fetch_assoc($raw_mat)) 
									{
										//$rm_id = $row['rm_id'];
										$rm_name = $row['rm_name'];
										$rm_rate=$row['rm_rate'];
										$rm_last_purchase_price=$row['rm_last_purchase_price'];

										echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
									}
								?>
								</select> 
								<!--<input  autoComplete="on" id="po_material_name" list="po_material_name" name="po_material_name[]" onchange='myFunction(this.id)' />-->
							</td>
				<td align="left"><input type="number" id="po_material_quantity30" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" placeholder="Enter Quantity" step=".01"></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit30" class="form-control" style="width: 105px; height: 40px;">
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" >
						<option>-Select GST%-</option>
						<option value="5">5%</option>
						<option value="12">12%</option>
						<option value="18">18%</option>
						<option value="28">28%</option>
						</select>
				</td>
				<td align="left"><input type="number" id="po_rate30" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" placeholder="Rate Per Item" step=".01"></td>
				<td align="left"><input type="text" id="textbox30" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>				
				<script>	
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');					
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}
				</script>
				<td></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField30(this);" style="width: 220px; height: 40px;">Delete Row</button></td>
			</tr>
			</tbody>
			</table>
		
		<br>
		<hr style="height:2px" color="black">
		<br>	
		</div>
			 
			<table style="width:100%" id="formContent" align="center">		
				<tr>
					<td align="right" class="form-label">Total Quantity: </td>
					<td align="center" style="padding-left:70px;"><input type="text" id="po_total_quantity" class="form-control" name="po_total_quantity" style="width: 500px; height: 40px; text-align: center;" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Details: </td>
					<td align="center" style="padding-left:70px;"><br><br><input type="text" id="charges" class="form-control" name="charges" style="width: 500px; height: 40px; text-align: center;"></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Amount: </td>
					<td align="center" style="padding-left:70px;"><br><br><input type="number" id="other_charges" class="form-control" name="other_charges" onblur="other(this)" style="width: 500px; height: 40px; text-align: center;" step=".01"></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Total Amount: </td>
					<td align="center" style="padding-left:70px;"><br><br><input type="text" id="po_total_amt" class="form-control" name="po_total_amt" style="width: 500px; height: 40px; text-align: center" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Freight Charges Bourn by: </td>
					<td align="center" style="padding-left:70px;"><br><br><input type="radio" id="Supplier" name="freight_charges" value="Supplier" required> Supplier
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					
					<?php
						$query = "SELECT * FROM company_info";
						$info = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($info)) 
						{
							$full_name = $row['company_full_name'];
							$short_name = $row['company_short_name'];
							$full_addr = $row['company_full_address'];
							$pan = $row['pan'];
							$gstin = $row['gstin'];
							$email = $row['email'];
						}
					?>
					<input type="radio" id="Company" name="freight_charges" value="<?php echo $full_name.' ('.$short_name.')'; ?>"> Company</td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Expected Delivery Date: </td>
					<td align="center" style="padding-left:70px;"><br><br><input type="date" id="po_due_date" class="form-control" name="po_due_date" style="width: 500px; height: 40px;" min="<?php echo date('Y-m-d', strtotime("+0days")); ?>" required></td>
				</tr>
				<tr>
					  <td align="right" class="form-label"><br><br>Narration: </td>
					  <td align="center" style="padding-left:70px;"><br><br><textarea id="po_narration" class="form-control" name="po_narration" rows="7" cols="50" style="width: 500px; height: 200px;"></textarea>
					  </td>
				</tr>
			</table><br><br>
			  <p align="center"><a href="htmlToPDFfile/htmlTOpdf.html">
			  	<?php echo "<input type='submit' class='btn btn-primary btn-lg' value='Save & Print' name='print_data' onClick=\"javascript: return confirm('Do you want to Place the Purchase Order Number = $po_num?');\">";?>
			  </a>
			<!--  <input type="submit" class="btn btn-primary btn-lg" value="Email" name="email_and_print"></p>-->
			  <br><br>
		</form>
	</div>
</body>
</html>
<?php mysqli_close($connection); ?>
