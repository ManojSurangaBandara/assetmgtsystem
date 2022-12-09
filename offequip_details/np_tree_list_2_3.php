<?php	
	include 'header2.php';
?>

<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
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
<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">  
								<div class="title_wrapper">
									<h2><?php echo $title; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
                                        <table width="100%" id="abc" border="1">
													<tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['assetscenter']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['assetunit']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['itemCategory']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['mainCategory']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%"><?php echo $PlantMac['itemDescription']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['catalogueno']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['assetsno']; ?>-<?php echo $PlantMac['newAssestno']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['identificationno']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['ledgerno']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['ledgerFoliono']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['eqptSriNo']; ?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['purchasedDate']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>group - <?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['quantity']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['capacity']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['unitValue']; ?></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['receivedDate']; ?></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Fund Type :</label></td>
                                                        <td width="70%"><?php echo ($PlantMac['fundtype'] == 1 ? 'NonPublic' : 'Public'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%"><?php echo $PlantMac['Remarks']; ?></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>DAM Comment :</label></td>
                                                        <td width="70%"><?php echo $PlantMac['damcomment'];?></td>
                                                    </tr>
										</table>
                    </div>
					  </div>
                    </div>
                </div>
            </div>			
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>	
			<iframe id="txtArea1" style="display:none"></iframe>
			<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
			<button onclick="generate()">Export to pdf</button>
			<script src="../jspdf/libs/jspdf.min.js"></script>
			<script src="../jspdf/libs/jspdf.plugin.autotable.src.js"></script>
			<script src="../jspdf/libs/json2.js"></script>
			<script>
				function generate() {
					var doc = new jsPDF('p', 'pt', 'a4');
					doc.text("<?php echo $title; ?>", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>			
        </div>
    </div>
  </div>
</div>

<div id="sidebar">
    <div class="inner">
        <p>&nbsp;</p>
        <div class="section">
            <div class="section">
                <div class="title_wrapper">                   
							<h2>Summary List</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>       
                </div>
				<?php include('np_easyui_panel.php');?>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>


<?php
//include('sidebar.php');
include '../view/footer.php';
?>