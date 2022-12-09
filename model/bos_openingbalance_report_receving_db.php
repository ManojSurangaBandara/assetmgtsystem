<?php

class bos_openingbalance_report_recevingDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM bos_openingbalance_report_receving order by assetunit';
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

    public static function getHasRecord($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM bos_openingbalance_report_receving WHERE assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($assetunit, $received_date, $approved_date) {
        $db = Database::getDB();
        $query = "INSERT INTO bos_openingbalance_report_receving
          (assetunit, received_date, approved_date)
          VALUES
          ('$assetunit', '$received_date', '$approved_date')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($assetunit, $received_date, $approved_date) {
        $db = Database::getDB();
        $query = "UPDATE bos_openingbalance_report_receving SET received_date = '$received_date', approved_date = '$approved_date' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
    }

	public static function deleteRecord($assetunit) {
        $db = Database::getDB();
        $query = "DELETE FROM bos_openingbalance_report_receving WHERE assetunit = '$assetunit'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from bos_openingbalance_report_receving where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsByAssetunit($assetunit) {
        $db = Database::getDB();
        $query = "select * from bos_openingbalance_report_receving where assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
