<?php
class dos_materialmasterDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM dos_materialmaster order by itemcode';
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
        $query = "UPDATE dos_materialmaster SET current_asset = '$current_asset' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getCurrentDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM dos_materialmaster WHERE current_asset = 0 order by itemcode';
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
	public static function save_asset_sinhala_name($id, $s_description, $sub_category, $main_category) {
        $db = Database::getDB();
        $query = "UPDATE dos_materialmaster SET s_description = '$s_description', sub_category = '$sub_category', main_category = '$main_category' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getUniqueitemtype() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT itemtype FROM dos_materialmaster order by itemtype';
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
    public static function getUniqueqstore() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT qstore FROM dos_materialmaster order by qstore';
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
    public static function getUniquevotehead() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT votehead FROM dos_materialmaster order by votehead';
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
    public static function getUniquevotename() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT votename FROM dos_materialmaster order by votename';
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
    public static function getUniquedescription() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT description FROM dos_materialmaster order by description';
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
    public static function getDescriptionList($itemtype, $qstore, $description) {
        $db = Database::getDB();
        $querytext = " id != 0";
		if 	($itemtype) {$querytext = $querytext." and  itemtype = '$itemtype'"; }
		if 	($qstore) {$querytext = $querytext." and  qstore = '$qstore'"; }
		if 	($description) {$querytext = $querytext." and  description LIKE '%$description%'"; }
		$query = "SELECT * FROM dos_materialmaster WHERE".$querytext." order by description";
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
    public static function getDescriptionList_search($itemtype, $qstore, $description, $assetunit) {
        $db = Database::getDB();
        $querytext = " dos_materialmaster.id != 0";
		if 	($itemtype) {$querytext = $querytext." and dos_materialmaster.itemtype = '$itemtype'"; }
		if 	($qstore) {$querytext = $querytext." and  dos_materialmaster.qstore = '$qstore'"; }
		if 	($description) {$querytext = $querytext." and  dos_materialmaster.description LIKE '%$description%'"; }
		$query = "SELECT dos_materialmaster.*, bos_openingbalance.ledger_folio, bos_openingbalance.qty_onhand, bos_openingbalance.qty_q1, bos_openingbalance.qty_q2, bos_openingbalance.qty_q3, bos_openingbalance.qty_q4, bos_openingbalance.qty_q5, bos_openingbalance.qty_q6, bos_openingbalance.qty_ledger FROM dos_materialmaster 
					LEFT JOIN bos_openingbalance
					ON dos_materialmaster.itemcode = bos_openingbalance.itemcode 
					AND (assetunit = '$assetunit' or assetunit is null)
					WHERE".$querytext." order by dos_materialmaster.description";
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
    public static function getHasRecord($itemcode) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM dos_materialmaster WHERE itemcode = '$itemcode'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
   public static function addDetails($itemtype, $itemcode, $description, $AsstNo, $qstore, $votehead, $votename) {
        $db = Database::getDB();
        $query = "INSERT INTO dos_materialmaster
            (itemtype, itemcode, description, AsstNo, qstore, votehead, votename)
         VALUES
        ('$itemtype', '$itemcode', '$description', '$AsstNo', '$qstore', '$votehead', '$votename')";
        $row_count = $db->exec($query);
        return $row_count;
    }
    public static function deleteDetailsByitemcode($itemcode) {
        $db = Database::getDB();
        $query = "DELETE FROM dos_materialmaster WHERE itemcode = '$itemcode'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getFullDetails_dos_full_list() {
        $db = Database::getDB();
        $query = 'SELECT * FROM dos_full_list order by catlogueno';
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
	public static function update_sub_category_main_category($itemcode, $sub_category, $main_category) {
        $db = Database::getDB();
        $query = "UPDATE dos_materialmaster SET sub_category = '$sub_category', main_category = '$main_category' WHERE itemcode ='$itemcode'";
        $count = $db->exec($query);
        return $count;
		}
    public static function deleteDetailsByMainCategory($main_category) {
        $db = Database::getDB();
        $query = "DELETE FROM dos_materialmaster WHERE main_category = '$main_category'";
        $count = $db->exec($query);
        return $count;
    }
   public static function addDetails_2($itemcode, $sub_category, $description, $AsstNo) {
        $db = Database::getDB();
        $query = "INSERT INTO dos_materialmaster
            (itemcode, main_category, sub_category, description, itemtype, AsstNo, qstore, itemcategory)
         VALUES
        ('$itemcode', 'Medical Equipments', '$sub_category', '$description', 'Medical Stores', '$AsstNo', 'Medical Equipment Ledger', 'Medical Stores')";
        $row_count = $db->exec($query);
        return $row_count;
    }
    public static function getUnique_main_category() {
        $db = Database::getDB();
        $query = 'SELECT DISTINCT main_category FROM dos_materialmaster order by main_category';
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
    public static function getsub_category($main_category) {
        $db = Database::getDB();
        $querytext = " main_category = '$main_category'";
		$query = "SELECT DISTINCT sub_category FROM dos_materialmaster WHERE".$querytext." order by sub_category";
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
    public static function getDescriptionList_2($main_category, $sub_category, $description) {
        $db = Database::getDB();
        $querytext = " id != 0";
		if 	($main_category) {$querytext = $querytext." and  main_category = '$main_category'"; }
		if 	($sub_category) {$querytext = $querytext." and  sub_category = '$sub_category'"; }
		if 	($description) {$querytext = $querytext." and  description LIKE '%$description%'"; }
		$query = "SELECT * FROM dos_materialmaster WHERE".$querytext." order by description";
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
    public static function getDescriptionList_search_2($main_category, $sub_category, $description, $assetunit) {
        $db = Database::getDB();
        $querytext = " dos_materialmaster.id != 0";
		if 	($main_category) {$querytext = $querytext." and dos_materialmaster.main_category = '$main_category'"; }
		if 	($sub_category) {$querytext = $querytext." and  dos_materialmaster.sub_category = '$sub_category'"; }
		if 	($description) {$querytext = $querytext." and  dos_materialmaster.description LIKE '%$description%'"; }
		$query = "SELECT dos_materialmaster.*, bos_openingbalance.ledger_folio, bos_openingbalance.qty_onhand, bos_openingbalance.qty_q1, bos_openingbalance.qty_q2, bos_openingbalance.qty_q3, bos_openingbalance.qty_q4, bos_openingbalance.qty_q5, bos_openingbalance.qty_q6, bos_openingbalance.qty_ledger FROM dos_materialmaster 
					LEFT JOIN bos_openingbalance
					ON dos_materialmaster.itemcode = bos_openingbalance.itemcode 
					AND (assetunit = '$assetunit' or assetunit is null)
					WHERE".$querytext." order by dos_materialmaster.description";
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
    public static function getDescription_main_sub($main_category, $sub_category) {
        $db = Database::getDB();
        $querytext = " main_category = '$main_category'";
		$querytext = $querytext." and  sub_category = '$sub_category'";
		$query = "SELECT description FROM dos_materialmaster WHERE".$querytext." order by description";
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
