<?php

class vehicle_repair_detailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicle_repair_details order by r_date';
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

    public static function getHasRecord($vehicle_id, $r_date, $r_type, $r_amount) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM vehicle_repair_details WHERE vehicle_id = '$vehicle_id' and r_date = '$r_date' and r_type = '$r_type' and r_amount = '$r_amount'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($vehicle_id, $armyno, $identificationno, $r_date, $r_type, $r_desc, $r_amount) {
        $db = Database::getDB();
        $query = "INSERT INTO vehicle_repair_details
          (vehicle_id, armyno, identificationno, r_date, r_type, r_desc, r_amount)
          VALUES
          ('$vehicle_id', '$armyno', '$identificationno', '$r_date', '$r_type', '$r_desc', '$r_amount')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function deleteRecord($id) {
        $db = Database::getDB();
        $query = "DELETE FROM vehicle_repair_details WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from vehicle_repair_details where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsByarmyno($armyno) {
        $db = Database::getDB();
        $query = "select * from vehicle_repair_details where armyno = '$armyno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
