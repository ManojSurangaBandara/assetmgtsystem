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
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
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
		<table id="abc" class="tablesorter"> 
			<thead> 
			<tr> 
				<th>S/N</th>  
				<th><nobr><?php echo $tList[1][$lang]?></nobr></th> 
				<th><nobr><?php echo $tList[2][$lang]?></nobr></th> 
				<th><nobr><?php echo $tList[3][$lang]?></nobr></th> 
				<th><nobr><?php echo $tList[4][$lang]?></nobr></th> 
				<th><nobr>Assets Number</nobr></th> 
				<th><nobr>Classification No</nobr></th> 
				<th><nobr>Quantity</nobr></th> 
				<th><nobr>Value</nobr></th> 
			</tr> 
			</thead> 
			<tbody> 
				<?php $i = 1;
				$totqty = 0; 
				$totvalue = 0;?>
				<?php foreach ($items as $exp) { ?>		
				<tr> 
				<td><nobr><?php echo $i; ?></nobr></td>
				<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
				<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>	
				<td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
				<td><nobr><a href="index.php?action=approve_Items_For_Disposal_catlog_2&assetunit=<?php echo $exp['assetunit']; ?>&catalogueno=<?php echo $exp['catalogueno']; ?>&assetscenter=<?php echo $exp['assetscenter']; ?>"><?php echo substr($exp['itemDescription'],0,40); ?></a></nobr></td>
				<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>
				<td><nobr><?php echo $exp['catalogueno']; ?></a></nobr></td>
				<td align="right"><nobr><?php echo $exp['cnt']; ?></nobr></td>
				<td style="text-align:right"><nobr><?php echo number_format($exp['tot'], 2, '.', ','); ?></nobr></td>	
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
				<td></td>
				<td align="right"><?php echo number_format($totqty, 0, '.', ','); ?></td>	
				  <td align="right"><?php echo number_format($totvalue, 2, '.', ','); ?></td>
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










