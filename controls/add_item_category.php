<?php include 'header1.php';?>
<div id="page">
    <div class="inner">
        <div class="section">
            <div class="title_wrapper">
                <h2>
                    ADD - Item Category
                </h2>
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
                                                <li class="yellow"><span class="ico"></span><strong class="system_title">Assets Catalogue Number Already Entered !</strong></li>
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
                                    <form name="frm_add" method="post" id="frm_add" action="index.php" class="search_form general_form"> 
                                        <input type="hidden" name="action" value="Add_Item_Category" />
                                        
                                        <table width="100%" border="0">
                                            <td colspan="3">
                                                <table width="100%" border="0" class="listing form">
                                                    <tr>
                                                        <td width="30%"><label>Classification :</label></td>

                                                        <td width="70%">
                                                            <select name="classification" onChange="getAssetsUnitByCenter('index.php?action=findMianCategory&classification=' + this.value)">
                                                                <option value=""></option>
                                                                <option value="1">OFFICE EQUIPMENTS</option>
                                                                <option value="2">PLANT & MACHINERY</option>
                                                                <option value="3">VEHICLES</option>
                                                            </select>

                                                            <?php echo $fields->getField('classification')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                        <td width="30%"><label>Main Category :</label></td>
                                                        <td width="70%">
                                                            <div id="Unitdiv">
                                                                <select name="mainCategory"  onChange="getDistrictByProvince('index.php?action=findItemCategory&mainCategory=' + this.value)">
                                                                    <option value=""></option>
                                                                    <?php foreach ($maincategorys as $maincate) { ?>
                                                                        <option value="<?php echo $maincate['mainCategory']; ?>">
                                                                            <?php echo $maincate['mainCategory']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>

                                                            <?php echo $fields->getField('mainCategory')->getHTML(); ?><br /></td>
                                                        </div>
                                                    </tr>
                                                    <tr>
													
													
                                                    <tr>
                                                        <td width="30%"><label>Item Category :</label></td>
                                                        
                                                        <td width="70%"><input type="text" class="text" name="itemCategory"  id="itemCategory" value="<?php echo $itemCategory; ?>" style="width:400px"/>
                                                            <?php echo $fields->getField('itemCategory')->getHTML(); ?><br /></td>
                                                    </tr>
													<tr>
                                                    <td width="30%"><label>Display Details by :</label></td>

                                                        <td width="70%">
                                                            <select name="sorttype">
                                                                <option value="0">Accending Order</option>
                                                                <option value="1">Catalogue Number</option>                                                                
                                                            </select>

                                                            <?php echo $fields->getField('classification')->getHTML(); ?><br /></td>
                                                    </tr>
                                                    <tr>
                                                        <td><label> </label></td>
                                                        <td>
                                                            <div class="buttons">
                                                                <ul>
                                                                    <li><span class="button send_form_btn"><span><span><?php echo "Add Item Category";?></span></span><input name="" type="submit"/></span> </li>
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
			<div id="Itmdiv">
												<div class="table_wrapper">
													<div class="table_wrapper_inner">
														<table cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Classification</th>
															<th>Main Category</th>
															<th>Item Category</th>
															<th>newAssestno</th>
															<th>assetsno</th>
															<th></th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { 

															$row = CatalogueDB::getcatlognewAssestnoByitemCategory($exp['mainCategory'], $exp['itemCategory']);														
														?>																
														
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php if ($exp['type'] == 1) { echo 'OFFICE EQUIPMENTS';}
															 elseif ($exp['type'] == 2) { echo 'PLANT & MACHINERY';}
															 elseif ($exp['type'] == 3) { echo 'VEHICLES';} ?></td>
															<td><?php echo $exp['mainCategory']; ?></td>
															<td><?php echo $exp['itemCategory']; ?></td>
															<td><?php echo ($row[0] ?? ""); ?></td>
															<td><?php echo ($row[1] ?? ""); ?></td>
															<td><form action="." method="post">
															<input type="hidden" name="action" value="Delete_Item_Category" />
															<input type="hidden" name="id" value="<?php echo $exp['id']; ?>"/>
															<input type="hidden" name="mainCategory" value="<?php echo $exp['mainCategory']; ?>"/>															
															<input type="hidden" name="itemCategory" value="<?php echo $exp['itemCategory']; ?>"/>
															<input name="submit" type="submit" value="Delete" onClick = "javascript: return confirm('Are you SURE you wish to Delete Item?');"/>
															</form></td>															
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>
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










