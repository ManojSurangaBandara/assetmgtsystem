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
        <div class="title_wrapper">
            <h2><?php echo $title ?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[1][$lang]?></nobr></th> 
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
<?php foreach ($items as $exp) { ?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>	
<td><?php echo $exp['itemCategory']; ?></td>
<td><a href="index.php?action=List_summary_age_perid_unit_item&id=<?php echo $id?>&date1=<?php echo $date1?>&date2=<?php echo $date2?>&assetunit=<?php echo $exp['assetunit']?>&catalogueno=<?php echo $exp['catalogueno']?>" style="color:black"><?php echo $exp['itemDescription']; ?></a></td>
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
<iframe id="txtArea1" style="display:none"></iframe>
<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
															<button onclick="generate()">Export to pdf</button>
															<script src="../jspdf/libs/jspdf.min.js"></script>
															<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
															<script>
																function generate() {
																	 var doc = new jsPDF('l', 'pt', 'a3');
																	doc.text("Vehicle Details List", 30, 50);
																	var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
																	doc.autoTable(res.columns, res.data, {startY: 60});
																	doc.save("table.pdf");
																}
															</script>
 
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