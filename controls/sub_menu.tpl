<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
<div id="sec_menu">
    <ul>
        <li><a href="index.php?action=catalogue_book" class="sm6">Catalogue Book</a></li>
		<li><a href="index.php?action=Add_Catalogue" class="sm4">Add Catalogue Nos</a></li>
		<li><a href="index.php?action=Add_Catalogue_withlist" class="sm4">Add Catalogue With List</a></li>
		<li><a href="index.php?action=Add_Main_Categorys" class="sm4">Add Main Category</a></li>
		<li><a href="index.php?action=Add_Item_Categorys" class="sm4">Add Item Category</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<!--<li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
		<li><a href="index.php?action=add_item_value_range" class="sm4">Add Item Value Range</a></li>
        <li><a href="index.php?action=Add_BoardMembers" class="sm4">Add Board Member Details</a></li>
		<li><a href="index.php?action=boardmember_details" class="sm4">Board Member Details</a></li>
        <li><a href="index.php?action=Add_Institutes" class="sm4">Add Institutes</a></li>
		<li><a href="index.php?action=Add_Institutes_ajax" class="sm4">Add Institutes Using Ajax</a></li>
		<li><a href="index.php?action=add_institute_ajs" class="sm4">Add Institutes Using AJS</a></li>
		<li><a href="index.php?action=Add_BuyerDetails" class="sm4">Add Buyer Details</a></li>
		<li><a href="index.php?action=Add_BuyerDetails_ajax" class="sm4">Add Buyer Details Ajax</a></li>
        <li><a href="index.php?action=Add_AssetYear" class="sm4">Add Asset Year</a></li>
        <li><a href="index.php?action=add_quickinfos" class="sm4">Add Quick Info.</a></li>
		<li><a href="index.php?action=Add_UnitCentres" class="sm4">Add Centres</a></li>
		<li><a href="index.php?action=Add_Units" class="sm4">Add Units</a></li>
		<li><a href="index.php?action=change_unit_name" class="sm4">Change Unit Name</a></li>
		<li><a href="index.php?action=Add_Land_Categorys" class="sm4">Add Land Category</a></li>
		<li><a href="index.php?action=Add_Building_Categorys" class="sm4">Add Building Category</a></li>
		<li><a href="index.php?action=Add_DS_Divitions" class="sm4">Add DS Divisions</a></li>
		<li><a href="index.php?action=Add_GS_Divitions" class="sm4">Add GS Divisions</a></li>
		<li><a href="index.php?action=add_brand" class="sm4">Vehicle Brand</a></li>
		<li><a href="index.php?action=add_model" class="sm4">Vehicle Models</a></li>
		<li><a href="index.php?action=add_unitdetails" class="sm4">Add Unit Details</a></li>
		<li><a href="index.php?action=display_unitdetails" class="sm4">Display Unit Details</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<li><a href="index.php?action=display_unitdetails_all" class="sm4">Display Unit Details - All</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		<li><a href="index.php?action=total_input_list" class="sm4">Data Total Inputs</a></li>
		<li><a href="index.php?action=total_input_confirm_list" class="sm4">Data Input Confirm List</a></li>
		<li><a href="index.php?action=report_received" class="sm4">Add Report Received</a></li>
		<li hidden ><a href="index.php?action=add_protocol_tem" class="sm4">Add Protocol-Temp</a></li>
		<li><a href="index.php?action=Add_protocol" class="sm4">Add Protocol</a></li>
		<li><a href="index.php?action=Add_protocol_to_assets" class="sm4">Add Protocol to Assets</a></li>
		<li><a href="index.php?action=orbat" class="sm4">Control Orbat</a></li>
		<li hidden><a href="index.php?action=change_assets_unit_name" class="sm4">Change Assts Units - Only One Time</a></li>
		<li><a href="index.php?action=map_all" class="sm4">Map All</a></li>
		<li><a href="index.php?action=total_summary_list" class="sm4">Total Summary List</a></li>
		<li><a href="index.php?action=total_summary_list_2" class="sm4">Total Summary List - 2</a></li>
        <li><a href="index.php?action=add_error_code" class="sm4">Add Error Codes</a></li>
        <li><a href="index.php?action=inform_errors" class="sm4">Inform Errors to Units</a></li>
		<li><a href="index.php?action=add_unit_email" class="sm4">Add Unit E-Mail Address & Crest</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=add_places" class="sm4">Add Places</a></li>
		<li><a href="index.php?action=add_ordinance_places" class="sm4">Add Ordinance Places</a></li>
		<li><a href="index.php?action=add_unit_ordinance" class="sm4">Add Unit Ordinance</a></li>
		<li><a href="index.php?action=add_centreNameSinhala" class="sm4">Add Sinhala Names to Centres</a></li>
		<li><a href="index.php?action=add_unitNameSinhala" class="sm4">Add Sinhala Names to Units</a></li>
		<li><a href="index.php?action=unit_disband" class="sm4">Unit Disband</a></li>
		<li><a href="index.php?action=unit_disband_undo" class="sm4">Undo Unit Disband</a></li>
		<li><a href="index.php?action=cigas" class="sm4">Cigas Controls</a></li>
		<li><a href="index.php?action=add_present_location" class="sm4">Add Present Locations</a></li>
		<li><a href="index.php?action=board_report" class="sm4">Board Report Details</a></li>
    </ul>
