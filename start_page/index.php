<?php
require('../model/database.php');
require_once('../php-login/auth.php');
require('../model/assetsunit_db.php');
require('../model/errorcode_db.php');
require('../model/unitdetails_db.php');
require('../model/members_db.php');
$page=0;
$lang = 0;
global $lang;
$assetunit = $_SESSION['SESS_PLACE'];
require_once('../model/language.php');
$unit = AssetsUnitDB::getAllDetailsUnit($_SESSION['SESS_PLACE']);
if ($unit['error_display'] == 1) {
	$str = $unit['error_codes'];
	$errors = explode(",",$str);
}
$members = MembersDB::getAllDetailsMember($_SESSION['SESS_MEMBER_ID']);
if ($members['error_display'] == 1) {
	$str = $members['error_codes'];
	$errors_m = explode(",",$str);
}
include '../view/header1.php';
$details = unitdetailsDB::getDetailsByUnit($_SESSION['SESS_PLACE']);
$errordisplay = $details['errordisplay'];
$errortitle = $details['errortitle'];
$errordetails = $details['errordetails'];
$logo = unitdetailsDB::getCrestByUnit($assetunit);
if (empty($logo)) {
	$logo = "1.jpg";
} else {
	$logo = "../controls/".$logo;
}
include '../start_page/start-form.php';
include '../view/footer.php';
?>