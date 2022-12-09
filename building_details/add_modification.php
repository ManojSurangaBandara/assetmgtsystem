<?php include 'header1.php'; ?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php echo $identificationno; ?></h2>
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
                                         <input type="hidden" name="action" value="SelectModificationSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                 <table width="100%" border="0" class="listing form">
                                                   <tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetscenter"  id="assetscenter" value="<?php echo $assetscenter; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetunit"  id="assetunit" value="<?php echo $assetunit; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="province"  id="province" value="<?php echo $province; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="district"  id="district" value="<?php echo $district; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="dsDivision"  id="dsDivision" value="<?php echo $dsDivision; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>

                                                        </td> 
                                                    </tr>														  
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="gsDivision"  id="gsDivision" value="<?php echo $gsDivision; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="category"  id="category" value="<?php echo $category; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="natureOwnership"  id="natureOwnership" value="<?php echo $natureOwnership; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>														  
                                                        <td><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ownership"  id="ownership" value="<?php echo $ownership; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="landName"  id="landName" value="<?php echo $landName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ownerName"  id="ownerName" value="<?php echo $ownerName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>


                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="buildingType"  id="buildingType" value="<?php echo $buildingType; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="rentAndRate"  id="rentAndRate" value="<?php echo $rentAndRate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="regOwnerName"  id="regOwnerName" value="<?php echo $regOwnerName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="buildingno"  id="buildingno" value="<?php echo $buildingno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="plandate"  id="plandate" value="<?php echo $plandate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="feets"  id="feets" value="<?php echo $feets; ?>" style="width:75px; background-color:white; color: black" disabled/>
                                                                <?php echo $fields->getField('feets')->getHTML(); ?>
                                                            <input type="text" class="text" name="area"  id="area" value="<?php echo $area; ?>" style="width:75px; background-color:white; color: black" disabled/>
                                                            <?php echo $fields->getField('area')->getHTML(); ?><br />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="constructionCost"  id="constructionCost" value="<?php echo $constructionCost; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="additionsValue"  id="additionsValue" value="<?php echo $additionsValue; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[23][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="alterationValue"  id="alterationValue" value="<?php echo $alterationValue; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <td width="30%"><label><?php echo $tList[24][$lang]?></label></td>
                                                    <td width="70%">
                                                        <input type="text" class="text" name="acquisitiondate"  id="acquisitiondate" value="<?php echo $acquisitiondate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[25][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Modification Allow :</label></td>
                                                        <td width="70%">
                                                            <input name="selectmodification" type="checkbox" value="1"> Select / Deselect
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
															   <li><span class="button send_form_btn"><span><span>Select for Modification</span></span><input name="" type="submit"/></span> </li>
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










