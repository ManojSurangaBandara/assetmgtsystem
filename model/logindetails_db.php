<?php

class LoginDB {

    public static function getLogin() {
        $db = Database::getDB();
        $query = "select * from logindetails";
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
	
    public static function getInqDetails($assetscenter, $assetunit, $loginname, $inputField1, $inputField2) {
        $db = Database::getDB();
		$msg = "";
		$msg = ($assetscenter != '') ? $msg. " assetscenter = '$assetscenter'" : $msg;
		if ($msg != "") {
		$msg = ($assetunit != '') ? $msg. " and assetunit = '$assetunit'" : $msg;
		} else {
		$msg = ($assetunit != '') ? $msg. " assetunit = '$assetunit'" : $msg;}
		if ($msg != "") {
		$msg = ($loginname != '') ? $msg. " and loginname = '$loginname'" : $msg;
		} else {
		$msg = ($loginname != '') ? $msg. " loginname = '$loginname'" : $msg;
		}
		if ($msg != "") {
		$msg = ($inputField1 != '') ? $msg. " and (sysDate BETWEEN '$inputField1' AND '$inputField2')" : $msg;
        } else {
		$msg = ($inputField1 != '') ? $msg. " (sysDate BETWEEN '$inputField1' AND '$inputField2')" : $msg;
		}
		$msg = ($msg == "") ? "select * from logindetails" : "select * from logindetails where " .$msg;
		$query = $msg;
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
    public static function addLogin($assetscenter, $assetunit, $macaddress, $loginname, $password, $status) {
        $db = Database::getDB();
        $query = "INSERT INTO logindetails
          (assetscenter, assetunit, macaddress, loginname, password, sysDate, result)
          VALUES
          ('$assetscenter', '$assetunit', '$macaddress', '$loginname', '$password', now(), '$status')";
        $count = $db->exec($query);
        return $count;
    }
    public static function getInqDetails_user($loginname, $inputField1, $inputField2) {
        $db = Database::getDB();
		$msg = "";
		$msg = " loginname = '$loginname'";
		if ($inputField1 != '' && $inputField2 != '') {
			$msg = $msg. " and (sysDate BETWEEN '$inputField1' AND '$inputField2')";
        } 
		$query = "select * from logindetails where" .$msg. "order by sysDate desc";
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
	public static function last_log_date($assetunit) {
        $db = Database::getDB();
        $query = "SELECT loginname, max(sysDate) as sysDate FROM logindetails WHERE assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
