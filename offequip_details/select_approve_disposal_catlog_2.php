<?php include 'header1.php'; ?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
$(".savebttn").click(function(){
	var id = $(this).attr('id');
    var Approved = ($('#Loss_'+id).prop('checked')) ? 1 : 0;
	var querystring = {
			id: id,
			Approved: Approved, 				 
			action: 'approve_Items_For_Disposal_catlog_5'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			if (result == 1) {
				$($('#Row_'+id).closest("tr")).remove();
			}
		//alert(result);
		} 	
return false
});
$("#btnSubmit").click(function(){
    var assetunit = $('#assetunit_a').val();
	var catalogueno = $('#catalogueno_a').val();
		var querystring = {
			assetunit: assetunit,
			catalogueno: catalogueno, 				 
			action: 'approve_Items_For_Disposal_catlog_6'
		}
		$.get('index.php', querystring, processResponse);
 	 function processResponse(result) {
			if (result > 0) {
			$("#abc").find("tr:gt(0)").remove();
			}
	 } 	
    });
 $(".rej_savebttn").click(function(){
    //alert();
  	var id = $(this).attr('id');
	var querystring = {
			id: id, 				 
			action: 'approve_Items_For_Disposal_catlog_7'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
			//if (result == 1) {
				$($('#Row_'+result).closest("tr")).remove();
			//}
		//alert(result);
		} 	
return false
  });
}); 
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>Approve Items For Disposal </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="approve_Items_For_Disposal_catlog" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>

                                                        <td width="70%">
                                                            <select name="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $fields->getField('assetscenter')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                        <tr>
                                                        <td width="30%"><label></label></td>
                                                        <td width="70%"></td>
                                                    </tr>
                                                    <div id="PreLocdiv">
                                                        
                                                        </div>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Search Disposal Items</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Assets Center, Assets Unit and  press "Search Disposal Items" Button</strong></li>
                                                <?php
                                                break;
                                            case '1':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>
                                                <?php
                                                break;
                                            case '2':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>
                                                <?php
                                                break;
                                            case '3':
                                                ?>
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Deed Details Already Entered !</strong></li>
                                                <?php
                                                break;
                                            case '5':
                                                ?>
                                                <li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>
                                                <?php
                                                break;
                                            case '6':
                                                ?>
                                                <li class="green"><span class="ico"></span><strong class="system_title">Data Deleted</strong></li>
                                        <?php } ?>
                                    </ul>
        <div class="title_wrapper">
            <h2>Disposal List - Office Equipments</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Select</nobr></th>
											 <th><nobr><?php echo $tList[1][$lang]?></nobr></th>
											 <th><nobr>Disposal Date</nobr></th>
                                            <th><nobr><?php echo $tList[18][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[2][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[3][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[4][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[5][$lang]?></nobr></th>
                                            <th><nobr>Assets Number</nobr></th>
											<th><nobr>Classification No</nobr></th>
                                            <th><nobr><?php echo $tList[33][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[7][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[8][$lang]?></nobr></th>
                                            <th><nobr><?php echo $tList[9][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[10][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[13][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[15][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[16][$lang]?></nobr></th>
											<th><nobr><?php echo $tList[17][$lang]?></nobr></th>
                                             </tr>
											</thead>                                                     
                                            <tbody>
                                                <?php $i = 1; 
												$totvalue = 0;?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr id ="Row_<?php echo $exp['id']; ?>">
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><form name="add_form" id="add_form" class="add_form" action="." method="post">
												<input type="checkbox" name="Loss_<?php echo $exp['id']; ?>" id="Loss_<?php echo $exp['id']; ?>"><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Approve"/></form></nobr></td>
                                                                 <td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
																 <th><nobr><?php echo $exp['disposedDate']; ?></nobr></th>
																<td><nobr><a href="index.php?action=approve_Items_For_Disposal_catlog_3&id=<?php echo $exp['id'];?>&assetscenter=<?php echo $assetscenter;?>$assetunit=<?php echo $assetunit;?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
																<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
                                                                 <td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['newAssestno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['natureOwnership']; ?></nobr></td>
																 <td><nobr><?php echo $exp['ledgerno']; ?></nobr></td>
																 <td><nobr><?php echo $exp['ledgerFoliono']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['eqptSriNo']; ?></nobr></td>
																 <td><nobr><?php echo $exp['purchasedDate']; ?></nobr></td>
                                                                <td align="right"><nobr><?php echo $exp['unitValue']; ?></nobr></td>
																<td><nobr><?php echo $exp['receivedDate']; ?></nobr></td>
																<td><nobr><?php echo $exp['presentLocation']; ?></nobr></td>
                                                               <td><nobr><?php echo $exp['Remarks']; ?></nobr></td>
                                                                <td><button type="button" class = "rej_savebttn" id = "reg_<?php echo $exp['id']; ?>">Reject</button></td>
																</tr>
																<?php $i++; 
													      $totvalue = $totvalue + $exp['unitValue']; ?>
                                                <?php } ?> 
                                                            </tbody>
															<tfoot>
												<tr>
												<td></td>
												<td><input id = "btnSubmit" type="submit" value="Approve All"/>
												<input type="hidden" name="assetunit_a" id="assetunit_a" value="<?php echo $assetunit; ?>" />
												<input type="hidden" name="catalogueno_a" id="catalogueno_a" value="<?php echo $catalogueno; ?>" /></td>
												<td>Page Total :</td>
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
												<td></td>
												<td></td>
												<td align="right"><?php echo number_format((float)$totvalue, 2, '.', ','); ?></td>
												<td></td>
												<td></td>
												<td></td>
												</tr>
											  </tfoot>
											  </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>










