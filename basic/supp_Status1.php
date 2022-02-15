<?php
    include_once("includes/header.php");
	global $connection;
	if($_SESSION['user_dept'] != 'accounts_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")</script>';
		header("Location: ../login.html");
	}

    $id = $_GET['id'];
    $Blacklist=mysqli_query($connection, "UPDATE supplier SET supp_status='' WHERE supp_id='$id'");
    if($Blacklist){
    	echo '<script>alert("Supplier Whitelisted");
        window.location.replace("supp_workers.php")</script>';    
    }
    else{
        echo "Error.".mysqli_error($connection);
        echo '<script>window.location.replace("supp_workers.php")</script>';
    }
    mysqli_close($connection);
?>	