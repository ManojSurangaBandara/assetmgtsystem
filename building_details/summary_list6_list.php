<?php include 'header5.php'; ?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]." - " .$categoryName ?></h2>
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
                                            <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                                                
                                                <thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Assets Unit</nobr></th>
                                                <th><nobr>Identification No</nobr></th>
                                                <th><nobr>Building Category</nobr></th>
                                                <th><nobr>Building Type</nobr></th>
												<th><nobr>Assets No</nobr></th>
												<th><nobr>Classification No</nobr></th>
                                                <th><nobr>Name of Land</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
												<th><nobr>GS Division</nobr></th>
                                                <th><nobr>DOR</nobr></th>												
                                                <th><nobr>Area(SQ Metre)</nobr></th>
												<th><nobr>Area(SQ Foot)</nobr></th>
                                                <th><nobr>Construction Cost</nobr></th>
                                                </tr>
												</thead>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
														<td><nobr><?php echo $exp['assetunit']; ?></td>
                                                        <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                        <td><nobr><?php echo $exp['buildingCategory']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['buildingType']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
														<td><nobr><?php echo $exp['classificationno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['landname']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['acquisitiondate']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format((float)$exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo number_format((float)$exp['feets'], 2, '.', ','); ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format((float)$exp['constructionCost'], 2, '.', ','); ?></nobr></td>
                                                        
                                                    </tr>
                                                    <?php $i++; 
													$totvalue = $totvalue + $exp['constructionCost'];?>
                                                <?php } ?> 
                                                </tbody>
												<tfoot>
												<tr>
												<td></td>											
												<td>Total Value</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
												  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
                                        </div>
                                    
                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script>
				function generate() {
					 var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Building Details List", 30, 50);
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