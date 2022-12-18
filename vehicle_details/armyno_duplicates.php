<?php include 'header5.php'; ?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Vehicle Details List</h2>
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
                                        <table id="abc" cellpadding="1" cellspacing="0" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                           <thead>
                                            <th>S/N</th>
											<th nowrap="nowrap"><nobr>Assets Unit</nobr></th>
											<th nowrap="nowrap"><nobr>Vehicle Type</nobr></th>
                                            <th nowrap="nowrap"><nobr>Identification No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Category</nobr></th>
                                            <th nowrap="nowrap"><nobr>Description</nobr></th>
											<th nowrap="nowrap"><nobr>Capacity</nobr></th>
                                            <th nowrap="nowrap"><nobr>Fuel</nobr></th>
                                            <th nowrap="nowrap"><nobr>Asset No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Engine No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Chassis No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Brand</nobr></th>
                                            <th nowrap="nowrap"><nobr>Model</nobr></th>											
                                            <th nowrap="nowrap"><nobr>Army No</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOP</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOR</nobr></th>
                                            <th nowrap="nowrap"><nobr>Value</nobr></th>
											</thead>
											<tbody>
                                                        </tr>
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr bgcolor=<?php
                                                            switch ($exp['selectDisposal'] + $exp['confirmDisposal']) {
                                                                case '1':
                                                                    echo "#00FF00";
                                                                    break;
                                                                case '2':
                                                                    echo "#00BFFF";
                                                                    break;
                                                            }
															if ($exp['presentLocation'] != $exp['assetunit']) {
																echo "#EE82EE"; }
                                                            ?>>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
																<td><nobr><?php echo $exp['make']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['modle']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['engineno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['chessisno']; ?></nobr></td>
																<td><nobr><?php echo $exp['brandName']; ?></nobr></td>
																<td><nobr><?php echo $exp['modelName']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['armyno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td  align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue']; ?>
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
																	doc.text("Vehicle Details List", 30, 50);
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