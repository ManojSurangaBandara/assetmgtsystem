<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<script>	
$(document).ready(function() {
		$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
});
</script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Lands Details Update Review</h2>
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

                                    <div class="table_wrapper_inner">
                                        <table id="myTable" class="tablesorter">
                                            <thead>											
											<tr>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Assets Unit</nobr></th>
                                            <th><nobr>Identification No.</nobr></th>
											<th><nobr>Category Name</nobr></th>
                                            <th><nobr>Add Date & Time</nobr></th>
                                            <th><nobr>Confirmed  Date & Time</nobr></th>
											<th><nobr>Viewed - DAM</nobr></th>
											<th><nobr>DAM Comment</nobr></th>
                                            </tr>
											</thead>
											<tbody> 
                                            <?php $i = 1; ?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr>
                                                    <td><nobr><?php echo $i; ?></nobr></td>
													<td></nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                    <td></nobr><?php echo $exp['identificationno'];?></nobr></td>
													<td><nobr><?php echo $exp['category']; ?></nobr></td>
                                                    <td></nobr><?php echo $exp['sysdate']; ?></nobr></td>
                                                    <td></nobr><?php echo $exp['apprivedDate']; ?></nobr></td> 
														<?php if ($exp['view'] = 1) {
														    $view = $exp['viewdate']." - ".$exp['viewperson'];
															} else {
															$view = "";
															}
														?>
													<td></nobr><?php echo $view; ?></nobr></td>
													<td></nobr><?php echo $exp['damcomment']; ?></nobr></td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php } ?> 
                                            </tbody></table>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>