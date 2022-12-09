<?php
	//Start session
	session_start();
	
	//Include database connection details
	//require_once('config.php');
	require('../model/database.php');
	require('../model/logindetails_db.php');
	require('../model/assetsunit_db.php');
	require('../model/members_db.php');
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
	
	//Function to sanitize values received from the form. Prevents SQL injection
//	function clean($str) {
//		$str = @trim($str);
//		if(get_magic_quotes_gpc()) {
//			$str = stripslashes($str);
//		}
//		return mysql_real_escape_string($str);
//	}
	
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
	$qry="SELECT * FROM members WHERE login='$login' AND passwd='".md5($_POST['password'])."' AND deactive=0";
//	$result=mysql_query($qry);
        $result=$db->query($qry);
	
	//Check whether the query was successful or not
	if($result) {
            if($result->rowCount() == 1) {
//		if(mysql_num_rows($result) == 1) {
			//Login Successful
			 
			session_regenerate_id();
//			$member = mysql_fetch_assoc($result);
                        $member = $result->fetch(PDO::FETCH_ASSOC);
			
			///////////////////
			$pw_update = $member['pw_update'];;
			$fail_attempts = $member['fail_attempts'];;
			$pw_update=strtotime($pw_update);//Converted to a PHP date (a second count)
			//Calculate difference
			$diff=time()-$pw_update;//time returns current time in seconds
			$days=floor($diff/(60*60*24));//seconds/minute*minutes/hour*hours/day)
			/////////////
			if ($days > 30 && $member['level'] > 1) {
				$count1 = MembersDB::updateerror_codes($member['member_id'], 1, 9);
				$_SESSION['ERRMSG_ARR'] = "ඔබගේ මුරපදයේ භාවිතා කිරීමේ කාලය ඉක්ම වී ඇති නිසා පරිශීලක නාමය (Login / User Account) තාවකාලිකව අත්හිටවා ඇත.  වකඅම අමතා මෙය නිවැරදි කරගත හැක. එක් මුර පදයක් වලංගු වන්නේ දින 30ක කාල සීමාවකට පමණි.";
				header("location:../index.php");
				exit();
			} elseif ($fail_attempts > 3 && $member['level'] > 1) {
				$_SESSION['ERRMSG_ARR'] = "වැරදි මුර පදයක් භාවිතා කරමින් කිහිපවිටක් පූරනය වීමට උත්සහ කර ඇත. ඔබේ පරිශීලක නාමය (Login / User Account) තාවකාලිකව අත්හිටවා ඇත.  වකඅම අමතා මෙය නිවැරදි කරගත හැක.";
				header("location:../index.php");
				exit();				
			} else {
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
			//$_SESSION['SESS_PROTOCOLL5'] = $item['protocollevel5'];
			if ($member['level'] == '5') {
				$_SESSION['DAM_CONTROLLER'] = $member['login'];
			} else {
				$_SESSION['DAM_CONTROLLER'] = $item['dam_controller'];}
			session_write_close();
			$defaultPassword = 0;
			if ($member['level'] == '8' && $password == '123') {
				$defaultPassword = 1;
			} elseif ($member['level'] == '7' && $password == '1234') {
				$defaultPassword = 1;
			} elseif ($member['level'] == '6' && $password == '12345') {
				$defaultPassword = 1;
			} elseif ($member['level'] == '17' && $password == '1234') {
				$defaultPassword = 1;
			}

			if ($defaultPassword == 1) {
				$count = MembersDB::active_decative($member['member_id'], $defaultPassword);
				if ($count == 1) {
					$count1 = MembersDB::updateerror_codes($member['member_id'], 1, 8);
				}
			}
			/////////////////
			$num = 0;
			$count2 = MembersDB::fail_attempt_update($num, $login);
			$password = "";
			LoginDB::addLogin($member['centreName'], $member['place'], $macaddress, $login, $password, 1);
			header("location: ../index.php");
			exit();
			}
		}else {
			//Login failed
			$count2 = MembersDB::fail_attempt_update(1, $login);
			LoginDB::addLogin("", "", $macaddress, $login, $password, 0);
			header("location: login-failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>