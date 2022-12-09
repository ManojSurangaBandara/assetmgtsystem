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
            $prov = new AssetsCenter($row['SN'], $row['unitName']);
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
            $prov = new AssetsCenter($row['SN'], $row['unitName']);
            $provinces[] = $prov;
        }
        return $provinces;
    }

    public static function getCentreIDByAssetsUnit($assetsUnit) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE unitName = '$assetsUnit'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = new AssetsCenter($row['SN'], $row['centreID']);
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