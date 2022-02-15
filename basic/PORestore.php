<?php
    include_once ("includes/header.php");
    global $connection;

    if($_SESSION['username'] != 'accounts_dept'){
        echo '<script type="text/javascript">alert("Access Denied.")';
        header("Location: ../login.html");
    }
    $id = $_GET['id'];
    $delete=mysqli_query($connection, "UPDATE po_summary SET po_status='PO issued' WHERE po_number='$id'");
    if($delete){
    	echo '<script>alert("PO Restored.");
        window.location.replace("DeletedPOs.php")</script>';
    }
    else{
        echo "Error.".mysqli_error($connection);
        echo '<script>window.location.replace("DeletedPOs.php")</script>';
    }
    mysqli_close($connection);
?>	