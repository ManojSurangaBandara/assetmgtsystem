<div id="sub_menu">
<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
		<div class="dropdown">
		  <button class="dropbtn">Assets</button>
		  <div class="dropdown-content">
			<a href="index.php?action=land">Land</a>
			<a href="index.php?action=building">Building</a>
			<a href="index.php?action=plantmacdetails">Plant & Machinery</a>
			<a href="index.php?action=officeequdetails">Office Equipments</a>
			<a href="index.php?action=vehicledetails">Vehicle Details</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Controls</button>
		  <div class="dropdown-content">
			<a href="index.php?action=assetcentre">Centres</a>
			<a href="index.php?action=assetunit">Units</a>
			<a href="index.php?action=mas_ds_divisions">DS Divisions</a>
			<a href="index.php?action=mas_gs_divisions">GS Divisions</a>
			<a href="index.php?action=itemcategory">Item Category</a>
			<a href="index.php?action=Catalogue_Numbers">Catalogue Numbers</a>
			<a href="index.php?action=dos_material_master">DOS Material Master</a>
			<a href="index.php?action=members">Users</a>
			<a href="index.php?action=commects">Comments</a>
			<a href="index.php?action=errorcode">Error Code</a>
			<a href="index.php?action=provinces">provinces</a>
			<a href="index.php?action=change_unit_name_history">Unit Name Change History</a>
			<a href="index.php?action=user_account_change_history">User Account Change History</a>
			<a href="index.php?action=allocation_details">Allocation Details</a>
			<a href="index.php?action=scale_catalogue">Scale Catalogue</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Board of Survey</button>
		  <div class="dropdown-content">
				<a href="index.php?action=board_of_survey">Board of Survey</a>
				<a href="index.php?action=dos_material_master">DOS Material Master</a>
				<a href="index.php?action=bos_openingbalance">Opening Balance</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Loss and Damage</button>
		  <div class="dropdown-content">
			<a href="index.php?action=loss_damage">Loss and Damage</a>
			<a href="index.php?action=loss_damage_details">Loss and Damage Details</a>
			<a href="index.php?action=loss_damage_board">Loss and Damage Board</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Board Report</button>
		  <div class="dropdown-content">
			<a href="index.php?action=board_report">Board Report</a>
			<a href="index.php?action=board_report_summary">Board Report Summary</a>
			<a href="index.php?action=board_report_observations">Board Report Observations</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Tender Details</button>
		  <div class="dropdown-content">
				<a href="index.php?action=vehicle_tender_details">Vehicle Tender Details</a>
		  </div>
		</div>
<?php 
break;
case '5':
?>
		<div class="dropdown">
		  <button class="dropbtn">Assets</button>
		  <div class="dropdown-content">
			<a href="index.php?action=land">Land</a>
			<a href="index.php?action=building">Building</a>
			<a href="index.php?action=plantmacdetails">Plant & Machinery</a>
			<a href="index.php?action=officeequdetails">Office Equipments</a>
			<a href="index.php?action=vehicledetails">Vehicle Details</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Controls</button>
		  <div class="dropdown-content">
			<a href="index.php?action=assetcentre">Centres</a>
			<a href="index.php?action=assetunit">Units</a>
			<a href="index.php?action=mas_ds_divisions">DS Divisions</a>
			<a href="index.php?action=mas_gs_divisions">GS Divisions</a>
			<a href="index.php?action=itemcategory">Item Category</a>
			<a href="index.php?action=Catalogue_Numbers">Catalogue Numbers</a>
			<a href="index.php?action=members">Users</a>
			<a href="index.php?action=commects">Comments</a>
			<a href="index.php?action=errorcode">Error Code</a>
			<a href="index.php?action=provinces">provinces</a>
			<a href="index.php?action=change_unit_name_history">Unit Name Change History</a>
			<a href="index.php?action=user_account_change_history">User Account Change History</a>
			<a href="index.php?action=allocation_details">Allocation Details</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Board of Survey</button>
		  <div class="dropdown-content">
				<a href="index.php?action=board_of_survey">Board of Survey</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Loss and Damage</button>
		  <div class="dropdown-content">
			<a href="index.php?action=loss_damage">Loss and Damage</a>
			<a href="index.php?action=loss_damage_details">Loss and Damage Details</a>
			<a href="index.php?action=loss_damage_board">Loss and Damage Board</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Board Report</button>
		  <div class="dropdown-content">
			<a href="index.php?action=board_report">Board Report</a>
			<a href="index.php?action=board_report_summary">Board Report Summary</a>
			<a href="index.php?action=board_report_observations">Board Report Observations</a>
		  </div>
		</div>
		<div class="dropdown">
		  <button class="dropbtn">Tender Details</button>
		  <div class="dropdown-content">
				<a href="index.php?action=vehicle_tender_details">Vehicle Tender Details</a>
		  </div>
		</div>
<?php 
break;
case '16':
?>
		<div class="dropdown">
		  <button class="dropbtn">Tender Details</button>
		  <div class="dropdown-content">
				<a href="index.php?action=vehicle_tender_details">Vehicle Tender Details</a>
		  </div>
		</div>
<?php
break;
} ?>
</div>