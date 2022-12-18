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
/* $('#tt').tree({
	onClick: function(node){
		    			alert(node.id);
	}
}) */;
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
<div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter">
                                             <thead>
											 <tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category</nobr></th>
                                            <th><nobr>Description</nobr></th>
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
                                                        <?php foreach ($exps as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=np_tree_list_2_1&id=10&identificationno=<?php echo $exp['identificationno']; ?>"><?php echo $exp['identificationno']; ?></a></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
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
												  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot></table>
                                                        </div>
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
					var doc = new jsPDF('l', 'pt', 'a3');
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