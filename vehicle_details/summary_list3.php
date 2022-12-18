<?php include 'header1.php'; ?>
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
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="List_summary3"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
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
                    <td></td>
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
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" id="searchby">
                            <option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
                            <option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                            <option value="Assets Number" <?php if ($searchby == "Assets Number") echo "selected = 'selected'"; ?>>Assets Number</option>
                            <option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
                            <option value="Ledger Number" <?php if ($searchby == "Ledger Number") echo "selected = 'selected'"; ?>>Ledger Number</option>
                            <option value="Ledger Folio Number" <?php if ($searchby == "Ledger Folio Number") echo "selected = 'selected'"; ?>>Ledger Folio Number</option>
                            <option value="Serial Number" <?php if ($searchby == "Serial Number") echo "selected = 'selected'"; ?>>Serial Number</option>
                            <option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
                            <option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
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
                            <input type="text" class="text" name="search"  id="search" style="width:200px;" value="<?php echo $search; ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[10][$lang]?></b></td> <td> <b>From :</b> 
                    
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                       
                    </td><td><b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
            </td>    
            </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>
                    <td>  
						<!--
                        <input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?>
 

                        <input type="checkbox" name="ExpToPdf" value="1" /> <?php echo $exppdf[$lang]?>
						-->
                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2><?php echo (isset($disposal) && $disposal == 1 ? 'Office Equipment  - Disposal List' : 'Plant & Machinery Details List') ?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th> 
    <th><?php echo $tList[1][$lang]?></th> 
    <th><?php echo $tList[2][$lang]?></th>  
	<th>Quantity</th> 
	<th>Value</th> 
</tr> 
</thead> 
<tbody> 
<?php $i = 1; 
$totqty = 0; 
$totvalue = 0;?>
<?php foreach ($items as $exp) { ?>		
<tr> 
<td><?php echo $i; ?></td>
<td><?php echo $exp['assetunit']; ?></td>
<td><?php echo $exp['mainCategory']; ?></td>	
<td align="right"><?php echo $exp['cnt']; ?></td>
<td style="text-align:right"><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></td>	
</tr> 
 <?php $i++; 
  $totqty = $totqty + $exp['cnt']; 
 $totvalue = $totvalue + $exp['tot']; ?>
                                                        <?php } ?> 
</tbody> 
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
</table>
<iframe id="txtArea1" style="display:none"></iframe>
<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
															<button onclick="generate()">Export to pdf</button>
															<script src="../jspdf/libs/jspdf.min.js"></script>
															<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
															<script>
																function generate() {
																	 var doc = new jsPDF('p', 'pt', 'a4');
																	doc.text("Vehicle Details List", 30, 50);
																	var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
																	doc.autoTable(res.columns, res.data, {startY: 60});
																	doc.save("table.pdf");
																}
															</script>
 
                                                        </div>

                                                        </div>
														</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
                                                        <?php
include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>