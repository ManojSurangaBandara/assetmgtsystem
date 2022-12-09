<?php include 'header1.php';?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var unitName = $('#unitName_'+id).val();
	var centreID = $('#centreID_'+id).val();
	var querystring = {
			id: id,
			unitName: unitName,
			centreID: centreID,
			action: 'change_units_details_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		$("#"+id).hide();	
		}
	return false
});
}); 
$(document).on('change','.sname',function(){
    var id = $(this).attr('id');
	values=id.split('_');
	$("#"+values[1]).show();		 
return false
});
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Change Unit Details
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
					<th>S No.</th>
					<th>Center</th>
					<th>Unit</th>
					<th>Change Unit</th>
					<th>Unit ID</th>
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
					<td><?php echo $exp['centreName']; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<?php if ($exp['unit_type'] == 1) { ?>
					<td><input class = "sname" type="text" name="unitName_<?php echo $exp['SN']; ?>" id="unitName_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitName']; ?>" style="font-family: courier;font-size:18px;"></td>
					<td><input class = "sname" type="text" name="centreID_<?php echo $exp['SN']; ?>" id="centreID_<?php echo $exp['SN']; ?>" value="<?php echo $exp['centreID']; ?>" style="font-family: courier;font-size:18px;"></td>
					<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save" hidden/></td>
					<?php  } else { ?>
					<td style="font-family: courier;font-size:18px;"><?php echo $exp['unitName']; ?></td>
					<td style="font-family: courier;font-size:18px;"><?php echo $exp['centreID']; ?></td>
					<td></td>
					<?php } ?>
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










