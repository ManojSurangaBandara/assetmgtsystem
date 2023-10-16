<?php
require_once("conf.php");
require('../model/database.php');

if (! session_id()){ session_start(); }
if (! isset($HTTP_POST_VARS) && isset($_POST)){ $HTTP_POST_VARS = $_POST; }

// $dg = new C_DataGrid("SELECT * FROM assetcentre", "id", "assetcentre");
// $dg->set_caption("Centres Grid"); 
// $dg -> set_dimension(1000, 400); 
// $dg->enable_autowidth(false);
// $dg -> enable_export('EXCEL');
// $dg -> enable_search(true);
// $dg -> enable_edit('INLINE', 'CRU');

// echo $_SESSION[GRID_SESSION_KEY.'_'.$_SESSION['scSszsDyqcqvyLtAFSSN']

$dg = new C_DataGrid($_SESSION[GRID_SESSION_KEY.'_'.$_SESSION['selected_table'].'_sql'], $_SESSION['selected_table_primary_key'], $_SESSION['selected_table']);
$dg->set_caption($_SESSION['selected_table_caption']); 
$dg -> set_dimension($_SESSION['selected_table_width'], $_SESSION['selected_table_height']); 
$dg->enable_autowidth(false);
$dg -> enable_export('EXCEL');
$dg -> enable_search(true);
$dg -> enable_edit('INLINE', 'CRU');

$_8A5AC4CC694EF9B1FCDE489E5E9E9D6E = isset($_GET['gn']) ? $_GET['gn'] : die('phpGrid fatal error: URL parameter "gn" is not defined');
$db = new C_DataBase(PHPGRID_DB_HOSTNAME, PHPGRID_DB_USERNAME, PHPGRID_DB_PASSWORD, PHPGRID_DB_NAME);
$src = isset($_GET['src']) ? $_GET['src'] : '';
$dg = ($src == 'md') ? $dg->_485FB4C99DD632A980C101519C106BEF : $dg;
$arrFields = array();
$pk = $dg->gXXLXcMHriaRfTpnLnY()[0]; //name of the primary key of the table

$JQGRID_ROWID_KEY = $_POST[JQGRID_ROWID_KEY]; //id value of the clicked row
$oper = isset($_POST['oper']) ? $_POST['oper'] : '';
$_907AFA1F0B32542AC409662FBE610773 = '';
if ($oper != '')
{
	$rs = $db->wCcQTuVYgSckNyasyuoU($dg->yMuqaBGJOflQMtdRiWxx(), 1, 1); // execute limited, get sql
	foreach ($HTTP_POST_VARS as $key => $value)
	{
		if ($key != 'oper')
		{
			$_05485668FF1F9AF3E49F3672CEDBC092 = $db->hPAWyuoeKGSrMikDjtxa(
			$dg->axEENBchSjcvncpdrwwn(), $key);
			if ($_05485668FF1F9AF3E49F3672CEDBC092)
			{
				if (! $_05485668FF1F9AF3E49F3672CEDBC092->auto_increment)
				{
					$arrFields[$key] = $value;
				}
			}
			else
			{
				$arrFields[$key] = $value;
			}
		}
	}
	if ($dg->debug) print_r($arrFields);
	$meta_type = $db->EwgdjJxDBHtjNonvuUPA($rs, $db->lHGMnYhnTIFoLxnJpUUW($rs, $pk)); //meta type of field
	if ($dg->has_multiselect())
	{
		$_CF2853CDF6FA3C44681BA55ACC51A70F = explode(',', $JQGRID_ROWID_KEY);
		$_CEAE9D35FD20B335C39A2E69A46870B0 = '';
		foreach ($_CF2853CDF6FA3C44681BA55ACC51A70F as $key => $value)
		{
			if ($meta_type != 'I' &&
			 $meta_type != 'N' &&
			 $meta_type != 'R')
				$_CEAE9D35FD20B335C39A2E69A46870B0 .= "'" . trim($value) . "',";
			else
				$_CEAE9D35FD20B335C39A2E69A46870B0 .= $value . ',';
		}
		$_CEAE9D35FD20B335C39A2E69A46870B0 = substr(
		$_CEAE9D35FD20B335C39A2E69A46870B0, 0, - 1);
	}
	else
	{
		if ($meta_type != 'I' &&
		 $meta_type != 'N' &&
		 $meta_type != 'R') $JQGRID_ROWID_KEY = "'" .
		 $JQGRID_ROWID_KEY . "'";
	}
	switch ($oper)
	{
		case 'add':
			$_907AFA1F0B32542AC409662FBE610773 = $db->db->GetInsertSQL($rs, 
			$arrFields, true);
			break;
		case 'edit':
			$_907AFA1F0B32542AC409662FBE610773 = $db->db->GetUpdateSQL($rs, 
			$arrFields, true) . ' WHERE ' . $pk . '=' .
			 $JQGRID_ROWID_KEY;
			break;
		case 'del':
			preg_match("/FROM\s+" . ADODB_TABLE_REGEX . "/is", 
			$dg->_821853BAB96B76F492924C9554DBDB09(), $tableName);
			$tableName = $tableName[1];
			if ($dg->has_multiselect())
			{
				$_907AFA1F0B32542AC409662FBE610773 = 'DELETE FROM ' . $tableName .
				 ' WHERE ' . $pk . ' IN(' . $_CEAE9D35FD20B335C39A2E69A46870B0 .
				 ')';
			}
			else
			{
				$_907AFA1F0B32542AC409662FBE610773 = 'DELETE FROM ' . $tableName .
				 ' WHERE ' . $pk . '=' . $JQGRID_ROWID_KEY;
			}
			break;
	}
	if ($dg->debug) echo 'SQL: ' . $_907AFA1F0B32542AC409662FBE610773 .
	 '<br /><br />';
	if ($_907AFA1F0B32542AC409662FBE610773 != '') $db->EtrPEtuENDzSLqqlwjdu(
	$_907AFA1F0B32542AC409662FBE610773);
}
$dg = null;
$db = null;
?>
