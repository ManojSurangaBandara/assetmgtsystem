<?php

class loss_damage_chargeDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = "SELECT * FROM lost_damage_charge order by fileno";
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
	public static function getHasRecord($fileno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM lost_damage_charge WHERE fileno = '$fileno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addRecord($fileno, $number, $rank, $name, $unit, $value) {
        $db = Database::getDB();
        $query = "INSERT INTO lost_damage_charge
          (fileno, number, rank, name, unit, value)
          VALUES
          ('$fileno', '$number', '$rank', '$name', '$unit', '$value')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from lost_damage_charge where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM lost_damage_charge WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
   public static function get_file_table($fileno) {
        $db = Database::getDB();
        $query = "SELECT * FROM lost_damage_charge WHERE fileno = '$fileno' order by id";
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
