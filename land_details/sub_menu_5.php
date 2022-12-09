<div id="sub_menu">
<div class="dropdown">
  <button class="dropbtn">Board Reports</button>
  <div class="dropdown-content">
		<a style="pointer-events: none;" href="index.php?action=board_report_start">Download Board Report</a>
		<a style="pointer-events: none;" href="index.php?action=board_report_history">Board Report History</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Handle Land Details</button>
  <div class="dropdown-content">
		<a style="pointer-events: none;" href="index.php?action=Add_Land_Details"><?php echo $subMenu[1][$lang]?></a>
		<a style="pointer-events: none;" href="index.php?action=upload_plan">Upload Land Plan</a>
		<a href="index.php?action=Select_Items_For_Modifications">Land Details Modification</a>
		<a href="index.php?action=delete_not_confirm">Delete Data-Not Confirm</a>
		<a style="color:red; pointer-events: none;" href="index.php?action=delete_all_items" >Delete Items(Use Carefully)</a>
		<a style="pointer-events: none;" href="index.php?action=mofifydata_grid">Modify Details</a>
		<a style="pointer-events: none;" href="index.php?action=upload_vreport">Upload Valuation Report</a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">Approve Details</button>
  <div class="dropdown-content">
		<a style="pointer-events: none;" href="index.php?action=List_Approved"><?php echo $subMenu[2][$lang]?></a>
  </div>
</div>
<div class="dropdown">
  <button class="dropbtn">List Details</button>
  <div class="dropdown-content">
        <a href="index.php?action=List_Land_Details"><?php echo $subMenu[0][$lang]?></a>
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
		<a href="?index.php&action=List_summary">Group By Land Category</a>
		<a href="?index.php&action=List_summary6">Group By Land Category to Date (Ignore Units)</a></li> 
  </div>
</div>
</div>