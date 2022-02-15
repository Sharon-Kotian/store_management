<?php
	include_once ("includes/db.php");
	global $connection;
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale=1.0">
	<title>Purchase Order</title>
	<link rel="stylesheet" href="htmlToPDFfile/htmlTOpdf.css">
	<script src="htmlToPDFfile/htmlTOpdfJavascript.js"></script>
	<script src="htmlToPDFfile/htmlTOpdfscript.js"></script>
	<script src="htmlToPDFfile/JS/addRowButton.js"></script>
</head>
<body onload="window.print()">
	<div id="PurchaseOrder">
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
		<h2 align="center"><?php echo $full_name.' ('.$short_name.')';?></h2>
		<br>
		<h1>Purchase Order</h1>
		<br><br>
		<table style="width:100%;">
			<?php 
				$po_number=$_SESSION['po_number'];
				$query=mysqli_query($connection, "SELECT * FROM po_summary WHERE po_number='$po_number'");
				while($row=mysqli_fetch_array($query)){
					$po_supp_id=$row['po_supp_id'];
					$rs=mysqli_query($connection, "SELECT supp_name,supp_address,supp_gstin from supplier where supp_id='$po_supp_id'");
					while($data=mysqli_fetch_array($rs)){
			?>
			<tr>
				<td width="150" height="200"><strong>Invoice To:</strong>
				<br><?php echo $row['po_invoiceTo']; ?>
				<td> <table style="width:100%">
					<tr width="250">
						<td width="100" height="50">Voucher No:
						<br><strong><?php echo $po_number; ?></strong></td>
						<td width="100" height="50">Dated:
						<br><strong><?php echo date('d-M-Y'); ?></strong></td>
						
					</tr>
					<tr>
						<td width="100" height="50">Due on:
						<strong><?php 
								$newDate = date("d-M-Y", strtotime($row['po_due_date']));
								echo $newDate; 
								?></strong></td>
						<td width="100" height="50">Mode/Terms of Payment:
						<strong><?php echo $row['po_mode_payment']; ?></strong></td>
					</tr>
					<tr>
						<td width="100" height="50">Supplier’s Ref./Order No.:
						<strong><?php echo $row['po_supp_number']; ?></strong></td>
						<td width="100" height="50">Other Reference(s):
						<br><strong><?php echo $row['po_other_ref']; ?></strong></td>
					</tr>
				</td>
				</table>
			</tr>
			
			<tr>
				<?php 
					$squery=mysqli_query($connection, "SELECT factory_address FROM factory_details WHERE factory_name='".$row['po_despatchTo']."'");
					while($fact=mysqli_fetch_array($squery)){
				?>
				
				<td width="100" height="50"><strong>Delivery Address:</strong>
						<br><?php echo $fact['factory_address'];?></td>
				<?php } ?>
				<td> 				<p>Terms of Delivery: 
				<br><strong><?php echo $row['po_terms']; ?></strong></p></td>
			</tr>
			
			<tr>	
				<td width="550" height="100">Supplier Name:
				<strong><?php echo $data['supp_name']; ?></strong>
					<br>Supplier Address: <?php echo $data['supp_address']; ?>
					<br>Supplier GSTIN: <?php echo $data['supp_gstin']; ?></td>
				<td> </td>					
			</tr>	

			<table style="width:100%">
				<tr>
					<th style="width: 20px;">Sr. No.</th>
					<th style="width: 80px;">Description of Goods</th>
					<th style="width: 20px;">Quantity</th>
					<th style="width: 20px;">Rate</th>
					<th style="width: 20px;">per</th>
					<th style="width: 20px;">GST %</th>
					<th style="width: 20px;">Amount</th>
				</tr>
				<?php
					$select_query=mysqli_query($connection, "SELECT * from po_details where po_number='$po_number'");
					$sr_no=0;
					$gst=0;
					while($raws=mysqli_fetch_array($select_query)){
						$sr_no++;
				?>
				<tr>
					<th><br><?php echo $sr_no; ?></th>
					<th><br><?php echo $raws['po_material_name']; ?></th>
					<th><br><?php echo $raws['po_material_quantity']; ?></th>
					<td><br><?php 
					$po_rate=0;
					
						if ($row['po_include_gst']=="GST will be added extra" && $raws['po_percent_gst']==5) {
							$po_rate=$raws['po_rate']/1.05;
							echo number_format($po_rate,2);
						}elseif($row['po_include_gst']=="GST will be added extra" && $raws['po_percent_gst']==12) {
							$po_rate=$raws['po_rate']/1.12;
							echo number_format($po_rate,2);
						}elseif($row['po_include_gst']=="GST will be added extra" && $raws['po_percent_gst']==18) {
							$po_rate=$raws['po_rate']/1.18;
							echo number_format($po_rate,2);
						}elseif($row['po_include_gst']=="GST will be added extra" && $raws['po_percent_gst']==28){
							$po_rate=$raws['po_rate']/1.28;
							echo number_format($po_rate,2);
						}else{
							echo $raws['po_rate'];
						}
						if ($row['po_include_gst']=="GST will be added extra") {
							$gst1= $raws['po_amount']-($raws['po_material_quantity']*$po_rate);
							$gst+=round($gst1,2);
						}else{
							$gst1=$raws['po_amount']*$raws['po_percent_gst']/100;
							$gst+=round($gst1,2);
						}
						
					?></td>
					<td><br><?php echo $raws['po_qnty_unit']; ?></td>
					<td><br><?php echo $raws['po_percent_gst']; ?></td>
					<th><br>
						<?php
							if ($row['po_include_gst']=="GST will be added extra") {
								$po_amount=round($po_rate,2)*$raws['po_material_quantity'];
								echo number_format($po_amount,2);	
							}else{
								echo $raws['po_amount'];
							}
						?>
					</th>
				</tr>
				<?php
					}
				?>
				<tr>
					<td> </td>
					<td><b>Other Charges</b> - <?php echo $row['po_other_charges_details']; ?></td>
					<th></th>
					<td> </td>
					<td> </td>
					<td> </td>
					<th><?php echo $row['po_other_charges_amt']; ?></th>
				</tr>
				<tr>
					<td></td>
					<td align="right">
						<strong><i>Input GST</i></strong>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<th><?php
						if ($row['po_include_gst']=="GST will be added extra") {
							echo $gst;	
						}else{
							echo number_format($gst, 2);
						}
					?>
					</th>
				</tr>
				<tr>
					<td> </td>
					<td>Total</td>
					<th><?php echo $row['po_total_quantity'];?></th>
					<td> </td>
					<td> </td>
					<td> </td>
					<th>
						<?php 
						$gst_amt=0;
							if ($row['po_include_gst']=="GST will be added extra") {
								$gst_amt=$row['po_total_amt'];
								echo $gst_amt;	
							}else{
								$gst_amt=$row['po_total_amt']+$gst;
								echo number_format($gst_amt, 2);
							}
						?>
					</th>
				</tr>
			</table>
			<?php
				$number = $gst_amt;
			   	$no = floor($number);
			   	$point = round($number - $no, 2) * 100;
			   	$hundred = null;
			   	$digits_1 = strlen($no);
			   	$i = 0;
			   	$str = array();
			   	$words = array('0' => '', '1' => 'One', '2' => 'Two',
			    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
			    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
			    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
			    '13' => 'Thirteen', '14' => 'Fourteen',
			    '15' => 'Fifteen', '16' => 'Cixteen', '17' => 'Seventeen',
			    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
			    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
			    '60' => 'Sixty', '70' => 'Seventy',
			    '80' => 'Eighty', '90' => 'Ninety');
			   	$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
			   	while ($i < $digits_1) {
			   		$divider = ($i == 2) ? 10 : 100;
			     	$number = floor($no % $divider);
			     	$no = floor($no / $divider);
			     	$i += ($divider == 10) ? 1 : 2;
			     	if ($number) {
			        	$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			        	$hundred = ($counter == 1 && $str[0]) ? 'and ' : null;
			        	$str [] = ($number < 21) ? $words[$number] .
			            " " . $digits[$counter] . $plural . " " . $hundred
			            :
			            $words[floor($number / 10) * 10]
			            . " " . $words[$number % 10] . " "
			            . $digits[$counter] . $plural . " " . $hundred;
			     	} else $str[] = null;
			  	}
			 	$str = array_reverse($str);
				$result = implode('', $str);
				$points = ($point) ?
				    	$words[floor($point / 10)*10] . " " . 
				        $words[$point = $point % 10] : '';
				//echo $result . "Rupees and " . $points . " Paise";
 
			?>
			<p>Amount Chargeable (in words): 
			<br><strong><?php 
			if($points==''){
				echo $result.'Rupees Only';
			}else{
				echo $result.'Rupees and '.$points.' Paise Only';
			}?></strong></p>
			<br>Freight or Forward charges bourn by: <strong><?php echo $row['freight_charges_bourn_by'];?></strong><br>
			<br>Taxes applicability: <strong><?php echo $row['po_include_gst'];?></strong>
			<p> </p>
			<br><br><br><br>
			
			<p>Company’s PAN : <strong><?php echo $pan; ?></strong></p><br><br><br><br>
			
			<table border="1" frame="BOX" rules="NONE" align="right"> 
				<tr><td width="500" align="right"><strong>for <?php echo $full_name.' ('.$short_name.')';?>    </strong>
					<br><br><br>
					Authorised Signatory
				</tr>
				<tr>
			</table>
		</table>
	</div>
	<?php 
		}
	}mysqli_close($connection);
	?>
</body>
</html>
