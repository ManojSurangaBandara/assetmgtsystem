<?php include 'header1.php'; ?>
<div id="page">
    <div class="inner">
        <div class="section">
                        <div class="title_wrapper" id="title">
                <span><h2><?php if ($id == 0) {
        //echo $title[$lang];
		echo "ADD - Building Details";
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
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form">  
                                        <input type="hidden" name="action" value="Add_Building_Detail_ajax" />
                                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                                        <input type="hidden" name="identificationnoTem" id="identificationnoTem" value="<?php echo $identificationnoTem; ?>" />
                                        <input type="hidden" name="counterID" id="counterID" value="" />
										<div><label  for="assetscenter" class="label"><?php echo $tList[0][$lang]?></label>
                                                            <select name="assetscenter" id="assetscenter">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
															<div><label class="label"><?php echo $tList[1][$lang]?></label>
                                                                <select name="assetunit" id="assetunit">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select></div>
                                                    <div><label class="label"><?php echo $tList[2][$lang]?></label>
                                                            <select name="province" id="province">
                                                                <option value=""></option>
                                                                <?php foreach ($provinces as $prov) { ?>
                                                                    <option value="<?php echo $prov->getName(); ?>" <?php if ($province == $prov->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $prov->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
															<div><label class="label"><?php echo $tList[3][$lang]?></label>
                                                                <select name="district" id="district">
                                                                    <option value=""></option>                                                                    
                                                                </select>
                                                        </div>
                                                    <div><label class="label"><?php echo $tList[4][$lang]?></label>
                                                                <select name="dsDivision" id="dsDivision">
                                                                    <option value=""></option>
                                                                    </select>
													</div>
                                                        <div><label class="label"><?php echo $tList[5][$lang]?></label>
                                                                <select name="gsDivision" id="gsDivision">
                                                                    <option value=""></option>
                                                                </select></div>
                                                    <div><label class="label"><?php echo $tList[6][$lang]?></label>
                                                            <select name="category"  id="category">
                                                                <option value=""></option>
                                                                <?php foreach ($buildingCategorys as $landcata) { ?>
                                                                    <option value="<?php echo $landcata->getName(); ?>" <?php if ($category == $landcata->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $landcata->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select></div>
															<div><label class="label"><?php echo $tList[7][$lang]?></label>
                                                                <input type="text" class="text" name="assetsno"  id="assetsno" style="width:50px; text-align: right;"/>
                                                                <input type="text" class="text" name="classificationno"  id="classificationno" style="width:100px; text-align: right;"/>
                                                    </div>
													<div><label class="label"><?php echo $tList[8][$lang]?></label>
															<select name="natureOwnership" id="natureOwnership">
                                                                <option value=""></option>
                                                                <option value="Freehold">Freehold</option>
                                                                <option value="Encroached">Encroached</option>
                                                            </select></div>
															<div><label class="label"><?php echo $tList[9][$lang]?></label>             
                                                            <select name="ownership" id="ownership">
                                                                <option value=""></option>
                                                                <option value="Army Land" <?php if ($ownership == "Army Land") echo "selected = 'selected'"; ?>>Army Land</option>
                                                                <option value="Other Land" <?php if ($ownership == "Other Land") echo "selected = 'selected'"; ?>>Other Land</option>
                                                            </select></div>
															<div><label class="label"><?php echo $tList[10][$lang]?></label>
                                                        <input type="text" class="text" name="landName"  id="landName" style="width:200px"/>
														</div>
															<div><label class="label"><?php echo $tList[11][$lang]?></label>
                                                        <input type="text" class="text" name="ownerName"  id="ownerName" style="width:200px"/>
                                                           </div> 
                                                        <div><label class="label"><?php echo $tList[12][$lang]?></label>
                                                        <input type="text" class="text" name="buildingType"  id="buildingType" style="width:200px"/>
                                                           </div>
                                                        <div><label class="label"><?php echo $tList[13][$lang]?></label>
															<input type="text" class="text" name="rentAndRate"  id="rentAndRate" style="width:200px"/>
                                                        </div> 
                                                        <div><label class="label"><?php echo $tList[14][$lang]?></label>
                                                        <input type="text" class="text" name="regOwnerName"  id="regOwnerName" style="width:200px"/>
                                                        </div>    
                                                    
                                                        <div><label class="label"><?php echo $tList[15][$lang]?></label>
                                                        <input type="text" class="text" name="buildingno"  id="buildingno" style="width:200px; text-align: right;"/>
                                                         </div> 
                                                        <div><label class="label"><?php echo $tList[16][$lang]?></label>
                                                        <input type="text" class="text" name="planno" id="planno" style="width:200px; text-align: right;"/>
                                                         </div>  
                                                    
                                                        <div><label class="label"><?php echo $tList[17][$lang]?></label>
                                                        <input type='text' class="date text" name="plandate" id="plandate" style="width:90px;"/>
                                                        </div>    
														<div>	
                                                        <label class="label"><?php echo $tList[18][$lang]?></label>
                                                            <select name="areaMeasure"  id="areaMeasure" onChange="getUnitConvertUnit('index.php?action=findUnitConvertUnit&areaMeasure=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="Imperial Units"  <?php if ($areaMeasure == "Imperial Units") echo "selected = 'selected'"; ?>>Imperial Units</option>
                                                                <option value="Metric Units" <?php if ($areaMeasure == "Metric Units") echo "selected = 'selected'"; ?>>Metric Units</option>
                                                            </select>                                                            
                                                    </div> 
                                                       <div> <label class="label"><?php echo $tList[19][$lang]?></label>
                                                            <div id="Areadiv">  
                                                                <?php include('../view/findunitconvertunitb.php'); ?>
                                                            </div>
														</div> 	
                                                        <div><label class="label"><?php echo $tList[20][$lang]?></label>
                                                        <input type="text" class="text" name="constructionCost"  id="constructionCost" style="width:200px;"/>
                                                        </div>     
                                                                                                        
                                                        <div><label class="label"><?php echo $tList[21][$lang]?></label>
                                                        <input type="text" class="text" name="additionsValue"  id="additionsValue" style="width:75px; text-align: right;"/>
                                                         </div>   
                                                                                                        
                                                        <div><label class="label"><?php echo $tList[22][$lang]?></label>
                                                        <input type="text" class="text" name="alterationValue"  id="alterationValue" style="width:75px; text-align: right;"/>
                                                         </div>                                       
                                                        <div><label class="label"><?php echo $tList[23][$lang]?></label>                                                        
                                                            <select name="acquisitionInstitute" id="acquisitionInstitute" class="text">
                                                                <option value=""></option>
                                                                <?php foreach ($institutes as $center) { ?>
                                                                    <option value="<?php echo $center['instName']; ?>" <?php if ($acquisitionInstitute == $center['instName']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center['instName']; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                         </div>
                                                    <div><label class="label"><?php echo $tList[24][$lang]?></label>
                                                    <input type='text' class="date text" name="acquisitiondate" id="acquisitiondate" style="width:90px;"/>
                                                    </div> 
                                                        <div><label class="label"><?php echo $tList[25][$lang]?></label>
                                                        <input type="text" class="text" name="remarks"  id="remarks" style="width:200px;"/> 
                                                     </div>                                                            
                                                        <div><label class="label"><?php echo $tList[26][$lang]?></label>
                                                        <input type="text" class="text" name="identificationno"  id="identificationno" style="width:300px"/>
                                                        <button id="button">Generate Number</button>
                                                    </div> 
                                                    <div id="PreLocdiv">

                                                    </div>
                                                    <div><input type="submit" name="submit" id="submit" value="Add Details"></div>
                                        <div><input type="submit" name="submit" id="update" value="Delete Building Details"></div> 
                                        <div id="notapprove">
                                            <label  for="notapprivedReason" class="label"><?php echo $tList[27][$lang] ?></label>
                                            <div><input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" style="width:400px; background-color:white; color: black" disabled/></div>
                                        </div>
										<?php if (isset($notapprived) && $notapprived == 1) { ?>
                                                 <label>Reason for not Approve  :</label>
												 <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" style="width:400px;" disabled/>
                                                 <?php } ?>  
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
<script  src="../customjquery/functions.js"></script>
<script  src="../customjquery/message.js"></script> 
<script  src="../customjquery/sidebar.js"></script>
<script  src="add_building_details.js"></script>
<?php
include('sidebar.php');
include '../view/footer.php';
?>










