<?php
include 'header1.php';
?>
<script>
	$(function(){
		$('table').tablesorter({
			widgets        : ['zebra', 'stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});
	</script>
<div id="page">
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	var querystring = {
			id: id,				 
			action: 'undo_Disposal_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		if (result == 1) {
		alert("Record Undo Complete");}
		} 	
return false
});	
	
	
	}); 
</script>
    <div class="section table_section">
        <form action="." method="post" id="undo_Disposal">
            <input type="hidden" name="action" value="undo_Disposal"/>
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
            <h2>Plant & Machinery Record Status</h2>
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
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Assets Unit</nobr></th>
                                            <th><nobr>Identification No.</nobr></th>
											<th><nobr>Description</nobr></th>                                            
											<th>select Disposal</th>
											<th>select Disposal Date</th>
											<th>confirm Disposal</th>
											<th>confirm DisposalDate</th>
											<th>Approved Disposal</th>
											<th>Approved DisposalDate</th>
											<th>Undo Disposal</th>
                                            </tr>
											</thead>
											<tbody> 
                                            <?php $i = 1; ?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr>
                                                    <td><nobr><?php echo $i; ?></nobr></td>
													<td><nobr><?php echo $exp['assetunit']; ?></td>
                                                    <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno'];?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                    <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>													
													<td><nobr><?php echo $exp['selectDisposal']; ?></nobr></td>
													<td><nobr><?php echo $exp['selectDisposalDate']; ?></nobr></td>
													<td><nobr><?php echo $exp['confirmDisposal']; ?></nobr></td>
													<td><nobr><?php echo $exp['confirmDisposalDate']; ?></nobr></td>
													<td><nobr><?php echo $exp['ApprovedDisposal']; ?></nobr></td>
													<td><nobr><?php echo $exp['ApprovedDisposalDate']; ?></nobr></td>
													<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
													<input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Undo Disposal"/></form></nobr></td>													
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