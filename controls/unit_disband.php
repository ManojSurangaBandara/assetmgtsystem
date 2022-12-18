<?php include 'header2.php'; ?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['zebra', 'stickyHeaders', 'cssStickyHeaders'],
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
									<h2>Plant & Machinery Details List - <?php echo $unit; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
									<table id="abc" class="tablesorter"> 
										<thead> 
										<tr> 
											<th>S/N</th>  
											<th><nobr>Main Category</nobr></th> 
											<th><nobr>Item Category</nobr></th> 
											<th><nobr>Item Description</nobr></th> 
											<th><nobr>Asst. No.</nobr></th> 
											<th><nobr>Classi. No</nobr></th> 
											<th><nobr>Quantity</nobr></th> 
											<th><nobr>Value</nobr></th> 
										</tr> 
										</thead> 
										<tbody> 
											<?php $i = 1;
											$totqty = 0; 
											$totvalue = 0;?>
											<?php foreach ($expsPlant as $exp) { ?>		
											<tr> 
												<td><nobr><?php echo $i; ?></nobr></td>
												<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
												<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
												<td><nobr><?php echo substr($exp['itemDescription'],0,40); ?></nobr></td>
												<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
												<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
												<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
												<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
											</tr> 
											 <?php $i++; 
											 $totqty = $totqty + $exp['cnt']; 
											 $totvalue = $totvalue + $exp['tot']; ?>
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
											<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
											  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
										</tr>
								  </tfoot> 
								</table>
								<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							</div>
						</div>
                    </div>
                </div>
            </div>			
            						
        </div>
    </div>
<div class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">  
								<div class="title_wrapper">
									<h2>Office Equipments List -  <?php echo $unit; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
									<table id="abc" class="tablesorter"> 
										<thead> 
										<tr> 
											<th>S/N</th>  
											<th><nobr>Main Category</nobr></th> 
											<th><nobr>Item Category</nobr></th> 
											<th><nobr>Item Description</nobr></th> 
											<th><nobr>Asst. No.</nobr></th> 
											<th><nobr>Classi. No</nobr></th> 
											<th><nobr>Quantity</nobr></th> 
											<th><nobr>Value</nobr></th> 
										</tr> 
										</thead> 
										<tbody> 
											<?php $i = 1;
											$totqty = 0; 
											$totvalue = 0;?>
											<?php foreach ($expsOffice as $exp) { ?>		
											<tr> 
												<td><nobr><?php echo $i; ?></nobr></td>
												<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
												<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
												<td><nobr><?php echo substr($exp['itemDescription'],0,40); ?></nobr></td>
												<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
												<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
												<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
												<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
											</tr> 
											 <?php $i++; 
											 $totqty = $totqty + $exp['cnt']; 
											 $totvalue = $totvalue + $exp['tot']; ?>
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
											<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
											  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
										</tr>
								  </tfoot> 
								</table>
								<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							</div>
						</div>
                    </div>
                </div>
            </div>									
        </div>
    </div>
<div hidden class="section table_section">
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">  
								<div class="title_wrapper">
									<h2>Vehicle Details List -  <?php echo $unit; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
									<table id="abc" class="tablesorter"> 
										<thead> 
										<tr> 
											<th>S/N</th>  
											<th><nobr>Main Category</nobr></th> 
											<th><nobr>Item Category</nobr></th> 
											<th><nobr>Item Description</nobr></th> 
											<th><nobr>Asst. No.</nobr></th> 
											<th><nobr>Classi. No</nobr></th> 
											<th><nobr>Quantity</nobr></th> 
											<th><nobr>Value</nobr></th> 
										</tr> 
										</thead> 
										<tbody> 
											<?php $i = 1;
											$totqty = 0; 
											$totvalue = 0;?>
											<?php foreach ($expsVehicle as $exp) { ?>		
											<tr> 
												<td><nobr><?php echo $i; ?></nobr></td>
												<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
												<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
												<td><nobr><?php echo substr($exp['itemDescription'],0,40); ?></nobr></td>
												<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
												<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
												<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
												<td style="text-align:right"><nobr><?php echo number_format((float)$exp['tot'], 2, '.', ','); ?></nobr></td>	
											</tr> 
											 <?php $i++; 
											 $totqty = $totqty + $exp['cnt']; 
											 $totvalue = $totvalue + $exp['tot']; ?>
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
											<td align="right"><?php echo number_format((float)$totqty, 0, '.', ','); ?></td>	
											  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
										</tr>
								  </tfoot> 
								</table>
								<span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>
							</div>
						</div>
                    </div>
                </div>
            </div>									
        </div>
    </div>
	<form name="add_form" id="add_form" class="add_form" action="." method="post">									
		<input type="hidden" name="action" id="action" value="unit_disband"/>
		<input type="hidden" name="unit" id="unit" value="<?php echo $unit; ?>"/>
		<input class = "savebttn" id = "disband_all" name="disband_all" type="submit" value="Disband All" onclick="if (!confirm('Are you sure? Disband this Unit.')) { return false }"/>
	</form>
    </div>
</div>

<div id="sidebar">
    <div class="inner">
        <div class="section">
            <div class="section">
                <div class="title_wrapper">
					<h2>Unit Disband</h2>
					<span class="title_wrapper_left"></span>
					<span class="title_wrapper_right"></span>                            
                </div>
                <div class="section_content">	
    <div class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span>Sri Lanka Army</span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li data-options="state:'closed'" id="2">                        
						<span><?php echo $exp['protocoltext2']; ?></span>
						<ul>
                            <li><a href="index.php?action=unit_disband&type=4&unit=<?php echo $exp['unitName']; ?>" onclick="return confirm('Are you sure ? You Want to Disband This Unit.')"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=unit_disband&type=4&unit=<?php echo $exp['unitName']; ?>" onclick="return confirm('Are you sure ? You Want to Disband This Unit.')"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li data-options="state:'closed'" id="3">                        
						<span><?php echo $exp['protocoltext1']; ?></span>
						<ul>
                            <li><a href="index.php?action=unit_disband&type=4&unit=<?php echo $exp['unitName']; ?>" onclick="return confirm('Are you sure ? You Want to Disband This Unit.')"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li><a href="index.php?action=unit_disband&type=4&unit=<?php echo $exp['unitName']; ?>" onclick="return confirm('Are you sure ? You Want to Disband This Unit.')"><?php echo $exp['unitName']; ?></a></li>
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










