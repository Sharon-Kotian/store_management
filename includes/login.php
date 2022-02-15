<?php 
	include "db.php";
	session_start();


	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];


		$username = mysqli_real_escape_string($connection, $username);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM users WHERE user_name = '{$username}'";
		$select_user_query = mysqli_query($connection,$query);
		if(!$select_user_query)
		{
			die("Query Failed " .mysqli_error($connection));
		}

		while($row = mysqli_fetch_array($select_user_query))
		{
			$db_id = $row['user_id'];
			$db_username = $row['user_name'];
			$db_user_password = $row['user_pass'];
			$db_user_role = $row['user_role'];
		}

		//$password = crypt($password,$db_user_password);

	/*	if($username !== $db_username && $password !== $db_user_password )
		{
			header("Location: ../index.php");
		}
		else*/ if($username === $db_username && $password === $db_user_password )
		{

			$_SESSION['username'] = $db_username;
			$_SESSION['user_role'] = $db_user_role;

			$loc = "../".$db_user_role."/rawmaterialsoverview.php";

			header("Location: $loc");
		}
		else
		{
			header("Location: ../login.html");
		}

	}


?>