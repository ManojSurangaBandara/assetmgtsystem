<?php	
include '../view/header6.php';
if ($_SESSION['SESS_LEVEL'] == '1' || $_SESSION['SESS_LEVEL'] == '4' || $_SESSION['SESS_LEVEL'] == '5') {
?>
<div id="sub_menu">	
	<?php include("sub_menu_".$_SESSION['SESS_LEVEL'].".php"); ?>
</div>
<?php	
} else {
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl"); ?>
</div>
<?php } ?>