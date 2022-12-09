<?php	
	include '../view/header2.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
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
$("#submit").click(
            function (e) {
			   var querystring = {	
					groupId: $('#groupId').val(),
					action: 'viewDAM',
					damcomment: $('#damcomment').val()
					}    
		$.post('index.php', querystring, processResponse);
							function processResponse(result) {						
													} // end processData		
			   e.preventDefault();
            }            
        );
		$('#damcomment').keyup(function(){
			this.value = this.value.toUpperCase();
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
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                         <input type="hidden" name="action" value="approveSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="groupId" id="groupId" value="<?php echo $groupId; ?>" />
                                        <table width="100%" id="abc" border="1">
													<tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>
                                                        <td width="70%"><?php echo $assetscenter; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
                                                        <td width="70%"><?php echo $assetunit; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>
                                                        <td width="70%"><?php echo $itemCategory; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%"><?php echo $mainCategory; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%"><?php echo $itemDescription; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%"><?php echo $catalogueno; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%"><?php echo $assetsno; ?>-<?php echo $newAssestno; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%"><?php echo $identificationno; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%"><?php echo $ledgerno; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%"><?php echo $ledgerFoliono; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%"><?php echo $eqptSriNo; ?></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%"><?php echo $purchasedDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>group - <?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%"><?php echo $quantity; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%"><?php echo $capacity; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><?php echo $unitValue; ?></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%"><?php echo $receivedDate; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%"><?php echo $Remarks; ?></td>
                                                    </tr>
													<?php 
                                                          if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 5) { 
														   ?>
													<tr>
                                                        <td width="30%"><label>DAM Comment :</label></td>
                                                        <<td width="70%"><input type="text" class="text" name="damcomment"  id="damcomment" value="<?php echo isset($damcomment) ? $damcomment : "";?>" style="width:600px; background-color:white; color: black">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>                                                          
														   <input type="submit" name="submit" id="submit" value="Viewed by DAM">								
														</td>
                                                    </tr>
													<?php }	
                                                        ?> 
										</table>
                                    </form>
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
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span><a href="index.php?action=List_summary_tree_2&id=1">Plant & Machinery</a></span>
                <ul>
                    <?php 
					$i=0;
					$j = 0;
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($tem <> $exp['mainCategory']) { 
					 if ($j<>0){
						 $j++;
						?> 
						</li>
						</ul>						
					 <?php }
					  $j++;
					 ?>	
					<li id="2" data-options="state:'closed'">                        
						<span><a href="index.php?action=List_summary_tree_2&id=2&unit=<?php echo $exp['mainCategory']; ?>"><?php echo $exp['mainCategory']; ?></a></span>
						<?php 
					   $tem = $exp['mainCategory'];
					   $i=0;
					   } 
						if ($tem2 <> $exp['itemCategory']) { 
						if ($i<>0) { ?>
							</li>
							</ul>
						 <?php
						}
						?>
						<ul>
                            <li id="3" data-options="state:'closed'"><span><a href="index.php?action=List_summary_tree_2&id=3&unit=<?php echo $exp['itemCategory']; ?>"><?php echo $exp['itemCategory']; ?></a></span>
                        
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="4"><a href="index.php?action=List_summary_tree_2&id=4&unit=<?php echo $exp['itemDescription']; ?>"><?php echo $exp['itemDescription']; ?></a></li>
                        </ul>   
						<?php   
					   $i++;
					} ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
                </div>
            </div>
        </div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>