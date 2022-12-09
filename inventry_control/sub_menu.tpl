<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
case '2':
case '3':
case '4':
case '12':
?>
<div id="sec_menu">
    <ul>
		<li><a href="#" class="sm4"></a></li>
    </ul>
</div>
<?php 
break;
} ?>
