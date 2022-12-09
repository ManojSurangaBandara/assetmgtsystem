<?php
include '../view/header1.php';
?>

<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper" id="title">
                <span><h2><?php if ($id == 0) {
        echo $title[$lang];
    } else {
        echo $identificationnoTem;
    } ?></h2></span>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">
                                    <ul class="system_messages" id="message">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title"><?php echo $errors[0][$lang] ?></strong></li>
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

                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <input type="hidden" name="action" value="Add_Land_Detail_Ajax" />
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="identificationnoTem" value="<?php echo $identificationnoTem; ?>" />
                                        <input type="hidden" name="counterID" id="counterID" value="" />
									<?php 
									if ($displaytype == 1) {?>
									<div id="accordion">
									<h3>First Panel</h3>
									<div id="tabs-1"> 
									<?php } else if ($displaytype == 2) {?>
									<div id="tabs">
									<ul>
										<li><a href="#tabs-1">First Tab</a></li>
										<li><a href="#tabs-2">Second Tab</a></li>
										<li><a href="#tabs-3">Third Tab</a></li>
										<li><a href="#tabs-4">Fourth Tab</a></li>
									</ul>
									<div id="tabs-1">
									<?php } ?>
                                        <label for="assetscenter" class="label"><?php echo $tList[0][$lang] ?></label>
                                        <div> 
                                            <select name="assetscenter" id="assetscenter">
                                                <option value=""></option>
                                                <?php foreach ($assetsCenters as $center) { ?>
                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $center->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
<?php echo $fields->getField('assetscenter')->getHTML(); ?><br />
                                        </div>

                                        <label for="assetunit" class="label"><?php echo $tList[1][$lang] ?></label>                                                        
                                        <div id="Unitdiv">
                                            <select name="assetunit" id="assetunit">
                                                <option value=""></option>
                                                <?php foreach ($assetunits as $unit) { ?>
                                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $unit->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>

<?php echo $fields->getField('assetunit')->getHTML(); ?><br />
                                        </div>
                                        <label for="province" class="label"><?php echo $tList[2][$lang] ?></label>                                                       
                                        <div>
                                            <select name="province" id="province">
                                                <option value=""></option>
                                                <?php foreach ($provinces as $prov) { ?>
                                                    <option value="<?php echo $prov->getName(); ?>" <?php if ($province == $prov->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $prov->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
<?php echo $fields->getField('province')->getHTML(); ?><br />
                                        </div>
                                        <label for="district" class="label"><?php echo $tList[3][$lang] ?></label>
                                        <div id="Disdiv">
                                            <select name="district" id="district">
                                                <option value=""></option>
                                                <?php foreach ($districts as $dist) { ?>
                                                    <option value="<?php echo $dist->getName(); ?>" <?php if ($district == $dist->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $dist->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
<?php echo $fields->getField('district')->getHTML(); ?><br />
                                        </div>
                                        <label for="dsDivision" class="label"><?php echo $tList[4][$lang] ?></label>                                                       
                                        <div id="DSdiv">
                                            <select name="dsDivision" id="dsDivision">
                                                <option value=""></option>
                                                <?php foreach ($dsdivisions as $dsdi) { ?>
                                                    <option value="<?php echo $dsdi->getName(); ?>" <?php if ($dsDivision == $dsdi->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $dsdi->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>

<?php echo $fields->getField('dsDivision')->getHTML(); ?><br />
                                        </div>
                                        <label for="GSdiv" class="label"><?php echo $tList[5][$lang] ?></label>
                                        <div id="GSdiv">
                                            <select name="gsDivision" id="gsDivision">
                                                <option value=""></option>
                                                <?php foreach ($gsdivisions as $gsdi) { ?>
                                                    <option value="<?php echo $gsdi->getName(); ?>" <?php if ($gsDivision == $gsdi->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $gsdi->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
<?php echo $fields->getField('gsDivision')->getHTML(); ?><br />                                                        
                                        </div>
									<?php if ($displaytype == 1) {?>
										</div>
									<h3>Second Panel</h3>
											<div id="tabs-2">
										<?php } else if ($displaytype == 2) {?>
										</div>
									 <div id="tabs-2">
									 <?php } ?>
                                        <label for="category" class="label"><?php echo $tList[6][$lang] ?></label>
                                        <div>
                                            <select name="category"  id="category">
                                                <option value=""></option>
                                                <?php foreach ($landcategorys as $landcata) { ?>
                                                    <option value="<?php echo $landcata->getName(); ?>" <?php if ($category == $landcata->getName()) echo "selected = 'selected'"; ?>>
                                                <?php echo $landcata->getName(); ?>
                                                    </option>
<?php } ?>
                                            </select>
                                            <?php echo $fields->getField('category')->getHTML(); ?><br />
                                        </div>
                                        <label for="assetsno" class="label"><?php echo $tList[7][$lang] ?></label>
                                        <div id="Itmdiv">
                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; text-align: right;"/>
<?php echo $fields->getField('assetsno')->getHTML(); ?>
                                            <input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $classificationno; ?>" style="width:100px; text-align: right;"/>
<?php echo $fields->getField('classificationno')->getHTML(); ?>
                                            <br />
                                        </div>
                                        <label for="natureOwnership" class="label"><?php echo $tList[8][$lang] ?></label></td>
                                        <div>
                                            <select name="natureOwnership" id="natureOwnership">
                                                <option value=""></option>
                                                <option value="Freehold" <?php if ($natureOwnership == "Freehold") echo "selected = 'selected'"; ?>>Freehold</option>
                                                <option value="Encroached" <?php if ($natureOwnership == "Encroached") echo "selected = 'selected'"; ?>>Encroached</option>
                                            </select>
<?php echo $fields->getField('natureOwnership')->getHTML(); ?><br />
                                        </div>
                                        <label for="ownership" class="label"><?php echo $tList[9][$lang] ?></label>
                                        <div>			          
                                            <select name="ownership" id="ownership" onChange="getPresentUnitByUnit('index.php?action=findOwnership&ownership=' + this.value)">
                                                <option value=""></option>
                                                <option value="Army Land"  <?php if ($ownership == "Army Land") echo "selected = 'selected'"; ?>>Army Land</option>
                                                <option value="Other Land" <?php if ($ownership == "Other Land") echo "selected = 'selected'"; ?>>Other Land</option>
                                            </select>
                                            <?php echo $fields->getField('ownership')->getHTML(); ?><br />
                                        </div>
                                        <label for="landname" class="label"><?php echo $tList[11][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="landname"  id="landname" value="<?php echo $landname; ?>" style="width:200px;"/>
                                            <?php echo $fields->getField('landname')->getHTML(); ?><br />
                                        </div>	
											<?php if ($displaytype == 1) {?>									
											</div>
	<h3>Third Panel</h3>
        <div id="tabs-3">
		<?php } else if ($displaytype == 2) {?>
										</div>
									 <div id="tabs-3">
									 <?php } ?>
										
                                        <label for="register" class="label"><?php echo $tList[10][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="register"  id="register" value="<?php echo $register; ?>" style="width:200px;"/>
                                            <?php echo $fields->getField('register')->getHTML(); ?><br />
                                        </div>
                                        <label for="register" class="label"><?php echo $tList[12][$lang] ?></label></td>
                                        <div> 
                                            <input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:200px;"/>
                                            <?php echo $fields->getField('planno')->getHTML(); ?><br />	
                                        </div>
                                        <label for="deedno" class="label"><?php echo $tList[13][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="deedno"  id="deedno" value="<?php echo $deedno; ?>" style="width:75px;"/>
                                            <?php echo $fields->getField('deedno')->getHTML(); ?><br />
                                        </div>
                                        <label for="deeddate" class="label"><?php echo $tList[14][$lang] ?></label>
                                        <div> 
                                            <input type='text' class="date" name="deeddate" id="deeddate" value="<?php echo $deeddate; ?>" style="width:90px;"/>
                                            <?php echo $fields->getField('deeddate')->getHTML(); ?><br />
                                        </div>
                                        <label for="landNature" class="label"><?php echo $tList[15][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="landNature"  id="landNature" value="<?php echo $landNature; ?>" style="width:200px;"/>
<?php echo $fields->getField('landNature')->getHTML(); ?><br />	
                                        </div>
                                        <label for="areaMeasure" class="label"><?php echo $tList[16][$lang] ?></label>    
                                        <div> 
                                            <select name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" onChange="getUnitConvertUnit('index.php?action=findUnitConvertUnit&areaMeasure=' + this.value)">
                                                <option value=""></option>
                                                <option value="Imperial Units"  <?php if ($areaMeasure == "Imperial Units") echo "selected = 'selected'"; ?>>Imperial Units</option>
                                                <option value="Metric Units" <?php if ($areaMeasure == "Metric Units") echo "selected = 'selected'"; ?>>Metric Units</option>
                                            </select>
                                            <?php echo $fields->getField('areaMeasure')->getHTML(); ?><br />
                                        </div>
                                        <label for="Areadiv" class="label"><?php echo $tList[17][$lang] ?></label> 
                                        <div id="Areadiv">  
<?php include('../view/findunitconvertunit.php'); ?>
                                        </div>		

<?php if ($displaytype == 1) {?>									
											</div>
	<h3>Fourth Panel</h3>
        <div id="tabs-4">
		<?php } else if ($displaytype == 2) {?>
										</div>
									 <div id="tabs-4">
									 <?php } ?>
										
                                        <label for="estimatedValue" class="label"><?php echo $tList[18][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="estimatedValue"  id="estimatedValue" value="<?php echo $estimatedValue; ?>" style="width:75px; text-align: right;" onkeypress="return isNumberKey(event)"/>
<?php echo $fields->getField('estimatedValue')->getHTML(); ?><br />
                                        </div>
                                        <label for="areaMeasure" class="label"><?php echo $tList[19][$lang] ?></label>
                                        <div>
                                            <select name="acquisitionInstitute" id="acquisitionInstitute">
                                                <option value="">--</option>
                                                <?php foreach ($institutes as $center) { ?>
                                                    <option value="<?php echo $center['instName']; ?>" <?php if ($acquisitionInstitute == $center['instName']) echo "selected = 'selected'"; ?>>
                                                <?php echo $center['instName']; ?>
                                                    </option>
<?php } ?>
                                            </select>
                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br />
                                        </div>
                                        <label for="areaMeasure" class="label"><?php echo $tList[20][$lang] ?></label></td>
                                        <div> 
                                            <input type='acquisitiondate' class="date" name="acquisitiondate" id="acquisitiondate" value="<?php echo $acquisitiondate; ?>" style="width:90px;"/>
                                            <?php echo $fields->getField('acquisitiondate')->getHTML(); ?><br />
                                        </div>
                                        <label for="remarks" class="label"><?php echo $tList[21][$lang] ?></label>
                                        <div> 
                                            <input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:200px;"/> 
<?php echo $fields->getField('remarks')->getHTML(); ?><br />
                                        </div>
<?php if ($displaytype == 1) {?>
										</div>	
</div>
<?php } else if ($displaytype == 2) {?>
										</div>	
</div>
<?php }?>

                                        <div> 	</div>
                                        <div> 	
                                            <label for="identificationno" class="label"><?php echo $tList[22][$lang] ?></label>
                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php //echo $identificationno;  ?>" style="width:300px"/>
                                            <button id="button">Generate Number</button>
<?php echo $fields->getField('identificationno')->getHTML(); ?>
                                        </div>
                                        <div id="PreLocdiv">

                                        </div>	
                                        <div><input type="submit" name="submit" id="submit" value="Add Land Details"></div>
                                        <div><input type="submit" name="submit" id="update" value="Delete Land Details"></div> 
                                        <div id="notapprove">
                                            <label  for="notapprivedReason" class="label"><?php echo $tList[23][$lang] ?></label>
                                            <div><input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px; background-color:white; color: black" disabled/></div>
                                        </div>
                                    </form>
                                    <div id="confirm" title="Confirm Destruction"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script  src="add_land_details.js"></script>
<?php
include('sidebar.php');
include '../view/footer.php';
?>










