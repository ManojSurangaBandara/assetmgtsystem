<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
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
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var ver_brd_app = $('#ver_brd_app_'+id).val();
	var ver_brd_rec = $('#ver_brd_rec_'+id).val();
	var ver_brd_rej1 = $('#ver_brd_rej1_'+id).val();
	var ver_brd_rej_rec1 = $('#ver_brd_rej_rec1_'+id).val();
	var ver_brd_rej2 = $('#ver_brd_rej2_'+id).val();
	var ver_brd_rej_rec2 = $('#ver_brd_rej_rec2_'+id).val();
	var ver_brd_rej3 = $('#ver_brd_rej3_'+id).val();
	var ver_brd_rej_rec3 = $('#ver_brd_rej_rec3_'+id).val();
	var ver_brd_approved = $('#ver_brd_approved_'+id).val();
	var querystring = {
			id: id,
			ver_brd_app: ver_brd_app,
			ver_brd_rec: ver_brd_rec,
			ver_brd_rej1: ver_brd_rej1,
			ver_brd_rej_rec1: ver_brd_rej_rec1,
			ver_brd_rej2: ver_brd_rej2,
			ver_brd_rej_rec2: ver_brd_rej_rec2,
			ver_brd_rej3: ver_brd_rej3,
			ver_brd_rej_rec3: ver_brd_rej_rec3,
			ver_brd_approved: ver_brd_approved,
			action: 'save_ver_rpt'
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
			sortRestart    : true,
			theam		:	'blue'
		});
}); 
</script>
<style>
input[type="text"] {
     width: 100%; 
     box-sizing: border-box;
     -webkit-box-sizing:border-box;
     -moz-box-sizing: border-box;
}
</style>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Add verification Board - <?php echo $survayyear?></h2>
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
										<table  id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
													<td>S/No</td>
													<td>Assets Center</td>
													<td>Assets Unit</td>
													<td>Appoint</td>
													<td>Rpt. Received</td>
													<td>Rpt. Rejected - 1 </td>
													<td>Rej. Rpt. Received - 1</td>
													<td>Rpt. Rejected - 2 </td>
													<td>Rej. Rpt. Received - 2</td>
													<td>Rpt. Rejected - 3 </td>
													<td>Rej. Rpt. Received - 3</td>
													<td>Approved</td>
													<td>Save</td>
												</tr>
											</thead>
											<tbody>
											<?php $i = 1; 
                                                foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetscenter']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>                                                        
														<form name="add_form" id="add_form" class="add_form" action="." method="post">
															<td><input type="text" name="ver_brd_app_<?php echo $exp['id']; ?>" id="ver_brd_app_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_app = ($exp['ver_brd_app'] == '0000-00-00') ? '' : $exp['ver_brd_app'];?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rec_<?php echo $exp['id']; ?>" id="ver_brd_rec_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rec = ($exp['ver_brd_rec'] == '0000-00-00') ? '' : $exp['ver_brd_rec']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej1_<?php echo $exp['id']; ?>" id="ver_brd_rej1_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej1 = ($exp['ver_brd_rej1'] == '0000-00-00') ? '' : $exp['ver_brd_rej1']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej_rec1_<?php echo $exp['id']; ?>" id="ver_brd_rej_rec1_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej_rec1 = ($exp['ver_brd_rej_rec1'] == '0000-00-00') ? '' : $exp['ver_brd_rej_rec1']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej2_<?php echo $exp['id']; ?>" id="ver_brd_rej2_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej2 = ($exp['ver_brd_rej2'] == '0000-00-00') ? '' : $exp['ver_brd_rej2']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej_rec2_<?php echo $exp['id']; ?>" id="ver_brd_rej_rec2_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej_rec2 = ($exp['ver_brd_rej_rec2'] == '0000-00-00') ? '' : $exp['ver_brd_rej_rec2']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej3_<?php echo $exp['id']; ?>" id="ver_brd_rej3_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej3 = ($exp['ver_brd_rej3'] == '0000-00-00') ? '' : $exp['ver_brd_rej3']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_rej_rec3_<?php echo $exp['id']; ?>" id="ver_brd_rej_rec3_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_rej_rec3 = ($exp['ver_brd_rej_rec3'] == '0000-00-00') ? '' : $exp['ver_brd_rej_rec3']; ?>" class="date" style="width:75px"></td>
															<td><input type="text" name="ver_brd_approved_<?php echo $exp['id']; ?>" id="ver_brd_approved_<?php echo $exp['id']; ?>" value="<?php echo $ver_brd_approved = ($exp['ver_brd_approved'] == '0000-00-00') ? '' : $exp['ver_brd_approved']; ?>" class="date" style="width:75px"></td>
															<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
														</form>														
                                                    </tr>
                                                <?php $i++; } ?> 	
											</tbody>
										</table>
                                        </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
				<form action="index.php">
					<input type="hidden" name="action" value="update_units" />
					<input type="submit" value="Update Units" />
				</form>
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
					var doc = new jsPDF('l', 'pt', 'a1');
					doc.text("Land Details List", 30, 50);
					var res = doc.autoTableHtmlToJson(document.getElementById("abc"));
					doc.autoTable(res.columns, res.data, {startY: 60});
					doc.save("table.pdf");
				}
			</script>					
        </div>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>