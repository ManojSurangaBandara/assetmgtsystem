<?php include 'header1.php'; ?>
<script>
$(document).ready(function() {
	$("#submit").click(
            function (e) {
			   var querystring = {	
					id : <?php echo $id; ?>,
					lossedDate: $('#lossedDate').val(),
					lossedReason: $('#lossedReason').val(),
					action: 'save_loss_details'
									}
		$.post('index.php', querystring, processResponse);
							function processResponse(result) {	
							//alert(result);
							} // end processData	
			   e.preventDefault();
            }            
        );
		$('#lossedReason').keyup(function(){
    this.value = this.value.toUpperCase();
});
});
</script>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>Add Loss & Damaged Details - <?php echo $identificationno; ?></h2>
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
                                                            <input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:200px; background-color:white; color: black" disabled/>
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
                                                            <input type="text" class="text" name="make"  id="make" value="<?php echo $make; ?>" style="width:100px; background-color:white; color: black" disabled/>
                                                            <input type="text" class="text" name="modle"  id="modle" value="<?php echo $modle; ?>" style="width:150px; background-color:white; color: black" disabled/>
                                                            <input type="text" class="text" name="assetsno"  id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px; background-color:white; color: black" disabled/>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:100px; background-color:white; color: black" disabled/>  
                                                            </div>  
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[22][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="identificationno"  id="identificationno" value="<?php echo $identificationno; ?>" style="width:300px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[7][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="engineno"  id="engineno" value="<?php echo $engineno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[8][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="chessisno"  id="chessisno" value="<?php echo $chessisno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[9][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="yearManufacture"  id="yearManufacture" value="<?php echo $yearManufacture; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>


                                                    <tr>														  
                                                        <td><label><?php echo $tList[10][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="ownerShip"  id="ownerShip" value="<?php echo $ownerShip; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[11][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="armyno"  id="armyno" value="<?php echo $armyno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[12][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="civilno"  id="civilno" value="<?php echo $civilno; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>														  
                                                        <td><label><?php echo $tList[13][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="fuel"  id="fuel" value="<?php echo $fuel; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[14][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="purchasedDate"  id="purchasedDate" value="<?php echo $purchasedDate; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[15][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Total Cost :</label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="totalCost"  id="totalCost" value="<?php echo $totalCost; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[16][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="horsePower"  id="horsePower" value="<?php echo $horsePower; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[17][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="tare"  id="tare" value="<?php echo $tare; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[20][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="presentLocation"  id="presentLocation" value="<?php echo $presentLocation; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[19][$lang]?></label></td>
                                                        <td width="70%">
                                                            <input type="text" class="text" name="receivedDate"  id="receivedDate" value="<?php echo $receivedDate; ?>" style="width:200px; background-color:white; color: black" disabled/>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label><?php echo $tList[21][$lang]?></label></td>
                                                        <td width="70%"><input type="text" class="text" name="Remarks"  id="Remarks" value="<?php echo $Remarks; ?>" style="width:200px; background-color:white; color: black" disabled/>
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
													<td width="30%"><label><h3>Loss & Damaged Details</h3></label></td>
													<tr>
                                                        <td width="30%"><label>Loss / Damaged Date :</label></td>
                                                        <<td width="70%"><input type="date" class="date" name="lossedDate"  id="lossedDate" value="<?php echo $lossedDate;?>" style="background-color:white; color: black">
                                                        </td>
                                                    </tr>												
													<tr>
                                                        <td width="30%"><label>Loss / Damaged Reason :</label></td>
                                                        <<td width="70%"><input type="text" class="text" name="lossedReason"  id="lossedReason" value="<?php echo $lossedReason;?>" style="width:400px; background-color:white; color: black">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>                                                          
														   <input type="submit" name="submit" id="submit" value="Add Loss & Damaged Details">								
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










