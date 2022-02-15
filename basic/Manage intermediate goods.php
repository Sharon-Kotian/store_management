<?php 
	include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

		if(isset($_POST['add'])){
			$igs_name1=$_POST['igs_name'];
			$igs_amt=$_POST['igs_amt'];

			$igs_name1=mysqli_real_escape_string($connection,$igs_name1);
			$igs_amt=mysqli_real_escape_string($connection,$igs_amt);

			$rs=mysqli_query($connection, "SELECT * from inter_goods_summary WHERE igs_name='$igs_name1'");

			if(mysqli_num_rows($rs)>0){
				echo '<script type="text/javascript"> alert("Intermediate Good already exits.");
				window.location.replace("Manage intermediate goods.php")</script>';
			}
			else{
				$insert_query=mysqli_query($connection, "INSERT into inter_goods_summary (igs_id, igs_name, igs_amt) VALUES('','$igs_name1','$igs_amt')");
				if($insert_query){
					echo '<script type="text/javascript">alert("Intermediate Good Inserted Successfully.");
					window.location.replace("Manage intermediate goods.php")</script>';
				}
				else
					echo "Error" .mysqli_error($connection);
			}
			mysqli_close($connection);
		};

		if(isset($_POST['delete'])){
			$igs_name1=$_POST['igs_name'];
			if($igs_name1==''){
				echo "<script>alert('Intermediate Good Name is empty.');
				window.location.replace('Manage intermediate goods.php')</script>";
			}else{
				$query=mysqli_query($connection, "DELETE FROM inter_goods_summary WHERE igs_name='$igs_name1' ");
			}
			if($query){
				echo '<script type="text/javascript">alert("Intermediate Good Deleted Successfully.");
				window.location.replace("Manage intermediate goods.php")</script>';
			}
			else
				echo "Error" .mysqli_error($connection);
			mysqli_close($connection);
		};
		
		
		
		
		
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

	<title>Manage Intermediate Goods</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="CSS/bootstrap.css">
	<script src="JS/login_jquery.js"></script>
	<script src="JS/login_bootstrap.js"></script>
	<script src="JS/addRowButton.js"></script>
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
		$("#igs_name1").select2();
		$('#but_read').click(function(){
		var username = $('#igs_name1 option:selected').text();
		var userid = $('#igs_name1').val();
		$('#result').html("id : " + userid + ", name : " + username);
		});
	});
	
function ShowProduct() {
    var x = document.getElementById('SectionName');
	var y = document.getElementById('ProductName');
	var z = document.getElementById('Manage');
    if (x.style.display == 'none') {
        y.style.display = 'block';
		z.style.display = 'none';
    } 
	else{
       y.style.display = 'block';
		x.style.display = 'none';
		z.style.display = 'none';
    }
}

function ShowRowMaterial() {
    var y = document.getElementById('ProductName');
	var x = document.getElementById('SectionName');
    if (y.style.display == 'none') {
        x.style.display = 'block';
		z.style.display = 'none';
    } 
	else{
        y.style.display = 'none';
		x.style.display = 'block';
		z.style.display = 'none';
    }
}

	


function ManageGoods() {
     var x = document.getElementById('ProductName');
	var y = document.getElementById('Manage');
	var z = document.getElementById('SectionName')
    if (y.style.display == 'none') {
        y.style.display = 'block';
		z.style.display = 'none';
		x.style.display = 'none';
    } 
	
	else
	{
		 y.style.display = 'block';
		z.style.display = 'none';
		x.style.display = 'none';
	}
}

	
function myfunctionProduct() {
  var tablewrap=document.getElementById('ProductTable'); 
	if(tablewrap.style.display==="none"){
		tablewrap.style.display="block"
	}
	else{
		tablewrap.style.display="none"
	}
};


function setName()
									{
										var name=document.getElementById(igs_name1).value;
										
										document.getElementById(name1).value=name;
									}

</SCRIPT>
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
	<h1 class="display-3" align="center">Manage Intermediate Goods</h1>
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
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='SubmitJobWork.php'">
				Jobwork Out(Issue Material)
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='AcceptJobwork1.php'">
				Jobwork In(Accept Material) 
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_work_receivable.php'">
					Jobwork Receivable
				</button><br><br>
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='HistoricalJobWork.php'">
				Historical Data
				</button><br><br>
				
				
				<button class="btn btn-primary btn-lg" style="width: 300px; height: 45px;" onClick="parent.location='job_workers.php'">
				Manage Job Workers
				</button>
			
			
			
			
				
			</div>
		  </div>
</div>
	
