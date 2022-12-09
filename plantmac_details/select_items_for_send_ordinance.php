<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
$('.date').datepicker({dateFormat: 'yy-mm-dd',
maxDate: '0',
changeMonth : true,
changeYear: true});
var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate();
var output = d.getFullYear() + '-' +
(month<10 ? '0' : '') + month + '-' +
(day<10 ? '0' : '') + day;

$('.date').change(function() {  
	var arr = $(this).attr('id').split('_');
	var id = arr[3];
	if (Date.parse($(this).val())) {
		$('#Loss_'+id).prop('disabled', false);
	} else {
		$('#Loss_'+id).prop('disabled', true);
	}
} );

$("#abc").on('change', 'input:checkbox', function(){ 
   var arr = $(this).attr('id').split('_');
   var id = arr[1];
   var selectLoss = ($(this).prop('checked')) ? 1 : 0;
   	if (selectLoss == 1) {
		var ordinance_send_date = $('#ordinance_send_date_'+id).val();
		var ordinance = "<?php echo $ordinance; ?>";
	} else {
		var ordinance_send_date = "";
		var ordinance = "";		
	}
	var querystring = {
			id: id,
			ordinance_send_date: ordinance_send_date,
			ordinance: ordinance,
			selectLoss: selectLoss, 				 
			action: 'send_ordinance_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 	
return false
});
			$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter"],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
	}); 
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Select Lost & Damaged Details - Plant & Machinery</h2>
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
											<th><nobr>Send Date      &     Select</nobr></th>
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
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input type="text" name="ordinance_send_date_<?php echo $exp['id']; ?>" id="ordinance_send_date_<?php echo $exp['id']; ?>" value="<?php echo $ordinance_send_date = ($exp['ordinance_send_date'] == '0000-00-00') ? '' : $exp['ordinance_send_date'];?>" class="date" style="width:75px">
																<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>" <?php if($exp['select_send_ordinance']==1) echo "checked=checked"; ?> <?php if ($exp['ordinance_send_date'] == '0000-00-00'){ ?> disabled <?php   } ?>/></form></nobr></td>
                                                                <td><nobr><a href="index.php?action=add_loss_details&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
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
												<td></td>
												<td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
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
                                                            include '../view/footer.php';
                                                            ?>