<?php
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetscenter2.php');
require('../model/assetsunit_db.php');
require('../model/classificationlist_db.php');
require('../model/vehicle.php');
require('../model/vehicle_db.php');
require('../model/institute_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/catalogue_db.php');
require('../model/brand_db.php');
require('../model/model_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/unitdetails_db.php');
require('../model/present_location_db.php');
require('../model/board_report_db.php');
require('../model/board_report_observations_db.php');
require('../model/board_report_summary_db.php');
require_once ('../model/tender_vehicledetails_db.php');
require('../model/allocation_details_db.php');
require('../model/vehicle_repairtype_db.php');
require('../model/vehicle_repair_details_db.php');

$page = 5;
$type = 3;
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
$fields->addField('make');
$fields->addField('modle');
$fields->addField('assetsno');
$fields->addField('newAssestno');
$fields->addField('catalogueno');
$fields->addField('identificationno');
$fields->addField('engineno');
$fields->addField('chessisno');
$fields->addField('yearManufacture');
$fields->addField('ownerShip');
$fields->addField('armyno');
$fields->addField('civilno');
$fields->addField('fuel');
$fields->addField('purchasedDate');
$fields->addField('unitValue');
$fields->addField('totalCost');
$fields->addField('horsePower');
$fields->addField('tare');
$fields->addField('presentLocation');
$fields->addField('receivedDate');
$fields->addField('Remarks');
$fields->addField('counterId');
$fields->addField('searchby');
$fields->addField('search');
$fields->addField('disposedDate');
$fields->addField('disposedReason');
$fields->addField('acquisitionInstitute');
$fields->addField('natureOwnership');
$fields->addField('$CapRepairCost');

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
	        $items = VehicleDB::getFullDetails();
		$checkAllowType = VehicleDB::getIsAllocation($assetscenter, $assetunit);
		if ($checkAllowType == 2) {
		$itemAll = VehicleDB::getAllocationDetails($assetunit);
		foreach ($itemAll as $row) {
            $items[] = $row;
        }
		}
       // $items = VehicleDB::getFullDetails();
        include('full_list.php');
        break;
    case 'List_Details_2':
	     $items = VehicleDB::getFullDetails();
        include('full_list_2.php');
        break;
    case 'Add_Details':
        $slidebartype = 3;
        $error = 0;
        $id = 0;
        setcookie('id', 0);
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $make = "";
        $modle = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $engineno = "";
        $chessisno = "";
        $yearManufacture = "";
        $ownerShip = "";
        $armyno = "";
        $civilno = "";
        $fuel = "";
        $purchasedDate = "";
        $unitValue = "";
        $totalCost = "";
        $horsePower = "";
        $tare = "";
        $presentLocation = "";
        $receivedDate = "";
        $Remarks = "";
        $counterId = 0;
        $identificationnoTem = "";
        $notapprived = "";
        $notapprivedReason = "";
        $acquisitionInstitute = "";
		$natureOwnership = "";
		$brandName = "";
		$modleNames = array();
		$brandNames = brandDB::getFullDetails();
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);
        $mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $makes = ClassificationListDB::getMakeByDescription($itemDescription, $type);
        $modles = ClassificationListDB::getModleByMake($make, $type);
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
		$Items_Sub_2 = VehicleDB::getItemsNotTransfered($assetunit);
        $institutes = InstituteDB::getFullDetails();
        $capRprCost = "";
        include('add_details.php');
        break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
        $assetunit = "";
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'findCategoryByMainCategory':
        $mainCategory = $_GET['mainCategory'] ?? "";
        $itemCategory = "";
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        include('../view/findcategorybymaincategory.php');
        break;
    case 'findDescriptionByCategory':
        $mainCategory = $_GET['mainCategory'] ?? "";
        $itemCategory = $_GET['itemCategory'] ?? "";
        $itemDescription = "";
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        include('../view/finddescriptionbycategory.php');
        break;
    case 'findCataloguenoByDescription':
        $mainCategory = $_GET['mainCategory'] ?? "";
        $itemCategory = $_GET['itemCategory'] ?? "";
        $itemDescription = $_GET['itemDescription'] ?? "";
        $catalogueno = "";
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        include('../view/findcataloguenobydescription.php');
        break;
    case 'findAssetsnoByCatalogueno':
        $catalogueno = $_GET['catalogueno'];
        //$assetsno = "";
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        setcookie('catalogueno', $catalogueno);
        setcookie('assetsno', $assetsnos->getId());
        include('../view/findassetsnobycataloguenov.php');
        break;
    case 'findPresentUnitByUnit':
        $assetsUnit = $_GET['unit'];
        $assetunits = AssetsUnitDB::getPresentUnitByUnit($assetsUnit);
        setcookie('assetsUnit', $_GET['unit']);
        include('../view/findpresentunitbyunit.php');
        break;
    case 'findMakeByDescription':
        $mainCategory = $_GET['mainCategory'];
        $itemCategory = $_GET['itemCategory'];
        $itemDescription = $_GET['itemDescription'];
        $catalogueno = "";
        $cataloguenos = ClassificationListDB::getMakeByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        include('../view/findmakebydescription.php');
        break;

    case 'generateCode':
        $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
        if ($_COOKIE["id"] == 0) {
            $counterIdD = VehicleDB::getCounterId($_COOKIE["assetsUnit"]);
            $counterIdD++;
        } else {
            $counterIdD = $_COOKIE["counterID"];
        }
        //$counterIdD++;
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $_COOKIE["catalogueno"] . "/" . $counterId;
        setcookie('counterId', $counterIdD);
        echo $identificationno;
        break;
    case 'Add_Detail':
        //die('in');
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $mainCategory = $_POST['mainCategory'];
        $itemCategory = $_POST['itemCategory'];
        $itemDescription = $_POST['itemDescription'];
        $make = $_POST['make'];
        $modle = $_POST['modle'];
        $assetsno = $_POST['assetsno'];
        $newAssestno = $_POST['newAssestno'];
        $catalogueno = $_POST['catalogueno'];
        $identificationno = $_POST['identificationno'];
        $engineno = strtoupper($_POST['engineno']);
        $chessisno = strtoupper($_POST['chessisno']);
        $yearManufacture = $_POST['yearManufacture'];
        $ownerShip = strtoupper($_POST['ownerShip']);
        $armyno = strtoupper($_POST['armyno']);
        $civilno = strtoupper($_POST['civilno']);
        $fuel = $_POST['fuel'];
        $purchasedDate = $_POST['purchasedDate'];
        $unitValue = $_POST['unitValue'];
        $totalCost = 0;
        $horsePower = $_POST['horsePower'];
        $tare = $_POST['tare'];
        $presentLocation = $_POST['presentLocation'];
        $receivedDate = $_POST['receivedDate'];
        $Remarks = strtoupper($_POST['Remarks']);
        $counterId = $_COOKIE['counterId'];
        $identificationnoTem = $_POST['identificationnoTem'];
        $CapRepairCost = $_POST['CapRepairCost'];
        $id = $_POST['id'];
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
        $acquisitionInstitute = $_POST['acquisitionInstitute'];
		$natureOwnership = strtoupper($_POST['natureOwnership']);
		$brandName = $_POST['brandName'];
		$modleName = $_POST['modleName'];
		
        $validate->text('assetscenter', $assetscenter);
        $validate->text('assetunit', $assetunit);
        $validate->text('mainCategory', $mainCategory);
        $validate->text('itemCategory', $itemCategory);
        $validate->text('itemDescription', $itemDescription);
        //$validate->text('make', $make);
        //$validate->text('modle', $modle);
        $validate->text('assetsno', $assetsno);
        //$validate->text('newAssestno', $newAssestno);
        $validate->text('catalogueno', $catalogueno);
        $validate->text('identificationno', $identificationno);
        $validate->text('engineno', $engineno);
        $validate->text('chessisno', $chessisno);
        $validate->text('yearManufacture', $yearManufacture);
        //$validate->text('ownerShip', $ownerShip);
        $validate->text('armyno', $armyno);
        $validate->text('civilno', $civilno);
        $validate->text('fuel', $fuel);
        //$validate->passeddate('purchasedDate', $purchasedDate);
        $validate->number('unitValue', $unitValue);
        //$validate->number('totalCost', $totalCost);
        //$validate->number('horsePower', $horsePower);
        //$validate->number('tare', $tare);
        $validate->text('presentLocation', $presentLocation);
        $validate->passeddate('receivedDate', $receivedDate);
		//$validate->current_year_date('receivedDate', $receivedDate, $currentYear);
        //$validate->text('Remarks', $Remarks);


        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $makes = ClassificationListDB::getMakeByDescription($itemDescription, $type);
        $models = ClassificationListDB::getModleByMake($make, $type);
        $institutes = InstituteDB::getFullDetails();
		$modleNames = array();
		$brandNames = brandDB::getFullDetails();

// Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            $error = 2;

            // include('ADD_Details.php');
        } else {
            if ($id != 0) {
                VehicleDB::deleteDetailsById($id);
            }
            $vehicle = new Vehicle($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $make, $modle, $assetsno, $newAssestno, $catalogueno, $identificationno, $engineno, $chessisno, $yearManufacture, $ownerShip, $armyno, $civilno, $fuel, $purchasedDate, $unitValue, $totalCost, $horsePower, $tare, $presentLocation, $receivedDate, $Remarks, $counterId, $acquisitionInstitute, $natureOwnership, $CapRepairCost);
            $count1 = VehicleDB::getHasRecord($vehicle);
            $count2 = VehicleDB::getHasArmyno($armyno);
			$count = $count1 + $count2;
			if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = VehicleDB::addVehicle($vehicle);
                if ($saveCount == 1) {
                    $error = 1;
                    $id = 0;
                    setcookie('id', 0);
					$count = VehicleDB::Savemakemodel($brandName, $modleName, $identificationno);
					$count = VehicleDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
					$count = VehicleDB::Save_psos_allow(3, $itemCategory, $identificationno);
					if ($proto['protocollevel1'] == 25) {
						$count = VehicleDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					} else {
						$count = VehicleDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					}
				} else {
                    $error = 5;
                }
            }
        }
        $slidebartype = 3;
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        $notapprived = 0;
        include('add_details.php');
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
        $Items = VehicleDB::getSelectedDisposalItems();
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $id = $Vehicle['id'] ?? "";

        $selectDisposal = $Vehicle['selectDisposal'] ?? "";
        $disposedDate = $Vehicle['disposedDate'] ?? "";
        $disposedReason = $Vehicle['disposedReason'] ?? "";
		$condemnation = $Vehicle['condemnation'] ?? "";
		$destruction = $Vehicle['destruction'] ?? "";

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
        $mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
        setcookie('catalogueno', $catalogueno);
        setcookie('searchby', $searchby);
        setcookie('search', $search);
        $slidebartype = 21;
        include('select_disposal.php');
        break;
    case 'search_Disposal':
        $id = $_GET['id'];
        // $catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'];
        $search = $_COOKIE['search'];
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $id = $Vehicle['id'];

        $selectDisposal = $Vehicle['selectDisposal'];
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
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
            $count = VehicleDB::SelectDisposalSave($id, $selectDisposal, $disposedDate, $disposedReason, $condemnation, $destruction, $login);
        }
        //
        $catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'];
        $search = $_COOKIE['search'];
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $id = $Vehicle['id'];

        $selectDisposal = $Vehicle['selectDisposal'];
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        if ($slidebartype == 21) {
            $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
            //$slidebartype = 21;
        } else if ($slidebartype == 14) {
            $Items = VehicleDB::getToConfirmDisposalItems();
        }
        include('add_disposal.php');
        break;
    case 'Confirm_Items_For_Disposal':
        $Items = VehicleDB::getToConfirmDisposalItems();
        $slidebartype = 22;
        include('startpage.php');
        break;
    case 'confirm_Disposal' :
        $id = $_GET['id'];
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $confirmDisposal = $Vehicle['confirmDisposal'];
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        $Items = VehicleDB::getToConfirmDisposalItems();
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
        $count = VehicleDB::ConfirmDisposalSave($id, $confirmDisposal, $login);
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $confirmDisposal = $Vehicle['confirmDisposal'];
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        $Items = VehicleDB::getToConfirmDisposalItems();
        $slidebartype = 22;
        include('confirm_disposal.php');
        break;
	case 'ConfirmDisposalReject':
        $id = $_POST['id'];
        $count = VehicleDB::ConfirmDisposalReject($id);
        $Items = VehicleDB::getToConfirmDisposalItems();
        $slidebartype = 22;
        include('startpage.php');
        break;
    case 'approve_Items_For_Disposal':
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
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
		$items = VehicleDB::getApproveDisposalItems_catlog($assetunit);
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
		$items = VehicleDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
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
        $Vehicle = VehicleDB::getDetailsById($id);
		include('dbtovariable.php');
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
        $ApprovedDisposal = $Vehicle['ApprovedDisposal'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
		$row = VehicleDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
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
        $count = VehicleDB::ApproveDisposalSave($id, $ApprovedDisposal, $login);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$items = VehicleDB::getApproveDisposalItems_catlog_2($assetunit, $catalogueno);
        $slidebartype = 1;
        include('select_approve_disposal_catlog_2.php');
        break;
  case 'approve_Items_For_Disposal_catlog_5':
		 $id = $_GET['id'];
		 $Approved = $_GET['Approved'];
		 $login = $_SESSION['SESS_LOGIN'];
		 if ($Approved == 1) {
		 $count = VehicleDB::ApproveDisposalSave($id, $Approved, $login);
		 } else {
		 $count = 0; 
		 }
		 echo json_encode($count);
         break;
  case 'approve_Items_For_Disposal_catlog_7':
		 $id = (int)ltrim($_GET['id'], 'reg_');
		 $count = VehicleDB::RejectDisposalSave($id);
		 echo json_encode($id);
         break;		 
    case 'approve_search_Disposals':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];

        $id = "";
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $make = "";
        $modle = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $engineno = "";
        $chessisno = "";
        $yearManufacture = "";
        $ownerShip = "";
        $armyno = "";
        $civilno = "";
        $fuel = "";
        $purchasedDate = "";
        $unitValue = "";
        $totalCost = "";
        $horsePower = "";
        $tare = "";
        $presentLocation = "";
        $receivedDate = "";
        $Remarks = "";
        $disposedDate = "";
        $disposedReason = "";
		$condemnation = "";
		$destruction = "";
        $ApprovedDisposal = "";
        $acquisitionInstitute = "";
        $Items = VehicleDB::getApproveDisposalItems($assetunit);
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

        //$assetscenter = $_POST['assetscenter'];
        // $assetunit = $_POST['assetunit'];
        $id = $_GET['id'];
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
        $ApprovedDisposal = $Vehicle['ApprovedDisposal'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        $Items = VehicleDB::getApproveDisposalItems($assetunit);
        $slidebartype = 23;
        include('approve_disposal.php');
        break;
    case 'ApproveDisposalSave':
        $id = $_POST['id'];
        if (isset($_POST['ApprovedDisposal'])) {
            $ApprovedDisposal = 1;
        } else {
            $ApprovedDisposal = 0;
			$condemnation = "";
			$destruction = "";			
        }
        $login = $_SESSION['SESS_LOGIN'];
        $count = VehicleDB::ApproveDisposalSave($id, $ApprovedDisposal, $login);
        $Vehicle = VehicleDB::getDetailsById($id);
        $assetscenter = $Vehicle['assetscenter'];
        $assetunit = $Vehicle['assetunit'];
        $id = "";
        $mainCategory = "";
        $itemCategory = "";
        $itemDescription = "";
        $make = "";
        $modle = "";
        $assetsno = "";
        $newAssestno = "";
        $catalogueno = "";
        $identificationno = "";
        $engineno = "";
        $chessisno = "";
        $yearManufacture = "";
        $ownerShip = "";
        $armyno = "";
        $civilno = "";
        $fuel = "";
        $purchasedDate = "";
        $unitValue = "";
        $totalCost = "";
        $horsePower = "";
        $tare = "";
        $presentLocation = "";
        $receivedDate = "";
        $Remarks = "";
        $disposedDate = "";
        $disposedReason = "";
        $ApprovedDisposal = "";
		$condemnation = "";
		$destruction = "";
        $acquisitionInstitute = "";
        $Items = VehicleDB::getApproveDisposalItems($assetunit);
        $slidebartype = 23;
        include('approve_disposal.php');
        break;
    case 'Disposal_List':
        //$items = VehicleDB::getDisposalDetails();
        $per_page=10000;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = VehicleDB::getDisposalDetailsPaging($start_from, $per_page);
		$total_records = VehicleDB::countTotalRecordsDisposalDetails();
		$total_pages = ceil($total_records / $per_page);
        include('disposal_list.php');
        break;
    case 'DisposalList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 24;
        $Items = VehicleDB::getDisposalDetails();
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);

        include('dbtovariable.php');
        $id = $Vehicle['id'];
        $disposedDate = $Vehicle['disposedDate'];
        $disposedReason = $Vehicle['disposedReason'];
        $ApprovedDisposal = $Vehicle['ApprovedDisposal'];
		$condemnation = $Vehicle['condemnation'];
		$destruction = $Vehicle['destruction'];
        include('disposal_details.php');
        break;
    case 'List_Approved':
        $slidebartype = 11;
        include('startpage.php');
        break;
    case 'Tobe_Approve':
        $slidebartype = 12;
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        include('startpage.php');
        break;
    case 'toBeApproveList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 12;
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        $notapprived = $Vehicle['notapprived'];
        $notapprivedReason = $Vehicle['notapprivedReason'];

        include('dbtovariable.php');
        $id = $Vehicle['id'];
        include('approve_details.php');
        break;
    case 'approveSave':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 12;
        $count = 0;
        $count = VehicleDB::ApproveDetails($id, $login);
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        include('startpage.php');
        break;
    case 'notApproveSave':
        $id = $_POST['id'];
        $notapprivedReason = $_POST['notapprivedReason'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 12;
        $count = 0;
        $count = VehicleDB::notApproveDetails($id, $login, $notapprivedReason);
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        include('startpage.php');
        break;
    case 'Approved':
        $slidebartype = 13;
        $Items = VehicleDB::getItemsApproved();
        include('startpage.php');
        break;
    case 'ApprovedList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
        //$Items = VehicleDB::getItemsApproved();
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);

        include('dbtovariable.php');
        $id = $Vehicle['id'];
		$damcomment = $Vehicle['damcomment'];
        include('approved_details.php');
        break;
    case 'update_Details':
        $slidebartype = 3;
        $error = 0;
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        $id = $_GET['id'];
        $Vehicle = VehicleDB::getDetailsById($id);
        $notapprived = $Vehicle['notapprived'];
        $notapprivedReason = $Vehicle['notapprivedReason'];

        include('dbtovariable.php');
        $id = $Vehicle['id'];
        $identificationnoTem = $Vehicle['identificationno'];
        $lastCounterID = $Vehicle['counterId'];
        $delComfirem = $identificationno;
		$modleNames = array();
		$brandNames = brandDB::getFullDetails();
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $makes = ClassificationListDB::getMakeByDescription($itemDescription, $type);
        $models = ClassificationListDB::getModleByMake($make, $type);
        $institutes = InstituteDB::getFullDetails();
        //$groupIdNew = VehicleDB::getGroupId();
        // setcookie('district', $district);
        setcookie('assetsno', $assetsno);
        //  setcookie('ownership', $ownership);
        setcookie('assetsUnit', $assetunit);
        setcookie('counterID', $Vehicle['counterId']);
        setcookie('id', $id);
        setcookie('catalogueno', $catalogueno);
        //$newCounterID = VehicleDB::getCounterId($_COOKIE["assetsUnit"]);
		$newCounterID = VehicleDB::getCounterId($assetunit);
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
        include('add_details.php');
        break;
    case 'delete_Details':
        $slidebartype = 3;
        $error = 0;

        $id = $_POST['id'];
        $Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');

        $id = $Vehicle['id'];
        $identificationnoTem = $Vehicle['identificationno'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $makes = ClassificationListDB::getMakeByDescription($itemDescription, $type);
        $models = ClassificationListDB::getModleByMake($make, $type);
        //$groupIdNew = VehicleDB::getGroupId();
        // setcookie('district', $district);
        setcookie('assetsno', $assetsno);
        //  setcookie('ownership', $ownership);
        setcookie('assetsUnit', $assetunit);
        setcookie('counterID', $Vehicle['counterId']);
        setcookie('id', 0);
        setcookie('catalogueno', $catalogueno);
        $saveCount = VehicleDB::deleteDetailsById($id);
        setcookie('groupId', 0);
        $id = 0;
        $identificationnoTem = "";
        $error = 6;
        $Items = VehicleDB::getItemsNotApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
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
        $searchText = VehicleDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$checkAllowType = VehicleDB::getIsAllocation($assetscenter, $assetunit);
        if ($disposal == 1) {
            $items = VehicleDB::getInqDisposalDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        } else {
         	if ($search <> "") {
				$items = VehicleDB::getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
			} else {
				$items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
			}  
		   // $items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        }
				
				if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
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
		   include('excel_list.php');
        }
		
		if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
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
			include('print_list.php');
        }
        include('inquiry_list.php');
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
		$checkAllowType = VehicleDB::getIsAllocation($assetscenter, $assetunit);
		$allocation = 1;
        $items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        //$items = array();
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        // $Vehicle = VehicleDB::getDetailsById($id);
        include('dbtovariable.php');

        $id = $Vehicle['id'];
        include('approved_details.php');
        break;
    case 'findSearchType':
        $searchby = $_GET['searchby'];
        include('coldefine.php');
        $searchText = VehicleDB::getSearchText($column);
        ?>
        <input list="searchs" name="search">
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
        $items = VehicleDB::getApprovedConfirmedItems();
        include('approve_items_for_disposal_list.php');
        break;
    case 'Select_Items_For_Modifications':
	
        $assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : "");
        $assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : "");
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
        $mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
		setcookie('catalogueno', $catalogueno);
        setcookie('searchby', $searchby);
        setcookie('search', $search);
		
        $Items = array();
        if ($_POST) {
		    $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
        }
        $slidebartype = 25;
		
        include('select_modification.php');
        break;
	case 'ModificationList':
        $id = $_GET['id'];
        $catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'];
        $search = $_COOKIE['search'];
		$Vehicle = VehicleDB::getDetailsById($id);

        include('dbtovariable.php');
        $id = $Vehicle['id'];
        $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
        $slidebartype = 25;
        include('add_modification.php');
        break;
	case 'SelectModificationSave':
        $id = $_POST['id'];
		if (isset($_POST['selectmodification'])) {
			$count = VehicleDB::ModificationAllows($id); }
        $catalogueno = $_COOKIE['catalogueno'];
        $searchby = $_COOKIE['searchby'];
        $search = $_COOKIE['search'];
        $Items = VehicleDB::getDisposalItems($catalogueno, $searchby, $search);
		$slidebartype = 25;
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::view_update($assetscenter, $assetunit);
        include('view_updates.php');
        break;	
    case 'viewDAM':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
		$damcomment = $_POST['damcomment'];
        $count = VehicleDB::view_dam($id, $login, $damcomment);
        break;	
	case 'upload_plan':
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
		
		if (isset($_POST['identificationno'])) {
            $identificationno = $_POST['identificationno'];
        } else if (isset($_GET['identificationno'])) {
            $identificationno = $_GET['identificationno'];
        } else {
            $identificationno = "";
        }

		$slidebartype = 4;
        $error = 0;
		$title = array("Upload - Vehicle Photo","Upload - Vehicle Photo","Upload - Vehicle Photo");
		//$Items = VehicleDB::getItemsNotApproved();
		$Items = VehicleDB::getItemsApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
		$row = VehicleDB::getpicById($id);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
       include('upload_plan.php');
        break;
	case 'upload':
		$id = $_POST['id'];
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
		if ($uploadOk == 1){
		$Filename=basename( $_FILES['Filename']['name']);
		if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
			//echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
			$error = 1;
			$count=VehicleDB::picpath($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 4;
		$title = array("Upload - Vehicle Photo","Upload - Vehicle Photo","Upload - Vehicle Photo");
		//$Items = VehicleDB::getItemsNotApproved();
		$Items = VehicleDB::getItemsApproved();
        $Items_Sub = VehicleDB::getItemsApproveRejected();
		$row = VehicleDB::getpicById($id);
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
        $searchText = VehicleDB::getSearchText($column);
        $items = VehicleDB::getInqDetails2($assetscenter, $assetunit);
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
        //$searchText = VehicleDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::getSummaryDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
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
        //$searchText = VehicleDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::getSummaryDetails2($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
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
        //$searchText = VehicleDB::getSearchText($column);
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::getSummaryDetails3($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('summary_list3.php');
        break;
   case 'List_summary4':
		$slidebartype = 30;
        $items = CatalogueDB::getCatalogueType(3);
		$exps = array();
		foreach ($items as $row) {
			$catalogueno = $row['catalogueno'];
			$cata = VehicleDB::get_catalogueno_summary($catalogueno);
			$exp = array($row['mainCategory'], $row['itemCategory'], $row['itemDescription'], $row['assetsno'], $row['catalogueno'], $cata['cnt'], $cata['tot']);  
			$exps[] = $exp;
			}
        include('summary_list4.php');
        break;
   case 'List_summary5':
		$slidebartype = 30;
        $items = CatalogueDB::getitemCategoryType(3);
		$exps = array();
		foreach ($items as $row) {
			$itemCategory = $row['itemCategory'];
			$cata = VehicleDB::get_itemCategory_summary($itemCategory);
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
        $items = CatalogueDB::getitemCategoryType(3);
		$exps = array();
		foreach ($items as $row) {
			$itemCategory = $row['itemCategory'];
			$cata = VehicleDB::get_itemCategory_summary_date($itemCategory, $receivedDate);
			$exp = array($row['mainCategory'], $row['itemCategory'], $row['newAssestno'], $row['assetsno'], $row['catalogueno'], $cata['cnt'], $cata['tot']); 
			$exps[] = $exp;
			}
        include('summary_list6.php');
        break;		
   case 'List_summary4_1':
		$slidebartype = 30;
		$exps = VehicleDB::get_catalogueno_summary_1();
        include('summary_list4_1.php');
        break;
   case 'List_summary5_1':
		$slidebartype = 30;
			$exps = VehicleDB::get_itemCategory_summary_1();
			//$exp = array($row['mainCategory'], $row['itemCategory'], $cata['cnt'], $cata['tot']);  
        include('summary_list5_1.php');
        break;
   case 'delete_not_confirm':
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
		if (isset($_POST['id'])) {
            $id = $_POST['id'];
			VehicleDB::deleteDetailsById($id);
        }
        include('coldefine.php');
        $searchText = VehicleDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = VehicleDB::getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('delete_not_confirm.php');
        break;
    case 'zero_value_list':
		$items = AssetsUnitDB::getFullList();
		$exps = array();
		foreach ($items as $row) {
			$assetunit = $row['unitName'];
			$type = ($row['report_received'] == '1' ? "Yes" : "");
			$lds = VehicleDB::zero_value_Records($assetunit);
			foreach ($lds as $ld) {
			$exp = array($row['centreName'], $row['unitName'], $ld['identificationno'], $ld['itemCategory'], $ld['itemDescription'], $ld['unitValue'], $type);  
			$exps[] = $exp;
			}
			}
        include('zero_value_list.php');
        break;
	case 'findmodelBybrand':
		$brand = $_GET['brand'];
		$exps = modelDB::getDetailsbrand($brand);
		echo json_encode( $exps );
        break;
    case 'mofifydata_grid':

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
        $searchText = VehicleDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);		
		$brandNames = brandDB::getFullDetails();
		$modleNames = array();
		$checkAllowType = VehicleDB::getIsAllocation($assetscenter, $assetunit);
        if ($disposal == 1) {
            $items = VehicleDB::getInqDisposalDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        } else {
            $items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
        }
        include('mofifydata_grid.php');
        break;
  case 'mofifydata_grid_save':
			$id = $_GET['id'];
			$engineno = $_GET['engineno'];
			$chessisno = $_GET['chessisno'];
			$brandName = $_GET['brandName'];
			$modleName = $_GET['modleName'];
			$armyno = $_GET['armyno'];
			$purchasedDate = $_GET['purchasedDate'];
			$receivedDate = $_GET['receivedDate'];
			$unitValue = $_GET['unitValue'];
			$presentLocation = $_GET['presentLocation'];
			$natureOwnership = $_GET['natureOwnership'];
			$saveCount = VehicleDB::mofifydata_grid_save($id, $engineno, $chessisno, $brandName, $modleName, $armyno, $purchasedDate, $receivedDate, $unitValue, $presentLocation, $natureOwnership);
		echo $saveCount;
		break;
    case 'tree_list':
        $slidebartype = 26;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list.php');
        break;
    case 'tree_list_2':
			if (isset($_GET['unit'])) {
			$assetunit = $_GET['unit'];
				$title = 'Vehicle Details List - '.$assetunit;
			} else {
				$title = 'Vehicle Details List';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if ($id == 1){
				$exps = VehicleDB::get_catalogueno_summary_1();
				$title = 'Vehicle Details Full List';
			} else if ($id == 5 || $id == 2) {
				$exps = VehicleDB::get_catalogueno_summary_2(1, $assetunit);	
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$exps = VehicleDB::get_catalogueno_summary_2(2, $assetunit);
			}
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list_2.php');
        break;
    case 'tree_list_2_1':
			$items = AssetsUnitDB::getFullListbyProtocol();
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = VehicleDB::get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Vehicle Details - '.$_GET['itemDescription'];
				include('tree_list_2_1.php');
			} else if ($id == 5 || $id == 2) {
				$unit = $_GET['assetunit'];
				$exps = VehicleDB::get_catalogueno_summary_2_unit(1, $unit, $catalogueno);
				$title = 'Vehicle Details - '.$unit.' - '.$_GET['itemDescription'];
				include('tree_list_2_1.php');
			} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
				$unit = $_GET['assetunit'];
				$exps = VehicleDB::get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Vehicle Details - '.$unit.' - '.$_GET['itemDescription'];
				include('tree_list_2_2.php');
			} else if ($id == 10) {	
				$identificationno = $_GET['identificationno'];
				$Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
				include('dbtovariable.php');
				$id = $Vehicle['id'];
				$damcomment = $Vehicle['damcomment'];
				$title = $identificationno;
				include('tree_list_2_3.php');
			}
        break;
    case 'getDetailsUnit':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = VehicleDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
		break;
    case 'List_summary_tree':
        $slidebartype = 27;
		$items = CatalogueDB::getCatalogue_Tree(3);
        include('summary_list_tree.php');
        break;
    case 'getDetailsUnitbyCategory':	
		// if (isset($_GET['category'])) {
			 $itemDescription = $_GET['category'];
			 $res = $_GET['res'];
			 if ($res == 'x') { $items = VehicleDB::getSummaryDetailsCategory($itemDescription); }
			 if ($res == 'y') { $items = VehicleDB::getSummaryDetailsCategory2($itemDescription); } 
		//} 
		echo json_encode($items);
		break;
    case 'armyno_duplicates':
	        $items = VehicleDB::armyno_duplicates();
        include('armyno_duplicates.php');
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
			VehicleDB::deleteDetailsById($id);
        }
		
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$items = VehicleDB::getDetailsUnitAll($assetunit);
        include('delete_all_items.php');
        break;
   case 'delete_all_item':
		 $assetunit = $_GET['unit'];
		 $count = VehicleDB::deleteDetailsAll($assetunit);
		 echo json_encode($count);
         break;	
    case 'ledgerformat':
        $slidebartype = 5;
		$items = VehicleDB::getFullDetails_ledger(); 
        include('ledgerformat.php');
        break;
    case 'ledgerformatdata':	
		$items = VehicleDB::getFullDetails_ledger(); 
		echo json_encode($items);
		break;	
  case 'min_max_find':
		$catalogueno = $_GET['catalogueno'];
		 $exps = CatalogueDB::getcatlogDetailByCatalogueno($catalogueno);
		echo json_encode( $exps );
		break;	
    case 'List_summary_tree_2':
			if (isset($_GET['unit'])) {
			$assetunit = $_GET['unit'];
				$title = 'Vehicle Details - '.$assetunit;
			} else {
				$title = 'Vehicle Details';
			}
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			$items = CatalogueDB::getCatalogue_Tree(3);
			if ($id == 1){
				$exps = VehicleDB::get_catalogueno_summary_1();
				$title = 'Vehicle Details';
				include('summary_list_tree_2.php');
			} else if ($id == 2) {
				$exps = VehicleDB::get_catalogueno_unit_summary_2(1, $assetunit);	
				include('summary_list_tree_2.php');
			} else if ($id == 3) {
				$exps = VehicleDB::get_catalogueno_unit_summary_2(2, $assetunit);
				include('summary_list_tree_2.php');
			} else if ($id == 4) {
				$exps = VehicleDB::get_catalogueno_unit_summary_3(3, $assetunit);
				include('List_summary_tree_2_1.php');
			} else if ($id == 0) {
				 include('summary_list_tree_2.php');
			}
        break;	
    case 'List_summary_tree_2_1':
			$items = CatalogueDB::getCatalogue_Tree(3);
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			if ($id == 1){
				$exps = VehicleDB::get_catalogueno_summary_1_unit($catalogueno);
				$title = 'Vehicle Details - '.$_GET['itemDescription'];
				include('List_summary_tree_2_1.php');
			} else if ($id == 2) {
				$unit = $_GET['assetunit'];
				$exps = VehicleDB::get_catalogueno_summary_2_unit(2, $unit, $catalogueno);
				$title = 'Vehicle Details - '.$unit.' - '.$_GET['itemDescription'];
				include('List_summary_tree_2_2.php');
			} else if ($id == 3) {	
				$identificationno = $_GET['identificationno'];
				$Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
				include('dbtovariable.php');
				$id = $Vehicle['id'];
				$damcomment = $Vehicle['damcomment'];
				$title = $identificationno;
				include('List_summary_tree_2_3.php');
			}
        break;
    case 'ca_no_err_list':
        $items = VehicleDB::ca_no_err_list();
		include('ca_no_err_list.php');
        break;
    case 'List_loss':
        $slidebartype = 32;
        include('startpage.php');
        break;
    case 'Select_Items_For_loss':		
        $per_page=10000;
/* 		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1; */
		$items = VehicleDB::getFullDetails();
		//$items = VehicleDB::getPagingDetails($start_from, $per_page);
		//$total_records = VehicleDB::countTotalRecords();
		//$total_pages = ceil($total_records / $per_page);
		include('loss_select_list.php');
        break;
   case 'loss_select_save':
		 $id = $_GET['id'];
		 $selectLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_select_save($id, $selectLoss, $login);
		 echo json_encode($items);
         break;
    case 'Selected_Items_For_loss':		
		$items = VehicleDB::Selected_Items_For_loss();
		include('Selected_Items_For_loss.php');
        break;
    case 'Confirm_Items_For_loss':		
		$items = VehicleDB::Selected_Items_For_Confirm_loss();
		include('Confirm_Items_For_loss.php');
        break;
   case 'loss_confirm_save':
		 $id = $_GET['id'];
		 $confirmLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_confirm_save($id, $confirmLoss, $login);
		 echo json_encode($items);
         break;	
   case 'loss_reject_save':
		 $id = $_GET['id'];
		 $items = VehicleDB::loss_reject_save($id);
		 echo json_encode($items);
         break;
    case 'approve_Items_For_loss':		
		$items = VehicleDB::approve_Items_For_loss();
		include('approve_Items_For_loss.php');
        break;
   case 'loss_approve_save':
		 $id = $_GET['id'];
		 $ApprovedLoss = $_GET['ApprovedLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_approve_save($id, $ApprovedLoss, $login);
		 echo json_encode($items);
         break;	
    case 'loss_List':		
		$items = VehicleDB::getDetails_lost();
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
        $items = VehicleDB::Loss_Inquiry($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		include('loss_list_inquiry.php');
        break;
    case 'add_loss_details':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        include('dbtovariable.php');
        $id = $Vehicle['id'];
		$damcomment = $Vehicle['damcomment'];
		$lossedDate = $Vehicle['lossedDate'];
		$lossedReason = $Vehicle['lossedReason'];
		$row = VehicleDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        include('add_loss_details.php');
        break;	
    case 'save_loss_details':
        $id = $_POST['id'];
        $lossedDate = $_POST['lossedDate'];
		$lossedReason = $_POST['lossedReason'];
        $count = VehicleDB::save_loss_details($id, $lossedDate, $lossedReason);
        break;
    case 'display_loss_details':
		$identificationno = $_GET['identificationno'];
        $slidebartype = 0;
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        include('dbtovariable.php');
        $id = $Vehicle['id'];
		$damcomment = $Vehicle['damcomment'];
		$lossedDate = $Vehicle['lossedDate'];
		$lossedReason = $Vehicle['lossedReason'];
		$row = VehicleDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
		$lossedDate = $Vehicle['lossedDate'];
		$lossedReason = $Vehicle['lossedReason'];
        include('display_loss_details.php');
        break;
    case 'min_max_values':
        $items = VehicleDB::min_max_values();
		include('min_max_values.php');
        break;
    case 'List_Details_photo':
		$per_page=100;
		if (isset($_GET['page1'])) {
			$page1 = $_GET['page1'];
			} else {
			$page1=1;
		}		
		$start_from = ($page1-1) * $per_page;
		$i = $start_from + 1;
		$items = VehicleDB::getPagingDetails($start_from, $per_page);
		$total_records = VehicleDB::countTotalRecords();
		$total_pages = ceil($total_records / $per_page);
        include('full_list_photo.php');
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::record_status($assetscenter, $assetunit);
        include('record_status.php');
        break;	
    case 'board_report_start':
        $slidebartype = 0;
		$filename = "";
		$error = board_reportDB::getHasRecord($assetscenter, $assetunit, $currentYear);
		if ( $error > 0){
			$filename = board_reportDB::getassetpath("vehicle_path", $assetunit, $currentYear);
			$error = ($filename == "" ? 0 : 1); 
		} else {
			$count = board_reportDB::addRecord($assetscenter, $assetunit, $currentYear);
			$error = 0;
		}
        $exps = board_reportDB::getUnitList_currentyear($assetunit, $currentYear);
		include('board_report_start.php');
        break;
    case 'board_report':
		$disposal = 0;
		$items = VehicleDB::getBoard_report($assetscenter, $assetunit);
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
		$filename = "../board_report/".$currentYear."-".$assetunit."-vehicle.pdf";
		$filename_des = "../board_report/".$currentYear."-".$assetunit."-vehicle_des.pdf";
		$filename_new = "../board_report/".$currentYear."-".$assetunit."-vehicle_new.pdf";
		$asset = "vehicle";
		$count = board_reportDB::updateRecord($asset, $filename, $assetunit, $currentYear);
		$delcount = board_report_summaryDB::deleteRecordsUnitYear($asset, $assetunit, $currentYear);
		include('print_list.php');
		$des_items = VehicleDB::getDisposalDetails_year($assetunit, $currentYear);
        include('print_disposal.php');
        $new_items = VehicleDB::getNewDetails_year($assetunit, $currentYear);
        include('print_new_items.php');
		$count = VehicleDB::add_Board_report($assetunit);
		foreach ($count as $row) {
			$disposal = VehicleDB::add_Board_report_disposal($assetunit, $currentYear, $row['catalogueno']);
			$newitems = VehicleDB::add_Board_report_new($assetunit, $currentYear, $row['catalogueno']);
			//$count = board_report_summaryDB::add_Board_report($assetunit, $currentYear, $asset, $row['catalogueno'], $row['cnt'], $row['total'], serialize($row['ids_array']), $disposal['cnt'], $disposal['total'], serialize($disposal['ids_array']), $newitems['cnt'], $newitems['total'], serialize($newitems['ids_array']));
			$count = board_report_summaryDB::add_Board_report($assetunit, $currentYear, $asset, $row['catalogueno'], $row['cnt'], $row['total'], $row['ids_array'], $disposal['cnt'], $disposal['total'], $disposal['ids_array'], $newitems['cnt'], $newitems['total'], $newitems['ids_array']);
		} 
        break;
    case 'board_report_history':
        $slidebartype = 0;
        $exps = board_reportDB::getUnitList($assetunit);
		include('board_report_history.php');
        break;		
    case 'select_items_for_send_ordinance':		
		$items = VehicleDB::get_send_ordinance();
		$ordinance = AssetsUnitDB::getOrdince($assetunit);
		include('select_items_for_send_ordinance.php');
        break;
	case 'send_ordinance_save':
		 $id = $_GET['id'];
		 $ordinance_send_date = $_GET['ordinance_send_date'];
		 $selectLoss = $_GET['selectLoss'];
		 $ordinance = $_GET['ordinance'];
		 $items = VehicleDB::send_ordinance_save($id, $selectLoss, $ordinance_send_date, $ordinance);
		 echo json_encode($items);
		 break;	
    case 'Receive_Condemned_Goods':
         	if (isset($_GET['unit'])) {
				$assetunit = $_GET['unit'];
				$title = 'Plant & Machinery Receive Condemned Goods - '.$assetunit;
				$exps = VehicleDB::get_receive_ordinance($assetunit);
			} else {
				$title = 'Plant & Machinery Receive Condemned Goods';
				$assetunit = "";
			}
/* 			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if ($id == 1){
				$exps = PlantMacDB::get_receive_ordinance($assetunit);
			} */ 
		$ordinance = $_SESSION['SESS_PLACE'];
		$items = AssetsUnitDB::getFullListbyProtocol_ord($ordinance);
		$slidebartype = 33;
        include('receive_condemned_goods.php');
		break;
	case 'receive_ordinance_save':
		 $id = $_GET['id'];
		 $ordinance_receive_date = $_GET['ordinance_receive_date'];
		 $selectLoss = $_GET['selectLoss'];
		 $items = VehicleDB::receive_ordinance_save($id, $selectLoss, $ordinance_receive_date);
		 echo json_encode($items);
		 break;
    case 'ordinance_received_details':
         	if (isset($_GET['delete'])) {
				$id = $_GET['tid'];
				$ordinance_receive_date = "";
				$selectLoss = 0;
				$items = VehicleDB::receive_ordinance_save($id, $selectLoss, $ordinance_receive_date);	
			}
			if (isset($_GET['unit'])) {
				$unit = $_GET['unit'];
				$title = 'Plant & Machinery Received Condemn Goods - '.$unit;
				$ordinance = $_SESSION['SESS_PLACE'];
				$id = $_GET['id'];
				$exps = VehicleDB::ordinance_received_details($ordinance, $unit, $id);
			} else {
				$title = 'Plant & Machinery Received Condemn Goods';
				$assetunit = "";
			}
		$ordinance = $_SESSION['SESS_PLACE'];
		$items = AssetsUnitDB::getFullListbyProtocol_ord($ordinance);
		//$slidebartype = 34;
        include('ordinance_received_details.php');
		break;
   case 'List_summary_age':
		if (isset($_POST['inputField1'])) {
            $receivedDate = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $receivedDate = $_GET['inputField1'];
        } else {
            $receivedDate = date("Y-m-d");
        }
		$slidebartype = 30;
		$date2 = $receivedDate;
		//
	    $date5 = date('Y-m-d', strtotime($date2 . ' -5 year'));
	    $items5 = VehicleDB::getSummaryDetails_age($date5, $date2);
		//
        $date51 = date('Y-m-d', strtotime($date5 . ' -1 day'));
		$date10 = date('Y-m-d', strtotime($date5 . ' -5 year'));
		$items10 = VehicleDB::getSummaryDetails_age($date10, $date51);
		//
        $date101 = date('Y-m-d', strtotime($date10 . ' -1 day'));
		$date15 = date('Y-m-d', strtotime($date10 . ' -5 year'));
		$items15 = VehicleDB::getSummaryDetails_age($date15, $date101);	
		//
        $date151 = date('Y-m-d', strtotime($date15 . ' -1 day'));
		$date20 = strtotime('1970-01-01');
		$items20 = VehicleDB::getSummaryDetails_age($date20, $date151);		
		include('summary_list_age.php');
        break;
    case 'List_summary_age_perid':
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['date1'])) {$date1 = $_GET['date1'];}
			if (isset($_GET['date2'])) {$date2 = $_GET['date2'];}
			$items = VehicleDB::getSummaryDetails_age_perid($date2, $date1);
			if ($id == 1){
				$title = 'Vehicle Details Below 5 Years (' . $date2 .' to '. $date1. ')';
			} else if ($id == 2) {
				$title = 'Vehicle Details Between 5 ~ 10 Years (' . $date2 .' to '. $date1. ')';
			} else if ($id == 3) {	
				$title = 'Vehicle Details  Between 10 ~ 15 Years (' . $date2 .' to '. $date1. ')';
			} else if ($id == 4) {	
				$title = 'Vehicle Details Above 15 Years (' . $date2 .' to '. $date1. ')';
			}
			$slidebartype = 30;
			include('List_summary_age_perid.php');
        break;
    case 'List_summary_age_perid_unit_item':
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['date1'])) {$date1 = $_GET['date1'];}
			if (isset($_GET['date2'])) {$date2 = $_GET['date2'];}
			if (isset($_GET['assetunit'])) {$assetunit = $_GET['assetunit'];}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			$items = VehicleDB::getSummaryDetails_age_perid_unit_item($date1, $date2, $assetunit, $catalogueno);
			$itemDescription = CatalogueDB::getcatlogDescriptionByCatalogueno($catalogueno);
			if ($id == 1){
				$title = 'Vehicle Details Below 5 Years (' . $date2 .' to '. $date1. ') '. 'Unit :' . $assetunit . ' , Item : ' . $itemDescription;
			} else if ($id == 2) {
				$title = 'Vehicle Details Between 5 ~ 10 Years (' . $date2 .' to '. $date1. ') '. 'Unit :' . $assetunit . ' , Item : ' . $itemDescription;
			} else if ($id == 3) {	
				$title = 'Vehicle Details  Between 10 ~ 15 Years (' . $date2 .' to '. $date1. ') '. 'Unit :' . $assetunit . ' , Item : ' . $itemDescription;
			} else if ($id == 4) {	
				$title = 'Vehicle Details Above 15 Years (' . $date2 .' to '. $date1. ') '. 'Unit :' . $assetunit . ' , Item : ' . $itemDescription;
			}
			$slidebartype = 30;
			include('List_summary_age_perid_unit_item.php');
        break;
    case 'List_summary_age_perid_item':
			if (isset($_GET['id'])) {$id = $_GET['id'];} else {$id = 0;}
			if (isset($_GET['date1'])) {$date1 = $_GET['date1'];}
			if (isset($_GET['date2'])) {$date2 = $_GET['date2'];}
			if (isset($_GET['catalogueno'])) {$catalogueno = $_GET['catalogueno'];}
			$items = VehicleDB::getSummaryDetails_age_perid_item($date1, $date2, $catalogueno);
			$itemDescription = CatalogueDB::getcatlogDescriptionByCatalogueno($catalogueno);
			if ($id == 1){
				$title = 'Vehicle Details Below 5 Years (' . $date2 .' to '. $date1. ') '. ' Item : ' . $itemDescription;
			} else if ($id == 2) {
				$title = 'Vehicle Details Between 5 ~ 10 Years (' . $date2 .' to '. $date1. ') '. ' Item : ' . $itemDescription;
			} else if ($id == 3) {	
				$title = 'Vehicle Details  Between 10 ~ 15 Years (' . $date2 .' to '. $date1. ') '. ' Item : ' . $itemDescription;
			} else if ($id == 4) {	
				$title = 'Vehicle Details Above 15 Years (' . $date2 .' to '. $date1. ') '. ' Item : ' . $itemDescription;
			}
			$slidebartype = 30;
			include('List_summary_age_perid_item.php');
        break;
   case 'monthly_changes':
		 if (isset($_POST['receivedDate'])) {
            $receivedDate = $_POST['receivedDate'];
        } else if (isset($_GET['receivedDate'])) {
            $receivedDate = $_GET['receivedDate'];
        } else {
            $receivedDate = "";
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
		$monthName = $dateObj->format('F'); // March
		$monthName = (isset($_POST['ignore_month'])) ? '' : $dateObj->format('F');  // March
		if ($receivedDate <> "") {
			$title2 = 'New Items - ' . $year . ' - ' . $monthName;
			$title_dis = 'Dispisal Items - ' . $year . ' - ' . $monthName;
		} else {
			$title2 = "New Items";
			$title_dis = "Dispisal Items";
		}
		$exps = VehicleDB::monthly_changes($year, $month, $ignore_month);
		$exps_dis = VehicleDB::monthly_changes_dis($year, $month, $ignore_month);
        include('monthly_changes.php');
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
			$exps = VehicleDB::getDisposalDetails();
		} else {	
			$exps = VehicleDB::getDisposalDetailsUnit($unit, $type);
		} 
        include('disposal_inquiry_tree.php');
        break;
    case 'display_vehicle':
        $slidebartype = 34;
        include('startpage.php');
        break;
    case 'Select_Items_For_displayvehicle':		
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
		$items = VehicleDB::getFullDetails_unit($assetunit);
		include('displayvehicle_select_list.php');
        break;
   case 'displayvehicle_select_save':
		 $id = $_GET['id'];
		 $selectLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_select_save($id, $selectLoss, $login);
		 echo json_encode($items);
         break;
    case 'Selected_Items_For_displayvehicle':		
		$items = VehicleDB::Selected_Items_For_displayvehicle();
		include('Selected_Items_For_displayvehicle.php');
        break;
    case 'Confirm_Items_For_displayvehicle':		
		$items = VehicleDB::Selected_Items_For_Confirm_displayvehicle();
		include('Confirm_Items_For_displayvehicle.php');
        break;
   case 'displayvehicle_confirm_save':
		 $id = $_GET['id'];
		 $confirmLoss = $_GET['selectLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_confirm_save($id, $confirmLoss, $login);
		 echo json_encode($items);
         break;	
   case 'displayvehicle_reject_save':
		 $id = $_GET['id'];
		 $items = VehicleDB::loss_reject_save($id);
		 echo json_encode($items);
         break;
    case 'approve_Items_For_displayvehicle':		
		$items = VehicleDB::approve_Items_For_displayvehicle();
		include('approve_Items_For_displayvehicle.php');
        break;
   case 'displayvehicle_approve_save':
		 $id = $_GET['id'];
		 $ApprovedLoss = $_GET['ApprovedLoss'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::loss_approve_save($id, $ApprovedLoss, $login);
		 echo json_encode($items);
         break;	
    case 'displayvehicle_List':		
		$items = VehicleDB::getDetails_displayvehicle();
		include('paging_lost_list_headfix.php');
        break;
    case 'displayvehicle_List_Inquiry':
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
        $items = VehicleDB::displayvehicle_Inquiry($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		include('displayvehicle_list_inquiry.php');
        break;
    case 'add_displayvehicle_details':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 0;
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        include('dbtovariable.php');
        $id = $Vehicle['id'];
		$damcomment = $Vehicle['damcomment'];
		$displayvehicleedDate = $Vehicle['displayvehicleedDate'];
		$displayvehicleedReason = $Vehicle['displayvehicleedReason'];
		$row = VehicleDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        include('add_displayvehicle_details.php');
        break;	
    case 'save_displayvehicle_details':
        $id = $_POST['id'];
        $displayvehicleedDate = $_POST['displayvehicleedDate'];
		$displayvehicleedReason = $_POST['displayvehicleedReason'];
        $count = VehicleDB::save_displayvehicle_details($id, $displayvehicleedDate, $displayvehicleedReason);
        break;
    case 'display_displayvehicle_details':
		$identificationno = $_GET['identificationno'];
        $slidebartype = 0;
        $Vehicle = VehicleDB::getDetailsByIdentificationno($identificationno);
        include('dbtovariable.php');
        $id = $Vehicle['id'];
		$damcomment = $Vehicle['damcomment'];
		$displayvehicleedDate = $Vehicle['displayvehicleedDate'];
		$displayvehicleedReason = $Vehicle['displayvehicleedReason'];
		$row = VehicleDB::getpicById($identificationno);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
		$displayvehicleedDate = $Vehicle['displayvehicleedDate'];
		$displayvehicleedReason = $Vehicle['displayvehicleedReason'];
        include('display_displayvehicle_details.php');
        break;
    case 'List_transfer':
        $slidebartype = 35;
        include('startpage.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenterAll($assetscenter);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
  case 'transfer_selet_quick':
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
		$assetsCenters_all = AssetsCenterDB::getAssetsCentersAll();
		$assetunits_all = AssetsUnitDB::getAssetsUnitsByCenterAll($assetscenter);
        $items = VehicleDB::getInqDetailsforTransfer($assetscenter, $assetunit);
		include('add_transfer_selet_quick.php');
		break;
  case 'transfer_selet_quick_save':
			$id = $_GET['id'];
			$transferSelect = $_GET['transferSelect'];
			if ($transferSelect == 1) {
			$transferToCenter = $_GET['transferToCenter'];
			$transferToUnit = $_GET['transferToUnit'];
			$transferToDetails = "Bulk Transfer";
			$transferToDate = date("Y/m/d");
			} else {
			$transferToCenter = "";
			$transferToUnit = "";
			$transferToDetails = "";
			$transferToDate = "";				
			}
			$saveCount = VehicleDB::select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate);
		echo $saveCount;
		break;
    case 'add_details_transfer':
        if (isset($_POST['idTem'])) {
		///////////////////////
		$VehicleTem = VehicleDB::getDetailsById($_POST['idTem']);
		$assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $mainCategory = $VehicleTem['mainCategory'];
        $itemCategory = $VehicleTem['itemCategory'];
        $itemDescription = $VehicleTem['itemDescription'];
        $make = $VehicleTem['make'];
        $modle = $VehicleTem['modle'];
        $assetsno = $VehicleTem['assetsno'];
        $newAssestno = $VehicleTem['newAssestno'];
        $catalogueno = $VehicleTem['catalogueno'];
        $identificationnoTem = $VehicleTem['identificationno'];
        $engineno = strtoupper($VehicleTem['engineno']);
        $chessisno = strtoupper($VehicleTem['chessisno']);
        $yearManufacture = $VehicleTem['yearManufacture'];
        $ownerShip = strtoupper($VehicleTem['ownerShip']);
        $armyno = strtoupper($VehicleTem['armyno']);
        $civilno = strtoupper($VehicleTem['civilno']);
        $fuel = $VehicleTem['fuel'];
        $purchasedDate = $VehicleTem['purchasedDate'];
        $unitValue = $VehicleTem['unitValue'];
        $totalCost = 0;
        $horsePower = $VehicleTem['horsePower'];
        $tare = $VehicleTem['tare'];
        $presentLocation = $VehicleTem['presentLocation'];
        $receivedDate = $VehicleTem['receivedDate'];
        $Remarks = strtoupper($VehicleTem['Remarks']);
        $counterId = $_POST['counterId'];
        $identificationno = $_POST['identificationno'];
        //$id = $_POST['idTem'];
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
        $acquisitionInstitute = $VehicleTem['acquisitionInstitute'];
		$natureOwnership = strtoupper($VehicleTem['natureOwnership']);
		$brandName = $VehicleTem['brandName'];
		$modleName = $VehicleTem['modelName'];
		
        $validate->text('assetscenter', $assetscenter);
        $validate->text('assetunit', $assetunit);
        $validate->text('mainCategory', $mainCategory);
        $validate->text('itemCategory', $itemCategory);
        $validate->text('itemDescription', $itemDescription);
        //$validate->text('make', $make);
        //$validate->text('modle', $modle);
        $validate->text('assetsno', $assetsno);
        //$validate->text('newAssestno', $newAssestno);
        $validate->text('catalogueno', $catalogueno);
        $validate->text('identificationno', $identificationno);
        $validate->text('engineno', $engineno);
        $validate->text('chessisno', $chessisno);
        $validate->text('yearManufacture', $yearManufacture);
        //$validate->text('ownerShip', $ownerShip);
        $validate->text('armyno', $armyno);
        $validate->text('civilno', $civilno);
        $validate->text('fuel', $fuel);
        //$validate->passeddate('purchasedDate', $purchasedDate);
        $validate->number('unitValue', $unitValue);
        //$validate->number('totalCost', $totalCost);
        //$validate->number('horsePower', $horsePower);
        //$validate->number('tare', $tare);
        $validate->text('presentLocation', $presentLocation);
        //$validate->passeddate('receivedDate', $receivedDate);
        //$validate->text('Remarks', $Remarks);


        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$mainCategorys = ClassificationListDB::getMainCategory($type);
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno($catalogueno, $type);
        $makes = ClassificationListDB::getMakeByDescription($itemDescription, $type);
        $models = ClassificationListDB::getModleByMake($make, $type);
        $institutes = InstituteDB::getFullDetails();
		$modleNames = array();
		$brandNames = brandDB::getFullDetails();

// Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            $vehicle = new Vehicle($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $make, $modle, $assetsno, $newAssestno, $catalogueno, $identificationno, $engineno, $chessisno, $yearManufacture, $ownerShip, $armyno, $civilno, $fuel, $purchasedDate, $unitValue, $totalCost, $horsePower, $tare, $presentLocation, $receivedDate, $Remarks, $counterId, $acquisitionInstitute, $natureOwnership);
            $count = VehicleDB::getHasRecord($vehicle);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = VehicleDB::addVehicle($vehicle);
                if ($saveCount == 1) {
                    $error = 1;
                    $id = 0;
					$count = VehicleDB::Savemakemodel($brandName, $modleName, $identificationno);
					$count = VehicleDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
					$count = VehicleDB::Save_psos_allow(3, $itemCategory, $identificationno);
					$count = VehicleDB::MarkasTransfer($identificationnoTem, $assetunit, $VehicleTem['assetscenter'], $VehicleTem['assetunit'], $identificationno, $_SESSION['SESS_LOGIN']);
					$count = VehicleDB::Save_cigas($VehicleTem['cigas_assetno'], $VehicleTem['cigas_idno'], $VehicleTem['cigas_transferdate'], $identificationno);
					if ($proto['protocollevel1'] == 25) {
						$count = VehicleDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					} else {
						$count = VehicleDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
					}
				} else {
                    $error = 5;
                }
            }
        }
		 }
		///////////////////////
		$slidebartype = 5;
        $error = 0;
        $id = (isset($_GET['id'])? $_GET['id']: 0);
		//isset($_POST['assetsno']) ? $_POST['assetsno'] : ""
		//$identificationno = $_GET['identificationno'];
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        $Vehicle = VehicleDB::getDetailsById($id);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        //$presentLocations = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$presentLocations = present_locationDB::getDetailsByUnit($assetunit);
		$Items_Sub_2 = VehicleDB::getItemsNotTransfered($assetunit);
        if (isset($_POST['idTem'])) {
			include('startpage.php');
		} else {
			include('add_details_transfer.php');
		}
        break;
    case 'generateCode_Ajax':
        $identificationno = "";
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_GET["assetunit"]);
        $counterIdD = VehicleDB::getCounterId($_GET["assetunit"]);
		$counterIdD++;
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_GET["assetsno"] . "/" . $_GET["catalogueno"] . "/" . $counterId;
		$counterdetails= array($counterIdD, $identificationno);
		echo json_encode($counterdetails);
        break;
    case 'Select_Items_For_Disposal_quick':		
        $items = VehicleDB::getFullDetails();
		include('Select_Items_For_Disposal_quick.php');
        break;
   case 'Disposal_select_save_quick':
		 $id = $_GET['id'];
		 $selectDisposal = $_GET['selectDisposal'];
		 $login = $_SESSION['SESS_LOGIN'];
		 $items = VehicleDB::disposal_select_save_quick($id, $selectDisposal, $login);
		 echo json_encode($items);
         break;
    case 'add_disposal_details_quick':		
		if (isset($_POST['save_all']))
		{
		$count = VehicleDB::disposal_details_save_quick_all($assetunit, $_POST['disposedDate'], $_POST['disposedReason'], $_POST['condemnation']);
		}
		$items = VehicleDB::getSelectedDisposalItems();
		include('add_disposal_details_quick.php');
        break;
    case 'disposal_details_save_quick':		
		 $id = $_GET['id'];
		 $disposedDate = $_GET['disposedDate'];
		 $disposedReason = $_GET['disposedReason'];
		 $condemnation = $_GET['condemnation'];
		 $items = VehicleDB::disposal_details_save_quick($id, $disposedDate, $disposedReason, $condemnation);
		 echo json_encode($items);
        break;
    case 'confirm_items_for_disposal_quick':
        $items = VehicleDB::getToConfirmDisposalItems();
		//$items = VehicleDB::getToConfirmDisposalItemsSort();
        include('confirm_items_for_disposal_quick.php');
        break;
    case 'ConfirmDisposalSave_quick':
        $id = $_GET['id'];
        $confirmDisposal = 1;
        $login = $_SESSION['SESS_LOGIN'];
        $items = VehicleDB::ConfirmDisposalSave($id, $confirmDisposal, $login);
		echo json_encode($items);
        break;
	case 'ConfirmDisposalReject_quick':
        $id = $_GET['id'];
        $items = VehicleDB::ConfirmDisposalReject($id);
		echo json_encode($items);
        break;
    case 'Selected_List_For_Disposal':
        $Items = VehicleDB::getSelectedDisposalItems();
        include('Selected_List_For_Disposal.php');
        break;
    case 'Confirmed_List_For_Disposal':
        $Items = VehicleDB::Confirmed_For_Disposal();
        include('Confirmed_List_For_Disposal.php');
        break;
    case 'upload_vreport':
        if (isset($_POST['del'])) {
            $id = $_POST['id'];
			$identificationno = $_POST['identificationno'];
			$target = "";
			$count=VehicleDB::put_vreport_path($id, $target);
		} else {
		
		if (isset($_POST['id'])) {
            $id = $_POST['id'];
        } else if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id = 0;
        }
		
		if (isset($_POST['identificationno'])) {
            $identificationno = $_POST['identificationno'];
        } else if (isset($_GET['identificationno'])) {
            $identificationno = $_GET['identificationno'];
        } else {
            $identificationno = "";
        }
		}
		$slidebartype = 36;
        $error = 0;
		$title = array("Upload - Valuation Report","Upload - Valuation Report","Upload - Valuation Report");
		$Items = VehicleDB::getFullDetails();
		$row = VehicleDB::getvreportById($id);
		$vreport_path = isset($row['vreport']) ? $row['vreport'] : "";
        include('upload_vreport.php');
        break;
	case 'upload_vreport_save':
		$id = $_POST['id'];
		$identificationno = $_POST['identificationno'];
		$target = preg_replace('/\s+/', '', $place);
		$target = "vreport/".$target."/";
		$error = 1;
		$uploadOk = 1;
		if (!file_exists($target)) {
			mkdir($target, 0777, true);
		}
		//$target = $target . basename( $_FILES['Filename']['name']);
		$target = $target . $id.".pdf";
		// Check if file already exists
