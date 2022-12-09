<?php include 'header1.php';?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var protocoltext1 = $('#protocoltext1_'+id).val();
	var protocoltext2 = $('#protocoltext2_'+id).val();
	var protocollevel1 = $('#protocollevel1_'+id).val();
	var protocollevel2 = $('#protocollevel2_'+id).val();
	var protocollevel3 = $('#protocollevel3_'+id).val();
	var protocollevel4 = $('#protocollevel4_'+id).val();
	var protocollevel5 = $('#protocollevel5_'+id).val();
	var querystring = {
			id: id,
			protocoltext1: protocoltext1,
			protocoltext2: protocoltext2,
			protocollevel1: protocollevel1,
			protocollevel2: protocollevel2,
			protocollevel3: protocollevel3,
			protocollevel4: protocollevel4,
			protocollevel5: protocollevel5,
			action: 'Add_protocol_ajax_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		$('#protocollevel5_'+id).val(result);
		//alert(result);
		}
	return false
});
}); 
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Protocol
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tr>
					<th>S No.</th>
					<th>Unit</th>
					<th>S Order</th>
				</tr><tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['unitName']; ?></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="hidden" name="action" id="action" value="Add_protocol" />									
						<input type="hidden" name="id" id="id" value="<?php echo $exp['SN']; ?>"/>
						<input type="text" name="protocoltext1_<?php echo $exp['SN']; ?>" id="protocoltext1_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocoltext1']; ?>">
						<input type="text" name="protocoltext2_<?php echo $exp['SN']; ?>" id="protocoltext2_<?php echo $exp['SN']; ?>" value="<?php echo $exp['protocoltext2']; ?>">
						<input type="text" name="protocollevel1_<?php echo $exp['SN']; ?>" id="protocollevel1_<?php echo $exp['SN']; ?>" maxlength="2" size="1" value="<?php echo $exp['protocollevel1']; ?>">
						<input type="text" name="protocollevel2_<?php echo $exp['SN']; ?>" id="protocollevel2_<?php echo $exp['SN']; ?>" maxlength="2" size="1" value="<?php echo $exp['protocollevel2']; ?>">
						<input type="text" name="protocollevel3_<?php echo $exp['SN']; ?>" id="protocollevel3_<?php echo $exp['SN']; ?>" maxlength="2" size="1" value="<?php echo $exp['protocollevel3']; ?>">
						<input type="text" name="protocollevel4_<?php echo $exp['SN']; ?>" id="protocollevel4_<?php echo $exp['SN']; ?>" maxlength="2" size="1" value="<?php echo $exp['protocollevel4']; ?>">
						<input type="text" name="protocollevel5_<?php echo $exp['SN']; ?>" id="protocollevel5_<?php echo $exp['SN']; ?>" maxlength="8" size="5" readonly value="<?php echo $exp['protocollevel5']; ?>">
						<input class = "savebttn" id = "<?php echo $exp['SN']; ?>" name="submit" type="submit" value="Save"/>
					</form>
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
</div>

<?php
include('sidebar.php');
include '../view/footer.php';
?>










