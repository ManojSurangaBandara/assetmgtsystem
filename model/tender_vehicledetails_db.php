<?php
class tender_vehicledetails{
	private $id;
	private $year;
	private $year_half;
	private $ordinance;
	private $type;
	private $date1;
	private $date2;
	private $lotno;
	private $vehicleno;
	private $vmodel;
	private $engineno;
	private $chaisseeno;
	private $amount;
	private $bname;
	private $baddress;
	private $bidno;

	
	protected static $instance;
	
	public function __construct($_id=NULL,$_year=NULL,$_year_half=NULL,$_ordinance=NULL,$_type=NULL,$_date1=NULL,$_date2=NULL,$_lotno=NULL,$_vehicleno=NULL,$_vmodel=NULL,$_engineno=NULL,$_chaisseeno=NULL,$_amount=NULL,$_bname=NULL,$_baddress=NULL,$_bidno=NULL){
		$this->id=$_id;
		$this->year=$_year;
		$this->year_half=$_year_half;
		$this->ordinance=$_ordinance;
		$this->type=$_type;
		$this->date1=$_date1;
		$this->date2=$_date2;
		$this->lotno=$_lotno;
		$this->vehicleno=$_vehicleno;
		$this->vmodel=$_vmodel;
		$this->engineno=$_engineno;
		$this->chaisseeno=$_chaisseeno;
		$this->amount=$_amount;
		$this->bname=$_bname;
		$this->baddress=$_baddress;
		$this->bidno=$_bidno;
		

	}
	public function _get($arg){
		if($arg=='id'){return $this->id; }
		if($arg=='year'){return $this->year; }
		if($arg=='year_half'){return $this->year_half; }
		if($arg=='ordinance'){return $this->ordinance; }
		if($arg=='type'){return $this->type; }
		if($arg=='date1'){return $this->date1; }
		if($arg=='date2'){return $this->date2; }
		if($arg=='lotno'){return $this->lotno; }
		if($arg=='vehicleno'){return $this->vehicleno; }
		if($arg=='vmodel'){return $this->vmodel; }
		if($arg=='engineno'){return $this->engineno; }
		if($arg=='chaisseeno'){return $this->chaisseeno; }
		if($arg=='amount'){return $this->amount; }
		if($arg=='bname'){return $this->bname; }
		if($arg=='baddress'){return $this->baddress; }
		if($arg=='bidno'){return $this->bidno; }
		

	
	}
	public function find($arr=NULL){
		global $db;
		try {
			if(empty($arr)){
							
					$sth = $db->prepare("SELECT * FROM tender_vehicledetails ORDER BY year, year_half, id");
				}
			else {			
				$where="";				
				foreach($arr as $key => $value){		
						$where=$key."='".$value."'";
				 } 							
				$sth = $db->prepare("SELECT * FROM tender_vehicledetails WHERE $where ORDER BY id");
			}		
		
			$sth->execute();	
			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
			$list=array();
			$i=0;							
				foreach($rows as $key=>$row){					
					self::$instance = new tender_vehicledetails($row['id'],$row['year'],$row['year_half'],$row['ordinance'],$row['type'],$row['date1'],$row['date2'],$row['lotno'],$row['vehicleno'],$row['vmodel'],$row['engineno'],$row['chaisseeno'],$row['amount'],$row['bname'],$row['baddress'],$row['bidno']);					
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
				$stmt = $db->prepare("INSERT INTO tender_vehicledetails(code,name)
VALUES (?,?)");		
				return $stmt->execute(array($this->code,$this->name));		
		
		}catch (Exception $e) {
		 		return $e->getMessage();
		}
	
       
	}
	public function update(){
		global $db;
		try {		
				$stmt = $db->prepare("UPDATE tender_vehicledetails SET code=?,name=? WHERE id=?");		
				return $stmt->execute(array($this->code,$this->name,$this->id));		
		
		}catch (Exception $e) {
		 		return $e->getMessage();
		}
	
       
	}
	public function delete(){
		global $db;
		try {		
				$stmt = $db->prepare("DELETE FROM tender_vehicledetails WHERE id=?");		
				return $stmt->execute(array($this->id));		
		
		}catch (Exception $e) {
		 		return $e->getMessage();
		}
	
       
	}
	public function search_army_number($vehicleno){
		global $db;
		try {
			$query = "SELECT * FROM tender_vehicledetails WHERE vehicleno like '%$vehicleno%'";
			$sth = $db->prepare($query);
			$sth->execute();	
			$rows = $sth->fetchAll(PDO::FETCH_ASSOC);
			$list="";
			$i=0;							
				foreach($rows as $key=>$row){					
					self::$instance = new tender_vehicledetails($row['id'],$row['year'],$row['year_half'],$row['ordinance'],$row['type'],$row['date1'],$row['date2'],$row['lotno'],$row['vehicleno'],$row['vmodel'],$row['engineno'],$row['chaisseeno'],$row['amount'],$row['bname'],$row['baddress'],$row['bidno']);					
					$list[$i]=self::$instance;
					$i=$i+1;
				}
		return $list;
		
		}catch (Exception $e) {
		 		echo $e->getMessage();
		}
	}
    public static function tender_summary_list() {
        $db = Database::getDB();
		$query = "SELECT year, year_half FROM tender_vehicledetails GROUP BY year, year_half order by year, year_half";
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
    public static function tender_summary_cal($year, $year_half, $type) {
        $db = Database::getDB();
		$query = "SELECT count(1) as tot FROM tender_vehicledetails where year = '$year' and year_half = '$year_half' and type = '$type'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }
    public static function tender_summary_ordinance() {
        $db = Database::getDB();
		$query = "SELECT year, year_half, ordinance FROM tender_vehicledetails GROUP BY year, year_half, ordinance order by year, year_half, ordinance";
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
    public static function tender_summary_cal_ord($year, $year_half, $type, $ordinance) {
        $db = Database::getDB();
		$query = "SELECT count(1) as tot FROM tender_vehicledetails where year = '$year' and year_half = '$year_half' and type = '$type' and ordinance = '$ordinance'";
        $result = $db->query($query);
        $row = $result->fetch();
        $count = $row['tot'];
        return $count;
    }

}


?>