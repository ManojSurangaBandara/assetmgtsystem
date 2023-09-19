<?php

class board_reportDB {

 	public static function addRecord($assetscenter, $assetunit, $cyear) {
        $db = Database::getDB();
        $query = "INSERT INTO board_report (assetscenter, assetunit, cyear) VALUES ('$assetscenter', '$assetunit', '$cyear')";
        $row_count = $db->exec($query);
        return $row_count;
    }
	public static function getHasRecord($assetscenter, $assetunit, $cyear) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM board_report WHERE assetscenter = '$assetscenter' and assetunit = '$assetunit' and cyear = '$cyear'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    } 
	public static function getassetpath($asset, $assetunit, $cyear) {
        $db = Database::getDB();
        $query = "SELECT ".$asset." as asset FROM board_report WHERE assetunit = '$assetunit' and cyear = '$cyear'";
        $result = $db->query($query);
        $row = $result->fetch();
        $assetpath = $row['asset'];
        return $assetpath;
    }     
	 public static function updateRecord($asset, $filename, $assetunit, $cyear) {
        $db = Database::getDB();
        $asset_path = $asset."_path";
		$asset_date = $asset."_date";
		$query = "UPDATE board_report SET ".$asset_path." = '$filename', ".$asset_date." = now() WHERE assetunit = '$assetunit' and cyear = '$cyear'";
        $count = $db->exec($query);
        return $count;
    }
     public static function getUnitList($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report WHERE assetunit = '$assetunit' order by cyear desc";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			//$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
     public static function getUnitList_currentyear($assetunit, $currentYear) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report WHERE assetunit = '$assetunit' and cyear = '$currentYear' order by cyear desc";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			//$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	 public static function updateReceiveDate($id, $received_date, $approved_date) {
        $db = Database::getDB();
		$query = $query = "UPDATE board_report SET received_date = '$received_date', approved_date = '$approved_date' WHERE id = '$id'";
        $count = $db->exec($query);
        return $count;
    } 
	 public static function delete_board_report_server($asset, $filename, $nulldate, $id) {
        $db = Database::getDB();
        $asset_path = $asset."_path";
		$asset_date = $asset."_date";
		$query = "UPDATE board_report SET ".$asset_path." = '$filename', ".$asset_date." = '$nulldate' WHERE id = '$id'";
        $count = $db->exec($query);
        return $count;
    }
 /*    public static function getAssetsUnits() {
        $db = Database::getDB();
        $query = 'SELECT * FROM board_report  order by sorder';
        $result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'] ?? "", $row['unitName'] ?? "");
            $provinces[] = $prov;
        }
        return $provinces;
    }

    public static function getAssetsUnitsByCenter($assetscenter, $level) {
        $db = Database::getDB();
		if ($_SESSION['SESS_LEVEL'] == 2) {
			$query = "SELECT * FROM `board_report` WHERE protocoltext1 = '$assetscenter' or protocoltext2 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 15) {
			$query = "SELECT * FROM `board_report` WHERE protocoltext1 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 25) {
			$query = "SELECT * FROM `board_report` WHERE protocoltext2 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 5) {
			$dam_controller = $_SESSION['DAM_CONTROLLER'];
			$query = "SELECT * FROM `board_report` WHERE centreName = '$assetscenter' and dam_controller = '$dam_controller' order by protocollevel5";
 		} else if ($_SESSION['SESS_LEVEL'] == 13) {
			$query = "SELECT * FROM `board_report` WHERE protocoltext2 = '$assetscenter' order by protocollevel5"; 
		} else {
			$query = "SELECT * FROM `board_report` WHERE centreName = '$assetscenter' order by protocollevel5";
        }
		$result = $db->query($query);
        $provinces = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter($row['SN'] ?? "", $row['unitName'] ?? "");
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
        $query = "SELECT * FROM `board_report` WHERE centreName = '$assetscenter' order by sorder";
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
        $query = "SELECT * FROM `board_report` WHERE centreName IN (SELECT centreName FROM `board_report` WHERE unitName = '$unit')";
        // $query = "SELECT * FROM `board_report`";
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
        $query = "SELECT * FROM `board_report` WHERE unitName = '$assetsUnit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = new AssetsCenter($row['SN'] ?? "", $row['centreID'] ?? "");
        return $centreID;
    }
	
	public static function getAllDetailsUnit($board_report) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report where unitName = '$board_report' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
    public static function addMembers($board_report, $boardMemberName1, $boardMemberRank1, $boardMemberNumber1, $email1, $boardMemberName2, $boardMemberRank2, $boardMemberNumber2, $email2, $boardMemberName3, $boardMemberRank3, $boardMemberNumber3, $email3) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET boardMemberName1 = '$boardMemberName1', boardMemberRank1 = '$boardMemberRank1', boardMemberNumber1 = '$boardMemberNumber1', email1 = '$email1', boardMemberName2 = '$boardMemberName2', boardMemberRank2 = '$boardMemberRank2', boardMemberNumber2 = '$boardMemberNumber2', email2 = '$email2', boardMemberName3 = '$boardMemberName3', boardMemberRank3 = '$boardMemberRank3', boardMemberNumber3 = '$boardMemberNumber3', email3 = '$email3' WHERE unitName ='$board_report'";
        $count = $db->exec($query);
        return $count;
    }
	
	   public static function getAssetsUnitsByCenterArray($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `board_report` WHERE centreName = '$assetscenter'  order by sorder";
        $result = $db->query($query);
        return $result;
    }
	
	public static function getHasRecord($unitName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM board_report WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

	public static function getHasRecord1($centreID) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM board_report WHERE centreID = '$centreID'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	public static function addRecord($assetscenter, $unitName, $centreID) {
        $db = Database::getDB();
        $query = "INSERT INTO board_report (centreName, unitName, centreID, Active) VALUES ('$assetscenter', '$unitName', '$centreID', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
	public static function updatesorder($id, $sorder) {
        $db = Database::getDB();
        $query = "update board_report set sorder='$sorder' where SN=$id";
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
        $query = "SELECT sorderwithcenter FROM board_report WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $sorderwithcenter = $row['sorderwithcenter'];
        return $sorderwithcenter;
    }
	public static function centerupdatesorder($id, $abc) {
        $db = Database::getDB();
        $query = "update board_report set sorderwithcenter='$abc' where SN=$id";
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
        $query = "SELECT * FROM board_report WHERE centreName = '$assetscenter' order by sorder";
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
        $query = "SELECT * FROM board_report order by protocollevel5";
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
        $query = "UPDATE board_report SET report_received = '$report_received', report_received_date = '$report_received_date' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report order by protocollevel5";
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
	public static function updateprotocolTem($board_report, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE unitName ='$board_report'";
        $count = $db->exec($query);
        return $count;
    }	
	public static function updateprotocol($id, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getprotocol($unitName) {
        $db = Database::getDB();
        $query = "SELECT protocoltext1, protocoltext2, protocollevel1, protocollevel5, dam_controller FROM board_report WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
     //   $sorderwithcenter = $row['protocollevel5'];
     //   return $sorderwithcenter;
		return $row;
    }
    public static function getFullListbyProtocol() {
        $db = Database::getDB();
			$query = "SELECT * FROM board_report order by protocollevel5";
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
		public static function getprotocolDetails($board_report) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report where unitName = '$board_report' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
	
	    public static function getUnitDetails() {
        $db = Database::getDB();
		$query = "SELECT board_report.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM board_report LEFT JOIN unitdetails ON board_report.unitName=unitdetails.unit  order by board_report.protocollevel5";
			//$query = "SELECT * FROM board_report order by protocollevel5";
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
	    public static function getUnitDetails_unit($board_report) {
        $db = Database::getDB();
		$query = "SELECT board_report.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM board_report LEFT JOIN unitdetails ON board_report.unitName=unitdetails.unit  where board_report.protocoltext1 = '$board_report' or board_report.protocoltext2 = '$board_report' order by board_report.protocollevel5";
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
        $query = "UPDATE board_report SET error_display = '$error_display', error_codes = '$error_codes' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListwithunitSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT board_report.unitName, board_report.SN, board_report.error_display, board_report.error_codes, unitdetails.email, unitdetails.errordisplay, unitdetails.errortitle, unitdetails.errordetails FROM board_report LEFT JOIN unitdetails ON board_report.unitName=unitdetails.unit ORDER BY board_report.protocollevel5";
		//$query = "SELECT * FROM board_report order by protocollevel5";
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
        $query = "UPDATE board_report SET unitNameSinhala = '$unitNameSinhala', unitNameSinhalaFull = '$unitNameSinhalaFull', unitnameEnglishFull = '$unitnameEnglishFull' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function updateOrdinanceRecord($id, $ordinance) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET ordinance = '$ordinance' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getOrdince($unitName) {
        $db = Database::getDB();
        $query = "SELECT ordinance FROM board_report WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $ordinance = $row['ordinance'];
        return $ordinance;
    }
    public static function getFullListbyProtocol_ord($ordinance) {
        $db = Database::getDB();
			$query = "SELECT * FROM board_report where ordinance = '$ordinance' order by protocollevel5";
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
    public static function getunits_ordinance($ordinance) {
        $db = Database::getDB();
			$query = "SELECT unitName FROM board_report where ordinance = '$ordinance' order by protocollevel5";
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
	public static function updateDamControllerRecord($id, $controller) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET dam_controller = '$controller' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function update_cigas_name($id, $cigas_name) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET cigas_name = '$cigas_name' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function get_cigas_name($unitName) {
        $db = Database::getDB();
        $query = "SELECT cigas_name FROM board_report WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $cigas_name = $row['cigas_name'];
        return $cigas_name;
    }
	public static function update_province_code($id, $province) {
        $db = Database::getDB();
        $query = "UPDATE board_report SET province_code = '$province' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    } */
}

?>