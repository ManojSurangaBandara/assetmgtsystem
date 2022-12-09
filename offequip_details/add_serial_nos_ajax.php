<?php
include 'header1.php';
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var ledgerFoliono = $('#ledgerFoliono_'+id).val();
	var eqptSriNo = $('#eqptSriNo_'+id).val();
	var purchasedDate = $('#purchasedDate_'+id).val();
	var receivedDate = $('#receivedDate_'+id).val();
	var natureOwnership = $('#natureOwnership_'+id).val();
	var unitValue = $('#unitValue_'+id).val();
	var presentLocation = $('#presentLocation_'+id).val();
	var querystring = {
			id: id,
			ledgerFoliono: ledgerFoliono,
			eqptSriNo: eqptSriNo,
			purchasedDate: purchasedDate,
			receivedDate: receivedDate,
			natureOwnership: natureOwnership,
			unitValue: unitValue,
			presentLocation: presentLocation,
			action: 'add_serial_nos_ajax_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		}
	return false
});
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
            <input type="hidden" name="action" value="add_serial_nos_ajax"/>
            <table width="100%" border="0">
                <tr>                    
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b>
                    </td>
                    <td>
                        <select name="searchby">
							<option value="Assets Number" <?php if ($searchby == "Assets Number") echo "selected = 'selected'"; ?>>Assets Number</option>
							<option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Date of Purchased" <?php if ($searchby == "Date of Purchased") echo "selected = 'selected'"; ?>>Date of Purchased</option>
							<option value="Date of Received" <?php if ($searchby == "Date of Received") echo "selected = 'selected'"; ?>>Date of Received</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
							<option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
							<option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
                            <option value="Ledger Folio Number" <?php if ($searchby == "Ledger Folio Number") echo "selected = 'selected'"; ?>>Ledger Folio Number</option>
                            <option value="Ledger Number" <?php if ($searchby == "Ledger Number") echo "selected = 'selected'"; ?>>Ledger Number</option>
                            <option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Serial Number" <?php if ($searchby == "Serial Number") echo "selected = 'selected'"; ?>>Serial Number</option>  
                        </select>

                    </td>
                    <td>
                        <div id="Itmdiv">
                            <!-- <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist> -->
                            <input type="text" class="text" name="search"  id="search" value="<?php echo $search; ?>" style="width:200px;"/>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b><?php echo $tList[10][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>
                    </td>
                    <td>
                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                    </td>
                </tr>	
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
			<h2>Office Equipments - Add Serial No Ajax</h2>
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
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                            <th>S/N</th>
                                            <th>Identification No</th>							
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Catalogue No
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
											<th>Folio No
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
                                            <th>Serial No.
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
                                            <th style="width: 8%;">DOP
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
                                            <th style="width: 8%;">DOR
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
											<th>Nature of the Ownership
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
                                            <th>Unit Value
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
											<th>Present Location
												<button class="pull-right btn btn-default btn-condensed hide-column" data-toggle="tooltip" data-placement="bottom" title="Hide Column">
												<i class="fa fa-eye-slash"></i>  
												</button>
											</th>
                                                        </tr>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="index.php?action=Inquiry_List_Details&assetunit=<?php echo $assetunit; ?>&searchby=<?php echo $searchby; ?>&search=<?php echo $search; ?>&identificationno=<?php echo $exp['identificationno']; ?>&inputField1=<?php echo $inputField1; ?>&inputField2=<?php echo $inputField2; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
																<td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>																															
																<td>
																<form name="add_form" id="add_form" class="add_form" action="." method="post">
																	<input type="text" name="ledgerFoliono_<?php echo $exp['id']; ?>" id="ledgerFoliono_<?php echo $exp['id']; ?>" value="<?php echo $exp['ledgerFoliono']; ?>"></td>
																	<td><input type="text" name="eqptSriNo_<?php echo $exp['id']; ?>" id="eqptSriNo_<?php echo $exp['id']; ?>" value="<?php echo $exp['eqptSriNo']; ?>"></td>
																	<td><input type="text" class="date" name="purchasedDate_<?php echo $exp['id']; ?>" id="purchasedDate_<?php echo $exp['id']; ?>" value="<?php echo $exp['purchasedDate']; ?>" style="width:80px;"></td>
																	<td><input type="text" class="date" name="receivedDate_<?php echo $exp['id']; ?>" id="receivedDate_<?php echo $exp['id']; ?>" value="<?php echo $exp['receivedDate']; ?>" style="width:80px;"></td>
																	<td><select name="natureOwnership_<?php echo $exp['id']; ?>" id="natureOwnership_<?php echo $exp['id']; ?>">
																		<option value=""></option>
																		<option value="DONATION" <?php if ($exp['natureOwnership'] == "DONATION") echo "selected = 'selected'"; ?>>DONATION</option>																
																		<option value="PURCHASE" <?php if ($exp['natureOwnership'] == "PURCHASE") echo "selected = 'selected'"; ?>>PURCHASE</option>
																		</select> </td>
																	<td align="right"><input type="text" name="unitValue_<?php echo $exp['id']; ?>" id="unitValue_<?php echo $exp['id']; ?>" value="<?php echo $exp['unitValue']; ?>" style="width:80px; text-align: right;"></td>
																	<!--<td><input type="text" name="presentLocation_<?php echo $exp['id']; ?>" id="presentLocation_<?php echo $exp['id']; ?>" value="<?php echo $exp['presentLocation']; ?>"></td> -->
																	 <td><select name="presentLocation_<?php echo $exp['id']; ?>" id="presentLocation_<?php echo $exp['id']; ?>">
                                                                <option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>
																	<?php foreach ($presentLocations as $unit) { ?>
																		<option value="<?php echo $unit['locations']; ?>" <?php if ($exp['presentLocation'] == $unit['locations']) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit['locations']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
																</td>																	
																	<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
																</form>
																</td>
                                                            </tr>
                                                            <?php $i++; ?>
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
                                                        <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                        </div>
                                                        </div>

                                                        </div>
                                                        <?php
                                                        include '../view/footer.php';
                                                        ?>