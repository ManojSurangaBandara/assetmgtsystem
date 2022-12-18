<?php include 'header1.php';?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
    $('#export-btn').on('click', function(e){
        e.preventDefault();
        ResultsToTable();
    });
    
    function ResultsToTable(){    
        $("#abc").table2excel({
            name: "New File",
			filename: "TotalSummaryList",
			fileext: "xls"
        });
    }
});
</script>

<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Total Summary List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                   
                                        <div class="table_wrapper_inner">
                                            <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
												<thead>
												<tr>												 
                                                <th>S/N</th>
                                                <th>Assests Category</th>
												<th>Items</th>
                                                <th align="right">Amount</th>
                                                </tr>
											</thead>
											<tbody>															
                                                    <tr>
                                                        <td>1</td>                                                        
                                                        <td>Land</td>
														<td align="right"><?php echo $ld[0]; ?></td>
														<td align="right"><?php echo number_format((float)$ld[1], 2, '.', ','); ?></td>
													</tr>
													<tr>
														<td>2</td>
														<td>Building</td>
														<td align="right"><?php echo $bd[0]; ?></td>
														<td align="right"><?php echo number_format((float)$bd[1], 2, '.', ','); ?></td>
													</tr>
													<tr>
														<td>3</td>
														<td>Plant & Machinery</td>
														<td align="right"><?php echo $pm[0]; ?></td>
														<td align="right"><?php echo number_format((float)$pm[1], 2, '.', ','); ?></td>
													</tr>
													<tr>
														<td>4</td>
														<td>Office Equipments</td>													
														<td align="right"><?php echo $oe[0]; ?></td>
														<td align="right"><?php echo number_format((float)$oe[1], 2, '.', ','); ?></td>
													</tr>
													<tr>
														<td>5</td>
														<td>Vehicles</td>													
														<td align="right"><?php echo $ve[0]; ?></td>
														<td align="right"><?php echo number_format((float)$ve[1], 2, '.', ','); ?></td>														
                                                    </tr>
                                                </tbody>
												<tr>
														<td></td>                                                        
                                                        <td>Total</td>	
														<td align="right"><?php echo $ld[0]+$bd[0]+$pm[0]+$oe[0]+$ve[0]; ?></td>
														<td align="right"><?php echo number_format((float)$ld[1]+$bd[1]+$pm[1]+$oe[1]+$ve[1], 2, '.', ','); ?></td>
												</tr>		
												</table>
                                        </div>
                                    
                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<button id="export-btn">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a3');
					doc.text("Total Summary List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("totalsummary.pdf");
				}
			</script>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>