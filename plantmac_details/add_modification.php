<?php
include '../view/header1.php';
?>


<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
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
                                        <input type="hidden" name="slidebartype" value="<?php echo $slidebartype; ?>" />
										<input type="hidden" name="groupId" value="<?php echo $groupId; ?>" />
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetscenter"  id="assetscenter" value="<?php echo $assetscenter; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetunit"  id="assetunit" value="<?php echo $assetunit; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Main Category :</label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $itemCategory; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Item Category :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $mainCategory; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Item Description :</label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Catalogue Number :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:200px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Make/Modle/Assets No:</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; color: black" disabled/>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:100px; color: black" disabled/>  
                                                            </div>  
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Identification Number :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Ledger Number :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerno"  id="ledgerno" value="<?php echo $ledgerno; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Ledger Folio Number :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerFoliono"  id="ledgerFoliono" value="<?php echo $ledgerFoliono; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Equipment Serial Number :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" value="<?php echo $eqptSriNo; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label>Date of Purchased  :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="purchasedDate"  id="purchasedDate" value="<?php echo $purchasedDate; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label>Quantity :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Capacity :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Unit Value :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right; color: black" disabled/>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Total Cost :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Date of Received :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $receivedDate; ?>" style="width:300px; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Remarks  :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Remarks; ?>" style="width:300px; color: black" disabled/>
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










