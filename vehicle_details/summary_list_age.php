<?php include 'header1.php'; ?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
</script>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
    <div class="section table_section">
	        <form action="." method="post" id="search_Expendable__form" class="search_form general_form">
            <input type="hidden" name="action" value="List_summary_age"/>
            <table width="100%" border="0" class="listing form">
                <tr>
                    <td><b>Stock at : </b></td> <td>  
                    
                        <input type='text' class="text" name="inputField1" value="<?php echo $receivedDate; ?>" id="inputField1" style="width:90px;"/>
                       
                    </td>
            </tr>
                <tr>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />
                    </td>
                </tr>
            </table>
        </form>
<?php 
$grandqty = 0; 
$grandvalue = 0;?>		
        <div class="title_wrapper">
            <h2><a href="index.php?action=List_summary_age_perid&id=1&date1=<?php echo $date2?>&date2=<?php echo $date5?>" style="color:white">Vehicle Details Below 5 Years (<?php echo $date5?> to <?php echo $date2?>)</a></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
    <th><?php echo $tList[3][$lang]?></th> 
	<th><?php echo $tList[4][$lang]?></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items5 as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><a href="index.php?action=List_summary_age_perid_item&id=1&date1=<?php echo $date2?>&date2=<?php echo $date5?>&catalogueno=<?php echo $exp['catalogueno']?>" style="color:black"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
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
	<td></td>
	<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
 <?php 
 $grandqty = $grandqty + $totqty; 
 $grandvalue = $grandvalue + $totvalue; ?>
 <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>	
       <div class="title_wrapper" >
            <h2><a href="index.php?action=List_summary_age_perid&id=2&date1=<?php echo $date51?>&date2=<?php echo $date10?>" style="color:white">Vehicle Details Between 5 ~ 10 Years (<?php echo $date10?> to <?php echo $date51?>)</a></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items10 as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><a href="index.php?action=List_summary_age_perid_item&id=2&date1=<?php echo $date51?>&date2=<?php echo $date10?>&catalogueno=<?php echo $exp['catalogueno']?>" style="color:black"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
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
	<td></td>
	<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
 <?php 
 $grandqty = $grandqty + $totqty; 
 $grandvalue = $grandvalue + $totvalue; ?>
<div class="title_wrapper">
            <h2><a href="index.php?action=List_summary_age_perid&id=3&date1=<?php echo $date101?>&date2=<?php echo $date15?>" style="color:white">Vehicle Details  Between 10 ~ 15 Years (<?php echo $date15?> to <?php echo $date101?>)</a></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>   
    <th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items15 as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><a href="index.php?action=List_summary_age_perid_item&id=3&date1=<?php echo $date101?>&date2=<?php echo $date15?>&catalogueno=<?php echo $exp['catalogueno']?>" style="color:black"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
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
	<td></td>
	<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
 <?php 
 $grandqty = $grandqty + $totqty; 
 $grandvalue = $grandvalue + $totvalue; ?>
<div class="title_wrapper">
            <h2><a href="index.php?action=List_summary_age_perid&id=4&date1=<?php echo $date151?>&date2=<?php echo $date20?>" style="color:white">Vehicle Details Above 15 Years (<?php echo $date20?> to <?php echo $date151?>)</a></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Assets Number</nobr></th> 
	<th><nobr>Classification No</nobr></th> 
	<th><nobr>Quantity</nobr></th> 
	<th><nobr>Value</nobr></th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items20 as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><a href="index.php?action=List_summary_age_perid_item&id=4&date1=<?php echo $date151?>&date2=<?php echo $date20?>&catalogueno=<?php echo $exp['catalogueno']?>" style="color:black"><?php echo $exp['itemDescription']; ?></a></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
<?php } ?> 
 <?php 
 $grandqty = $grandqty + $totqty; 
 $grandvalue = $grandvalue + $totvalue; ?>
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
		<tr>
	<td></td>
	<td>Grand Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td align="right"><?php echo number_format((float)$grandqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$grandvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
                                                </div>

                                                        </div>
														</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
                                                        <?php
include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>