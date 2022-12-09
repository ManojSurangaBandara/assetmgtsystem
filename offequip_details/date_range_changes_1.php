<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th>Assets Number</th> 
	<th>Classification No</th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><?php echo $exp['itemDescription']; ?></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['tot'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>

        <div class="title_wrapper">
            <h2><?php echo $title_dis?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>   
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th>Assets Number</th> 
	<th>Classification No</th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($exps_dis as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>	
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><?php echo $exp['itemDescription']; ?></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format($exp['tot'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format($totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>