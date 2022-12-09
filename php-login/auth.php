<?php
	//Start session
	session_start();
	error_reporting(E_ALL);
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') || !isset($_SESSION['SESS_PROGRAM']) || !(($_SESSION['SESS_PROGRAM']) == "AMS")) {
		header("location: ../php-login/access-denied.php");
		exit();
	}
?>