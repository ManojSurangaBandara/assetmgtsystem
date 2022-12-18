<?php
include 'header1.php';
?>

<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
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
    }
    ;	
});
</script>
<style>
#col-1 {
  position: relative;
  width: 50%;
  float: left;
}

#col-2 {
  position: relative;
  width: 50%;
  float: left;
}
</style>
<div id="page">
        <div class="title_wrapper">
            <h2>Compare With Fixed Assets System Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<br/>
    <div class="section table_section">
	<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
		<input type="hidden" name="action" value="compare_fa_system" />
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
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>

                                    <div class="table_wrapper_inner">
									<div id="col-1">
                                     <div class="title_wrapper">
										<h2>Fixed Assets System Details</h2>
										<span class="title_wrapper_left"></span>
										<span class="title_wrapper_right"></span>
									</div>
										<table id="myTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                            <thead>
											<tr> 
												<th>S/N</th>  
												<th><nobr>Item Type</nobr></th>
												<th><nobr>Catalogue No</nobr></th> 
												<th><nobr>Description</nobr></th> 
												<th><nobr>Quantity</nobr></th> 
											</tr> 
											</thead>
											<tbody> 
												<?php $i = 1;
												$totqty = 0; 
												$totvalue = 0;?>
												<?php foreach ($items as $exp) { ?>		
												<tr> 
													<td><nobr><?php echo $i; ?></nobr></td>
													<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
													<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
													<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
													<td align="right"><nobr><?php echo number_format((float)$exp['quantity'], 0, '.', ','); ?></nobr></td>
												</tr> 
												 <?php $i++; 
												 $totqty = $totqty + $exp['quantity']; 
												 $totvalue = $totvalue + $exp['totalcost']; ?>
												<?php } ?> 
                                            </tbody></table>
										</div>
								<div id="col-2">
											  <div class="title_wrapper" id="title">
												<span><h2>BOS System Details</h2></span>
												<span class="title_wrapper_left"></span>
												<span class="title_wrapper_right"></span>
											</div>
											<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
				<thead>
				<tr>
						<th>S No.</th>
						<th>Item Type</th>
						<th>Item Code</th>
						<th>Description</th>
						<th>Ledger Qty</th>						
					</tr>
				</thead>	
				<tbody>
				<?php $i = 1; 
				   foreach ($bos_items as $exp) {
				   ?>																
						<tr>
							<td><nobr><?php echo $i; ?></td>
							<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
							<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>							
							<td title = "<?php echo $exp['description']; ?>"><nobr><?php echo substr($exp['description'],0,60); ?></nobr></td>
							<td style="text-align: right; font-family: courier;font-size:14px; font-weight:bold;"><nobr><?php echo $exp['qty_ledger']; ?></nobr></td>
						</tr>					
						<?php $i++; 
					} ?> 
				</tbody>
			</table>
								
								
								</div>		
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