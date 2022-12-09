<?php

class loss_damage_detailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = "SELECT * FROM loss_damage_details order by fileno";
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
        $query = "SELECT count(1) as tot FROM loss_damage_details WHERE fileno = '$fileno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addRecord($fileno, $classification, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $assetsno, $newAssestno, $eqptSriNo, $identificationno, $value) {
        $db = Database::getDB();
        $query = "INSERT INTO loss_damage_details
          (fileno, classification, mainCategory, itemCategory, itemDescription, catalogueno, assetsno, newAssestno, eqptSriNo, identificationno, value)
          VALUES
          ('$fileno', '$classification', '$mainCategory', '$itemCategory', '$itemDescription', '$catalogueno', '$assetsno', '$newAssestno', '$eqptSriNo', '$identificationno', '$value')";
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
        $query = "select * from loss_damage_details where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM loss_damage_details WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
   public static function get_file_table($fileno) {
        $db = Database::getDB();
        $query = "SELECT * FROM loss_damage_details WHERE fileno = '$fileno' order by id";
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
