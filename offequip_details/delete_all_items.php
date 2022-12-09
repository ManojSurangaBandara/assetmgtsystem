<?php
include 'header1.php';
?>
<script>	
$(document).ready(function() {
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
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
                    <td>
                        <select name="assetscenter" id="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
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

                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" id="btnSubmit" value="Search" />
                    </td>
                    <td>  
                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Office Equipment Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
		<table id="abc" class="tablesorter" cellpadding="0" cellspacing="0" width="100%" border="1" BORDERCOLOR=red style="font-size:11px;"> 
<thead> 
<tr> 
    <th><nobr>S/N</nobr></th> 
	<th><nobr>Delete</nobr></th>
    <th><nobr>Identification No</nobr></th> 
    <th><nobr>Category</nobr></th> 
    <th><nobr>Description</nobr></th> 
    <th><nobr>Asset No</nobr></th> 
	<th><nobr>Catalogue No</nobr></th>
	<th><nobr>Serial No.</nobr></th> 
	<th><nobr>DOP</nobr></th> 
	<th><nobr>DOR</nobr></th> 
	<th><nobr>Unit Value</nobr></th> 
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
<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
<td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
<td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
<td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
<td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>	
<td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
</tr> 
 <?php $i++; 
 $totvalue = $totvalue + $exp['unitValue'];?>
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
												  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
												</tr>
											  </tfoot>
</table>
       <div class="section_content">
	   <button id="delete-button" style="background-color: #f44336;border-radius: 8px; color: white;padding: 15px 32px;">Delete All </button>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>  
                                                        </div>

                                                        </div>
                                                        <?php
                                                        include '../view/footer.php';
                                                        ?>