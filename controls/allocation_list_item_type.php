	<table id="myTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
		<thead>
		<tr>
		<th>SNo.</th>
		<th>Asset Unit</th>
		<th>Item Description</th>
		<th>Colleague No.</th>
		<th>Scale Qty</th>
		<th>Current Qty</th>
		<th>Shortage</th>											
        <th>Excess</th>
	</tr>
	</thead>
	<tbody>
	<?php $i = 1; ?>
	<?php foreach($exps as $exp) { 
	$bal = $exp['quantity'] - $exp['act_quantity'];
	$style = "background-color:white;font-weight:bold;";
	if ($bal > 0) {
		$style = "background-color:LightCyan;font-weight:bold;";
	}
	if ($bal < 0) {
		$style = "background-color:OldLace; font-weight:bold;";
	}	
	?>																
	<tr>
		<td style="<?php echo $style; ?>"><nobr><?php echo $i; ?><nobr></td>
		<td style="<?php echo $style; ?>"><nobr><?php echo $exp['assetunit']; ?><nobr></td>
		<td style="<?php echo $style; ?>"><nobr><?php echo $exp['itemDescription']; ?><nobr></td>
		<td style="<?php echo $style; ?>"><nobr><?php echo $exp['catalogueno']; ?><nobr></td>
		<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $exp['quantity'] != 0 ? (int)$exp['quantity'] : '';?><nobr></td>
		<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $exp['act_quantity'] != 0 ? (int)$exp['act_quantity'] : '';?><nobr></td>
		<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal > 0 ? (int)abs($bal) : ''; ?></nobr></td>
		<td style="text-align: right;<?php echo $style; ?>"><nobr><?php echo $bal < 0 ? (int)abs($bal) : ''; ?></nobr></td>		
	</tr>
	<?php $i++; ?>
	<?php }  ?>
  </tbody>
  </table>					