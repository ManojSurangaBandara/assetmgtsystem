<?php

require_once('../php-login/auth.php');
//require_once('../model/database.php');
require('../model/database.php');
require('../model/users_db.php');
require('../model/assetscenter_db.php');
require('../model/assetscenter.php');
require('../model/assetsunit_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
require('../model/constants_db.php');
require('../model/quickinfo_db.php');
require('../model/logindetails_db.php');
require('../model/members_db.php');
require('../model/catalogue_db.php');
require('../model/plantmac_db.php');
require('../model/officeequ_db.php');
require('../model/vehicle_db.php');
require('../model/landcategory_db.php');
require('../model/landcategory.php');
require('../model/buildingcategory_db.php');
require('../model/land_db.php');
require('../model/building_db.php');
require('../model/unitdetails_db.php');
require('../model/user_account_change_history_db.php');

$page = 7;

$memPlace = $place = $_SESSION['SESS_PLACE'];
$memLevel = $level = $_SESSION['SESS_LEVEL'];
$memId = $member = $_SESSION['SESS_MEMBER_ID'];
$currentYear = ConstantsDB::getCurrentYear();
require_once('../model/language.php');
$slidebartype = 5;
$error = 0;
$exps = array();

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('assetscenter');
$fields->addField('assetunit');
$fields->addField('firstname');
$fields->addField('lastname');
$fields->addField('login');
$fields->addField('passwd');
$fields->addField('cpassword');
$fields->addField('level');


if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'user_control_level';
}
$assetscenter = $_SESSION['SESS_CENTRE'];
$assetunit = $_SESSION['SESS_PLACE'];
$assetsCenters = AssetsCenterDB::getAssetsCenters();
$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
$Qinfo = QuickInfoDB::getActivatedDetails();
switch ($action) {
    case 'temp':
       $List = AssetsUnitDB::getFullList_unittype(1);
	   //$List = TempDB::getAssetsUnits();
        foreach ($List as $row) {
           // print $row['SN'] . "<BR>";
           // print $row['unitName'] . "<BR>";
           // print rtrim($row['centreID'], '0') . "<BR>";
            //$lo = rtrim($row['centreID'], '0');
           // print $row['centreName'] . "<BR>";
            $pw = "1234";
            $fname = "Board of Survey User";
            $lname = "BOS User";
            $login = rtrim($row['centreID'], '0') . "-BOS";
            $place = $row['unitName'];
            $level = 17;
            $centreName = $row['centreName'];
			$pw_update = date('Y-m-d H:i:s'); 
			print $fname." ".$lname." ".$login." ".$place. "<BR>";
            //$qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('User1','User1','$lo','" . md5($pw) . "','$row['unitName']','$level','$row['centreName']')";
            //$qry = "DELETE FROM members WHERE level = 17";
			$qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName, pw_update) VALUES('$fname','$lname','$login','" . md5($pw) . "','$place','$level','$centreName','$pw_update')";
            $result = @mysql_query($qry);
            //     
            //     $prov = new AssetsCenter($row['SN'], $row['unitName']);
            //     $provinces[] = $prov;
        }
        // $exps = get_users();
        // include('user_list.php');		




		// $qry = "UPDATE members SET firstname='Administrator(Unit)' WHERE firstname='User 1'";
			//$qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('$fname','$lname','$login','" . md5($pw) . "','$place','$level','$centreName')";
            // $result = @mysql_query($qry);
	/*	$exps = get_users();
		foreach ($exps as $exp) {
		$sorderwithcenter = AssetsUnitDB::getsorderwithcenter($exp['place']);
		print $sorderwithcenter;
		print $exp['place']. "<BR>";
		$u = TempDB::Savesorderwithcenter($sorderwithcenter, $exp['member_id']);
		}
		*/
		 // break;
		/*$List = TempDB::getAssetsCenters();
		foreach ($List as $row) {
            print $row['centreName'];
            print $row['sorder'] . "<BR>";
			$units = TempDB::getAssetsUnitsByCenterNew($row['centreName']);
			foreach ($units as $rowunit) {
				print $rowunit['unitName'];
				print $rowunit['sorder'] . "<BR>";
				$counterId = sprintf("%03d", $rowunit['sorder']);
				print $row['sorder'].$counterId  . "<BR>" . "<BR>";
				$abc = $row['sorder'].$counterId;
				$abc = (int)$abc;
				print $abc . "<BR>";
				$unit = $rowunit['unitName'];
				$sql = "UPDATE assetunit SET sorderwithcenter='$abc' WHERE unitName='$unit'";
				$result = @$db->query($sql);
			}
        }
		break;
		 **************************************************
        $List = TempDB::getAssetsUnits();
        foreach ($List as $row) {
            print $row['SN'] . "<BR>";
            print $row['unitName'] . "<BR>";
            print rtrim($row['centreID'], '0') . "<BR>";
            //$lo = rtrim($row['centreID'], '0');
            print $row['centreName'] . "<BR>";
            $pw = "123";
            $fname = "User-Operator";
            $lname = "User 1";
            $login = rtrim($row['centreID'], '0') . "-OP";
            $place = $row['unitName'];
            $level = 8;
            $centreName = $row['centreName'];
            //$qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('User1','User1','$lo','" . md5($pw) . "','$row['unitName']','$level','$row['centreName']')";
            $qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('$fname','$lname','$login','" . md5($pw) . "','$place','$level','$centreName')";
            $result = @mysql_query($qry);
            //     
            //     $prov = new AssetsCenter($row['SN'], $row['unitName']);
            //     $provinces[] = $prov;
        }
        // $exps = get_users();
        // include('user_list.php');
        // include('sidebar.php');
        break;
		*/
    case 'user_control_level':
        $exps = get_users();
        include('user_control_level.php');
        // include('sidebar.php');
        break;
	case 'user_list':
        $exps = get_users();
        include('user_list.php');
        // include('sidebar.php');
        break;
    case 'Select_User_List':
        $assetscenter = (isset($_POST['assetscenter']) ? $_POST['assetscenter'] : "");
        $assetunit = (isset($_POST['assetunit']) ? $_POST['assetunit'] : "");
		$exps = get_users_selected($assetscenter, $assetunit);
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('user_list.php');
        break;
    case 'add_users':
        $assetscenter = "";
        $assetunit = "";
        $firstname = "";
        $lastname = "";
        $centreName = "";
        $place = "";
        $login = "";
        $passwd = "";
        $cpassword = "";
        $level = "";
        //  $plac = get_places();
        include('register-form.php');
        break;
    case 'findAssetsUnitsByCenter_Ajax':
        $assetscenter = $_GET['center'];
        $units = array();
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
		foreach ($assetunits as $unit) {
		$units[] = $unit->getName(); }
		echo json_encode( $units );
        break;
    case 'findAssetsUnitsByCenter':
        $assetscenter = $_REQUEST['center'];
        $assetunit = "";
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('../view/findassetsunitsbycenter.php');
        break;
    case 'register-exec':

		$errmsg_arr = array();
        $errflag = false;

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $assetscenter = $_POST['assetscenter'];
        $assetunit = $_POST['assetunit'];
        $login = $_POST['login'];
        $passwd = $_POST['passwd'];
        $cpassword = $_POST['cpassword'];
        $level = $_POST['level'];

		if (isset($_POST['search'])) {
		    $exps = get_users_selected($assetscenter, $assetunit);
		} else {
            $validate->text('firstname', $firstname);
            //$validate->text('lastname', $lastname);
            $validate->text('assetscenter', $assetscenter);
            //$validate->text('assetunit', $assetunit);
            $validate->text('login', $login);
            $validate->text('passwd', $passwd);
            $validate->text('cpassword', $cpassword);
            $validate->UserLevelCheck('level', $level);
            $validate->equailsCheck('cpassword', $cpassword, $passwd);

            $slidebartype = 3;
            if ($fields->hasErrors()) {
                $error = 2;
            } else {
                if ($login != '') {

                    $result = array();
                    $result = getUserByLogin($login);

                    if (count($result) > 0) {
                        $error = 3;
                    } else {
                        $sorderwithcenter = AssetsUnitDB::getsorderwithcenter($assetunit);
                        $date = date('Y-m-d H:i:s');
                        
                        $user_added = addUser($firstname, $lastname, $assetscenter, $login, $passwd, $assetunit, $level, $sorderwithcenter, $date);
                        if ($user_added) {
                            //$assetscenter = "";
                            // $assetunit = "";
                            $firstname = "";
                            $lastname = "";
                            $centreName = "";
                            $place = "";
                            $login = "";
                            $passwd = "";
                            $cpassword = "";
                            $level = "";
                            $error = 1;
                            $exps = get_users_selected($assetscenter, $assetunit);
                        } else {
                            $error = 5;
                        }
                    }
                }
            }
		}
		$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
        include('register-form.php');
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
        //  $plac = get_places();
        $error = 0;
		$exps = MembersDB::get_users_unit($assetunit);
        include('passwordreset-form.php');
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
                
                if (count($result) == 1) {      
                    $member = $result[0];
                    $level = $member['level'];
                    if ($level == 8) {
                        $passwd = '123';
                    } elseif ($level == 7 || $level == 17) {
                        $passwd = '1234';
                    } elseif ($level == 6) {
                        $passwd = '12345';
                    } else {
                        $passwd = '123456';
                    }
                    $date = date('Y-m-d H:i:s');
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
                } else {
                    $error = 3;
                }
                
            } else {
                $error = 6;
            }
        }
		$exps = MembersDB::get_users_unit($assetunit);
        include('passwordreset-form.php');
        break;
    case 'get_users_unit':
		$assetunit = $_GET['assetunit'];
		$exps = MembersDB::get_users_unit($assetunit);
		echo json_encode( $exps );
        break;
    case 'logging_list':
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
		if (isset($_POST['loginname'])) {
            $loginname = $_POST['loginname'];
        } else if (isset($_GET['loginname'])) {
            $loginname = $_GET['loginname'];
        } else {
            $loginname = "";
        }
		
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        //$items = LoginDB::getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2);
        $exps = LoginDB::getInqDetails($assetscenter, $assetunit, $loginname, $inputField1, $inputField2);
		//$exps = LoginDB::getLogin();
        include('login_list.php');
        break;
   case 'decative_accunt':
        $saveCount1 = membersDB::decative_accunt(8, '123');
		$saveCount2 = membersDB::decative_accunt(7, '1234');
		$saveCount3 = membersDB::decative_accunt(6, '12345');
		$saveCount2 = membersDB::decative_accunt(17, '1234');
        echo $saveCount1 + $saveCount2 + $saveCount3;
        break;
   case 'pw_update':
		$count = membersDB::pw_update();
		echo $count;
        break;
   case 'active_deactive':
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
		
		if (isset($_GET['act_dec'])) {
			if (isset($_GET['deactive'])) {
				$deactive = 0;
				$operation = "Active Account";
			} else {
				$deactive = 1;
				$operation = "Deactive Account";
			}
			$member_id = $_GET['member_id'];
			$count = MembersDB::active_decative($member_id, $deactive);
			$login = MembersDB::get_login($member_id);
			$saveCount = user_account_change_historyDB::addRecord($assetunit, $login, $operation, "", $_SESSION['SESS_LOGIN']);
			}	
		$exps = get_users_selected($assetscenter, $assetunit);
		$assetsCenters = AssetsCenterDB::getAssetsCenters();
        $assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 2);
        include('active_deactive.php');
        break;
    case 'psos_allow_list':
        $slidebartype = 2;
        $error = 0;
        $instName = "";
        $exps = CatalogueDB::getItemCategory();
		$landcategorys = LandCategoryDB::getLandCategorysArray();
		$buildingCategorys = BuildingCategoryDB::getBuildingCategorysArray();
        include('add_psos_allow_list.php');
        break;
  case 'Add_psos_save':
			$id = $_GET['id'];
			$DGGS = $_GET['DGGS']; 			
			$DOPS = $_GET['DOPS']; 		
			$DTRG = $_GET['DTRG'];       
			$DPLAN = $_GET['DPLAN'];      
			$DIT = $_GET['DIT'];        
			$CFE = $_GET['CFE'];        
			$CSO = $_GET['CSO'];        
			$DGSPORTS = $_GET['DGSPORTS'];   
			$DSPORTS = $_GET['DSPORTS'];    
			$AG = $_GET['AG'];         
			$DGAHS = $_GET['DGAHS'];      
			$DAMS = $_GET['DAMS'];       
			$DADS = $_GET['DADS'];    
			$DAMPS = $_GET['DAMPS'];  			
			$DAMM = $_GET['DAMM'];       
			$QMG = $_GET['QMG'];        
			$DAQ = $_GET['DAQ'];        
			$DST = $_GET['DST'];        
			$DES = $_GET['DES'];        
			$MGO = $_GET['MGO'];        
			$DOS = $_GET['DOS'];        
			$DEME = $_GET['DEME'];       
			$DGINF = $_GET['DGINF'];      
			$saveCount = CatalogueDB::update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		echo $saveCount;
		break;
  case 'Add_psos_save_land':
			$id = $_GET['id'];
			$DGGS = $_GET['DGGS']; 			
			$DOPS = $_GET['DOPS']; 		
			$DTRG = $_GET['DTRG'];       
			$DPLAN = $_GET['DPLAN'];      
			$DIT = $_GET['DIT'];        
			$CFE = $_GET['CFE'];        
			$CSO = $_GET['CSO'];        
			$DGSPORTS = $_GET['DGSPORTS'];   
			$DSPORTS = $_GET['DSPORTS'];    
			$AG = $_GET['AG'];         
			$DGAHS = $_GET['DGAHS'];      
			$DAMS = $_GET['DAMS'];       
			$DADS = $_GET['DADS'];    
			$DAMPS = $_GET['DAMPS'];  			
			$DAMM = $_GET['DAMM'];       
			$QMG = $_GET['QMG'];        
			$DAQ = $_GET['DAQ'];        
			$DST = $_GET['DST'];        
			$DES = $_GET['DES'];        
			$MGO = $_GET['MGO'];        
			$DOS = $_GET['DOS'];        
			$DEME = $_GET['DEME'];       
			$DGINF = $_GET['DGINF'];      
			$saveCount = LandCategoryDB::update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		echo $DGGS;
		break;
  case 'Add_psos_save_building':
			$id = $_GET['id'];
			$DGGS = $_GET['DGGS']; 			
			$DOPS = $_GET['DOPS']; 		
			$DTRG = $_GET['DTRG'];       
			$DPLAN = $_GET['DPLAN'];      
			$DIT = $_GET['DIT'];        
			$CFE = $_GET['CFE'];        
			$CSO = $_GET['CSO'];        
			$DGSPORTS = $_GET['DGSPORTS'];   
			$DSPORTS = $_GET['DSPORTS'];    
			$AG = $_GET['AG'];         
			$DGAHS = $_GET['DGAHS'];      
			$DAMS = $_GET['DAMS'];       
			$DADS = $_GET['DADS'];  
			$DAMPS = $_GET['DAMPS'];  			
			$DAMM = $_GET['DAMM'];       
			$QMG = $_GET['QMG'];        
			$DAQ = $_GET['DAQ'];        
			$DST = $_GET['DST'];        
			$DES = $_GET['DES'];        
			$MGO = $_GET['MGO'];        
			$DOS = $_GET['DOS'];        
			$DEME = $_GET['DEME'];       
			$DGINF = $_GET['DGINF'];      
			$saveCount = BuildingCategoryDB::update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		echo $saveCount;
		break;
    case 'copy_pso_details':
        $exps = CatalogueDB::getItemCategory();
		foreach ($exps as $row) {
			$type = $row['type'];
			$itemCategory = $row['itemCategory'];
			$DGGS = $row['DGGS']; 			
			$DOPS = $row['DOPS']; 		
			$DTRG = $row['DTRG'];       
			$DPLAN = $row['DPLAN'];      
			$DIT = $row['DIT'];        
			$CFE = $row['CFE'];        
			$CSO = $row['CSO'];        
			$DGSPORTS = $row['DGSPORTS'];   
			$DSPORTS = $row['DSPORTS'];    
			$AG = $row['AG'];         
			$DGAHS = $row['DGAHS'];      
			$DAMS = $row['DAMS'];       
			$DADS = $row['DADS'];  
			$DAMPS = $row['DAMPS']; 			
			$DAMM = $row['DAMM'];       
			$QMG = $row['QMG'];        
			$DAQ = $row['DAQ'];        
			$DST = $row['DST'];        
			$DES = $row['DES'];        
			$MGO = $row['MGO'];        
			$DOS = $row['DOS'];        
			$DEME = $row['DEME'];       
			$DGINF = $row['DGINF']; 
		if ($type == 1) {
				$saveCount1 = OfficeEquDB::update_psos_allow($itemCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		} else if ($type == 2) {
				$saveCount2 = PlantMacDB::update_psos_allow($itemCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);			
		} else if ($type == 3) {
				$saveCount3 = VehicleDB::update_psos_allow($itemCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);			
		}
		}
		
$landcategorys = LandCategoryDB::getLandCategorysArray();
		foreach ($landcategorys as $row) {
			$assetno = $row['assetno'];
			$DGGS = $row['DGGS']; 			
			$DOPS = $row['DOPS']; 		
			$DTRG = $row['DTRG'];       
			$DPLAN = $row['DPLAN'];      
			$DIT = $row['DIT'];        
			$CFE = $row['CFE'];        
			$CSO = $row['CSO'];        
			$DGSPORTS = $row['DGSPORTS'];   
			$DSPORTS = $row['DSPORTS'];    
			$AG = $row['AG'];         
			$DGAHS = $row['DGAHS'];      
			$DAMS = $row['DAMS'];       
			$DADS = $row['DADS']; 
			$DAMPS = $row['DAMPS']; 
			$DAMM = $row['DAMM'];       
			$QMG = $row['QMG'];        
			$DAQ = $row['DAQ'];        
			$DST = $row['DST'];        
			$DES = $row['DES'];        
			$MGO = $row['MGO'];        
			$DOS = $row['DOS'];        
			$DEME = $row['DEME'];       
			$DGINF = $row['DGINF']; 
			$saveCount4 = LandDB::update_psos_allow($assetno, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		}		
		
$buildingCategorys = BuildingCategoryDB::getBuildingCategorysArray();
		foreach ($buildingCategorys as $row) {
			$buildingCategory = $row['categoryName'];
			$DGGS = $row['DGGS']; 			
			$DOPS = $row['DOPS']; 		
			$DTRG = $row['DTRG'];       
			$DPLAN = $row['DPLAN'];      
			$DIT = $row['DIT'];        
			$CFE = $row['CFE'];        
			$CSO = $row['CSO'];        
			$DGSPORTS = $row['DGSPORTS'];   
			$DSPORTS = $row['DSPORTS'];    
			$AG = $row['AG'];         
			$DGAHS = $row['DGAHS'];      
			$DAMS = $row['DAMS'];       
			$DADS = $row['DADS']; 
			$DAMPS = $row['DAMPS'];			
			$DAMM = $row['DAMM'];       
			$QMG = $row['QMG'];        
			$DAQ = $row['DAQ'];        
			$DST = $row['DST'];        
			$DES = $row['DES'];        
			$MGO = $row['MGO'];        
			$DOS = $row['DOS'];        
			$DEME = $row['DEME'];       
			$DGINF = $row['DGINF']; 

			$saveCount4 = BuildingDB::update_psos_allow($buildingCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF);
		}		
		echo $saveCount4;
        break;
    case 'add_dam_controller':
        $slidebartype = 2;
        $error = 0;
        $exps = AssetsUnitDB::getFullListbyProtocol();
		$controllers = MembersDB::get_dam_controllers();
		include('add_dam_controller.php');
        break;
   case 'add_dam_controller_record':
        $error = 0;
		$id = $_GET['id'];
		$unit = $_GET['unit'];
        $controller = $_GET['controller'];
		$user_email = $_GET['user_email'];
		$saveCount = AssetsUnitDB::updateDamControllerRecord($id, $controller);
		$saveCount = MembersDB::update_user_email($unit, $user_email);
		if ($saveCount == 1) {
			$error = 1;
		} else {
			$error = 5;
		}
       echo $error;
        break;
    case 'copy_dam_controller':
        $exps = AssetsUnitDB::getFullListbyProtocol();
		foreach ($exps as $exp) {
			$assetunit = $exp['unitName'];
			$dam_controller = $exp['dam_controller'];
			$count1 = LandDB::update_dam_controller($assetunit, $dam_controller);
			$count2 = BuildingDB::update_dam_controller($assetunit, $dam_controller);
			$count3 = PlantMacDB::update_dam_controller($assetunit, $dam_controller);
			$count4 = OfficeEquDB::update_dam_controller($assetunit, $dam_controller);
			$count5 = VehicleDB::update_dam_controller($assetunit, $dam_controller);
			$centreName = $exp['centreName'];
			$count6 = AssetsCenterDB::update_dam_controller($centreName, $dam_controller);
		}
		echo $count2;
        break;
    case 'copy_email_from_unit':
        $exps = AssetsUnitDB::getFullListbyProtocol();
		foreach ($exps as $exp) {
			$assetunit = $exp['unitName'];
			$user_email = unitdetailsDB::get_email($assetunit);
			$saveCount = MembersDB::update_user_email($assetunit, $user_email);
		}
		echo $saveCount;
        break;
    case 'last_log_date':
        $slidebartype = 2;
        $error = 0;
        $exps = AssetsUnitDB::getFullListbyProtocol();
		$controllers = MembersDB::get_dam_controllers();
		include('last_log_date.php');
        break;
    case 'account_change_history':
        $assetscenter = "";
        $assetunit = "";
        $login = "";
        $error = 0;
        include('account_change_history.php');
        break;
    case 'get_change_history':
		$assetunit = $_GET['assetunit'];
		$login = $_GET['login'];
		$exps = user_account_change_historyDB::get_unit_details($assetunit, $login);
		echo json_encode( $exps );
        break;
}		
?>