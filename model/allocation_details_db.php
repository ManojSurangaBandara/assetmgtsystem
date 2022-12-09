<?php

class allocation_detailsDB {

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM allocation_details order by assetunit, catalogueno';
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

    public static function getHasRecord($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM allocation_details WHERE assetunit = '$assetunit' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "INSERT INTO allocation_details
          (assetunit, catalogueno)
          VALUES
          ('$assetunit', '$catalogueno')";
        try {
			$row_count = $db->exec($query);
			return $row_count;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	public static function deleteRecord($id) {
        $db = Database::getDB();
        $query = "DELETE FROM allocation_details WHERE id = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from allocation_details where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	
	public static function getDetailsByCatalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select * from allocation_details where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['quantity'];
    }
	public static function getTotalByCatalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select sum(quantity) as quantity from allocation_details where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['quantity'];
    }
	public static function getActTotalByCatalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select sum(act_quantity) as quantity from allocation_details where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['quantity'];
    }
	public static function getDetailsByUnitCatalogueno($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "select * from allocation_details where assetunit = '$assetunit' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['quantity'];
    }
	public static function getDetailsByUnitCatalogueno_all($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "select * from allocation_details where assetunit = '$assetunit' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getAct_qtyDetailsByUnitCatalogueno($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "select * from allocation_details where assetunit = '$assetunit' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['act_quantity'];
    }	
	public static function getDetailsByunit($assetunit) {
        $db = Database::getDB();
        $query = "select allocation_details.*, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		where allocation_details.assetunit = '$assetunit' order by classificationlist.type, classificationlist.catalogueno";
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
	 public static function allocation_details_save_qty($id, $quantity) {
        $db = Database::getDB();
        $query = "UPDATE allocation_details SET quantity = '$quantity' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
	 public static function allocation_details_save_act_qty($id, $quantity) {
        $db = Database::getDB();
        $query = "UPDATE allocation_details SET act_quantity = '$quantity' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getDetailsByassetunit($assetunit) {
        $db = Database::getDB();
        $query = "select * FROM allocation_details WHERE assetunit ='$assetunit'";
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
    }

	public static function getDetailsByassetunits($protocoltext1) {
        $db = Database::getDB();
		$query = "select catalogueno FROM allocation_details WHERE assetunit IN (SELECT unitName FROM assetunit WHERE protocoltext1 = '$protocoltext1' or protocoltext2 = '$protocoltext1'  order by protocollevel5)";
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
    }


	public static function get_scale_catalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select * from classificationlist where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['scale_catalogueno'];
    }
	
	public static function get_details_scale_catalogue($catalogueno, $scale_assetunit) {
        $db = Database::getDB();	
		$query = "select ".$scale_assetunit." as qty from scale_catalogue where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['qty'];
    }
	
	public static function getDetailsView() {
        $db = Database::getDB();
        $query = "select allocation_details.catalogueno, sum(allocation_details.quantity) as quantity, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype 
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		GROUP BY allocation_details.catalogueno order by allocation_details.catalogueno";
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
    }
	public static function getDetailsByCatlogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select allocation_details.*, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		where allocation_details.catalogueno = '$catalogueno' order by classificationlist.type";
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
	public static function getDetailsByitemCategory($itemCategory) {
        $db = Database::getDB();
        $query = "select allocation_details.*, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		LEFT JOIN assetunit ON assetunit.unitName=allocation_details.assetunit
		where classificationlist.itemCategory = '$itemCategory' order by assetunit.protocollevel5, classificationlist.catalogueno";
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
	public static function getDetailsBymainCategory($mainCategory) {
        $db = Database::getDB();
        $query = "select allocation_details.*, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		LEFT JOIN assetunit ON assetunit.unitName=allocation_details.assetunit
		where classificationlist.mainCategory = '$mainCategory' order by assetunit.protocollevel5, classificationlist.catalogueno";
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
	public static function getDetailsByType($type) {
        $db = Database::getDB();
        $query = "select allocation_details.*, classificationlist.type, classificationlist.mainCategory, classificationlist.itemCategory, classificationlist.itemDescription,
		 CASE classificationlist.type
		   when 1 then 'Office Equipment'
		   when 2 then 'Plant & Machinery'
		   when 3 then 'Vehicle Details'
		END as itemtype
		FROM allocation_details 
		LEFT JOIN classificationlist ON classificationlist.catalogueno=allocation_details.catalogueno
		LEFT JOIN assetunit ON assetunit.unitName=allocation_details.assetunit
		where classificationlist.type = '$type' order by assetunit.protocollevel5, classificationlist.catalogueno";
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
