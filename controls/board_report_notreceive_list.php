<?php include 'header5.php';?>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Board Report Not Receive List</h2>
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
												<th><nobr>Assets Center</nobr></th>
												<th><nobr>Assets Unit</nobr></th>
												<th><nobr>Protocol 1</nobr></th>
                                                <th><nobr>Protocol 2</nobr></th>
												<th><nobr>Address</nobr></th>
												<th><nobr>Telephone No</nobr></th>
                                                <th><nobr>E-Mail Address</nobr></th>                                               
                                                </tr>
											</thead>
											<tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['centreName']; ?></nobr></td>
														<td><nobr><?php echo $exp['unitName']; ?></nobr></td>
														<td><nobr><?php echo $exp['protocoltext1']; ?></nobr></td>
														<td><nobr><?php echo $exp['protocoltext2']; ?></nobr></td>	
														<td><nobr><?php echo $exp['address']; ?></nobr></td>
														<td><nobr><?php echo $exp['telephone']; ?></nobr></td>
                                                        <td><nobr><?php echo $exp['email']; ?></nobr></td>                                                        
                                                    </tr>
                                                    <?php $i++; 
													 } ?> 
                                                </tbody>
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
					doc.text("Board Report Not Receive List", 30, 50);
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