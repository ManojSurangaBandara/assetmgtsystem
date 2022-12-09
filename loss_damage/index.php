<?php
require_once('../php-login/auth.php');
require_once('../model/database.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require_once('../model/loss_damage_db.php');
require_once('../model/lost_damage_board_db.php');
require_once('../model/loss_damage_details_db.php');
require_once('../model/loss_damage_charge_db.php');
require('../model/classificationlist_db.php');

$page = 14;
require_once('../model/language.php');
$filestatus = array("මුකශා වෙත යැවූ නොලද ගොණු", 
					"හලේකා වෙත යැවූ නොලද ගොණු", 
					"රා. ආ. අ. වෙත යැවූ නොලද ගොණු");

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
   $action = 'startpage';
}
$slidebartype = 1;
$error = 0;
function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}
switch ($action) {
    case 'startpage':
        $slidebartype = 1;
        $content = loss_damageDB::status();
		include('startpage.php');
        break;
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'new_loss_damage':
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
		$assetscenter = "";
		$items = loss_damageDB::getFullDetails();
        include('new_loss_damage.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
   case 'add_loss_damage':
        $error = 0;
		$slidebartype = 2;
		$fileno = $_POST['fileno'];
        $assetscenter = $_POST['assetscenter'];
		$assetunit = $_POST['assetunit'];
		$place = $_POST['place'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$goods = $_POST['goods'];
		$value = $_POST['value'];
		$description = $_POST['description'];
		$letter1 = $_POST['letter1'];
		$letter1date = $_POST['letter1date'];
		$id = $_POST['id'];
            $count = loss_damageDB::getHasRecord($fileno);
            if ($count > 0) {
                if ($id <> 0) {			
				$saveCount = loss_damageDB::updateRecord($fileno, $assetscenter, $assetunit, $place, $date, $time, $goods, $value, $description, $letter1, $letter1date);
                    $error = 2;
                } else {
					$error = 3;
				}
            } else {
                $saveCount = loss_damageDB::addRecord($fileno, $assetscenter, $assetunit, $place, $date, $time, $goods, $value, $description, $letter1, $letter1date);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
            }
       echo $error;
       break;
	case 'showSidebar':
		$id = $_GET['id'];
		$Items = loss_damageDB::getSidebarDetails($id); 
		echo json_encode( $Items );
		break;
	case 'getDetailsById':
		$id = $_GET['id'];
		$Items = loss_damageDB::getDetailsById($id);
		echo json_encode( $Items );
		break;
	case 'deleteRecordByid':
		$id = $_GET['id'];
		$delCount = loss_damageDB::deleteRecordByid($id);
		echo $delCount;
        break;
    case 'board_details':
		$fileno = "";
		$board_letter = "";
		//$items = loss_damageDB::getFullDetails();
        include('board_details.php');
        break;
   case 'get_board_details':
		$fileno = $_GET['fileno'];
		$board_letter = loss_damageDB::getboardletterByFileno($fileno);
		include('board_details.php');
        break;
   case 'get_lost_damage_board':
		$fileno = $_GET['fileno'];
		if ($fileno == ''){
		} else {
			$result = lost_damage_boardDB::getDetailsByFileno($fileno);
		}
		echo json_encode($result);
        break;
    case 'save_lost_damage_board':
		$sno = $_REQUEST['sno'];
		$number = $_REQUEST['number'];
		$rank = $_REQUEST['rank'];
		$name = $_REQUEST['name'];
		$unit = $_REQUEST['unit'];
		$post = $_REQUEST['post'];	
		$fileno = $_GET['fileno'];		
		$result = lost_damage_boardDB::addRecord($fileno, $sno, $number, $rank, $name, $unit, $post);
		echo json_encode(array(
			'id' => mysql_insert_id(),
			'sno' => $sno,
			'number' => $number,
			'rank' => $rank,
			'name' => $name,
			'unit' => $unit,			
			'post' => $post
		));	
		break;
    case 'update_lost_damage_board':
		$id = intval($_REQUEST['id']);
		$sno = $_REQUEST['sno'];
		$number = $_REQUEST['number'];
		$rank = $_REQUEST['rank'];
		$name = $_REQUEST['name'];
		$unit = $_REQUEST['unit'];
		$post = $_REQUEST['post'];		
		$result = lost_damage_boardDB::updateRecord($id, $sno, $number, $rank, $name, $unit, $post);
		echo json_encode(array(
			'id' => $id,
			'sno' => $sno,
			'number' => $number,
			'rank' => $rank,
			'name' => $name,
			'unit' => $unit,			
			'post' => $post
		));	
		break;
    case 'destroy_lost_damage_board':
		$id = intval($_REQUEST['id']);
		$result = lost_damage_boardDB::deleteRecordByid($id);
		echo json_encode(array('success'=>true));
        break;
    case '104_3':
		$items = loss_damageDB::getFullDetails();
        include('104_3.php');
        break;
   case 'add_104_3':
        $error = 0;
		$_1043_recdate = $_POST['_1043_recdate'];
		$_1043_frbrsenddate = $_POST['_1043_frbrsenddate'];
		$_1043_frbrrecdate = $_POST['_1043_frbrrecdate'];
		$_1043_comdsecsenddate = $_POST['_1043_comdsecsenddate'];
		$_1043_comdsecrecdate = $_POST['_1043_comdsecrecdate'];
		$_1043_defminsenddate = $_POST['_1043_defminsenddate'];
		$_1043_defminrecdate = $_POST['_1043_defminrecdate'];
		$_1043_adviseddate = $_POST['_1043_adviseddate'];
		$id = $_POST['id'];
		$fileno = clean(loss_damageDB::getfilenoById($id));
		$_1043_letter = $_POST['_1043_letter'];
		if ($id <> 0) {			
			if(!empty($_FILES['letter']['name'])){
			$target_dir = "upload/r1043/";
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = "r1043_".$fileno.'.'.end($temp);
			$_1043_letter = $newfilename;
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = $newfilename;
			$target_file = $target_dir . basename($newfilename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if ($_FILES['letter']["size"] > 1000000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "pdf" ) {
				echo "Sorry, only PDF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo " Your file was not uploaded.";
			} else {
			if (move_uploaded_file($_FILES['letter']["tmp_name"], $target_file)) {
				} else {
				echo "Sorry, there was an error uploading your file.";
				}
			}
			}
				$saveCount = loss_damageDB::updateRecord_1043($id, $_1043_recdate, $_1043_frbrsenddate, $_1043_frbrrecdate, $_1043_comdsecsenddate, $_1043_comdsecrecdate, $_1043_defminsenddate, $_1043_defminrecdate, $_1043_adviseddate, $_1043_letter);
				$error = 1;
			} else {
				$error = 3;
			}
       echo $error;
       break;
   case 'get_104_3':
		$fileno = $_GET['fileno'];
		if ($fileno == ''){
		} else {
			$result = lost_damage_boardDB::getDetailsByFileno($fileno);
		}
		echo json_encode($result);
        break;
    case '104_4':
		$items = loss_damageDB::getFullDetails();
        include('104_4.php');
        break;
   case 'add_104_4':
        $error = 0;
		$_1044_recdate 				= $_POST['_1044_recdate'];
		$_1044_obsenddate 			= $_POST['_1044_obsenddate'];
		$_1044_obrecdate 			= $_POST['_1044_obrecdate'];
		$_1044_lowsenddate 			= $_POST['_1044_lowsenddate'];
		$_1044_lowobsenddate 		= $_POST['_1044_lowobsenddate'];
		$_1044_againsenddate 		= $_POST['_1044_againsenddate'];
		$_1044_againrecdate 		= $_POST['_1044_againrecdate'];
		$_1044_againlowsenddate 	= $_POST['_1044_againlowsenddate'];
		$_1044_commanderorderdate 	= $_POST['_1044_commanderorderdate'];
		$_1044_clams 				= $_POST['_1044_clams'];
		$_1044_frbrsenddate 		= $_POST['_1044_frbrsenddate'];
		$_1044_frbrrecdate 			= $_POST['_1044_frbrrecdate'];
		$_1044_comdsecsenddate 		= $_POST['_1044_comdsecsenddate'];
		$_1044_comdsecrecdate 		= $_POST['_1044_comdsecrecdate'];
		$_1044_defminsenddate 		= $_POST['_1044_defminsenddate'];
		$_1044_defminrecdate 		= $_POST['_1044_defminrecdate'];
		$id = $_POST['id'];
		$fileno = clean(loss_damageDB::getfilenoById($id));
		$_1044_letter = $_POST['_1044_letter'];
		if ($id <> 0) {			
			if(!empty($_FILES['letter']['name'])){
			$target_dir = "upload/r1044/";
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = "r1044_".$fileno.'.'.end($temp);
			$_1044_letter = $newfilename;
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = $newfilename;
			$target_file = $target_dir . basename($newfilename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if ($_FILES['letter']["size"] > 1000000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "pdf" ) {
				echo "Sorry, only PDF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo " Your file was not uploaded.";
			} else {
			if (move_uploaded_file($_FILES['letter']["tmp_name"], $target_file)) {
				} else {
				echo "Sorry, there was an error uploading your file.";
				}
			}
			}
			$saveCount = loss_damageDB::updateRecord_1044($id, $_1044_recdate, $_1044_obsenddate, $_1044_obrecdate, $_1044_lowsenddate, $_1044_lowobsenddate, $_1044_againsenddate, $_1044_againrecdate, $_1044_againlowsenddate, $_1044_commanderorderdate, $_1044_clams, $_1044_frbrsenddate, $_1044_frbrrecdate, $_1044_comdsecsenddate, $_1044_comdsecrecdate, $_1044_defminsenddate, $_1044_defminrecdate, $_1044_letter);
			$error = 1;                                                                                                                                                                                                            				
		} else {                                                                                                                                                                                                                   		
			$error = 3;                                                                                                                                                                                                            			
		}                                                                                                                                                                                                                          		
       echo $error;                                                                                                                                                                                                               		
       break;
    case '109':
		$items = loss_damageDB::getFullDetails();
        include('109.php');
        break;
   case 'add_109':
        $error = 0;
		$_109_dirfinsenddate = $_POST['_109_dirfinsenddate'];
		$_109_dirfinrecdate = $_POST['_109_dirfinrecdate'];
		$_109_frbrsenddate = $_POST['_109_frbrsenddate'];
		$_109_frbrrecdate = $_POST['_109_frbrrecdate'];
		$_109_comdsecsenddate = $_POST['_109_comdsecsenddate'];
		$_109_comdsecrecdate = $_POST['_109_comdsecrecdate'];
		$_109_defminsenddate = $_POST['_109_defminsenddate'];
		$_109_defminrecdate = $_POST['_109_defminrecdate'];
		$id = $_POST['id'];		
		$fileno = clean(loss_damageDB::getfilenoById($id));
		$_109_letter = $_POST['_109_letter'];
		if ($id <> 0) {			
			if(!empty($_FILES['letter']['name'])){
			$target_dir = "upload/r109/";
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = "r109_".$fileno.'.'.end($temp);
			$_109_letter = $newfilename;
			$temp = explode(".",$_FILES['letter']["name"]);
			//$newfilename = $newfilename;
			$target_file = $target_dir . basename($newfilename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if ($_FILES['letter']["size"] > 1000000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "pdf" ) {
				echo "Sorry, only PDF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo " Your file was not uploaded.";
			} else {
			if (move_uploaded_file($_FILES['letter']["tmp_name"], $target_file)) {
				} else {
				echo "Sorry, there was an error uploading your file.";
				}
			}
			}
			$saveCount = loss_damageDB::updateRecord_109($id, $_109_dirfinsenddate, $_109_dirfinrecdate, $_109_frbrsenddate, $_109_frbrrecdate, $_109_comdsecsenddate, $_109_comdsecrecdate, $_109_defminsenddate, $_109_defminrecdate, $_109_letter);
			$error = 1;
		} else {
			$error = 3;
		}
       echo $error;
       break;
    case 'removed':
		$items = loss_damageDB::getFullDetails();
        include('removed.php');
        break;
   case 'add_removed':
        $error = 0;
		$removeddate = $_POST['removeddate'];
		$removedvalue = $_POST['removedvalue'];
		$id = $_POST['id'];
		if ($id <> 0) {			
			$saveCount = loss_damageDB::updateRecord_removed($id, $removeddate, $removedvalue);
			$error = 1;
		} else {
			$error = 3;
		}
       echo $error;
       break;
    case 'findmainCategory':
        $classification = $_GET['classification'];
        $maincategorys = array();
		$mainCate = ClassificationListDB::getMainCategory($classification);
		foreach ($mainCate as $unit) {
		$maincategorys[] = $unit->getName(); }
		echo json_encode( $maincategorys );
        break;
    case 'finditemCategory':
        $mainCategory = $_GET['mainCategory'];
		$type = $_GET['type'];
        $itemCategorys = array();
		$itemCate = ClassificationListDB::getItemCategoryByMainCategory($mainCategory, $type);
		foreach ($itemCate as $unit) {
		$itemCategorys[] = $unit->getName(); }
		echo json_encode( $itemCategorys );
        break;
    case 'finditemDescription':
        $itemCategory = $_GET['itemCategory'];
		$mainCategory = $_GET['mainCategory'];
		$type = $_GET['type'];
        $itemDescriptions = array();
		$itemDes = ClassificationListDB::getDescriptionByCategory($mainCategory, $itemCategory, $type);
		foreach ($itemDes as $unit) {
		$itemDescriptions[] = $unit->getName(); }
		echo json_encode( $itemDescriptions );
        break;
    case 'findcatalogueno':
        $itemDescription = $_GET['itemDescription'];
		$itemCategory = $_GET['itemCategory'];
		$mainCategory = $_GET['mainCategory'];
		$type = $_GET['type'];
        $cataloguenos = array();
		$cata = ClassificationListDB::getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type);
		foreach ($cata as $unit) {
		$cataloguenos[] = $unit->getName(); }
		echo json_encode( $cataloguenos );
        break;
    case 'findassetsno':
        $catalogueno = $_GET['catalogueno'];
		$type = $_GET['type'];
		$assetsnos = ClassificationListDB::getAssetsnoByCatalogueno3($catalogueno, $type);
		echo json_encode( $assetsnos );
        break;
    case 'loss_damage_details':
		$items = loss_damageDB::getFullDetails();
        include('loss_damage_details.php');
        break;
   case 'add_loss_damage_details':
        $error = 0;
		$classification = $_POST['classification'];
		$mainCategory = $_POST['mainCategory'];
		$itemCategory = $_POST['itemCategory'];
		$itemDescription = $_POST['itemDescription'];
		$catalogueno = $_POST['catalogueno'];
		$assetsno = $_POST['assetsno'];
		$newAssestno = $_POST['newAssestno'];
		$eqptSriNo = $_POST['eqptSriNo'];
		$identificationno = $_POST['identificationno'];
		$value = $_POST['value'];
		$fileno = $_POST['fileno'];
		$id = $_POST['id'];
		if ($id <> 0) {			
                $saveCount = loss_damage_detailsDB::addRecord($fileno, $classification, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $assetsno, $newAssestno, $eqptSriNo, $identificationno, $value);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
		} else {
                    $error = 5;
                }
       echo $error;
       break;
	case 'get_file_table':
        $fileno = $_GET['fileno'];
		$exps = loss_damage_detailsDB::get_file_table($fileno);
		echo json_encode( $exps );
        break;
	case 'delete_file_table':
        $id = $_GET['id'];
		$exps = loss_damage_detailsDB::deleteRecordByid($id);
		echo json_encode( $exps );
        break;
    case 'close_file':
		//$items = loss_damageDB::getFullDetails();
        include('close_file.php');
        break;
   case 'add_close_file':
        $error = 0;
		$closedfile = $_GET['closedfile'];
		$id = $_GET['id'];
		if ($id <> 0) {			
			$saveCount = loss_damageDB::updateRecord_close_file($id, $closedfile);
			$error = 1;
		} else {
			$error = 3;
		}
       echo $error;
       break;
   case 'add_board':
        $error = 0;
		$fileno = $_POST['fileno'];
		$board_letter = $_POST['board_letter'];
		if ($fileno <> "") {			
			if(!empty($_FILES['letter']['name'])){
			$target_dir = "upload/board/";
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename = clean($fileno);
			$newfilename = "board_".$newfilename.'.'.end($temp);
			$temp = explode(".",$_FILES['letter']["name"]);
			$newfilename =  basename($newfilename);
			$board_letter = $newfilename;
			$target_file = $target_dir . $newfilename;
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			if ($_FILES['letter']["size"] > 1000000000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if($imageFileType != "pdf" ) {
				echo "Sorry, only PDF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				echo " Your file was not uploaded.";
			} else {
			if (move_uploaded_file($_FILES['letter']["tmp_name"], $target_file)) {
				} else {
				echo "Sorry, there was an error uploading your file.";
				}
			}
			}
				$saveCount = loss_damageDB::updateRecord_board($fileno, $board_letter);
				$error = 1;
			} else {
				$error = 3;
			}
       echo $error;
       break;
    case '104_3_report_view':
		$fileno = $_GET['fileno'];
		$reportname = loss_damageDB::getReportName($fileno, 1);
        echo $reportname;
        break;
    case 'closed_files':
		$exps = loss_damageDB::getClosedFiles();
		include('closed_files.php');
        break;
    case 'closed_file_view':
		$id = $_GET['id'];
        include('closed_file_view.php');
        break;
    case 'status_report':
        $i = $_POST['i'];
		$slidebartype = 1;
		$content = loss_damageDB::statusDetails($i);
		include('status_report.php');
        break;
    case 'loss_damage_charge':
		$items = loss_damageDB::getFullDetails();
        include('loss_damage_charge.php');
		break;
	case 'add_loss_damage_charge_details':
        $error = 0;
		$number = $_POST['number'];
		$rank = $_POST['rank'];
		$name = $_POST['name'];
		$unit = $_POST['unit'];
		$value = $_POST['value'];
		$fileno = $_POST['fileno'];
		$id = $_POST['id'];
		if ($id <> 0 && $number <> "") {			
                $saveCount = loss_damage_chargeDB::addRecord($fileno, $number, $rank, $name, $unit, $value);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
		} else {
                    $error = 5;
                }
       echo $error;
	   break;
	case 'get_file_table_charge':
	   $fileno = $_GET['fileno'];
	   $exps = loss_damage_chargeDB::get_file_table($fileno);
	   echo json_encode( $exps );
	   break;
   case 'delete_file_table_charge':
	   $id = $_GET['id'];
	   $exps = loss_damage_chargeDB::deleteRecordByid($id);
	   echo json_encode( $exps );
	   break;
		
}                                                                                                                                                                                                                                  		
?>