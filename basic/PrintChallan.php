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
	<title>Print Challan</title>
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
	<link rel="stylesheet" href="htmlToPDFfile/htmlTOpdf.css">
	<script src="htmlToPDFfile/htmlTOpdfJavascript.js"></script>
	<script src="htmlToPDFfile/htmlTOpdfscript.js"></script>
	<script src="htmlToPDFfile/JS/addRowButton.js"></script>
</head>
<body onload="window.print()">
	<div id="PurchaseOrder">
		<br><br>
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
		<h3 align="center"><?php echo $full_name.' ('.$short_name.')';?></h3>
		<h1>Job work challan</h1>
		<br><br>
		<table style="width:100%">
			<tr>
				<?php 
					$jw_id=$_SESSION['jw_id'];
					$jw_tot_amt=$_SESSION['jw_tot_amt'];
					$jw_challan = $_SESSION['jw_challan'];

					$jw_query = mysqli_query($connection, "SELECT * from ext_job_work WHERE jw_id = '$jw_id'");
					if($jw_row = mysqli_fetch_array($jw_query)){
						$jw_exp_date = $jw_row['jw_exp_date'];
					}
				?>
				<td width="150" height="200">
					<p style="margin-left: 20px;">Invoice To:</p>
					
					<p style="margin-left: 20px;"><strong><?php 
						echo $full_name.' ('.$short_name.')';?></strong></p>
					<p style="margin-left: 20px;">
					<br>
						<?php echo $full_addr;?><br>
						<?php echo 'GSTIN/UIN: '.$gstin;?><br>
						<?php echo 'E-Mail:'.' '.$email;?><br></p>
				</td>
				<td>
					<table style="width:100%; border: none;">
						<tr width="100%" height="85" style="border: none;">
							<td width="100" height="50" style="border: none; border-bottom: 1px solid black;">Challan Number:
							<br><?php echo $jw_challan; ?></td>						
						</tr>
						<tr height="85">
							<td width="100" height="50" style="border: none; border-bottom: 1px solid black;">Dated:
							<br><?php echo date('d-M-Y');?></td>
						</tr>
						<tr height="85">
							<td width="100" height="50" style="border: none;">Buyer's Order Number:
							<br><input type="text" name="Name"></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<tr>
				<td width="550" height="120"><p style="margin-left: 20px; margin-right: 20px;">Party:
					<br><input type="text" name="Name" size="60"></p>
				</td>

				<td>
					<table style="width:100%; border: none;">
						<tr height="100">
							<td width="100" height="50" style="border: none; border-bottom: 1px solid black;">Dispatch Document Number:
							<br><input type="text" name="Name" size="20"></td>
						</tr>
						<tr height="100">
							<td width="100" height="50" style="border: none;">Duration Of Process:
							<br><input type="text" name="Name" size="20"></td>
						</tr>
					</table>
				</td>
			</tr>	

			<table style="width:100%">
				<tr>
					<th style="width: 10%;">Sr. No.</th>
					<th style="width: 30%;">Description of Goods</th>
					<th style="width: 15%;">Due on</th>
					<th style="width: 5%;">Quantity</th>
					<th style="width: 10%;">Rate</th>
					<th style="width: 5%;">per</th>
					<th style="width: 15%;">Disc. %</th>
					<th style="width: 10%;">Amount</th>
				</tr>
				<?php
					$select_query=mysqli_query($connection, "SELECT * from job_work_summary where jw_id='$jw_id'");
					$sr_no=0;
					while($row=mysqli_fetch_array($select_query)){
						$sr_no++;
				?>
				<tr>
					<td align="center"><br><?php echo $sr_no; ?></td>
					<td><br><?php echo $row['rm_name']; ?></td>
					<td><br>
						<?php 
							if($jw_exp_date == "0000-00-00 00:00:00"){
								echo "N/A";
							}
							else{
								echo date('d-m-Y', strtotime($jw_exp_date));
							}
						?>
					</td>
					<td><br><?php echo (int)$row['submitted_quantity']; ?></td>
					<td><br></td>
					<td><br>Nos.</td>
					<td><br></td>
					<td><br></td>
				</tr>
				<?php
					}
				?>
				<tr>
					<td> </td>
					<td><strong>Total</strong></td>
					<td> </td>
					<td></td>
					<td> </td>
					<td> </td>
					<td> </td>
					<td><?php echo $jw_tot_amt; ?></td>
				</tr>
			</table>
			<?php
				$number = $jw_tot_amt;
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
				    "." . $words[$point / 10] . " " . 
				          $words[$point = $point % 10] : '';
				//echo $result . "Rupees and " . $points . " Paise";
 
			?>
			<br><p>Amount Chargeable (in words): 
			<?php echo $result.'Rupees and'.$points.' Paise Only';?></p>
			<p> </p>
			<br><br><br><br>
			
			<p>Company’s PAN : <?php echo $pan; ?></p>
			
			<table border="1" frame="BOX" rules="NONE" align="right"> 
				<tr><td>for <?php echo $full_name.' ('.$short_name.')'; ?><br><br>
					<br><br><br><br>
					<p>Authorised Signatory</p>
				</td>
				<tr>
				
			</table>
		</table>
		<br><br><br><br>
	</div> <br><br><br><br>
</body>
</html>
