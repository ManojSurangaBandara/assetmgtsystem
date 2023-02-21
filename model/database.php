<?php

/* $dsn = 'mysql:host=172.16.0.9;dbname=assetmgtsystemtest;charset=UTF8';  
  $username = 'user_assettest';
  $password = 'asset#$789';
  $dbhost = '172.16.0.9';
 */

/* $dsn = 'mysql:host=172.16.60.12;dbname=assetmgtsystem;charset=UTF8';  
  $username = 'asset';
  $password = 'Asset@#567';
  $dbhost = '172.16.60.12';

  $dbuser = $username;
  $dbpass = $password;
  $conn = mysql_connect($dbhost, $dbuser, $dbpass);
  if(! $conn )
  {
  die('Could not connect: ' . mysql_error());
  }
  mysql_select_db("assetmgtsystem") or die(mysql_error()); */

/////////////////  LOCALHOST   ///////////////////////
$dsn = 'mysql:host=localhost;dbname=assetmgtsystem;charset=UTF8';
$username = 'root';
$password = '';
$dbhost = 'localhost';

/////////////////   SERVER   ///////////////////////
// $dsn = 'mysql:host=172.16.60.29;dbname=assetmgtsystem;charset=UTF8';
// $username = 'assetmgtsystem';
// $password = 'Asset@#567';
// $dbhost = '172.16.60.29';

// try {
//     $db = new PDO('mysql:host=localhost;dbname=assetmgtsystem', $username, $password);
// //    foreach($dbh->query('SELECT * from members') as $row) {
// //        print_r($row);
// //    }
//     $db = null;
// } catch (PDOException $e) {
//     print "Error!: " . $e->getMessage() . "<br/>";
//     die();
// }

// $dbuser = $username;
// $dbpass = $password;

// $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
// if (!$conn) {
//     die('Could not connect: ' . mysqli_error());
// }
// mysqli_select_db($conn, "assetmgtsystem") or die(mysqli_error());

try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('../errors/database_error.php');
    exit();
}

class Database {
    /*
      private static $dsn = 'mysql:host=172.16.0.9;dbname=assetmgtsystemtest';
      private static $username = 'user_assettest';
      private static $password = 'asset#$789';
     */

    /////////////////  LOCALHOST   ///////////////////////
    private static $dsn = 'mysql:host=localhost;dbname=assetmgtsystem';
    private static $username = 'root';
    private static $password = '';
    private static $db;

    /////////////////  SERVER   ///////////////////////
    // private static $dsn = 'mysql:host=172.16.60.29;dbname=assetmgtsystem';
    // private static $username = 'assetmgtsystem';
    // private static $password = 'Asset@#567';
    // private static $db;

    private function __construct() {
        
    }

    public static function getDB() {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn,
                        self::$username,
                        self::$password);
            } catch (PDOException $e) {
                $error_message = $e->getMessage();
                include '../errors/db_error.php';
                //include('/errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }

    public static function filterUnits($result) {
        if ($_SESSION['SESS_LEVEL'] == 6 || $_SESSION['SESS_LEVEL'] == 7 || $_SESSION['SESS_LEVEL'] == 8) {
            return ($result['assetunit'] == $_SESSION['SESS_PLACE']);
        } else if ($_SESSION['SESS_LEVEL'] == 15) {
            return (isset($result['protocoltext1']) && $result['protocoltext1'] == $_SESSION['SESS_PROTOCOLT1']);
        } else if ($_SESSION['SESS_LEVEL'] == 25) {
            return (isset($result['protocoltext2']) && $result['protocoltext2'] == $_SESSION['SESS_PROTOCOLT2']);
        } else if ($_SESSION['SESS_LEVEL'] == 5) {
            return (isset($result['dam_controller']) && $result['dam_controller'] == $_SESSION['SESS_LOGIN']);
        } else {
            return true;
        }
    }

    public static function filterCentre($result) {
        if ($_SESSION['SESS_LEVEL'] == 6 || $_SESSION['SESS_LEVEL'] == 7 || $_SESSION['SESS_LEVEL'] == 8) {
            if ($_SESSION['SESS_PLACE'] == $_SESSION['SESS_CENTRE']) {
                return ($result['assetscenter'] == $_SESSION['SESS_PLACE']);
            } else {
                return ($result['assetunit'] == $_SESSION['SESS_PLACE']);
            }
        } else if ($_SESSION['SESS_LEVEL'] == 15) {
            return (isset($result['protocoltext1']) && $result['protocoltext1'] == $_SESSION['SESS_PROTOCOLT1']);
        } else if ($_SESSION['SESS_LEVEL'] == 25) {
            return (isset($result['protocoltext2']) && $result['protocoltext2'] == $_SESSION['SESS_PROTOCOLT2']);
        } else {
            return true;
        }
    }

    public static function unitsFilter($querytext) {
        if ($_SESSION['SESS_LEVEL'] == 6 || $_SESSION['SESS_LEVEL'] == 7 || $_SESSION['SESS_LEVEL'] == 8) {
            $assetunit = $_SESSION['SESS_PLACE'];
            $querytext = $querytext . " and  assetunit = '$assetunit'";
        } else if ($_SESSION['SESS_LEVEL'] == 15) {
            $protocoltext1 = $_SESSION['SESS_PROTOCOLT1'];
            $querytext = $querytext . " and  protocoltext1 = '$protocoltext1'";
            //return ($result['protocoltext1'] == $_SESSION['SESS_PROTOCOLT1']);
        } else if ($_SESSION['SESS_LEVEL'] == 25) {
            $protocoltext2 = $_SESSION['SESS_PROTOCOLT2'];
            $querytext = $querytext . " and  protocoltext2 = '$protocoltext2'";
            //return ($result['protocoltext2'] == $_SESSION['SESS_PROTOCOLT2']);
        } else if ($_SESSION['SESS_LEVEL'] == 10) {
            $querytext = $querytext . " and  " . $_SESSION['SESS_LAST_NAME'] . " = 1";
        } else if ($_SESSION['SESS_LEVEL'] == 5) {
            $dam_controller = $_SESSION['SESS_LOGIN'] ?? "";
            $querytext = $querytext . " and  dam_controller = '$dam_controller'";
        }
        return $querytext;
    }

}

?>
