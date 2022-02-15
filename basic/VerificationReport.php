<?php 
	include_once ("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}
	
	
	//if(isset($_POST['submit1']))
	//{
			//$r=$cnt;
			//echo "Selected";
			//$cnt=$_POST['cnt'];
			//echo $cnt;
			
			/*for($x=1; $x<=$cnt; $x++)
			{
				$dsid='ds_cnt'.$x;
				$dcid='dc_cnt'.$x;
				$dqid='dq_cnt'.$x;
				$drid='dr_cnt'.$x;
				$djid='dj_cnt'.$x;
				$dtid='dt_cnt'.$x;
				
				$sid='s_cnt'.$x;
				$cid='c_cnt'.$x;
				$qid='q_cnt'.$x;
				$rid='r_cnt'.$x;
				$jid='j_cnt'.$x;
				$tid='t_cnt'.$x;				
				
				$rsid='rs_cnt'.$x;
				$rcid='rc_cnt'.$x;
				$rqid='rq_cnt'.$x;
				$rrid='rr_cnt'.$x;
				$rjid='rj_cnt'.$x;
				$rtid='rt_cnt'.$x;
				
				$d1=$_POST[$dsid];
				$d2=$_POST[$dcid];
				$d3=$_POST[$dqid];
				$d4=$_POST[$drid];
				$d5=$_POST[$djid];
				$d6=$_POST[$dtid];
				
				$r1=$_POST[$rsid];
				$r2=$_POST[$rcid];
				$r3=$_POST[$rqid];
				$r4=$_POST[$rrid];
				$r5=$_POST[$rjid];
				$r6=$_POST[$rtid];
				
				$s=$_POST[$sid];
				$c=$_POST[$cid];
				$q=$_POST[$qid];
				$r=$_POST[$rid];
				$j=$_POST[$jid];
				$t=$_POST[$tid];
				
				$i='rid'.$x;
				$id=$_POST[$i];
				
				if($d1>0)
				{
					if($r1==1)
					{*/
						
						/*$query1 = "update raw_materials set rm_stores_quantity=1 where rm_id=3705";
						$update=mysqli_query($connection,$query1);*/
					//}
				//}
				
				/*if($update)
				{
					echo '<script>alert("Placed Purchase Order Successfully.")</script>';
				}
				else
				{
					echo '<script>alert("Error Placing Purchase Order. '.mysqli_error($connection).'")</script>';
				}*/
				
				
			//}
	//}
	/*else
	{
		echo "Not selected";
	}*/
	
	
	if(isset($_POST['submit2'])){
						/*$rm_name_update = $_POST['rm_name_table'];
						$caret_id_update = $_POST['caret_id_update'];
						$caret_narration_update = $_POST['caret_narration'];
						
						foreach ($rm_name_update as $index => $names) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_caret_id='$caret_id_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
							
							if($caret_narration_update[$index] != ""){
								$update_caret_narration= mysqli_query($connection, "UPDATE store_caret SET caret_narration='$caret_narration_update[$index]' WHERE caret_id='$caret_id_update[$index]'");
							}
							else{
								$update_caret_narration = true;
							}
						}
						
						if($update_query && $update_caret_narration){
							echo '<script type="text/javascript">alert("Caret Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Caret Not Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}*/
						
						$scnt=$_POST['s_cnt'];
						$ccnt=$_POST['c_cnt'];
						$qcnt=$_POST['q_cnt'];
						$rcnt=$_POST['r_cnt'];
						$jcnt=$_POST['j_cnt'];
						$tcnt=$_POST['t_cnt'];
						
						
						$dscnt=$_POST['ds_cnt'];
						$dccnt=$_POST['dc_cnt'];
						$dqcnt=$_POST['dq_cnt'];
						$drcnt=$_POST['dr_cnt'];
						$djcnt=$_POST['dj_cnt'];
						$dtcnt=$_POST['dt_cnt'];
						
						$rscnt=$_POST['rs_cnt'];
						$rccnt=$_POST['rc_cnt'];
						$rqcnt=$_POST['rq_cnt'];
						$rrcnt=$_POST['rr_cnt'];
						$rjcnt=$_POST['rj_cnt'];
						$rtcnt=$_POST['rt_cnt'];
						
						$v_on=$_POST['v_on'];
						$v_by=$_POST['v_by'];
						
						$i=$_POST['i'];
						
						foreach ($v_by as $index => $value) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_last_edited_by='$v_by[$index]' WHERE rm_id='$i[$index]'");
						}
						
						foreach ($v_on as $index => $value) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_verification_date='$v_on[$index]' WHERE rm_id='$i[$index]'");
						}
						
						
						foreach ($scnt as $index => $value) {
							
							if($dscnt[$index]!=0)
							{
								if($rscnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$scnt[$index]' WHERE rm_id='$i[$index]'");
									
								}
							}
							
						}
						
						foreach ($ccnt as $index => $value) {
							
							if($dccnt[$index]!=0)
							{
								if($rccnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity='$ccnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($qcnt as $index => $value) {
							
							if($dqcnt[$index]!=0)
							{
								if($rqcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity='$qcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($rcnt as $index => $value) {
							
							if($drcnt[$index]!=0)
							{
								if($rrcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_rework_quantity='$rcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($jcnt as $index => $value) {
							
							if($djcnt[$index]!=0)
							{
								if($rjcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_jobwork_quantity='$jcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}		
						
						
						
					}
					
		
	
	if(isset($_POST['submit3'])){
						/*$rm_name_update = $_POST['rm_name_table'];
						$caret_id_update = $_POST['caret_id_update'];
						$caret_narration_update = $_POST['caret_narration'];
						
						foreach ($rm_name_update as $index => $names) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_caret_id='$caret_id_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
							
							if($caret_narration_update[$index] != ""){
								$update_caret_narration= mysqli_query($connection, "UPDATE store_caret SET caret_narration='$caret_narration_update[$index]' WHERE caret_id='$caret_id_update[$index]'");
							}
							else{
								$update_caret_narration = true;
							}
						}
						
						if($update_query && $update_caret_narration){
							echo '<script type="text/javascript">alert("Caret Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Caret Not Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}*/
						
						$scnt=$_POST['s_cnt'];
						$ccnt=$_POST['c_cnt'];
						$qcnt=$_POST['q_cnt'];
						$rcnt=$_POST['r_cnt'];
						$jcnt=$_POST['j_cnt'];
						$tcnt=$_POST['t_cnt'];
						
						
						$dscnt=$_POST['ds_cnt'];
						$dccnt=$_POST['dc_cnt'];
						$dqcnt=$_POST['dq_cnt'];
						$drcnt=$_POST['dr_cnt'];
						$djcnt=$_POST['dj_cnt'];
						$dtcnt=$_POST['dt_cnt'];
						
						$rscnt=$_POST['rs_cnt'];
						$rccnt=$_POST['rc_cnt'];
						$rqcnt=$_POST['rq_cnt'];
						$rrcnt=$_POST['rr_cnt'];
						$rjcnt=$_POST['rj_cnt'];
						$rtcnt=$_POST['rt_cnt'];
						
						$v_on=$_POST['v_on'];
						$v_by=$_POST['v_by'];
						
						$i=$_POST['i'];
						
						
						foreach ($scnt as $index => $value) {
							
							if($dscnt[$index]!=0)
							{
								if($rscnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$scnt[$index]',rm_last_edited_by='$v_by[$index]',rm_verification_date='$v_on[$index]' WHERE rm_id='$i[$index]'");
								}
								
							}
							
						}
						
						foreach ($ccnt as $index => $value) {
							
							if($dccnt[$index]!=0)
							{
								if($rccnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity='$ccnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($qcnt as $index => $value) {
							
							if($dqcnt[$index]!=0)
							{
								if($rqcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity='$qcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($rcnt as $index => $value) {
							
							if($drcnt[$index]!=0)
							{
								if($rrcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_rework_quantity='$rcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($jcnt as $index => $value) {
							
							if($djcnt[$index]!=0)
							{
								if($rjcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_jobwork_quantity='$jcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}		
						
						
						
					}
	
	
	
	
	
	if(isset($_POST['submit4'])){
						/*$rm_name_update = $_POST['rm_name_table'];
						$caret_id_update = $_POST['caret_id_update'];
						$caret_narration_update = $_POST['caret_narration'];
						
						foreach ($rm_name_update as $index => $names) {
							$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_caret_id='$caret_id_update[$index]' WHERE rm_name='$rm_name_update[$index]'");
							
							if($caret_narration_update[$index] != ""){
								$update_caret_narration= mysqli_query($connection, "UPDATE store_caret SET caret_narration='$caret_narration_update[$index]' WHERE caret_id='$caret_id_update[$index]'");
							}
							else{
								$update_caret_narration = true;
							}
						}
						
						if($update_query && $update_caret_narration){
							echo '<script type="text/javascript">alert("Caret Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}
						else{
							echo '<script type="text/javascript">alert("Caret Not Updated.");
							window.location.replace("AlignItemsInCarets.php")</script>';
						}*/
						
						$scnt=$_POST['s_cnt'];
						$ccnt=$_POST['c_cnt'];
						$qcnt=$_POST['q_cnt'];
						$rcnt=$_POST['r_cnt'];
						$jcnt=$_POST['j_cnt'];
						$tcnt=$_POST['t_cnt'];
						
						
						$dscnt=$_POST['ds_cnt'];
						$dccnt=$_POST['dc_cnt'];
						$dqcnt=$_POST['dq_cnt'];
						$drcnt=$_POST['dr_cnt'];
						$djcnt=$_POST['dj_cnt'];
						$dtcnt=$_POST['dt_cnt'];
						
						$rscnt=$_POST['rs_cnt'];
						$rccnt=$_POST['rc_cnt'];
						$rqcnt=$_POST['rq_cnt'];
						$rrcnt=$_POST['rr_cnt'];
						$rjcnt=$_POST['rj_cnt'];
						$rtcnt=$_POST['rt_cnt'];
						
						$v_on=$_POST['v_on'];
						$v_by=$_POST['v_by'];
						
						$i=$_POST['i'];
						
						
						foreach ($scnt as $index => $value) {
							
							if($dscnt[$index]!=0)
							{
								if($rscnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_stores_quantity='$scnt[$index]',rm_last_edited_by='$v_by[$index]',rm_verification_date='$v_on[$index]' WHERE rm_id='$i[$index]'");
								}
								
							}
							
						}
						
						foreach ($ccnt as $index => $value) {
							
							if($dccnt[$index]!=0)
							{
								if($rccnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_counting_quantity='$ccnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($qcnt as $index => $value) {
							
							if($dqcnt[$index]!=0)
							{
								if($rqcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_qc_quantity='$qcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($rcnt as $index => $value) {
							
							if($drcnt[$index]!=0)
							{
								if($rrcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_rework_quantity='$rcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}
						
						foreach ($jcnt as $index => $value) {
							
							if($djcnt[$index]!=0)
							{
								if($rjcnt[$index]==1)
								{
									$update_query= mysqli_query($connection, "UPDATE raw_materials SET rm_jobwork_quantity='$jcnt[$index]' WHERE rm_id='$i[$index]'");
								}
							}
							
						}		
						
						
						
					}
	
	
	
	
	/*if(isset($_POST['submit2']))
	{
		//$r=$cnt;
		echo "Selected";
		
		$cnt=$_POST['cnt'];
		echo $cnt;
		//$cnt=$_POST['cnt'];
			//echo $cnt;
			
			for($x=1; $x<=$cnt; $x++)
			{
				$dsid='ds_cnt'.$x;
				$dcid='dc_cnt'.$x;
				$dqid='dq_cnt'.$x;
				$drid='dr_cnt'.$x;
				$djid='dj_cnt'.$x;
				$dtid='dt_cnt'.$x;
				
				$sid='s_cnt'.$x;
				$cid='c_cnt'.$x;
				$qid='q_cnt'.$x;
				$rid='r_cnt'.$x;
				$jid='j_cnt'.$x;
				$tid='t_cnt'.$x;				
				
				$rsid='rs_cnt'.$x;
				$rcid='rc_cnt'.$x;
				$rqid='rq_cnt'.$x;
				$rrid='rr_cnt'.$x;
				$rjid='rj_cnt'.$x;
				$rtid='rt_cnt'.$x;
				
				$d1=$_POST[$dsid];
				$d2=$_POST[$dcid];
				$d3=$_POST[$dqid];
				$d4=$_POST[$drid];
				$d5=$_POST[$djid];
				$d6=$_POST[$dtid];
				
				$r1=$_POST[$rsid];
				$r2=$_POST[$rcid];
				$r3=$_POST[$rqid];
				$r4=$_POST[$rrid];
				$r5=$_POST[$rjid];
				$r6=$_POST[$rtid];
				
				$s=$_POST[$sid];
				$c=$_POST[$cid];
				$q=$_POST[$qid];
				$r=$_POST[$rid];
				$j=$_POST[$jid];
				$t=$_POST[$tid];
				
				$i='rid'.$x;
				$id=$_POST[$i];
				
				if($d1>0)
				{
					$update=0;
					if($r1==1)
					{
						$query1 = "update raw_materials set rm_stores_quantity='$s' where rm_id='$id'";
						$update=mysqli_query($connection,$query1);
						continue;
					}
				}
				//continue;
				
				
			}
	}
	else
	{
		echo "Not selected";
	}
	
	if(isset($_POST['submit1']))
	{
		
						$query1 = "update raw_materials set rm_stores_quantity=1 where rm_id=3705";
						$update=mysqli_query($connection,$query1);
					//}
				//}
				
				if($update)
				{
					echo '<script>alert("Placed Purchase Order Successfully.")</script>';
				}
				else
				{
					echo '<script>alert("Error Placing Purchase Order. '.mysqli_error($connection).'")</script>';
				}
	}
	else
	{
		echo "Not selected";
	}
*/
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

	<title>Verification report</title>
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
		$("#fps_name").select2();
		//$("#reason").select2();
	});
	
	/*function findTotal(){
		var po_material_quantity_id = "po_material_quantity";
		po_material_quantity_id = po_material_quantity_id.concat(po_rate_id.replace("po_rate",""));
		console.log(po_material_quantity_id);
		var amount_id = "textbox";
		amount_id = amount_id.concat(po_rate_id.replace("po_rate",""));
		console.log(amount_id);
		
		var s_cnt=document.getElementById("s_cnt").value;
		var c_cnt=document.getElementById("c_cnt").value;
		var q_cnt=document.getElementById("q_cnt").value;
		var r_cnt=document.getElementById("r_cnt").value;
		var j_cnt=document.getElementById("j_cnt").value;
		
		console.log("Function Called")
		
		
		/*var arr = document.getElementsByClassName('form-control form-control-lg');
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
			
		var tot;
		tot=parseFloat(parseFloat(s_cnt)+parseFloat(c_cnt)+parseFloat(q_cnt)+parseFloat(r_cnt)+parseFloat(j_cnt));
		/*}
		if(other_charges!="")
		{
			document.getElementById('po_total_amt').value = Number(tot)+Number(other_charges);	
		}
	    	else
		{
			document.getElementById('po_total_amt').value = tot;
		}
		document.getElementById('t_cnt').value=tot;
	    // document.getElementById('other_charges').value = tot;
	}*/
	
	/*function tot(){
	var table=document.getElementById("table1"),sum=0;
	for(var i=1;i<table.rows.length;i++)
	{
		sum=sum+parseInt(table.rows[i].cells[3])+parseInt(table.rows[i].cells[4])+parseInt(table.rows[i].cells[5])+parseInt(table.rows[i].cells[6])+parseInt(table.rows[i].cells[7]);
	}
	document.getElementById('t_cnt').value=tot;
	}*/
	
	
	function findDiff(){
		/*var po_material_quantity_id = "po_material_quantity";
		po_material_quantity_id = po_material_quantity_id.concat(po_rate_id.replace("po_rate",""));
		console.log(po_material_quantity_id);
		var amount_id = "textbox";
		amount_id = amount_id.concat(po_rate_id.replace("po_rate",""));
		console.log(amount_id);*/
		
		var s_cnt=document.getElementById("s_cnt").value;
		var c_cnt=document.getElementById("c_cnt").value;
		var q_cnt=document.getElementById("q_cnt").value;
		var r_cnt=document.getElementById("r_cnt").value;
		var j_cnt=document.getElementById("j_cnt").value;
		
		console.log("Function Called")
		
		
		/*var arr = document.getElementsByClassName('form-control form-control-lg');
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
				tot += parseFloat(arr[i].value);*/
			
		var tot;
		tot=parseFloat(parseFloat(s_cnt)+parseFloat(c_cnt)+parseFloat(q_cnt)+parseFloat(r_cnt)+parseFloat(j_cnt));
		/*}
		if(other_charges!="")
		{
			document.getElementById('po_total_amt').value = Number(tot)+Number(other_charges);	
		}
	    	else
		{
			document.getElementById('po_total_amt').value = tot;
		}*/
		document.getElementById('t_cnt').value=tot;
	    // document.getElementById('other_charges').value = tot;
	}
	
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
	<h1 class="display-3" align="center">Verification report</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='stores_home.php'">
				Dashboard
				</button><br>
				<hr>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AddItemsInCaret.php'">
				Add New Caret
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='UpdateOpeningStock.php'">
				Update opening stock
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='PrintQuantityVerification.php'">
				Print For Verification
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AlignItemsInCarets.php'">
				Allocate Caret ID
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='RawMaterialInformation.php'">
				Search Caret ID
				</button>
			</div>
		</div>
	</div>
	
 
<div class="wrapper fadeInDown"> <div id="formContent">
		<p align="center">
			<br><br>
			<a class="btn btn-primary btn-lg" href="VerificationReport.php?source=Finished" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Finished Product Wise</a>
			<a class="btn btn-primary btn-lg" href="VerificationReport.php?source=Entire" ONCLICK="ShowProduct()" style="width: 250px; height: 50px;">Entire List</a>
		<a class="btn btn-primary btn-lg" href="VerificationReport.php?source=Verification" ONCLICK="ShowRowMaterial()" style="width: 250px; height: 50px;">Verification Pending</a>
			</p>
	
	</div>
	
	<div class="row" align="center">
		<form method="post">
			<?php
				if(isset($_GET['source']))
				{
					$source = $_GET['source'];
				}
				else
				{
					$source = '';
				}	switch ($source)
				{
					case 'Finished':
						
						//global $connection;
						$cnt=1;
						echo '<br><br>';
						echo '<select name="fps_name" id="fps_name" class="form-control form-select" style="width: 400px; height: 45px;" required>';
						echo '<option value="">Select Finished Good Name</option>';
						$query = "SELECT DISTINCT fps_id,fps_name FROM finished_product_summary";
						$raw_mat = mysqli_query($connection,$query);
						
						while ($row = mysqli_fetch_assoc($raw_mat)) 
						{
							$fps_id = $row['fps_id'];
							$fps_name = $row['fps_name'];
							//echo $fps_name;
							echo "<option value=$fps_id>$fps_name</option>";
						}
						echo "</select>";
						echo '<br><br>';
						echo '<input type="submit" name="fps_name_submit" class="btn btn-primary btn-lg" value="Submit"></form>';
						
						if(isset($_POST['fps_name_submit']))
						{
							//echo $_POST['material_name'];
							$fps_name1 = $_POST['fps_name'];
							
							
							$query = "select fpd_material_name from finished_product_summary,finished_product_details where finished_product_details.fps_id=finished_product_summary.fps_id AND finished_product_summary.fps_id='$fps_name1'";
							$raw_mat_query = mysqli_query($connection,$query);
						?>

						<center><table class="table table-bordered" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th rowspan=2>Caret Id</th>
									<th rowspan=2>Name of Raw Material</th>
									<th rowspan=2></th>
                                    <th colspan=6>Quantity</th>
                                    <th rowspan=2>Verified On</th>        
									<th rowspan=2>Verified By</th>                 
                                </tr>
								<tr>
									<th>Stores</th>
									<th>Counting</th>
									<th>Quality Check</th>
									<th>Rework</th>
									<th>Jobwork</th>
									<th>TOTAL</th>
								</tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($row = mysqli_fetch_assoc($raw_mat_query)) 
							{
								//$cnt=0;
								//$cnt++;
								$fpd_mat_name=$row['fpd_material_name'];
								//echo $row['fpd_material_name'];
								$selectquery = mysqli_query($connection,"select * from raw_materials where rm_name = '$fpd_mat_name'");
								while($rows = mysqli_fetch_assoc($selectquery)){
								
								$rm_name=$rows['rm_name'];
								$rm_id=$rows['rm_id'];
								$caret_id=$rows['rm_caret_id'];
								$store_cnt=$rows['rm_stores_quantity'];
								$counting_cnt=$rows['rm_counting_quantity'];
								$quality_cnt=$rows['rm_qc_quantity'];
								$rework_cnt=$rows['rm_rework_quantity'];
								$jobwork_cnt=$rows['rm_jobwork_quantity'];
								$total_cnt=$store_cnt+$counting_cnt+$quality_cnt+$rework_cnt+$jobwork_cnt;
								
								//$caret_query=mysqli_query($connection,"select * from store_caret where caret_material_name='$rm_name'");
								//$caret_id = '';
								//while($id=mysqli_fetch_array($caret_query)){
									//$caret_id=$id['caret_id'];
								//}
								
								$bsid='bs_cnt'.$cnt;
								$bcid='bc_cnt'.$cnt;
								$bqid='bq_cnt'.$cnt;
								$brid='br_cnt'.$cnt;
								$bjid='bj_cnt'.$cnt;
								$btid='bt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center' rowspan=4>$caret_id</td>";
								echo "<td align='center' rowspan=4>$rm_name</td>";
								echo "<td align='center'>As per books</td>";
								echo "<td align='center' id=$bsid>$store_cnt</td>";
								echo "<td align='center' id=$bcid>$counting_cnt</td>";          
								echo "<td align='center' id=$bqid>$quality_cnt</td>";					
								echo "<td align='center' id=$brid>$rework_cnt</td>";
								echo "<td align='center' id=$bjid>$jobwork_cnt</td>";
								echo "<td align='center' id=$btid>$total_cnt</td>";
								echo "<td align='center' rowspan=4><form method='post'><input type='date' name='v_on[]' id='v_on' value='' class='form-control' style='width:170px;height:30px'></td>";
								echo "<td align='center' rowspan=4><input type='text' class='form-control' name='v_by[]' id='v_by' value='' style='width:150px;height:30px'></td>";
								echo "</tr>";
								echo '<script>
								function findTotal(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		console.log("Function Called");
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		
			
		var tot;
		tot=parseFloat(parseFloat(s_cnt)+parseFloat(c_cnt)+parseFloat(q_cnt)+parseFloat(r_cnt)+parseFloat(j_cnt));
		
		document.getElementById(tid).value=tot;
	    
	}
							
							
														function findDiff(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		var dsid="ds_cnt";
		dsid=dsid.concat(caret_id);
		var dcid="dc_cnt";
		dcid=dcid.concat(caret_id);
		var dqid="dq_cnt";
		dqid=dqid.concat(caret_id);
		var drid="dr_cnt";
		drid=drid.concat(caret_id);
		var djid="dj_cnt";
		djid=djid.concat(caret_id);
		var dtid="dt_cnt";
		dtid=dtid.concat(caret_id);
		
		var bsid="bs_cnt";
		bsid=bsid.concat(caret_id);
		var bcid="bc_cnt";
		bcid=bcid.concat(caret_id);
		var bqid="bq_cnt";
		bqid=bqid.concat(caret_id);
		var brid="br_cnt";
		brid=brid.concat(caret_id);
		var bjid="bj_cnt";
		bjid=bjid.concat(caret_id);
		var btid="bt_cnt";
		btid=btid.concat(caret_id);
		
		var s=document.getElementById(bsid);
		var s1=s.innerHTML;
		
		var c=document.getElementById(bcid);
		var c1=c.innerHTML;
		
		var q=document.getElementById(bqid);
		var q1=q.innerHTML;
		
		var r=document.getElementById(brid);
		var r1=r.innerHTML;
		
		var j=document.getElementById(bjid);
		var j1=j.innerHTML;
		
		var t=document.getElementById(btid);
		var t1=t.innerHTML;
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		console.log("Function Called")
		
		
		
		
		var d1,d2,d3,d4,d5,d6;
		
		d1=parseFloat(Math.abs(parseFloat(s1)-parseFloat(s_cnt)));
		d2=parseFloat(Math.abs(parseFloat(c1)-parseFloat(c_cnt)));
		d3=parseFloat(Math.abs(parseFloat(q1)-parseFloat(q_cnt)));
		d4=parseFloat(Math.abs(parseFloat(r1)-parseFloat(r_cnt)));
		d5=parseFloat(Math.abs(parseFloat(j1)-parseFloat(j_cnt)));
		d6=parseFloat(Math.abs(parseFloat(t1)-parseFloat(t_cnt)));
		
		document.getElementById(dsid).value=d1;
		document.getElementById(dcid).value=d2;
		document.getElementById(dqid).value=d3;
		document.getElementById(drid).value=d4;
		document.getElementById(djid).value=d5;
		document.getElementById(dtid).value=d6;
	    
	}
							</script>'?>
								<?php
								$sid='s_cnt'.$cnt;
								$cid='c_cnt'.$cnt;
								$qid='q_cnt'.$cnt;
								$rid='r_cnt'.$cnt;
								$jid='j_cnt'.$cnt;
								$tid='t_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>As per verification</td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$sid name='s_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$cid name='c_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$qid name='q_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$rid name='r_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$jid name='j_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='text' class='form-control' name='t_cnt[]' id=$tid readonly></td>";
								echo "</tr>";
								//$cnt=$cnt+1;
								//echo $cnt;
								
								
								$dsid='ds_cnt'.$cnt;
								$dcid='dc_cnt'.$cnt;
								$dqid='dq_cnt'.$cnt;
								$drid='dr_cnt'.$cnt;
								$djid='dj_cnt'.$cnt;
								$dtid='dt_cnt'.$cnt;
								
								$id='rid'.$cnt;
								echo "<tr>";
								echo "<td align='center'>Difference</td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dsid name='ds_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dcid name='dc_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dqid name='dq_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$drid name='dr_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$djid name='dj_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dtid name='dt_cnt[]' readonly><input type='text' class='form-control' id='i' name='i[]' value=$rm_id hidden></td>";
								echo "</tr>";
								
								$rsid='rs_cnt'.$cnt;
								//echo $rsid;
								$rcid='rc_cnt'.$cnt;
								$rqid='rq_cnt'.$cnt;
								$rrid='rr_cnt'.$cnt;
								$rjid='rj_cnt'.$cnt;
								$rtid='rt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>Reason</td>";
								echo "<td align='center'><select class='form-control form-select' name='rs_cnt[]' id=$rsid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rc_cnt[]' id=$rcid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rq_cnt[]' id=$rqid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rr_cnt[]' id=$rrid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rj_cnt[]' id=$rjid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rt_cnt[]' id=$rtid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "</tr>";
								//$cnt++;
								$cnt=$cnt+1;
							
						?>
							<?php
								echo "</tr>";
							}
							}
							echo '</tbody>';
                        	echo '</table></center>';
							$cnt=$cnt-1;
							echo "<center><input type='submit' name='submit2' value='Update' class='btn btn-primary btn-lg' style='width: 250px; height: 50px';><center>";
							
						}
						echo "</form>";
						
						break;

                      case 'Entire':
							 $cnt=1;
							$i=array();
							$query = "select * from raw_materials";
							$raw_mat_query = mysqli_query($connection,$query);
						
						?>
						<table class="table table-bordered" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th rowspan=2>Caret Id</th>
									<th rowspan=2>Name of Raw Material</th>
									<th rowspan=2></th>
                                    <th colspan=6>Quantity</th>
                                    <th rowspan=2>Verified On</th>        
									<th rowspan=2>Verified By</th>                 
                                </tr>
								<tr>
									<th>Stores</th>
									<th>Counting</th>
									<th>Quality Check</th>
									<th>Rework</th>
									<th>Jobwork</th>
									<th>TOTAL</th>
								</tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($rows = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$rm_name=$rows['rm_name'];
								$rm_id=$rows['rm_id'];
								$caret_id=$rows['rm_caret_id'];
								$store_cnt=$rows['rm_stores_quantity'];
								$counting_cnt=$rows['rm_counting_quantity'];
								$quality_cnt=$rows['rm_qc_quantity'];
								$rework_cnt=$rows['rm_rework_quantity'];
								$jobwork_cnt=$rows['rm_jobwork_quantity'];
								$total_cnt=$store_cnt+$counting_cnt+$quality_cnt+$rework_cnt+$jobwork_cnt;
								
								//$caret_query=mysqli_query($connection,"select * from store_caret where caret_material_name='$rm_name'");
								//$caret_id = '';
								//while($id=mysqli_fetch_array($caret_query)){
									//$caret_id=$id['caret_id'];
								//}
								
								$bsid='bs_cnt'.$cnt;
								$bcid='bc_cnt'.$cnt;
								$bqid='bq_cnt'.$cnt;
								$brid='br_cnt'.$cnt;
								$bjid='bj_cnt'.$cnt;
								$btid='bt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center' rowspan=4>$caret_id</td>";
								echo "<td align='center' rowspan=4>$rm_name</td>";
								echo "<td align='center'>As per books</td>";
								echo "<td align='center' id=$bsid>$store_cnt</td>";
								echo "<td align='center' id=$bcid>$counting_cnt</td>";          
								echo "<td align='center' id=$bqid>$quality_cnt</td>";					
								echo "<td align='center' id=$brid>$rework_cnt</td>";
								echo "<td align='center' id=$bjid>$jobwork_cnt</td>";
								echo "<td align='center' id=$btid>$total_cnt</td>";
								echo "<td align='center' rowspan=4><form method='post'><input type='date' name='v_on[]' id='v_on' value='' class='form-control' style='width:170px;height:30px'></td>";
								echo "<td align='center' rowspan=4><input type='text' class='form-control' name='v_by[]' id='v_by' value='' style='width:150px;height:30px'></td>";
								echo "</tr>";
								echo '<script>
								function findTotal(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		console.log("Function Called");
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		
			
		var tot;
		tot=parseFloat(parseFloat(s_cnt)+parseFloat(c_cnt)+parseFloat(q_cnt)+parseFloat(r_cnt)+parseFloat(j_cnt));
		
		document.getElementById(tid).value=tot;
	    
	}
							
							
														function findDiff(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		var dsid="ds_cnt";
		dsid=dsid.concat(caret_id);
		var dcid="dc_cnt";
		dcid=dcid.concat(caret_id);
		var dqid="dq_cnt";
		dqid=dqid.concat(caret_id);
		var drid="dr_cnt";
		drid=drid.concat(caret_id);
		var djid="dj_cnt";
		djid=djid.concat(caret_id);
		var dtid="dt_cnt";
		dtid=dtid.concat(caret_id);
		
		var bsid="bs_cnt";
		bsid=bsid.concat(caret_id);
		var bcid="bc_cnt";
		bcid=bcid.concat(caret_id);
		var bqid="bq_cnt";
		bqid=bqid.concat(caret_id);
		var brid="br_cnt";
		brid=brid.concat(caret_id);
		var bjid="bj_cnt";
		bjid=bjid.concat(caret_id);
		var btid="bt_cnt";
		btid=btid.concat(caret_id);
		
		var s=document.getElementById(bsid);
		var s1=s.innerHTML;
		
		var c=document.getElementById(bcid);
		var c1=c.innerHTML;
		
		var q=document.getElementById(bqid);
		var q1=q.innerHTML;
		
		var r=document.getElementById(brid);
		var r1=r.innerHTML;
		
		var j=document.getElementById(bjid);
		var j1=j.innerHTML;
		
		var t=document.getElementById(btid);
		var t1=t.innerHTML;
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		console.log("Function Called")
		
		
		
		
		var d1,d2,d3,d4,d5,d6;
		
		d1=parseFloat(Math.abs(parseFloat(s1)-parseFloat(s_cnt)));
		d2=parseFloat(Math.abs(parseFloat(c1)-parseFloat(c_cnt)));
		d3=parseFloat(Math.abs(parseFloat(q1)-parseFloat(q_cnt)));
		d4=parseFloat(Math.abs(parseFloat(r1)-parseFloat(r_cnt)));
		d5=parseFloat(Math.abs(parseFloat(j1)-parseFloat(j_cnt)));
		d6=parseFloat(Math.abs(parseFloat(t1)-parseFloat(t_cnt)));
		
		document.getElementById(dsid).value=d1;
		document.getElementById(dcid).value=d2;
		document.getElementById(dqid).value=d3;
		document.getElementById(drid).value=d4;
		document.getElementById(djid).value=d5;
		document.getElementById(dtid).value=d6;
	    
	}
							</script>'?>
								<?php
								$sid='s_cnt'.$cnt;
								$cid='c_cnt'.$cnt;
								$qid='q_cnt'.$cnt;
								$rid='r_cnt'.$cnt;
								$jid='j_cnt'.$cnt;
								$tid='t_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>As per verification</td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$sid name='s_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$cid name='c_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$qid name='q_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$rid name='r_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$jid name='j_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='text' class='form-control' name='t_cnt[]' id=$tid readonly></td>";
								echo "</tr>";
								//$cnt=$cnt+1;
								//echo $cnt;
								
								
								$dsid='ds_cnt'.$cnt;
								$dcid='dc_cnt'.$cnt;
								$dqid='dq_cnt'.$cnt;
								$drid='dr_cnt'.$cnt;
								$djid='dj_cnt'.$cnt;
								$dtid='dt_cnt'.$cnt;
								
								$id='rid'.$cnt;
								echo "<tr>";
								echo "<td align='center'>Difference</td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dsid name='ds_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dcid name='dc_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dqid name='dq_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$drid name='dr_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$djid name='dj_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dtid name='dt_cnt[]' readonly><input type='text' class='form-control' id='i' name='i[]' value=$rm_id hidden></td>";
								echo "</tr>";
								
								$rsid='rs_cnt'.$cnt;
								//echo $rsid;
								$rcid='rc_cnt'.$cnt;
								$rqid='rq_cnt'.$cnt;
								$rrid='rr_cnt'.$cnt;
								$rjid='rj_cnt'.$cnt;
								$rtid='rt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>Reason</td>";
								echo "<td align='center'><select class='form-control form-select' name='rs_cnt[]' id=$rsid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rc_cnt[]' id=$rcid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rq_cnt[]' id=$rqid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rr_cnt[]' id=$rrid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rj_cnt[]' id=$rjid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rt_cnt[]' id=$rtid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "</tr>";
								//$cnt++;
								$cnt=$cnt+1;
							
						?>
							<?php
								echo "</tr>";
							}
							
							echo '</tbody>';
                        	echo '</table></center>';
							$cnt=$cnt-1;
							echo "<center><input type='submit' name='submit3' value='Update' class='btn btn-primary btn-lg' style='width: 250px; height: 50px';><center>";
							
						
						echo "</form>";
						
						break;
						
						
						
						
					case 'Verification':

							$cnt=1;
							$i=array();
							$query = "select * from raw_materials WHERE rm_verification_date<=date_sub(curdate(),interval 30 day)";
							$raw_mat_query = mysqli_query($connection,$query);
						
						?>
						<table class="table table-bordered" style="width:80%">
							<thead>
                                <tr align='center'>
                                    <th rowspan=2>Caret Id</th>
									<th rowspan=2>Name of Raw Material</th>
									<th rowspan=2></th>
                                    <th colspan=6>Quantity</th>
                                    <th rowspan=2>Verified On</th>        
									<th rowspan=2>Verified By</th>                 
                                </tr>
								<tr>
									<th>Stores</th>
									<th>Counting</th>
									<th>Quality Check</th>
									<th>Rework</th>
									<th>Jobwork</th>
									<th>TOTAL</th>
								</tr>
                            </thead>
                        	<tbody>
						<?php	
							echo '<br><br>';
							while ($rows = mysqli_fetch_assoc($raw_mat_query)) 
							{
								$rm_name=$rows['rm_name'];
								$rm_id=$rows['rm_id'];
								$caret_id=$rows['rm_caret_id'];
								$store_cnt=$rows['rm_stores_quantity'];
								$counting_cnt=$rows['rm_counting_quantity'];
								$quality_cnt=$rows['rm_qc_quantity'];
								$rework_cnt=$rows['rm_rework_quantity'];
								$jobwork_cnt=$rows['rm_jobwork_quantity'];
								$total_cnt=$store_cnt+$counting_cnt+$quality_cnt+$rework_cnt+$jobwork_cnt;
								
								//$caret_query=mysqli_query($connection,"select * from store_caret where caret_material_name='$rm_name'");
								//$caret_id = '';
								//while($id=mysqli_fetch_array($caret_query)){
									//$caret_id=$id['caret_id'];
								//}
								
								$bsid='bs_cnt'.$cnt;
								$bcid='bc_cnt'.$cnt;
								$bqid='bq_cnt'.$cnt;
								$brid='br_cnt'.$cnt;
								$bjid='bj_cnt'.$cnt;
								$btid='bt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center' rowspan=4>$caret_id</td>";
								echo "<td align='center' rowspan=4>$rm_name</td>";
								echo "<td align='center'>As per books</td>";
								echo "<td align='center' id=$bsid>$store_cnt</td>";
								echo "<td align='center' id=$bcid>$counting_cnt</td>";          
								echo "<td align='center' id=$bqid>$quality_cnt</td>";					
								echo "<td align='center' id=$brid>$rework_cnt</td>";
								echo "<td align='center' id=$bjid>$jobwork_cnt</td>";
								echo "<td align='center' id=$btid>$total_cnt</td>";
								echo "<td align='center' rowspan=4><form method='post'><input type='date' name='v_on[]' id='v_on' value='' class='form-control' style='width:170px;height:30px'></td>";
								echo "<td align='center' rowspan=4><input type='text' class='form-control' name='v_by[]' id='v_by' value='' style='width:150px;height:30px'></td>";
								echo "</tr>";
								echo '<script>
								function findTotal(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		console.log("Function Called");
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		
			
		var tot;
		tot=parseFloat(parseFloat(s_cnt)+parseFloat(c_cnt)+parseFloat(q_cnt)+parseFloat(r_cnt)+parseFloat(j_cnt));
		
		document.getElementById(tid).value=tot;
	    
	}
							
							
														function findDiff(c){
		
		
		var caret_id="";
		caret_id=caret_id.concat(c.slice(5,));
		
		var sid="s_cnt";
		sid=sid.concat(caret_id);
		var cid="c_cnt";
		cid=cid.concat(caret_id);
		var qid="q_cnt";
		qid=qid.concat(caret_id);
		var rid="r_cnt";
		rid=rid.concat(caret_id);
		var jid="j_cnt";
		jid=jid.concat(caret_id);
		var tid="t_cnt";
		tid=tid.concat(caret_id);
		console.log(caret_id);
		
		var dsid="ds_cnt";
		dsid=dsid.concat(caret_id);
		var dcid="dc_cnt";
		dcid=dcid.concat(caret_id);
		var dqid="dq_cnt";
		dqid=dqid.concat(caret_id);
		var drid="dr_cnt";
		drid=drid.concat(caret_id);
		var djid="dj_cnt";
		djid=djid.concat(caret_id);
		var dtid="dt_cnt";
		dtid=dtid.concat(caret_id);
		
		var bsid="bs_cnt";
		bsid=bsid.concat(caret_id);
		var bcid="bc_cnt";
		bcid=bcid.concat(caret_id);
		var bqid="bq_cnt";
		bqid=bqid.concat(caret_id);
		var brid="br_cnt";
		brid=brid.concat(caret_id);
		var bjid="bj_cnt";
		bjid=bjid.concat(caret_id);
		var btid="bt_cnt";
		btid=btid.concat(caret_id);
		
		var s=document.getElementById(bsid);
		var s1=s.innerHTML;
		
		var c=document.getElementById(bcid);
		var c1=c.innerHTML;
		
		var q=document.getElementById(bqid);
		var q1=q.innerHTML;
		
		var r=document.getElementById(brid);
		var r1=r.innerHTML;
		
		var j=document.getElementById(bjid);
		var j1=j.innerHTML;
		
		var t=document.getElementById(btid);
		var t1=t.innerHTML;
		
		var s_cnt=document.getElementById(sid).value;
		var c_cnt=document.getElementById(cid).value;
		var q_cnt=document.getElementById(qid).value;
		var r_cnt=document.getElementById(rid).value;
		var j_cnt=document.getElementById(jid).value;
		var t_cnt=document.getElementById(tid).value;
		
		if(!s_cnt){s_cnt=0;}
		if(!c_cnt){c_cnt=0;}
		if(!q_cnt){q_cnt=0;}
		if(!r_cnt){r_cnt=0;}
		if(!j_cnt){j_cnt=0;}
		if(!t_cnt){t_cnt=0;}
		
		
		console.log("Function Called")
		
		
		
		
		var d1,d2,d3,d4,d5,d6;
		
		d1=parseFloat(Math.abs(parseFloat(s1)-parseFloat(s_cnt)));
		d2=parseFloat(Math.abs(parseFloat(c1)-parseFloat(c_cnt)));
		d3=parseFloat(Math.abs(parseFloat(q1)-parseFloat(q_cnt)));
		d4=parseFloat(Math.abs(parseFloat(r1)-parseFloat(r_cnt)));
		d5=parseFloat(Math.abs(parseFloat(j1)-parseFloat(j_cnt)));
		d6=parseFloat(Math.abs(parseFloat(t1)-parseFloat(t_cnt)));
		
		document.getElementById(dsid).value=d1;
		document.getElementById(dcid).value=d2;
		document.getElementById(dqid).value=d3;
		document.getElementById(drid).value=d4;
		document.getElementById(djid).value=d5;
		document.getElementById(dtid).value=d6;
	    
	}
							</script>'?>
								<?php
								$sid='s_cnt'.$cnt;
								$cid='c_cnt'.$cnt;
								$qid='q_cnt'.$cnt;
								$rid='r_cnt'.$cnt;
								$jid='j_cnt'.$cnt;
								$tid='t_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>As per verification</td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$sid name='s_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$cid name='c_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$qid name='q_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$rid name='r_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='number' min=0 step=0.01 class='form-control' id=$jid name='j_cnt[]' onchange='findTotal(this.id)' onfocus='findDiff(this.id)' onblur='findDiff(this.id)'></td>";
								echo "<td align='center'><input type='text' class='form-control' name='t_cnt[]' id=$tid readonly></td>";
								echo "</tr>";
								//$cnt=$cnt+1;
								//echo $cnt;
								
								
								$dsid='ds_cnt'.$cnt;
								$dcid='dc_cnt'.$cnt;
								$dqid='dq_cnt'.$cnt;
								$drid='dr_cnt'.$cnt;
								$djid='dj_cnt'.$cnt;
								$dtid='dt_cnt'.$cnt;
								
								$id='rid'.$cnt;
								echo "<tr>";
								echo "<td align='center'>Difference</td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dsid name='ds_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dcid name='dc_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dqid name='dq_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$drid name='dr_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$djid name='dj_cnt[]' readonly></td>";
								echo "<td align='center'><input type='text' class='form-control' id=$dtid name='dt_cnt[]' readonly><input type='text' class='form-control' id='i' name='i[]' value=$rm_id hidden></td>";
								echo "</tr>";
								
								$rsid='rs_cnt'.$cnt;
								//echo $rsid;
								$rcid='rc_cnt'.$cnt;
								$rqid='rq_cnt'.$cnt;
								$rrid='rr_cnt'.$cnt;
								$rjid='rj_cnt'.$cnt;
								$rtid='rt_cnt'.$cnt;
								
								echo "<tr>";
								echo "<td align='center'>Reason</td>";
								echo "<td align='center'><select class='form-control form-select' name='rs_cnt[]' id=$rsid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rc_cnt[]' id=$rcid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rq_cnt[]' id=$rqid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rr_cnt[]' id=$rrid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rj_cnt[]' id=$rjid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "<td align='center'><select class='form-control form-select' name='rt_cnt[]' id=$rtid><option value=0>Select Reason</option><option value=1>Incorrect Opening Quantity</option><option value=2>Raise Query</option></select></td>";
								echo "</tr>";
								//$cnt++;
								$cnt=$cnt+1;
							
						?>
							<?php
								echo "</tr>";
							}
							
							echo '</tbody>';
                        	echo '</table></center>';
							$cnt=$cnt-1;
							echo "<center><input type='submit' name='submit4' value='Update' class='btn btn-primary btn-lg' style='width: 250px; height: 50px';><center>";
							
						
						echo "</form>";
						
						break;
						


					
				
						
						
						
						
					default: break;
				}

			?>
		</form>
	</div>
	
							
	
							
</body>
</html>
<?php mysqli_close($connection); ?>
