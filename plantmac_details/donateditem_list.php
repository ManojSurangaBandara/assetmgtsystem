<?php
include 'header5.php';
?>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Plant & Machinery Donated Item List</h2>
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
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead> 
											<tr> 
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Unit</nobr></th>
                                            <th><nobr>Identification No</nobr></th>                                            
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
											<th><nobr>Remarks</nobr></th>
                                             </tr>
											 </thead> <tbody> 
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=DisposalList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>																
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
																<td><nobr><?php echo $exp['ApprovedDisposal'] == '1' ? "Disposed on ".$exp['disposedDate'] : ""; ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue']; ?>
                                                        <?php } ?> 
                                                        </tbody>
																													<tfoot>
												<tr>
												<td></td>
												<td>Total :</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
												<td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												<td></td>
												</tr>
											  </tfoot>
														
														</table>
                                                        </div>
                                                        </fieldset>
														<form action = "index.php" method = "post">
															<input type="hidden" name="action" value="Donated_List_csv" />
															<input type="submit" name="csv" value="Convert to CSV" />
														</form>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
                                                        </div>

                                                        </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>