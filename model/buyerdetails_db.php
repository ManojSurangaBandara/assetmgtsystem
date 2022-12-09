<?php

class BuyerdetailsDB {

	private $id;
	private $nicno;
	private $name;
	private $address;
	private $telephone;
	private $email;

	protected static $instance;
	public function __construct($_id=NULL,$_nicno=NULL,$_name=NULL,$_address=NULL,$_telephone=NULL,$_email=NULL){
		$this->id=$_id;
		$this->nicno=$_nicno;
		$this->name=$_name;
		$this->address=$_address;
		$this->telephone=$_telephone;
		$this->email=$_email;
	}
	public function _get($arg){
		if($arg=='id'){return $this->id; }
		if($arg=='nicno'){return $this->nicno; }
		if($arg=='name'){return $this->name; }
		if($arg=='address'){return $this->address; }
		if($arg=='telephone'){return $this->telephone; }
		if($arg=='email'){return $this->email; }
	}

	public function find($arr=NULL){
		global $db;
		try {
			if(empty($arr)){
							
					$sth = $db->prepare("SELECT * FROM buyerdetails ORDER BY nicno");
				}
			else {			
				$where="";				
				foreach($arr as $key => $value){		
						$where=$key."='".$value."'";
				 } 							
				$sth = $db->prepare("SELECT * FROM buyerdetails WHERE $where ORDER BY id");
			}		
		
			$sth->execute();	
			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
			$list="";
			$i=0;							
				foreach($rows as $key=>$row){					
					self::$instance = new BuyerdetailsDB($row['id'],$row['nicno'],$row['name'],$row['address'],$row['telephone'],$row['email']);					
					$list[$i]=self::$instance;
					$i=$i+1;
				}
		return $list;
		
		}catch (Exception $e) {
		 		echo $e->getMessage();
		}
		
	}
	public function save(){
		global $db;
		try {		
				$stmt = $db->prepare("INSERT INTO buyerdetails(nicno, name, address, telephone, email) VALUES (?,?,?,?,?)");		
				return $stmt->execute(array($this->nicno,$this->name,$this->address,$this->telephone,$this->email));
		}catch (Exception $e) {
		 		return $e->getMessage();
		}
	
       
	}

	
 public static function getFullDetails() {
        $db = Database::getDB();
        $query = 'SELECT * FROM buyerdetails';
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

    public static function getHasRecord($nicno) {
        $db = Database::getDB();
        $query = "SELECT count(1) as tot FROM buyerdetails WHERE nicno = '$nicno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

    public static function addRecord($nicno, $name, $address, $telephone, $email) {
        $db = Database::getDB();
        $query = "INSERT INTO buyerdetails
          (nicno, name, address, telephone, email)
          VALUES
          ('$nicno', '$name', '$address', '$telephone', '$email')";
        $row_count = $db->exec($query);
       // $row_count = $db->lastInsertId();
		return $row_count;
    }
    public static function editRecord($id, $nicno, $name, $address, $telephone, $email) {
        $db = Database::getDB();
        $query = "UPDATE buyerdetails SET nicno = '$nicno', name = '$name', address = '$address', telephone = '$telephone', email = '$email' WHERE id ='$id'";
		//$query = "UPDATE buyerdetails SET nicno = '$nicno', name = '$name', address = $address WHERE id ='$id'";
        $row_count = $db->exec($query);
        return $row_count;
    }
	
    public static function updateRecord($nicno, $name, $address, $telephone, $email) {
        $db = Database::getDB();
        $query = "UPDATE buyerdetails SET name = '$name', address = '$address', telephone = '$telephone', email = '$email' WHERE nicno = '$nicno'";
		//$query = "UPDATE buyerdetails SET nicno = '$nicno', name = '$name', address = $address WHERE id ='$id'";
         try {
			$row_count = $db->exec($query);
			return $row_count;
		} catch (PDOException $e) {
            $error_message = $e->getMessage();
            display_db_error($error_message);
        }
    }
	
	public static function deleteRecordById($id) {
        $db = Database::getDB();
        $query = "DELETE FROM buyerdetails WHERE id = '$id'";
        $db->exec($query);
    }

	public static function deleteRecordByNicno($id) {
        $db = Database::getDB();
        $query = "DELETE FROM buyerdetails WHERE nicno = '$id'";
        $row_count = $db->exec($query);
		return $row_count;
    }
	
	public static function getDetailsById($id) {
        $db = Database::getDB();
        $query = "select * from buyerdetails where id = '$id'";
        $result = $db->query($query);
        $row = $result->fetch();
        return $row;
    }
	public static function getDetailsByNicno($nicno) {
        $db = Database::getDB();
        $query = "select * from buyerdetails where nicno = '$nicno'";
        $result = $db->query($query);
        $row = $result->fetch();
        $instance = new BuyerdetailsDB($row['id'],$row['nicno'],$row['name'],$row['address'],$row['telephone'],$row['email']);
		return $instance;
    }
	public static function getNICDetails() {
        $db = Database::getDB();
        $query = 'SELECT nicno FROM buyerdetails';
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
}
