<?php

class DistrictDB {

    public static function getDistricts() {
        $db = Database::getDB();
        $query = 'SELECT * FROM mas_districts order by str_District';
        $result = $db->query($query);
        $districts = array();
        foreach ($result as $row) {
            $dist = new District($row['SN'], $row['str_District']);
            $districts[] = $dist;
        }
        return $districts;
    }

    public static function getDistrictsByProvince($province) {
        $db = Database::getDB();
        $query = "SELECT * FROM mas_districts
                  WHERE str_Province = '$province'
                  ORDER BY str_District";
        $result = $db->query($query);
        $districts = array();
        foreach ($result as $row) {
            $district = new District($row['SN'], $row['str_District']);
            $districts[] = $district;
        }
        return $districts;
    }

    public static function getCatlognoByDistrict($type, $district) {
        $db = Database::getDB();
        $query = "SELECT * FROM mas_districts
                  WHERE str_District = '$district'";
        $result = $db->query($query);
        $statement = $db->query($query);
        $row = $statement->fetch();
        if ($type == 4) {
            $districts = new District($row['str_Army_Land'], $row['str_Other_Land']);
        } elseif ($type == 5) {
            $districts = new District($row['str_Army_Building'], $row['str_Other_Building']);
        }
        return $districts;
    }

}

?>