<?php
require_once('../php-login/auth.php');
require_once('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');


require_once('../model/fields.php');
require_once('../model/validate.php');

$page = 15;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
require_once('../model/language.php');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
   $action = 'startpage';
}
$slidebartype = 1;
$error = 0;
switch ($action) {
    case 'startpage':
        $slidebartype = 1;
        include('startpage.php');
        break;
}
?>