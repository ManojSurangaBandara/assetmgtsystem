<?php
ini_set('max_execution_time', 1000);
ini_set('memory_limit', '2G');
require_once('../php-login/auth.php');
require('../model/database.php');
require('../model/catalogue_db.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require('../model/institute_db.php');
require('../model/buyerdetails_db.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/landcategory_db.php');
require('../model/land_db.php');
require('../model/buildingcategory_db.php');
require('../model/building_db.php');
require('../model/province_db.php');
require('../model/province.php');
require('../model/district_db.php');
require('../model/district.php');
require('../model/dsdivision_db.php');
require('../model/dsdivision.php');
require('../model/gsdivision_db.php');
require('../model/comment_db.php');
require('../model/plantmac_db.php');
require('../model/officeequ_db.php');
require('../model/vehicle_db.php');
require('../model/brand_db.php');
require('../model/model_db.php');
require('../model/unitdetails_db.php');
require('../model/unitmembers_db.php');
require('../model/errorcode_db.php');
require('../model/protocallist_db.php');
require('../model/orbat_db.php');
require('../model/places_db.php');
require('../model/ordinance_places_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/logindetails_db.php');
require('../model/members_db.php');
require('../model/present_location_db.php');
require('../model/board_report_db.php');
require('../model/board_report_observations_db.php');
require('../model/board_report_summary_db.php');
require('../model/change_unit_name_history_db.php');
require('../model/user_account_change_history_db.php');
require('../model/allocation_details_db.php');
require('../model/dos_materialmaster_db.php');
require('../model/vehicle_repairtype_db.php');
$page = 8;
$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
require_once('../model/language.php');
// Add fields with optional initial message
$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('classification');
$fields->addField('mainCategory');
$fields->addField('itemCategory');
$fields->addField('description');
$fields->addField('make');
$fields->addField('modle');
$fields->addField('voteHead');
$fields->addField('newAssestno');
$fields->addField('assetsno');
$fields->addField('catalogueno');
$fields->addField('instName');
$fields->addField('name');
$fields->addField('comment');
$fields->addField('assetscenter');
$fields->addField('unitName');
$fields->addField('centreID');
$fields->addField('categoryName');
$fields->addField('district');
$fields->addField('dsDivision');
$fields->addField('district');
$fields->addField('dsDivision');
$fields->addField('gsDivision');
$fields->addField('nicno');
$fields->addField('unit_type');


if (isset($_POST['action'])) {
	$action = $_POST['action'];
} else if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = 'startpage';
}

$sql = "SELECT displaytype FROM members WHERE member_id = $memId";
// $result = $db->query($sql);
$result = array();
try {
		$statement = $db->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
} catch (PDOException $e) {
	$error_message = $e->getMessage();
	display_db_error($error_message);
}
$displaytype = "";

if(count($result) == 1) {
	$displaytype = $result[0]['displaytype'];
}

$assetscenter = $_SESSION['SESS_CENTRE'];
$assetunit = $_SESSION['SESS_PLACE'];
$Qinfo = QuickInfoDB::getActivatedDetails();
$logo = unitdetailsDB::getCrestByUnit($assetunit);

if (empty($logo)) {
	$logo = "../pic/1.jpg";
}
switch ($action) {
	case 'startpage':
		$slidebartype = 1;
		include('startpage.php');
		break;
	case 'formdisplaychange':
		$i = $_POST['i'];
		$sql = "UPDATE members SET displaytype = $i WHERE member_id = $memId";
		$result = $db->query($sql);
		break;
	case 'List_Details':
		$items = CalalogueDB::getFullDetails();
		include('full_list.php');
		break;
	case 'catalogue_book':
		$slidebartype = 1;
		include('catalogue_book.php');
		break;
	case 'Add_Catalogue':
		$slidebartype = 2;
		$error = 0;
		$classification = "";
		$mainCategory = "";
		$itemCategory = "";
		$description = "";
		$make = "";
		$modle = "";
		$voteHead = "";
		$newAssestno = "";
		$assetsno = "";
		$catalogueno = "";

		$maincategorys = CatalogueDB::getMainCategoryByClassification("");
		$itemCategorys = CatalogueDB::getItemCategoryByMainCategory("");
		include('add_catalogue.php');
		break;
	case 'Add_Catalogue_withlist':
		$slidebartype = 2;
		$error = 0;
		$classification = "";
		$mainCategory = "";
		$itemCategory = "";
		$description = "";
		$make = "";
		$modle = "";
		$voteHead = "";
		$newAssestno = "";
		$assetsno = "";
		$catalogueno = "";

		$maincategorys = CatalogueDB::getMainCategoryByClassification("");
		$itemCategorys = CatalogueDB::getItemCategoryByMainCategory("");
		$items = CatalogueDB::getCatalogue();
		include('add_catalogue_withlist.php');
		break;
	case 'delete_catelog_Item':
		$id = $_POST['id'];
		$result = CatalogueDB::deleteRecord($id);
		$slidebartype = 2;
		$error = 0;
		$classification = $_POST['classification'];
		$mainCategory = $_POST['mainCategory'];
		$itemCategory = $_POST['itemCategory'];
		$description = "";
		$make = "";
		$modle = "";
		$voteHead = "";
		$newAssestno = "";
		$assetsno = "";
		$catalogueno = "";

		$maincategorys = CatalogueDB::getMainCategoryByClassification($classification);
		$itemCategorys = CatalogueDB::getItemCategoryByMainCategory($mainCategory);
		$items = CatalogueDB::getCataloguemainitem($classification, $mainCategory, $itemCategory);
		include('add_catalogue_withlist.php');
		break;
	case 'findMianCategory':
		$classification = $_GET['classification'];
		$maincategorys = CatalogueDB::getMainCategoryByClassification($classification);
		?>
        <div id="Unitdiv">
            <select name="mainCategory"  onChange="getDistrictByProvince('index.php?action=findItemCategory&mainCategory=' + this.value)">
                <option value=""></option>
                <?php foreach ($maincategorys as $maincate) { ?>
                    <option value="<?php echo $maincate['mainCategory']; ?>">
                        <?php echo $maincate['mainCategory']; ?>
                    </option>
                <?php 
														} ?>
            </select>
            <?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
        </div>
        <?php
							break;
						case 'findItemCategory':
							$mainCategory = $_GET['mainCategory'];
							$itemCategorys = CatalogueDB::getItemCategoryByMainCategory($mainCategory);
							?>
        <div id="Disdiv">
            <select name="itemCategory">
                <option value=""></option>
                <?php foreach ($itemCategorys as $itemCate) { ?>
                    <option value="<?php echo $itemCate['itemCategory']; ?>">
                        <?php echo $itemCate['itemCategory']; ?>
                    </option>
                <?php 
														} ?>
            </select>
            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
        </div>
        <?php
							break;
						case 'Add_Detail':
							$classification = $_POST['classification'];
							$mainCategory = $_POST['mainCategory'];
							$itemCategory = $_POST['itemCategory'];
							$description = $_POST['description'];
							$make = $_POST['make'];
							$modle = $_POST['modle'];
							$voteHead = $_POST['voteHead'];
							$newAssestno = $_POST['newAssestno'];
							$assetsno = $_POST['assetsno'];
							$catalogueno = $_POST['catalogueno'];
							$add = $_POST['add'] ?? '';

							$validate->text('classification', $classification);
							$validate->text('mainCategory', $mainCategory);
							$validate->text('itemCategory', $itemCategory);
							if (isset($_POST['search'])) {
		//$exps = get_users_selected($assetscenter, $assetunit);
								$slidebartype = 2;
								$error = 0;
								$maincategorys = CatalogueDB::getMainCategoryByClassification($classification);
								$itemCategorys = CatalogueDB::getItemCategoryByMainCategory($mainCategory);
								$items = CatalogueDB::getCataloguemainitem($classification, $mainCategory, $itemCategory);
								include('add_catalogue_withlist.php');
							} else {
								$validate->text('description', $description);
								$validate->text('voteHead', $voteHead);
        //$validate->text('newAssestno', $newAssestno);
								$validate->text('assetsno', $assetsno);
								$validate->text('catalogueno', $catalogueno);
        // Load appropriate view based on hasErrors
								if ($fields->hasErrors()) {
									$error = 2;
            // include('ADD_Building_Details.php');
								} else {
									if ($add <> 0) {
										CatalogueDB::deleteRecord($add);
										$add = 0;
									}
									$count = CatalogueDB::getHasRecord($catalogueno);
									if ($count > 0) {
										$error = 3;
									} else {
										$saveCount = CatalogueDB::addRecord($classification, $mainCategory, $itemCategory, $description, $make, $modle, $voteHead, $newAssestno, $assetsno, $catalogueno);
										if ($saveCount == 1) {
											$error = 1;
										} else {
											$error = 5;
										}
									}
								}

								$slidebartype = 2;
								$items = CatalogueDB::getCataloguemainitem($classification, $mainCategory, $itemCategory);
								$maincategorys = CatalogueDB::getMainCategoryByClassification($classification);
								$itemCategorys = CatalogueDB::getItemCategoryByMainCategory($mainCategory);
								include('add_catalogue_withlist.php');
							}
							break;
						case 'List_Inquiry':
							if (isset($_POST['searchby'])) {
								$searchby = $_POST['searchby'];
							} else if (isset($_GET['searchby'])) {
								$searchby = $_GET['searchby'];
							} else {
								$searchby = "";
							}

							if (isset($_POST['search'])) {
								$search = $_POST['search'];
							} else if (isset($_GET['search'])) {
								$search = $_GET['search'];
							} else {
								$search = "";
							}
							$column = "";
							switch ($searchby) {
								case 'Main Category':
									$column = "mainCategory";
									break;
								case 'Item Category':
									$column = "itemCategory";
									break;
								case 'Item Description':
									$column = "itemDescription";
									break;
								case 'Catalogue Number':
									$column = "catalogueno";
									break;
								case 'Make':
									$column = "make";
									break;
								case 'Model':
									$column = "modle";
									break;
								case 'New Classification of Asset':
									$column = "newAssestno";
									break;
								case 'Present Asset No':
									$column = "assetsno";
									break;
							}
							$items = CatalogueDB::getInqDetails($column, $search);
							if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
								include('excel_catelog_list.php');
							}
							if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
            //$assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
								include('print_catelog_list.php');
							}
							include('inquiry_catalogue.php');
							break;
						case 'List_Inquiry_ajax':
							if (isset($_POST['searchby'])) {
								$searchby = $_POST['searchby'];
							} else if (isset($_GET['searchby'])) {
								$searchby = $_GET['searchby'];
							} else {
								$searchby = "";
							}

							if (isset($_POST['search'])) {
								$search = $_POST['search'];
							} else if (isset($_GET['search'])) {
								$search = $_GET['search'];
							} else {
								$search = "";
							}
							$column = "";
							switch ($searchby) {
								case 'Main Category':
									$column = "mainCategory";
									break;
								case 'Item Category':
									$column = "itemCategory";
									break;
								case 'Item Description':
									$column = "itemDescription";
									break;
								case 'Catalogue Number':
									$column = "catalogueno";
									break;
								case 'Make':
									$column = "make";
									break;
								case 'Modle':
									$column = "modle";
									break;
								case 'New Classification of asset':
									$column = "newAssestno";
									break;
								case 'Present Asst No':
									$column = "assetsno";
									break;
							}
							$items = CatalogueDB::getInqDetails($column, $search);
							if (isset($_POST['ExpToExcel']) && $_POST['ExpToExcel'] == '1') {
								include('excel_catelog_list.php');
							}
							if (isset($_POST['ExpToPdf']) && $_POST['ExpToPdf'] == '1') {
            //$assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
								include('print_catelog_list.php');
							}
							include('inquiry_catalogue_ajax.php');
							break;
						case 'List_Inquiry_ajax1':

							break;
						case 'get_catlogDetail_Ajax':
							$id = $_GET['id'];
							$exps = CatalogueDB::getcatlogDetailByid($id);
							echo json_encode($exps);
							break;
						case 'boardmember_details':
							$items = AssetsUnitDB::getFullList();
							include('boardmember_details.php');
							break;
						case 'Add_BoardMembers':
							$slidebartype = 1;
							$error = 0;
							$assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
							$boardMemberName1 = $assetunits['boardMemberName1'];
							$boardMemberRank1 = $assetunits['boardMemberRank1'];
							$boardMemberNumber1 = $assetunits['boardMemberNumber1'];
							$email1 = $assetunits['email1'];
							$boardMemberName2 = $assetunits['boardMemberName2'];
							$boardMemberRank2 = $assetunits['boardMemberRank2'];
							$boardMemberNumber2 = $assetunits['boardMemberNumber2'];
							$email2 = $assetunits['email2'];
							$boardMemberName3 = $assetunits['boardMemberName3'];
							$boardMemberRank3 = $assetunits['boardMemberRank3'];
							$boardMemberNumber3 = $assetunits['boardMemberNumber3'];
							$email3 = $assetunits['email3'];
							include('add_boardmembers.php');
							break;
						case 'Add_BoardMember':
							$slidebartype = 1;
							$assetunits = AssetsUnitDB::getAllDetailsUnit($assetunit);
							$boardMemberName1 = $_POST['boardMemberName1'];
							$boardMemberRank1 = $_POST['boardMemberRank1'];
							$boardMemberNumber1 = $_POST['boardMemberNumber1'];
							$email1 = $_POST['email1'];
							$boardMemberName2 = $_POST['boardMemberName2'];
							$boardMemberRank2 = $_POST['boardMemberRank2'];
							$boardMemberNumber2 = $_POST['boardMemberNumber2'];
							$email2 = $_POST['email2'];
							$boardMemberName3 = $_POST['boardMemberName3'];
							$boardMemberRank3 = $_POST['boardMemberRank3'];
							$boardMemberNumber3 = $_POST['boardMemberNumber3'];
							$email3 = $_POST['email3'];

							$saveCount = AssetsUnitDB::addMembers($assetunit, $boardMemberName1, $boardMemberRank1, $boardMemberNumber1, $email1, $boardMemberName2, $boardMemberRank2, $boardMemberNumber2, $email2, $boardMemberName3, $boardMemberRank3, $boardMemberNumber3, $email3);
							if ($saveCount == 1) {
								$error = 1;
							} else {
								$error = 5;
							}

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
							include('add_boardmembers.php');
							break;
						case 'Add_Institutes':
							$slidebartype = 2;
							$error = 0;
							$instName = "";
							$instAddress = "";
							$instTele = "";
							$instEmail = "";
							$exps = InstituteDB::getFullDetails();
							include('add_institute.php');
							break;
						case 'Add_Institute':
							$slidebartype = 2;
							$error = 0;
							$instName = $_POST['instName'];
							$instAddress = $_POST['instAddress'];
							$instTele = $_POST['instTele'];
							$instEmail = $_POST['instEmail'];
							$validate->text('instName', $instName);
							if ($fields->hasErrors()) {
								$error = 2;
							} else {
								$count = InstituteDB::getHasRecord($instName);
								if ($count > 0) {
									$error = 3;
								} else {
									$saveCount = InstituteDB::addRecord($instName, $instAddress, $instTele, $instEmail);
									if ($saveCount == 1) {
										$error = 1;
									} else {
										$error = 5;
									}
								}
							}
							$exps = InstituteDB::getFullDetails();
							include('add_institute.php');
							break;
						case 'delete_institute':
							$id = $_POST['id'];
							$delCount = InstituteDB::deleteRecordById($id);
							$slidebartype = 2;
							$error = 0;
							$instName = "";
							$instAddress = "";
							$instTele = "";
							$instEmail = "";
							$exps = InstituteDB::getFullDetails();
							include('add_institute.php');
							break;
						case 'Add_AssetYear':
							$slidebartype = 1;
							$error = 0;
							$currentYear = ConstantsDB::getCurrentYear();
        // $currentYear = $currentYears['currentYear'];
							include('add_assetyear.php');
							break;
						case 'Change_AssetYear':
							$slidebartype = 1;
							$currentYear = $_POST['currentYear'];
							$saveCount = ConstantsDB::addCurrentYear($currentYear);
							if ($saveCount == 1) {
								$error = 1;
							} else {
								$error = 5;
							}
							$currentYear = ConstantsDB::getCurrentYear();
							include('add_assetyear.php');
							break;
						case 'add_quickinfos':
							$slidebartype = 2;
							$error = 0;
							$title = "";
							$details = "";
							$id = 0;
							$activate = 0;
							$Items = QuickInfoDB::getFullDetails();
							include('add_quickinfo.php');
							break;
						case 'Add_QuickInfo':
							$title = $_POST['name'];
							$details = mysql_real_escape_string($_POST['comment']);
		//$details = $_POST['comment'];
							$id = $_POST['id'];
							$activate = (isset($_POST['activate']) ? 1 : 0);
							$validate->text('name', $title);
       // $validate->text('comment', $details);
							if ($fields->hasErrors()) {
								$error = 2;
							} else {
								if ($id > 0) {
									$saveCount = QuickInfoDB::updateRecord($title, $details, $activate, $id);
								} else {
									$saveCount = QuickInfoDB::addRecord($title, $details, $activate);
								}
								if ($saveCount == 1) {
									$error = 1;
									$id = 0;
									$title = "";
									$details = "";
								} else {
									$error = 5;
								}
							}

							$slidebartype = 2;
							$Items = QuickInfoDB::getFullDetails();
							include('add_quickinfo.php');
							break;
						case 'Display_QuickInfos':
							$id = $_GET['id'];
							$Info = QuickInfoDB::getDetailsById($id);
							$title = $Info['title'];
							$details = $Info['details'];
							$activate = $Info['activate'];
							$slidebartype = 2;
							$error = 0;
							$Items = QuickInfoDB::getFullDetails();
							include('add_quickinfo.php');
							break;
						case 'View_QuickInfos':
							$id = $_GET['id'];
							$Info = QuickInfoDB::getDetailsById($id);
							$comments = QuickInfoDB::getCommentsById($id);
							$title = $Info['title'];
							$details = $Info['details'];
							$slidebartype = 2;
							$error = 0;
							$Items = array();
							include('view_quickinfo.php');
							break;
						case 'Add_Comments':
							$comment = $_GET['comment'];
							$id = $_GET['id'];
							$unit = ' ' . $_SESSION['SESS_FIRST_NAME'] . ' - ' . $assetunit;
							$activate = (isset($_POST['activate']) ? 1 : 0);
        //$validate->text('comment', $comment);
							if ($fields->hasErrors()) {
								$error = 2;
							} else {
								$saveCount = QuickInfoDB::addComments($id, $comment, $unit);
								if ($saveCount == 1) {
									$error = 1;
								} else {
									$error = 5;
								}
							}

							$slidebartype = 2;
							$Info = QuickInfoDB::getDetailsById($id);
							$title = $Info['title'];
							$details = $Info['details'];
							$comments = QuickInfoDB::getCommentsById($id);
							$Items = array();
							include('view_quickinfo.php');
							break;
						case 'Delete_Comments':
							$sqno = $_GET['sqno'];
							$id = $_GET['id'];
							$saveCount = QuickInfoDB::deleteComments($sqno);
							$slidebartype = 2;
							$Info = QuickInfoDB::getDetailsById($id);
							$title = $Info['title'];
							$details = $Info['details'];
							$comments = QuickInfoDB::getCommentsById($id);
							$Items = array();
							include('view_quickinfo.php');
							break;
						case 'Add_UnitCentres':
							$slidebartype = 2;
							$error = 0;
							$instName = "";
							if (isset($_POST['sorder'])) {
								$id = $_POST['id'];
								$sorder = $_POST['sorder'];
								$saveCount = AssetsCenterDB::updatesorder($id, $sorder);
							}
							$exps = AssetsCenterDB::getAssetsCentersAlls();
		//foreach($exps as $exp) {
		//	$centers[] = $exp['centreName'];
		//}
