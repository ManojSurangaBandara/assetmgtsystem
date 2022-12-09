<?php
class present_locationDB {
    public static function getFullDetails() {
        $db = Database::getDB();
		$query = "SELECT * FROM present_location order by present_location_code";
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
     //   return $result;
    }
	public static function getDetailsByUnit($assetunit) {
        $db = Database::getDB();
        $query = "select * from present_location where assetunit = '$assetunit'";
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
   public static function addRecord($assetunit, $locations) {
        $db = Database::getDB();
        $query = "INSERT INTO present_location (assetunit, locations) VALUES ('$assetunit', '$locations')";
        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>