<?php

class brandDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM brand order by brand';
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

    public static function getHasRecord($brand) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM brand WHERE brand = '$brand'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($brand) {
        $db = Database::getDB();
        $query = "INSERT INTO brand
          (brand)
          VALUES
          ('$brand')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function deleteRecord($brand) {
        $db = Database::getDB();
        $query = "DELETE FROM brand WHERE brand = '$brand'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from brand where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode($code) {
        $db = Database::getDB();
        $query = "select * from brand where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
