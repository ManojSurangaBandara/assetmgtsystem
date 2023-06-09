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
	var selectDisposal 		 = ($('#Disposal_'+id).prop('checked')) ? 1 : 0;
	if (selectDisposal == 1) {
		$("#"+id).prop('value', 'Deselect');
	} else {
		$("#"+id).prop('value', 'Select');	
	}
	var querystring = {
			id: id,
			selectDisposal: selectDisposal, 				 
			action: 'Disposal_select_save_quick'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 	
return false
});	
	
	
	}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Select Disposals Details - Office Equipments (Quick)</h2>
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
									<?php
									echo "<a href='index.php?action=Select_Items_For_Disposal_quick&page1=1' class='paging'>First Page</a>";
									for ($j=1; $j<=$total_pages; $j++) {
										echo "<a href='index.php?action=Select_Items_For_Disposal_quick&page1=$j' class='paging'>$j</a>";
									};
									$last_page_no = $total_pages ? $total_pages : 1;
									echo "<a href='index.php?action=Select_Items_For_Disposal_quick&page1=$last_page_no'  class='paging'>Last Page</a>";
									?>
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
                                                <?php //$i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
												<input type="checkbox" name="Disposal_<?php echo $exp['id']; ?>" id="Disposal_<?php echo $exp['id']; ?>" <?php if($exp['selectDisposal']==1) echo "checked=checked"; ?> <?php if($exp['confirmDisposal']==1) echo "disabled"; ?>><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php if($exp['selectDisposal']==0) {echo "Select";} else {echo "Deselect";} ?>" <?php if($exp['confirmDisposal']==1) echo "disabled"; ?>/></form></nobr></td>
                                                                <td><nobr><a href="index.php?action=search_Disposal&id=<?php echo $exp['id']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
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