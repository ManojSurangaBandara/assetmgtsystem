<?php

class TenderdetailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM tenderdetails';
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

    public static function getNotFinishedDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM tenderdetails where finished = 0';
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
        $query = "select * from tenderdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsByTenderno($tenderno) {
        $db = Database::getDB();
        $query = "select * from tenderdetails where tenderno = '$tenderno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }	
    public static function getHasRecord($tenderno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM tenderdetails WHERE tenderno = '$tenderno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($year, $place, $type, $tenderno, $chairmanno, $chairmanname, $member1no, $member1name, $member2no, $member2name, $member3no, $member3name, $member4no, $member4name, $remarks) {
        $db = Database::getDB();
        $query = "INSERT INTO tenderdetails
          (year, place, type, tenderno, chairmanno, chairmanname, member1no, member1name, member2no, member2name, member3no, member3name, member4no, member4name, remarks)
          VALUES
          ('$year', '$place', '$type', '$tenderno', '$chairmanno', '$chairmanname', '$member1no', '$member1name', '$member2no', '$member2name', '$member3no', '$member3name', '$member4no', '$member4name', '$remarks')";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function updateRecord($year, $place, $type, $tenderno, $chairmanno, $chairmanname, $member1no, $member1name, $member2no, $member2name, $member3no, $member3name, $member4no, $member4name, $remarks) {
        $db = Database::getDB();
		//$query = "UPDATE tenderdetails SET place='$place' WHERE tenderno = '$tenderno'";
		$query = "UPDATE tenderdetails SET place='$place', type='$type', chairmanno='$chairmanno', chairmanname='$chairmanname', member1no='$member1no', member2no='$member2no', member3no='$member3no', member4no='$member4no', remarks='$remarks' WHERE tenderno = '$tenderno'";
        $row_count = $db->exec($query);
        return $row_count;
    }
	
	public static function deleteRecordById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM tenderdetails WHERE id = '$id'";
        $db->exec($query);
    }
	
}
