<?php include 'header1.php'; ?>
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
			filename: "LandDetails",
			fileext: "xls"
        });
    }
});
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]?></h2>
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
                                        <div id="wrap">
										<table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Item No</nobr></th>
												<th><nobr>Province</nobr></th>
												<th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Assets Unit</nobr></th>												
                                                <th><nobr>Category Name</nobr></th>																								
                                                <th><nobr>Area(Hect)</nobr></th>
												<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                                <th><nobr>Estimated Value</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1;
													  $province = "";
													  $j = 1;
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { 
													if ($province != $exp['province']) {
														$j = 1;
														$province = $exp['province'];
													}
												?>																
                                                       
													<tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $j; ?></nobr></td>
														<td><nobr><?php echo $exp['province']; ?></nobr></td>
														<td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>	
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['category']; ?></nobr></td>														
                                                        <td align="right"><nobr><?php echo number_format($exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format($exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['estimatedValue'], 2, '.', ','); ?></nobr></td>
                                                    </tr>
                                                    <?php $i++;
														$j++;
													      $totvalue = $totvalue + $exp['estimatedValue']; ?>
                                                <?php } ?> 
                                                </tbody>
											  </table>
                                        </div>
                                    
                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel Type I</button>
			<button id="export-btn">Export to Excel Type II</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Land Details List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
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