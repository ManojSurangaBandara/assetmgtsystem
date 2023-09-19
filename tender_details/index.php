<?php
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter2.php');
require('../model/assetscenter.php');
require('../model/classificationlist_db.php');
require('../model/assetsunit_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/tenderdetails_db.php');
require('../model/tenderdetailsvehicle_db.php');
require('../model/buyerdetails_db.php');
require('../model/vehicle_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');

$page = 9;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
$currentYear = ConstantsDB::getCurrentYear();

require_once('../model/language.php');

$slidebartype = 1;
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
$validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('buyernicno');
		$fields->addField('lotno');
		$fields->addField('armyno');
		$fields->addField('assetscenter');
		$fields->addField('assetunit');
		$fields->addField('mainCategory');
		$fields->addField('itemCategory');
		$fields->addField('itemDescription');
		$fields->addField('assetsno');
		$fields->addField('newAssestno');
		$fields->addField('catalogueno');
switch ($action) {
    case 'startpage':
        $slidebartype = 1;
        include('startpage.php');
        break;
    case 'Add_BuyerDetails':
        $validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('nicno');
		$fields->addField('name');
		$slidebartype = 1;
        $error = 0;
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			$buyer = BuyerdetailsDB::getDetailsById($id);
			$nicno = $buyer['nicno'];
			$name = $buyer['name'];
			$address = $buyer['address'];
			$telephone = $buyer['telephone'];
			$email = $buyer['email'];
		} else {
			$id = 0;
			$nicno = "";
			$name = "";
			$address = "";
			$telephone = "";
			$email = "";
		}
        $exps = BuyerdetailsDB::getFullDetails();
		$Items = $exps; 
        include('add_buyerdetails.php');
        break;
    case 'Add_BuyerDetail':
        $validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('nicno');
		$fields->addField('name');
		$slidebartype = 1;
        $error = 0;
        $nicno = $_POST['nicno'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
		$id = $_POST['id'];
		
        $validate->text('nicno', $nicno);
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
			if ($id > 0) {
                $saveCount = BuyerdetailsDB::editRecord($id, $nicno, $name, $address, $telephone, $email);
                  if ($saveCount == 1) {
                    $error = 1;
					$id = 0;
                } else {
                    $error = 5;
                }
			} else {
            $count = BuyerdetailsDB::getHasRecord($nicno);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = BuyerdetailsDB::addRecord($nicno, $name, $address, $telephone, $email);
                if ($saveCount == 1) {
                    $error = 1;
					$id = 0;
                } else {
                    $error = 5;
                }
            }
        }
		}
        $exps = BuyerdetailsDB::getFullDetails();
		$Items = $exps; 
        include('add_buyerdetails.php');
        break;
	case 'delete_BuyerDetail':
		$id = $_POST['id'];
		$delCount = BuyerdetailsDB::deleteRecordById($id);
        $validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('nicno');
		$fields->addField('name');
		$slidebartype = 1;
        $error = 0;
		$id = 0;
        $nicno = "";
        $name = "";
        $address = "";
        $telephone = "";
        $email = "";
        $exps = BuyerdetailsDB::getFullDetails();
		$Items = $exps; 
        include('add_buyerdetails.php');
        break;
    case 'create_new_tenderno':
        $title = "Create New Tender Number";
		$returnaction = "save_tendernos";
		$validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('tenderno');
		$slidebartype = 2;
        $error = 0;
		$tplace = "";
		$type = "";
        $tenderno = "";
        $chairmanno = "";
		$chairmanname = "";
		$member1no = "";
		$member1name = "";
		$member2no = "";
		$member2name = "";
		$member3no = "";
		$member3name = "";
		$member4no = "";
		$member4name = "";
		$remarks = "";
        $Items = TenderdetailsDB::getNotFinishedDetails();
        include('add_tender_details.php');
        break;
    case 'save_tendernos':
	    $title = "Create New Tender Number";
		$returnaction = "save_tendernos";
        $validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('place');
		$fields->addField('type');
		$fields->addField('tenderno');
		$slidebartype = 2;
        $error = 0;
		$year = $_POST['year'];
		$tplace = $_POST['place'];
		$type = $_POST['type'];
        $tenderno = $_POST['tenderno'];
        $chairmanno = $_POST['chairmanno'];
		$chairmanname = $_POST['chairmanname'];
		$member1no = $_POST['member1no'];
		$member1name = $_POST['member1name'];
		$member2no = $_POST['member2no'];
		$member2name = $_POST['member2name'];
		$member3no = $_POST['member3no'];
		$member3name = $_POST['member3name'];
		$member4no = $_POST['member4no'];
		$member4name = $_POST['member4name'];
		$remarks = $_POST['remarks'];
        $validate->text('tenderno', $tenderno);
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            $count = TenderdetailsDB::getHasRecord($tenderno);
            if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = TenderdetailsDB::addRecord($year, $tplace, $type, $tenderno, $chairmanno, $chairmanname, $member1no, $member1name, $member2no, $member2name, $member3no, $member3name, $member4no, $member4name, $remarks);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
            }
        }
        $Items = TenderdetailsDB::getNotFinishedDetails();
        include('add_tender_details.php');
        break;
    case 'update_Tender_Details':
        $title = "Edit Tender Details";
		$returnaction = "update_Tender_Detail";
		$validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('tenderno');
		$slidebartype = 2;
        $error = 0;
		$id = $_GET['id'];
		$Tender = TenderdetailsDB::getDetailsById($id);
		
		$year = $Tender['year'];
		$tplace = $Tender['place'];
		$type = $Tender['type'];
        $tenderno = $Tender['tenderno'];
        $chairmanno = $Tender['chairmanno'];
		$chairmanname = $Tender['chairmanname'];
		$member1no = $Tender['member1no'];
		$member1name = $Tender['member1name'];
		$member2no = $Tender['member2no'];
		$member2name = $Tender['member2name'];
		$member3no = $Tender['member3no'];
		$member3name = $Tender['member3name'];
		$member4no = $Tender['member4no'];
		$member4name = $Tender['member4name'];
		$remarks = $Tender['remarks'];
        $Items = TenderdetailsDB::getNotFinishedDetails();
        include('update_tender_details.php');
        break;		
    case 'update_Tender_Detail':
	    $title = "Create New Tender Number";
		$returnaction = "save_tendernos";
        $validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('place');
		$fields->addField('type');
		$fields->addField('tenderno');
		$slidebartype = 2;
        $error = 0;
		$year = $_POST['year'];
		$tplace = $_POST['place'];
		$type = $_POST['type'];
        $tenderno = $_POST['tenderno'];
        $chairmanno = $_POST['chairmanno'];
		$chairmanname = $_POST['chairmanname'];
		$member1no = $_POST['member1no'];
		$member1name = $_POST['member1name'];
		$member2no = $_POST['member2no'];
		$member2name = $_POST['member2name'];
		$member3no = $_POST['member3no'];
		$member3name = $_POST['member3name'];
		$member4no = $_POST['member4no'];
		$member4name = $_POST['member4name'];
		$remarks = $_POST['remarks'];
        $validate->text('tenderno', $tenderno);
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            $count = TenderdetailsDB::getHasRecord($tenderno);
            if ($count > 0) {
				$saveCount = TenderdetailsDB::updateRecord($year, $tplace, $type, $tenderno, $chairmanno, $chairmanname, $member1no, $member1name, $member2no, $member2name, $member3no, $member3name, $member4no, $member4name, $remarks);
                if ($saveCount > 0) {
					$error = 1;
					} else {
                    $error = 5;
                }
            
            } else {
                    $error = 5;
                }
            }
        $Items = TenderdetailsDB::getNotFinishedDetails();
        include('add_tender_details.php');
        break;
	case 'delete_Tender_Details':
		$title = "Create New Tender Number";
		$returnaction = "save_tendernos";
		$id = $_POST['id'];
		$count = TenderdetailsDB::deleteRecordById($id);
		if ($count = 1) {
                $error = 1;
            } else {
                $error = 5;
            }
		$Tender = TenderdetailsDB::getDetailsById($id);
		$year = $Tender['year'];
		$tplace = $Tender['place'];
		$type = $Tender['type'];
        $tenderno = $Tender['tenderno'];
        $chairmanno = $Tender['chairmanno'];
		$chairmanname = $Tender['chairmanname'];
		$member1no = $Tender['member1no'];
		$member1name = $Tender['member1name'];
		$member2no = $Tender['member2no'];
		$member2name = $Tender['member2name'];
		$member3no = $Tender['member3no'];
		$member3name = $Tender['member3name'];
		$member4no = $Tender['member4no'];
		$member4name = $Tender['member4name'];
		$remarks = $Tender['remarks'];
        $Items = TenderdetailsDB::getNotFinishedDetails();
		$slidebartype = 2;
        include('add_tender_details.php');
        break;
    case 'Add_VehicleTenderDetails':
        $title = "Add Tender Details - Vehicles";
		$slidebartype = 3;
        $error = 0;
        $Items = TenderdetailsDB::getNotFinishedDetails();
        include('startpage.php');
        break;
    case 'display_Tender_Details':
        $id = $_GET['id'];
		$Tender = TenderdetailsDB::getDetailsById($id);
		
		$returnaction = "save_tender_vehicle";
		$lotno = "";
		
		$Buyers = BuyerdetailsDB::getFullDetails();
		$slidebartype = 3;
        $error = 0;
		$Items = TenderdetailsDB::getNotFinishedDetails();
		$exps = TenderdetailvehicleDB::getDetailsbyTenderno($Tender['tenderno']);
		if ($Tender['type'] == "V") {
			$title = "Add Vehicles Tender Details - ".$Tender['tenderno'];
			$type = "Vehicle";
			$armyno = "";
			$vehicles = VehicleDB::getDisposalDetails();
			include('add_vehicle_details.php');
		 } else {
			$type = "General Goods";			
			$title = "Add General Goods Tender Details - ".$Tender['tenderno'];
			$assetscenter = $_SESSION['SESS_CENTRE'];
			$assetunit = $_SESSION['SESS_PLACE'];
			$mainCategory = "";
			$itemCategory = "";
			$itemDescription = "";
			$assetsno = "";
			$newAssestno = "";
			$catalogueno = "";
			$assetsCenters = AssetsCenterDB::getAssetsCenters();
		$type1 = 4;
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$mainCategorys = ClassificationListDB::getMainCategory2();
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory2($mainCategory);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory2($mainCategory, $itemCategory);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription2($mainCategory, $itemCategory, $itemDescription);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno2($catalogueno);
			include('add_general_details.php');
		 }
        break;
    case 'findVehicleDetailsByid':
        $id = $_GET['id'];
        $vehicle = VehicleDB::getDetailsByarmyno($id);
        include('../view/findvehicledetails.php');
        break;
    case 'findBuyerDetailsByid':
        $nicno = $_GET['nicno'];
        $buyer = BuyerdetailsDB::getDetailsByNicno($nicno);
        include('../view/findbuyerdetails.php');
        break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_GET['center'];
        setcookie('assetscenter', $assetscenter, time() + 3600);
        $assetunit = "";
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'findPresentUnitByUnit':
        $assetsUnit = $_GET['unit'];
        $assetunits = AssetsUnitDB::getPresentUnitByUnit($assetsUnit);
        $centreID = AssetsUnitDB::getCentreIDByAssetsUnit($assetsUnit);
        setcookie('assetsUnit', $assetsUnit, time() + 3600);
        include('../view/findpresentunitbyunit1.php');
        break;
    case 'findCategoryByMainCategory':
        $mainCategory = $_GET['mainCategory'];
        setcookie('mainCategory', $mainCategory, time() + 3600);
        $itemCategory = "";
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory2($mainCategory);
        include('../view/findcategorybymaincategory.php');
        break;
    case 'findDescriptionByCategory':
        $mainCategory = $_COOKIE["mainCategory"] ?? "";
        //$mainCategory = $_REQUEST['mainCategory'];
        $itemCategory = $_GET['itemCategory'];
        setcookie('itemCategory', $itemCategory, time() + 3600);
        $itemDescription = "";
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory2($mainCategory, $itemCategory);
        include('../view/finddescriptionbycategory.php');
        break;
    case 'findCataloguenoByDescription':
        $mainCategory = $_COOKIE["mainCategory"] ?? "";
        $itemCategory = $_COOKIE["itemCategory"];
        // $mainCategory = $_REQUEST['mainCategory'];
        // $itemCategory = $_REQUEST['itemCategory'];
        //$itemCategory = $_REQUEST['itemCategory'];
        $itemDescription = $_GET['itemDescription'];
        $catalogueno = "";
        $cataloguenos = ClassificationListDB::getCatalogueByDescription2($mainCategory, $itemCategory, $itemDescription);
        include('../view/findcataloguenobydescription.php');
        break;
    case 'findAssetsnoByCatalogueno':
        $catalogueno = $_GET['catalogueno'];
        //$assetsno = "";
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno2($catalogueno);
        setcookie('catalogueno', $_GET['catalogueno']);
        setcookie('assetsno', $assetsnos->getId());
        include('../view/findassetsnobycatalogueno.php');
        break;		
    case 'save_tender_vehicle':
		if ($_POST['type'] == "Vehicle") {
			$validate = new Validate();
			$fields = $validate->getFields();
			$fields->addField('armyno');
			$fields->addField('buyernicno');
			$fields->addField('lotno');
			$slidebartype = 2;
			$error = 0;
			
			$year = $_POST['year'];
			$tplace = $_POST['place'];
			$type = $_POST['type'];
			$tenderno = $_POST['tenderno'];
			$lotno = $_POST['lotno'];
			$armyno = $_POST['armyno'];
			$buyernicno = $_POST['buyernicno'];
			
			$validate->text('armyno', $armyno);
			$validate->text('buyernicno', $buyernicno);
			$validate->text('lotno', $lotno);
			
			if ($fields->hasErrors()) {
				$error = 2;
			} else {
				$count = TenderdetailvehicleDB::getHasRecord($tenderno, $lotno);
				if ($count > 0) {
					$error = 3;
				} else {
					$mainCategory = $_POST['mainCategory'];
					$itemCategory = $_POST['itemCategory'];
					$itemDescription = $_POST['itemDescription'];
					$make = $_POST['make'];
					$modle = $_POST['modle'];
					$assetsno = $_POST['assetsno'];
					$newAssestno = $_POST['newAssestno'];
					$catalogueno = $_POST['catalogueno'];
					$engineno = $_POST['engineno'];
					$chessisno = $_POST['chessisno'];
					$yearManufacture = $_POST['yearManufacture'];
					
					$estimatevalue = $_POST['estimatevalue'];
					$tendervalue = $_POST['tendervalue'];
					
					$buyername = $_POST['buyername'];
					$buyeraddress = $_POST['buyeraddress'];
					$remarks = $_POST['remarks'];
			
					$saveCount = TenderdetailvehicleDB::addRecord($year, $tplace, $type, $tenderno, $lotno, $armyno, $mainCategory, $itemCategory, $itemDescription, $make, $modle, $assetsno, $newAssestno, $catalogueno, $engineno, $chessisno, $yearManufacture, $buyernicno, $buyername, $buyeraddress, $estimatevalue, $tendervalue, $remarks);
					if ($saveCount == 1) {
						$error = 1;
					} else {
						$error = 5;
					}
				}
			}
			$Tender = TenderdetailsDB::getDetailsByTenderno($tenderno);
			$title = "Add Vehicles Tender Details - ".$Tender['tenderno'];
			$returnaction = "save_tender_vehicle";
			if ($Tender['type'] == "V") {
			 $type = "Vehicle";
			 } else {
			 $type = "General Goods";
			 }
			$vehicles = VehicleDB::getDisposalDetails();
			$Buyers = BuyerdetailsDB::getFullDetails();
			$slidebartype = 3;
			$Items = TenderdetailsDB::getNotFinishedDetails();
			$exps = TenderdetailvehicleDB::getDetailsbyTenderno($Tender['tenderno']);
			include('add_vehicle_details.php');
		} else {
			$slidebartype = 2;
			$error = 0;
			
			$year = $_POST['year'];
			$tplace = $_POST['place'];
			$type = $_POST['type'];
			$tenderno = $_POST['tenderno'];
			$lotno = $_POST['lotno'];
			$buyernicno = $_POST['buyernicno'];
			$validate->text('buyernicno', $buyernicno);
			$validate->text('lotno', $lotno);
					if (isset($_POST['mainCategory'])) {
						$mainCategory = $_POST['mainCategory'];
					} else {
						$mainCategory = "";}
					if (isset($_POST['itemCategory'])) {
						$itemCategory = $_POST['itemCategory'];
					} else {
						$itemCategory = "";}
					if (isset($_POST['itemDescription'])) {
						$itemDescription = $_POST['itemDescription'];
					} else {
						$itemDescription = "";}
					if (isset($_POST['assetsno'])) {
						$assetsno = $_POST['assetsno'];
					} else {
						$assetsno = "";}
					if (isset($_POST['newAssestno'])) {
						$newAssestno = $_POST['newAssestno'];
					} else {
						$newAssestno = "";}
					if (isset($_POST['catalogueno'])) {
						$catalogueno = $_POST['catalogueno'];
					} else {
						$catalogueno = "";}
					$estimatevalue = $_POST['estimatevalue'];
					$tendervalue = $_POST['tendervalue'];
					
					if (isset($_POST['buyername'])) {
						$buyername = $_POST['buyername'];
						} else {
						$buyername = "";
						}
					if (isset($_POST['buyeraddress'])) {
						$buyeraddress = $_POST['buyeraddress'];
					} else {
						$buyeraddress = "";
					}
					$remarks = $_POST['remarks'];
			if ($fields->hasErrors()) {
				$error = 2;
			} else {
				$count = TenderdetailvehicleDB::getHasRecord($tenderno, $lotno);
				if ($count > 0) {
					$error = 3;
				} else {

			
					$saveCount = TenderdetailvehicleDB::addRecord2($year, $tplace, $type, $tenderno, $lotno, $mainCategory, $itemCategory, $itemDescription, $assetsno, $newAssestno, $catalogueno, $buyernicno, $buyername, $buyeraddress, $estimatevalue, $tendervalue, $remarks);
					if ($saveCount == 1) {
						$error = 1;
					} else {
						$error = 5;
					}
				}
			}
		$Tender = TenderdetailsDB::getDetailsByTenderno($tenderno);
		$title = "Add General Tender Details - ".$tenderno;
		$returnaction = "save_tender_vehicle";
		//$lotno = "";
		
		$Buyers = BuyerdetailsDB::getFullDetails();
		$slidebartype = 3;
		$Items = TenderdetailsDB::getNotFinishedDetails();
		$exps = TenderdetailvehicleDB::getDetailsbyTenderno($tenderno);
			$type = "General Goods";			
			
			//$assetscenter = $_SESSION['SESS_CENTRE'];
			//$assetunit = $_SESSION['SESS_PLACE'];
			//$mainCategory = "";
			//$itemCategory = "";
			//$itemDescription = "";
			//$assetsno = "";
			//$newAssestno = "";
			//$catalogueno = "";
			$assetsCenters = AssetsCenterDB::getAssetsCenters();
		$type1 = 4;
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		$mainCategorys = ClassificationListDB::getMainCategory2();
        $itemCategorys = ClassificationListDB::getItemCategoryByMainCategory2($mainCategory);
        $itemDescriptions = ClassificationListDB::getDescriptionByCategory2($mainCategory, $itemCategory);
        $cataloguenos = ClassificationListDB::getCatalogueByDescription2($mainCategory, $itemCategory, $itemDescription);
        $assetsnos = ClassificationListDB::getAssetsnoByCatalogueno2($catalogueno);
			include('add_general_details.php');
		}
        break;
	case 'delete_VehicleDetail':
		$id = $_POST['id'];
		$tenderno = $_POST['tenderno'];
		$lotno = "";
		$validate = new Validate();
		$fields = $validate->getFields();
		$fields->addField('armyno');
		$fields->addField('buyernicno');
		$fields->addField('lotno');
		$delCount = TenderdetailvehicleDB::deleteRecordById($id);
		$Tender = TenderdetailsDB::getDetailsByTenderno($tenderno);
		$title = "Add Vehicles Tender Details - ".$Tender['tenderno'];
		$returnaction = "save_tender_vehicle";
		if ($Tender['type'] == "V") {
		 $type = "Vehicle";
		 } else {
		 $type = "General Goods";
		 }
		$vehicles = VehicleDB::getDisposalDetails();
		$Buyers = BuyerdetailsDB::getFullDetails();
		$slidebartype = 3;
		$Items = TenderdetailsDB::getNotFinishedDetails();
		$exps = TenderdetailvehicleDB::getDetailsbyTenderno($Tender['tenderno']);
        include('add_vehicle_details.php');        
        break;
   case 'List_Inquiry':
        if (isset($_POST['tenderno'])) {
            $tenderno = $_POST['tenderno'];
        } else if (isset($_GET['tenderno'])) {
            $tenderno = $_GET['tenderno'];
        } else {
			$tenderno = "";
		}
		$exps = TenderdetailvehicleDB::getDetailsbyTenderno($tenderno);
        $items = TenderdetailsDB::getFullDetails();
		$tplaces = TenderdetailsDB::getDetailsByTenderno($tenderno);
		$tplace = $tplaces['place'];
		if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
		   //include('excel_list.php');
        }
		if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
			include('print_list.php');
        }
        include('inquiry_list.php');
        break;
    case 'findtenderdetailsBytenderno':
        $tenderno = $_GET['tenderno'];
        $exps = TenderdetailvehicleDB::getDetailsbyTenderno($tenderno);
        include('../view/findtenderlist.php');
        break;		
}
?>