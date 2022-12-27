<div id="sub_menu">
<div class="dropdown">
  <button class="dropbtn">Board Reports</button>
  <div class="dropdown-content">
		<a href="index.php?action=board_report_start">Download Board Report</a>
		<a href="index.php?action=board_report_history">Board Report History</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Handle Building Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=Add_Building_Details"><?php echo $subMenu[1][$lang]?></a>
		<a href="index.php?action=upload_plan">Upload Building Plan</a>
		<a href="index.php?action=Select_Items_For_Modifications">Building Details Modification</a>
		<a href="index.php?action=delete_not_confirm">Delete Data-Not Confirm</a>
		<a href="index.php?action=delete_all_items" style="color:red">Delete Items(Use Carefully)</a>
		<a href="index.php?action=mofifydata_grid">Modify Details</a>
		<a href="index.php?action=upload_vreport">Upload Valuation Report</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Approve Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_Approved"><?php echo $subMenu[2][$lang]?></a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">List Details</button>
  <div class="dropdown-content">
        <a href="index.php?action=List_Building_Details"><?php echo $subMenu[0][$lang]?></a>
		<a href="index.php?action=tree_list_2">Tree List</a>
		<a href="index.php?action=List_Inquiry">Inquiry</a>
		<a href="index.php?action=List_columnlist">Full List-Column Select</a>
		<a href="index.php?action=zero_value_list">Zero Value List</a>
		<a href="index.php?action=ledgerformat">Print Ledger Format</a>
		<a href="index.php?action=list_province">List Sort by Province</a>
		<a href="index.php?action=view_update">DAM Comments</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Summary Details</button>
  <div class="dropdown-content">
		<a href="index.php?action=List_summary">Summary List</a>
		<a href="?index.php&action=List_summary">Group By Building Category</a>
		<a href="?index.php&action=List_summary6">Group By Building Category to Date (Ignore Units)</a></li> 
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Non Public Items</button>
  <div class="dropdown-content">
        <a href="index.php?action=np_List_Building_Details"><?php echo $subMenu[0][$lang]?></a>
		<a href="index.php?action=np_tree_list_2">Tree List</a>
		<a href="index.php?action=np_List_Inquiry">Inquiry</a>
  </div>
</div>
</div>