<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="myApp">
    <!-- the head section -->
    <head>
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <meta http-equiv="Content-Language" content="en-us">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Directorate of Asset Management</title>
        <link rel="shortcut icon" href="../pic/favicon.ico" type="favicon.icon" />
        <link rel="stylesheet" href="../angular/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../jquery/jquery-ui.css">	
		<link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
		<script type="text/javascript" src="../jscript/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="../jquery/jquery-ui.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../easyui/themes/default/easyui.css">
		<link rel="stylesheet" type="text/css" href="../easyui/themes/icon.css">
		<script type="text/javascript" src="../easyui/jquery.min.js"></script>
		<script type="text/javascript" src="../easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="../easyui/jquery.edatagrid.js"></script>
		<script src="../angular/angular.min.js"></script>
		<script src="../angular/angu-fixed-header-table.js"></script>
<script type="text/javascript"> 
//Enter Disable
	function stopRKey(evt) { 
		  var evt = (evt) ? evt : ((event) ? event : null); 
		  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
		  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
	} 
			document.onkeypress = stopRKey; 
</script>
    </head>
<?php include('mainmenu.php'); ?>