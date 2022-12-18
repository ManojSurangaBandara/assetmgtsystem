<?php include 'header1.php'; ?>
	<script>
	$(function(){
		$("#delete-button").click(function(){
			if(confirm("Are you sure you want to delete this all items?")){
					deleteData();
					return false
			}
			else{
				return false;
			}
		});
		
		function deleteData()
		{
	var unit = $('#assetunit').val();
	var querystring = {
			unit: unit,
			action: 'delete_all_item'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		alert(result +" Records Deleted");
		}
	return false
		};
		
		$('table').tablesorter({
			widgets        : ['zebra', 'stickyHeaders', "filter", 'cssStickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});
	});
	</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="delete_all_items"/>
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
                            <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
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
            <h2>Lands Details List - Delete</h2>
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
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=red style="font-size:11px;">
                                            <thead>
												<tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Delete</nobr></th>
											<th><nobr>Identification No</nobr></th>
                                            <th><nobr>Category Name</nobr></th>
                                            <th><nobr>District</nobr></th>
                                            <th><nobr>DS Division</nobr></th>
                                            <th><nobr>GS Division</nobr></th>
                                            <th><nobr>Deed Number</nobr></th>
                                            <th><nobr>Land Name</nobr></th>
                                            <th><nobr>Area(Hect)</nobr></th>
											<th><nobr>Area(Acre/Rood/Parch)</nobr></th>
                                            <th><nobr>DOR</nobr></th>
                                            <th><nobr>Value</nobr></th>
                                            </tr>
											</thead>
											<tbody>
                                            <?php $i = 1; 
											$totvalue = 0;?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
														<form action="." method="post">
														<input type="hidden" name="action" value="delete_all_items" />
														<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
														<input type="hidden" name="assetscenter" value="<?php echo $assetscenter; ?>"/>
														<input type="hidden" name="assetunit" value="<?php echo $assetunit; ?>"/>
														<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete Item?');" style="background-color: #f44336;border-radius: 8px; color: white;padding: 5px 10px;"/>
														</form>
													</td>
													<td><nobr><?php echo $exp['identificationno']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['category']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['district']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['dsDivision']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['gsDivision']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['deedno']; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['landname']; ?></nobr></td>
                                                    <td align="right"><nobr><?php echo number_format((float)$exp['area'], 2, '.', ','); ?></nobr></td>
													<td align="right"><nobr><?php echo $exp['acre']."A, ".$exp['rood']."R, ".number_format((float)$exp['parch'], 2, '.', ',')."P "; ?></nobr></td>
                                                    <td><nobr><?php echo $exp['acquisitiondate']; ?></nobr></td>
                                                    <td align="right"><nobr><?php echo number_format((float)$exp['estimatedValue'], 2, '.', ','); ?></nobr></td>
                                                </tr>
                                                <?php $i++; 
												$totvalue = $totvalue + $exp['estimatedValue']; ?>
                                            <?php } ?> 
                                            </tbody>
											<tfoot>
												<tr>
												<td></td>
												<td>Total Value</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
												  <td></td>
												  <td></td>
												  <td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot>
											  </table>
                                    </div>

                                </fieldset>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<button id="delete-button" style="background-color: #f44336;border-radius: 8px; color: white;padding: 15px 32px;">Delete All Items</button>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>

</div>
<?php
include '../view/footer.php';
?>