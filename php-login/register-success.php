<?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	//unset($_SESSION['SESS_MEMBER_ID']);
	//unset($_SESSION['SESS_FIRST_NAME']);
	//unset($_SESSION['SESS_LAST_NAME']);
	//include '../view/header1.php';
?>
<h1>Registration Successful</h1>
<p align="center">Click here to <a href="../index.php">Login</a></p>
 <?php include '../view/footer.php'; ?>
