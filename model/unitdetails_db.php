<?php

class unitdetailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM unitdetails';
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
        $query = "SELECT count(1) as tot FROM unitdetails WHERE unit = '$unit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($unit, $address, $telephone, $email, $fax, $fb, $coX, $coY) {
        $db = Database::getDB();
        $query = "INSERT INTO unitdetails
          (unit, address, telephone, email, fax, fb, coX, coY)
          VALUES
          ('$unit', '$address', '$telephone', '$email', '$fax', '$fb', '$coX', '$coY')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

        public static function updateRecord($unit, $address, $telephone, $email, $fax, $fb, $coX, $coY) {
        $db = Database::getDB();
        $query = "UPDATE unitdetails SET address = '$address', telephone = '$telephone', email = '$email', fax = '$fax', fb = '$fb', coX = '$coX', coY = '$coY' WHERE unit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
    
	public static function deleteRecordByUnit($unit) {
        $db = Database::getDB();
        $query = "DELETE FROM unitdetails WHERE unit = '$unit'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsbrand($brand) {
        $db = Database::getDB();
        $query = "select * from unitdetails where brand = '$brand' order by unitdetails";
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
        $query = "select * from unitdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsByUnit($assetunit) {
        $db = Database::getDB();
        $query = "select * from unitdetails where unit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function updateEmailRecord($unit, $email) {
        $db = Database::getDB();
        $query = "UPDATE unitdetails SET email = '$email' WHERE unit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
    public static function addEmailRecord($unit, $email) {
        $db = Database::getDB();
        $query = "INSERT INTO unitdetails
          (unit, email)
          VALUES
          ('$unit', '$email')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function updateUnitErrorRecord($unit, $errordisplay, $errortitle, $errordetails) {
        $db = Database::getDB();
        $query = "UPDATE unitdetails SET errordisplay = '$errordisplay', errortitle = '$errortitle', errordetails = '$errordetails' WHERE unit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
    public static function addUnitErrorRecord($unit, $errordisplay, $errortitle, $errordetails) {
        $db = Database::getDB();
        $query = "INSERT INTO unitdetails
          (unit, errordisplay, errortitle, errordetails)
          VALUES
          ('$unit', '$errordisplay', '$errortitle', '$errordetails')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	 public static function upload_crest($unit, $target_file) {
        $db = Database::getDB();
        $query = "UPDATE unitdetails SET crest = '$target_file' WHERE unit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getCrestByUnit($assetunit) {
        $db = Database::getDB();
        $query = "select crest from unitdetails where unit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['crest'] ?? "";
    }
	public static function get_email($assetunit) {
        $db = Database::getDB();
        $query = "select email from unitdetails where unit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['email'];
    }	
}
