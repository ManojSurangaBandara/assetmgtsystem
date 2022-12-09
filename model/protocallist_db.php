<?php

class protocallistDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM protocallist';
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
	public static function getDetailsByUnit($assetunit) {
        $db = Database::getDB();
        $query = "select * from protocallist where t3 = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
}
