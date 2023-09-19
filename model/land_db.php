<?php

class LandDB {

    public static function getLands() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE isdelete = 0 order by protocolOrder, counterID';
        $result = $db->query($query);
        $lands = array();
        foreach ($result as $row) {
            $land = new Land(
                    $row['assetscenter'], $row['assetunit'], $row['province'], $row['district'], $row['dsDivision'], $row['gsDivision'], $row['category'], $row['assetsno'], $row['classificationno'], $row['identificationno'], $row['register'], $row['landname'], $row['natureOwnership'], $row['ownership'], $row['planno'], $row['deedno'], $row['deeddate'], $row['landNature'], $row['areaMeasure'], $row['area'], $row['estimatedValue'], $row['acquisitiondate'], $row['remarks']);
            $lands[] = $land;
        }
        return $lands;
    }

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE apprived = 1 order by protocolOrder, counterID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function getDetails_protocol($protocol, $text) {
        $db = Database::getDB();
        if ($protocol == 1) {
			$query = "SELECT * FROM landdetails WHERE protocoltext1 = '$text' and apprived = 1 order by protocolOrder, counterID";
		} else if ($protocol == 2) {
			$query = "SELECT * FROM landdetails WHERE assetunit = '$text' and apprived = 1 order by protocolOrder, counterID";
		}
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }	
	
	
	
    public static function getHasRecord($land) {
        $db = Database::getDB();
        $identificationno = $land->getIdentificationno();
        $query = "SELECT count(1) as tot FROM landdetails
                  WHERE identificationno = '$identificationno' order by sorderwithcenter";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addLand($land) {
        $db = Database::getDB();

        $assetscenter = $land->getAssetscenter();
        $assetunit = $land->getAssetunit();
        $province = $land->getProvince();
        $district = $land->getDistrict();
        $dsDivision = $land->getDsDivision();
        $gsDivision = $land->getGsDivision();
        $category = $land->getCategory();
        $assetsno = $land->getAssetsno();
        $classificationno = $land->getClassificationno();
        $identificationno = $land->getIdentificationno();
        $register = $land->getRegister();
        $landname = $land->getLandname();
        $natureOwnership = $land->getNatureOwnership();
        $ownership = $land->getOwnership();
        $planno = $land->getPlanno();
        $deedno = $land->getDeedno();
        $deeddate = $land->getDeeddate();
        $landNature = $land->getLandNature();
        $areaMeasure = $land->getAreaMeasure();
        $area = $land->getArea();
        $acre = $land->getAcre();
        $rood = $land->getRood();
        $parch = $land->getParch();
        $estimatedValue = $land->getEstimatedValue();
        $acquisitiondate = $land->getAcquisitiondate();
        $remarks = $land->getRemarks();
        $counterId = $land->getCounterId();
        $acquisitionInstitute = $land->getAcquisitionInstitute();
	$previousownership = $land->getPreviousownership();
        $refValue = $land->getRefValue();
        $valCost = $land->getValCost();
        

        $query = "INSERT INTO landdetails
          (assetscenter, assetunit, province, district, dsDivision, gsDivision, category, assetsno, classificationno, identificationno, register, landname, natureOwnership, ownership, planno, deedno, deeddate, landNature, areaMeasure, area, acre, rood, parch, estimatedValue, acquisitiondate, remarks, counterId, acquisitionInstitute, previousownership, sysdate, refValue, valCost)
          VALUES
          ('$assetscenter', '$assetunit', '$province', '$district', '$dsDivision', '$gsDivision', '$category', '$assetsno', '$classificationno', '$identificationno', '$register', '$landname', '$natureOwnership', '$ownership', '$planno', '$deedno', '$deeddate', '$landNature', '$areaMeasure', '$area', '$acre', '$rood', '$parch', '$estimatedValue', '$acquisitiondate', '$remarks', '$counterId', '$acquisitionInstitute', '$previousownership', now(), '$refValue', '$valCost')";
        
		
		$row_count = $db->exec($query);
		
		

        return $row_count;
    }

    public static function getCounterId($assetunit) {
        $db = Database::getDB();
        $query = "select max(counterId) as tot from landdetails where assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function getLandsNotApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE apprived = 0 and notapprived = 0 order by protocolOrder, counterID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

   public static function getLandsApproveRejected() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE apprived = 0 and notapprived = 1 order by protocolOrder, counterID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    
    public static function getLandsApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE apprived = 1 and isdelete = 0 order by protocolOrder, counterID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function getDetailsByIdentificationno($identificationno) {
        $db = Database::getDB();
        $query = "select * from landdetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function ApproveDetails($id, $login) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET apprived = 1, approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function notApproveDetails($id, $login, $notapprivedReason) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET notapprived = 1, notapprivedReason = '$notapprivedReason', approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }  
    public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from landdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function deleteDetailsById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM landdetails WHERE id = '$id'";
        $count = $db->exec($query);
		return $count;
    }
    public static function getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " apprived = 1";
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if ($inputField1 && $inputField1) {	
			$querytext = $querytext." and acquisitiondate BETWEEN '$inputField1' AND '$inputField2'";}
			
		$query = "SELECT * FROM landdetails WHERE".$querytext." and ".$column." LIKE '%$search%' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterCentre");
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }   
 
   public static function getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " apprived = 1";
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if ($inputField1 && $inputField1) {	
			$querytext = $querytext." and acquisitiondate BETWEEN '$inputField1' AND '$inputField2'";}
			
		$query = "SELECT * FROM landdetails WHERE".$querytext." and ".$column." = '$search' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterCentre");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	
  public static function getSearchText($column) {
        $db = Database::getDB();
        $query = "SELECT ".$column." as col, assetscenter, assetunit, protocoltext1, protocoltext2, dam_controller FROM landdetails WHERE apprived = 1 order by ".$column.", sorderwithcenter";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            $resultUnique = array();
        foreach ($result as $row) {
            $resultUnique[] = $row['col'];
        }
            $result = array_unique($resultUnique);
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	
    public static function getDetails($assetscenter, $assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM landdetails WHERE apprived = 1 and assetscenter = '$assetscenter' and assetunit = '$assetunit' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getDetailsUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM landdetails WHERE apprived = 1 and assetunit = '$assetunit' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }	
	public static function ModificationAllows($id) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET apprived = 0 WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Savesorderwithcenter($sorderwithcenter, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET sorderwithcenter = '$sorderwithcenter' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Savesprotocol($protocoltext1, $protocoltext2, $protocol, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function view_update($assetscenter, $assetunit, $inputField1, $inputField2) {
        $db = Database::getDB();
        //$query = 'SELECT * FROM landdetails WHERE apprived = 1 order by sorderwithcenter, counterID';
		$query = 'SELECT * FROM landdetails order by protocolOrder, counterID';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function view_dam($id, $login, $damcomment) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET view = 1, viewperson = '$login', viewdate = now(), damcomment = '$damcomment' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function picpath($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET picpath = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 
    public static function getpicById($id) {
        $db = Database::getDB();
        $query = "select picpath from landdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
public static function getaaaDetails($assetscenter) {
        $db = Database::getDB();
        $query = "SELECT * FROM landdetails WHERE apprived = 1 and assetscenter = '$assetscenter' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (acquisitiondate BETWEEN '$inputField1' AND '$inputField2')"; }		
		$query = "SELECT * FROM landdetails WHERE".$querytext." order by protocolOrder, identificationno";		
        //echo $query;exit;
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$result = array_filter($result, "Database::filterUnits");            
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getHasLand_CategoryInLand($categoryName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM landdetails
                  WHERE category = '$categoryName' order by protocolOrder";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function countRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM landdetails
                  WHERE assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function confirmRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM landdetails
                  WHERE apprived = 1 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function zero_value_Records($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM landdetails WHERE assetunit = '$assetunit' and apprived = 1 and estimatedValue = 0 order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
	public static function change_assets_unit_name($oldassetunit, $newassetunit, $identification) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET assetunit = '$newassetunit' WHERE assetunit ='$oldassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE landdetails SET identificationno = SUBSTRING(identificationno, 12) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE landdetails SET identificationno = CONCAT('$identification', identificationno) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		return $count;
		}
    public static function getDetailsUnitAll($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM landdetails WHERE assetunit = '$assetunit' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function deleteDetailsAll($assetunit) {
        $db = Database::getDB();
        $query = "DELETE FROM landdetails WHERE assetunit = '$assetunit'";
        $count = $db->exec($query);
		return $count;
    }
	public static function summaryRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT sum(estimatedValue) as tot FROM landdetails
                  WHERE apprived = 1 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function summaryRecords_2() {
        $db = Database::getDB();
        $query = "SELECT count(1) as cnt, sum(estimatedValue) as tot FROM landdetails
                  WHERE apprived = 1";
        $result = $db->query($query);
        $row = $result->fetch();
		$count = array($row['cnt'], $row['tot']);
        return $count;
    }
	public static function update_psos_allow($assetno, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE assetsno ='$assetno'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Save_psos_allow($category, $identificationno) {
        $db = Database::getDB();
        $sql = "SELECT * FROM landclasification WHERE categoryName = '$category'";
        $result = $db->query($sql);
        $row = $result->fetch();
			$DGGS = $row['DGGS']; 			
			$DOPS = $row['DOPS']; 		
			$DTRG = $row['DTRG'];       
			$DPLAN = $row['DPLAN'];      
			$DIT = $row['DIT'];        
			$CFE = $row['CFE'];        
			$CSO = $row['CSO'];        
			$DGSPORTS = $row['DGSPORTS'];   
			$DSPORTS = $row['DSPORTS'];    
			$AG = $row['AG'];         
			$DGAHS = $row['DGAHS'];      
			$DAMS = $row['DAMS'];       
			$DADS = $row['DADS'];       
			$DAMM = $row['DAMM'];       
			$QMG = $row['QMG'];        
			$DAQ = $row['DAQ'];        
			$DST = $row['DST'];        
			$DES = $row['DES'];        
			$MGO = $row['MGO'];        
			$DOS = $row['DOS'];        
			$DEME = $row['DEME'];       
			$DGINF = $row['DGINF'];
			$dam_controller = $_SESSION['DAM_CONTROLLER'];	
		$query = "UPDATE landdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF', dam_controller = '$dam_controller' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecord_psos_allow() {
        $db = Database::getDB();
        try {
            
            $query = "SELECT count(1) as tot FROM landdetails WHERE ".$_SESSION['SESS_LAST_NAME']." = 1";
            $result = $db->query($query);
            $row = $result->fetch();
            $count = $row['tot'];
            return $count;
        }  catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        
    }
    public static function getBoard_report($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = " apprived = 1";
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
			
		$query = "SELECT * FROM landdetails WHERE".$querytext." order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterCentre");
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    } 
    public static function getSummaryDetails($assetscenter, $assetunit, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 1";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (acquisitiondate BETWEEN '$inputField1' AND '$inputField2')"; }		
		
		$query = "SELECT *, count(*) as cnt, sum(estimatedValue) as tot FROM landdetails WHERE".$querytext." group by assetsno order by assetsno";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function get_itemCategory_summary_date($category, $acquisitiondate) {
		$db = Database::getDB();
		 $query = "SELECT count(*) as cnt, sum(estimatedValue) as tot FROM landdetails WHERE apprived = 1 and category = '$category' and acquisitiondate <= '$acquisitiondate' order by assetsno";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	public static function get_itemCategory_summary_date_list($category, $acquisitiondate) {
		$db = Database::getDB();
		 $query = "SELECT * FROM landdetails WHERE apprived = 1 and category = '$category' and acquisitiondate <= '$acquisitiondate' order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;	
	}
    public static function getFullDetails_province() {
        $db = Database::getDB();
        $query = 'SELECT * FROM landdetails WHERE apprived = 1 order by province, district, dsDivision, gsDivision';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function update_dam_controller($assetunit, $dam_controller) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET dam_controller = '$dam_controller' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getvreportById($id) {
        $db = Database::getDB();
        $query = "select vreport from landdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function put_vreport_path($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET vreport = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getInqDetails3($assetscenter, $assetunit) {
		$db = Database::getDB();
		$querytext = " assetscenter = '$assetscenter' and assetunit = '$assetunit'";
        $query = "SELECT * FROM landdetails WHERE".$querytext." order by identificationno";		
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
    public static function getHasRecordUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM landdetails
                  WHERE assetunit ='$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function change_unit_name($assetscenter, $assetunit, $assetscenter1, $assetunit1, $CentreID, $CentreIDold) {
        $db = Database::getDB();
        $query = "UPDATE landdetails SET assetscenter = '$assetscenter1', assetunit = '$assetunit1', identificationno = REPLACE(identificationno, '$CentreIDold', '$CentreID') WHERE assetunit ='$assetunit' and assetscenter = '$assetscenter'";
        $count = $db->exec($query);
        return $count;
		}	
}
