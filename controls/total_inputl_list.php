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
												<col width="80">
												<col width="80">
												<col width="80">
												<col width="80">
												<col width="80">
												<col width="80">
												<col width="80">
												<tbody> 
                                                <th>S/N</th>
                                                <th><a>Asset Center</a></th>
                                                <th><a>Asset Unit</a></th>
                                                <th><a>Land</a></th>
                                                <th><a>Building</a></th>
                                                <th><a>Plant & Machinery</a></th>
                                                <th><a>Office Equipments</a></th>
                                                <th><a>Vehicles</a></th>
                                                <th><a>Total</a></th>
												<th>Report Received</th>
                                                </tr>
                                                <?php $i = 1; ?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr bgcolor=<?php 
													if ($exp[7] == 0) {
																echo "#FFFF00"; }
                                                    ?>>
                                                        <td><?php echo $i; ?></td>                                                        
                                                        <td><?php echo $exp[0]; ?></td>
                                                        <td><?php echo $exp[1]; ?></td>	
														<td align="right"><?php echo $exp[2]; ?></td>
														<td align="right"><?php echo $exp[3]; ?></td>
														<td align="right"><?php echo $exp[4]; ?></td>
														<td align="right"><?php echo $exp[5]; ?></td>
														<td align="right"><?php echo $exp[6]; ?></td>
														<td align="right"><?php echo $exp[7]; ?></td>
														<td align="right"><?php echo $exp[8]; ?></td>														
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