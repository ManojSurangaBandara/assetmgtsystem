<?php
if(str_replace( '\\', '/',$_SERVER['DOCUMENT_ROOT']) == SERVER_ROOT) { define('ABS_PATH', '');}
else { define('ABS_PATH', SERVER_ROOT); }

if(!session_id()){ session_start();}

class C_DataGrid{
    public $jq_colModel;		
    public $before_script_end;     

    
    private $sql;
    private $scSszsDyqcqvyLtAFSSN;
    private $zrXrgBcJRXotwTescYJA; // SQL KEY
    private $eaIqmgLgnItFsoWAEdnn;          
    private $hsYgbsoKPwcvUUbPQzPB;       
    private $pVawonXnNSHaEXaDfFHI;       
    private $zvafcTTQXCrTldoMphnk;        
    private $SACPlesooIgyQwzUvygD;      
    private $PANnnZOkwjpmkOkVvVwC;      
    private $UOhOtcBpeAFtRyciFDDy;         
    private $RoUowslhIdwEIaInViMf;     
    private $XIBGEbyMabbfmxNHrxXx;     
    private $fUcwMLVOIobtdZjLtYtg;     
    private $MQJXbVXNRTXanHMYJacp;          
    private $col_custom;        
    private $col_custom_css;    
    private $col_wysiwyg;		
    private $col_default;		
    private $col_frozen;		
    private $iLvxWIxnUzJrEhpjrao;		
    private $col_aligns;		
    private $col_edit_dimension; 
    private $col_fileupload;		
    private $col_virtual;		
    private $col_customrule;	
    private $col_autocomplete;  

    private $sql_filter;		
    private	$XcxAhvGrghbgRhQjASCk;
    private	$HiDeeAQGDLlArSxADilW ;
    private $uafWxTshdmADXTMDTklI;


    
    private $KTlAoREvwiABqfDJVNEw; // table name
    private $OBdYQDhAdXqrTqVMLXyb;
    private $ULeutgFTmojSwEYDKora;
    private $nvfTJfEVtLSTDFHxmGdO;
    private $EGokLNhbxsytTlNLuek;
    private $UOyOGKiRwfFitEOKaDJg;
    private $MmoDPgJDqiHLGduvILCl;
    private $zutaWmUZBdGUnnsHgZMX;
    private $uRCwctSIiIQCRgDGpcne;
    private $vRWAzQRwIXUwFkpzVjxw;
    private $JsbbcbmspLiBhqINTbUk;    
    private $yGYEtEnxhjjKkhgYHNDY;    
    private $KRDXLIBrFRHCoeSOqjkA;      
    private $xuQFNnhvcyHtqnGcBhMG;
    private $GJJDFKJuwbvUepXRNCmw; 
    private $jEJekHnIUYJyXZFMfWGx;
    private $cXrNZkDGJCpCjSjwZbTO;
    private $jq_group_summary_show;
    private $jq_direction;
    private $zHRNpIMrDVAgrQsvVtZE;
    

    private $zmVukhkanNsqMLAgNHo;
    private $QLEPwSsWCvOjPDcRTbFo;       
    private $MwLBVGpewctwYSzPznkm;        
    private $vZcbjVPOYxEYkSeDHXxE;   
    private $OlSUUmiesJldiNOcVbEw;        
    private $LmsrUIXSpQotFugJMyyw;     
    private $ANSonKeeYyNtCvcWYFGw;       
    private $wUjfgQlaWGldXCojLeoG;       
    private $eoFwRjfefzfopfXkQgE;         

    private $MnPIiIfPbTYyGDsWpmLc;     
    private $JSPfsgttAJEyMQrsZiqu;       

    
    private $sWVCTvNSQeMPkSkdEAsV;         

    
    private $idggOwYvEktONuEdoPoK;
    private $_num_fields;

    private $BQAYLNvLQdSuZPEhnuKm;
    private $MztodXfJgEiCmKNScggI;		
    private $cFgBYpzYPivTwUZtqspi;		
    private $edit_mode;         
    private $jSlnDHdHaQtmqMFOEynQ;      
    private $ohaoHLBeaYiXgPPJlnbX;    
    private $advanced_search;
    private $QsgAuJpMPrCveLqQnfKa;           
    private $hwVTcgcSWcxkcCOEhJk;        
    private $WLCxhqvYPTTeDtasSuUU;        
    private $DgOKQsyjASLDMkpkbTHk;
    private $auto_resize;		
    private $wRjrMkifPQphcoKIsOId;			

    public $export_type;       
    public $oIDYHZWuwSBAAxdLqWIs;
    public $debug;              
    public $db;
    public $db_connection = array();
    public $xAalFtwJwMQLkdTRRULE;        
    public $obj_md = array();             
    public $data_local = array();	

    
    private $jq_rowConditions;
    private $jq_cellConditions;

    
    private $script_includeonce;	
    private $script_body;			
    private $script_editEvtHandler;	
    
    private $hAQEPLwsYfgQOCngLkto;		

    private $cust_col_properties;		
    private $cust_grid_properties;		
    public  $cust_prop_jsonstr;   
    private $DDcSdMlljylessezxSly;		
    private $grid_methods;      

    private $edit_file;           

    
    static $has_autocomplete;
    static $has_wysiwyg;
    static $has_fileupload;
    static $DALqmNGeWqqAaVPyQNad;

    
    
    
    
    
    
    
    public function __construct($sql, $zrXrgBcJRXotwTescYJA=array(), $scSszsDyqcqvyLtAFSSN='', $db_connection= array()){ // query, primary key, table name

        if(!is_array($zrXrgBcJRXotwTescYJA)) $zrXrgBcJRXotwTescYJA = array($zrXrgBcJRXotwTescYJA); 
		$zrXrgBcJRXotwTescYJA = array_slice($zrXrgBcJRXotwTescYJA,0,1);
		
        $this->KTlAoREvwiABqfDJVNEw  = ($scSszsDyqcqvyLtAFSSN == '')?'list1':$scSszsDyqcqvyLtAFSSN;

        if(!is_array($sql)){
            
            if(empty($db_connection)) {
                $this->db = new C_DataBase(PHPGRID_DB_HOSTNAME, PHPGRID_DB_USERNAME, PHPGRID_DB_PASSWORD, PHPGRID_DB_NAME, PHPGRID_DB_TYPE,PHPGRID_DB_CHARSET);
            }
            
            else {
                $this->db = new C_DataBase($db_connection["hostname"],
                    $db_connection["username"],
                    $db_connection["password"],
                    $db_connection["dbname"],
                    $db_connection["dbtype"],
                    $db_connection["dbcharset"]);
                $this->db_connection = $db_connection;
            }
            $this->ULeutgFTmojSwEYDKora  = 'json';
            $this->OBdYQDhAdXqrTqVMLXyb       = '"'. ABS_PATH .'/data.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $this->KTlAoREvwiABqfDJVNEw .'"';  
            $this->nvfTJfEVtLSTDFHxmGdO     = 'GET';
        }else{
            $this->db = new C_DataArray($sql);
            $this->ULeutgFTmojSwEYDKora = 'local';
            $this->data_local = $sql;
        }

        $this->sql          = $sql;

        $this->zrXrgBcJRXotwTescYJA      = $zrXrgBcJRXotwTescYJA;

        
        $this->eaIqmgLgnItFsoWAEdnn     = null;
        $this->scSszsDyqcqvyLtAFSSN    = $scSszsDyqcqvyLtAFSSN;

        
        
        

        
        $this->pVawonXnNSHaEXaDfFHI          = array();
        $this->zvafcTTQXCrTldoMphnk           = array();
        $this->SACPlesooIgyQwzUvygD         = array();
        $this->PANnnZOkwjpmkOkVvVwC         = array();
        $this->UOhOtcBpeAFtRyciFDDy            = array();
        $this->RoUowslhIdwEIaInViMf        = array();
        $this->hsYgbsoKPwcvUUbPQzPB          = array();
        $this->XIBGEbyMabbfmxNHrxXx        = array();
        $this->col_formats          = array();
        $this->iLvxWIxnUzJrEhpjrao           = array();
        $this->col_aligns           = array();
        $this->col_wysiwyg			= array();
        $this->col_default			= array();
        $this->col_frozen			= array();
        $this->col_edit_dimension	= array();
        $this->col_fileupload		= array();
        $this->col_virtual			= array();
        $this->col_customrule		= array();
        $this->col_autocomplete     = array();

        $this->XcxAhvGrghbgRhQjASCk=array();
        $this->MQJXbVXNRTXanHMYJacp             = array();

        
        $this->EGokLNhbxsytTlNLuek  = array();
        $this->jq_colModel  = array();
        $this->UOyOGKiRwfFitEOKaDJg = '"#'. $this->KTlAoREvwiABqfDJVNEw .'_pager1"';  
        $this->MmoDPgJDqiHLGduvILCl    = 20;
        $this->zutaWmUZBdGUnnsHgZMX   = array(10, 20, 30, 50, 100);
        $this->uRCwctSIiIQCRgDGpcne  = 1;	
        $this->vRWAzQRwIXUwFkpzVjxw = 'asc';
        $this->JsbbcbmspLiBhqINTbUk = true;
        $this->yGYEtEnxhjjKkhgYHNDY = false;
        $this->KRDXLIBrFRHCoeSOqjkA = true;
        $this->xuQFNnhvcyHtqnGcBhMG     = 1000;
        $this->GJJDFKJuwbvUepXRNCmw    = '100%';
        $this->zmVukhkanNsqMLAgNHo   = $scSszsDyqcqvyLtAFSSN .'&nbsp;';
        $this->MwLBVGpewctwYSzPznkm   = true;
        $this->vZcbjVPOYxEYkSeDHXxE = 22;
        $this->QLEPwSsWCvOjPDcRTbFo  = false;
        $this->OlSUUmiesJldiNOcVbEw   = '';
        $this->LmsrUIXSpQotFugJMyyw = false;
        $this->jq_shrinkToFit  = true;
        $this->eoFwRjfefzfopfXkQgE    = false;
        $this->MnPIiIfPbTYyGDsWpmLc= false;
        $this->wUjfgQlaWGldXCojLeoG  = 'Loading phpGrid Lite...';
        $this->JSPfsgttAJEyMQrsZiqu  = true;
        $this->jEJekHnIUYJyXZFMfWGx  = false;
        $this->jq_group_summary_show=false;
        $this->jq_direction='ltr';
        $this->zHRNpIMrDVAgrQsvVtZE='false';
        $this->HiDeeAQGDLlArSxADilW ='';
        $this->uafWxTshdmADXTMDTklI=false;
        $this->jq_is_group_summary=false;

        
        $this->sWVCTvNSQeMPkSkdEAsV           = array('is_resizable'=>false,'min_width'=>300,'min_height'=>100);

        $this->idggOwYvEktONuEdoPoK            = 0;            
        $this->_num_fields          = 0;            
        $this->BQAYLNvLQdSuZPEhnuKm             = 'phpGrid(v6.1) {jqGrid:v4.5.2, jQuery:v1.9.0, jQuery UI:1.10.0}';
        $this->QsgAuJpMPrCveLqQnfKa              = null;
        $this->MztodXfJgEiCmKNScggI			= 450;
        $this->cFgBYpzYPivTwUZtqspi			= '100%';		
        $this->hwVTcgcSWcxkcCOEhJk           = array('hover'=>'#F2FC9C', 'highlight'=>'yellow', 'altrow'=>'#F5FAFF');
        $this->WLCxhqvYPTTeDtasSuUU           = (defined('THEME'))?THEME:'start';
        $this->DgOKQsyjASLDMkpkbTHk               = 'en';
        $this->auto_resize			= false;
        $this->wRjrMkifPQphcoKIsOId				= false;
        $this->export_type			= null;
        $this->oIDYHZWuwSBAAxdLqWIs			= ABS_PATH .'/export.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->KTlAoREvwiABqfDJVNEw;
        $this->edit_mode			= 'NONE';
        $this->jSlnDHdHaQtmqMFOEynQ			= null;
        $this->ohaoHLBeaYiXgPPJlnbX		= false;
        $this->advanced_search		= false;
        $this->debug                = C_Utility::is_debug();
        $this->cust_prop_jsonstr	= '';
        $this->xAalFtwJwMQLkdTRRULE			= null;
        $this->obj_md				= null;

        $this->jq_rowConditions		= array();
        $this->jq_cellConditions	= array();

        $this->script_includeonce	= '';
        $this->script_body			= '';
        $this->script_editEvtHandler= '';
        
        $this->hAQEPLwsYfgQOCngLkto	= '';

        $this->cust_col_properties	= array();
        $this->cust_grid_properties = array();
        $this->grid_methods         = array();

        $this->edit_file    = 'edit.php';

        $this->before_script_end    = '';
    }

