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

require_once('../model/fields.php');
require_once('../model/validate.php');
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('assetscenter');
$fields->addField('unitName');
$fields->addField('centreID');
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
}
?>