<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>


<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Total Input List</h2>
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
                                            <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                                <col width="30">
												<col width="130">
												<col width="130">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<col width="40">
												<tbody> 
                                                <th>S/N</th>
                                                <th><a>Asset Center</a></th>
                                                <th><a>Asset Unit</a></th>
                                                <th><a>Land Confirmed</a></th>
                                                <th><a>Land Not Confirmed</a></th>
												<th><a>Land Total</a></th>
												<th><a>Building Confirmed</a></th>
                                                <th><a>Building Not Confirmed</a></th>
												<th><a>Building Total</a></th>
												<th><a>Plant & Machinery  Confirmed</a></th>
                                                <th><a>Plant & Machinery Not Confirmed</a></th>
												<th><a>Plant & Machinery Total</a></th>
												<th><a>Office Equipments Confirmed</a></th>
                                                <th><a>Office Equipments Not Confirmed</a></th>
												<th><a>Office Equipments Total</a></th>
												<th><a>Vehicles Confirmed</a></th>
                                                <th><a>Vehicles Not Confirmed</a></th>
												<th><a>Vehicles Total</a></th>
												<th><a>Total Confirmed</a></th>
                                                <th><a>Total Not Confirmed</a></th>
                                                <th><a>Full Total</a></th>
												<th>Report Received</th>
                                                </tr>
                                                <?php $i = 1; ?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr bgcolor=<?php 
													if ($exp[7] == 0) {
																echo "#3BB9FF"; }
                                                    ?>>
                                                        <td><?php echo $i; ?></td>                                                        
                                                        <td><?php echo $exp[0]; ?></td>
                                                        <td><?php echo $exp[1]; ?></td>	
														<td align="right"><?php echo $exp[8]; ?></td>
														<td align="right"><?php echo $exp[14]; ?></td>
														<td align="right"><?php echo $exp[2]; ?></td>
														<td align="right"><?php echo $exp[9]; ?></td>
														<td align="right"><?php echo $exp[15]; ?></td>
														<td align="right"><?php echo $exp[3]; ?></td>
														<td align="right"><?php echo $exp[10]; ?></td>
														<td align="right"><?php echo $exp[16]; ?></td>
														<td align="right"><?php echo $exp[4]; ?></td>
														<td align="right"><?php echo $exp[11]; ?></td>
														<td align="right"><?php echo $exp[17]; ?></td>
														<td align="right"><?php echo $exp[5]; ?></td>
														<td align="right"><?php echo $exp[12]; ?></td>
														<td align="right"><?php echo $exp[18]; ?></td>
														<td align="right"><?php echo $exp[6]; ?></td>
														<td align="right"><?php echo $exp[13]; ?></td>
														<td align="right"><?php echo $exp[19]; ?></td>
														<td align="right"><?php echo $exp[7]; ?></td>
														<td align="right"><?php echo $exp[20]; ?></td>														
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?> 
                                                </tbody></table>
                                        </div>
                                    
                                </fieldset>


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