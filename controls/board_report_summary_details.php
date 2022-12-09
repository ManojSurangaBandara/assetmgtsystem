<?php include 'header5.php';?>
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
<div id="page">

        <div class="section">
              <div class="title_wrapper" id="title">
                <span><h2>Board Report Summary Details</h2></span>
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
                                        <input type="hidden" name="action" value="board_report_summary_details" />
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
				
				<?php foreach($exps as $exp) { ?>	
			<?php $i = 1; ?>
			<div class="title_wrapper">
                <h2>Board Reports History - <?php echo $exp['cyear']; ?></h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tbody><tr>
					<th>S No.</th>
					<th>Type</th>
					<th>Board Report</th>
					<th>Disposal Report</th>
					<th>New Items Report</th>
					<th>Report Summary</th>
					<th>Transaction Summary</th>
					<th>Details Report</th>
					<th>Download Date Time</th>
					<th>DAM Received Date</th>
					<th>Observations</th>
					<th>Relevant Letters</th>
				</tr>
															
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td>Land</td>
					<td><?php if ($exp['land_path'] <> "") { ?>
						<button><a href="<?php echo $exp['land_path']; ?>#toolbar=0" target="_blank">View</a></button>
					<?php } ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $exp['land_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="../land_details/index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=land"><font color="DarkBlue">View</a></button></td>
				</tr>
				<?php $i++; ?>
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td>Building</td>
					<td>
					<?php if ($exp['building_path'] <> "") { ?>
					<button><a href="<?php echo $exp['building_path']; ?>#toolbar=0" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td><?php echo $exp['building_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="../building_details/index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=building"><font color="DarkBlue">View</a></button></td>
				</tr>
				<?php $i++; ?>				
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td style="white-space:nowrap;">Plant & Machinery</td>
					<td>
					<?php if ($exp['plant_path'] <> "") { ?>
						<button><a href="<?php echo $exp['plant_path']; ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['plant_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_des.pdf",$exp['plant_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['plant_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_new.pdf",$exp['plant_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><button><a href="../plantmac_details/index.php?action=board_report_summary_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=plant"><font color="DarkBlue">View</a></button></td>
					<td><button><a href="../plantmac_details/index.php?action=board_report_summary_view_trans&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=plant"><font color="DarkBlue">View</a></button></td>
					<td>
					<?php if ($exp['plant_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_d.pdf",$exp['plant_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>					
					<td><?php echo $exp['plant_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="../plantmac_details/index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=plant"><font color="DarkBlue">View</a></button></td>					
				</tr>
				<?php $i++; ?>
								<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td style="white-space:nowrap;">Office Equipments</td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo $exp['office_path']; ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_des.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_new.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><button><a href="../offequip_details/index.php?action=board_report_summary_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>
					<td><button><a href="../offequip_details/index.php?action=board_report_summary_view_trans&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>
					<td>
					<?php if ($exp['office_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_d.pdf",$exp['office_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><?php echo $exp['office_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="../offequip_details/index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=office"><font color="DarkBlue">View</a></button></td>					
				</tr>
				<?php $i++; ?>
								<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td>Vehicle</td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo $exp['vehicle_path']; ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_des.pdf",$exp['vehicle_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_new.pdf",$exp['vehicle_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><button><a href="../vehicle_details/index.php?action=board_report_summary_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>
					<td><button><a href="../vehicle_details/index.php?action=board_report_summary_view_trans&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>
					<td></td>
					<td><?php echo $exp['vehicle_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="../vehicle_details/index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>					
				</tr>
				<?php $i++; ?>
				
			  </tbody>
			  </table>
			  </div>
			  </div>
			  <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>	
				<?php }  ?>				
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