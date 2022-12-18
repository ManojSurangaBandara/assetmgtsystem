<?php include 'header5.php';?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Vehicle Repair Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
												<th>S/N</th>
												<th nowrap="nowrap"><nobr>Assets Unit</nobr></th>
												<th nowrap="nowrap"><nobr>Vehicle Type</nobr></th>
												<th nowrap="nowrap"><nobr>Identification No</nobr></th>
												<th nowrap="nowrap"><nobr>Army No</nobr></th>
												<th nowrap="nowrap"><nobr>Description</nobr></th>
												<th nowrap="nowrap"><nobr>Brand</nobr></th>
												<th nowrap="nowrap"><nobr>Model</nobr></th>
												<th nowrap="nowrap"><nobr>Engine No</nobr></th>
												<th nowrap="nowrap"><nobr>Chassis No</nobr></th>
												<th nowrap="nowrap"><nobr>Purchased Value</nobr></th>
												<th nowrap="nowrap"><nobr>Repaired Value</nobr></th> 
												<th nowrap="nowrap"><nobr>Total Value</nobr></th> 												
												</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr class="nr">
																<td><?php echo $i; ?></td>
																<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
																<td><nobr><?php echo $exp['armyno']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td> 
																<td><nobr><?php echo $exp['brandName']; ?></nobr></td>
																<td><nobr><?php echo $exp['modelName']; ?></nobr></td>
																<td><nobr><?php echo $exp['engineno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['chessisno']; ?></nobr></td>
																 <td  align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>																
																<?php 
																$sum = vehicle_repair_detailsDB::getTotal_vehicleid($exp['id']);
																$tsum = $sum + $exp['unitValue'];
																?>
																<td  align="right"><nobr><?php echo number_format((float)$sum, 2, '.', ','); ?></nobr></td>
																<td  align="right"><nobr><?php echo number_format((float)$tsum, 2, '.', ','); ?></nobr></td>
															</tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>


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
                                                        include '../view/footer.php';
                                                        ?>