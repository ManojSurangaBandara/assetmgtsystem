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
	var unittype = $('#unittype_'+id).val();
	var active = $('#active_'+id).val();
	var querystring = {
			id: id,
			unittype: unittype,
			active: active,
			action: 'change_units_type_active_save'
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
<style> 
         td { 
            white-space: nowrap; 
         } 
      </style> 
<div id="page">

        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Change Unit Type & Active De-Active Details
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<h2>Unit Type : වාර්ෂික සමීක්‍ෂණ මණ්ඩල සඳහා පමණක් භාවිතා කරන ඒකක සඳහා 1 ද අනෙක් ඒකක සඳහා 0 ද භාවිතා කල යුතුයි. </h2>
			<h2>Active : දැනට භාවිතයේ පවතින ඒකක සඳහා 1 ද භාවිතයේ නොමැති ඒකක සඳහා 0 ද භාවිතා කල යුතුයි. </h2
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
					<th>S No.</th>
					<th>Center</th>
					<th>Unit</th>
					<th>Unit ID</th>
					<th>Unit Type</th>
					<th>Active</tr>
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
					<td><?php echo $exp['centreID']; ?></td>
					<td><input class = "sname" type="number" name="unittype_<?php echo $exp['SN']; ?>" id="unittype_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unit_type']; ?>" maxlength="1" size="1" min="0" max="1" size="40" style="font-family: courier;font-size:14px;"></td>
					<td><input class = "sname" type="number" name="active_<?php echo $exp['SN']; ?>" id="active_<?php echo $exp['SN']; ?>" value="<?php echo $exp['Active']; ?>" maxlength="1" size="1"  min="0" max="1" style="font-family: courier;font-size:14px;"></td>
					<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save" hidden/></td>
					</td>
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

<?php
//include('sidebar.php');
include '../view/footer.php';
?>










