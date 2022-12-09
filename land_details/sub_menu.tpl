<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
<div id="sec_menu">
<ul>
		<li><span style="font-size:14px;cursor:pointer" onclick="openNav()">&#9776;</span></li>			
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List - 2</a></li>
        <li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li hidden><a href="index.php?action=Add_Land_Details_Ajax" class="sm4"><?php echo $subMenu[1][$lang]?> - Ajax</a></li>
        <li><a href="index.php?action=upload_plan" class="sm4">Upload Plan Details</a></li>
		<li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
		<li hidden><a href="index.php?action=List_Approved_Ajax" class="sm4"><?php echo $subMenu[2][$lang]?> - Ajax</a></li>
        <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
		<li hidden><a href="index.php?action=Select_Items_For_Modifications_Ajax" class="sm4"><?php echo $subMenu[4][$lang]?> - Ajax</a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li hidden><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=delete_not_confirm" class="sm4">Delete Data-Not Confirm</a></li>
		<li><a href="index.php?action=zero_value_list" class="sm4">Zero Value List</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li><a href="index.php?action=list_province" class="sm4">List - Sort by province</a></li>
		<li><a href="index.php?action=delete_all_items" class="sm4" style="color:red">Delete Items(Use Carefully)</a></li>
		<li hidden><a href="index.php?action=testpage" class="sm4">Test Page</a></li>
		<li><a href="index.php?action=Add_Land_Details_AJS" class="sm4"><?php echo $subMenu[1][$lang]?> - AJS</a></li>
		<li><a href="index.php?action=board_report_start" class="sm4 blink_text">Board Reports<img src="../pic/new.png" style="width:40px;height:20px;"></a></li>
		<li><a href="index.php?action=upload_vreport" class="sm4">Upload Valuation Report</a></li>		
    </ul>
</div>
<?php 
break;
case '2':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=list_province" class="sm4">List - Sort by province</a></li>
    </ul>
</div>
<?php 
break;
case '3':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <!-- <li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li> -->
		<!-- <li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li> -->
        <!-- <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li> --> 
		<!-- <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li> -->
        <!-- <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li> -->
		<!-- <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li> -->
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li>--> 
		<!-- <li><a href="index.php?action=testpage" class="sm4">Test Page</a></li> --> 
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=list_province" class="sm4">List - Sort by province</a></li>
    </ul>
</div>
<?php 
break;
case '4':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <!-- <li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li> -->
		<!-- <li><a href="index.php?action=Add_Land_Details_Ajax" class="sm4"><?php echo $subMenu[1][$lang]?></a></li> -->
        <!-- <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li> --> 
		<!-- <li><a href="index.php?action=List_Approved_Ajax" class="sm4"><?php echo $subMenu[2][$lang]?></a></li> -->
        <!-- <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li> -->
		<li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li> -->
		<!-- <li><a href="index.php?action=testpage" class="sm4">Test Page</a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=list_province" class="sm4">List - Sort by province</a></li>
    </ul>
</div>
<?php 
break;
case '5':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<!-- <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li> -->
        <li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=list_province" class="sm4">List - Sort by province</a></li>
		<li><a href="index.php?action=upload_vreport" class="sm4">Upload Valuation Report</a></li>
	</ul>
</div>
<?php 
break;
case '6':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
        <!-- <li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>-->
		<li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
        <!-- <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>-->
		<li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
	</ul>
</div>
<?php
break;
case '7':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li><a href="index.php?action=upload_plan" class="sm4">Upload Plan Details</a></li>
        <!-- <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li> -->
		<li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=delete_not_confirm" class="sm4">Delete Data-Not Confirm</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li><a href="index.php?action=board_report_start" class="sm4 blink_text">Board Reports<img src="../pic/new.png" style="width:40px;height:20px;"></a></li>
		<li><a href="index.php?action=upload_vreport" class="sm4">Upload Valuation Report</a></li>
	</ul>
</div>
<?php 
break;
case '8':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
        <!--<li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li> -->
		<li><a href="index.php?action=Add_Land_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li><a href="index.php?action=upload_plan" class="sm4">Upload Plan Details</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_Ajax" class="sm4"><?php echo $subMenu[3][$lang]?> - Ajax</a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li hidden><a href="index.php?action=Add_Land_Details_AJS" class="sm4"><?php echo $subMenu[1][$lang]?> - AJS</a></li>
	</ul>
</div> 
<?php 
break;
case '15':
case '25':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li hidden><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
    </ul>
</div>
<?php 
break;
case '10':
		$count = LandDB::getHasRecord_psos_allow();
	if ($count != 0) {
?>
<div id="sec_menu">
	<ul>
        <li><a href="index.php?action=List_Land_Details" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
    </ul>
</div>
<?php
	} 
break;
} ?>
