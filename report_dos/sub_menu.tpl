<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
case '2':
case '3':
case '4':
case '13':
?>
<div id="sec_menu">
    <ul>
		<li style="font-size:16px";><a href="index.php?action=report_stock" class="sm4">Stock Report</a></li>
		
    </ul>
</div>
<?php 
break;
} ?>
