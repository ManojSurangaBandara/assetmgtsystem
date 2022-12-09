<?php
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetscenter2.php');
require('../model/assetsunit_db.php');
require('../model/institute_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');

$page = 10;
$type = 3;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
require_once('../model/language.php');

$slidebartype = 10;
$error = 0;
$exps = array();


if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'startpage';
}

$assetscenter = $_SESSION['SESS_CENTRE'];
$assetunit = $_SESSION['SESS_PLACE'];
$Qinfo = QuickInfoDB::getActivatedDetails();

switch ($action) {
    case 'startpage':
        $slidebartype = 1;
        include('startpage.php');
        break;
	case 'Land_Details_Videos':
        $slidebartype = 2;
        include('startpage.php');
        break;
    case 'Add_Land_Details':
        $slidebartype = 2;
        include('land_add.php');
        break;
    case 'Approve_Land_Details':
        $slidebartype = 2;
        include('land_approve.php');
        break;	
    case 'Not_Approve_Land_Details':
        $slidebartype = 2;
        include('land_notapprove.php');
        break;
    case 'Inquery_Land_Details':
        $slidebartype = 2;
        include('land_inquiry.php');
        break;		
}
?>