<?php

class ConstantsDB {
    public static function getCurrentYear() {
        $db = Database::getDB();
        $query = "select currentYear from constants";
        $result = $db->query($query);
        $row = $result->fetch();
        $currentYear = $row['currentYear'];
        return $currentYear;
    }
    public static function addCurrentYear($currentYear) {
        $db = Database::getDB();
        $query = "UPDATE constants SET currentYear = '$currentYear'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getsurvayyear() {
        $db = Database::getDB();
        $query = "select surveyyear from constants";
        $result = $db->query($query);
        $row = $result->fetch();
        $surveyyear = $row['surveyyear'];
        return $surveyyear;
    }
    public static function addsurvayyear($currentYear) {
        $db = Database::getDB();
        $query = "UPDATE constants SET surveyyear = '$currentYear'";
        $count = $db->exec($query);
        return $count;
    }
}
