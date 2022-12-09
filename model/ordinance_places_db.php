<?php

class ordinancePlacesDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM ordinance_places order by code';
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
        $query = "SELECT count(1) as tot FROM ordinance_places WHERE code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($code, $name_english, $name_sinhala, $name_tamil, $address) {
        $db = Database::getDB();
        $query = "INSERT INTO ordinance_places
          (code, name_english, name_sinhala, name_tamil, address)
          VALUES
          ('$code', '$name_english', '$name_sinhala', '$name_tamil', '$address')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($code, $name_english, $name_sinhala, $name_tamil, $address) {
        $db = Database::getDB();
        $query = "UPDATE ordinance_places SET name_english = '$name_english', name_sinhala = '$name_sinhala', name_tamil = '$name_tamil', address = '$address' WHERE code = '$code'";
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
        $query = "DELETE FROM ordinance_places WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }

	public static function deleteRecordBycode($code) {
        $db = Database::getDB();
        $query = "DELETE FROM ordinance_places WHERE code = '$code'";
        $row_count = $db->exec($query);
		return $row_count;
    }	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from ordinance_places where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode($code) {
        $db = Database::getDB();
        $query = "select * from ordinance_places where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getordinance_placesname($code) {
        $db = Database::getDB();
        $query = "select name from ordinance_places where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getName() {
        $db = Database::getDB();
        $query = 'SELECT name FROM ordinance_places';
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
