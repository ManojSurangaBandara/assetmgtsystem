<?php include 'header5.php'; ?>
<style>
a.paging:link, a:visited {
    background-color: #5CB3FF;
    color: white;
    padding: 4px 5px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}


a.paging:hover, a:active {
    background-color: #157DEC;
}
</style>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
    var ApprovedLoss 		 = ($('#Loss_'+id).prop('checked')) ? 1 : 0;
	var querystring = {
			id: id,
			ApprovedLoss: ApprovedLoss, 				 
			action: 'loss_approve_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			if (result == 1) {
				$($('#Row_'+id).closest("tr")).remove();
				//alert(result);
			}
		} 	
return false
});	
	}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Approve Confirmed Lost & Damaged Details - Plant & Machinery</h2>
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
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Select</nobr></th>
											<th nowrap="nowrap"><nobr>Asset Unit</nobr></th>
											<th nowrap="nowrap"><nobr>Identification No</nobr></th>
											<th nowrap="nowrap"><nobr>Vehicle Type</nobr></th>
                                            <th nowrap="nowrap"><nobr>Category</nobr></th>
                                            <th nowrap="nowrap"><nobr>Description</nobr></th>
											<th nowrap="nowrap"><nobr>Capacity</nobr></th>
                                            <th nowrap="nowrap"><nobr>Fuel</nobr></th>
                                            <th nowrap="nowrap"><nobr>Catalogue No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Engine No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Chassis No</nobr></th>
                                            <th nowrap="nowrap"><nobr>Brand</nobr></th>
                                            <th nowrap="nowrap"><nobr>Model</nobr></th>											
                                            <th nowrap="nowrap"><nobr>Army No</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOP</nobr></th>
                                            <th nowrap="nowrap"><nobr>DOR</nobr></th>
                                            <th nowrap="nowrap"><nobr>Value</nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr id ="Row_<?php echo $exp['id']; ?>">
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
												<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>" <?php if($exp['ApprovedLoss']==1) echo "checked=checked"; ?>><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php if($exp['ApprovedLoss']==0) {echo "Approve";} else {echo "Approve";} ?>"/></form></nobr></td>
                                                                 <td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																<td><nobr><a href="index.php?action=display_loss_details&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
																<td><nobr><?php echo $exp['make']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['fuel']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['engineno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['chessisno']; ?></nobr></td>
																<td><nobr><?php echo $exp['brandName']; ?></nobr></td>
																<td><nobr><?php echo $exp['modelName']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['armyno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td  align="right"><nobr><?php echo number_format($exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                                </tr>
																<?php $i++; 
													      $totvalue = $totvalue + $exp['unitValue']; ?>
                                                <?php } ?> 
                                                            </tbody>
															<tfoot>
												<tr>
												<td></td>
												<td>Page Total :</td>
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
												<td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												<td></td>
												<td></td>
												<td></td>
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
																	doc.text("Plant & Machinery Details List", 30, 50);
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