<?php
include 'header1.php';
?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Office Equipment Details List</h2>
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
                                            <table id="abc" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                                
                                                <tbody>
                                                    <col width="10">
                                                    <col width="200">
                                                <th>S/N</th>
                                                <th><a>Identification No</a></th>
                                                <th><a>Category</a></th>
                                                <th><a>Description</a></th>
                                                <th><a>Asset No</a></th>
                                                <th><a>Catalogue No</a></th>
                                                <th><a>Serial No.</a></th>												
                                                <th><a>DOP</a></th>
                                                <th><a>DOR<a></th>
                                                <!-- <th><a>Quantity</a></th> -->
                                                <th><a>Unit Value</a></th>
                                                <!-- <th><a>Total Value</a></th>  -->
                                                </tr>
                                                <?php $i = 1; ?>
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
                                                        <td><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                        <td><?php echo $exp['itemCategory']; ?></td>
                                                         <td><?php echo $exp['itemDescription']; ?></td>
                                                           <td><?php echo $exp['assetsno']; ?></td>
                                                        <td><?php echo $exp['catalogueno']; ?></td>                                                        
														<td><?php echo $exp['eqptSriNo']; ?></td>                                                        
                                                        <td><?php echo $exp['purchasedDate']; ?></td>
                                                        <td><?php echo $exp['receivedDate']; ?></td>
                                                        <!-- <td><?php echo $exp['quantity']; ?></td>  -->
                                                        <td align="right"><?php echo $exp['unitValue']; ?></td>
                                                        <!-- <td><?php echo $exp['totalCost']; ?></td>  -->
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
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>