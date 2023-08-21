<?php

class lost_damage_boardDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM lost_damage_board';
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

    public static function addRecord($fileno, $sno, $number, $rank, $name, $unit, $post) {
        $db = Database::getDB();
        $query = "INSERT INTO lost_damage_board
          (`fileno`, `sno`, `number`, `rank`, `name`, `unit`, `post`)
          VALUES
          ('$fileno', '$sno', '$number', '$rank', '$name', '$unit', '$post')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function updateRecord($id, $sno, $number, $rank, $name, $unit, $post) {
        $db = Database::getDB();
        $query = "UPDATE lost_damage_board SET sno = '$sno', post = '$post', number = '$number', `rank` = '$rank', name = '$name', unit = '$unit' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM lost_damage_board WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }

	public static function getDetailsByFileno($fileno) {
        $db = Database::getDB();
        $query = "select * from lost_damage_board where fileno ='$fileno' order by sno";
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
