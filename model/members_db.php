<?php
class MembersDB {
	public static function decative_accunt($level, $password) {       
		$db = Database::getDB();
        $query = "UPDATE members SET deactive = 1 WHERE level =".$level." AND passwd = '".md5($password)."'";
        $count = $db->exec($query);
        $query1 = "UPDATE members SET deactive = 0 WHERE level =".$level." AND passwd != '".md5($password)."'";
        $count1 = $db->exec($query1);		
        return $count+$count1;
	}
		
	public static function active_decative($member_id, $deactive) {       
		$db = Database::getDB();
        $date = date('Y-m-d H:i:s');
		$query = "UPDATE members SET deactive = ".$deactive.", pw_update = '".$date."', fail_attempts = 0 WHERE member_id =".$member_id;
        $count = $db->exec($query);
        return $count;
	}
	public static function updateerror_codes($id, $error_display, $error_codes) {
        $db = Database::getDB();
        $query = "UPDATE members SET error_display = '$error_display', error_codes = '$error_codes' WHERE member_id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getAllDetailsMember($member_id) {
        $db = Database::getDB();
        $query = "SELECT * FROM members where member_id = '$member_id'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
    public static function get_dam_controllers() {
        $db = Database::getDB();
		$query = "SELECT * FROM members where level = '5'";
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
    public static function get_pw_update_days($member_id) {
        $db = Database::getDB();
        $query = "SELECT pw_update FROM members where member_id = '$member_id'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row;
    }
	public static function pw_update() {       
		$db = Database::getDB();
        $date = date('Y-m-d H:i:s');
		$query = "UPDATE members SET pw_update = '".$date."'";
        $count = $db->exec($query);
        return $count;
	}
	public static function fail_attempt_update($num, $login) {       
		$db = Database::getDB();
		 // $query = "UPDATE members SET fail_attempts = fail_attempts + 1 WHERE login ='$login'";
		if ($num == 0) {
				$query = "UPDATE members SET fail_attempts = 0 WHERE login ='$login'";
		} elseif ($num == 1) { 
				$query = "UPDATE members SET fail_attempts = fail_attempts + 1 WHERE login ='$login'";
 		} 
        $count = $db->exec($query);
        return $count;
	}
	public static function get_user_email($place) {
        $db = Database::getDB();
        $query = "SELECT * FROM members where place = '$place'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row['user_email'] ?? "";
    }
	public static function update_user_email($unit, $user_email) {       
		$db = Database::getDB();
		$query = "UPDATE members SET user_email = '$user_email' WHERE place ='$unit'";
        $count = $db->exec($query);
        return $count;
	}
    public static function get_users_unit($place) {
        $db = Database::getDB();
		$query = "SELECT * FROM members where place = '$place'";
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
    public static function get_login($member_id) {
        $db = Database::getDB();
        $query = "SELECT login FROM members where member_id = '$member_id'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        return $row['login'];
    }
	public static function getAllDetailsLevels($level) {
        $db = Database::getDB();
        $query = "SELECT * FROM members LEFT JOIN assetunit ON members.place=assetunit.unitName where level = '$level' order by protocollevel5";
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
    public static function get_users_unit_login($place, $level) {
        $db = Database::getDB();
		$query = "SELECT * FROM members where place = '$place' and level = '$level'";
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

    // public static function addUser($assetscenter, $assetunit, $macaddress, $loginname, $password, $status) {
    //     $db = Database::getDB();
    //     $query = "INSERT INTO logindetails
    //       (assetscenter, assetunit, macaddress, loginname, password, sysDate, result)
    //       VALUES
    //       ('$assetscenter', '$assetunit', '$macaddress', '$loginname', '$password', now(), '$status')";
    //     $count = $db->exec($query);
    //     return $count;
        
    //     try {
    //         $statement = $db->prepare($query);
    //         $statement->execute();
    //         $result = $statement->fetchAll();
    //         $statement->closeCursor();
    //         return $result;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         display_db_error($error_message);
    //     }
    // }
}
?>