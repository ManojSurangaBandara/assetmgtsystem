<?php
include 'header1.php';
?>
<script>
    jQuery(document).ready(function () {
       $(".date").datepicker({ 
	   dateFormat: 'yy-mm-dd',
		onSelect: function(date) {
            currentYear = $("#currentYear").val();
			var  year = date.substring(0, 4);
			if (year!==currentYear){
			alert("ඔබ තෝරාගන්නා වර්ෂය වනුයේ  - "+currentYear);
			}
        } });
/* 		$('.date').datepicker({
            format: 'yyyy-mm-dd'
        }).on('changeDate', function (e) {
            $(this).datepicker('hide');
        }); */
    });
</script>
<script>
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	var disposedDate = formatDate($('#disposedDate_'+id).prop('value'));
	var disposedReason = $('#disposedReason_'+id).prop('value');
	var condemnation = $('#condemnation_'+id).prop('value');
	var querystring = {
			id: id,
			disposedDate: disposedDate, 
			disposedReason: disposedReason,
			condemnation: condemnation,			
			action: 'disposal_details_save_quick'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//if (result == '1') {
		$("#"+id).prop('value', '-Saved-'); 
		$("#"+id).hide();
		//}
		//alert(result);
		} 	
return false
});	
$(".text, .date").change(function() { 
	var fields = $(this).attr('id').split('_');
	var id = fields[1];
	var disposedDate = $('#disposedDate_'+id).prop('value');
	var currentYear = $("#currentYear").val();
	var year = disposedDate.substring(0, 4);	
	if (year==currentYear){
		$("#"+id).prop('value', 'Save');
		$("#"+id).show();
	}
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
            <h2>Select Disposals Details - Office Equipments (Quick)</h2>
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
											<th><nobr>Save</nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                             <tr>
													<td><form name="add_form" id="add_form" class="add_form" action="index.php" method="post"></td>
													<td style="text-align:right" colspan="3">
													<input type="hidden" name="action" id="action" value="add_disposal_details_quick" />
													<input type="hidden" name="currentYear" id="currentYear" value="<?php echo $currentYear; ?>" />
													<input class = "save" id = "save_all" name="save_all" type="submit" value="Save to All" onclick="return confirm('Are you sure?')" style="color: white; background-color: #008CBA;"/></td>
													<td><input type='text' class="date" id="disposedDate" name="disposedDate" value="" style="width:90px;"/></td>
													<td><input type='text' class="text" id="disposedReason" name="disposedReason" value="" style="width:250px; text-transform: uppercase;"/></td>
													<td><input type='text' class="text" id="condemnation" name="condemnation" value="" style="width:250px; text-transform: uppercase;"/></td>
													<td></form></td>
												</tr>    
												<?php $i = 1; 
                                                foreach ($items as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><a href="index.php?action=Selected_Items_For_Disposal&id=<?php echo $exp['id']; ?>&quick=1"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>                                                                
                                                                <td><?php echo $exp['itemDescription']; ?></td>                                                                 
                                                                <td><?php echo $exp['eqptSriNo']; ?></td>
																<td><input type='text' class="date" id="disposedDate_<?php echo $exp['id']; ?>" name="disposedDate_<?php echo $exp['id']; ?>" value="<?php echo $exp['disposedDate']; ?>" style="width:90px;"/></td>
                                                                <td><input type='text' class="text" id="disposedReason_<?php echo $exp['id']; ?>" name="disposedReason_<?php echo $exp['id']; ?>" value="<?php echo $exp['disposedReason']; ?>" style="width:250px; text-transform: uppercase;"/></td>
																<td><input type='text' class="text" id="condemnation_<?php echo $exp['id']; ?>" name="condemnation_<?php echo $exp['id']; ?>" value="<?php echo $exp['condemnation']; ?>" style="width:250px; text-transform: uppercase;"/></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
																<input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save" style="color: white; background-color: #008CBA;" hidden/> 
																</form></nobr></td>
																
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