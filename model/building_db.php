<?php

class BuildingDB {

    public static function getBuildings() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE isdelete = 0 order by protocolOrder, counterID';
        $result = $db->query($query);
        $buildings = array();
        foreach ($result as $row) {
            $building = new Building($row['assetscenter'], $row['assetunit'], $row['province'], $row['district'], $row['dsDivision'], $row['gsDivision'], $row['landName'], $row['ownerName'], $row['buildingCategory'], $row['assetsno'], $row['buildingType'], $row['rentAndRate'], $row['natureOwnership'], $row['ownership'], $row['regOwnerName'], $row['classificationno'], $row['identificationno'], $row['buildingno'], $row['planno'], $row['plandate'], $row['areaMeasure'], $row['area'], $row['constructionCost'], $row['additionsValue'], $row['alterationValue'], $row['acquisitiondate'], $row['remarks']);
            $buildings[] = $building;
        }
        return $buildings;
    }

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID';
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
			$query = "SELECT * FROM buildingdetails WHERE protocoltext1 = '$text' and fundtype = 0 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID";
		} else if ($protocol == 2) {
			$query = "SELECT * FROM buildingdetails WHERE assetunit = '$text' and fundtype = 0 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID";
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
	
	
    public static function getHasRecord($building) {
        $db = Database::getDB();
        $identificationno = $building->getIdentificationno();
        $query = "SELECT count(1) as tot FROM buildingdetails
                  WHERE identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addBuilding($building) {
        $db = Database::getDB();

        $assetscenter = $building->getAssetscenter();
        $assetunit = $building->getAssetunit();
        $province = $building->getProvince();
        $district = $building->getDistrict();
        $dsDivision = $building->getDsDivision();
        $gsDivision = $building->getGsDivision();
        $landName = $building->getLandName();
        $ownerName = $building->getOwnerName();
        $buildingCategory = $building->getBuildingCategory();
        $assetsno = $building->getAssetsno();
        $buildingType = $building->getBuildingType();
        $rentAndRate = $building->getRentAndRate();
        $natureOwnership = $building->getNatureOwnership();
        $ownership = $building->getOwnership();
        $regOwnerName = $building->getRegOwnerName();
        $classificationno = $building->getClassificationno();
        $identificationno = $building->getIdentificationno();
        $buildingno = $building->getBuildingno();
        $planno = $building->getPlanno();
        $plandate = $building->getPlandate();
        $areaMeasure = $building->getAreaMeasure();
        $area = $building->getArea();
        $feets = $building->getFeets();
        $constructionCost = $building->getConstructionCost();
        $additionsValue = $building->getAdditionsValue();
        $alterationValue = $building->getAlterationValue();
        $acquisitiondate = $building->getAcquisitiondate();
        //$capitalCost = $building->getCapitalCost(); 
        $remarks = $building->getRemarks();
        $counterId = $building->getCounterId();
        $acquisitionInstitute = $building->getAcquisitionInstitute();
		$previousownership = $building->getPreviousownership();
                $refValue = $building->getRefValue();
        $query = "INSERT INTO buildingdetails
          (assetscenter,  assetunit, province, district, dsDivision, gsDivision, landname, ownerName, buildingCategory, assetsno, buildingType, rentAndRate, natureOwnership, ownership, regOwnerName, classificationno, identificationno, buildingno, planno, plandate, areaMeasure, area, feets, constructionCost, additionsValue, alterationValue, acquisitiondate, remarks, counterId, acquisitionInstitute, previousownership, sysdate, refValue)
          VALUES
          ('$assetscenter',  '$assetunit', '$province', '$district', '$dsDivision', '$gsDivision', '$landName', '$ownerName', '$buildingCategory', '$assetsno',  '$buildingType', '$rentAndRate', '$natureOwnership', '$ownership', '$regOwnerName', '$classificationno', '$identificationno', '$buildingno', '$planno', '$plandate', '$areaMeasure', '$area', '$feets', '$constructionCost', '$additionsValue', '$alterationValue', '$acquisitiondate', '$remarks', '$counterId', '$acquisitionInstitute', '$previousownership', now(),'$refValue')";

        //      $query = "INSERT INTO buildingdetails
        //    (assetscenter,  assetunit, province, district, dsDivision, gsDivision, landname, ownerName, buildingCategory, assetsno, buildingType, rentAndRate, natureOwnership, ownership, regOwnerName, classificationno, identificationno, buildingno, planno, plandate, areaMeasure, area, constructionCost, additionsValue, alterationValue, acquisitiondate, remarks, counterId, sysdate)
        //    VALUES
        //    ('$assetscenter',  '$assetunit', '$province', '$district', '$dsDivision', '$gsDivision', '$landName', '$ownerName', '$buildingCategory', '$assetsno',  '$buildingType', '$rentAndRate', '$natureOwnership', $ownership', '$regOwnerName', '$classificationno', '$identificationno', '$buildingno', '$planno', '$plandate', '$areaMeasure', '$area', '$constructionCost', '$additionsValue', '$alterationValue', '$acquisitiondate', '$remarks', '$counterId', now())";


        $row_count = $db->exec($query);


        return $row_count;
    }

    public static function getCounterId($assetunit) {
        $db = Database::getDB();
        $query = "select max(counterId) as tot from buildingdetails where assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function getBuildingNotApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE apprived = 0 and notapprived = 0 and isdelete = 0 order by protocolOrder, counterID';
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

    public static function getBuildingApproveRejected() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE apprived = 0 and notapprived = 1 and isdelete = 0 order by protocolOrder, counterID';
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

    public static function getBuildingApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID';
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
        $query = "select * from buildingdetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function ApproveDetails($id, $login) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET apprived = 1, approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function notApproveDetails($id, $login, $notapprivedReason) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET notapprived = 1, notapprivedReason = '$notapprivedReason', approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from buildingdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function deleteDetailsById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM buildingdetails where id = '$id'";
        $count = $db->exec($query);
		return $count;
    }

    public static function getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and isdelete = 0";
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
			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." and ".$column." LIKE '%$search%' order by protocolOrder, counterID";

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

	public static function getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and isdelete = 0";
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
                        
                        
                        
			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." and ".$column." = '$search' order by protocolOrder, counterID";

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
        $query = "SELECT " . $column . " as col, assetscenter, assetunit, protocoltext1, protocoltext2, dam_controller FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 order by " . $column . ", counterID";
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
        $query = "SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and assetscenter = '$assetscenter' and assetunit = '$assetunit' order by protocolOrder, counterID";
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
        $query = "UPDATE buildingdetails SET apprived = 0 WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Savesorderwithcenter($sorderwithcenter, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET sorderwithcenter = '$sorderwithcenter' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function view_update($assetscenter, $assetunit, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = "";
		if ($assetscenter <> "") {
			$querytext = " where assetscenter = '$assetscenter'";
			if ($assetunit <> "") {
					$querytext = $querytext." and assetunit = '$assetunit'";
			}
		}
		
		
        //$query = 'SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 order by sorderwithcenter, counterID';
		//$query = 'SELECT * FROM buildingdetails order by sorderwithcenter, counterID';
		$query = "SELECT * FROM buildingdetails".$querytext." order by protocolOrder, counterID";
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
        $query = "UPDATE buildingdetails SET view = 1, viewperson = '$login', viewdate = now(), damcomment = '$damcomment' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 
	public static function picpath($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET picpath = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 
    public static function getpicById($id) {
        $db = Database::getDB();
        $query = "select picpath from buildingdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
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
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." order by protocolOrder, identificationno";		
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
    public static function getHasBuilding_CategoryInBuilding($categoryName) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM buildingdetails
                  WHERE buildingCategory = '$categoryName' order by protocolOrder";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function countRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM buildingdetails
                  WHERE assetunit = '$assetunit' and isdelete = 0";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function confirmRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM buildingdetails
                  WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function zero_value_Records($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingdetails WHERE assetunit = '$assetunit' and fundtype = 0 and apprived = 1 and isdelete = 0 and constructionCost = 0 order by protocolOrder, counterID";
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
	public static function Savesprotocol($protocoltext1, $protocoltext2, $protocol, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
    public static function mofifydata_grid_save($id, $category, $buildingType, $landname, $acquisitiondate, $area, $feets, $constructionCost, $alterationValue, $rentAndRate) {
        $db = Database::getDB();
		$query = "UPDATE buildingdetails SET buildingCategory = '$category', buildingType = '$buildingType', landname = '$landname', acquisitiondate = '$acquisitiondate', area = '$area', feets = '$feets', constructionCost = '$constructionCost', alterationValue = '$alterationValue', rentAndRate = '$rentAndRate' WHERE id ='$id'";
		$count = $db->exec($query);
        return $count;
    }
	    public static function getDetailsUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and assetunit = '$assetunit' order by protocolOrder, counterID";
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
	public static function change_assets_unit_name($oldassetunit, $newassetunit, $identification) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET assetunit = '$newassetunit' WHERE assetunit ='$oldassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE buildingdetails SET identificationno = SUBSTRING(identificationno, 12) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE buildingdetails SET identificationno = CONCAT('$identification', identificationno) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		return $count;
		}
    public static function getDetailsUnitAll($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingdetails WHERE assetunit = '$assetunit' and isdelete = 0 order by protocolOrder, counterID";
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
        $query = "DELETE FROM buildingdetails WHERE assetunit = '$assetunit'";
        $count = $db->exec($query);
		return $count;
    }
	public static function summaryRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT sum(constructionCost) as tot FROM buildingdetails
                  WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function summaryRecords_2() {
        $db = Database::getDB();
        $query = "SELECT count(1) as cnt, sum(constructionCost) as tot FROM buildingdetails
                  WHERE fundtype = 0 and apprived = 1 and isdelete = 0";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = array($row['cnt'], $row['tot']);
        return $count;
    }
	public static function update_psos_allow($buildingCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE buildingCategory ='$buildingCategory'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Save_psos_allow($category, $identificationno) {
        $db = Database::getDB();
        $sql = "SELECT * FROM buildingclasification WHERE categoryName = '$category'";
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
		$query = "UPDATE buildingdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF', dam_controller = '$dam_controller' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecord_psos_allow() {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM buildingdetails WHERE ".$_SESSION['SESS_LAST_NAME']." = 1";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getBoard_report($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and isdelete = 0";
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." order by protocolOrder, counterID";
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
		$querytext = " fundtype = 0 and apprived = 1 and isdelete = 0";
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
		
		$query = "SELECT *, count(*) as cnt, sum(constructionCost) as tot, sum(alterationValue) as addtot FROM buildingdetails WHERE".$querytext." group by buildingCategory order by buildingCategory";		
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
    public static function getSummaryDetails_list($assetscenter, $assetunit, $inputField1, $inputField2, $categoryName) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and isdelete = 0 and buildingCategory = '$categoryName'";
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
		
		$query = "SELECT * FROM buildingdetails WHERE".$querytext."  order by protocolOrder, counterID";		
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
	public static function get_itemCategory_summary_date($categoryName, $acquisitiondate) {
		$db = Database::getDB();
		 $query = "SELECT count(*) as cnt, sum(constructionCost) as tot FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and buildingCategory = '$categoryName' and acquisitiondate <= '$acquisitiondate' order by buildingCategory";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	public static function get_itemCategory_summary_date_list($categoryName, $acquisitiondate) {
		$db = Database::getDB();
		 $query = "SELECT * FROM buildingdetails WHERE fundtype = 0 and apprived = 1 and isdelete = 0 and buildingCategory = '$categoryName' and acquisitiondate <= '$acquisitiondate' order by protocolOrder, counterID";
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
        $query = "UPDATE buildingdetails SET dam_controller = '$dam_controller' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getvreportById($id) {
        $db = Database::getDB();
        $query = "select vreport from buildingdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function put_vreport_path($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET vreport = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getInqDetails3($assetscenter, $assetunit) {
		$db = Database::getDB();
		$querytext = " assetscenter = '$assetscenter' and assetunit = '$assetunit'";
        $query = "SELECT * FROM buildingdetails WHERE".$querytext." order by identificationno";		
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
        $query = "SELECT count(1) as tot FROM buildingdetails
                  WHERE assetunit ='$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function change_unit_name($assetscenter, $assetunit, $assetscenter1, $assetunit1, $CentreID, $CentreIDold) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET assetscenter = '$assetscenter1', assetunit = '$assetunit1', identificationno = REPLACE(identificationno, '$CentreIDold', '$CentreID') WHERE assetunit ='$assetunit' and assetscenter = '$assetscenter'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Save_fundtype($fundtype, $identificationno) {
        $db = Database::getDB();
		$query = "UPDATE buildingdetails SET fundtype = '$fundtype' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function np_getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buildingdetails WHERE fundtype = 1 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID';
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
	    public static function np_getDetails_protocol($protocol, $text) {
        $db = Database::getDB();
        if ($protocol == 1) {
			$query = "SELECT * FROM buildingdetails WHERE protocoltext1 = '$text' and fundtype = 1 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID";
		} else if ($protocol == 2) {
			$query = "SELECT * FROM buildingdetails WHERE assetunit = '$text' and fundtype = 1 and apprived = 1 and isdelete = 0 order by protocolOrder, counterID";
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
    public static function np_getSearchText($column) {
        $db = Database::getDB();
        $query = "SELECT " . $column . " as col, assetscenter, assetunit, protocoltext1, protocoltext2, dam_controller FROM buildingdetails WHERE fundtype = 1 and apprived = 1 and isdelete = 0 order by " . $column . ", counterID";
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
	public static function np_getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and isdelete = 0";
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
			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." and ".$column." = '$search' order by protocolOrder, counterID";

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
    public static function np_getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and isdelete = 0";
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
			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." and ".$column." LIKE '%$search%' order by protocolOrder, counterID";

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
   public static function getInqDetails_unit($assetunit) {
        $db = Database::getDB();
		$querytext = " apprived = 1";
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }			
		$query = "SELECT * FROM buildingdetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET transferSelect = '$transferSelect', transferToCenter = '$transferToCenter', transferToUnit = '$transferToUnit', transferToDetails = '$transferToDetails', transferToDate = '$transferToDate' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function getItemsNotTransfered($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM buildingdetails WHERE transferToUnit ='$assetunit' and transferToConfirm = 1 and transfered = 0 order by protocolOrder, identificationno";
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
	public static function getItemsNotTransferConfirmed($assetunit) {
        $db = Database::getDB();
		$query = "SELECT * FROM buildingdetails WHERE assetunit = '$assetunit' and transferSelect = 1 and transfered = 0 order by protocolOrder, identificationno";
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
    public static function ConfirmTransferSave($id, $transferToConfirm) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET transferToConfirm = '$transferToConfirm' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function ConfirmTransferReject($id) {
        $db = Database::getDB();
        $query = "UPDATE buildingdetails SET transferSelect = 0, transferToConfirm = 0, transferToCenter = '', transferToUnit = '', transferToDetails = '', transferToDate = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
}
