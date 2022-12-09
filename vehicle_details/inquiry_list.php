<?php include 'header1.php'; ?>
	<script>
	$(function(){
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
            <input type="hidden" name="action" value="List_Inquiry"/>
            <input type="hidden" name="disposal" value="<?php echo $disposal; ?>"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b> </td>
                    <td>        
                        <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" id="searchby" onChange="getrequestitem('index.php?action=findSearchType&searchby=' + this.value)">
                            <option value="Army Number" <?php if ($searchby == "Army Number") echo "selected = 'selected'"; ?>>Army Number</option>
							<option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Category"  <?php if ($searchby == "Category") echo "selected = 'selected'"; ?>>Category</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                           <option value="Chassis Number" <?php if ($searchby == "Chassis Number") echo "selected = 'selected'"; ?>>Chassis Number</option>
						   <option value="Civil Number" <?php if ($searchby == "Civil Number") echo "selected = 'selected'"; ?>>Civil Number</option>
						   <option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
						   <option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
						   <option value="Engine Number" <?php if ($searchby == "Engine Number") echo "selected = 'selected'"; ?>>Engine Number</option>
						   <option value="Horse Power" <?php if ($searchby == "Horse Power") echo "selected = 'selected'"; ?>>Horse Power</option>
						   <option value="Modle" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Fuel</option> 
						   <option value="Ownership" <?php if ($searchby == "Ownership") echo "selected = 'selected'"; ?>>Ownership</option>
						   <option value="Present Location" <?php if ($searchby == "Present Location") echo "selected = 'selected'"; ?>>Present Location</option>
						   <option value="brandName" <?php if ($searchby == "brandName") echo "selected = 'selected'"; ?>>Brand</option>
                            <option value="modelName" <?php if ($searchby == "modelName") echo "selected = 'selected'"; ?>>Modle</option>
                            <option value="Tare" <?php if ($searchby == "Tare") echo "selected = 'selected'"; ?>>Tare</option>
                             <option value="Unit Value" <?php if ($searchby == "Unit Value") echo "selected = 'selected'"; ?>>Unit Value</option>
                            <option value="Year manufactured" <?php if ($searchby == "Year manufactured") echo "selected = 'selected'"; ?>>Year manufactured</option>   
                        </select>

                    </td>
                    <td>
                        <div id="Itmdiv">
                            <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist>
                            <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[14][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>
								
				<?php if ($checkAllowType == 1 && $disposal == 0) { // 1 - Asset center and asset unit same?>
				<tr>
                    <td></td>
                    <td><b>&nbsp;</b></td> <td>
						<input type="radio" name="allocation" value="1" <?php if ($allocation == 1) echo 'checked'; ?>>Only This Unit Details
						<input type="radio" name="allocation" value="2" <?php if ($allocation == 2) echo 'checked'; ?>>Allocation to Other Units
						<input type="radio" name="allocation" value="3" <?php if ($allocation == 3) echo 'checked'; ?>>Both
						</td>
                    </td>
                </tr>
				 <?php } elseif ($checkAllowType == 2 && $disposal == 0) { // 1 - Asset unit and present location different?> 
					<tr>
                    <td></td>
                    <td><b>&nbsp;</b></td> <td>
						<input type="radio" name="allocation" value="1" <?php if ($allocation == 1) echo 'checked'; ?>>Only This Unit Details
						<input type="radio" name="allocation" value="2" <?php if ($allocation == 2) echo 'checked'; ?>>Allocated from Assets Centre - <?php echo $assetscenter; ?>
						<!--<input type="radio" name="allocation" value="3" <?php if ($allocation == 3) echo 'checked'; ?>>Both -->
						</td>
                    </td>
                </tr>	
					
				<?php } ?>	
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>
                    <td>  

                        <input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?>
                        <input type="checkbox" name="ExpToPdf" value="1" /> <?php echo $exppdf[$lang]?>
                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2><?php echo (isset($disposal) && $disposal == 1 ? 'Vehicle Details - Disposal List' : 'Vehicle Details List') ?></h2>
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
                                            <th>S/N</th>
											<th nowrap="nowrap"><nobr>Assets Unit</nobr></th>
											<th nowrap="nowrap"><nobr>Vehicle Type</nobr></th>
                                            <th nowrap="nowrap"><nobr>Identification No</nobr></th>
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
											</thead>
														<tbody>
                                                        </tr>
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
																<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
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
												<td>Total Value</td>
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
												   <td></td>
												   <td></td>
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
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