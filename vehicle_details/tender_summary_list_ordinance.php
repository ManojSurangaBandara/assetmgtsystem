<?php
include 'header5.php';
?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Vehicle Tender Summary List With Ordinance</h2>
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
											<th nowrap="nowrap"><nobr>Ordinance</nobr></th>
                                            <th nowrap="nowrap"><nobr>Sold as a Vehicle</nobr></th>										
											<th nowrap="nowrap"><nobr>Sold as a Debris</nobr></th>
											<th nowrap="nowrap"><nobr>Total</nobr></th>											
											</thead>
											<tbody>
                                                        </tr>
                                                        <?php $i = 1;
														$t_type1 = 0; 	
														$t_type2 = 0; 
														?>
                                                        <?php foreach ($items as $c) { 
															$type1 = tender_vehicledetails::tender_summary_cal_ord($c['year'], $c['year_half'], 1, $c['ordinance']);
															$type2 = tender_vehicledetails::tender_summary_cal_ord($c['year'], $c['year_half'], 2, $c['ordinance']);
														?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $c['year']; ?></nobr></td>
																<td><nobr><?php echo $c['year_half']; ?></nobr></td>
																<td><nobr><?php echo $c['ordinance']; ?></nobr></td>
																<td style="text-align: right;"><nobr><?php echo $type1; ?></nobr></td>
																<td style="text-align: right;"><nobr><?php echo $type2; ?></nobr></td>
																<td style="text-align: right;"><nobr><?php echo $type1+$type2; ?></nobr></td> 																
															</tr>
                                                            <?php $i++;
															$t_type1 = $t_type1 + $type1;
															$t_type2 = $t_type2 + $type2;?>
                                                        <?php } ?> 
                                                        </tbody>
														 <tfoot>
																<tr>
																  <th id="total" colspan="4">Total :</th>
																<td style="text-align: right;"><nobr><?php echo $t_type1; ?></nobr></td>
																<td style="text-align: right;"><nobr><?php echo $t_type2; ?></nobr></td>
																<td style="text-align: right;"><nobr><?php echo $t_type1+$t_type2; ?></nobr></td>
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