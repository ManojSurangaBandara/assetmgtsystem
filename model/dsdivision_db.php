<?php
class DsDivisionDB {
    public static function getDivisions() {
        $db = Database::getDB();
        $query = 'SELECT * FROM mas_ds_divisions ORDER BY DSDivision';
        $result = $db->query($query);
        $divisions = array();
        foreach ($result as $row) {
            $divi = new DsDivision($row['SN'],
                                     $row['DSDivision']);
            $divisions[] = $divi;
        }
        return $divisions;
    }

    public static function getDivisionsByDistrict($district) {
        $db = Database::getDB();
        $query = "SELECT * FROM mas_ds_divisions
                  WHERE District = '$district'
                  ORDER BY DSDivision";
        $result = $db->query($query);
        $divisions = array();
        foreach ($result as $row) {
            $division = new DsDivision($row['SN'],
                                   $row['DSDivision']);
            $divisions[] = $division;
        }
        return $divisions;
    }
	
		 public static function getDivisionsByDistrictArray($district) {
       $db = Database::getDB();
        $query = "SELECT * FROM mas_ds_divisions
                  WHERE District = '$district'
                  ORDER BY DSDivision";
        $result = $db->query($query);;
        return $result;
    }
	    public static function getHasRecord($dsDivision) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM mas_ds_divisions WHERE DSDivision = '$dsDivision'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }	
	
	public static function addRecord($district, $dsDivision) {
        $db = Database::getDB();
        $query = "INSERT INTO mas_ds_divisions
          (District, DSDivision, Active)
          VALUES
          ('$district', '$dsDivision', 1)";
        $row_count = $db->exec($query);
        return $row_count;
    }
}
?>