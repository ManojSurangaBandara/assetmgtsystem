<?php

class BoardOfSurvey_UnitDB {

    public static function getAssetsUnits() {
        $db = Database::getDB();
        $query = 'SELECT * FROM boardofsurvey_unit  order by sorder';
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'], $row['unitName']);
            $provinces[] = $prov;
        }
        return $provinces;
    }

    public static function getAssetsUnitsByCenter($assetscenter, $level) {
        $db = Database::getDB();
		if ($_SESSION['SESS_LEVEL'] == 2) {
			$query = "SELECT * FROM `boardofsurvey_unit` WHERE protocoltext1 = '$assetscenter' or protocoltext2 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 15) {
			$query = "SELECT * FROM `boardofsurvey_unit` WHERE protocoltext1 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 25) {
			$query = "SELECT * FROM `boardofsurvey_unit` WHERE protocoltext2 = '$assetscenter' order by protocollevel5";
/* 		} else if ($_SESSION['SESS_LEVEL'] == 13) {
			$query = "SELECT * FROM `boardofsurvey_unit` WHERE protocoltext2 = '$assetscenter' order by protocollevel5"; */
		} else {
			$query = "SELECT * FROM `boardofsurvey_unit` WHERE centreName = '$assetscenter' order by protocollevel5";
        }
		$result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'], $row['unitName']);
            if ($_SESSION['SESS_LEVEL'] == 6 || $_SESSION['SESS_LEVEL'] == 7 || $_SESSION['SESS_LEVEL'] == 8) {
                if ($_SESSION['SESS_PLACE'] == $row['unitName']) {
                    $provinces[] = $prov;
                    setcookie('assetsUnit', $_SESSION['SESS_PLACE']);
                } else if ($level == 2 && $_SESSION['SESS_PLACE'] == $row['centreName']) {
                    $provinces[] = $prov;
                }
            } else {
                $provinces[] = $prov;
            } 
           // $provinces[] = $prov;
        }
        return $provinces;
    }

	    public static function getAssetsUnitsByCenterAll($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `boardofsurvey_unit` WHERE centreName = '$assetscenter' order by sorder";
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
        $query = "SELECT * FROM `boardofsurvey_unit` WHERE centreName IN (SELECT centreName FROM `boardofsurvey_unit` WHERE unitName = '$unit')";
        // $query = "SELECT * FROM `boardofsurvey_unit`";
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
        $query = "SELECT * FROM `boardofsurvey_unit` WHERE unitName = '$assetsUnit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = new AssetsCenter($row['SN'], $row['centreID']);
        return $centreID;
    }
	
	public static function getAllDetailsUnit($boardofsurvey_unit) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_unit where unitName = '$boardofsurvey_unit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
    public static function addMembers($boardofsurvey_unit, $boardMemberName1, $boardMemberRank1, $boardMemberNumber1, $email1, $boardMemberName2, $boardMemberRank2, $boardMemberNumber2, $email2, $boardMemberName3, $boardMemberRank3, $boardMemberNumber3, $email3) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET boardMemberName1 = '$boardMemberName1', boardMemberRank1 = '$boardMemberRank1', boardMemberNumber1 = '$boardMemberNumber1', email1 = '$email1', boardMemberName2 = '$boardMemberName2', boardMemberRank2 = '$boardMemberRank2', boardMemberNumber2 = '$boardMemberNumber2', email2 = '$email2', boardMemberName3 = '$boardMemberName3', boardMemberRank3 = '$boardMemberRank3', boardMemberNumber3 = '$boardMemberNumber3', email3 = '$email3' WHERE unitName ='$boardofsurvey_unit'";
        $count = $db->exec($query);
        return $count;
    }
	
	   public static function getAssetsUnitsByCenterArray($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `boardofsurvey_unit` WHERE centreName = '$assetscenter'  order by sorder";
        $result = $db->query($query);
        return $result;
    }
	
	public static function getHasRecord($unitName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM boardofsurvey_unit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

	public static function getHasRecord1($centreID) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM boardofsurvey_unit WHERE centreID = '$centreID'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	public static function addRecord($assetscenter, $unitName, $centreID) {
        $db = Database::getDB();
        $query = "INSERT INTO boardofsurvey_unit (centreName, unitName, centreID, Active) VALUES ('$assetscenter', '$unitName', '$centreID', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
	public static function updatesorder($id, $sorder) {
        $db = Database::getDB();
        $query = "update boardofsurvey_unit set sorder='$sorder' where SN=$id";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	public static function getsorderwithcenter($unitName) {
        $db = Database::getDB();
        $query = "SELECT sorderwithcenter FROM boardofsurvey_unit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $sorderwithcenter = $row['sorderwithcenter'];
        return $sorderwithcenter;
    }
	public static function centerupdatesorder($id, $abc) {
        $db = Database::getDB();
        $query = "update boardofsurvey_unit set sorderwithcenter='$abc' where SN=$id";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
    public static function getUnitDetailsbycenter($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_unit WHERE centreName = '$assetscenter' order by sorder";
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
    public static function getFullList() {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_unit order by protocollevel5";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function add_report_received($id, $report_received, $report_received_date) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET report_received = '$report_received', report_received_date = '$report_received_date' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_unit order by protocollevel5";
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
	public static function updateprotocolTem($boardofsurvey_unit, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE unitName ='$boardofsurvey_unit'";
        $count = $db->exec($query);
        return $count;
    }	
	public static function updateprotocol($id, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getprotocol($unitName) {
        $db = Database::getDB();
        $query = "SELECT protocoltext1, protocoltext2, protocollevel1, protocollevel5 FROM boardofsurvey_unit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
     //   $sorderwithcenter = $row['protocollevel5'];
     //   return $sorderwithcenter;
		return $row;
    }
    public static function getFullListbyProtocol() {
        $db = Database::getDB();
			$query = "SELECT * FROM boardofsurvey_unit order by protocollevel5";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
		public static function getprotocolDetails($boardofsurvey_unit) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_unit where unitName = '$boardofsurvey_unit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
	
	    public static function getUnitDetails() {
        $db = Database::getDB();
		$query = "SELECT boardofsurvey_unit.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM boardofsurvey_unit LEFT JOIN unitdetails ON boardofsurvey_unit.unitName=unitdetails.unit  order by boardofsurvey_unit.protocollevel5";
			//$query = "SELECT * FROM boardofsurvey_unit order by protocollevel5";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	    public static function getUnitDetails_unit($boardofsurvey_unit) {
        $db = Database::getDB();
		$query = "SELECT boardofsurvey_unit.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM boardofsurvey_unit LEFT JOIN unitdetails ON boardofsurvey_unit.unitName=unitdetails.unit  where boardofsurvey_unit.protocoltext1 = '$boardofsurvey_unit' or boardofsurvey_unit.protocoltext2 = '$boardofsurvey_unit' order by boardofsurvey_unit.protocollevel5";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    
	public static function updateerror_codes($id, $error_display, $error_codes) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET error_display = '$error_display', error_codes = '$error_codes' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListwithunitSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT boardofsurvey_unit.unitName, boardofsurvey_unit.SN, boardofsurvey_unit.error_display, boardofsurvey_unit.error_codes, unitdetails.email, unitdetails.errordisplay, unitdetails.errortitle, unitdetails.errordetails FROM boardofsurvey_unit LEFT JOIN unitdetails ON boardofsurvey_unit.unitName=unitdetails.unit ORDER BY boardofsurvey_unit.protocollevel5";
		//$query = "SELECT * FROM boardofsurvey_unit order by protocollevel5";
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
	public static function add_unitNameSinhala($id, $unitNameSinhala, $unitNameSinhalaFull, $unitnameEnglishFull) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET unitNameSinhala = '$unitNameSinhala', unitNameSinhalaFull = '$unitNameSinhalaFull', unitnameEnglishFull = '$unitnameEnglishFull' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function updateOrdinanceRecord($id, $ordinance) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_unit SET ordinance = '$ordinance' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getOrdince($unitName) {
        $db = Database::getDB();
        $query = "SELECT ordinance FROM boardofsurvey_unit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $ordinance = $row['ordinance'];
        return $ordinance;
    }
    public static function getFullListbyProtocol_ord($ordinance) {
        $db = Database::getDB();
			$query = "SELECT * FROM boardofsurvey_unit where ordinance = '$ordinance' order by protocollevel5";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
}

?>