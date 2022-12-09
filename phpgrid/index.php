<?php
require_once('../php-login/auth.php');
require('../model/database.php');
$page = 11;
$lang = 0;
global $lang;
require_once('../model/language.php');
if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'land';
	if ($_SESSION['SESS_LEVEL'] == 16) {$action = 'vehicle_tender_details';}
}
$login = $_SESSION['SESS_LOGIN'];
switch ($action) {
    case 'land':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Land Grid"; 
		$grid["width"] = 2000;
		$g->set_options($grid); 
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "landdetails";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM landdetails WHERE dam_controller = '$login'";
		}
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'building':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Building Grid"; 
		$grid["width"] = 2000;
		$g->set_options($grid);
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "buildingdetails";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM buildingdetails WHERE dam_controller = '$login'";
		}		
		//$g->table = "buildingdetails"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'plantmacdetails':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Plant & Machinery Grid"; 
		$grid["width"] = 3000;
		$g->set_options($grid); 
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "plantmacdetails";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM plantmacdetails WHERE dam_controller = '$login'";
		}
		//$g->table = "plantmacdetails"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'officeequdetails':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Office Equipments Grid"; 
		$grid["width"] = 3000;
		$g->set_options($grid);
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "officeequdetails";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM officeequdetails WHERE dam_controller = '$login'";
		}		
		//$g->table = "officeequdetails"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;	
    case 'vehicledetails':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Vehicle Details Grid"; 
		$grid["width"] = 2000;
		$g->set_options($grid); 
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "vehicledetails";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM vehicledetails WHERE dam_controller = '$login'";
		}
		//$g->table = "vehicledetails"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;		
    case 'itemcategory':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Item Category Grid"; 
		$grid["width"] = 1000;
		$g->set_options($grid); 
		$g->table = "itemcategory"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'Catalogue_Numbers':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Catalogue Numbers Grid"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "classificationlist"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'assetcentre':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Centres Grid"; 
		$grid["width"] = 1000;
		$g->set_options($grid); 
		$g->table = "assetcentre"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'assetunit':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Units Grid"; 
		$grid["width"] = 2000;
		$g->set_options($grid); 
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$g->table = "assetunit";
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$g->select_command ="SELECT * FROM assetunit WHERE dam_controller = '$login'";
		}
		//$g->table = "assetunit"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'mas_ds_divisions':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "DS Divisions Grid"; 
		$grid["width"] = 1000;
		$g->set_options($grid); 
		$g->table = "mas_ds_divisions"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'mas_gs_divisions':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "GS Divisions Grid"; 
		$grid["width"] = 1000;
		$g->set_options($grid); 
		$g->table = "mas_gs_divisions"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'members':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Users Grid"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "members"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'commects':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Comments"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "quickinfocomments"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'board_of_survey':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Board of Survey"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "boardofsurvey"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'loss_damage':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Loss and Damage"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "loss_damage"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'loss_damage_details':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Loss and Damage Details"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "loss_damage_details"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'loss_damage_board':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Loss and Damage Board"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "lost_damage_board"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'errorcode':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Error Code"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "errorcode"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'provinces':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Error Code"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "provinces"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'board_report':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Board Report"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "board_report"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;	
    case 'board_report_summary':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Board Report Summary"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "board_report_summary"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'board_report_observations':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Board Report Observations"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "board_report_observations"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;	
    case 'vehicle_tender_details':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Vehicle Tender Details"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "tender_vehicledetails"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'change_unit_name_history':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Unit Name Change History"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "change_unit_name_history"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'user_account_change_history':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "User Account Change History"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "user_account_change_history"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;	
    case 'allocation_details':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Allocation Details"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "allocation_details"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'scale_catalogue':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Allocation Details"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "scale_catalogue"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'dos_material_master':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "DOS Material Master"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "dos_materialmaster"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;
    case 'bos_openingbalance':
		include("lib/inc/jqgrid_dist.php"); 
		$g = new jqgrid(); 
		$grid["caption"] = "Opening Balance"; 
		$grid["width"] = 1350;
		$g->set_options($grid); 
		$g->table = "bos_openingbalance"; 
		$out = $g->render("list1"); 
        include('land.php');
        break;		
	}
?>