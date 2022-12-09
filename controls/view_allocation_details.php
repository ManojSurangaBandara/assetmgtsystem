<?php include 'header2.php';?>
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
}); 
</script>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						        <div class="title_wrapper">
									<h2>Allocation (Scale) Details - <?php echo $title;?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
								<?php include $alocation_table;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<div id="sidebar">

                <div class="title_wrapper">
                            <h2>Allocation (Scale) Details</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>
                </div>
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=view_allocation_details">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><a href="index.php?action=view_allocation_details&type=reg&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=view_allocation_details&type=unit&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=view_allocation_details&type=unit&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><a href="index.php?action=view_allocation_details&type=reg&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=view_allocation_details&type=unit&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=view_allocation_details&type=unit&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					} }?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>				

                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>

        <?php include '../view/quick_info.php'; ?>
		<P>

	</P>
    </div>
</div>
<?php
include '../view/footer.php';
?>