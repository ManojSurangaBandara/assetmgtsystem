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
	var received_date = $('#received_date_'+id).val();
	var approved_date = $('#approved_date_'+id).val();
	var querystring = {
			id: id,
			received_date: received_date,
			approved_date: approved_date,
			action: 'add_board_report_receving_save'
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
                    ADD - Board Report Receving
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
					<th>Unit</th>
					<th>Land Report</th>
					<th>Building Report</th>
					<th>P/M Report</th>
					<th>Office Report</th>
					<th>Vehicle Report</th>
					<th>Received Date</th>
					<th>Approved Date</th>
					<th>Save</th>
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
					<td><?php echo $exp['unitName']; ?></td>
					<td><button><a href="<?php echo $exp['land_path']; ?>#toolbar=0" target="_blank"><?php echo substr($exp['land_date'],0,10); ?></a></button></td>
					<td><button><a href="<?php echo $exp['building_path']; ?>#toolbar=0" target="_blank"><?php echo substr($exp['building_date'],0,10); ?></a></button></td>
					<td><button><a href="<?php echo $exp['plant_path']; ?>#toolbar=0" target="_blank"><?php echo substr($exp['plant_date'],0,10); ?></a></button></td>
					<td><button><a href="<?php echo $exp['office_path']; ?>#toolbar=0" target="_blank"><?php echo substr($exp['office_date'],0,10); ?></a></button></td>
					<td><button><a href="<?php echo $exp['vehicle_path']; ?>#toolbar=0" target="_blank"><?php echo substr($exp['vehicle_date'],0,10); ?></a></button></td>
					<td><input type='text' class="date" id="received_date_<?php echo $exp['id']; ?>" name="received_date_<?php echo $exp['id']; ?>" value="<?php echo $exp['received_date']; ?>" style="width:90px;"/></td>
					<td><input type='text' class="date" id="approved_date_<?php echo $exp['id']; ?>" name="approved_date_<?php echo $exp['id']; ?>" value="<?php echo $exp['approved_date']; ?>" style="width:90px;"/></td>
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










