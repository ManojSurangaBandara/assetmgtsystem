<?php
class BuildingCategoryDB {
    public static function getBuildingCategorys() {
        $db = Database::getDB();
        $query = "SELECT id, categoryName FROM buildingclasification order by categoryName";
        $result = $db->query($query);
        $categorys = array();
        foreach ($result as $row) {
            $cate = new LandCategory($row['id'],
                                     $row['categoryName']);
            $categorys[] = $cate;
        }
        return $categorys;
    }
    
    	public static function getAssetsnoByCategory($category) {
        $db = Database::getDB();
        $query = "SELECT assetno, classification  FROM buildingclasification WHERE categoryName = '$category' and isdelete='0' order by categoryName";
       $statement = $db->query($query);
        $row = $statement->fetch();
        $assetnos = new LandCategory($row['assetno'],
                                     $row['classification']);
        return $assetnos;
    }
	
	
	    public static function getBuildingCategorysArray() {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingclasification WHERE isdelete='0'  order by categoryName";
        $result = $db->query($query);
        return $result;
    }
	
	    public static function getHasRecord($categoryName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM buildingclasification WHERE categoryName = '$categoryName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	    public static function addRecord($categoryName, $description, $vote, $classification, $assetno, $catalogueno) {
        $db = Database::getDB();
        $query = "INSERT INTO buildingclasification
          (categoryName, description, vote, classification, assetno, catalogueno, isdelete, user, Active)
          VALUES
          ('$categoryName', '$description', '$vote', '$classification', '$assetno', '$catalogueno', 0, 'DAM', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
		public static function deleteBuilding_Category($id) {
        $db = Database::getDB();
        $query = "DELETE FROM buildingclasification WHERE id = '$id'";
        $db->exec($query);
    }
	public static function update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE buildingclasification SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function getBuildingCategorysassetno() {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingclasification WHERE isdelete='0'  order by categoryName";
        $result = $db->query($query);
        return $result;
    }
}
?>