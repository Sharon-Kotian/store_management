<?php 
	include "includes/header.php";
	global $connection;
	if($_SESSION['user_dept'] != 'accounts_dept'){
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
		$po_mode_payment = $_POST['po_mode_payment'];
		$po_supp_number = $_POST['po_supp_number'];
		$po_other_ref = $_POST['po_other_ref'];
		$po_terms = $_POST['po_terms'];
		$po_material_name = $_POST['po_material_name'];
		$po_material_quantity = $_POST['po_material_quantity'];
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
		$gst_percent=$_POST['gst_percent'];
		$po_qnty_unit=$_POST['po_qnty_unit'];
		
		$update_query=mysqli_query($connection, "UPDATE po_summary SET po_supp_number='$po_supp_number', po_mode_payment='$po_mode_payment', po_invoiceTo='$po_invoiceTo', po_despatchTo='$po_despatchTo', po_other_ref='$po_other_ref', po_terms='$po_terms', po_total_quantity='$po_total_quantity', po_total_amt='$po_total_amt', po_other_charges_details='$charges', po_other_charges_amt='$other_charges', po_include_gst='$include_gst', freight_charges_bourn_by='$freight_charges', po_due_date='$po_due_date', po_narration='$po_narration' WHERE po_number='$po_number'");

		foreach ($po_material_name as $index => $values) {
			$po_amount = $po_material_quantity[$index] * $po_rate[$index];
			$flag=false;
			$select=mysqli_query($connection, "SELECT po_material_name FROM po_details WHERE po_number='$po_number'");
			while($row=mysqli_fetch_array($select)){
				$flag=false;
				$material_name=$row['po_material_name'];
				//echo "Db".$material_name."<br>";
				//echo "Form".$values."<br>";
				if($values==$material_name){
					$query1=mysqli_query($connection, "UPDATE po_details SET po_material_quantity='$po_material_quantity[$index]', po_rate='$po_rate[$index]', po_amount='$po_amount', po_qnty_unit='$po_qnty_unit[$index]', po_percent_gst='$gst_percent[$index]' WHERE po_material_name='$values' AND po_number='$po_number'");
					break;
				}else{
					$flag=true;
				}
				
			}
			//echo var_dump($flag)."<br>";
			if($flag==true){
				$query2 = mysqli_query($connection, "INSERT INTO po_details(po_number,po_material_name,po_material_quantity, po_qnty_unit, po_rate,po_amount, po_percent_gst)VALUES ('$po_number','$values','$po_material_quantity[$index]', '$po_qnty_unit[$index]','$po_rate[$index]','$po_amount', 'gst_percent[$index]')");
			}
			$update_query1=mysqli_query($connection, "UPDATE raw_materials SET rm_ordered_quantity=rm_ordered_quantity + '$po_material_quantity[$index]', rm_last_purchase_price='$po_rate[$index]' WHERE rm_name='$values'");
		}

		$select_query=mysqli_query($connection, "SELECT po_material_name FROM po_details WHERE po_number='$po_number'");
		while($rs=mysqli_fetch_array($select_query)){
			$flag=true;
			$material_name=$rs['po_material_name'];
			foreach ($po_material_name as $index => $values) {
				//echo '<br>DB'.$material_name;
				//echo '<br>Form'.$values;
				if($material_name==$values){
					$flag=true;
					break;
				}else{
					$flag=false;
				}
			}
			if($flag==false){
				$delete=mysqli_query($connection, "DELETE FROM po_details WHERE po_number='$po_number' AND po_material_name='$material_name'");
			}
		}

		if($update_query && $update_query1 || $query1 || $query2 || $delete){
			echo '<script>alert("Updated Placed Purchase Order Successfully.")</script>';
			echo '<script>window.open("POPrint.php")</script>';
		}
		else{
			echo "Error.". mysqli_error($connection);
			echo '<script>window.location.replace("ViewPOs.php")</script>';
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

	<title>Update Purchase Order</title>
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
	<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
	
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
		$("#supp_state_code").select2();
		$('#but_read').click(function(){
		var username = $('#supp_state_code option:selected').text();
		var userid = $('#supp_state_code').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
	/*$(document).ready(function(){
		$("#supp_id").select2();
		$('#but_read').click(function(){
		var username = $('#supp_id option:selected').text();
		var userid = $('#supp_id').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});*/
	
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
	<h1 class="display-3" align="center">Update Purchase Order</h1>
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
					Delete POs
			</button><br><br>
			</div>
		  </div>
</div>
	
	<div class="wrapper fadeInDown">
		<div id="formContent">
		<form method="post">
		<table style="width:80%" id="formContent" align="center">
			<?php 
			 	$id=$_GET['id'];
				$query=mysqli_query($connection, "SELECT * FROM po_summary WHERE po_number='$id'");
				$row=mysqli_fetch_array($query);
				if($count=mysqli_num_rows($query)){
					$supp_id=$row['po_supp_id'];
					$po_supp_number=$row['po_supp_number'];
					$po_other_ref=$row['po_other_ref'];
					$po_terms=$row['po_terms'];
					$po_other_charges_details=$row['po_other_charges_details'];
					$po_other_charges_amt=$row['po_other_charges_amt'];
					$po_total_amt=$row['po_total_amt'];
					$po_total_quantity=$row['po_total_quantity'];
					$po_due_date=$row['po_due_date'];
					$po_narration=$row['po_narration'];
					$po_include_gst=$row['po_include_gst'];
					$freight_charges=$row['freight_charges_bourn_by'];
					$po_gst_percent=$row['po_gst_percent'];
			?> 
			<tr>
				<td align="left" class="form-label">Invoice To: </td> 
				<td align="left"><textarea id="po_invoiceTo" class="form-control" name="po_invoiceTo" rows="7" cols="50" required><?php echo $row['po_invoiceTo']; ?></textarea>
				</td>
			</tr>
			
			<tr>
			<td align="left" class="form-label"><br><br>Voucher No: </td> 
				<td align="left"><br><br><input type="text" id="po_number" class="form-control" name="po_number" value="<?php echo $id; ?>" readonly>
				</td>
			</tr>
			<tr>
				<td align="left" class="form-label"><br><br>Despatch To: </td>
				<td align="left"><br><br>
				<select name="po_despatchTo" id="po_despatchTo" class="form-control" value="<?php echo $row['po_despatchTo']; ?>" required>
				<?php
					$query = "SELECT factory_name FROM factory_details";
					$fact = mysqli_query($connection,$query);
						
					while ($rows = mysqli_fetch_assoc($fact)) 
					{
						$fact_name = "{$rows['factory_name']}";
						echo "<option value={$fact_name}>$fact_name</option>";
					}
				?>
				</select>
				</td>
			</tr>
			<?php
				$select_query=mysqli_query($connection, "SELECT supp_name FROM supplier WHERE supp_id='$supp_id'");
				while($data=mysqli_fetch_array($select_query)){
					?>
				<td align="left" class="form-label"><br><br>Supplier Name: </td> 
				<td align="left"><br><br><input type="text" id="supp_id" class="form-control" name="supp_id" value="<?php echo $data['supp_name']; ?>" readonly>
				</td>
			<tr>
				<?php } ?>
			
			</tr>

			<tr>
				<td align="left" class="form-label"><br><br>Mode/Terms of Payment: </td>
				<td align="left"><br><br><select name="po_mode_payment" id="po_mode_payment" style="width: 185px; height: 30px;" value="<?php echo $row['po_mode_payment']; ?>" required>
					<?php
						if($row['po_mode_payment']=='Cash'){?>
							<option value="Cash" selected>Cash</option>
							<option value="Credit">Credit</option>
							<option value="Advance">Advance</option>
						<?php }elseif($row['po_mode_payment']=='Credit'){?>
							<option value="Cash">Cash</option>
							<option value="Credit" selected>Credit</option>
							<option value="Advance">Advance</option>
						<?php }elseif($row['po_mode_payment']=='Advance'){?>
							<option value="Cash">Cash</option>
							<option value="Credit">Credit</option>
							<option value="Advance" selected>Advance</option>
						<?php }?>
				</select>
				</td>
			</tr>

			<tr>
				<td align="left" class="form-label"><br><br>Supplier’s Ref./Order No: </td>
				<td align="left"><br><br><input type="text" id="po_supp_number" class="form-control" name="po_supp_number" value="<?php echo $po_supp_number; ?>" required></td>
			</tr>
			
			<tr>
				<td align="left" class="form-label"><br><br>Other Reference(s): </td>
				<td align="left"><br><br><input type="text" id="po_other_ref" class="form-control" name="po_other_ref" value="<?php echo $po_other_ref; ?>" required></td>
			</tr>	
	
			<tr>
			  	<td align="left" class="form-label"><br><br>Terms of Delivery: </td>
			  	<td align="left"><br><br><input type="text" id="po_terms" class="form-control" name="po_terms" value="<?php echo $po_terms; ?>" required></td>
			</tr>
			</table>
			<br>
			<hr style="height:2px" color="black">
			<br>
			<table style="width:100%" id="formContent">
				<tr style="width:100%;">
					<td align="left" class="form-label" style="padding-left: 15%; width:50% ;"><br><br>Amounts mentioned above are inclusive of GST:</td>
					<?php 
					if($po_include_gst=='GST will be added extra'){
						echo '<td align="center"><br><br><input type="radio" id="Include" name="include_gst" value="GST will be added extra" required checked><br> Yes</td>';
						echo '<td align="left"><br><br><input type="radio" id="Exclude" name="include_gst" value="No extra taxes"><br> No</td>';
					}else{
						echo '<td align="center"><br><br><input type="radio" id="Include" name="include_gst" value="GST will be added extra" required><br> Yes</td>';
						echo '<td align="left"><br><br><input type="radio" id="Exclude" name="include_gst" value="No extra taxes" checked><br> No</td>';
					}?>
				</tr>
			</table><br><br>
			<table style="width:95%" id="tableContent" align="center">
			<th>
			  <td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center" ><b>Quantity</b></td>
			  <td class="fadeIn fourth" id="unit" name="unit" align="center"><b>Unit</b></td>
			  <td class="fadeIn fourth" id="po_gst_percent" name="po_gst_percent" align="center"><b>GST %</b></td>
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center"><b>Standard Price/Item</b></td>	
				<td class="fadeIn fourth" id="rm_counting_quantity" name="rm_counting_quantity" align="center"><b>Total</b></td>
			</th>
			<tbody id="table">
			<tr id="row">
				<?php
					$rs=mysqli_query($connection, "SELECT * FROM po_details WHERE po_number='$id'");
					$n=1;
					$text='';
					while($rs1=mysqli_fetch_array($rs)){
						if($n==1){
							$text='';
						}else{
							$text=strval($n);
						}
						$n++;
				?>
				<td>
				<!--<td align="left" class="form-label">Select Material: </td>
				<td align="left"><select name="po_material_name" id="po_material_name" data-live-search="true" class="form-select"> -->
				<select name="po_material_name[]" id="po_material_name<?php echo $text; ?>" class="form-control" required onchange="myFunction(this.id)" value="<?php echo $rs1['po_material_name']; ?>">
				<option value="0">Select Material</option>
				<?php
					$query = "SELECT rm_name, rm_rate, rm_last_purchase_price FROM raw_materials";
					$raw_mat = mysqli_query($connection,$query);
						
					while ($row = mysqli_fetch_assoc($raw_mat)) 
					{
						//$rm_id = $row['rm_id'];
						$rm_name = $row['rm_name'];
						$rm_rate=$row['rm_rate'];
						$rm_last_purchase_price=$row['rm_last_purchase_price'];
						if($rm_name==$rs1['po_material_name']){
							echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."' selected>$rm_name</option>";
						}else{
							echo "<option data-po_rate='$rm_rate' data-po_purchase_price='$rm_last_purchase_price' value='".$rm_name."'>$rm_name</option>";
						}
					}
					echo "</select>";
				?>
				</td>
				<td align="left"><input type="text" id="po_material_quantity<?php echo $text; ?>" onblur="findTotal()" onfocusout="fTotal(this.id)" class="form-control form-control-sm" name="po_material_quantity[]" value="<?php echo $rs1['po_material_quantity']; ?>" style="text-align: center" required></td>
				<td align="left"><select name="po_qnty_unit[]" id="po_qnty_unit<?php echo $text; ?>" class="form-control" style="width: 105px; height: 40px;" required>
					<?php 
						if($rs1['po_qnty_unit']=='Nos'){?>
							<option>Select Unit</option>
							<option value="Nos" selected>Nos</option>
							<option value="Kg">Kg</option>
							<option value="Ltr">Ltr</option>
						<?php }elseif($rs1['po_qnty_unit']=='Kg'){?>
							<option>Select Unit</option>
							<option value="Nos">Nos</option>
							<option value="Kg" selected>Kg</option>
							<option value="Ltr">Ltr</option>
						<?php }elseif($rs1['po_qnty_unit']=='Ltr'){?>
							<option>Select Unit</option>
							<option value="Nos">Nos</option>
							<option value="Kg">Kg</option>
							<option value="Ltr" selected>Ltr</option>
						<?php }else{?>
							<option>Select Unit</option>
							<option value="Nos">Nos</option>
							<option value="Kg">Kg</option>
							<option value="Ltr">Ltr</option>
						<?php } ?>
					
				</select>
				</td>
				<td align="center"><select name="gst_percent[]" id="gst_percent" class="form-control" value="<?php echo $rs1['po_percent_gst']; ?>" required>
						<?php 
						if($rs1['po_percent_gst']=='5'){?>
							<option>-- Select GST % --</option>
							<option value="5" selected>5%</option>
							<option value="12">12%</option>
							<option value="18">18%</option>
							<option value="28">28%</option>
						<?php }elseif($rs1['po_percent_gst']=='12'){?>
							<option>-- Select GST % --</option>
							<option value="5">5%</option>
							<option value="12" selected>12%</option>
							<option value="18">18%</option>
							<option value="28">28%</option>
						<?php }elseif($rs1['po_percent_gst']=='18'){?>
							<option>-- Select GST % --</option>
							<option value="5">5%</option>
							<option value="12">12%</option>
							<option value="18" selected>18%</option>
							<option value="28">28%</option>
						<?php }elseif($rs1['po_percent_gst']=='28'){?>
							<option>-- Select GST % --</option>
							<option value="5">5%</option>
							<option value="12">12%</option>
							<option value="18">18%</option>
							<option value="28" selected>28%</option>
						<?php }else{?>
							<option>--Select GST%--</option>
							<option value="5">5%</option>
							<option value="12">12%</option>
							<option value="18">18%</option>
							<option value="28">28%</option>
						<?php } ?>
					</select>
					</td>
				<td align="left"><input type="text" id="po_rate<?php echo $text; ?>" onblur="findTotalAmt(this.id)" class="form-control" name="po_rate[]" value="<?php echo $rs1['po_rate']; ?>" style="text-align: center" required ></td>
				<td align="left"><input type="text" id="textbox<?php echo $text; ?>" class="form-control form-control-lg" name="textbox" style="text-align: center" readonly></td>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
		<?php } ?>
			</tbody>
			</table>
		
		<br>
		<hr style="height:2px" color="black">
		<br>	
		</div>
			 
			<table style="width:100%" id="formContent">		
				<tr>
					<td align="right" class="form-label">Total Quantity: </td>
					<td align="center"><input type="text" id="po_total_quantity" class="form-control" name="po_total_quantity" style="width: 500px; height: 40px; text-align: center;" value="<?php echo $po_total_quantity; ?>" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Details: </td>
					<td align="center"><br><br><input type="text" id="charges" class="form-control" name="charges" style="width: 500px; height: 40px; text-align: center;" value="<?php echo $po_other_charges_details; ?>" required></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Other Charges Amount: </td>
					<td align="center"><br><br><input type="text" id="other_charges" class="form-control" name="other_charges" onblur="other(this)" style="width: 500px; height: 40px; text-align: center;" value="<?php echo $po_other_charges_amt; ?>" required></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Total Amount: </td>
					<td align="center"><br><br><input type="text" id="po_total_amt" class="form-control" name="po_total_amt" style="width: 500px; height: 40px; text-align: center" value="<?php echo $po_total_amt; ?>" readonly></td>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Freight Charges Bourn by: </td>
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
						
						if($freight_charges=='Supplier'){
							echo '<td align="center"><br><br><input type="radio" id="Supplier" name="freight_charges" value="Supplier" required checked><br> Supplier</td>';
							echo '<td align="left"><br><br><input type="radio" id="Company" name="freight_charges" value="'.$full_name.' ('.$short_name.')'.'"><br> Company</td>';
						}else{
							echo '<td align="center"><br><br><input type="radio" id="Supplier" name="freight_charges" value="Supplier" required><br> Supplier</td>';
							echo '<td align="left"><br><br><input type="radio" id="Company" name="freight_charges" value="'.$full_name.' ('.$short_name.')'.'" checked><br> Company</td>';
						}
						?>
				</tr>
				<tr>
					<td align="right" class="form-label"><br><br>Expected Delivery Date: </td>
					<td align="center"><br><br><input type="date" id="po_due_date" class="form-control" name="po_due_date" style="width: 500px; height: 40px;" value="<?php echo $po_due_date; ?>" required></td>
				</tr>
				<tr>
					  <td align="right" class="form-label"><br><br>Narration: </td>
					  <td align="center"><br><br><textarea id="po_narration" class="form-control" name="po_narration" rows="7" cols="50" style="width: 500px; height: 200px;"><?php echo $po_narration; ?></textarea>
					  </td>
				</tr>
			
			<?php } ?>
			</table><br><br>
			  <p align="center"><a href="htmlToPDFfile/htmlTOpdf.html"><input type="submit" class="btn btn-primary btn-lg" value="Save & Print" name="print_data"></a>
			<!--  <input type="submit" class="btn btn-primary btn-lg" value="Email" name="email_and_print"></p>-->
			  <br><br>
		</form>
	</div>
</body>
</html>

