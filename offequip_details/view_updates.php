<?php
include 'header1.php';
?>
<script>
	$(function(){
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
            <input type="hidden" name="action" value="view_update"/>
            <table width="1009" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
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
                        <b><?php echo $tList[1][$lang]?></b>
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
            <h2>Office Equipments Update Review</h2>
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
                                        <table id="myTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                            <thead>
											
											<tr>
                                            <th>S/N</th>
											<th>Assets Unit</th>
                                            <th>Identification No.</th>
                                            <th>Add Date & Time</th>
                                            <th>Confirmed  Date & Time</th>
											<th>Viewed - DAM</th>
											<th>DAM Comment</th>
                                            </tr>
											</thead>
											<tbody> 
                                            <?php $i = 1; ?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr>
                                                    <td><?php echo $i; ?></td>
													<td><?php echo $exp['assetunit']; ?></td>
                                                    <td><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                    <td><?php echo $exp['sysdate']; ?></td>
                                                    <td><?php echo $exp['apprivedDate']; ?></td> 
														<?php if ($exp['view'] = 1) {
														    $view = $exp['viewdate']." - ".$exp['viewperson'];
															} else {
															$view = "";
															}
														?>
													<td><?php echo $view; ?></td>
													<td><?php echo $exp['damcomment']; ?></td>
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