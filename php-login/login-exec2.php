<?php
	//Start session
	session_start();
	
	//Include database connection details
	//require_once('config.php');
	require('../model/database.php');
	require('../model/logindetails_db.php');
	require('../model/assetsunit_db.php');
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
	
	function getMacAddress() {
ob_start();
system('ipconfig /all');
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean();
$findme = "Physical";
$pos = strpos($mycom, $findme);
$macp=substr($mycom,($pos+36),17);
return $macp;
//return $mac;
}
// FInd Mac Address
$ipAddress=$_SERVER['REMOTE_ADDR'];
$macAddr=false;

#run the external command, break output into lines
$arp=`arp -n $ipAddress`;
$lines=explode("\n", $arp);

#look for the output line describing our IP address
foreach($lines as $line)
{
   $cols=preg_split('/\s+/', trim($line));
   if ($cols[0]==$ipAddress)
   {
       $macAddr=$cols[1];
   }
}
// Mac Address End
	//Sanitize the POST values
	$login = $_POST['login'];
	$password = $_POST['password'];
	$macaddress = getMacAddress();
	//Input Validations
	if($login == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location:../index.php");
		exit();
	}
	
	//Create query
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."'";
	$result = array();
	try {
		$statement = $db->prepare($qry);
		$statement->execute();
		$result = $statement->fetch(PDO::FETCH_ASSOC);
		$statement->closeCursor();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		display_db_error($error_message);
	}
	
	//Check whether the query was successful or not
	if(count($result) > 0) {
		if(count($result) == 1) {
			//Login Successful
			 
			session_regenerate_id();
			$member = $result[0];
			$_SESSION['SESS_MEMBER_ID'] = $member['member_id'];
			$_SESSION['SESS_FIRST_NAME'] = $member['firstname'];
			$_SESSION['SESS_LAST_NAME'] = $member['lastname'];
			$_SESSION['SESS_PLACE'] = $member['place'];
			$_SESSION['SESS_LEVEL'] = $member['level'];
            $_SESSION['SESS_CENTRE'] = $member['centreName'];
            $_SESSION['SESS_LOGIN'] = $member['login'];
			$_SESSION['SESS_PROGRAM'] = "AMS";
			$item = AssetsUnitDB::getprotocol($member['place']);
			$_SESSION['SESS_PROTOCOLT1'] = $item['protocoltext1'];
			$_SESSION['SESS_PROTOCOLT2'] = $item['protocoltext2'];
			$_SESSION['SESS_PROTOCOLL5'] = $item['protocollevel5'];
			session_write_close();
			$password = "";
			LoginDB::addLogin($member['centreName'], $member['place'], $macaddress, $login, $password, 1);
			header("location: ../index.php");
			exit();
		}else {
			//Login failed
			LoginDB::addLogin("", "", $macaddress, $login, $password, 0);
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>