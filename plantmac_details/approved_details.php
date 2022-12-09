<?php
include 'header1.php';
?>
<script>
$(document).ready(function()
	{
	$("#submit").click(
            function (e) {
					               var querystring = {	
										groupId: $('#groupId').val(),
										action: 'viewDAM',
										damcomment: $('#damcomment').val()
									}
				    
		$.post('index.php', querystring, processResponse);
							function processResponse(result) {						
													} // end processData	
					
			   e.preventDefault();
            }            
        );
		$('#damcomment').keyup(function(){
    this.value = this.value.toUpperCase();
});
	}
);
</script>
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
                                         <input type="hidden" name="action" value="approveSave" />
                                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
										<input type="hidden" name="groupId" id="groupId" value="<?php echo $groupId; ?>" />
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
                                                            <input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $itemCategory; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $mainCategory; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[5][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[6][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; background-color:white; color: black" disabled/>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:100px; background-color:white; color: black" disabled/>  
                                                            </div>  
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerno"  id="ledgerno" value="<?php echo $ledgerno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ledgerFoliono"  id="ledgerFoliono" value="<?php echo $ledgerFoliono; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" value="<?php echo $eqptSriNo; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="purchasedDate"  id="purchasedDate" value="<?php echo $purchasedDate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="quantity"  id="quantity" value="<?php echo $quantity; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right;"/>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <!-- <tr>
                                                        <td width="30%"><label>Total Cost :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr> -->
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $receivedDate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Remarks; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
																										<tr>
													<td width="30%"><label>			
                                                    </label></td>
													<td width="70%">
                                                            <a href="<?php echo $picpath; ?>" windowheight="300" windowwidth="280" imageheight="512" imagewidth="512" imagedescription="Image 1" style="color: #000084">
															  Click to Display Photo
															</a>
                                                        </td>
													</tr>
													<?php 
                                                          if ($_SESSION['SESS_LEVEL'] == 1 || $_SESSION['SESS_LEVEL'] == 3 || $_SESSION['SESS_LEVEL'] == 4 || $_SESSION['SESS_LEVEL'] == 5) { 
														   ?>
													<tr>
                                                        <td width="30%"><label>DAM Comment :</label></td>
                                                        <<td width="70%"><input type="text" class="text" name="damcomment"  id="damcomment" value="<?php echo isset($damcomment) ? $damcomment : "";?>" style="width:400px; background-color:white; color: black">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>                                                          
														   <input type="submit" name="submit" id="submit" value="Viewed by DAM">								
														</td>
                                                    </tr>
													<?php }	
                                                        ?> 
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










