<?php
	include_once ("includes/db.php");
	global $connection;
	session_start();

	// if($_SESSION['user_dept'] != 'goods_receiving'){
	// 	echo '<script type="text/javascript">alert("Access Denied.")';
	// 	header("Location: ../login.html");
	// }
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Print</title>
</head>
<body onload="window.print()">

	<?php
		$po_number=$_SESSION['po_number'];
		$rs=mysqli_query($connection, "SELECT po_din, po_boxes_actual_received from po_summary WHERE po_number='$po_number'");
		$row=mysqli_fetch_array($rs);
		if($row){
			$po_din=$row['po_din'];
			$po_boxes_actual_received=$row['po_boxes_actual_received'];
			for($i=1;$i<=$po_boxes_actual_received;$i++){?>
				<input type="text" name="txt" style="height: 67px; width: 126px; text-align: center; size: 18px; margin-bottom: 5px;" value="<?php echo $po_din; ?>" disabled>				
			<?php
			}
		}
		mysqli_close($connection);
	?>
</body>
</html>