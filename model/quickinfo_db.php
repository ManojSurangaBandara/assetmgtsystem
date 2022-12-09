<?php

class QuickInfoDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM quickinfo';
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

	    public static function getActivatedDetails() {
        $db = Database::getDB();
        $query = "SELECT * FROM quickinfo where activate = 1";
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
	
    public static function getHasRecord($instName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM quickinfo WHERE instName = '$instName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($title, $details, $activate) {
        $db = Database::getDB();
        $query = "INSERT INTO quickinfo (title, details, activate) VALUES ('$title', '$details', '$activate')";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function addComments($id, $comment, $assetunit) {
        $db = Database::getDB();
        $query = "INSERT INTO quickinfocomments (id, comment, unit, sysdate) VALUES ('$id', '$comment', '$assetunit', now())";
        $row_count = $db->exec($query);
        return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from quickinfo where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

		public static function getCommentsById($id) {
        $db = Database::getDB();
        $query = "select * from quickinfocomments where id = '$id'";
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
	
	public static function updateRecord($title, $details, $activate, $id) {
        $db = Database::getDB();
        $query = "UPDATE quickinfo SET title = '$title', details = '$details', activate = '$activate' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

	public static function deleteComments($sqno) {
        $db = Database::getDB();
        $query = "DELETE FROM quickinfocomments where sqno = '$sqno'";
        $count = $db->exec($query);
		return $count;
    }

}
