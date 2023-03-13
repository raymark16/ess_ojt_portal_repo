<?php
	error_reporting(E_ALL & ~ E_NOTICE);
	session_start();
	require_once('connection.php');

	// Admin login form 
	if(isset($_POST['submit']))
	{
		// Assigning POST values to variables.
		$username = $_POST['username'];
		$password = $_POST['password'];

		// CHECK FOR THE RECORD FROM TABLE
		$query = "SELECT * FROM school_users WHERE schlusr_username='$username'";
 		$result = mysqli_query($dbConn, $query) or die(mysqli_error($dbConn));

		$count = mysqli_num_rows($result);

		if ($count > 0)
		{
			while($row = mysqli_fetch_array($result))
			{

				if($row['schlusr_password'] == md5($password))
				{
					if($row['schlusr_status'] == 1)
					{
						session_start(); 
						$_SESSION['USERNAME']   = $row["schlusr_username"];
						$_SESSION['FIRST_NAME'] = $row["schlusr_fname"];
						$_SESSION['LAST_NAME']	= $row["schlusr_lname"];
						$_SESSION['POSITION']	= $row["schlusr_acclvl"];
						$_SESSION['USERID']		= $row["schlusr_id"];

						if($_SESSION["POSITION"] == 0)
						{
							$dashboard = '/associate-enrollment-registration-process-form.php';

						}
						else if($_SESSION["POSITION"] == 1)
						{
							$dashboard = '/ess-enrollment-registration-process-form.php';
						}	
						else if($_SESSION["POSITION"] == 2)
						{
							$dashboard = '/teamleader-enrollment-registration-process-form.php';
						}
						else if($_SESSION["POSITION"] == 3)
						{
							$dashboard = '/finance-enrollment-registration-process-form.php';
						}
						else if($_SESSION["POSITION"] == 4)
						{
							$dashboard = '/administrator-enrollment-registration-process-form.php';
						}
						
						$_SESSION["DASHBOARD"]  = $dashboard;

						$url = 'https://' . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . $dashboard;
						header('Location: ' . $url);

						//echo "<script type='text/javascript'>location.href='../../../../$dashboard.php'</script>";		
					}
					else
					{
						echo "<script type='text/javascript'>alert(' User Account is not Active. Pls Contact the Admin.')</script>";
						echo "<script type='text/javascript'>location.href='adminlogin.php'</script>";		
					}
				}
				if($row['schlusr_password'] == $password)
				{
					$id = $row['schlusr_password'];
					echo "<script type='text/javascript'>alert(' Redirecting to Changing Password.')</script>";
					echo "<script type='text/javascript'>location.href='Pass_Change.php?id=$id'</script>";		
				}

				else
				{
					echo "<script type='text/javascript'>alert('Incorrect Username & Password Combination')</script>";
				}
			}
		}	
       
	}


?>