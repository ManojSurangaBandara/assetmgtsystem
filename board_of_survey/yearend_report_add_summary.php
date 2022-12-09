<?php include 'header1.php';?>
<script>
	$(function(){
		$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
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
                    2020/12/31 Year End Report Entering Summary
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<thead>
				<tr>
					<th>S No.</th>
					<th>Unit Center</th>
					<th>Unit</th>
					<th>View Details</th>
					<th># of Items</th>
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
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['assetscenter']; ?></td>
					<td><?php echo $exp['assetunit']; ?></td>
					<td><form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
						<input type="hidden" name="action" value="view_opening_balance_unit" />
						<input type="hidden" name="assetunit" value="<?php echo $exp['assetunit']; ?>" />
						<?php 
							$count = bos_openingbalanceDB::count_Records_unit($exp['assetunit']);
							if ($count > 0) { ?>
								<button type="submit" class="btn btn-info" name="print" id="print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>View Details</button>
							<?php } ?>
					</form></td>
					<td><?php echo $exp['cnt']; ?></td>
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