/*
		function record_sort($records, $field, $reverse=false)
{
    $hash = array();
    foreach($records as $record) {
        $hash[$record[$field]] = $record;
    }
    ($reverse)? krsort($hash) : ksort($hash);
    $records = array();
    foreach($hash as $record){
        $records []= $record;
    }
    return $records;
}
	$exps = record_sort($exps, "sorder");
//		array_sort($exps, 'centreName', SORT_DESC);
							 */
							include('add_unitcentre.php');
							break;
						case 'Add_UnitCentre':
							$slidebartype = 2;
							$error = 0;
							$instName = $_POST['instName'];
							$validate->text('instName', $instName);
							if ($fields->hasErrors()) {
								$error = 2;
							} else {
								$count = AssetsCenterDB::getHasRecord($instName);
								if ($count > 0) {
									$error = 3;
								} else {
									$saveCount = AssetsCenterDB::addRecord($instName);
									if ($saveCount == 1) {
										$error = 1;
									} else {
										$error = 5;
									}
								}
							}
							$exps = AssetsCenterDB::getAssetsCentersAlls();
							include('add_unitcentre.php');
							break;
						case 'Add_Units':
							$slidebartype = 2;
							$error = 0;
							$assetscenter = "";
							if (isset($_POST['center'])) {
								$id = $_POST['id'];
								$sorder = $_POST['sorder'];
								$saveCount = AssetsUnitDB::updatesorder($id, $sorder);
								$assetscenter = $_POST['center'];
								$Centersorder = AssetsCenterDB::getsorder($assetscenter);
								$counterId = sprintf("%03d", $sorder);
								$abc = $Centersorder . $counterId;
								$abc = (int)$abc;
								$saveCount2 = AssetsUnitDB::centerupdatesorder($id, $abc);
							}
							$unitName = "";
							$centreNo = "";
							$unit_type = 0;
		//$centreName = "";
							$centreID = "";
							$assetsCenters = AssetsCenterDB::getAssetsCenters();
							$exps = AssetsUnitDB::getAssetsUnitsByCenterArray_ut($assetscenter);
							include('add_units.php');
							break;
						case 'findAssetsUnitsByCenter':
							$assetscenter = $_REQUEST['center'];
							$assetunit = "";
							$exps = AssetsUnitDB::getAssetsUnitsByCenterArray_ut($assetscenter);
							?>
		<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>Unit Type</th>
															<th>Unit Name</th>
															<th>Unit ID</th>
															<th>S Order</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach ($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																								echo "first";
																							} else {
																								echo "second";
																							} ?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['unit_type']; ?></td>
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
														<?php 
												} ?>
													  </tbody>
													  </table>
													  </div>
													  </div>
												</div>
		<?php	
	break;
case 'Add_Unit':
	$slidebartype = 2;
	$error = 0;
	$assetscenter = $_POST['assetscenter'];
	$unitName = $_POST['unitName'];
	$centreID = $_POST['centreID'];
	$unit_type = $_POST['unit_type'];
	$validate->text('assetscenter', $assetscenter);
	$validate->text('unitName', $unitName);
	$validate->text('centreID', $centreID);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = AssetsUnitDB::getHasRecord($unitName);
		$count1 = AssetsUnitDB::getHasRecord1($centreID);
		$count = $count + $count1;
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = AssetsUnitDB::addRecord($assetscenter, $unitName, $centreID, $unit_type);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$exps = AssetsUnitDB::getAssetsUnitsByCenterArray_ut($assetscenter);
	$assetsCenters = AssetsCenterDB::getAssetsCenters();
	include('add_units.php');
	break;
case 'Add_Land_Categorys':
	$slidebartype = 2;
	$error = 0;

	$categoryName = "";
	$description = "";
	$vote = "";
	$classification = "";
	$assetno = "";
	$catalogueno = "";

	$exps = LandCategoryDB::getLandCategorysArray();
	include('add_land_categorys.php');
	break;
case 'Add_Land_Category':
	$slidebartype = 2;
	$error = 0;

	$categoryName = $_POST['categoryName'];
	$description = $_POST['description'];
	$vote = $_POST['vote'];
	$classification = $_POST['classification'];
	$assetno = $_POST['assetno'];
	$catalogueno = $_POST['catalogueno'];
	$validate->text('categoryName', $categoryName);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = LandCategoryDB::getHasRecord($categoryName);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = LandCategoryDB::addRecord($categoryName, $description, $vote, $classification, $assetno, $catalogueno);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$exps = LandCategoryDB::getLandCategorysArray();
	include('add_land_categorys.php');
	break;
case 'Delete_Land_Category':
	$slidebartype = 2;
	$error = 0;
	$id = $_POST['id'];
	$categoryName = $_POST['categoryName'];
	$count = LandDB::getHasLand_CategoryInLand($categoryName);
	if ($count > 0) {
		$error = 3;
	} else {
		$delCount = LandCategoryDB::deleteLand_Category($id);
		$error = 6;
	}
	$categoryName = "";
	$description = "";
	$vote = "";
	$classification = "";
	$assetno = "";
	$catalogueno = "";
	$exps = LandCategoryDB::getLandCategorysArray();
	include('add_land_categorys.php');
	break;
case 'Add_Building_Categorys':
	$slidebartype = 2;
	$error = 0;

	$categoryName = "";
	$description = "";
	$vote = "";
	$classification = "";
	$assetno = "";
	$catalogueno = "";

	$exps = BuildingCategoryDB::getBuildingCategorysArray();
	include('add_building_categorys.php');
	break;
case 'Add_Building_Category':
	$slidebartype = 2;
	$error = 0;

	$categoryName = $_POST['categoryName'];
	$description = $_POST['description'];
	$vote = $_POST['vote'];
	$classification = $_POST['classification'];
	$assetno = $_POST['assetno'];
	$catalogueno = $_POST['catalogueno'];
	$validate->text('categoryName', $categoryName);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = BuildingCategoryDB::getHasRecord($categoryName);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = BuildingCategoryDB::addRecord($categoryName, $description, $vote, $classification, $assetno, $catalogueno);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$exps = BuildingCategoryDB::getBuildingCategorysArray();
	include('add_building_categorys.php');
	break;
case 'Delete_Building_Category':
	$slidebartype = 2;
	$error = 0;
	$id = $_POST['id'];
	$categoryName = $_POST['categoryName'];
	$count = BuildingDB::getHasBuilding_CategoryInBuilding($categoryName);
	if ($count > 0) {
		$error = 3;
	} else {
		$delCount = BuildingCategoryDB::deleteBuilding_Category($id);
		$error = 6;
	}
	$categoryName = "";
	$description = "";
	$vote = "";
	$classification = "";
	$assetno = "";
	$catalogueno = "";
	$exps = BuildingCategoryDB::getBuildingCategorysArray();
	include('add_building_categorys.php');
	break;
case 'Add_DS_Divitions':
	$slidebartype = 2;
	$error = 0;
	$province = "";
	$district = "";
	$dsDivision = "";

	$provinces = ProvinceDB::getProvinces();
	$districts = DistrictDB::getDistrictsByProvince($province);
	$dsdivisions = DsDivisionDB::getDivisionsByDistrictArray($district);
	include('add_ds_divitions.php');
	break;
case 'findDistrictByProvince':
	$province = $_REQUEST['province'];
	$districts = DistrictDB::getDistrictsByProvince($province);
	include('../view/finddistrictbyprovince.php');
	break;
