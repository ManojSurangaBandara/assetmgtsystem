<?php
require('../model/database.php');
require_once('../php-login/auth.php');
require('../model/assetsunit_db.php');
require('../model/errorcode_db.php');
require('../model/unitdetails_db.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/dos_materialmaster_db.php');
require('../model/bos_openingbalance_db.php');
$page=12;
require_once('../model/language.php');
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
		include 'startpage.php';
		break;
    case 'select_current_asset':
		$items = dos_materialmasterDB::getFullDetails();
		include 'select_current_asset.php';
		break;
	case 'save_current_asset':
		$exps = dos_materialmasterDB::save_current_asset($_GET['id'], $_GET['current_asset']);
		echo json_encode($exps);
		break;
    case 'add_asset_sinhala_name':
		$items = dos_materialmasterDB::getCurrentDetails();
		include 'add_asset_sinhala_name.php';
		break;
	case 'save_asset_sinhala_name':
		$exps = dos_materialmasterDB::save_asset_sinhala_name($_GET['id'], $_GET['s_description'], $_GET['sub_category']);
		echo json_encode($exps);
		break;
    case 'add_opening_balance':
		if (isset($_POST['search'])) {
			$a_itemtype = $_POST['itemtype'];
			$a_qstore = $_POST['qstore'];
			$a_description = $_POST['description'];
			if ($a_itemtype == "" && $a_qstore == "" && $a_description == "") {
				$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);	
			} else {
				$items = dos_materialmasterDB::getDescriptionList_search($a_itemtype, $a_qstore, $a_description, $assetunit);
			}
		} else {
			$a_itemtype = "";
			$a_qstore = "";
			$a_description = "";
			$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
		}	
		$itemtypes = dos_materialmasterDB::getUniqueitemtype();
		$qstores = dos_materialmasterDB::getUniqueqstore();
		$descriptions = dos_materialmasterDB::getUniquedescription();
		include 'add_opening_balance.php';
		break;
    case 'add_opening_balance_save':
		$count = bos_openingbalanceDB::getHasRecord($assetunit, $_GET['itemcode']);
		if ($count == 0) {
			$scount = bos_openingbalanceDB::addRecord($assetscenter, $assetunit, $_GET['itemtype'], $_GET['qstore'], $_GET['votename'], $_GET['itemcode'], $_GET['description'], $_GET['ledger_folio'], $_GET['qty_onhand'], $_GET['qty_q1'], $_GET['qty_q2'], $_GET['qty_q3'], $_GET['qty_q4'], $_GET['qty_q5'], $_GET['qty_ledger']);
		} else {
			$scount = bos_openingbalanceDB::updateRecord($assetunit, $_GET['itemcode'], $_GET['ledger_folio'], $_GET['qty_onhand'], $_GET['qty_q1'], $_GET['qty_q2'], $_GET['qty_q3'], $_GET['qty_q4'], $_GET['qty_q5'], $_GET['qty_ledger']);
		}
		echo $scount;
		break;		
	case 'getDescriptionList':
		$exps = dos_materialmasterDB::getDescriptionList($_GET['itemtype'], $_GET['qstore'], $_GET['description']);
		echo json_encode($exps);
		break;
	case 'getDescriptionList_search':
		$exps = dos_materialmasterDB::getDescriptionList_search($_GET['itemtype'], $_GET['qstore'], $_GET['description'], $assetunit);
		echo json_encode($exps);
		break;
    case 'change_units_details':
		//$exps = AssetsUnitDB::getFullList_unittype(1);
		$exps = AssetsUnitDB::getFullListsortCenterUnit();
		include 'change_units_details.php';
		break;
	case 'change_units_details_save':
		$id = $_GET['id'];
		$count = AssetsUnitDB::change_units_details_save($_GET['id'], $_GET['unitName'], $_GET['centreID']);
		echo $count;
	break;
}
?>