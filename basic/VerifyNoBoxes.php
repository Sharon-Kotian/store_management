<?php
	include("includes/header.php");
	global $connection;
	
	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	function random_strings($length_of_string) {
		return substr(sha1(time()), 0, $length_of_string);
	}

	if(isset($_POST['submit'])){
		$po_number=$_POST['po_number'];
		$po_boxes_as_per_invoice=$_POST['po_boxes_as_per_invoice'];
		$po_boxes_actual_received=$_POST['po_boxes_actual_received'];
		$po_ordered_date=$_POST['po_ordered_date'];
		$po_invoice_received=$_POST['po_invoice_received'];
		$_SESSION['po_number']=$_POST['po_number'];

		$name=$_FILES['image_of_document']['name'];
		$target_dir="uploads/";
		$target_file=$target_dir.basename($_FILES["image_of_document"]["name"]);
		$imageFileType=strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$extension_arr=array("jpg", "jpeg", "png", "gif", "pdf");
		if(in_array($imageFileType, $extension_arr)){
			$image_base64=base64_encode(file_get_contents($_FILES["image_of_document"]["tmp_name"]));
			$image='data:image/'.$imageFileType.';base64,'.$image_base64;
		}
		$image_of_document=getimagesize($_FILES["image_of_document"]["tmp_name"]);

		$rs=mysqli_query($connection, "SELECT po_number from po_summary where po_number='$po_number'");
		if(mysqli_num_rows($rs)>0){
			$po_din=random_strings(6);
			$update_query=mysqli_query($connection, "UPDATE po_summary SET po_boxes_as_per_invoice='$po_boxes_as_per_invoice', po_boxes_actual_received='$po_boxes_actual_received', po_ordered_date=NOW(), po_din='$po_din', po_invoice_received='$po_invoice_received', po_status='Goods Received', image_of_document='".$image."' WHERE po_number='$po_number'");
			if($update_query){
				move_uploaded_file($_FILES['image_of_document']['tmp_name'],$target_dir.$name);
				echo '<script type="text/javascript">alert("Verified Number of Boxes Successfully.");
				window.location.replace("HandoverToCountingDepartment(Good Review).php")</script>';
			}
			else{
				die("Query Failed " .mysqli_error($connection));
			}
		}
		else{
			echo '<script type="text/javascript">alert("PO Number does not exists");
			window.location.replace("VerifyNoBoxesForm.php")</script>';
		}
	}else{
		echo '<script type="text/javascript">alert("Error Submitting Form");
			window.location.replace("VerifyNoBoxesForm1.php")</script>';
	}
?>