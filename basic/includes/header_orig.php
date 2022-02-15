
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
  background-color: #f1f1f1;
  padding: 100px 200px;
 
}

p{
   background-color: none ;
   font-family: Arial;
   color:black;
   font-size: 1em;
}
/* a{
    font-family: Hack, monospace;
    font-style: sodium_bin2hex;
    background: none;
    text-align: center;
    color: black;
    cursor: pointer;
    font-size: 1em;
    padding: 2Srem;
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
<header>

		<p align="right">Welcome  <?php echo $_SESSION['username']; ?>
			<a href="../includes/logout.php"><input type="button" class="btn btn-primary btn-sm" value=" Logout " name="logout"></a>



            
		</p>
</header>
</html>
