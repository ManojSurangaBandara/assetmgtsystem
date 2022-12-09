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
			widgets        : ['stickyHeaders', "filter", 'cssStickyHeaders'],
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
									<h2>Allocation(Scale) and Present Status</h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
								<?php if (isset($alocation_table)) {
										include $alocation_table; }?>
							</div>
						</div>
                    </div>
                </div>
            </div>					
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
							<h2>Asset Items List</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>       
                </div>
        <div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span><a href="index.php?action=allocation_list_item&type=1">Office Equipments</a></span>
                <ul>
                    <?php 
					$i=0;
					$j = 0;
					$tem = "";
					$tem2 = "";
					foreach ($items1 as $exp) { 
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
						<span><a href="index.php?action=allocation_list_item&mainCategory=<?php echo $exp['mainCategory']; ?>" title="<?php echo $exp['mainCategory']; ?>"><?php echo $exp['mainCategory']; ?></a></span>
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
                            <li id="3" data-options="state:'closed'"><span><a href="index.php?action=allocation_list_item&itemCategory=<?php echo $exp['itemCategory']; ?>" title="<?php echo $exp['itemCategory']; ?>"><?php echo $exp['itemCategory']; ?></a></span>
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="4"><a href="index.php?action=allocation_list_item&catalogueno=<?php echo $exp['catalogueno']; ?>" title="<?php echo $exp['itemDescription']; ?>"><?php echo $exp['itemDescription']; ?></a></li>
                        </ul>   
						<?php   
					   $i++;
					} ?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
	<div class="easyui-panel" style="padding:5px">
        <ul id="tt2" class="easyui-tree">
            <li>
                <span><a href="index.php?action=allocation_list_item&type=2">Plant & Machinery</a></span>
                <ul>
                    <?php 
					$i=0;
					$j = 0;
					$tem = "";
					$tem2 = "";
					foreach ($items2 as $exp) { 
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
						<span><a href="index.php?action=allocation_list_item&mainCategory=<?php echo $exp['mainCategory']; ?>" title="<?php echo $exp['mainCategory']; ?>"><?php echo $exp['mainCategory']; ?></a></span>
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
							<li id="3" data-options="state:'closed'"><span><a href="index.php?action=allocation_list_item&itemCategory=<?php echo $exp['itemCategory']; ?>" title="<?php echo $exp['itemCategory']; ?>"><?php echo $exp['itemCategory']; ?></a></span>
                       <?php 
					   $tem2 = $exp['itemCategory'];
					   } ?>
						<ul>
                            <li id="4"><a href="index.php?action=allocation_list_item&catalogueno=<?php echo $exp['catalogueno']; ?>" title="<?php echo $exp['itemDescription']; ?>"><?php echo $exp['itemDescription']; ?></a></li>
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
 </div>
<?php
include '../view/footer.php';
?>