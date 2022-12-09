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

</script>

<script>
    $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            var current_asset = ($(this).prop('checked')) ? 1 : 0;
			var id = $(this).attr('id');
        var querystring = {
			id: id,
			current_asset: current_asset, 				 
			action: 'save_current_asset'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 	
//return false
		});
    });
</script>
<div id="page">

        <div class="section">
              <div class="title_wrapper" id="title">
                <span><h2>Select Current & Fixed Asset</h2></span>
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
			<div class="table_wrapper_inner">
							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
                                        <th>&nbsp;</th>
                                        <th>Item Code</th>
                                        <th>Description</th>
                                        <th>Item Type</th>
                                        <th>Q Store</th>
										<th>DAM Catalog Number</th>
										<th>Select Fixed Asset</th>												
                                    </tr>
								</thead>
                                <tbody>
                                                <?php $i = 1; 
                                               foreach ($items as $exp) { ?>																
                                                    <tr>
														<td><nobr><?php echo $i; ?></td>
														<td><nobr><?php echo $exp['itemcode']; ?></nobr></td>
														<td><nobr><?php echo $exp['description']; ?></nobr></td>
														<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
														<td><nobr><?php echo $exp['qstore']; ?></nobr></td>
														<td><nobr><?php echo $exp['dam_catalogueno']; ?></nobr></td>
														<td><nobr><input type="checkbox" class = "savebttn" name="current_asset_<?php echo $exp['id']; ?>" id="<?php echo $exp['id']; ?>" <?php if($exp['current_asset']==1) echo "checked=checked"; ?>>
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