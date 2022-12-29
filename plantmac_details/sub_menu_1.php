<div id="sub_menu">
<div class="dropdown">
  <button class="dropbtn">Board Reports</button>
  <div class="dropdown-content">
		<a href="index.php?action=board_report_start">Download Board Report</a>
		<a href="index.php?action=board_report_history">Board Report History</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Handle Plant & Machinery</button>
  <div class="dropdown-content">
		<a href="index.php?action=Add_Details"><?php echo $subMenu[1][$lang]?></a>
		<a href="index.php?action=add_details_new&fundtype=0"><?php echo $subMenu[1][$lang]."- New"?></a>
		<a href="index.php?action=upload_plan">Upload Photos</a>
		<a href="index.php?action=Select_Items_For_Modifications"><?php echo $subMenu[5][$lang]?></a>
		<a href="index.php?action=Delete_Not_Confirm">Delete Data-Not Confirm</a>
		<a href="index.php?action=delete_all_items" style="color:red">Delete Items(Use Carefully)</a>
		<a href="index.php?action=add_serial_nos_ajax">Modify Details</a>
		<a href="index.php?action=disband_selected_items">Delete Disband Items</a>
		<a href="index.php?action=add_repair_details">Add Item Repair Details</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Approve Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_Approved"><?php echo $subMenu[2][$lang]?></a>
		<a href="index.php?action=tobe_approve_new&fundtype=0">Pending Approve</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Disposal Details</button>
  <div class="dropdown-content">
        <a href="index.php?action=List_Disposal"><?php echo $subMenu[3][$lang]?></a>
		 <?php if (isset($transfer) && $transfer == 1) { ?> 
		<a href="?index.php&action=Select_Items_For_Disposal&transfer=1"><?php echo $slideBar[18][$lang]?></a>
		<a href="?index.php&action=Selected_Items_For_Disposal&transfer=1"><?php echo $slideBar[19][$lang]?></a>
		<a href="?index.php&action=Confirm_Items_For_Disposal&transfer=1"><?php echo $slideBar[20][$lang]?></a>
		<a href="?index.php&action=Disband_List">Disband List</a>
		<a href="?index.php&action=transfer_selet_quick">Select Transfer - Quick</a>
		<?php } else { ?>
		 <a href="?index.php&action=Select_Items_For_Disposal"><?php echo $slideBar[21][$lang]?></a>
		 <a href="?index.php&action=Select_Items_For_Disposal_quick">Select Items For Disposal - Quick</a>
		 <a href="?index.php&action=add_disposal_details_quick">Add Disposal Details - Quick</a>
		 <a href="?index.php&action=Selected_Items_For_Disposal"><?php echo $slideBar[22][$lang]?></a>
		 <a href="?index.php&action=Selected_List_For_Disposal">Selected List For Disposal</a>
		 <a href="?index.php&action=Confirm_Items_For_Disposal"><?php echo $slideBar[23][$lang]?></a>
		 <a href="?index.php&action=confirm_items_for_disposal_quick">Confirm Items for Disposal - Quick</a>
		 <a href="?index.php&action=Confirmed_Items_For_Disposal">Confirmed Items For Disposal</a>
		 <a href="?index.php&action=Confirmed_List_For_Disposal">Confirmed List For Disposal</a>  														
		 <a href="?index.php&action=approve_Items_For_Disposal"><?php echo $slideBar[24][$lang]?></a>
		 <a href="?index.php&action=Approve_Items_For_Disposal_List"><?php echo $slideBar[25][$lang]?></a>
		 <a href="?index.php&action=approve_Items_For_Disposal_catlog">Approve Disposal- Item Wise </a>
		 <a href="?index.php&action=Disposal_List"><?php echo $slideBar[26][$lang]?></a>
		 <a href="?index.php&action=Disposal_Inquiry"><?php echo $slideBar[27][$lang]?></a>
		 <a href="index.php?action=disposal_inquiry_tree">Disposal Inquiry Tree - Tree</a>
		 <a href="index.php?action=Disposal_List_summary_tree_2">Disposal-Summary List - Tree</a>
		 <a href="?index.php&action=disposal_yearsummary_List">Year Summary List</a>
		 <a href="?index.php&action=select_items_for_send_ordinance">Send Items to Ordnance</a>
		 <a href="?index.php&action=ordinance_stock_list">Ordnance Stock List</a>
		 <a href="?index.php&action=undo_Disposal">Undo Disposal</a>
		<?php } ?>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">List Details</button>
  <div class="dropdown-content">
        <a href="index.php?action=Paging_List"><?php echo $subMenu[0][$lang]?></a>
		<a href="index.php?action=paging_list_headfix"><?php echo $subMenu[0][$lang]?> - 2</a>
		<a href="index.php?action=tree_list_2">Tree List</a>
		<a href="index.php?action=List_Inquiry"><?php echo $subMenu[6][$lang]?></a>
		<a href="index.php?action=Full_List"><?php echo $subMenu[7][$lang]?></a>
		<a href="index.php?action=List_columnlist">Full List-Column Select</a>
		<a href="index.php?action=zero_value_list">Zero Value List</a>
		<a href="index.php?action=ledgerformat">Print Ledger Format</a>
		<a href="index.php?action=sno_duplicates">Find Serial No Duplicates</a>
		<a href="index.php?action=check_notconfirm">Check Not Confirm</a>
		<a href="index.php?action=ca_no_err_list">Catalogue No Error List</a>
		<a href="index.php?action=min_max_values">Find Min Max Values</a>
		<a href="index.php?action=record_status">Record Status</a>
		<a href="index.php?action=view_update">View DAM Comment</a>
		<a href="index.php?action=donated_item">Donated Items</a>
		<a href="index.php?action=allocation_list">Allocation and Present Status</a>
		<a href="index.php?action=lifetime_list">Lifetime Details</a>
		<a href="index.php?action=repair_details_list">Repair Details List</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Summary Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_summary">Summary List</a>
		<a href="?index.php&action=List_summary">Group By Catalogue Number</a>
		<a href="?index.php&action=List_summary2">Group By Item Category</a>
		<a href="?index.php&action=List_summary3">Group By Main Category</a>
		<a <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?> href="?index.php&action=List_summary4_1">Group By Catalogue Number (Ignore Units)</a>
		<a <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?> href="?index.php&action=List_summary5_1">Group By Item Category (Ignore Units)</a>
		<a <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?> href="?index.php&action=List_summary4">Group By Catalogue Number (Ignore Units, All Items)</a>
		<a <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?> href="?index.php&action=List_summary5">Group By Item Category (Ignore Units, All Items)</a>
		<a <?php if ($_SESSION['SESS_LEVEL'] > 5){ echo 'hidden' ;}?> href="?index.php&action=List_summary6">Group By Item Category to Date(Ignore Units, All Items)</a>
		<a href="index.php?action=List_summary_tree_2">Summary List - Tree </a>
		<a href="index.php?action=List_summary_tree_3">Summary List - Tree (With Unit)</a>
		<a href="index.php?action=monthly_changes">Monthly Changes</a>
		<a href="index.php?action=date_range_changes">Date Range Changes</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Lost & Damaged</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_loss">Lost & Damaged</a>
		<a href="index.php?action=Select_Items_For_loss">Select Lost & Damaged Items</a>
		<a href="index.php?action=Selected_Items_For_loss">Selected List Lost & Damaged</a>
		<a href="index.php?action=Confirm_Items_For_loss">Confirm Selected Lost & Damaged</a> 
		<a href="index.php?action=approve_Items_For_loss">Approve Comfirmed Lost & Damaged</a>
		<a href="index.php?action=loss_List">Lost & Damaged List</a>
		<a href="index.php?action=loss_List_Inquiry">Lost & Damaged Inquiry</a>
		<a href="index.php?action=lost_List_summary_tree_2">Lost-Summary List - Tree</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Transfer Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_Disposal&transfer=1"><?php echo $subMenu[4][$lang]?></a>
		<a href="?index.php&action=transfer_selet_quick">Select Transfer - Quick</a>
		<a href="?index.php&action=Select_Items_For_Disposal&transfer=1"><?php echo $slideBar[18][$lang]?></a>
		<a href="?index.php&action=Selected_Items_For_Disposal&transfer=1"><?php echo $slideBar[19][$lang]?></a>
		<a href="?index.php&action=Confirm_Items_For_Disposal&transfer=1"><?php echo $slideBar[20][$lang]?></a>
		<a href="?index.php&action=Disband_List">Disband List</a>

  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Training & Display Items</button>
  <div class="dropdown-content">
		<a href="index.php?action=display_item">Training/Display Items</a>
		<a href="?index.php&action=Select_Items_For_displayitem">Select Display/Training Items</a>
		<a href="?index.php&action=Selected_Items_For_displayitem">Selected List Display/Training Items</a>
		<a href="?index.php&action=Confirm_Items_For_displayitem">Confirm Selected Display/Training Items</a> 
		<a href="?index.php&action=approve_Items_For_displayitem">Approve Comfirmed Display/Training Items</a>
		<a href="?index.php&action=displayitem_List">Display/Training Items List</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Non Public Fund</button>
  <div class="dropdown-content">
        <a href="index.php?action=add_details_new&fundtype=1"><?php echo $subMenu[1][$lang]."- New"?></a>
		<a href="index.php?action=tobe_approve_new&fundtype=1">Pending Approve</a>
		<a href="index.php?action=np_Paging_List"><?php echo $subMenu[0][$lang]?></a>
		<a href="index.php?action=np_paging_list_headfix"><?php echo $subMenu[0][$lang]?> - 2</a>
		<a href="index.php?action=np_tree_list_2">Tree List</a>
		<a href="index.php?action=np_List_Inquiry"><?php echo $subMenu[6][$lang]?></a>
  </div>
</div>
</div>