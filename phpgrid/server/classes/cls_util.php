<?php

class C_Utility{
    
    
    
    public static function IEllnFlkyqGTCdJuyCFu($str){
        if (get_magic_quotes_gpc() == 1) {
            return ($str);
        }else{ 
            return (addslashes($str));
        }
    }
    
     
     public static function ANKuZuKHcgttsicUFzSo($json) {     
        $result    = '';
        $pos       = 0;
        $QUVggEEElVKSsmsfTjGI    = strlen($json);
        $dvrFzujOAGlhrgLgQYyr = '  ';
        $OwcDAOFHPGmNhCybMdLk   = "\n";
     
        for($i = 0; $i <= $QUVggEEElVKSsmsfTjGI; $i++) {
            
            
            $char = substr($json, $i, 1);
            
            
            
            if($char == '}' || $char == ']') {
                $result .= $OwcDAOFHPGmNhCybMdLk;
                $pos --;
                for ($j=0; $j<$pos; $j++) {
                    $result .= $dvrFzujOAGlhrgLgQYyr;
                }
            }
            
            
            $result .= $char;
     
            
            
            
            
            if ($char == '{' || $char == '[') {
                $result .= $OwcDAOFHPGmNhCybMdLk;
                if ($char == '{' || $char == '[') {
                    $pos ++;
                }
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $dvrFzujOAGlhrgLgQYyr;
                }
            }
        }
     
        return $result;
    }
            
    
    public static function mWmzWdynypNTnbrauCBg($PMmgcbmcOvIoiNcmhKUy){
        return ($PMmgcbmcOvIoiNcmhKUy)?'true':'false';
    }

    
    public static function gen_rowids($arr=array(), $keys = array()){
        $rowids = '';
        foreach($keys as $key=>$val){
            $rowids .= $arr[$val] .PK_DELIMITER;
        }

        $rowids = substr($rowids, 0, -3);   

        return $rowids;
    }

    public static function is_debug(){
        return defined('DEBUG')?DEBUG:false;
    }

}

?>