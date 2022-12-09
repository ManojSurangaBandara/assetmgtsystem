<?php 
switch ($_SESSION['SESS_LEVEL']) {
case '1':
case '2':
case '3':
case '4':
case '13':
?>
<div id="sec_menu">
    <ul>
		<li style="font-size:16px";><a href="index.php?action=new_loss_damage" class="sm4">අළුත් ගොණුවක්</a></li>
		<li style="font-size:16px";><a href="index.php?action=board_details" class="sm4">මණ්ඩලය</a></li>
		<li style="font-size:16px";><a href="index.php?action=104_3" class="sm4">මු.රෙ. 104-(3)</a></li>
		<li style="font-size:16px";><a href="index.php?action=104_4" class="sm4">මු.රෙ. 104-(4)</a></li>
		<li style="font-size:16px";><a href="index.php?action=loss_damage_charge" class="sm4">අයකිරීම්</a></li>
		<li style="font-size:16px";><a href="index.php?action=109" class="sm4">මු.රෙ. 109</a></li>
		<li style="font-size:16px";><a href="index.php?action=removed" class="sm4">කපා හැරීම</a></li>
		<li style="font-size:16px";><a href="index.php?action=loss_damage_details" class="sm4">විස්තර ලයිස්තුව</a></li>
		<li style="font-size:16px";><a href="index.php?action=close_file" class="sm4">ගොණුව අවසන් කිරීම</a></li>
		<li style="font-size:16px";><a href="index.php?action=closed_files" class="sm4">අවසන් වූ ලිපි ගොණු</a></li>
    </ul>
</div>
<?php 
break;
} ?>
