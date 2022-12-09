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
                                     <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Press "Approve Building Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Identification Number Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="approveSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
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
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; background-color:white; color: black" disabled/>
															<input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $classificationno; ?>" style="width:100px; background-color:white; color: black" disabled/>
														</td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="buildingType"  id="buildingType" value="<?php echo $buildingType; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="rentAndRate"  id="rentAndRate" value="<?php echo $rentAndRate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													
													<tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="natureOwnership"  id="natureOwnership" value="<?php echo $natureOwnership; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                    <td width="30%"><label><?php echo $tList[24][$lang]?></label></td>
                                                    <td width="70%">
                                                        <input type="text" class="text" name="acquisitiondate"  id="acquisitiondate" value="<?php echo $acquisitiondate; ?>" style="width:200px; background-color:white; color: black" disabled/>
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
                                                            <input type="text" class="text" name="landName"  id="landName" value="<?php echo $landName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ownerName"  id="ownerName" value="<?php echo $ownerName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="rentAndRate"  id="rentAndRate" value="<?php echo $rentAndRate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="regOwnerName"  id="regOwnerName" value="<?php echo $regOwnerName; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="buildingno"  id="buildingno" value="<?php echo $buildingno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="plandate"  id="plandate" value="<?php echo $plandate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="feets"  id="feets" value="<?php echo $feets; ?>" style="width:75px; background-color:white; color: black" disabled/>
                                                                <?php echo $fields->getField('feets')->getHTML(); ?>
                                                            <input type="text" class="text" name="area"  id="area" value="<?php echo $area; ?>" style="width:75px; background-color:white; color: black" disabled/>
                                                            <?php echo $fields->getField('area')->getHTML(); ?><br />
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="constructionCost"  id="constructionCost" value="<?php echo $constructionCost; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="additionsValue"  id="additionsValue" value="<?php echo $additionsValue; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="alterationValue"  id="alterationValue" value="<?php echo $alterationValue; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													  <tr>
                                                        <td width="30%"><label><?php echo $tList[23][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="acquisitionInstitute">
                                                                <option value=""></option>
																<option value="GOVERNMENT" <?php if ($acquisitionInstitute == "GOVERNMENT") echo "selected = 'selected'"; ?>>GOVERNMENT</option>
																<option value="PRIVATE" <?php if ($acquisitionInstitute == "PRIVATE") echo "selected = 'selected'"; ?>>PRIVATE</option>
																<!--
																<option value="">--</option>
                                                                <?php foreach ($institutes as $center) { ?>
                                                                    <option value="<?php echo $center['instName']; ?>" <?php if ($acquisitionInstitute == $center['instName']) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center['instName']; ?>
                                                                    </option>
                                                                <?php } ?>-->
                                                            </select>
															<input type="text" class="text" name="previousownership"  id="previousownership" value="<?php echo $previousownership; ?>" style="width:250px; background-color:white; color: black" disabled/>
															
                                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Fund Type :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="fundtype"  id="fundtype" value="<?php echo ($fundtype == 1 ? 'NonPublic' : 'Public'); ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
													
													<tr>
                                                        <td width="30%"><label><?php echo $tList[25][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[26][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
													<td width="30%"><label>			
                                                    </label></td>
													<td width="70%">
                                                            <a href="<?php echo $Building['picpath']; ?>" windowheight="300" windowwidth="280" imageheight="512" imagewidth="512" imagedescription="Image 1" style="color: #000084">
															  Click to Display Building Plan
															</a>
                                                        </td>
													</tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Approve Building Details</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                    <form name="frm_land_add2" method="post" id="frm_land_add2" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="notApproveSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[27][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px;" />
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Not Approve</span></span><input name="" type="submit"/></span> </li>
                                                                </ul>       
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            </tr>
                                        </table>
                                    </form>
                                   
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










