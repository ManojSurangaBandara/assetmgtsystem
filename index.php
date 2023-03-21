
<?php session_start(); ?>
<?php 
	if (!isset($_SESSION['csrf_token'])) {
  		$_SESSION['csrf_token'] = uniqid();
	}
	$csrf_token = $_SESSION['csrf_token'];

	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '') || !isset($_SESSION['SESS_PROGRAM']) || !(trim($_SESSION['SESS_PROGRAM']) == 'AMS')) {
		setcookie('lang', 0);
		include 'view/header.php';
		if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<li>',$msg,'</li>'; 
			}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
		}
		include './php-login/login-form.php';
	} else {
		$dir = dirname(__FILE__);
		setcookie('dir', $dir);
		header("location: ./start_page");
	}
?>
<?php include 'view/footer.php'; ?>
<?php include_once("analyticstracking.php") ?>
