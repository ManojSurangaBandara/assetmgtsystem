<?php
include 'header1.php';
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var engineno = $('#engineno_'+id).val();
	var chessisno = $('#chessisno_'+id).val();
	var brandName = $('#brandName_'+id).val();
	var modleName = $('#modleName_'+id).val();
	var armyno = $('#armyno_'+id).val();
	var purchasedDate = $('#purchasedDate_'+id).val();
	var receivedDate = $('#receivedDate_'+id).val();
	var unitValue = $('#unitValue_'+id).val();
	var presentLocation = $('#presentLocation_'+id).val();
	var natureOwnership = $('#natureOwnership_'+id).val();
	var querystring = {
			id: id,
			engineno: engineno,
			chessisno: chessisno,
			brandName: brandName,
			modleName: modleName,
			armyno: armyno,
			purchasedDate: purchasedDate,
			receivedDate: receivedDate,
			unitValue: unitValue,
			presentLocation: presentLocation,
			natureOwnership: natureOwnership,
			action: 'mofifydata_grid_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
$('.brand').change(function() {
		var data = $(this).attr('id');
		//alert($(this).val());
		//alert($(this).attr('id'));
		var arr = data.split('_');
		var id = arr[1];
		var model = 
		getmodels($(this).val(), "", id);
	});
	function getmodels(brand, model, id)
		{
	var querystring = {
		brand: brand,
		action: 'findmodelBybrand'
	}
	$.get('index.php', querystring, processResponse);
	function processResponse(result) {
				var numbers = $.parseJSON(result);
				var option = '<option value=""></option>';
				for (var i = 0; i < numbers.length; i++) {
					option += '<option value="' + numbers[i].model + '">' + numbers[i].model + '</option>';
				}
				$('#modleName_' + id).html(option);
				$('#modleName_' + id + ' option[value="' + model + '"]').attr('selected', 'selected');
			} // end processData
		}
		;
function createcodes() {
    $('#abc tr').each(function () {
	var id = $(this).attr('id');
	var bn = $('#brandName_' + id).val();
	var mn = $('#mn_' + id).val();
	getmodels(bn, mn, id);
		//var customerId = $(this).find("td:eq(8)").val(); 
		//alert(bn);
	   //processing this row
        //how to process each cell(table td) where there is checkbox
      //  $(this).find('td input:checked').each(function () {

             // it is checked, your code here...
       // });
    });
}
createcodes();		
});
$(function() {
  // on init
  $(".table-hideable .hide-col").each(HideColumnIndex);

  // on click
  $('.hide-column').click(HideColumnIndex)

  function HideColumnIndex() {
    var $el = $(this);
    var $cell = $el.closest('th,td')
    var $table = $cell.closest('table')

    // get cell location - https://stackoverflow.com/a/4999018/1366033
    var colIndex = $cell[0].cellIndex + 1;

    // find and hide col index
    $table.find("tbody tr, thead tr")
      .children(":nth-child(" + colIndex + ")")
      .addClass('hide-col');
      
    // show restore footer
    $table.find(".footer-restore-columns").show()
  }

  // restore columns footer
  $(".restore-columns").click(function(e) {
    var $table = $(this).closest('table')
    $table.find(".footer-restore-columns").hide()
    $table.find("th, td")
      .removeClass('hide-col');

  })

  $('[data-toggle="tooltip"]').tooltip({
    trigger: 'hover'
  })

}); 
</script>
<style>
body {
  padding: 15px;
}

.table-hideable td,
.table-hideable th {
  width: auto;
  transition: width .5s, margin .5s;
}

.btn-condensed.btn-condensed {
  padding: 0 5px;
  box-shadow: none;
}


