<?php

class AssetsCenterDB {

    public static function getAssetsCenters() {
        if ($_SESSION['SESS_LEVEL'] == 2) {
			$db = Database::getDB();
			$query = "SELECT * FROM assetunit order by protocollevel5";
			$result = $db->query($query);
			$provinces = array();
			$tem = "";
			$tem2 = "";
			foreach ($result as $row) {
					 if ($row['protocollevel1'] == 25) {
					 if ($tem <> $row['protocoltext2']) { 
						$prov = new AssetsCenter($row['SN'] ?? "", $row['protocoltext2'] ?? ""); 
					     $tem = $row['protocoltext2'];
						 $provinces[] = $prov;
					   } 
					 } else {
					 if ($tem <> $row['protocoltext1']) {	
						$prov = new AssetsCenter($row['SN'] ?? "", $row['protocoltext1'] ?? "");  
					   $tem = $row['protocoltext1'];
					   $provinces[] = $prov;
					} }
        }
		
		} else if ($_SESSION['SESS_LEVEL'] == 25) {
			$prov = new AssetsCenter(1, $_SESSION['SESS_PROTOCOLT2'] ?? "");
			$provinces[] = $prov;
		} else if ($_SESSION['SESS_LEVEL'] == 5) {
			$db = Database::getDB();
			$dam_controller = $_SESSION['DAM_CONTROLLER'];
			$query = "SELECT * FROM assetcentre JOIN assetunit ON assetcentre.centreName = assetunit.centreName WHERE assetcentre.Active='1' and assetunit.dam_controller = '$dam_controller' order by assetcentre.sorder";
			//$query = "SELECT * FROM assetunit where dam_controller = '$dam_controller' order by centreName";
			$result = $db->query($query);
			$provinces = array();
			$cn = "";
			foreach ($result as $row) { 
				if ($row['centreName'] <> $cn) {
					$prov = new AssetsCenter($row['id'] ?? "", $row['centreName'] ?? ""); 
					$provinces[] = $prov;
					$cn = $row['centreName'];
				}
        }
		} else {
		$db = Database::getDB();
        $query = "SELECT * FROM assetcentre  WHERE Active='1' order by sorder";
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['id'] ?? "", $row['centreName'] ?? "");
            if ($_SESSION['SESS_LEVEL'] == 6 || $_SESSION['SESS_LEVEL'] == 7 || $_SESSION['SESS_LEVEL'] == 8 || $_SESSION['SESS_LEVEL'] == 15 ) {
                if ($_SESSION['SESS_CENTRE'] == $row['centreName']) {
                    $provinces[] = $prov;
                }
			} else {
                $provinces[] = $prov;
            } 
        }
		}
        return $provinces;
    }
    public static function getAssetsCentersAll() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetcentre order by sorder';
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['id'], $row['centreName'], $row['Active']);
                $provinces[] = $prov;
            } 
        return $provinces;
    }
	
	    public static function getAssetsCentersAlls() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetcentre order by sorder';
        $result = $db->query($query);
        return $result;
    }
	
	    public static function getHasRecord($instName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM assetcentre WHERE centreName = '$instName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	    public static function addRecord($instName) {
        $db = Database::getDB();
        $query = "INSERT INTO assetcentre (centreName, Active) VALUES ('$instName', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
	    public static function addRecordgrid($centreName, $Active, $sorder) {
        $db = Database::getDB();
        $query = "INSERT INTO assetcentre (centreName, Active, sorder) VALUES ('$centreName', '$Active', '$sorder')";
        $row_count = 0;
        try {
			$row_count = $db->exec($query);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $row_count;
    }
    public static function updatesorder($id, $sorder) {
        $db = Database::getDB();
        $query = "update assetcentre set sorder='$sorder' where id=$id";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	public static function getsorder($centreName) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetcentre` WHERE centreName = '$centreName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $sorder = $row['sorder'] ?? "";
        return $sorder;
    }
    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetcentre order by sorder';
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
        return $result;
    }
	public static function add_centreNameSinhala($id, $centreNameSinhala, $centreNameSinhalaFull, $centreNameEnglishFull) {
        $db = Database::getDB();
        $query = "UPDATE assetcentre SET centreNameSinhala = '$centreNameSinhala', centreNameSinhalaFull = '$centreNameSinhalaFull', centreNameEnglishFull = '$centreNameEnglishFull' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function update_dam_controller($centreName, $dam_controller) {
        $db = Database::getDB();
        $query = "UPDATE assetcentre SET dam_controller = '$dam_controller' WHERE centreName ='$centreName'";
        $count = $db->exec($query);
        return $count;
		} 	
}

?>