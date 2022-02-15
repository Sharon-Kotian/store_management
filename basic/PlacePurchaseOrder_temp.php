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
		echo "<br>";
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
		//$po_amount = (int)$po_material_quantity * (int)$po_rate;
		

		$query = "INSERT INTO po_summary(po_number,po_supp_id,po_supp_number,po_mode_payment,po_status,po_total_quantity,po_total_amt,po_include_gst,freight_charges_bourn_by,po_due_date,po_ordered_date, po_other_charges_details, po_other_charges_amt, po_invoiceTo, po_other_ref, po_terms, po_despatchTo, po_narration, po_gst_percent)";
		$query .= " VALUES ('$po_number','{$supp_id}','{$po_supp_number}','{$po_mode_payment}', 'PO issued', '{$po_total_quantity}','{$po_total_amt}','{$include_gst}','{$freight_charges}','{$po_due_date}','{$po_ordered_date}', '{$charges}', '{$other_charges}', '{$po_invoiceTo}', '{$po_other_ref}', '{$po_terms}', '{$po_despatchTo}', '{$po_narration}', '{$gst_percent}')";
		$insert_query_res = mysqli_query($connection,$query);

		foreach ($po_material_name as $index => $values) {
			$po_amount = $po_material_quantity[$index] * $po_rate[$index];
			$query1 = mysqli_query($connection, "INSERT INTO po_details(po_number,po_material_name,po_material_quantity,po_qnty_unit,po_rate,po_amount)VALUES ('$po_number','$values','$po_material_quantity[$index]','$po_qnty_unit[$index]','$po_rate[$index]','$po_amount')");
			$update_query=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity + '$po_material_quantity[$index]', rm_last_purchase_price='$po_rate[$index]' WHERE rm_name='$values'");
		}
		if($insert_query_res && $query1 && $update_query){
			echo '<script>alert("Placed Purchase Order Successfully.")</script>';
			echo '<script>window.open("POPrint.php")</script>';
		}
		else{
			echo "Error.". mysqli_error($connection);
			//echo '<script>window.location.replace("PlacePurchaseOrder.php")</script>';
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

	<link rel="stylesheet" href="CSS/fstdropdown.css">
	<link rel="stylesheet" href="CSS/fstdropdown.min.css">

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

	<script src="JS/fstdropdown.js"></script>
	<script src="JS/fstdropdown.min.js"></script>
	
	<script type="text/javascript">
		/*$(document).ready(function(){
			$("#po_material_name").select2();
				$('#but_read').click(function(){
				var username = $('#po_material_name option:selected').text();
				var userid = $('#po_material_name').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});
		
		$(document).ready(function(){
			$("#supp_state_name").select2();
				$('#but_read').click(function(){
				var username = $('#supp_state_name option:selected').text();
				var userid = $('#supp_state_name').val();
				$('#result').html("id : " + userid + ", name : " + username);
			});
		});*/
	
	$(document).ready(function(){
		$("#supp_state_code").select2();
		$('#but_read').click(function(){
		var username = $('#supp_state_code option:selected').text();
		var userid = $('#supp_state_code').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
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

	function setDrop() {
            if (!document.getElementById('third').classList.contains("fstdropdown-select"))
                document.getElementById('third').className = 'fstdropdown-select';
            setFstDropdown();
        }
        setFstDropdown();
        function removeDrop() {
            if (document.getElementById('third').classList.contains("fstdropdown-select")) {
                document.getElementById('third').classList.remove('fstdropdown-select');
                document.getElementById("third").fstdropdown.dd.remove();
            }
        }
        function addOptions(add) {
            var select = document.getElementById("fourth");
            for (var i = 0; i < add; i++) {
                var opt = document.createElement("option");
                var o = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                var last = o == undefined ? 1 : Number(o.value) + 1;
                opt.text = opt.value = last;
                select.add(opt);
            }
        }
        function removeOptions(remove) {
            for (var i = 0; i < remove; i++) {
                var last = Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0];
                if (last == undefined)
                    break;
                Array.from(document.getElementById("fourth").querySelectorAll("option")).slice(-1)[0].remove();
            }
        }
        function updateDrop() {
            document.getElementById("fourth").fstdropdown.rebind();
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
			<div class="dropdown mt-3">
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='rawmaterialsoverview.php'">
					Raw Materials Overview
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
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateStockQuantityForMaterial.php'">
					Update stock quantity for material
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddRawMaterialfortheProduct.php'">
					Add New Raw Material
				  </button>
			</div>
		  </div>
</div>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post">
		<table style="width:80%" id="formContent" align="center">
			  
			<tr>
				<td align="left" class="form-label">Invoice To: </td> 
				<td align="left"><textarea id="po_invoiceTo" class="form-control" name="po_invoiceTo" rows="7" cols="50" required>Additional Lighting Industries PL (S)
Ground Floor,07,Chaitanya Terrace,S.No.43/33,
Near Manaji Nagar Ganpati Mandir
Pune,Maharashtra-411041
GSTIN/UIN: 27AATCA4725C1ZN
State Name : Maharashtra, Code : 27
E-Mail : stalwar2000@yahoo.com </textarea>
				</td>
			</tr>
			
			<tr>
			<td align="left" class="form-label"><br><br>Voucher No: </td> 
			<?php
				$query = "SELECT count(po_number) as max_po FROM po_summary";
				$max_po = mysqli_query($connection,$query);
				while ($row = mysqli_fetch_assoc($max_po)) 
				{
					$po_num = $row['max_po'] + 1 ;
				}
			?>
				<td align="left"><br><br><input type="text" id="po_number" class="form-control" name="po_number" value="<?php echo $po_num; ?>" readonly>
				</td>
			</tr>
		
			<tr>
				<?php
					echo '<td align="left" class="form-label"><br><br>Despatch To: </td>';
					echo '<td align="left">';
					echo '<br><br><select name="po_despatchTo" id="po_despatchTo" class="form-control" required>';
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
					echo '<td align="left" class="form-label"><br><br>Supplier Name: </td>';
					echo '<td align="left">';
					echo '<br><br><select name="supp_id" id="supp_id" class="form-control" required>';
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
				<td align="left" class="form-label"><br><br>Mode/Terms of Payment: </td>
				<td align="left"><br><br><select name="po_mode_payment" id="po_mode_payment" class="form-control" style="width: 215px; height:40px;" required>
					<option value="Cash">Cash</option>
					<option value="Credit">Credit</option>
					<option value="Advance">Advance</option>
				</select>
				</td>
			</tr>

			<tr>
				<td align="left" class="form-label"><br><br>Supplier’s Ref./Order No: </td>
				<td align="left"><br><br><input type="text" id="po_supp_number" class="form-control" name="po_supp_number" required></td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Other Reference(s): </td>
				<td align="left"><br><br><input type="text" id="po_other_ref" class="form-control" name="po_other_ref" required></td>
			</tr>	
	
			<tr>
			  	<td align="left" class="form-label"><br><br>Terms of Delivery: </td>
			  	<td align="left"><br><br><input type="text" id="po_terms" class="form-control" name="po_terms" required></td>
			</tr>
			</table>
			<br>
			<hr style="height:2px" color="black">
			<br>
			<table style="width:95%" id="tableContent" align="center">
			<th>
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center" ><b>Quantity</b></td>
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center" ><b>Unit</b></td>
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center"><b>Standard Price/Item</b></td>	
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center"><b>Total</b></td>
			</th>
			<tbody id="table">
			<tr id="row">
				<td>
				<!-- onchange="myFunction(this.id)"-->
				<select name="po_material_name[]" id="po_material_name" class="fstdropdown-select" required >
				<option value="0">Select Material</option>
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
					echo "</select>";
				?>
				</td>
				<td align="left"><input type="text" id="po_material_quantity" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" style="text-align: center" required></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit" class="form-control" style="width: 105px; height: 40px;" required>
					<option value="0">Select Unit</option>
					<option value="Nos">Nos</option>
					<option value="Kg">Kg</option>
					<option value="Ltr">Ltr</option>
				</select>
				</td>
				<td align="left"><input type="text" id="po_rate" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" style="text-align: center" required ></td>
				<td align="left"><input type="text" id="textbox" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>
				
				<script>
					
					function myFunction(po_material_name_id){
						var rate = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_rate');
						$('#po_rate'.concat(po_material_name_id.replace("po_material_name",""))).val(rate);
						var price = $('#po_material_name'.concat(po_material_name_id.replace("po_material_name",""))).find(':selected').data('po_purchase_price');
						alert("Last Purchase Price is: "+ price);
					}

				</script>
				<td><button type="button" class="btn btn-outline-primary btn-sm" value="Add Row" id="addrowvalue"  onclick="addField(this);" style="width: 110px; height: 40px;">Add Row</button></td>
				<td><button type="button" class="btn btn-outline-warning" value="Delete Row"  onclick="deleteField(this);" style="width: 110px; height: 40px;">Delete Row</button></td>
			</tr>
			</tbody>
			</table>
		
		<br>
		<hr style="height:2px" color="black">
		<br>	
		</div>
			 
			<table style="width:100%" id="formContent">		
				<tr>
					<td align="right" class="form-label">Total Quantity: </td>
					<td align="center"><input type="text" id="po_total_quantity" class="form-control" name="po_total_quantity" style="width: 500px; height: 40px; text-align: center;" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Details: </td>
					<td align="center"><br><br><input type="text" id="charges" class="form-control" name="charges" style="width: 500px; height: 40px; text-align: center;" required></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Amount: </td>
					<td align="center"><br><br><input type="text" id="other_charges" class="form-control" name="other_charges" onblur="other(this)" style="width: 500px; height: 40px; text-align: center;" required></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Total Amount: </td>
					<td align="center"><br><br><input type="text" id="po_total_amt" class="form-control" name="po_total_amt" style="width: 500px; height: 40px; text-align: center" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Amounts mentioned above are inclusive of GST:</td>
					<td align="center"><br><br><input type="radio" id="Include" name="include_gst" value="GST will be added extra" required><br> Yes</td>
					<td align="left"><br><br><input type="radio" id="Exclude" name="include_gst" value="No extra taxes"><br> No</td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>GST %: </td>
					<td align="center"><br><br><select name="gst_percent" id="gst_percent" class="form-control fstdropdown-select" style="width: 500px; height: 40px; text-align: center;" required>
						<option>-- Select GST % --</option>
						<option value="5">5%</option>
						<option value="14">12%</option>
						<option value="18">18%</option>
						<option value="24">28%</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Freight Charges Bourn by: </td>
					<td align="center"><br><br><input type="radio" id="Supplier" name="freight_charges" value="Supplier" required><br> Supplier</td>
					<td align="left"><br><br><input type="radio" id="Company" name="freight_charges" value="Additional Lighting Industries PL (S)"><br> Company</td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Expected Delivery Date: </td>
					<td align="center"><br><br><input type="date" id="po_due_date" class="form-control" name="po_due_date" style="width: 500px; height: 40px;" required></td>
				</tr>
				<tr>
					  <td align="right" class="form-label"><br><br>Narration: </td>
					  <td align="center"><br><br><textarea id="po_narration" class="form-control" name="po_narration" rows="7" cols="50" style="width: 500px; height: 200px;"></textarea>
					  </td>
				</tr>
			</table><br><br>
			  <p align="center"><a href="htmlToPDFfile/htmlTOpdf.html"><input type="submit" class="btn btn-primary btn-lg" value="Save & Print" name="print_data"></a>
			<!--  <input type="submit" class="btn btn-primary btn-lg" value="Email" name="email_and_print"></p>-->
			  <br><br>
		</form>
	</div>
</body>
</html>
<?php mysqli_close($connection); ?>