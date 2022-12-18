<?php include 'header1.php'; ?>
<div id="page">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Search Vehicle Details from Vehicle Number
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter vehicle Number and  press "Search" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="search_army_number" />
                                        <div><label for="code" class="label">Vehicle Army Number :</label><input type="text" class="text" name="vehicleno"  id="vehicleno" value = "<?php echo $vehicleno; ?>" style="width:150px"/></div>
                                        <div><input type="submit" name="submit" id="submit" value="Search"></div>									
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="Itmdiv">
                    <div class="table_wrapper">
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
                                                        <?php 
														if (!empty($content)) {
														foreach ((array)$content as $c) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $c->_get('year'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('year_half'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('ordinance'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('type'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('date1'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('date2'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('lotno'); ?></nobr></td>
                                                                <td><nobr><?php echo (int)$c->_get('vehicleno'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('vmodel'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('engineno'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('chaisseeno'); ?></nobr></td>
																<td align="right"><nobr><?php echo number_format((float)$c->_get('amount'), 2, '.', ','); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('bname'); ?></nobr></td>
																<td><nobr><?php echo $c->_get('baddress'); ?></nobr></td>
                                                                <td><nobr><?php echo $c->_get('bidno'); ?></nobr></td>                                                                
															</tr>
                                                            <?php $i++;?>
                                                        <?php } } ?> 
                                                        </tbody>
														</table>
                                                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>
<?php
include '../view/footer.php';
?>