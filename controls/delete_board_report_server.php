<?php include 'header1.php';?>
<?php 
function isDate($date)
	{
		list($y, $m, $d) = explode("-", $date);
		if(checkdate($m, $d, $y)){
			return true;
		} else {
			return false;
		}
	}
 ?>
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
var result = confirm("Want to delete?");
if (result) {
	$(this).hide();
	var fields = $(this).attr('id').split('_');
	var id = fields[1];
	var item = fields[0];
	var querystring = {
			id: id,
			item: item,
			action: 'delete_board_report_server_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//$(this).attr('id').hide();
		//alert($("#"+item+"_"+id));
		}
	return false
}
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
                    Delete Board Repoert from Server
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
					<th>Pla/Mac Report</th>
					<th>Office Report</th>
					<th>Vehicle Report</th>
					<th>Received Date</th>
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
					<td><?php if ($exp['land_path'] <> "") {?> <input class = "savebttn" id = land_<?php echo $exp['id']; ?> name="submit" type="submit" value="Delete" style="color: white; background-color: red;" <?php if (isDate($exp['received_date'])) { echo "disabled";} ?>/><?php } ?></td>
					<td><?php if ($exp['building_path'] <> "") {?> <input class = "savebttn" id = building_<?php echo $exp['id']; ?> name="submit" type="submit" value="Delete" style="color: white; background-color: red;" <?php if (isDate($exp['received_date'])) { echo "disabled";} ?>/><?php } ?></td>
					<td><?php if ($exp['plant_path'] <> "") {?> <input class = "savebttn" id = plant_<?php echo $exp['id']; ?> name="submit" type="submit" value="Delete" style="color: white; background-color: red;" <?php if (isDate($exp['received_date'])) { echo "disabled";} ?>/><?php } ?></td>
					<td><?php if ($exp['office_path'] <> "") {?> <input class = "savebttn" id = office_<?php echo $exp['id']; ?> name="submit" type="submit" value="Delete" style="color: white; background-color: red;" <?php if (isDate($exp['received_date'])) { echo "disabled";} ?>/><?php } ?></td>
					<td><?php if ($exp['vehicle_path'] <> "") {?> <input class = "savebttn" id = vehicle_<?php echo $exp['id']; ?> name="submit" type="submit" value="Delete" style="color: white; background-color: red;" <?php if (isDate($exp['received_date'])) { echo "disabled";} ?>/><?php } ?></td>
					<td><?php echo $exp['received_date']; ?></td>
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










