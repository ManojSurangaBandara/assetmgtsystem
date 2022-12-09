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
$(document).on('change','.sname',function(){
    var id = $(this).attr('id');
	values=id.split('_');
	$("#"+values[2]).show();	 
return false
});
$(document).on('click','.savebttn',function(){
    var id = $(this).attr('id');
	var s_description = $('#s_description_'+id).val();
	var sub_category = $('#sub_category_'+id).val();
	var querystring = {
		id: id,
		s_description: s_description,
		sub_category: sub_category,
		action: 'save_asset_sinhala_name'
	}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
			//alert(result);
		$("#"+id).hide();	
		} 	 
return false
});
</script>
<div id="page">

        <div class="section">
              <div class="title_wrapper" id="title">
                <span><h2>Add Asset Sinhala Name & Sub Category</h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			  <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
					<div class="table_wrapper">

							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
                                        <th>S No.</th>
                                        <th>Item Type</th>
										<th>Item Code</th>
                                        <th>Sub Category</th>
										<th>Description</th>
                                        <th>Description in Sinhala</th>
										<th>Save</th>												
                                    </tr>
								</thead>
                                <tbody>
                                                <?php $i = 1; 
                                               foreach ($items as $exp) { ?>																
                                                    <tr>
														<td><nobr><?php echo $i; ?></td>
														<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
														<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>
														<td><nobr><input class = "sname" type="text" value="<?php echo $exp['sub_category']; ?>" id="sub_category_<?php echo $exp['id']; ?>" style="text-align: left;" size="20" onClick="this.select();"></td>
														<td><nobr><?php echo substr($exp['description'],0,80); ?></nobr></td>
														<td><nobr><input class = "sname" type="text" value="<?php echo $exp['s_description']; ?>" id="s_description_<?php echo $exp['id']; ?>" style="text-align: left;" size="50" onClick="this.select();"></nobr></td>
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
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>