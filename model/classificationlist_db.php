<?php

class ClassificationListDB {

    public static function getMainCategory($type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT mainCategory FROM classificationlist where type = '$type' order by mainCategory";
        $result = $db->query($query);
        $mainCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['mainCategory']);
            $mainCategory[] = $prov;
        }
        return $mainCategory;
    }

    public static function getmainCategory1($type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT mainCategory FROM classificationlist where type = '$type' order by mainCategory";
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
	
    public static function getItemCategoryByMainCategory($mainCategory, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT itemCategory FROM classificationlist where type = '$type' and mainCategory = '$mainCategory' order by itemCategory";
        $result = $db->query($query);
        $itemCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['itemCategory']);
            $itemCategory[] = $prov;
        }
        return $itemCategory;
    }

    public static function getitemCategoryBymainCategory1($mainCategory, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT itemCategory FROM classificationlist where type = '$type' and mainCategory = '$mainCategory' order by itemCategory";
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
 public static function getDescriptionByCategory($mainCategory, $itemCategory, $type) {
        $db = Database::getDB();
        /////////////
		$sql = "SELECT sorttype FROM itemcategory WHERE itemCategory = '$itemCategory'";
        $result = $db->query($sql);
        $row = $result->fetch();
        $count = $row['sorttype'] ?? 0;
		//////////
		if ($count == 1) {
		$query = "SELECT DISTINCT itemDescription FROM classificationlist where type = '$type' and itemCategory = '$itemCategory' and mainCategory = '$mainCategory' order by catalogueno";
		} else {
		$query = "SELECT DISTINCT itemDescription FROM classificationlist where type = '$type' and itemCategory = '$itemCategory' and mainCategory = '$mainCategory' order by itemDescription";
        }
		$result = $db->query($query);
        $mainCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['itemDescription']);
            $mainCategory[] = $prov;
        }
        return $mainCategory;
    }

 public static function getDescriptionByCategory1($mainCategory, $itemCategory, $type) {
        $db = Database::getDB();
		$query = "SELECT DISTINCT itemDescription FROM classificationlist where type = '$type' and itemCategory = '$itemCategory' and mainCategory = '$mainCategory' order by itemDescription";
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
    public static function getCatalogueByDescription($mainCategory, $itemCategory, $itemDescription, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT catalogueno FROM classificationlist where type = '$type' and mainCategory = '$mainCategory' and itemCategory = '$itemCategory' and itemDescription = '$itemDescription' order by catalogueno";
        $result = $db->query($query);
        $catalogueno = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['catalogueno']);
            $catalogueno[] = $prov;
        }
        return $catalogueno;
    }
    public static function getCatalogueByDescription1($mainCategory, $itemCategory, $itemDescription, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT catalogueno FROM classificationlist where type = '$type' and mainCategory = '$mainCategory' and itemCategory = '$itemCategory' and itemDescription = '$itemDescription' order by catalogueno";
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

    public static function getAssetsnoByCatalogueno($catalogueno, $type) {
        $db = Database::getDB();
        $query = "SELECT assetsno, newAssestno, make, modle FROM classificationlist where type = '$type' and catalogueno = '$catalogueno'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $assetsno = new AssetsCenter2($row['assetsno'] ?? "", $row['newAssestno'] ?? "", $row['make'] ?? "", $row['modle'] ?? "");
        return $assetsno;
    }

    public static function getAssetsnoByCatalogueno1($catalogueno, $type) {
        $db = Database::getDB();
        $query = "SELECT assetsno FROM classificationlist where type = '$type' and catalogueno = '$catalogueno'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        //$assetsno = new AssetsCenter2($row['assetsno'], $row['newAssestno'], $row['make'], $row['modle']);
        return $row['assetsno'];
    }
	
    public static function getMakeByDescription($itemDescription, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT make FROM classificationlist where type = '$type' and itemDescription = '$itemDescription' order by make";
        $result = $db->query($query);
        $make = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['make']);
            $make[] = $prov;
        }
        return $make;
    }

    public static function getModleByMake($make, $type) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT modle FROM classificationlist where type = '$type' and make = '$make' order by modle";
        $result = $db->query($query);
        $modle = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['modle']);
            $modle[] = $prov;
        }
        return $modle;
    }
	
	public static function getMainCategory2() {
        $db = Database::getDB();
        $query = "SELECT DISTINCT mainCategory FROM classificationlist where type = '1' or type = '2' order by mainCategory";
        $result = $db->query($query);
        $mainCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['mainCategory']);
            $mainCategory[] = $prov;
        }
        return $mainCategory;
    }
	
    public static function getItemCategoryByMainCategory2($mainCategory) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT itemCategory FROM classificationlist where mainCategory = '$mainCategory' make";
        $result = $db->query($query);
        $itemCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['itemCategory']);
            $itemCategory[] = $prov;
        }
        return $itemCategory;
    }

    public static function getDescriptionByCategory2($mainCategory, $itemCategory) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT itemDescription FROM classificationlist where itemCategory = '$itemCategory' and mainCategory = '$mainCategory' order by itemDescription";
        // $query = "SELECT itemDescription FROM classificationlist where type = 1";
        $result = $db->query($query);
        $mainCategory = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['itemDescription']);
            $mainCategory[] = $prov;
        }
        return $mainCategory;
    }

    public static function getCatalogueByDescription2($mainCategory, $itemCategory, $itemDescription) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT catalogueno FROM classificationlist where mainCategory = '$mainCategory' and itemCategory = '$itemCategory' and itemDescription = '$itemDescription'";
        $result = $db->query($query);
        $catalogueno = array();
        foreach ($result as $row) {
            $prov = new AssetsCenter(1, $row['catalogueno']);
            $catalogueno[] = $prov;
        }
        return $catalogueno;
    }

    public static function getAssetsnoByCatalogueno2($catalogueno) {
        $db = Database::getDB();
        $query = "SELECT assetsno, newAssestno, make, modle FROM classificationlist where catalogueno = '$catalogueno'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $assetsno = new AssetsCenter2($row['assetsno'], $row['newAssestno'], $row['make'], $row['modle']);
        return $assetsno;
    }
	public static function deleteDetailsById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM landdetails WHERE id = '$id'";
        $count = $db->exec($query);
		return $count;
    }
	
	public static function getAssetsnoByCatalogueno3($catalogueno, $type) {
        $db = Database::getDB();
        $query = "SELECT assetsno, newAssestno, make, modle FROM classificationlist where type = '$type' and catalogueno = '$catalogueno'";
        $statement = $db->query($query);
        $row = $statement->fetch();
        $assetsno = array($row['assetsno'], $row['newAssestno'], $row['make'], $row['modle']);
        return $assetsno;
    }

}

?>