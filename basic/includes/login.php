<?php 
	include_once("db.php");
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
			$db_user_dept=$row['user_dept'];
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
			$_SESSION['user_dept'] = $db_user_dept;			
			

			#$loc = "../".$db_user_role."/rawmaterialsoverview.php";

			switch($db_user_dept){
				case 'purchase_dept':
					$page = 'rawmaterialsoverview.php';
					break;
				case 'counting_dept':
					$page = 'CountingDetails.php';
					break;
				/*case 'counting_dept_display':
					$page = 'countingstatus.php';
					break;*/
				case 'goods_receiving':
					$page = 'VerifyNoBoxesForm1.php';
					break;
				case 'qc_dept':
					$page = 'QC_Details.php';
					break;
				case 'stores_dept':
					$page = 'stores_home.php';
					break;
				case 'production_dept':
					$page = 'AcceptRawMaterial.php';
					break;
				case 'rework_dept':
					$page = 'ReworkEstimation.php';
					break;
				case 'outward_dept':
					$page = 'accept_receipt_of_goods.php';
					break;
				case 'accounts_dept':
					$page = 'Production report.php';
					break;
				case 'admin_dept':
					$page = 'ManageUsers.php';
					break;
				default:
					header("Location: ../login.html");
					break;
			}
			

			$loc = "../".$page;
			echo '<script language="javascript">alert("message successfully sent");
			window.location.replace("Location: ".$loc)</script>';
			header("Location: $loc");
		}
		else
		{
			header("Location: ../login1.html");
		}

	}


?>
