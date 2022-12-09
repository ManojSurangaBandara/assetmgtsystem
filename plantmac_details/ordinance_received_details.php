<?php	
	include '../view/header1.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
<script>	
$(document).ready(function () {
	$('table').tablesorter({
			widgets        : ['stickyHeaders', "filter"],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
    $('.confirmation').on('click', function () {
        return confirm('Are you sure, You Want to Delete Receving Details ?');
    });		
	}); 
</script>
<div id="page">
<div class="inner">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $title ?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
	<div class="section">
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
											<th><nobr>Received Date</nobr></th>
											<th><nobr>Send From Unit</nobr></th>
                                            <th><nobr><?php echo $tList[18][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[2][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[5][$lang]?></nobr></th>                                            
                                            <th><nobr><?php echo $tList[9][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[10][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[13][$lang]?></nobr></th>
											<?php if(substr($_SESSION['SESS_LOGIN'], -2) == "of") { ?>
											<th><nobr>Remove Receving</nobr></th>
											 <?php } ?>
											 </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($exps as $exp) { ?>																
                                                    <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo $exp['ordinance_receive_date']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['ordinance_send_date']; ?></nobr></td>
																<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                 <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>																
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
																 <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
																<?php if(substr($_SESSION['SESS_LOGIN'], -2) == "of") { ?>
																<th  align="center"><nobr><a href="index.php?action=ordinance_received_details&delete=delete&id=<?php echo $id; ?>&unit=<?php echo $unit; ?>&tid=<?php echo $exp['id']; ?>" class="confirmation">Remove Receving</a></nobr></th>
																 <?php } ?>																
                                                                </tr>
																<?php $i++; 
													      $totvalue = $totvalue + $exp['unitValue']; ?>
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
							<h2>Summary List</h2>
                            <span class="title_wrapper_left"></span>
                            <span class="title_wrapper_right"></span>       
                </div>

    <div  class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=ordinance_received_details&id=4&unit=All Units">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li id="2" data-options="state:'closed'">                        
						<span><a href="index.php?action=ordinance_received_details&id=3&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li><a href="index.php?action=ordinance_received_details&id=1&unit=<?php echo $exp['unitName']; ?>" title="<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
							<li><a href="index.php?action=ordinance_received_details&id=1&unit=<?php echo $exp['unitName']; ?>" title="<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li id="5" data-options="state:'closed'">                        
						<span><a href="index.php?action=ordinance_received_details&id=2&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
							<li><a href="index.php?action=ordinance_received_details&id=1&unit=<?php echo $exp['unitName']; ?>" title="<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
							<li><a href="index.php?action=ordinance_received_details&id=1&unit=<?php echo $exp['unitName']; ?>" title="<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
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
<?php
//include('sidebar.php');
include '../view/footer.php';
?>