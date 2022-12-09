<?php	
	include 'header1.php';
?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
	$('#submit').click(function(){
	   $(this).prop('hidden', true);
	});
});
</script>
<div id="page">
	<div class="section">
		<div class="title_wrapper">
			<h2>Board Report Download - <?php echo $currentYear ?></h2>
			<span class="title_wrapper_left"></span>
			<span class="title_wrapper_right"></span>
		</div>
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">						    
						    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Click Download Button to get Board Report</strong></li>
                                                <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
													<input type="hidden" name="action" value="board_report" />									
													<div><input type="<?php echo ($error == 0 ? "submit" : "")?>" name="submit" id="submit" value="Download Board Report"></div>										
												</form>
												<?php
                                                break;
                                            case '1':
                                                ?>                                                
												<li class="red"><span class="ico"></span><strong class="system_title"><font size="4">මෙම වර්ෂය සඳහා Board Report බාගත කර ඇත.  එය බලා ගැනීම සඳහා "View Board Report" බොත්තම click කරන්න. තවත් බාගත කිරීමක් අවශ්‍යනම් වකඅම අමතන්න.</font></strong></li>
                                                <?php
                                                break;
                                         } ?>
                                    </ul>
									
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	                <div class="title_wrapper">
                <h2>
                    Board Report Details
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
				<table cellpadding="0" cellspacing="0" width="100%" >
				<tbody><tr>
					<th>S No.</th>
					<th>Year</th>
					<th>Board Report</th>
					<th>Disposal Report</th>
					<th>New Items Report</th>
					<th>Report Summary</th>
					<th>Transaction Summary</th>
					<th>Download Date Time</th>
					<th>DAM Received Date</th>
					<th>Observations</th>
					<th>Relevent Letters</th>
				</tr>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['cyear']; ?></td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo $exp['vehicle_path']; ?>#toolbar=0" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_des.pdf",$exp['vehicle_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td>
					<?php if ($exp['vehicle_path'] <> "") { ?>
						<button><a href="<?php echo str_replace(".pdf","_new.pdf",$exp['vehicle_path']); ?>" target="_blank">View</a></button>
					<?php } ?>
					</td>
					<td><button><a href="index.php?action=board_report_summary_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>
					<td><button><a href="index.php?action=board_report_summary_view_trans&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>
					<td><?php echo $exp['vehicle_date']; ?></td>
					<td><?php echo $exp['received_date']; ?></td>
					<td><button><a href="index.php?action=board_report_ob_view&cyear=<?php echo $exp['cyear'];?>&assetunit=<?php echo $exp['assetunit'];?>&itemtype=vehicle"><font color="DarkBlue">View</a></button></td>					
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>