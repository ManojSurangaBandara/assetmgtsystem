<?php include 'header1.php';?>
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
$(document).on('click','.savebttn',function(){
    var id = $(this).attr('id');
	var quantity = $('#quantity_'+id).val();
	var querystring = {
		id: id,
		quantity: quantity, 				 
		action: 'allocation_details_save_qty'
	}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
			//alert(result);
		$("#"+id).hide();	
		} 	 
return false
});

$(document).on('change','.qtyText',function(){
    var id = $(this).attr('id');
	values=id.split('_');
	$("#"+values[1]).show();	 
return false
});

$(document).on('click','#add_from_scale',function(){
	var assetunit = $('#assetunit').val();
	var scale_assetunit = $('#scale_assetunit').val();
	var querystring = {
		assetunit: assetunit,
		scale_assetunit: scale_assetunit, 				 
		action: 'get_details_scale_catalogue'
	}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
			//alert(result);	
		} 	
//alert();
return false
});
});

</script>
<div id="page">

        <div class="section">
              <div class="title_wrapper" id="title">
                <span><h2>Add Unit Item Allocation Details</h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			  <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
									<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="allocation_details" />
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
										<div>
                                            <select name="scale_assetunit" id="scale_assetunit">
                                                <option value=""></option>
                                                <?php foreach ($scale_assetunits as $unit) { ?>
                                                    <option value="<?php echo $unit[0]; ?>" <?php if ($scale_assetunit == $unit[0]) echo "selected = 'selected'"; ?>>
                                                <?php echo $unit[0]; ?>
                                                    </option>
												<?php } ?></select>
											<br />
                                        </div>
										<div><input type="submit" name="add_from_scale" id="add_from_scale" value="Add From Scale"></div>
									</form>
			<div class="title_wrapper">
                <h2>Entry Allocation Details</h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
					<div class="table_wrapper">
			<div class="table_wrapper_inner">
							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
                                        <th>&nbsp;</th>
                                        <th>Fixed Asset Type</th>
                                        <th>Main Category</th>
                                        <th>Item Category</th>
                                        <th>Item Description</th>
										<th>Catalog Number</th>
										<th>Allocation Amount</th>	
										<th>Save</th>											
                                    </tr>
								</thead>
                                <tbody>
                                                <?php $i = 1; 
                                               foreach ($items as $exp) { ?>																
                                                    <tr>
														<td><nobr><?php echo $i; ?></td>
														<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
														<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
														<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
														<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
														<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
														<td><nobr><input class = "qtyText" type="number" value="<?php echo $exp['quantity']; ?>" id="quantity_<?php echo $exp['id']; ?>" style="text-align: right;" onClick="this.select();"></nobr></td>
														<td><nobr><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save" hidden/></nobr></td>
													</tr>					
                                                    <?php $i++; 
                                                } ?> 
								</tbody>
                            </table>                                                      
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
			  </div>
			  </div>														
                                                       
</div>
</div>
                    </div>
                </div>
            </div>
        </div>
  </div>

  </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>