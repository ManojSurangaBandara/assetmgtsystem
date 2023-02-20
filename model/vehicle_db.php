<?php

class VehicleDB {

    public static function getVehicle() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE isdelete = 0 order by protocolOrder, counterID';
        $result = $db->query($query);
        $result = array_filter($result, "Database::filterUnits");
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
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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

    public static function getFullDetailsUnit($assetunit) {
        $db = Database::getDB();
		$querytext = " assetunit = '$assetunit'";
        $query = "SELECT DISTINCT catalogueno FROM vehicledetails WHERE".$querytext." order by catalogueno";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	
    public static function getFullDetails_unit($assetunit) {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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

	public static function getPagingDetails($start_from, $per_page) {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and picpath IS NOT NULL AND TRIM(picpath) <> ''";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
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
        $query = "SELECT count(1) as tot FROM vehicledetails
                  WHERE identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addVehicle($vehicle) {
        $db = Database::getDB();

        $assetscenter = $vehicle->getAssetscenter();
        $assetunit = $vehicle->getAssetunit();
        $mainCategory = $vehicle->getMainCategory();
        $itemCategory = $vehicle->getItemCategory();
        $itemDescription = $vehicle->getItemDescription();
        $make = $vehicle->getMake();
        $modle = $vehicle->getModle();
        $assetsno = $vehicle->getAssetsno();
        $newAssestno = $vehicle->getNewAssestno();
        $catalogueno = $vehicle->getCatalogueno();
        $identificationno = $vehicle->getIdentificationno();
        $engineno = $vehicle->getEngineno();
        $chessisno = $vehicle->getChessisno();
        $yearManufacture = $vehicle->getYearManufacture();
        $ownerShip = $vehicle->getOwnerShip();
        $armyno = $vehicle->getArmyno();
        $civilno = $vehicle->getCivilno();
        $fuel = $vehicle->getFuel();
        $purchasedDate = $vehicle->getPurchasedDate();
        $unitValue = $vehicle->getUnitValue();
        $totalCost = $vehicle->getTotalCost();
        $horsePower = $vehicle->getHorsePower();
        $tare = $vehicle->getTare();
        $presentLocation = $vehicle->getPresentLocation();
        $receivedDate = $vehicle->GETReceivedDate();
        $Remarks = $vehicle->getRemarks();
        $counterId = $vehicle->getCounterId();
        $acquisitionInstitute = $vehicle->getAcquisitionInstitute();
	$natureOwnership = $vehicle->getnatureOwnership();
        $CapRepairCost = $vehicle->getCapitalRepairCost();
        $query = "INSERT INTO vehicledetails
            (assetscenter, assetunit, mainCategory, itemCategory, itemDescription, make, modle, assetsno, newAssestno, catalogueno, identificationno, engineno, chessisno, yearManufacture, ownerShip, armyno, civilno, fuel, purchasedDate, unitValue, totalCost, horsePower, tare, presentLocation, receivedDate, Remarks, counterId, acquisitionInstitute, natureOwnership, sysdate, CapRepairCost)
         VALUES
            ('$assetscenter', '$assetunit', '$mainCategory', '$itemCategory', '$itemDescription', '$make', '$modle', '$assetsno', '$newAssestno', '$catalogueno', '$identificationno', '$engineno', '$chessisno', '$yearManufacture', '$ownerShip', '$armyno', '$civilno', '$fuel', '$purchasedDate', '$unitValue', '$totalCost', '$horsePower', '$tare', '$presentLocation', '$receivedDate', '$Remarks', '$counterId', '$acquisitionInstitute', '$natureOwnership', now(), '$CapRepairCost')";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function getCounterId($assetunit) {
        $db = Database::getDB();
        $query = "select max(counterId) as tot from vehicledetails where assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function getItemsNotApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 0 and notapprived = 0  and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, counterId';
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
   public static function getItemsApproveRejected() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 0 and notapprived = 1 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, counterId';
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
    public static function getItemsApproved() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, counterId';
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
        $query = "select * from vehicledetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

    public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from vehicledetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }

	    public static function getDetailsByarmyno($id) {
        $db = Database::getDB();
        $query = "select * from vehicledetails where armyno = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	
    public static function ApproveDetails($id, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET apprived = 1, approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
public static function notApproveDetails($id, $login, $notapprivedReason) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET notapprived = 1, notapprivedReason = '$notapprivedReason', approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }  
    public static function getDisposalItems($catalogueno, $searchby, $search) {
        $db = Database::getDB();
        //$result = array();
        switch ($searchby) {
            case 'Army Number':
                $query = "SELECT id, armyno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and ApprovedDisposal = 0 and confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and armyno LIKE '%$search%'  order by armyno";
                break;
            case 'Civil Number':
                $query = "SELECT id, civilno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and ApprovedDisposal = 0 and confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and civilno LIKE '%$search%'  order by civilno";
                break;
            case 'Engine Number':
                $query = "SELECT id, engineno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and ApprovedDisposal = 0 and confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and engineno LIKE '%$search%'  order by engineno";
                break;
            case 'Chassis Number':
                $query = "SELECT id, chessisno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and and ApprovedDisposal = 0 confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and chessisno LIKE '%$search%'  order by chessisno";
                break;
            case 'Identification Number':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and ApprovedDisposal = 0 and confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' and identificationno LIKE '%$search%'  order by identificationno";
                break;
            case 'List All Items':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and selectDisposal = 0 and ApprovedDisposal = 0 and confirmDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' order by identificationno";
                break;
			default:
				$query = "";
                break;
        }
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }

        return $result;
    }

    public static function SelectDisposalSave($id, $selectDisposal, $disposedDate, $disposedReason, $condemnation, $destruction, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET selectDisposal = '$selectDisposal', disposedDate = '$disposedDate', disposedReason = '$disposedReason', condemnation = '$condemnation', destruction = '$destruction', selectDisposalPerson = '$login', selectDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function getToConfirmDisposalItems() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, counterId';
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


	public static function getApprovedConfirmedItems() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and confirmDisposal = 1 order by protocolOrder, counterId';
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

    public static function getSelectedDisposalItems() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, counterId';
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
    
	
    public static function ConfirmDisposalSave($id, $confirmDisposal, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET confirmDisposal = '$confirmDisposal', confirmDisposalPerson = '$login', confirmDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

	public static function ConfirmDisposalReject($id) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET selectDisposal = 0, confirmDisposal = 0, selectDisposalPerson = '', selectDisposalDate = '', confirmDisposalPerson = '', confirmDisposalDate = '', disposedDate = '', disposedReason = '', condemnation = '', destruction = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
    public static function getApproveDisposalItems($assetunit) {
        $db = Database::getDB();
        $query = "SELECT id, identificationno, assetscenter, assetunit FROM vehicledetails WHERE apprived = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' order by protocolOrder, counterId";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	    public static function getApproveDisposalItems_catlog($assetunit) {
        $db = Database::getDB();
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' group by assetscenter, assetunit, catalogueno order by protocolOrder, catalogueno";	       
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    
	public static function getApproveDisposalItems_catlog_2($assetunit, $catalogueno) {
        $db = Database::getDB();
		$query = "SELECT * FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' and catalogueno = '$catalogueno' order by identificationno";	       
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
		
    public static function ApproveDisposalSave($id, $ApprovedDisposal, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET ApprovedDisposal = '$ApprovedDisposal', ApprovedDisposalPerson = '$login', ApprovedDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function getDisposalDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 order by sorderwithcenter, counterId';
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
    
    public static function getDisposalDetailsPaging($start_from, $per_page) {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 order by sorderwithcenter, counterId LIMIT '.$start_from.', '.$per_page;
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
    
    public static function countTotalRecordsDisposalDetails() {
        $db = Database::getDB();
		//$querytext = "apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		//$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";        
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function deleteDetailsById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM vehicledetails WHERE id = '$id'";
        $db->exec($query);
    }

   public static function getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if ($inputField1 && $inputField1) {	
			$querytext = $querytext." and purchasedDate BETWEEN '$inputField1' AND '$inputField2'";}
			
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." and ".$column." LIKE '%$search%' order by protocolOrder, counterID";
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
 
   public static function getInqDetailsOnly($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if (!empty($assetscenter)) {
			if ($_SESSION['SESS_LEVEL'] == 2 || $_SESSION['SESS_LEVEL'] == 15 || $_SESSION['SESS_LEVEL'] == 25) {
			    $querytext = $querytext." and  protocoltext1 = '$assetscenter'";
		} else { 
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; 
		}}
		if 	(!empty($assetunit)) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if ($inputField1 && $inputField1) {	
			$querytext = $querytext." and purchasedDate BETWEEN '$inputField1' AND '$inputField2'";}
			
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." and ".$column." = '$search' order by protocolOrder, counterID";
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

 
   public static function getInqDisposalDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation) {
             $db = Database::getDB();
		if ($checkAllowType == 0 ) {
        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by protocolOrder, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by protocolOrder, counterId";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		}
		
		} elseif ($checkAllowType == 1 ) {
			if ($allocation == 1) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit = presentLocation and ".$column." LIKE '%$search%' order by protocolOrder, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit = presentLocation and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit = presentLocation and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit = presentLocation and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		}
		} elseif ($allocation == 2) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit != presentLocation and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and assetscenter = '$assetscenter' and ApprovedDisposal = 1 and assetunit != presentLocation and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit != presentLocation and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit != presentLocation and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		}
		} elseif ($allocation == 3) {
		if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and assetscenter = '$assetscenter' and ApprovedDisposal = 1 and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by identificationno";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		}
		
		}
		} elseif ($checkAllowType == 2 ) {
			if ($allocation == 1) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		}
		
		} elseif ($allocation == 2) {
		if ($assetunit == '') {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by sorderwithcenter, counterId";
        } else {
                $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";
            }
		} else {
		if ($inputField1 == '' || $inputField2 == '') {
            $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and  ApprovedDisposal = 1 and presentLocation = '$assetunit' and ".$column." LIKE '%$search%' order by identificationno";
        } else {
             $query = "SELECT * FROM vehicledetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and apprived = 1 and and ApprovedDisposal = 1 presentLocation = '$assetunit' and " . $column . " LIKE '%$search%' order by protocolOrder, counterId";   
            }
		} 
		            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            //$result = array_filter($result, "Database::filterCentre");
            return $result;
		}
		}
		
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
        $query = "SELECT ".$column." as col, assetscenter, assetunit, protocoltext1, protocoltext2, dam_controller FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by ".$column;
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
	
	    public static function getIsAllocation($assetscenter, $assetunit) {
        $db = Database::getDB();
		$count = 0;
        if ($assetscenter == $assetunit) {
			$query = "SELECT count(1) as tot FROM vehicledetails
                  WHERE assetunit = '$assetunit' and assetunit != presentLocation and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by sorderwithcenter, counterId";
			$result = $db->query($query);
			$row = $result->fetch();
			$count = ($row['tot'] > 0 ? 1 : 0);
		} else {
			$query = "SELECT count(1) as tot FROM vehicledetails
                  WHERE presentLocation = '$assetunit' and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by sorderwithcenter, counterId";
			$result = $db->query($query);
			$row = $result->fetch();
			$count = $row['tot'];
			$count = ($row['tot'] > 0 ? 2 : 0);
		}
        return $count;
    }
	   
	      public static function getAllocationDetails($assetunit) {
        $db = Database::getDB();
		$query = "SELECT * FROM vehicledetails
                  WHERE presentLocation = '$assetunit' and assetunit != '$assetunit' and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by sorderwithcenter, counterId";
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
	
		public static function ModificationAllows($id) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET apprived = 0 WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
		public static function Savesorderwithcenter($sorderwithcenter, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET sorderwithcenter = '$sorderwithcenter' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}

		public static function view_update($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = "";
		if ($assetscenter <> "") {
			$querytext = " where assetscenter = '$assetscenter'";
			if ($assetunit <> "") {
					$querytext = $querytext." and assetunit = '$assetunit'";
			}
		}
        //$query = 'SELECT * FROM landdetails WHERE apprived = 1 order by sorderwithcenter, counterID';
		$query = "SELECT * FROM vehicledetails".$querytext." order by protocolOrder, counterID";
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
        $query = "UPDATE vehicledetails SET view = 1, viewperson = '$login', viewdate = now(), damcomment = '$damcomment' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 	
	 public static function picpath($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET picpath = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 
    public static function getpicById($id) {
        $db = Database::getDB();
        $query = "select picpath from vehicledetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function getInqDetails2($assetscenter, $assetunit) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by sorderwithcenter, identificationno";		
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
    public static function getInqDetails3($assetscenter, $assetunit) {
		$db = Database::getDB();
		$querytext = " assetscenter = '$assetscenter' and assetunit = '$assetunit'";
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by identificationno";		
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
    public static function getNotConfirmDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }		
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by sorderwithcenter, identificationno";		
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
    public static function countRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM vehicledetails
                  WHERE assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function confirmRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM vehicledetails
                  WHERE apprived = 1 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }	
    public static function zero_value_Records($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM vehicledetails WHERE assetunit = '$assetunit' and apprived = 1 and ApprovedLoss = 0 and transfered = 0 and unitValue = 0 order by sorderwithcenter, counterID";
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
        $query = "UPDATE vehicledetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Savemakemodel($brandName, $modleName, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET brandName = '$brandName', modelName = '$modleName' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function mofifydata_grid_save($id, $engineno, $chessisno, $brandName, $modleName, $armyno, $purchasedDate, $receivedDate, $unitValue, $presentLocation, $natureOwnership) {
        $db = Database::getDB();
        if ($modleName == "") {
			$query = "UPDATE vehicledetails SET engineno = '$engineno', chessisno = '$chessisno', brandName = '$brandName', armyno = '$armyno', purchasedDate = '$purchasedDate', receivedDate = '$receivedDate', unitValue = '$unitValue', presentLocation = '$presentLocation', natureOwnership = '$natureOwnership' WHERE id ='$id'";
		} else {
			$query = "UPDATE vehicledetails SET engineno = '$engineno', chessisno = '$chessisno', brandName = '$brandName', modelName = '$modleName', armyno = '$armyno', purchasedDate = '$purchasedDate', receivedDate = '$receivedDate', unitValue = '$unitValue', presentLocation = '$presentLocation', natureOwnership = '$natureOwnership' WHERE id ='$id'";
		}
		 // $query = "UPDATE vehicledetails SET engineno = '$engineno', chessisno = '$chessisno', brandName = '$brandName', 	modelName = '$modleName' WHERE id ='$id'";
	   $count = $db->exec($query);
        return $count;
    }
	public static function getDetailsUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' order by protocolOrder, identificationno";
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
	public static function getSummaryDetailsCategory($itemDescription) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		if ($itemDescription) {
			$querytext = $querytext." and  itemDescription = '$itemDescription'"; }
				
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, mainCategory, catalogueno";		
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
    public static function getSummaryDetailsCategory2($itemDescription) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		if ($itemDescription) {
			$querytext = $querytext." and  itemCategory = '$itemDescription'"; }
				
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, mainCategory, catalogueno";		
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
	public static function armyno_duplicates() {
        $db = Database::getDB();
       // $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 0 order by protocolOrder, counterID';
       // $query = 'SELECT *, count(*) no_of_records FROM vehicledetails GROUP BY armyno HAVING count(*) > 1';
		$query = 'SELECT * FROM vehicledetails
   INNER JOIN (SELECT armyno
               FROM   vehicledetails
               GROUP  BY armyno
               HAVING COUNT(id) > 1) dup
           ON vehicledetails.armyno = dup.armyno';
		
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
        $query = "UPDATE vehicledetails SET assetunit = '$newassetunit' WHERE assetunit ='$oldassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE vehicledetails SET identificationno = SUBSTRING(identificationno, 12) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE vehicledetails SET identificationno = CONCAT('$identification', identificationno) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		return $count;
		}
    public static function getDetailsUnitAll($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM vehicledetails WHERE assetunit = '$assetunit' order by protocolOrder, counterID";
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
        $query = "DELETE FROM vehicledetails WHERE assetunit = '$assetunit'";
        $count = $db->exec($query);
		return $count;
    }
	public static function summaryRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT sum(unitValue) as tot FROM vehicledetails
                  WHERE apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function summaryRecords_2() {
        $db = Database::getDB();
        $query = "SELECT count(1) as cnt, sum(unitValue) as tot FROM vehicledetails
                  WHERE apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = array($row['cnt'], $row['tot']);
        return $count;
    }
    public static function getFullDetails_ledger() {
        $db = Database::getDB();
        $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, mainCategory, counterID';
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
	public static function get_itemCategory_summary_1() {
	$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by itemCategory order by mainCategory, itemCategory, catalogueno";		
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
	}
	public static function get_catalogueno_summary($catalogueno) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
		public static function get_catalogueno_summary_1() {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by catalogueno order by mainCategory, itemCategory, catalogueno";		
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
	public static function get_catalogueno_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	}
    public static function getSummaryDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }		
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetscenter, assetunit, catalogueno order by protocolOrder, catalogueno";		
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
    public static function getSummaryDetails2($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }		
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetscenter, assetunit, itemCategory order by protocolOrder, itemCategory";		
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
    public static function getSummaryDetails3($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }		
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetscenter, assetunit, mainCategory order by protocolOrder, mainCategory";		
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
	public static function get_itemCategory_summary($itemCategory) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	
	public static function get_itemCategory_summary_date($itemCategory, $receivedDate) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory' and receivedDate <= '$receivedDate'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	
		public static function get_catalogueno_summary_1_unit($catalogueno) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function get_catalogueno_summary_2_unit($protocol, $assetunit, $catalogueno) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit' and catalogueno = '$catalogueno'";
		} else if ($protocol == 2) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'  and catalogueno = '$catalogueno'";
		}
		$querytext = Database::unitsFilter($querytext);			
		if ($protocol == 1) {
			$query = "SELECT assetunit, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";	
		} else if ($protocol == 2) {
			$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by counterID";			
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
	}
	public static function get_catalogueno_unit_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	}
	public static function get_catalogueno_unit_summary_3($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and and ApprovedLoss = 0 and transfered = 0 itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and and ApprovedLoss = 0 and transfered = 0 itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	}
	public static function update_psos_allow($itemCategory, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE itemCategory ='$itemCategory'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Save_psos_allow($type, $itemCategory, $identificationno) {
        $db = Database::getDB();
        $sql = "SELECT * FROM itemcategory WHERE itemCategory = '$itemCategory' and type = '$type'";
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
			$DAMPS = $row['DAMPS'];			
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
		$query = "UPDATE vehicledetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF', dam_controller = '$dam_controller' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecord_psos_allow() {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM vehicledetails WHERE ".$_SESSION['SESS_LAST_NAME']." = 1";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function ca_no_err_list() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT vehicledetails.* FROM vehicledetails JOIN classificationlist ON vehicledetails.catalogueno = classificationlist.catalogueno and  vehicledetails.itemDescription != classificationlist.itemDescription order by protocolOrder, identificationno";
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
    public static function loss_select_save($id, $selectLoss, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET selectLoss = '$selectLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function Selected_Items_For_loss() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	 public static function Selected_Items_For_Confirm_loss() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function loss_confirm_save($id, $confirmLoss, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET confirmLoss = '$confirmLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function loss_reject_save($id) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET selectLoss = 0, confirmLoss = 0, selectLossPerson = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	 public static function approve_Items_For_loss() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and confirmLoss = 1 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function loss_approve_save($id, $ApprovedLoss, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET ApprovedLoss = '$ApprovedLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getDetails_lost() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	public static function Loss_Inquiry($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
	    $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1";
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
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }
			$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function save_loss_details($id, $lossedDate, $lossedReason) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET lossedDate = '$lossedDate', lossedReason = '$lossedReason' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	 public static function min_max_values() {
        $db = Database::getDB();
		//$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and ApprovedLoss = 0";
		//$querytext = Database::unitsFilter($querytext);
        $query = "SELECT mainCategory, itemCategory, itemDescription, catalogueno, max(unitValue) as mx, min(unitValue) as mn FROM vehicledetails group by catalogueno order by catalogueno";
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
    public static function getFullDetails_photo() {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and picpath IS NOT NULL AND TRIM(picpath) <> ''";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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
	public static function countTotalRecords() {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and picpath IS NOT NULL AND TRIM(picpath) <> ''";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
        $query = "SELECT count(*) as tot FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function record_status($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = "";
		if ($assetscenter <> "") {
			$querytext = " where assetscenter = '$assetscenter'";
			if ($assetunit <> "") {
					$querytext = $querytext." and assetunit = '$assetunit'";
			}
		}
        $query = "SELECT * FROM vehicledetails".$querytext." order by protocolOrder, identificationno";
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
    }
	public static function getBoard_report($assetscenter, $assetunit) {
        $db = Database::getDB();
	    $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
			$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function get_send_ordinance() {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 1 and confirm_receive_ordinance = 0";
		//if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); 
		// }
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function send_ordinance_save($id, $selectLoss, $ordinance_send_date, $ordinance) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET select_send_ordinance = '$selectLoss', ordinance_send_date = '$ordinance_send_date', ordinance = '$ordinance' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function get_receive_ordinance($assetunit) {
        $db = Database::getDB();
        $querytext = " assetunit = '$assetunit' and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 0";
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function receive_ordinance_save($id, $selectLoss, $ordinance_receive_date) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET confirm_receive_ordinance = '$selectLoss', ordinance_receive_date = '$ordinance_receive_date' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function ordinance_received_details($ordinance, $assetunit, $id) {
        $db = Database::getDB();
        if ($id == 1) {
			$querytext = " ordinance = '$ordinance' and assetunit = '$assetunit' and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 2) {
			$querytext = " ordinance = '$ordinance' and protocoltext1 = '$assetunit' and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 3) {
			$querytext = " ordinance = '$ordinance' and protocoltext2 = '$assetunit' and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 4) {
			$querytext = " ordinance = '$ordinance' and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		}
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getSummaryDetails_age($date1, $date2) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext." and (purchasedDate BETWEEN '$date1' AND '$date2')";	
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
    public static function getSummaryDetails_age_perid($date1, $date2) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext." and (purchasedDate BETWEEN '$date1' AND '$date2')";	
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
    public static function getSummaryDetails_age_perid_unit_item($date1, $date2, $assetunit, $catalogueno) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext." and (purchasedDate BETWEEN '$date2' AND '$date1')";
		$querytext = $querytext." and assetunit = '$assetunit' and catalogueno = '$catalogueno'";
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by catalogueno";
		//$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
    public static function getSummaryDetails_age_perid_item($date1, $date2, $catalogueno) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext." and (purchasedDate BETWEEN '$date2' AND '$date1')";
		$querytext = $querytext." and catalogueno = '$catalogueno'";
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, catalogueno";
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
    public static function monthly_changes($year, $month, $ignore_month) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(purchasedDate) = '$year' and month(purchasedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(purchasedDate) = '$year'";	
		}
				
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_dis($year, $month, $ignore_month) {
		$db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(disposedDate) = '$year' and month(disposedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(disposedDate) = '$year'";
		}
				
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, catalogueno";		
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
        $query = "UPDATE vehicledetails SET dam_controller = '$dam_controller' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
	public static function update_cigas_1($catalogueno, $cigas_assetno, $newAssestno) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET cigas_assetno = '$cigas_assetno', newAssestno = '$newAssestno' WHERE catalogueno ='$catalogueno' and cigas_idno = ''";
        $count = $db->exec($query);
        return $count;
		}
    public static function update_cigas_2() {
        $db = Database::getDB();
        $query = "SELECT id, cigas_assetno FROM vehicledetails WHERE cigas_idno = '' order by cigas_assetno, protocolOrder, id";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function update_cigas_3($id, $cigas_idno) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET cigas_idno = '$cigas_idno', cigas_transferdate = CURDATE() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getFullDetails_cigas() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedLoss = 0 and transfered = 0 and mainCategory <>'A VEHICLE'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM vehicledetails WHERE".$querytext." order by cigas_assetno, protocolOrder, id";
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
    public static function getDisposalDetailsUnit($unit, $type) {
        $db = Database::getDB();
		$querytext = " where apprived = 1 and ApprovedDisposal = 1";
		if ($type == 2) {
			$querytext = $querytext." and protocoltext1 = '$unit'";
		} elseif ($type == 3) {	
			$querytext = $querytext." and protocoltext2 = '$unit'";
		} elseif ($type == 4) {
			$querytext = $querytext." and assetunit = '$unit'";
        } elseif ($type == 0) {
			$querytext = $querytext." and assetunit = ''";
        }
		$query = "SELECT * FROM vehicledetails".$querytext." order by protocolOrder, identificationno";
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
	public static function get_catalogueno_summary_2_undo($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM vehicledetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	}
    public static function Selected_Items_For_displayvehicle() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	 public static function Selected_Items_For_Confirm_displayvehicle() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	 public static function approve_Items_For_displayvehicle() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 2 and confirmLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function getDetails_displayvehicle() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	public static function displayvehicle_Inquiry($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
	    $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 2";
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
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }
			$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function cigas_nottransfer_list() {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and cigas_idno = ''";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function cigas_2018_pruchase_list() {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and year(purchasedDate) = '2018'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function getCatalogue_cigas_getmaxno($cigas_assetno) {
        $db = Database::getDB();
		$query = "SELECT id, cigas_assetno, cigas_idno FROM vehicledetails WHERE cigas_assetno = '$cigas_assetno' order by id DESC";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$maxno = 0;
			foreach ($result as $exp) {
 				if (strlen($exp['cigas_idno']) > 0) {
				$myArray = explode('-', $exp['cigas_idno']);
				if ($maxno < $myArray[1]) {
					$maxno = $myArray[1];
				} 
			}
			}
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $maxno;
    }
    public static function getFullDetails_cigas_date() {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedLoss = 0 and transfered = 0 and mainCategory <>'A VEHICLE' and cigas_transferdate = CURDATE()";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM vehicledetails WHERE".$querytext." order by cigas_assetno, protocolOrder, id";
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
 public static function RejectDisposalSave($id) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET confirmDisposal = 0, selectDisposal = 0 WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
   public static function getInqDetailsforTransfer($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
				if (!empty($assetscenter)) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET transferSelect = '$transferSelect', transferToConfirm = '$transferSelect', transferToCenter = '$transferToCenter', transferToUnit = '$transferToUnit', transferToDetails = '$transferToDetails', transferToDate = '$transferToDate' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
	public static function getItemsNotTransfered($assetunit) {
        $db = Database::getDB();
        $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and transferToConfirm = 1 and transferToUnit = '$assetunit'";
		$query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterID";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            //$result = array_filter($result, "Database::filterUnits");
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function MarkasTransfer($identificationnoTem, $assetunit, $tassetscenter, $tassetunit, $identificationno, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET transfered = 1, transferReceiveidentificationno = '$identificationno' WHERE identificationno ='$identificationnoTem'";
        $count1 = $db->exec($query);
        $query = "UPDATE vehicledetails SET presentLocation = '$assetunit', apprived = 1, approvedPerson = '$login', apprivedDate = now() WHERE identificationno ='$identificationno'";
        $count2 = $db->exec($query);       
		return $count1 + $count2;
		}
	public static function Save_cigas($cigas_assetno, $cigas_idno, $cigas_transferdate, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET cigas_assetno = '$cigas_assetno', cigas_idno = '$cigas_idno', cigas_transferdate = '$cigas_transferdate' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
/* 	public static function getItemsNotTransfered($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM vehicledetails WHERE transferToUnit = '$assetunit' and transfered = 0 order by protocolOrder, identificationno";
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
    }	 */
    public static function disposal_select_save_quick($id, $selectDisposal, $login) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET selectDisposal = '$selectDisposal', selectDisposalPerson = '$login', selectDisposalDate = now() WHERE id ='$id'";
		$count = $db->exec($query);
        return $count;
    }
    public static function disposal_details_save_quick($id, $disposedDate, $disposedReason, $condemnation) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET disposedDate = '$disposedDate', disposedReason = '$disposedReason', condemnation = '$condemnation' WHERE id ='$id'";
		$count = $db->exec($query);
        return $count;
    }
    public static function Confirmed_For_Disposal() {
        $db = Database::getDB();
       $query = 'SELECT * FROM vehicledetails WHERE apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
    public static function getvreportById($id) {
        $db = Database::getDB();
        $query = "select vreport from vehicledetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function put_vreport_path($id, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET vreport = '$Filename' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function disposal_details_save_quick_all($assetunit, $disposedDate, $disposedReason, $condemnation) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET disposedDate = '$disposedDate', disposedReason = '$disposedReason', condemnation = '$condemnation' WHERE assetunit = '$assetunit' and apprived = 1 and selectDisposal = 1 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0";
		$count = $db->exec($query);
        return $count;
    }
	public static function add_Board_report($assetunit) {
        $db = Database::getDB();
	    $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit'";
		$query = "SELECT catalogueno, SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM vehicledetails WHERE".$querytext." GROUP BY catalogueno order by catalogueno";
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
	public static function add_Board_report_disposal($assetunit, $currentYear, $catalogueno) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' and YEAR(disposedDate) = '$currentYear' and  assetunit = '$assetunit'";
        $query = "SELECT SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function add_Board_report_new($assetunit, $currentYear, $catalogueno) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' and YEAR(receivedDate) = '$currentYear' and  assetunit = '$assetunit'";
        $query = "SELECT SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM vehicledetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function board_report_summary_view_details($id){
        $db = Database::getDB();
		$query = "SELECT ids_array FROM board_report_summary WHERE id = '$id'";
		$result = $db->query($query);
        $row = $result->fetch();
		$query = "SELECT * FROM vehicledetails WHERE id in (".$row['ids_array'].")";
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
	public static function change_unit_name($assetscenter, $assetunit, $assetscenter1, $assetunit1, $CentreID, $CentreIDold) {
        $db = Database::getDB();
        $query = "UPDATE vehicledetails SET assetscenter = '$assetscenter1', assetunit = '$assetunit1', presentLocation = '$assetunit1', identificationno = REPLACE(identificationno, '$CentreIDold', '$CentreID') WHERE assetunit ='$assetunit' and assetscenter = '$assetscenter'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecordUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM vehicledetails
                  WHERE assetunit ='$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getDisposalDetails_year($assetunit, $currentYear) {
        $db = Database::getDB();
        $query = "SELECT * FROM vehicledetails WHERE apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and LEFT(disposedDate, 4) = '$currentYear' order by identificationno";
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
    public static function getNewDetails_year($assetunit, $currentYear) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' and LEFT(receivedDate, 4) = '$currentYear'";
        $query = "SELECT * FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	public static function allocation_list($assetunit) {
        $db = Database::getDB();
	    $querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit'";
		$query = "SELECT catalogueno, mainCategory, itemCategory, itemDescription, COUNT(*) as cnt 
		FROM vehicledetails 
		WHERE".$querytext." GROUP BY catalogueno order by catalogueno";
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
	public static function allocation_list_assetunit_catalogueno($assetunit, $catalogueno) {
        $db = Database::getDB();
		$querytext = " apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit' and  catalogueno = '$catalogueno'";
		$query = "SELECT COUNT(*) as cnt 
		FROM vehicledetails 
		WHERE".$querytext ;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['cnt'];
        return $count;
    } 
    public static function getItemsNotApproved_unit($assetunit, $fundtype) {
        $db = Database::getDB();
		$querytext = " apprived = 0 and notapprived = 0 and ApprovedLoss = 0 and transfered = 0 and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, id FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterId";
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
               // if ($id != $data['groupId']) {
                    $result[] = array($data['identificationno'], $data['id']);
                   // $id = $data['groupId'];
              //  }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getItemsApproveRejected_unit($assetunit, $fundtype) {
        $db = Database::getDB();
		$querytext = " apprived = 0 and notapprived = 1 and ApprovedLoss = 0 and transfered = 0 and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, id FROM vehicledetails WHERE".$querytext." order by protocolOrder, counterId";
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
				$result[] = array($data['identificationno'], $data['id']);
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getItemsNotTransfered_unit($assetunit, $fundtype) {
        $db = Database::getDB();
		$querytext = " transferToUnit ='$assetunit' and transferToConfirm = 1 and transfered = 0 and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, id FROM vehicledetails WHERE".$querytext." order by protocolOrder, identificationno";
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                $result[] = array($data['identificationno'], $data['id']);
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getHasArmyno($armyno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM vehicledetails
                  WHERE armyno = '$armyno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    } 	
}
