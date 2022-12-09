<?php
include 'header1.php';
?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
    $('#assetscenter').change(function() {
        getAsstUnit($(this).val(), "");
    });
    function getAsstUnit(assetscenter, assetunit)
    {
        var querystring = {
            center: assetscenter,
            action: 'findAssetsUnitsByCenter_Ajax'
        }
        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
            var numbers = $.parseJSON(result);
            var option = '<option></option>';
            for (var i = 0; i < numbers.length; i++) {
                option += '<option value="' + numbers[i] + '">' + numbers[i] + '</option>';
            }
            $('#assetunit').html(option);
            $('#assetunit option[value="' + assetunit + '"]').attr('selected', 'selected');
        } // end processData
    };
});

</script>
<div id="page">
	</br>
    <div class="section table_section">
	<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
	<input type="hidden" name="action" value="allocation_list" />
	<label for="assetscenter" class="label">Assets Center :</label>
	<div> 
		<select name="assetscenter" id="assetscenter">
			<option value=""></option>
			<?php foreach ($assetsCenters as $center) { ?>
				<option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
			<?php echo $center->getName(); ?>
				</option>
			<?php } ?>
			</select>
	</div>
			<label for="assetunit" class="label">Assets Unit :</label>                                                        
	<div>
		<select name="assetunit" id="assetunit">
			<option value=""></option>
			<?php foreach ($assetunits as $unit) { ?>
				<option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
			<?php echo $unit->getName(); ?>
				</option>
			<?php } ?></select>
		<br />
	</div>
	<div><input type="submit" name="submit" id="submit" value="Search"></div>
</form>
        <div class="title_wrapper">
            <h2>Allocation (Scale) & Present Quantity</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>

                                    <div class="table_wrapper_inner">
                                        <table id="myTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                            <thead>
											<tr>
                                            <th>&nbsp;</th>
											<th>Type</th>
											<th>Main Category</th>
											<th>Item Category</th>
											<th>Item Description</th>
											<th>Catalog Number</th>
											<th>Allocation Qty</th>
											<th>Current Qty</th>
											<th>Shortage</th>											
                                            <th>Excess</th>
											</tr>
											</thead>
											<tbody> 
                                            <?php $i = 1; ?>
                                            <?php foreach ($Officeitems as $exp) { 
											if ($assetunit == '') {
												$quantity = allocation_detailsDB::getTotalByCatalogueno($exp['catalogueno']); 
											} else {
												$quantity = allocation_detailsDB::getDetailsByUnitCatalogueno($assetunit, $exp['catalogueno']); 
											}											
                                            $bal = $quantity - $exp['cnt'];
											$style = "background-color:white;font-weight:bold;";
											if ($bal > 0) {
												$style = "background-color:LightCyan;font-weight:bold;";
											}
											if ($bal < 0) {
												$style = "background-color:OldLace; font-weight:bold;";
											}											
											?>	
											<tr>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $i; ?></nobr></td>
													<td style="<?php echo $style; ?>"><nobr>Office Equipment</td>
													<td style="<?php echo $style; ?>"><nobr><?php echo $exp['mainCategory']; ?></td>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
													<td style="<?php echo $style; ?>"><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $quantity != 0 ? (int)$quantity : '';?></nobr></td>
                                                    <td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $exp['cnt'] != 0 ? (int)$exp['cnt'] : '';?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal > 0 ? (int)abs($bal) : ''; ?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal < 0 ? (int)abs($bal) : ''; ?></nobr></td>													
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>
                                            <?php foreach ($Plantitems as $exp) { 
											if ($assetunit == '') {
												$quantity = allocation_detailsDB::getTotalByCatalogueno($exp['catalogueno']); 
											} else {
												$quantity = allocation_detailsDB::getDetailsByUnitCatalogueno($assetunit, $exp['catalogueno']); 
											}
											$bal = $quantity - $exp['cnt'];
											$style = "background-color:white;font-weight:bold;";
											if ($bal > 0) {
												$style = "background-color:LightCyan;font-weight:bold;";
											}
											if ($bal < 0) {
												$style = "background-color:OldLace; font-weight:bold;";
											}
											?>																
                                                <tr>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $i; ?></nobr></td>
													<td style="<?php echo $style; ?>"><nobr>Plant & Machinery</td>
													<td style="<?php echo $style; ?>"><nobr><?php echo $exp['mainCategory']; ?></td>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                    <td style="<?php echo $style; ?>"><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
													<td style="<?php echo $style; ?>"><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $quantity != 0 ? (int)$quantity : '';?></nobr></td>
                                                    <td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $exp['cnt'] != 0 ? (int)$exp['cnt'] : '';?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal > 0 ? (int)abs($bal) : ''; ?></nobr></td>
													<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal < 0 ? (int)abs($bal) : ''; ?></nobr></td>												
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?>											
                                            </tbody></table>
                                    </div>

                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>