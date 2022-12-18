<?php
include 'header1.php';
?>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="loss_List_Inquiry"/>
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
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>
                        <select name="searchby">
							<option value="Assets Number" <?php if ($searchby == "Assets Number") echo "selected = 'selected'"; ?>>Assets Number</option>
							<option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
							<option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
							<option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
							<option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
                            <option value="Ledger Folio Number" <?php if ($searchby == "Ledger Folio Number") echo "selected = 'selected'"; ?>>Ledger Folio Number</option>
                            <option value="Ledger Number" <?php if ($searchby == "Ledger Number") echo "selected = 'selected'"; ?>>Ledger Number</option>
                            <option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Serial Number" <?php if ($searchby == "Serial Number") echo "selected = 'selected'"; ?>>Serial Number</option>  
                        </select>

                    </td>
                    <td>
                        <div id="Itmdiv">
                            <!-- <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist> -->
                            <input type="text" class="text" name="search"  id="search" value="<?php echo $search; ?>" style="width:200px;"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[10][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                    </td>
                    <td>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                    </td>
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
            <h2>Plant & Machinery Details - Lost & Damaged List</h2>
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
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                             <thead>
											 <tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th>                                           
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
                                                                <td><nobr><a href="index.php?action=display_loss_details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>                                                               
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>
                                                            </tr>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue'];?>
                                                        <?php } ?> 
                                                        </tbody>
														<tfoot>
												<tr>
												<td></td>											
												<td>Total Value</td>
												<td></td>
												<td></td>												
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
												  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
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
																	 var doc = new jsPDF('l', 'pt', 'a2');
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