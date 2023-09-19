<?php
function get_users() {
    global $db;
    $query = 'SELECT * FROM members order by sorderwithcenter, level, login';
	/*$query = 'SELECT * 
	FROM members
	LEFT JOIN assetcentre ON members.centreName = assetcentre.centreName
	LEFT JOIN assetunit ON assetcentre.centreName = assetunit.centreName
	order by assetcentre.sorder, assetunit.sorder, level';
	*/
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function getUserByLogin($login) {
    global $db;
    $query = "SELECT * FROM members WHERE login='$login'";
    
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function addUser($firstname, $lastname, $assetscenter, $login, $passwd, $assetunit, $level, $sorderwithcenter, $date){
    global $db;
    $query = "INSERT INTO members(firstname, lastname, centreName, login, passwd, place, level, sorderwithcenter, pw_update) 
            VALUES	('$firstname','$lastname','$assetscenter','$login','" . md5($passwd) . "','$assetunit','$level','$sorderwithcenter','$date')";
    
    try {
        $statement = $db->prepare($query);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_users_selected($assetscenter, $assetunit) {
    global $db;
    $query = "SELECT * FROM members where centreName = '$assetscenter' and place = '$assetunit' order by level, login";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_users_selected_by_login($login, $assetscenter, $assetunit){
    global $db;
    $query = "SELECT * FROM members WHERE login='$login' and centreName='$assetscenter' and place='$assetunit'";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_places() {
    global $db;
    $query = 'SELECT * FROM places order by sno';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function updateConfirm() {
        $currentYear = ConstantsDB::getCurrentYear();
		$result = array(substr($currentYear, 0, 2) < substr($currentYear, -2),"abc");
		return $result;
}

function resetPassword($passwd, $date, $login, $assetscenter, $assetunit){
    global $db;
    $query = "UPDATE members SET passwd = '" . md5($passwd)."', pw_update = '".$date."', fail_attempts = 0 WHERE login='$login' and centreName='$assetscenter' and place='$assetunit'";
    try {
        $statement = $db->prepare($query);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
        return false;
    }
}


class TempDB {

    public static function getAssetsUnits() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetunit';
        $result = $db->query($query);
        return $result;
    }

	public static function getAssetsCenters() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetcentre order by sorder';
        $result = $db->query($query);
        return $result;
    }
	
    public static function getAssetsUnitsByCenter($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE centreName = '$assetscenter'";
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'] ?? "", $row['unitName'] ?? "");
            $provinces[] = $prov;
        }
        return $provinces;
    }

    public static function getPresentUnitByUnit($unit) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE centreName IN (SELECT centreName FROM `assetunit` WHERE unitName = '$unit')";
        // $query = "SELECT * FROM `assetunit`";
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'] ?? "", $row['unitName'] ?? "");
            $provinces[] = $prov;
        }
        return $provinces;
    }

    public static function getCentreIDByAssetsUnit($assetsUnit) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE unitName = '$assetsUnit'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = new AssetsCenter($row['SN'] ?? "", $row['centreID'] ?? "");
        return $centreID;
    }
	public static function getAssetsUnitsByCenterNew($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE centreName = '$assetscenter'";
        $result = $db->query($query);
        return $result;
    }
	
	public static function Savesorderwithcenter($sorderwithcenter, $member_id) {
        $db = Database::getDB();
        $query = "UPDATE members SET sorderwithcenter = '$sorderwithcenter' WHERE member_id ='$member_id'";
        $count = $db->exec($query);
        return $count;
		}

}

?>