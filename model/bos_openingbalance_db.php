<?php
class bos_openingbalanceDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM bos_openingbalance order by itemcode';
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
	
	    public static function getHasRecord($assetunit, $itemcode) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM bos_openingbalance
                  WHERE assetunit = '$assetunit' and itemcode = '$itemcode'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

	public static function addRecord($assetscenter, $assetunit, $itemtype, $qstore, $votename, $itemcode, $description, $ledger_folio, $qty_onhand, $qty_q1, $qty_q2, $qty_q3, $qty_q4, $qty_q5, $qty_ledger) {
        $db = Database::getDB();
        $query = "INSERT INTO bos_openingbalance (assetscenter, assetunit, itemtype, qstore, votename, itemcode, description, ledger_folio, qty_onhand, qty_q1, qty_q2, qty_q3, qty_q4, qty_q5, qty_ledger) VALUES ('$assetscenter', '$assetunit', '$itemtype', '$qstore', '$votename', '$itemcode', '$description', '$ledger_folio', '$qty_onhand', '$qty_q1', '$qty_q2', '$qty_q3', '$qty_q4', '$qty_q5', '$qty_ledger')";
        $row_count = $db->exec($query);
        return $row_count;
    }
        public static function updateRecord($assetunit, $itemcode, $ledger_folio, $qty_onhand, $qty_q1, $qty_q2, $qty_q3, $qty_q4, $qty_q5, $qty_ledger) {
        $db = Database::getDB();
        $query = "UPDATE bos_openingbalance SET ledger_folio = '$ledger_folio', qty_onhand = '$qty_onhand', qty_q1 = '$qty_q1', qty_q2 = '$qty_q2', qty_q3 = '$qty_q3', qty_q4 = '$qty_q4', qty_q5 = '$qty_q5', qty_ledger = '$qty_ledger' WHERE assetunit ='$assetunit' and itemcode ='$itemcode'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getDescriptionList_unit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM bos_openingbalance WHERE assetunit = '$assetunit' order by itemcode";
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
	public static function save_current_asset($id, $current_asset) {
        $db = Database::getDB();
        $query = "UPDATE bos_openingbalance SET current_asset = '$current_asset' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function summary_list_catlogue() {
		$db = Database::getDB();		
		$query = "SELECT itemcode, description, sum(qty_onhand) as qty_onhand, sum(qty_q1) as qty_q1, sum(qty_q2) as qty_q2, sum(qty_q3) as qty_q3, sum(qty_q4) as qty_q4, sum(qty_q5) as qty_q5, sum(qty_ledger) as qty_ledger FROM bos_openingbalance group by itemcode order by itemcode";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
	}
	public static function summary_list_catlogue_unit($itemcode) {
		$db = Database::getDB();		
		$query = "SELECT assetunit, itemcode, description, sum(qty_onhand) as qty_onhand, sum(qty_q1) as qty_q1, sum(qty_q2) as qty_q2, sum(qty_q3) as qty_q3, sum(qty_q4) as qty_q4, sum(qty_q5) as qty_q5, sum(qty_ledger) as qty_ledger FROM bos_openingbalance WHERE itemcode ='$itemcode' group by assetunit order by assetunit";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
	}
	public static function count_Records_unit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM bos_openingbalance WHERE assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function yearend_report_add_summary() {
        $db = Database::getDB();
        $query = "SELECT a.*, COUNT(*) as cnt FROM bos_openingbalance a LEFT JOIN assetunit b
            ON  a.assetunit = b.unitName GROUP BY a.assetunit order by b.protocollevel5";
    /*     $query = "SELECT bos_openingbalance.*, COUNT(bos_openingbalance.*) as cnt FROM bos_openingbalance LEFT JOIN assetunit 
            ON  bos_openingbalance.assetunit = assetunit.unitName GROUP BY bos_openingbalance.assetunit order by assetunit.protocollevel5";  */
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
    public static function delete_opening_balance($id) {
        $db = Database::getDB();
        $query = "DELETE FROM bos_openingbalance WHERE id = '$id'";
        $row_count = $db->exec($query);
        return $row_count;
    }	
}
