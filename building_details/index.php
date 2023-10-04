<?php
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '2G');
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require('../model/province_db.php');
require('../model/province.php');
require('../model/district_db.php');
require('../model/district.php');
require('../model/dsdivision_db.php');
require('../model/dsdivision.php');
require('../model/gsdivision_db.php');
require('../model/gsdivision.php');
require('../model/buildingcategory_db.php');
require('../model/landcategory.php');
require('../model/building.php');
require('../model/building_db.php');
require('../model/institute_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/unitdetails_db.php');
require('../model/board_report_db.php');
require('../model/board_report_observations_db.php');

$page = 2;
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
$fields->addField('province');
$fields->addField('district');
$fields->addField('dsDivision');
$fields->addField('gsDivision');
$fields->addField('landName');
$fields->addField('ownerName');
$fields->addField('category');
$fields->addField('assetsno');
$fields->addField('buildingType');
$fields->addField('rentAndRate');
$fields->addField('natureOwnership');
$fields->addField('ownership');
$fields->addField('regOwnerName');
$fields->addField('classificationno');
$fields->addField('identificationno');
$fields->addField('buildingno');
$fields->addField('planno');
$fields->addField('plandate');
$fields->addField('areaMeasure');
$fields->addField('area', 'Sq m');
$fields->addField('feets', 'Sq ft');
$fields->addField('constructionCost');
$fields->addField('additionsValue');
$fields->addField('alterationValue');
$fields->addField('acquisitiondate');
$fields->addField('fundtype');
$fields->addField('remarks');
$fields->addField('counterId');
$fields->addField('acquisitionInstitute');
$fields->addField('refValue');

