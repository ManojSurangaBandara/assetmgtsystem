<?php
require_once('../php-login/auth.php');
require_once('../model/database.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require('../model/boardofsurvey_unit_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/boardofsurvey_db.php');
require('../model/boardofsurvey_s_db.php');
require('../model/dos_materialmaster_db.php');
require('../model/bos_openingbalance_db.php');
require('../model/members_db.php');
require('../model/bos_openingbalance_report_receving_db.php');
require('../model/user_account_change_history_db.php');
require('../model/board_report_summary_db.php');
require('../model/users_db.php');

require_once('../model/fields.php');
require_once('../model/validate.php');

if ($_SESSION['SESS_LEVEL'] == 25) {
	$assetscenter = $_SESSION['SESS_PROTOCOLT2'];
} else {
	$assetscenter = $_SESSION['SESS_CENTRE'];
}
$assetunit = $_SESSION['SESS_PLACE'];
$slidebartype = 1;

$assetsCenters = AssetsCenterDB::getAssetsCenters();
$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);

function isDate($value) 
{
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('assetscenter');
$fields->addField('unitName');
$fields->addField('centreID');

$fields->addField('assetunit');
$fields->addField('firstname');
$fields->addField('lastname');
$fields->addField('login');
$fields->addField('passwd');
$fields->addField('cpassword');
$fields->addField('level');

$page = 13;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
$survayyear = ConstantsDB::getsurvayyear();

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
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'full_list':
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('full_list.php');
        break;
    case 'Add_surveyyear':
        $error = 0;
        $survayyear = ConstantsDB::getsurvayyear();
        include('add_surveyyear.php');
        break;
    case 'change_surveyyear':
        $survayyear = $_POST['survayyear'];
		$saveCount = ConstantsDB::addsurvayyear($survayyear);
		if ($saveCount == 1) {
            $error = 1;
        } else {
            $error = 5;
        }
        $survayyear = ConstantsDB::getsurvayyear();
        include('add_surveyyear.php');
        break;
    case 'add_ver_rpt':
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('add_ver_rpt.php');
        break;
    case 'save_ver_rpt':
		$id = $_GET['id'];
		$ver_brd_app = $_GET['ver_brd_app'];
		$ver_brd_rec = $_GET['ver_brd_rec'];
		$ver_brd_rej1 = $_GET['ver_brd_rej1'];
		$ver_brd_rej_rec1 = $_GET['ver_brd_rej_rec1'];
		$ver_brd_rej2 = $_GET['ver_brd_rej2'];
		$ver_brd_rej_rec2 = $_GET['ver_brd_rej_rec2'];
		$ver_brd_rej3 = $_GET['ver_brd_rej3'];
		$ver_brd_rej_rec3 = $_GET['ver_brd_rej_rec3'];
		$ver_brd_approved = $_GET['ver_brd_approved'];
		$saveCount = boardofsurveyDB::save_ver($id, $ver_brd_app, $ver_brd_rec, $ver_brd_rej1, $ver_brd_rej_rec1, $ver_brd_rej2, $ver_brd_rej_rec2, $ver_brd_rej3, $ver_brd_rej_rec3, $ver_brd_approved);
		echo $saveCount;
        break;
    case 'update_units':
		$Counts = boardofsurveyDB::update_units($survayyear);
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('add_ver_rpt.php');
        break;
    case 'add_con_rpt':
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('add_con_rpt.php');
        break;
    case 'save_con_rpt':
		$id = $_GET['id'];
		$con_brd_app = $_GET['con_brd_app'];
		$con_brd_rec = $_GET['con_brd_rec'];
		$con_brd_rej1 = $_GET['con_brd_rej1'];
		$con_brd_rej_rec1 = $_GET['con_brd_rej_rec1'];
		$con_brd_rej2 = $_GET['con_brd_rej2'];
		$con_brd_rej_rec2 = $_GET['con_brd_rej_rec2'];
		$con_brd_rej3 = $_GET['con_brd_rej3'];
		$con_brd_rej_rec3 = $_GET['con_brd_rej_rec3'];
		$con_brd_approved = $_GET['con_brd_approved'];
		$saveCount = boardofsurveyDB::save_con($id, $con_brd_app, $con_brd_rec, $con_brd_rej1, $con_brd_rej_rec1, $con_brd_rej2, $con_brd_rej_rec2, $con_brd_rej3, $con_brd_rej_rec3, $con_brd_approved);
		echo $saveCount;
        break;
    case 'add_des_rpt':
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('add_des_rpt.php');
        break;
    case 'save_des_rpt':
		$id = $_GET['id'];
		$des_brd_app = $_GET['des_brd_app'];
		$des_brd_rec = $_GET['des_brd_rec'];
		$saveCount = boardofsurveyDB::save_des($id, $des_brd_app, $des_brd_rec);
		echo $saveCount;
        break;
   case 'Add_surveyyear_schedule':
        $slidebartype = 1;
        $error = 0;
		$exp = boardofsurveyscheduleDB::getFullDetails($survayyear);
		include('add_surveyyear_schedule.php');
        break;
   case 'Add_surveyyear_schedule_record':
        $error = 0;
		$year = $_POST['year'];		
		$ver_brd_app = $_POST['ver_brd_app'];
		$ver_brd_rec = $_POST['ver_brd_rec'];
		$ver_brd_approved = $_POST['ver_brd_approved'];
		$con_brd_app = $_POST['con_brd_app'];
		$con_brd_rec = $_POST['con_brd_rec'];
		$con_brd_approved = $_POST['con_brd_approved'];		
		$des_brd_app = $_POST['des_brd_app'];
		$des_brd_rec = $_POST['des_brd_rec'];		
            $count = boardofsurveyscheduleDB::getHasRecord($year);
            if ($count > 0) {
                $saveCount = boardofsurveyscheduleDB::updateRecord($year, $ver_brd_app, $ver_brd_rec, $ver_brd_approved, $con_brd_app, $con_brd_rec, $con_brd_approved, $des_brd_app, $des_brd_rec);
                if ($saveCount == 1) {
                    $error = 2;
                } else {
                    $error = 6;
                }
            } else {
                $saveCount = boardofsurveyscheduleDB::addRecord($year, $ver_brd_app, $ver_brd_rec, $ver_brd_approved, $con_brd_app, $con_brd_rec, $con_brd_approved, $des_brd_app, $des_brd_rec);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
            }
       echo $error;
        break;
    case 'inquiry':
		$items = boardofsurveyDB::getFullDetails($survayyear);
        include('inquiry.php');
        break;
	case 'data_inquiry':
		$report = $_POST['report'];
		$status = $_POST['status'];
		$query = "";
		switch ($report){
		   case "ver":
				switch ($status){
					case "1":
						$query = " year(ver_brd_app) = 0 and";
					break;
					case "2":
						$query = " year(ver_brd_app) <> 0 and year(ver_brd_rec) = 0 and";
					break;
					case "3":
						$query = " year(ver_brd_app) <> 0 and year(ver_brd_rec) <> 0 and year(ver_brd_rej1) <> 0 and year(ver_brd_rej_rec1) = 0 and";
					break;
					case "4":
						$query = " year(ver_brd_app) <> 0 and year(ver_brd_rec) <> 0 and year(ver_brd_approved) = 0 and";
					break;
					case "5":
						$query = " year(ver_brd_app) <> 0 and year(ver_brd_rec) <> 0 and year(ver_brd_approved) <> 0 and";
					break;
				}
				break;
		   case "con":
				switch ($status){
					case "11":
						$query = " year(con_brd_app) = 0 and";
					break;
					case "12":
						$query = " year(con_brd_app) <> 0 and year(con_brd_rec) = 0 and";
					break;
					case "13":
						$query = " year(con_brd_app) <> 0 and year(con_brd_rec) <> 0 and year(con_brd_rej1) <> 0 and year(con_brd_rej_rec1) = 0 and";
					break;
					case "14":
						$query = " year(con_brd_app) <> 0 and year(con_brd_rec) <> 0 and year(con_brd_approved) = 0 and";
					break;
					case "15":
						$query = " year(con_brd_app) <> 0 and year(con_brd_rec) <> 0 and year(con_brd_approved) <> 0 and";
					break;
				}
				break;
		   case "des":
					switch ($status){
					case "21":
						$query = " year(des_brd_app) = 0 and";
					break;
					case "22":
						$query = " year(des_brd_app) <> 0 and year(con_brd_rec) = 0 and";
					break;
					}
		   
		   
		   
		   
		   
		   /* 				option += '<option value="21">Not Appoint</option>';
				option += '<option value="12">Appointed Not Approved</option>';
				option += '<option value="15">Approved</option>'; */		
			   break;
		}
		
		$items = boardofsurveyDB::queryDetails($query, $survayyear);
		echo json_encode( $items );
        break;
    case 'Add_Units':
		$slidebartype = 2;
        $error = 0;
		$assetscenter ="";
		if (isset($_POST['center'])) {
			$id = $_POST['id'];
			$sorder = $_POST['sorder'];
			$saveCount = BoardOfSurvey_UnitDB::updatesorder($id, $sorder);
			$assetscenter = $_POST['center'];
			$Centersorder = AssetsCenterDB::getsorder($assetscenter);
			$counterId = sprintf("%03d", $sorder);
			$abc = $Centersorder.$counterId;
			$abc = (int)$abc;
			$saveCount2 = BoardOfSurvey_UnitDB::centerupdatesorder($id, $abc);
		}
		$unitName = "";
		$centreNo = "";
		//$centreName = "";
		$centreID = "";
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $exps = BoardOfSurvey_UnitDB::getAssetsUnitsByCenterArray($assetscenter);
        include('add_units.php');
        break;
	case 'Add_Unit':
	    $slidebartype = 2;
        $error = 0;
        $assetscenter = $_POST['assetscenter'];
		$unitName = $_POST['unitName'];
		$centreID = $_POST['centreID'];
        $validate->text('assetscenter', $assetscenter);
		$validate->text('unitName', $unitName);
		$validate->text('centreID', $centreID);
        if ($fields->hasErrors()) {
            $error = 2;
        } else {
            $count = BoardOfSurvey_UnitDB::getHasRecord($unitName);
			$count1 = BoardOfSurvey_UnitDB::getHasRecord1($centreID);
            $count = $count + $count1;
			if ($count > 0) {
                $error = 3;
            } else {
                $saveCount = BoardOfSurvey_UnitDB::addRecord($assetscenter, $unitName, $centreID);
                if ($saveCount == 1) {
                    $error = 1;
                } else {
                    $error = 5;
                }
            }
        }
         $exps = BoardOfSurvey_UnitDB::getAssetsUnitsByCenterArray($assetscenter);
		 $assetsCenters = AssetsCenterDB::getAssetsCenters();
        include('add_units.php');  	
	 break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_REQUEST['center'];
        $assetunit = "";
        $exps = BoardOfSurvey_UnitDB::getAssetsUnitsByCenterArray($assetscenter);
	   ?>
		<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>Unit Name</th>
															<th>Unit ID</th>
															<th>S Order</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['unitName']; ?></td>
															<td><?php echo $exp['centreID']; ?></td>
															<td>
																<form name="add_form" id="add_form" class="add_form" action="." method="post">
																	<input type="hidden" name="action" id="action" value="Add_Units" />									
																	<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
																	<input type="hidden" name="center" id="center" value="<?php echo $exp['centreName']; ?>"/>
																	<input type="number" name="sorder" id="sorder" style="text-align:right;" value="<?php echo $exp['sorder']; ?>">
																	<input name="submit" type="submit" value="Save"/>
																</form>
																</td>
															<td><?php echo $exp['Active']; ?></td>
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>
													  </div>
													  </div>
												</div>
		<?php										
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
		$exps = dos_materialmasterDB::save_asset_sinhala_name($_GET['id'], $_GET['s_description'], $_GET['sub_category'], $_GET['main_category']);
		echo json_encode($exps);
		break;
    case 'add_opening_balance':
		$exp = bos_openingbalance_report_recevingDB::getDetailsByAssetunit($assetunit);
		if (strtotime($exp['received_date'] ?? "")) {
			$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
			include 'opening_balance_list.php';
		} else {
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
		}
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
		$count = AssetsUnitDB::change_units_details_save($_GET['id'], $_GET['unitName'], $_GET['centreID'], $_GET['protocoltext1'], $_GET['protocoltext2'], $_GET['protocollevel1'], $_GET['protocollevel2'], $_GET['protocollevel3'], $_GET['protocollevel4']);
		echo $count;
	break;
    case 'print_opening_balance':
	    $items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
		include('print_opening_balance.php');
	break;
    case 'only_bos_unit_list':
		$unit_type = 1;
		$exps = AssetsUnitDB::getFullList_unittype($unit_type);
		include 'only_bos_unit_list.php';
		break;
	case 'only_bos_user_list':
        $exps = MembersDB::getAllDetailsLevels(17);
        include('user_list.php');
        break;
case 'add_yearend_report_receving':
	$slidebartype = 9;
	$currentYear = ConstantsDB::getCurrentYear();
	$exps = AssetsUnitDB::getAllActiveunits();
	include('add_yearend_report_receving.php');
	break;
case 'add_yearend_report_receving_save':
	$count = bos_openingbalance_report_recevingDB::getHasRecord($_GET['unit']);
	if ($count == 0) {
		$exps = bos_openingbalance_report_recevingDB::addRecord($_GET['unit'], $_GET['received_date'], $_GET['approved_date']);
	} else {
		$exps = bos_openingbalance_report_recevingDB::updateRecord($_GET['unit'], $_GET['received_date'], $_GET['approved_date']);
	}
	echo json_encode($exps);
	break;
case 'summary_list_catlogue':
	$items = bos_openingbalanceDB::summary_list_catlogue();
	include 'summary_list_catlogue.php';
	break;
case 'summary_list_catlogue_unit':
	$items = bos_openingbalanceDB::summary_list_catlogue_unit($_GET['itemcode']);
	include 'summary_list_catlogue_unit.php';
	break;
case 'view_opening_balance_unit':
	$items = bos_openingbalanceDB::getDescriptionList_unit($_POST['assetunit']);
	include 'opening_balance_list_2.php';
	break;
case 'reset_passwords':
	$assetscenter = "";
	$assetunit = "";
	$firstname = "";
	$lastname = "";
	$login = "";
	$passwd = "";
	$cpassword = "";
	$level = "";
	$error = 0;
	$exps = MembersDB::get_users_unit_login($assetunit, 17);
	include('passwordreset-form.php');
	break;
case 'get_users_unit':
	$assetunit = $_GET['assetunit'];
	$exps = MembersDB::get_users_unit_login($assetunit, 17);
	echo json_encode( $exps );
	break;
case 'findAssetsUnitsByCenter_Ajax':
	$assetscenter = $_GET['center'];
	$units = array();
	$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
	foreach ($assetunits as $unit) {
	$units[] = $unit->getName(); }
	echo json_encode( $units );
	break;
case 'reset_password':
	$assetscenter = $_POST['assetscenter'];
	$assetunit = $_POST['assetunit'];
	$login = $_POST['login'];
	$validate->text('assetscenter', $assetscenter);
	$validate->text('assetunit', $assetunit);
	$validate->text('login', $login);
	$error = 0;
	$slidebartype = 3;
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		if ($login != '') {
			$result = array();
            $result = get_users_selected_by_login($login, $assetscenter, $assetunit);
			// $qry = "SELECT * FROM members WHERE login='$login' and centreName='$assetscenter' and place='$assetunit'";
			// $result = mysql_query($qry);
			if (count($result) == 1) {
				// $member = mysql_fetch_assoc($result);
				$member = $result[0];
				$level = $member['level'];
				if ($level == 17) {
					$passwd = '1234';
					$date = date('Y-m-d H:i:s');
					// $qry = "UPDATE members SET passwd = '" . md5($passwd)."', pw_update = '".$date."', fail_attempts = 0, deactive = 0 WHERE login='$login' and centreName='$assetscenter' and place='$assetunit'";
					// $result = @mysql_query($qry);
					$result = array();
                    $result = resetPassword($passwd, $date, $login, $assetscenter, $assetunit);
					if ($result) {
						$saveCount = user_account_change_historyDB::addRecord($assetunit, $login, "Reset Password", md5($passwd), $_SESSION['SESS_LOGIN']);
						$error = 1;
						$assetscenter = "";
						$assetunit = "";
						$login = "";
						
					} else {
						$error = 5;
					}
				}
				
			} else {
				$error = 3;
			}
			
		} else {
			$error = 6;
		}
	}
	$exps = MembersDB::get_users_unit_login($assetunit, 17);
	include('passwordreset-form.php');
	break;
