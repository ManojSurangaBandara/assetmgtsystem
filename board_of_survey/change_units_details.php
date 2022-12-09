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
	var protocoltext1 = $('#protocoltext1_'+id).val();
	var protocoltext2 = $('#protocoltext2_'+id).val();
	var protocollevel1 = $('#protocollevel1_'+id).val();
	var protocollevel2 = $('#protocollevel2_'+id).val();
	var protocollevel3 = $('#protocollevel3_'+id).val();
	var protocollevel4 = $('#protocollevel4_'+id).val();
	var querystring = {
			id: id,
			unitName: unitName,
			centreID: centreID,
			protocoltext1: protocoltext1,
			protocoltext2: protocoltext2,
			protocollevel1: protocollevel1,
			protocollevel2: protocollevel2,
			protocollevel3: protocollevel3,
			protocollevel4: protocollevel4,
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
<style> 
         td { 
            white-space: nowrap; 
         } 
      </style> 
<div id="page">

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
					<th>protocoltext1</th>
					<th>protocoltext2</th>
					<th>P/L 1</th>
					<th>P/L 2</th>
					<th>P/L 3</th>
					<th>P/L 4</th>
					<th>P/L 5</th>
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
					<td><input class = "sname" type="text" name="unitName_<?php echo $exp['SN']; ?>" id="unitName_<?php echo $exp['SN']; ?>" value="<?php echo $exp['unitName']; ?>" style="font-family: courier;font-size:14px;"></td>
					<td><input class = "sname" type="text" name="centreID_<?php echo $exp['SN']; ?>" id="centreID_<?php echo $exp['SN']; ?>" value="<?php echo $exp['centreID']; ?>" style="font-family: courier;font-size:14px;"></td>
					<td><input class = "sname" type="text" name="protocoltext1_<?php echo $exp['SN']; ?>" id="protocoltext1_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocoltext1']; ?>"></td>
					<td><input class = "sname" type="text" name="protocoltext2_<?php echo $exp['SN']; ?>" id="protocoltext2_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocoltext2']; ?>"></td>
					<td><input class = "sname" type="text" name="protocollevel1_<?php echo $exp['SN']; ?>" id="protocollevel1_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocollevel1']; ?>" size="2"></td>
					<td><input class = "sname" type="text" name="protocollevel2_<?php echo $exp['SN']; ?>" id="protocollevel2_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocollevel2']; ?>" size="2"></td>
					<td><input class = "sname" type="text" name="protocollevel3_<?php echo $exp['SN']; ?>" id="protocollevel3_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocollevel3']; ?>" size="2"></td>
					<td><input class = "sname" type="text" name="protocollevel4_<?php echo $exp['SN']; ?>" id="protocollevel4_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocollevel4']; ?>" size="2"></td>
					<td><input class = "sname" type="text" name="protocollevel5_<?php echo $exp['SN']; ?>" id="protocollevel5_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocollevel5']; ?>" size="6" onfocus="this.blur();"></td>
					<td><input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save" hidden/></td>
					<?php  } else { ?>
					<td style="font-family: courier;font-size:14px;"><?php echo $exp['unitName']; ?></td>
					<td style="font-family: courier;font-size:14px;"><?php echo $exp['centreID']; ?></td>
					<td><?php echo $exp['protocoltext1']; ?></td>
					<td><?php echo $exp['protocoltext2']; ?></td>
					<td><?php echo $exp['protocollevel1']; ?></td>
					<td><?php echo $exp['protocollevel2']; ?></td>
					<td><?php echo $exp['protocollevel3']; ?></td>
					<td><?php echo $exp['protocollevel4']; ?></td>	
					<td><?php echo $exp['protocollevel5']; ?></td>						
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

<?php
//include('sidebar.php');
include '../view/footer.php';
?>










