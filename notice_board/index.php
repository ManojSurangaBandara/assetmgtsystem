<?php
require('../model/database.php');
require_once('../php-login/auth.php');
require('../model/assetsunit_db.php');
require('../model/errorcode_db.php');
require('../model/unitdetails_db.php');
require('../model/land_db.php');
require('../model/building_db.php');
require('../model/plantmac_db.php');
require('../model/officeequ_db.php');
require('../model/vehicle_db.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require_once('../model/fields.php');
require_once('../model/validate.php');

$page=12;
require_once('../model/language.php');
$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('assetscenter');
$fields->addField('assetunit');
$unit = AssetsUnitDB::getAllDetailsUnit($_SESSION['SESS_PLACE']);
if ($_SESSION['SESS_LEVEL'] == 25) {
	$assetscenter = $_SESSION['SESS_PROTOCOLT2'];
} else {
	$assetscenter = $_SESSION['SESS_CENTRE'];
}
$assetunit = $_SESSION['SESS_PLACE'];
$slidebartype = 1;
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
   $action = 'startpage';
}
$logo = unitdetailsDB::getCrestByUnit($assetunit);
if (empty($logo)) {
	$logo = "../pic/1.jpg";
	} else {
	$logo = "../controls/".$logo;
}
switch ($action) {
    case 'startpage':
		if ($unit['error_display'] == 1) {
			$str = $unit['error_codes'];
			$errors = explode(",",$str);
		}
		$details = unitdetailsDB::getDetailsByUnit($_SESSION['SESS_PLACE']);
		$errordisplay = $details['errordisplay'];
		$errortitle = $details['errortitle'];
		$errordetails = $details['errordetails'];
		include 'startpage.php';
		break;
	case 'view_updates_land':
	    $items = LandDB::view_update($assetscenter, $assetunit, "", "");
        include('view_updates_land.php');
		break;
	case 'view_updates_building':
	    if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
		}

        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
		}

        if (isset($_POST['inputField1'])) {
            $inputField1 = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $inputField1 = $_GET['inputField1'];
        } else {
            $inputField1 = "";
        }

        if (isset($_POST['inputField2'])) {
            $inputField2 = $_POST['inputField2'];
        } else if (isset($_GET['inputField2'])) {
            $inputField2 = $_GET['inputField2'];
        } else {
            $inputField2 = "";
        }
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = BuildingDB::view_update($assetscenter, $assetunit, $inputField1, $inputField2);
        include('view_updates_building.php');
		break;
	case 'view_updates_plant':
	        if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
		}

        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
		}
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = PlantMacDB::view_update($assetscenter, $assetunit);
        include('view_updates_plant.php');
		break;
	case 'view_updates_office':
		if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
		}

        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
		}
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
	    $items = OfficeEquDB::view_update($assetscenter, $assetunit);
        include('view_updates_office.php');
		break;
	case 'view_updates_vehicle':
			if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
		}

        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
		}
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
	    $items = VehicleDB::view_update($assetscenter, $assetunit);
        include('view_updates_vehicle.php');
		break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
        $assetunit = "";
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'blog':
        include('blog.php');
        break;
}
?>