/* 		if (file_exists($target)) {
			$error = 4;
			//echo "Sorry, file already exists.";
			$uploadOk = 0;
		} */
		// Check file size
		if ($_FILES["Filename"]["size"] > 500000) {
			$error = 5;
			//echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		$imageFileType = pathinfo($target,PATHINFO_EXTENSION);
		// Allow certain file formats
		if($imageFileType != "pdf" && $imageFileType != "PDF") {
			//echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
			$error = 6;
		}
		if ($uploadOk == 1){
		$Filename=basename( $_FILES['Filename']['name']);
		if(move_uploaded_file($_FILES['Filename']['tmp_name'], $target)) {
			//echo "The file ". basename( $_FILES['Filename']['name']). " has been uploaded, and your information has been added to the directory";
			$error = 1;
			$count=VehicleDB::put_vreport_path($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 36;
		$title = array("Upload - Valuation Report","Upload - Valuation Report","Upload - Valuation Report");
		$Items = VehicleDB::getFullDetails();
		$row = VehicleDB::getvreportById($id);
		$vreport_path = isset($row['vreport']) ? $row['vreport'] : "";
        include('upload_vreport.php');
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
		$items = VehicleDB::board_report_summary_view_details($_GET['id']);
		include('board_report_summary_view_details.php');
        break;
    case 'board_report_summary_view_trans':
        $slidebartype = 0;
		$items = board_report_summaryDB::getFullDetails($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_summary_view_trans.php');
        break;
    case 'tender_details':
        $slidebartype = 37;
/* 		$o=new tender_vehicledetails();
		$content=$o->find();
		include('tender_details.php'); */
		include('startpage.php');
        break;
    case 'tender_full_list':
        $slidebartype = 37;
 		$o=new tender_vehicledetails();
		$content=$o->find();
		include('tender_full_list.php'); 
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = VehicleDB::allocation_list($assetunit);
        include('allocation_list.php');
        break;
    case 'inquiry_summary_list':
        $assetscenter = $_POST['assetscenter'] ?? "";
        $assetunit = $_POST['assetunit'] ?? "";
        $searchby = $_POST['searchby'] ?? "";
        $search = $_POST['search'] ?? "";
        $inputField1 = $_POST['inputField1'] ?? "";
        $inputField2 = $_POST['inputField2'] ?? "";
        if(isset($_POST['searchby'])) {
            include('coldefine.php');
            $searchText = VehicleDB::getSearchText($column);
        }

        $items = array();
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $checkAllowType = VehicleDB::getIsAllocation($assetscenter, $assetunit);
         
        if ( isset($_POST['searchby'])){
            if ($disposal == 1) {
                $items = VehicleDB::getInqDisposalDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
            } else {
                if ($search <> "") {
                    $items = VehicleDB::getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
                } else {
                    $items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
                }  
            // $items = VehicleDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation);
            }
        }
        
				
		if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
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
		   include('excel_list.php');
        }
		
		if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
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
			include('print_list.php');
        }
        include('inquiry_summary_list.php');
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
  case 'getcatalogueDetails':
		$catalogueno = $_GET['catalogueno'];
		$exps = CatalogueDB::getcatlogDetailByCatalogueno($catalogueno);
		echo json_encode( $exps );
		break;
	case 'showSidebar':
		switch ($_GET['id']) {
		case 1:
			 $items = VehicleDB::getItemsNotApproved_unit($assetunit, $_GET['fundtype']);
			break;
		case 2:
			 $items = VehicleDB::getItemsApproveRejected_unit($assetunit, $_GET['fundtype']);	
			break;
		case 3:
			 $items = VehicleDB::getItemsNotTransfered_unit($assetunit, $_GET['fundtype']);
			break;
		}
		echo json_encode( $items );
		break;
    case 'tender_summary_list':
        $slidebartype = 37;
 		$items = tender_vehicledetails::tender_summary_list();
		include('tender_summary_list.php'); 
        break;
    case 'tender_summary_ordinance':
        $slidebartype = 37;
 		$items = tender_vehicledetails::tender_summary_ordinance();
		include('tender_summary_list_ordinance.php'); 
        break;
    case 'search_army_number':
        if (isset($_POST['vehicleno'])) {
            $vehicleno = $_POST['vehicleno'];		
			$o=new tender_vehicledetails();
			$content=$o->search_army_number($vehicleno);
		} else {
			 $vehicleno = "";
		}
		include('search_army_number.php'); 
        break;
    case 'add_vehicle_repair':
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
		$v_repairtype = vehicle_repairtypeDB::getFullDetails();
		$items = VehicleDB::getFullDetails_unit($assetunit);
		include('add_vehicle_repair.php'); 
        break;
case 'add_vehicle_repair_record':
	$error = 0;
	$vehicle_id = $_POST['vehicle_id'];
	$armyno= $_POST['armyno'];
	$identificationno= $_POST['identificationno'];
	$r_date= $_POST['r_date'];
	$r_type= $_POST['r_type'];
	$r_desc= $_POST['r_desc'];
	$r_amount= $_POST['r_amount'];

	$count = vehicle_repair_detailsDB::getHasRecord($vehicle_id, $r_date, $r_type, $r_amount);
	if ($count > 0) {
		$error = 3;
	} else {
		$saveCount = vehicle_repair_detailsDB::addRecord($vehicle_id, $armyno, $identificationno, $r_date, $r_type, $r_desc, $r_amount);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;		
}
?>