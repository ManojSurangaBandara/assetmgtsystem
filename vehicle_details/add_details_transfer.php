<?php include 'header1.php'; ?>
<script>	
	$(document).ready(function () {
   $( "#Generate_Number" ).click(function() {
		codegenerate();
	return false;
	});
codegenerate();	
});
   function codegenerate()
    {
        var querystring = {
            id: $('#id').val(),
            assetunit: $('#assetunit').val(),
            assetsno: $('#assetsno').val(),
            catalogueno: $('#catalogueno').val(),
            action: 'generateCode_Ajax'
        }

        $.get('index.php', querystring, processResponse);
        function processResponse(result) {
			var numbers = $.parseJSON(result);
			$('#counterId').val(numbers[0]);
            $('#identificationno').val(numbers[1]);
        } // end processData	
    }
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php echo "ADD - Vehicle Details - Receive from Unit - ".$_GET['identificationno'];?></h2>
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
                                        <input type="hidden" name="action" value="add_details_transfer" />
                                        <input type="hidden" name="idTem" value="<?php echo $id; ?>" />
                                        <!--<input type="hidden" name="identificationnoTem" value="<?php echo $_GET['identificationno']; ?>" /> -->
										<input type="hidden" name="counterId" id="counterId" value="" />
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
                                                                <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&center=' + this.value)">
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
														<input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $Vehicle['mainCategory']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">                                                            
														<input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $Vehicle['itemCategory']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $Vehicle['itemDescription']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                        </td> 
                                                    </tr>  
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $Vehicle['catalogueno']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $Vehicle['assetsno']; ?>" style="width:100px; background-color:white; color: black" disabled/>
														<input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $Vehicle['newAssestno']; ?>" style="width:100px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[32][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="natureOwnership"  id="natureOwnership" value="<?php echo $Vehicle['natureOwnership']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Brand :</label></td>
                                                        <td width="70%">
                                                        <input type="text" class="text" name="brandName"  id="brandName" value="<?php echo $Vehicle['brandName']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Modle :</label></td>
                                                        <td width="70%">
                                                        <input type="text" class="text" name="modleName"  id="modleName" value="<?php echo $Vehicle['modelName']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                        												
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="engineno"  id="engineno" value="<?php echo $Vehicle['engineno']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                        												
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="chessisno"  id="chessisno" value="<?php echo $Vehicle['chessisno']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                       												
                                                    </tr>															
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>                                                        	
														<td width="70%">
														<input type="text" class="text" name="yearManufacture"  id="yearManufacture" value="<?php echo $Vehicle['yearManufacture']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                       												
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="armyno"  id="armyno" value="<?php echo $Vehicle['armyno']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                        											
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="civilno"  id="civilno" value="<?php echo $Vehicle['civilno']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                        													
                                                    </tr>
                                                    <tr>														  
                                                        <td><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td>              
														<input type="text" class="text" name="fuel"  id="fuel" value="<?php echo $Vehicle['fuel']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                        													
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="purchasedDate"  id="purchasedDate" value="<?php echo $Vehicle['purchasedDate']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $Vehicle['unitValue']; ?>" style="width:300px; background-color:white; color: black" disabled/>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="horsePower"  id="horsePower" value="<?php echo $Vehicle['horsePower']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="tare"  id="tare" value="<?php echo $Vehicle['tare']; ?>" style="width:300px; background-color:white; color: black" disabled/></td></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $Vehicle['receivedDate']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="presentLocation">
                                                                    <?php foreach ($presentLocations as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>">
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            <?php echo $fields->getField('presentLocation')->getHTML(); ?><br /></td>
                                                        </td>
                                                    </tr>
                                                       
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Vehicle['Remarks']; ?>" style="width:300px; background-color:white; color: black" disabled/></td>                                                    
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="" style="width:250px" readonly="readonly"/>
                                                            <button name="Generate_Number"  id="Generate_Number" class="ui-button ui-widget ui-corner-all">Generate Number</button>
														</td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Add Vehicle Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
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