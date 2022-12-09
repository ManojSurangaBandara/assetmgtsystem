<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Board of Survey - Total List - <?php echo $survayyear?></h2>
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
										<div id="table-container">
										<table  id="maintable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
												<tr>
													<td rowspan="2">S/No</td>
													<td rowspan="2">Assets Center</td>
													<td rowspan="2">Assets Unit</td>
													<th colspan="5">Annual Verfication Board</th>
													<th colspan="5">Annual Condemnation Board</th>
													<th colspan="2">Annual Destruction Board</th>
												</tr>
												<tr>
													<th>Appoint</th>
													<th>Rpt. Received</th>
													<th>Rpt. Rejected</th>
													<th>Rej. Rpt. Received</th>
													<th>Approved</th>
													<th>Appoint</th>
													<th>Rpt. Received</th>
													<th>Rpt. Rejected</th>
													<th>Rej. Rpt. Received</th>
													<th>Approved</th>
													<th>Appoint</th>
													<th>Rpt. Received</th>
												</tr>
											</thead>
											<tbody>
											<?php $i = 1; 
                                                foreach ($items as $exp) { ?>																
                                                    <tr>
                                                        <td><nobr><?php echo $i; ?></nobr></td>
														<td><nobr><?php echo $exp['assetscenter']; ?></nobr></td>
														<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>                                                        
                                                        <td><nobr><?php echo $ver_brd_app = ($exp['ver_brd_app'] == '0000-00-00') ? '' : $exp['ver_brd_app']; ?></nobr></td>
														<td><nobr><?php echo $ver_brd_rec = ($exp['ver_brd_rec'] == '0000-00-00') ? '' : $exp['ver_brd_rec']; ?></nobr></td>
														<td><nobr><?php echo $ver_brd_rej1 = ($exp['ver_brd_rej1'] == '0000-00-00') ? '' : $exp['ver_brd_rej1']; ?></nobr></td>
                                                        <td><nobr><?php echo $ver_brd_rej_rec1 = ($exp['ver_brd_rej_rec1'] == '0000-00-00') ? '' : $exp['ver_brd_rej_rec1']; ?></nobr></td>
                                                        <td><nobr><?php echo $ver_brd_approved = ($exp['ver_brd_approved'] == '0000-00-00') ? '' : $exp['ver_brd_approved']; ?></nobr></td>
														<td><nobr><?php echo $con_brd_app = ($exp['con_brd_app'] == '0000-00-00') ? '' : $exp['con_brd_app']; ?></nobr></td>
														<td><nobr><?php echo $con_brd_rec = ($exp['con_brd_rec'] == '0000-00-00') ? '' : $exp['con_brd_rec']; ?></nobr></td>
														<td><nobr><?php echo $con_brd_rej1 = ($exp['con_brd_rej1'] == '0000-00-00') ? '' : $exp['con_brd_rej1']; ?></nobr></td>
                                                        <td><nobr><?php echo $con_brd_rej_rec1 = ($exp['con_brd_rej_rec1'] == '0000-00-00') ? '' : $exp['con_brd_rej_rec1']; ?></nobr></td>
                                                        <td><nobr><?php echo $con_brd_approved = ($exp['con_brd_approved'] == '0000-00-00') ? '' : $exp['con_brd_approved']; ?></nobr></td>
														<td><nobr><?php echo $des_brd_app = ($exp['des_brd_app'] == '0000-00-00') ? '' : $exp['des_brd_app']; ?></nobr></td>	
                                                        <td><nobr><?php echo $des_brd_rec = ($exp['des_brd_rec'] == '0000-00-00') ? '' : $exp['des_brd_rec']; ?></nobr></td>														
                                                    </tr>
                                                <?php $i++; } ?> 	
											</tbody>
										</table>
										<div id="bottom_anchor"></div>
</div>
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

<style>
body { height: 1000px; }
thead{
    background-color:white;
}
</style>
<script>
function moveScroll(){
    var scroll = $(window).scrollTop();
    var anchor_top = $("#maintable").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    if (scroll>anchor_top && scroll<anchor_bottom) {
    clone_table = $("#clone");
    if(clone_table.length == 0){
        clone_table = $("#maintable").clone();
        clone_table.attr('id', 'clone');
        clone_table.css({position:'fixed',
                 'pointer-events': 'none',
                 top:0});
        clone_table.width($("#maintable").width());
        $("#table-container").append(clone_table);
        $("#clone").css({visibility:'hidden'});
        $("#clone thead").css({'visibility':'visible','pointer-events':'auto'});
    }
    } else {
    $("#clone").remove();
    }
}
$(window).scroll(moveScroll); 
</script>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>