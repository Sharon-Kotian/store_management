<?php
    include_once ("includes/header.php");
	global $connection;

	if($_SESSION['user_dept'] != 'admin_dept'){
		echo '<script type="text/javascript">alert("Access Denied.")';
		header("Location: ../login.html");
	}

    $name = $_GET['name'];
    $delete=mysqli_query($connection, "DELETE FROM factory_details WHERE factory_name='$name'");
    if($delete){
    	echo '<script>alert("Factory Details Deleted");
        window.location.replace("view_factory.php")</script>';
    }
    else{
        echo "Error.".mysqli_error($connection);
        echo '<script>window.location.replace("view_factory.php")</script>';
    }
    mysqli_close($connection);
?>	