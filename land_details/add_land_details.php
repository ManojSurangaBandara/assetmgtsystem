<?php
include 'header1.php';
?>
<script>	
/* $(document).ready(function () {
	$('#inputField2').blur(function() {
		alert();
	});
}); */
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php if ($id == 0) {echo $title[$lang];} else {echo $identificationnoTem;} ?></h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title"><?php echo $errors[0][$lang]?></strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Land Details Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="Add_Land_Detail" />
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
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>

                                                        <td width="70%">
                                                            <select name="province" onChange="getDistrictByProvince('index.php?action=findDistrictByProvince&province=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($provinces as $prov) { ?>
                                                                    <option value="<?php echo $prov->getName(); ?>" <?php if ($province == $prov->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $prov->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $fields->getField('province')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Disdiv">
                                                                <select name="district" onChange="getDSByDistrict('index.php?action=findDSByDistrict&district=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($districts as $dist) { ?>
                                                                        <option value="<?php echo $dist->getName(); ?>" <?php if ($district == $dist->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $dist->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('district')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <div id="DSdiv">
                                                                <select name="dsDivision" onChange="getGSByDS('index.php?action=findGSByDS&dsDivision=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($dsdivisions as $dsdi) { ?>
                                                                        <option value="<?php echo $dsdi->getName(); ?>" <?php if ($dsDivision == $dsdi->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $dsdi->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('dsDivision')->getHTML(); ?><br /></td>
                                                        </div>
                                                        </td> 
                                                    </tr>														  
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="GSdiv">
                                                                <select name="gsDivision">
                                                                    <option value=""></option>
                                                                    <?php foreach ($gsdivisions as $gsdi) { ?>
                                                                        <option value="<?php echo $gsdi->getName(); ?>" <?php if ($gsDivision == $gsdi->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $gsdi->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                                <?php echo $fields->getField('gsDivision')->getHTML(); ?><br />
                                                        </td>

                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="category"  onChange="getrequestitem('index.php?action=findAssetsnoByCategory&category=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($landcategorys as $landcata) { ?>
                                                                    <option value="<?php echo $landcata->getName(); ?>" <?php if ($category == $landcata->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $landcata->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>

                                                            <?php echo $fields->getField('category')->getHTML(); ?><br />
                                                        </td>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Itmdiv">
                                                                <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; text-align: right;"/>
                                                                <?php echo $fields->getField('assetsno')->getHTML(); ?>
                                                                <input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $classificationno; ?>" style="width:100px; text-align: right;"/>
                                                                <?php echo $fields->getField('classificationno')->getHTML(); ?>

                                                                <br />

                                                        </td>
                                                        </div>
                                                    </tr>
													 <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="landNature"  id="landNature" value="<?php echo $landNature; ?>" style="width:350px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('landNature')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%"><select name="natureOwnership">
                                                                <option value=""></option>
                                                                <option value="ACQUIRED" <?php if ($natureOwnership == "ACQUIRED") echo "selected = 'selected'"; ?>>ACQUIRED</option>
																<option value="DONATION" <?php if ($natureOwnership == "DONATION") echo "selected = 'selected'"; ?>>DONATION</option>
																<option value="LEASE" <?php if ($natureOwnership == "LEASE") echo "selected = 'selected'"; ?>>LEASE</option>
																<option value="PURCHASE" <?php if ($natureOwnership == "PURCHASE") echo "selected = 'selected'"; ?>>PURCHASE</option>
                                                            </select>
                                                            <?php echo $fields->getField('natureOwnership')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>														  
                                                        <td><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td>              
                                                            <select name="ownership" onChange="getPresentUnitByUnit('index.php?action=findOwnership&ownership=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="ARMY LAND"  <?php if ($ownership == "ARMY LAND") echo "selected = 'selected'"; ?>>ARMY LAND</option>
                                                                <option value="OTHER LAND" <?php if ($ownership == "OTHER LAND") echo "selected = 'selected'"; ?>>OTHER LAND</option>
                                                            </select>
                                                            <?php echo $fields->getField('ownership')->getHTML(); ?><br /></td>
                                                        </td> 
                                                    </tr>
                                                    <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                    <td width="70%"><input type="text" class="text" name="register"  id="register" value="<?php echo $register; ?>" style="width:200px; text-transform: uppercase;"/>
                                                        <?php echo $fields->getField('register')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="landname"  id="landname" value="<?php echo $landname; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('landname')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:200px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('planno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="deedno"  id="deedno" value="<?php echo $deedno; ?>" style="width:75px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('deedno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%"><input type='text' class="text" name="deeddate" value="<?php echo $deeddate; ?>" id="inputField1" style="width:90px;"/>
                                                            <?php echo $fields->getField('deeddate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                   <tr>
                                                    <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                    <td width="70%"><input type='text' class="text" name="acquisitiondate" value="<?php echo $acquisitiondate; ?>" id="inputField2" style="width:90px;"/>
                                                        <?php echo $fields->getField('acquisitiondate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td>    
                                                            <select name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" onChange="getUnitConvertUnit('index.php?action=findUnitConvertUnit&areaMeasure=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="IMPERIAL UNITS"  <?php if ($areaMeasure == "IMPERIAL UNITS") echo "selected = 'selected'"; ?>>IMPERIAL UNITS</option>
                                                                <option value="METRIC UNITS" <?php if ($areaMeasure == "METRIC UNITS") echo "selected = 'selected'"; ?>>METRIC UNITS</option>
                                                            </select>
                                                       <!-- <td width="70%"><input type="text" class="text" name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" style="width:200px;"/> -->
                                                            <?php echo $fields->getField('areaMeasure')->getHTML(); ?><br /></td>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%"> 
                                                            <div id="Areadiv">  
                                                                <?php include('../view/findunitconvertunit.php'); ?>
                                                            </div>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="estimatedValue"  id="estimatedValue" value="<?php echo $estimatedValue; ?>" style="width:150px; text-align: right;" onkeypress="return isNumberKey(event)"/>
                                                            <?php echo $fields->getField('estimatedValue')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="acquisitionInstitute">
                                                                <option value=""></option>
																<option value="GOVERNMENT" <?php if ($acquisitionInstitute == "GOVERNMENT") echo "selected = 'selected'"; ?>>GOVERNMENT</option>
																<option value="PRIVATE" <?php if ($acquisitionInstitute == "PRIVATE") echo "selected = 'selected'"; ?>>PRIVATE</option>
                                                                <!--
																<?php foreach ($institutes as $center) { ?>
                                                                    <option value="<?php echo $center['instName']; ?>" <?php if ($acquisitionInstitute == $center['instName']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center['instName']; ?>
                                                                    </option>
                                                                <?php } ?>
																-->
                                                            </select>
															<input type="text" class="text" name="previousownership"  id="previousownership" value="<?php echo $previousownership; ?>" style="width:250px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br /></td>
                                                    </tr>
													
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:200px; text-transform: uppercase;"/> 
                                                            <?php echo $fields->getField('remarks')->getHTML(); ?><br /></td>
                                                    </tr>
                                                     <tr>
                                                        <td width="30%"><label><?php echo $tList[24][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="valCost"  id="valCost" value="<?php echo $valCost; ?>" style="width:200px; text-transform: uppercase;"/> 
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[25][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="refValue"  id="refValue" value="<?php echo $refValue; ?>" style="width:200px; text-transform: uppercase;"/> 
                                                            </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="identificationno"  id="identificationno" value="<?php //echo $identificationno; ?>" style="width:300px"/>
                                                            <a href="#" onclick="getGeneratedCode('index.php?action=generateCode')" class="green">Generate Number</a>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <div id="PreLocdiv">

                                                    </div>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                
                                                                    <span class="button send_form_btn"><span><span><?php if($id==0){echo "Add Land Details";} else {echo "Update Land Details";} ?></span></span><input name="" type="submit"/></span> 
                                                                      
                                                            </div>

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
                                            </td>
                                            </tr>
                                        </table>
										<input type="reset" value="Reset">
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










