<?php
include '../view/header2.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
}); 
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    List Last Access Date
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				 <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
				 <thead>
				<tr>
					<th>S No.</th>
					<th>Unit</th>
					<th>Loged Name</th>
					<th>Last Access Date</th>
				</tr>
				</thead> 
				<tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<?php $dtls = LoginDB::last_log_date($exp['unitName']);?>
					<td><?php echo $i; ?></td>	
					<td><?php echo $exp['unitName']; ?></td>
					<td><?php echo $dtls['loginname']; ?></td>
					<td><?php echo $dtls['sysDate']; ?></td>					                      
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
		</div>
        </div>
    </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>










