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
            <table width="1009" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                </tr>
                <tr>
                    <td>
                    </td>
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
                    <td>
                    </td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b> </td>
                    <td>
                        <select name="searchby" onChange="getrequestitem('index.php?action=findSearchType&searchby=' + this.value)">
                            <option value="Area" <?php if ($searchby == "Area") echo "selected = 'selected'"; ?>>Area</option>
							<option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Date of Acquisition" <?php if ($searchby == "Date of Acquisition") echo "selected = 'selected'"; ?>>Date of Acquisition</option>
							<option value="District" <?php if ($searchby == "District") echo "selected = 'selected'"; ?>>District</option>
							<option value="DS Division" <?php if ($searchby == "DS Division") echo "selected = 'selected'"; ?>>DS Division</option>
							<option value="GS Division" <?php if ($searchby == "GS Division") echo "selected = 'selected'"; ?>>GS Division</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Land Category" <?php if ($searchby == "Land Category") echo "selected = 'selected'"; ?>>Land Category</option>
							<option value="Land Name" <?php if ($searchby == "Land Name") echo "selected = 'selected'"; ?>>Land Name</option>
							<option value="Nature of Land" <?php if ($searchby == "Nature of Land") echo "selected = 'selected'"; ?>>Nature of Land</option>
							<option value="Plan Number" <?php if ($searchby == "Plan Number") echo "selected = 'selected'"; ?>>Plan Number</option>
							<option value="Province"  <?php if ($searchby == "Province") echo "selected = 'selected'"; ?>>Province</option>
							<option value="Register Number" <?php if ($searchby == "Register Number") echo "selected = 'selected'"; ?>>Register Number</option>
                            <option value="Remarks" <?php if ($searchby == "Remarks") echo "selected = 'selected'"; ?>>Remarks</option>
                            <option value="Title Deed Date" <?php if ($searchby == "Title Deed Date") echo "selected = 'selected'"; ?>>Title Deed Date</option>
                            <option value="Title Deed Number" <?php if ($searchby == "Title Deed Number") echo "selected = 'selected'"; ?>>Title Deed Number</option>
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
                <tr>
                    <td>
                    </td>
                    <td><b><?php echo $tList[20][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                    </td>
                    <td>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
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
            <h2>Lands Details List</h2>
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
                                            <th><nobr>Category Name</nobr></th>
                                            <th><nobr>District</nobr></th>
                                            <th><nobr>DS Division</nobr></th>
                                            <th><nobr>GS Division</nobr></th>
                                            <th><nobr>Deed Number</nobr></th>
                                            <th><nobr>Land Name</nobr></th>
                                            <th><nobr>Area(Hect)</nobr></th>
											<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Value</nobr></th>
                                            </tr>
											</thead>
											<tbody>
                                            <?php $i = 1; 
											$totvalue = 0;?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><nobr><a href="index.php?action=Inquiry_List_Details&identificationno=<?php echo $exp['identificationno']; ?>&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                    <td><nobr><?php echo $exp['category']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['deedno']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['landname']; ?></nobr></td>
                                                    <td align="right"><nobr><?php echo number_format($exp['area'], 2, '.', ','); ?></nobr></td>
													<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format($exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['acquisitiondate']; ?></nobr></td>
                                                    <td align="right"><nobr><?php echo number_format($exp['estimatedValue'], 2, '.', ','); ?></nobr></td>
                                                </tr>
                                                <?php $i++; 
												$totvalue = $totvalue + $exp['estimatedValue']; ?>
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
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
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
					 var doc = new jsPDF('l', 'pt', 'a3');
					doc.text("Land Details List", 30, 50);
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