<?php include 'header5.php'; ?>
<script>
	document.getElementById("wrap").addEventListener("scroll",function(){
   var translate = "translate(0,"+this.scrollTop+"px)";
   this.querySelector("thead").style.transform = translate;
	});
</script>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]." - ".$category." as at ".$acquisitiondate?></h2>
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
                                        <div id="wrap">
										<table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
                                                <th><nobr>S/N</nobr></th>
												<th><nobr>Assets Unit</nobr></th>
												<th><nobr>Identification No</nobr></th>
                                                <th><nobr>Category Name</nobr></th>
												<th><nobr>Assets No</nobr></th>
												<th><nobr>Classification No</nobr></th>
                                                <th><nobr>District</nobr></th>
                                                <th><nobr>DS Division</nobr></th>
                                                <th><nobr>GS Division</nobr></th>
												<th><nobr>Land Registration Number/Date</nobr></th>
												<th><nobr>Land Name</nobr></th>
												<th><nobr>Nature of the Ownership</nobr></th>
												<th><nobr>Plan Number</nobr></th>
                                                <th><nobr>Deed Number</nobr></th>
                                                <th><nobr>Area(Hect)</nobr></th>
												<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                                <th><nobr>Acqu. Date</nobr></th>
                                                <th><nobr>Value</nobr></th>
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                        <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>&slidebartype=31&category=<?php echo $category;?>&acquisitiondate=<?php echo $acquisitiondate;?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                        <td><nobr><?php echo $exp['category']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
														<td><nobr><?php echo $exp['classificationno']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
														<td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>	
                                                        <td><nobr><?php echo $exp['register']; ?></nobr></td>
														<td><nobr><?php echo $exp['landname']; ?></nobr></td>
														<td><nobr><?php echo $exp['natureOwnership']; ?></nobr></td>
														<td><nobr><?php echo $exp['planno']; ?></nobr></td>																											
                                                        <td><nobr><?php echo $exp['deedno']; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo number_format($exp['area'], 2, '.', ','); ?></nobr></td>
														<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format($exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                        <td align="right"><nobr><?php echo $exp['acquisitiondate']; ?></nobr></td>
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
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('l', 'pt', 'a1');
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