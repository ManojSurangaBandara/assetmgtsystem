<?php
include 'header1.php';
?>
<script>	
$(document).ready(function () {
var min = 0;
var max = 0;
$("#unitValue").focus(function () {
     var catalogueno = $('#catalogueno').val();
	 	var querystring = {
			catalogueno: catalogueno,
			action: 'min_max_find'
		}
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
		var obj1 = $.parseJSON(result);
		min = obj1.minval;
		max = obj1.maxval;
		var range = (max == 0 && min == 0) ? "  Range Not Defined " : "  Range : " + min + " - " + max;
		$('#maxminval').html(range);		
		}
});
$("#unitValue").blur(function() {
	var unitValue = parseFloat($('#unitValue').val());
	if(max == 0 && min == 0){
	} else {	
		if (unitValue >= parseFloat(min) && unitValue <= parseFloat(max)) {

		} else {
			alert("Please Check Unit Value");
		}
	}
});
}); 
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php if ($groupId == 0) {echo "ADD - Office Equipment Details";} else {echo $identificationnoTem;} ?></h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Office Equipment Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Details Already Entered !</strong></li>
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
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Add_Detail" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="groupId" value="<?php echo $groupId; ?>" />
                                        <input type="hidden" name="identificationno" value="<?php if (isset($identificationno)) {echo $identificationno;} ?>" />
                                        <input type="hidden" name="identificationnoTem" value="<?php echo $identificationnoTem; ?>" />
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
                                                                <select name="assetunit"  onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
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
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>

                                                        <td width="70%">
                                                            <select name="mainCategory" onChange="getDistrictByProvince('index.php?action=findCategoryByMainCategory&mainCategory=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($mainCategorys as $mainCate) { ?>
                                                                    <option value="<?php echo $mainCate->getName(); ?>" <?php if ($mainCategory == $mainCate->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $mainCate->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Disdiv">
                                                                <select name="itemCategory" onChange="getDSByDistrict('index.php?action=findDescriptionByCategory&itemCategory=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($itemCategorys as $itemCate) { ?>
                                                                        <option value="<?php echo $itemCate->getName(); ?>" <?php if ($itemCategory == $itemCate->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $itemCate->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <div id="DSdiv">
                                                                <select name="itemDescription" onChange="getGSByDS('index.php?action=findCataloguenoByDescription&itemDescription=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($itemDescriptions as $itemDesc) { ?>
                                                                        <option value="<?php echo $itemDesc->getName(); ?>" <?php if ($itemDescription == $itemDesc->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $itemDesc->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('itemDescription')->getHTML(); ?><br /></td>
                                                        </div>
                                                        </td> 
                                                    </tr>														  
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="GSdiv">
                                                                <select name="catalogueno" onChange="getrequestitem('index.php?action=findAssetsnoByCatalogueno&catalogueno=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($cataloguenos as $cata) { ?>
                                                                        <option value="<?php echo $cata->getName(); ?>" <?php if ($catalogueno == $cata->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $cata->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                                <?php echo $fields->getField('catalogueno')->getHTML(); ?><br />
                                                        </td>

                                                        </div>
                                                    </tr>

                                                    <tr>

                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Itmdiv">
                                                                <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px"/>
                                                                <?php echo $fields->getField('assetsno')->getHTML(); ?>
                                                                <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px"/>
                                                                <?php echo $fields->getField('newAssestno')->getHTML(); ?><br />
                                                            </div>  
                                                        </td>

                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[33][$lang]?></label></td>
                                                        <td width="70%"><select name="natureOwnership">
                                                                <option value=""></option>                                                                
                                                                <option value="DONATION" <?php if ($natureOwnership == "DONATION") echo "selected = 'selected'"; ?>>DONATION</option>																
                                                                <option value="PURCHASE" <?php if ($natureOwnership == "PURCHASE") echo "selected = 'selected'"; ?>>PURCHASE</option>
                                                            </select>
                                                            <?php echo $fields->getField('natureOwnership')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="ledgerno"  id="ledgerno" value="<?php echo $ledgerno; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('ledgerno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="ledgerFoliono"  id="ledgerFoliono" value="<?php echo $ledgerFoliono; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('ledgerFoliono')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" value="<?php echo $eqptSriNo; ?>" style="width:400px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('eqptSriNo')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%"><input type='text' class="text" name="purchasedDate" value="<?php echo $purchasedDate; ?>" id="inputField1" style="width:90px;"/>
                                                            <?php echo $fields->getField('purchasedDate')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%"><?php if ($groupId == 0) { ?>
                                                        <input type="text" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:200px; text-align: right" onchange="setCookie(this.id)"/>
                                                            <?php echo $fields->getField('quantity')->getHTML(); ?><br />
                                                        <?php } else { ?>
                                                        <input type="text" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:200px; text-align: right; background-color:white; color: black" disabled/>
                                                            <?php echo $fields->getField('quantity')->getHTML(); ?><br />
                                                        <input type="hidden" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:200px; text-align: right"/>    
                                                        <?php } ?>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:200px; text-align: right"/>
                                                            <?php echo $fields->getField('capacity')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right;" onkeypress="validate(event)"/><span name="maxminval"  id="maxminval"> </span>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td width="30%"><label>Total Cost :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:200px; text-align: right;"/>
                                                            <?php echo $fields->getField('totalCost')->getHTML(); ?><br /></td>
                                                    </tr> -->
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="acquisitionInstitute">
                                                                <option value="">--</option>
                                                                <?php foreach ($institutes as $center) { ?>
                                                                    <option value="<?php echo $center['instName']; ?>" <?php if ($acquisitionInstitute == $center['instName']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center['instName']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br /></td>
                                                    </tr>
                                                            <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%"><input type='text' class="text" name="receivedDate" value="<?php echo $receivedDate; ?>" id="inputField2" style="width:90px;"/>
                                                            <?php echo $fields->getField('receivedDate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                     <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
														   <?php if ($assetunit == 'Dte of AMS') { 
														   if ($presentLocation == "" ) $presentLocation = $assetunit;
														   ?>
														   <select name="presentLocation">
                                                                    <?php foreach ($units as $unit) { ?>
                                                                        <option value="<?php echo $unit; ?>" <?php if ($presentLocation == $unit) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
														   <?php 
														   } elseif ($assetunit == 'HQ CSO') {
															?>   
															   <input type="text" class="text" name="presentLocation"  id="presentLocation" value="<?php echo $presentLocation; ?>" style="width:200px"/>
														   <?php
														   } else {?>
                                                            <select name="presentLocation">
                                                                <option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>
																	<?php foreach ($presentLocations as $unit) { ?>
																		<option value="<?php echo $unit['locations']; ?>" <?php if ($presentLocation == $unit['locations']) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit['locations']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
															<?php } ?>	
                                                            <?php echo $fields->getField('presentLocation')->getHTML(); ?><br /></td>
                                                        </td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label>Fund Type :</label></td>
                                                        <td width="70%">
                                                            <select name="fundtype">
																<option value="0" <?php if ($fundtype == 0) echo "selected = 'selected'"; ?>>Public</option>
																<option value="1" <?php if ($fundtype == 1) echo "selected = 'selected'"; ?>>NonPublic</option>													
                                                            <?php echo $fields->getField('fundtype')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="Remarks"  id="remarks" value="<?php echo $Remarks; ?>" style="width:200px; text-transform: uppercase;"/> 
                                                            <?php echo $fields->getField('Remarks')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                                         <div id="Genediv">  
                                                                <input type="text" class="text" name="identificationno"  id="identificationno" value="" style="width:250px;"/>
                                                           <input type="hidden" name="identificationnos" id="identificationnos" value=""/>
                                                              </div>
                                                            <?php// include('../view/findgenerateCodeList.php'); ?>
                                                            <!--
                                                            <div id="Genediv"> 
                                                                <input type="text" class="text" name="identificationno"  id="identificationno" value="" style="width:250px"/>
                                                            </div>
                                                            -->
                                                            <a href="#" onclick="getGeneratedCodeList('index.php?action=generateCodeList')" class="green">Generate Number</a>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php if($groupId==0){echo "Add Office Equipment Details";} else {echo "Update Office Equipment Details";} ?></span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                     <?php if (isset($notapprived) && $notapprived == 1) { ?>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px;" disabled/>
                                                        </td>
                                                    </tr>
                                                    <?php }?>   
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
										<input type="reset" value="Reset">
                                    </form>
                                     <?php if (isset($lastCounterID) && isset($newCounterID) && $lastCounterID == $newCounterID) { ?>
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" onsubmit="return confirm('Are you sure you want to Delete this Record? <?php echo $delComfirem; ?>');"> 
                                        <input type="hidden" name="action" value="delete_Details" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="groupId" value="<?php echo $groupId; ?>" />
                                        <input type="hidden" name="identificationno" value="<?php echo $identificationno; ?>" />
                                        <input type="hidden" name="identificationnoTem" value="<?php echo $identificationnoTem; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    
                                                    <tr>
                                                      
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Delete Plant & Machinery Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <?php } ?>
                                    <div id="Itmdiv">
                                        <div class="table_wrapper">
                                            <div class="table_wrapper_inner">

                                            </div>
                                        </div>
                                    </div>
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










