		<div id="Unitdiv">
        <div class="title_wrapper">
            <h2>Tender Details List</h2>
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
                                   <div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Lot No.</th>
															<th>Vehicle No.</th>
															<th>Vehicle Description</th>
															<th>Estimate Amount</th>
															<th>Tender Amount</th>
															<th>Buyer Name</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['lotno']; ?></td>
															<td><?php echo $exp['armyno']; ?></td>
															<td><?php echo $exp['itemDescription'];?></td>
															<td><?php echo $exp['estimatevalue']; ?></td>
															<td><?php echo $exp['tendervalue']; ?></td>
															<td><?php echo $exp['buyername']; ?></td>
														</tr>
														<?php $i++; ?>
														<?php }  ?>
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