case 'findDSByDistrict':
	$district = $_REQUEST['district'];
	$dsdivisions = DsDivisionDB::getDivisionsByDistrictArray($district);
	?>
		<div id="DSdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>District</th>
															<th>DS Division</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach ($dsdivisions as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																								echo "first";
																							} else {
																								echo "second";
																							} ?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['District']; ?></td>
															<td><?php echo $exp['DSDivision']; ?></td>
															<td><?php echo $exp['Active']; ?></td>
														</tr>
														<?php $i++; ?>
														<?php 
												} ?>
													  </tbody>
													  </table>
													  </div>
													  </div>
												</div>
		<?php	
	break;
case 'Add_DS_Divition':
	$slidebartype = 2;
	$error = 0;

	$province = $_POST['province'];
	$district = $_POST['district'];
	$dsDivision = $_POST['dsDivision'];

	$validate->text('district', $district);
	$validate->text('dsDivision', $dsDivision);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = DsDivisionDB::getHasRecord($dsDivision);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = DsDivisionDB::addRecord($district, $dsDivision);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$provinces = ProvinceDB::getProvinces();
	$districts = DistrictDB::getDistrictsByProvince($province);
	$dsdivisions = DsDivisionDB::getDivisionsByDistrictArray($district);
	include('add_ds_divitions.php');
	break;
case 'Add_GS_Divitions':
	$slidebartype = 2;
	$error = 0;
	$province = "";
	$district = "";
	$dsDivision = "";
	$gsDivision = "";
	$GN_Code = "";

	$provinces = ProvinceDB::getProvinces();
	$districts = DistrictDB::getDistrictsByProvince($province);
	$dsdivisions = DsDivisionDB::getDivisionsByDistrictArray($district);
	$gsdivisions = GsDivisionDB::getDivisionsByDS($dsDivision);
	include('add_gs_divitions.php');
	break;
case 'findDistrictByProvinceGS':
	$province = $_REQUEST['province'];
	$districts = DistrictDB::getDistrictsByProvince($province);
	?>
		<div id="Disdiv">
    <select name="district" onChange="getDSByDistrict('index.php?action=findDSByDistrictGS&district=' + this.value)">
        <option value=""></option>
        <?php foreach ($districts as $dist) { ?>
            <option value="<?php echo $dist->getName(); ?>">
                <?php echo $dist->getName(); ?>
            </option>
        <?php 
						} ?>
    </select>
    <?php echo $fields->getField('district')->getHTML(); ?><br /></td>
</div>
	<?php

break;
case 'findDSByDistrictGS':
	$district = $_REQUEST['district'];
	$dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
	?>
        <div id="DSdiv">
    <select name="dsDivision" onChange="getGSByDS('index.php?action=findGSByDS&dsDivision=' + this.value)">
        <option value=""></option>
        <?php foreach ($dsdivisions as $dsdi) { ?>
            <option value="<?php echo $dsdi->getName(); ?>">
                <?php echo $dsdi->getName(); ?>
            </option>
        <?php 
						} ?>
    </select>

    <?php echo $fields->getField('dsDivision')->getHTML(); ?><br /></td>
</div> <?php
		//include('../view/findDSByDistrict.php');
						setcookie('district', $district);
						break;
					case 'findGSByDS':
						$dsDivision = $_REQUEST['dsDivision'];
						$gsdivisions = GsDivisionDB::getDivisionsByDSArray($dsDivision);
						?>
		<div id="GSdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															
															<th>S No.</th>
															<th>DS Division</th>
															<th>GS Division</th>
															<th>GN Code</th>
															<th>Active</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach ($gsdivisions as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																								echo "first";
																							} else {
																								echo "second";
																							} ?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['DSDivision']; ?></td>
															<td><?php echo $exp['str_GS_Division']; ?></td>
															<td><?php echo $exp['GN_Code']; ?></td>
															<td><?php echo $exp['Active']; ?></td>
														</tr>
														<?php $i++; ?>
														<?php 
												} ?>
													  </tbody>
													  </table>
													  </div>
													  </div>
												</div>
		<?php	
	break;
case 'Add_GS_Divition':
	$slidebartype = 2;
	$error = 0;
	$province = $_POST['province'];
	$district = $_POST['district'];

	$dsDivision = $_POST['dsDivision'];
	$gsDivision = $_POST['gsDivision'];
	$GN_Code = $_POST['GN_Code'];

	$validate->text('gsDivision', $gsDivision);
	$validate->text('dsDivision', $dsDivision);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = GsDivisionDB::getHasRecord($gsDivision);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = GsDivisionDB::addRecord($dsDivision, $gsDivision, $GN_Code);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$provinces = ProvinceDB::getProvinces();
	$districts = DistrictDB::getDistrictsByProvince($province);
	$dsdivisions = DsDivisionDB::getDivisionsByDistrict($district);
	$gsdivisions = GsDivisionDB::getDivisionsByDSArray($dsDivision);
	include('add_gs_divitions.php');
	break;
case 'Add_Main_Categorys':
	$slidebartype = 2;
	$error = 0;
	$classification = "";
	$mainCategory = "";
	$exps = CatalogueDB::getMainCategory();
	include('add_main_category.php');
	break;
case 'Add_Main_Category':
	$classification = $_POST['classification'];
	$mainCategory = $_POST['mainCategory'];

	$validate->text('classification', $classification);
	$validate->text('mainCategory', $mainCategory);
		
        // Load appropriate view based on hasErrors
	if ($fields->hasErrors()) {
		$error = 2;
            // include('ADD_Building_Details.php');
	} else {
		$count = CatalogueDB::getHasMainRecord($mainCategory);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = CatalogueDB::addMainRecord($classification, $mainCategory);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$slidebartype = 2;
	$mainCategory = "";
	$exps = CatalogueDB::getMainCategory();
	include('add_main_category.php');
	break;
case 'delete_Main_Category':
	$id = $_POST['id'];
	$mainCategory = $_POST['mainCategory'];
	$error = 0;
	$count = CatalogueDB::getHasMainCategoryInItemcategory($mainCategory);
	if ($count > 0) {
		$error = 3;
	} else {
		$delCount = CatalogueDB::deletemainCategory($id);
	}
	$slidebartype = 2;
	$classification = "";
	$mainCategory = "";
	$exps = CatalogueDB::getMainCategory();
	include('add_main_category.php');
	break;
case 'Add_Item_Categorys':
	$slidebartype = 2;
	$error = 0;
	$classification = "";
	$mainCategory = "";
	$itemCategory = "";
	$maincategorys = CatalogueDB::getMainCategoryByClassification("");
	$exps = CatalogueDB::getItemCategory();
	include('add_item_category.php');
	break;
case 'Add_Item_Category':
	$classification = $_POST['classification'];
	$mainCategory = $_POST['mainCategory'];
	$itemCategory = $_POST['itemCategory'];
	$sorttype = $_POST['sorttype'];

	$validate->text('classification', $classification);
	$validate->text('mainCategory', $mainCategory);
	$validate->text('itemCategory', $itemCategory);
		
        // Load appropriate view based on hasErrors
	if ($fields->hasErrors()) {
		$error = 2;
            // include('ADD_Building_Details.php');
	} else {
		$count = CatalogueDB::getHasItemRecord($mainCategory, $itemCategory);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = CatalogueDB::addItemRecord($classification, $mainCategory, $itemCategory, $sorttype);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	}
	$slidebartype = 2;
	$mainCategory = "";
	$itemCategory = "";
	$maincategorys = CatalogueDB::getMainCategoryByClassification("");
	$exps = CatalogueDB::getItemCategory();
	include('add_item_category.php');	
	break;
case 'Delete_Item_Category':
	$slidebartype = 2;
	$error = 0;
	$id = $_POST['id'];
	$mainCategory = $_POST['mainCategory'];
	$itemCategory = $_POST['itemCategory'];
	$count = CatalogueDB::getHasItemcategoryIncategory($mainCategory, $itemCategory);
	if ($count > 0) {
		$error = 3;
	} else {
		$delCount = CatalogueDB::deleteItemCategory($id);
	}

	$classification = "";
	$mainCategory = "";
	$itemCategory = "";
	$maincategorys = CatalogueDB::getMainCategoryByClassification("");
	$exps = CatalogueDB::getItemCategory();
	include('add_item_category.php');
	break;
case 'Change_Passwords':
	$fields->addField('currentPassword');
	$fields->addField('newPassword');
	$fields->addField('confirmPassword');
	$slidebartype = 1;
	$error = 0;
        //$currentYear = ConstantsDB::getCurrentYear();
        //$currentYear = $currentYears['currentYear'];
	include('change_password.php');
	break;
case 'Change_Password':
	$slidebartype = 1;
	$fields->addField('currentPassword');
	$fields->addField('newPassword');
	$fields->addField('confirmPassword');

	$currentPassword = $_POST['currentPassword'];
	$newPassword = $_POST['newPassword'];
	$confirmPassword = $_POST['confirmPassword'];

	$validate->checkCurrentPassword('currentPassword', $currentPassword);
	$validate->text('newPassword', $newPassword);
	$validate->equailsCheck('confirmPassword', $confirmPassword, $newPassword);
	$validate->passwordtext('newPassword', $newPassword);

	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$Count = user_account_change_historyDB::getHasRecord($_SESSION['SESS_LOGIN'], $newPassword);
		if ($Count == 0) {
			$date = date('Y-m-d H:i:s');
			// $qry = "UPDATE members SET passwd = '" . md5($_POST['newPassword']) . "', pw_update = '" . $date . "' WHERE login='" . $_SESSION['SESS_LOGIN'] . "' AND passwd='" . md5($_POST['currentPassword']) . "'";
			
			$result = MembersDB::changePassword($_POST['newPassword'], $date, $_SESSION['SESS_LOGIN'], $_POST['currentPassword']);
			// $result = @mysql_query($qry);
			if ($result) {
				$error = 1;
				$deactive = 0;
				$member_id = $_SESSION['SESS_MEMBER_ID'];
				$saveCount = user_account_change_historyDB::addRecord($assetunit, $_SESSION['SESS_LOGIN'], "Change Password", md5($_POST['newPassword']), $_SESSION['SESS_LOGIN']);
				$count = MembersDB::active_decative($member_id, $deactive);
				if ($count == 1) {
					$count1 = MembersDB::updateerror_codes($member_id, 0, "");
				}
				header("location: ../php-login/logout.php");
				//include('../php-login/logout.php');
			} else {
				$error = 5;
			}
		} else {
			$error = 3;
		}
	}
	include('change_password.php');
	break;
case 'Add_BuyerDetails':
	$slidebartype = 2;
	$error = 0;
	$nicno = "";
	$name = "";
	$address = "";
	$telephone = "";
	$email = "";
	$o=new BuyerdetailsDB();
	$content=$o->find();
	//$exps = BuyerdetailsDB::getFullDetails();
	include('add_buyerdetails.php');
	break;
case 'Add_BuyerDetail':
	$slidebartype = 2;
	$error = 0;
	$nicno = $_POST['nicno'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
 	$validate->text('nicno', $nicno);
	if ($fields->hasErrors()) {
		$error = 2;
	} else {
		$count = BuyerdetailsDB::getHasRecord($nicno);
		if ($count > 0) {
			$error = 3;
		} else {
		$o=new BuyerdetailsDB(NULL, $_POST['nicno'], $_POST['name'], $_POST['address'], $_POST['telephone'], $_POST['email']);
		$saveCount = $o->save();
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	} 
	$o=new BuyerdetailsDB();
	$content=$o->find();
	//$exps = BuyerdetailsDB::getFullDetails();
	include('add_buyerdetails.php');
	break;
case 'get_buyerdetails_nicno':
	//$o=new BuyerdetailsDB();
	//$content=$o->find(array('nicno'=>$_GET['nicno']));
	$nicno = $_GET['nicno'];
	$details = array();
	$exps = BuyerdetailsDB::getDetailsByNicno($nicno);
        $details[] = $exps->_get('nicno');
		$details[] = $exps->_get('name');		
	//echo utf8_encode($details);
	$utfEncodedArray = array_map("utf8_encode", $details );
	echo utf8_encode($utfEncodedArray);
	break;
case 'delete_BuyerDetail':
	$id = $_POST['id'];
	$delCount = BuyerdetailsDB::deleteRecordById($id);
	$slidebartype = 2;
	$error = 0;
	$nicno = "";
	$name = "";
	$address = "";
	$telephone = "";
	$email = "";
	$o=new BuyerdetailsDB();
	$content=$o->find();
	//$exps = BuyerdetailsDB::getFullDetails();
	include('add_buyerdetails.php');
	break;
case 'Add_BuyerDetails_ajax':
	$slidebartype = 2;
	$error = 0;
	$nicnos = array();
	$exps = BuyerdetailsDB::getFullDetails();
	foreach ($exps as $value) {
		$nicnos[] = $value['nicno'];
	}
	include('add_buyerdetails_ajax.php');
	break;
case 'Add_BuyerDetail_Ajax':
	$error = 0;
	$nicno = $_POST['nicno'];
	$name = $_POST['name'];
	$address = $_POST['address'];
	$telephone = $_POST['telephone'];
	$email = $_POST['email'];
	$add = $_POST['add'];
	if ($add == 1) {
		$count = BuyerdetailsDB::getHasRecord($nicno);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = BuyerdetailsDB::addRecord($nicno, $name, $address, $telephone, $email);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	} elseif ($add == 0) {
		$saveCount = BuyerdetailsDB::updateRecord($nicno, $name, $address, $telephone, $email);
		if ($saveCount == 1) {
			$error = 2;
		} else {
			$error = 6;
		}
	}
	echo $error;
	break;
case 'delete_BuyerDetail_Ajax':
	$id = $_GET['id'];
	$delCount = BuyerdetailsDB::deleteRecordByNicno($id);
	echo $delCount;
	break;
case 'get_BuyerDetail_Ajax':
	$nicno = $_GET['id'];
	$exps = BuyerdetailsDB::getDetailsByNicno($nicno);
	echo json_encode($exps);
	break;
case 'get_BuyerDetail_Ajax':
	$nicno = $_GET['id'];
	$exps = BuyerdetailsDB::getDetailsByNicno($nicno);
	echo json_encode($exps);
	break;
case 'Add_Institutes_ajax':
	$slidebartype = 2;
	$error = 0;
	include('add_institute_ajax.php');
	break;
case 'showcomment':
			//$slidebartype = 2;
			//$error = 0;
	$exps = InstituteDB::getFullDetails();
	echo json_encode($exps);
		//include('institute_table.php');
	break;
case 'addcomment':
	$instName = $_POST['instName'];
	$instAddress = $_POST['instAddress'];
	$instTele = $_POST['instTele'];
	$instEmail = $_POST['instEmail'];

	$saveCount = InstituteDB::addRecord($instName, $instAddress, $instTele, $instEmail);
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 2;
	}
	echo $error;
	break;
case 'delcomment':
	$id = $_GET['id'];
	$delCount = InstituteDB::deleteRecordById($id);
	echo $delCount;	
	//if($delCount == 1){
    //    $error = 6;
    // }
    // else{
	//	$error = 5; 
    // }
	// echo $error;
	break;
case 'options_ajax':
	$slidebartype = 1;
	include('options_ajax.php');
	break;
case 'get_center':
	$result = AssetsCenterDB::getAssetsCentersAlls();
	echo json_encode($result);
	break;
case 'save_center':
	$centreName = $_REQUEST['centreName'];
	$Active = $_REQUEST['Active'];
	$sorder = $_REQUEST['sorder'];
	$result = AssetsCenterDB::addRecordgrid($centreName, $Active, $sorder);
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'centreName' => $centreName,
		'Active' => $Active,
		'sorder' => $sorder
	));
