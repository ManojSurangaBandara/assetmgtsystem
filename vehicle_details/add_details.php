<?php include 'header1.php'; ?>
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
				
	$('#brandName').change(function() {
		getmodels($(this).val(), "");
	});
	function getmodels(brand, model)
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
				$('#modleName').html(option);
				$('#modleName option[value="' + model + '"]').attr('selected', 'selected');
			} // end processData
		};	

/* 	$("#fuel").on( "blur", function() {
	var itemCategory = $('#itemCategory').val();
	var fuel = $('#fuel').val();
	if(itemCategory == 'BICYCLE' && fuel != 'OTHER') {
		alert('Bicycle Fuel should be Other');
	} else if(itemCategory == 'MOTOR CYCLE' && fuel != 'PETROL') {
		alert('Motor Bicycle Fuel should be Petrol');
	} else if(itemCategory == 'BUS' && fuel != 'DIESEL') {
		alert('Bus Fuel should be Diesel');
	} else if(itemCategory == 'TRUCK' && fuel != 'DIESEL') {
		alert('Truck Fuel should be Diesel');
	}
}); */

$('#fuel').change(function() {
		var itemCategory = $('#itemCategory').val();
		var fuel = $('#fuel').val();
		if(itemCategory == 'BICYCLE' && fuel != 'OTHER') {
			alert('Bicycle Fuel should be Other');
		} else if(itemCategory == 'MOTOR CYCLE' && fuel != 'PETROL') {
			alert('Motor Bicycle Fuel should be Petrol');
		} else if(itemCategory == 'BUS' && fuel != 'DIESEL') {
			alert('Bus Fuel should be Diesel');
		} else if(itemCategory == 'TRUCK' && fuel != 'DIESEL') {
			alert('Truck Fuel should be Diesel');
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
                <h2><?php if ($id == 0) {echo "ADD - Vehicle Details";} else {echo $identificationnoTem;} ?></h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Vehicle Details" Button</strong></li>
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
                                                                <select name="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&center=' + this.value)">
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
                                                                <select name="itemCategory" id="itemCategory" onChange="getDSByDistrict('index.php?action=findDescriptionByCategory&itemCategory=' + this.value)">
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
                                                                <select name="itemDescription" onChange="getMakeByDescription('index.php?action=findMakeByDescription&itemDescription=' + this.value)">
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
                                                    <!--
                                                     <tr>
                                                         <td width="30%"><label>Manufacture/Make :</label></td>
                                                         <td  width="70%">
                                                             <div id="Makediv">
                                                                 <select name="$make" onChange="getModelByMake('index.php?action=findModelByMake&make=' + this.value)">
                                                                     <option value=""></option>
                                                    <?php foreach ($makes as $mak) { ?>
                                                                             <option value="<?php echo $mak->getName(); ?>" <?php if ($make == $mak->getName()) echo "selected = 'selected'"; ?>>
                                                        <?php echo $mak->getName(); ?>
                                                                             </option>
                                                    <?php } ?>
                                                                 </select>
 
                                                    <?php echo $fields->getField('make')->getHTML(); ?><br /></td>
                                                         </div>
                                                         </td> 
                                                     </tr>
 
                                                     <tr>
                                                         <td width="30%"><label>Modle :</label></td>
                                                         <td  width="70%">
                                                             <div id="Modlediv">
                                                                 <select name="$modle" onChange="getCataloguenoByModle('index.php?action=findCataloguenoByModle&modle=' + this.value)">
                                                                     <option value=""></option>
                                                    <?php foreach ($modles as $modl) { ?>
                                                                             <option value="<?php echo $modl->getName(); ?>" <?php if ($modle == $modl->getName()) echo "selected = 'selected'"; ?>>
                                                        <?php echo $modl->getName(); ?>
                                                                             </option>
                                                    <?php } ?>
                                                                 </select>
 
                                                    <?php echo $fields->getField('modle')->getHTML(); ?><br /></td>
                                                         </div>
                                                         </td> 
                                                     </tr>
                                                    -->
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


                                                                <input hidden type="text" class="text" name="make"  id="make" value="<?php echo $assetsnos->getMake(); ?>" style="width:100px; background-color:white; color: black" disabled/>
                                                                <input type="hidden" name="make" value="<?php echo $assetsnos->getMake(); ?>"/>

                                                                <input hidden type="text" class="text" name="modle"  id="modle" value="<?php echo $assetsnos->getModle(); ?>" style="width:150px; background-color:white; color: black" disabled/>
                                                                <input type="hidden" name="modle" value="<?php echo $assetsnos->getModle(); ?>"/>

                                                                <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px; background-color:white; color: black" disabled/>
                                                                <input type="hidden" name="assetsno" value="<?php echo $assetsnos->getId(); ?>"/>

                                                                <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px; background-color:white; color: black" disabled/>
                                                                <input type="hidden" name="newAssestno" value="<?php echo $assetsnos->getName(); ?>"/>


<!--      <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsnos->getId(); ?>" style="width:50px"/>
                                                                <?php echo $fields->getField('assetsno')->getHTML(); ?>
<input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $assetsnos->getName(); ?>" style="width:100px"/>
                                                                <?php echo $fields->getField('newAssestno')->getHTML(); ?>
<input type="text" class="text" name="make"  id="make" value="<?php echo $assetsnos->getId(); ?>" style="width:100px"/>
                                                                <?php echo $fields->getField('make')->getHTML(); ?>
<input type="text" class="text" name="modle"  id="modle" value="<?php echo $assetsnos->getName(); ?>" style="width:100px"/>
                                                                <?php echo $fields->getField('modle')->getHTML(); ?><br />
                                                                -->  
                                                            </div>  
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[32][$lang]?></label></td>
                                                        <td width="70%"><select name="natureOwnership">
                                                                <option value=""></option>                                                               																
                                                                <option value="CAPTURED" <?php if ($natureOwnership == "CAPTURED") echo "selected = 'selected'"; ?>>CAPTURED</option>
																<option value="DONATION" <?php if ($natureOwnership == "DONATION") echo "selected = 'selected'"; ?>>DONATION</option>
																 <option value="PURCHASE" <?php if ($natureOwnership == "PURCHASE") echo "selected = 'selected'"; ?>>PURCHASE</option>
                                                            </select>
                                                            <?php echo $fields->getField('natureOwnership')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Brand :</label></td>
                                                        <td width="70%">
                                                            <select name="brandName" id="brandName" class="text">
                                                                <option value=""></option>
                                                                <?php foreach ($brandNames as $cat) { ?>
                                                                    <option value="<?php echo $cat['brand']; ?>"<?php if ($brandName == $cat['brand']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $cat['brand']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Modle :</label></td>
                                                        <td width="70%">
                                                            <select name="modleName" id="modleName" class="text">
                                                                <option value=""></option>
                                                                <?php foreach ($modleNames as $cat) { ?>
                                                                    <option value="<?php echo $cat['modle']; ?>">
                                                                        <?php echo $cat['modle']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select><br /></td>
                                                    </tr>													
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="engineno"  id="engineno" value="<?php echo $engineno; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('engineno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="chessisno"  id="chessisno" value="<?php echo $chessisno; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('chessisno')->getHTML(); ?><br /></td>
                                                    </tr>
															<?php $myear = array();
															for ($i = date("Y"); $i > 1950; $i--)
															{
																$myear[] = $i;
															} ?>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>                                                        	
														<td width="70%">
														<select name="yearManufacture" id="yearManufacture" class="text">
                                                                <option value=""></option>
                                                                <?php foreach ($myear as $cat) { ?>
                                                                    <option value="<?php echo $cat; ?>"<?php if ($yearManufacture == $cat) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $cat; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
														<!--<input type="text" class="text" name="yearManufacture"  id="yearManufacture" value="<?php echo $yearManufacture; ?>" style="width:200px"/> -->
                                                            <?php echo $fields->getField('yearManufacture')->getHTML(); ?><br /></td>
                                                    </tr>


                                                    <tr hidden>														  
                                                        <td><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td>              <select name="ownerShip" class="textbox">
                                                                <option value=""></option>
                                                                <option value="ARMY" <?php if ($ownerShip == "ARMY") echo "selected = 'selected'"; ?>>ARMY</option>
                                                                <option value="CIVIL" <?php if ($ownerShip == "CIVIL") echo "selected = 'selected'"; ?>>CIVIL</option>
                                                            </select>
                                                            <?php echo $fields->getField('ownerShip')->getHTML(); ?><br /></td>
                                                        </td> 
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">UHA - </label>
														<input type="number" class="text" name="armyno"  id="armyno" value="<?php echo $armyno; ?>" style="width:100px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('armyno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="civilno"  id="civilno" value="<?php echo $civilno; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('civilno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>														  
                                                        <td><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td>              <select name="fuel" id="fuel" class="textbox">
                                                                <option value=""></option>                                                               
                                                                <option value="DIESEL" <?php if ($fuel == "DIESEL") echo "selected = 'selected'"; ?>>DIESEL</option>
																<option value="ELECTRIC" <?php if ($fuel == "ELECTRIC") echo "selected = 'selected'"; ?>>ELECTRIC</option>
																<option value="HYBRID" <?php if ($fuel == "HYBRID") echo "selected = 'selected'"; ?>>HYBRID</option>                                                                
																 <option value="PETROL" <?php if ($fuel == "PETROL") echo "selected = 'selected'"; ?>>PETROL</option>
																 <option value="OTHER" <?php if ($fuel == "OTHER") echo "selected = 'selected'"; ?>>OTHER</option>
                                                            </select>
                                                            <?php echo $fields->getField('fuel')->getHTML(); ?><br /></td>
                                                        </td> 
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%"><input type='text' class="text" name="purchasedDate" value="<?php echo $purchasedDate; ?>" id="inputField1" style="width:90px;"/>
                                                            <?php echo $fields->getField('purchasedDate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%"><input type="number" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right;" onkeypress="validate(event)"/><span name="maxminval"  id="maxminval"> </span>
                                                            <?php echo $fields->getField('unitValue')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td width="30%"><label>Total Cost :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:200px; text-align: right;"/>
                                                            <?php echo $fields->getField('totalCost')->getHTML(); ?><br /></td>
                                                    </tr> -->
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="horsePower"  id="horsePower" value="<?php echo $horsePower; ?>" style="width:200px; text-align: right"/>
                                                            <?php echo $fields->getField('horsePower')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="tare"  id="tare" value="<?php echo $tare; ?>" style="width:200px; text-align: right"/>
                                                            <?php echo $fields->getField('tare')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <!--
                                                    <tr>
                                                        <td width="30%"><label>Present Location  :</label></td>
                                                        <td width="70%">
                                                            <div id="PreLocdiv">
                                                                <select name="presentLocation" >
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($presentLocation == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('presentLocation')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    -->    
													<tr hidden>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
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
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%"><input type='text' class="text" name="receivedDate" value="<?php echo $receivedDate; ?>" id="inputField2" style="width:90px;"/>
                                                            <?php echo $fields->getField('receivedDate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                               <select name="presentLocation">
                                                                <option value="<?php echo $assetunit; ?>"><?php echo $assetunit; ?></option>
																	<?php foreach ($presentLocations as $unit) { ?>
																		<option value="<?php echo $unit['locations']; ?>" <?php if ($presentLocation == $unit['locations']) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit['locations']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php echo $fields->getField('presentLocation')->getHTML(); ?><br /></td>
                                                        </td>
                                                    </tr>
                                                       
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[33][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="CapRepairCost"  id="CapRepairCost" value="<?php echo ($capRprCost ?? ""); ?>" style="width:200px; text-transform: uppercase;"/> 
                                                           
                                                    </tr>
                                                    
                                                    
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="Remarks"  id="remarks" value="<?php echo $Remarks; ?>" style="width:200px; text-transform: uppercase;"/> 
                                                            <?php echo $fields->getField('Remarks')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php // echo $identificationno; ?>" style="width:250px" readonly="readonly"/>
                                                            <a href="#" onclick="getGeneratedCode('index.php?action=generateCode')" class="green">Generate Number</a>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php if($id==0){echo "Add Vehicle Details";} else {echo "Update Vehicle Details";} ?></span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                            <?php if (isset($notapprived) && $notapprived == 1) { ?>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[23][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px;" disabled/>
                                                        </td>
                                                    </tr>
                                                    <?php }?>  
                                        </table>
										<input type="reset" value="Reset">
                                    </form>
                                    <?php if (isset($lastCounterID) && isset($newCounterID) && $lastCounterID == $newCounterID) { ?>
                                    <form name="frm_land_add" method="post" id="frm_land_add" action="index.php" class="search_form general_form" onsubmit="return confirm('Are you sure you want to Delete this Record? <?php echo $delComfirem; ?>');"> 
                                        <input type="hidden" name="action" value="delete_Details" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
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










