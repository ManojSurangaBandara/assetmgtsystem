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
			filename: "Vehicle_Details",
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
												<th><nobr>Assets Unit</nobr></th>
												<th><nobr>Main Category</nobr></th>												
                                                <th><nobr>Item Category</nobr></th>
												<th><nobr>Item Description</nobr></th>
												<th><nobr>Brand Name</nobr></th>
												<th><nobr>Model Name</nobr></th>
												<th><nobr>Asset No.</nobr></th>
                                                <th><nobr>Classification No.</nobr></th>
                                                <th><nobr>Engine No.</nobr></th>
                                                <th><nobr>Chessis No.</nobr></th>
												<th><nobr>Army No.</nobr></th>
												<th><nobr>Civil No.</nobr></th>												
                                                <th><nobr>Fuel</nobr></th>
												<th><nobr>DOP</nobr></th>
                                                <th><nobr>Unit Value (Rs.)</nobr></th>
												<th><nobr>Identification No.</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
														<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
														<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
														<td><nobr><?php echo $exp['brandName']; ?></nobr></td>
														<td><nobr><?php echo $exp['modelName']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
														<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['engineno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['chessisno']; ?></nobr></td>
														<td><nobr><?php echo $exp['armyno']; ?></nobr></td>	
														<td><nobr><?php echo $exp['civilno']; ?></nobr></td>
														<td><nobr><?php echo $exp['fuel']; ?></nobr></td>
														<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
														<td  align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>
														<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
														</tr>
                                                    <?php $i++;?>
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
					doc.text("Vehicle Details", 30, 50);
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