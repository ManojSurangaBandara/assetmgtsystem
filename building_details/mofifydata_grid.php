<?php include 'header1.php'; ?>
	<script>
	$(function(){
$(".savebttn").click(function(){
	var id = $(this).attr('id');
	saveDate(id);
	return false
});
function saveDate(id)
		{
	var category = $('#category_'+id).val();
	var buildingType = $('#buildingType_'+id).val();
	var landname = $('#landname_'+id).val();
	var acquisitiondate = $('#acquisitiondate_'+id).val();
	var area = $('#area_'+id).val();
	var feets = $('#feets_'+id).val();
	var constructionCost = $('#constructionCost_'+id).val();
	var alterationValue = $('#alterationValue_'+id).val();
	var rentAndRate = $('#rentAndRate_'+id).val();
	var querystring = {
			id: id,
			category: category,
			buildingType: buildingType,
			landname: landname,
			acquisitiondate: acquisitiondate,
			area: area,
			feets: feets,
			constructionCost: constructionCost,
			alterationValue: alterationValue,
			rentAndRate: rentAndRate,
			action: 'mofifydata_grid_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
		};
	function getTypes(id)
		{
		var val = $('#category_' + id).val();
		$('#buildingtypes_' + id).empty();
		if (val == 'PRE FABRICATED BUILDINGS'){
			$('#buildingtypes_' + id).append("<option value='A - 125 X 20'>");
			$('#buildingtypes_' + id).append("<option value='B - 100 X 20'>");
			$('#buildingtypes_' + id).append("<option value='D - 60 X 20'>");
			$('#buildingtypes_' + id).append("<option value='E - 50 X 20'>");
			$('#buildingtypes_' + id).append("<option value='H - 25 X 20'>");
			$('#buildingtypes_' + id).append("<option value='Q - 100 X 30'>");
			$('#buildingtypes_' + id).append("<option value='R - 60 X 30'>");			
		}
		}
		;
		$('.categ').change(function() {
		var data = $(this).attr('id');
		//alert($(this).val());
		//alert($(this).attr('id'));
		var arr = data.split('_');
		var id = arr[1];
		var model = getTypes(id);
	});
		$('table').tablesorter({
			widgets        : ['uitheme', 'stickyHeaders', 'scroller']
		});
function createcodes() {
    $('#abc tr').each(function () {
	var id = $(this).attr('id');
	getTypes(id);
    });
}
  $("#btnSubmit").click(function(){
      $('#abc tr').each(function () {
		var id = $(this).attr('id');
		saveDate(id);
		});      
    });  
createcodes();		
	});
	</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form"  class="search_form general_form">
            <input type="hidden" name="action" value="mofifydata_grid"/>
            <table width="100%" border="0">
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
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" onChange="getrequestitem('index.php?action=findSearchType&searchby=' + this.value)">                       
							<option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
							<option value="Building Category" <?php if ($searchby == "Building Category") echo "selected = 'selected'"; ?>>Building Category</option>
							<option value="Building Number" <?php if ($searchby == "Building Number") echo "selected = 'selected'"; ?>>Building Number</option>
							<option value="Building Type" <?php if ($searchby == "Building Type") echo "selected = 'selected'"; ?>>Building Type</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Construction Cost" <?php if ($searchby == "Construction Cost") echo "selected = 'selected'"; ?>>Construction Cost</option>
							<option value="Date of Acquisition" <?php if ($searchby == "Date of Acquisition") echo "selected = 'selected'"; ?>>Date of Acquisition</option>
							<option value="District" <?php if ($searchby == "District") echo "selected = 'selected'"; ?>>District</option>
							<option value="DS Division" <?php if ($searchby == "DS Division") echo "selected = 'selected'"; ?>>DS Division</option>
							<option value="GS Division" <?php if ($searchby == "GS Division") echo "selected = 'selected'"; ?>>GS Division</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
							<option value="Name of Land" <?php if ($searchby == "Name of Land") echo "selected = 'selected'"; ?>>Name of Land</option>							
							<option value="Nature of the Ownership" <?php if ($searchby == "Nature of the Ownership") echo "selected = 'selected'"; ?>>Nature of the Ownership</option>
							<option value="Ownership" <?php if ($searchby == "Ownership") echo "selected = 'selected'"; ?>>Ownership</option>
							<option value="Plan Date" <?php if ($searchby == "Plan Date") echo "selected = 'selected'"; ?>>Plan Date</option>
							<option value="Plan Number" <?php if ($searchby == "Plan Number") echo "selected = 'selected'"; ?>>Plan Number</option>
							<option value="Province"  <?php if ($searchby == "Province") echo "selected = 'selected'"; ?>>Province</option>							
                        </select>

                    </td>
                    <td>
                        <div id="Itmdiv">
                            <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist>
                            <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>" style="width:200px;"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><b><?php echo $tList[24][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>
                <tr>
                <td> </td>
                <td> </td>
                <td>  
                    <input type="submit" value="Search" />
                </td>
                <td></td>
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Modify - <?php echo $subMenu[0][$lang]?></h2>
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
                                        <table id="abc" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
												<tr>
                                            <th>S/N</th>
                                            <th><nobr>Identification No</nobr></th>
                                            <th><nobr>Building Category</nobr></th>
                                            <th><nobr>Building Type</nobr></th>
                                            <th><nobr>Name of Land</nobr></th>
											<th><nobr>DOR</nobr></th>
                                            <th><nobr>Area(SQ Metre)</nobr></th>
											<th><nobr>Area(SQ Foot)</nobr></th>
                                            <th><nobr>Construction Cost</nobr></th>
											 <th><nobr>Valuation Cost</nobr></th>
											<th><nobr>No. of Floors</nobr></th> 											
											<th><nobr></nobr></th> 											
                                            </tr>
											</thead>
											<tbody>
                                            <?php $i = 1; 
											$totvalue = 0;?>
                                            <?php foreach ($items as $exp) { ?>																
                                                <tr id="<?php echo $exp['id']; ?>">
                                                    <td><?php echo $i; ?></td>
                                                    <td><nobr><a href="index.php?action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                    <form name="add_form" id="add_form" class="add_form" action="." method="post">																	
														<input type="hidden" id="mn_<?php echo $exp['id']; ?>" name="mn_<?php echo $exp['id']; ?>" value="<?php echo $exp['buildingType']; ?>"/>
														<td><select name="category_<?php echo $exp['id']; ?>"  id ="category_<?php echo $exp['id']; ?>" class="categ">
                                                                <option value=""></option>
                                                                <?php foreach ($buildingCategorys as $landcata) { ?>
                                                                    <option value="<?php echo $landcata->getName(); ?>" <?php if ($exp['buildingCategory'] == $landcata->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $landcata->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                        </select></td>													
								
														<td><input type="text" name="buildingType_<?php echo $exp['id']; ?>" id="buildingType_<?php echo $exp['id']; ?>" list="buildingtypes_<?php echo $exp['id']; ?>" value="<?php echo $exp['buildingType']; ?>"></td>
														<datalist id="buildingtypes_<?php echo $exp['id']; ?>">
														</datalist>
														<td><input type="text" name="landname_<?php echo $exp['id']; ?>" id="landname_<?php echo $exp['id']; ?>" value="<?php echo $exp['landname']; ?>"></td>
														<td><input type="text" class="date" name="acquisitiondate_<?php echo $exp['id']; ?>" id="acquisitiondate_<?php echo $exp['id']; ?>" value="<?php echo $exp['acquisitiondate']; ?>"></td>
														<td><input type="text" name="area_<?php echo $exp['id']; ?>" id="area_<?php echo $exp['id']; ?>" style="direction: rtl;" value="<?php echo $exp['area']; ?>"></td>
														<td><input type="text" name="feets_<?php echo $exp['id']; ?>" id="feets_<?php echo $exp['id']; ?>" style="direction: rtl;" value="<?php echo $exp['feets']; ?>"></td>
														<td><input type="text" name="constructionCost_<?php echo $exp['id']; ?>" id="constructionCost_<?php echo $exp['id']; ?>"  style="direction: rtl;" value="<?php echo $exp['constructionCost']; ?>"></td>
														<td><input type="text" name="alterationValue_<?php echo $exp['id']; ?>" id="alterationValue_<?php echo $exp['id']; ?>"  style="direction: rtl;" value="<?php echo $exp['alterationValue']; ?>"></td>
														<td><input type="text" name="rentAndRate_<?php echo $exp['id']; ?>" id="rentAndRate_<?php echo $exp['id']; ?>"  style="direction: rtl;" value="<?php echo $exp['rentAndRate']; ?>"></td>
														<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
													</form>                                                  
                                                </tr>
                                                <?php $i++; 
												$totvalue = $totvalue + $exp['constructionCost'];?>
                                            <?php } ?> 
                                            </tbody>
											<tfoot>
												<tr>
												<td></td>											
												<td></td>
												<td></td>												
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>												
												<td></td>
												</tr>
											  </tfoot></table>
                                    </div>
                                </fieldset>
								<input id = "btnSubmit" type="submit" value="Save All"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<iframe id="txtArea1" style="display:none"></iframe>
            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
        </div>
    </div>
</div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>