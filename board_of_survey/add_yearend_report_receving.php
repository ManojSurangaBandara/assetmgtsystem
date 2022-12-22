<?php include 'header1.php';?>
<script>
$(function(){
   $(".date").datepicker({ 
	dateFormat: 'yy-mm-dd' 
	});
});
</script>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	var unit = $('#unitName_'+id).val();
	var received_date = $('#received_date_'+id).val();
	var approved_date = $('#approved_date_'+id).val();
	var querystring = {
			unit: unit,
			received_date: received_date,
			approved_date: approved_date,
			action: 'add_yearend_report_receving_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		$("#"+id).hide();
		}
	return false
});

$(".text, .date").change(function() { 
	var fields = $(this).attr('id').split('_');
	var id = fields[2];
	$("#"+id).show();
});
}); 
</script>
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
                    ADD - 2020/12/31 Year End Report Receiving
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
					<th>Received Date</th>
					<th>Approved Date</th>
					<th>Save</th>
				</tr>
				</thead> 
				<tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<input type="hidden" id="unitName_<?php echo $exp['id']; ?>" name="unitName_<?php echo $exp['id']; ?>" value="<?php echo $exp['unitName']; ?>"/>
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['centreName']; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<td><form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
						<input type="hidden" name="action" value="view_opening_balance_unit" />
						<input type="hidden" name="assetunit" value="<?php echo $exp['unitName']; ?>" />
						<?php 
							$count = bos_openingbalanceDB::count_Records_unit($exp['unitName']);
							if ($count > 0) { ?>
								<button type="submit" class="btn btn-info" name="print" id="print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>View Details</button>
							<?php } ?>
					</form></td>
					<td><input type='text' class="date" id="received_date_<?php echo $exp['id']; ?>" name="received_date_<?php echo $exp['id']; ?>" value="<?php echo (strtotime($exp['received_date'] ?? "")) ? $exp['received_date'] : ""; ?>" style="width:90px;"/></td>
					<td><input type='text' class="date" id="approved_date_<?php echo $exp['id']; ?>" name="approved_date_<?php echo $exp['id']; ?>" value="<?php echo (strtotime($exp['approved_date']?? "")) ? $exp['approved_date'] : ""; ?>" style="width:90px;"/></td>
					<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save" style="color: white; background-color: #008CBA;" hidden/></td>
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










