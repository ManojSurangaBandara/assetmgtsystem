<?php

class placesDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM places';
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
        $query = "SELECT count(1) as tot FROM places WHERE code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($code, $name_english, $name_sinhala, $name_tamil) {
        $db = Database::getDB();
        $query = "INSERT INTO places
          (code, name_english, name_sinhala, name_tamil)
          VALUES
          ('$code', '$name_english', '$name_sinhala', '$name_tamil')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($code, $name) {
        $db = Database::getDB();
        $query = "UPDATE places SET name = '$name' WHERE code = '$code'";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM places WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from places where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode($code) {
        $db = Database::getDB();
        $query = "select * from places where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getplacesname($code) {
        $db = Database::getDB();
        $query = "select name from places where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getName() {
        $db = Database::getDB();
        $query = 'SELECT name FROM places';
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
