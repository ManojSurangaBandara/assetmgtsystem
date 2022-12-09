<?php

class modelDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM model';
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

    public static function getHasRecord($brand, $model) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM model WHERE model = '$model' and brand = '$brand'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($brand, $model, $details) {
        $db = Database::getDB();
        $query = "INSERT INTO model
          (brand, model, details)
          VALUES
          ('$brand', '$model', '$details')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($brand, $model, $details) {
        $db = Database::getDB();
        $query = "UPDATE model SET brand = '$brand', details = '$details' WHERE model = '$model'";
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
        $query = "DELETE FROM model WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsbrand($brand) {
        $db = Database::getDB();
        $query = "select * from model where brand = '$brand' order by model";
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
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from model where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
