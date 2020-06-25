<?php
	session_start();
	require_once("config.php");

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	use PHPMailer\PHPMailer\SMTP;

	require '../PHPMailer-master/src/Exception.php';
	require '../PHPMailer-master/src/PHPMailer.php';
	require '../PHPMailer-master/src/SMTP.php';

	//get the data off web
	$Email = $_POST["Email"];
	print "web data ($Email)<br>";
	
	//connect to DB
	
	$con = mysqli_connect(SERVER, USER, PASSWORD, DATABASE);
	if( !$con){
		$_SESSION["RegState"] = -1;
		$_SESSION["Message"] = "Database connnection failed: ".mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	print "Database connected <br>";


	//build a query
	$query = "SELECT *  FROM Users Where Email='$Email';";
	//execute the query
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Query failed: ".mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	print "Query vertify <br>";
	
	$Acode = rand(); // get a new activation code
	$query = "UPDATE Users SET Acode=$Acode WHERE Email='$Email';";
	$result = mysqli_query($con, $query);
	//check for correctness
	if (!$result) {
		$_SESSION["RegState"] = -2;
		$_SESSION["Message"] = "Acode update query failed: ".
			mysqli_error($con);
		header("location:../index.php");
		exit();
	}
	print "Query worked! <br>"; 


	// Build the PHPMailer object:
	$mail= new PHPMailer(true);
	try { 
		$mail->SMTPDebug = 2; // Wants to see all errors
		$mail->IsSMTP();
		$mail->Host="smtp.gmail.com";
		$mail->SMTPAuth=true;
		$mail->Username="cis105223053238@gmail.com";
		$mail->Password = 'g+N3NmtkZWe]m8"M';
		$mail->SMTPSecure = "ssl";
		$mail->Port=465;
		$mail->SMTPKeepAlive = true;
		$mail->Mailer = "smtp";
		$mail->setFrom("tug01026@temple.edu", "Tuan Nguyen");
		$mail->addReplyTo("tug01026@temple.edu","Tuan Nguyen");
		$msg = "Please click the link to complete reset password process: "."http://cis-linux2.temple.edu/~tug01026/4398/BCLab/php/authenticate.php?Acode=$Acode&Email=$Email";
		$mail->addAddress($Email,"$FirstName,$LastName");
		$mail->Subject = "Welcome to my project";
		$mail->Body = $msg;
		$mail->send();
		print "Email sent ... <br>";
		$_SESSION["RegState"] = 3;
		$_SESSION["Message"] = "Email sent.";
		header("location:../index.php");
		exit();
	} catch (phpmailerException $e) {
		$_SESSION["Message"] = "Mailer error: ".$e->errorMessage();
		$_SESSION["RegState"] = -4;
		print "Mail send failed: ".$e->errorMessage;
		header("location:../index.php");
		exit();		
	}

?>