<?php
include 'header5.php';
?>
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
    var selectLoss 		 = ($('#Loss_'+id).prop('checked')) ? 1 : 0;
	var querystring = {
			id: id,
			selectLoss: selectLoss, 				 
			action: 'loss_confirm_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 	
return false
});	

$(".rejectbttn").click(function(){
	var id = $(this).attr('id');
	var selectLoss = ($('#Loss_'+id).prop('checked')) ? 1 : 0;
	if (selectLoss == 1) {
		var querystring = {
				id: id,				 
				action: 'loss_reject_save'
			}
			$.get('index.php', querystring, processResponse);
		 function processResponse(result) {
			if (result == 1) {
				$($('#Row_'+id).closest("tr")).remove();
				//alert(result);
			}
			}  
		} 
return false
});	
	
	}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Confirm Selected Lost & Damaged Details - Office Equipments</h2>
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
                                            <th><nobr><?php echo $tList[18][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[2][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[5][$lang]?></nobr></th>
                                            <th><nobr>Assets Number</nobr></th>
											<th><nobr>Classification No</nobr></th>
                                            <th><nobr><?php echo $tList[33][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[7][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[8][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[9][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[10][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[13][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[15][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[16][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[17][$lang]?></nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr id ="Row_<?php echo $exp['id']; ?>">
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
												<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>" <?php if($exp['confirmLoss']==1) echo "checked=checked"; ?>><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php if($exp['confirmLoss']==0) {echo "Confirm";} else {echo "Confirm";} ?>"/>&nbsp;&nbsp;<input class = "rejectbttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Reject"/></form></nobr></td>
                                                                <td><nobr><a href="index.php?action=display_loss_details&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                 <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['newAssestno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['natureOwnership']; ?></nobr></td>
																 <td><nobr><?php echo $exp['ledgerno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['ledgerFoliono']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
																 <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
																<td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
																<td><nobr><?php echo $exp['presentLocation']; ?></nobr></td>
                                                               <td><nobr><?php echo $exp['Remarks']; ?></nobr></td>
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
												<td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
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