<div class="wrapper fadeInDown">
	<div id="formContent"><form method=post>
		<p align="center"><input type="button" class="btn btn-primary btn-lg" value="  Add Intermediate Good  " ONCLICK="ShowRowMaterial()" name="add">
			<input type="button" class="btn btn-primary btn-lg" value=" Delete Intermediate Good " ONCLICK="ShowProduct()" name="delete">
			<input type="button" class="btn btn-primary btn-lg" value=" Manage Intermediate Good " ONCLICK="ManageGoods()" name="manage"></form>
			</p>
	
	</div>
	<DIV ID="SectionName" STYLE="display:none">
		<form name="frm" action="" method="post">
			<table style="width:50%" align="center">
			<tr align="center">
				<td align="left" class="form-label"><br><br>Enter Intermediate Good Name: </td>
				<td align="center"><br><br><input type="text" id="igs_name" name="igs_name" style="text-align: center" class="form-control" style="width: 300px; height: 45px;" required></td>
			</tr>
			<tr align="center">
				<td align="left" class="form-label"><br><br>Enter Intermediate Good Quantity: </td>
				<td align="center"><br><br><input type="text" id="igs_amt" name="igs_amt" style="text-align: center" class="form-control" style="width: 300px; height: 45px;" required></td>
			</tr>
		</table>
		<p align="center"><br><br>
			<?php echo "<input type='submit' id= 'clickme' value=' Add ' class='btn btn-primary btn-lg' name='add' onClick=\"javascript: return confirm('Do you want to add the Intermediate Good?');\">";?></p>
		</form>
			  
	</DIV>
	
	<DIV ID="ProductName" STYLE="display:none">
		<form name="frm1" action="" method="post">
		<table style="width:60%" align="center">
			<tr>
				<td align="center" class="form-label"><br><br>Select Intermediate Good Name: </td>
				<td align="center"><br><br><select name="igs_name" id="igs_name1" style="width: 250px; height: 45px;" class="form-select">
					<?php 
						$records=mysqli_query($connection,"SELECT igs_name from inter_goods_summary");
						while($data=mysqli_fetch_array($records)){
							echo "<option value='".$data['igs_name']."'>".$data['igs_name']."</option>";
						}
					?>
			</select>
				</td>
				<td align="left"><br><br>
					<?php echo "<input type='submit' id='clickme' value= 'Delete' class='btn btn-primary btn-lg' name='delete' data-bs-toggle='modal' data-bs-target='#exampleModal' onClick=\"javascript: return confirm('Are you sure to delete the Intermediate Good?');\">";?>
			</tr>
		</table>
		</form>		
	</DIV>
	
	
	
	<DIV ID="Manage" STYLE="display:none">
		<br><br><br><form name="frm2" action="" method="post">
								
								
		<center><table class="table table-bordered table-hover" style="width:20%">
							<thead>
                                <tr>
                                    <!--<th>Intermediate Good ID</th>-->
                                    <th>Semi-finished Product</th>
									<!--<th>Charges Per Unit</th>-->                                    
									<th>Action</th>
                                </tr>
                            </thead>
                        	<tbody>						
		
			<!--<tr>-->
				<!--<td align="center" class="form-label"><br><br>Select Intermediate Good Name: </td>
				<td align="center"><br><br><select name="igs_name" id="igs_name1" style="width: 250px; height: 45px;" class="form-select" onchange='setName()'>-->
					<?php 
						
						$records=mysqli_query($connection,"SELECT * from inter_goods_summary");
						while($data=mysqli_fetch_array($records)){
							//echo "<form><tr><td id='id'>".$data['igs_id']."</td>";
							$id=$data['igs_id'];
							$name=$data['igs_name'];
							echo "<form><tr><td style='width:175px'><input type=text id='igs_name' name='igs_name[]' value=".$data['igs_name']." hidden>".$data['igs_name']."</td>";
							//echo "<td id='id'>".$data['igs_amt']."</td>";
							echo "<td style='width:100px'><a onClick=\"javascript: return confirm('Confirm your Managing for the Intermediate Good = $name?');\"  href='intermediate_goods_manage.php?name=".$name."'  role='button' class='btn btn-outline-warning btn-lg' aria-pressed='true' style='width:80px;height:40px;font-size:15px'>Manage</a></td>";
							//echo "<td><input type='submit' name='Manage[]' class='btn btn-primary btn-lg' value='Manage'></td></tr></form>";
							//echo "<form><tr><td>$data['igs_id']</td>";
							//echo "<td>$data['igs_name']</td>";
							//echo "<td>$data['igs_amt']</td>";
							//echo "<td><input type='submit' name='Manage' class='btn btn-primary btn-lg' value='Manage'></td></tr></form>";
						}
						
					?>
					</tbody>
					</table></center>
					</form>
	</DIV>
	
	
	
	
	
	
	
	
	
		
		<script>
	$(document).ready(function(){
	  $("#myBtn").click(function(){
	    $('.toast').toast('show');
	  });
	});
</script>				
	</DIV>

</body>
</html>
