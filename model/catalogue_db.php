<?php

class CatalogueDB {

    public static function getCatalogue() {
        $db = Database::getDB();
        $query = 'SELECT * FROM classificationlist order by type, itemDescription, catalogueno';
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
	
    public static function getCatalogueType($type) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist where type = '$type' order by catalogueno";
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
	
	public static function getitemCategoryType($type) {
        $db = Database::getDB();
		$query = "SELECT * FROM classificationlist where type = '$type' group by itemCategory order by catalogueno";
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
    public static function getCataloguemainitem($classification, $mainCategory, $itemCategory) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist where type = '$classification' and mainCategory = '$mainCategory' and itemCategory = '$itemCategory' order by type, catalogueno";
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
	
    public static function getMainCategoryByClassification($classification) {
        $db = Database::getDB();
			$query = "SELECT mainCategory FROM maincategory WHERE type = $classification order by mainCategory";
       // $query = "SELECT DISTINCT mainCategory FROM classificationlist WHERE type = $classification";
        $result = $db->query($query);
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

    public static function getItemCategoryByMainCategory($mainCategory) {
        $db = Database::getDB();
		$query = "SELECT itemCategory FROM itemcategory WHERE mainCategory = '$mainCategory' order by itemCategory";
        //$query = "SELECT DISTINCT itemCategory FROM classificationlist WHERE mainCategory = '$mainCategory'";
        $result = $db->query($query);
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

    public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM classificationlist order by catalogueno';
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

    public static function getHasRecord($catalogueno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM classificationlist WHERE catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($classification, $mainCategory, $itemCategory, $description, $make, $modle, $voteHead, $newAssestno, $assetsno, $catalogueno) {
        $db = Database::getDB();
        $query = "INSERT INTO classificationlist
          (type, mainCategory, itemCategory, itemDescription, make, modle, voteHead, newAssestno, assetsno, catalogueno)
          VALUES
          ('$classification', '$mainCategory', '$itemCategory', '$description', '$make', '$modle', '$voteHead', '$newAssestno', '$assetsno', '$catalogueno')";
        $row_count = $db->exec($query);
        return $row_count;
    }

    public static function getInqDetails($column, $search) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist WHERE ". $column ." LIKE '%$search%' order by catalogueno";
        //$query = "SELECT * FROM classificationlist WHERE itemCategory LIKE '%$search%'";
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

    public static function getSearchText($column) {
        $db = Database::getDB();
        $query = "SELECT " . $column . " as col, assetscenter, assetunit  FROM landdetails WHERE apprived = 1";
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
public static function getHasMainRecord($mainCategory) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM maincategory WHERE mainCategory = '$mainCategory'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addMainRecord($classification, $mainCategory) {
        $db = Database::getDB();
        $query = "INSERT INTO maincategory
          (type, mainCategory)
          VALUES
          ('$classification', '$mainCategory')";
        $row_count = $db->exec($query);
        return $row_count;
    }
    public static function getMainCategory() {
        $db = Database::getDB();
        $query = 'SELECT * FROM maincategory order by type, mainCategory';
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
    public static function getItemCategory() {
        $db = Database::getDB();
        $query = 'SELECT * FROM itemcategory order by type, mainCategory, itemCategory';
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
public static function getHasItemRecord($mainCategory, $itemCategory) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM itemcategory WHERE itemCategory = '$itemCategory' AND mainCategory = '$mainCategory'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function addItemRecord($classification, $mainCategory, $itemCategory, $sorttype) {
        $db = Database::getDB();
        $query = "INSERT INTO itemcategory
          (type, mainCategory, itemCategory, sorttype)
          VALUES
          ('$classification', '$mainCategory', '$itemCategory', '$sorttype')";
        $row_count = $db->exec($query);
        return $row_count;
    }
	public static function getcatlogDetailByid($id) {
        $db = Database::getDB();
        $query = "select * from classificationlist where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function deleteRecord($id) {
        $db = Database::getDB();
        $query = "DELETE FROM classificationlist WHERE id = '$id'";
        $db->exec($query);
    }
	public static function getHasMainCategoryInItemcategory($mainCategory) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM itemcategory WHERE mainCategory = '$mainCategory'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function deletemainCategory($id) {
        $db = Database::getDB();
        $query = "DELETE FROM maincategory WHERE id = '$id'";
        $db->exec($query);
    }
	public static function getHasItemcategoryIncategory($mainCategory, $itemCategory) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM classificationlist WHERE mainCategory = '$mainCategory' and itemCategory ='$itemCategory'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
	public static function deleteItemCategory($id) {
        $db = Database::getDB();
        $query = "DELETE FROM itemcategory WHERE id = '$id'";
        $db->exec($query);
    }
    public static function getCatalogue_Tree($type) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist WHERE type = '$type' order by type, mainCategory, itemCategory, catalogueno";
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
	public static function getcatlogDetailByCatalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select * from classificationlist where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getcatlogDescriptionByCatalogueno($catalogueno) {
        $db = Database::getDB();
        $query = "select * from classificationlist where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row['itemDescription'];
    }
	public static function updateMinMax($id, $minval, $maxval, $minlifetime, $maxlifetime) {
        $db = Database::getDB();
        $query = "UPDATE classificationlist SET minval = '$minval', maxval = '$maxval', minlifetime = '$minlifetime', maxlifetime = '$maxlifetime' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function update_psos_allow($id, $DGGS, $DOPS, $DTRG, $DPLAN, $DIT, $CFE, $CSO, $DGSPORTS, $DSPORTS, $AG, $DGAHS, $DAMS, $DADS, $DAMPS, $DAMM, $QMG, $DAQ, $DST, $DES, $MGO, $DOS, $DEME, $DGINF) {
        $db = Database::getDB();
        $query = "UPDATE itemcategory SET DGGS = '$DGGS', DOPS = '$DOPS', DTRG = '$DTRG', DPLAN = '$DPLAN', DIT = '$DIT', CFE = '$CFE', CSO = '$CSO', DGSPORTS = '$DGSPORTS', DSPORTS = '$DSPORTS', AG = '$AG', DGAHS = '$DGAHS', DAMS = '$DAMS', DADS = '$DADS', DAMPS = '$DAMPS', DAMM = '$DAMM', QMG = '$QMG', DAQ = '$DAQ', DST = '$DST', DES = '$DES', MGO = '$MGO', DOS = '$DOS', DEME = '$DEME', DGINF = '$DGINF' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function getcatlognewAssestnoByitemCategory($mainCategory, $itemCategory) {
        $db = Database::getDB();
        $query = "select newAssestno, assetsno from classificationlist where mainCategory = '$mainCategory' and itemCategory = '$itemCategory' order by catalogueno";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
    public static function getCatalogue_cigas() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM classificationlist order by type, newAssestno, catalogueno';
		$query = 'SELECT * FROM classificationlist order by newAssestno, catalogueno';
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
    public static function getCatalogue_cigas_nodefence() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM classificationlist order by type, newAssestno, catalogueno';
		$query = "SELECT * FROM classificationlist where mainCategory <> 'DEFENCE EQUIPMENTS' and mainCategory <> 'A VEHICLE' order by newAssestno, catalogueno";
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
	public static function updatecigas_assetno($id, $cigas_assetno) {
        $db = Database::getDB();
        $query = "UPDATE classificationlist SET cigas_assetno = '$cigas_assetno', cigas_transferdate = CURDATE() WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
    public static function getCatalogue_cigas_empty() {
        $db = Database::getDB();
		$query = "SELECT * FROM classificationlist WHERE cigas_assetno = '' order by newAssestno, catalogueno";
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
    public static function getCatalogue_cigas_getmaxno($newAssestno) {
        $db = Database::getDB();
		$query = "SELECT * FROM classificationlist WHERE newAssestno = '$newAssestno' order by id desc";
        try {
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();
            $statement->closeCursor();
			$maxno = 0;
			foreach ($result as $exp) {
				if (strlen($exp['cigas_assetno']) > 0) {
				$myArray = explode('.', $exp['cigas_assetno']);
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
	public static function updatecigas_assetno_max($id, $maxno) {
        $db = Database::getDB();
        //$query = "UPDATE classificationlist SET cigas_maxno = '$maxno', cigas_transferdate = CURDATE() WHERE id ='$id'";
		$query = "UPDATE classificationlist SET cigas_maxno = '$maxno' WHERE id ='$id'";
        $count = $db->exec($query);
        return $count;
		}
	public static function getcigas_assetno_max($cigas_assetno) {
        $db = Database::getDB();
        $query = "select cigas_maxno from classificationlist where cigas_assetno = '$cigas_assetno'";
        $result = $db->query($query);
        $row = $result->fetch();
		$maxno = $row['cigas_maxno'];
        return $maxno;
    }
    public static function getCatalogue_cigas_date() {
        $db = Database::getDB();
        //$query = 'SELECT * FROM classificationlist order by type, newAssestno, catalogueno';
		$query = 'SELECT * FROM classificationlist where cigas_transferdate = CURDATE() order by newAssestno, catalogueno';
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
	public static function getLifetime_details($catalogueno) {
        $db = Database::getDB();
        $query = "select minlifetime, maxlifetime from classificationlist where catalogueno = '$catalogueno'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
   public static function getDetails_dam($search) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist WHERE itemDescription LIKE '%$search%' order by catalogueno";
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
   public static function getDetails_scale($search) {
        $db = Database::getDB();
        $query = "SELECT * FROM scale_catalogue WHERE itemDescription LIKE '%$search%' order by catalogueno";
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
	public static function scale_catalogue_save($catalogueno, $scale_catalogueno) {
        $db = Database::getDB();
        $query = "UPDATE classificationlist SET scale_catalogueno = '$scale_catalogueno' WHERE catalogueno ='$catalogueno'";
        $count1 = $db->exec($query);
         $query = "UPDATE scale_catalogue SET dam_catalogueno = '$catalogueno' WHERE catalogueno ='$scale_catalogueno'";
        $count2 = $db->exec($query);       
		return $count1 + $count2;
		}
   public static function get_columnname_scale() {
        $db = Database::getDB();
        $query = "SHOW COLUMNS FROM scale_catalogue";
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
    public static function dos_getCatalogue() {
        $db = Database::getDB();
        $query = 'SELECT * FROM dos_materialmaster order by itemtype, itemcategory, itemcode';
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
   public static function getDetails_dos($search) {
        $db = Database::getDB();
        $query = "SELECT * FROM dos_materialmaster WHERE description LIKE '%$search%' order by itemcode";
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
	public static function compare_dam_dos_catalogue_save($catalogueno, $dos_catalogueno) {
        $db = Database::getDB();
        $query = "UPDATE classificationlist SET dos_catalogueno = '$dos_catalogueno' WHERE catalogueno ='$catalogueno'";
        $count1 = $db->exec($query);
         $query = "UPDATE dos_materialmaster SET dam_catalogueno = '$catalogueno' WHERE itemcode ='$dos_catalogueno'";
        $count2 = $db->exec($query);       
		return $count1 + $count2;
		}
    public static function getCatalogue_mainCategory($mainCategory) {
        $db = Database::getDB();
        $query = "SELECT * FROM classificationlist WHERE mainCategory = '$mainCategory' order by type, itemDescription, catalogueno";
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
}