case 'update_center':
	$id = intval($_REQUEST['id']);
	$centreName = $_REQUEST['centreName'];
	$Active = $_REQUEST['Active'];
	$sorder = $_REQUEST['sorder'];
	$result = AssetsCenterDB::updateRecordgrid($id, $centreName, $Active, $sorder);
	echo json_encode(array(
		'id' => $id,
		'centreName' => $centreName,
		'Active' => $Active,
		'sorder' => $sorder
	));
	break;
case 'destroy_center':
	$id = intval($_REQUEST['id']);
	$result = AssetsCenterDB::deleteRecordByid($id);
	echo json_encode(array('success' => true));
	break;
case 'update_sorder':
	$id = $_POST['id'];
	$sorder = $_POST['sorder'];
	$saveCount = AssetsCenterDB::updatesorder($id, $sorder);
	break;
case 'downloadmanual':
	header("Content-Type: application/octet-stream");
	$file = $_GET["file"] . ".pdf";
	header("Content-Disposition: attachment; filename=" . urlencode($file));
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");
	header("Content-Description: File Transfer");
	header("Content-Length: " . filesize($file));
	flush(); // this doesn't really matter.
	$fp = fopen($file, "r");
	while (!feof($fp)) {
		echo fread($fp, 65536);
		flush(); // this is essential for large downloads
	}
	fclose($fp);
	break;
case 'total_input_list':
	$items = AssetsUnitDB::getFullList();
	$exps = array();
	foreach ($items as $row) {
		$assetunit = $row['unitName'];
		$type = ($row['report_received'] == '1' ? "Yes" : "");
		$ld = LandDB::countRecords($assetunit);
		$bd = BuildingDB::countRecords($assetunit);
		$pm = PlantMacDB::countRecords($assetunit);
		$oe = OfficeEquDB::countRecords($assetunit);
		$ve = VehicleDB::countRecords($assetunit);
		$tot = $ld + $bd + $pm + $oe + $ve;
		$exp = array($row['centreName'], $row['unitName'], $ld, $bd, $pm, $oe, $ve, $tot, $type);
		$exps[] = $exp;
	}
	include('total_inputl_list.php');
	break;
case 'total_input_confirm_list':
	$items = AssetsUnitDB::getFullList();
	$exps = array();
	foreach ($items as $row) {
		$assetunit = $row['unitName'];
		$type = ($row['report_received'] == '1' ? "Yes" : "");
		$ld = LandDB::countRecords($assetunit);
		$bd = BuildingDB::countRecords($assetunit);
		$pm = PlantMacDB::countRecords($assetunit);
		$oe = OfficeEquDB::countRecords($assetunit);
		$ve = VehicleDB::countRecords($assetunit);
		$ld1 = LandDB::confirmRecords($assetunit);
		$bd1 = BuildingDB::confirmRecords($assetunit);
		$pm1 = PlantMacDB::confirmRecords($assetunit);
		$oe1 = OfficeEquDB::confirmRecords($assetunit);
		$ve1 = VehicleDB::confirmRecords($assetunit);
		$ld2 = $ld - $ld1;
		$bd2 = $bd - $bd1;
		$pm2 = $pm - $pm1;
		$oe2 = $oe - $oe1;
		$ve2 = $ve - $ve1;
		$tot = $ld + $bd + $pm + $oe + $ve;
		$tot1 = $ld1 + $bd1 + $pm1 + $oe1 + $ve1;
		$tot2 = $ld2 + $bd2 + $pm2 + $oe2 + $ve2;
		$exp = array($row['centreName'], $row['unitName'], $ld, $bd, $pm, $oe, $ve, $tot, $ld1, $bd1, $pm1, $oe1, $ve1, $tot1, $ld2, $bd2, $pm2, $oe2, $ve2, $tot2, $type);
		$exps[] = $exp;
	}
	include('total_input_confirm_list.php');
	break;
case 'report_received':
	$items = AssetsUnitDB::getFullList();
	include('report_received.php');
	break;
case 'add_report_received':
	$id = $_GET['id'];
	$report_received = $_GET['report_received'];
	$report_received_date = $_GET['report_received_date'];
	$saveCount = AssetsUnitDB::add_report_received($id, $report_received, $report_received_date);
	echo $saveCount;
	break;
case 'add_brand':
	$slidebartype = 1;
	$error = 0;
	$exps = brandDB::getFullDetails();
	include('add_brand.php');
	break;
case 'add_brand_record':
	$error = 0;
	$brand = $_POST['brand'];
	$count = brandDB::getHasRecord($brand);
	if ($count > 0) {
		$error = 3;
	} else {
		$saveCount = brandDB::addRecord($brand);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;
case 'delete_brand_details':
	$brand = $_GET['brand'];
	$delCount = brandDB::deleteRecord($brand);
	echo $delCount;
	break;
case 'add_model':
	$slidebartype = 1;
	$error = 0;
	$brand = "";
	$brands = brandDB::getFullDetails();
	$exps = modelDB::getDetailsbrand($brand);
	include('add_model.php');
	break;
case 'add_model_record':
	$error = 0;
	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$details = $_POST['details'];
	$id = $_POST['id'];
	if ($id == 0) {
		$count = modelDB::getHasRecord($brand, $model);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = modelDB::addRecord($brand, $model, $details);
			if ($saveCount == 1) {
				$error = 1;
			} else {
				$error = 5;
			}
		}
	} else {
		$saveCount = modelDB::updateRecord($brand, $model, $details);
		if ($saveCount == 1) {
			$error = 2;
		} else {
			$error = 6;
		}
	}
	echo $error;
	break;
case 'get_model_detail':
	$id = $_GET['id'];
	$exps = modelDB::getDetailsById($id);
	echo json_encode($exps);
	break;
case 'get_model_detail_code':
	$code = $_GET['id'];
	$exps = modelDB::getDetailsBycode($code);
	echo json_encode($exps);
	break;
case 'delete_model_details':
	$id = $_GET['id'];
	$delCount = modelDB::deleteRecordByid($id);
	echo $delCount;
	break;
case 'findmodelBybrand':
	$brand = $_GET['brand'];
	$exps = modelDB::getDetailsbrand($brand);
	echo json_encode($exps);
	break;
case 'add_protocol_tem':
	$items = AssetsUnitDB::getFullList();
	$exps = array();
	foreach ($items as $row) {
		$assetunit = $row['unitName'];
		$exps = protocallistDB::getDetailsByUnit($assetunit);
		$t1 = $exps['t1'];
		$t2 = $exps['t2'];
		$c1 = $exps['c1'];
		$c2 = $exps['c2'];
		$c3 = $exps['c3'];
		$c4 = $exps['c4'];
		$c5 = $exps['c5'];
			//$items = AssetsUnitDB::updateprotocalTem($assetunit, $t1, $t2, $c1, $c2, $c3, $c4, $c5);
		$saveCount = AssetsUnitDB::updateprotocolTem($assetunit, $t1, $t2, $c1, $c2, $c3, $c4, $c5);
		echo $saveCount;
	}
	break;
case 'Add_protocol':
	$slidebartype = 2;
	$error = 0;
	$instName = "";
	$exps = AssetsUnitDB::getFullListSortProtocol();
	include('add_protocol.php');
	break;
case 'Add_protocol_ajax_save':
	$id = $_GET['id'];
	$protocoltext1 = $_GET['protocoltext1'];
	$protocoltext2 = $_GET['protocoltext2'];
	$protocollevel1 = $_GET['protocollevel1'];
	$protocollevel2 = $_GET['protocollevel2'];
	$protocollevel3 = $_GET['protocollevel3'];
	$protocollevel4 = $_GET['protocollevel4'];
	$protocollevel5 = $protocollevel1 . $protocollevel2 . $protocollevel3 . $protocollevel4;
	$saveCount = AssetsUnitDB::updateprotocol($id, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5);
	echo $protocollevel5;
	break;
case 'Add_protocol_to_assets':
	$items = AssetsUnitDB::getFullList();
	$exps = array();
	foreach ($items as $row) {
		$assetunit = $row['unitName'];
		$protocol = $row['protocollevel5'];
		$protocoltext1 = $row['protocoltext1'];
		$protocoltext2 = $row['protocoltext2'];
		if ($row['protocollevel1'] == 25) {
			$protocoltext1 = $row['protocoltext2'];
		}
		$ld = LandDB::Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit);
		$bd = BuildingDB::Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit);
		$pm = PlantMacDB::Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit);
		$oe = OfficeEquDB::Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit);
		$ve = VehicleDB::Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit);
	}
      //  include('total_inputl_list.php');
	break;
case 'orbat':
	$slidebartype = 5;
	include('startpage.php');
	break;
case 'orbat_addsf':
	$slidebartype = 5;
	$error = 0;
	$exps = orbatDB::getFullDetails_sf();
	include('add_orbat_sf.php');
	break;
case 'add_sf_record':
	$error = 0;
	$code = $_POST['code'];
	$level = $_POST['level'];
	$count = orbatDB::getHasRecord_sf($code);
	if ($count > 0) {
		$error = 3;
	} else {
		$saveCount = orbatDB::addRecord_sf($code, $level);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;
case 'delete_sf_details':
	$code = $_GET['code'];
	$delCount = orbatDB::deleteRecord_sf($code);
	echo $delCount;
	break;
case 'change_assets_unit_name':
	$oldassetunit = "Dte of ADS";
	$newassetunit = "Dte of AMP";
	$identification = "D-AMP000000";
	$ld = LandDB::change_assets_unit_name($oldassetunit, $newassetunit, $identification);
	$bd = BuildingDB::change_assets_unit_name($oldassetunit, $newassetunit, $identification);
	$pm = PlantMacDB::change_assets_unit_name($oldassetunit, $newassetunit, $identification);
	$oe = OfficeEquDB::change_assets_unit_name($oldassetunit, $newassetunit, $identification);
	$ve = VehicleDB::change_assets_unit_name($oldassetunit, $newassetunit, $identification);
	break;
case 'add_unitdetails':
	$slidebartype = 1;
	$error = 0;
	if (isset($_POST['unit'])) {
		$temp = explode(".", $_FILES['Filename']["name"]);
		$newfilename = $_POST['unit'] . '.' . end($temp);
		$target_dir = "pics/";
		$target_file = $target_dir . basename($newfilename);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES['Filename']["tmp_name"]);
		if ($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
			// Check if file already exists
		if (file_exists($target_file)) {
			unlink($target_file);
		}
			// Check file size
		if ($_FILES['Filename']["size"] > 1000000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
				// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
				// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES['Filename']["tmp_name"], $target_file)) {
				$uploadOk = 1;
						//echo "The file ". basename( $_FILES[$fileToUpload]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
				$uploadOk = 0;
			}
		}
		if ($uploadOk == 1) {
			//$crest = $newfilename;
			$count = unitdetailsDB::upload_crest($_POST['unit'], $target_file);
		}
	}
	$details = unitdetailsDB::getDetailsByUnit($assetunit);
	include('add_unitdetails_2.php');
	break;
case 'add_unitdetails_record':
	$error = 0;
	$unit = $_GET['unit'];
	$address = $_GET['address'];
	$telephone = $_GET['telephone'];
	$email = $_GET['email'];
	$fax = $_GET['fax'];
	$fb = $_GET['fb'];
	$coX = $_GET['coX'];
	$coY = $_GET['coY'];
	$count = unitdetailsDB::getHasRecord($unit);
	if ($count > 0) {
		$saveCount = unitdetailsDB::updateRecord($unit, $address, $telephone, $email, $fax, $fb, $coX, $coY);
			//$count1 = unitdetailsDB::deleteRecordByUnit($unit);
	} else {
		$saveCount = unitdetailsDB::addRecord($unit, $address, $telephone, $email, $fax, $fb, $coX, $coY);
	}
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'get_unitmembers':
	$result = unitmembersDB::getDetailsByUnit($assetunit);
	echo json_encode($result);
	break;
