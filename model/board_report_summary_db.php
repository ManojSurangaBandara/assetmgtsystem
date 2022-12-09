<?php

class board_report_summaryDB {
	public static function add_Board_report($assetunit, $currentYear, $itemtype, $catalogueno, $quantity, $totalcost, $ids_array, $dis_quantity, $dis_totalcost, $dis_ids_array, $new_quantity, $new_totalcost, $new_ids_array) {
        $db = Database::getDB();
        $query = "DELETE FROM board_report_summary WHERE cyear = '$currentYear' and assetunit = '$assetunit' and itemtype = '$itemtype' and catalogueno = '$catalogueno'";
        $row_count = $db->exec($query);
		$query = "INSERT INTO board_report_summary (cyear, assetunit, itemtype, catalogueno, quantity, totalcost, ids_array, dis_quantity, dis_totalcost, dis_ids_array, new_quantity, new_totalcost, new_ids_array) VALUES ('$currentYear', '$assetunit', '$itemtype', '$catalogueno', '$quantity', '$totalcost', '$ids_array', '$dis_quantity', '$dis_totalcost', '$dis_ids_array', '$new_quantity', '$new_totalcost', '$new_ids_array')";
        $row_count = $db->exec($query);
        return $row_count;
    }
     public static function getFullDetails($cyear, $assetunit, $itemtype) {
        $db = Database::getDB();
        $query = "SELECT board_report_summary.*, classificationlist.mainCategory as mainCategory, classificationlist.itemCategory as itemCategory, classificationlist.itemDescription as itemDescription, classificationlist.assetsno as assetsno FROM board_report_summary 
		LEFT JOIN classificationlist ON 
		board_report_summary.catalogueno = classificationlist.catalogueno WHERE cyear = '$cyear' and assetunit = '$assetunit' and itemtype = '$itemtype' order by catalogueno";
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
	
     public static function getFullDetails_ignoreItem($cyear, $assetunit) {
        $db = Database::getDB();
        $query = "SELECT board_report_summary.*, classificationlist.mainCategory as mainCategory, classificationlist.itemCategory as itemCategory, classificationlist.itemDescription as itemDescription, classificationlist.assetsno as assetsno FROM board_report_summary 
		LEFT JOIN classificationlist ON 
		board_report_summary.catalogueno = classificationlist.catalogueno WHERE cyear = '$cyear' and assetunit = '$assetunit' order by catalogueno";
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
	
    public static function getOpeningBalance($cyear, $assetunit, $itemtype, $catalogueno) {
        $db = Database::getDB();
        $query = "select quantity, totalcost from board_report_summary where cyear = '$cyear' and assetunit = '$assetunit' and itemtype = '$itemtype' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
 	public static function deleteRecords($id, $asset) {
        $db = Database::getDB();
        $query = "SELECT cyear, assetunit FROM board_report WHERE $id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
		$cyear = $row['cyear'];
		$assetunit = $row['assetunit'];
		$query = "DELETE FROM board_report_summary WHERE cyear = '$cyear' and assetunit = '$assetunit' and itemtype = '$asset'";
        $row_count = $db->exec($query);
		return $row_count;
    }
 	public static function deleteRecordsUnitYear($asset, $assetunit, $currentYear) {
        $db = Database::getDB();
		$query = "DELETE FROM board_report_summary WHERE cyear = '$currentYear' and assetunit = '$assetunit' and itemtype = '$asset'";
        $row_count = $db->exec($query);
		return $row_count;
    }
 /* 	public static function addRecord($cyear, $assetunit, $itemtype, $subject, $details) {
        $db = Database::getDB();
        $query = "INSERT INTO board_report_summary (cyear, assetunit, itemtype, subject, details) VALUES ('$cyear', '$assetunit', '$itemtype', '$subject', '$details')";
        $row_count = $db->exec($query);
        return $row_count;
    }
	

	public static function deleteRecordByid($id) {
        $db = Database::getDB();
        $query = "DELETE FROM board_report_summary WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
    public static function getFullDetails_Itemtype($cyear, $assetunit, $itemtype) {
        $db = Database::getDB();
        $query = "SELECT * FROM board_report_summary WHERE cyear = '$cyear' and assetunit = '$assetunit' and itemtype = '$itemtype' order by id";
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
    } */
}

?>