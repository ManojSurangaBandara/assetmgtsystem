<?php
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '2G');
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetscenter2.php');
require('../model/assetsunit_db.php');
require('../model/classificationlist_db.php');
require('../model/plantmac.php'); // Structre same as Plant mac
require('../model/officeequ_db.php');
require('../model/institute_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/catalogue_db.php');
require('../model/unitdetails_db.php');
require('../model/ordinance_places_db.php');
require('../model/present_location_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/board_report_db.php');
require('../model/board_report_observations_db.php');
require('../model/board_report_summary_db.php');
require('../model/allocation_details_db.php');
$page = 4;
$type = 1;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
$currentYear = ConstantsDB::getCurrentYear();
require_once('../model/language.php');
// Add fields with optional initial message
$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('assetscenter');
$fields->addField('assetunit');
$fields->addField('mainCategory');
$fields->addField('itemCategory');
$fields->addField('itemDescription');
$fields->addField('assetsno');
$fields->addField('newAssestno');
$fields->addField('catalogueno');
$fields->addField('identificationno');
$fields->addField('ledgerno');
$fields->addField('ledgerFoliono');
$fields->addField('eqptSriNo');
$fields->addField('purchasedDate');
$fields->addField('quantity');
$fields->addField('capacity');
$fields->addField('unitValue');
$fields->addField('totalCost');
$fields->addField('receivedDate');
$fields->addField('fundtype');
$fields->addField('Remarks');
$fields->addField('counterId');
$fields->addField('searchby');
$fields->addField('search');
$fields->addField('disposedDate');
$fields->addField('disposedReason');
$fields->addField('identificationnos');
$fields->addField('presentLocation');
$fields->addField('acquisitionInstitute');
$fields->addField('natureOwnership');

$slidebartype = 5;
$error = 0;
$exps = array();


if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'startpage';
}

if ($_SESSION['SESS_LEVEL'] == 25) {
	$assetscenter = $_SESSION['SESS_PROTOCOLT2'];
} else {
	$assetscenter = $_SESSION['SESS_CENTRE'];
}
$assetunit = $_SESSION['SESS_PLACE'];

$Qinfo = QuickInfoDB::getActivatedDetails();
$logo = unitdetailsDB::getCrestByUnit($assetunit);
if (empty($logo)) {
	$logo = "../pic/1.jpg";
	} else {
	$logo = "../controls/".$logo;
}
switch ($action) {
    case 'startpage':
        $slidebartype = 0;
        include('startpage.php');
        break;
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'List_Details':
	    $items = OfficeEquDB::getFullDetails();
		//$checkAllowType = OfficeEquDB::getIsAllocation($assetscenter, $assetunit);
		//if ($checkAllowType == 2) {
		//$itemAll = OfficeEquDB::getAllocationDetails($assetunit);
		//foreach ($itemAll as $row) {
        //    $items[] = $row;
        //}
		//}
                     // $items = OfficeEquDB::getFullDetails();
	   	             //include('full_list_jq.php');
        include('full_list.php');
        break;
    case 'Full_List':
	        $items = OfficeEquDB::getFullDetails();
		$checkAllowType = OfficeEquDB::getIsAllocation($assetscenter, $assetunit);
		if ($checkAllowType == 2) {
		$itemAll = OfficeEquDB::getAllocationDetails($assetunit);
		foreach ($itemAll as $row) {
            $items[] = $row;
        }
		}
       // $items = OfficeEquDB::getFullDetails();
        include('full_list.php');
        break;
    case 'Paging_List':
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('paging_list.php');
        break;
    case 'Paging_List_csv':
		if (isset($_POST['commu'])) {
			$mainCategory = "COMMUNICATION EQUIPMENTS";
		} elseif (isset($_POST['compu'])) {
			$mainCategory = "COMPUTER EQUIPMENTS";
		} elseif (isset($_POST['softw'])) {
			$mainCategory = "COMPUTER SOFTWARE";
		} elseif (isset($_POST['elect'])) {
			$mainCategory = "ELECTRICAL EQUIPMENTS";
		} elseif (isset($_POST['firep'])) {
			$mainCategory = "FIRE PROTECTION EQUIPMENTS";
		} elseif (isset($_POST['furni'])) {
			$mainCategory = "FURNITURE";
		} elseif (isset($_POST['music'])) {
			$mainCategory = "MUSICAL INSTRUMENTS";
		} elseif (isset($_POST['offic'])) {
			$mainCategory = "OFFICE EQUIPMENTS";
		} elseif (isset($_POST['sport'])) {
			$mainCategory = "SPORTS EQUIPMENTS";
		} elseif (isset($_POST['biolo'])) {
			$mainCategory = "BIOLOGICAL ASSETS";
		}
			$items = OfficeEquDB::getFullDetails_maincat($mainCategory);
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename='.$mainCategory.'.csv');
			$output = fopen('php://output', 'w');
			fputcsv($output, array('S/N', 'Unit', 'Identification No', 'Category', 'Description', 'Asset No', 'Catalogue No', 'Serial No.', 'Present Locaton', 'DOP', 'DOR', 'Unit Value'));
			$i = 0;
			foreach ($items as $exp) {
				$i++;
				$fields = array($i, $exp['assetunit'], $exp['identificationno'], $exp['itemCategory'], $exp['itemDescription'], $exp['assetsno'], $exp['catalogueno'], $exp['eqptSriNo'], $exp['presentLocation'], $exp['purchasedDate'], $exp['receivedDate'], $exp['unitValue']);
				fputcsv($output, $fields);
			}
			fclose($output);
		break;
    case 'paging_list_headfix':
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('paging_list_headfix.php');
        break;
    case 'Add_Details':
        $slidebartype = 3;
        $error = 0;
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $ledgerno = "AB 09";
        $ledgerFoliono = "";
        $eqptSriNo = "";
        $purchasedDate = "";
        $quantity = "";
        $capacity = "";
        $unitValue = "";
        $totalCost = "";
        $receivedDate = "";
        $presentLocation = "";
		$fundtype = "";
        $Remarks = "";
        $counterId = 0;
        $groupId = 0;
        $notapprived = 0;
        $id = 0;
        setcookie('groupId', 0);
        $identificationnoTem = "";
        $acquisitionInstitute = "";
		$natureOwnership = "";
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);
        $mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $institutes = InstituteDB::getFullDetails();
		if ($assetunit == 'Dte of AMS') {$units = array('Dte of AMS', '1 SLAMC', '3 SLAMC', '4 SLAMC', '5 SLAMC', 'Mil Hosp(CBO)'); }// 
		//$units = AssetsUnitDB::getAssetsUnits();
        $qty = 0;
        $idList = array();
        include('add_details.php');
        break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
		        if (isset($_POST['transfer'])) {
            $transfer = $_POST['transfer'];
        } else if (isset($_GET['transfer'])) {
            $transfer = $_GET['transfer'];
        } else {
            $transfer = 0;
        }
        setcookie('assetscenter', $assetscenter, time() + 3600);
		$assetunit = "";
		$transferToUnit = "";
        if ($transfer == 1) {
            $assetunits = AssetsUnitDB::getAssetsUnitsByCenterAll($assetscenter);
            include('../view/findassetsunitsbycenterall.php');
        } else {
            $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
            include('../view/findassetsunitsbycenter.php');
        }
       // $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
       // include('../view/findassetsunitsbycenter.php');
        break;
    case 'findCategoryByMainCategory':
        $mainCategory = $_GET['mainCategory'];
		setcookie('mainCategory', $mainCategory, time() + 3600);
        $itemCategory = "";
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        include('../view/findcategorybymaincategory.php');
        break;
    case 'findDescriptionByCategory':
        //$mainCategory = $_REQUEST['mainCategory'];
		$mainCategory = $_COOKIE["mainCategory"] ?? "";
        $itemCategory = $_GET['itemCategory'];
		setcookie('itemCategory', $itemCategory, time() + 3600);
        $itemDescription = "";
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        include('../view/finddescriptionbycategory.php');
        break;
    case 'findCataloguenoByDescription':
	        $mainCategory = $_COOKIE["mainCategory"] ?? "";
        $itemCategory = $_COOKIE["itemCategory"];
       // $mainCategory = $_REQUEST['mainCategory'];
       // $itemCategory = $_REQUEST['itemCategory'];
        $itemDescription = $_GET['itemDescription'];
        $catalogueno = "";
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        include('../view/findcataloguenobydescription.php');
        break;
    case 'findAssetsnoByCatalogueno':
        $catalogueno = $_GET['catalogueno'];
        //$assetsno = "";
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        setcookie('catalogueno', $_GET['catalogueno']);
        setcookie('assetsno', $assetsnos->getId());
        include('../view/findassetsnobycatalogueno.php');
        break;
    case 'findPresentUnitByUnit':
        setcookie('assetsUnit', $_GET['unit']);
        break;
    case 'generateCodeList':
        $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
        if ($_COOKIE["groupId"] == 0) {
            $counterIdD = OfficeEquDB::getCounterId($_COOKIE["assetsUnit"], $_COOKIE["catalogueno"]);
        } else {
            $counterIdD = $_COOKIE["counterID"];
            $counterIdD--;
        }
        $qty = (int) $_COOKIE["quantity"];
        $idList = array();
        $counterIds = array();
        for ($x = 1; $x <= $qty; $x++) {
            $counterIdD++;
            $counterId = sprintf("%04d", $counterIdD);
            $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $_COOKIE["catalogueno"] . "/" . $counterId;
            $idList[] = $identificationno;
            $counterIds[] = $counterId;
            setcookie('counterId', $counterIdD);
        }
        $groupId = OfficeEquDB::getGroupId();
        include('../view/findgeneratecodelist.php');
        ////
        /* $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
          $counterIdD = OfficeEquDB::getCounterId($_COOKIE["assetsUnit"]);
          $qty = (int) $_COOKIE["quantity"];
          $idList = array();
          $counterIds = array();
          for ($x = 1; $x <= $qty; $x++) {
          $counterIdD++;
          $counterId = sprintf("%04d", $counterIdD);
          $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $_COOKIE["catalogueno"] . "/" . $counterId;
          $idList[] = $identificationno;
          $counterIds[] = $counterId;
          setcookie('counterId', $counterIdD);
          }
          $groupId = OfficeEquDB::getGroupId();
          include('../view/findgenerateCodeList.php');
         */
        ////
        /*
          $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
          $counterIdD = OfficeEquDB::getCounterId($_COOKIE["assetsUnit"]);
          $counterIdD++;
          $counterId = sprintf("%04d", $counterIdD);
          //	$identificationno = $centreID->getName()."/".$_COOKIE["assetsno"]."/".$catalohueno."/".$counterId;
          $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $_COOKIE["catalogueno"] . "/" . $counterId;
          setcookie('counterId', $counterIdD);
          echo $identificationno;
         */
        break;
    case 'Add_Detail':
        //die('in-side');
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $mainCategory = $_POST['mainCategory'];
        $itemCategory = $_POST['itemCategory'];
        $itemDescription = $_POST['itemDescription'];
        $assetsno = $_POST['assetsno'];
        $newAssestno = $_POST['newAssestno'];
        $catalogueno = $_POST['catalogueno'];
        //$identificationno = $_POST['identificationno'];
        $ledgerno = strtoupper($_POST['ledgerno']);
        $ledgerFoliono = strtoupper($_POST['ledgerFoliono']);
        $eqptSriNo = strtoupper($_POST['eqptSriNo']);
        $purchasedDate = $_POST['purchasedDate'];
        $quantity = $_POST['quantity'];
        $groupQty = $_POST['quantity'];
        $capacity = $_POST['capacity'];
        $unitValue = $_POST['unitValue'];
        $totalCost = 0;
        $receivedDate = $_POST['receivedDate'];
        $presentLocation = $_POST['presentLocation'];
		$fundtype = strtoupper($_POST['fundtype']);
        $Remarks = strtoupper($_POST['Remarks']);
        $counterId = $_COOKIE['counterId'];
        $identificationnos = $_POST['identificationnos'];
        $idList = explode(";", $identificationnos);
        $counterId = $_COOKIE['counterId'];
        $id = $_POST['id'];
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
        $identificationnoTem = $_POST['identificationnoTem'];
        $groupId = $_POST['groupId'];
        $acquisitionInstitute = $_POST['acquisitionInstitute'];
		$natureOwnership = strtoupper($_POST['natureOwnership']);

        $validate->text('assetscenter', $assetscenter);
        $validate->text('assetunit', $assetunit);
        $validate->text('mainCategory', $mainCategory);
        $validate->text('itemCategory', $itemCategory);
        $validate->text('itemDescription', $itemDescription);
        $validate->text('assetsno', $assetsno);
        $validate->text('newAssestno', $newAssestno);
        $validate->text('catalogueno', $catalogueno);
        $validate->longText('identificationnos', $identificationnos);
        //$validate->text('identificationno', $identificationno);
        $validate->text('ledgerno', $ledgerno);
        $validate->text('ledgerFoliono', $ledgerFoliono);
        //$validate->text('eqptSriNo', $eqptSriNo);
        //$validate->passeddate('purchasedDate', $purchasedDate);
        $validate->number('quantity', $quantity);
        //$validate->number('capacity', $capacity);
        $validate->number('unitValue', $unitValue);
        //$validate->number('totalCost', $totalCost);
        $validate->passeddate('receivedDate', $receivedDate);
        //$validate->current_year_date('receivedDate', $receivedDate, $currentYear);
		$validate->text('presentLocation', $presentLocation);
        //$validate->text('Remarks', $Remarks);
        $validate->text('counterId', $counterId);


        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $institutes = InstituteDB::getFullDetails();
		if ($assetunit == 'Dte of AMS') {$units = array('Dte of AMS', '1 SLAMC', '3 SLAMC', '4 SLAMC', '5 SLAMC', 'Mil Hosp(CBO)'); }
        if ($groupId == 0) {
            $groupIdNew = OfficeEquDB::getGroupId();
        } else {
            $groupIdNew = $groupId;
        }
        //$groupId = OfficeEquDB::getGroupId();
        $qty = (int) $_COOKIE["quantity"];
// Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            $slidebartype = 3;
            $Items = OfficeEquDB::getItemsNotApproved();
            $Items_Sub = OfficeEquDB::getItemsApproveRejected();
			$Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
            $error = 2;
            $notapprived = 0;
            include('ADD_Details.php');
        } else {
            if ($groupId != 0) {
                OfficeEquDB::deleteDetailsByGroupId($groupId);
            }
            $identificationnos = $_POST['identificationnos'];
            $idList = explode(";", $identificationnos);
            for ($x = 0; $x < $qty; $x++) {
                $identificationno = $idList[$x];
                $counterId = (int) substr($identificationno, -4);
                $officeEqu = new PlantMac($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $assetsno, $newAssestno, $catalogueno, $identificationno, $ledgerno, $ledgerFoliono, $eqptSriNo, $purchasedDate, $quantity, $capacity, $unitValue, $totalCost, $receivedDate, $Remarks, $counterId, $groupIdNew, $groupQty, $presentLocation, "", "", "", "", "", "", $acquisitionInstitute, $natureOwnership);
                $count = OfficeEquDB::getHasRecord($officeEqu);
                if ($count > 0) {
                    $error = 3;
                    break 1;
                } else {
                    $saveCount = OfficeEquDB::addOfficeEqu($officeEqu);
                    if ($saveCount == 1) {
                        setcookie('groupId', 0);
                        $groupId = 0;
                        $identificationnoTem = "";
                        $error = 1;
						$count = OfficeEquDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
						$count = OfficeEquDB::Save_psos_allow(1, $itemCategory, $identificationno);
						$countft = OfficeEquDB::Save_fundtype($fundtype, $identificationno);
						if ($proto['protocollevel1'] == 25) {
							$count = OfficeEquDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
						} else {
							$count = OfficeEquDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
						}
                    } else {
                        $error = 5;
                        break 1;
                    }
                }
            }
            $slidebartype = 3;
            $Items = OfficeEquDB::getItemsNotApproved();
            $Items_Sub = OfficeEquDB::getItemsApproveRejected();
			$Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
			//if ($assetunit == 'Dte of AMS') {$units = array('Dte of AMS', '1 SLAMC', '3 SLAMC', '4 SLAMC', '5 SLAMC', 'Mil Hosp(CBO)'); }//
			//$units = AssetsUnitDB::getAssetsUnits();
            $notapprived = 0;
            include('add_details.php');
        }
        break;
    case 'List_Disposal':
        $slidebartype = 1;
        include('startpage.php');
        break;
    case 'Select_Items_For_Disposal':
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $searchby = "";
        $search = "";
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $slidebartype = 1;
        include('select_disposal.php');
        break;
    case 'Selected_Items_For_Disposal':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = "";
        }
        $slidebartype = 14;
        $Items = OfficeEquDB::getSelectedDisposalItems();
        $PlantMac = OfficeEquDB::getDetailsById($id);

        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'] ?? "";
        $assetunit = $OfficeEqu['assetunit'] ?? "";
        $mainCategory = $OfficeEqu['mainCategory'] ?? "";
        $itemCategory = $OfficeEqu['itemCategory'] ?? "";
        $itemDescription = $OfficeEqu['itemDescription'] ?? "";
        $assetsno = $OfficeEqu['assetsno'] ?? "";
        $newAssestno = $OfficeEqu['newAssestno'] ?? "";
        $catalogueno = $OfficeEqu['catalogueno'] ?? "";
        $identificationno = $OfficeEqu['identificationno'] ?? "";
        $ledgerno = $OfficeEqu['ledgerno'] ?? "";
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'] ?? "";
        $eqptSriNo = $OfficeEqu['eqptSriNo'] ?? "";
        $purchasedDate = $OfficeEqu['purchasedDate'] ?? "";
        $quantity = $OfficeEqu['quantity'] ?? "";
        $capacity = $OfficeEqu['capacity'] ?? "";
        $unitValue = $OfficeEqu['unitValue'] ?? "";
        $totalCost = $OfficeEqu['totalCost'] ?? "";
        $receivedDate = $OfficeEqu['receivedDate'] ?? "";
        $presentLocation = $OfficeEqu['presentLocation'] ?? "";
        $fundtype = $OfficeEqu['fundtype'] ?? "";
		$Remarks = $OfficeEqu['Remarks'] ?? "";
        $id = $OfficeEqu['id'] ?? "";
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'] ?? "";
		$natureOwnership = $OfficeEqu['natureOwnership'] ?? "";
        $selectDisposal = $OfficeEqu['selectDisposal'] ?? "";
        $disposedDate = $OfficeEqu['disposedDate'] ?? "";
        $disposedReason = $OfficeEqu['disposedReason'] ?? "";
		$condemnation = $OfficeEqu['condemnation'] ?? "";
		$destruction = $OfficeEqu['destruction'] ?? "";
        //include('startpage.php');
        include('add_disposal.php');
        break;
    case 'search_Disposals':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $mainCategory = $_POST['mainCategory'];
        $itemCategory = $_POST['itemCategory'];
        $itemDescription = $_POST['itemDescription'];
        $assetsno = $_POST['assetsno'];
        $newAssestno = $_POST['newAssestno'];
        $catalogueno = $_POST['catalogueno'];
        $searchby = $_POST['searchby'];
        $search = $_POST['search'];
        $search = ($search == '' ? "  " : $search);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
        setcookie('catalogueno', $catalogueno);
        setcookie('searchby', $searchby);
        setcookie('search', $search);
        $slidebartype = 21;
        include('select_disposal.php');
        break;
    case 'search_Disposal':
        $id = $_GET['id'];
		if(!isset($_COOKIE['catalogueno'])) {
			$catalogueno = ""; 
		} else {
			$catalogueno = $_COOKIE['catalogueno'];
		}
        
        $searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $id = $OfficeEqu['id'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
		$condemnation = $OfficeEqu['condemnation'];
		$destruction = $OfficeEqu['destruction'];
        $Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
        $slidebartype = 21;
        include('add_disposal.php');
        break;
    case 'SelectDisposalSave':
        $id = $_POST['id'];
        if (isset($_POST['selectDisposal'])) {
            $selectDisposal = 1;
        } else {
            $selectDisposal = 0;
        }
        $slidebartype = $_POST['slidebartype'];
        $disposedDate = $_POST['disposedDate'];
        $disposedReason = $_POST['disposedReason'];
		$condemnation = $_POST['condemnation'];
		$destruction = $_POST['destruction'];
        $login = $_SESSION['SESS_LOGIN'];
        if ($selectDisposal == 1) {
           // $validate->passeddate('disposedDate', $disposedDate);
            $validate->text('disposedReason', $disposedReason);
        }

        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            $count = OfficeEquDB::SelectDisposalSave($id, $selectDisposal, $disposedDate, $disposedReason, $condemnation, $destruction, $login);
        }
        //
        $catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";

        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $id = $OfficeEqu['id'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
		$condemnation = $OfficeEqu['condemnation'];
		$destruction = $OfficeEqu['destruction'];
        if ($slidebartype == 21) {
            $Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
            // $slidebartype = 21;
        } else if ($slidebartype == 14) {
            //$slidebartype = 14;
            $Items = OfficeEquDB::getSelectedDisposalItems();
        }
        include('add_disposal.php');
        break;
    case 'Confirm_Items_For_Disposal':
        $Items = OfficeEquDB::getToConfirmDisposalItemsSort();
        $slidebartype = 22;
        include('startpage.php');
        break;
    case 'confirm_Disposal' :
        $id = $_GET['id'];
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $confirmDisposal = $OfficeEqu['confirmDisposal'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
		$condemnation = $OfficeEqu['condemnation'];
		$destruction = $OfficeEqu['destruction'];
        $Items = OfficeEquDB::getToConfirmDisposalItemsSort();
        $slidebartype = 22;
        include('confirm_disposal.php');
        break;
    case 'ConfirmDisposalSave':
        $id = $_POST['id'];
        if (isset($_POST['confirmDisposal'])) {
            $confirmDisposal = 1;
        } else {
            $confirmDisposal = 0;
        }
        $login = $_SESSION['SESS_LOGIN'];
        $count = OfficeEquDB::ConfirmDisposalSave($id, $confirmDisposal, $login);
        $OfficeEqu = OfficeEquDB::getDetailsById($id);

        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $confirmDisposal = $OfficeEqu['confirmDisposal'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
		$condemnation = $OfficeEqu['condemnation'];
		$destruction = $OfficeEqu['destruction'];
        $Items = OfficeEquDB::getToConfirmDisposalItems();
        $slidebartype = 22;
        include('confirm_disposal.php');
        break;
	 case 'ConfirmDisposalReject':
        $id = $_POST['id'];

        $count = OfficeEquDB::ConfirmDisposalReject($id);
        /*
		$OfficeEqu = OfficeEquDB::getDetailsById($id);

        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $confirmDisposal = $OfficeEqu['confirmDisposal'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];

		*/
        $Items = OfficeEquDB::getToConfirmDisposalItems();
        $slidebartype = 22;
        include('startpage.php');
        break;
    case 'approve_Items_For_Disposal':
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$slidebartype = 1;
        include('select_approve_disposal.php');
        break;
    case 'approve_Items_For_Disposal_catlog':
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$items = OfficeEquDB::getApproveDisposalItems_catlog($assetunit);
        $slidebartype = 1;
        include('select_approve_disposal_catlog.php');
        break;
    case 'approve_Items_For_Disposal_catlog_2':
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
		$catalogueno = $_GET['catalogueno'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$items = OfficeEquDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
        $slidebartype = 1;
        include('select_approve_disposal_catlog_2.php');
        break;
    case 'approve_Items_For_Disposal_catlog_3':
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
		$id = $_GET['id'];
        $PlantMac = OfficeEquDB::getDetailsById($id);
        $assetscenter = $PlantMac['assetscenter'];
        $assetunit = $PlantMac['assetunit'];
        $mainCategory = $PlantMac['mainCategory'];
        $itemCategory = $PlantMac['itemCategory'];
        $itemDescription = $PlantMac['itemDescription'];
        $assetsno = $PlantMac['assetsno'];
        $newAssestno = $PlantMac['newAssestno'];
        $catalogueno = $PlantMac['catalogueno'];
        $identificationno = $PlantMac['identificationno'];
        $ledgerno = $PlantMac['ledgerno'];
        $ledgerFoliono = $PlantMac['ledgerFoliono'];
        $eqptSriNo = $PlantMac['eqptSriNo'];
        $purchasedDate = $PlantMac['purchasedDate'];
        $quantity = $PlantMac['quantity'];
        $capacity = $PlantMac['capacity'];
        $unitValue = $PlantMac['unitValue'];
        $totalCost = $PlantMac['totalCost'];
        $receivedDate = $PlantMac['receivedDate'];
        $fundtype = $PlantMac['fundtype'];
		$Remarks = $PlantMac['Remarks'];
        $acquisitionInstitute = $PlantMac['acquisitionInstitute'];
        $presentLocation = $PlantMac['presentLocation'];
        $disposedDate = $PlantMac['disposedDate'];
        $disposedReason = $PlantMac['disposedReason'];
        $ApprovedDisposal = $PlantMac['ApprovedDisposal'];
		$condemnation = $PlantMac['condemnation'];
		$destruction = $PlantMac['destruction'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		//$items = PlantMacDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
        $slidebartype = 1;
        include('select_approve_disposal_catlog_3.php');
        break;
    case 'approve_Items_For_Disposal_catlog_4':
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
		$catalogueno = $_POST['catalogueno'];
		$id = $_POST['id'];
        if (isset($_POST['ApprovedDisposal'])) {
            $ApprovedDisposal = 1;
        } else {
            $ApprovedDisposal = 0;
        }
        $login = $_SESSION['SESS_LOGIN'];
        $count = OfficeEquDB::ApproveDisposalSave($id, $ApprovedDisposal, $login);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$items = OfficeEquDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
        $slidebartype = 1;
        include('select_approve_disposal_catlog_2.php');
        break;
  case 'approve_Items_For_Disposal_catlog_5':
		 $id = $_GET['id'];
		 $Approved = $_GET['Approved'];
		 $login = $_SESSION['SESS_LOGIN'];
		 if ($Approved == 1) {
		 $count = OfficeEquDB::ApproveDisposalSave($id, $Approved, $login);
		 } else {
		 $count = 0; 
		 }
		 echo json_encode($count);
         break;
  case 'approve_Items_For_Disposal_catlog_6':
		$assetunit = $_GET['assetunit'];
		$catalogueno = $_GET['catalogueno'];
		$login = $_SESSION['SESS_LOGIN'];
		$items = OfficeEquDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
		$count = 0;
		foreach ($items as $exp) {
			$id = $exp['id'];
			$count = OfficeEquDB::ApproveDisposalSave($id, 1, $login);
			$count = $count + 1;
		}
		 echo json_encode($count);
         break;	
  case 'approve_Items_For_Disposal_catlog_7':
		 $id = (int)ltrim($_GET['id'], 'reg_');
		 $count = OfficeEquDB::RejectDisposalSave($id);
		 echo json_encode($id);
         break;		 
    case 'approve_search_Disposals':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $id = "";
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $ledgerno = "";
        $ledgerFoliono = "";
        $eqptSriNo = "";
        $purchasedDate = "";
        $quantity = "";
        $capacity = "";
        $unitValue = "";
        $totalCost = "";
        $receivedDate = "";
        $presentLocation = "";
        $fundtype = "";
		$Remarks = "";
        $acquisitionInstitute = "";
        $disposedDate = "";
        $disposedReason = "";
        $ApprovedDisposal = "";
		$condemnation = "";
		$destruction = "";
        $Items = OfficeEquDB::getApproveDisposalItems($assetunit);
        $slidebartype = 23;
        include('approve_disposal.php');
        break;
    case 'approve_Disposal':
        if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
        } else {
            $assetscenter = '';
        }
        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
        } else {
            $assetunit = '';
        }
        $id = $_GET['id'];
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $confirmDisposal = $OfficeEqu['confirmDisposal'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
        $ApprovedDisposal = $OfficeEqu['ApprovedDisposal'];
		$condemnation = $OfficeEqu['condemnation'];
		$destruction = $OfficeEqu['destruction'];
        $Items = OfficeEquDB::getApproveDisposalItems($assetunit);
        $slidebartype = 23;
        include('approve_disposal.php');
        break;
    case 'ApproveDisposalSave':
        $id = $_POST['id'];
        if (isset($_POST['ApprovedDisposal'])) {
            $ApprovedDisposal = 1;
        } else {
            $ApprovedDisposal = 0;
        }
        $login = $_SESSION['SESS_LOGIN'];
        $count = OfficeEquDB::ApproveDisposalSave($id, $ApprovedDisposal, $login);
        $OfficeEqu = OfficeEquDB::getDetailsById($id);

        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];

        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $ledgerno = "";
        $ledgerFoliono = "";
        $eqptSriNo = "";
        $purchasedDate = "";
        $quantity = "";
        $capacity = "";
        $unitValue = "";
        $totalCost = "";
        $receivedDate = "";
        $presentLocation = "";
        $fundtype = "";
		$Remarks = "";
        $disposedDate = "";
        $disposedReason = "";
        $ApprovedDisposal = "";
		$condemnation = "";
		$destruction = "";
        $acquisitionInstitute = "";
        $Items = OfficeEquDB::getApproveDisposalItems($assetunit);
        $slidebartype = 23;
        include('approve_disposal.php');
        break;
    case 'Disposal_List':
        //$items = OfficeEquDB::getDisposalDetails();
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getDisposalDetailsPaging($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecordsDisposalDetails();
		$total_pages = ceil($total_records / $per_page);
        include('disposal_list.php');
        break;
    case 'DisposalList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 24;
        $Items = OfficeEquDB::getDisposalDetails();
        $OfficeEqu = OfficeEquDB::getDetailsByIdentificationno($identificationno);

        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $confirmDisposal = $OfficeEqu['confirmDisposal'];
        $selectDisposal = $OfficeEqu['selectDisposal'];
        $disposedDate = $OfficeEqu['disposedDate'];
        $disposedReason = $OfficeEqu['disposedReason'];
        $id = $OfficeEqu['id'];
        include('disposal_details.php');
        break;
    /* case 'Insert_Disposal':
      $slidebartype = 1;
      include('startpage.php');
      break;
      case 'Assign_Disposal':
      $slidebartype = 1;
      include('startpage.php');
      break;
      case 'Approved_Disposal':
      $slidebartype = 1;
      include('startpage.php');
      break;
      case 'Tobe_Approved_Disposal':
      $slidebartype = 1;
      include('startpage.php');
      break;
     */
    case 'List_Approved':
        $slidebartype = 11;
        include('startpage.php');
        break;
    case 'Tobe_Approve':
        $slidebartype = 12;
         if (isset($_GET['listdelete'])) {
			$count = OfficeEquDB::deleteItemsNotApproved(); 
		}
		if (isset($_GET['Rejectedlistdelete'])) {
			$count = OfficeEquDB::deleteItemsRejected(); 
		}       
		$Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        include('startpage.php');
        break;
    case 'toBeApproveList':
        $identificationno = $_GET['identificationno'];
        $row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
		$slidebartype = 12;
        $idList = array();
        $id = array();
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        $OfficeEqus = OfficeEquDB::getDetailsByIdentificationnoGroup($identificationno);
        foreach ($OfficeEqus as $OfficeEqu) :
            $assetscenter = $OfficeEqu['assetscenter'];
            $assetunit = $OfficeEqu['assetunit'];
            $mainCategory = $OfficeEqu['mainCategory'];
            $itemCategory = $OfficeEqu['itemCategory'];
            $itemDescription = $OfficeEqu['itemDescription'];
            $assetsno = $OfficeEqu['assetsno'];
            $newAssestno = $OfficeEqu['newAssestno'];
            $catalogueno = $OfficeEqu['catalogueno'];
			$natureOwnership = $OfficeEqu['natureOwnership'];
            $idList[] = $OfficeEqu['identificationno'];
            $ledgerno = $OfficeEqu['ledgerno'];
            $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
            $eqptSriNo = $OfficeEqu['eqptSriNo'];
            $purchasedDate = $OfficeEqu['purchasedDate'];
            $quantity = floatval($OfficeEqu['quantity']);
            $capacity = $OfficeEqu['capacity'];
            $unitValue = $OfficeEqu['unitValue'];
            $totalCost = $OfficeEqu['totalCost'];
            $receivedDate = $OfficeEqu['receivedDate'];
            $presentLocation = $OfficeEqu['presentLocation'];
            $fundtype = $OfficeEqu['fundtype'];
			$Remarks = $OfficeEqu['Remarks'];
            $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
            $notapprived = $OfficeEqu['notapprived'];
            $notapprivedReason = $OfficeEqu['notapprivedReason'];
            $id[] = $OfficeEqu['id'];
        endforeach;
        $id = implode(";", $id);
        $qty = $quantity;
        include('approve_details.php');
        break;
    case 'approveSave':
        $id = $_POST['id'];
        $id = explode(";", $id);
        $qty = count($id);
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 12;
        $count = 0;
        for ($x = 0; $x < $qty; $x++) {
            $count = OfficeEquDB::ApproveDetails($id[$x], $login);
        }
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        include('startpage.php');
        break;
    case 'notApproveSave':
        $id = $_POST['id'];
        $notapprivedReason = $_POST['notapprivedReason'];
        $id = explode(";", $id);
        $qty = count($id);
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 12;
        $count = 0;
        for ($x = 0; $x < $qty; $x++) {
            $count = OfficeEquDB::notApproveDetails($id[$x], $login, $notapprivedReason);
        }
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        include('startpage.php');
        break;
    case 'Approved':
        $slidebartype = 13;
        $Items = OfficeEquDB::getItemsApproved();
        include('startpage.php');
        break;
    case 'ApprovedList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        //$Items = OfficeEquDB::getItemsApproved();
        $OfficeEqu = OfficeEquDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
        $notapprived = $OfficeEqu['notapprived'];
        $id = $OfficeEqu['id'];
		$groupId = $OfficeEqu['groupId'];
		$damcomment = $OfficeEqu['damcomment'];
        include('approved_details.php');
        break;
    case 'update_Details':
        $slidebartype = 3;
        $error = 0;
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
        $groupId = $_GET['groupId'];
        $identificationno = $_GET['identificationno'];
        $identificationnoTem = $identificationno;
        $idList = array();
        $id = array();
        $i = 0;
        $OfficeEqus = OfficeEquDB::getDetailsByIdentificationnoGroup($identificationno);
        foreach ($OfficeEqus as $OfficeEqu) :
            $assetscenter = $OfficeEqu['assetscenter'];
            $assetunit = $OfficeEqu['assetunit'];
            $mainCategory = $OfficeEqu['mainCategory'];
            $itemCategory = $OfficeEqu['itemCategory'];
            $itemDescription = $OfficeEqu['itemDescription'];
            $assetsno = $OfficeEqu['assetsno'];
            $newAssestno = $OfficeEqu['newAssestno'];
            $catalogueno = $OfficeEqu['catalogueno'];
            $idList[] = $OfficeEqu['identificationno'];
            $ledgerno = $OfficeEqu['ledgerno'];
            $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
            $eqptSriNo = $OfficeEqu['eqptSriNo'];
            $purchasedDate = $OfficeEqu['purchasedDate'];
            // $quantity = $PlantMac['quantity'];
            $quantity = $OfficeEqu['groupQty'];
            $capacity = $OfficeEqu['capacity'];
            $unitValue = $OfficeEqu['unitValue'];
            $totalCost = $OfficeEqu['totalCost'];
            $receivedDate = $OfficeEqu['receivedDate'];
            $presentLocation = $OfficeEqu['presentLocation'];
            $fundtype = $OfficeEqu['fundtype'];
			$Remarks = $OfficeEqu['Remarks'];
            $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
            $notapprived = $OfficeEqu['notapprived'];
            $notapprivedReason = $OfficeEqu['notapprivedReason'];
			$natureOwnership = $OfficeEqu['natureOwnership'];
            $id[] = $OfficeEqu['id'];
            $groupId = $OfficeEqu['groupId'];
            if ($i == 0) {
                $counterID = $OfficeEqu['counterId'];
            }
            $lastCounterID = $OfficeEqu['counterId'];
            $i++;
        endforeach;
        $id = implode(";", $id);
        $qty = $quantity;
        $delComfirem = implode(";", $idList);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $groupIdNew = OfficeEquDB::getGroupId();
        $institutes = InstituteDB::getFullDetails();
		if ($assetunit == 'Dte of AMS') {$units = array('Dte of AMS', '1 SLAMC', '3 SLAMC', '4 SLAMC', '5 SLAMC', 'Mil Hosp(CBO)'); }//
		//$units = AssetsUnitDB::getAssetsUnits();
        setcookie('assetsno', $assetsno);
        setcookie('catalogueno', $catalogueno);
        setcookie('assetsUnit', $assetunit);
        setcookie('quantity', $quantity);
        setcookie('groupId', $groupId);
        setcookie('counterID', $counterID);
        //$newCounterID = OfficeEquDB::getCounterId($_COOKIE["assetsUnit"], $_COOKIE["assetsno"]);
        $newCounterID = OfficeEquDB::getCounterId($assetunit, $assetsno);
		include('add_details.php');
        break;
    case 'delete_Details':
        $slidebartype = 3;
        $error = 0;
        $groupId = $_POST['groupId'];
        $identificationno = $_POST['identificationno'];
        $identificationnoTem = $identificationno;
        $idList = array();
        $id = array();
        $i = 0;
        $OfficeEqus = OfficeEquDB::getDetailsByIdentificationnoGroup($identificationno);
        foreach ($OfficeEqus as $OfficeEqu) :
            $assetscenter = $OfficeEqu['assetscenter'];
            $assetunit = $OfficeEqu['assetunit'];
            $mainCategory = $OfficeEqu['mainCategory'];
            $itemCategory = $OfficeEqu['itemCategory'];
            $itemDescription = $OfficeEqu['itemDescription'];
            $assetsno = $OfficeEqu['assetsno'];
            $newAssestno = $OfficeEqu['newAssestno'];
            $catalogueno = $OfficeEqu['catalogueno'];
            $idList[] = $OfficeEqu['identificationno'];
            $ledgerno = $OfficeEqu['ledgerno'];
            $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
            $eqptSriNo = $OfficeEqu['eqptSriNo'];
            $purchasedDate = $OfficeEqu['purchasedDate'];
            // $quantity = $PlantMac['quantity'];
            $quantity = $OfficeEqu['groupQty'];
            $capacity = $OfficeEqu['capacity'];
            $unitValue = $OfficeEqu['unitValue'];
            $totalCost = $OfficeEqu['totalCost'];
            $receivedDate = $OfficeEqu['receivedDate'];
            $presentLocation = $OfficeEqu['presentLocation'];
            $fundtype = $OfficeEqu['fundtype'];
			$Remarks = $OfficeEqu['Remarks'];
            $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
            $id[] = $OfficeEqu['id'];
            $groupId = $OfficeEqu['groupId'];
            $counterId = $OfficeEqu['counterId'];
            if ($i == 0) {
                $counterID = $OfficeEqu['counterId'];
            }
            $i++;
        endforeach;

        $id = implode(";", $id);
        $qty = $quantity;

        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $groupIdNew = OfficeEquDB::getGroupId();

        setcookie('assetsno', $assetsno);
        setcookie('catalogueno', $catalogueno);
        setcookie('assetsUnit', $assetunit);
        setcookie('quantity', $quantity);
        setcookie('groupId', $groupId);
        setcookie('counterID', $counterID);

        $saveCount = OfficeEquDB::deleteDetailsByGroupId($groupId);
        //   if ($saveCount > 0) {
        setcookie('groupId', 0);
        $groupId = 0;
        $identificationnoTem = "";
        $error = 6;
        // } else {
        //     $error = 5;
        // break 1;
        // }
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
        include('add_details.php');
        break;
    case 'List_Inquiry':

        if (isset($_POST['disposal'])) {
            $disposal = $_POST['disposal'];
        } else if (isset($_GET['disposal'])) {
            $disposal = $_GET['disposal'];
        } else {
            $disposal = 0;
        }

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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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
		        if (isset($_POST['allocation'])) {
            $allocation = $_POST['allocation'];
        } else if (isset($_GET['allocation'])) {
            $allocation = $_GET['allocation'];
        } else {
            $allocation = 1;
        }
        include('coldefine.php');
        //$searchText = OfficeEquDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$checkAllowType = OfficeEquDB::getIsAllocation($assetscenter, $assetunit);
        if ($disposal == 1) {
            $items = OfficeEquDB::getInqDisposalDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        } else {
            $items = OfficeEquDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        }
		if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
        //    $assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
        //     $boardMemberName1 = $assetunits['boardMemberName1'];
        //     $boardMemberRank1 = $assetunits['boardMemberRank1'];
        //     $boardMemberNumber1 = $assetunits['boardMemberNumber1'];
        //     $boardMemberName2 = $assetunits['boardMemberName2'];
        //     $boardMemberRank2 = $assetunits['boardMemberRank2'];
        //     $boardMemberNumber2 = $assetunits['boardMemberNumber2'];
        //     $boardMemberName3 = $assetunits['boardMemberName3'];
        //     $boardMemberRank3 = $assetunits['boardMemberRank3'];
        //     $boardMemberNumber3 = $assetunits['boardMemberNumber3'];
		   //include('excel_list.php');
        }
		if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
        //     $assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
        //     $boardMemberName1 = $assetunits['boardMemberName1'];
        //     $boardMemberRank1 = $assetunits['boardMemberRank1'];
        //     $boardMemberNumber1 = $assetunits['boardMemberNumber1'];
        //     $boardMemberName2 = $assetunits['boardMemberName2'];
        //     $boardMemberRank2 = $assetunits['boardMemberRank2'];
        //     $boardMemberNumber2 = $assetunits['boardMemberNumber2'];
        //     $boardMemberName3 = $assetunits['boardMemberName3'];
        //     $boardMemberRank3 = $assetunits['boardMemberRank3'];
        //     $boardMemberNumber3 = $assetunits['boardMemberNumber3'];
		// 	include('print_list.php');
        }
        include('inquiry_list.php');
        break;
    case 'Disposal_Inquiry':
        if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
            $assetunit = $_POST['assetunit'];
            $disposedYear = $_POST['disposedYear'];		
        } else {
            $disposedYear = "";	
			$disposedYear = $currentYear;
		}
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = OfficeEquDB::getDisposal_Inquiry($assetunit, $disposedYear);
		include('Disposal_Inquiry.php');
        break;
    case 'Inquiry_List_Details':
        $identificationno = $_GET['identificationno'];
        $assetunit = $_GET['assetunit'];
        $searchby = $_GET['searchby'];
        $search = $_GET['search'];
        $inputField1 = $_GET['inputField1'];
        $inputField2 = $_GET['inputField2'];
        include('coldefine.php');
        $slidebartype = 8;
		$allocation = 1;
		$checkAllowType = OfficeEquDB::getIsAllocation($assetscenter, $assetunit);
        $items = OfficeEquDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        $OfficeEqu = OfficeEquDB::getDetailsByIdentificationno($identificationno);
        // $Vehicle = VehicleDB::getDetailsById($id);
        include('dbtovariable.php');

        $id = $OfficeEqu['id'];
        $fundtype = "";
        include('approved_details.php');
        break;
    case 'findSearchType':
        $searchby = $_GET['searchby'];
        include('coldefine.php');
        $searchText = OfficeEquDB::getSearchText($column);
        ?>
        <input list="searchs" name="search" style="width:200px;">
        <datalist id="searchs">
            <option value=""></option>
            <?php foreach ($searchText as $itemCate) { ?>
                <option value="<?php echo $itemCate; ?>">
                    <?php echo $itemCate; ?>
                </option>
            <?php } ?>
        </datalist>
        <?php
        break;
    case 'Approve_Items_For_Disposal_List':
        $items = OfficeEquDB::getApprovedConfirmedItems();
        include('approve_items_for_disposal_list.php');
        break;
    case 'Select_Items_For_Modifications':
        $assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : $assetscenter);
        $assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : $assetunit);
        $mainCategory = (isset($_POST['mainCategory']) ? $_POST['mainCategory'] : "");
        $itemCategory = (isset($_POST['itemCategory']) ? $_POST['itemCategory'] : "");
        $itemDescription = (isset($_POST['itemDescription']) ? $_POST['itemDescription'] : "");
        $assetsno = (isset($_POST['assetsno']) ? $_POST['assetsno'] : "");
        $newAssestno = (isset($_POST['newAssestno']) ? $_POST['newAssestno'] : "");
        $catalogueno = (isset($_POST['catalogueno']) ? $_POST['catalogueno'] : "");
        $searchby = (isset($_POST['searchby']) ? $_POST['searchby'] : "");
        $search = (isset($_POST['search']) ? $_POST['search'] : "");

		$search = ($search == '' ? "  " : $search);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        //$Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
		$Items = OfficeEquDB::getAllowModicationItems($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search);
        setcookie('assetscenter', $assetscenter);
		setcookie('assetunit', $assetunit);
		setcookie('mainCategory', $mainCategory);
		setcookie('itemCategory', $itemCategory);
		setcookie('itemDescription', $itemDescription);
		setcookie('catalogueno', $catalogueno);
        setcookie('searchby', $searchby);
        setcookie('search', $search);
   //     $slidebartype = 21;
        $slidebartype = 25;
        include('select_modification.php');
        break;
	case 'ModificationList':
        $id = $_GET['id'];
        $assetscenter = (isset($_COOKIE['assetscenter']) ? $_COOKIE['assetscenter'] : $assetscenter);
        $assetunit = (isset($_COOKIE['assetunit']) ? $_COOKIE['assetunit'] : $assetunit);
		$mainCategory = (isset($_COOKIE['mainCategory']) ? $_COOKIE['mainCategory'] : "");
		$itemCategory = (isset($_COOKIE['itemCategory']) ? $_COOKIE['itemCategory'] : "");
		$itemDescription = (isset($_COOKIE['itemDescription']) ? $_COOKIE['itemDescription'] : "");
		$catalogueno = (isset($_COOKIE['catalogueno']) ? $_COOKIE['catalogueno'] : "");
		$searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";
		$Items = OfficeEquDB::getAllowModicationItems($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search);
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $id = $OfficeEqu['id'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
		$groupId = $OfficeEqu['groupId'];
        //$Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
		$slidebartype = 25;
        include('add_modification.php');
        break;	
	case 'SelectModificationSave':
        $groupId = $_POST['groupId'];
		if (isset($_POST['selectmodification'])) {
			$count = OfficeEquDB::ModificationAllows($groupId); }
        $assetscenter = (isset($_COOKIE['assetscenter']) ? $_COOKIE['assetscenter'] : $assetscenter);
        $assetunit = (isset($_COOKIE['assetunit']) ? $_COOKIE['assetunit'] : $assetunit);
		$mainCategory = (isset($_COOKIE['mainCategory']) ? $_COOKIE['mainCategory'] : "");
		$itemCategory = (isset($_COOKIE['itemCategory']) ? $_COOKIE['itemCategory'] : "");
		$itemDescription = (isset($_COOKIE['itemDescription']) ? $_COOKIE['itemDescription'] : "");
		$catalogueno = (isset($_COOKIE['catalogueno']) ? $_COOKIE['catalogueno'] : "");
		$searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";
		//$Items = OfficeEquDB::getAllowModicationItems($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search);
		//$catalogueno = (isset($_COOKIE['catalogueno']) ? $_COOKIE['catalogueno'] : "");
        //$searchby = $_COOKIE['searchby'];
        //$search = $_COOKIE['search'];
        //$Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
		$Items = OfficeEquDB::getAllowModicationItems($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search);
		$slidebartype = 25;
        include('startpage.php');
        break;
    case 'list_transfer':
        $slidebartype = 26;
        include('startpage.php');
        break;
   case 'Select_Items_For_Transfer':
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        /*$mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $searchby = "";
        $search = "";
		*/
		//$assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : "");
        //$assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : "");
        $mainCategory = (isset($_POST['mainCategory']) ? $_POST['mainCategory'] : "");
        $itemCategory = (isset($_POST['itemCategory']) ? $_POST['itemCategory'] : "");
        $itemDescription = (isset($_POST['itemDescription']) ? $_POST['itemDescription'] : "");
        $assetsno = (isset($_POST['assetsno']) ? $_POST['assetsno'] : "");
        $newAssestno = (isset($_POST['newAssestno']) ? $_POST['newAssestno'] : "");
        $catalogueno = (isset($_POST['catalogueno']) ? $_POST['catalogueno'] : "");
        $searchby = (isset($_POST['searchby']) ? $_POST['searchby'] : "");
        $search = (isset($_POST['search']) ? $_POST['search'] : "");

		$search = ($search == '' ? "  " : $search);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $Items = array();
        if ($_POST) {
		    $Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
        }
        setcookie('catalogueno', $catalogueno);
        setcookie('searchby', $searchby);
        setcookie('search', $search);
        $slidebartype = 27;
        include('select_transfer.php');
        break;
    case 'search_transfer':
        $id = $_GET['id'];
        $catalogueno = $_COOKIE['catalogueno'] ?? "";
        $searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'];
        $assetunit = $OfficeEqu['assetunit'];
        $mainCategory = $OfficeEqu['mainCategory'];
        $itemCategory = $OfficeEqu['itemCategory'];
        $itemDescription = $OfficeEqu['itemDescription'];
        $assetsno = $OfficeEqu['assetsno'];
        $newAssestno = $OfficeEqu['newAssestno'];
        $catalogueno = $OfficeEqu['catalogueno'];
        $identificationno = $OfficeEqu['identificationno'];
        $ledgerno = $OfficeEqu['ledgerno'];
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
        $eqptSriNo = $OfficeEqu['eqptSriNo'];
        $purchasedDate = $OfficeEqu['purchasedDate'];
        $quantity = $OfficeEqu['quantity'];
        $capacity = $OfficeEqu['capacity'];
        $unitValue = $OfficeEqu['unitValue'];
        $totalCost = $OfficeEqu['totalCost'];
        $receivedDate = $OfficeEqu['receivedDate'];
        $presentLocation = $OfficeEqu['presentLocation'];
        $fundtype = $OfficeEqu['fundtype'];
		$Remarks = $OfficeEqu['Remarks'];
        $id = $OfficeEqu['id'];
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
		
		$transferSelect = $OfficeEqu['transferSelect'];
		$transferToCenter = $OfficeEqu['transferToCenter'];
		$transferToUnit = $OfficeEqu['transferToUnit'];
		$transferToDate = $OfficeEqu['transferToDate'];
		$transferToDetails = $OfficeEqu['transferToDetails'];
		$assetsCenters = AssetsCenterDB::getAssetsCentersAll();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenterAll($transferToCenter);
		
        $Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
        $slidebartype = 27;
        include('add_transfer.php');
        break;
    case 'SelectTransferSave':
        $id = $_POST['id'];
        $slidebartype = $_POST['slidebartype'];
        $login = $_SESSION['SESS_LOGIN'];

            if (isset($_POST['transferSelect'])) {
                $transferSelect = 1;
            } else {
                $transferSelect = 0;
            }
            $transferToCenter = $_POST['transferToCenter'];
            $transferToUnit = $_POST['transferToUnit'];
            $transferToDetails = $_POST['transferToDetails'];
            $transferToDate = $_POST['transferToDate'];
            $count = OfficeEquDB::SelectTransferSave($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate, $login);
		if (isset($_COOKIE['catalogueno'])) {
		$catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'] ?? "";
        $search = $_COOKIE['search'] ?? "";
		$Items = OfficeEquDB::getDisposalItems($catalogueno, $searchby, $search);
		$slidebartype = 27;
		} else {
        $slidebartype = 28;
        $Items = OfficeEquDB::getSelectedTransferItems();
		}
        include('startpage.php');
        break;
    case 'Selected_Items_For_Transfer':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = "";
        }
        $slidebartype = 28;
        $Items = OfficeEquDB::getSelectedTransferItems();

        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'] ?? "";
        $assetunit = $OfficeEqu['assetunit'] ?? "";
        $mainCategory = $OfficeEqu['mainCategory'] ?? "";
        $itemCategory = $OfficeEqu['itemCategory'] ?? "";
        $itemDescription = $OfficeEqu['itemDescription'] ?? "";
        $assetsno = $OfficeEqu['assetsno'] ?? "";
        $newAssestno = $OfficeEqu['newAssestno'] ?? "";
        $catalogueno = $OfficeEqu['catalogueno'] ?? "";
        $identificationno = $OfficeEqu['identificationno'] ?? "";
        $ledgerno = $OfficeEqu['ledgerno'] ?? "";
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'] ?? "";
        $eqptSriNo = $OfficeEqu['eqptSriNo'] ?? "";
        $purchasedDate = $OfficeEqu['purchasedDate'] ?? "";
        $quantity = $OfficeEqu['quantity'] ?? "";
        $capacity = $OfficeEqu['capacity'] ?? "";
        $unitValue = $OfficeEqu['unitValue'] ?? "";
        $totalCost = $OfficeEqu['totalCost'] ?? "";
        $receivedDate = $OfficeEqu['receivedDate'] ?? "";
        $presentLocation = $OfficeEqu['presentLocation'] ?? "";
        $fundtype = $OfficeEqu['fundtype'] ?? "";
		$Remarks = $OfficeEqu['Remarks'] ?? "";
        $id = $OfficeEqu['id'] ?? "";
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'] ?? "";
        $selectDisposal = $OfficeEqu['selectDisposal'] ?? "";
        $disposedDate = $OfficeEqu['disposedDate'] ?? "";
        $disposedReason = $OfficeEqu['disposedReason'] ?? "";
		$transferSelect = $OfficeEqu['transferSelect'] ?? "";
		$transferToCenter = $OfficeEqu['transferToCenter'] ?? "";
		$transferToUnit = $OfficeEqu['transferToUnit'] ?? "";
		$transferToDate = $OfficeEqu['transferToDate'] ?? "";
		$transferToDetails = $OfficeEqu['transferToDetails'] ?? "";
		$assetsCenters = AssetsCenterDB::getAssetsCentersAll();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenterAll($transferToCenter);
        include('add_transfer.php');
        break;
    case 'ConfirmTransferSave':
                if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
		
		//$id = $_POST['id'];

        if (isset($_POST['confirmTransfer'])) {
            $confirmDisposal = 1;
			$login = $_SESSION['SESS_LOGIN'];
			$count = OfficeEquDB::ConfirmTransferSave($id, $confirmDisposal, $login);
        } 
        $OfficeEqu = OfficeEquDB::getDetailsById($id);
        $assetscenter = $OfficeEqu['assetscenter'] ?? "";
        $assetunit = $OfficeEqu['assetunit'] ?? "";
        $mainCategory = $OfficeEqu['mainCategory'] ?? "";
        $itemCategory = $OfficeEqu['itemCategory'] ?? "";
        $itemDescription = $OfficeEqu['itemDescription'] ?? "";
        $assetsno = $OfficeEqu['assetsno'] ?? "";
        $newAssestno = $OfficeEqu['newAssestno'] ?? "";
        $catalogueno = $OfficeEqu['catalogueno'] ?? "";
        $identificationno = $OfficeEqu['identificationno'] ?? "";
        $ledgerno = $OfficeEqu['ledgerno'] ?? "";
        $ledgerFoliono = $OfficeEqu['ledgerFoliono'] ?? "";
        $eqptSriNo = $OfficeEqu['eqptSriNo'] ?? "";
        $purchasedDate = $OfficeEqu['purchasedDate'] ?? "";
        $quantity = $OfficeEqu['quantity'] ?? "";
        $capacity = $OfficeEqu['capacity'] ?? "";
        $unitValue = $OfficeEqu['unitValue'] ?? "";
        $totalCost = $OfficeEqu['totalCost'] ?? "";
        $receivedDate = $OfficeEqu['receivedDate'] ?? "";
        $presentLocation = $OfficeEqu['presentLocation'] ?? "";
        $fundtype = $OfficeEqu['fundtype'] ?? "";
		$Remarks = $OfficeEqu['Remarks'] ?? "";
        $id = $OfficeEqu['id'] ?? "";
        $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'] ?? "";
        $selectDisposal = $OfficeEqu['selectDisposal'] ?? "";
        $disposedDate = $OfficeEqu['disposedDate'] ?? "";
        $disposedReason = $OfficeEqu['disposedReason'] ?? "";
		$transferSelect = $OfficeEqu['transferSelect'] ?? "";
		$transferToCenter = $OfficeEqu['transferToCenter'] ?? "";
		$transferToUnit = $OfficeEqu['transferToUnit'] ?? "";
		$transferToDate = $OfficeEqu['transferToDate'] ?? "";
		$transferToDetails = $OfficeEqu['transferToDetails'] ?? "";
        
        $Items = OfficeEquDB::getToConfirmTransferItems();
        
        $slidebartype = 29;
        include('confirm_transfer.php');
        break;
	case 'ConfirmTransferReject':
        $id = $_POST['id'];
        $count = OfficeEquDB::ConfirmTransferReject($id);
        
		$PlantMac = OfficeEquDB::getDetailsById($id);
		$Items = OfficeEquDB::getToConfirmTransferItems();
        $slidebartype = 29;
        include('startpage.php');
        break;
   case 'Add_Transfer_Details':
        $slidebartype = 3;
        $error = 0;
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        
		$identificationnofrom = $_GET['identificationno'];
        $PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationnofrom);

        $assetscenterFrom = $PlantMac['assetscenter'];
        $assetunitFrom = $PlantMac['assetunit'];
        $mainCategory = $PlantMac['mainCategory'];
        $itemCategory = $PlantMac['itemCategory'];
        $itemDescription = $PlantMac['itemDescription'];
        $assetsno = $PlantMac['assetsno'];
        $newAssestno = $PlantMac['newAssestno'];
        $catalogueno = $PlantMac['catalogueno'];
        $identificationno = $PlantMac['identificationno'];
        $ledgerno = $PlantMac['ledgerno'];
        $ledgerFoliono = $PlantMac['ledgerFoliono'];
        $eqptSriNo = $PlantMac['eqptSriNo'];
        $purchasedDate = $PlantMac['purchasedDate'];
        $quantity = $PlantMac['quantity'];
        $capacity = $PlantMac['capacity'];
        $unitValue = $PlantMac['unitValue'];
        $totalCost = $PlantMac['totalCost'];
		$acquisitionInstitute = $PlantMac['acquisitionInstitute'];
        $receivedDate = "";
        $fundtype = "";
		$Remarks = "";
        $presentLocation = "";
        $counterId = 0;
        $groupId = 0;
        $id = 0;
		setcookie('assetscenter', $assetscenter, time() + 3600);
		setcookie('assetsUnit', $assetunit, time() + 3600);
		setcookie('mainCategory', $mainCategory, time() + 3600);
		setcookie('itemCategory', $itemCategory, time() + 3600);
		setcookie('catalogueno', $catalogueno, time() + 3600);
        setcookie('assetsno', $assetsno, time() + 3600);
		setcookie('quantity', 1, time() + 3600);
		setcookie('groupId', 0, time() + 3600);

        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
        $Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
		//$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		include('add_transfer_details.php');
        break;
    case 'Add_Transfer_Detail':
		
		$assetscenterFrom = $_POST['assetscenterFrom'];
        $assetunitFrom = $_POST['assetunitFrom'];
		$identificationnofrom = $_POST['identificationnofrom'];		
		
		$assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $mainCategory = $_POST['mainCategory'];
        $itemCategory = $_POST['itemCategory'];
        $itemDescription = $_POST['itemDescription'];
        $assetsno = $_POST['assetsno'];
        $newAssestno = $_POST['newAssestno'];
        $catalogueno = $_POST['catalogueno'];
        $identificationnos = $_POST['identificationnos'];
        $ledgerno = $_POST['ledgerno'];
        $ledgerFoliono = $_POST['ledgerFoliono'];
        $eqptSriNo = $_POST['eqptSriNo'];
        $purchasedDate = $_POST['purchasedDate'];
        $quantity = $_POST['quantity'];
        $groupQty = $_POST['quantity'];
        $capacity = $_POST['capacity'];
        $unitValue = $_POST['unitValue'];
        $totalCost = 0;
		$groupId = $_POST['groupId'];
        $receivedDate = $_POST['receivedDate'];
        $fundtype = $_POST['fundtype'];
		$Remarks = $_POST['Remarks'];
        $presentLocation = $_POST['presentLocation'];
        $acquisitionInstitute = $_POST['acquisitionInstitute'];

        //$validate->number('totalCost', $totalCost);
        //$validate->text('receivedDate', $receivedDate);
        //$validate->text('presentLocation', $presentLocation);
        //$validate->text('Remarks', $Remarks);
        $validate->longText('identificationnos', $identificationnos);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		        if ($groupId == 0) {
            $groupIdNew = OfficeEquDB::getGroupId();
        } else {
            $groupIdNew = $groupId;
        }
        $qty = (int) $_COOKIE["quantity"];
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
                $count = OfficeEquDB::getHasRecordS($identificationnos);
                if ($count > 0) {
                    $error = 3;
                    break 1;
                } else {
					$counterId = (int) substr($identificationnos, -4);
                    $saveCount = OfficeEquDB::addTransfer($assetscenter, $assetunit, $assetscenterFrom, $assetunitFrom, $identificationnofrom, $identificationnos, $receivedDate, $presentLocation, $Remarks, $counterId, $groupIdNew);
                    if ($saveCount == 2) {
						setcookie('groupId', 0);
                        $groupId = 0;
                        $identificationnoTem = "";
                        $error = 1;
                    } else {
                        $error = 5;
                        break 1;
                    }
                }
            }
            $slidebartype = 3;
            $Items = OfficeEquDB::getItemsNotApproved();
            $Items_Sub = OfficeEquDB::getItemsApproveRejected();
			$Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
            include('add_transfer_details.php');
        break;	
    case 'toBeApproveListTransfer':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 12;
        $idList = array();
        $id = array();
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        $OfficeEqu = OfficeEquDB::getDetailsByIdentificationno($identificationno);
            $assetscenter = $OfficeEqu['assetscenter'];
            $assetunit = $OfficeEqu['assetunit'];
            $mainCategory = $OfficeEqu['mainCategory'];
            $itemCategory = $OfficeEqu['itemCategory'];
            $itemDescription = $OfficeEqu['itemDescription'];
            $assetsno = $OfficeEqu['assetsno'];
            $newAssestno = $OfficeEqu['newAssestno'];
            $catalogueno = $OfficeEqu['catalogueno'];
			
            $identificationno = $OfficeEqu['identificationno'];
            $ledgerno = $OfficeEqu['ledgerno'];
            $ledgerFoliono = $OfficeEqu['ledgerFoliono'];
            $eqptSriNo = $OfficeEqu['eqptSriNo'];
            $purchasedDate = $OfficeEqu['purchasedDate'];
            $quantity = 1;
            $capacity = $OfficeEqu['capacity'];
            $unitValue = $OfficeEqu['unitValue'];
            $totalCost = $OfficeEqu['totalCost'];
            $receivedDate = $OfficeEqu['receivedDate'];
            $presentLocation = $OfficeEqu['presentLocation'];
            $fundtype = $OfficeEqu['fundtype'];
			$Remarks = $OfficeEqu['Remarks'];
            $acquisitionInstitute = $OfficeEqu['acquisitionInstitute'];
            $notapprived = $OfficeEqu['notapprived'];
            $notapprivedReason = $OfficeEqu['notapprivedReason'];
			$id = $OfficeEqu['id'];
        include('approve_details_transfer.php');
        break;
    case 'approve_transfer_Save':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 12;
        $count = OfficeEquDB::ApproveDetails($id, $login);
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        include('startpage.php');
        break;
    case 'view_update':
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::view_update($assetscenter, $assetunit);
        include('view_updates.php');
        break;	
    case 'viewDAM':
        $groupId = $_POST['groupId'];
        $login = $_SESSION['SESS_LOGIN'];
		$damcomment = $_POST['damcomment'];
        $count = OfficeEquDB::view_dam($groupId, $login, $damcomment);
        break;		
    case 'upload_plan':
        if (isset($_POST['groupId'])) {
            $groupId = $_POST['groupId'];
        } else if (isset($_GET['groupId'])) {
            $groupId = $_GET['groupId'];
        } else {
            $groupId = 0;
        }
		
		if (isset($_POST['identificationno'])) {
            $identificationno = $_POST['identificationno'];
        } else if (isset($_GET['identificationno'])) {
            $identificationno = $_GET['identificationno'];
        } else {
            $identificationno = "";
        }

		$slidebartype = 5;
        $error = 0;
		$title = array("Upload - Office Eqpt. Photos","Upload - Office Eqpt. Photos","Upload - Office Eqpt. Photos");
		$Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotTransfered($assetunit);
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        include('upload_plan.php');
        break;
	case 'upload':
		$groupId = $_POST['groupId'];
		$identificationno = $_POST['identificationno'];
		$target = preg_replace('/\s+/', '', $place);
		$target = "pics/".$target."/";
		$error = 1;
		$uploadOk = 1;
		if (!file_exists($target)) {
			mkdir($target, 0777, true);
		}
		$target = $target . basename( $_FILES['Filename']['name']);
		// Check if file already exists
		if (file_exists($target)) {
			$error = 4;
			//echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["Filename"]["size"] > 500000) {
			$error = 5;
			//echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		$imageFileType = pathinfo($target,PATHINFO_EXTENSION);
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
			$error = 6;
		}
		echo $groupId;
		if ($uploadOk == 1){
		$Filename=basename( $_FILES['Filename']['name']);
		if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
			//echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
			$error = 1;
			$count=OfficeEquDB::picpath($groupId, $target);
			if ($count ==0){
				$error = 2;
			}
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 5;
		$title = array("Upload - Office Eqpt. Photos","Upload - Office Eqpt. Photos","Upload - Office Eqpt. Photos");
		$Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        include('upload_plan.php');
        break;
    case 'List_columnlist':
        $slidebartype = 5;
        include('full_list_selectcolumns.php');
        break;		
    case 'getassetscenter':	
		$assetsCenters = AssetsCenterDB::getFullDetails();
		echo json_encode($assetsCenters);
		break;
    case 'getassetsunitcenter':	
		$assetscenter = $id = $_GET['id'];
		$assetunits = AssetsUnitDB::getUnitDetailsbycenter($assetscenter);
		echo json_encode($assetunits);
		break;
   case 'List_columnlist_easyui_query':
	      if (isset($_POST['assetscenter'])) {
            $assetscenter = $_POST['assetscenter'];
        } else if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
        } else {
			$assetscenter = "";
		}
        if (isset($_POST['assetunit'])) {
            $assetunit = $_POST['assetunit'];
        } else if (isset($_GET['assetunit'])) {
            $assetunit = $_GET['assetunit'];
        } else {
			$assetunit = "";
		}

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }
        if (isset($_POST['fromdate'])) {
            $fromdate = $_POST['fromdate'];
        } else if (isset($_GET['inputField1'])) {
            $fromdate = $_GET['fromdate'];
        } else {
            $fromdate = "";
        }

        if (isset($_POST['todate'])) {
            $todate = $_POST['todate'];
        } else if (isset($_GET['todate'])) {
            $todate = $_GET['todate'];
        } else {
            $todate = "";
        }
        include('coldefine.php');
        $searchText = OfficeEquDB::getSearchText($column);
        $items = OfficeEquDB::getInqDetails2($assetscenter, $assetunit);
		echo json_encode($items);
        break;
    case 'List_summary':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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

        include('coldefine.php');
        //$searchText = OfficeEquDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::getSummaryDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('summary_list.php');
        break;	
    case 'List_summary2':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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

        include('coldefine.php');
        //$searchText = OfficeEquDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::getSummaryDetails2($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('summary_list2.php');
        break;
    case 'List_summary3':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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

        include('coldefine.php');
        //$searchText = OfficeEquDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::getSummaryDetails3($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('summary_list3.php');
        break;
   case 'List_summary4':
		$slidebartype = 30;
        $items = CatalogueDB::getCatalogueType(1);
		$exps = array();
		foreach ($items as $row) {
			$catalogueno = $row['catalogueno'];
			$cata = OfficeEquDB::get_catalogueno_summary($catalogueno);
			$exp = array($row['mainCategory'], $row['itemCategory'], $row['itemDescription'], $row['assetsno'], $row['catalogueno'], $cata['cnt'], $cata['tot']);  
			$exps[] = $exp;
			}
        include('summary_list4.php');
        break;
   case 'List_summary5':
		$slidebartype = 30;
        $items = CatalogueDB::getitemCategoryType(1);
		$exps = array();
		foreach ($items as $row) {
			$itemCategory = $row['itemCategory'];
			$cata = OfficeEquDB::get_itemCategory_summary($itemCategory);
			$exp = array($row['mainCategory'], $row['itemCategory'], $cata['cnt'], $cata['tot']);  
			$exps[] = $exp;
			}
        include('summary_list5.php');
        break;
   case 'List_summary6':
		 if (isset($_POST['inputField1'])) {
            $receivedDate = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $receivedDate = $_GET['inputField1'];
        } else {
            $receivedDate = date("Y-m-d");
        }
		$slidebartype = 30;
        $items = CatalogueDB::getitemCategoryType(1);
		$exps = array();
		foreach ($items as $row) {
			$itemCategory = $row['itemCategory'];
			$cata = OfficeEquDB::get_itemCategory_summary_date($itemCategory, $receivedDate);
			$exp = array($row['mainCategory'], $row['itemCategory'], $row['newAssestno'], $row['assetsno'], $row['catalogueno'], $cata['cnt'], $cata['tot']); 
			$exps[] = $exp;
			}
        include('summary_list6.php');
        break;
   case 'List_summary4_1':
		$slidebartype = 30;
		$exps = OfficeEquDB::get_catalogueno_summary_1();
        include('summary_list4_1.php');
        break;
   case 'List_summary5_1':
		$slidebartype = 30;
			$exps = OfficeEquDB::get_itemCategory_summary_1();
			//$exp = array($row['mainCategory'], $row['itemCategory'], $cata['cnt'], $cata['tot']);  
        include('summary_list5_1.php');
        break;		
    case 'Delete_Not_Confirm':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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
        if (isset($_POST['groupId'])) {
            $groupId = $_POST['groupId'];
			OfficeEquDB::deleteDetailsByGroupId($groupId);
        }
		
        include('coldefine.php');
        //$searchText = OfficeEquDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('delete_not_confirm.php');
        break;
    case 'PendingApproveList':
	    $items = OfficeEquDB::getItemsNotApprovedAll();
		include('pending_approve_list.php');
		break;
    case 'add_serial_nos':
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$eqptSriNo = $_POST['eqptSriNo'];
			$saveCount = OfficeEquDB::updateserialno($id, $eqptSriNo);
		}
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }

        if (isset($_POST['inputField1'])) {
            $inputField1 = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $inputField1 = $_GET['inputField1'];
        } else {
            $inputField1 = "";
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
		
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, "", "");
		include('add_serial_nos.php');
		break;
   case 'add_serial_nos_ajax':
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$eqptSriNo = $_POST['eqptSriNo'];
			$saveCount = OfficeEquDB::updateserialno($id, $eqptSriNo);
		}
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }

        if (isset($_POST['inputField1'])) {
            $inputField1 = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $inputField1 = $_GET['inputField1'];
        } else {
            $inputField1 = "";
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
		
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);		
        $items = OfficeEquDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, "", "");
		include('add_serial_nos_ajax.php');
		break;
  case 'add_serial_nos_ajax_save':
			$id = $_GET['id'];
			$ledgerFoliono = $_GET['ledgerFoliono'];
			$eqptSriNo = $_GET['eqptSriNo'];
			$purchasedDate = $_GET['purchasedDate'];
			$receivedDate = $_GET['receivedDate'];
			$natureOwnership = $_GET['natureOwnership'];
			$unitValue = $_GET['unitValue'];
			$presentLocation = $_GET['presentLocation'];
			$saveCount = OfficeEquDB::updateserialno($id, $ledgerFoliono, $eqptSriNo, $purchasedDate, $receivedDate, $natureOwnership, $unitValue, $presentLocation);
		echo $saveCount;
		break;	
  case 'zero_value_list':
		$items = AssetsUnitDB::getFullList();
		$exps = array();
		foreach ($items as $row) {
			$assetunit = $row['unitName'];
			$type = ($row['report_received'] == '1' ? "Yes" : "");
			$lds = OfficeEquDB::zero_value_Records($assetunit);
			foreach ($lds as $ld) {
			$exp = array($row['centreName'], $row['unitName'], $ld['itemCategory'], $ld['itemDescription'], $ld['cnt'], $ld['unitValue'], $type);  
			$exps[] = $exp;
			}
			}
        include('zero_value_list.php');
        break;
    case 'tree_list':
        $slidebartype = 31;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list.php');
        break;
    case 'tree_list_2':
			if (isset($_GET['unit'])) {
			$assetunit = $_GET['unit'];
				$title = 'Office Equipment Details List - '.$assetunit;
			} else {
				$title = 'Office Equipment Details List';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if ($id == 1){
				$exps = OfficeEquDB::get_catalogueno_summary_1();
				$title = 'Office Equipment Details Full List';
			} else if ($id == 5 || $id == 2) {
				$exps = OfficeEquDB::get_catalogueno_summary_2(1, $assetunit);	
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$exps = OfficeEquDB::get_catalogueno_summary_2(2, $assetunit);
			}
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list_2.php');
        break;
   case 'tree_list_2_1':
			$items = AssetsUnitDB::getFullListbyProtocol();
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = OfficeEquDB::get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Office Equipment Details - '.$_GET['itemDescription'];
				include('tree_list_2_1.php');
			} else if ($id == 5 || $id == 2) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::get_catalogueno_summary_2_unit(1, $unit, $catalogueno);
				$title = 'Office Equipment Details - '.$unit.' - '.$_GET['itemDescription'];
				include('tree_list_2_1.php');
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Office Equipment Details - '.$unit.' - '.$_GET['itemDescription'];
				include('tree_list_2_2.php');
			} else if ($id == 10) {	
				$identificationno = $_GET['identificationno'];
				$row = OfficeEquDB::getpicById($identificationno);
				 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
				//$Items = OfficeEquDB::getItemsApproved();
				$PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
				$assetscenter = $PlantMac['assetscenter'];
				$assetunit = $PlantMac['assetunit'];
				$mainCategory = $PlantMac['mainCategory'];
				$itemCategory = $PlantMac['itemCategory'];
				$itemDescription = $PlantMac['itemDescription'];
				$assetsno = $PlantMac['assetsno'];
				$newAssestno = $PlantMac['newAssestno'];
				$catalogueno = $PlantMac['catalogueno'];
				$identificationno = $PlantMac['identificationno'];
				$ledgerno = $PlantMac['ledgerno'];
				$ledgerFoliono = $PlantMac['ledgerFoliono'];
				$eqptSriNo = $PlantMac['eqptSriNo'];
				$purchasedDate = $PlantMac['purchasedDate'];
				$quantity = $PlantMac['quantity'];
				$capacity = $PlantMac['capacity'];
				$unitValue = $PlantMac['unitValue'];
				$totalCost = $PlantMac['totalCost'];
				$receivedDate = $PlantMac['receivedDate'];
				$presentLocation = $PlantMac['presentLocation'];
				$fundtype = $PlantMac['fundtype'];
				$Remarks = $PlantMac['Remarks'];
				$id = $PlantMac['id'];
				$groupId = $PlantMac['groupId'];
				$acquisitionInstitute = $PlantMac['acquisitionInstitute'];
				$damcomment = $PlantMac['damcomment'];
				$title = $identificationno;
				include('tree_list_2_3.php');
			}
        break;
    case 'getDetailsUnit':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = OfficeEquDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
		break;
    case 'getDetailsUnit2':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = OfficeEquDB::getSummaryDetails("", $assetunit, "", "", "", "");
		//$items = OfficeEquDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
		break;
    case 'getDetailsUnit3':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = OfficeEquDB::getSummaryDetails2("", $assetunit, "", "", "", "");
		//$items = OfficeEquDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
		break;
    case 'List_summary_tree':
        $slidebartype = 32;
		$items = CatalogueDB::getCatalogue_Tree(1);
        include('summary_list_tree.php');
        break;
    case 'getDetailsUnitbyCategory':	
		// if (isset($_GET['category'])) {
			 $itemDescription = $_GET['category'];
			 $res = $_GET['res'];
			 if ($res == 'x') { $items = OfficeEquDB::getSummaryDetailsCategory($itemDescription); }
			 if ($res == 'y') { $items = OfficeEquDB::getSummaryDetailsCategory2($itemDescription); } 
		//} 
		echo json_encode($items);
		break;
    case 'sno_duplicates':
	    $items = OfficeEquDB::sno_duplicates();
        include('sno_duplicates.php');
        break;
   case 'delete_all_items':
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

		if (isset($_POST['id'])) {
            $id = $_POST['id'];
			OfficeEquDB::deleteDetailsById($id);
        }		

	
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$items = OfficeEquDB::getDetailsUnitAll($assetunit);
        include('delete_all_items.php');
        break;
   case 'delete_all_item':
		 $assetunit = $_GET['unit'];
		 $count = OfficeEquDB::deleteDetailsAll($assetunit);
		 echo json_encode($count);
         break;	
    case 'ledgerformat':
        $slidebartype = 5;
		$items = OfficeEquDB::getFullDetails_ledger(); 
        include('ledgerformat.php');
        break;
    case 'ledgerformatdata':	
		$items = OfficeEquDB::getFullDetails_ledger(); 
		echo json_encode($items);
		break;
    case 'reorder_id':
		$slidebartype = 5;
        $catalogueno ="";
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = OfficeEquDB::reorder_id($assetunit, $catalogueno);
        include('reorder_id.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
    case 'findAssetsUnitsByCenterAll_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenterAll($assetscenter);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
   case 'getCatalogueno':
		 $assetunit = $_GET['assetunit'];
		 $items = OfficeEquDB::getCatalogueno($assetunit);
		 echo json_encode($items);
         break;	
   case 'get_catalogueno_details':
		 $assetunit = $_GET['assetunit'];
		 $catalogueno = $_GET['catalogueno'];
		 $items = OfficeEquDB::reorder_id($assetunit, $catalogueno);
		 echo json_encode($items);
         break;
   case 'save_reorder_id':
		 $assetunit = $_GET['assetunit'];
		 $catalogueno = $_GET['catalogueno'];
		 $dels = OfficeEquDB::delete_not_confirm($assetunit, $catalogueno);
		 $items = OfficeEquDB::reorder_id($assetunit, $catalogueno);
		 $counterIdD = 0;
		 foreach ($items as $item) {    
			$id = $item['id'];
			$identificationno = $item['identificationno'];
			$identificationno = substr($identificationno, 0, -4);
			$counterIdD++;
			$counterId = sprintf("%04d", $counterIdD);
            $identificationno = $identificationno . $counterId;
			$count = OfficeEquDB::reorder_id_save($id, $identificationno, $counterId);
		}
		echo json_encode($count);
         break;
    case 'serialno_dash':
        $slidebartype = 5;
        include('serialno_dash.php');
        break;
   case 'getCataloguenos':
		 $items = OfficeEquDB::getCataloguenos();
		 echo json_encode($items);
         break;
   case 'get_cataloguenos_details':
		 $catalogueno = $_GET['catalogueno'];
		 $items = OfficeEquDB::get_catalogueno_dtls($catalogueno);
		 echo json_encode($items);
         break;
   case 'replace_with_dash':
		 $catalogueno = $_GET['catalogueno'];
		 $dels = OfficeEquDB::serialno_replace_with_dash($catalogueno);
		 echo json_encode($count);
         break;
    case 'change_Catalogno':
        $slidebartype = 5;
        include('change_Catalogno.php');
        break;
   case 'change_Catalognos':
		 $catalogueno1 = $_GET['catalogueno1'];
		 $catalogueno2 = $_GET['catalogueno2'];
		 $cata = CatalogueDB::getcatlogDetailByCatalogueno($catalogueno2);
		 $itemDescription = $cata[itemDescription];
		 $items = OfficeEquDB::get_catalogueno_dtls($catalogueno1);
		 foreach ($items as $item) {    
			$id = $item['id'];
			$identificationno = $item['identificationno'];
			$identificationno = str_replace($catalogueno1,$catalogueno2,$identificationno);
			$count = OfficeEquDB::change_Catalogno_save($id, $identificationno,$catalogueno2,$itemDescription);
		}
		 echo json_encode($count);
         break;
    case 'check_notconfirm':
        $slidebartype = 33;
		$assetunits = AssetsUnitDB::getAssetsUnits();
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        include('startpage.php');
        break;
   case 'check_notconfirm_details':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 33;
        $idList = array();
        $id = array();
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        $Items = OfficeEquDB::getItemsNotApproved();
        $Items_Sub = OfficeEquDB::getItemsApproveRejected();
		$Items_Sub_2 = OfficeEquDB::getItemsNotApprovedTransfer();
        $PlantMacs = OfficeEquDB::getDetailsByIdentificationnoGroup($identificationno);
        foreach ($PlantMacs as $PlantMac) :
            $assetscenter = $PlantMac['assetscenter'];
            $assetunit = $PlantMac['assetunit'];
            $mainCategory = $PlantMac['mainCategory'];
            $itemCategory = $PlantMac['itemCategory'];
            $itemDescription = $PlantMac['itemDescription'];
            $assetsno = $PlantMac['assetsno'];
            $newAssestno = $PlantMac['newAssestno'];
            $catalogueno = $PlantMac['catalogueno'];
			$natureOwnership = $PlantMac['natureOwnership'];
            $idList[] = $PlantMac['identificationno'];
            $ledgerno = $PlantMac['ledgerno'];
            $ledgerFoliono = $PlantMac['ledgerFoliono'];
            $eqptSriNo = $PlantMac['eqptSriNo'];
            $purchasedDate = $PlantMac['purchasedDate'];
            // $quantity = $PlantMac['quantity'];
            $quantity = $PlantMac['groupQty'];
            $capacity = $PlantMac['capacity'];
            $unitValue = $PlantMac['unitValue'];
            $totalCost = $PlantMac['totalCost'];
            $receivedDate = $PlantMac['receivedDate'];
            $fundtype = $PlantMac['fundtype'];
			$Remarks = $PlantMac['Remarks'];
            $presentLocation = $PlantMac['presentLocation'];
            $notapprived = $PlantMac['notapprived'];
            $notapprivedReason = $PlantMac['notapprivedReason'];
            $id[] = $PlantMac['id'];
            $acquisitionInstitute = $PlantMac['acquisitionInstitute'];
			$sysdate = $PlantMac['sysdate'];
        endforeach;
        $id = implode(";", $id);
        $qty = $quantity;
		$count = unitdetailsDB::getHasRecord($assetunit);
		if ($count > 0) {
			$details = unitdetailsDB::getDetailsByUnit($assetunit);
            $errordisplay = $details['errordisplay'];
            $errortitle = $details['errortitle'];
            $errordetails = $details['errordetails'];
            $email =  $details['email'];       
		} else {
            $errordisplay = "";
            $errortitle = "";
            $errordetails = "";
            $email = "";
        }
        include('check_notconfirm_details.php');
        break;
   case 'add_unit_error_record':
		$unit = $_GET['unit'];
        $errordisplay = $_GET['errordisplay'];
		$errortitle = $_GET['errortitle'];
		$errordetails = $_GET['errordetails'];
		
        $count = unitdetailsDB::getHasRecord($unit);
		if ($count > 0) {
			$saveCount = unitdetailsDB::updateUnitErrorRecord($unit, $errordisplay, $errortitle, $errordetails);
		} else {
            $saveCount = unitdetailsDB::addUnitErrorRecord($unit, $errordisplay, $errortitle, $errordetails);
        }
            echo $saveCount;
        break;
  case 'min_max_find':
		$catalogueno = $_GET['catalogueno'];
		 $exps = CatalogueDB::getcatlogDetailByCatalogueno($catalogueno);
		echo json_encode( $exps );
		//echo $saveCount;
		break;	
    case 'List_summary_tree_2':
			if (isset($_GET['unit'])) {
			$assetunit = $_GET['unit'];
				$title = 'Office Equipments Details List - '.$assetunit;
			} else {
				$title = 'Office Equipments Details List';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			$items = CatalogueDB::getCatalogue_Tree(1);
			if ($id == 1){
				$exps = OfficeEquDB::get_catalogueno_summary_1();
				$title = 'Office Equipments Details Full List';
				include('summary_list_tree_2.php');
			} else if ($id == 2) {
				$exps = OfficeEquDB::get_catalogueno_unit_summary_2(1, $assetunit);	
				include('summary_list_tree_2.php');
			} else if ($id == 3) {
				$exps = OfficeEquDB::get_catalogueno_unit_summary_2(2, $assetunit);
				include('summary_list_tree_2.php');
			} else if ($id == 4) {
				$exps = OfficeEquDB::get_catalogueno_unit_summary_3(3, $assetunit);
				include('List_summary_tree_2_1.php');
			}else if ($id == 0) {
				 include('summary_list_tree_2.php');
			}
        break;	
    case 'List_summary_tree_2_1':
			$items = CatalogueDB::getCatalogue_Tree(1);
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = OfficeEquDB::get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Office Equipments - '.$_GET['itemDescription'];
				include('List_summary_tree_2_1.php');
			} else if ($id == 2) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Office Equipments - '.$unit.' - '.$_GET['itemDescription'];
				include('List_summary_tree_2_2.php');
			} else if ($id == 3) {	
				$identificationno = $_GET['identificationno'];
				$row = OfficeEquDB::getpicById($identificationno);
				 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
				$PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
				$assetscenter = $PlantMac['assetscenter'];
				$assetunit = $PlantMac['assetunit'];
				$mainCategory = $PlantMac['mainCategory'];
				$itemCategory = $PlantMac['itemCategory'];
				$itemDescription = $PlantMac['itemDescription'];
				$assetsno = $PlantMac['assetsno'];
				$newAssestno = $PlantMac['newAssestno'];
				$catalogueno = $PlantMac['catalogueno'];
				$identificationno = $PlantMac['identificationno'];
				$ledgerno = $PlantMac['ledgerno'];
				$ledgerFoliono = $PlantMac['ledgerFoliono'];
				$eqptSriNo = $PlantMac['eqptSriNo'];
				$purchasedDate = $PlantMac['purchasedDate'];
				$quantity = $PlantMac['quantity'];
				$capacity = $PlantMac['capacity'];
				$unitValue = $PlantMac['unitValue'];
				$totalCost = $PlantMac['totalCost'];
				$receivedDate = $PlantMac['receivedDate'];
				$presentLocation = $PlantMac['presentLocation'];
				$fundtype = $PlantMac['fundtype'];
				$Remarks = $PlantMac['Remarks'];
				$id = $PlantMac['id'];
				$groupId = $PlantMac['groupId'];
				$acquisitionInstitute = $PlantMac['acquisitionInstitute'];
				$damcomment = $PlantMac['damcomment'];
				$title = $identificationno;
				include('List_summary_tree_2_3.php');
			}
        break;	
    case 'ca_no_err_list':
        $items = OfficeEquDB::ca_no_err_list();
		include('ca_no_err_list.php');
        break;
    case 'List_loss':
        $slidebartype = 34;
        include('startpage.php');
        break;
    case 'Select_Items_For_loss':		
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('loss_select_list.php');
        break;
   case 'loss_select_save':
		 $id = $_GET['id'];
		 $selectLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = OfficeEquDB::loss_select_save($id, $selectLoss, $login);
		 echo json_encode($items);
         break;
    case 'Selected_Items_For_loss':		
		$items = OfficeEquDB::Selected_Items_For_loss();
		include('Selected_Items_For_loss.php');
        break;
    case 'Confirm_Items_For_loss':		
		$items = OfficeEquDB::Selected_Items_For_Confirm_loss();
		include('Confirm_Items_For_loss.php');
        break;
   case 'loss_confirm_save':
		 $id = $_GET['id'];
		 $confirmLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = OfficeEquDB::loss_confirm_save($id, $confirmLoss, $login);
		 echo json_encode($items);
         break;	
   case 'loss_reject_save':
		 $id = $_GET['id'];
		 $items = OfficeEquDB::loss_reject_save($id);
		 echo json_encode($items);
         break;
    case 'approve_Items_For_loss':		
		$items = OfficeEquDB::approve_Items_For_loss();
		include('approve_Items_For_loss.php');
        break;
   case 'loss_approve_save':
		 $id = $_GET['id'];
		 $ApprovedLoss = $_GET['ApprovedLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = OfficeEquDB::loss_approve_save($id, $ApprovedLoss, $login);
		 echo json_encode($items);
         break;	
    case 'loss_List':		
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails_lost($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords_loss();
		$total_pages = ceil($total_records / $per_page);
		include('paging_lost_list_headfix.php');
        break;
    case 'loss_List_Inquiry':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }

        if (isset($_POST['inputField1'])) {
            $inputField1 = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $inputField1 = $_GET['inputField1'];
        } else {
            $inputField1 = "";
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
		
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = OfficeEquDB::Loss_Inquiry($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		include('loss_list_inquiry.php');
        break;
    case 'add_loss_details':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        //$Items = OfficeEquDB::getItemsApproved();
        $PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $PlantMac['assetscenter'];
        $assetunit = $PlantMac['assetunit'];
        $mainCategory = $PlantMac['mainCategory'];
        $itemCategory = $PlantMac['itemCategory'];
        $itemDescription = $PlantMac['itemDescription'];
        $assetsno = $PlantMac['assetsno'];
        $newAssestno = $PlantMac['newAssestno'];
        $catalogueno = $PlantMac['catalogueno'];
        $identificationno = $PlantMac['identificationno'];
        $ledgerno = $PlantMac['ledgerno'];
        $ledgerFoliono = $PlantMac['ledgerFoliono'];
        $eqptSriNo = $PlantMac['eqptSriNo'];
        $purchasedDate = $PlantMac['purchasedDate'];
        $quantity = $PlantMac['quantity'];
        $capacity = $PlantMac['capacity'];
        $unitValue = $PlantMac['unitValue'];
        $totalCost = $PlantMac['totalCost'];
        $receivedDate = $PlantMac['receivedDate'];
        $presentLocation = $PlantMac['presentLocation'];
        $fundtype = $PlantMac['fundtype'];
		$Remarks = $PlantMac['Remarks'];
        $id = $PlantMac['id'];
		$groupId = $PlantMac['groupId'];
        $acquisitionInstitute = $PlantMac['acquisitionInstitute'];
		$lossedDate = $PlantMac['lossedDate'];
		$lossedReason = $PlantMac['lossedReason'];
        include('add_loss_details.php');
        break;	
    case 'save_loss_details':
        $id = $_POST['id'];
        $lossedDate = $_POST['lossedDate'];
		$lossedReason = $_POST['lossedReason'];
        $count = OfficeEquDB::save_loss_details($id, $lossedDate, $lossedReason);
        break;
    case 'display_loss_details':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
		$row = OfficeEquDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        //$Items = OfficeEquDB::getItemsApproved();
        $PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $PlantMac['assetscenter'];
        $assetunit = $PlantMac['assetunit'];
        $mainCategory = $PlantMac['mainCategory'];
        $itemCategory = $PlantMac['itemCategory'];
        $itemDescription = $PlantMac['itemDescription'];
        $assetsno = $PlantMac['assetsno'];
        $newAssestno = $PlantMac['newAssestno'];
        $catalogueno = $PlantMac['catalogueno'];
        $identificationno = $PlantMac['identificationno'];
        $ledgerno = $PlantMac['ledgerno'];
        $ledgerFoliono = $PlantMac['ledgerFoliono'];
        $eqptSriNo = $PlantMac['eqptSriNo'];
        $purchasedDate = $PlantMac['purchasedDate'];
        $quantity = $PlantMac['quantity'];
        $capacity = $PlantMac['capacity'];
        $unitValue = $PlantMac['unitValue'];
        $totalCost = $PlantMac['totalCost'];
        $receivedDate = $PlantMac['receivedDate'];
        $presentLocation = $PlantMac['presentLocation'];
        $fundtype = $PlantMac['fundtype'];
		$Remarks = $PlantMac['Remarks'];
        $id = $PlantMac['id'];
		$groupId = $PlantMac['groupId'];
        $acquisitionInstitute = $PlantMac['acquisitionInstitute'];
		$lossedDate = $PlantMac['lossedDate'];
		$lossedReason = $PlantMac['lossedReason'];
        include('display_loss_details.php');
        break;
    case 'min_max_values':
        $items = OfficeEquDB::min_max_values();
		include('min_max_values.php');
        break;
    case 'Confirmed_Items_For_Disposal':
        $items = OfficeEquDB::Confirmed_For_Disposal();
        include('Confirmed_Items_For_Disposal.php');
        break;
    case 'record_status':
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::record_status($assetscenter, $assetunit);
        include('record_status.php');
        break;
    case 'board_report_start':
        $slidebartype = 0;
		$filename = "";
		$error = board_reportDB::getHasRecord($assetscenter, $assetunit, $currentYear);
		if ( $error > 0){
			$filename = board_reportDB::getassetpath("office_path", $assetunit, $currentYear);
			$error = ($filename == "" ? 0 : 1); 
		} else {
			$count = board_reportDB::addRecord($assetscenter, $assetunit, $currentYear);
			$error = 0;
		}
        $exps = board_reportDB::getUnitList_currentyear($assetunit, $currentYear);
		include('board_report_start.php');
        break;
    case 'board_report':
		$items = OfficeEquDB::getBoard_report($assetscenter, $assetunit);
		$assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
		$boardMemberName1 = $assetunits['boardMemberName1'];
		$boardMemberRank1 = $assetunits['boardMemberRank1'];
		$boardMemberNumber1 = $assetunits['boardMemberNumber1'];
		$boardMemberName2 = $assetunits['boardMemberName2'];
		$boardMemberRank2 = $assetunits['boardMemberRank2'];
		$boardMemberNumber2 = $assetunits['boardMemberNumber2'];
		$boardMemberName3 = $assetunits['boardMemberName3'];
		$boardMemberRank3 = $assetunits['boardMemberRank3'];
		$boardMemberNumber3 = $assetunits['boardMemberNumber3'];
		$filename = "../board_report/".$currentYear."-".$assetunit."-office.pdf";
		$filename_d = "../board_report/".$currentYear."-".$assetunit."-office_d.pdf";
		$filename_des = "../board_report/".$currentYear."-".$assetunit."-office_des.pdf";
		$filename_new = "../board_report/".$currentYear."-".$assetunit."-office_new.pdf";
		$asset = "office";
		$count = board_reportDB::updateRecord($asset, $filename, $assetunit, $currentYear);
		$delcount = board_report_summaryDB::deleteRecordsUnitYear($asset, $assetunit, $currentYear);
		include('print_list.php');
		$des_items = OfficeEquDB::getDisposalDetails_year($assetunit, $currentYear);
        include('print_disposal.php');
        $new_items = OfficeEquDB::getNewDetails_year($assetunit, $currentYear);
        include('print_new_items.php');
		$count = OfficeEquDB::add_Board_report($assetunit);
		foreach ($count as $row) {
			$disposal = OfficeEquDB::add_Board_report_disposal($assetunit, $currentYear, $row['catalogueno']);
			$newitems = OfficeEquDB::add_Board_report_new($assetunit, $currentYear, $row['catalogueno']);
			$count = board_report_summaryDB::add_Board_report($assetunit, $currentYear, $asset, $row['catalogueno'], $row['cnt'], $row['total'], $row['ids_array'], $disposal['cnt'], $disposal['total'], $disposal['ids_array'], $newitems['cnt'], $newitems['total'], $newitems['ids_array']);
		}
		$filename_s = "../board_report/".$currentYear."-".$assetunit."-office_summary.pdf";
		$items_s = board_report_summaryDB::getFullDetails($currentYear, $assetunit, $asset);
		include('print_summary.php');		
        break;
    case 'board_report_history':
        $slidebartype = 0;
        $exps = board_reportDB::getUnitList($assetunit);
		include('board_report_history.php');
        break;
    case 'disposal_yearsummary_List':
        $items = OfficeEquDB::getDisposalDetailsSummary();
        include('disposal_yearsummary_List.php');
        break;
    case 'select_items_for_send_ordinance':		
		$items = OfficeEquDB::get_send_ordinance();
		$ordinance = AssetsUnitDB::getOrdince($assetunit);
		include('select_items_for_send_ordinance.php');
        break;
	case 'send_ordinance_save':
		 $id = $_GET['id'];
		 $ordinance_send_date = $_GET['ordinance_send_date'];
		 $selectLoss = $_GET['selectLoss'];
		 $ordinance = $_GET['ordinance'];
		 $items = OfficeEquDB::send_ordinance_save($id, $selectLoss, $ordinance_send_date, $ordinance);
		 echo json_encode($items);
		 break;
    case 'Receive_Condemned_Goods':
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
				$title = 'Office Equipments Receive Condemned Goods - '.$unit;
				$exps = OfficeEquDB::get_receive_ordinance($unit);
			} else {
				$title = 'Office Equipments Receive Condemned Goods';
				$assetunit = "";
			}
		$ordinance = $_SESSION['SESS_PLACE'];
		$items = AssetsUnitDB::getFullListbyProtocol_ord($ordinance);
		$slidebartype = 35;
        include('receive_condemned_goods.php');
		break;
	case 'receive_ordinance_save':
		 $id = $_GET['id'];
		 $ordinance_receive_date = $_GET['ordinance_receive_date'];
		 $selectLoss = $_GET['selectLoss'];
		 $items = OfficeEquDB::receive_ordinance_save($id, $selectLoss, $ordinance_receive_date);
		 echo json_encode($items);
		 break;
    case 'ordinance_received_details':
         	if (isset($_GET['delete'])) {
				$id = $_GET['tid'];
				$ordinance_receive_date = "";
				$selectLoss = 0;
				$items = OfficeEquDB::receive_ordinance_save($id, $selectLoss, $ordinance_receive_date);	
			}
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
				$title = 'Office Equipments Received Condemn Goods - '.$unit;
				$ordinance = $_SESSION['SESS_PLACE'];
				$id = $_GET['id'];
				$exps = OfficeEquDB::ordinance_received_details($ordinance, $unit, $id);
			} else {
				$title = 'Office Equipments Received Condemn Goods';
				$assetunit = "";
			}
		$ordinance = $_SESSION['SESS_PLACE'];
		$items = AssetsUnitDB::getFullListbyProtocol_ord($ordinance);
		//$slidebartype = 34;
        include('ordinance_received_details.php');
		break;
    case 'List_summary_tree_3':
			$title = 'Office Equipments Details List';
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			$items = CatalogueDB::getCatalogue_Tree(1);
			$per_page=10000;
				if (isset($_GET['page1'])) {
					$page1 = $_GET['page1'];
					} else {
					$page1=1;
				}		
				$start_from = ($page1-1) * $per_page;
				$i = $start_from + 1;
				$total_pages = 0;
			if (isset($_GET['itemCategory'])) {$itemCategory = $_GET['itemCategory'];} else {$itemCategory = "";}	
			if ($id == 1){
				$exps = OfficeEquDB::getPagingDetails($start_from, $per_page);
				$total_records = OfficeEquDB::countTotalRecords();
				$total_pages = ceil($total_records / $per_page);
				$title = 'Office Equipments Full List';
				include('summary_list_tree_3.php');
			} else if ($id == 2) {
				$exps = OfficeEquDB::get_catalogueno_paging_summary_4(2, $itemCategory, $start_from, $per_page);
				$total_records = OfficeEquDB::catalogueno_paging_summary_4_TotalRecords(2, $itemCategory);
				$total_pages = ceil($total_records / $per_page);
				$title = 'Office Equipments Full List - '.$itemCategory;
				include('summary_list_tree_3.php');				
			} else if ($id == 3) {
				$exps = OfficeEquDB::get_catalogueno_paging_summary_4(3, $itemCategory, $start_from, $per_page);
				$total_records = OfficeEquDB::catalogueno_paging_summary_4_TotalRecords(3, $itemCategory);
				$total_pages = ceil($total_records / $per_page);
				$title = 'Office Equipments Details List - Item Category - '.$itemCategory;
				include('summary_list_tree_3.php');
			} else if ($id == 4) {
				$exps = OfficeEquDB::get_catalogueno_paging_summary_4(4, $itemCategory, $start_from, $per_page);
				$total_records = OfficeEquDB::catalogueno_paging_summary_4_TotalRecords(4, $itemCategory);
				$total_pages = ceil($total_records / $per_page);				
				//$exps = OfficeEquDB::get_catalogueno_unit_summary_4(4, $itemCategory);
				$title = 'Office Equipments Details List - Item Description - '.$itemCategory;
				include('summary_list_tree_3.php');
				//echo $id;
			} else if ($id == 0) {
				 include('summary_list_tree_3.php');
				 //echo $id;
			}
        break;	
    case 'json_all':
		$itemcategory = $_GET['itemcategory'];
		$exps = OfficeEquDB::get_all_json($itemcategory);
        echo json_encode($exps);
		break;
    case 'itemcategory_all':
		$exps = OfficeEquDB::get_itemcategory_all();
        echo json_encode($exps);
		break;
   case 'monthly_changes':
		 if (isset($_POST['receivedDate'])) {
            $receivedDate = $_POST['receivedDate'];
        } else if (isset($_GET['receivedDate'])) {
            $receivedDate = $_GET['receivedDate'];
        } else {
            $receivedDate = "";
        }
		if (isset($_POST['ignore_units'])) {
            $ignore_units = $_POST['ignore_units'];
        } else {
			$ignore_units = 0;
		}
		
		if (isset($_POST['ignore_month'])) {
            $ignore_month = $_POST['ignore_month'];
        } else {
			$ignore_month = 0;
		}
		$year = date('Y', strtotime($receivedDate));
		$month = date('m', strtotime($receivedDate));
		$slidebartype = 0;
       	$monthNum  = $month;
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = (isset($_POST['ignore_month'])) ? '' : $dateObj->format('F');  // March
		if ($receivedDate <> "") {
			$title2 = 'New Items - ' . $year . ' - ' . $monthName;
			$title_dis = 'Dispisal Items - ' . $year . ' - ' . $monthName;
		} else {
			$title2 = "New Items";
			$title_dis = "Dispisal Items";
		}
		if ($ignore_units == 0) {
		$exps = OfficeEquDB::monthly_changes($year, $month, $ignore_month);
		$exps_dis = OfficeEquDB::monthly_changes_dis($year, $month, $ignore_month);
        include('monthly_changes.php');
		} else {
		$exps = OfficeEquDB::monthly_changes_iu($year, $month, $ignore_month);
		$exps_dis = OfficeEquDB::monthly_changes_dis_iu($year, $month, $ignore_month);
        include('monthly_changes_iu.php');			
		}
        break;
   case 'monthly_changes_2':
		$id = $_GET['id'];
		$year = $_GET['year'];
		$month = $_GET['month'];
		$catalogueno = $_GET['catalogueno'];
		$ignore_month = $_GET['ignore_month'];
		if (isset($_GET['assetunit'])) {$assetunit = $_GET['assetunit'];}
		$cataloguename = CatalogueDB::getcatlogDescriptionByCatalogueno($catalogueno);
		$slidebartype = 0;
       	$monthNum  = $month;
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		//$monthName = $dateObj->format('F'); // March
		$monthName = ($ignore_month == 1) ? '' : $dateObj->format('F');  // March
		$title2 = 'New Items';
		$title_dis = 'Dispisal Items';
		if ($id == 1) {
			$title = 'Monthly Change Items - ' . $cataloguename . ' - ' . $year . ' - ' . $monthName;
			$exps = OfficeEquDB::monthly_changes_cata($year, $month, $catalogueno, $ignore_month);
			$exps_dis = OfficeEquDB::monthly_changes_dis_cata($year, $month, $catalogueno, $ignore_month);
			include('monthly_changes_2.php');
		} else if ($id == 2){
			$title = 'Monthly Change Items - ' . $cataloguename . ' - ' . $year . ' - ' . $monthName . ' - ' . $assetunit;
			$exps = OfficeEquDB::monthly_changes_cata_unit($year, $month, $catalogueno, $assetunit, $ignore_month);
			$exps_dis = OfficeEquDB::monthly_changes_dis_cata_unit($year, $month, $catalogueno, $assetunit, $ignore_month);
			include('monthly_changes_3.php');			
		}
        break;
    case 'undo_Disposal':
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
        $items = OfficeEquDB::getDisposalDetails_2($assetscenter, $assetunit);
        include('undo_disposal.php');
        break;
   case 'undo_Disposal_save':
		 $id = $_GET['id'];
		 $items = OfficeEquDB::undo_Disposal_save($id);
		 echo json_encode($items);
         break;
    case 'ordinance_stock_list':
		$slidebartype = 1;
        $ordinances = ordinancePlacesDB::getFullDetails();
        include('ordinance_stock_list.php');
        break;
    case 'get_assets_units_ordinance':
        $ordinance = $_GET['ordinance'];
        $units = array();
		$assetunits = AssetsUnitDB::getunits_ordinance($ordinance);
		foreach ($assetunits as $unit) {
		$units[] = $unit['unitName']; }
		echo json_encode( $units );
        break;
    case 'get_unit_ordinance_record':
        $ordinance = $_GET['ordinance'];
		$unit = $_GET['unit'];
		$ordinance_send_date_1 = $_GET['ordinance_send_date_1'];
		$ordinance_send_date_2 = $_GET['ordinance_send_date_2'];
		$exps = OfficeEquDB::ordinance_received_details_2($ordinance, $unit, $ordinance_send_date_1, $ordinance_send_date_2);
		echo json_encode( $exps );
        break;
    case 'Disposal_List_summary_tree_2':
			if (isset($_GET['unit'])) {
			$unit = $_GET['unit'];
				$title = 'Disposal - Office Equipments List - '.$unit;
			} else {
				$title = 'Disposal - Office Equipments List List';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			echo $id;
			$items = CatalogueDB::getCatalogue_Tree(1);
			if ($id == 1){
				$exps = OfficeEquDB::disposal_get_catalogueno_summary_1();
				$title = 'Disposal - Office Equipments List Full List';
				include('disposal_summary_list_tree_2.php');
			} elseif ($id == 2) {
				$exps = OfficeEquDB::disposal_get_catalogueno_unit_summary_2(1, $unit);
				include('disposal_summary_list_tree_2.php');				
			} elseif ($id == 3) {
				$exps = OfficeEquDB::disposal_get_catalogueno_unit_summary_2(2, $unit);
				include('disposal_summary_list_tree_2.php');
			} elseif ($id == 4) {
				$exps = OfficeEquDB::disposal_get_catalogueno_unit_summary_3(3, $unit);
				include('disposal_List_summary_tree_2_1.php');
			} elseif ($id == 0) {
				 include('disposal_summary_list_tree_2.php');
			}
        break;
    case 'Disposal_List_summary_tree_2_1':
			$items = CatalogueDB::getCatalogue_Tree(1);
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = OfficeEquDB::disposal_get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Disposal Office Equipments List - '.$_GET['itemDescription'];
				include('disposal_List_summary_tree_2_1.php');
			} else if ($id == 2) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::disposal_get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Disposal Office Equipments List - '.$unit.' - '.$_GET['itemDescription'];
				include('disposal_List_summary_tree_2_2.php');
			} else if ($id == 3) {	
				$identificationno = $_GET['identificationno'];
				$row = OfficeEquDB::getpicById($identificationno);
				 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
				$PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
				$assetscenter = $PlantMac['assetscenter'];
				$assetunit = $PlantMac['assetunit'];
				$mainCategory = $PlantMac['mainCategory'];
				$itemCategory = $PlantMac['itemCategory'];
				$itemDescription = $PlantMac['itemDescription'];
				$assetsno = $PlantMac['assetsno'];
				$newAssestno = $PlantMac['newAssestno'];
				$catalogueno = $PlantMac['catalogueno'];
				$identificationno = $PlantMac['identificationno'];
				$ledgerno = $PlantMac['ledgerno'];
				$ledgerFoliono = $PlantMac['ledgerFoliono'];
				$eqptSriNo = $PlantMac['eqptSriNo'];
				$purchasedDate = $PlantMac['purchasedDate'];
				$quantity = $PlantMac['quantity'];
				$capacity = $PlantMac['capacity'];
				$unitValue = $PlantMac['unitValue'];
				$totalCost = $PlantMac['totalCost'];
				$receivedDate = $PlantMac['receivedDate'];
				$presentLocation = $PlantMac['presentLocation'];
				$fundtype = $PlantMac['fundtype'];
				$Remarks = $PlantMac['Remarks'];
				$id = $PlantMac['id'];
				$groupId = $PlantMac['groupId'];
				$acquisitionInstitute = $PlantMac['acquisitionInstitute'];
				$damcomment = $PlantMac['damcomment'];
				$title = $identificationno;
				include('disposal_List_summary_tree_2_3.php');
			}
        break;	
   case 'date_range_changes':

        $receivedDate_from = "";
        $receivedDate_to = "";
		$with_units = $_POST['with_units'] ?? 0;
        $full_details = $_POST['full_details'] ?? 0;
        $slidebartype = 0;
        $title2 = "";
        $title_dis = "";
        $display_type = 0;
        $exps = array();
        $exps_dis = array();
        if (isset($_POST['receivedDate_from']) && isset($_POST['receivedDate_to'])) {
            $receivedDate_from = $_POST['receivedDate_from'];
            $receivedDate_to = $_POST['receivedDate_to'];
            $title2 = 'New Items - From ' . $receivedDate_from . ' To ' . $receivedDate_to;
		    $title_dis = 'Dispisal Items - From ' . $receivedDate_from . ' To ' . $receivedDate_to;
            if ($with_units == 0 && $full_details == 0){
                $display_type = 0;
            } elseif ($with_units == 1 && $full_details == 0) {
                $display_type = 1;
            } elseif ($full_details == 1){
                $display_type = 2;
            }
            $exps = OfficeEquDB::date_range_changes($receivedDate_from, $receivedDate_to, $display_type);
            $exps_dis = OfficeEquDB::date_range_changes_dis($receivedDate_from, $receivedDate_to, $display_type);
        }
		include('date_range_changes.php');
        break;
    case 'disposal_inquiry_tree':
        $slidebartype = 0;
        $error = 0;
		if (isset($_GET['unit'])) {
            $unit = $_GET['unit'];
        } else {
            $unit = "";
        }
		if (isset($_GET['type'])) {
            $type = $_GET['type'];
        } else {
            $type = 0;
        }
        $items = AssetsUnitDB::getFullListbyProtocol();
        if ($type == 1) {
			$exps = OfficeEquDB::getDisposalDetails();
		} else {	
			$exps = OfficeEquDB::getDisposalDetailsUnit($unit, $type);
		} 
        include('disposal_inquiry_tree.php');
        break;
    case 'Disband_List':
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails_disband($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords_disband();
		$total_pages = ceil($total_records / $per_page);
		include('Disband_List.php');
        break;	
    case 'disband_selected_items':

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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = OfficeEquDB::getInqDetails_disband($assetscenter, $assetunit, $column, $search);
		include('disband_selected_items.php');
        break;
   case 'delete_disband':
        $error = 0;
		$id = $_GET['id'];
		$saveCount = OfficeEquDB::disband_one($id);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
       echo $error;
        break;
    case 'donated_item':		
		$items = OfficeEquDB::getDonateditems();
		include('donateditem_list.php');
        break;
	case 'Donated_List_csv':
		$exps = OfficeEquDB::getDonateditems();
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=donated_list.csv');
			$output = fopen('php://output', 'w');
			fputcsv($output, array('S/N', 'Unit', 'Identification No', 'Description', 'Asset No', 'Catalogue No', 'Serial No.', 'DOR', 'Unit Value', 'Remarks'));
			$i = 1;
			foreach ($exps as $exp) {
				$fields = array($i, $exp['assetunit'], $exp['identificationno'], $exp['itemDescription'], $exp['assetsno'], $exp['catalogueno'], $exp['eqptSriNo'], $exp['receivedDate'], $exp['unitValue'], $exp['ApprovedDisposal'] == '1' ? "Disposed on ".$exp['disposedDate'] : "");
				fputcsv($output, $fields);
				$i++;
			}
			fclose($output);
		break;
   case 'year_changes':
		 if (isset($_POST['receivedDate'])) {
            $year = $_POST['receivedDate'];
        } else if (isset($_GET['receivedDate'])) {
            $year = $_GET['receivedDate'];
        } else {
            $year = "";
        }
		$exps = OfficeEquDB::year_changes($year);
        include('year_changes.php');			
        break;
   case 'transfer_selet_quick':
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			$eqptSriNo = $_POST['eqptSriNo'];
			$saveCount = OfficeEquDB::updateserialno($id, $eqptSriNo);
		}
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
        }

        if (isset($_POST['inputField1'])) {
            $inputField1 = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $inputField1 = $_GET['inputField1'];
        } else {
            $inputField1 = "";
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
		
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        //added by Capt APL Madhushanka 2022/11/21
        $assetsCenters_all = AssetsCenterDB::getAssetsCentersAll();
	$assetunits_all = AssetsUnitDB::getAssetsUnitsByCenterAll($assetscenter);
        //
        $items = OfficeEquDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, "", "");
		include('add_transfer_selet_quick.php');
		break;
  case 'transfer_selet_quick_save':
			$id = $_GET['id'];
			$transferSelect = $_GET['transferSelect'];
			$transferToCenter = $_GET['transferToCenter'];
			$transferToUnit = $_GET['transferToUnit'];
			$transferToDetails = "Bulk Transfer";
			$transferToDate = date("Y/m/d");
			$saveCount = OfficeEquDB::select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate);
		echo $saveCount;
		break;
    case 'Select_Items_For_Disposal_quick':		
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('Select_Items_For_Disposal_quick.php');
        break;
   case 'Disposal_select_save_quick':
		 $id = $_GET['id'];
		 $selectDisposal = $_GET['selectDisposal'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = OfficeEquDB::disposal_select_save_quick($id, $selectDisposal, $login);
		 echo json_encode($items);
         break;
    case 'add_disposal_details_quick':		
		if (isset($_POST['save_all']))
		{
		$count = OfficeEquDB::disposal_details_save_quick_all($assetunit, $_POST['disposedDate'], $_POST['disposedReason'], $_POST['condemnation']);
		}
		$items = OfficeEquDB::getSelectedDisposalItems();
		include('add_disposal_details_quick.php');
        break;
    case 'disposal_details_save_quick':		
		 $id = $_GET['id'];
		 $disposedDate = $_GET['disposedDate'];
		 $disposedReason = $_GET['disposedReason'];
		 $condemnation = $_GET['condemnation'];
		 $items = OfficeEquDB::disposal_details_save_quick($id, $disposedDate, $disposedReason, $condemnation);
		 echo json_encode($items);
        break;
    case 'confirm_items_for_disposal_quick':
        $items = OfficeEquDB::getToConfirmDisposalItemsSort();
        include('confirm_items_for_disposal_quick.php');
        break;
    case 'ConfirmDisposalSave_quick':
        $id = $_GET['id'];
        $confirmDisposal = 1;
        $login = $_SESSION['SESS_LOGIN'];
        $items = OfficeEquDB::ConfirmDisposalSave($id, $confirmDisposal, $login);
		echo json_encode($items);
        break;
	case 'ConfirmDisposalReject_quick':
        $id = $_GET['id'];
        $items = OfficeEquDB::ConfirmDisposalReject($id);
		echo json_encode($items);
        break;
    case 'Selected_List_For_Disposal':
        $Items = OfficeEquDB::getSelectedDisposalItems();
        include('Selected_List_For_Disposal.php');
        break;
    case 'Confirmed_List_For_Disposal':
        $Items = OfficeEquDB::Confirmed_For_Disposal();
        include('Confirmed_List_For_Disposal.php');
        break;
    case 'bulk_approved':		
		$items = OfficeEquDB::getItemsNotApproved_all();
		include('bulk_approved.php');
        break;
    case 'bulk_approved_save':
        $id = $_GET['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $count = OfficeEquDB::ApproveDetails($id, $login);
        echo $count;
        break;
    case 'board_report_ob_view':
        $slidebartype = 0;
		$exps = board_report_observationsDB::getFullDetails_Itemtype($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_ob_view.php');
        break;
   case 'board_report_summary_view':
        $slidebartype = 0;
		$items = board_report_summaryDB::getFullDetails($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_summary_view.php');
        break;
    case 'board_report_summary_view_details':
        $slidebartype = 0;
		$items = OfficeEquDB::board_report_summary_view_details($_GET['id']);
		include('board_report_summary_view_details.php');
        break;
    case 'board_report_summary_view_trans':
        $slidebartype = 0;
		$items = board_report_summaryDB::getFullDetails($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_summary_view_trans.php');
        break;
    case 'allocation_list':
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::allocation_list($assetunit);
        include('allocation_list.php');
        break;
    case 'lifetime_list':
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::lifetime_list($assetunit);
        include('lifetime_list.php');
        break;
    case 'np_Paging_List':
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::np_getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::np_countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('np_paging_list.php');
        break;
    case 'np_paging_list_headfix':
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = OfficeEquDB::np_getPagingDetails($start_from, $per_page);
		$total_records = OfficeEquDB::np_countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
		include('np_paging_list_headfix.php');
        break;
    case 'np_tree_list_2':
			if (isset($_GET['unit'])) {
			$assetunit = $_GET['unit'];
				$title = 'Office Equipments Details List Non Public - '.$assetunit;
			} else {
				$title = 'Office Equipments Details List Non Public';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if ($id == 1){
				$exps = OfficeEquDB::np_get_catalogueno_summary_1();
				$title = 'Office Equipments Details Full List - Non Public';
			} else if ($id == 5 || $id == 2) {
				$exps = OfficeEquDB::np_get_catalogueno_summary_2(1, $assetunit);	
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$exps = OfficeEquDB::np_get_catalogueno_summary_2(2, $assetunit);
			}
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('np_tree_list_2.php');
        break;
    case 'np_tree_list_2_1':
			$items = AssetsUnitDB::getFullListbyProtocol();
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = OfficeEquDB::np_get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Office Equipments Details - Non Public - '.$_GET['itemDescription'];
				include('np_tree_list_2_1.php');
			} else if ($id == 5 || $id == 2) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::np_get_catalogueno_summary_2_unit(1, $unit, $catalogueno);
				$title = 'Office Equipments Details - Non Public - '.$unit.' - '.$_GET['itemDescription'];
				include('np_tree_list_2_1.php');
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$unit = $_GET['assetunit'];
				$exps = OfficeEquDB::np_get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Office Equipments Details - Non - Public - '.$unit.' - '.$_GET['itemDescription'];
				include('np_tree_list_2_2.php');
			} else if ($id == 10) {	
				$PlantMac = OfficeEquDB::getDetailsByIdentificationno($_GET['identificationno']);
				$title = $_GET['identificationno']. ' - Non Public';
				include('np_tree_list_2_3.php');
			}
        break;
    case 'np_List_Inquiry':
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

        if (isset($_POST['searchby'])) {
            $searchby = $_POST['searchby'];
        } else if (isset($_GET['searchby'])) {
            $searchby = $_GET['searchby'];
        } else {
            $searchby = 'Identification Number';
        }

        if (isset($_POST['search'])) {
            $search = $_POST['search'];
        } else if (isset($_GET['search'])) {
            $search = $_GET['search'];
        } else {
            $search = "";
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
		
        include('coldefine.php');
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = OfficeEquDB::np_getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		include('np_inquiry_list.php');
        break;
    case 'np_Inquiry_List_Details':
        $identificationno = $_GET['identificationno'];
        $assetunit = $_GET['assetunit'];
        $searchby = $_GET['searchby'];
        $search = $_GET['search'];
        $inputField1 = $_GET['inputField1'];
        $inputField2 = $_GET['inputField2'];
        include('coldefine.php');
        $slidebartype = 8;
        $items = OfficeEquDB::np_getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        $PlantMac = OfficeEquDB::getDetailsByIdentificationno($identificationno);
        include('np_approved_details.php');
        break;
    case 'add_details_new':
        $slidebartype = 3;
		$fundtype = $_GET['fundtype'];
		include('add_details_new.php');
        break;
    case 'getmainCategory':
		$exps = ClassificationListDB::getmainCategory1($_GET['type']);
        echo json_encode($exps);
		break;
    case 'getitemCategory':
		$exps = ClassificationListDB::getitemCategoryBymainCategory1($_GET['mainCategory'], $_GET['type']);
        echo json_encode($exps);
		break;
    case 'getitemDescription':
		$exps = ClassificationListDB::getDescriptionByCategory1($_GET['mainCategory'], $_GET['itemCategory'], $_GET['type']);
        echo json_encode($exps);
		break;
    case 'getitemCatalogueno':
		$exps = ClassificationListDB::getCatalogueByDescription1($_GET['mainCategory'], $_GET['itemCategory'], $_GET['itemDescription'], $_GET['type']);
        echo json_encode($exps);
		break;	
    case 'getpresentLocation':
		$exps = present_locationDB::getDetailsByUnit($assetunit);		
        echo json_encode($exps);
		break;
    case 'generatedCode':
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit1($assetunit);
		$assetsnos = ClassificationListDB::getAssetsnoByCatalogueno1($_GET['catalogueno'], $type);
		if ($_GET["counterId"] == 0) {
            $counterIdD = OfficeEquDB::getCounterId($assetunit, $_GET['catalogueno']);
        } else {
            $counterIdD = $_GET["counterId"];
            $counterIdD--;
        }
        $qty = (int) $_GET["quantity"];
        $idList = array();
        $counterIds = array();
        for ($x = 1; $x <= $qty; $x++) {
            $counterIdD++;
            $counterId = sprintf("%04d", $counterIdD);
            $identificationno = $centreID."/" . $assetsnos . "/" . $_GET['catalogueno'] . "/" . $counterId;
            $idList[] = $identificationno;
        }
        //$groupId = OfficeEquDB::getGroupId();	
        echo json_encode($idList);
		break;
    case 'add_detail_new_save':
		if ($_POST['groupId'] == 0) {
            $groupIdNew = OfficeEquDB::getGroupId();
        } else {
            $groupIdNew = $_POST['groupId'];
			OfficeEquDB::deleteDetailsByGroupId($_POST['groupId']);
        }
        $qty = (int) $_POST['quantity'];
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
		$identificationnos = $_POST['identificationnos'];
        $idList = explode(" ", $identificationnos);
		$eqList = explode(";", $_POST['eqptSriNo']);	
		for ($x = 0; $x < $qty; $x++) {
			$identificationno = $idList[$x];
			if (array_key_exists($x,$eqList))
			{
				$eqptSriNo = $eqList[$x];
			} else {
				$eqptSriNo = "";
			}
			$counterId = (int) substr($identificationno, -4);
			$officeEqu = new PlantMac($assetscenter, $assetunit, $_POST['mainCategory'], $_POST['itemCategory'], $_POST['itemDescription'], $_POST['assetsno'], $_POST['newAssestno'], $_POST['catalogueno'], $identificationno, $_POST['ledgerno'], $_POST['ledgerFoliono'], $eqptSriNo, $_POST['purchasedDate'], $_POST['quantity'], 0, $_POST['unitValue'], $_POST['quantity']*$_POST['unitValue'], $_POST['receivedDate'], $_POST['remarks'], $counterId, $groupIdNew, $_POST['quantity'], $_POST['presentLocation'], "", "", "", "", "", "", "", $_POST['natureOwnership']);
			$count = OfficeEquDB::getHasRecord($officeEqu);
			if ($count > 0) {
				$error = 3;
				break 1;
			} else {
				$saveCount = OfficeEquDB::addOfficeEqu($officeEqu);
				if ($saveCount == 1) {                       
					$error = 1;
					$count = OfficeEquDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
					$count = OfficeEquDB::Save_psos_allow(2, $_POST['itemCategory'], $identificationno);
					$countft = OfficeEquDB::Save_fundtype($_POST['fundtype'], $identificationno);
					if ($proto['protocollevel1'] == 25) {
						$count = OfficeEquDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					} else {
						$count = OfficeEquDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					}
					if ($_POST['receiveFromUnits'] != 0) {
						$count = OfficeEquDB::addPlantMacTransferDetails($assetscenter, $assetunit, $_POST['receiveFromUnits'], $identificationno);
					}
				} else {
					$error = 5;
					break 1;
				}
			}
		}
	echo $error;		
        break;
	case 'showSidebar':
		switch ($_GET['id']) {
		case 1:
			 $items = OfficeEquDB::getItemsNotApproved_unit($assetunit, $_GET['fundtype']);
			break;
		case 2:
			 $items = OfficeEquDB::getItemsApproveRejected_unit($assetunit, $_GET['fundtype']);	
			break;
		case 3:
			 $items = OfficeEquDB::getItemsNotTransfered_unit($assetunit, $_GET['fundtype']);
			break;
		}
		echo json_encode( $items );
		break;
	case 'getDetailsGroupID':
		$items = OfficeEquDB::getDetailsGroupID($_GET['groupId']);
		echo json_encode( $items );
		break;
	case 'deleteDetailsByGroupId':
		$count = OfficeEquDB::deleteDetailsByGroupId($_GET['groupId']);
		echo $count;
		break;
	case 'getDetailsById':
		$items = OfficeEquDB::getDetailsById($_GET['id']);
		echo json_encode( $items );
		break;
    case 'tobe_approve_new':
        $slidebartype = 5;
		$fundtype = $_GET['fundtype'];
		include('tobe_approve_new.php');
        break;
    case 'approve_save_new':
        $count = OfficeEquDB::approve_save_new($_GET['groupId']);
		echo $count;        
		break;
    case 'not_approve_save_new':
        $count = OfficeEquDB::not_approve_save_new($_GET['groupId'], $_GET['notapprivedReason']);
		echo $count; 
        break;
  case 'getcatalogueDetails':
		$catalogueno = $_GET['catalogueno'];
		$exps = CatalogueDB::getcatlogDetailByCatalogueno($catalogueno);
		echo json_encode( $exps );
		break;		
}
?>