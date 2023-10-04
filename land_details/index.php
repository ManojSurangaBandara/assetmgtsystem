<?php
require_once('../php-login/auth.php');
require_once('../model/database.php');
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
require('../model/landcategory_db.php');
require('../model/landcategory.php');
require('../model/personal_db.php');
require('../model/land.php');
require('../model/land_db.php');
require('../model/institute_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/unitdetails_db.php');
require('../model/board_report_db.php');
require('../model/board_report_observations_db.php');



$page = 1;
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
$fields->addField('category');
$fields->addField('assetsno');
$fields->addField('classificationno');
$fields->addField('identificationno');
$fields->addField('register');
$fields->addField('landname');
$fields->addField('natureOwnership');
$fields->addField('ownership');
$fields->addField('planno');
$fields->addField('deedno');
$fields->addField('deeddate', '(yyyy-mm-dd)');
$fields->addField('landNature');
$fields->addField('areaMeasure');
$fields->addField('area', 'Hectare');
$fields->addField('acre', 'Acres');
$fields->addField('rood', 'Rood');
$fields->addField('parch', 'Perch');
$fields->addField('estimatedValue');
$fields->addField('acquisitiondate', '(yyyy-mm-dd)');
$fields->addField('remarks');
$fields->addField('counterId');
$fields->addField('acquisitionInstitute');
$fields->addField('valCost');
$fields->addField('refValue');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
   // $action = 'List_Land_Details';
   $action = 'startpage';
}
$slidebartype = 5;
$error = 0;
$sql = "SELECT displaytype FROM members WHERE member_id = $memId";
//$result = $db->query($sql);
$result = $db->query($sql);
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $displaytype = $row["displaytype"];
}
$exps = array();
if ($_SESSION['SESS_LEVEL'] == 25) {
	$assetscenter = $_SESSION['SESS_PROTOCOLT2'];
} else {
	$assetscenter = $_SESSION['SESS_CENTRE'];
}
$assetunit = $_SESSION['SESS_PLACE'];
$province = "";
$district = "";
$dsDivision = "";
$gsDivision = "";
$category = "";
$assetsno = "";
$classificationno = "";
$identificationno = "";
$register = "";
$landname = "";
$natureOwnership = "";
$ownership = "";
$planno = "";
$deedno = "";
$deeddate = "";
$landNature = "";
$areaMeasure = "";
$area = ""; //hectare
$acre = "";
$rood = "";
$parch = "";
$estimatedValue = "";
$acquisitiondate = "";
$remarks = "";
$notapprived = "";
$notapprivedReason = "";
$counterId = 0;
$acquisitionInstitute = "";
$previousownership = "";
$valCost = "";
$refValue = "";

