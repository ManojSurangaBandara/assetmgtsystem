<?php
include 'header1.php';
?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2> <?php echo $identificationno; ?> </h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Press "Approve Details" Button </strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Deed Details Already Entered !</strong></li>
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
                                                            <input type="text" class="text" name="category"  id="category" value="<?php echo $category; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; background-color:white; color: black" disabled/>
                                                            <input type="text" class="text" name="classificationno"  id="classificationno" value="<?php echo $classificationno; ?>" style="width:100px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="landNature"  id="landNature" value="<?php echo $landNature; ?>" style="width:200px; background-color:white; color: black" disabled/>
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
                                                        <td> 
                                                            <input type="text" class="text" name="ownership"  id="ownership" value="<?php echo $ownership; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>

                                                    </tr>
                                                    <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                    <td width="70%">
                                                        <input type="text" class="text" name="register"  id="register" value="<?php echo $register; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="landname"  id="landname" value="<?php echo $landname; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">  <input type="text" class="text" name="planno"  id="planno" value="<?php echo $planno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%">  <input type="text" class="text" name="deedno"  id="deedno" value="<?php echo $deedno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="deeddate"  id="deeddate" value="<?php echo $deeddate; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                    <td width="70%"><input type="text" class="text" name="acquisitiondate"  id="acquisitiondate" value="<?php echo $acquisitiondate; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                    </td>
													</tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="areaMeasure"  id="areaMeasure" value="<?php echo $areaMeasure; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="acre"  id="acre" value="<?php echo $acre; ?>" style="width:60px; background-color:white; color: black; text-align: right" disabled/>
                                                            <?php echo $fields->getField('acre')->getHTML(); ?>
                                                            <input type="text" class="text" name="rood"  id="rood" value="<?php echo $rood; ?>" style="width:60px; background-color:white; color: black; text-align: right" disabled/>
                                                            <?php echo $fields->getField('rood')->getHTML(); ?>
                                                            <input type="text" class="text" name="parch"  id="parch" value="<?php echo $parch; ?>" style="width:70px; background-color:white; color: black; text-align: right" disabled/>
                                                            <?php echo $fields->getField('parch')->getHTML(); ?> 
                                                            <br />
                                                            <input type="text" class="text" name="area" id="area" value="<?php echo $area; ?>" style="width:100px; background-color:white; color: black; text-align: right" disabled/>
                                                            <?php echo $fields->getField('area')->getHTML(); ?> 
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="estimatedValue"  id="estimatedValue" value="<?php echo $estimatedValue; ?>" style="width:200px; background-color:white; color: black; text-align: right" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
															<input type="text" class="text" name="acquisitionInstitute" id="acquisitionInstitute" value="<?php echo $acquisitionInstitute; ?>" style="width:100px; background-color:white; color: black" disabled/>
															<input type="text" class="text" name="previousownership"  id="previousownership" value="<?php echo $previousownership; ?>" style="width:250px;background-color:white; color: black"  disabled/>
                                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <<td width="70%"><input type="text" class="text" name="remarks"  id="remarks" value="<?php echo $remarks; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
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
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
													<td width="30%"><label>			
                                                    </label></td>
													<td width="70%">
                                                            <a href="<?php echo $Land['picpath']; ?>" windowheight="300" windowwidth="280" imageheight="512" imagewidth="512" imagedescription="Image 1">
															  Click to Display Land Plan
															</a>
                                                        </td>
													</tr>
													<tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Approve Details</span></span><input name="" type="submit"/></span> </li>
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
                                                        <td width="30%"><label><?php echo $tList[23][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px;" />
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span>Not Approve Details</span></span><input name="" type="submit"/></span> </li>
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










