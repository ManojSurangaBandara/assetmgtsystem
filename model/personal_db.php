<?php
function get_All_Persons_SVC() {
    global $db;
	// $query = "SELECT personal.* FROM personal, ranks where (personal.rank = ranks.code) AND (dtype = '1' or dtype = '4') ORDER BY ranks.ranklevel";
  $query = "SELECT * FROM personal where dtype = '1' or dtype = '4' ORDER BY tabl";
  
  
  // $query = "SELECT * FROM personal order by code";
   // "SELECT file.*, fileitems.itemcode, fileitems.itemname, fileitems.itemqty FROM file, fileitems WHERE file.code = fileitems.file AND file.code LIKE '%$file_id%'
   //          ORDER BY file.code"
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
function get_All_Persons_SVC_only() {
    global $db;
	// $query = "SELECT personal.* FROM personal, ranks where (personal.rank = ranks.code) AND (dtype = '1' or dtype = '4') ORDER BY ranks.ranklevel";
  $query = "SELECT * FROM personal where dtype = '1' ORDER BY tabl";
  
  
  // $query = "SELECT * FROM personal order by code";
   // "SELECT file.*, fileitems.itemcode, fileitems.itemname, fileitems.itemqty FROM file, fileitems WHERE file.code = fileitems.file AND file.code LIKE '%$file_id%'
   //          ORDER BY file.code"
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
function get_All_Persons_SVC_only_rank($rank) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '1' and `rank` = '$rank' ORDER BY tabl";
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
function get_All_Persons_SVC_only_regi($regi) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '1' and regi = '$regi' ORDER BY tabl";
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
function get_All_Persons_SVC_only_regi_rank($regi,$rank) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '1' and regi = '$regi' and `rank` = '$rank' ORDER BY tabl";
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
function get_All_Persons_Retd_only() {
    global $db;
	// $query = "SELECT personal.* FROM personal, ranks where (personal.rank = ranks.code) AND (dtype = '1' or dtype = '4') ORDER BY ranks.ranklevel";
  $query = "SELECT * FROM personal where dtype = '4' ORDER BY tabl";
  
  
  // $query = "SELECT * FROM personal order by code";
   // "SELECT file.*, fileitems.itemcode, fileitems.itemname, fileitems.itemqty FROM file, fileitems WHERE file.code = fileitems.file AND file.code LIKE '%$file_id%'
   //          ORDER BY file.code"
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
function get_All_Persons_Civil_only() {
    global $db;
	// $query = "SELECT personal.* FROM personal, ranks where (personal.rank = ranks.code) AND (dtype = '1' or dtype = '4') ORDER BY ranks.ranklevel";
  $query = "SELECT * FROM personal where dtype = '2' or dtype = '3' dtype = '5' dtype = '6' ORDER BY tabl";
  
  
  // $query = "SELECT * FROM personal order by code";
   // "SELECT file.*, fileitems.itemcode, fileitems.itemname, fileitems.itemqty FROM file, fileitems WHERE file.code = fileitems.file AND file.code LIKE '%$file_id%'
   //          ORDER BY file.code"
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
function get_All_Persons_Retd_only_rank($rank) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '4' and `rank` = '$rank' ORDER BY tabl";
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
function get_All_Persons_Retd_only_regi($regi) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '4' and regi = '$regi' ORDER BY tabl";
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
function get_All_Persons_Retd_only_regi_rank($regi,$rank) {
    global $db;
  $query = "SELECT * FROM personal where dtype = '4' and regi = '$regi' and `rank` = '$rank' ORDER BY tabl";
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
function get_regis() {
    global $db;
    $query = "SELECT DISTINCT regi FROM personal order by regi";
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
function get_regis_svc() {
    global $db;
    $query = "SELECT DISTINCT regi FROM personal where dtype = '1' order by regi";
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
function get_regis_civil() {
    global $db;
    $query = "SELECT DISTINCT regi FROM personal where dtype = '2' or dtype = '3' or dtype = '5' order by regi";
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
function get_All_Persons() {
    global $db;
  $query = "SELECT * FROM personal ORDER BY tabl";

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
function get_All_Persons_SVC_tabl($ticketno) {
    global $db;
  $query = "SELECT * FROM personal where ticketno = '$ticketno' ORDER BY tabl";
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
function get_All_Persons_SVC_code($code) {
    global $db;
  $query = "SELECT * FROM personal where code LIKE '%$code%' ORDER BY code";
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
function get_All_Persons_name($cname) {
 global $db;
  $query = "SELECT * FROM personal where cname LIKE '%$cname%' ORDER BY tabl";
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
function get_All_Persons_CIV() {
    global $db;
  $query = "SELECT * FROM personal where dtype = '2' or dtype = '3' or dtype = '5' or dtype = '6' ORDER BY tabl";
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
function get_All_Persons_Civil_only_typename($typename) {
    global $db;
  $query = "SELECT * FROM personal where typename = '$typename' ORDER BY tabl";
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
function get_All_Persons_Civil_only_regi($regi) {
    global $db;
  $query = "SELECT * FROM personal where regi = '$regi' ORDER BY tabl";
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
function get_Number_Name($t4) {
    global $db;
    $query = "SELECT * FROM personal WHERE char = '$t4'";
    $Iname = $db->query($query);
    $Iname = $Iname->fetch();
	$no = $Iname['code'];
    return $no;
}
function Count_Personal($code) {
    global $db;
    $query = "SELECT COUNT(code) as tot FROM personal WHERE dtype = 1 AND code = '$code'";
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
function add_Personal($code, $rank, $cname, $deco, $regi, $tabl, $ticketno) {
    global $db;
    $query = "INSERT INTO personal
                 (dtype, typename, code, rank, cname, deco, regi, tabl, ticketno)
              VALUES
                 ('1', 'SVC', '$code', '$rank', '$cname', '$deco', '$regi', '$tabl', '$ticketno')";
    $count = $db->exec($query);
	return $count;
}
function add_Personal_Civil($typename, $rank, $cname, $regi, $tabl, $ticketno) {
    global $db;
	switch($typename) {    
	case 'Civil':
		$dtype = 2;
		break;
	case 'Sponsor':
		$dtype = 3;
		break;
	case 'Invitee':
		$dtype = 5;
		break;
	case 'Res-Civil':
		$dtype = 6;
}
    $query = "INSERT INTO personal
                 (dtype, typename, rank, cname, regi, tabl, ticketno)
              VALUES
                 ('$dtype', '$typename', '$rank', '$cname', '$regi', '$tabl', '$ticketno')";
    $count = $db->exec($query);
	return $count;
}

function Find_table_details($seltable) {
    global $db;
	$query = "SELECT * FROM personal where tabl = '$seltable'";
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
function DELETE_Persinal_Details($id) {
    global $db;
    $query = "DELETE FROM personal where id = '$id'";
    $count = $db->exec($query);
	return $count;
}
function add_Personal_Retd($code, $rank, $cname, $deco, $regi, $tabl, $ticketno) {
    global $db;
    $query = "INSERT INTO personal
                 (dtype, typename, code, rank, cname, deco, regi, tabl, ticketno)
              VALUES
                 ('4', 'RETD', '$code', '$rank', '$cname', '$deco', '$regi', '$tabl', '$ticketno')";
    $count = $db->exec($query);
	return $count;
}
function Update_gift($ticketno, $lgift, $ggift) {
    global $db;
	$IR = 'I';
	$query = "UPDATE personal  SET lgift = '$lgift', ggift = '$ggift' WHERE ticketno = '$ticketno'";
    $count = $db->exec($query);
	return $count;
}
function get_gift_regi() {
    global $db;
	$query = "SELECT regi, count(*) as cnt, sum(lgift) as lg, sum(ggift) as gg FROM personal where dtype = '1' GROUP BY regi order by regi";
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
function get_gift_org() {
    global $db;
	$query = "SELECT regi, count(*) as cnt, sum(lgift) as lg, sum(ggift) as gg FROM personal where dtype = '2' or dtype = '3' or dtype = '5' or dtype = '6' GROUP BY regi order by regi";
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
function get_gift_rank() {
    global $db;
	$query = "SELECT `rank`, count(*) as cnt, sum(lgift) as lg, sum(ggift) as gg FROM personal where dtype = '1' GROUP BY `rank` order by `rank`";
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
function get_gift_reg_rank() {
    global $db;
	$query = "SELECT rank, regi, count(*) as cnt, sum(lgift) as lg, sum(ggift) as gg FROM personal where dtype = '1' GROUP BY regi, rank order by regi, rank";
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
?>