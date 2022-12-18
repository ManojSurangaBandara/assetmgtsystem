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
                                                <th><a>Asset Center</a></th>
                                                <th><a>Asset Unit</a></th>
                                                <th><a>Land</a></th>
                                                <th><a>Building</a></th>
                                                <th><a>Plant & Machinery</a></th>
                                                <th><a>Office Equipments</a></th>
                                                <th><a>Vehicles</a></th>
                                                <th><a>Total</a></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$tot2 = 0;
												$tot3 = 0;
												$tot4 = 0;
												$tot5 = 0;
												$tot6 = 0;
												$tot7 = 0;
												?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr>
                                                        <td><?php echo $i; ?></td>                                                        
                                                        <td><?php echo $exp[0]; ?></td>
                                                        <td><?php echo $exp[1]; ?></td>	
														<td align="right"><?php echo number_format((float)$exp[2], 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$exp[3], 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$exp[4], 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$exp[5], 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$exp[6], 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$exp[7], 2, '.', ','); ?></td>														
                                                    </tr>
                                                    <?php $i++; 
													$tot2 = $tot2 + $exp[2];
													$tot3 = $tot3 + $exp[3];
													$tot4 = $tot4 + $exp[4];
													$tot5 = $tot5 + $exp[5];
													$tot6 = $tot6 + $exp[6];
													$tot7 = $tot7 + $exp[7];													
													?>
                                                <?php } ?> 
                                                </tbody>
												<tfoot>
												<tr>
														<td></td>                                                        
                                                        <td></td>
                                                        <td>Total</td>	
														<td align="right"><?php echo number_format((float)$tot2, 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$tot3, 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$tot4, 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$tot5, 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$tot6, 2, '.', ','); ?></td>
														<td align="right"><?php echo number_format((float)$tot7, 2, '.', ','); ?></td>
												</tr>
											  </tfoot>
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