<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=List_Inquiry" class="sm4">Inquiry Tender</a></li>
		<li><a href="index.php?action=Add_VehicleTenderDetails" class="sm4">Add Tender Details</a></li>
		<li><a href="index.php?action=create_new_tenderno" class="sm4">Create New Tender Number </a></li>
		<li><a href="index.php?action=Add_BuyerDetails" class="sm4">Add Buyer Details</a></li><!--<li><a href="index.php?action=List_Building_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li> -->
    </ul>
</div>
<?php 
break;
case '9':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=List_Inquiry" class="sm4">Inquiry Tender</a></li>
		<li><a href="index.php?action=Add_VehicleTenderDetails" class="sm4">Add Tender Details</a></li>
		<li><a href="index.php?action=create_new_tenderno" class="sm4">Create New Tender Number </a></li>
		<li><a href="index.php?action=Add_BuyerDetails" class="sm4">Add Buyer Details</a></li>
    </ul>
</div>
<?php 
break;
 } ?>