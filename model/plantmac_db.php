<?php

class PlantMacDB {

    public static function getPlantMac() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmacdetails WHERE ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
        $result = $db->query($query);
        $result = array_filter($result, "Database::filterUnits");
        $lands = array();
        foreach ($result as $row) {
            $land = new Land(
                    $row['assetscenter'], $row['assetunit'], $row['province'], $row['district'], $row['dsDivision'], $row['gsDivision'], $row['category'], $row['assetsno'], $row['classificationno'], $row['identificationno'], $row['register'], $row['landname'], $row['natureOwnership'], $row['ownership'], $row['planno'], $row['deedno'], $row['deeddate'], $row['landNature'], $row['areaMeasure'], $row['area'], $row['estimatedValue'], $row['acquisitiondate'], $row['remarks'], $row['counterId']);
            $lands[] = $land;
        }
        return $lands;
    }

    public static function getFullDetails() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 order by protocolOrder, identificationno';
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
        $query = "SELECT DISTINCT catalogueno FROM plantmacdetails WHERE".$querytext." order by catalogueno";
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
	
	    public static function getFullDetails_maincat($mainCategory) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and mainCategory = '$mainCategory'";
		$querytext = Database::unitsFilter($querytext);
		$selection = "assetunit, identificationno, itemCategory, itemDescription, assetsno, catalogueno, eqptSriNo, presentLocation, purchasedDate, receivedDate, unitValue";
        $query = "SELECT ".$selection." FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 order by protocolOrder, identificationno';
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 order by protocolOrder, identificationno';
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
	
    public static function getHasRecord($plantMac) {
        $db = Database::getDB();
        $identificationno = $plantMac->getIdentificationno();
        $query = "SELECT count(1) as tot FROM plantmacdetails
                  WHERE identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getHasRecordS($identificationnos) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM plantmacdetails
                  WHERE identificationno = '$identificationnos'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addPlantMac($plantMac) {
        $db = Database::getDB();

        $assetscenter = $plantMac->getAssetscenter();
        $assetunit = $plantMac->getAssetunit();
        $mainCategory = $plantMac->getMainCategory();
        $itemCategory = $plantMac->getItemCategory();
        $itemDescription = $plantMac->getItemDescription();
        $assetsno = $plantMac->getAssetsno();
        $newAssestno = $plantMac->getNewAssestno();
        $catalogueno = $plantMac->getCatalogueno();
        $identificationno = $plantMac->getIdentificationno();
        $ledgerno = $plantMac->getLedgerno();
        $ledgerFoliono = $plantMac->getLedgerFoliono();
        $eqptSriNo = $plantMac->getEqptSriNo();
        $purchasedDate = $plantMac->getPurchasedDate();
        $quantity = $plantMac->getQuantity();
        $capacity = $plantMac->getCapacity();
        $unitValue = $plantMac->getUnitValue();
        $totalCost = $plantMac->getTotalCost();
        $receivedDate = $plantMac->GETReceivedDate();
        $Remarks = $plantMac->getRemarks();
        $counterId = $plantMac->getCounterId();
        $groupId = $plantMac->getGroupId();
        $groupQty = $plantMac->getGroupQty();
        $presentLocation = $plantMac->getpresentLocation();
        $acquisitionInstitute = $plantMac->getAcquisitionInstitute();
		$natureOwnership =  $plantMac->getnatureOwnership();
        $query = "INSERT INTO plantmacdetails
            (assetscenter, assetunit, mainCategory, itemCategory, itemDescription, assetsno, newAssestno, catalogueno, identificationno, ledgerno, ledgerFoliono, eqptSriNo, purchasedDate, quantity, capacity, unitValue, totalCost, receivedDate, Remarks, counterId, groupId, groupQty, presentLocation, acquisitionInstitute, natureOwnership, sysdate)
         VALUES
        ('$assetscenter', '$assetunit', '$mainCategory', '$itemCategory', '$itemDescription', '$assetsno', '$newAssestno', '$catalogueno', '$identificationno', '$ledgerno', '$ledgerFoliono', '$eqptSriNo', '$purchasedDate', '$quantity', '$capacity', '$unitValue', '$totalCost', '$receivedDate', '$Remarks', '$counterId', '$groupId', '$groupQty', '$presentLocation', '$acquisitionInstitute', '$natureOwnership', now())";
        $row_count = $db->exec($query);
        return $row_count;
    }

	public static function addPlantMacTransfer($assetscenter, $assetunit, $assetscenterFrom, $assetunitFrom, $identificationnofrom, $identificationnos, $receivedDate, $presentLocation, $Remarks, $counterId, $groupId) {
        $db = Database::getDB();
		$row = PlantMacDB::getDetailsByIdentificationno($identificationnofrom);
			$query = "INSERT INTO plantmacdetails
            (assetscenter, assetunit, mainCategory, itemCategory, itemDescription, assetsno, newAssestno, catalogueno, identificationno, ledgerno, ledgerFoliono, eqptSriNo, purchasedDate, quantity, capacity, unitValue, totalCost, receivedDate, Remarks, counterId, groupId, groupQty, presentLocation, acquisitionInstitute, transferReceivecenter, transferReceiveunit, transferReceiveidentificationno, sysdate)
 VALUES ('".$assetscenter."', '".$assetunit."', '".$row['mainCategory']."', '".$row['itemCategory']."', '".$row['itemDescription']."', '".$row['assetsno']."', '".$row['newAssestno']."', '".$row['catalogueno']."', '".$identificationnos."', '".$row['ledgerno']."', '".$row['ledgerFoliono']."', '".$row['eqptSriNo']."', '".$row['purchasedDate']."', '".$row['quantity']."', '".$row['capacity']."', '".$row['unitValue']."', '".$row['totalCost']."', '".$receivedDate."', '".$Remarks."', '".$counterId."', '".$groupId."', 1, '".$presentLocation."', '".$row['acquisitionInstitute']."', '".$assetscenterFrom."', '".$assetunitFrom."', '".$identificationnofrom."', now())";
      
	//	$query = "INSERT INTO plantmacdetails
    //        (assetscenter, assetunit, mainCategory, itemCategory, itemDescription, assetsno, newAssestno, catalogueno, identificationno, ledgerno, ledgerFoliono, eqptSriNo, purchasedDate, quantity, capacity, unitValue, totalCost, receivedDate, Remarks, counterId, groupId, groupQty, presentLocation, acquisitionInstitute, transferReceivecenter, transferReceiveunit, transferReceiveidentificationno, sysdate)
    //     VALUES
    //    ('$row['assetscenter']', '$row['assetunit']', '$row['mainCategory']', '$row['itemCategory']', '$row['itemDescription']', '$row['assetsno']', '$row['newAssestno']', '$row['catalogueno']', '$row['identificationno']', '$row['ledgerno']', '$row['ledgerFoliono']', '$row['eqptSriNo']', '$row['purchasedDate']', '$row['quantity']', '$row['capacity']', '$row['unitValue']', '$row['totalCost']', '$receivedDate', '$Remarks', '$counterId', 0, 0, '$presentLocation', '$row['acquisitionInstitute']', '$assetscenterFrom', '$assetunitFrom', '$identificationnofrom', now())";
        $row_count = $db->exec($query);
		if ($row_count == 1) {
			$query = "UPDATE plantmacdetails SET transfered = 1, transferReceivecenter = '$assetscenterFrom', transferReceiveunit = '$assetunitFrom', transferReceiveidentificationno = '$identificationnofrom' WHERE id = ".$row['id'];
			$count = $db->exec($query);
			$row_count = $row_count + $count;
		}
        return $row_count;
	}

	public static function addPlantMacTransferDetails($assetscenter, $assetunit, $id, $transferReceiveidentificationno) {
        $db = Database::getDB();
		$query = "UPDATE plantmacdetails SET transfered = 1, transferReceivecenter = '$assetscenter', transferReceiveunit = '$assetunit', transferReceiveidentificationno = '$transferReceiveidentificationno' WHERE id = '$id'";
		$count = $db->exec($query);
        return $count;
	}	
	
    public static function getCounterId($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "select max(counterId) as tot from plantmacdetails where assetunit = '$assetunit' and catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function getGroupId() {
        $db = Database::getDB();
        $query = 'select max(groupId) as tot from plantmacdetails';
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        $count = $count + 1;
        return $count;
    }

    public static function getItemsNotApproved() {
        $db = Database::getDB();
		$querytext = " apprived = 0 and notapprived = 0 and transferReceivecenter is NULL";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, groupId, assetunit, assetscenter FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
       // $query = 'SELECT * FROM plantmacdetails WHERE apprived = 0  and notapprived = 0 and transfered = 0 and transferReceiveidentificationno IS NULL order by groupId, counterId';
        //$query = 'SELECT * FROM plantmacdetails WHERE apprived = 0  and notapprived = 0 order by protocolOrder, identificationno';
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = array($data['identificationno'], $data['groupId']);
                    ;
                    $id = $data['groupId'];
                }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }

    public static function getItemsNotApproved_unit($assetunit, $fundtype) {
        $db = Database::getDB();
		$querytext = " apprived = 0 and notapprived = 0 and transferReceivecenter is NULL and assetunit = '$assetunit' and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, groupId, assetunit, assetscenter FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    $result[] = array($data['identificationno'], $data['groupId']);
                    $id = $data['groupId'];
                }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	
    public static function deleteItemsNotApproved() {
        $db = Database::getDB();
        $querytext = " apprived = 0 and notapprived = 0 and transferReceivecenter is NULL";
		$querytext = Database::unitsFilter($querytext);
		$query = "DELETE FROM plantmacdetails WHERE".$querytext;
        $db->exec($query);
    }

    public static function deleteItemsRejected() {
        $db = Database::getDB();
        $querytext = " apprived = 0 and notapprived = 1 and transferReceivecenter is NULL";
		$querytext = Database::unitsFilter($querytext);
		$query = "DELETE FROM plantmacdetails WHERE".$querytext;
        $db->exec($query);
    }
	
	public static function getItemsNotApprovedTransfer() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmacdetails WHERE apprived = 0 and notapprived = 0 and transfered = 0 and transferReceiveidentificationno IS NOT NULL order by protocolOrder, identificationno';
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $result = array_filter($result, "Database::filterUnits");
          /*  $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = array($data['identificationno'], $data['groupId']);
                    ;
                    $id = $data['groupId'];
                }
            } */
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getItemsApproveRejected() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM plantmacdetails WHERE apprived = 0  and notapprived = 1 and transfered = 0 order by groupId, counterId';
			$query = 'SELECT * FROM plantmacdetails WHERE apprived = 0  and notapprived = 1 order by protocolOrder, identificationno';
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = array($data['identificationno'], $data['groupId']);
                    ;
                    $id = $data['groupId'];
                }
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
		$querytext = " apprived = 0 and notapprived = 1 and transferReceivecenter is NULL and assetunit = '$assetunit' and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, groupId, assetunit, assetscenter FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
		try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    $result[] = array($data['identificationno'], $data['groupId']);
                    $id = $data['groupId'];
                }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    } 


 public static function getItemsApproved() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1  and ApprovedDisposal = 0 and transfered = 0 order by identificationno';
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1  and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
        $query = "select * from plantmacdetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        // $count = $row['tot'];
        return $row;
    }

    public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from plantmacdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    public static function getDetailsByIdentificationnoGroup($identificationno) {
        $db = Database::getDB();
        $query = "select * from plantmacdetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['groupId'];
        $query = "SELECT * FROM plantmacdetails WHERE groupID = '$count' order by counterId";
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

    public static function ApproveDetails($id, $login) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET apprived = 1, approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function notApproveDetails($id, $login, $notapprivedReason) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET notapprived = 1, notapprivedReason = '$notapprivedReason', approvedPerson = '$login', apprivedDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    } 
    public static function getDisposalItems($catalogueno, $searchby, $search) {
        $db = Database::getDB();
        //$result = array();
		$query = "";
        switch ($searchby) {
		
            case 'Serial Number':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transferSelect = 0 and transfered = 0 and eqptSriNo LIKE '%$search%' order by protocolOrder, identificationno";
                break;
            case 'Ledger Number':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transferSelect = 0 and transfered = 0 and ledgerno LIKE '%$search%' order by protocolOrder, identificationno";
                break;
            case 'Identification Number':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transferSelect = 0 and transfered = 0 and identificationno LIKE '%$search%' order by protocolOrder, identificationno";
                break;
            case 'List All Items':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transferSelect = 0 and transfered = 0 and catalogueno = '$catalogueno' order by protocolOrder, identificationno";
                break;
				
			/*case 'Serial Number':
                $query = "SELECT id, eqptSriNo as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and catalogueno = '$catalogueno' and eqptSriNo LIKE '%$search%'  order by identificationno";
                break;
            case 'Ledger Number':
                $query = "SELECT id, ledgerno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and catalogueno = '$catalogueno' and ledgerno LIKE '%$search%'  order by identificationno";
                break;
            case 'Identification Number':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and catalogueno = '$catalogueno' and identificationno LIKE '%$search%'  order by identificationno";
                break;
            case 'List All Items':
                $query = "SELECT id, identificationno as searchKey, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and catalogueno = '$catalogueno' order by identificationno";
                break;*/
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

    public static function SelectDisposalSave($id, $selectDisposal, $disposedDate, $disposedReason, $login, $condemnation, $destruction) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET selectDisposal = '$selectDisposal', disposedDate = '$disposedDate', disposedReason = '$disposedReason', selectDisposalPerson = '$login', condemnation = '$condemnation', destruction = '$destruction', selectDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
    public static function SelectTransferSave($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate, $login) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transferSelect = '$transferSelect', transferToCenter = '$transferToCenter', transferToUnit = '$transferToUnit', transferToDetails = '$transferToDetails', transferToDate = '$transferToDate' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }	

    public static function getConfirmDisposalItems() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 order by assetscenter, assetunit';
       $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
    
	public static function ConfirmDisposalReject($id) {
        $db = Database::getDB();
        //$query = "UPDATE plantmacdetails SET selectDisposal = 0, confirmDisposal = 0 WHERE id ='$id'";
        $query = "UPDATE plantmacdetails SET selectDisposal = 0, confirmDisposal = 0, selectDisposalPerson = '', selectDisposalDate = '', confirmDisposalPerson = '', confirmDisposalDate = '', disposedDate = '', disposedReason = '', condemnation = '', destruction = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
    public static function getSelectedDisposalItems() {
        $db = Database::getDB();
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
		$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
 
    public static function getSelectedTransferItems() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and transferSelect = 1 and transferToConfirm = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
	
    public static function getToConfirmDisposalItems() {
        $db = Database::getDB();
       // $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 order by assetscenter, assetunit';
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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

    public static function getToConfirmDisposalItemsSort() {
        $db = Database::getDB();
       // $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 order by assetscenter, assetunit';
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, confirmDisposal, identificationno';
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
	
   public static function getToConfirmTransferItems() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and transferSelect = 1 and transfered = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
        //$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 and confirmDisposal = 1 order by assetscenter, assetunit';
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and confirmDisposal = 1 order by protocolOrder, identificationno';
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
        $query = "UPDATE plantmacdetails SET confirmDisposal = '$confirmDisposal', confirmDisposalPerson = '$login', confirmDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function ConfirmTransferSave($id, $confirmDisposal, $login) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transferToConfirm = '$confirmDisposal' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	
    public static function getApproveDisposalItems($assetunit) {
        $db = Database::getDB();
        //$query = "SELECT id, identificationno, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 and assetunit = '$assetunit' order by identificationno";
        $query = "SELECT id, identificationno, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' order by protocolOrder, identificationno";
		//$query = 'SELECT id, identificationno, assetscenter, assetunit FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0';
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
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' group by assetscenter, assetunit, catalogueno order by protocolOrder, catalogueno";	       
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
		$query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' and catalogueno = '$catalogueno' order by identificationno";	       
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
        $query = "UPDATE plantmacdetails SET ApprovedDisposal = '$ApprovedDisposal', ApprovedDisposalPerson = '$login', ApprovedDisposalDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }

    public static function getDisposalDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 order by protocolOrder, identificationno';
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
        $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 order by protocolOrder, identificationno LIMIT '.$start_from.', '.$per_page;
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;        
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function deleteDetailsByGroupId($groupId) {
        $db = Database::getDB();
        $query = "DELETE FROM plantmacdetails WHERE groupId = '$groupId'";
        $count = $db->exec($query);
        return $count;
    }

	public static function deleteDetailsById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM plantmacdetails WHERE id = '$id'";
        $db->exec($query);
    }
	
	public static function getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2, $checkAllowType, $allocation) {
        $db = Database::getDB();
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
		if ($checkAllowType == 1 ) {
			if ($allocation == 1) {
				$querytext = $querytext." and and assetunit = presentLocation";}
			if ($allocation == 2) {
				$querytext = $querytext." and and assetunit != presentLocation";}	
			}
		if ($checkAllowType == 2 ) {
			if ($allocation == 2) {
			$querytext = $querytext." and presentLocation = '$assetunit'";}
			}
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
            }
		}
		
		} elseif ($checkAllowType == 1 ) {
			if ($allocation == 1) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit = presentLocation and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit = presentLocation and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit = presentLocation and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit = presentLocation and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
            }
		}
		} elseif ($allocation == 2) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and assetunit != presentLocation and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and assetscenter = '$assetscenter' and assetunit != presentLocation and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit != presentLocation and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and assetunit != presentLocation and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
            }
		}
		} elseif ($allocation == 3) {
		if ($assetunit == '') {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
            }
		}
		
		}
		} elseif ($checkAllowType == 2 ) {
			if ($allocation == 1) {
		        if ($assetunit == '') {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and assetunit = '$assetunit' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
            }
		}
		
		} elseif ($allocation == 2) {
		if ($assetunit == '') {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
                $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetscenter = '$assetscenter' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";
            }
		} else {
		if ($inputField1 == '' || $inputField1 == '') {
            $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and  ApprovedDisposal = 1 and presentLocation = '$assetunit' and ".$column." LIKE '%$search%' order by protocolOrder, identificationno";
        } else {
             $query = "SELECT * FROM plantmacdetails WHERE (purchasedDate BETWEEN '$inputField1' AND '$inputField2') and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and presentLocation = '$assetunit' and " . $column . " LIKE '%$search%' order by disposedDate, protocolOrder, identificationno";   
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
 
    public static function getDisposal_Inquiry($assetunit, $disposedYear) {
     $db = Database::getDB();
	 if ($disposedYear == "") {
		  $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' order by identificationno";
	 } elseif ($assetunit == "") {
		  $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and year(disposedDate) = '$disposedYear' order by assetunit, identificationno";
	 } else {	  
		  $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and year(disposedDate) = '$disposedYear' order by identificationno";
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
   public static function getSearchText($column) {
        $db = Database::getDB();
        $query = "SELECT ".$column." as col, assetscenter, assetunit, protocoltext1, protocoltext2  FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by ".$column;
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
	
	    public static function getItemsNotTransfered($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE transferToUnit ='$assetunit' and transferToConfirm = 1 and transfered = 0 order by protocolOrder, identificationno";
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
    public static function getItemsNotTransfered_unit($assetunit, $fundtype) {
        $db = Database::getDB();
		$querytext = " transferToUnit ='$assetunit' and transferToConfirm = 1 and transfered = 0 and fundtype = '$fundtype'";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT identificationno, id, assetunit, assetscenter FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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

	    public static function getIsAllocation($assetscenter, $assetunit) {
        $db = Database::getDB();
		$count = 0;
        if ($assetscenter == $assetunit) {
			$query = "SELECT count(1) as tot FROM plantmacdetails
                  WHERE assetunit = '$assetunit' and assetunit != presentLocation and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
			//$query = "SELECT count(1) as tot FROM plantmacdetails
            //     WHERE assetunit = '$assetunit' and assetunit != presentLocation and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0";
			$result = $db->query($query);
			$row = $result->fetch();
			$count = ($row['tot'] > 0 ? 1 : 0);
		} else {
			$query = "SELECT count(1) as tot FROM plantmacdetails
                  WHERE presentLocation = '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
			//$query = "SELECT count(1) as tot FROM plantmacdetails
            //      WHERE assetunit != '$assetunit' and presentLocation = '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0";
			$result = $db->query($query);
			$row = $result->fetch();
			$count = $row['tot'];
			$count = ($row['tot'] > 0 ? 2 : 0);
		}
        return $count;
    }
	   
	      public static function getAllocationDetails($assetunit) {
        $db = Database::getDB();
		$query = "SELECT * FROM plantmacdetails
                  WHERE presentLocation = '$assetunit' and assetunit != '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 order by protocolOrder, identificationno";
       // $query = "SELECT * FROM plantmacdetails
       //           WHERE presentLocation = '$assetunit' and assetunit != '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 0";
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
	
	    public static function ModificationAllows($groupId) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET apprived = 0 WHERE groupId ='$groupId'";
        $count = $db->exec($query);
        return $count;
    }
		public static function Savesorderwithcenter($sorderwithcenter, $identificationno) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET sorderwithcenter = '$sorderwithcenter' WHERE identificationno ='$identificationno'";
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
        $query = "SELECT  groupId, assetscenter, assetunit, identificationno, itemDescription, sysdate, apprivedDate, view, viewdate, viewperson, damcomment, dam_controller FROM plantmacdetails".$querytext." order by protocolOrder, identificationno";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = $data;
                    ;
                    $id = $data['groupId'];
                }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function view_dam($groupId, $login, $damcomment) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET view = 1, viewperson = '$login', viewdate = now(), damcomment = '$damcomment' WHERE groupId ='$groupId'";
        $count = $db->exec($query);
        return $count;
    }
	public static function picpath($groupId, $Filename) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET picpath = '$Filename' WHERE groupId ='$groupId'";
        $count = $db->exec($query);
        return $count;
    } 
    public static function getpicById($identificationno) {
        $db = Database::getDB();
        $query = "select picpath from plantmacdetails where identificationno = '$identificationno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function getInqDetails2($assetscenter, $assetunit) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";		
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
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by identificationno";		
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
		$querytext = " apprived = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }		
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = $data;
                    ;
                    $id = $data['groupId'];
                }
            }
            return $result;
            //$result = array_filter($result, "Database::filterUnits");
            //return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function getConfirmDetailsToModify($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
		if 	($mainCategory) {
			$querytext = $querytext." and  mainCategory = '$mainCategory'"; }
       /*
	   if 	($search) {
			$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		if (($inputField1) && ($inputField1)){
			$querytext = $querytext." and (purchasedDate BETWEEN '$inputField1' AND '$inputField2')"; }	
		*/	
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";		
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
    public static function getSummaryDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetscenter, assetunit, catalogueno order by protocolOrder, catalogueno";		
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetscenter, assetunit, itemCategory order by protocolOrder, itemCategory";		
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetscenter, assetunit, mainCategory order by protocolOrder, mainCategory";		
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
    public static function getAllowModicationItems($assetscenter, $assetunit, $mainCategory, $itemCategory, $itemDescription, $catalogueno, $searchby, $search) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and selectDisposal = 0 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($assetscenter) {
			$querytext = $querytext." and  assetscenter = '$assetscenter'"; }
		if 	($assetunit) {
			$querytext = $querytext." and  assetunit = '$assetunit'"; }
        if 	($mainCategory) {
			$querytext = $querytext." and  mainCategory = '$mainCategory'"; }
		if 	($itemCategory) {
			$querytext = $querytext." and  itemCategory = '$itemCategory'"; }
		if 	($itemDescription) {
			$querytext = $querytext." and  itemDescription = '$itemDescription'"; }	
		if 	($catalogueno) {
			$querytext = $querytext." and  catalogueno = '$catalogueno'"; }	
		
		//if 	($search) {
		//	$querytext = $querytext." and ". $column ." LIKE '%$search%'"; }
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    //$result[] = $data['identificationno'];
                    $result[] = $data;
                    ;
                    $id = $data['groupId'];
                }
            }
            return $result;
            //$result = array_filter($result, "Database::filterUnits");
            //return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
    public static function countRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM plantmacdetails
                  WHERE assetunit = '$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function confirmRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(*) as tot FROM plantmacdetails
                  WHERE fundtype = 0 and apprived = 1 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getItemsNotApprovedAll() {
        $db = Database::getDB();
        $querytext = " apprived = 0 and notapprived = 0 and transferReceivecenter is NULL";
		$querytext = Database::unitsFilter($querytext);
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
            $row = array_filter($result, "Database::filterUnits");
            $result = array();
            $id = 0;
            foreach ($row as $data) {
                if ($id != $data['groupId']) {
                    $result[] = $data;
                    ;
                    $id = $data['groupId'];
                }
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
        return $result;
    }
	public static function countTotalRecords() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function updateserialno($id, $ledgerFoliono, $eqptSriNo, $purchasedDate, $receivedDate, $natureOwnership, $unitValue, $presentLocation ) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET ledgerFoliono = '$ledgerFoliono', eqptSriNo = '$eqptSriNo', purchasedDate = '$purchasedDate', receivedDate = '$receivedDate', natureOwnership = '$natureOwnership', unitValue = '$unitValue', presentLocation = '$presentLocation' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function zero_value_Records($assetunit) {
        $db = Database::getDB();
        $query = "SELECT *, COUNT(*) as cnt FROM plantmacdetails WHERE assetunit = '$assetunit' and fundtype = 0 and apprived = 1 and unitValue = 0 GROUP BY catalogueno order by protocolOrder, counterID";
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
        $query = "UPDATE plantmacdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
	public static function Addprotocol($protocoltext1, $protocoltext2, $protocol, $assetunit) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET protocoltext1 = '$protocoltext1', protocoltext2 = '$protocoltext2', protocolOrder = '$protocol' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}	
	    public static function getDetailsUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit' order by protocolOrder, identificationno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($itemDescription) {
			$querytext = $querytext." and  itemDescription = '$itemDescription'"; }
				
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($itemDescription) {
			$querytext = $querytext." and  itemCategory = '$itemDescription'"; }
				
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
	public static function sno_duplicates() {
        $db = Database::getDB();
		$query = 'SELECT * FROM plantmacdetails
   INNER JOIN (SELECT eqptSriNo
               FROM   plantmacdetails
               GROUP  BY eqptSriNo
               HAVING COUNT(id) > 1) dup
           ON plantmacdetails.eqptSriNo = dup.eqptSriNo';
		
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
        $query = "UPDATE plantmacdetails SET assetunit = '$newassetunit' WHERE assetunit ='$oldassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE plantmacdetails SET identificationno = SUBSTRING(identificationno, 12) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		$query = "UPDATE plantmacdetails SET identificationno = CONCAT('$identification', identificationno) WHERE assetunit ='$newassetunit'";
        $count = $db->exec($query);
		
		return $count;
		}
    public static function getDetailsUnitAll($assetunit) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE assetunit = '$assetunit' order by protocolOrder, counterID";
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
        $query = "DELETE FROM plantmacdetails WHERE assetunit = '$assetunit'";
        $count = $db->exec($query);
		return $count;
    }
    public static function reorder_id($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE assetunit = '$assetunit' and catalogueno = '$catalogueno' order by id";
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
	public static function getCatalogueno($assetunit) {
        $db = Database::getDB();
        $query = "SELECT DISTINCT catalogueno FROM plantmacdetails WHERE assetunit = '$assetunit' order by catalogueno";
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
	public static function reorder_id_save($id, $identificationno, $counterId) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET identificationno = '$identificationno', counterId = '$counterId' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function delete_not_confirm($assetunit, $catalogueno) {
        $db = Database::getDB();
        $query = "DELETE FROM plantmacdetails WHERE assetunit = '$assetunit' and catalogueno = '$catalogueno' and apprived = 0";
        $count = $db->exec($query);
		return $count;
    }
	public static function summaryRecords($assetunit) {
        $db = Database::getDB();
        $query = "SELECT sum(unitValue) as tot FROM plantmacdetails
                  WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' ";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function summaryRecords_2() {
        $db = Database::getDB();
        $query = "SELECT count(1) as cnt, sum(unitValue) as tot FROM plantmacdetails
                  WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = array($row['cnt'], $row['tot']);
        return $count;
    }
    public static function getFullDetails_ledger() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, mainCategory, identificationno";
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 order by protocolOrder, identificationno';
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
	public static function getCataloguenos() {
        $db = Database::getDB();
        $query = "SELECT DISTINCT catalogueno FROM plantmacdetails order by catalogueno";
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
    public static function get_catalogueno_dtls($catalogueno) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE catalogueno = '$catalogueno' order by id";
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
	public static function serialno_replace_with_dash($catalogueno) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET eqptSriNo = '-' WHERE catalogueno ='$catalogueno'";
        $count = $db->exec($query);
        return $count;
		}
    
	public static function get_catalogueno_summary($catalogueno) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	public static function get_catalogueno_summary_1() {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}

	public static function get_itemCategory_summary_date($itemCategory, $receivedDate) {
		$db = Database::getDB();
		 $query = "SELECT count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails
                  WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory' and receivedDate <= '$receivedDate'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;	
	}
	
	public static function get_itemCategory_summary_1() {
	$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by itemCategory order by catalogueno";		
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
	public static function get_catalogueno_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function get_catalogueno_summary_1_unit($catalogueno) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit' and catalogueno = '$catalogueno'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'  and catalogueno = '$catalogueno'";
		}
		$querytext = Database::unitsFilter($querytext);			
		if ($protocol == 1) {
			$query = "SELECT assetunit, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";	
		} else if ($protocol == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by counterID";			
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
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
        $query = "UPDATE plantmacdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE itemCategory ='$itemCategory'";
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
		$query = "UPDATE plantmacdetails SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF', dam_controller = '$dam_controller' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecord_psos_allow() {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM plantmacdetails WHERE ".$_SESSION['SESS_LAST_NAME']." = 1";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function ca_no_err_list() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT plantmacdetails.* FROM plantmacdetails JOIN classificationlist ON plantmacdetails.catalogueno = classificationlist.catalogueno and  plantmacdetails.itemDescription != classificationlist.itemDescription order by protocolOrder, identificationno";
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
        $query = "UPDATE plantmacdetails SET selectLoss = '$selectLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function Selected_Items_For_loss() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
        $query = "UPDATE plantmacdetails SET confirmLoss = '$confirmLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function loss_reject_save($id) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET selectLoss = 0, confirmLoss = 0, selectLossPerson = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	 public static function approve_Items_For_loss() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and confirmLoss = 1 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
        $query = "UPDATE plantmacdetails SET ApprovedLoss = '$ApprovedLoss', selectLossPerson = '$login', confirmLossDate = now() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getPagingDetails_lost($start_from, $per_page) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 1";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
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
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0";
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
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
        $query = "UPDATE plantmacdetails SET lossedDate = '$lossedDate', lossedReason = '$lossedReason' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
	public static function countTotalRecords_loss() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and ApprovedLoss = 1";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	 public static function min_max_values() {
        $db = Database::getDB();
		//$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and selectLoss = 1 and ApprovedLoss = 0";
		//$querytext = Database::unitsFilter($querytext);
        $query = "SELECT mainCategory, itemCategory, itemDescription, catalogueno, max(unitValue) as mx, min(unitValue) as mn FROM plantmacdetails group by catalogueno order by catalogueno";
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
    public static function Confirmed_For_Disposal() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and ApprovedDisposal = 0 and transfered = 0 order by assetscenter, assetunit';
       $query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 order by protocolOrder, identificationno';
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
    public static function record_status($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = "";
		if ($assetscenter <> "") {
			$querytext = " where assetscenter = '$assetscenter'";
			if ($assetunit <> "") {
					$querytext = $querytext." and assetunit = '$assetunit'";
			}
		}
        $query = "SELECT * FROM plantmacdetails".$querytext." order by protocolOrder, identificationno";
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
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function getDisposalDetailsSummary() {
        $db = Database::getDB();
		$query = "select currentYear from constants";
        $result = $db->query($query);
        $row = $result->fetch();
        $currentYear = $row['currentYear'];
        $query = "SELECT *, count(catalogueno) as qty FROM plantmacdetails WHERE year(disposedDate) = ".$currentYear." and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 group by catalogueno order by catalogueno";
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
    public static function get_send_ordinance() {
        $db = Database::getDB();
        $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and confirm_receive_ordinance = 0";
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID";
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
        $query = "UPDATE plantmacdetails SET select_send_ordinance = '$selectLoss', ordinance_send_date = '$ordinance_send_date', ordinance = '$ordinance' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function get_receive_ordinance($unit) {
        $db = Database::getDB();
        $querytext = " assetunit = '$unit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 0";
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID";
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
        $query = "UPDATE plantmacdetails SET confirm_receive_ordinance = '$selectLoss', ordinance_receive_date = '$ordinance_receive_date' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function ordinance_received_details($ordinance, $assetunit, $id) {
        $db = Database::getDB();
        if ($id == 1) {
			$querytext = " ordinance = '$ordinance' and assetunit = '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 2) {
			$querytext = " ordinance = '$ordinance' and protocoltext1 = '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 3) {
			$querytext = " ordinance = '$ordinance' and protocoltext2 = '$assetunit' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		} else if ($id == 4) {
			$querytext = " ordinance = '$ordinance' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		}
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID";
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
	public static function get_catalogueno_unit_summary_4($protocol, $itemCategory) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$itemCategory'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, eqptSriNo, purchasedDate, receivedDate, unitValue, protocoltext1, protocoltext2 FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID";		
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
	public static function get_all_json($itemcategory) {
	$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemcategory'";		
		$query = "SELECT itemCategory, itemDescription, catalogueno, eqptSriNo, Year(purchasedDate) as pyear, unitValue FROM plantmacdetails WHERE".$querytext." order by catalogueno, receivedDate";		
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $row = $statement->fetchAll();			
			$statement->closeCursor();
			$result = array();
            foreach ($row as $data) {
                    $result[] = array($data['itemCategory'], $data['itemDescription'], $data['catalogueno'], $data['eqptSriNo'], $data['pyear'], $data['unitValue']);
            }
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }	
	}
	public static function get_itemcategory_all() {
	$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";		
		$query = "SELECT DISTINCT itemCategory FROM plantmacdetails WHERE".$querytext." order by catalogueno, receivedDate";		
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
	public static function get_catalogueno_paging_summary_4($protocol, $itemCategory, $start_from, $per_page) {
	$db = Database::getDB();
		if ($protocol == 0) {
			$querytext = " ";
		} else if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$itemCategory'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory'";
		} else if ($protocol == 4) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$itemCategory'";
		}
		$querytext = Database::unitsFilter($querytext);			
		//$query = "SELECT * FROM officeequdetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, eqptSriNo, purchasedDate, receivedDate, unitValue, protocoltext1, protocoltext2 FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID LIMIT ".$start_from.", ".$per_page;		
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
	public static function catalogueno_paging_summary_4_TotalRecords($protocol, $itemCategory) {
        $db = Database::getDB();
		if ($protocol == 0) {
			$querytext = "";
		} else if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$itemCategory'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$itemCategory'";
		} else if ($protocol == 4) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$itemCategory'";
		}
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function monthly_changes($year, $month, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(purchasedDate) = '$year' and month(purchasedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(purchasedDate) = '$year'";	
		}		
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(disposedDate) = '$year' and month(disposedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(disposedDate) = '$year'";
		}
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_iu($year, $month, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(purchasedDate) = '$year' and month(purchasedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(purchasedDate) = '$year'";	
		}
				
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_dis_iu($year, $month, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and  year(disposedDate) = '$year' and month(disposedDate) = '$month'";
		} else {
			$querytext = $querytext." and  year(disposedDate) = '$year'";
		}
				
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_cata($year, $month, $catalogueno, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {
			$querytext = $querytext." and catalogueno = '$catalogueno' and  year(purchasedDate) = '$year' and month(purchasedDate) = '$month'";
		} else {
			$querytext = $querytext." and catalogueno = '$catalogueno' and  year(purchasedDate) = '$year'";
		}
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_dis_cata($year, $month, $catalogueno, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {		
			$querytext = $querytext." and catalogueno = '$catalogueno' and  year(disposedDate) = '$year' and month(disposedDate) = '$month'";
		} else {
			$querytext = $querytext." and catalogueno = '$catalogueno' and  year(disposedDate) = '$year'";
		}
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, catalogueno";		
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
    public static function monthly_changes_cata_unit($year, $month, $catalogueno, $assetunit, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {	
			$querytext = $querytext." and assetunit = '$assetunit' and catalogueno = '$catalogueno' and  year(purchasedDate) = '$year' and month(purchasedDate) = '$month'";
		} else {
			$querytext = $querytext." and assetunit = '$assetunit' and catalogueno = '$catalogueno' and  year(purchasedDate) = '$year'";
		}		
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by catalogueno";		
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
    public static function monthly_changes_dis_cata_unit($year, $month, $catalogueno, $assetunit, $ignore_month) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		if ($ignore_month == 0) {			
			$querytext = $querytext." and assetunit = '$assetunit' and catalogueno = '$catalogueno' and  year(disposedDate) = '$year' and month(disposedDate) = '$month'";
		} else {
			$querytext = $querytext." and assetunit = '$assetunit' and catalogueno = '$catalogueno' and  year(disposedDate) = '$year'";
		}		
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by catalogueno";		
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
    public static function getDisposalDetails_2($assetscenter, $assetunit) {
        $db = Database::getDB();
		$querytext = " where fundtype = 0 and apprived = 1 and ApprovedDisposal = 1";
		if ($assetscenter <> "") {
			$querytext = $querytext." and assetscenter = '$assetscenter'";
			if ($assetunit <> "") {
					$querytext = $querytext." and assetunit = '$assetunit'";
			}
		}
        $query = "SELECT * FROM plantmacdetails".$querytext." order by protocolOrder, identificationno";
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
    public static function undo_Disposal_save($id) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET selectDisposal = 0, selectDisposalPerson = '', selectDisposalDate = '', confirmDisposal = 0, confirmDisposalPerson = '', confirmDisposalDate = '', ApprovedDisposal = 0, ApprovedDisposalPerson = '', ApprovedDisposalDate = '', disposedReason = '', disposedDate = '' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function ordinance_received_details_2($ordinance, $unit, $ordinance_send_date_1, $ordinance_send_date_2) {
        $db = Database::getDB();
		$querytext = " ordinance = '$ordinance' and fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and select_send_ordinance = 1 and confirm_receive_ordinance = 1";
		if ($unit) {
			$querytext = $querytext." and assetunit = '$unit'";
		}
		if ($ordinance_send_date_1) {
			if ($ordinance_send_date_2) {
			$querytext = $querytext." and (ordinance_receive_date BETWEEN '$ordinance_send_date_1' AND '$ordinance_send_date_2')"; } 
		}
/* 				if (DateTime::createFromFormat('Y-m-d', $ordinance_send_date_1) !== FALSE) {
			if (DateTime::createFromFormat('Y-m-d', $ordinance_send_date_2) !== FALSE) {
			$querytext = $querytext." and (ordinance_receive_date BETWEEN '$ordinance_send_date_1' AND '$ordinance_send_date_2')"; } 
		} */
		//$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' group by assetscenter, assetunit, catalogueno order by protocolOrder, catalogueno";	       
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	public static function update_dam_controller($assetunit, $dam_controller) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET dam_controller = '$dam_controller' WHERE assetunit ='$assetunit'";
        $count = $db->exec($query);
        return $count;
		}
	public static function update_cigas_1($catalogueno, $cigas_assetno) {
        $db = Database::getDB();
		//$query = "UPDATE plantmacdetails SET cigas_assetno = '$cigas_assetno' WHERE catalogueno ='$catalogueno'";
		$query = "UPDATE plantmacdetails SET cigas_assetno = '$cigas_assetno' WHERE catalogueno ='$catalogueno' and cigas_idno = ''";
        $count = $db->exec($query);
        return $count;
		}
    public static function update_cigas_2() {
        $db = Database::getDB();
        //$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and cigas_idno = ''";
		$query = "SELECT id, cigas_assetno FROM plantmacdetails WHERE".$querytext." order by cigas_assetno, protocolOrder, id";
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
        $query = "UPDATE plantmacdetails SET cigas_idno = '$cigas_idno', cigas_transferdate = CURDATE() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getFullDetails_cigas($start_from, $per_page) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and mainCategory <> 'DEFENCE EQUIPMENTS'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM plantmacdetails WHERE".$querytext." order by cigas_assetno, protocolOrder, id LIMIT ".$start_from.", ".$per_page;
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
	public static function countTotalRecords_cigas() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory <> 'DEFENCE EQUIPMENTS'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getFullDetails_cigas_all() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and mainCategory <> 'DEFENCE EQUIPMENTS'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM plantmacdetails WHERE".$querytext." order by assetunit, protocolOrder, id";
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
	public static function disposal_get_catalogueno_summary_1() {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function disposal_get_catalogueno_unit_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function disposal_get_catalogueno_unit_summary_3($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function disposal_get_catalogueno_summary_1_unit($catalogueno) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function disposal_get_catalogueno_summary_2_unit($protocol, $assetunit, $catalogueno) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit' and catalogueno = '$catalogueno'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'  and catalogueno = '$catalogueno'";
		}
		$querytext = Database::unitsFilter($querytext);			
		if ($protocol == 1) {
			$query = "SELECT assetunit, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";	
		} else if ($protocol == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by counterID";			
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
	public static function lost_get_catalogueno_summary_1() {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function lost_get_catalogueno_unit_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function lost_get_catalogueno_unit_summary_3($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and mainCategory = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and itemCategory = '$assetunit'";
		} else if ($protocol == 3) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and itemDescription = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT assetunit, mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function lost_get_catalogueno_summary_1_unit($catalogueno) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function lost_get_catalogueno_summary_2_unit($protocol, $assetunit, $catalogueno) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and protocoltext1 = '$assetunit' and catalogueno = '$catalogueno'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 1 and transfered = 0 and assetunit = '$assetunit'  and catalogueno = '$catalogueno'";
		}
		$querytext = Database::unitsFilter($querytext);			
		if ($protocol == 1) {
			$query = "SELECT assetunit, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";	
		} else if ($protocol == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by counterID";			
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
    public static function date_range_changes($receivedDate_from, $receivedDate_to, $display_type) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext."  and (purchasedDate BETWEEN '$receivedDate_from' AND '$receivedDate_to')";		
		if ($display_type == 0) {
			$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
        } elseif ($display_type == 1) {
			$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";
		} elseif ($display_type == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, catalogueno";
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
    public static function date_range_changes_dis($receivedDate_from, $receivedDate_to, $display_type) {
		$db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0";
		$querytext = $querytext." and (disposedDate BETWEEN '$receivedDate_from' AND '$receivedDate_to')";
		if ($display_type == 0) {
			$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
        } elseif ($display_type == 1) {
			$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit, catalogueno order by protocolOrder, catalogueno";
		} elseif ($display_type == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, catalogueno";
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
    public static function getDisposalDetailsUnit($unit, $type) {
        $db = Database::getDB();
		$querytext = " where fundtype = 0 and apprived = 1 and ApprovedDisposal = 1";
		if ($type == 2) {
			$querytext = $querytext." and protocoltext1 = '$unit'";
		} elseif ($type == 3) {	
			$querytext = $querytext." and protocoltext2 = '$unit'";
		} elseif ($type == 4) {
			$querytext = $querytext." and assetunit = '$unit'";
        } elseif ($type == 0) {
			$querytext = $querytext." and assetunit = ''";
        }
		$query = "SELECT * FROM plantmacdetails".$querytext." order by protocolOrder, identificationno";
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
    public static function disband_all($unit) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transfered = 2, transferToDate = now() WHERE transfered = 0 and assetunit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
    public static function disband_one($id) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transfered = 2, transferToDate = now() WHERE transfered = 0 and id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getPagingDetails_disband($start_from, $per_page) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 2 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
		//$query = 'SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 order by protocolOrder, identificationno';
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
	public static function countTotalRecords_disband() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function disband_all_undo($unit) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transfered = 0, transferToDate = now() WHERE transfered = 2 and assetunit ='$unit'";
        $count = $db->exec($query);
        return $count;
    }
	public static function get_catalogueno_summary_2_undo($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 2 and protocoltext1 = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 2 and assetunit = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function getInqDetails_disband($assetscenter, $assetunit, $column, $search) {
        $db = Database::getDB();
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and cigas_idno = ''";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and year(purchasedDate) = '2018'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
		$query = "SELECT id, cigas_assetno, cigas_idno FROM plantmacdetails WHERE cigas_assetno = '$cigas_assetno' order by id DESC";
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
    public static function getFullDetails_cigas_date($start_from, $per_page) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and mainCategory <> 'DEFENCE EQUIPMENTS' and cigas_transferdate = CURDATE()";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM plantmacdetails WHERE".$querytext." order by cigas_assetno, protocolOrder, id LIMIT ".$start_from.", ".$per_page;
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
	public static function countTotalRecords_cigas_date() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and mainCategory <> 'DEFENCE EQUIPMENTS' and cigas_transferdate = CURDATE()";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function getFullDetails_cigas_all_date() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and mainCategory <> 'DEFENCE EQUIPMENTS' and cigas_transferdate = CURDATE()";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT newAssestno, cigas_assetno, cigas_idno, assetunit, purchasedDate, itemCategory, itemDescription, unitValue, identificationno FROM plantmacdetails WHERE".$querytext." order by assetunit, protocolOrder, id";
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
        $query = "UPDATE plantmacdetails SET confirmDisposal = 0, selectDisposal = 0 WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function getDisposalDetails_unit($assetunit) {
        $db = Database::getDB();
        $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and assetunit = '$assetunit'";
		if ($_SESSION['SESS_LEVEL'] == 10) {
		$querytext = Database::unitsFilter($querytext); }
		$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, counterID";
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
    public static function Selected_Items_For_displayitem() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and selectLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	 public static function Selected_Items_For_Confirm_displayitem() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and selectLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
	 public static function approve_Items_For_displayitem() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and selectLoss = 2 and confirmLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function getDetails_displayitem() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 2";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function getDonateditems() {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and natureOwnership = 'DONATION'";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function select_transfer_quick($id, $transferSelect, $transferToCenter, $transferToUnit, $transferToDetails, $transferToDate) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET transferSelect = '$transferSelect', transferToConfirm = '$transferSelect', transferToCenter = '$transferToCenter', transferToUnit = '$transferToUnit', transferToDetails = '$transferToDetails', transferToDate = '$transferToDate' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
    }
    public static function disposal_select_save_quick($id, $selectDisposal, $login) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET selectDisposal = '$selectDisposal', selectDisposalPerson = '$login', selectDisposalDate = now() WHERE id ='$id'";
		$count = $db->exec($query);
        return $count;
    }
    public static function disposal_details_save_quick($id, $disposedDate, $disposedReason, $condemnation) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET disposedDate = '$disposedDate', disposedReason = '$disposedReason', condemnation = '$condemnation' WHERE id ='$id'";
		$count = $db->exec($query);
        return $count;
    }
    public static function disposal_details_save_quick_all($assetunit, $disposedDate, $disposedReason, $condemnation) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET disposedDate = '$disposedDate', disposedReason = '$disposedReason', condemnation = '$condemnation' WHERE assetunit = '$assetunit' and fundtype = 0 and apprived = 1 and selectDisposal = 1 and confirmDisposal = 0 and ApprovedDisposal = 0 and ApprovedLoss = 0";
		$count = $db->exec($query);
        return $count;
    }
	public static function add_Board_report($assetunit) {
        $db = Database::getDB();
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit'";
		$query = "SELECT catalogueno, SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM plantmacdetails WHERE".$querytext." GROUP BY catalogueno order by catalogueno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' and YEAR(disposedDate) = '$currentYear' and  assetunit = '$assetunit'";
        $query = "SELECT SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function add_Board_report_new($assetunit, $currentYear, $catalogueno) {
        $db = Database::getDB();
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno' and YEAR(receivedDate) = '$currentYear' and  assetunit = '$assetunit'";
        $query = "SELECT SUM(unitValue) AS total, COUNT(*) as cnt, GROUP_CONCAT(id) as ids_array FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function board_report_summary_view_details($id){
        $db = Database::getDB();
		$query = "SELECT ids_array FROM board_report_summary WHERE id = '$id'";
		$result = $db->query($query);
        $row = $result->fetch();
		$query = "SELECT * FROM plantmacdetails WHERE id in (".$row['ids_array'].")";
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
        $query = "UPDATE plantmacdetails SET assetscenter = '$assetscenter1', assetunit = '$assetunit1', presentLocation = '$assetunit1', identificationno = REPLACE(identificationno, '$CentreIDold', '$CentreID') WHERE assetunit ='$assetunit' and assetscenter = '$assetscenter'";
        $count = $db->exec($query);
        return $count;
		}
	public static function change_unit_name1($assetscenter, $assetunit, $assetscenter1, $assetunit1, $CentreID, $CentreIDold) {
        $db = Database::getDB();
        $query = "UPDATE plantmacdetails SET identificationno = CONCAT('$CentreID', SUBSTR(identificationno,12,19)) WHERE assetunit ='$assetunit' and assetscenter = '$assetscenter'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getHasRecordUnit($assetunit) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM plantmacdetails
                  WHERE assetunit ='$assetunit'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }	
    public static function getDisposalDetails_year($assetunit, $currentYear) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE fundtype = 0 and apprived = 1 and ApprovedDisposal = 1 and assetunit = '$assetunit' and LEFT(disposedDate, 4) = '$currentYear' order by identificationno";
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0 and assetunit = '$assetunit' and LEFT(receivedDate, 4) = '$currentYear'";
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
    public static function getDetailsGroupID($groupId) {
        $db = Database::getDB();
        $query = "SELECT * FROM plantmacdetails WHERE groupID = '$groupId' order by counterId";
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
    public static function approve_save_new($groupId) {
        $db = Database::getDB();
        $login = $_SESSION['SESS_LOGIN'];
		$query = "UPDATE plantmacdetails SET apprived = 1, approvedPerson = '$login', notapprived = 0, notapprivedReason = '', apprivedDate = now() WHERE groupId ='$groupId'";
        $count = $db->exec($query);
        return $count;
    }
    public static function not_approve_save_new($groupId, $notapprivedReason) {
        $db = Database::getDB();
		$login = $_SESSION['SESS_LOGIN'];
        $query = "UPDATE plantmacdetails SET notapprived = 1, notapprivedReason = '$notapprivedReason', approvedPerson = '$login', apprivedDate = now() WHERE groupId ='$groupId'";
        $count = $db->exec($query);
        return $count;
    }
	public static function allocation_list($assetunit) {
        $db = Database::getDB();
	    if ($assetunit == '') {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		} else {
			$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit'";
		}
		$query = "SELECT catalogueno, mainCategory, itemCategory, itemDescription, COUNT(*) as cnt 
		FROM plantmacdetails 
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
	public static function lifetime_list($assetunit) {
        $db = Database::getDB();
	    $querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit'";
		$query = "SELECT catalogueno, mainCategory, itemCategory, itemDescription, purchasedDate 
		FROM plantmacdetails 
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
		$querytext = " fundtype = 0 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and  assetunit = '$assetunit' and  catalogueno = '$catalogueno'";
		$query = "SELECT COUNT(*) as cnt 
		FROM plantmacdetails 
		WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['cnt'];
        return $count;
    }
	public static function Save_fundtype($fundtype, $identificationno) {
        $db = Database::getDB();
		$query = "UPDATE plantmacdetails SET fundtype = '$fundtype' WHERE identificationno ='$identificationno'";
        $count = $db->exec($query);
        return $count;
		}
    public static function np_getPagingDetails($start_from, $per_page) {
        $db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and transfered = 0 and ApprovedLoss = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno LIMIT ".$start_from.", ".$per_page;
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
	public static function np_countTotalRecords() {
        $db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);
        $query = "SELECT count(*) as tot FROM plantmacdetails WHERE".$querytext;
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function np_get_catalogueno_summary_1() {
		$db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function np_get_catalogueno_summary_2($protocol, $assetunit) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'";
		}
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT mainCategory, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by catalogueno order by catalogueno";		
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
	public static function np_get_catalogueno_summary_1_unit($catalogueno) {
		$db = Database::getDB();
		$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and catalogueno = '$catalogueno'";
		$querytext = Database::unitsFilter($querytext);			
		$query = "SELECT *, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";		
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
	public static function np_get_catalogueno_summary_2_unit($protocol, $assetunit, $catalogueno) {
	$db = Database::getDB();
		if ($protocol == 1) {
			$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and protocoltext1 = '$assetunit' and catalogueno = '$catalogueno'";
		} else if ($protocol == 2) {
			$querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0 and assetunit = '$assetunit'  and catalogueno = '$catalogueno'";
		}
		$querytext = Database::unitsFilter($querytext);			
		if ($protocol == 1) {
			$query = "SELECT assetunit, itemCategory, itemDescription, assetsno, catalogueno, protocoltext1, protocoltext2, count(*) as cnt, sum(unitValue) as tot FROM plantmacdetails WHERE".$querytext." group by assetunit order by protocolOrder, counterID";	
		} else if ($protocol == 2) {
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by counterID";			
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
	public static function np_getInqDetails($assetscenter, $assetunit, $column, $search, $inputField1, $inputField2) {
        $db = Database::getDB();
	    $querytext = " fundtype = 1 and apprived = 1 and ApprovedDisposal = 0 and ApprovedLoss = 0 and transfered = 0";
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
			$query = "SELECT * FROM plantmacdetails WHERE".$querytext." order by protocolOrder, identificationno";
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
}