</div>
<?php 
break;
case '2':
case '10':
case '15':
case '25':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<li><a href="index.php?action=display_unitdetails_all" class="sm4">Display Unit Details - All</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<li><a href="index.php?action=boardmember_details" class="sm4">Board Member Details</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		<li><a href="index.php?action=board_report" class="sm4">Board Report Details</a></li>
    </ul>
</div>
<?php 
break;
case '3':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>
        <li hidden><a href="index.php?action=Add_Catalogue_withlist" class="sm4">Add Catalogue Nos</a></li>
		<li hidden><a href="index.php?action=Add_Main_Categorys" class="sm4">Add Main Category</a></li>
		<li hidden><a href="index.php?action=Add_Item_Categorys" class="sm4">Add Item Category</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
        <li hidden><a href="index.php?action=Add_BoardMembers" class="sm4">Add Board Member Details</a></li>
		<li><a href="index.php?action=boardmember_details" class="sm4">Board Member Details</a></li>
        <!-- <li><a href="index.php?action=Add_Institutes" class="sm4">Add Institutes</a></li> -->
		<li hidden><a href="index.php?action=Add_Institutes_ajax" class="sm4">Add Institutes Using Ajax</a></li>
		<!-- <li><a href="index.php?action=Add_BuyerDetails" class="sm4">Add Buyer Details</a></li> -->
		<!-- <li><a href="index.php?action=Add_BuyerDetails_ajax" class="sm4">Add Buyer Details Ajax</a></li> -->
        <li><a href="index.php?action=Add_AssetYear" class="sm4">Add Asset Year</a></li>
        <li><a href="index.php?action=add_quickinfos" class="sm4">Add Quick Info.</a></li>
		<li hidden><a href="index.php?action=Add_UnitCentres" class="sm4">Add Centres</a></li>
		<li hidden><a href="index.php?action=Add_Units" class="sm4">Add Units</a></li>
		<li hidden><a href="index.php?action=Add_Land_Categorys" class="sm4">Add Land Category</a></li>
		<li hidden><a href="index.php?action=Add_Building_Categorys" class="sm4">Add Building Category</a></li>
		<li hidden><a href="index.php?action=Add_DS_Divitions" class="sm4">Add DS Divisions</a></li>
		<li hidden><a href="index.php?action=Add_GS_Divitions" class="sm4">Add GS Divisions</a></li>
		<li hidden><a href="index.php?action=add_brand" class="sm4">Vehicle Brand</a></li>
		<li hidden><a href="index.php?action=add_model" class="sm4">Vehicle Models</a></li>
		<li><a href="index.php?action=display_unitdetails_all" class="sm4">Display Unit Details - All</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=add_error_code" class="sm4">Add Error Codes</a></li>
        <li><a href="index.php?action=inform_errors" class="sm4">Inform Errors to Units</a></li>
		<li><a href="index.php?action=add_unit_email" class="sm4">Add Unit E-Mail Address</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li> 
    </ul>
