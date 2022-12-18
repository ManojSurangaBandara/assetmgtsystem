<?php
include 'header1.php';
?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<div id="page">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Board Report Summary - Plant & Machinery Details - <?php echo $currentYear ?> - <?php echo $_GET['assetunit'];?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<div class="table_wrapper">
		<div class="table_wrapper_inner">
		<table cellpadding="0" cellspacing="0" width="100%"> 
<thead> 
<tr> 
    <th rowspan="2">S/N</th>  
	<th rowspan="2" style="text-align:center">Catalogue No</th>     
	<th rowspan="2" style="text-align:center">Item Description</th>  
	<th colspan="2" style="text-align:center"><nobr>Opening Balance</nobr></th>
	<th colspan="2" style="text-align:center"><nobr>New Arrivals</nobr></th>
	<th colspan="2" style="text-align:center"><nobr>Disposals</nobr></th>
	<th colspan="2" style="text-align:center"><nobr>Year End Balance</nobr></th> 	
</tr> 
<tr>  
	<th style="text-align:center"><nobr>Qty</nobr></th> 
	<th style="text-align:center"><nobr>Value</nobr></th> 
	<th style="text-align:center"><nobr>Qty</nobr></th> 
	<th style="text-align:center"><nobr>Value</nobr></th> 
	<th style="text-align:center"><nobr>Qty</nobr></th> 
	<th style="text-align:center"><nobr>Value</nobr></th> 
	<th style="text-align:center"><nobr>Qty</nobr></th> 
	<th style="text-align:center"><nobr>Value</nobr></th> 
</tr>
</thead> 
<tbody> 
<?php $i = 1;
$opn_totqty = 0;
$opn_totvalue = 0;
$new_totqty = 0; 
$new_totvalue = 0;
$dis_totqty = 0; 
$dis_totvalue = 0;
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items as $exp) { 
$opn_bal = board_report_summaryDB::getOpeningBalance($_GET['cyear'] - 1, $_GET['assetunit'], $_GET['itemtype'], $exp['catalogueno']);

//getOpeningBalance($cyear, $assetunit, $itemtype, $catalogueno)
?>		
<tr> 
<td><nobr><?php echo $i; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><a href="index.php?action=board_report_summary_view_details&id=<?php echo $exp['id'];?>&cyear=<?php echo $_GET['cyear'];?>&assetunit=<?php echo $_GET['assetunit'];?>"><?php echo $exp['itemDescription']; ?></a></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$opn_bal['quantity'], 0, '.', ','); ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$opn_bal['totalcost'], 2, '.', ','); ?></nobr></td>	
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['new_quantity'], 0, '.', ','); ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['new_totalcost'], 2, '.', ','); ?></nobr></td>	
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['dis_quantity'], 0, '.', ','); ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['dis_totalcost'], 2, '.', ','); ?></nobr></td>	
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['quantity'], 0, '.', ','); ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp['totalcost'], 2, '.', ','); ?></nobr></td>	
</tr> 
 <?php $i++; 
 $opn_totqty = $opn_totqty + $opn_bal['quantity'];
 $opn_totvalue = $opn_totvalue + $opn_bal['totalcost'];  
 $totqty = $totqty + $exp['quantity']; 
 $totvalue = $totvalue + $exp['totalcost']; 
 $new_totqty = $new_totqty + $exp['new_quantity']; 
 $new_totvalue = $new_totqty + $exp['new_totalcost'];
 $dis_totqty = $dis_totqty + $exp['dis_quantity']; 
 $dis_totvalue = $dis_totvalue + $exp['dis_totalcost'];
 ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td style="text-align:right"><?php echo number_format((float)$opn_totqty, 0, '.', ','); ?></td>	
	<td style="text-align:right"><?php echo number_format((float)$opn_totvalue, 2, '.', ','); ?></td>
	<td style="text-align:right"><?php echo number_format((float)$new_totqty, 0, '.', ','); ?></td>	
	<td style="text-align:right"><?php echo number_format((float)$new_totvalue, 2, '.', ','); ?></td>
	<td style="text-align:right"><?php echo number_format((float)$dis_totqty, 0, '.', ','); ?></td>	
	<td style="text-align:right"><?php echo number_format((float)$dis_totvalue, 2, '.', ','); ?></td>
	<td style="text-align:right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	<td style="text-align:right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
</div>
</div>
<iframe id="txtArea1" style="display:none"></iframe>
<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
															<button onclick="generate()">Export to pdf</button>
															<script src="../jspdf/libs/jspdf.min.js"></script>
															<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
															<script>
																function generate() {
																	 var doc = new jsPDF('l', 'pt', 'a3');
																	doc.text("Plant & Machinery Details List", 30, 50);
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
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>