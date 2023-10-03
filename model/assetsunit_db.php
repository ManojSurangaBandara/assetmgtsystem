<?php

class AssetsUnitDB {

    public static function getAssetsUnits() {
        $db = Database::getDB();
        $query = 'SELECT * FROM assetunit WHERE unit_type = 0 order by sorder';
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
			$query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and (protocoltext1 = '$assetscenter' or protocoltext2 = '$assetscenter') order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 15) {
			$query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and protocoltext1 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 25) {
			$query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and protocoltext2 = '$assetscenter' order by protocollevel5";
		} else if ($_SESSION['SESS_LEVEL'] == 5) {
			$dam_controller = $_SESSION['DAM_CONTROLLER'];
			$query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and centreName = '$assetscenter' and dam_controller = '$dam_controller' order by protocollevel5";
/* 		} else if ($_SESSION['SESS_LEVEL'] == 13) {
			$query = "SELECT * FROM `assetunit` WHERE protocoltext2 = '$assetscenter' order by protocollevel5"; */
		} else {
			$query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and centreName = '$assetscenter' order by protocollevel5";
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
        $query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and centreName = '$assetscenter' order by sorder";
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
        $query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and centreName IN (SELECT centreName FROM `assetunit` WHERE unitName = '$unit')";
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
        $query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and unitName = '$assetsUnit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = new AssetsCenter($row['SN'] ?? "", $row['centreID'] ?? "");
        return $centreID;
    }

