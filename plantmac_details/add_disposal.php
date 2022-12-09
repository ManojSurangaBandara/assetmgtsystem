<?php
include 'header1.php';
?>
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
                                         <input type="hidden" name="action" value="SelectDisposalSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="transfer" value="<?php echo (isset($transfer) && $transfer == 1 ? '1' : '0')?>" />
                                        <input type="hidden" name="slidebartype" value="<?php echo $slidebartype; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[0][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetscenter"  id="assetscenter" value="<?php echo $assetscenter; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[1][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetunit"  id="assetunit" value="<?php echo $assetunit; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[2][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $itemCategory; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $mainCategory; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; color: black" disabled/>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:100px; color: black" disabled/>  
                                                            </div>  
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerno"  id="ledgerno" value="<?php echo $ledgerno; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerFoliono"  id="ledgerFoliono" value="<?php echo $ledgerFoliono; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" value="<?php echo $eqptSriNo; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="purchasedDate"  id="purchasedDate" value="<?php echo $purchasedDate; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right; color: black" disabled/>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[23][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $receivedDate; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Remarks; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<?php if(isset($transfer) && $transfer == 1) {
													?> 
													<tr>
                                                        <td width="30%"><label><?php echo $tList[24][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input name="transferSelect" type="checkbox" value="1" <?php if($transferSelect==1) echo "checked=checked"; ?> > Select / Deselect
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[25][$lang]?></label></td>

                                                        <td width="70%">
                                                            <select name="transferToCenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&transfer=1&center=' + this.value)">
                                                                <option value=""></option>
                                                                <?php foreach ($assetsCenters as $center) { ?>
                                                                    <option value="<?php echo $center->getName(); ?>" <?php if ($transferToCenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                                                        <?php echo $center->getName(); ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[26][$lang]?></label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="transferToUnit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($assetunits as $unit) { ?>
                                                                        <option value="<?php echo $unit->getName(); ?>" <?php if ($transferToUnit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                                                            <?php echo $unit->getName(); ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[27][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="transferToDate" value="<?php echo $transferToDate; ?>" id="inputField1" style="width:90px;"/>
                                                            </td>    
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[28][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="transferToDetails" value="<?php echo $transferToDetails; ?>" id="transferToDetails" style="width:300px;"/>
                                                            </td>
                                                    </tr>
													<?php } else { ?>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[29][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input name="selectDisposal" type="checkbox" value="1" <?php if($selectDisposal==1) echo "checked=checked"; ?> > Select / Deselect
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="disposedDate" value="<?php echo $disposedDate; ?>" id="inputField1" style="width:90px;"/>
                                                            <?php echo $fields->getField('disposedDate')->getHTML(); ?><br /></td>    </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="disposedReason" value="<?php echo $disposedReason; ?>" id="disposedReason" style="width:300px; text-transform: uppercase;"/>
                                                            <?php echo $fields->getField('disposedReason')->getHTML(); ?><br /></td>    </td>
                                                    </tr>
													<tr>
                                                    <td width="30%"><label><?php echo $tList[31][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="condemnation" value="<?php echo $condemnation; ?>" id="condemnation" style="width:300px; text-transform: uppercase;"/>
                                                        </td> 
                                                    </tr>
													<tr hidden>
													<td width="30%"><label><?php echo $tList[32][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type='text' class="text" name="destruction" value="<?php echo $destruction; ?>" id="destruction" style="width:300px; text-transform: uppercase;"/>
                                                        </td> 
                                                    </tr>
													<?php } ?>
													
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
																<?php if(isset($transfer) && $transfer == 1) {
													?>
                                                                    <li><span class="button send_form_btn"><span><span>Add Transfer Details</span></span><input name="" type="submit"/></span> </li>
                                                               <?php }  else {?> 
															   <li><span class="button send_form_btn"><span><span>Add Disposal Details</span></span><input name="" type="submit"/></span> </li>
															   <?php } ?>
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










