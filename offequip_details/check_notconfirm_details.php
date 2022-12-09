<?php
include 'header1.php';
?>
<script>
	$(function(){
	$("#submit").click(function(){
	   saveData();
	return false
});
function saveData()
		{
	var unit = $('#unit').val();
    if ($('#errordisplay').is(":checked")) {
        var errordisplay = 1;
    } else {
        var errordisplay = 0;
    }
    var errortitle = $('#errortitle').val();
	var errordetails = $('#errordetails').val();
	var querystring = {
			unit: unit,
            errordisplay: errordisplay,
			errortitle: errortitle,
			errordetails: errordetails,
			action: 'add_unit_error_record'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		if (result == 1) {
		$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Add Error Details Successfully Saved.</strong></li>');
		}
		}
	return false
		};
	});
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
                                    <ul class="system_messages">
                                        <?php
                                        switch ($error) {
                                            case '0':
                                                ?>
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Press "Approve Plant & Machinery Details" Button</strong></li>
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
                                                            <input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $itemCategory; ?>" style="width:400px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[3][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $mainCategory; ?>" style="width:400px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[4][$lang]?></label></td>
                                                        <td  width="70%">
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:400px; background-color:white; color: black" disabled/>
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
                                                        <td width="30%"><label><?php echo $tList[33][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="natureOwnership"  id="natureOwnership" value="<?php echo $natureOwnership; ?>" style="width:200px; background-color:white; color: black" disabled/>
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
                                                    <tr hidden>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; text-align: right;"/>
                                                            <?php echo $fields->getField('unitValue')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $receivedDate; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="presentLocation"  id="presentLocation" value="<?php echo $presentLocation; ?>" style="width:100px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Remarks; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
													                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[18][$lang]?></label></td>
                                                        <td width="70%">
                                                            <select name="identificationno" size=<?php echo ($qty > 10 ? 10 : $qty); ?> multiple>
                                                                <?php
                                                                for ($x = 0; $x < $qty; $x++) {
                                                                    ?>
                                                                    <option value="<?php echo $idList[$x]; ?>"><?php echo $idList[$x]; ?>
                                                                    <?php } ?>
                                                            </select>

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
													<tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>

                                                        <td width="70%">
                                                            <input type="text" class="text" name="notapprivedReason"  id="notapprivedReason" value="<?php echo $notapprivedReason; ?>" style="width:400px;" disabled/>
                                                        </td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Operator Add Date & Time :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="sysdate"  id="sysdate" value="<?php echo $sysdate; ?>" style="width:300px;" disabled/>
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
            <div class="section_content">
                <div class="sct">
                    <div class="sct_left">
                        <div class="sct_right">
                            <div class="sct_left">
                                <div class="sct_right">								
								<div id="confirm" title="Confirm Destruction"></div>
                                    <ul id="message" class="system_messages">
                                        <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Error Details" Button</strong></li>
                                    </ul>
                                    <form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
                                        <div><label for="brand" class="label">Assets Unit :</label><input type="text" class="text" name="unit"  id="unit" value ="<?php echo $assetunit; ?>" style="width:300px" readonly/></div>
                                        <div><label for="brand" class="label">Error Display :</label><input type="checkbox" name="errordisplay" id="errordisplay" value="1" <?php if($errordisplay==1) echo "checked=checked"; ?>></div>
										<div><label for="errortitle" class="label">Error Title :</label><input type="text" class="text" name="errortitle"  id="errortitle" value ="<?php echo $errortitle; ?>" style="width:300px"/></div>
                                        <div><label for="errordetails" class="label">Error Details :</label><textarea rows="15" cols="80" name="errordetails"  id="errordetails"><?php echo $errordetails; ?></textarea></div>
										<div><input type="submit" name="submit" id="submit" value="Add Error Details"></div>  
                                    </form>									
                                        <a href="mailto:<?php echo $email; ?>?subject=වකඅම - ජාලගත පරිගණක වැඩසටහන - හඳුනාගත් වැරදි පිළිබඳව දැනුවත් කිරීම.&body=ඔබ ඒකකය විසින් ස්ථාවර වත්කම් ජාලගත පරිගණක වැඩසටහන වෙත ඇතුලත් කර ඇති විස්තරයන්හි නිළධාරි විසින් අනුමත නොකල අයිතමයන් ඇති බව හදුනාගෙන ඇත.  එහෙයින්  ඉක්මණින් නිවැරදි කර වකඅම වෙත දැනුම් දෙන්න. "><button type="button">Send E-Mail</button></a>
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










