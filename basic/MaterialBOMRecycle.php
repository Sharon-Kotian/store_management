<?php
    include_once ("includes/header.php");
    global $connection;

    if($_SESSION['username'] != 'purchase_dept'){
        echo '<script type="text/javascript">alert("Access Denied.")';
        header("Location: ../login.html");
    }
    $id = $_GET['id'];
    $delete=mysqli_query($connection, "DELETE FROM finished_product_details WHERE fpd_id ='$id'");
    if($delete){
    	echo '<script>alert("Material Deleted");
        window.location.replace("ViewBOM.php")</script>';
    }
    else{
        echo "Error.".mysqli_error($connection);
    }
    mysqli_close($connection);
?>	