
													<div class="table_wrapper">
													<div class="table_wrapper_inner">
															<table id="abc" cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>SNo.</th>
															<th>Item Category</th>
															<th>Item Description</th>
															<th>Colleague No.</th>
															<th>Quantity</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['itemCategory']; ?></td>
															<td><?php echo $exp['itemDescription']; ?></td>
															<td><?php echo $exp['catalogueno']; ?></td>
															<td style="text-align: right;"><?php echo $exp['quantity'] != 0 ? (int)$exp['quantity'] : '';?></td>															
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>					
													</div>
													  </div>