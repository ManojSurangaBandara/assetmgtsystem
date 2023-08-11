<?php include 'header1.php'; ?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<div id="page">
<div class="inner">

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
					<td><?php if ($exp['land_path'] <> "") { ?>
						<button><a href="<?php echo $exp['land_path']; ?>#toolbar=0" target="_blank">View Board Report</a></button>
					<?php } ?></td>
					<td><?php echo $exp['land_date']='1000-01-01 00:00:00' ? '' : $exp['land_date']; ?></td>
					<td><?php echo $exp['received_date']='1000-01-01' ? '' : $exp['received_date']; ?></td>
					<td><button><a href="index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=land"><font color="DarkBlue">View</a></button></td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>