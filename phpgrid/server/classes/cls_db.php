<?php
if(!session_id()){ session_start();} 

class C_Database{
	public $zyKIxGFCDaGuObCtPLcH; // db host
	public $LYZymBHAGWBWWOZHXICM; // db username
	public $password;
	public $databaseName;
	public $tableName;
	public $link;
	public $dbType;
	public $charset;
    public $db; 
    public $result;
	
	//constructor
	public function __construct($host, $user, $pass, $dbName, $db_type = "mysql", $charset=""){
		$this -> zyKIxGFCDaGuObCtPLcH = $host;
		$this -> LYZymBHAGWBWWOZHXICM = $user;
		$this -> password = $pass;
		$this -> databaseName = $dbName;
		$this -> dbType  = $db_type;
        $this -> charset = $charset;
		
		$this -> zrmCNBMkuIKUyvcMIcsd();	
	}

	//create database connection
	public function zrmCNBMkuIKUyvcMIcsd(){
		switch($this->dbType){
			case "access":
				$this->db = ADONewConnection($this->dbType);
				$dsn = "Driver={Microsoft Access Driver (*.mdb)};Dbq=".$this->databaseName.";Uid=".$this->LYZymBHAGWBWWOZHXICM.";Pwd=".$this->password.";";
				$this->db->Connect($dsn);
				break;
			case "odbc_mssql_native":
				$this->db = ADONewConnection('odbc_mssql');
                
				$dsn = "Driver={SQL Server};Server=".$this->zyKIxGFCDaGuObCtPLcH.";Database=".$this->databaseName.";";
                $this->db->Connect($dsn, $this->LYZymBHAGWBWWOZHXICM, $this->password);
                break;
            case "odbc_mssql":
                $this->db = ADONewConnection($this->dbType);
                
                $this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password);
                break;
			case "postgres":
				$this->db = ADONewConnection($this->dbType);
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName) or die("Error: Could not connect to the database");
				if(!empty($this->charset)) {
                    $this->db->Execute("SET NAMES '$this->charset'");
                }
                break;
			case "db2":
				$this->db = ADONewConnection($this->dbType);
				$dsn = "driver={IBM db2 odbc DRIVER};Database=".$this->databaseName.";hostname=".$this->zyKIxGFCDaGuObCtPLcH.";port=50000;protocol=TCPIP;uid=".$this->LYZymBHAGWBWWOZHXICM."; pwd=".$this->password;
				$this->db->Connect($dsn);
				break;
            case 'db2-dsnless':
                $this->db = ADONewConnection('db2');
                $this->db->Connect($this->zyKIxGFCDaGuObCtPLcH,$this->LYZymBHAGWBWWOZHXICM,$this->password, $this->databaseName);
                break;
			case "ibase":
				$this->db = ADONewConnection($this->dbType); 
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH . $this->databaseName, $this->LYZymBHAGWBWWOZHXICM, $this->password);
				break;
			case "oci805":
                
				$this->db = ADONewConnection($this->dbType);		
				$ret = $this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName);         
	            if(!$ret){
                    
                    
                    $this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName);                                                                     
                }             
				
				
				
				
				break;
			case "sqlite":
				$this->db = ADONewConnection('sqlite');
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH); 
				break;
			case "informix":
				$this->db = ADONewConnection('informix');		
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName) or die("Error: Could not connect to the database");
			    break;
            case "informix72":
				$this->db = ADONewConnection('informix72');		
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName) or die("Error: Could not connect to the database");
			    break;
            
            case "odbc":
                $this->db = ADONewConnection($this->dbType);
                $dsn = "DSN=".$this->zyKIxGFCDaGuObCtPLcH.";uid=".$this->LYZymBHAGWBWWOZHXICM."; pwd=".$this->password;
                $this->db->Connect($dsn);
                break;
            
			default:	
				$this->db = ADONewConnection('mysqli'); 
				$this->db->Connect($this->zyKIxGFCDaGuObCtPLcH, $this->LYZymBHAGWBWWOZHXICM, $this->password, $this->databaseName) or die("Error: Could not connect to the database");
				if(!empty($this->charset)) {
					$this->db->Execute("SET NAMES '$this->charset'");
				}
		}			
	}
	       
	//return all results from executing query
	public function EtrPEtuENDzSLqqlwjdu($jliXqQXpmVaoqoBsHAOA){
		$this->db->SetFetchMode(ADODB_FETCH_BOTH);
		$result = $this->db->Execute($jliXqQXpmVaoqoBsHAOA) or die(
            (C_Utility::is_debug())?
                "\n". 'PHPGRID_DEBUG: C_Database->db_query() - '. $this->db->ErrorMsg() ."\n":
                "\n". 'PHPGRID_ERROR: Could not execute query. Error 101.' ."\n");

		$this->result = $result;        
        return $result;
	}
	
	//return limited result from executing query
	public function wCcQTuVYgSckNyasyuoU($sql, $size, $offset){
		$this->db->SetFetchMode(ADODB_FETCH_BOTH);
		$result = $this->db->SelectLimit($sql, $size, $offset) or die(
            (C_Utility::is_debug())?
                "\n". 'PHPGRID_DEBUG: C_Database->select_limit() - '. $this->db->ErrorMsg() ."\n":
                "\n". 'PHPGRID_ERROR: Could not execute query. Error 102' ."\n");

        $this->result = $result;        
		return $result;
	}
	
	//return all results from executing query as an array
	public function zuQiBKYyzWEXEWjqTbpf($jliXqQXpmVaoqoBsHAOA, $size, $QYzFABgdMqNPITbDJjIk){
		$result = $this->wCcQTuVYgSckNyasyuoU($jliXqQXpmVaoqoBsHAOA, $size, $QYzFABgdMqNPITbDJjIk);
		$FxPcSMgrnGkrrUqTLNOR = $result->GetArray();

        $this->result = $FxPcSMgrnGkrrUqTLNOR;
		return $FxPcSMgrnGkrrUqTLNOR;
	}
    	
	public function PlITTecRUaKgjwfphKQU(&$result){
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		if(!$result->EOF){
		 	$rs = $result->fields;
		 	$result->MoveNext();        
		 	return $rs;
		}
	}
	
	public function nQYSxKFVQQFOYRZcWfRT(&$result){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		if(!$result->EOF){
		 	$rs = $result->fields;
		 	$result->MoveNext();   
		 	return $rs;
		}  
	}
	
	public function bBJkbvWCrHXMxILnqSyw(&$result){
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		if(!$result->EOF){
		 	$rs = $result->fields;
		 	$result->MoveNext();  
		 	return $rs;
		}
	}	
		
	public function UrubXhEWkKBpqgBEgzuK($result){
        return $result->RecordCount();
        
	} 
	
	//run query and fetch first re
	public function query_then_fetch_array_first($jliXqQXpmVaoqoBsHAOA){
		$ADODB_FETCH_MODE = ADODB_FETCH_BOTH;
		$result = $this->db->Execute($jliXqQXpmVaoqoBsHAOA) or die('PHPGRID_ERROR: query_then_fetch_array_first() - '. $this->db->ErrorMsg());
		
		if(!$result->EOF){
			$rs = $result->fields;
			$result->MoveNext();     
			return $rs;
		}
	}
	
	//returns number of fields in a record set
	public function num_fields($result){
		return $result->FieldCount();
	}
	
	//return field name of index in a record set
	public function field_name($result, $index){
		$exfxgafGrjtOlCNYoiPv = new ADOFieldObject();
		$exfxgafGrjtOlCNYoiPv = $result->FetchField($index);
		return isset($exfxgafGrjtOlCNYoiPv->name) ? $exfxgafGrjtOlCNYoiPv->name : "";
	}
       
    //return the field type of a given field in a record set
    public function VMQORsBKIuzwBqjXIXyl($result, $index){
        $exfxgafGrjtOlCNYoiPv = new ADOFieldObject();
        $exfxgafGrjtOlCNYoiPv = $result->FetchField($index);
        return isset($exfxgafGrjtOlCNYoiPv->type) ? $exfxgafGrjtOlCNYoiPv->type : "";
    }
    
    //returns meta type of the index field in a record set
    public function EwgdjJxDBHtjNonvuUPA($result, $index){
        $exfxgafGrjtOlCNYoiPv = new ADOFieldObject();
        $exfxgafGrjtOlCNYoiPv = $result->FetchField($index);
	

        $type = $result->MetaType($exfxgafGrjtOlCNYoiPv->type, $exfxgafGrjtOlCNYoiPv->max_length);   
                
        return $type;              
    }
    
    //return field name of a table if that field exsit in that table
    public function hPAWyuoeKGSrMikDjtxa($table, $EzmmHCfAcURpMWcxsfOx){
        $arr = array();   
        $arr =  $this->db->MetaColumns($table);

        $exfxgafGrjtOlCNYoiPv = new ADOFieldObject();
        if(isset($arr[strtoupper($EzmmHCfAcURpMWcxsfOx)])){
            $exfxgafGrjtOlCNYoiPv = $arr[strtoupper($EzmmHCfAcURpMWcxsfOx)];
    
    
    
            return $exfxgafGrjtOlCNYoiPv;                                        
        }else{
            return false;
        }

    }
    
    //returns the index of "$field_name" key in a result
    public function lHGMnYhnTIFoLxnJpUUW($result, $field_name){
        $KETiETsYqXZQXZrNR = $this->num_fields($result);
        $i=0;
        for($i=0;$i<$KETiETsYqXZQXZrNR;$i++){
            if($field_name == $this->field_name($result, $i))
                return $i;        
        }    
        return -1;
    }
	
	//return the max length of index field in a db execute result
	public function cnjyfICcQBfmEDftkTRn($result, $index){
		$exfxgafGrjtOlCNYoiPv = new ADOFieldObject();
		$exfxgafGrjtOlCNYoiPv = $result->FetchField($index);
		return isset($exfxgafGrjtOlCNYoiPv->max_length) ? $exfxgafGrjtOlCNYoiPv->max_length : "";
	}

	// returns sql query part for WHERE clause
	function quote_field($sql, $fieldname, $fieldvalue){
		$rs         = $this->wCcQTuVYgSckNyasyuoU($sql, 1, 1);
        $meta_type    = $this->EwgdjJxDBHtjNonvuUPA($rs, $this->lHGMnYhnTIFoLxnJpUUW($rs, $fieldname));
		switch ($meta_type) {
			case 'I':
			case 'N':
			case 'R':
			case 'L':
				$qstr = $fieldname ."=". $fieldvalue;  
				break;
			default:
				$qstr = $fieldname ."='". $fieldvalue ."'";    
				break;
		}
		
		return $qstr;
	}

    function quote_fields(&$rs, $zrXrgBcJRXotwTescYJA=array(), $key_value=array()){
        $pk_val_new = array();

        $fm_types = array();
        for($t=0; $t<count($zrXrgBcJRXotwTescYJA); $t++){
            $meta_type   = $this->EwgdjJxDBHtjNonvuUPA($rs, $this->lHGMnYhnTIFoLxnJpUUW($rs, $zrXrgBcJRXotwTescYJA[$t]));
            $fm_types[] = $meta_type;
        }

        for($i =0; $i < count($key_value); $i++){
            $pk_val_fields = explode(PK_DELIMITER, $key_value[$i]);

            for($j=0; $j < count($zrXrgBcJRXotwTescYJA); $j++){
                $meta_type = $fm_types[$j];
                if($meta_type != 'I' && $meta_type != 'N' && $meta_type != 'R'){
                    $pk_val_fld = "'" . $pk_val_fields[$j] ."'";
                }else{
                    $pk_val_fld = $pk_val_fields[$j];
                }
                $pk_val_fields[$j] = $pk_val_fld;
            }

            $pk_val_new[] = '('. implode(',', $pk_val_fields) .')';
        }

        return $pk_val_new;
    }

	//returns field names array
	public function HVeMWDfzyAyqvmBnmI($result){
		$hsYgbsoKPwcvUUbPQzPB = array();
		$num_fields = $result->FieldCount();
		for($i = 0; $i < $num_fields; $i++) {
			$cTfzUGydhwEfzsysbOmo = $this->field_name($result, $i);             
			$hsYgbsoKPwcvUUbPQzPB[] = $cTfzUGydhwEfzsysbOmo;        
		}          
		
		return $hsYgbsoKPwcvUUbPQzPB;
	} 
	
}
?>
