<?php
	session_start();
	if($_SESSION["RegState"] != 4){
		print "Please login first.";
		$_SESSION["Message"] = "Please login first.";
		header("location:../index.php");
		exit();
	}
	header("location: service.html");
	exit();
?>
