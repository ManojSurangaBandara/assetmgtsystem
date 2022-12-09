<?php

class change_unit_name_historyDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM change_unit_name_history';
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

    public static function getHasRecord($unit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM change_unit_name_history WHERE unit = '$unit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($from_unit, $to_unit) {
        $db = Database::getDB();
        $query = "INSERT INTO change_unit_name_history
          (from_unit, to_unit, change_date)
          VALUES
          ('$from_unit', '$to_unit', now())";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }	
}
