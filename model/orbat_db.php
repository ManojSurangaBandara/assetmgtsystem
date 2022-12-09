<?php

class orbatDB {

    public static function getFullDetails_sf() {
        $db = Database::getDB();
        $query = 'SELECT * FROM orbat_sf order by level';
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

    public static function getHasRecord_sf($code) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM orbat_sf WHERE code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord_sf($code, $level) {
        $db = Database::getDB();
        $query = "INSERT INTO orbat_sf
          (code, level)
          VALUES
          ('$code', '$level')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function deleteRecord_sf($code) {
        $db = Database::getDB();
        $query = "DELETE FROM orbat_sf WHERE code = '$code'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById_sf($id) {
        $db = Database::getDB();
        $query = "select * from orbat_sf where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode_sf($code) {
        $db = Database::getDB();
        $query = "select * from orbat_sf where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
