<?php

class errorcodeDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM errorcode order by code';
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
    
    public static function getHasRecord($code) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM errorcode WHERE code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($code, $title, $details) {
        $db = Database::getDB();
        $query = "INSERT INTO errorcode
          (code, title, details)
          VALUES
          ('$code', '$title', '$details')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM errorcode WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }

    public static function deleteRecordByCode($code) {
        $db = Database::getDB();
        $query = "DELETE FROM errorcode WHERE code = '$code'";
        $row_count = $db->exec($query);
		return $row_count;
    }
    public static function getDetailsBycode($code) {
        $db = Database::getDB();
        $query = "select * from errorcode where code ='$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

}
