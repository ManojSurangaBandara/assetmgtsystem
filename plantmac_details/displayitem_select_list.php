<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	var selectLoss 		 = ($('#Loss_'+id).prop('checked')) ? 2 : 0;
	if (selectLoss == 2) {
		$("#"+id).prop('value', 'Deselect');
	} else {
		$("#"+id).prop('value', 'Select');	
	}
	var querystring = {
			id: id,
			selectLoss: selectLoss, 				 
			action: 'displayitem_select_save'
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
            <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="Select_Items_For_displayitem"/>
            <table width="100%" border="0">
                <tr>                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
                    <td>
                        <select name="assetscenter" id="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td></td>
                </tr>
 
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" id="btnSubmit" value="Search" />

                    </td> 
                </tr>
            </table>
        </form>
		<div class="title_wrapper">
            <h2>Select Display Vehicle</h2>
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
                                            <th nowrap="nowrap"><nobr>Identification No</nobr></th>
											<th><nobr>Disposed Date</nobr></th>
											<th><nobr>Approved Date - DAM</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>
											<th><nobr>Condemnation Board - Ref</nobr></th>
											<th><nobr>Destruction Board - Ref</nobr></th>
											<th><nobr>Reason for Disposal</nobr></th> 
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>" <?php if($exp['selectLoss']==2) echo "checked=checked"; ?> <?php if($exp['confirmLoss']==1) echo "disabled"; ?>><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php if($exp['selectLoss']==0) {echo "Select";} else {echo "Deselect";} ?>" <?php if($exp['confirmLoss']==1) echo "disabled"; ?>/></form></nobr></td>
                                                                <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
																<td><nobr><?php echo $exp['disposedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo substr($exp['ApprovedDisposalDate'],0,10); ?></nobr></td>
																<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
																<td><nobr><?php echo $exp['condemnation']; ?></nobr></td>
																<td><nobr><?php echo $exp['destruction']; ?></nobr></td>
																<td><nobr><?php echo $exp['disposedReason']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
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
												<td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
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