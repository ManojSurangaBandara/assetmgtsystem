<?php

class user_account_change_historyDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM user_account_change_history';
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

    public static function getHasRecord($login, $passwd) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM user_account_change_history WHERE login = '$login' and passwd='".md5($passwd)."'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($assetunit, $login, $operation, $passwd, $user) {
        $db = Database::getDB();
        $query = "INSERT INTO user_account_change_history
          (assetunit, login, odate, operation, passwd, user)
          VALUES
          ('$assetunit', '$login', now(), '$operation', '$passwd', '$user')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
   public static function get_unit_details($assetunit, $login) {
        $db = Database::getDB();
        if ($login == "") {
			$query = "SELECT * FROM user_account_change_history WHERE assetunit = '$assetunit' order by odate desc";
        } else {
			$query = "SELECT * FROM user_account_change_history WHERE assetunit = '$assetunit' and login = '$login' order by odate desc";
		}
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
