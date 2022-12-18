<?php include '../view/header1.php'; ?>
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
            <input type="hidden" name="action" value="List_summary6"/>
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
        <div class="title_wrapper">
            <h2>Vehicle Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
				<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
	<th>ASSET CLASSIFICATION NO</th>
	<th>ASSET NO</th>
	<th><nobr>CATALOGUE NO</nobr></th>	
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
<td><nobr><?php echo $exp[0]; ?></nobr></td>	
<td><nobr><?php echo $exp[1]; ?></nobr></td>
<td><nobr><?php echo $exp[2]; ?></nobr></td>
<td><nobr><?php echo $exp[3]; ?></nobr></td>
<td><nobr><?php echo $exp[4]; ?></nobr></td>
<td align="right"><nobr><?php echo $exp[5]; ?></nobr></td>
<td style="text-align:right"><nobr><?php echo number_format((float)$exp[6], 2, '.', ','); ?></nobr></td>	
</tr> 
 <?php $i++; 
 $totqty = $totqty + $exp['5']; 
 $totvalue = $totvalue + $exp['6']; ?>
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