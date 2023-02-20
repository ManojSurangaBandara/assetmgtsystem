<?php
require('../model/database.php');
require('../model/users_db.php');
require_once('../php-login/auth.php');
require('../model/AssetsCenter_db.php');
require('../model/AssetsCenter.php');
require('../model/AssetsUnit_db.php');
require_once('../model/fields.php');
require_once('../model/validate.php');
$page = 7;
include '../view/header1.php';
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=user_list" class="sm4">Users List</a></li>
        <li><a href="index.php?action=add_users" class="sm4">Add Users</a></li>
		 <li><a href="index.php?action=#" class="sm4">temp</a></li>
    </ul>
</div>
<?php
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('assetscenter');
$fields->addField('assetunit');

if (isset($_POST['action'])) {
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'user_list';
}
$assetscenter = $_SESSION['SESS_CENTRE'];
$assetunit = $_SESSION['SESS_PLACE'];
$assetsCenters = AssetsCenterDB::getAssetsCenters();
$assetunits = AssetsUnitDB::getAssetsUnitsByCenter($assetscenter, 1);
switch ($action) {
    case 'temp':
	$List = TempDB::getAssetsUnits();
       foreach ($List as $row) {
       print $row['SN'] . "<BR>";
		print $row['unitName'] . "<BR>";
		print rtrim($row['centreID'], '0') . "<BR>";
		//$lo = rtrim($row['centreID'], '0');
		print $row['centreName']. "<BR>";
		$pw = "123";
		$fname = "User-Operator";
		$lname = "User 1";
		$login = rtrim($row['centreID'], '0')."-OP";
		$place = $row['unitName'];
		$level = 8;
		$centreName = $row['centreName'];
		//$qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('User1','User1','$lo','" . md5($pw) . "','$row['unitName']','$level','$row['centreName']')";
        $qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level, centreName) VALUES('$fname','$lname','$login','" . md5($pw) . "','$place','$level','$centreName')";
        try {
            $statement = $db->prepare($qry);
            $result = $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
	   //     
       //     $prov = new AssetsCenter($row['SN'], $row['unitName']);
       //     $provinces[] = $prov;
        }
	   // $exps = get_users();
       // include('user_list.php');
       // include('sidebar.php');
        break;
    case 'user_list':
        $exps = get_users();
        include('user_list.php');
       // include('sidebar.php');
        break;
    case 'add_users':
	
        $plac = get_places();
        include('register-form.php');
        break;
    case 'register-exec':
        $errmsg_arr = array();
        $errflag = false;

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $place = $_POST['place'];
        $level = $_POST['level'];

        //Input Validations
        if ($fname == '') {
            $errmsg_arr[] = 'Full Name missing';
            $errflag = true;
        }
        if ($lname == '') {
            $errmsg_arr[] = 'Unit missing';
            $errflag = true;
        }
        if ($login == '') {
            $errmsg_arr[] = 'Login ID missing';
            $errflag = true;
        }
        if ($password == '') {
            $errmsg_arr[] = 'Password missing';
            $errflag = true;
        }
        if ($cpassword == '') {
            $errmsg_arr[] = 'Confirm password missing';
            $errflag = true;
        }
        if (strcmp($password, $cpassword) != 0) {
            $errmsg_arr[] = 'Passwords do not match';
            $errflag = true;
        }

        //Check for duplicate login ID
        if ($login != '') {
            $qry = "SELECT * FROM members WHERE login='$login'";
            $result = array();
            try {
                $statement = $db->prepare($qry);
                $statement->execute();
                $result = $statement->fetchAll();
                $statement->closeCursor();
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                display_db_error($error_message);
            }
            if (count($result) > 0) {
                $errmsg_arr[] = 'Login ID already in use';
                $errflag = true;
            } else {
                die("Query failed");
            }
        }

        //If there are input validations, redirect back to the registration form
        if ($errflag) {
            $plac = get_places();
            include('register-form.php');
            //	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            //	session_write_close();
            //	header("location: register-form.php");
            exit();
        }

        //Create INSERT query
        $qry = "INSERT INTO members(firstname, lastname, login, passwd, place, level) VALUES('$fname','$lname','$login','" . md5($_POST['password']) . "','$place','$level')";
        $result = false;
        try {
            $statement = $db->prepare($qry);
            $result = $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        //Check whether the query was successful or not
        if ($result) {
            //	header("location: register-success.php");
            $exps = get_users();
            include('user_list.php');
            //include('sidebar.php');
            exit();
        } else {
            die("Query failed");
        }
        break;
}
?>

<?php
include '../view/footer.php';
?>