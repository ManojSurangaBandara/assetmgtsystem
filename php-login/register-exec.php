<?php
	//Start session
	session_start();
	
	//Include database connection details
	//require_once('config.php');
	require('../model/database.php');
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	//$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	//if(!$link) {
	//	die('Failed to connect to server: ' . mysql_error());
	//}
	
	//Select database
	//$db = mysql_select_db(DB_DATABASE);
	//if(!$db) {
	//	die("Unable to select database");
	//}

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$login = $_POST['login'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	
	//Input Validations
	if($fname == '') {
		$errmsg_arr[] = 'Full Name missing';
		$errflag = true;
	}
	if($lname == '') {
		$errmsg_arr[] = 'Unit missing';
		$errflag = true;
	}
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = array();
		try {
            $statement = $db->prepare($qry);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }

		if (count($result) > 0) {
			$errmsg_arr[] = 'Login ID already in use';
			$errflag = true;
		} else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: register-form.php");
		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO members(firstname, lastname, login, passwd) VALUES('$fname','$lname','$login','".md5($_POST['password'])."')";
	$result = false;
	try {
		$statement = $db->prepare($qry);
		$result = $statement->execute();
		$statement->closeCursor();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		display_db_error($error_message);
	}
	//Check whether the query was successful or not
	if($result) {
		header("location: register-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>