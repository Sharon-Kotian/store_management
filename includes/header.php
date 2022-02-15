
<?php 
    include "db.php";

    //include "functions.php";

    ob_start();
    session_start();

    if(!isset($_SESSION['user_role']))
    {
            header("Location:../index.php");
    }
?>

<html lang="en">
<header>
		<p align="right">Welcome  <?php echo $_SESSION['username']; ?>
			<a href="../includes/logout.php" class="button">Logout</a>
		</p>

	</header>
    </html>
