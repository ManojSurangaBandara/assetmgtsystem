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
	        <form action="." method="post" id="view_update">
            <input type="hidden" name="action" value="view_updates_building"/>
            <table width="1009" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b>Asset Centre :</b>
                    </td>
                    <td>
                        <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <b>Asset Unit :</b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td>  
                        <input type="submit" value="Search" /> 
                    </td>
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Building Details Update Review</h2>
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
											<th><nobr>Building Category</nobr></th>
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
													<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
													<td><nobr><?php echo $exp['buildingCategory']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['sysdate']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['apprivedDate']; ?></nobr></td> 
														<?php if ($exp['view'] = 1) {
														    $view = $exp['viewdate']." - ".$exp['viewperson'];
															} else {
															$view = "";
															}
														?>
													<td><nobr><?php echo $view; ?></nobr></td>
													<td><nobr><?php echo $exp['damcomment']; ?></nobr></td>													
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