<?php
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'stores_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

    $id = $_GET['id'];
    $Blacklist=mysqli_query($connection, "UPDATE ext_worker SET ew_status='Blacklist' WHERE ew_id='$id'");
    if($Blacklist){
    	echo '<script>alert("Job Worker Blacklisted");
        window.location.replace("job_workers.php")</script>';    
    }
    else{
        echo "Error.".mysqli_error($connection);
        echo '<script>window.location.replace("job_workers.php")</script>';
    }
    mysqli_close($connection);
?>	