/* use class to have a little animation */
.hide-col {
  width: 0px !important;
  height: 0px !important;
  display: block !important;
  overflow: hidden !important;
  margin: 0 !important;
  padding: 0 !important;
  border: none !important;
}
</style>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="mofifydata_grid"/>
            <input type="hidden" name="disposal" value="<?php echo $disposal; ?>"/>
            <table width="100%" border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b> </td>
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
                    <td></td>
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
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>

                        <select name="searchby" id="searchby" onChange="getrequestitem('index.php?action=findSearchType&searchby=' + this.value)">
                            <option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Category"  <?php if ($searchby == "Category") echo "selected = 'selected'"; ?>>Category</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                            <option hidden value="Make" <?php if ($searchby == "Make") echo "selected = 'selected'"; ?>>Make</option>
                            <option hidden value="Modle" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Modle</option>
                            <option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
                            <option value="Engine Number" <?php if ($searchby == "Engine Number") echo "selected = 'selected'"; ?>>Engine Number</option>
                            <option value="Chassis Number" <?php if ($searchby == "Chassis Number") echo "selected = 'selected'"; ?>>Chassis Number</option>
                            <option value="Year manufactured" <?php if ($searchby == "Year manufactured") echo "selected = 'selected'"; ?>>Year manufactured</option>
                            <option value="natureOwnership" <?php if ($searchby == "natureOwnership") echo "selected = 'selected'"; ?>>natureOwnership</option>
                            <option value="Army Number" <?php if ($searchby == "Army Number") echo "selected = 'selected'"; ?>>Army Number</option>
                            <option value="Civil Number" <?php if ($searchby == "Civil Number") echo "selected = 'selected'"; ?>>Civil Number</option>
                            <option value="Modle" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Fuel</option>
                            <option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
                            <option value="Unit Value" <?php if ($searchby == "Unit Value") echo "selected = 'selected'"; ?>>Unit Value</option>
                            <option value="Horse Power" <?php if ($searchby == "Horse Power") echo "selected = 'selected'"; ?>>Horse Power</option>
                            <option value="Tare" <?php if ($searchby == "Tare") echo "selected = 'selected'"; ?>>Tare</option>
                            <option value="Present Location" <?php if ($searchby == "Present Location") echo "selected = 'selected'"; ?>>Present Location</option>
                            <option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
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
                            <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[14][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                </tr>
								
				<?php if ($checkAllowType == 1 && $disposal == 0) { // 1 - Asset center and asset unit same?>
				<tr>
                    <td></td>
                    <td><b>&nbsp;</b></td> <td>
						<input type="radio" name="allocation" value="1" <?php if ($allocation == 1) echo 'checked'; ?>>Only This Unit Details
						<input type="radio" name="allocation" value="2" <?php if ($allocation == 2) echo 'checked'; ?>>Allocation to Other Units
						<input type="radio" name="allocation" value="3" <?php if ($allocation == 3) echo 'checked'; ?>>Both
						</td>
                    </td>
                </tr>
				 <?php } elseif ($checkAllowType == 2 && $disposal == 0) { // 1 - Asset unit and present location different?> 
					<tr>
                    <td></td>
                    <td><b>&nbsp;</b></td> <td>
						<input type="radio" name="allocation" value="1" <?php if ($allocation == 1) echo 'checked'; ?>>Only This Unit Details
						<input type="radio" name="allocation" value="2" <?php if ($allocation == 2) echo 'checked'; ?>>Allocated from Assets Centre - <?php echo $assetscenter; ?>
						<!--<input type="radio" name="allocation" value="3" <?php if ($allocation == 3) echo 'checked'; ?>>Both -->
						</td>
                    </td>
                </tr>	
					
				<?php } ?>	
                <tr>
                    <td></td>
                    <td></td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>
                    <td>  

                        <input type="checkbox" name="ExpToExcel" value="1" /> <?php echo $expexcel[$lang]?>
                        <input type="checkbox" name="ExpToPdf" value="1" /> <?php echo $exppdf[$lang]?>
                    </td> 
                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2><?php echo (isset($disposal) && $disposal == 1 ? 'Vehicle Details - Disposal List' : 'Vehicle Details List') ?></h2>
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
                                           <tbody> 
                                            <tr>
												<th>S/N</th>											
												<th nowrap="nowrap"><nobr>Identification No</nobr></th>
												<th nowrap="nowrap"><nobr>Category</nobr></th>
												<th nowrap="nowrap"><nobr>Description</nobr></th>
												<th nowrap="nowrap"><nobr>Capacity</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Fuel</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Asset No</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Engine No</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Chassis No</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Brand</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Model</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>											
												<th nowrap="nowrap"><nobr>Army No</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>DOP</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>DOR</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap"><nobr>Value</nobr><i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap">Present Location <i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
												<th nowrap="nowrap">natureOwnership<i class="fa fa-eye-slash hide-column pull-right" title="Hide Column"></i></th>
											</tr>
                                                        <?php $i = 1; 
														$totvalue = 0; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr id="<?php echo $exp['id']; ?>">
                                                                <td><?php echo $i; ?></td>																
                                                                <td><nobr><a href="index.php?action=ApprovedList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></nobr></td>
                                                                <td><nobr><?php echo $exp['itemCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemDescription']; ?></nobr></td>
																<td><nobr><?php echo $exp['make']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['modle']; ?></nobr></td>
																<td><nobr><?php echo $exp['assetsno']; ?></nobr></td>				
																	
																	<td><input type="text" name="engineno_<?php echo $exp['id']; ?>" id="engineno_<?php echo $exp['id']; ?>" value="<?php echo $exp['engineno']; ?>"></td>
																	<td><input type="text" name="chessisno_<?php echo $exp['id']; ?>" id="chessisno_<?php echo $exp['id']; ?>" value="<?php echo $exp['chessisno']; ?>"></td>
																	<td><select name="brandName_<?php echo $exp['id']; ?>" id="brandName_<?php echo $exp['id']; ?>" class="brand">
                                                                <option value=""></option>
                                                                <?php foreach ($brandNames as $cat) { ?>
                                                                    <option value="<?php echo $cat['brand']; ?>"<?php if ($exp['brandName'] == $cat['brand']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $cat['brand']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
																	</td>
																	<td><select name="modleName_<?php echo $exp['id']; ?>" id="modleName_<?php echo $exp['id']; ?>" class="text">
                                                                <option value=""></option>
                                                                <?php foreach ($modleNames as $cat) { ?>
                                                                    <option value="<?php echo $cat['modle']; ?>"<?php if ($exp['modleName'] == $cat['modle']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $cat['modle']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select> </td>
																	<td><input type="text" name="armyno_<?php echo $exp['id']; ?>" id="armyno_<?php echo $exp['id']; ?>" value="<?php echo $exp['armyno']; ?>"></td>
																	<td><input type="text" class="date" name="purchasedDate_<?php echo $exp['id']; ?>" id="purchasedDate_<?php echo $exp['id']; ?>" value="<?php echo $exp['purchasedDate']; ?>"></td>
																	<td><input type="text" class="date" name="receivedDate_<?php echo $exp['id']; ?>" id="receivedDate_<?php echo $exp['id']; ?>" value="<?php echo $exp['receivedDate']; ?>"></td>
																	<td><input type="text" name="unitValue_<?php echo $exp['id']; ?>" id="unitValue_<?php echo $exp['id']; ?>"  style="direction: rtl;" value="<?php echo $exp['unitValue']; ?>"></td>
																	<td><select name="presentLocation_<?php echo $exp['id']; ?>" id="presentLocation_<?php echo $exp['id']; ?>">
                                                                <option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>
																	<?php foreach ($presentLocations as $unit) { ?>
																		<option value="<?php echo $unit['locations']; ?>" <?php if ($exp['presentLocation'] == $unit['locations']) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit['locations']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
																</td>
                                                        <td><select name="natureOwnership_<?php echo $exp['id']; ?>" id="natureOwnership_<?php echo $exp['id']; ?>">
                                                                <option value=""></option>                                                               																
                                                                <option value="CAPTURED" <?php if ($exp['natureOwnership'] == "CAPTURED") echo "selected = 'selected'"; ?>>CAPTURED</option>
																<option value="DONATION" <?php if ($exp['natureOwnership'] == "DONATION") echo "selected = 'selected'"; ?>>DONATION</option>
																 <option value="PURCHASE" <?php if ($exp['natureOwnership'] == "PURCHASE") echo "selected = 'selected'"; ?>>PURCHASE</option>
                                                            </select>
                                                            </td>
																	<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/></td>
															
                                                            </tr>
															<input type="hidden" id="mn_<?php echo $exp['id']; ?>" name="mn_<?php echo $exp['id']; ?>" value="<?php echo $exp['modelName']; ?>"/>
                                                            <?php $i++; 
															$totvalue = $totvalue + $exp['unitValue']; ?>
                                                        <?php } ?> 
                                                        </tbody>
														<tfoot class="footer-restore-columns">
															<tr>
															  <th colspan="4"><a class="restore-columns" href="#">Some columns hidden - click to show all</a></th>
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
														<iframe id="txtArea1" style="display:none"></iframe>
														<button id="btnExport" onclick="fnExcelReport();">Export to Excel</button>
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
                                                        </div>

                                                        </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>