<?php

class board_report_observationsDB {

 	public static function addRecord($cyear, $assetunit, $itemtype, $subject, $details) {
        $db = Database::getDB();
        $query = "INSERT INTO board_report_observations (cyear, assetunit, itemtype, subject, details) VALUES ('$cyear', '$assetunit', '$itemtype', '$subject', '$details')";
        $row_count = $db->exec($query);
        return $row_count;
    }
	
     public static function getFullDetails($cyear, $assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report_observations WHERE cyear = '$cyear' and assetunit = '$assetunit' order by cyear";
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
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM board_report_observations WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
    public static function getFullDetails_Itemtype($cyear, $assetunit, $itemtype) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report_observations WHERE cyear = '$cyear' and assetunit = '$assetunit' and itemtype = '$itemtype' order by id";
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