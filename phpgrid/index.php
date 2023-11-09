<?php
require_once("conf.php");
// require_once('../php-login/auth.php');
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
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM landdetails", "id", "landdetails");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM landdetails WHERE dam_controller = '$login'", "id", "landdetails");
		}
		$dg->set_caption("Land Grid"); 
		$dg -> set_dimension(2000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');
		//$dg -> set_multiselect(true, true);

		$_SESSION['selected_table'] = 'landdetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Land Grid';
		$_SESSION['selected_table_width'] = 2000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'building':
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM buildingdetails", "id", "buildingdetails");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM buildingdetails WHERE dam_controller = '$login'", "id", "buildingdetails");
		}
		$dg->set_caption("Building Grid"); 
		$dg -> set_dimension(2000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'buildingdetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Building Grid';
		$_SESSION['selected_table_width'] = 2000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'plantmacdetails':
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM plantmacdetails", "id", "plantmacdetails");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM plantmacdetails WHERE dam_controller = '$login'", "id", "plantmacdetails");
		}
		$dg->set_caption("Plant & Machinery Grid"); 
		$dg -> set_dimension(3000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'plantmacdetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Plant & Machinery Grid';
		$_SESSION['selected_table_width'] = 3000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'officeequdetails':
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM officeequdetails", "id", "officeequdetails");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM officeequdetails WHERE dam_controller = '$login'", "id", "officeequdetails");
		}
		$dg->set_caption("Office Equipments Grid"); 
		$dg -> set_dimension(3000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'officeequdetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Office Equipments Grid';
		$_SESSION['selected_table_width'] = 3000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'vehicledetails':
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM vehicledetails", "id", "vehicledetails");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM vehicledetails WHERE dam_controller = '$login'", "id", "vehicledetails");
		}
		$dg->set_caption("Vehicle Details Grid"); 
		$dg -> set_dimension(2000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'vehicledetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Vehicle Details Grid';
		$_SESSION['selected_table_width'] = 2000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'itemcategory':
		$dg = new C_DataGrid("SELECT * FROM itemcategory", "id", "itemcategory");
		$dg->set_caption("Item Category Grid"); 
		$dg -> set_dimension(1000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'itemcategory';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Item Category Grid';
		$_SESSION['selected_table_width'] = 1000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'Catalogue_Numbers':
		$dg = new C_DataGrid("SELECT * FROM classificationlist", "id", "classificationlist");
		$dg->set_caption("Catalogue Numbers Grid"); 
		$dg -> set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'classificationlist';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Catalogue Numbers Grid';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'assetcentre':
		$dg = new C_DataGrid("SELECT * FROM assetcentre", "id", "assetcentre");
		$dg->set_caption("Centres Grid"); 
		$dg -> set_dimension(1000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');
		
		$_SESSION['selected_table'] = 'assetcentre';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Centres Grid';
		$_SESSION['selected_table_width'] = 1000;
		$_SESSION['selected_table_height'] = 400;

		include('land.php');
        break;
    case 'assetunit':
		if ($_SESSION['SESS_LEVEL'] == 1) {
			$dg = new C_DataGrid("SELECT * FROM assetunit", "SN", "assetunit");
		} elseif ($_SESSION['SESS_LEVEL'] == 5) {
			$dg = new C_DataGrid("SELECT * FROM assetunit WHERE dam_controller = '$login'", "SN", "assetunit");
		}
		$dg->set_caption("Units Grid"); 
		$dg -> set_dimension(2000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'assetunit';
		$_SESSION['selected_table_primary_key'] = 'SN';
		$_SESSION['selected_table_caption'] = 'Units Grid';
		$_SESSION['selected_table_width'] = 2000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'mas_ds_divisions':
		$dg = new C_DataGrid("SELECT * FROM mas_ds_divisions", "SN", "mas_ds_divisions");
		$dg->set_caption("IDS Divisions Grid"); 
		$dg -> set_dimension(1000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'mas_ds_divisions';
		$_SESSION['selected_table_primary_key'] = 'SN';
		$_SESSION['selected_table_caption'] = 'IDS Divisions Grid';
		$_SESSION['selected_table_width'] = 1000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'mas_gs_divisions':
		$dg = new C_DataGrid("SELECT * FROM mas_gs_divisions", "SN", "mas_gs_divisions");
		$dg->set_caption("GS Divisions Grid"); 
		$dg -> set_dimension(1000, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'mas_gs_divisions';
		$_SESSION['selected_table_primary_key'] = 'SN';
		$_SESSION['selected_table_caption'] = 'GS Divisions Grid';
		$_SESSION['selected_table_width'] = 1000;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'members':
		$dg = new C_DataGrid("SELECT * FROM members", "member_id", "members");
		$dg->set_caption("Users Grid"); 
		$dg -> set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'members';
		$_SESSION['selected_table_primary_key'] = 'member_id';
		$_SESSION['selected_table_caption'] = 'Users Grid';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
	case 'languagechange':
        $i = $_POST['i'];
		$sql = "UPDATE members SET language = $i WHERE member_id = $memId";
	    $result=$db->query($sql);
        break;
    case 'commects':
		$dg = new C_DataGrid("SELECT * FROM members", "member_id", "members");
		$dg->set_caption("Comments"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'members';
		$_SESSION['selected_table_primary_key'] = 'member_id';
		$_SESSION['selected_table_caption'] = 'Comments';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'board_of_survey':
		$dg = new C_DataGrid("SELECT * FROM boardofsurvey", "id", "boardofsurvey");
		$dg->set_caption("Board of Survey"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'boardofsurvey';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Board of Survey';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
    case 'loss_damage':
		$dg = new C_DataGrid("SELECT * FROM loss_damage", "id", "loss_damage");
		$dg->set_caption("Loss and Damage"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'loss_damage';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Loss and Damage';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
    case 'loss_damage_details':
		$dg = new C_DataGrid("SELECT * FROM loss_damage_details", "id", "loss_damage_details");
		$dg->set_caption("Loss and Damage Details"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'loss_damage_details';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Loss and Damage Details';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'loss_damage_board':
		$dg = new C_DataGrid("SELECT * FROM lost_damage_board", "id", "lost_damage_board");
		$dg->set_caption("Loss and Damage Board"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'lost_damage_board';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Loss and Damage Board';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'errorcode':
		$dg = new C_DataGrid("SELECT * FROM errorcode", "id", "errorcode");
		$dg->set_caption("Error Code"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'errorcode';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Error Code';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'provinces':
		$dg = new C_DataGrid("SELECT * FROM provinces", "province_id", "provinces");
		$dg->set_caption("provinces"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'provinces';
		$_SESSION['selected_table_primary_key'] = 'province_id';
		$_SESSION['selected_table_caption'] = 'provinces';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'board_report':
		$dg = new C_DataGrid("SELECT * FROM board_report", "id", "board_report");
		$dg->set_caption("Board Report"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'board_report';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Board Report';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'board_report_summary':
		$dg = new C_DataGrid("SELECT * FROM board_report_summary", "id", "board_report_summary");
		$dg->set_caption("Board Report Summary"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'board_report_summary';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Board Report Summary';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'board_report_observations':
		$dg = new C_DataGrid("SELECT * FROM board_report_observations", "id", "board_report_observations");
		$dg->set_caption("Board Report Observations"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'board_report_observations';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Board Report Observations';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'vehicle_tender_details':
		$dg = new C_DataGrid("SELECT * FROM tender_vehicledetails", "id", "tender_vehicledetails");
		$dg->set_caption("Vehicle Tender Details"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'tender_vehicledetails';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Vehicle Tender Details';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'change_unit_name_history':
		$dg = new C_DataGrid("SELECT * FROM change_unit_name_history", "id", "change_unit_name_history");
		$dg->set_caption("Unit Name Change History"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'change_unit_name_history';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Unit Name Change History';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'user_account_change_history':
		$dg = new C_DataGrid("SELECT * FROM user_account_change_history", "id", "user_account_change_history");
		$dg->set_caption("User Account Change History"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'user_account_change_history';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'User Account Change History';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'allocation_details':
		$dg = new C_DataGrid("SELECT * FROM allocation_details", "id", "allocation_details");
		$dg->set_caption("Allocation Details"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'allocation_details';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Allocation Details';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'scale_catalogue':
		$dg = new C_DataGrid("SELECT * FROM scale_catalogue", "id", "scale_catalogue");
		$dg->set_caption("Allocation Details"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'scale_catalogue';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Allocation Detail';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'dos_material_master':
		$dg = new C_DataGrid("SELECT * FROM dos_materialmaster", "id", "dos_materialmaster");
		$dg->set_caption("DOS Material Master"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'dos_materialmaster';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'DOS Material Master';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
    case 'bos_openingbalance':
		$dg = new C_DataGrid("SELECT * FROM bos_openingbalance", "id", "bos_openingbalance");
		$dg->set_caption("Opening Balance"); 
		$dg->set_dimension(1350, 400); 
		$dg->enable_autowidth(false);
		$dg -> enable_export('EXCEL');
		$dg -> enable_search(true);
		$dg -> enable_edit('INLINE', 'CRUD');
		//$dg -> set_multiselect(true, true);
		$dg->add_column("actions", array('name'=>'actions',
    		'index'=>'actions',
    		'width'=>'70',
    		'formatter'=>'actions',
    		'formatoptions'=>array('keys'=>true, 'editbutton'=>true, 'delbutton'=>true)),'Actions');

		$_SESSION['selected_table'] = 'bos_openingbalance';
		$_SESSION['selected_table_primary_key'] = 'id';
		$_SESSION['selected_table_caption'] = 'Opening Balance';
		$_SESSION['selected_table_width'] = 1350;
		$_SESSION['selected_table_height'] = 400;

        include('land.php');
        break;
	}
?>