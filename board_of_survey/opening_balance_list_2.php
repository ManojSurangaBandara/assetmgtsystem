<?php
include 'header1.php';
?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="../jquery/bootstrap-datepicker.js"></script>
		<script src="../jquery/jquery.notifyBar.js"></script>
		<link rel="stylesheet" href="../css/datepicker.css">
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
		<link href="../css/jquery.notifyBar.css"  rel="stylesheet" type="text/css" >
		<link href="../css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />		
		<script src="../jquery/bootstrap-dialog.js"></script>
		<script src="../jquery/bootstrap.js"></script>
<style>
#data {
  background-color: #ebfafa;
}
</style>
<script>
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});	
</script>
<div id="page">
	<div class="title_wrapper">
		<h2><?php echo $_POST['assetunit']; ?> - Opening Balance (2020/12/31 වන දිනට තොගය)</h2>
		<span class="title_wrapper_left"></span>
		<span class="title_wrapper_right"></span>
	</div>
	<div class="panel panel-primary">
	<ul class="system_messages" id="message"></ul>	
		</div>
    </div>
			<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
				<thead>
				<tr>
						<th>S No.</th>
						<th>Item Type</th>
						<th>Item Code</th>
						<th>Description</th>
						<th>Ledger Folio</th>
						<th>Qty On Hand</th>
						<th>Q1 Issue</th>
						<th>Q2 Issue</th>
						<th>Q3 Issue</th>
						<th>Q4 Issue</th>
						<th>Q5 Issue</th>
						<th>Ledger Qty</th>						
					</tr>
				</thead>	
				<tbody>
				<?php $i = 1; 
				   foreach ($items as $exp) {
				   ?>																
						<input type="hidden" id="itemtype_<?php echo $exp['id']; ?>" value="<?php echo $exp['itemtype']; ?>" />
						<input type="hidden" id="qstore_<?php echo $exp['id']; ?>" value="<?php echo $exp['qstore']; ?>" />
						<input type="hidden" id="votename_<?php echo $exp['id']; ?>" value="<?php echo $exp['votename']; ?>" />
						<input type="hidden" id="itemcode_<?php echo $exp['id']; ?>" value="<?php echo $exp['itemcode']; ?>" />
						<input type="hidden" id="description_<?php echo $exp['id']; ?>" value="<?php echo $exp['description']; ?>" />
						<tr>
							<td><nobr><?php echo $i; ?></td>
							<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
							<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>							
							<td title = "<?php echo $exp['description']; ?>"><nobr><?php echo substr($exp['description'],0,60); ?></nobr></td>
							<td><nobr><?php echo $exp['ledger_folio']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_onhand']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q1']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q2']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q3']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q4']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q5']; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_ledger']; ?></nobr></td>
						</tr>					
						<?php $i++; 
					} ?> 
				</tbody>
			</table>
</div>
					
</div>	
<?php
include '../view/footer.php';
?>










