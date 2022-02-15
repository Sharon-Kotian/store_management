<?php 
	session_start();
	
	$_SESSION['username'] = null;
	$_SESSION['firstname'] = null;
	$_SESSION['lastname'] = null;
	$_SESSION['user_role'] = null;
	$_SESSION['user_dept'] = null;

	header("Location: ../../login.html");



?>