</div>
<?php 
break;
case '4':
case '5':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>
        <li><a href="index.php?action=Add_Catalogue_withlist" class="sm4">Add Catalogue Nos</a></li>
		<li><a href="index.php?action=Add_Main_Categorys" class="sm4">Add Main Category</a></li>
		<li><a href="index.php?action=Add_Item_Categorys" class="sm4">Add Item Category</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<li><a href="index.php?action=boardmember_details" class="sm4">Board Member Details</a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
        <li><a href="index.php?action=Add_Institutes" class="sm4">Add Institutes</a></li>
        <li><a href="index.php?action=Add_AssetYear" class="sm4">Add Asset Year</a></li>
		<li><a href="index.php?action=Add_UnitCentres" class="sm4">Add Unit Centres</a></li>
		<li><a href="index.php?action=Add_Units" class="sm4">Add Units</a></li>
		<li><a href="index.php?action=Add_Land_Categorys" class="sm4">Add Land Category</a></li>
		<li><a href="index.php?action=Add_Building_Categorys" class="sm4">Add Building Category</a></li>
		<li><a href="index.php?action=Add_DS_Divitions" class="sm4">Add DS Divisions</a></li>
		<li><a href="index.php?action=Add_GS_Divitions" class="sm4">Add GS Divisions</a></li>
		<li><a href="index.php?action=display_unitdetails_all" class="sm4">Display Unit Details - All</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		<li><a href="index.php?action=Add_protocol" class="sm4">Add Protocol</a></li>
		<li><a href="index.php?action=add_error_code" class="sm4">Add Error Codes</a></li>
        <li><a href="index.php?action=inform_errors" class="sm4">Inform Errors to Units</a></li>
		<li><a href="index.php?action=add_unit_email" class="sm4">Add Unit E-Mail Address</a></li>
		<li><a href="index.php?action=board_report" class="sm4">Board Report Details</a></li>
    </ul>
</div>
<?php 
break;
case '6':
case '7':
case '8':
case '13':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<li><a href="index.php?action=add_unitdetails" class="sm4">Add Unit Details</a></li>
		<li><a href="index.php?action=display_unitdetails" class="sm4">Display Unit Details</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
        <li><a href="index.php?action=Add_BoardMembers" class="sm4">Board Member Details</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		<li><a href="index.php?action=add_present_location" class="sm4">Present Locations</a></li>
		<li><a href="index.php?action=notice_details" class="sm4">Notice</a></li>
		<li hidden><a href="index.php?action=allocation_details">Allocation Details</a></li>
    </ul>
</div>
<?php 
break;
case '12':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=Add_Units" class="sm4">Add Units</a></li>
		<li><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>
        <li><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>
		<li><a href="index.php?action=add_unitdetails" class="sm4">Add Unit Details</a></li>
		<li><a href="index.php?action=display_unitdetails" class="sm4">Display Unit Details</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
        <li><a href="index.php?action=Add_BoardMembers" class="sm4">Board Member Details</a></li>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		<li><a href="index.php?action=add_present_location" class="sm4">Present Locations</a></li>
		<li><a href="index.php?action=notice_details" class="sm4">Notice</a></li>
		<li hidden><a href="index.php?action=allocation_details">Allocation Details</a></li>
		<li><a href="index.php?action=view_dos_catalogue">View DOS Catalogue Details</a></li>
		<li><a href="index.php?action=compare_dam_dos_catalogue">Compare DAM & DOS Catalogue Nos.</a></li>
		<li><a href="index.php?action=add_dos_catalogue">Add DOS Catalogue Details</a></li>
		<li><a href="index.php?action=add_centreNameSinhala">Add Sinhala Names to Centres</a></li>
		<li><a href="index.php?action=add_unitNameSinhala">Add Sinhala Names to Units</a></li>		
    </ul>
</div>
<?php 
break;
case '16':
//terder Details User
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=Add_BuyerDetails" class="sm4">Add Buyer Details</a></li>
		<li><a href="index.php?action=Add_BuyerDetails_ajax" class="sm4">Add Buyer Details Ajax</a></li>
    </ul>
</div>
<?php 
break;
case '17':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=view_dos_catalogue">View DOS Catalogue Details</a></li>
		<!-- <li hidden><a href="index.php?action=catalogue_book" class="sm4">Catalogue Book</a></li>-->
        <!--<li hidden><a href="index.php?action=List_Inquiry" class="sm4">Catalogue Inquiry</a></li>-->
		<li><a href="index.php?action=add_unitdetails" class="sm4">Add Unit Details</a></li>
		<li><a href="index.php?action=display_unitdetails" class="sm4">Display Unit Details</a></li>
		<li><a href="index.php?action=display_Dam_details" class="sm4">DAM Details</a></li>
		<!-- <li><a href="index.php?action=List_Inquiry_ajax" class="sm4">Catalogue Inquiry 2</a></li> -->
        <!--<li hidden ><a href="index.php?action=Add_BoardMembers" class="sm4">Board Member Details</a></li>-->
		<li><a href="index.php?action=Change_Passwords" class="sm4">Change Password</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li hidden><a href="index.php?action=options_ajax" class="sm4">User Manual</a></li>
		 <!--<li hidden><a href="index.php?action=add_present_location" class="sm4">Present Locations</a></li>-->
		<li><a href="index.php?action=notice_details" class="sm4">Notice</a></li>
		<!--<li hidden><a href="index.php?action=allocation_details">Allocation Details</a></li>-->
    </ul>
</div>
<?php 
break;
} ?>