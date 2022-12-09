<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List - 2</a></li>
		<!--<li><a href="index.php?action=Paging_List" class="sm4">Paging List</a></li> -->
        <li><a href="index.php?action=Add_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li><a href="index.php?action=upload_plan" class="sm4">Upload Photos</a></li>
        <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
        <li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
		<li><a href="index.php?action=List_Disposal&transfer=1" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
		<li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[5][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=Full_List" class="sm4"><?php echo $subMenu[7][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=List_summary_tree" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree 2</a></li>
		<li><a href="index.php?action=List_summary_tree_3" class="sm4">Summary List - Tree 3</a></li>
		<li><a href="index.php?action=Delete_Not_Confirm" class="sm4">Delete Data-Not Confirm</a></li>
		<li><a href="index.php?action=delete_all_items" class="sm4" style="color:red">Delete Items(Use Carefully)</a></li>
		<li><a href="index.php?action=add_serial_nos" class="sm4">Add Serial Nos.</a></li>
		<li><a href="index.php?action=add_serial_nos_ajax" class="sm4">Modify Details</a></li>
		<li><a href="index.php?action=zero_value_list" class="sm4">Zero Value List</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li><a href="index.php?action=sno_duplicates" class="sm4">Find Serial No Duplicates</a></li>
		<li><a href="index.php?action=serialno_dash" class="sm4" style="color:red">Serial No Replace to "-"</a></li>
		<li><a href="index.php?action=reorder_id" class="sm4">Reorder Identification No.</a></li>
		<li><a href="index.php?action=check_notconfirm" class="sm4">Check Not Confirm</a></li>
		<li><a href="index.php?action=ca_no_err_list" class="sm4">Catalogue No Error List</a></li>
		<li><a href="index.php?action=min_max_values" class="sm4">Find Min Max Values</a></li>
		<li><a href="index.php?action=record_status" class="sm4">Record Status</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=disband_selected_items" class="sm4">Delete Disband Items</a></li>
		<li><a href="index.php?action=display_item" class="sm4">Training/Display Items</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
		<li><a href="index.php?action=board_report_start" class="sm4 blink_text">Board Reports<img src="../pic/new.png" style="width:40px;height:20px;"></a></li>
    </ul>
</div>
<?php 
break;
case '2':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li hidden><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '3':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=check_notconfirm" class="sm4">Check Not Confirm</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '4':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
		<li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[5][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=check_notconfirm" class="sm4">Check Not Confirm</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '5':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_update" class="sm4">View Updates</a></li>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
		<!--<li><a href="index.php?action=Paging_List" class="sm4">Paging List</a></li> -->
        <li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
		<li><a href="index.php?action=Select_Items_For_Modifications" class="sm4"><?php echo $subMenu[5][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<!-- <li><a href="index.php?action=Full_List" class="sm4"><?php echo $subMenu[7][$lang]?></a></li> -->
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li hidden><a href="index.php?action=List_summary_tree" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=check_notconfirm" class="sm4">Check Not Confirm</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '6':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
        <li><a href="index.php?action=Add_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
        <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
        <li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
		<li><a href="index.php?action=List_Disposal&transfer=1" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<!-- <li><a href="index.php?action=Full_List" class="sm4"><?php echo $subMenu[7][$lang]?></a></li> -->
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=add_serial_nos" class="sm4">Add Serial Nos.</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php
break;
case '7':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=Add_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li><a href="index.php?action=upload_plan" class="sm4">Upload Photos</a></li>
        <li><a href="index.php?action=List_Approved" class="sm4"><?php echo $subMenu[2][$lang]?></a></li>
        <li><a href="index.php?action=List_Disposal" class="sm4"><?php echo $subMenu[3][$lang]?></a></li>
		<li><a href="index.php?action=List_loss" class="sm4">Lost & Damaged</a></li>
		<li><a href="index.php?action=List_Disposal&transfer=1" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<!-- <li><a href="index.php?action=Full_List" class="sm4"><?php echo $subMenu[7][$lang]?></a></li> -->
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li><a href="index.php?action=Delete_Not_Confirm" class="sm4">Delete Data-Not Confirm</a></li>
		<li><a href="index.php?action=add_serial_nos_ajax" class="sm4">Modify Details</a></li>
		<li><a href="index.php?action=board_report_start" class="sm4 blink_text">Board Reports<img src="../pic/new.png" style="width:40px;height:20px;"></a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '8':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
        <li><a href="index.php?action=Add_Details" class="sm4"><?php echo $subMenu[1][$lang]?></a></li>
		<li><a href="index.php?action=upload_plan" class="sm4">Upload Photos</a></li>
        <li><a href="index.php?action=List_Disposal" class="sm4">Disposal Details</a></li>
		<li><a href="index.php?action=List_Disposal&transfer=1" class="sm4"><?php echo $subMenu[4][$lang]?></a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<!-- <li><a href="index.php?action=Full_List" class="sm4"><?php echo $subMenu[7][$lang]?></a></li> -->
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=Delete_Not_Confirm" class="sm4">Delete Data-Not Confirm</a></li>
		<li><a href="index.php?action=ledgerformat" class="sm4">Print Ledger Format</a></li>
		<li><a href="index.php?action=add_serial_nos_ajax" class="sm4">Modify Details</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=date_range_changes" class="sm4">Date Dange Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div> 
<?php
break; 
case '15':
case '25':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li hidden><a href="index.php?action=tree_list" class="sm4">Tree List</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=List_columnlist" class="sm4">Full List-Column Select</a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li hidden><a href="index.php?action=List_summary_tree" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
		<li><a href="index.php?action=donated_item" class="sm4">Donated Items</a></li>
    </ul>
</div>
<?php 
break;
case '10':
		$count = PlantMacDB::getHasRecord_psos_allow();
	if ($count != 0) {
?>
<div id="sec_menu">
	<ul>
        <li><a href="index.php?action=Paging_List" class="sm4"><?php echo $subMenu[0][$lang]?></a></li>
		<li><a href="index.php?action=paging_list_headfix" class="sm4"><?php echo $subMenu[0][$lang]?> - 2</a></li>
		<li><a href="index.php?action=tree_list_2" class="sm4">Tree List</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4"><?php echo $subMenu[6][$lang]?></a></li>
		<li><a href="index.php?action=List_summary" class="sm4">Summary List</a></li>
		<li><a href="index.php?action=List_summary_tree_2" class="sm4">Summary List - Tree</a></li>
		<li><a href="index.php?action=monthly_changes" class="sm4">Monthly Changes</a></li>
    </ul>
</div>
<?php
	} 
break;
case '14':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=Receive_Condemned_Goods" class="sm4">Receive Condemned Goods from Units</a></li>
		<li><a href="index.php?action=ordinance_received_details" class="sm4">Received Details</a></li>
    </ul>
</div>
<?php 
break;
} ?>
