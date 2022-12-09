<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
$(".confirm").click(function(){
	var fields = $(this).attr('id').split('_');
	var id = fields[1];
	var querystring = {
			id: id,			
			action: 'ConfirmDisposalSave_quick'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		$("#c_"+id).prop('value', 'Confirmed');
		$("#tr_"+id).css("color", "red");
		//alert(result);
		} 	
return false
});	
$(".reject").click(function(){
 if(confirm("Are you sure you want to Reject this?")){
	var fields = $(this).attr('id').split('_');
	var id = fields[1];
	var querystring = {
			id: id,			
			action: 'ConfirmDisposalReject_quick'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		$("#tr_"+id).remove();
		//alert(result);
		}
 }
return false
});
	}); 
</script>
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
        <div class="title_wrapper">
            <h2>Comfirm Disposals Details - Plant & Machinery (Quick)</h2>
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
                                            <th><nobr><?php echo $tList[18][$lang]?></nobr></th>                                            
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>                                    
                                            <th><nobr><?php echo $tList[9][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[20][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[21][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[31][$lang]?></nobr></th>										
											<th><nobr>Confirm</nobr></th>
											<th><nobr>Reject</nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
                                                foreach ($items as $exp) { ?>																
                                                    <tr id = "tr_<?php echo $exp['id']; ?>" <?php echo ($exp['confirmDisposal'] == 1) ? "style='color:Red'" : "";?>>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><a href="index.php?action=confirm_Disposal&id=<?php echo $exp['id']; ?>&quick=1"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>                                                                
                                                                <td><?php echo $exp['itemDescription']; ?></td>                                                                 
                                                                <td><?php echo $exp['eqptSriNo']; ?></td>
																<td><?php echo $exp['disposedDate']; ?></td>
                                                                <td><?php echo $exp['disposedReason']; ?></td>
																<td><?php echo $exp['condemnation']; ?></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input class = "confirm" id = "c_<?php echo $exp['id']; ?>" name="submit" type="submit" value="<?php echo ($exp['confirmDisposal'] == 1) ? "Confirmed" : "Confirm";?>" style="color: white; background-color: #008CBA;"/></form></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input class = "reject" id = "r_<?php echo $exp['id']; ?>" name="submit" type="submit" value="Reject" style="color: white; background-color: #800000;"/></form></nobr></td>
																</tr>
																<?php $i++;?>
                                                <?php } ?> 
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