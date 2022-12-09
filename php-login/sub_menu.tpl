<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=user_control_level" class="sm4">User Control Levels</a></li>
        <li><a href="index.php?action=user_list" class="sm4">Users List</a></li>
        <li><a href="index.php?action=add_users" class="sm4">Add Users</a></li>
		<li><a href="index.php?action=reset_passwords" class="sm4">Reset Password</a></li>
        <li><a href="index.php?action=psos_allow_list" class="sm4">PSOs Allow List</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=last_log_date" class="sm4">Last Loged Date</a></li>
		<li><a href="index.php?action=active_deactive" class="sm4">Active/Deactive Account</a></li>
		<li><a href="index.php?action=add_dam_controller" class="sm4">DAM Controllers</a></li>
		<li><a href="index.php?action=account_change_history" class="sm4">Account Change History</a></li>
		<!--<li><a href="index.php?action=temp" class="sm4">temp</a></li>--> 
    </ul>
</div>
<?php
 break;
 case '3':
 case '5':
?>
<div id="sec_menu">
    <ul>
		<li><a href="index.php?action=user_control_level" class="sm4">User Control Levels</a></li>
        <li><a href="index.php?action=user_list" class="sm4">Users List</a></li>
        <li><a href="index.php?action=add_users" class="sm4">Add Users</a></li>
		<li><a href="index.php?action=reset_passwords" class="sm4">Reset Password</a></li>
        <li><a href="index.php?action=psos_allow_list" class="sm4">PSOs Allow List</a></li>
		<li><a href="index.php?action=logging_list" class="sm4">Logging Details</a></li>
		<li><a href="index.php?action=active_deactive" class="sm4">Active/Deactive Account</a></li>
		<!--<li><a href="index.php?action=temp" class="sm4">temp</a></li> -->
    </ul>
</div>
<?php } ?>
