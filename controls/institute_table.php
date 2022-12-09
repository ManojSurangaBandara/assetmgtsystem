	
<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table id = "delTable" cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Name</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['instName']; ?></td>
															<td><?php echo $exp['instAddress']; ?></td>
															<td><?php echo $exp['instTele']; ?></td>
															<td><?php echo $exp['instEmail']; ?></td>
															<td><button class="btnDel" type="button">Button</button></td>
															<td><a href="action=delcomment&id=<?php echo $exp['id']; ?>" id="<?php echo $exp['id']; ?>" class="del">Delete</a>
															</td>
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>
													  </div>
													  </div>
