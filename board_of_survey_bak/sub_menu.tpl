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
		<li><a href="index.php?action=full_list" class="sm4">Total List</a></li>
		<li><a href="index.php?action=inquiry" class="sm4">Inquiry</a></li>
		<li><a href="index.php?action=add_ver_rpt" class="sm4">Add Verification Board</a></li>
		<li><a href="index.php?action=add_con_rpt" class="sm4">Add Condemnation Board</a></li>
		<li><a href="index.php?action=add_des_rpt" class="sm4">Add Destruction Board</a></li>
		<li><a href="index.php?action=Add_surveyyear_schedule" class="sm4">Add Survey Year Schedule</a></li>
		<li><a href="index.php?action=Add_surveyyear" class="sm4">Add Survey Year</a></li>
		<li><a href="index.php?action=Add_Units" class="sm4">Add Units</a></li>
    </ul>
</div>
<?php 
break;
} ?>
