<?php
include 'header1.php';
?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2><?php echo "ADD - Plant & Machinery Details - Received form Other Unit"; ?></h2>
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
                                                <li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and  press "Add Details" Button</strong></li>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Identification Number Already Entered !</strong></li>
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
                                        <input type="hidden" name="action" value="Add_Transfer_Detail" />
										<input type="hidden" name="groupId" value="<?php echo $groupId; ?>" />
										<!--<input type="hidden" name="assetscenterFrom" value="<?php echo $assetscenterFrom; ?>" />
                                        <input type="hidden" name="assetunitFrom" value="<?php echo $assetunitFrom; ?>" />
                                        <input type="hidden" name="identificationnofrom" value="<?php echo $identificationnofrom; ?>" /> -->
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
												<tr>
                                                        <td width="30%"><label>Received From - Center :</label></td>

                                                        <td width="70%">
														   <input type="text" class="text" name="assetscenterFrom"  id="assetscenterFrom" value="<?php echo $assetscenterFrom; ?>" style="width:200px" readonly/> 
                                            
															</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Received From - Unit :</label></td>
                                                        <td width="70%">
																<input type="text" class="text" name="assetunitFrom"  id="assetunitFrom" value="<?php echo $assetunitFrom; ?>" style="width:200px" readonly/>
                                                    </tr>
																									<tr>
                                                        <td width="30%"><label>Old Identification no. :</label></td>

                                                        <td width="70%">
														   <input type="text" class="text" name="identificationnofrom"  id="identificationnofrom" value="<?php echo $identificationnofrom; ?>" style="width:300px" readonly/> 
                                            
															</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Center :</label></td>

                                                        <td width="70%">
														   <input type="text" class="text" name="assetscenter"  id="assetscenter" value="<?php echo $assetscenter; ?>" style="width:200px" readonly/> 
                                                            <?php echo $fields->getField('assetscenter')->getHTML(); ?><br />
															</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Assets Unit :</label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
																<input type="text" class="text" name="assetunit"  id="assetunit" value="<?php echo $assetunit; ?>" style="width:200px" readonly/>
                                                            <?php echo $fields->getField('assetunit')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Main Category :</label></td>
															<td width="70%">
															<input type="text" class="text" name="mainCategory"  id="mainCategory" value="<?php echo $mainCategory; ?>" style="width:400px" readonly/>
															<?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
                                                    </tr>
                                              
												   <tr>
                                                        <td width="30%"><label>Item Category :</label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $itemCategory; ?>" style="width:400px" readonly/>
                                                         <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Item Description :</label></td>
                                                        <td  width="70%">
														<input type="text" class="text" name="itemDescription"  id="itemDescription" value="<?php echo $itemDescription; ?>" style="width:400px" readonly/>
														<?php echo $fields->getField('itemDescription')->getHTML(); ?><br /></td>
                                                        </td> 
                                                    </tr>														  
                                                    <tr>
                                                        <td width="30%"><label>Catalogue Number :</label></td>
                                                        <td width="70%">
														<input type="text" class="text" name="catalogueno"  id="catalogueno" value="<?php echo $catalogueno; ?>" style="width:200px" readonly/>
                                                                <?php echo $fields->getField('catalogueno')->getHTML(); ?><br />
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
													<td width="30%"><label>Assets Number/Classification No:</label></td>
                                                        <td width="70%">
                                                            <div id="Itmdiv">
                                                            <input type="text" class="text" name="assetsno" id="assetsno" value="<?php echo $assetsno; ?>" style="width:50px" readonly/>
                                                            <?php echo $fields->getField('assetsno')->getHTML(); ?>
                                                            <input type="text" class="text" name="newAssestno"  id="newAssestno" value="<?php echo $newAssestno; ?>" style="width:100px" readonly/>
                                                            <?php echo $fields->getField('newAssestno')->getHTML(); ?><br />
                                                            </div>  
                                                            </td>
                                                          
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Ledger Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="ledgerno"  id="ledgerno" value="<?php echo $ledgerno; ?>" style="width:200px" readonly/>
                                                            <?php echo $fields->getField('ledgerno')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Ledger Folio Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="ledgerFoliono"  id="ledgerFoliono" value="<?php echo $ledgerFoliono; ?>" style="width:200px" readonly/>
                                                            <?php echo $fields->getField('ledgerFoliono')->getHTML(); ?><br /></td>
                                                    </tr>

                                                    <tr>
                                                        <td width="30%"><label>Equipment Serial Number :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="eqptSriNo"  id="eqptSriNo" value="<?php echo $eqptSriNo; ?>" style="width:200px" readonly/>
                                                            <?php echo $fields->getField('eqptSriNo')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label>Date of Purchased  :</label></td>
                                                        <td width="70%"><input type='text' class="text" name="purchasedDate" value="<?php echo $purchasedDate; ?>" id="inputField1" style="width:90px;" readonly/>
                                                            <?php echo $fields->getField('purchasedDate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label>Quantity :</label></td>
                                                        <td width="70%">
                                                        <input type="text" class="text" name="quantity"  id="quantity" value="1" style="width:100px; text-align: right" readonly/>
                                                            <?php echo $fields->getField('quantity')->getHTML(); ?><br />
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Capacity :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="capacity"  id="capacity" value="<?php echo $capacity; ?>" style="width:100px; text-align: right" readonly/>
                                                            <?php echo $fields->getField('capacity')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Unit Value :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="unitValue"  id="unitValue" value="<?php echo $unitValue; ?>" style="width:100px; text-align: right;" readonly/>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>
                                                    </tr>

                                                        <tr>
                                                        <td width="30%"><label>Acquired Institute :</label></td>
														<td width="70%"><input type="text" class="text" name="acquisitionInstitute"  id="acquisitionInstitute" value="<?php echo $acquisitionInstitute; ?>" style="width:200px;" readonly/>
                                                            <?php echo $fields->getField('acquisitionInstitute')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="30%"><label>Date of Received :</label></td>
                                                        <td width="70%"><input type='text' class="text" name="receivedDate" value="<?php echo $receivedDate; ?>" id="inputField2" style="width:90px;"/>
                                                            <?php echo $fields->getField('receivedDate')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    

                                                    <tr>
                                                        <td width="30%"><label>Remarks  :</label></td>
                                                        <td width="70%"><input type="text" class="text" name="Remarks"  id="remarks" value="<?php echo $Remarks; ?>" style="width:200px;"/> 
                                                            <?php echo $fields->getField('Remarks')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td width="30%"><label>Assets Identification Number :</label></td>
                                                            <td width="70%">
                                                              <div id="Genediv">  
                                                                <input type="text" class="text" name="identificationno"  id="identificationno" value="" style="width:250px;" readonly/>
                                                           <input type="hidden" name="identificationnos" id="identificationnos" value=""/>
                                                              </div>
                                                            <a href="#" onclick="getGeneratedCodeList('index.php?action=generateCodeList')" class="green">Generate Number</a>
                                                            <?php echo $fields->getField('identificationno')->getHTML(); ?><br /></td>     
                                                    </tr>
                                                    <div id="PreLocdiv">
                                                        
                                                        </div>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Plant & Machinery Details"; ?></span></span><input name="" type="submit"/></span> </li>
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
<script>




function myFunction() {
   // var val1 = document.getElementById("newAssestno").value;
   // var val2 = document.getElementById("assetsno").value;
   // var counterId = document.getElementById("counterId").value;
        document.getElementById("identificationno").value = document.getElementById("centreID").value + "/" + document.getElementById("assetsno").value + "/" + document.getElementById("catalogueno").value+ "/" + document.getElementById("counterId").value;

}
function selectAllOptions(id)
	{
	var ref = document.getElementById(id);
	
	for(i=0; i<ref.options.length; i++)
	ref.options[i].selected = true;
	}

</script>
<?php
include('sidebar.php');
include '../view/footer.php';
?>










