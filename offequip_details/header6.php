<?php	
include '../view/header6.php';
if ($_SESSION['SESS_LEVEL'] == '1' || $_SESSION['SESS_LEVEL'] == '4' || $_SESSION['SESS_LEVEL'] == '5' || $_SESSION['SESS_LEVEL'] == '7') {
?>
<div id="sub_menu">	
	<?php include("sub_menu.php"); ?>
</div>
<?php	
} else {
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl"); ?>
</div>
<?php } ?>