<?php
    include "db.php";

    //include "functions.php";

    ob_start();
    session_start();

   if(!isset($_SESSION['user_role']))
    {
        // header("Location:../index.php");
    }
?>

<html lang="en">
<head>
            <style>
 * {box-sizing: border-box;}

body {
    margin: 0;

}

.header {
  overflow: hidden;
  
  padding: 100px 200px;

}

img{
  border: 1px solid #ddd;
  border-radius: 4px;
  width: 150px;
}
img:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}

p{
   background-color: none ;
   font-family: Arial;
   color:black;
   font-size: 120%;
}
/* a{
    font-family: Hack, monospace;
    font-style: sodium_bin2hex;
    background: none;
    text-align: center;
    color: black;
    cursor: pointer;
    font-size: 1em;
    padding: 25rem;
    border: 0;
    transition: all 0.5s;
    border-radius: 1px;
    width: auto;
    position: relative;
    min-width: 10px;
    } */
    .btn-lg, .btn {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.3rem;
    }


            </style>

</head>
<header style="background-color: #FFFF;">
	<p align="right">Welcome  <?php echo $_SESSION['username']; ?> 
		<a href="includes/logout.php" class="p-3"><input type="submit" class="btn btn-primary btn-lg" value=" Logout " name="logout"></a>
		<img src="../images/Logo2.jpeg" style="width:100px" align="left"></img>
    </p>
</header>
</html>
