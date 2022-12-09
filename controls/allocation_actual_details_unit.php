	                                    <div class="table_wrapper_inner">
                                        <table id="myTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                            <thead>
											<tr>
                                            <th>&nbsp;</th>
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