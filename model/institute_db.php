<?php

class InstituteDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM institute order by instName';
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

    public static function getHasRecord($instName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM institute WHERE instName = '$instName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($instName, $instAddress, $instTele, $instEmail) {
        $db = Database::getDB();
        $query = "INSERT INTO institute
          (instName, instAddress, instTele, instEmail)
          VALUES
          ('$instName', '$instAddress', '$instTele', '$instEmail')";
        $row_count = $db->exec($query);
        return $row_count;
    }
	
	public static function deleteRecordById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM institute WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
}
