<?php
	session_start();
	require_once("config.php");
	//Get data off the web
	$Email = $_GET["Email"];
	$Acode = $_GET["Acode"];
	print "Web data ($Email) ($Acode) <br>";
	// Connect to DB
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if( !$con){
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connnection failed: ".mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	print "Database connected <br>";
	// Build query to check if Email and Acode match
	$query = "Select * from Users where Email='$Email' and Acode='$Acode';";
	$result = mysqli_query($con, $query);

	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Select Query failed: ".mysqli_error($con);
		header("location:../index.php");
		exit();
	}


	//Check if only one row matched
	if(mysqli_num_rows($result) != 1){
		$_SESSION["RegState"] = -4;
		$_SESSION["Message"] = "Either email or activation code did not match. Please register again: .";
		header("location:../index.php");
		exit();	
	}
	//Authentication succeeded
	$Acode = rand(); // replacing old Acode
	$Adatetime = date("Y-m-d h:i:s");
	$query = "Update Users set Acode ='$Acode', Adatetime = '$Adatetime' where Email='$Email';";
	$result = mysqli_query($con, $query);
	if (!$result) {
		$_SESSION["RegState"] = -5;
		$_SESSION["Message"] = "Acode update failed: ".mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	// Save Email 
	$_SESSION["Email"] = $Email;
	$_SESSION["RegState"] = 6; // to trigger the password form 
	header("location:../index.php");
	exit();


?>