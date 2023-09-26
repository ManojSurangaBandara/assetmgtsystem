<?php
class LandCategoryDB {
    public static function getLandCategorys() {
        $db = Database::getDB();
        $query = "SELECT assetno, categoryName FROM landclasification WHERE isdelete='0' ORDER BY categoryName";
        $result = $db->query($query);
        $categorys = array();
        foreach ($result as $row) {
            $cate = new LandCategory($row['assetno'],
                                     $row['categoryName']);
            $categorys[] = $cate;
        }
        return $categorys;
    }
	
	public static function getAssetsnoByCategory($category) {
        $db = Database::getDB();
        $query = "SELECT assetno, classification  FROM landclasification WHERE categoryName = '$category' and isdelete='0' ORDER BY categoryName";
       $statement = $db->query($query);
        $row = $statement->fetch();
        $assetnos = new LandCategory($row['assetno'] ?? "",
                                     $row['classification'] ?? "");
        return $assetnos;
    }
	
	    public static function getLandCategorysArray() {
        $db = Database::getDB();
        $query = "SELECT * FROM landclasification WHERE isdelete='0' ORDER BY categoryName";
        $result = $db->query($query);
        return $result;
    }
	
	    public static function getHasRecord($categoryName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM landclasification WHERE categoryName = '$categoryName'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	
	    public static function addRecord($categoryName, $description, $vote, $classification, $assetno, $catalogueno) {
        $db = Database::getDB();
        $query = "INSERT INTO landclasification
          (categoryName, description, vote, classification, assetno, catalogueno, isdelete, user, sysdate)
          VALUES
          ('$categoryName', '$description', '$vote', '$classification', '$assetno', '$catalogueno', 0, 'DAM', now())";
        $row_count = $db->exec($query);
        return $row_count;
    }
		public static function deleteLand_Category($id) {
        $db = Database::getDB();
        $query = "DELETE FROM landclasification WHERE id = '$id'";
        $db->exec($query);
    }
	public static function update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE landclasification SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function getLandCategorysassetno() {
        $db = Database::getDB();
        $query = "SELECT * FROM landclasification WHERE isdelete='0'  order by assetno";
        $result = $db->query($query);
        return $result;
    }
}
?>