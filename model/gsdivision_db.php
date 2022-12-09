<?php
class GsDivisionDB {
    public static function getDivisions() {
        $db = Database::getDB();
        $query = 'SELECT * FROM mas_gs_divisions';
        $result = $db->query($query);
        $divisions = array();
        foreach ($result as $row) {
            $divi = new DsDivision($row['SN'],
                                     $row['str_GS_Division']);
            $divisions[] = $divi;
        }
        return $divisions;
    }

    public static function getDivisionsByDS($dsdivision) {
        $db = Database::getDB();
        $query = "SELECT * FROM mas_gs_divisions
                  WHERE DSDivision = '$dsdivision'
                  ORDER BY str_GS_Division";
        $result = $db->query($query);
        $divisions = array();
        foreach ($result as $row) {
            $divi = new DsDivision($row['SN'],
                                   $row['str_GS_Division']);
            $divisions[] = $divi;
        }
        return $divisions;
    }
	
			 public static function getDivisionsByDSArray($dsDivision) {
       $db = Database::getDB();
        $query = "SELECT * FROM mas_gs_divisions
                  WHERE DSDivision = '$dsDivision'
                  ORDER BY str_GS_Division";
        $result = $db->query($query);;
        return $result;
    }
	    public static function getHasRecord($gsDivision) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM mas_gs_divisions WHERE str_GS_Division = '$gsDivision'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }	
	
	public static function addRecord($dsDivision, $gsDivision, $GN_Code) {
        $db = Database::getDB();
        $query = "INSERT INTO mas_gs_divisions
          (DSDivision, str_GS_Division, GN_Code, Active)
          VALUES
          ('$dsDivision', '$gsDivision', '$GN_Code', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>