<?php

class boardofsurveyDB {

    public static function getFullDetails($survayyear) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey WHERE year = '$survayyear' order by protocolOrder";
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
    public static function save_ver($id, $ver_brd_app, $ver_brd_rec, $ver_brd_rej1, $ver_brd_rej_rec1, $ver_brd_rej2, $ver_brd_rej_rec2, $ver_brd_rej3, $ver_brd_rej_rec3, $ver_brd_approved){
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey SET ver_brd_app = '$ver_brd_app', ver_brd_rec = '$ver_brd_rec', ver_brd_rej1 = '$ver_brd_rej1', ver_brd_rej_rec1 = '$ver_brd_rej_rec1', ver_brd_rej2 = '$ver_brd_rej2', ver_brd_rej_rec2 = '$ver_brd_rej_rec2', ver_brd_rej3 = '$ver_brd_rej3', ver_brd_rej_rec3 = '$ver_brd_rej_rec3', ver_brd_approved = '$ver_brd_approved' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function update_units($survayyear) {
        $db = Database::getDB();
		$db1 = Database::getDB();
        $query = 'SELECT * FROM assetunit  order by sorder';
        $result = $db->query($query);
        $units = 0;
        foreach ($result as $row) {
            $assetscenter = $row['centreName'];
			$assetunit = $row['unitName'];
			$protocolOrder = $row['protocollevel5'];
			$query1 = "SELECT count(*) as total from boardofsurvey WHERE year = '$survayyear' and assetunit = '$assetunit'";
			$result1 = $db->query($query1);
			$row1 = $result1->fetch();
			$count = $row1['total'];
			//echo $count;
			if ($count == 0){
					$query2 = "INSERT INTO boardofsurvey (year, assetscenter, assetunit, protocolOrder) VALUES ('$survayyear', '$assetscenter', '$assetunit', '$protocolOrder')";
					$row_count = $db->exec($query2);
					$units = $units + $row_count;
			}
        }
        return $units;
    }
    public static function save_con($id, $con_brd_app, $con_brd_rec, $con_brd_rej1, $con_brd_rej_rec1, $con_brd_rej2, $con_brd_rej_rec2, $con_brd_rej3, $con_brd_rej_rec3, $con_brd_approved){
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey SET con_brd_app = '$con_brd_app', con_brd_rec = '$con_brd_rec', con_brd_rej1 = '$con_brd_rej1', con_brd_rej_rec1 = '$con_brd_rej_rec1', con_brd_rej2 = '$con_brd_rej2', con_brd_rej_rec2 = '$con_brd_rej_rec2', con_brd_rej3 = '$con_brd_rej3', con_brd_rej_rec3 = '$con_brd_rej_rec3', con_brd_approved = '$con_brd_approved' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function save_des($id, $des_brd_app, $des_brd_rec){
        $db = Database::getDB();
        $query = "UPDATE boardofsurvey SET des_brd_app = '$des_brd_app', des_brd_rec = '$des_brd_rec' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function queryDetails($query, $survayyear) {
        $db = Database::getDB();
        $query = "SELECT * FROM boardofsurvey WHERE".$query." year = '$survayyear' order by protocolOrder";
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
