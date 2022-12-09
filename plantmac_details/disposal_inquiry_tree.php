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
			widgets        : ['zebra', 'stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
}); 
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Disposal Details - <?php echo $unit ?>
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
        <div class="section_content">                                     
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead> 
											<tr> 
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th>Disposed Date</th>
											<th>Approved-DAM</th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No</nobr></th>
                                            <th><nobr>Catalogue No</nobr></th>
                                            <th><nobr>Serial No.</nobr></th> 
                                            <th><nobr>DOP</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Unit Value</nobr></th>
                                             </tr>
											 </thead> <tbody> 
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($exps as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><a href="index.php?action=DisposalList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['disposedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo substr($exp['ApprovedDisposalDate'],0,10); ?></nobr></td>
																<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
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
												<td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot>														
														</table>
                                                       
                                                  
														<form action = "index.php" method = "post">
															<input type="hidden" name="action" value="Disposal_List_csv" />
															<input type="submit" name="csv" value="Convert to CSV" />
														</form>                                                        
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
        </div>
    </div>
</div>

<div id="sidebar">
    <div class="inner">
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
					<h2><?php echo $slideBar[1][$lang] ?></h2>
					<span class="title_wrapper_left"></span>
					<span class="title_wrapper_right"></span>                            
                </div>
                <div class="section_content">	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=disposal_inquiry_tree&type=1">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><a href="index.php?action=disposal_inquiry_tree&type=3&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=disposal_inquiry_tree&type=4&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=disposal_inquiry_tree&type=4&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><a href="index.php?action=disposal_inquiry_tree&type=2&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=disposal_inquiry_tree&type=4&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=disposal_inquiry_tree&type=4&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
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
                </div>
            </div>
        </div>
        <?php include '../view/quick_info.php'; ?>
		<P>

	</P>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>










