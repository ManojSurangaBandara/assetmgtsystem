<?php

class unitmembersDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM unitmembers';
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

    public static function addRecord($assetunit, $sno, $post, $number, $rank, $name, $telephone, $email, $fax, $fb, $skype) {
        $db = Database::getDB();
        $query = "INSERT INTO unitmembers
          (unit, sno, post, number, rank, name, telephone, email, fax, fb, skype)
          VALUES
          ('$assetunit', '$sno', '$post', '$number', '$rank', '$name', '$telephone', '$email', '$fax', '$fb', '$skype')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($id, $sno, $post, $number, $rank, $name, $telephone, $email, $fax, $fb, $skype) {
        $db = Database::getDB();
        $query = "UPDATE unitmembers SET `sno` = '$sno', `post` = '$post', `number` = '$number', `rank` = '$rank', `name` = '$name', `telephone` = '$telephone', `email` = '$email', `fax` = '$fax', `fb` = '$fb', `skype` = '$skype' WHERE `id` ='$id'";   
        $count = $db->exec($query);
        return $count;
    }

	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM unitmembers WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }

	public static function getDetailsByUnit($assetunit) {
        $db = Database::getDB();
        $query = "select * from unitmembers where unit ='$assetunit' order by sno";
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
