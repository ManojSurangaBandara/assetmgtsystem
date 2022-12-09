<?php	
	include 'header1.php';
?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
	$('#submit').click(function(){
	   $(this).prop('hidden', true);
	});
});
</script>
<div id="page">
	                <div class="title_wrapper">
                <h2>
                    Board Reports History
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tbody><tr>
					<th>S No.</th>
					<th>Year</th>
					<th>Board Report</th>
					<th>Disposal Report</th>
					<th>New Items Report</th>
					<th>Report Summary</th>
					<th>Transaction Summary</th>
					<th>Details Report</th>
					<th>Download Date Time</th>
					<th>DAM Received Date</th>
					<th>Observations</th>
					<th>Relevent Letters</th>
				</tr>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['cyear']; ?></td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo $exp['office_path']; ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_des.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_new.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><button><a href="index.php?action=board_report_summary_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>
					<td><button><a href="index.php?action=board_report_summary_view_trans&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_d.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><?php echo $exp['office_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>					
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>