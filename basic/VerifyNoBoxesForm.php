<?php
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'goods_receiving'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: login.html");
	}
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

	<title>Receive goods</title>
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
    <script>
        
		$(document).ready(function() {
            $("#po_number").select2();
            $('#but_read').click(function() {
                var username = $('#po_number option:selected').text();
                var userid = $('#po_number').val();
                $('#result').html("id : " + userid + ", name : " + username);
            });
        });
    </script>

    <script type="text/javascript">
		$(function() {
		    $('input[name="po_invoice_received"]').on('click', function() {
		        if ($(this).val() == 'Yes') {
		            $('#textboxes').show();
		        }
		        else {
		            $('#textboxes').hide();
		        }
		    });
		});
	</script>

<meta name="viewport" content=" width=device-width,  initial-scale=1.0, maximum-scale=1.0, user-scalable=no " /> 		
	
</head>
<body class="bg-light text-dark">
<header>
	<?php 
    //include "../includes/header.php";
	//global $connection;
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	?>
	
	<hr style="height:2px" color="black">
	<h1 class="display-3" align="center">Receive goods</h1>
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
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='VerifyNoBoxesForm1.php'">
				  Receive goods
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ViewNoBoxes.php'">
					DIN Reprint
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='ListofGoodsReceived.php'">
					List of Goods Received in past
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='HandoverToCounting.php'">
					Handover To Counting Department
				  </button><br><br>
				  <button class="btn btn-primary btn-lg" style="width: 275px; height: 45px;" onClick="parent.location='din_status.php'">
					DIN Status
				  </button>
			</div>
		  </div>
</div>

    <div class="wrapper fadeInDown">
        <div id="formContent"><br><br>
        	<form name="frm" method="post">
            <table style="width:50%" id="tableContent" align="center">
            <tr align="center">
            	<?php
            		$supp_name=$_SESSION['supp_name'];
            	?>
				<td align="center" class="form-label">Supplier Name : </td>
				<td><input type="text" id="supp_name" class="form-control" name="supp_name" style="width: 350px; height: 40px;" value="<?php echo $supp_name; ?>" readonly>
				</td>
			</tr>
            <tr align="center">									
				<td align="center" class="form-label"><br><br>PO Number: </td>
				<td align="center"><br><br><select name="po_number" id="po_number" style="width: 350px; height: 40px;">
					<?php
						$result=mysqli_query($connection, "SELECT supp_id fROM supplier WHERE supp_name='$supp_name'");
						$data=mysqli_fetch_array($result);
						if(mysqli_num_rows($result)){
							$supp_id=$data['supp_id'];
							$query=mysqli_query($connection, "SELECT po_number FROM po_summary WHERE po_supp_id='$supp_id' AND (po_status='PO issued' OR po_status='Goods Received')");
							while($row=mysqli_fetch_array($query)){
								echo "<option value='".$row['po_number']."'>".$row['po_number']."</option>";
							}
						}	
					?>
				</select> 
				</td>
			</tr>
		</table><br><br>
            <p align="center"><input type="submit" class="btn btn-primary btn-lg" value="  Submit  " name="submit"></p>
            </form>
        </div>
    </div>
</body>

</html>
<?php
	if(isset($_POST['submit'])){
		$po_number=$_POST['po_number'];
		$_SESSION['po_number']=$_POST['po_number'];
		if($po_number==''){
			echo '<script>alert("PO Number is empty");
			window.location.replace("VerifyNOBoxesForm1.php")</script>';
		}else{
			echo '<script>window.location.replace("VerifyNOBoxesForm2.php")</script>';
		}
		
	};
	mysqli_close($connection);
?>
