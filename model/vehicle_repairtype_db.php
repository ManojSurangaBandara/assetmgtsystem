<?php

class vehicle_repairtypeDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicle_repairtype order by details';
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

    public static function getHasRecord($vehicle_repairtype) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM vehicle_repairtype WHERE details = '$vehicle_repairtype'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($vehicle_repairtype) {
        $db = Database::getDB();
        $query = "INSERT INTO vehicle_repairtype
          (details)
          VALUES
          ('$vehicle_repairtype')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function deleteRecord($vehicle_repairtype) {
        $db = Database::getDB();
        $query = "DELETE FROM vehicle_repairtype WHERE details = '$vehicle_repairtype'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from vehicle_repairtype where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode($vehicle_repairtype) {
        $db = Database::getDB();
        $query = "select * from vehicle_repairtype where vehicle_repairtype = '$vehicle_repairtype'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