case 'yearend_report_add_summary':
	$slidebartype = 9;
	$exps = bos_openingbalanceDB::yearend_report_add_summary();
	include('yearend_report_add_summary.php');
	break;
case 'compare_fa_system':
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
	$cyear = 2020;
	$assetsCenters = AssetsCenterDB::getAssetsCenters();
	$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
	$items = board_report_summaryDB::getFullDetails_ignoreItem($cyear, $assetunit);
	$bos_items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
	include('compare_fa_system.php');
	break;
case 'edit_opening_balance':
	$exp = bos_openingbalance_report_recevingDB::getDetailsByAssetunit($assetunit);
	if (strtotime($exp['received_date'] ?? "")) {
		$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
		include 'opening_balance_list.php';
	} else {
		$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
		include 'edit_opening_balance.php';
	}
	break;
case 'delete_opening_balance':
	$exps = bos_openingbalanceDB::delete_opening_balance($_GET['id']);
	echo json_encode($exps);
	break;
case 'get_category_from_excel':
	$items = dos_materialmasterDB::getFullDetails_dos_full_list();
	 foreach ($items as $exp) {
		$count = dos_materialmasterDB::update_sub_category_main_category($exp['catlogueno'], $exp['sub_category'], $exp['main_category']);
	 }
	 echo json_encode($count);
	break;
