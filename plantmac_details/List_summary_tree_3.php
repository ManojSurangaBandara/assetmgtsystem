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
		<table id="abc" class="tablesorter"> 
<thead> 
<tr> 
    <th>S/N</th>  
    <th><nobr><?php echo $tList[1][$lang]?></nobr></th> 
    <th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
	<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
	<th><nobr>Asst. No.</nobr></th> 
	<th><nobr>Classi. No</nobr></th> 
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
<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>	
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><nobr><?php echo substr($exp['itemDescription'],0,40); ?></nobr></td>
<td><nobr><?php echo $exp['assetsno']; ?></a></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
<td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
<td align="right"><nobr><?php echo number_format((float)$exp['unitValue'], 2, '.', ','); ?></nobr></td>
</tr> 
 <?php $i++; 
 $totvalue = $totvalue + $exp['unitValue']; ?>
<?php } ?> 
</tbody>
	<tfoot>
	<tr>
	<td></td>
	<td>Total</td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>	
	  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
	</tr>
  </tfoot> 
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
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span><a href="#">Plant & Machinery</a></span>
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
						<span><a href="#"><?php echo $exp['mainCategory']; ?></a></span>
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
                            <li id="3" data-options="state:'closed'"><span><a href="index.php?action=List_summary_tree_3&id=3&unit=<?php echo $exp['itemCategory']; ?>"><?php echo $exp['itemCategory']; ?></a></span>
                        
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="4"><a href="index.php?action=List_summary_tree_3&id=4&unit=<?php echo $exp['itemDescription']; ?>"><?php echo $exp['itemDescription']; ?></a></li>
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