<div class="table_wrapper">
<div class="table_wrapper_inner">
<table id="abc" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
 <thead>
<tr>															
	<th rowspan = "2">SNo.</th>
	<th rowspan = "2">Item Description</th>
	<th rowspan = "2">Colleague No.</div></th>
	<?php 
	$i = 1;
	$j = 1;
	$unitsarray = array();
	foreach($units as $exp) { ?>																
		<th  colspan = "4" style="text-align: center;"><?php echo $exp['unitName']; ?></div></th>
<?php 
	$unitsarray[] = $exp['unitName'];
	$j++;
}  ?>
</tr>
<tr>
<?php for ($x = 1; $x < $j; $x++) { ?>
	<th>Sc</th>
	<th>Ac</th>
	<th>Sh</th>
	<th>Ex</th>
<?php } ?>	
</tr>
</thead> 
<?php foreach($catloguenos as $exp) { ?>																
<tbody>
<tr>
	<td><?php echo $i; ?></td>
	<td><nobr><?php echo CatalogueDB::getcatlogDescriptionByCatalogueno($exp['catalogueno']); ?></nobr></td>
	<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>														
	<?php
	foreach($unitsarray as $item) {
		$value = allocation_detailsDB::getDetailsByUnitCatalogueno_all($item, $exp['catalogueno']); 
		if (isset($value['quantity']) && isset($value['act_quantity'])) {
			$bal = $value['quantity'] - $value['act_quantity'];
		
		
		?>																
		<td style="text-align: right;"><?php echo $value['quantity'] != 0 ? (int)$value['quantity'] : ''; ?></td>
		<td style="text-align: right;"><?php echo $value['act_quantity'] != 0 ? (int)$value['act_quantity'] : ''; ?></td>
		<td style="text-align: right;"><nobr><?php echo $bal > 0 ? (int)abs($bal) : ''; ?></nobr></td>
		<td style="text-align: right;"><nobr><?php echo $bal < 0 ? (int)abs($bal) : ''; ?></nobr></td>	
		
		<?php 
		}else{
		?>
		<td style="text-align: right;"><?php echo ''; ?></td>
		<td style="text-align: right;"><?php echo ''; ?></td>
		<td style="text-align: right;"><nobr><?php echo ''; ?></nobr></td>
		<td style="text-align: right;"><nobr><?php echo ''; ?></nobr></td>	
		<?php
		}
	}
	?>
</tr>
<?php $i++; ?>
<?php }  ?>
</tbody>
</table>
</div>
</div>					