case 'add_opening_balance_2':
	$exp = bos_openingbalance_report_recevingDB::getDetailsByAssetunit($assetunit);
	$main_category_2 = "";
	$sub_category_2 = "";
	$description_2 = "";
	if (strtotime($exp['received_date'] ?? "")) {
		$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
		include 'opening_balance_list.php';
	} else {
		if (isset($_POST['search'])) {
				if ($_POST['main_category'] == "" && $_POST['sub_category'] == "" && $_POST['description'] == "") {
					$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);	
				} else {
					$main_category_2 = $_POST['main_category'];
					$sub_category_2 = $_POST['sub_category'];
					$description_2 = $_POST['description'];					
					$items = dos_materialmasterDB::getDescriptionList_search_2($_POST['main_category'], $_POST['sub_category'], $_POST['description'], $assetunit);
				}
			} else {
				$items = bos_openingbalanceDB::getDescriptionList_unit($assetunit);
			}	
			$main_categorys = dos_materialmasterDB::getUnique_main_category();
			if (isset($_POST['main_category']) && $_POST['main_category'] != "") {
				$sub_categorys = dos_materialmasterDB::getsub_category($_POST['main_category']);
				if (isset($_POST['sub_category']) && $_POST['sub_category'] != "") {			
					$descriptions = dos_materialmasterDB::getDescription_main_sub($_POST['main_category'], $_POST['sub_category']);
			}}

			include 'add_opening_balance_2.php';
	}
	break;
case 'getsub_category':
	$exps = dos_materialmasterDB::getsub_category($_GET['main_category']);
	echo json_encode($exps);
	break;
case 'getDescriptionList_2':
	$exps = dos_materialmasterDB::getDescriptionList_2($_GET['main_category'], $_GET['sub_category'], $_GET['description']);
	echo json_encode($exps);
	break;	
}
?>