$assetsCenters = AssetsCenterDB::getAssetsCenters();
$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
$provinces = ProvinceDB::getProvinces();
$districts = DistrictDB::getDistrictsByProvince($province);
$dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
$gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
$landcategorys = LandCategoryDB::getLandCategorys();
$institutes = InstituteDB::getFullDetails();

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
    case 'List_Land_Details':
		$items = LandDB::getFullDetails();
        include('full_list.php');
        break;
    case 'Add_Land_Details':
        $slidebartype = 3;
        $error = 0;
		$title = array("ADD - Land Details","ඉඩම් විස්තර ඇතුලත් කිරීම","காணியின் நுழைய");
        //$title = $title[$lang];
		$Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $id = 0;
        $identificationnoTem = "";
        setcookie('id', 0);
        $assetscenter = $_SESSION['SESS_CENTRE'];
        $assetunit = $_SESSION['SESS_PLACE'];
        setcookie('assetsUnit', $assetunit);
        include('add_land_details.php');
        break;
    case 'Add_Land_Details_Ajax':
        $slidebartype = 3;
        $error = 0;
		$title = array("ADD - Land Details","ඉඩම් විස්තර ඇතුලත් කිරීම","காணியின் நுழைய");
		$Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $id = 0;
        $identificationnoTem = "";
        setcookie('id', 0);
        include('add_land_details_ajax.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
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
		//include('../view/finddistrictbyprovince.php');
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
		//include('../view/finddsbydistrict.php');
        //setcookie('district', $district);
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
		//include('../view/findgsbyds.php');
        break;		
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
        $assetunit = "";
        setcookie('assetsUnit', "");
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'findAssetsnoByCategory':
        $category = $_GET['category'];
        //assetsno = "";
        $assetsnos = LandCategoryDB::getAssetsnoByCategory($category);
        setcookie('assetsno', $assetsnos->getId() ?? "");
        include('../view/findassetsnobycategory.php');
        break;
	case 'findAssetsnoByCategory_Ajax':
        $category = $_GET['category'];
		$assetsno =  array();
        $assetsnos = LandCategoryDB::getAssetsnoByCategory($category);
        $assetsno[] = $assetsnos->getId();
		$assetsno[] = $assetsnos->getName();		
		echo json_encode( $assetsno );
        break;
    case 'findUnitConvertUnit':
        $areaMeasure = $_GET['areaMeasure'];
        //echo $areaMeasure;
        // $assetsnos = LandCategoryDB::getAssetsnoByCategory($category);
        //setcookie('assetsno', $assetsnos->getId());
        include('../view/findunitconvertunit.php');
        break;
    case 'findOwnership':
        setcookie('ownership', $_GET['ownership']);
        break;
    case 'findPresentUnitByUnit':
        setcookie('assetsUnit', $_GET['unit']);
        break;
    case 'generateCode':
        $identificationno = "";
		//if (isset($_COOKIE["assetsUnit"])) {
		//if (isset($_COOKIE["district"])) {
		//if (isset($_COOKIE["ownership"])) {
		//if (isset($_COOKIE["counterID"])) {
		//if (isset($_COOKIE["assetsno"])) {
        $_COOKIE["assetsUnit"] = $_COOKIE["assetsUnit"] ?? "";
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_COOKIE["assetsUnit"]);
        $catalohuenos = DistrictDB::getCatlognoByDistrict(4, $_COOKIE["district"]);
        $catalohueno = ($_COOKIE["ownership"] == 'ARMY LAND' ? $catalohuenos->getId() : $catalohuenos->getName());
        if ($_COOKIE["id"] == 0) {
            $counterIdD = LandDB::getCounterId($_COOKIE["assetsUnit"]);
            $counterIdD++;
        } else {
            $counterIdD = $_COOKIE["counterID"];
        }
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_COOKIE["assetsno"] . "/" . $catalohueno . "/" . $counterId;
        setcookie('counterID', intval($counterId));
       // }
		//}
	//	}
		//}
		//}
		echo $identificationno;
        break;
    case 'generateCode_Ajax':
        $identificationno = "";
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit($_GET["assetsUnit"]);
        $catalohuenos = DistrictDB::getCatlognoByDistrict(4, $_GET["district"]);
        $catalohueno = ($_GET["ownership"] == 'Army Land' ? $catalohuenos->getId() : $catalohuenos->getName());
        if ($_GET["id"] == 0) {
            $counterIdD = LandDB::getCounterId($_GET["assetsUnit"]);
            $counterIdD++;
        } else {
            $counterIdD = $_GET["counterID"];
        }
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $_GET["assetsno"] . "/" . $catalohueno . "/" . $counterId;
        setcookie('counterID', intval($counterId));
		echo $identificationno;
        break;
    case 'Add_Land_Detail':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $dsDivision = $_POST['dsDivision'];
        $gsDivision = $_POST['gsDivision'];
        $category = $_POST['category'];
        $assetsno = $_POST['assetsno'];
        $classificationno = strtoupper($_POST['classificationno']);
        $identificationno = strtoupper($_POST['identificationno']);
        $register = strtoupper($_POST['register']);
        $landname = strtoupper($_POST['landname']);
        $natureOwnership = strtoupper($_POST['natureOwnership']);
        $ownership = strtoupper($_POST['ownership']);
        $planno = strtoupper($_POST['planno']);
        $deedno = strtoupper($_POST['deedno']);
        $deeddate = $_POST['deeddate'];
        $landNature = strtoupper($_POST['landNature']);
        $areaMeasure = strtoupper($_POST['areaMeasure']);
        $area = $_POST['area'];
        $acre = $_POST['acre'];
        $rood = $_POST['rood'];
        $parch = $_POST['parch'];
        $estimatedValue = $_POST['estimatedValue'];
        $acquisitiondate = $_POST['acquisitiondate'];
		$previousownership = strtoupper($_POST['previousownership']);
        $remarks = strtoupper($_POST['remarks']);
        //$notapprived = $Land['notapprived'];
        //$notapprivedReason = $Land['notapprivedReason'];
        $identificationnoTem = $_POST['identificationnoTem'];
        
         $valCost = $_POST['valCost'];  
         $refValue = $_POST['refValue']; 
        
        if (isset($_COOKIE["counterID"])) {
		$counterId = $_COOKIE["counterID"];}
        $id = $_POST['id'];
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
		$proto = AssetsUnitDB::getprotocol($assetunit);
        $acquisitionInstitute = strtoupper($_POST['acquisitionInstitute']);
        if ($areaMeasure == 'IMPERIAL UNITS') {
            $area = $acre * 0.40468564224047 + $rood * 0.10117141056012 + $parch * 0.0025292852640029;
        } elseif ($areaMeasure == 'METRIC UNITS') {
            $acre = (int) ($area / 0.40468564224047);
            $roodTem = fmod($area, 0.40468564224047);
            //  $roodTem = $area%0.40468564224047;
            $rood = (int) ($roodTem / 0.101171410560120);
            $parchTem = fmod($roodTem, 0.101171410560120);
            //$parchTem = $roodTem%0.101171410560120;
            $parch = $parchTem / 0.0025292852640029;
        }
        $validate->text('assetscenter', $assetscenter);
        $validate->text('assetunit', $assetunit);
        $validate->text('province', $province);
        $validate->text('district', $district);
        $validate->text('dsDivision', $dsDivision);
        $validate->text('gsDivision', $gsDivision);
        $validate->text('category', $category);
        $validate->text('assetsno', $assetsno);
        $validate->text('classificationno', $classificationno);
        $validate->text('identificationno', $identificationno);
        $validate->text('register', $register);
        $validate->text('landname', $landname);
        $validate->text('natureOwnership', $natureOwnership);
        $validate->text('ownership', $ownership);
        $validate->text('planno', $planno);
        $validate->text('deedno', $deedno);
        //$validate->passeddate('deeddate', $deeddate);
        $validate->text('landNature', $landNature);
        $validate->text('areaMeasure', $areaMeasure);
        // $validate->number('area', $area);
        $validate->number('estimatedValue', $estimatedValue);
        //$validate->passeddate('acquisitiondate', $acquisitiondate);
		$validate->current_year_date('acquisitiondate', $acquisitiondate, $currentYear);
        //$validate->text('remarks', $remarks);
        $slidebartype = 3;
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            if ($id != 0) {
                LandDB::deleteDetailsById($id);
            }
            $land = new Land($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $category, $assetsno, $classificationno, $identificationno, $register, $landname, $natureOwnership, $ownership, $planno, $deedno, $deeddate, $landNature, $areaMeasure, $area, $acre, $rood, $parch, $estimatedValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute, $previousownership, $valCost, $refValue );
            $count = LandDB::getHasRecord($land);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = LandDB::addLand($land);
                if ($saveCount == 1) {
                   $count = LandDB::Save_psos_allow($category, $identificationno);
				   $error = 1;
                    $id = 0;
                    setcookie('id', 0);
                } else {
                    $error = 5;
                }
            }
        }
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $landcategorys = LandCategoryDB::getLandCategorys();
		$count = LandDB::Savesorderwithcenter($sorderwithcenter, $identificationno);
		if ($_COOKIE["assetsUnit"] ?? "") {
            if ($proto['protocollevel1'] == 25) {
                    $count = LandDB::Savesprotocol($proto['protocoltext2'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);	
            } else {
                    $count = LandDB::Savesprotocol($proto['protocoltext1'], $proto['protocoltext2'], $proto['protocollevel5'], $identificationno);
            }
        }
		$title = array("ADD - Land Details","ඉඩම් විස්තර ඇතුලත් කිරීම","காணியின் நுழைய");
        include('add_land_details.php');
        break;
    case 'Add_Land_Detail_Ajax':
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $province = $_POST['province'];
        $district = $_POST['district'];
        $dsDivision = $_POST['dsDivision'];
        $gsDivision = $_POST['gsDivision'];
        $category = $_POST['category'];
        $assetsno = $_POST['assetsno'];
        $classificationno = $_POST['classificationno'];
        $identificationno = $_POST['identificationno'];
        $register = $_POST['register'];
        $landname = $_POST['landname'];
        $natureOwnership = $_POST['natureOwnership'];
        $ownership = $_POST['ownership'];
        $planno = $_POST['planno'];
        $deedno = $_POST['deedno'];
        $deeddate = $_POST['deeddate'];
        $landNature = $_POST['landNature'];
        $areaMeasure = $_POST['areaMeasure'];
        $area = $_POST['area'];
        $acre = $_POST['acre'];
        $rood = $_POST['rood'];
        $parch = $_POST['parch'];
        $estimatedValue = $_POST['estimatedValue'];
        $acquisitiondate = $_POST['acquisitiondate'];
        $remarks = $_POST['remarks'];
        $identificationnoTem = $_POST['identificationnoTem'];
        //if (isset($_COOKIE["counterID"])) {
		//$counterId = $_COOKIE["counterID"];}
		$num = substr($identificationno,-4);
		$counterId = (int)$num;
        $id = $_POST['id'];
        $acquisitionInstitute = $_POST['acquisitionInstitute'];
        if ($areaMeasure == 'IMPERIAL UNITS') {
            $area = $acre * 0.40468564224047 + $rood * 0.10117141056012 + $parch * 0.0025292852640029;
        } elseif ($areaMeasure == 'METRIC UNITS') {
            $acre = (int) ($area / 0.40468564224047);
            $roodTem = fmod($area, 0.40468564224047);
            //  $roodTem = $area%0.40468564224047;
            $rood = (int) ($roodTem / 0.101171410560120);
            $parchTem = fmod($roodTem, 0.101171410560120);
            //$parchTem = $roodTem%0.101171410560120;
            $parch = $parchTem / 0.0025292852640029;
        }

            if ($id != 0) {
                LandDB::deleteDetailsById($id);
            }
            $land = new Land($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $category, $assetsno, $classificationno, $identificationno, $register, $landname, $natureOwnership, $ownership, $planno, $deedno, $deeddate, $landNature, $areaMeasure, $area, $acre, $rood, $parch, $estimatedValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute);
            $count = LandDB::getHasRecord($land);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = LandDB::addLand($land);
                if ($saveCount == 1) {
                    $error = 1;
                    setcookie('id', 0);
                } else {
                    $error = 5;
                }
            }
			echo $error;
        break;
    case 'List_Approved':
        $slidebartype = 11;
        include('startpage.php');
        break;
	case 'List_Approved_Ajax':
        $slidebartype = 12;
        include('startpage.php');
        break;
    case 'Tobe_Approve':
        $slidebartype = 1;
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        include('startpage.php');
        break;
	case 'Tobe_Approve_Ajax':
        $slidebartype = 3;
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        include('approve_land_details_Ajax.php');
        break;
    case 'toBeApproveList':
        $identificationno = $_GET['identificationno'];
        $slidebartype = 1;
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $Land = LandDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
        $province = $Land['province'];
        $district = $Land['district'];
        $dsDivision = $Land['dsDivision'];
        $gsDivision = $Land['gsDivision'];
        $category = $Land['category'];
        $assetsno = $Land['assetsno'];
        $classificationno = $Land['classificationno'];
        // $identificationno = $Land['identificationno'];
        $register = $Land['register'];
        $landname = $Land['landname'];
        $natureOwnership = $Land['natureOwnership'];
        $ownership = $Land['ownership'];
        $planno = $Land['planno'];
        $deedno = $Land['deedno'];
        $deeddate = $Land['deeddate'];
        $landNature = $Land['landNature'];
        $areaMeasure = $Land['areaMeasure'];
        $area = $Land['area'];
        $acre = $Land['acre'];
        $rood = $Land['rood'];
        $parch = $Land['parch'];
        $estimatedValue = $Land['estimatedValue'];
        $acquisitiondate = $Land['acquisitiondate'];
        $remarks = $Land['remarks'];
        $id = $Land['id'];
        $notapprived = $Land['notapprived'];
        $notapprivedReason = $Land['notapprivedReason'];
        $acquisitionInstitute = $Land['acquisitionInstitute'];
	$previousownership = $Land['previousownership'];
        $refValue = $Land['refValue']; 
        $valCost = $Land['valCost'];
        include('approve_land_details.php');
        break;
    case 'toBeApproveList_Ajax':
        $id = $_GET['id'];
        $Land = LandDB::getDetailsById($id);
        echo json_encode( $Land );
        break;
    case 'approveSave':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 1;
        $count = 0;
        $count = LandDB::ApproveDetails($id, $login);
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        include('startpage.php');
        break;
    case 'approveSave_Ajax':
        $id = $_GET['id'];
        $login = $_SESSION['SESS_LOGIN'];
        $count = LandDB::ApproveDetails($id, $login);
	   echo $count;
        break;
    case 'notApproveSave':
        $id = $_POST['id'];
        $notapprivedReason = $_POST['notapprivedReason'];
        $login = $_SESSION['SESS_LOGIN'];
        $slidebartype = 1;
        $count = 0;
        $count = LandDB::notApproveDetails($id, $login, $notapprivedReason);
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        include('startpage.php');
        break;
    case 'notApproveSave_Ajax':
        $id = $_POST['id'];
        $notapprivedReason = $_POST['notapprivedReason'];
        $login = $_SESSION['SESS_LOGIN'];
        $count = LandDB::notApproveDetails($id, $login, $notapprivedReason);
        break;
    case 'Approved':
        $slidebartype = 2;
        $Items = LandDB::getLandsApproved();
        include('startpage.php');
        break;
    case 'Approved_Ajax':
        $id = "";
		$slidebartype = 2;
		$Items = array();
	  // $Items = LandDB::getLandsApproved();
        include('approved_land_details_ajax.php');
		//include('startpage.php');
        break;
    case 'ApprovedList':
        $identificationno = $_GET['identificationno'];
		if (isset($_GET['slidebartype'])) {
			$slidebartype = $_GET['slidebartype'];
			if ($slidebartype == 31) {
				$category = $_GET['category'];
				$acquisitiondate = $_GET['acquisitiondate'];
				$Items = LandDB::get_itemCategory_summary_date_list($category, $acquisitiondate);
			}
		} else {
			$slidebartype = 2;
			$Items = LandDB::getLandsApproved();
		}
        $Land = LandDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
        $province = $Land['province'];
        $district = $Land['district'];
        $dsDivision = $Land['dsDivision'];
        $gsDivision = $Land['gsDivision'];
        $category = $Land['category'];
        $assetsno = $Land['assetsno'];
        $classificationno = $Land['classificationno'];
        $identificationno = $Land['identificationno'];
        $register = $Land['register'];
        $landname = $Land['landname'];
        $natureOwnership = $Land['natureOwnership'];
        $ownership = $Land['ownership'];
        $planno = $Land['planno'];
        $deedno = $Land['deedno'];
        $deeddate = $Land['deeddate'];
        $landNature = $Land['landNature'];
        $areaMeasure = $Land['areaMeasure'];
        $area = $Land['area'];
        $acre = $Land['acre'];
        $rood = $Land['rood'];
        $parch = $Land['parch'];
        $estimatedValue = $Land['estimatedValue'];
        $acquisitiondate = $Land['acquisitiondate'];
        $remarks = $Land['remarks'];
        $id = $Land['id'];
        $acquisitionInstitute = $Land['acquisitionInstitute'];
	$damcomment = $Land['damcomment'];
        $refValue = $Land['refValue']; 
        $valCost = $Land['valCost'];
        include('approved_land_details.php');
        break;
    case 'update_Details':
        $title = array("ADD - Land Details","ඉඩම් විස්තර ඇතුලත් කිරීම","காணியின் நுழைய");
		$slidebartype = 3;
        $error = 0;
        $Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $id = $_GET['id'];
        $Land = LandDB::getDetailsById($id);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
        $province = $Land['province'];
        $district = $Land['district'];
        $dsDivision = $Land['dsDivision'];
        $gsDivision = $Land['gsDivision'];
        $category = $Land['category'];
        $assetsno = $Land['assetsno'];
        $classificationno = $Land['classificationno'];
        $identificationno = $Land['identificationno'];
        $register = $Land['register'];
        $landname = $Land['landname'];
        $natureOwnership = $Land['natureOwnership'];
        $ownership = $Land['ownership'];
        $planno = $Land['planno'];
        $deedno = $Land['deedno'];
        $deeddate = $Land['deeddate'];
        $landNature = $Land['landNature'];
        $areaMeasure = $Land['areaMeasure'];
        $area = $Land['area'];
        $acre = $Land['acre'];
        $rood = $Land['rood'];
        $parch = $Land['parch'];
        $estimatedValue = $Land['estimatedValue'];
        $acquisitiondate = $Land['acquisitiondate'];
        $remarks = $Land['remarks'];
        $notapprived = $Land['notapprived'];
        $notapprivedReason = $Land['notapprivedReason'];
        $identificationnoTem = $Land['identificationno'];
        $id = $Land['id'];
        $acquisitionInstitute = $Land['acquisitionInstitute'];
		$previousownership = $Land['previousownership'];
                $refValue = $Land['refValue']; 
        $valCost = $Land['valCost'];
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $provinces = ProvinceDB::getProvinces();
        $districts = DistrictDB::getDistrictsByProvince($province);
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        $gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        $landcategorys = LandCategoryDB::getLandCategorys();

        setcookie('district', $district);
        setcookie('assetsno', $assetsno);
        setcookie('ownership', $ownership);
        setcookie('assetsUnit', $assetunit);
        setcookie('counterID', $Land['counterID']);
        setcookie('id', $id);
        include('add_land_details.php');
        break;
	case 'update_Details_Ajax':
        $id = $_GET['id'];
		$data = array();
        $Land = LandDB::getDetailsById($id);
		//$data[] = $Land;
	//	$districts = DistrictDB::getDistrictsByProvince($Land['province']);
	//	$data[] = $districts;
		echo json_encode( $Land );
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
        $searchText = LandDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		if ($search <> "") {
			$items = LandDB::getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
		} else {
			$items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
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
    case 'List_Inquiry_Ajax':
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        include('inquiry_list_ajax.php');
        break;
    case 'List_Inquiry_Data_Ajax':
		$assetscenter = $_POST['assetscenter'];
		$assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : "");
		$searchby = $_POST['searchby'];
		$search = (isset($_POST['search']) ? $_POST['search'] : "");
		//$search = $_GET['search'];
		$date1 = $_POST['inputField1'];
		$date2 = $_POST['inputField2'];
		include('coldefine.php');
		$items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $date1, $date2);
		echo json_encode( $items );
		break;
    case 'printPDF_Ajax':
		$assetscenter = $_POST['assetscenter'];
		$assetunit = $_POST['assetunit'];
		$searchby = $_POST['searchby'];
		$search = $_POST['search'];
		$date1 = $_POST['date1'];
		$date2 = $_POST['date2'];
		include('coldefine.php');
		$items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $date1, $date2);
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
		echo json_encode( $items );
		break;
    case 'Inquiry_List_Details':
        $identificationno = $_GET['identificationno'];
		if (isset($_GET['assetscenter'])) {
            $assetscenter = $_GET['assetscenter'];
        } else {
			$assetscenter = "";
		}
		$assetunit = $_GET['assetunit'];
        $searchby = $_GET['searchby'];
        $search = $_GET['search'];
        $inputField1 = $_GET['inputField1'];
        $inputField2 = $_GET['inputField2'];
        $slidebartype = 8;
        include('coldefine.php');
        $items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        $Land = LandDB::getDetailsByIdentificationno($identificationno);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
        $province = $Land['province'];
        $district = $Land['district'];
        $dsDivision = $Land['dsDivision'];
        $gsDivision = $Land['gsDivision'];
        $category = $Land['category'];
        $assetsno = $Land['assetsno'];
        $classificationno = $Land['classificationno'];
        $identificationno = $Land['identificationno'];
        $register = $Land['register'];
        $landname = $Land['landname'];
        $natureOwnership = $Land['natureOwnership'];
        $ownership = $Land['ownership'];
        $planno = $Land['planno'];
        $deedno = $Land['deedno'];
        $deeddate = $Land['deeddate'];
        $landNature = $Land['landNature'];
        $areaMeasure = $Land['areaMeasure'];
        $area = $Land['area'];
        $acre = $Land['acre'];
        $rood = $Land['rood'];
        $parch = $Land['parch'];
        $estimatedValue = $Land['estimatedValue'];
        $acquisitiondate = $Land['acquisitiondate'];
        $remarks = $Land['remarks'];
        $id = $Land['id'];
        $acquisitionInstitute = $Land['acquisitionInstitute'];
        include('approved_land_details.php');
        break;
    case 'findSearchType':
        $searchby = $_GET['searchby'];
        include('coldefine.php');
        $searchText = LandDB::getSearchText($column);
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
        //$is_admin = ($user['permissions'] == 'admin' ? true : false);
		$assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : "");
		$assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : ""); 
		//$assetscenter = $_POST['assetscenter'];
        //$assetunit = $_POST['assetunit'];

        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $Items = LandDB::getDetails($assetscenter, $assetunit);
        $slidebartype = 25;
        include('select_modification.php');
        break;
	case 'Select_Items_For_Modifications_Ajax':
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $Items = array();
        $slidebartype = 25;
        include('select_modification_ajax.php');
        break;
	case 'ModificationList':
        $id = $_GET['id'];
        $Land = LandDB::getDetailsById($id);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
        $province = $Land['province'];
        $district = $Land['district'];
        $dsDivision = $Land['dsDivision'];
        $gsDivision = $Land['gsDivision'];
        $category = $Land['category'];
        $assetsno = $Land['assetsno'];
        $classificationno = $Land['classificationno'];
        $identificationno = $Land['identificationno'];
        $register = $Land['register'];
        $landname = $Land['landname'];
        $natureOwnership = $Land['natureOwnership'];
        $ownership = $Land['ownership'];
        $planno = $Land['planno'];
        $deedno = $Land['deedno'];
        $deeddate = $Land['deeddate'];
        $landNature = $Land['landNature'];
        $areaMeasure = $Land['areaMeasure'];
        $area = $Land['area'];
        $acre = $Land['acre'];
        $rood = $Land['rood'];
        $parch = $Land['parch'];
        $estimatedValue = $Land['estimatedValue'];
        $acquisitiondate = $Land['acquisitiondate'];
        $remarks = $Land['remarks'];
        $notapprived = $Land['notapprived'];
        $notapprivedReason = $Land['notapprivedReason'];
        $identificationnoTem = $Land['identificationno'];
        $slidebartype = 25;
		$Items = LandDB::getDetails($assetscenter, $assetunit);
        include('add_modification.php');
        break;
	case 'SelectModificationSave':
        $id = $_POST['id'];
		$Land = LandDB::getDetailsById($id);
        $assetscenter = $Land['assetscenter'];
        $assetunit = $Land['assetunit'];
		if (isset($_POST['selectmodification'])) {
			$count = LandDB::ModificationAllows($id); }
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $Items = LandDB::getDetails($assetscenter, $assetunit);
		$slidebartype = 25;
        include('select_modification.php');
        break;
	case 'SelectModificationSave_ajax':
        $id = $_GET['id'];
		$count = LandDB::ModificationAllows($id); 
        break;
	case 'delete_LandDetail_Ajax':
        $id = $_GET['id'];
		$count = LandDB::deleteDetailsById($id); 
		echo $count;
        break;
	case 'showSidebar':
		$id = $_GET['id'];
		if ($id == 3) {
			$Items = LandDB::getLandsNotApproved();
		} else if ($id == 4) {
			$Items = LandDB::getLandsApproveRejected();
		} else if ($id == 2) {
			$Items = LandDB::getLandsApproved();
		} else if ($id == 25) {
			$assetscenter = $_GET['assetscenter'];
			$assetunit = $_GET['assetunit'];
			$Items = LandDB::getDetails($assetscenter, $assetunit);
		}
		echo json_encode( $Items );
		break;
	case 'getLabels_Ajax':
		echo json_encode($tList);
        break;	
    case 'testpage':
        $slidebartype = 5;
        include('testpage.php');
        break;
    case 'view_update':
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
        $items = LandDB::view_update($assetscenter, $assetunit, $inputField1, $inputField2);
        include('view_updates.php');
        break;	
    case 'viewDAM':
        $id = $_POST['id'];
        $login = $_SESSION['SESS_LOGIN'];
		$damcomment = $_POST['damcomment'];
        $count = LandDB::view_dam($id, $login, $damcomment);
        break;
    case 'List_columnlist':
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
        $searchText = LandDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);

      //  $items = LandDB::getFullDetails();
        include('full_list_selectcolumns.php');
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
		$title = array("Upload - Land Plan","Upload - Land Plan","Upload - Land Plan");
		//$Items = LandDB::getLandsNotApproved();
		$Items = LandDB::getFullDetails();
        $Items_Sub = LandDB::getLandsApproveRejected();
		$row = LandDB::getpicById($id);
        $picpath = isset($row['picpath']) ? $row['picpath'] : "";

       include('upload_plan.php');
        break;
	case 'upload':
		$id = $_POST['id'];
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
			$count=LandDB::picpath($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 4;
		$title = array("Upload - Land Plan","Upload - Land Plan","Upload - Land Plan");
		$Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
		$row = LandDB::getpicById($id);
		 $picpath = !isset($row['picpath']) ? "" : $row['picpath'];
        include('upload_plan.php');
        break;
    case 'List_columnlist_easyui':	
		$items = LandDB::getFullDetails();
		echo json_encode($items);
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
        $searchText = LandDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        $items = LandDB::getInqDetails($assetscenter, $assetunit, $column, $search, $fromdate, $todate);
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
			LandDB::deleteDetailsById($id);
        }
        include('coldefine.php');
        $searchText = LandDB::getSearchText($column);
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        $items = LandDB::getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        include('delete_not_confirm.php');
        break;
    case 'zero_value_list':
		$items = AssetsUnitDB::getFullList();
		$exps = array();
		foreach ($items as $row) {
			$assetunit = $row['unitName'];
			$type = ($row['report_received'] == '1' ? "Yes" : "");
			$lds = LandDB::zero_value_Records($assetunit);
			foreach ($lds as $ld) {
			$exp = array($row['centreName'], $row['unitName'], $ld['identificationno'], $ld['district'], $ld['category'], $ld['estimatedValue'], $type);  
			$exps[] = $exp;
			}
			}
        include('zero_value_list.php');
        break;	
    case 'tree_list':
        $slidebartype = 26;
		$items = AssetsUnitDB::getFullListbyProtocol();
        include('tree_list.php');
        break;
    case 'getDetailsUnit':	
		 if (isset($_GET['unit'])) {
		 $assetunit = $_GET['unit'];
		$items = LandDB::getDetailsUnit($assetunit);
		} 
		echo json_encode($items);
		break;
    case 'ledgerformat':
        $slidebartype = 5;
        $items = LandDB::getFullDetails();
		include('ledgerformat.php');
        break;
    case 'ledgerformatdata':	
		$items = LandDB::getFullDetails(); 
		//$assetunit = "LEBANON";
		//$items = LandDB::getDetailsUnit($assetunit);
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
			LandDB::deleteDetailsById($id);
        }
        $assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
		$items = LandDB::getDetailsUnitAll($assetunit);
        include('delete_all_items.php');
        break;
   case 'delete_all_item':
		 $assetunit = $_GET['unit'];
		 $count = LandDB::deleteDetailsAll($assetunit);
		 echo json_encode($count);
         break; 
    case 'Add_Land_Details_AJS':
        $slidebartype = 27;
        $error = 0;
		$title = array("ADD - Land Details","ඉඩම් විස්තර ඇතුලත් කිරීම","காணியின் நுழைய");
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
		$ac = array();
		foreach ($assetsCenters as $row) {
                $ac[] = $row->getName();
            }
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$au = array();
		foreach ($assetunits as $row) {
                $au[] = $row->getName();
            }	
		$provinces = ProvinceDB::getProvinces();
		$prov = array();
		foreach ($provinces as $row) {
                $prov[] = $row->getName();
            }
		$categorys = array();
		foreach ($landcategorys as $row) {
                $categorys[] = $row->getName();
            }
		$Items = LandDB::getLandsNotApproved();
        $Items_Sub = LandDB::getLandsApproveRejected();
        $id = 0;
        $identificationnoTem = "";
        setcookie('id', 0);
        include('add_land_details_ajs.php');
        break;
    case 'findAssetsUnitsByCenter_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$assetscenter = $request->assetscenter;
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
    case 'findDistrictByProvince_AjS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$province = $request->province;        
        $district = array();
		$districts = DistrictDB::getDistrictsByProvince($province);
		foreach ($districts as $unit) {
			$district[] = $unit->getName(); }
		echo json_encode( $district );
        break;
    case 'findDSByDistrict_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$district = $request->district; 
		$dsdivision =  array();
        $dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
        foreach ($dsdivisions as $unit) {
			$dsdivision[] = $unit->getName(); }
		echo json_encode( $dsdivision );
        break;
    case 'findGSByDS_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$dsDivision = $request->dsDivision;        
        $gsdivision =  array();
		$gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
        foreach ($gsdivisions as $unit) {
			$gsdivision[] = $unit->getName(); }
		echo json_encode( $gsdivision );
        break;
	case 'findAssetsnoByCategory_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$category = $request->category; 
		$assetsno =  array();
        $assetsnos = LandCategoryDB::getAssetsnoByCategory($category);
        $assetsno[] = $assetsnos->getId();
		$assetsno[] = $assetsnos->getName();		
		echo json_encode( $assetsno );
        break;	
    case 'generateCode_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$assetsUnit = $request->assetsUnit; 
		$district = $request->district;
		$ownership = $request->ownership;
		$id = $request->id;
		$counterID = $request->counterID;
		$assetsno = $request->assetsno;
		
		$identificationno = "";
		$centreID = AssetsUnitDB::getCentreIDByAssetsUnit($assetsUnit);
        $catalohuenos = DistrictDB::getCatlognoByDistrict(4, $district);
        $catalohueno = ($ownership == 'Army Land' ? $catalohuenos->getId() : $catalohuenos->getName());
        if ($id == 0) {
            $counterIdD = LandDB::getCounterId($assetsUnit);
            $counterIdD++;
        } else {
            $counterIdD = $counterID;
        }
        $counterId = sprintf("%04d", $counterIdD);
        $identificationno = $centreID->getName() . "/" . $assetsno . "/" . $catalohueno . "/" . $counterId;
		echo $identificationno;
        break;
    case 'Add_Land_Detail_AJS':	
	    $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$id = $request->id;
		$assetscenter = $request->assetscenter;
        $assetunit = $request->assetsunit;
        $province = $request->province;
        $district = $request->district;
        $dsDivision = $request->dsDivision;
        $gsDivision = $request->gsDivision;
        $category = $request->category;
        $assetsno = $request->assetsno;
        $classificationno = $request->classificationno;
        $identificationno = $request->identificationno;
        $register = $request->register;
        $landname = $request->landname;
        $natureOwnership = $request->natureOwnership;
        $ownership = $request->ownership;
        $planno = $request->planno;
        $deedno = $request->deedno;
        $deeddate = $request->deeddate;
        $landNature = $request->landNature;
        $areaMeasure = $request->areaMeasure;
        $area = $request->area;
        $acre = $request->acre;
        $rood = $request->rood;
        $parch = $request->parch;
        $estimatedValue = $request->estimatedValue;
        $acquisitiondate = $request->acquisitiondate;
        $remarks = $request->remarks;
       // $identificationnoTem = $request->identificationnoTem;
		$num = substr($identificationno,-4);
		$counterId = (int)$num;
        $acquisitionInstitute = $request->acquisitionInstitute;
		            if ($id != 0) {
                LandDB::deleteDetailsById($id);
            }
			$land = new Land($assetscenter, $assetunit, $province, $district, $dsDivision, $gsDivision, $category, $assetsno, $classificationno, $identificationno, $register, $landname, $natureOwnership, $ownership, $planno, $deedno, $deeddate, $landNature, $areaMeasure, $area, $acre, $rood, $parch, $estimatedValue, $acquisitiondate, $remarks, $counterId, $acquisitionInstitute, $previousownership);	
            $count = LandDB::getHasRecord($land);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = LandDB::addLand($land);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
            }
		echo json_encode($error);
        break;
	case 'update_Details_AJS':
        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$id = $request->id; 
        $Land = LandDB::getDetailsById($id);
		echo json_encode( $Land );
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
			$items = LandDB::getFullDetails(); } 
		else if ($id == 5 || $id == 2) {
			$items = LandDB::getDetails_protocol(1, $text);	
		} else if ($id == 3 || $id == 4 || $id == 6 || $id == 7) {
			$items = LandDB::getDetails_protocol(2, $text);
		}
		echo json_encode($items);
		break;
    case 'board_report_start':
        $slidebartype = 0;
		$filename = "";
		$error = board_reportDB::getHasRecord($assetscenter, $assetunit, $currentYear);
		if ( $error > 0){
			$filename = board_reportDB::getassetpath("land_path", $assetunit, $currentYear);
			$error = ($filename == "" ? 0 : 1); 
		} else {
			$count = board_reportDB::addRecord($assetscenter, $assetunit, $currentYear);
			$error = 0;
		}
        $exps = board_reportDB::getUnitList_currentyear($assetunit, $currentYear);
		include('board_report_start.php');
        break;		
    case 'board_report':
		$items = LandDB::getBoard_report($assetscenter, $assetunit);
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
		$filename = "../board_report/".$currentYear."-".$assetunit."-land.pdf";
		$asset = "land";
		$count = board_reportDB::updateRecord($asset, $filename, $assetunit, $currentYear);
		include('print_list.php');
		//$count = board_reportDB::getassetpath("land_path", $filename, $assetunit, $currentYear);
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
        $items = LandDB::getSummaryDetails($assetscenter, $assetunit, $inputField1, $inputField2);
        include('summary_list.php');
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
        $items = LandCategoryDB::getLandCategorysassetno();
		$exps = array();
		foreach ($items as $row) {
			//$assetno = $row['assetno'];
			$category = $row['categoryName'];
			//$cata = LandDB::get_itemCategory_summary_date($assetno, $acquisitiondate);
			$cata = LandDB::get_itemCategory_summary_date($category, $acquisitiondate);
			$exp = array($row['categoryName'], $row['classification'], $row['assetno'], $cata['cnt'], $cata['tot']);  
			$exps[] = $exp;
			}
        include('summary_list6.php');
        break;
   case 'List_summary_6_list':
		 $id = $_GET['id'];
		 $acquisitiondate = $_GET['acquisitiondate'];
		$category = $_GET['category'];
		$slidebartype = 30;
		$items = LandDB::get_itemCategory_summary_date_list($category, $acquisitiondate);
        include('summary_list6_list.php');
        break;
    case 'list_province':
        $slidebartype = 5;
        $items = LandDB::getFullDetails_province();
		include('list_province.php');
        break;
    case 'upload_vreport':
        if (isset($_POST['del'])) {
            $id = $_POST['id'];
			$identificationno = $_POST['identificationno'];
			$target = "";
			$count=LandDB::put_vreport_path($id, $target);
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
		$Items = LandDB::getFullDetails();
		$row = LandDB::getvreportById($id);
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
			$count=LandDB::put_vreport_path($id, $target);
		} else {
			$error = 2;
			//echo "Sorry, there was a problem uploading your file.";
		}
		}
		$slidebartype = 32;
		$title = array("Upload - Valuation Report","Upload - Valuation Report","Upload - Valuation Report");
		$Items = LandDB::getFullDetails();
		$row = LandDB::getvreportById($id);
		$vreport_path = isset($row['vreport']) ? $row['vreport'] : "";
        include('upload_vreport.php');
        break;
    case 'board_report_ob_view':
        $slidebartype = 0;
		$exps = board_report_observationsDB::getFullDetails_Itemtype($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype']);
		include('board_report_ob_view.php');
        break;		
}
?>