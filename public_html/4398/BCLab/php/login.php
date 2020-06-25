<?php
	session_start();
	require_once("config.php");
	
	//Get data off the web:
	$Email = $_POST["Email"];
	$Password = md5($_POST["Password"]);
	$rememberMe = $_POST["rememberMe"]; //You have to figure out how to handle cookies
	
	//Connect to database		
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if (!$con) {
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connection failed: ";
			mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	print "Database connected <br>";
	//Build a query to update user Password
	$query = "Select * from Users where Password='$Password' and Email='$Email';";
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -7;
		$_SESSION["Message"] = "Login query failed: ";
			mysqli_error($con);
		header("location:../index.php");
		exit();
	}

	//Check if only one row matched
	if (mysqli_num_rows($result) != 1) {
		$_SESSION["RegState"] = -8;
		$_SESSION["Message"] = "Either Email Password did not match. Please try again.";
		header("location:../index.php");
		exit();
	}
	$_SESSION["RegState"] = 4; //Login success
	header("location:../project.php");
	exit();
	
?>