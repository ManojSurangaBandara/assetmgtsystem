<style>
	th
	{
		text-align: center;
		vertical-align: bottom;
		height: 150px;
		padding-bottom: 3px;
		padding-left: 5px;
		padding-right: 5px;
	}

	.verticalText
	{
		text-align: center;
		vertical-align: middle;
		width: 5px;
		margin: 0px;
		padding: 0px;
		padding-left: 3px;
		padding-right: 3px;
		padding-top: 10px;
		white-space: nowrap;
		-webkit-transform: rotate(-90deg); 
		-moz-transform: rotate(-90deg);                 
	};
</style>
													<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
														 <thead>
														<tr>															
															<th>SNo.</th>
															<th>Item Description</th>
															<th>Colleague No.</th>
															<?php 
															$i = 1;
															$unitsarray = array();
															foreach($units as $exp) { ?>																
																<th><div class="verticalText"><?php echo $exp['unitName']; ?></div></th>
														<?php 
															$unitsarray[] = $exp['unitName'];
														}  ?>
														</tr>
														</thead> 
													  	<?php foreach($catloguenos as $exp) { ?>																
														<tbody>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo CatalogueDB::getcatlogDescriptionByCatalogueno($exp['catalogueno']); ?></td>
															<td><?php echo $exp['catalogueno']; ?></td>														
															<?php
															foreach($unitsarray as $item) {
																?>																
																<td style="text-align: right;"><?php
																$quantity = allocation_detailsDB::getDetailsByUnitCatalogueno($item, $exp['catalogueno']); 
																echo $quantity != 0 ? (int)$quantity : '';
																?></td>
														<?php 
															}
															?>
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>					
													</div>
													  </div>