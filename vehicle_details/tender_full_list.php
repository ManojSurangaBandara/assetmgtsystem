<?php
include 'header5.php';
?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Vehicle Tender Details List</h2>
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
											<th nowrap="nowrap"><nobr>Year</nobr></th>
											<th nowrap="nowrap"><nobr>Half Year</nobr></th>
                                            <th nowrap="nowrap"><nobr>Ordinance </nobr></th>
                                            <th nowrap="nowrap"><nobr>Type</nobr></th>
                                            <th nowrap="nowrap"><nobr>Tender Date 1</nobr></th>
											<th nowrap="nowrap"><nobr>Tender Date 2</nobr></th>
                                            <th nowrap="nowrap"><nobr>Lot No.</nobr></th>
                                            <th nowrap="nowrap"><nobr>Vehicle No.</nobr></th>
											<th nowrap="nowrap"><nobr>Vehicle Model</nobr></th>
                                            <th nowrap="nowrap"><nobr>Engine No.</nobr></th>
                                            <th nowrap="nowrap"><nobr>Chassis No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Amount</nobr></th>
                                            <th nowrap="nowrap"><nobr>Buyer Name</nobr></th>											
                                            <th nowrap="nowrap"><nobr>Buyer Address</nobr></th>
											<th nowrap="nowrap"><nobr>Buyer ID No.</nobr></th>											
											</thead>
											<tbody>
                                                        </tr>
                                                        <?php $i = 1;?>
                                                        <?php foreach ($content as $c) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $c->_get('year'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('year_half'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('ordinance'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('type'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('date1'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('date2'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('lotno'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('vehicleno'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('vmodel'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('engineno'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('chaisseeno'); ?></nobr></td>
																<td align="right"><nobr><?php echo number_format($c->_get('amount'), 2, '.', ','); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('bname'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('baddress'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('bidno'); ?></nobr></td>                                                                
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