$slidebartype = 5;
$error = 0;
$exps = array();
$notapprived = "";
$notapprivedReason = "";



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
        $slidebartype = 5;
        include('startpage.php');
        break;
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'List_Building_Details':
        $items = BuildingDB::getFullDetails();
        include('full_list.php');
        break;
    case 'Add_Building_Details':
        $slidebartype = 3;
        $error = 0;
        $id = 0;
        setcookie('id', 0);
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        setcookie('assetsUnit', $assetunit);
        $province = "";
        $district = "";
        $dsDivision = "";
        $gsDivision = "";
        $landName = "";
        $ownerName = "";
        $category = "";
        $assetsno = "";
        $buildingType = "";
        $rentAndRate = "";
        $natureOwnership = "";
        $ownership = "";
        $regOwnerName = "";
        $classificationno = "";
        $identificationno = "";
        $buildingno = "";
        $planno = "";
        $plandate = "";
        $areaMeasure = "";
        $area = "";
        $feets = "";
        $constructionCost = "";
        $additionsValue = "";
        $alterationValue = "";
        $acquisitiondate = "";
        $fundtype = "";
		$remarks = "";
        $counterId = 0;
        $identificationnoTem = "";
        $acquisitionInstitute = "";
		$previousownership = "";
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $buildingCategorys = BuildingCategoryDB::getBuildingCategorys();
        $institutes = InstituteDB::getFullDetails();
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
		$Items_Sub_2 = BuildingDB::getItemsNotTransfered($assetunit);
        $refValue = "";
        include('add_building_details.php');
        break;
    case 'Add_Building_Details_ajax':
        $slidebartype = 3;
        $error = 0;
        $id = 0;
        setcookie('id', 0);
        $province = "";
        $district = "";
        $dsDivision = "";
        $gsDivision = "";
        $landName = "";
        $ownerName = "";
        $category = "";
        $assetsno = "";
        $buildingType = "";
        $rentAndRate = "";
        $natureOwnership = "";
        $ownership = "";
        $regOwnerName = "";
        $classificationno = "";
        $identificationno = "";
        $buildingno = "";
        $planno = "";
        $plandate = "";
        $areaMeasure = "";
        $area = "";
        $feets = "";
        $constructionCost = "";
        $additionsValue = "";
        $alterationValue = "";
        $acquisitiondate = "";
        $fundtype = "";
		$remarks = "";
        $counterId = 0;
        $identificationnoTem = "";
        $acquisitionInstitute = "";
		$previousownership = "";
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $buildingCategorys = BuildingCategoryDB::getBuildingCategorys();
        $institutes = InstituteDB::getFullDetails();
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        include('add_building_details_ajax.php');
        break;
    case 'findDistrictByProvince':
        $province = $_GET['province'];
        $districts = DistrictDB::getDistrictsByProvince($province);
        include('../view/finddistrictbyprovince.php');
        break;
    case 'findDistrictByProvince_Ajax':
        $province = $_GET['province'];
        $district = array();
		$districts = DistrictDB::getDistrictsByProvince($province);
		foreach ($districts as $unit) {
		$district[] = $unit->getName(); }
		echo json_encode( $district );
        break;
    case 'findDSByDistrict':
        $district = $_GET['district'];
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        include('../view/finddsbydistrict.php');
        setcookie('district', $district);
        break;
    case 'findDSByDistrict_Ajax':
        $district = $_GET['district'];
		$dsdivision =  array();
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        foreach ($dsdivisions as $unit) {
			$dsdivision[] = $unit->getName(); }
		echo json_encode( $dsdivision );
        break;
    case 'findGSByDS':
        $dsDivision = $_GET['dsDivision'];
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        include('../view/findgsbyds.php');
        break;
    case 'findGSByDS_Ajax':
        $dsDivision = $_GET['dsDivision'];
        $gsdivision =  array();
		$gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        foreach ($gsdivisions as $unit) {
			$gsdivision[] = $unit->getName(); }
		echo json_encode( $gsdivision );
        break;	
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
        $assetunit = "";
        setcookie('assetsUnit', "");
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
    case 'findAssetsnoByCategory':
        $category = $_GET['category'];
        //assetsno = "";
        $assetsnos = BuildingCategoryDB::getAssetsnoByCategory($category);
        setcookie('assetsno', $assetsnos->getId());
        include('../view/findassetsnobycategory.php');
        break;
	case 'findAssetsnoByCategory_Ajax':
        $category = $_GET['category'];
		$assetsno =  array();
        $assetsnos = BuildingCategoryDB::getAssetsnoByCategory($category);
        $assetsno[] = $assetsnos->getId();
		$assetsno[] = $assetsnos->getName();		
		echo json_encode( $assetsno );
        break;
    case 'findUnitConvertUnit':
        $areaMeasure = $_GET['areaMeasure'];
        include('../view/findunitconvertunitb.php');
        break;
    case 'findOwnership':
        setcookie('ownership', $_GET['ownership']);
        break;
    case 'findPresentUnitByUnit':
        setcookie('assetsUnit', $_GET['unit']);
        break;
    case 'generateCode':
        $_COOKIE["assetsUnit"] = $_COOKIE["assetsUnit"] ?? "";  
        $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
        $catalohuenos = DistrictDB::getCatlognoByDistrict(5, $_COOKIE["district"]);
        $catalohueno = ($_COOKIE["ownership"] == 'ARMY BUILDING' ? $catalohuenos->getId() : $catalohuenos->getName());
        if ($_COOKIE["id"] == 0) {
            $counterIdD = BuildingDB::getCounterId($_COOKIE["assetsUnit"]);
            $counterIdD++;
        } else {
            $counterIdD = $_COOKIE["counterID"];
        }
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $catalohueno . "/" . $counterId;
        setcookie('counterId', $counterIdD);
        echo $identificationno;
        break;
    case 'generateCode_Ajax':
        $identificationno = "";
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_GET["assetsUnit"]);
        $catalohuenos = DistrictDB::getCatlognoByDistrict(4, $_GET["district"]);
        $catalohueno = ($_GET["ownership"] == 'Army Land' ? $catalohuenos->getId() : $catalohuenos->getName());
        if ($_GET["id"] == 0) {
            $counterIdD = BuildingDB::getCounterId($_GET["assetsUnit"]);
            $counterIdD++;
        } else {
            $counterIdD = $_GET["counterID"];
        }
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_GET["assetsno"] . "/" . $catalohueno . "/" . $counterId;
        setcookie('counterID', intval($counterId));
		echo $identificationno;
        break;
    case 'Add_Building_Detail':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $dsDivision = $_POST['dsDivision'];
        $gsDivision = $_POST['gsDivision'];
        $landName = strtoupper($_POST['landName']);
        $ownerName = strtoupper($_POST['ownerName']);
        $category = $_POST['category'];
        $assetsno = $_POST['assetsno'];
        $buildingType = strtoupper($_POST['buildingType']);
        $rentAndRate = $_POST['rentAndRate'];
        $ownership = strtoupper($_POST['ownership']);
        $natureOwnership = strtoupper($_POST['natureOwnership']);
        $regOwnerName = strtoupper($_POST['regOwnerName']);
        $classificationno = strtoupper($_POST['classificationno']);
        $identificationno = strtoupper($_POST['identificationno']);
        $buildingno = strtoupper($_POST['buildingno']);
        $planno = strtoupper($_POST['planno']);
        $plandate = $_POST['plandate'];
        $areaMeasure = $_POST['areaMeasure'];
        $area = $_POST['area'];
        $feets = $_POST['feets'];
        $constructionCost = $_POST['constructionCost'];
        $additionsValue = $_POST['additionsValue'];
        $alterationValue = $_POST['alterationValue'];
        $acquisitiondate = $_POST['acquisitiondate'];
        $capitalCost = $_POST['capitalCost'] ?? 0; 
        $refValue = $_POST['refValue']; 
        
        $identificationnoTem = $_POST['identificationnoTem'];
        $fundtype = $_POST['fundtype'];
		$remarks = strtoupper($_POST['remarks']);
		$previousownership = strtoupper($_POST['previousownership']);
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
        $id = $_POST['id'];
        $acquisitionInstitute = strtoupper($_POST['acquisitionInstitute']);
        if ($areaMeasure == 'IMPERIAL UNITS') {
            $area = $feets * 0.09290304;
        } elseif ($areaMeasure == 'METRIC UNITS') {
            $feets = $area * 10.76391042;
        }

        $validate->text('assetscenter', $assetscenter);
        $validate->text('assetunit', $assetunit);
        $validate->text('province', $province);
        $validate->text('district', $district);
        $validate->text('dsDivision', $dsDivision);
        $validate->text('gsDivision', $gsDivision);
        $validate->text('landName', $landName);
        //$validate->text('ownerName', $ownerName);
        $validate->text('category', $category);
        $validate->text('assetsno', $assetsno);
        $validate->text('buildingType', $buildingType);
        //$validate->text('rentAndRate', $rentAndRate);
        $validate->text('natureOwnership', $natureOwnership);
        $validate->text('ownership', $ownership);
        //$validate->text('regOwnerName', $regOwnerName);
        $validate->text('classificationno', $classificationno);
        $validate->text('identificationno', $identificationno);
        $validate->text('buildingno', $buildingno);
        //$validate->text('planno', $planno);
        //$validate->passeddate('plandate', $plandate);
        $validate->text('areaMeasure', $areaMeasure);
        // $validate->number('area', $area);
        $validate->number('constructionCost', $constructionCost);
        //$validate->number('additionsValue', $additionsValue);
        //$validate->number('alterationValue', $alterationValue);
        //$validate->passeddate('acquisitiondate', $acquisitiondate);
		$validate->current_year_date('acquisitiondate', $acquisitiondate, $currentYear);
        //$validate->text('remarks', $remarks);
        $IdPieces = explode("/", $identificationno);


        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $buildingCategorys = BuildingCategoryDB::getBuildingCategorys();
        $institutes = InstituteDB::getFullDetails();

        // Load appropriate view based on hasErrors
        if ($fields->hasErrors()) {

            $error = 2;
            // include('ADD_Building_Details.php');
        } else {
            $counterId = $_COOKIE['counterId'];
            if ($id != 0) {
                BuildingDB::deleteDetailsById($id);
            }
            $building = new Building($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $landName, $ownerName, $category, $assetsno, $buildingType, $rentAndRate, $natureOwnership, $ownership, $regOwnerName, $classificationno, $identificationno, $buildingno, $planno, $plandate, $areaMeasure, $area, $feets, $constructionCost, $additionsValue, $alterationValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute, $previousownership, $refValue);
            $count = BuildingDB::getHasRecord($building);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = BuildingDB::addBuilding($building);
                if ($saveCount == 1) {
                    $count = BuildingDB::Save_psos_allow($category, $identificationno);
					$countft = BuildingDB::Save_fundtype($fundtype, $identificationno);
					$error = 1;
                    $id = 0;
                    setcookie('id', 0);
                } else {
                    $error = 5;
                }
            }
        }
        $slidebartype = 3;
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
		$count = BuildingDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
		if ($_COOKIE["assetsUnit"] ?? "") {
            if ($proto['protocollevel1'] == 25) {
				$count = BuildingDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
		    } else {
				$count = BuildingDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
		    }
        }
        
        include('add_building_details.php');
        break;
    case 'List_Approved':
        $slidebartype = 11;
        include('startpage.php');
        break;
    case 'Tobe_Approve':
        $slidebartype = 1;
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        include('startpage.php');
        break;
    case 'toBeApproveList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 1;
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        $Building = BuildingDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $Building['assetscenter'];
        $assetunit = $Building['assetunit'];
        $province = $Building['province'];
        $district = $Building['district'];
        $dsDivision = $Building['dsDivision'];
        $gsDivision = $Building['gsDivision'];
        $landName = $Building['landname'];
        $ownerName = $Building['ownerName'];
        $category = $Building['buildingCategory'];
        $assetsno = $Building['assetsno'];
        $buildingType = $Building['buildingType'];
        $rentAndRate = $Building['rentAndRate'];
        $ownership = $Building['ownership'];
        $natureOwnership = $Building['natureOwnership'];
        $regOwnerName = $Building['regOwnerName'];
        $classificationno = $Building['classificationno'];
        $identificationno = $Building['identificationno'];
        $buildingno = $Building['buildingno'];
        $planno = $Building['planno'];
        $plandate = $Building['plandate'];
        $areaMeasure = $Building['areaMeasure'];
        $area = $Building['area'];
        $feets = $Building['feets'];
        $constructionCost = $Building['constructionCost'];
        $additionsValue = $Building['additionsValue'];
        $alterationValue = $Building['alterationValue'];
        $acquisitiondate = $Building['acquisitiondate'];
        $fundtype = $Building['fundtype'];
		$remarks = $Building['remarks'];
        $id = $Building['id'];
        $notapprived = $Building['notapprived'];
        $notapprivedReason = $Building['notapprivedReason'];
        $acquisitionInstitute = $Building['acquisitionInstitute'];
		$previousownership = $Building['previousownership'];
        include('approve_building_details.php');
        break;
    case 'approveSave':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 1;
        $count = 0;
        $count = BuildingDB::ApproveDetails($id, $login);
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        include('startpage.php');
        break;
    case 'notApproveSave':
        $id = $_POST['id'];
        $notapprivedReason = $_POST['notapprivedReason'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 1;
        $count = 0;
        $count = BuildingDB::notApproveDetails($id, $login, $notapprivedReason);
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        include('startpage.php');
        break;
    case 'Approved':
        $slidebartype = 2;
        $Items = BuildingDB::getBuildingApproved();
        include('startpage.php');
        break;
    case 'ApprovedList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 2;
        $Items = BuildingDB::getBuildingApproved();
        $Building = BuildingDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $Building['assetscenter'];
        $assetunit = $Building['assetunit'];
        $province = $Building['province'];
        $district = $Building['district'];
        $dsDivision = $Building['dsDivision'];
        $gsDivision = $Building['gsDivision'];
        $landName = $Building['landname'];
        $ownerName = $Building['ownerName'];
        $category = $Building['buildingCategory'];
        $assetsno = $Building['assetsno'];
        $buildingType = $Building['buildingType'];
        $rentAndRate = $Building['rentAndRate'];
        $ownership = $Building['ownership'];
        $natureOwnership = $Building['natureOwnership'];
        $regOwnerName = $Building['regOwnerName'];
        $classificationno = $Building['classificationno'];
        $identificationno = $Building['identificationno'];
        $buildingno = $Building['buildingno'];
        $planno = $Building['planno'];
        $plandate = $Building['plandate'];
        $areaMeasure = $Building['areaMeasure'];
        $area = $Building['area'];
        $feets = $Building['feets'];
        $constructionCost = $Building['constructionCost'];
        $additionsValue = $Building['additionsValue'];
        $alterationValue = $Building['alterationValue'];
        $acquisitiondate = $Building['acquisitiondate'];
        $fundtype = $Building['fundtype'];
		$remarks = $Building['remarks'];
        $id = $Building['id'];
        $acquisitionInstitute = $Building['acquisitionInstitute'];
		$damcomment = $Building['damcomment'];
        include('approved_details.php');
        break;
    case 'update_Details':
        $slidebartype = 3;
        $error = 0;
        $Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
        $id = $_GET['id'];
        $Building = BuildingDB::getDetailsById($id);
        $assetscenter = $Building['assetscenter'];
        $assetunit = $Building['assetunit'];
        $province = $Building['province'];
        $district = $Building['district'];
        $dsDivision = $Building['dsDivision'];
        $gsDivision = $Building['gsDivision'];
        $landName = $Building['landname'];
        $ownerName = $Building['ownerName'];
        $category = $Building['buildingCategory'];
        $assetsno = $Building['assetsno'];
        $buildingType = $Building['buildingType'];
        $rentAndRate = $Building['rentAndRate'];
        $ownership = $Building['ownership'];
        $natureOwnership = $Building['natureOwnership'];
        $regOwnerName = $Building['regOwnerName'];
        $classificationno = $Building['classificationno'];
        $identificationno = $Building['identificationno'];
        $buildingno = $Building['buildingno'];
        $planno = $Building['planno'];
        $plandate = $Building['plandate'];
        $areaMeasure = $Building['areaMeasure'];
        $area = $Building['area'];
        $feets = $Building['feets'];
        $constructionCost = $Building['constructionCost'];
        $additionsValue = $Building['additionsValue'];
        $alterationValue = $Building['alterationValue'];
        $acquisitiondate = $Building['acquisitiondate'];
        $fundtype = $Building['fundtype'];
		$remarks = $Building['remarks'];
        $notapprived = $Building['notapprived'];
        $notapprivedReason = $Building['notapprivedReason'];
        $id = $Building['id'];
        $acquisitionInstitute = $Building['acquisitionInstitute'];
		$previousownership = $Building['previousownership'];
                $capitalCost = $Building['capitalCost'];
                $refValue = $Building['refValue'];
        $identificationnoTem = $identificationno;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $buildingCategorys = BuildingCategoryDB::getBuildingCategorys();
        $institutes = InstituteDB::getFullDetails();
        setcookie('district', $district);
        setcookie('assetsno', $assetsno);
        setcookie('ownership', $ownership);
        setcookie('assetsUnit', $assetunit);
        setcookie('counterID', $Building['counterID']);
        setcookie('id', $id);
        include('add_building_details.php');
        break;
    case 'update_Details_Ajax':
        $id = $_GET['id'];
        $Building = BuildingDB::getDetailsById($id);
        echo json_encode($Building);
        break;
    case 'List_Inquiry':
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
        $searchText = BuildingDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		if ($search <> "") {
			$items = BuildingDB::getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		} else {
			$items = BuildingDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		}
        //$items = BuildingDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);

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
        $items = BuildingDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        $Building = BuildingDB::getDetailsByIdentificationno($identificationno);
        include('dbtovariable.php');
        $id = $Building['id'];
        include('approved_details.php');
        break;
    case 'findSearchType':
        $searchby = $_GET['searchby'];
        include('coldefine.php');

        $searchText = BuildingDB::getSearchText($column);
        ?>
        <input type="text" list="searchs" name="search">
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
	case 'Select_Items_For_Modifications':
        $assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : "");
        $assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : "");

        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $Items = BuildingDB::getDetails($assetscenter, $assetunit);

        $slidebartype = 25;
        include('select_modification.php');
        break;
	case 'ModificationList':
        $id = $_GET['id'];
        $Building = BuildingDB::getDetailsById($id);
		$assetscenter = $Building['assetscenter'];
        $assetunit = $Building['assetunit'];
        $province = $Building['province'];
        $district = $Building['district'];
        $dsDivision = $Building['dsDivision'];
        $gsDivision = $Building['gsDivision'];
        $landName = $Building['landname'];
        $ownerName = $Building['ownerName'];
        $category = $Building['buildingCategory'];
        $assetsno = $Building['assetsno'];
        $buildingType = $Building['buildingType'];
        $rentAndRate = $Building['rentAndRate'];
        $ownership = $Building['ownership'];
        $natureOwnership = $Building['natureOwnership'];
        $regOwnerName = $Building['regOwnerName'];
        $classificationno = $Building['classificationno'];
        $identificationno = $Building['identificationno'];
        $buildingno = $Building['buildingno'];
        $planno = $Building['planno'];
        $plandate = $Building['plandate'];
        $areaMeasure = $Building['areaMeasure'];
        $area = $Building['area'];
        $feets = $Building['feets'];
        $constructionCost = $Building['constructionCost'];
        $additionsValue = $Building['additionsValue'];
        $alterationValue = $Building['alterationValue'];
        $acquisitiondate = $Building['acquisitiondate'];
        $fundtype = $Building['fundtype'];
		$remarks = $Building['remarks'];
        $slidebartype = 25;
		$Items = BuildingDB::getDetails($assetscenter, $assetunit);
        include('add_modification.php');
        break;
	case 'SelectModificationSave':
        $id = $_POST['id'];
		$Building = BuildingDB::getDetailsById($id);
        $assetscenter = $Building['assetscenter'];
        $assetunit = $Building['assetunit'];
		if (isset($_POST['selectmodification'])) {
			$count = BuildingDB::ModificationAllows($id); }
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $Items = BuildingDB::getDetails($assetscenter, $assetunit);
		$slidebartype = 25;
        include('select_modification.php');
        break;	
	case 'delete_Detail_Ajax':
        $id = $_GET['id'];
		$count = BuildingDB::deleteDetailsById($id); 
		echo $count;
        break;		
	case 'showSidebar':
		$id = $_GET['id'];
		if ($id == 3) {
			$Items = BuildingDB::getBuildingNotApproved();
		} else if ($id == 4) {
			//$Items = BuildingDB::getLandsApproveRejected();
			$Items = BuildingDB::getBuildingApproveRejected();
		} else if ($id == 2) {
			$Items = BuildingDB::getBuildingApproved();
		} else if ($id == 25) {
			$assetscenter = $_GET['assetscenter'];
			$assetunit = $_GET['assetunit'];
			$Items = BuildingDB::getDetails($assetscenter, $assetunit);
		}
		echo json_encode( $Items );
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
        include('view_updates.php');
        break;	
    case 'viewDAM':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
		$damcomment = $_POST['damcomment'];
        $count = BuildingDB::view_dam($id, $login, $damcomment);
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
		$title = array("Upload - Building Plan","Upload - Building Plan","Upload - Building Plan");
		$Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
		$row = BuildingDB::getpicById($id);
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
			$count=BuildingDB::picpath($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 4;
		$title = array("Upload - Building Plan","Upload - Building Plan","Upload - Building Plan");
		$Items = BuildingDB::getBuildingNotApproved();
        $Items_Sub = BuildingDB::getBuildingApproveRejected();
		$row = BuildingDB::getpicById($id);
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
        $searchText = BuildingDB::getSearchText($column);
        $items = BuildingDB::getInqDetails($assetscenter, $assetunit, $column, $search, $fromdate, $todate);
		echo json_encode($items);
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
			BuildingDB::deleteDetailsById($id);
        }
        include('coldefine.php');
        $searchText = BuildingDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = BuildingDB::getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('delete_not_confirm.php');
        break;
    case 'zero_value_list':
		$items = AssetsUnitDB::getFullList();
		$exps = array();
		foreach ($items as $row) {
			$assetunit = $row['unitName'];
			$type = ($row['report_received'] == '1' ? "Yes" : "");
			$lds = BuildingDB::zero_value_Records($assetunit);
			foreach ($lds as $ld) {
			$exp = array($row['centreName'], $row['unitName'], $ld['identificationno'], $ld['district'], $ld['buildingCategory'], $ld['constructionCost'], $type);  
			$exps[] = $exp;
			}
			}
        include('zero_value_list.php');
        break;	
    case 'mofifydata_grid':
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
        $searchText = BuildingDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		if ($search <> "") {
			$items = BuildingDB::getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		} else {
			$items = BuildingDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		}
		$buildingCategorys = BuildingCategoryDB::getBuildingCategorys();
        include('mofifydata_grid.php');
        break;
  case 'mofifydata_grid_save':
			$id = $_GET['id'];
			$category = $_GET['category'];
			$buildingType = $_GET['buildingType'];
			$landname = $_GET['landname'];
			$acquisitiondate = $_GET['acquisitiondate'];
			$area = $_GET['area'];
			$feets = $_GET['feets'];
			$constructionCost = $_GET['constructionCost'];
			$alterationValue = $_GET['alterationValue'];
			$rentAndRate = $_GET['rentAndRate'];			
			$saveCount = BuildingDB::mofifydata_grid_save($id, $category, $buildingType, $landname, $acquisitiondate, $area, $feets, $constructionCost, $alterationValue, $rentAndRate);
		echo $saveCount;
		break;
    case 'tree_list':
        $slidebartype = 26;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list.php');
        break;
    case 'getDetailsUnit':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = BuildingDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
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
			BuildingDB::deleteDetailsById($id);
        }
		
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$items = BuildingDB::getDetailsUnitAll($assetunit);
        include('delete_all_items.php');
        break;
   case 'delete_all_item':
		 $assetunit = $_GET['unit'];
		 $count = BuildingDB::deleteDetailsAll($assetunit);
		 echo json_encode($count);
         break;
    case 'ledgerformat':
        $slidebartype = 5;
        $items = BuildingDB::getFullDetails();
		include('ledgerformat.php');
        break;
    case 'ledgerformatdata':	
		$items = BuildingDB::getFullDetails(); 
		echo json_encode($items);
		break;
    case 'tree_list_2':
        $slidebartype = 26;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list_2.php');
        break;
    case 'getDetailsUnit_2':	
		 if (isset($_GET['id'])) {
		 $id = $_GET['id'];}
		 if (isset($_GET['text'])) {
		 $text = $_GET['text'];} 
		if ($id == 1) {
			$items = BuildingDB::getFullDetails(); } 
		else if ($id == 5 || $id == 2) {
			$items = BuildingDB::getDetails_protocol(1, $text);	
		} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
			$items = BuildingDB::getDetails_protocol(2, $text);
		}
		echo json_encode($items);
		break;
     case 'board_report_start':
        $slidebartype = 0;
		$filename = "";
		$error = board_reportDB::getHasRecord($assetscenter, $assetunit, $currentYear);
		if ( $error > 0){
			$filename = board_reportDB::getassetpath("building_path", $assetunit, $currentYear);
			$error = ($filename == "" ? 0 : 1); 
		} else {
			$count = board_reportDB::addRecord($assetscenter, $assetunit, $currentYear);
			$error = 0;
		}
        $exps = board_reportDB::getUnitList_currentyear($assetunit, $currentYear);
		include('board_report_start.php');
        break;   
	case 'board_report':
		$items = BuildingDB::getBoard_report($assetscenter, $assetunit);
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
		$filename = "../board_report/".$currentYear."-".$assetunit."-building.pdf";
		$asset = "building";
		$count = board_reportDB::updateRecord($asset, $filename, $assetunit, $currentYear);
		include('print_list.php');
        break;
    case 'board_report_history':
        $slidebartype = 0;
        $exps = board_reportDB::getUnitList($assetunit);
		include('board_report_history.php');
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
		$slidebartype = 30;
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = BuildingDB::getSummaryDetails($assetscenter, $assetunit, $inputField1, $inputField2);
        include('summary_list.php');
        break;
    case 'List_summary_list':
        $assetscenter = $_GET['assetscenter'];
		$assetunit = $_GET['assetunit'];
		$inputField1 = $_GET['inputField1'];
		$inputField2 = $_GET['inputField2'];
		$categoryName = $_GET['categoryName'];
        $items = BuildingDB::getSummaryDetails_list($assetscenter, $assetunit, $inputField1, $inputField2, $categoryName);
        include('summary_list_list.php');
        break;
   case 'List_summary6':
		 if (isset($_POST['inputField1'])) {
            $acquisitiondate = $_POST['inputField1'];
        } else if (isset($_GET['inputField1'])) {
            $acquisitiondate = $_GET['inputField1'];
        } else {
            $acquisitiondate = date("Y-m-d");
        }
		$slidebartype = 30;
        $items = BuildingCategoryDB::getBuildingCategorysassetno();
		$exps = array();
		foreach ($items as $row) {
			$categoryName = $row['categoryName'];
			$cata = BuildingDB::get_itemCategory_summary_date($categoryName, $acquisitiondate);
			$exp = array($row['categoryName'], $row['classification'], $row['assetno'], $cata['cnt'], $cata['tot']);  
			$exps[] = $exp;
			}
        include('summary_list6.php');
        break;
   case 'List_summary_6_list':
		 $id = $_GET['id'];
		 $acquisitiondate = $_GET['acquisitiondate'];
		$categoryName = $_GET['categoryName'];
		$slidebartype = 30;
		$items = BuildingDB::get_itemCategory_summary_date_list($categoryName, $acquisitiondate);
        include('summary_list6_list.php');
        break;
    case 'upload_vreport':
        if (isset($_POST['del'])) {
            $id = $_POST['id'];
			$identificationno = $_POST['identificationno'];
			$target = "";
			$count=BuildingDB::put_vreport_path($id, $target);
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
		$slidebartype = 32;
        $error = 0;
		$title = array("Upload - Valuation Report","Upload - Valuation Report","Upload - Valuation Report");
		$Items = BuildingDB::getFullDetails();
		$row = BuildingDB::getvreportById($id);
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
			$count=BuildingDB::put_vreport_path($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 32;
		$title = array("Upload - Valuation Report","Upload - Valuation Report","Upload - Valuation Report");
		$Items = BuildingDB::getFullDetails();
		$row = BuildingDB::getvreportById($id);
		$vreport_path = isset($row['vreport']) ? $row['vreport'] : "";
        include('upload_vreport.php');
        break;
    case 'board_report_ob_view':
        $slidebartype = 0;
		$exps = board_report_observationsDB::getFullDetails_Itemtype($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_ob_view.php');
        break;
    case 'np_List_Building_Details':
        $items = BuildingDB::np_getFullDetails();
        include('np_full_list.php');
        break;
    case 'np_tree_list_2':
        $slidebartype = 26;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('np_tree_list_2.php');
        break;
    case 'np_getDetailsUnit_2':	
		 if (isset($_GET['id'])) {
		 $id = $_GET['id'];}
		 if (isset($_GET['text'])) {
		 $text = $_GET['text'];} 
		if ($id == 1) {
			$items = BuildingDB::np_getFullDetails(); } 
		else if ($id == 5 || $id == 2) {
			$items = BuildingDB::np_getDetails_protocol(1, $text);	
		} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
			$items = BuildingDB::np_getDetails_protocol(2, $text);
		}
		echo json_encode($items);
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
        $searchText = BuildingDB::np_getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		if ($search <> "") {
			$items = BuildingDB::np_getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		} else {
			$items = BuildingDB::np_getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		}
        include('np_inquiry_list.php');
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
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = BuildingDB::getInqDetails_unit($assetunit);
		include('transfer_selet_quick.php');
		break;
  case 'transfer_selet_quick_save':
			$id = $_GET['id'];
			$transferSelect = $_GET['transferSelect'];
			$transferToCenter = $_GET['transferToCenter'];
			$transferToUnit = $_GET['transferToUnit'];
			$transferToDetails = "Bulk Transfer";
			$transferToDate = date("Y/m/d");
			$saveCount = BuildingDB::select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate);
		echo $saveCount;
		break;
    case 'Confirm_Items_For_transfer':
        $items = BuildingDB::getItemsNotTransferConfirmed($assetunit);
        include('Confirm_Items_For_transfer.php');
        break;
    case 'Confirm_Transfer_Save':
        $id = $_GET['id'];
        $transferToConfirm = 1;
        $items = BuildingDB::ConfirmTransferSave($id, $transferToConfirm);
		echo json_encode($items);
        break;
	case 'Confirm_Transfer_Reject':
        $id = $_GET['id'];
        $items = BuildingDB::ConfirmTransferReject($id);
		echo json_encode($items);
        break;		
}
?>