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
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
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
		<h2>Opening Balance (2020/12/31 වන දිනට තොගය) Summary List</h2>
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
						<th>Item Code</th>
						<th>Description</th>
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
						<tr>
							<td><nobr><?php echo $i; ?></td>
							<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>							
							<td title = "<?php echo $exp['description']; ?>"><nobr><a href="index.php?action=summary_list_catlogue_unit&itemcode=<?php echo $exp['itemcode']; ?>"><?php echo substr($exp['description'],0,120); ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_onhand'] != 0 ? floor($exp['qty_onhand']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q1'] != 0 ? floor($exp['qty_q1']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q2'] != 0 ? floor($exp['qty_q2']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q3'] != 0 ? floor($exp['qty_q3']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q4'] != 0 ? floor($exp['qty_q4']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_q5'] != 0 ? floor($exp['qty_q5']):""; ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_ledger'] != 0 ? floor($exp['qty_ledger']):""; ?></nobr></td>
						</tr>					
						<?php $i++; 
					} ?> 
				</tbody>
			</table>
			<form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
			<input type="hidden" name="action" value="print_opening_balance" />
			<div class="col-md-1">
				<div class="form-group">
						<label></label>
						<button type="submit" class="btn btn-info" name="print" id="print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>   Print</button>
				</div>
			</div>
			</form>
</div>
					
</div>	
<?php
include '../view/footer.php';
?>










