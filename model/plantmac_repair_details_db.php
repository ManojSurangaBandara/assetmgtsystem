<?php

class plantmac_repair_detailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmac_repair_details order by r_date';
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

    public static function getHasRecord($item_id, $r_date, $r_desc, $r_amount) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM plantmac_repair_details WHERE item_id = '$item_id' and r_date = '$r_date' and r_desc = '$r_desc' and r_amount = '$r_amount'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($item_id, $identificationno, $r_date, $r_desc, $r_amount) {
        $db = Database::getDB();
        $query = "INSERT INTO plantmac_repair_details
          (item_id, identificationno, r_date, r_desc, r_amount)
          VALUES
          ('$item_id', '$identificationno', '$r_date', '$r_desc', '$r_amount')";
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
        $query = "DELETE FROM plantmac_repair_details WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from plantmac_repair_details where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	
	public static function getDetails_itemid($item_id) {
        $db = Database::getDB();
	    $querytext = " item_id = '$item_id'";
		$query = "SELECT * FROM plantmac_repair_details WHERE".$querytext;
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
    public static function getTotal_itemid($item_id) {
        $db = Database::getDB();
        $query = "SELECT sum(r_amount) as tot FROM plantmac_repair_details WHERE item_id = '$item_id'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
}