case 'save_unitmember':
	$sno = $_REQUEST['sno'];
	$post = $_REQUEST['post'];
	$number = $_REQUEST['number'];
	$rank = $_REQUEST['rank'];
	$name = $_REQUEST['name'];
	$telephone = $_REQUEST['telephone'];
	$email = $_REQUEST['email'];
	$fax = $_REQUEST['fax'];
	$fb = $_REQUEST['fb'];
	$skype = $_REQUEST['skype'];
	$result = unitmembersDB::addRecord($assetunit, $sno, $post, $number, $rank, $name, $telephone, $email, $fax, $fb, $skype);
	echo json_encode(array(
		'id' => mysql_insert_id(),
		'sno' => $sno,
		'post' => $post,
		'number' => $number,
		'rank' => $rank,
		'name' => $name,
		'telephone' => $telephone,
		'email' => $email,
		'fax' => $fax,
		'fb' => $fb,
		'skype' => $skype
	));
	break;
case 'update_unitmember':
	$id = intval($_REQUEST['id']);
	$sno = $_REQUEST['sno'];
	$post = $_REQUEST['post'];
	$number = $_REQUEST['number'];
	$rank = $_REQUEST['rank'];
	$name = $_REQUEST['name'];
	$telephone = $_REQUEST['telephone'];
	$email = $_REQUEST['email'];
	$fax = $_REQUEST['fax'];
	$fb = $_REQUEST['fb'];
	$skype = $_REQUEST['skype'];
	$result = unitmembersDB::updateRecord($id, $sno, $post, $number, $rank, $name, $telephone, $email, $fax, $fb, $skype);
	//	$result = unitmembersDB::updateRecord($id, $sno);
	echo json_encode(array(
		'id' => $id,
		'sno' => $sno,
		'post' => $post,
		'number' => $number,
		'rank' => $rank,
		'name' => $name,
		'telephone' => $telephone,
		'email' => $email,
		'fax' => $fax,
		'fb' => $fb,
		'skype' => $skypee
	));
	break;
case 'destroy_unitmember':
	$id = intval($_REQUEST['id']);
	$result = unitmembersDB::deleteRecordByid($id);
	echo json_encode(array('success' => true));
	break;
case 'display_unitdetails':
	$slidebartype = 1;
	$error = 0;
	$details = unitdetailsDB::getDetailsByUnit($assetunit);
	include('display_unitdetails.php');
	break;
case 'display_Dam_details':
	$slidebartype = 1;
	$error = 0;
	$assetunit = 'DAM';
	$details = unitdetailsDB::getDetailsByUnit($assetunit);
	include('display_unitdetails.php');
	break;
case 'display_unitdetails_all':
	if (isset($_GET['unit'])) {
		$assetunit = $_GET['unit'];
	}
	$slidebartype = 6;
	$error = 0;
	$items = AssetsUnitDB::getFullListbyProtocol();
	$details = unitdetailsDB::getDetailsByUnit($assetunit);
	include('display_unitdetails.php');
	break;
case 'get_unitmembers_all':
	if (isset($_GET['unit'])) {
		$assetunit = $_GET['unit'];
	}
	$result = unitmembersDB::getDetailsByUnit($assetunit);
	echo json_encode($result);
	break;
case 'map_all':
	$slidebartype = 6;
	$locations = array();
	$items = AssetsUnitDB::getFullListbyProtocol();
	$exps = AssetsUnitDB::getUnitDetails();
	$pos = unitdetailsDB::getFullDetails();
	$i = 0;
	foreach ($pos as $row) {
		$i++;
		$exp = array($row['unit'], $row['coX'], $row['coY'], $i);
		$locations[] = $exp;
	}
	include('map_all.php');
	break;
case 'map_all_unit':
	if (isset($_GET['unit'])) {
		$assetunit = $_GET['unit'];
	}
	$slidebartype = 6;
	$locations = array();
	$items = AssetsUnitDB::getFullListbyProtocol();
	$exps = AssetsUnitDB::getUnitDetails_unit($assetunit);
		//$exps = AssetsUnitDB::getUnitDetails();
		//$pos = unitdetailsDB::getFullDetails_unit();
	$i = 0;
	foreach ($exps as $row) {
		$i++;
		$exp = array($row['unit'], $row['coX'], $row['coY'], $i);
		$locations[] = $exp;
	}
	include('map_all.php');
	break;
case 'total_summary_list':
	$items = AssetsUnitDB::getFullList();
	$exps = array();
	foreach ($items as $row) {
		$assetunit = $row['unitName'];
		$ld = LandDB::summaryRecords($assetunit);
		$bd = BuildingDB::summaryRecords($assetunit);
		$pm = PlantMacDB::summaryRecords($assetunit);
		$oe = OfficeEquDB::summaryRecords($assetunit);
		$ve = VehicleDB::summaryRecords($assetunit);
		$tot = $ld + $bd + $pm + $oe + $ve;
		$exp = array($row['centreName'], $row['unitName'], $ld, $bd, $pm, $oe, $ve, $tot);
		$exps[] = $exp;
	}
	include('total_summary_list.php');
	break;
case 'total_summary_list_2':
	$ld = LandDB::summaryRecords_2($assetunit);
	$bd = BuildingDB::summaryRecords_2($assetunit);
	$pm = PlantMacDB::summaryRecords_2($assetunit);
	$oe = OfficeEquDB::summaryRecords_2($assetunit);
	$ve = VehicleDB::summaryRecords_2($assetunit);
	include('total_summary_list_2.php');
	break;
case 'add_error_code':
	$slidebartype = 1;
	$error = 0;
	$items = errorcodeDB::getFullDetails();
	include('add_errorcode.php');
	break;
case 'add_errorcode_record':
	$error = 0;
	$code = $_GET['code'];
	$title = $_GET['title'];
	$details = $_GET['details'];
	$count = errorcodeDB::getHasRecord($code);
	if ($count > 0) {
		$count1 = errorcodeDB::deleteRecordByCode($code);
	}
	$saveCount = errorcodeDB::addRecord($code, $title, $details);
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'get_errorcode':
	$code = $_GET['code'];
	$exps = errorcodeDB::getDetailsBycode($code);
	echo json_encode($exps);
	break;
case 'get_errorcode_full':
	$exps = errorcodeDB::getFullDetails();
	echo json_encode($exps);
	break;
case 'detete_errorcode':
	$id = $_GET['id'];
	$count = errorcodeDB::deleteRecordByid($id);
	echo json_encode($count);
	break;
case 'inform_errors':
	$slidebartype = 7;
	$error = 0;
	$items = AssetsUnitDB::getFullListbyProtocol();
	$exps = AssetsUnitDB::getFullListwithunitSortProtocol();
	include('inform_errors.php');
	break;
case 'inform_errors_records':
	$id = $_GET['id'];
	$error_display = $_GET['error_display'];
	$error_codes = $_GET['error_codes'];
	$saveCount = AssetsUnitDB::updateerror_codes($id, $error_display, $error_codes);
	echo $saveCount;
	break;
case 'send_mail':
	require('../phpmailer/class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPDebug = 0;
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Port = 587;
	$mail->Username = "dteofam@gmail.com";
	$mail->Password = "dam1234567";
	$mail->Host = "smtp.gmail.com";
	$mail->Mailer = "smtp";
	$mail->SetFrom("dteofam@gmail.com", "Dte of AM");
	$mail->AddReplyTo("dteofam@gmail.com", "PHPPot");
	$mail->AddAddress("dteofam@gmail.com");
	$mail->Subject = "Test email using PHP mailer";
	$mail->WordWrap = 80;
	$content = "<b>This is a test email using PHP mailer class.</b>";
	$mail->MsgHTML($content);
	$mail->IsHTML(true);
	if (!$mail->Send())
		echo "Problem sending email.";
	else
		echo "email sent.";
	echo $result;
	break;
case 'add_unit_email':
	$slidebartype = 2;
	$error = 0;
	if (isset($_POST['unit'])) {
		$temp = explode(".", $_FILES['Filename']["name"]);
		$newfilename = $_POST['unit'] . '.' . end($temp);
		$target_dir = "pics/";
		$target_file = $target_dir . basename($newfilename);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES['Filename']["tmp_name"]);
		if ($check !== false) {
				//echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
			// Check if file already exists
		if (file_exists($target_file)) {
			unlink($target_file);
		}
			// Check file size
		if ($_FILES['Filename']["size"] > 1000000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
				// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
				// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES['Filename']["tmp_name"], $target_file)) {
				$uploadOk = 1;
						//echo "The file ". basename( $_FILES[$fileToUpload]["name"]). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
				$uploadOk = 0;
			}
		}
		if ($uploadOk == 1) {
			//$crest = $newfilename;
			$count = unitdetailsDB::upload_crest($_POST['unit'], $target_file);
		}
	}
	$exps = AssetsUnitDB::getFullListwithunitSortProtocol();
	include('add_unit_email.php');
	break;
case 'add_unit_email_record':
	$error = 0;
	$unit = $_GET['unit'];
	$email = $_GET['email'];
	$count = unitdetailsDB::getHasRecord($unit);
	if ($count > 0) {
		$saveCount = unitdetailsDB::updateEmailRecord($unit, $email);
	} else {
		$saveCount = unitdetailsDB::addEmailRecord($unit, $email);
	}
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'add_unit_error':
	$slidebartype = 7;
	$error = 0;
	$unit = $_GET['unit'];
	$count = unitdetailsDB::getHasRecord($unit);
	if ($count > 0) {
		$details = unitdetailsDB::getDetailsByUnit($unit);
		$errordisplay = $details['errordisplay'];
		$errortitle = $details['errortitle'];
		$errordetails = $details['errordetails'];
		$email = $details['email'];
	} else {
		$errordisplay = "";
		$errortitle = "";
		$errordetails = "";
		$email = "";
	}
	$items = AssetsUnitDB::getFullListbyProtocol();
	include('add_unit_error.php');
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
case 'add_item_value_range':
	if (isset($_POST['searchby'])) {
		$searchby = $_POST['searchby'];
	} else if (isset($_GET['searchby'])) {
		$searchby = $_GET['searchby'];
	} else {
		$searchby = "";
	}

	if (isset($_POST['search'])) {
		$search = $_POST['search'];
	} else if (isset($_GET['search'])) {
		$search = $_GET['search'];
	} else {
		$search = "";
	}
	$column = "";
	switch ($searchby) {
		case 'Main Category':
			$column = "mainCategory";
			break;
		case 'Item Category':
			$column = "itemCategory";
			break;
		case 'Item Description':
			$column = "itemDescription";
			break;
		case 'Catalogue Number':
			$column = "catalogueno";
			break;
		case 'Make':
			$column = "make";
			break;
		case 'Model':
			$column = "modle";
			break;
		case 'New Classification of Asset':
			$column = "newAssestno";
			break;
		case 'Present Asset No':
			$column = "assetsno";
			break;
	}
	$items = CatalogueDB::getInqDetails($column, $search);
	include('add_item_value_range.php');
	break;
case 'add_min_max':
	$id = $_GET['id'];
	$minval = $_GET['minval'];
	$maxval = $_GET['maxval'];
	$minlifetime = $_GET['minlifetime'];
	$maxlifetime = $_GET['maxlifetime'];
	$saveCount = CatalogueDB::updateMinMax($id, $minval, $maxval, $minlifetime, $maxlifetime);
	echo $saveCount;
	break;
case 'logging_list':
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

	$loginname = $_SESSION['SESS_LOGIN'];
	$exps = LoginDB::getInqDetails_user($loginname, $inputField1, $inputField2);
	include('login_list.php');
	break;
case 'psos_allow_list':
	$slidebartype = 2;
	$error = 0;
	$instName = "";
	$exps = CatalogueDB::getItemCategory();
	include('add_psos_allow_list.php');
	break;
case 'add_places':
	$slidebartype = 1;
	$error = 0;
	$exps = placesDB::getFullDetails();
	include('add_places.php');
	break;
