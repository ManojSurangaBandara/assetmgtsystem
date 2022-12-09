<?php
include 'header1.php';
?>
<script type="text/javascript" language="javascript" class="init">


$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>
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
                                            <table id="example" class="display" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                                <thead>
													<tr>
														<th>Identification No.</th>
														<th>Category</th>
														<th>Description</th>
														<th>Asset No</th>
														<th>Calalogue No</th>
														<th>Ledger No</th>
														<th>Folio No</th>
														<th>DOP</th>
														<th>DOR</th>
														<th>Unit Value</th>
													</tr>
												</thead>
                                                <tbody>
                                                <?php $i = 1; ?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                        <td><?php echo $exp['itemCategory']; ?></td>
                                                         <td><?php echo $exp['itemDescription']; ?></td>
                                                           <td><?php echo $exp['assetsno']; ?></td>
                                                        <td><?php echo $exp['catalogueno']; ?></td>
                                                        <td><?php echo $exp['ledgerno']; ?></td>
                                                        <td><?php echo $exp['ledgerFoliono']; ?></td>
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
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>