<?php

class loss_damageDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = "SELECT * FROM loss_damage where closedfile = 0 order by fileno";
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
    public static function getSidebarDetails($ststus) {
        $db = Database::getDB();
        if ($ststus == 0) {
			$query = "SELECT * FROM loss_damage where closedfile = 0 order by fileno";
		} else if ($ststus == 1) {
			$query = "SELECT * FROM loss_damage where closedfile = 1 order by fileno";		
		}
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
	
	public static function _1043($result) {
	$_1043_adviseddate = date_parse($result['_1043_adviseddate']);
	$_1043_defminrecdate = date_parse($result['_1043_defminrecdate']);
		return (!checkdate($_1043_adviseddate["month"], $_1043_adviseddate["day"], $_1043_adviseddate["year"]) && !checkdate($_1043_defminrecdate["month"], $_1043_defminrecdate["day"], $_1043_defminrecdate["year"]));
	}

	public static function _1044($result) {
	$_1044_recdate = date_parse($result['_1044_recdate']);
		return (!checkdate($_1044_recdate["month"], $_1044_recdate["day"], $_1044_recdate["year"]));
	}	

	public static function _1049($result) {
	$_1043_adviseddate = date_parse($result['_1043_adviseddate']);
	$_1043_defminrecdate = date_parse($result['_1043_defminrecdate']);
		return (checkdate($_1043_adviseddate["month"], $_1043_adviseddate["day"], $_1043_adviseddate["year"]) || checkdate($_1043_defminrecdate["month"], $_1043_defminrecdate["day"], $_1043_defminrecdate["year"]));
	}

	public static function _109($result) {
	$removeddate = date_parse($result['removeddate']);
	$_1044_defminrecdate = date_parse($result['_1044_defminrecdate']);
		return (!checkdate($removeddate["month"], $removeddate["day"], $removeddate["year"]) && checkdate($_1044_defminrecdate["month"], $_1044_defminrecdate["day"], $_1044_defminrecdate["year"]));
	}
	public static function _removed($result) {
	$_109_defminrecdate = date_parse($result['_109_defminrecdate']);
		return ( $result['closedfile'] == 0 && checkdate($_109_defminrecdate["month"], $_109_defminrecdate["day"], $_109_defminrecdate["year"]));
	}
	public static function _close($result) {
	$removeddate = date_parse($result['removeddate']);
		return ( $result['closedfile'] == 0 && checkdate($removeddate["month"], $removeddate["day"], $removeddate["year"]));
	}	
	public static function getHasRecord($fileno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM loss_damage WHERE fileno = '$fileno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addRecord($fileno, $assetscenter, $assetunit, $place, $date, $time, $goods, $value, $description, $letter1, $letter1date) {
        $db = Database::getDB();
        $query = "INSERT INTO loss_damage
          (fileno, assetscenter, assetunit, place, date, time, goods, value, description, letter1, letter1date, closedfile)
          VALUES
          ('$fileno', '$assetscenter', '$assetunit', '$place', '$date', '$time', '$goods', '$value', '$description', '$letter1', '$letter1date', 0)";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
        public static function updateRecord($fileno, $assetscenter, $assetunit, $place, $date, $time, $goods, $value, $description, $letter1, $letter1date) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET assetscenter = '$assetscenter', assetunit = '$assetunit', place = '$place', date = '$date', time = '$time', goods = '$goods', value = '$value', description = '$description', letter1 = '$letter1', letter1date = '$letter1date' WHERE fileno ='$fileno'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from loss_damage where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getfilenoById($id) {
        $db = Database::getDB();
        $query = "select fileno from loss_damage where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['fileno'];
    }
	public static function getboardletterByFileno($fileno) {
        $db = Database::getDB();
        $query = "select board_letter from loss_damage where fileno = '$fileno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['board_letter'];
    }
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM loss_damage WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
    public static function updateRecord_1043($id, $_1043_recdate, $_1043_frbrsenddate, $_1043_frbrrecdate, $_1043_comdsecsenddate, $_1043_comdsecrecdate, $_1043_defminsenddate, $_1043_defminrecdate, $_1043_adviseddate, $_1043_letter) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET _1043_recdate = '$_1043_recdate', _1043_frbrsenddate = '$_1043_frbrsenddate', _1043_frbrrecdate = '$_1043_frbrrecdate', _1043_comdsecsenddate = '$_1043_comdsecsenddate', _1043_comdsecrecdate = '$_1043_comdsecrecdate', _1043_defminsenddate = '$_1043_defminsenddate', _1043_defminrecdate = '$_1043_defminrecdate', _1043_adviseddate = '$_1043_adviseddate', _1043_letter = '$_1043_letter' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function updateRecord_1044($id, $_1044_recdate, $_1044_obsenddate, $_1044_obrecdate, $_1044_lowsenddate, $_1044_lowobsenddate, $_1044_againsenddate, $_1044_againrecdate, $_1044_againlowsenddate, $_1044_commanderorderdate, $_1044_clams, $_1044_frbrsenddate, $_1044_frbrrecdate, $_1044_comdsecsenddate, $_1044_comdsecrecdate, $_1044_defminsenddate, $_1044_defminrecdate, $_1044_letter) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET _1044_recdate = '$_1044_recdate', _1044_obsenddate = '$_1044_obsenddate', _1044_obrecdate = '$_1044_obrecdate', _1044_lowsenddate = '$_1044_lowsenddate', _1044_lowobsenddate = '$_1044_lowobsenddate', _1044_againsenddate = '$_1044_againsenddate', _1044_againrecdate = '$_1044_againrecdate', _1044_againlowsenddate = '$_1044_againlowsenddate', _1044_commanderorderdate = '$_1044_commanderorderdate', _1044_clams = '$_1044_clams', _1044_frbrsenddate = '$_1044_frbrsenddate', _1044_frbrrecdate = '$_1044_frbrrecdate', _1044_comdsecsenddate = '$_1044_comdsecsenddate', _1044_comdsecrecdate = '$_1044_comdsecrecdate', _1044_defminsenddate = '$_1044_defminsenddate', _1044_defminrecdate = '$_1044_defminrecdate', _1044_letter = '$_1044_letter' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function updateRecord_109($id, $_109_dirfinsenddate, $_109_dirfinrecdate, $_109_frbrsenddate, $_109_frbrrecdate, $_109_comdsecsenddate, $_109_comdsecrecdate, $_109_defminsenddate, $_109_defminrecdate, $_109_letter) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET _109_dirfinsenddate = '$_109_dirfinsenddate', _109_dirfinrecdate = '$_109_dirfinrecdate', _109_frbrsenddate = '$_109_frbrsenddate', _109_frbrrecdate = '$_109_frbrrecdate', _109_comdsecsenddate = '$_109_comdsecsenddate', _109_comdsecrecdate = '$_109_comdsecrecdate', _109_defminsenddate = '$_109_defminsenddate', _109_defminrecdate = '$_109_defminrecdate', _109_letter = '$_109_letter' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function updateRecord_removed($id, $removeddate, $removedvalue) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET removeddate = '$removeddate', removedvalue = '$removedvalue' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function updateRecord_close_file($id, $closedfile) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET closedfile = '$closedfile' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function updateRecord_board($fileno, $board_letter) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET board_letter = '$board_letter' WHERE fileno ='$fileno'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getReportName($fileno, $type) {
        $db = Database::getDB();
        if ($type == 1) {
		$query = "select _1043_letter as letter from loss_damage where fileno = '$fileno'";
        } 
		$result = $db->query($query);
        $row = $result->fetch();
        return $row['letter'];
    }
    public static function getClosedFiles() {
        $db = Database::getDB();
        $query = "SELECT * FROM loss_damage where closedfile = 1 order by fileno";
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
	public static function status() {
        $db = Database::getDB();
        global $filestatus;
		$status = array();
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1043_frbrrecdate) = 0 OR _1043_frbrrecdate IS NULL) and year(_1043_frbrsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1043 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1044_frbrrecdate) = 0 OR _1044_frbrrecdate IS NULL) and year(_1044_frbrsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1044 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_109_frbrrecdate) = 0 OR _109_frbrrecdate IS NULL) and year(_109_frbrsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_109 = $row['cnt'];
		$stat = array("text"=>$filestatus[0], "_1043"=>$count_1043, "_1044"=>$count_1044, "_109"=>$count_109);
		$status[] = $stat;
		//
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1043_comdsecrecdate) = 0 OR _1043_comdsecrecdate IS NULL) and year(_1043_comdsecsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1043 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1044_comdsecrecdate) = 0 OR _1044_comdsecrecdate IS NULL) and year(_1044_comdsecsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1044 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_109_comdsecrecdate) = 0 OR _109_comdsecrecdate IS NULL) and year(_109_comdsecsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_109 = $row['cnt'];
		$stat = array("text"=>$filestatus[1], "_1043"=>$count_1043, "_1044"=>$count_1044, "_109"=>$count_109);
		$status[] = $stat;
		//
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1043_defminrecdate) = 0 OR _1043_defminrecdate IS NULL) and year(_1043_defminsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1043 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_1044_defminrecdate) = 0 OR _1044_defminrecdate IS NULL) and year(_1044_defminsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_1044 = $row['cnt'];
		$query="SELECT COUNT(*) as cnt FROM loss_damage WHERE (year(_109_defminrecdate) = 0 OR _109_defminrecdate IS NULL) and year(_109_defminsenddate) <> 0";
		$result = $db->query($query);
		$row = $result->fetch();
        $count_109 = $row['cnt'];
		$stat = array("text"=>$filestatus[2], "_1043"=>$count_1043, "_1044"=>$count_1044, "_109"=>$count_109);
		$status[] = $stat;
        return $status;
    }	
	public static function statusDetails($i) {
        $db = Database::getDB();
        global $filestatus;
		$status = array();
		
		if ($i == 0) {
		
		$query="SELECT *,_1043_frbrsenddate as sdate FROM loss_damage WHERE (year(_1043_frbrrecdate) = 0 OR _1043_frbrrecdate IS NULL) and year(_1043_frbrsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *,_1043_frbrsenddate as sdate FROM loss_damage WHERE (year(_1044_frbrrecdate) = 0 OR _1044_frbrrecdate IS NULL) and year(_1044_frbrsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *,_1043_frbrsenddate as sdate FROM loss_damage WHERE (year(_109_frbrrecdate) = 0 OR _109_frbrrecdate IS NULL) and year(_109_frbrsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
        return $status;
		
		} elseif ($i == 1) {
				
		$query="SELECT *, _1043_comdsecsenddate as sdate FROM loss_damage WHERE (year(_1043_comdsecrecdate) = 0 OR _1043_comdsecrecdate IS NULL) and year(_1043_comdsecsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *, _1043_comdsecsenddate as sdate FROM loss_damage WHERE (year(_1044_comdsecrecdate) = 0 OR _1044_comdsecrecdate IS NULL) and year(_1044_comdsecsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *, _1043_comdsecsenddate as sdate FROM loss_damage WHERE (year(_109_comdsecrecdate) = 0 OR _109_comdsecrecdate IS NULL) and year(_109_comdsecsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
        return $status;	
		} elseif ($i == 2) {
				
		$query="SELECT *, _1043_defminsenddate as sdate FROM loss_damage WHERE (year(_1043_defminrecdate) = 0 OR _1043_defminrecdate IS NULL) and year(_1043_defminsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *, _1043_defminsenddate as sdate FROM loss_damage WHERE (year(_1044_defminrecdate) = 0 OR _1044_defminrecdate IS NULL) and year(_1044_defminsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
		//
		$query="SELECT *, _1043_defminsenddate as sdate FROM loss_damage WHERE (year(_109_defminrecdate) = 0 OR _109_defminrecdate IS NULL) and year(_109_defminsenddate) <> 0";
		$statement = $db->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$statement->closeCursor();
		$status[] = $result;
        return $status;	
		}
    }
    public static function quick_entry_save($id, $place, $date, $time, $goods, $value, $description, $letter1, $letter1date, $_1043_recdate, $_1043_defminrecdate, $_1043_adviseddate, $_1044_recdate, $_1044_lowsenddate, $_1044_commanderorderdate, $_109_defminrecdate, $removeddate, $removedvalue, $board_letter, $_1043_letter, $_1044_letter, $_109_letter, $remove_list) {
        $db = Database::getDB();
        $query = "UPDATE loss_damage SET place = '$place', date = '$date', time = '$time', goods = '$goods', value = '$value', description = '$description', letter1 = '$letter1', letter1date = '$letter1date', _1043_recdate = '$_1043_recdate', _1043_defminrecdate = '$_1043_defminrecdate', _1043_adviseddate = '$_1043_adviseddate', _1044_recdate = '$_1044_recdate', _1044_lowsenddate = '$_1044_lowsenddate', _1044_commanderorderdate = '$_1044_commanderorderdate', _109_defminrecdate = '$_109_defminrecdate', removeddate = '$removeddate', removedvalue = '$removedvalue', board_letter = '$board_letter', _1043_letter = '$_1043_letter', _1044_letter = '$_1044_letter', _109_letter = '$_109_letter', remove_list = '$remove_list' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }	
}