case 'add_places_record':
	$error = 0;
	$code = $_POST['code'];
	$name_english = $_POST['name_english'];
	$name_sinhala = $_POST['name_sinhala'];
	$name_tamil = $_POST['name_tamil'];
	$count = placesDB::getHasRecord($code);
	if ($count > 0) {
		$saveCount = placesDB::updateRecord($code, $name_english, $name_sinhala, $name_tamil);
		if ($saveCount == 1) {
			$error = 2;
		} else {
			$error = 6;
		}
	} else {
		$saveCount = placesDB::addRecord($code, $name_english, $name_sinhala, $name_tamil);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;
case 'get_places_detail':
	$id = $_GET['id'];
	$exps = placesDB::getDetailsById($id);
	echo json_encode($exps);
	break;
case 'get_places_detail_code':
	$code = $_GET['id'];
	$exps = placesDB::getDetailsBycode($code);
	echo json_encode($exps);
	break;
case 'delete_places_details':
	$id = $_GET['id'];
	$delCount = placesDB::deleteRecordByid($id);
	echo $delCount;
	break;
case 'get_places_table':
	$exps = placesDB::getFullDetails();
	echo json_encode($exps);
	break;
case 'add_unitNameSinhala':
	$exps = AssetsUnitDB::getFullListSortProtocol();
	include('add_unitnamesinhala.php');
	break;
case 'add_unitNameSinhala_save':
	$id = $_GET['id'];
	$unitNameSinhala = $_GET['unitNameSinhala'];
	$unitNameSinhalaFull = $_GET['unitNameSinhalaFull'];
	$unitnameEnglishFull = $_GET['unitnameEnglishFull'];
	$saveCount = AssetsUnitDB::add_unitNameSinhala($id, $unitNameSinhala, $unitNameSinhalaFull, $unitnameEnglishFull);
	echo $saveCount;
	break;
case 'add_centreNameSinhala':
	$exps = AssetsCenterDB::getFullDetails();
	include('add_centresnamesinhala.php');
	break;
case 'add_centreNameSinhala_save':
	$id = $_GET['id'];
	$centreNameSinhala = $_GET['centreNameSinhala'];
	$centreNameSinhalaFull = $_GET['centreNameSinhalaFull'];
	$centreNameEnglishFull = $_GET['centreNameEnglishFull'];
	$saveCount = AssetsCenterDB::add_centreNameSinhala($id, $centreNameSinhala, $centreNameSinhalaFull, $centreNameEnglishFull);
	echo $saveCount;
	break;
case 'add_ordinance_places':
	$slidebartype = 1;
	$error = 0;
	$exps = ordinancePlacesDB::getFullDetails();
	include('add_ordinance_places.php');
	break;
case 'add_ordinance_places_record':
	$error = 0;
	$code = $_POST['code'];
	$name_english = $_POST['name_english'];
	$name_sinhala = $_POST['name_sinhala'];
	$name_tamil = $_POST['name_tamil'];
	$address = $_POST['address'];
	$count = ordinancePlacesDB::getHasRecord($code);
	if ($count > 0) {
		$saveCount = ordinancePlacesDB::updateRecord($code, $name_english, $name_sinhala, $name_tamil, $address);
		if ($saveCount == 1) {
			$error = 2;
		} else {
			$error = 6;
		}
	} else {
		$saveCount = ordinancePlacesDB::addRecord($code, $name_english, $name_sinhala, $name_tamil, $address);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;
case 'get_ordinance_places_detail':
	$id = $_GET['id'];
	$exps = ordinancePlacesDB::getDetailsById($id);
	echo json_encode($exps);
	break;
case 'get_ordinance_places_detail_code':
	$code = $_GET['id'];
	$exps = ordinancePlacesDB::getDetailsBycode($code);
	echo json_encode($exps);
	break;
case 'delete_ordinance_places_details':
	$id = $_GET['id'];
	$delCount = ordinancePlacesDB::deleteRecordBycode($id);
	echo $delCount;
	break;
case 'get_ordinance_places_table':
	$exps = ordinancePlacesDB::getFullDetails();
	echo json_encode($exps);
	break;
case 'add_unit_ordinance':
	$slidebartype = 2;
	$error = 0;
	$exps = AssetsUnitDB::getFullListbyProtocol();
	$ordinances = ordinancePlacesDB::getFullDetails();
	include('add_unit_ordinance.php');
	break;
case 'add_unit_ordinance_record':
	$error = 0;
	$id = $_GET['id'];
	$unit = $_GET['unit'];
	$ordinance = $_GET['ordinance'];
	$saveCount = AssetsUnitDB::updateOrdinanceRecord($id, $ordinance);
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'cigas':
	$slidebartype = 8;
	$error = 0;
	include('startpage.php');
	break;
case 'cigas_units_display':
	$slidebartype = 8;
	$error = 0;
	$exps = AssetsUnitDB::getFullListSortProtocol();
	$provinces = ProvinceDB::getFullDetails();
	if (isset($_POST['exp'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=location.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Location', 'Description', 'Is_Active'));
		foreach ($exps as $exp) {
				//$cigas_name = $exp['cigas_name'];
				//$cigas_name = ($cigas_name == ''? $exp['unitName'] : $cigas_name);
				//$fields = array($cigas_name, $cigas_name, "Yes");
			$fields = array($exp['unitName'], $exp['unitName'], "Yes");
			fputcsv($output, $fields);
		}
		fclose($output);
	} else {
		include('cigas_units_display.php');
	}
	break;
case 'cigas_item_display':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas_date();
	if (isset($_POST['exp'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=asset_items.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item_Code', 'Description', 'Is_Active'));
		foreach ($exps as $exp) {
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['itemCategory'] . " - " . $exp['itemDescription'], "Yes");
			fputcsv($output, $fields);
		}
		fclose($output);
	} elseif (isset($_POST['exp_dot'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=asset_items.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item_Code', 'Description', 'Is_Active'));
		foreach ($exps as $exp) {
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['cigas_assetno'] . ".", $exp['itemCategory'] . " - " . $exp['itemDescription'], "Yes");
			fputcsv($output, $fields);
		}
		fclose($output);
	} else {
		include('cigas_item_display.php');
	}
	break;
case 'cigas_item_display_fb':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas_nodefence();
	if (isset($_POST['exp'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=asset_items.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item_Code', 'Description', 'Is_Active'));
		foreach ($exps as $exp) {
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['itemCategory'] . " - " . $exp['itemDescription'], "Yes");
			fputcsv($output, $fields);
		}
		fclose($output);
	} else {
		include('cigas_item_display_fb.php');
	}
	break;
case 'cigas_item_generate':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas();
	$i = 1;
	$newAssestno = "";
	foreach ($exps as $exp) {
		if ($newAssestno != $exp['newAssestno']) {
			$newAssestno = $exp['newAssestno'];
			$i = 1;
			echo $exp['newAssestno'] . "-" . $newAssestno . "\n";
		} else {
			$i = $i + 1;
		}
		$cigas_assetno = $exp['newAssestno'] . "." . $i;
		$updateCount = CatalogueDB::updatecigas_assetno($exp['id'], $cigas_assetno);
	}		
		//include('cigas_item_display.php');
	break;
case 'cigas_plantmacdetails_display':
	$slidebartype = 8;
	$error = 0;
	$per_page = 20000;
		//$per_page=10;
	if (isset($_GET['page1'])) {
		$page1 = $_GET['page1'];
	} else {
		$page1 = 1;
	}
	$start_from = ($page1 - 1) * $per_page;
	$i = $start_from + 1;
		
/* 				Category_Code	varchar(12)	
				Item_Code	varchar(12)	
				Location_Code	varchar(20)	
				Identification_No	varchar(25)	
				Date	date	
				Supplier_Code	varchar(12)	
				Description	varchar(100)	
				Qty	int	
				Unit_Price	numeric(18, 2)	
				Value	numeric(18, 2)	
				-Disposal	varchar(1)	
				-Dis_Date	date	
				-Accu_Dep_BF	numeric(18, 2)	
				-Dep_For_Year	numeric(18, 2)	
				-Accu_Dep_CD	numeric(18, 2)	
				-WDV	numeric(18, 2)	
				Pass_Journal	varchar(1)	O
				-P_Return_No	varchar(4)	
				-P_Return_Amt	numeric(18, 2)	
				-vou_no	varchar(24)	
				sno	int	
				Sub_Item	varchar(12)	
				Old_no	varchar(50) - identificationno*/

	$exps = PlantMacDB::getFullDetails_cigas_date($start_from, $per_page);
	$total_records = PlantMacDB::countTotalRecords_cigas_date();
	$total_pages = ceil($total_records / $per_page);
	if (isset($_GET['csv'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=plant' . $page1 . '.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} elseif (isset($_GET['csv_all'])) {
		$exps = PlantMacDB::getFullDetails_cigas_all_date();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=plant.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
			//$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} elseif (isset($_GET['exp_dot'])) {
		$exps = PlantMacDB::getFullDetails_cigas_all();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=plant.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
			//$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$cigas_idno = $pieces[0] . "." . "-" . $x;
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $cigas_idno, $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'] . ".", $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} else {
		include('cigas_plantmacdetails_display.php');
	}
	break;
case 'cigas_officeequipments_display':
	$slidebartype = 8;
	$error = 0;
	$per_page = 10000;
		//$per_page=10;
	if (isset($_GET['page1'])) {
		$page1 = $_GET['page1'];
	} else {
		$page1 = 1;
	}
	$start_from = ($page1 - 1) * $per_page;
	$i = $start_from + 1;

	$exps = OfficeEquDB::getFullDetails_cigas_date($start_from, $per_page);
	$total_records = OfficeEquDB::countTotalRecords_cigas_date();
	$total_pages = ceil($total_records / $per_page);
	if (isset($_GET['csv'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=office' . $page1 . '.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
			//$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} elseif (isset($_GET['csv_all'])) {
		$exps = OfficeEquDB::getFullDetails_cigas_all_date();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=office.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
			//$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} elseif (isset($_GET['exp_dot'])) {
		$exps = OfficeEquDB::getFullDetails_cigas_all();
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=office.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
			//$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$cigas_idno = $pieces[0] . "." . "-" . $x;
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $cigas_idno, $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'] . ".", $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} else {
		include('cigas_officeequipments_display.php');
	}
	break;
case 'cigas_vehicledetails_display':
	$slidebartype = 8;
	$error = 0;
	$exps = VehicleDB::getFullDetails_cigas_date();
	if (isset($_POST['exp'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=vehicle.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
		$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'], $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} elseif (isset($_POST['exp_dot'])) {
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=vehicle.csv');
		$output = fopen('php://output', 'w');
		fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'Disposal', 'Dis_Date', 'Accu_Dep_BF', 'Dep_For_Year', 'Accu_Dep_CD', 'WDV', 'pass_journal', 'P_Return_No', 'P_Return_Amt', 'vou_no', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'location_code', 'identification_no', 'date', 'suppler_code', 'description', 'Qty', 'Unit_Price', 'value', 'pass_journal', 'sno', 'Sub_Item', 'Old_no'));
			//fputcsv($output, array('Category_Code', 'Item_Code', 'Sub_Item', 'identification_no', 'Old_no', 'location_code', 'date', 'suppler_code', 'description', 'value', 'pass_journal ', 'Sno'));
		$i = 1;
		foreach ($exps as $exp) {
			$date = $exp['purchasedDate'];
			$date_array = explode("-", $date); // split the array
			$var_year = (int)$date_array[0]; //day seqment
			$var_month = (int)$date_array[1]; //month segment
			$var_day = (int)$date_array[2]; //year segment
			$new_date_format = "$var_day/$var_month/$var_year"; // join them together
				//$cigas_name = AssetsUnitDB::get_cigas_name($exp['assetunit']);
				//$cigas_name = ($cigas_name == ''? $exp['assetunit'] : $cigas_name);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['cigas_assetno'], $exp['cigas_idno'], "", $cigas_name, $new_date_format, "OPN", $exp['itemCategory']." - ".$exp['itemDescription'], $exp['unitValue'], "", $i);
			$pieces = explode("-", $exp['cigas_idno']);
			$x = $pieces[1];
			$cigas_idno = $pieces[0] . "." . "-" . $x;
			$fields = array(substr($exp['newAssestno'], 0, 5), $exp['newAssestno'], $exp['assetunit'], $cigas_idno, $new_date_format, "", $exp['itemCategory'] . " - " . $exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "", "", "0", "0", "0", "0", "O", "", "0", "", $x, $exp['cigas_assetno'] . ".", $exp['identificationno']);
				//$fields = array(substr($exp['newAssestno'],0,5), $exp['newAssestno'], $exp['assetunit'], $exp['cigas_idno'], $new_date_format, "", $exp['itemCategory']." - ".$exp['itemDescription'], 1, $exp['unitValue'], $exp['unitValue'], "O", $x, $exp['cigas_assetno'], $exp['identificationno']);
			fputcsv($output, $fields);
			$i++;
		}
		fclose($output);
	} else {
		include('cigas_vehicledetails_display.php');
	}
	break;
case 'cigas_plantmacdetails_generate':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas();
	foreach ($exps as $exp) {
		$count = PlantMacDB::update_cigas_1($exp['catalogueno'], $exp['cigas_assetno']);
	}
	$items = PlantMacDB::update_cigas_2();
	$i = 1;
	$cigas_assetno = "";
	foreach ($items as $item) {
		if ($cigas_assetno != $item['cigas_assetno']) {
			$cigas_assetno = $item['cigas_assetno'];
			$maxno = CatalogueDB::getcigas_assetno_max($item['cigas_assetno']);
			$i = $maxno + 1;
				//echo $items['newAssestno']."-".$newAssestno."\n";
		} else {
			$i = $i + 1;
		}
		$cigas_idno = $item['cigas_assetno'] . "-" . $i;
		$updateCount = PlantMacDB::update_cigas_3($item['id'], $cigas_idno);
	}
	break;
case 'cigas_officeequdetails_generate':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas();
	foreach ($exps as $exp) {
		$count = OfficeEquDB::update_cigas_1($exp['catalogueno'], $exp['cigas_assetno']);
	}
	$items = OfficeEquDB::update_cigas_2();
	$i = 1;
	$cigas_assetno = "";
	foreach ($items as $item) {
		if ($cigas_assetno != $item['cigas_assetno']) {
			$cigas_assetno = $item['cigas_assetno'];
			$maxno = CatalogueDB::getcigas_assetno_max($item['cigas_assetno']);
			$i = $maxno + 1;
				//echo $items['newAssestno']."-".$newAssestno."\n";
		} else {
			$i = $i + 1;
		}
		$cigas_idno = $item['cigas_assetno'] . "-" . $i;
		$updateCount = OfficeEquDB::update_cigas_3($item['id'], $cigas_idno);
	}
	break;
case 'cigas_vehicledetails_generate':
	$slidebartype = 8;
	$error = 0;
echo "/////////////////////";
	$exps = CatalogueDB::getCatalogue_cigas();
	foreach ($exps as $exp) {
		$count = VehicleDB::update_cigas_1($exp['catalogueno'], $exp['cigas_assetno'], $exp['newAssestno']);
	}
	$items = VehicleDB::update_cigas_2();
	$i = 1;
	$cigas_assetno = "";
	foreach ($items as $item) {
		if ($cigas_assetno != $item['cigas_assetno']) {
			$cigas_assetno = $item['cigas_assetno'];
			$maxno = CatalogueDB::getcigas_assetno_max($item['cigas_assetno']);
			$i = $maxno + 1;
				//echo $items['newAssestno']."-".$newAssestno."\n";
		} else {
			$i = $i + 1;
		}
		$cigas_idno = $item['cigas_assetno'] . "-" . $i;
		$updateCount = VehicleDB::update_cigas_3($item['id'], $cigas_idno);
	}
	break;
case 'add_cigas_name':
	$error = 0;
	$id = $_GET['id'];
	$cigas_name = $_GET['cigas_name'];
	$saveCount = AssetsUnitDB::update_cigas_name($id, $cigas_name);
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'add_province_code':
	$error = 0;
	$id = $_GET['id'];
	$province = $_GET['province'];
	$saveCount = AssetsUnitDB::update_province_code($id, $province);
	if ($saveCount == 1) {
		$error = 1;
	} else {
		$error = 5;
	}
	echo $error;
	break;
case 'cigas_vehicle_compare_SNT_system':
	$slidebartype = 8;
	$error = 0;
	$db = Database::getDB();
		//$query = 'SELECT Army_No FROM system_vehicle INNER JOIN snt_vehicle ON system_vehicle.Army_No = snt_vehicle.number order by system_vehicle.Army_No';
	$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle INNER JOIN snt_vehicle ON system_vehicle.Army_No = snt_vehicle.number order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result1 = $statement->fetchAll();
	$statement->closeCursor();
	$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle LEFT OUTER JOIN snt_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE snt_vehicle.number IS NULL and system_vehicle.duplicates = 0 order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result2 = $statement->fetchAll();
	$statement->closeCursor();
	$query = 'SELECT system_vehicle.Army_No AS AA, snt_vehicle.number AS BB, snt_vehicle.* FROM system_vehicle RIGHT JOIN snt_vehicle on system_vehicle.Army_No = snt_vehicle.number WHERE system_vehicle.Army_No IS NULL ORDER BY snt_vehicle.number';
		//$query = 'SELECT snt_vehicle.* FROM system_vehicle RIGHT OUTER JOIN snt_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE system_vehicle.number IS NULL order by snt_vehicle.number';
		//$query = 'SELECT number FROM snt_vehicle LEFT OUTER JOIN system_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE snt_vehicle.number IS NULL order by snt_vehicle.number';
	$statement = $db->prepare($query);
	$statement->execute();
	$result3 = $statement->fetchAll();
	$statement->closeCursor();
	$query = 'SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1';
		//$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle LEFT OUTER JOIN snt_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE snt_vehicle.number IS NULL order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result4 = $statement->fetchAll();
	$statement->closeCursor();
	$query = 'SELECT number, COUNT(*) c FROM snt_vehicle GROUP BY number HAVING c > 1';
		//$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle LEFT OUTER JOIN snt_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE snt_vehicle.number IS NULL order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result5 = $statement->fetchAll();
	$statement->closeCursor();
	$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle INNER JOIN snt_vehicle ON system_vehicle.Army_No = snt_vehicle.number WHERE system_vehicle.duplicates = 0 order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result6 = $statement->fetchAll();
	$statement->closeCursor();
	include('cigas_vehicle_compare_display.php');
	break;
case 'cigas_vehicle_system_duplicates':
	$slidebartype = 8;
	$error = 0;
	$db = Database::getDB();
	$query = 'SELECT * FROM system_vehicle INNER JOIN (SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1) dup ON system_vehicle.Army_No = dup.Army_No';
		//$query = 'SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1';
		//$query = 'SELECT system_vehicle.Description as dis, system_vehicle.Engine_No as eng, system_vehicle.Chassis_No as cha, system_vehicle.*, snt_vehicle.* FROM system_vehicle LEFT OUTER JOIN snt_vehicle ON (system_vehicle.Army_No = snt_vehicle.number) WHERE snt_vehicle.number IS NULL order by system_vehicle.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$statement->closeCursor();
	include('cigas_vehicle_system_duplicates.php');
	break;
case 'cigas_vehicle_system_duplicates_mark':
	$slidebartype = 8;
	$error = 0;
	$db = Database::getDB();
	$query = 'SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$statement->closeCursor();
	$myArray = [];
	foreach ($result as $exp) {
		$myArray[] = $exp['Army_No'];
	}
	$query = "UPDATE system_vehicle SET duplicates = 1 WHERE Army_No IN ('" . implode("','", $myArray) . "')";
		//print_r ($myArray);
		//$query ="UPDATE system_vehicle SET duplicates = 1 WHERE Army_No IN (SELECT Army_No FROM system_vehicle INNER JOIN (SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1) dup ON system_vehicle.Army_No = dup.Army_No)";
		//$query = 'SELECT * FROM system_vehicle INNER JOIN (SELECT Army_No, COUNT(*) c FROM system_vehicle GROUP BY Army_No HAVING c > 1) dup ON system_vehicle.Army_No = dup.Army_No';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$statement->closeCursor();	
		//include('cigas_vehicle_system_duplicates.php');
	break;
case 'cigas_vehicle_system_all':
	$slidebartype = 8;
	$error = 0;
	$db = Database::getDB();
	$query = 'SELECT * FROM system_vehicle';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$statement->closeCursor();
	include('cigas_vehicle_system_all.php');
	break;
case 'cigas_vehicle_snt_all':
	$slidebartype = 8;
	$error = 0;
	$db = Database::getDB();
	$query = 'SELECT * FROM snt_vehicle';
	$statement = $db->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$statement->closeCursor();
	include('cigas_vehicle_snt_all.php');
	break;
case 'unit_disband':
	$slidebartype = 0;
	$error = 0;
	if (isset($_GET['unit'])) {
		$unit = $_GET['unit'];
	} else if (isset($_POST['unit'])) {
		$unit = $_POST['unit'];
	} else {
		$unit = "";
	}
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
	} else {
		$type = 0;
	}
	if (isset($_POST['disband_all'])) {
		$count1 = PlantMacDB::disband_all($unit);
		$count2 = OfficeEquDB::disband_all($unit);
	}
	$expsPlant = PlantMacDB::get_catalogueno_summary_2(2, $unit);
	$expsOffice = OfficeEquDB::get_catalogueno_summary_2(2, $unit);
	$expsVehicle = VehicleDB::get_catalogueno_summary_2(2, $unit);
	$items = AssetsUnitDB::getFullListbyProtocol();
	include('unit_disband.php');
	break;
case 'unit_disband_undo':
	$slidebartype = 0;
	$error = 0;
	if (isset($_GET['unit'])) {
		$unit = $_GET['unit'];
	} else if (isset($_POST['unit'])) {
		$unit = $_POST['unit'];
	} else {
		$unit = "";
	}
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
	} else {
		$type = 0;
	}
	if (isset($_POST['disband_all_undo'])) {
		$count1 = PlantMacDB::disband_all_undo($unit);
		$count2 = OfficeEquDB::disband_all_undo($unit);
	}
	$expsPlant = PlantMacDB::get_catalogueno_summary_2_undo(2, $unit);
	$expsOffice = OfficeEquDB::get_catalogueno_summary_2_undo(2, $unit);
	$expsVehicle = VehicleDB::get_catalogueno_summary_2_undo(2, $unit);
	$items = AssetsUnitDB::getFullListbyProtocol();
	include('unit_disband_undo.php');
	break;
case 'add_institute_ajs':
	$slidebartype = 2;
	$error = 0;
  /*       $instName = "";
        $instAddress = "";
        $instTele = "";
        $instEmail = "";
        $exps = InstituteDB::getFullDetails(); */
	include('add_institute_ajs.php');
	break;
case 'cigas_nottransfer_list':
	$items = PlantMacDB::cigas_nottransfer_list();
	$o_items = OfficeEquDB::cigas_nottransfer_list();
	$v_items = VehicleDB::cigas_nottransfer_list();
	include('cigas_nottransfer_list.php');
	break;
case 'cigas_2018_pruchase_list':
	$items = PlantMacDB::cigas_2018_pruchase_list();
	$o_items = OfficeEquDB::cigas_2018_pruchase_list();
	$v_items = VehicleDB::cigas_2018_pruchase_list();
	include('cigas_2018_pruchase_list.php');
	break;
case 'cigas_item_generate_empty':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas_empty();
	$i = 1;
	$newAssestno = "";
	foreach ($exps as $exp) {
		$count = CatalogueDB::getCatalogue_cigas_getmaxno($exp['newAssestno']);
 		if ($newAssestno != $exp['newAssestno']) {
			$newAssestno = $exp['newAssestno'];
			$i = $count + 1;
			//echo $exp['newAssestno'] . "-" . $count . "\n";
		} else {
			$i = $i + 1;
		}
		$cigas_assetno = $exp['newAssestno'] . "." . $i;
		//echo $cigas_assetno;
		//echo $exp['id'];
		$updateCount = CatalogueDB::updatecigas_assetno($exp['id'], $cigas_assetno);
	}		
		//include('cigas_item_display.php');
	break;
case 'cigas_item_generate_lastnumber':
	$slidebartype = 8;
	$error = 0;
	$exps = CatalogueDB::getCatalogue_cigas();
	$i = 1;
	$newAssestno = "";
	foreach ($exps as $exp) {
		if ($exp['type'] == 1) {
			$maxno = OfficeEquDB::getCatalogue_cigas_getmaxno($exp['cigas_assetno']);
		} elseif ($exp['type'] == 2) {
			$maxno = PlantMacDB::getCatalogue_cigas_getmaxno($exp['cigas_assetno']);
		} elseif ($exp['type'] == 3) {
			$maxno = VehicleDB::getCatalogue_cigas_getmaxno($exp['cigas_assetno']);
		}
		$updateCount = CatalogueDB::updatecigas_assetno_max($exp['id'], $maxno);
	}		
		//include('cigas_item_display.php');
	break;
case 'add_present_location':
	$slidebartype = 1;
	$error = 0;
	//$details = present_locationDB::getDetailsByUnit($assetunit);
	include('add_present_location.php');
	break;
case 'save_present_location':
	$saveCount = present_locationDB::addRecord($_GET['assetunit'], $_GET['locations']);
	echo $saveCount;
	break;
case 'get_present_location_details':
	$exps = present_locationDB::getDetailsByUnit($assetunit);
	echo json_encode($exps);
	break;
case 'board_report':
	$slidebartype = 9;
	include('board_report.php');
	break;
case 'add_board_report_receving':
	$slidebartype = 9;
	$currentYear = ConstantsDB::getCurrentYear();
	$exps = AssetsUnitDB::getFullListwithBoardreport($currentYear);
	include('add_board_report_receving.php');
	break;
case 'add_board_report_receving_save':
	$exps = board_reportDB::updateReceiveDate($_GET['id'], $_GET['received_date'], $_GET['approved_date']);
	echo json_encode($exps);
	break;
case 'delete_board_report_server':
	$slidebartype = 9;
	$currentYear = ConstantsDB::getCurrentYear();
	$exps = AssetsUnitDB::getFullListwithBoardreport($currentYear);
	include('delete_board_report_server.php');
	break;
case 'board_report_notreceive_list':
	$slidebartype = 9;
	$currentYear = ConstantsDB::getCurrentYear();
	$items = AssetsUnitDB::board_report_notreceive_list($currentYear);
	include('board_report_notreceive_list.php');
	break;
case 'delete_board_report_server_save':
	$filename = "";
	$nulldate ="0000-00-00";
	$asset = $_GET['item'];
	$id = $_GET['id'];
	$count = board_reportDB::delete_board_report_server($asset, $filename, $nulldate, $id);
	$items = board_report_summaryDB::deleteRecords($id, $asset);
	echo $count;
	break;
case 'add_board_report_observations':
	$slidebartype = 9;
	$currentYear = ConstantsDB::getCurrentYear();
	$content = AssetsUnitDB::getFullListwithBoardreport($currentYear);
	include('add_board_report_observations.php');
	break;
case 'add_board_report_ob_save':
	$currentYear = ConstantsDB::getCurrentYear();
	$count = board_report_observationsDB::addRecord($_GET['cyear'], $_GET['assetunit'], $_GET['itemtype'], $_GET['title'], $_GET['details']);
	echo $count;
	break;
case 'get_board_report':
	$exps = board_report_observationsDB::getFullDetails($_GET['cyear'], $_GET['assetunit']);
	echo json_encode($exps);
	break;
case 'detete_board_report':
	$id = $_GET['id'];
	$count = board_report_observationsDB::deleteRecordByid($id);
	echo json_encode($count);
	break;
case 'board_report_summary_details':
	$slidebartype = 9;
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
	$exps = board_reportDB::getUnitList($assetunit);
	include('board_report_summary_details.php');
	break;
case 'findAssetsUnitsByCenter_Ajax':
	$assetscenter = $_GET['center'];
	$units = array();
	$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
	foreach ($assetunits as $unit) {
	$units[] = $unit->getName(); }
	echo json_encode( $units );
	break;
case 'change_unit_name':
	$error = 0;
	if (isset($_POST['assetunit1'])) {
			$Lcount = LandDB::getHasRecordUnit($_POST['assetunit1']);
			$Bcount = BuildingDB::getHasRecordUnit($_POST['assetunit1']);
			$Pcount = PlantMacDB::getHasRecordUnit($_POST['assetunit1']);
			$Ocount = OfficeEquDB::getHasRecordUnit($_POST['assetunit1']);
			$Vcount = VehicleDB::getHasRecordUnit($_POST['assetunit1']);
			$tot = (int)$Pcount + (int)$Ocount + (int)$Vcount + (int)$Lcount + (int)$Bcount; 
			if ($tot == 0){
				$CentreID = AssetsUnitDB::getCentreID($_POST['assetunit1']);
				$CentreIDold = AssetsUnitDB::getCentreID($_POST['assetunit']);
				$count1 = LandDB::change_unit_name($_POST['assetscenter'], $_POST['assetunit'], $_POST['assetscenter1'], $_POST['assetunit1'], $CentreID, $CentreIDold);
				$count1 = BuildingDB::change_unit_name($_POST['assetscenter'], $_POST['assetunit'], $_POST['assetscenter1'], $_POST['assetunit1'], $CentreID, $CentreIDold);
				$count1 = PlantMacDB::change_unit_name($_POST['assetscenter'], $_POST['assetunit'], $_POST['assetscenter1'], $_POST['assetunit1'], $CentreID, $CentreIDold);
				$count1 = OfficeEquDB::change_unit_name($_POST['assetscenter'], $_POST['assetunit'], $_POST['assetscenter1'], $_POST['assetunit1'], $CentreID, $CentreIDold);
				$count1 = VehicleDB::change_unit_name($_POST['assetscenter'], $_POST['assetunit'], $_POST['assetscenter1'], $_POST['assetunit1'], $CentreID, $CentreIDold);
				$count1 = change_unit_name_historyDB::addRecord($_POST['assetunit'], $_POST['assetunit1']);
				$error = 1;
			} else {
				$error = 2;	
			}
	}
	if (isset($_POST['assetscenter'])) {
		$assetscenter = $_POST['assetscenter'];
	} else {
		$assetscenter = "";
	}

	if (isset($_POST['assetunit'])) {
		$assetunit = $_POST['assetunit'];
	} else {
		$assetunit = "";
	}
	
	if (isset($_POST['assetscenter1'])) {
		$assetscenter1 = $_POST['assetscenter1'];
	} else {
		$assetscenter1 = $assetscenter;
	}

	if (isset($_POST['assetunit1'])) {
		$assetunit1 = $_POST['assetunit1'];
	} else {
		$assetunit1 = $assetunit;
	}
	
	$assetsCenters = AssetsCenterDB::getAssetsCenters();
	$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
	$Landitems = LandDB::getInqDetails3($assetscenter, $assetunit);
	$Buildingitems = BuildingDB::getInqDetails3($assetscenter, $assetunit);
	$Plantitems = PlantMacDB::getInqDetails3($assetscenter, $assetunit);
	$Officeitems = OfficeEquDB::getInqDetails3($assetscenter, $assetunit);
	$Vehicleitems = VehicleDB::getInqDetails3($assetscenter, $assetunit);
	include('change_unit_name.php');
    break;
case 'allocation_details':
	$slidebartype = 0;
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
		
        if (isset($_POST['scale_assetunit'])) {
            $scale_assetunit = $_POST['scale_assetunit'];
        } else if (isset($_GET['scale_assetunit'])) {
            $scale_assetunit = $_GET['scale_assetunit'];
        } else {
			$scale_assetunit = "";
		}	
	
	
	$assetsCenters = AssetsCenterDB::getAssetsCenters();
	$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
	$au = $assetunit;  
	$exps = PlantMacDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}
	$exps = OfficeEquDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}
	$exps = VehicleDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}	
	$items = allocation_detailsDB::getDetailsByunit($au);
	$scale_assetunits = CatalogueDB::get_columnname_scale();
	include('allocation_details.php');
	break;
case 'allocation_details_save':
	$au = $_POST['assetunit'];
	$exps = PlantMacDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}
	$exps = OfficeEquDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}
	$exps = VehicleDB::getFullDetailsUnit($au);
	foreach ($exps as $exp) {
		$cnt = allocation_detailsDB::getHasRecord($au, $exp['catalogueno']);
		if ($cnt > 0) {
		} else {
			$c = allocation_detailsDB::addRecord($au, $exp['catalogueno']);		
		}
	}	
	$items = allocation_detailsDB::getDetailsByunit($au);
	echo json_encode($items);
	break;
case 'allocation_details_save_qty':
	$count = allocation_detailsDB::allocation_details_save_qty($_GET['id'], $_GET['quantity']);
	echo $count;
	break;
case 'scale_catalogue':
	if (isset($_POST['search'])) {
		$search = $_POST['search'];
	} else {
		$search = "";
	}
	$items = CatalogueDB::getDetails_dam($search);
	$items_s = CatalogueDB::getDetails_scale($search);
	include('scale_catalogue.php');
	break;
case 'scale_catalogue_save':
	$count = CatalogueDB::scale_catalogue_save($_GET['dam_catalogueno'], $_GET['scale_catalogueno']);
	echo $count;
	break;
case 'get_details_scale_catalogue':
	$exps = allocation_detailsDB::getDetailsByassetunit($_GET['assetunit']);
	foreach ($exps as $exp) {
		$count = 0;
		$scale_catalogueno = allocation_detailsDB::get_scale_catalogueno($exp['catalogueno']);
		$scale_qty = allocation_detailsDB::get_details_scale_catalogue($scale_catalogueno, $_GET['scale_assetunit']);
		if ($scale_qty > 0) {
			$count = allocation_detailsDB::allocation_details_save_qty($exp['id'], $scale_qty);
		}
	}
	echo $count;
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
        $Officeitems = OfficeEquDB::allocation_list($assetunit);
		$Plantitems = PlantMacDB::allocation_list($assetunit);
        include('allocation_list.php');
        break;
case 'view_allocation_details':
	if (isset($_GET['type'])) {
		if ($_GET['type'] == "unit") {
		$alocation_table = "view_allocation_details_unit.php";
		$exps = allocation_detailsDB::getDetailsByunit($_GET['unit']);
		$title = " - Unit - ".$_GET['unit'];
		} elseif ($_GET['type'] == "reg") {
			$alocation_table = "view_allocation_details_reg.php";
			$title = " - Regiment / Group - ".$_GET['unit'];
			$units = AssetsUnitDB::getUnitListbyProtocol($_GET['unit']);
			$catloguenos = allocation_detailsDB::getDetailsByassetunits($_GET['unit']);
		}
	} else {	
		$title = " - All Details";
		$alocation_table = "view_allocation_details_all.php";
		$exps = allocation_detailsDB::getDetailsView();
	}
	$items = AssetsUnitDB::getFullListbyProtocol();
	include('view_allocation_details.php');
	break;
case 'items_accumulation_pricess_scale':
	$slidebartype = 1;
	include('items_accumulation_pricess_scale.php');
	break;
case 'items_accumulation_pricess_scale_save':
	$exps = allocation_detailsDB::getFullDetails();
	$t_quantity = 0;
	foreach ($exps as $exp) {
		$type = substr($exp['catalogueno'],1,1);
		$quantity = 0;
		if ($type == "1"){
			$quantity = OfficeEquDB::allocation_list_assetunit_catalogueno($exp['assetunit'], $exp['catalogueno']);	
		} elseif ($type == "2") {
			$quantity = PlantMacDB::allocation_list_assetunit_catalogueno($exp['assetunit'], $exp['catalogueno']);	
		} elseif ($type == "3"){
			$quantity = VehicleDB::allocation_list_assetunit_catalogueno($exp['assetunit'], $exp['catalogueno']);	
		}
		allocation_detailsDB::allocation_details_save_act_qty($exp['id'], $quantity);
		$t_quantity = $t_quantity + $quantity;
	}
	echo $t_quantity;
	break;
case 'allocation_list_item':
	if (isset($_GET['catalogueno'])) {
		$alocation_table = "allocation_list_item_catlogue.php";
		$exps = allocation_detailsDB::getDetailsByCatlogueno($_GET['catalogueno']);
	} elseif (isset($_GET['itemCategory'])) {
		$alocation_table = "allocation_list_item_itemCategory.php";
		$exps = allocation_detailsDB::getDetailsByitemCategory($_GET['itemCategory']);	
	} elseif (isset($_GET['mainCategory'])) {
		$alocation_table = "allocation_list_item_mainCategory.php";
		$exps = allocation_detailsDB::getDetailsBymainCategory($_GET['mainCategory']);
	} elseif (isset($_GET['type'])) {
		$alocation_table = "allocation_list_item_type.php";
		$exps = allocation_detailsDB::getDetailsByType($_GET['type']);		
	}
	$items1 = CatalogueDB::getCatalogue_Tree(1);
	$items2 = CatalogueDB::getCatalogue_Tree(2);
	include('allocation_list_item.php');
    break;
case 'allocation_list_unit':
	$title = "";
	if (isset($_GET['type'])) {
		if ($_GET['type'] == "unit") {
		$alocation_table = "allocation_actual_details_unit.php";
		$Officeitems = OfficeEquDB::allocation_list($_GET['unit']);
		$Plantitems = PlantMacDB::allocation_list($_GET['unit']);
		//$exps = allocation_detailsDB::getDetailsByunit($_GET['unit']);
		$title = " - Unit - ".$_GET['unit'];
		} elseif ($_GET['type'] == "reg") {
			$alocation_table = "allocation_actual_details_reg.php";
			$title = " - Regiment / Group - ".$_GET['unit'];
			$units = AssetsUnitDB::getUnitListbyProtocol($_GET['unit']);
			$catloguenos = allocation_detailsDB::getDetailsByassetunits($_GET['unit']);
		}
	} 
/* 	else {	
		$title = " - All Details";
		$alocation_table = "view_allocation_details_all.php";
		$exps = allocation_detailsDB::getDetailsView();
	} */
	$items = AssetsUnitDB::getFullListbyProtocol();
	include('allocation_list_unit.php');
	break;
	case 'view_dos_catalogue':
		$items = CatalogueDB::dos_getCatalogue();
		include('dos_inquiry_catalogue.php');
	break;
case 'compare_dam_dos_catalogue':
	if (isset($_POST['search'])) {
		$search = $_POST['search'];
	} else {
		$search = "";
	}
	$items = CatalogueDB::getDetails_dam($search);
	$items_s = CatalogueDB::getDetails_dos($search);
	include('compare_dam_dos_catalogue.php');
	break;
case 'compare_dam_dos_catalogue_save':
	$count = CatalogueDB::compare_dam_dos_catalogue_save($_GET['dam_catalogueno'], $_GET['dos_catalogueno']);
	echo $count;
	break;
case 'notice_details':
	$slidebartype = 1;
	$unit = AssetsUnitDB::getAllDetailsUnit($_SESSION['SESS_PLACE']);
	if ($unit['error_display'] == 1) {
		$str = $unit['error_codes'];
		$errors = explode(",",$str);
	}
	$details = unitdetailsDB::getDetailsByUnit($_SESSION['SESS_PLACE']);
	$errordisplay = $details['errordisplay'];
	$errortitle = $details['errortitle'];
	$errordetails = $details['errordetails'];
	include 'notice_details.php';
	break;
case 'change_units_type_active':
		//$exps = AssetsUnitDB::getFullList_unittype(1);
	$exps = AssetsUnitDB::getAllunits();
	include 'change_units_type_active.php';
	break;
case 'change_units_type_active_save':
	$count = AssetsUnitDB::change_units_type_active_save($_GET['id'], $_GET['unittype'], $_GET['active']);
	echo $count;
break;
case 'add_dos_catalogue':
	$items = dos_materialmasterDB::getFullDetails();
	include('add_dos_catalogue.php');
break;
case 'getItemtype_dos':
	$exps = dos_materialmasterDB::getUniqueitemtype();
	echo json_encode($exps);
	break;
case 'getQstore_dos':
	$exps = dos_materialmasterDB::getUniqueqstore();
	echo json_encode($exps);
	break;
case 'getVotehead_dos':
	$exps = dos_materialmasterDB::getUniquevotehead();
	echo json_encode($exps);
	break;
case 'getVotename_dos':
	$exps = dos_materialmasterDB::getUniquevotename();
	echo json_encode($exps);
	break;
case 'dos_catalogue_save':
		$count = dos_materialmasterDB::getHasRecord($_POST['itemcode']);
		if ($count > 0) {
			$error = 3;
		} else {
			$saveCount = dos_materialmasterDB::addDetails($_POST['itemtype'], $_POST['itemcode'], $_POST['description'], $_POST['AsstNo'], $_POST['qstore'], $_POST['votehead'], $_POST['votename']);
			if ($saveCount == 1) {                       
				$error = 1;
			} else {
				$error = 5;
			}
		}
	echo $error;		
	break;
case 'deleteDetailsByitemcode':
	$count = dos_materialmasterDB::deleteDetailsByitemcode($_GET['itemcode']);
	echo $count;
	break;
case 'add_dam_catalogue':
	$items = CatalogueDB::getCatalogue_mainCategory("MEDICAL EQUIPMENTS");
	$count = dos_materialmasterDB::deleteDetailsByMainCategory("Medical Equipments");
	foreach ($items as $exp) {
		$saveCount = dos_materialmasterDB::addDetails_2($exp['catalogueno'], $exp['itemCategory'], $exp['itemDescription'], $exp['assetsno']);
		//echo $saveCount;
	}
	$itemss = dos_materialmasterDB::getFullDetails();
	include('add_dam_catalogue.php');
break;
case 'add_vehicle_repairtype':
	$slidebartype = 1;
	$error = 0;
	$exps = vehicle_repairtypeDB::getFullDetails();
	include('add_vehicle_repairtype.php');
	break;
case 'add_vehicle_repairtype_record':
	$error = 0;
	$vehicle_repairtype = $_POST['vehicle_repairtype'];
	$count = vehicle_repairtypeDB::getHasRecord($vehicle_repairtype);
	if ($count > 0) {
		$error = 3;
	} else {
		$saveCount = vehicle_repairtypeDB::addRecord($vehicle_repairtype);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
	}
	echo $error;
	break;
case 'delete_vehicle_repairtype_details':
	$vehicle_repairtype = $_GET['vehicle_repairtype'];
	$delCount = vehicle_repairtypeDB::deleteRecord($vehicle_repairtype);
	echo $delCount;
	break;
}
?>