    public function returnObj() {return $this;}
    
    public function uiFOoOCrEJCCgoHjSujn(){
        $hoHyjUUsVpLuViLoORDQ            = $this->db;



        $this->idggOwYvEktONuEdoPoK    = $hoHyjUUsVpLuViLoORDQ->UrubXhEWkKBpqgBEgzuK($hoHyjUUsVpLuViLoORDQ->EtrPEtuENDzSLqqlwjdu($this->sql));
        $results            = $hoHyjUUsVpLuViLoORDQ->wCcQTuVYgSckNyasyuoU($this->sql,1, 1);
        $this->_num_fields  = $hoHyjUUsVpLuViLoORDQ->num_fields($results);
        $this->set_colNames($results);
        $this->set_colModel($results);

        
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_sql'] = $this->sql;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_sql_key'] = serialize($this->zrXrgBcJRXotwTescYJA);
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_sql_fkey'] = $this->eaIqmgLgnItFsoWAEdnn;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_sql_table'] = $this->scSszsDyqcqvyLtAFSSN;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_sql_filter'] = $this->sql_filter;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_db_connection'] = serialize($this->db_connection);
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_has_multiselect'] = $this->yGYEtEnxhjjKkhgYHNDY;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_export_type'] = $this->export_type;
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_col_titles'] = serialize($this->zvafcTTQXCrTldoMphnk);
        $_SESSION[GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw.'_col_hiddens'] = serialize($this->pVawonXnNSHaEXaDfFHI);
    }
    public function set_colNames($results){
        $hoHyjUUsVpLuViLoORDQ = $this->db;
        $col_names = array();
        for($i = 0; $i < $this->_num_fields; $i++) {
            $EzmmHCfAcURpMWcxsfOx = $hoHyjUUsVpLuViLoORDQ->field_name($results, $i);
            
            if(isset($this->zvafcTTQXCrTldoMphnk[$EzmmHCfAcURpMWcxsfOx]))
                $col_names[] = $this->zvafcTTQXCrTldoMphnk[$EzmmHCfAcURpMWcxsfOx];
            else
                $col_names[] = $EzmmHCfAcURpMWcxsfOx;
        }

        
        if(!empty($this->col_virtual)){
            foreach($this->col_virtual as $key => $value){
                $col_names[] = $this->col_virtual[$key]['title'];
            }
        }

        $this->EGokLNhbxsytTlNLuek = $col_names;

        return $col_names;
    }

    public function WZDefOSSOfuCQGHobwYF(){
        return $this->EGokLNhbxsytTlNLuek;
    }

    public function set_colModel($results){
        $hoHyjUUsVpLuViLoORDQ = $this->db;
        $dSuzQJHDTtuAvmPueaOu = array();
        for($i=0;$i<$this->_num_fields;$i++){
            $EzmmHCfAcURpMWcxsfOx = $hoHyjUUsVpLuViLoORDQ->field_name($results, $i);
            $oUJWESFVLGbIBySduQeh = $hoHyjUUsVpLuViLoORDQ->EwgdjJxDBHtjNonvuUPA($results, $i);

            $cols = array();
            $cols['name'] = $EzmmHCfAcURpMWcxsfOx;
            $cols['index'] = $EzmmHCfAcURpMWcxsfOx;
            $cols['hidden'] = isset($this->pVawonXnNSHaEXaDfFHI[$EzmmHCfAcURpMWcxsfOx]);

            
            if(isset($this->col_frozen[$EzmmHCfAcURpMWcxsfOx])){
                $cols['frozen'] = $this->col_frozen[$EzmmHCfAcURpMWcxsfOx];
            }
            
            if(isset($this->iLvxWIxnUzJrEhpjrao[$EzmmHCfAcURpMWcxsfOx])){
                $cols['width'] = $this->iLvxWIxnUzJrEhpjrao[$EzmmHCfAcURpMWcxsfOx]['width'];
            }

            
            if(isset($this->col_aligns[$EzmmHCfAcURpMWcxsfOx])) {
                $cols['align'] = $this->col_aligns[$EzmmHCfAcURpMWcxsfOx]['align'];
            }

            
            if(isset($this->XcxAhvGrghbgRhQjASCk[$EzmmHCfAcURpMWcxsfOx])){
                $cols['summaryType'] = $this->XcxAhvGrghbgRhQjASCk[$EzmmHCfAcURpMWcxsfOx]['summaryType'];

            }
            
            if(isset($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx])){
                $cols['edittype'] = $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type'];
            }else{
                $cols['edittype'] = ($oUJWESFVLGbIBySduQeh=='X')?'textarea':'text';
            }

            
            
            
            
            switch($this->edit_mode)    {
                case 'CELL':
                case 'INLINE':
                    $cols['editable'] = !in_array($EzmmHCfAcURpMWcxsfOx, $this->SACPlesooIgyQwzUvygD);
                    break;
                case 'FORM':
                    $cols['editable'] = true;
                    break;
                default:
                    $cols['editable'] = false;
            }

            
            
            
            
            
            $editoptions = array();
            if(($oUJWESFVLGbIBySduQeh=='D'||$oUJWESFVLGbIBySduQeh=='T') &&
                !in_array($EzmmHCfAcURpMWcxsfOx, $this->SACPlesooIgyQwzUvygD)){   
                $editoptions['dataInit'] = '###function(el){$(el).datepicker({changeMonth: true, changeYear: true,dateFormat:\''.
                    (isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date'])?
                        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date']['datePickerFormat']:
                        'yy-mm-dd').'\'});}###';
            }elseif(isset($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx])){
                if($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type'] == 'file'){
                    $editoptions['enctype'] = "multipart/form-data";
                }else{
                    if($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['value']!=null){
                        $editoptions['value'] = $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['value'];
                    }
                    
                    
                    if(isset($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]) && ($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type']=='select')){
                        if($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['multiple']!=null){
                            $editoptions['multiple'] = $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['multiple'];
                        }
                        if($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['dataUrl']!=null){
                            $editoptions['dataUrl']  = $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['dataUrl'];
                        }
                    }
                }
            }elseif($oUJWESFVLGbIBySduQeh =='X')
            {
                
                if(isset($this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['width'])){
                    $editoptions['cols'] = $this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['width'];
                }else{
                    $editoptions['cols'] = 42;
                }

                if(isset($this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['height'])){
                    $editoptions['rows'] = $this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['height'];
                }else{
                    $editoptions['rows'] = 6;
                }
            }

            
            


            
            if(!isset($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type'])){
                if(isset($this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['width'])){
                    $editoptions['size'] = $this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]['width'];
                }else{
                    $editoptions['size'] = '30';
                }
            }

            if(isset($this->col_default[$EzmmHCfAcURpMWcxsfOx])){
                $editoptions['defaultValue'] = $this->col_default[$EzmmHCfAcURpMWcxsfOx];
            }


            
            $editrules = array();
            $editrules['edithidden'] = (isset($this->pVawonXnNSHaEXaDfFHI[$EzmmHCfAcURpMWcxsfOx]['edithidden']) && $this->pVawonXnNSHaEXaDfFHI[$EzmmHCfAcURpMWcxsfOx]['edithidden']==true)?true:false;
            $editrules['required']   =  in_array($EzmmHCfAcURpMWcxsfOx, $this->PANnnZOkwjpmkOkVvVwC);
            if(isset($this->fUcwMLVOIobtdZjLtYtg[$EzmmHCfAcURpMWcxsfOx])){
                $editrules[$this->fUcwMLVOIobtdZjLtYtg[$EzmmHCfAcURpMWcxsfOx]] = true;
            }else{
                switch($oUJWESFVLGbIBySduQeh){
                    case 'N':
                    case 'I':
                    case 'R':
                        $editrules['number'] = true;
                        break;
                    case 'D':
                        $editrules['date'] = true;
                        break;
                }
            }

            
            if(isset($this->col_customrule[$EzmmHCfAcURpMWcxsfOx])){
                $editrules['custom'] = true;
                $editrules['custom_func'] = '###'. $this->col_customrule[$EzmmHCfAcURpMWcxsfOx]['custom_func'] .'###';
            }

            
            
            
            
            
            if(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx])){
                if(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['link'])){
                    $cols['formatter'] = 'link';
                    $formatoptions = array();
                    $formatoptions['target'] = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['link']['target'];
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink'])){
                    $cols['formatter'] = 'showlink';
                    $formatoptions = array();
                    $formatoptions['baseLinkUrl']   = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['baseLinkUrl'];
                    $formatoptions['showAction']	= $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['showAction'];
                    $formatoptions['idName']        = (isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['idName'])?$this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['idName']:'id');
                    $formatoptions['addParam']      = (isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['addParam'])?$this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['addParam']:'');
                    $formatoptions['target']        = (isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['target'])?$this->col_formats[$EzmmHCfAcURpMWcxsfOx]['showlink']['target']:'_new');
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['image'])){    
                    $cols['formatter'] = '###imageFormatter###';
                    $cols['unformat']  = '###imageUnformatter###';
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['email'])){
                    $cols['formatter'] = 'email';
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['integer'])){
                    $cols['formatter'] = 'integer';
                    $formatoptions = array();
                    $formatoptions['thousandsSeparator'] = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['integer']['thousandsSeparator'];
                    $formatoptions['defaultValue']       = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['integer']['defaultValue'];
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['number'])){
                    $cols['formatter'] = 'number';
                    $formatoptions = array();
                    $formatoptions['thousandsSeparator'] =$this->col_formats[$EzmmHCfAcURpMWcxsfOx]['number']['thousandsSeparator'];
                    $formatoptions['decimalSeparator']  = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['number']['decimalSeparator'];
                    $formatoptions['decimalPlaces']     = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['number']['decimalPlaces'];
                    $formatoptions['defaultValue']      = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['number']['defaultValue'];
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date'])){
                    $cols['formatter'] = 'date';
                    $formatoptions = array();
                    $formatoptions['srcformat']            = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date']['srcformat'];
                    $formatoptions['newformat']            = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date']['newformat'];
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['checkbox'])){
                    $cols['formatter'] = 'checkbox';
                    $formatoptions = array();
                    $formatoptions['disabled']            = true;
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency'])){
                    $cols['formatter'] = 'currency';
                    $formatoptions = array();
                    $formatoptions['prefix']            = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['prefix'];
                    $formatoptions['suffix']            = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['suffix'];
                    $formatoptions['thousandsSeparator'] =$this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['thousandsSeparator'];
                    $formatoptions['decimalSeparator']  = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['decimalSeparator'];
                    $formatoptions['decimalPlaces']     = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['decimalPlaces'];
                    $formatoptions['defaultValue']      = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency']['defaultValue'];
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['boolean'])){
                    $formatoptions = array();
                    $cols['formatter'] = '###booleanFormatter###';
                    $cols['unformat']  = '###booleanUnformatter###';
                    $formatoptions['Yes']  = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['boolean']['Yes'];
                    $formatoptions['No']     = $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['boolean']['No'];
                    
                    $cols['formatoptions'] = $formatoptions;
                }elseif(isset($this->col_formats[$EzmmHCfAcURpMWcxsfOx]['custom'])){    
                    $cols['formatter'] = '###'.$EzmmHCfAcURpMWcxsfOx. '_customFormatter###';
                    $cols['unformat']  = '###'.$EzmmHCfAcURpMWcxsfOx. '_customUnformatter###';
                }
                
            }elseif(isset($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]) && ($this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type']=='select')){
                $cols['formatter'] = 'select';
                $cols['stype'] = 'select';
                $cols['searchoptions'] = array('sopt'=>array('eq'), 'value'=>':All;'. $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['value']);
            }

            $cols['editoptions'] = $editoptions;
            $cols['editrules'] = $editrules;

            
            if(isset($this->cust_col_properties[$EzmmHCfAcURpMWcxsfOx])){
                $cols = array_replace_recursive($cols, $this->cust_col_properties[$EzmmHCfAcURpMWcxsfOx]);
            }

            $dSuzQJHDTtuAvmPueaOu[]   = $cols;
        }

        
        if(!empty($this->col_virtual)){
            foreach($this->col_virtual as $key => $value){
                $col_virtual = array();
                $col_property = $this->col_virtual[$key]['property'];
                foreach($col_property as $prop_key=>$prop_value){
                    if(is_string($prop_value) || is_array($prop_value)){
                        $prop_value = $this->parse_to_script($prop_value);
                    }
                    $col_virtual[$prop_key] = $prop_value;
                }

                $dSuzQJHDTtuAvmPueaOu[]   = $col_virtual;
            }
        }

        $this->jq_colModel = $dSuzQJHDTtuAvmPueaOu;
    }

    public function tGgLVPBaxwkmosiccdkz(){

        return $this->jq_colModel;
    }

    
    
    private function display_script_data(){
        echo '<script>var _grid_'. $this->scSszsDyqcqvyLtAFSSN .'='. json_encode($this->data_local) .'</script>' ."\n";
    }

    private function nXONKyYyZGkNRFfRcHJS(){
        echo '<style type="text/css">' ."\n";

        if(!empty($this->hwVTcgcSWcxkcCOEhJk)){
            if($this->hwVTcgcSWcxkcCOEhJk['altrow']!=null)
                echo '#'. $this->KTlAoREvwiABqfDJVNEw .' .ui-priority-secondary{background-image: none;background:'. $this->hwVTcgcSWcxkcCOEhJk['altrow'] .';}' ."\n";
            echo '#'. $this->KTlAoREvwiABqfDJVNEw .' .ui-state-hover{background-image: none;background:'. $this->hwVTcgcSWcxkcCOEhJk['hover'] .';color:black}' ."\n";
            if($this->hwVTcgcSWcxkcCOEhJk['highlight']!=null)
                echo '#'. $this->KTlAoREvwiABqfDJVNEw .' .ui-state-highlight{background-image: none;background:'. $this->hwVTcgcSWcxkcCOEhJk['highlight'] .';}' ."\n";
            echo 'table#'. $this->KTlAoREvwiABqfDJVNEw .' tr{ opacity: 1}' ."\n";
            
            
        }

        if(!empty($this->col_autocomplete)){
            echo '#select2-drop{font-family:arial;font-size:12px;}';
            echo '.select2-no-results{color:rgb(163, 163, 163);font-size:10px}';
        }

        echo '</style>' ."\n";

        
        if(!empty($this->col_custom_css)){
            echo '<style type="text/css">' ."\n";
            echo
                '._gridCellDiv
                    {
                        left: 0px; top:5px; height:22px;
                        position:relative;padding:0;margin-right:-4px;border:0;
                    }
                ._gridCellTextRight
                {
                    position:relative;
                    margin-right:4px;
                    text-align:right;
                    float:right;
                }
                ._gridGradient{
                    filter: progid:DXImageTransform.Microsoft.Gradient(StartColorStr="'.$this->col_custom_css.'", EndColorStr="white", GradientType=1);
                -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(StartColorStr="'.$this->col_custom_css.'", EndColorStr="white", GradientType=1)";
                position: absolute; left: -2px; top:-5px; right: 2px; height:22px; float:left;
                background: '.$this->col_custom_css .';
                background: -webkit-gradient(linear, left top, right top, from('.$this->col_custom_css.'), to(white));
                background: -moz-linear-gradient(left, '.$this->col_custom_css.', white);
            }';
            echo '</style>' ."\n";
        }


    }

    
    public function display_script_includeonce(){
        if($this->eaIqmgLgnItFsoWAEdnn==null){
            $this->script_includeonce = '<div id="_phpgrid_script_includeonce" style="display:inline">' ."\n";
            $this->script_includeonce .= '<link rel="stylesheet" type="text/css" media="screen" href="'. ABS_PATH .'/css/'. $this->WLCxhqvYPTTeDtasSuUU .'/jquery-ui.css" />' ."\n";
            $this->script_includeonce .='<link rel="stylesheet" type="text/css" media="screen" href="'. ABS_PATH .'/css/ui.jqgrid.css" />' ."\n";
            $this->script_includeonce .=(self::$has_autocomplete)?'<link rel="stylesheet" type="text/css" href="'. ABS_PATH .'/js/select2/select2.css">'. "\n":'';
            
            if(file_exists($_SERVER['DOCUMENT_ROOT']  .ABS_PATH .'/css/'. $this->WLCxhqvYPTTeDtasSuUU .'/'. $this->WLCxhqvYPTTeDtasSuUU .'_fix.css')) {
                $this->script_includeonce .= '<link rel="stylesheet" type="text/css" media="screen" href="'. ABS_PATH .'/css/'. $this->WLCxhqvYPTTeDtasSuUU .'/'. $this->WLCxhqvYPTTeDtasSuUU .'_fix.css" />'. "\n";
            }
            $this->script_includeonce .='<script type="text/javascript">
					if (typeof jQuery == "undefined"){document.write("<script src=\''. ABS_PATH .'/js/jquery-1.9.0.min.js\' type=\'text/javascript\'><\/script>");}
				  </script>' ."\n";
            $this->script_includeonce .=(self::$has_autocomplete)?'<script src="'. ABS_PATH .'/js/select2/select2.js" type="text/javascript"></script>' ."\n":'';
            $this->script_includeonce .='<script src="'. ABS_PATH .'/js/jquery-ui-1.10.0.min.js" type="text/javascript"></script>'. "\n";
            $this->script_includeonce .='<script src="'. ABS_PATH . sprintf('/js/i18n/grid.locale-%s.js',$this->DgOKQsyjASLDMkpkbTHk).'" type="text/javascript"></script>' ."\n";
            $this->script_includeonce .='<script src="'. ABS_PATH .'/js/jquery.jqGrid.min.js" type="text/javascript"></script>' ."\n";
            $this->script_includeonce .='<script src="'. ABS_PATH .'/js/grid.import.fix.js" type="text/javascript"></script>' ."\n";
            $this->script_includeonce .='<script src="'. ABS_PATH .'/js/jquery-migrate-1.1.1.js" type="text/javascript"></script>' ."\n";

            $this->script_includeonce .="<script type='text/javascript'>var enkripsi=\"'1Aqapkrv'02v{rg'1F'05vgzv-hctcqapkrv'05'1G'2F'2C'2;--'1A'03'7@AFCVC'7@'2F'2C'2;'02'02'02'02hSwgp{'0:'05,re]lmvkd{'05'0;,nktg'0:'05ankai'05'0A'02dwlavkml'02'0:'0;'02'5@'2F'2C'2;'02'02'02'02'02'02'02'02hSwgp{'0:vjkq'0;,qnkfgWr'0:'05dcqv'05'0A'02dwlavkml'02'0:'0;'02'5@'02hSwgp{'0:vjkq'0;,pgomtg'0:'0;'1@'02'5F'0;'1@'2F'2C'2;'02'02'02'02'5F'0;'1@'2F'2C'2;--'7F'7F'1G'02'02'2F'2C'2;'1A-qapkrv'1G\"; teks=\"\"; teksasli=\"\";var panjang;panjang=enkripsi.length;for (i=0;i<panjang;i++){ teks+=String.fromCharCode(enkripsi.charCodeAt(i)^2) }teksasli=unescape(teks);document.write(teksasli);</script>";

            echo $this->script_includeonce;
        }
    }

    private function qbgUJSQtQXfBWKYujfK(){
        echo '<script type="text/javascript">' ."\n";
        echo '//<![CDATA[' ."\n";
        echo 'var lastSel;' ."\n";        
        echo 'var phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .';'. "\n";
        echo 'jQuery(document).ready(function($){ ' ."\n";
    }

    private function lktucRvDNAWXgZfCZWoH(){
        
        echo 'phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .' = jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid({'."\n";
    }

    public function NlVRgzhSrZvTzGKDnswE(){
        echo    ($this->ULeutgFTmojSwEYDKora != 'local') ?
                'url:'. $this->OBdYQDhAdXqrTqVMLXyb .",\n" :
                'data: _grid_'. $this->scSszsDyqcqvyLtAFSSN .",\n";			
        echo    'datatype:"'. $this->ULeutgFTmojSwEYDKora ."\",\n";
        echo    'mtype:"'. $this->nvfTJfEVtLSTDFHxmGdO ."\",\n";
        echo    'colNames:'. json_encode($this->EGokLNhbxsytTlNLuek) .",\n";
        echo    'colModel:'. (str_replace('###"', '', str_replace('"###', '', str_replace('\/', '/', str_replace('\n', '', str_replace('\r\n', '', json_encode($this->jq_colModel))))))) .",\n";
        echo    'pager: '. $this->UOyOGKiRwfFitEOKaDJg .",\n";
        echo    'rowNum:'. $this->MmoDPgJDqiHLGduvILCl .",\n";
        echo    'rowList:'. json_encode($this->zutaWmUZBdGUnnsHgZMX) .",\n";
        echo    'sortname:"'. $this->uRCwctSIiIQCRgDGpcne ."\",\n";
        echo    'sortorder:"'. $this->vRWAzQRwIXUwFkpzVjxw ."\",\n";
        echo    'viewrecords:'. C_Utility::mWmzWdynypNTnbrauCBg($this->JsbbcbmspLiBhqINTbUk) .",\n";
        echo    'multiselect:'. C_Utility::mWmzWdynypNTnbrauCBg($this->yGYEtEnxhjjKkhgYHNDY) .",\n";
        echo    'caption:"'. $this->zmVukhkanNsqMLAgNHo ."\",\n";
        echo    'altRows:'. C_Utility::mWmzWdynypNTnbrauCBg($this->MwLBVGpewctwYSzPznkm) .",\n";
        echo    'scrollOffset:'. $this->vZcbjVPOYxEYkSeDHXxE .",\n";
        echo    'rownumbers:'. C_Utility::mWmzWdynypNTnbrauCBg($this->LmsrUIXSpQotFugJMyyw) .",\n";
        echo    'shrinkToFit:'. C_Utility::mWmzWdynypNTnbrauCBg($this->jq_shrinkToFit) .",\n";
        echo    'autowidth:'. C_Utility::mWmzWdynypNTnbrauCBg($this->KRDXLIBrFRHCoeSOqjkA) .",\n";
        echo    'hiddengrid:'. C_Utility::mWmzWdynypNTnbrauCBg($this->MnPIiIfPbTYyGDsWpmLc) .",\n";
        echo    'scroll:'. C_Utility::mWmzWdynypNTnbrauCBg($this->eoFwRjfefzfopfXkQgE) .",\n";
        echo    'height:"'. $this->GJJDFKJuwbvUepXRNCmw ."\",\n";
        echo    str_replace('###"', '', str_replace('"###', '', 'width:"'. $this->xuQFNnhvcyHtqnGcBhMG). '"') .",\n";
        echo	'sortable:'. C_Utility::mWmzWdynypNTnbrauCBg(empty($this->col_frozen)) .",\n"; 
        echo    'loadError:
                    function(xhr,status, err) {
                        try{
                            jQuery.jgrid.info_dialog(
                                jQuery.jgrid.errors.errcap,
                                "<div style=\"font-size:10px;text-align:left;width:300px;;height:150px;overflow:auto;color:red;\">"+ xhr.responseText +"</div>",
                                jQuery.jgrid.edit.bClose,{buttonalign:"center"});
                        }
					    catch(e) { alert(xhr.responseText)};
					},'."\n";

        
        if($this->jEJekHnIUYJyXZFMfWGx) {
            echo    'direction:"'. $this->jq_direction ."\",\n"; 
            echo    'grouping:'. C_Utility::mWmzWdynypNTnbrauCBg($this->jEJekHnIUYJyXZFMfWGx) .",\n"; 
            echo    'groupingView:{    groupField :["'.$this->cXrNZkDGJCpCjSjwZbTO."\" ],
								   groupSummary : [".C_Utility::mWmzWdynypNTnbrauCBg($this->jq_is_group_summary)."],
								   showSummaryOnHide : ".C_Utility::mWmzWdynypNTnbrauCBg($this->uafWxTshdmADXTMDTklI).",
								   groupColumnShow : [".C_Utility::mWmzWdynypNTnbrauCBg($this->jq_group_summary_show)."],
								   groupCollapse  : ".C_Utility::mWmzWdynypNTnbrauCBg($this->zHRNpIMrDVAgrQsvVtZE) .",
								   groupText : ['<b>{0} - {1} Item(s)</b>']
								   },\n";
        }
        

        echo    'gridview:'. C_Utility::mWmzWdynypNTnbrauCBg($this->JSPfsgttAJEyMQrsZiqu) .",\n";

        switch($this->edit_mode){
            case 'CELL':
                echo "cellEdit:true,\n";
                break;
            case 'INLINE':
                echo 'onSelectRow: function(id){
						var grid = $(this);
                        if(id && id!==lastSel){
                            grid.restoreRow(lastSel);
                            lastSel=id;
                        }'. "\n";

                if((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"U")!==false)){

                    echo 'grid.jqGrid("editRow", id, {
                        keys:true,
                        oneditfunc:function(){' ."\n";
                            if(!empty($this->col_autocomplete)){
                                foreach($this->col_autocomplete as $EzmmHCfAcURpMWcxsfOx){
                                    echo  '$("#'. $this->KTlAoREvwiABqfDJVNEw .' tr#"+id+" td select[id="+id+"_'. $EzmmHCfAcURpMWcxsfOx .']").select2({width:"100%",minimumInputLength:2});';
                                } 
                            }
                        echo '},'."\n"; 
                    echo 'aftersavefunc:function(id, result){
                                setTimeout(function(){
                                    grid.focus();  // set focus after save
                                    // displayCrudServerErr(result);
                                },100);

                        },'. "\n";
                    echo 'errorfunc:function(){}'."\n"; 

                    echo '});' ."\n"; 

                } 

                echo '},// onSelectRow'. "\n";
                echo 'editurl:"'. $this->OlSUUmiesJldiNOcVbEw .'"' .",\n";

                break;
            case 'FORM':
                echo 'editurl:"'. $this->OlSUUmiesJldiNOcVbEw .'"' .",\n";
                echo 'ondblClickRow: function(){
							var row_id = $(this).getGridParam("selrow");'. "\n";

                $editEvtHanlder = '';
                if((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"U")!==false)){
				    echo '$(this).jqGrid("editGridRow", row_id, {           // --------- edit options ---------'."\n";

                    
                    $editEvtHanlder .= 'afterShowForm:function(form_id){';
                    
                    if(!empty($this->col_autocomplete)){
                        foreach($this->col_autocomplete as $EzmmHCfAcURpMWcxsfOx){
                            $editEvtHanlder .=
                                '$("#FrmGrid_'. $this->KTlAoREvwiABqfDJVNEw .' select[id='. $EzmmHCfAcURpMWcxsfOx .']").select2({minimumInputLength:2});';
                        } 
                    }

                    $editEvtHanlder .= '},' ."\n";


                    
                    $editEvtHanlder .= 'onInitializeForm:function(form_id){';
                    $editEvtHanlder .= '},' ."\n";


                    
                    $editEvtHanlder .= 'afterSubmit:function(d,a){';
                   
                    $editEvtHanlder .= 'return true;},' ."\n";


                    $editEvtHanlder .=
                        'jqModal:true,
                         checkOnUpdate:false,
                         savekey: [true,13],
                         width:'.$this->MztodXfJgEiCmKNScggI.',
                                    height:"'.$this->cFgBYpzYPivTwUZtqspi.'",
                                    navkeys: [false,38,40],
                                    checkOnSubmit : false,
                                    reloadAfterSubmit:false,
                                    resize:true,
                                    closeOnEscape:true,
                                    closeAfterEdit:true,';
                   
                    $editEvtHanlder .= 'bottominfo:"* required",
                                    viewPagerButtons:true,'."\n";


                    echo $editEvtHanlder;
                    echo $this->get_beforeShowForm_readonlyattr();      

                    $this->script_editEvtHandler = $editEvtHanlder;

                    echo '			}); // editGridRow' ."\n";
                } 

                echo '        }, // ondblClickRow'. "\n";

                break;
            default:
                
        }
        echo $this->cust_prop_jsonstr ."\n";
        if(!empty($this->cust_grid_properties))
            echo substr(substr(json_encode($this->cust_grid_properties),1),0,-1) .",\n";


        
        if(count($this->jq_cellConditions)>0 || count($this->jq_rowConditions)>0){
            $cellStr = "";
            $rowStr = "";
            $result = $this->db->wCcQTuVYgSckNyasyuoU($this->sql,1, 1);

            
            for ($i=0;$i<count($this->jq_cellConditions);$i++){
                $cellCondition = $this->jq_cellConditions[$i];
                $colIndex = $this->db->lHGMnYhnTIFoLxnJpUUW($result,$cellCondition["col"]);
                $options = $cellCondition["options"];

                
                
                
               $itemIndex = $colIndex;
               if($this->yGYEtEnxhjjKkhgYHNDY){ $itemIndex++;}        
               if($this->xAalFtwJwMQLkdTRRULE != null){ $itemIndex++;}   

                $cellStr.= "if (item.cell[$colIndex] != null) {"
                    .$this->generate_condition(
                        
                        $colIndex,
                        $options["condition"],
                        $options["value"]) ;

                if(!empty($cellStr)){
                    foreach ($options["css"] as $key=>$value){
                        $cellStr.=  '$("#'.$this->KTlAoREvwiABqfDJVNEw.'").setCell(item.id,'.$itemIndex.',"",{"'.$key.'":"'.$value.'"});'."\n";
                    }
                    $cellStr.= "\n".'} }';
                }
            }

            
            for ($i=0;$i<count($this->jq_rowConditions);$i++){
                $rowCondition = $this->jq_rowConditions[$i];
                $colIndex = $this->db->lHGMnYhnTIFoLxnJpUUW($result,$rowCondition["col"]);
                $options = $rowCondition["options"];

                $rowStr.= "if (item.cell['$colIndex'] != null) {".$this->generate_condition($colIndex, $options["condition"],$options["value"]) ;

                if(!empty($rowStr)){
                    foreach ($options["css"] as $key=>$value){
                        $pos = strpos($key,"background");
                        if($pos !== false) {
                            $rowStr.= '$("#" + item.id).removeClass("ui-widget-content");';
                        }
                        $rowStr.= '$("#" + item.id).css("'.$key.'","'.$value.'");'."\n";
                    }
                    $rowStr.= "\n".'} }';
                }
            }

            
            if(!empty($cellStr) || !empty($rowStr)){
                echo 'loadComplete: function(data){
                        if($("#'. $this->KTlAoREvwiABqfDJVNEw .'").getGridParam("reccount") != 0){$.each(data.rows,function(i,item){'.$rowStr.$cellStr.' })};
                },';
            }
        }
    }

    
    private function get_beforeShowForm_readonlyattr(){
        $readonlyattr ='beforeShowForm: function(frm) {';
        foreach($this->SACPlesooIgyQwzUvygD as $key => $value){
            $readonlyattr .='$("#'. $value .'").attr("readonly","readonly");';
        }
        $readonlyattr .=' }'."\n";

        return $readonlyattr;
    }

    private function generate_condition($colIndex,$condition,$value)
    {
        $ret ="";
        switch ($condition){
            case "eq":   
                $ret = "\n".'if (item.cell['.$colIndex.'] == "'.$value.'") {'."\n";
                break;
            case "ne":  
                $ret = "\n".'if (item.cell['.$colIndex.'] != "'.$value.'") {'."\n";
                break;
            case "lt":  
                $ret = "\n".'if (item.cell['.$colIndex.'] < '.$value.') {'."\n";
                break;
            case "le": 
                $ret = "\n".'if (item.cell['.$colIndex.'] <= '.$value.') {'."\n";
                break;
            case "gt":  
                $ret = "\n".'if (item.cell['.$colIndex.'] > '.$value.') {'."\n";
                break;
            case "ge":  
                $ret = "\n".'if (item.cell['.$colIndex.'] >= "'.$value.'") {'."\n";
                break;
            case "cn":  
                $ret = "\n".'if (item.cell['.$colIndex.'].indexOf("'.$value.'")!=-1) {'."\n";
                break;
            case "nc":  
                $ret = "\n".'if (item.cell['.$colIndex.'].indexOf("'.$value.'")==-1) {'."\n";
                break;
            case "bw":  
                $ret = "\n".'if (item.cell['.$colIndex.'].indexOf("'.$value.'")==0) {'."\n";
                break;
            case "bn":  
                $ret = "\n".'if (item.cell['.$colIndex.'].indexOf("'.$value.'")!=0) {'."\n";
                break;
            case "ew":  
                $ret = "\n".'if (item.cell['.$colIndex.'].substr(-1)==="'.$value.'") {'."\n";
                break;
            case "en":  
                $ret = "\n".'if (item.cell['.$colIndex.'].substr(-1)!=="'.$value.'") {'."\n";
                break;
        }
        return  $ret;
    }

    
    
    private function FgoavzBjlxCwACGBVeXs(&$cnt){
        if($this->xAalFtwJwMQLkdTRRULE != null){
            echo 'subGrid: true,'. "\n";
            echo 'subGridRowExpanded: function(subgrid_id'. $cnt .', row_id'. $cnt .') {
                    var subgrid_table_id'. $cnt .', pager_id'. $cnt .';
                    subgrid_table_id'. $cnt .' = subgrid_id'. $cnt .'+"_t";
                    pager_id'. $cnt .' = "p_"+subgrid_table_id'. $cnt .';' ."\n";
            
            echo '  $("#"+subgrid_id'. $cnt .').html("<table id=\'"+subgrid_table_id'. $cnt .'+"\' class=\'scroll\'></table><div id=\'"+pager_id'. $cnt .'+"\' class=\'scroll\'></div>");' ."\n";



            echo '  jQuery("#"+subgrid_table_id'. $cnt .').jqGrid({ ' ."\n";
            $this->xAalFtwJwMQLkdTRRULE->set_jq_url($this->xAalFtwJwMQLkdTRRULE->uOeviNxYSzNjdqtjiaAE().'+row_id'.$cnt, false);
            $this->xAalFtwJwMQLkdTRRULE->set_jq_pagerName('pager_id'.$cnt, false);
            $this->xAalFtwJwMQLkdTRRULE->set_multiselect(false);
            $this->xAalFtwJwMQLkdTRRULE->set_dimension($this->xuQFNnhvcyHtqnGcBhMG-100);
            $this->xAalFtwJwMQLkdTRRULE->NlVRgzhSrZvTzGKDnswE();

            
            if($this->xAalFtwJwMQLkdTRRULE->xAalFtwJwMQLkdTRRULE != null){
                $cnt++;
                $obj_sg = $this->xAalFtwJwMQLkdTRRULE;
                $obj_sg->FgoavzBjlxCwACGBVeXs(($cnt));
                $cnt--; 
            }
            echo '  }); // end of subgrid_table_id'. $cnt .' subgrid' ."\n";



            echo $this->xAalFtwJwMQLkdTRRULE->col_custom . "\n";
            
            echo 'jQuery("#"+subgrid_table_id'. $cnt .').jqGrid("navGrid","#"+pager_id'. $cnt .','
                .'{edit:'.	((strrpos($this->xAalFtwJwMQLkdTRRULE->jSlnDHdHaQtmqMFOEynQ,"U")!==false && $this->xAalFtwJwMQLkdTRRULE->edit_mode!='INLINE')?'true':'false')
                .',add:'.	((strrpos($this->xAalFtwJwMQLkdTRRULE->jSlnDHdHaQtmqMFOEynQ,"C")!==false)?'true':'false')
                .',del:'.	((strrpos($this->xAalFtwJwMQLkdTRRULE->jSlnDHdHaQtmqMFOEynQ,"D")!==false)?'true':'false')
                .',view:'.	((strrpos($this->xAalFtwJwMQLkdTRRULE->jSlnDHdHaQtmqMFOEynQ,"R")!==false && $this->xAalFtwJwMQLkdTRRULE->edit_mode!='INLINE')?'true':'false')
                .',search:false'
                .',excel:'. (($this->xAalFtwJwMQLkdTRRULE->export_type!=null)?'true':'false').'}) '. "\n";

            echo '}, // end of subGridRowExpanded' ."\n";
            echo 'subGridRowColapsed: function(subgrid_id'. $cnt .', row_id'. $cnt .'){},';

        } 
    }

    
    
    
    private function baKVqnCkGDBLqNwGASxn(){
        $md_onselectrow = '';
        if($this->obj_md != null){
            $md_onselectrow = 'function(status, ids) {            
					// console.log(ids);
                    if(ids == null) {                        
                        ids=0;';
            for($i=0;$i<count($this->obj_md);$i++){
                $md_onselectrow .= 'var mgrid = $("#'.$this->KTlAoREvwiABqfDJVNEw .'");
							var sel_id = mgrid.jqGrid("getGridParam", "selrow");
							var fkey_value = mgrid.jqGrid("getCell", sel_id, "'. $this->obj_md[$i]->HAjLddDaXUvcYooHYquA() .'");
							// console.log(fkey_value);
							jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam", {editurl:"'.ABS_PATH .'/'. $this->edit_file .'?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'&src=md&fkey='.$this->obj_md[$i]->HAjLddDaXUvcYooHYquA().'&fkey_value="+fkey_value});'."\n";

                $md_onselectrow .=
                    "\n".'if(jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn().'").jqGrid("getGridParam","records") >0 )
                            {
                                jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam",{url:"'. ABS_PATH .'/masterdetail.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->obj_md[$i]->axEENBchSjcvncpdrwwn().'&fkey_value="+fkey_value+"&'. JQGRID_ROWID_KEY .'="+ids,page:1}).trigger("reloadGrid");
                            }
                            else {
                                jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam",{url:"'. ABS_PATH .'/masterdetail.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->obj_md[$i]->axEENBchSjcvncpdrwwn().'&fkey_value="+fkey_value+"&'. JQGRID_ROWID_KEY .'="+ids,page:1}).trigger("reloadGrid");
                            }' ."\n";
            }
            $md_onselectrow .= ' } else {';

            for($i=0;$i<count($this->obj_md);$i++){
                $md_onselectrow .= 'var mgrid = $("#'.$this->KTlAoREvwiABqfDJVNEw .'");
								var sel_id = mgrid.jqGrid("getGridParam", "selrow");
								var fkey_value = mgrid.jqGrid("getCell", sel_id, "'. $this->obj_md[$i]->HAjLddDaXUvcYooHYquA() .'");
								// console.log(fkey_value);
								jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam", {editurl:"'.ABS_PATH .'/'. $this->edit_file .'?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'&src=md&fkey='.$this->obj_md[$i]->HAjLddDaXUvcYooHYquA().'&fkey_value="+fkey_value});'."\n";

                $md_onselectrow .=
                    "\n".'if(jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn().'").jqGrid("getGridParam","records") >0 )
                            {                                
                                jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam",{url:"'. ABS_PATH .'/masterdetail.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->obj_md[$i]->axEENBchSjcvncpdrwwn().'&fkey_value="+fkey_value+"&'. JQGRID_ROWID_KEY .'="+ids,page:1}).trigger("reloadGrid");
                            }
                            else {                                
                                jQuery("#'. $this->obj_md[$i]->axEENBchSjcvncpdrwwn() .'").jqGrid("setGridParam",{url:"'. ABS_PATH .'/masterdetail.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->obj_md[$i]->axEENBchSjcvncpdrwwn().'&fkey_value="+fkey_value+"&'. JQGRID_ROWID_KEY .'="+ids,page:1}).trigger("reloadGrid");
                            }';

            }
            $md_onselectrow .= '}}'."\n";

            $this->hAQEPLwsYfgQOCngLkto .= '$("#'.$this->KTlAoREvwiABqfDJVNEw.'").bind("jqGridSelectRow", '. $md_onselectrow .');' ."\n";

        }else{
            
        }
    }
    
    private function rCBGdKekUjyPkEycrsTx(){
        echo    'loadtext:"'. $this->wUjfgQlaWGldXCojLeoG ."\"\n";  
        echo    '});' ."\n";
    }

    
    private function display_extended_properties(){
        if($this->wRjrMkifPQphcoKIsOId){
            echo '$("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("bindKeys", {
					onEnter:function( rowid ) {
					    //alert("rowid: "+rowid); // only gets called when key pressed at the ROW LEVEL

						// restore focus
						// TODO - 9/27/2013 - Richard: This function is probably never gets called - need to investigate
						$("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("editRow",rowid,true,null, null, null, {},function(){
							setTimeout(function(){
								$("#'. $this->KTlAoREvwiABqfDJVNEw .'").focus();
							},100);
						});
					}
				});'. "\n";

        }

        if(!empty($this->col_frozen)){
            echo '$("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("setFrozenColumns");'. "\n";
        }
    }

    private function BhVRGAhNwlSoWEttOKmu(){
        switch($this->edit_mode){
            case 'FORM':
            case 'INLINE':
                echo    'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("navGrid", '. $this->UOyOGKiRwfFitEOKaDJg .",\n";

                echo       '{edit:'. ((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"U")!==false && $this->edit_mode!='INLINE')?'true':'false')
                    .',add:'.  (($this->edit_mode == 'INLINE') ? 'false' : ((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"C")!==false)?'true':'false'))
                    .',del:'.  ((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"D")!==false)?'true':'false')
                    .',view:'. ((strrpos($this->jSlnDHdHaQtmqMFOEynQ,"R")!==false && $this->edit_mode!='INLINE')?'true':'false')
                    .',cloneToTop:true'
                    .',search:false'
                    .',excel:'. (($this->export_type!=null)?'true':'false').'}, ';

                echo '{			// --------- edit options ---------'."\n";
                echo $this->script_editEvtHandler . $this->get_beforeShowForm_readonlyattr();
                echo '},'."\n";

                echo '{			// --------- add options ---------
								closeAfterAdd:true,
                				bottominfo:"* required",
                                viewPagerButtons:true,
                                afterComplete: function (response, postdata, formid) {  // auto reload
                                            var $self = $(this);
                                            setTimeout(function () {
                                                $self.trigger("reloadGrid");
                                            }, 50);
                                         },
                                beforeShowForm: function(frm) {';
                foreach($this->SACPlesooIgyQwzUvygD as $key => $value){ echo '$("#'. $value .'").removeAttr("readonly");';}
                echo '},'."\n";
                echo $this->script_editEvtHandler;
                echo '},'."\n";

                echo '{   // --------- del options ---------
                                reloadAfterSubmit:false,
                                jqModal:false,
                                bottominfo:"* required",
                                closeOnEscape:true,
                                afterComplete: function(){}
                            }, 
                            {
                                // --------- view options ---------       
                                navkeys: [false,38,40], 
								height:250,
								jqModal:false,
								resize:true,
								closeOnEscape:true
                            }, 
                            {closeOnEscape:true} // search options 
                         );' ."\n";

                break;
            case 'NONE':
                echo    'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("navGrid", '. $this->UOyOGKiRwfFitEOKaDJg .",\n";
                echo   '{edit:false,add:false,del:false,view:false'.
                    ',search:false' .
                    ',excel:'. (($this->export_type!=null)?'true':'false').'}, {})' ."\n";
                break;
        } 

        
        if($this->sWVCTvNSQeMPkSkdEAsV['is_resizable']){
            echo 'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("gridResize",{minWidth:'. $this->sWVCTvNSQeMPkSkdEAsV['min_width'] .',minHeight:'. $this->sWVCTvNSQeMPkSkdEAsV['min_height'] .'});' ."\n";
        }

        
        if($this->ohaoHLBeaYiXgPPJlnbX){
            echo 'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("navButtonAdd",'. $this->UOyOGKiRwfFitEOKaDJg .',{caption:"",title:"Toggle inline search", buttonicon :"ui-icon-search",
                        onClickButton:function(){
                            phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'[0].toggleToolbar();
                        }
                    });'."\n";
            echo 'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("filterToolbar", {searchOnEnter: false, stringResult: true, defaultSearch: "cn"});'."\n";
            echo 'phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'[0].toggleToolbar();'."\n";   
        }

        
        if($this->advanced_search){
            echo 'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw.'")
                .navGrid('.$this->UOyOGKiRwfFitEOKaDJg.',{edit:false,add:false,del:false,search:false,refresh:false})
                .navButtonAdd('.$this->UOyOGKiRwfFitEOKaDJg.',{
                    caption:"", 
                    buttonicon:"ui-icon-search", 
                    onClickButton: function(){ 
                        jQuery("#'.$this->KTlAoREvwiABqfDJVNEw.'").jqGrid("searchGrid", {multipleSearch:true});         
                }, 
                position:"first"          
            });'."\n";
        }

        
        
        if($this->export_type!=null){
            echo 'jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("navButtonAdd",'. $this->UOyOGKiRwfFitEOKaDJg .',{caption:"",title:"'. $this->export_type .'",
                        onClickButton:function(e){
                            try{
                                jQuery("#'. $this->KTlAoREvwiABqfDJVNEw .'").jqGrid("excelExport",{url:"'. $this->oIDYHZWuwSBAAxdLqWIs .(($this->export_type!='')?'&export_type='. $this->export_type:'') .'"});
                            } catch (e) {
                                window.location= "'. $this->oIDYHZWuwSBAAxdLqWIs .(($this->export_type!='')?'&export_type='. $this->export_type:'') .'";
                            }

                        }
                    });'."\n";
        }

        
        
        if(!empty($this->grid_methods)){
            foreach($this->grid_methods as $method){
                echo (str_replace('###"', '', str_replace('"###', '', str_replace('\"', '"', str_replace('\n', ' ', str_replace('\r\n', ' ', $method)))))) ."\n";
            }
        }
        unset($method);

    }

    
    public function set_sortablerow($sortable=false){
        if($sortable){
            $this->grid_methods[] = 'phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("sortableRows", {});';
        }

        return $this;
    }

    
    
    
    
    
    public function set_grid_method(){
        $options = '';
        $method_name = func_get_arg(0);

        for ($i = 1; $i < func_num_args(); $i++) {
            if(is_array(func_get_arg($i))){
                $options .= json_encode(func_get_arg($i)). ',';
            }else{
                $options .= '"'. func_get_arg($i) .'",';
            }
        }
        $options = substr($options, 0, -1); 

        $this->grid_methods[] = 'phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("'. $method_name .'", '. $options .');';

        return $this;
    }

    
    
    
    
    public function enable_columnchooser($enable=false){
        if($enable){
            $this->set_grid_method(
                    'navButtonAdd',
                    '###phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.getGridParam("pager")###',
                    array('caption' => '',
                        'buttonicon' => 'ui-icon-calculator',
                        'title' => 'Choose Columns',
                        'onClickButton' => '###function() {
                            phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("columnChooser", {"modal":true});
                         }###'));

        }
        return $this;
    }

    
    
    private function aCqasivsrnOuhyrITOcv(){
        echo "\n". '});' ."\n";
        echo 'function getSelRows()
             {
                var rows = jQuery("#'.$this->KTlAoREvwiABqfDJVNEw.'").jqGrid("getGridParam","selarrrow");                               
                return rows;                
             }' ."\n";
        echo '// cellValue - the original value of the cell
              // options - as set of options, e.g
              // options.rowId - the primary key of the row
              // options.colModel - colModel of the column
              // rowObject - array of cell data for the row, so you can access other cells in the row if needed ' ."\n";
        echo 'function imageFormatter(cellValue, options, rowObject)
             {
                return (cellValue == "" || cellValue === null)? "":"<img src=\"'. $this->DDcSdMlljylessezxSly .'"+ cellValue + "\" originalValue=\""+ cellValue +"\" title=\""+ cellValue +"\">";
             }' ."\n";
        echo '// cellValue - the original value of the cell
              // options - as set of options, e.g
              // options.rowId - the primary key of the row
              // options.colModel - colModel of the column
              // cellObject - the HMTL of the cell (td) holding the actual value ' ."\n";
        echo 'function imageUnformatter(cellValue, options, cellObject)
             {      
                return $(cellObject.html()).attr("originalValue");
             }' ."\n";
        echo 'function booleanFormatter(cellValue, options, rowObject)
             {
				var op;
				op = $.extend({},options.colModel.formatoptions);
                myCars=new Array(); 
				//alert(op.No);
				//mycars[cellValue]=  op.boolean.No;
				//mycars[cellValue]=  op.boolean.Yes;
				myCars[op.No]="No";       
				myCars[op.Yes]="Yes";
				//alert(options[boolean]);
				return myCars[cellValue];
             }' ."\n";

        echo 'function booleanUnformatter(cellValue, options, cellObject)
             {    var op;
				  op = $.extend({},options.colModel.formatoptions);
				  //alert(op.No);
				  if(cellValue=="No")
				  return (op.No);
				  else
				  return (op.Yes);
            //alert(op.boolean.Yes)
            //return (op.boolean.cellValue);
              //  myCars=new Array(); 
			//	myCars["No"]=\'0\';       
			//	myCars["Yes"]=1;
				//alert(myCars[cellValue]);
				//alert(options.colModel.formatoptions[1]);
				//return myCars[cellValue];
             }' ."\n";
        
        echo $this->col_custom;

        
        

        echo '//]]>' ."\n";
        echo '</script>' ."\n";
    }

    private function display_events(){
        echo '<script type="text/javascript">' ."\n";
        echo 'jQuery(document).ready(function($){ '. "\n";
        echo $this->hAQEPLwsYfgQOCngLkto;
        
        
            echo '$(document).ajaxComplete(function( event, xhr, settings ) {if ( (settings.url.split("?")[0]).indexOf("edit.php") >= 0 ){alert( xhr.responseText );}});';
            
        

        echo '});'. "\n";
        echo '</script>'. "\n";
    }

    
    
    private function TbhGIFvEqMJUsVxpRDmq(){
        echo '<table id="'. $this->KTlAoREvwiABqfDJVNEw .'"></table>' ."\n";
        echo '<div id='. str_replace("#", "", $this->UOyOGKiRwfFitEOKaDJg) .'></div>' ."\n";
        echo '<br />'. "\n";

        echo "<Script Language='Javascript'>document.write(unescape('%3C%64%69%76%20%63%6C%61%73%73%3D%22%70%67%5F%6E%6F%74%69%66%79%22%20%73%74%79%6C%65%3D%22%66%6F%6E%74%2D%73%69%7A%65%3A%37%70%74%3B%63%6F%6C%6F%72%3A%67%72%61%79%3B%66%6F%6E%74%2D%66%61%6D%69%6C%79%3A%61%72%69%61%6C%3B%63%75%72%73%6F%72%3A%70%6F%69%6E%74%65%72%3B%22%3E%0A%20%20%20%20%20%20%20%20%59%6F%75%20%61%72%65%20%75%73%69%6E%67%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%3A%2F%2F%70%68%70%67%72%69%64%2E%63%6F%6D%2F%22%3E%70%68%70%47%72%69%64%20%4C%69%74%65%3C%2F%61%3E%2E%20%50%6C%65%61%73%65%20%63%6F%6E%73%69%64%65%72%20%3C%61%20%68%72%65%66%3D%22%68%74%74%70%3A%2F%2F%70%68%70%67%72%69%64%2E%63%6F%6D%2F%64%6F%77%6E%6C%6F%61%64%73%2F%3F%72%65%66%3D%6C%69%74%65%5F%6E%61%67%23%63%6F%6D%70%61%72%69%73%6F%6E%22%3E%75%70%67%72%61%64%69%6E%67%20%70%68%70%47%72%69%64%3C%2F%61%3E%20%74%6F%20%74%68%65%20%66%75%6C%6C%20%76%65%72%73%69%6F%6E%20%74%6F%20%68%61%76%65%20%67%72%65%61%74%20%66%65%61%74%75%72%65%73%20%69%6E%63%6C%75%64%69%6E%67%20%65%64%69%74%2C%20%6D%61%73%74%65%72%20%64%65%74%61%69%6C%2C%20%61%6E%64%20%67%72%6F%75%70%69%6E%67%2C%20%63%6F%6D%70%6F%73%69%74%65%20%6B%65%79%2C%20%66%69%6C%65%20%75%70%6C%6F%61%64%2C%20%61%6E%64%20%70%72%65%6D%69%75%6D%20%74%68%65%6D%65%73%21%0A%20%20%20%20%3C%2F%64%69%76%3E'));</Script>";

    }

    
    private function BltXiKaFVgbpdjcKPAJD(){
        echo '<script>jQuery(document).ready(function($){
                $(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_ajaxresponse\').toggle();
                $(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_ctrl\').toggle();
                $(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_gridobj\').toggle();
                $(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_sessobj\').toggle();
            });</script>';
        print('<u style="cursor:pointer" onclick="$(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_ctrl\').toggle(\'fast\');">CONTROL VALIDATION</u><br />');
        print("<pre id='_". $this->KTlAoREvwiABqfDJVNEw ."_debug_ctrl' style='border:1pt dotted black;padding:5pt;background:red;color:white;display:block'>");
        if($this->yGYEtEnxhjjKkhgYHNDY && $this->edit_mode=='NONE'){
            print("\n".'- Grid has multiselect enabled. However, the grid has not been set to be editable.');
        }
        if($this->eoFwRjfefzfopfXkQgE){
            print("\n".'- Scrolling (set_sroll)is enabled. As a result, pagination is disabled.');
        }
        print("</pre>");

        print('<u style="cursor:pointer" onclick="$(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_gridobj\').toggle(\'fast\');">DATAGRID OBJECT</u><br />');
        print("<pre id='_". $this->KTlAoREvwiABqfDJVNEw ."_debug_gridobj' style='border:1pt dotted black;padding:5pt;background:#E4EAF5;display:block'>");
        print_r($this);
        print("</pre>");

        print('<u style="cursor:pointer" onclick="$(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_sessobj\').toggle(\'fast\');">SESSION OBJECT</u><br />');
        print("<pre id='_". $this->KTlAoREvwiABqfDJVNEw ."_debug_sessobj' style='border:1pt dotted black;padding:5pt;background:#FFDAFA;display:block'>");
        print("<br />SESSION NAME: ". session_name());
        print("<br />SESSION ID: ". session_id() ."<br />");
        print("SESSION KEY: ". GRID_SESSION_KEY.'_'.$this->KTlAoREvwiABqfDJVNEw ."<br />");
        print_r(C_Utility::ANKuZuKHcgttsicUFzSo(str_replace("\u0000", " ", json_encode($_SESSION)))); 
        print("</pre>");
    }

    
    private function qvWRwnLPNEYZcbwOAhLW(){
        print('<u style="cursor:pointer" onclick="$(\'#_'. $this->KTlAoREvwiABqfDJVNEw .'_debug_ajaxresponse\').toggle(\'fast\');">AJAX RESPONSE</u><br />');
        print("<pre id='_". $this->KTlAoREvwiABqfDJVNEw ."_debug_ajaxresponse' style='border:1pt dotted black;padding:5pt;background:yellow;color:black;display:block'>");
        print("</pre>");
    }

    
    public function display($render_content=true){
        $subgrid_count = 1;

        if(C_Utility::is_debug()) { print("<h2>". $this->BQAYLNvLQdSuZPEhnuKm ."</h2>");}

        $this->uiFOoOCrEJCCgoHjSujn(); //set session variables

        if($this->ULeutgFTmojSwEYDKora == 'local') $this->display_script_data();

        $this->nXONKyYyZGkNRFfRcHJS();

        
        ob_start();
        $this->display_script_includeonce();
        $this->script_includeonce = ob_get_contents();
        ob_end_clean();

        if($render_content){
            $this->display_script_includeonce();
        }

        
        ob_start();
        $this->qbgUJSQtQXfBWKYujfK();
        $this->lktucRvDNAWXgZfCZWoH();
        $this->NlVRgzhSrZvTzGKDnswE();
        $this->FgoavzBjlxCwACGBVeXs($subgrid_count);
        $this->baKVqnCkGDBLqNwGASxn();
        $this->rCBGdKekUjyPkEycrsTx();
        $this->display_extended_properties();
        $this->BhVRGAhNwlSoWEttOKmu();
        $this->display_before_script_end();
        $this->aCqasivsrnOuhyrITOcv();
        $this->TbhGIFvEqMJUsVxpRDmq();
        $this->display_events();

        if(C_Utility::is_debug()){
            $this->qvWRwnLPNEYZcbwOAhLW(); 
            $this->BltXiKaFVgbpdjcKPAJD(); // print datagrid object
        }

        
        if($this->obj_md!=null){
            for($i=0;$i<count($this->obj_md);$i++) {
                $this->obj_md[$i]->display();
            }
        }

        $this->script_body = ob_get_contents();		
        $this->script_body = preg_replace('/,\s*}/', '}', $this->script_body);	
        ob_end_clean();

        if($render_content){
            echo $this->script_body;
        }
    }

    
    
    public function __sleep(){
        
        
        
    }

    
    
    public function __wakeup(){
    }

    
    protected function set_sql($SLcDAxYHxEJInQtYBMW){
        $this->sql = $SLcDAxYHxEJInQtYBMW;

        return $this;
    }

    
    public function set_query_filter($where){
        if($where!=''){
            $this->sql_filter = $where;
            
        }

        return $this;
    }

    protected function get_filter(){
        return $this->sql_filter;

    }

    
    protected function set_sql_table($PHQmnFNlZXMCiJLuURng){
        $this->scSszsDyqcqvyLtAFSSN = $PHQmnFNlZXMCiJLuURng;

        return $this;
    }

    public function aOAEfwTGmkSzJgVVTKPa(){
        return $this->scSszsDyqcqvyLtAFSSN;
    }

    
    
    
    protected function set_jq_url($url, $YLJGoxsTxFKwkTlbXGHQ=true){
        $this->OBdYQDhAdXqrTqVMLXyb = ($YLJGoxsTxFKwkTlbXGHQ)?('"'.$url.'"'):$url;

        return $this;
    }

    protected function uOeviNxYSzNjdqtjiaAE(){
        return $this->OBdYQDhAdXqrTqVMLXyb;
    }

    public function set_jq_datatype($BpjheMQXKAyQDVznDPvT){
        $this->ULeutgFTmojSwEYDKora = $BpjheMQXKAyQDVznDPvT;
        $this->OBdYQDhAdXqrTqVMLXyb       = '"'. ABS_PATH .'/data.php?dt='. $BpjheMQXKAyQDVznDPvT .'&gn='. $this->KTlAoREvwiABqfDJVNEw .'"';

        return $this;
    }

    public function qLXndKuYZWVHPqchhpHn(){
        return $this->ULeutgFTmojSwEYDKora;
    }


    
    
    public function set_col_hidden($EzmmHCfAcURpMWcxsfOx, $edithidden=true){
        if(is_array($EzmmHCfAcURpMWcxsfOx)){
            foreach($EzmmHCfAcURpMWcxsfOx as $WFkKjjrAoOGXBRgfhgkJ){
                $this->pVawonXnNSHaEXaDfFHI[$WFkKjjrAoOGXBRgfhgkJ]['edithidden'] = $edithidden;
            }
        }else{
            $col_names = preg_split("/[\s]*[,][\s]*/", $EzmmHCfAcURpMWcxsfOx);
            foreach($col_names as $WFkKjjrAoOGXBRgfhgkJ){
                $this->pVawonXnNSHaEXaDfFHI[$WFkKjjrAoOGXBRgfhgkJ]['edithidden'] = $edithidden;
            }
        }

        return $this;
    }

    public function pyGiyQnfTndrlajXCXPh(){
        return $this->pVawonXnNSHaEXaDfFHI;
    }



    
    public function set_col_readonly($arr){
        $this->SACPlesooIgyQwzUvygD = preg_split("/[\s]*[,][\s]*/", $arr);

        return $this;
    }

    public function UDhrRgAvCWvmQZEHgWmp(){
        return $this->SACPlesooIgyQwzUvygD;
    }

    
    public function yMuqaBGJOflQMtdRiWxx(){ // get sql query
        return $this->sql;
    }

    
    public function get_db_connection(){
        return $this->db_connection;
    }

    
    public function set_sql_key($WdsTYweBAnEqGKjCGfuD){
        if(!is_array($WdsTYweBAnEqGKjCGfuD)) $WdsTYweBAnEqGKjCGfuD = array($WdsTYweBAnEqGKjCGfuD); 
        $this->zrXrgBcJRXotwTescYJA = $WdsTYweBAnEqGKjCGfuD;

        return $this;
    }

    
    public function gXXLXcMHriaRfTpnLnY(){ // get sql key
        return $this->zrXrgBcJRXotwTescYJA;
    }

    
    public function set_sql_fkey($keWKYFWMwHkrhIsUDOJw){
        $this->eaIqmgLgnItFsoWAEdnn = $keWKYFWMwHkrhIsUDOJw;

        return $this;
    }

    
    public function HAjLddDaXUvcYooHYquA(){
        return $this->eaIqmgLgnItFsoWAEdnn;
    }

    
    public function mNUNqbgbZaoFwmjzaUru(){
        return $this->idggOwYvEktONuEdoPoK;
    }

    
    
    public function set_scroll($wpsWlqMYvFvVbhqtRsfE, $h='400'){
        $this->eoFwRjfefzfopfXkQgE = $wpsWlqMYvFvVbhqtRsfE;
        $this->GJJDFKJuwbvUepXRNCmw = $h;

        return $this;
    }

    
    public function set_jq_editurl($url){
        $this->OlSUUmiesJldiNOcVbEw = $url; 

        
    }

    
    public function enable_edit($edit_mode = 'FORM', $options='CRUD', $edit_file='edit.php'){
        switch($edit_mode)    {
            case 'CELL':
                $this->QLEPwSsWCvOjPDcRTbFo = true;
                break;
            case 'INLINE':
                $this->edit_file = $edit_file;
                $this->set_jq_editurl(ABS_PATH .'/'. $edit_file .'?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->KTlAoREvwiABqfDJVNEw);

                
                
                if(strrpos($options,"C")!==false){
                    $this->set_grid_method('inlineNav',
                        
                        
                        
                        '###phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.getGridParam("pager")###',
                        array('addParams' => array('position'=> "last",
                                'addRowParams'=>array(
                                    'keys'=>true,
                                    'successfunc'=>'###function(){
                                        var $self=$(this);
                                        setTimeout(function(){
                                            $self.trigger("reloadGrid");
                                        }, 50);
                                    }###',
                                    'errorfunc'=>'###function(id,res){}###'))));
                }

                break;
            case 'FORM':
                $this->edit_file = $edit_file;
                $this->set_jq_editurl(ABS_PATH .'/'. $edit_file .'?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$this->KTlAoREvwiABqfDJVNEw);

                break;
            default:
                
        }
        $this->edit_mode = $edit_mode;
        $this->jSlnDHdHaQtmqMFOEynQ = $options;

        return $this;
    }

    
    
    
    
    
    
    
    
    
    
    
    public function set_edit_condition($conditions=array()){
        $onGridLoadComplete_script_begin = 'function(s, r)
            {
                var ids = phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("getDataIDs");
                for (var i = 0; i < ids.length; i++)
                {
                    var rowId = ids[i];
                    var rowData = phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid ("getRowData", rowId);' ."\n";

                    $compare_condition = 'if(';
                    
                    foreach($conditions as $column => $compare_operand){
                        if(trim($compare_operand) == '||' || trim($compare_operand) == '&&'){
                            $compare_operand = ($compare_operand == '||')?'&&':'||';
                            $compare_condition .= $compare_operand;
                        }else{
                            $compare_condition .= ' !(phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("getCell", rowId, "'. trim($column) .'") '. trim($compare_operand) .') ';
                        }
                    }
                    $compare_condition .= ')';

                    $onGridLoadComplete_script_end = '
                    {
                        phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("setCell", rowId, "actions", " zzz ", {"display":"none"}); // not possible to set value for virtual column
                    }
                }

            }';

        $this->add_column("actions", array('name'=>'actions',
            'index'=>'actions',
            'width'=>'80',
            'formatter'=>'actions',
            'formatoptions'=>array('keys'=>true)),'Actions');
        $this->set_grid_property(array('onSelectRow'=>''));
        $this->add_event("jqGridLoadComplete", $onGridLoadComplete_script_begin . $compare_condition . $onGridLoadComplete_script_end);
    }

    
    public function enable_search($tSNOXjkDDihwelkcgrOk){
        $this->ohaoHLBeaYiXgPPJlnbX = $tSNOXjkDDihwelkcgrOk;

        return $this;
    }

    
    public function enable_advanced_search($JINvreRPDcWGSPUizZBP){
        $this->advanced_search = $JINvreRPDcWGSPUizZBP;

        return $this;
    }

    
    public function set_multiselect($multiselect){
        $this->yGYEtEnxhjjKkhgYHNDY = $multiselect;

        return $this;
    }

    public function has_multiselect(){
        return $this->yGYEtEnxhjjKkhgYHNDY;
    }

    
    public function set_col_required($arr){
        $this->PANnnZOkwjpmkOkVvVwC = preg_split("/[\s]*[,][\s]*/", $arr);

        return $this;
    }

    
    public function set_col_title($EzmmHCfAcURpMWcxsfOx, $luWaxXcjAsZdmCekgzHf){
        $this->zvafcTTQXCrTldoMphnk[$EzmmHCfAcURpMWcxsfOx] = $luWaxXcjAsZdmCekgzHf;

        return $this;
    }

    
    public function ksNTpAHeBTJPmRwsiiye(){
        return $this->zvafcTTQXCrTldoMphnk;
    }


    
    
    
    
    public function set_col_link($EzmmHCfAcURpMWcxsfOx, $target="_new"){
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['link'] = array("target"=>$target);
        

        return $this;
    }

    
    public function set_col_date($EzmmHCfAcURpMWcxsfOx, $srcformat="Y-m-d", $newformat="Y-m-d", $datePickerFormat="Y-m-d"){
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['date'] = array("srcformat"=>$srcformat,
            "newformat"=>$newformat,
            "datePickerFormat"=>$datePickerFormat);

        return $this;
    }

    
    public function set_col_currency($EzmmHCfAcURpMWcxsfOx, $prefix='$', $suffix='', $thousandsSeparator=',', $decimalSeparator='.',
                                     $decimalPlaces='2', $defaultValue='0.00'){
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['currency'] = array("prefix" => $prefix,
            "suffix" => $suffix,
            "thousandsSeparator" => $thousandsSeparator,
            "decimalSeparator" => $decimalSeparator,
            "decimalPlaces" => $decimalPlaces,
            "defaultValue" => $defaultValue);
        return $this;
    }

    
    
    public function set_col_img($EzmmHCfAcURpMWcxsfOx, $baseUrl=''){
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['image'] = array('baseUrl' => $baseUrl);
        $this->DDcSdMlljylessezxSly = $baseUrl;

        return $this;
    }
    

    
    public function set_col_format($EzmmHCfAcURpMWcxsfOx, $format, $formatoptions=array()){
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx][$format] = $formatoptions;

        return $this;
    }

    
    
    
    public function set_col_dynalink($EzmmHCfAcURpMWcxsfOx, $baseLinkUrl="", $dynaParam="id",$addParam="",$target="_new"){
        $sFormatter = "function ".$EzmmHCfAcURpMWcxsfOx."_customFormatter(cellValue, options, rowObject){ %s }";
        $sUnformatter = "function ".$EzmmHCfAcURpMWcxsfOx."_customUnformatter(cellValue, options, rowObject){ %s }";
        $results = $this->db->wCcQTuVYgSckNyasyuoU($this->sql,1, 1);

        $dynaParamQs= '';
        if($this->ULeutgFTmojSwEYDKora != 'local'){
            if(is_array($dynaParam) && !empty($dynaParam)){
                foreach($dynaParam as $key => $value){
                    $dynaParamQs .= $value .'=" + encodeURIComponent(rowObject['.$this->db->lHGMnYhnTIFoLxnJpUUW($results,$value).']) + "&';
                }
                $dynaParamQs = rtrim($dynaParamQs, '&');
            }else{
                $dynaParamQs .= $dynaParam .'=" + encodeURIComponent(rowObject['.$this->db->lHGMnYhnTIFoLxnJpUUW($results,$dynaParam).']) + "';
            }
        }else{
            if(is_array($dynaParam) && !empty($dynaParam)){
                foreach($dynaParam as $key => $value){
                    $dynaParamQs .= $value .'=" + encodeURIComponent(rowObject.'. $value .') + "&';
                }
                $dynaParamQs = rtrim($dynaParamQs, '&');
            }else{
                $dynaParamQs .= $dynaParam .'=" + encodeURIComponent(rowObject.'. $dynaParam .') + "';
            }
        }

        $sVal = '                               
        var params = "?'.$dynaParamQs .$addParam.'";
        var url = \''.$baseLinkUrl.'\' + params;
        
        return \'<a href="\'+url+\'" target="'.$target.'" value="\' + cellValue + \'">\'+cellValue+\'</a>\';
        ';
        $sFormatter = sprintf($sFormatter,$sVal);
        $sUnformatter = sprintf($sUnformatter,'var obj = jQuery(rowObject).html(); return jQuery(obj).attr("value");');
        $this->col_custom .= $sFormatter . "\n" . $sUnformatter;
        $this->col_formats[$EzmmHCfAcURpMWcxsfOx]['custom'] = $addParam;

        return $this;
    }

    
    public function set_dimension($w, $h='100%', $shrinkToFit = true){
        $this->xuQFNnhvcyHtqnGcBhMG=$w;
        $this->GJJDFKJuwbvUepXRNCmw=$h;
        $this->jq_shrinkToFit = $shrinkToFit;

        return $this;
    }

    
    public function enable_resize($is_resizable, $CIiAHhgPrfxDEdNsiQVS=350, $BPElieIqJYwGJNvDSXNj=80){
        $this->sWVCTvNSQeMPkSkdEAsV["is_resizable"]   = $is_resizable;
        $this->sWVCTvNSQeMPkSkdEAsV["min_width"]      = $CIiAHhgPrfxDEdNsiQVS;
        $this->sWVCTvNSQeMPkSkdEAsV["min_height"]     = $BPElieIqJYwGJNvDSXNj;

        return $this;
    }

    
    
    
    public function set_masterdetail($nNvgFlLtLQWXmBkoCXdK, $YFCpPawmeoyenFSNcyqx){
        $gdNo = count( $this->obj_md)+1;

        if($nNvgFlLtLQWXmBkoCXdK instanceof C_DataGrid){
            $nNvgFlLtLQWXmBkoCXdK->set_jq_gridName($this->KTlAoREvwiABqfDJVNEw .'_d'.$gdNo);
            $nNvgFlLtLQWXmBkoCXdK->set_jq_pagerName(trim($this->UOyOGKiRwfFitEOKaDJg, '"') .'_d'.$gdNo);
            $nNvgFlLtLQWXmBkoCXdK->set_jq_url(ABS_PATH .'/masterdetail.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $nNvgFlLtLQWXmBkoCXdK->KTlAoREvwiABqfDJVNEw .'&'. JQGRID_ROWID_KEY .'=');
            $nNvgFlLtLQWXmBkoCXdK->set_jq_editurl(ABS_PATH .'/'. $this->edit_file .'?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $nNvgFlLtLQWXmBkoCXdK->KTlAoREvwiABqfDJVNEw .'&src=md');
            $nNvgFlLtLQWXmBkoCXdK->set_sql_fkey($YFCpPawmeoyenFSNcyqx);
            $nNvgFlLtLQWXmBkoCXdK->enable_search(false);
            $nNvgFlLtLQWXmBkoCXdK->uiFOoOCrEJCCgoHjSujn();

            $this->obj_md[] = $nNvgFlLtLQWXmBkoCXdK;
        }else{
            echo 'Invalid master/detail object.';
        }

        return $this;
    }

    
    
    
    
    public function set_subgrid($nNvgFlLtLQWXmBkoCXdK, $d_fkey, $m_fkey=-1){
        if($nNvgFlLtLQWXmBkoCXdK instanceof C_DataGrid){
            $m_fkey = ($m_fkey==-1)?$d_fkey:$m_fkey;	
            $this->JSPfsgttAJEyMQrsZiqu = false;     
            $nNvgFlLtLQWXmBkoCXdK->set_jq_url(ABS_PATH .'/subgrid.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $this->KTlAoREvwiABqfDJVNEw .'&sgn='. $nNvgFlLtLQWXmBkoCXdK->axEENBchSjcvncpdrwwn() .'&m_fkey='. $m_fkey .'&'. JQGRID_ROWID_KEY .'=');
            $nNvgFlLtLQWXmBkoCXdK->set_sql_fkey($d_fkey);
            
            $nNvgFlLtLQWXmBkoCXdK->uiFOoOCrEJCCgoHjSujn();

            $this->xAalFtwJwMQLkdTRRULE = $nNvgFlLtLQWXmBkoCXdK;
        }else{
            echo 'Invalid subgrid object.';
        }

        return $this;
    }

    
    
    
    
    public function set_jq_pagerName($AusUEShkgQAswAbgtzDF, $YLJGoxsTxFKwkTlbXGHQ=true){
        $this->UOyOGKiRwfFitEOKaDJg = ($YLJGoxsTxFKwkTlbXGHQ)?('"'.$AusUEShkgQAswAbgtzDF.'"'):$AusUEShkgQAswAbgtzDF;

        return $this;
    }

    
    public function set_jq_gridName($tpEtREuoXopBxmtsAtpN){
        $this->KTlAoREvwiABqfDJVNEw = $tpEtREuoXopBxmtsAtpN;
        $this->UOyOGKiRwfFitEOKaDJg = '"#'. $tpEtREuoXopBxmtsAtpN .'_pager1"';  
        $this->OBdYQDhAdXqrTqVMLXyb = '"'. ABS_PATH .'/data.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='.$tpEtREuoXopBxmtsAtpN .'"';
        $this->oIDYHZWuwSBAAxdLqWIs = ABS_PATH .'/export.php?dt='. $this->ULeutgFTmojSwEYDKora .'&gn='. $this->KTlAoREvwiABqfDJVNEw .(($this->export_type!='')?'&export_type='. $this->export_type:'');

        return $this;
    }

    
    public function axEENBchSjcvncpdrwwn(){
        return $this->KTlAoREvwiABqfDJVNEw;
    }

    
    public function set_sortname($MCPmWchiIpxlYhZTvkoI,$sortorder = 'ASC'){
        $this->uRCwctSIiIQCRgDGpcne = $MCPmWchiIpxlYhZTvkoI;
        $this->vRWAzQRwIXUwFkpzVjxw = $sortorder;

        return $this;
    }

    public function enable_export($type='EXCEL'){
        $this->export_type = $type;

        return $this;
    }

    
    
    
    
    
    
    
    public function set_col_edittype($EzmmHCfAcURpMWcxsfOx, $KEgsxwLEuJKUmHZLdJiu, $UnuxWFNsxPUbPbXduebq=null, $multiple=false, $dataUrl=null){
        if($KEgsxwLEuJKUmHZLdJiu == "select" || $KEgsxwLEuJKUmHZLdJiu == "autocomplete") {
            $select_list = '';
            $regex = "/SELECT (.*?) FROM /i";
            $data ="";
            $matches = array();
            if (preg_match($regex , $UnuxWFNsxPUbPbXduebq, $matches))
            {
                $select_kv = explode(",",$matches[1]);
                $select_kv = array_map('trim', $select_kv);
                $result = $this->db->zuQiBKYyzWEXEWjqTbpf($UnuxWFNsxPUbPbXduebq,-1,0);

                foreach($result as $i=>$val)
                {
                    $select_list.=$result[$i][0].":".$result[$i][1].";";
                }
                $select_list=rtrim($select_list,";");
                $UnuxWFNsxPUbPbXduebq = $select_list;
            }
        }

        
        if($KEgsxwLEuJKUmHZLdJiu == 'checkbox'){
            $this->set_col_format($EzmmHCfAcURpMWcxsfOx, 'checkbox');
            $this->set_col_align($EzmmHCfAcURpMWcxsfOx, 'center');
        }

        
        if($KEgsxwLEuJKUmHZLdJiu == 'autocomplete'){
            $KEgsxwLEuJKUmHZLdJiu = 'select';
            $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type'] = 'select';
            $this->col_autocomplete[$EzmmHCfAcURpMWcxsfOx] = $EzmmHCfAcURpMWcxsfOx;
            self::$has_autocomplete = true;
        }

        
        if($KEgsxwLEuJKUmHZLdJiu == 'select'){
            $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['multiple']     = $multiple;
            $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['dataUrl']      = $dataUrl;
        }

        $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['type']  = $KEgsxwLEuJKUmHZLdJiu;
        $this->XIBGEbyMabbfmxNHrxXx[$EzmmHCfAcURpMWcxsfOx]['value'] = $UnuxWFNsxPUbPbXduebq;

        return $this;
    }

    
    
    
    
    public function set_row_color($godCMnXSMDpJrFQMPulj, $hEUFQreMCandmWpUBXrV=null, $JBQhxufVTWmWYAIkegUG=null){
        $this->hwVTcgcSWcxkcCOEhJk['hover'] = $godCMnXSMDpJrFQMPulj;
        $this->hwVTcgcSWcxkcCOEhJk['highlight'] = $hEUFQreMCandmWpUBXrV;
        $this->hwVTcgcSWcxkcCOEhJk['altrow'] = $JBQhxufVTWmWYAIkegUG;

        return $this;
    }
    public function set_conditional_row_color($colName, $condition=array(),$default=""){
        $this->jq_conditionalRows[] = array("col"=>$colName,"default"=>$default,"condition"=>$condition);

        return $this;
    }

    public function set_conditional_cell_color($colName, $condition=array(),$default=""){
        $this->jq_conditionalRows[] = array("col"=>$colName,"default"=>$default,"condition"=>$condition);

        return $this;
    }


    
    
    
    

    
    public function set_theme($BUaWiuBBZtBuwRTOFSg){
        $this->WLCxhqvYPTTeDtasSuUU = $BUaWiuBBZtBuwRTOFSg;

        return $this;
    }

    
    public function set_locale($DgOKQsyjASLDMkpkbTHk){
        $this->DgOKQsyjASLDMkpkbTHk = $DgOKQsyjASLDMkpkbTHk;

        return $this;
    }

    
    
    public function enable_debug($debug){



        return $this;
    }

    
    public function set_caption($chDjsiuZzdJKtfdIePxE){
        if($chDjsiuZzdJKtfdIePxE=='') $chDjsiuZzdJKtfdIePxE = '&nbsp;';
        $this->zmVukhkanNsqMLAgNHo = $chDjsiuZzdJKtfdIePxE;

        return $this;
    }

    
    
    
    public function set_pagesize($kTVcyJfgKsLDUgDpTuuI){
        $this->MmoDPgJDqiHLGduvILCl = $kTVcyJfgKsLDUgDpTuuI;

        return $this;
    }

    
    public function enable_rownumbers($ubGjCDWkVObGkMxsvOAw){
        $this->LmsrUIXSpQotFugJMyyw = $ubGjCDWkVObGkMxsvOAw;

        return $this;
    }

    
    public function set_col_width($EzmmHCfAcURpMWcxsfOx, $width){
        $this->iLvxWIxnUzJrEhpjrao[$EzmmHCfAcURpMWcxsfOx]['width'] = $width;

        return $this;
    }
    
    public function get_col_width(){
        return $this->iLvxWIxnUzJrEhpjrao;
    }

    
    public function set_col_align($EzmmHCfAcURpMWcxsfOx, $align="left"){
        $this->col_aligns[$EzmmHCfAcURpMWcxsfOx]['align'] = $align;

        return $this;
    }
    
    public function kDjYwqFCUCVyCzfcpdCQ(){
        return $this->col_aligns;
    }

    public function set_group_properties($feildname, $QZyquraQuFQSsNovgxig=false, $omRmoKNsuFBFBoIkgOlu=true){
        $this->jEJekHnIUYJyXZFMfWGx=true;
        $this->jq_group_summary_show =$groupColumnShow;
        $this->cXrNZkDGJCpCjSjwZbTO=$feildname;
        $this->zHRNpIMrDVAgrQsvVtZE=$QZyquraQuFQSsNovgxig;
        $this->uafWxTshdmADXTMDTklI=$omRmoKNsuFBFBoIkgOlu;

        return $this;
    }

    public function set_group_summary($EzmmHCfAcURpMWcxsfOx, $summaryType){
        $this->jq_is_group_summary=true;
        $this->XcxAhvGrghbgRhQjASCk[$EzmmHCfAcURpMWcxsfOx]['summaryType'] = $summaryType;

        return $this;
    }

    
    public function enable_kb_nav($is_enabled = false){
        $this->wRjrMkifPQphcoKIsOId = $is_enabled;

        return $this;
    }

    public function setCallbackString ($string) {
        $this->callbackstring = '&__cbstr='.strtr(rtrim(base64_encode($string), '='), '+/', '-_');
        $this->OBdYQDhAdXqrTqVMLXyb = substr($this->OBdYQDhAdXqrTqVMLXyb,0,-1).$this->callbackstring.'"';
        $this->oIDYHZWuwSBAAxdLqWIs .= $this->callbackstring;

        return $this;
    }

    
    public function enable_autowidth($autowidth=false){
        $this->KRDXLIBrFRHCoeSOqjkA = $autowidth;

        
        if($autowidth){
            $this->hAQEPLwsYfgQOCngLkto .=
                '$(window).bind("resize", function() {
                    phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.setGridWidth($(window).width());
                }).trigger("resize");' ."\n";
        }

        return $this;
    }

    
    
    
    public function enable_autoheight($autoheight=false){
        
        if($autoheight){
            $this->hAQEPLwsYfgQOCngLkto .=
                'var grid_height = $(window).height() -
                    $(".ui-jqgrid .ui-jqgrid-titlebar").height() -
                    $(".ui-jqgrid .ui-jqgrid-hbox").height() -
                    $(phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.getGridParam("pager")).height() - 10;
                $(window).bind("resize", function() {
                    phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.jqGrid("setGridHeight", grid_height );
                }).trigger("resize");' ."\n";
        }

        return $this;
    }

    
    public function get_display($add_script_includeonce=true){
        if($add_script_includeonce){
            return $this->script_includeonce . $this->script_body;
        }else{
            return $this->script_body;
        }
    }

    
    public function set_form_dimension($f_width, $f_height = '100%'){
        $this->MztodXfJgEiCmKNScggI = $f_width;
        $this->cFgBYpzYPivTwUZtqspi = $f_height;

        return $this;
    }

    
    public function set_col_default($EzmmHCfAcURpMWcxsfOx, $default = ""){
        $this->col_default[$EzmmHCfAcURpMWcxsfOx] = $default;

        return $this;
    }

    
    public function set_col_frozen($EzmmHCfAcURpMWcxsfOx, $value=true){
        $this->col_frozen[$EzmmHCfAcURpMWcxsfOx] = $value;		

        return $this;
    }

    
    
    public function add_event($event_name, $js_event_handler){
        $this->hAQEPLwsYfgQOCngLkto .= 'phpGrid_'. $this->scSszsDyqcqvyLtAFSSN .'.bind("'. $event_name .'", '. $js_event_handler .');' ."\n";

        return $this;
    }

    
    
    
    
    private function parse_to_script($obj){
        if(is_array($obj)){
            $arr = array();
            foreach($obj as $key => $value){
                if(is_string($value)){
                    $script = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $value);
                    if(preg_match('/function\([^)].*\)/i', $script)){
                        $script = '###'. $script .'###';
                    }
                    $arr[$key] = $script;
                }else{
                    $arr[$key] = $value;
                }
            }

            return $arr;

        }elseif(is_string($obj)){
            $script = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $obj);
            if(preg_match('/function\([^)].*\)/i', $script)){
                $script = '###'. $script .'###';
            }
            return $script;

        }

    }

    
    
    public function set_col_property($EzmmHCfAcURpMWcxsfOx, $property = array()){
        $cust_property = array();
        foreach($property as $prop_key=>$prop_value){
            if(is_string($prop_value) || is_array($prop_value)){
                $prop_value = $this->parse_to_script($prop_value);
            }
            $cust_property[$prop_key] = $prop_value;
        }
        $this->cust_col_properties[$EzmmHCfAcURpMWcxsfOx] = $cust_property;

        return $this;
    }

    
    
    public function set_grid_property($property = array()){
        $this->cust_grid_properties = array_replace_recursive($property, $this->cust_grid_properties);

        return $this;
    }

    
    
    
    public function set_col_edit_dimension($EzmmHCfAcURpMWcxsfOx, $width=30, $height=6){
        $this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]["width"] = $width;
        $this->col_edit_dimension[$EzmmHCfAcURpMWcxsfOx]["height"] = $height;

        return $this;
    }

    
    private function MapPath($file){
        if(function_exists('apache_lookup_uri')){
            $alu=apache_lookup_uri($file);
            return $alu->filename;
        }
        return $this->col_fileupload['physical_path'];
    }

    
    public function add_column($EzmmHCfAcURpMWcxsfOx, $property = array(), $title='', $after = ''){
        $this->col_virtual[$EzmmHCfAcURpMWcxsfOx]['property'] = $property;
        $this->col_virtual[$EzmmHCfAcURpMWcxsfOx]['title'] = ($title == '') ? $EzmmHCfAcURpMWcxsfOx : $title;
        $this->col_virtual[$EzmmHCfAcURpMWcxsfOx]['after'] = $after;

        return $this;
    }

    
    public function set_col_customrule($EzmmHCfAcURpMWcxsfOx, $customrule_func){
        $this->col_customrule[$EzmmHCfAcURpMWcxsfOx]['custom'] = true;
        $this->col_customrule[$EzmmHCfAcURpMWcxsfOx]['custom_func'] = $customrule_func;

        return $this;
    }

    
    private function display_before_script_end(){
        echo $this->before_script_end;
    }


    public function set_selectnetsted($col_sel_parent, $col_sel_child){
        $this->set_col_property($col_sel_parent,
            array('editoptions'=>array(
                'dataUrl'=>'data.php',
                'buildSelect'=>'function(data){
                                    var response = jQuery.parseJSON(data);
                                    var s = "<select>";
                                    if (response && response.length) {
                                        for (var i = 0, l = response.length; i < l; i++) {
                                            var ri = response[i];
                                            s += "<option value=\"" + ri.Value + "\">" + ri.Text + "</option>";
                                        }
                                    }
                                    return s + "</select>";
                                }',
                'dataEvents'=>array(
                    'type'=>'change',
                    'fn'=>'function (e) {
                        var varIDUnidadMedida = e.currentTarget.value;
                        $.ajax({
                                url: "data",
                                type: "GET",
                                success: function (PlazosJson) {
                                var plazos = eval(PlazosJson);
                                var plazosHtml = "";
                                $(plazos).each(function (i, option) {
                                    plazosHtml += "<option value=\"" + option.Value + "\">" + option.Text + "</option>";
                                });

                                if ($(e.target).is(".FormElement")) {
                                    var form = $(e.target).closest("form.FormGrid");
                                    $("select#parPlazo.FormElement", form[0]).html(plazosHtml);
                                } else {
                                    var row = $(e.target).closest("tr.jqgrow");
                                    var rowId = row.attr("id");
                                    var rowId = jQuery("#grid").jqGrid("getGridParam", "selrow");
                                    jQuery("select#" + rowId + "_parPlazo").append(plazosHtml);
                                }
                            }
                        });
                    }'
                ))
            ));

        $this->set_col_property($col_sel_child,
            array('editoptions'=>array(
                'dataUrl'=>'data.php',
                'buildSelect'=>'function(data){
                                    var response = jQuery.parseJSON(data);
                                    var s = "<select>";
                                    if (response && response.length) {
                                        for (var i = 0, l = response.length; i < l; i++) {
                                            var ri = response[i];
                                            s += "<option value=\"" + ri.Value + "\">" + ri.Text + "</option>";
                                        }
                                    }
                                    return s + "</select>";
                                }'
            ))
        );

    } 



}

?>