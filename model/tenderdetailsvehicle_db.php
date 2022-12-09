<?php

class TenderdetailvehicleDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM tenderdetailsvehicle';
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

    public static function getDetailsbyTenderno($tenderno) {
        $db = Database::getDB();
        $query = "SELECT * FROM tenderdetailsvehicle where tenderno = '$tenderno'";
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
        $query = "select * from tenderdetailsvehicle where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
//	public static function getDetailsByTenderno($tenderno) {
//        $db = Database::getDB();
//        $query = "select * from tenderdetailsvehicle where tenderno = '$tenderno'";
//        $result = $db->query($query);
//        $row = $result->fetch();
//        return $row;
//    }
	
    public static function getHasRecord($tenderno, $lotno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM tenderdetailsvehicle WHERE tenderno = '$tenderno' and lotno = '$lotno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($year, $tplace, $type, $tenderno, $lotno, $armyno, $mainCategory, $itemCategory, $itemDescription, $make, $modle, $assetsno, $newAssestno, $catalogueno, $engineno, $chessisno, $yearManufacture, $buyernicno, $buyername, $buyeraddress, $estimatevalue, $tendervalue, $remarks) {
        $db = Database::getDB();
        $query = "INSERT INTO tenderdetailsvehicle
          (year, place, type, tenderno, lotno, armyno, mainCategory, itemCategory, itemDescription, make, modle, assetsno, newAssestno, catalogueno, engineno, chessisno, yearManufacture, buyernicno, buyername, buyeraddress, estimatevalue, tendervalue, remarks)
          VALUES
          ('$year', '$tplace', '$type', '$tenderno', '$lotno', '$armyno', '$mainCategory', '$itemCategory', '$itemDescription', '$make', '$modle', '$assetsno', '$newAssestno', '$catalogueno', '$engineno', '$chessisno', '$yearManufacture', '$buyernicno', '$buyername', '$buyeraddress', '$estimatevalue', '$tendervalue', '$remarks')";
		$row_count = $db->exec($query);
        return $row_count;
    }

	    public static function addRecord2($year, $tplace, $type, $tenderno, $lotno, $mainCategory, $itemCategory, $itemDescription, $assetsno, $newAssestno, $catalogueno, $buyernicno, $buyername, $buyeraddress, $estimatevalue, $tendervalue, $remarks) {
        $db = Database::getDB();
        $query = "INSERT INTO tenderdetailsvehicle
          (year, place, type, tenderno, lotno, mainCategory, itemCategory, itemDescription, assetsno, newAssestno, catalogueno, buyernicno, buyername, buyeraddress, estimatevalue, tendervalue, remarks)
          VALUES
          ('$year', '$tplace', '$type', '$tenderno', '$lotno', '$mainCategory', '$itemCategory', '$itemDescription', '$assetsno', '$newAssestno', '$catalogueno', '$buyernicno', '$buyername', '$buyeraddress', '$estimatevalue', '$tendervalue', '$remarks')";
		$row_count = $db->exec($query);
        return $row_count;
    }
	
	public static function deleteRecordById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM tenderdetailsvehicle WHERE id = '$id'";
        $db->exec($query);
    }
	
}
