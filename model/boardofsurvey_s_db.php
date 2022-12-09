<?php

class boardofsurveyscheduleDB {

    public static function getFullDetails($survayyear) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey_sch where year = '$survayyear'";
        try {
			$statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function getHasRecord($year) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM boardofsurvey_sch WHERE year = '$year'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($year, $ver_brd_app, $ver_brd_rec, $ver_brd_approved, $con_brd_app, $con_brd_rec, $con_brd_approved, $des_brd_app, $des_brd_rec) {
        $db = Database::getDB();
        $query = "INSERT INTO boardofsurvey_sch
          (year, ver_brd_app, ver_brd_rec, ver_brd_approved, con_brd_app, con_brd_rec, con_brd_approved, des_brd_app, des_brd_rec)
          VALUES
          ('$year', '$ver_brd_app', '$ver_brd_rec', '$ver_brd_approved', '$con_brd_app', '$con_brd_rec', '$con_brd_approved', '$des_brd_app', '$des_brd_rec')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($year, $ver_brd_app, $ver_brd_rec, $ver_brd_approved, $con_brd_app, $con_brd_rec, $con_brd_approved, $des_brd_app, $des_brd_rec) {
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey_sch SET ver_brd_app = '$ver_brd_app', ver_brd_rec = '$ver_brd_rec', ver_brd_approved = '$ver_brd_approved',con_brd_app = '$con_brd_app', con_brd_rec = '$con_brd_rec', con_brd_approved = '$con_brd_approved', des_brd_app = '$des_brd_app', des_brd_rec = '$des_brd_rec' WHERE year = '$year'";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	
	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM boardofsurvey_sch WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from boardofsurvey_sch where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsBycode($code) {
        $db = Database::getDB();
        $query = "select * from boardofsurvey_sch where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getboardofsurvey_schname($code) {
        $db = Database::getDB();
        $query = "select name from boardofsurvey_sch where code = '$code'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getName() {
        $db = Database::getDB();
        $query = 'SELECT name FROM boardofsurvey_sch';
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