    public static function getCentreIDByAssetsUnit1($assetsUnit) {
        $db = Database::getDB();
        $query = "SELECT centreID FROM `assetunit` WHERE unit_type = 0 and unitName = '$assetsUnit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        //$centreID = new AssetsCenter($row['SN'] ?? "", $row['centreID'] ?? "");
        return $row['centreID'];
    }	
	public static function getAllDetailsUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit where unit_type = 0 and unitName = '$assetunit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
    public static function addMembers($assetunit, $boardMemberName1, $boardMemberRank1, $boardMemberNumber1, $email1, $boardMemberName2, $boardMemberRank2, $boardMemberNumber2, $email2, $boardMemberName3, $boardMemberRank3, $boardMemberNumber3, $email3) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET boardMemberName1 = '$boardMemberName1', boardMemberRank1 = '$boardMemberRank1', boardMemberNumber1 = '$boardMemberNumber1', email1 = '$email1', boardMemberName2 = '$boardMemberName2', boardMemberRank2 = '$boardMemberRank2', boardMemberNumber2 = '$boardMemberNumber2', email2 = '$email2', boardMemberName3 = '$boardMemberName3', boardMemberRank3 = '$boardMemberRank3', boardMemberNumber3 = '$boardMemberNumber3', email3 = '$email3' WHERE unitName ='$assetunit'";
        $count = $db->exec($query);
        return $count;
    }
	
	   public static function getAssetsUnitsByCenterArray($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE unit_type = 0 and centreName = '$assetscenter'  order by sorder";
        $result = $db->query($query);
        return $result;
    }

	public static function getAssetsUnitsByCenterArray_ut($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM `assetunit` WHERE centreName = '$assetscenter'  order by sorder";
        $result = $db->query($query);
        return $result;
    }
	
	public static function getHasRecord($unitName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM assetunit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

	public static function getHasRecord1($centreID) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM assetunit WHERE centreID = '$centreID'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	public static function addRecord($assetscenter, $unitName, $centreID, $unit_type) {
        $db = Database::getDB();
        $query = "INSERT INTO assetunit (centreName, unitName, centreID, unit_type, Active) VALUES ('$assetscenter', '$unitName', '$centreID', '$unit_type', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
	public static function updatesorder($id, $sorder) {
        $db = Database::getDB();
        $query = "update assetunit set sorder='$sorder' where SN=$id";
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
        $query = "SELECT sorderwithcenter FROM assetunit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $sorderwithcenter = $row['sorderwithcenter'] ?? "";
        return $sorderwithcenter;
    }
	public static function centerupdatesorder($id, $abc) {
        $db = Database::getDB();
        $query = "update assetunit set sorderwithcenter='$abc' where SN=$id";
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
        $query = "SELECT * FROM assetunit WHERE unit_type = 0 and centreName = '$assetscenter' order by sorder";
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
        $query = "SELECT * FROM assetunit where unit_type = 0 order by protocollevel5";
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
        $query = "UPDATE assetunit SET report_received = '$report_received', report_received_date = '$report_received_date' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit where unit_type = 0 order by protocollevel5";
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
	public static function updateprotocolTem($assetunit, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE unitName ='$assetunit'";
        $count = $db->exec($query);
        return $count;
    }	
	public static function updateprotocol($id, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4, $protocollevel5) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getprotocol($unitName) {
        $db = Database::getDB();
        $query = "SELECT protocoltext1, protocoltext2, protocollevel1, protocollevel5, dam_controller FROM assetunit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
     //   $sorderwithcenter = $row['protocollevel5'];
     //   return $sorderwithcenter;
		return $row;
    }
    public static function getFullListbyProtocol() {
        $db = Database::getDB();
			$query = "SELECT * FROM assetunit where unit_type = 0 order by protocollevel5";
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
		public static function getprotocolDetails($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit where unitName = '$assetunit' order by sorder";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
	
	    public static function getUnitDetails() {
        $db = Database::getDB();
		$query = "SELECT assetunit.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM assetunit LEFT JOIN unitdetails ON assetunit.unitName=unitdetails.unit  order by assetunit.protocollevel5";
			//$query = "SELECT * FROM assetunit order by protocollevel5";
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
	    public static function getUnitDetails_unit($assetunit) {
        $db = Database::getDB();
		$query = "SELECT assetunit.unitName as unit, unitdetails.address as address, unitdetails.telephone as telephone, unitdetails.email as email, unitdetails.fax as fax, unitdetails.fb as fb, unitdetails.coX as coX, unitdetails.coY as coY FROM assetunit LEFT JOIN unitdetails ON assetunit.unitName=unitdetails.unit  where assetunit.protocoltext1 = '$assetunit' or assetunit.protocoltext2 = '$assetunit' order by assetunit.protocollevel5";
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
        $query = "UPDATE assetunit SET error_display = '$error_display', error_codes = '$error_codes' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getFullListwithunitSortProtocol() {
        $db = Database::getDB();
        $query = "SELECT assetunit.unitName, assetunit.SN, assetunit.error_display, assetunit.error_codes, unitdetails.email, unitdetails.errordisplay, unitdetails.errortitle, unitdetails.errordetails FROM assetunit LEFT JOIN unitdetails ON assetunit.unitName=unitdetails.unit ORDER BY assetunit.protocollevel5";
		//$query = "SELECT * FROM assetunit order by protocollevel5";
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
        $query = "UPDATE assetunit SET unitNameSinhala = '$unitNameSinhala', unitNameSinhalaFull = '$unitNameSinhalaFull', unitnameEnglishFull = '$unitnameEnglishFull' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function updateOrdinanceRecord($id, $ordinance) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET ordinance = '$ordinance' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getOrdince($unitName) {
        $db = Database::getDB();
        $query = "SELECT ordinance FROM assetunit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $ordinance = $row['ordinance'];
        return $ordinance;
    }
    public static function getFullListbyProtocol_ord($ordinance) {
        $db = Database::getDB();
			$query = "SELECT * FROM assetunit where ordinance = '$ordinance' order by protocollevel5";
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
			$query = "SELECT unitName FROM assetunit where ordinance = '$ordinance' order by protocollevel5";
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
        $query = "UPDATE assetunit SET dam_controller = '$controller' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function update_cigas_name($id, $cigas_name) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET cigas_name = '$cigas_name' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function get_cigas_name($unitName) {
        $db = Database::getDB();
        $query = "SELECT cigas_name FROM assetunit WHERE unitName = '$unitName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $cigas_name = $row['cigas_name'];
        return $cigas_name;
    }
	public static function update_province_code($id, $province) {
        $db = Database::getDB();
        $query = "UPDATE assetunit SET province_code = '$province' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getFullListwithBoardreport($currentYear) {
        $db = Database::getDB();
        $querytext = " br.cyear='$currentYear'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT unitName, br.* 
					FROM assetunit  
					LEFT JOIN board_report br ON unitName=br.assetunit
					where".$querytext." order by protocollevel5";
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
    public static function getCentreID($assetsUnit) {
        $db = Database::getDB();
        $query = "SELECT centreID FROM `assetunit` WHERE unitName = '$assetsUnit'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $centreID = $row['centreID'];
        return $centreID;
    }
    public static function board_report_notreceive_list($currentYear) {
        $db = Database::getDB();
        $querytext = " br.cyear='$currentYear'";
		//$querytext = Database::unitsFilter($querytext);
		$query = "SELECT unitName, centreName, protocoltext1, protocoltext2, u.address as address, u.telephone as telephone, u.email as email 
					FROM assetunit  
					LEFT JOIN unitdetails u ON unitName=u.unit
					where unit_type = 0 and Active = 1 and unitName NOT IN (SELECT assetunit FROM board_report where cyear ='$currentYear' and DAYNAME(received_date) IS NOT NULL) order by protocollevel5";
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
    public static function getUnitListbyProtocol($protocoltext1) {
        $db = Database::getDB();
			$query = "SELECT unitName FROM assetunit WHERE protocoltext1 = '$protocoltext1' or protocoltext2 = '$protocoltext1'  order by protocollevel5";
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
	public static function getFullList_unittype($unit_type) {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit where unit_type = '$unit_type' order by centreName, unitName";
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
	public static function getFullListsortCenterUnit() {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit where Active = 1 order by centreName, unitName, protocollevel5";
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
	public static function getAllunits() {
        $db = Database::getDB();
        $query = "SELECT * FROM assetunit order by protocollevel5";
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
	public static function change_units_details_save($id, $unitName, $centreID, $protocoltext1, $protocoltext2, $protocollevel1, $protocollevel2, $protocollevel3, $protocollevel4) {
        $db = Database::getDB();
        $protocollevel5 = $protocollevel1 . $protocollevel2 . $protocollevel3 . $protocollevel4;
		$query = "UPDATE assetunit SET unitName = '$unitName', centreID = '$centreID', protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocollevel1 = '$protocollevel1', protocollevel2 = '$protocollevel2', protocollevel3 = '$protocollevel3', protocollevel4 = '$protocollevel4', protocollevel5 = '$protocollevel5' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }	
	public static function change_units_type_active_save($id, $unit_type, $Active) {
        $db = Database::getDB();
		$query = "UPDATE assetunit SET unit_type = '$unit_type', Active = '$Active' WHERE SN ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getAllActiveunits() {
        $db = Database::getDB();
        $query = "SELECT assetunit.SN as id, assetunit.unitName as unitName, assetunit.centreName as centreName, bos_openingbalance_report_receving.received_date, bos_openingbalance_report_receving.approved_date FROM assetunit LEFT JOIN bos_openingbalance_report_receving ON assetunit.unitName = bos_openingbalance_report_receving.assetunit where Active = 1 order by protocollevel5";
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
}

?>